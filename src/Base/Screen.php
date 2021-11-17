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

final class Screen
{
    /**
     * Erase saved lines sequence.
     *
     * @return string Returns erase saved lines sequence.
     *
     * @access public
     */
    public static function eraseSavedLines(): string
    {
        return getCsi() . '3J';
    }

    /**
     * Erase entire screen sequence.
     *
     * @return string Returns erase saved lines sequence.
     *
     * @access public
     */
    public static function eraseAll(): string
    {
        return getCsi() . '2J';
    }

    /**
     * Erase from cursor to beginning of screen sequence.
     *
     * @return string Returns erase saved lines sequence.
     *
     * @access public
     */
    public static function eraseAbove(): string
    {
        return getCsi() . '1J';
    }

    /**
     * Erase from cursor until end of screen.
     *
     * @return string Returns erase saved lines sequence.
     *
     * @access public
     */
    public static function eraseBelow(): string
    {
        return getCsi() . '0J';
    }
}
