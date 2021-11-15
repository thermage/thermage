<?php

declare(strict_types=1);

/**
 * Termage - Totally RAD Terminal styling for PHP! (https://digital.flextype.org/termage/)
 * Copyright (c) Sergey Romanenko (https://awilum.github.io)
 *
 * Licensed under The MIT License.
 *
 * For full copyright and license information, please see the LICENSE
 * Redistributions of files must retain the above copyright notice.
 */

namespace Termage\Base;

use function Termage\getCsi;

final class Styles {

    /**
     * Reset all styles.
     * 
     * @return string Result all styles.
     * 
     * @access public
     */
    public static function resetAll(): string
    {
        return getCsi() . "0m";
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
        return getCsi() . "1m";
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
        return getCsi() . "22m";
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
        return getCsi() . "3m";
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
        return getCsi() . "23m";
    }
}