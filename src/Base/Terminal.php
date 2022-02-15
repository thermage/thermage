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

use Thermage\Base\Styles;
use Thermage\Base\Color;
use Thermage\Base\Cursor;
use Thermage\Base\Screen;
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
     * Control Sequence Escape.
     *
     * @access private
     */
    private static string $esc;

    /**
     * Control Sequence Introducer.
     *
     * @access private
     */
    private static string $csi;

    /**
     * Operating System Command.
     *
     * @access private
     */
    private static string $osc;

    /**
     * Styles.
     *
     * @return self Returns instance of The Styles class.
     * 
     * @access private
     */
    public function styles(): Styles
    {
        return new Styles();
    }

    /**
     * Color.
     *
     * @return self Returns instance of The Color class.
     * 
     * @access private
     */
    public function color(): Color
    {
        return new Color();
    }

    /**
     * Screen.
     *
     * @return self Returns instance of The Screen class.
     * 
     * @access private
     */
    public function screen(): Screen
    {
        return new Screen();
    }

    /**
     * Cursor.
     *
     * @return self Returns instance of The Cursor class.
     * 
     * @access private
     */
    public function cursor(): Cursor
    {
        return new Cursor();
    }

    /**
     * Get Control Sequence Introducer.
     *
     * @return string Control Sequence Introducer.
     *
     * @access public
     */
    public function getCsi(): string
    {
        return self::$csi ??= $this->getEsc() . '[';
    }

    /**
     * Set Control Sequence Introducer.
     *
     * @param string $value Control Sequence Introducer.
     *
     * @access public
     */
    public function csi(string $value): self
    {
        self::$csi = $value;

        return $this;
    }

    /**
     * Get Operating System Command.
     *
     * @return string Operating System Command.
     *
     * @access public
     */
    public function getOsc(): string
    {
        return self::$osc ??= $this->getEsc() . ']';
    }

    /**
     * Set Operating System Command.
     *
     * @param string $value Operating System Command.
     *
     * @access public
     */
    public function osc(string $value): self
    {
        self::$osc = $value;

        return $this;
    }

    /**
     * Get Control Sequence Escape.
     *
     * @return string Control Sequence Escape.
     *
     * @access public
     */
    public static function getEsc(): string
    {
        return self::$esc ??= "\033";
    }

    /**
     * Set Control Sequence Escape.
     *
     * @param string $value Control Sequence Escape.
     *
     * @access public
     */
    public static function setEsc(string $value)
    {
        self::$esc = $value;
    }

    /**
     * Get terminal width.
     *
     * @return int Terminal width.
     *
     * @access public
     */
    public function getWidth(): int
    {
        $width = getenv('COLUMNS');
        if ($width !== false) {
            return (int) trim($width);
        }

        if (self::$width === null) {
            $this->initDimensions();
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
    public function getHeight(): int
    {
        $height = getenv('LINES');
        if ($height !== false) {
            return (int) trim($height);
        }

        if (self::$height === null) {
            $this->initDimensions();
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
    public function width(int $value): self
    {
        putenv('COLUMNS=' . $value);

        return $this;
    }

    /**
     * Set terminal height.
     *
     * @param int $value Terminal width.
     *
     * @access public
     */
    public function height(int $value): self
    {
        putenv('ROWS=' . $value);

        return $this;
    }

    /**
     * Determine is stty available.
     *
     * @return bool True if stty is available otherwise false.
     *
     * @access public
     */
    public function hasSttyAvailable(): bool
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
    private function initDimensions(): void
    {
        if (DIRECTORY_SEPARATOR === '\\') {
            if (preg_match('/^(\d+)x(\d+)(?: \((\d+)x(\d+)\))?$/', trim(getenv('ANSICON')), $matches)) {
                // extract [w, H] from "wxh (WxH)"
                // or [w, h] from "wxh"
                self::$width  = (int) $matches[1];
                self::$height = isset($matches[4]) ? (int) $matches[4] : (int) $matches[2];
            } elseif (! $this->hasVt100Support() && $this->hasSttyAvailable()) {
                // only use stty on Windows if the terminal does not support vt100 (e.g. Windows 7 + git-bash)
                // testing for stty in a Windows 10 vt100-enabled console will implicitly disable vt100 support on STDOUT
                $this->initDimensionsUsingStty();
            } elseif (null !== $dimensions = $this->getConsoleMode()) {
                // extract [w, h] from "wxh"
                self::$width  = (int) $dimensions[0];
                self::$height = (int) $dimensions[1];
            }
        } else {
            $this->initDimensionsUsingStty();
        }
    }

    /**
     * Returns whether STDOUT has vt100 support (some Windows 10+ configurations).
     *
     * @return bool True if STDOUT has vt100 support otherwise false.
     *
     * @access private
     */
    private function hasVt100Support(): bool
    {
        return function_exists('sapi_windows_vt100_support') && sapi_windows_vt100_support(fopen('php://stdout', 'w'));
    }

    /**
     * Initializes dimensions using the output of an stty columns line.
     *
     * @access private
     */
    private function initDimensionsUsingStty(): void
    {
        if (! $sttyString = $this->getSttyColumns()) {
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
    private function getConsoleMode(): ?array
    {
        $info = $this->readFromProcess('mode CON');

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
    private function getSttyColumns(): ?string
    {
        return $this->readFromProcess('stty -a | grep columns');
    }

    /**
     * Read from process.
     *
     * @access private
     */
    private function readFromProcess(string $command): ?string
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

    /**
     * Set title.
     * 
     * @param string $title Title.
     * 
     * @access public
     * 
     * @return string
     */
    public function setTitle(string $title): string
    {
        return $this->isXterm() ? $this->getOsc() . "0;{$title}\007" : '';
    }

    /**
     * Get program name.
     * 
     * @access public
     * 
     * @return string
     */
    public function getName(): string
    {
        return getenv('TERM_PROGRAM') !== false ? getenv('TERM_PROGRAM') : '';
    }

    /**
     * Get program version.
     * 
     * @access public
     * 
     * @return string
     */
    public function getVersion(): string
    {
        return getenv('TERM_PROGRAM_VERSION') !== false ? getenv('TERM_PROGRAM_VERSION') : '';
    }

    /**
     * Determines if terminal is iTerm.app
     *
     * @access public
     * 
     * @return bool Returns TRUE if terminal is iTerm.app. FALSE otherwise.
     */
    public function isIterm(): bool
    {
        return $this->getName() === 'iTerm.app';
    }

    /**
     * Determines if terminal is Apple_Terminal
     *
     * @access public
     * 
     * @return bool Returns TRUE if terminal is Apple_Terminal. FALSE otherwise.
     */
    public function isAppleTerminal(): bool
    {
        return $this->getName() === 'Apple_Terminal';
    }

    /**
     * Check if terminal has 256 color support.
     * 
     * @access public
     * 
     * @return bool
     */
    public function has256ColorSupport(): bool
    {
        return $this->checkEnvVariable('TERM', '256color') || $this->checkEnvVariable('DOCKER_TERM', '256color');
    }

    /**
     * Check if terminal is xterm.
     * 
     * @access public
     * 
     * @return bool
     */
    public function isXterm(): bool
    {
        return $this->checkEnvVariable('TERM', 'xterm') || $this->checkEnvVariable('DOCKER_TERM', 'xterm');
    }

    /**
     * Check if terminal has true color support.
     * 
     * @access public
     * 
     * @return bool
     */
    public function hasTrueColorSupport(): bool
    {
        return $this->checkEnvVariable('COLORTERM', 'truecolor');
    }

    /**
     * Check environment variable.
     * 
     * @param string $varName  Name.
     * @param string $checkFor Check for.
     * 
     * @access public
     * 
     * @return bool
     */
    public function checkEnvVariable(string $varName, string $checkFor): bool
    {
        if ($t = getenv($varName)) {
            return false !== strpos($t, $checkFor);
        }

        return false;
    }
}
