<?php

declare(strict_types=1);

namespace Clirad\Base;

abstract class Colors
{
    /**
     * Colors pallete.
     *
     * @access visible
     */
    private static array $pallete = [
        'black'   => 'black',
        'gray'    => 'gray',
        'white'   => 'white',
        'red'     => 'red',
        'green'   => 'green',
        'yellow'  => 'yellow',
        'blue'    => 'blue',
        'magenta' => 'magenta',
        'cyan'    => 'cyan',

        'bright-red'     => 'bright-red',
        'bright-green'   => 'bright-green',
        'bright-yellow'  => 'bright-yellow',
        'bright-blue'    => 'bright-blue',
        'bright-magenta' => 'bright-magenta',
        'bright-cyan'    => 'bright-cyan',
        'bright-white'   => 'bright-white',

        'primary'   => 'blue',
        'secondary' => 'gray',
        'success'   => 'green',
        'info'      => 'cyan',
        'warning'   => 'yellow',
        'danger'    => 'red',
    ];

    /**
     * Get color.
     *
     * @param string $color Color name.
     *
     * @return void Void.
     *
     * @access visible
     */
    public static function get(string $color): string
    {
        return self::has($color) ? self::$pallete[$color] : $color;
    }

    /**
     * Set color.
     *
     * @param string $color Color name.
     * @param string $color Color value.
     *
     * @return void Void.
     *
     * @access visible
     */
    public static function set(string $color, string $value): void
    {
        self::$pallete[$color] = $value;
    }

    /**
     * Checks if the given color exists in the pallete.
     *
     * @param  string $color Color name.
     *
     * @return bool Return TRUE color exists in the pallete, FALSE otherwise.
     *    
     * @access visible
     */
    public static function has(string $color): bool
    {
        return isset(self::$pallete[$color]);
    }

    /**
     * Delete color.
     *
     * @param string $color Color name.
     *
     * @return void Void.
     *
     * @access visible
     */
    public static function delete(string $color): void
    {
        unset(self::$pallete[$color]);
    }

    /**
     * Set colors pallete.
     *
     * @param array $colors Colors pallete.
     *
     * @return void Void.
     *
     * @access visible
     */
    public static function setPallete(array $colors): void
    {
        self::$pallete = $colors;
    }

    /**
     * Get colors pallete.
     * 
     * @return array Colors pallete.
     *
     * @access visible
     */
    public static function getPallete(): array
    {
        return self::$pallete;
    }
}
