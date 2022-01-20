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

use function Thermage\terminal;

final class Screen
{
    /**
     * Erase saved lines sequence.
     *
     * @return string Returns erase saved lines sequence.
     *
     * @access public
     */
    public function eraseSavedLines(): string
    {
        return terminal()->getCsi() . '3J';
    }

    /**
     * Erase entire screen sequence.
     *
     * @return string Returns erase saved lines sequence.
     *
     * @access public
     */
    public function eraseAll(): string
    {
        return terminal()->getCsi() . '2J';
    }

    /**
     * Erase from cursor to beginning of screen sequence.
     *
     * @return string Returns erase saved lines sequence.
     *
     * @access public
     */
    public function eraseAbove(): string
    {
        return terminal()->getCsi() . '1J';
    }

    /**
     * Erase from cursor until end of screen.
     *
     * @return string Returns erase saved lines sequence.
     *
     * @access public
     */
    public function eraseBelow(): string
    {
        return terminal()->getCsi() . '0J';
    }
}
