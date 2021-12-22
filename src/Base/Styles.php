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

use function Thermage\getCsi;

final class Styles
{
    /**
     * Reset all styles and colors.
     *
     * @return string Result all styles and colors.
     *
     * @access public
     */
    public static function resetAll(): string
    {
        return getCsi() . '0m';
    }

    /**
     * Set bold style.
     *
     * @return string Set bold style.
     *
     * @access public
     */
    public static function setBold(): string
    {
        return getCsi() . '1m';
    }

    /**
     * Reset bold style.
     *
     * @return string Reset bold style.
     *
     * @access public
     */
    public static function resetBold(): string
    {
        return getCsi() . '22m';
    }

    /**
     * Set italic style.
     *
     * @return string Set italic style.
     *
     * @access public
     */
    public static function setItalic(): string
    {
        return getCsi() . '3m';
    }

    /**
     * Reset italic style.
     *
     * @return string Reset italic style.
     *
     * @access public
     */
    public static function resetItalic(): string
    {
        return getCsi() . '23m';
    }

    /**
     * Set underline style.
     *
     * @return string Set underline style.
     *
     * @access public
     */
    public static function setUnderline(): string
    {
        return getCsi() . '4m';
    }

    /**
     * Reset underline style.
     *
     * @return string Reset underline style.
     *
     * @access public
     */
    public static function resetUnderline(): string
    {
        return getCsi() . '24m';
    }

    /**
     * Set strikethrough style.
     *
     * @return string Set strikethrough style.
     *
     * @access public
     */
    public static function setStrikethrough(): string
    {
        return getCsi() . '9m';
    }

    /**
     * Reset strikethrough style.
     *
     * @return string Reset strikethrough style.
     *
     * @access public
     */
    public static function resetStrikethrough(): string
    {
        return getCsi() . '29m';
    }

    /**
     * Set dim style.
     *
     * @return string Set dim style.
     *
     * @access public
     */
    public static function setDim(): string
    {
        return getCsi() . '2m';
    }

    /**
     * Reset dim style.
     *
     * @return string Reset dim style.
     *
     * @access public
     */
    public static function resetDim(): string
    {
        return getCsi() . '22m';
    }

    /**
     * Set blink style.
     *
     * @return string Set blink style.
     *
     * @access public
     */
    public static function setBlink(): string
    {
        return getCsi() . '5m';
    }

    /**
     * Reset blink style.
     *
     * @return string Reset blink style.
     *
     * @access public
     */
    public static function resetBlink(): string
    {
        return getCsi() . '25m';
    }

    /**
     * Set reverse style.
     *
     * @return string Set reverse style.
     *
     * @access public
     */
    public static function setReverse(): string
    {
        return getCsi() . '7m';
    }

    /**
     * Reset reverse style.
     *
     * @return string Reset reverse style.
     *
     * @access public
     */
    public static function resetReverse(): string
    {
        return getCsi() . '27m';
    }

    /**
     * Set invisible style.
     *
     * @return string Set invisible style.
     *
     * @access public
     */
    public static function setInvisible(): string
    {
        return getCsi() . '8m';
    }

    /**
     * Reset invisible style.
     *
     * @return string Reset invisible style.
     *
     * @access public
     */
    public static function resetInvisible(): string
    {
        return getCsi() . '28m';
    }
}
