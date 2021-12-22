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

use InvalidArgumentException;

use function array_keys;
use function array_merge;
use function arrays as collection;
use function getenv;
use function hexdec;
use function implode;
use function intval;
use function max;
use function min;
use function mt_rand;
use function preg_match;
use function round;
use function sprintf;
use function strings;
use function substr;
use function Thermage\getCsi;

final class Color
{
    /**
     * COLORS
     *
     * @access private
     */
    private const COLORS = [
        'black' => 0,
        'red' => 1,
        'green' => 2,
        'yellow' => 3,
        'blue' => 4,
        'magenta' => 5,
        'cyan' => 6,
        'white' => 7,
        'default' => 9,
    ];

    /**
     * BRIGHT COLORS
     *
     * @access private
     */
    private const BRIGHT_COLORS = [
        'gray' => 0,
        'bright-red' => 1,
        'bright-green' => 2,
        'bright-yellow' => 3,
        'bright-blue' => 4,
        'bright-magenta' => 5,
        'bright-cyan' => 6,
        'bright-white' => 7,
    ];

    /**
     * Set text foreground color.
     *
     * @param string $value Value.
     * @param string $color Color.
     *
     * @return string Returns text with applied foreground color.
     *
     * @access public
     */
    public static function applyForegroundColor(string $value, string $color): string
    {
        $setCodes   = implode(';', collection(self::parseColor($color))->toArray());
        $unsetCodes = implode(';', collection(['39'])->toArray());

        return sprintf(getCsi() . '%sm', $setCodes) . $value . sprintf(getCsi() . '%sm', $unsetCodes);
    }

    /**
     * Set text background color.
     *
     * @param string $value Value.
     * @param string $color Color.
     *
     * @return string Returns text with applied background color.
     *
     * @access public
     */
    public static function applyBackgroundColor(string $value, string $color): string
    {
        $setCodes   = implode(';', collection(self::parseColor($color, true))->toArray());
        $unsetCodes = implode(';', collection(['49'])->toArray());

        return sprintf(getCsi() . '%sm', $setCodes) . $value . sprintf(getCsi() . '%sm', $unsetCodes);
    }

    /**
     * Get random HEX color.
     *
     * @return string Returns random HEX color.
     *
     * @access public
     */
    public static function getRandomHexColor(): string
    {
        return sprintf('#%06X', mt_rand(0, 0xFFFFFF));
    }

    /**
     * Get random RGB color.
     *
     * @return array Returns random RGB color.
     *
     * @access public
     */
    public static function getRandomRgbColor(): array
    {
        return [
            'r' => mt_rand(0, 255),
            'g' => mt_rand(0, 255),
            'b' => mt_rand(0, 255),
        ];
    }

    /**
     * Parse color.
     *
     * @param string $color      Color.
     * @param bool   $background Is color for background.
     *
     * @return string Returns parsed color.
     *
     * @access public
     */
    private static function parseColor(string $color, bool $background = false): string
    {
        if ($color === '') {
            return '';
        }

        if (strings($color)->startsWith('rgb(') && strings($color)->endsWith(')')) {
            $color = '#' . self::convertRgbColorToHex($color);
        }

        if (strings($color)->startsWith('#')) {
            $color = substr($color, 1);

            if (strings($color)->length() === 3) {
                $color = $color[0] . $color[0] . $color[1] . $color[1] . $color[2] . $color[2];
            }

            if (strings($color)->length() !== 6) {
                throw new InvalidArgumentException(sprintf('Invalid "%s" color.', $color));
            }

            return ($background ? '4' : '3') . self::convertHexColorToAnsi(hexdec($color));
        }

        if (isset(self::COLORS[$color])) {
            return ($background ? '4' : '3') . self::COLORS[$color];
        }

        if (isset(self::BRIGHT_COLORS[$color])) {
            return ($background ? '10' : '9') . self::BRIGHT_COLORS[$color];
        }

        throw new InvalidArgumentException(sprintf('Invalid "%s" color; expected one of (%s).', $color, implode(', ', array_merge(array_keys(self::COLORS), array_keys(self::BRIGHT_COLORS)))));
    }

    /**
     * Convert RGB Color to HEX.
     *
     * @param string $color Color.
     *
     * @return string Color.
     *
     * @access private
     */
    public static function convertRgbColorToHex(string $color): string
    {
        if (preg_match('/(\d{1,3})\,?\s?(\d{1,3})\,?\s?(\d{1,3})/', $color, $matches)) {
            $color = sprintf('%02x%02x%02x', $matches[1], $matches[2], $matches[3]);
        }

        return $color;
    }

    /**
     * Convert HEX Color to ANSI.
     *
     * @param int $color Color.
     *
     * @return string Color.
     *
     * @access private
     */
    private static function convertHexColorToAnsi(int $color): string
    {
        $r = ($color >> 16) & 255;
        $g = ($color >> 8) & 255;
        $b = $color & 255;

        if (getenv('COLORTERM') !== 'truecolor') {
            return (string) self::degradeHexColorToAnsi($r, $g, $b);
        }

        return sprintf('8;2;%d;%d;%d', $r, $g, $b);
    }

    /**
     * Degrade HEX Color to ANSI.
     *
     * @param int $r Red.
     * @param int $g Green.
     * @param int $b Blue.
     *
     * @return int Color.
     *
     * @access private
     */
    private static function degradeHexColorToAnsi(int $r, int $g, int $b): int
    {
        if (round(self::getSaturation($r, $g, $b) / 50) === 0) {
            return 0;
        }

        return (round($b / 255) << 2) | (round($g / 255) << 1) | round($r / 255);
    }

    /**
     * Get saturation
     *
     * @param int $r Red.
     * @param int $g Green.
     * @param int $b Blue.
     *
     * @return int Saturation.
     *
     * @access private
     */
    private static function getSaturation(int $r, int $g, int $b): int
    {
        $r /= 255;
        $g /= 255;
        $b /= 255;
        $v  = max($r, $g, $b);

        if (0 === $diff = $v - min($r, $g, $b)) {
            return 0;
        }

        return intval((int) $diff * 100 / $v);
    }
}
