<?php

declare(strict_types=1);

namespace Termage\Base;

use InvalidArgumentException;

use function array_keys;
use function array_merge;
use function count;
use function getenv;
use function hexdec;
use function implode;
use function max;
use function min;
use function mt_rand;
use function round;
use function sprintf;
use function strlen;
use function substr;

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
     * Foreground color.
     *
     * @param string Foreground color.
     *
     * @access private
     */
    private string $foreground;

    /**
     * Background color.
     *
     * @param string Background color.
     *
     * @access private
     */
    private string $background;

    /**
     * Create color instance.
     *
     * @param string $foreground Foreground color.
     * @param string $background Background color.
     *
     * @access public
     */
    public function __construct(string $foreground = '', string $background = '')
    {
        $this->foreground = $this->parseColor($foreground);
        $this->background = $this->parseColor($background, true);
    }

    /**
     * Get random hex color.
     *
     * @return string Returns random hex color.
     *
     * @access public
     */
    public function getRandomHexColor(): string
    {
        return sprintf('#%06X', mt_rand(0, 0xFFFFFF));
    }

    /**
     * Get random rgb color.
     *
     * @return array Returns random rgb color.
     *
     * @access public
     */
    public function getRandomRgbColor(): array
    {
        return [
            'r' => mt_rand(0, 255),
            'g' => mt_rand(0, 255),
            'b' => mt_rand(0, 255),
       ];
    }

    /**
     * Apply color for value.
     *
     * @param string $value Value.
     *
     * @return string Value with applied color.
     *
     * @access public
     */
    public function apply(string $value): string
    {
        return $this->set() . $value . $this->unset();
    }

    /**
     * Set color.
     *
     * @return string Value with set color.
     *
     * @access public
     */
    public function set(): string
    {
        $setCodes = [];
        if ($this->foreground !== '') {
            $setCodes[] = $this->foreground;
        }

        if ($this->background !== '') {
            $setCodes[] = $this->background;
        }

        if (count($setCodes) === 0) {
            return '';
        }

        return sprintf("\e[%sm", implode(';', $setCodes));
    }

    /**
     * Unset color.
     *
     * @return string Value with unset color.
     *
     * @access public
     */
    public function unset(): string
    {
        $unsetCodes = [];
        if ($this->foreground !== '') {
            $unsetCodes[] = 39;
        }

        if ($this->background !== '') {
            $unsetCodes[] = 49;
        }

        if (count($unsetCodes) === 0) {
            return '';
        }

        return sprintf("\e[%sm", implode(';', $unsetCodes));
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
    private function parseColor(string $color, bool $background = false): string
    {
        if ($color === '') {
            return '';
        }

        if ($color[0] === '#') {
            $color = substr($color, 1);

            if (strlen($color) === 3) {
                $color = $color[0] . $color[0] . $color[1] . $color[1] . $color[2] . $color[2];
            }

            if (strlen($color) !== 6) {
                throw new InvalidArgumentException(sprintf('Invalid "%s" color.', $color));
            }

            return ($background ? '4' : '3') . $this->convertHexColorToAnsi(hexdec($color));
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
     * Convert HEX Color to ANSI.
     *
     * @param int $color Color.
     *
     * @return int Color.
     *
     * @access private
     */
    private function convertHexColorToAnsi(int $color): string
    {
        $r = ($color >> 16) & 255;
        $g = ($color >> 8) & 255;
        $b = $color & 255;

        if (getenv('COLORTERM') !== 'truecolor') {
            return (string) $this->degradeHexColorToAnsi($r, $g, $b);
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
    private function degradeHexColorToAnsi(int $r, int $g, int $b): int
    {
        if (round($this->getSaturation($r, $g, $b) / 50) === 0) {
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
    private function getSaturation(int $r, int $g, int $b): int
    {
        $r /= 255;
        $g /= 255;
        $b /= 255;
        $v  = max($r, $g, $b);

        if (0 === $diff = $v - min($r, $g, $b)) {
            return 0;
        }

        return (int) $diff * 100 / $v;
    }
}
