<?php

declare(strict_types=1);

/**
 * Thermage - Totally RAD Terminal styling for PHP! (https://digital.flextype.org/thermage/)
 * Copyright (c) Sergey Romanenko (https://awilum.github.io)
 *
 * Licensed under The MIT License.
 *
 * For full copyright and license information, please see the LICENSE
 * Redistributions of files must retain the above copyright notice.
 */

namespace Thermage\Base;

use function exec;
use function fclose;
use function fopen;
use function function_exists;
use function getenv;
use function is_resource;
use function preg_match;
use function proc_close;
use function proc_open;
use function putenv;
use function stream_get_contents;
use function trim;

use const DIRECTORY_SEPARATOR;

final class Terminal
{
    /**
     * Terminal width.
     *
     * @param int Width.
     *
     * @access private
     */
    private static ?int $width = null;

    /**
     * Terminal height.
     *
     * @param int Width.
     *
     * @access private
     */
    private static ?int $height = null;

    /**
     * Terminal displays or changes the characteristics of the terminal.
     *
     * @access private
     */
    private static $stty;

    /**
     * Get terminal width.
     *
     * @return int Terminal width.
     *
     * @access public
     */
    public static function getWidth(): int
    {
        $width = getenv('COLUMNS');
        if ($width !== false) {
            return (int) trim($width);
        }

        if (self::$width === null) {
            self::initDimensions();
        }

        return self::$width ?: 80;
    }

    /**
     * Get terminal height.
     *
     * @return int Terminal width.
     *
     * @access public
     */
    public static function getHeight(): int
    {
        $height = getenv('LINES');
        if ($height !== false) {
            return (int) trim($height);
        }

        if (self::$height === null) {
            self::initDimensions();
        }

        return self::$height ?: 50;
    }

    /**
     * Set terminal width.
     *
     * @param int $value Terminal width.
     *
     * @access public
     */
    public static function setWidth(int $value): void
    {
        putenv('COLUMNS=' . $value);
    }

    /**
     * Set terminal height.
     *
     * @param int $value Terminal width.
     *
     * @access public
     */
    public static function setHeight(int $value): void
    {
        putenv('ROWS=' . $value);
    }

    /**
     * Determine is stty available.
     *
     * @return bool True if stty is available otherwise false.
     *
     * @access public
     */
    public static function hasSttyAvailable(): bool
    {
        if (self::$stty !== null) {
            return self::$stty;
        }

        // skip check if exec function is disabled
        if (! function_exists('exec')) {
            return false;
        }

        exec('stty 2>&1', $output, $exitcode);

        return self::$stty = $exitcode === 0;
    }

    /**
     * Init dimensions.
     *
     * @access private
     */
    private static function initDimensions(): void
    {
        if (DIRECTORY_SEPARATOR === '\\') {
            if (preg_match('/^(\d+)x(\d+)(?: \((\d+)x(\d+)\))?$/', trim(getenv('ANSICON')), $matches)) {
                // extract [w, H] from "wxh (WxH)"
                // or [w, h] from "wxh"
                self::$width  = (int) $matches[1];
                self::$height = isset($matches[4]) ? (int) $matches[4] : (int) $matches[2];
            } elseif (! self::hasVt100Support() && self::hasSttyAvailable()) {
                // only use stty on Windows if the terminal does not support vt100 (e.g. Windows 7 + git-bash)
                // testing for stty in a Windows 10 vt100-enabled console will implicitly disable vt100 support on STDOUT
                self::initDimensionsUsingStty();
            } elseif (null !== $dimensions = self::getConsoleMode()) {
                // extract [w, h] from "wxh"
                self::$width  = (int) $dimensions[0];
                self::$height = (int) $dimensions[1];
            }
        } else {
            self::initDimensionsUsingStty();
        }
    }

    /**
     * Returns whether STDOUT has vt100 support (some Windows 10+ configurations).
     *
     * @return bool True if STDOUT has vt100 support otherwise false.
     *
     * @access private
     */
    private static function hasVt100Support(): bool
    {
        return function_exists('sapi_windows_vt100_support') && sapi_windows_vt100_support(fopen('php://stdout', 'w'));
    }

    /**
     * Initializes dimensions using the output of an stty columns line.
     *
     * @access private
     */
    private static function initDimensionsUsingStty(): void
    {
        if (! $sttyString = self::getSttyColumns()) {
            return;
        }

        if (preg_match('/rows.(\d+);.columns.(\d+);/i', $sttyString, $matches)) {
            // extract [w, h] from "rows h; columns w;"
            self::$width  = (int) $matches[2];
            self::$height = (int) $matches[1];
        } elseif (preg_match('/;.(\d+).rows;.(\d+).columns/i', $sttyString, $matches)) {
            // extract [w, h] from "; h rows; w columns"
            self::$width  = (int) $matches[2];
            self::$height = (int) $matches[1];
        }
    }

    /**
     * Runs and parses mode CON if it's available, suppressing any error output.
     *
     * @return int[]|null An array composed of the width and the height or null if it could not be parsed
     *
     * @access private
     */
    private static function getConsoleMode(): ?array
    {
        $info = self::readFromProcess('mode CON');

        if ($info === null || ! preg_match('/--------+\r?\n.+?(\d+)\r?\n.+?(\d+)\r?\n/', $info, $matches)) {
            return null;
        }

        return [(int) $matches[2], (int) $matches[1]];
    }

    /**
     * Runs and parses stty -a if it's available, suppressing any error output.
     *
     * @access private
     */
    private static function getSttyColumns(): ?string
    {
        return self::readFromProcess('stty -a | grep columns');
    }

    /**
     * Read from process.
     *
     * @access private
     */
    private static function readFromProcess(string $command): ?string
    {
        if (! function_exists('proc_open')) {
            return null;
        }

        $descriptorspec = [
            1 => ['pipe', 'w'],
            2 => ['pipe', 'w'],
        ];

        $process = proc_open($command, $descriptorspec, $pipes, null, null, ['suppress_errors' => true]);
        if (! is_resource($process)) {
            return null;
        }

        $info = stream_get_contents($pipes[1]);
        fclose($pipes[1]);
        fclose($pipes[2]);
        proc_close($process);

        return $info;
    }
}
