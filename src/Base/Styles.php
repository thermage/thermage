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

final class Styles
{
    /**
     * Reset all styles and colors.
     *
     * @return string Result all styles and colors.
     *
     * @access public
     */
    public function resetAll(): string
    {
        return terminal()->getCsi() . '0m';
    }

    /**
     * Set bold style.
     *
     * @return string Set bold style.
     *
     * @access public
     */
    public function setBold(): string
    {
        return terminal()->getCsi() . '1m';
    }

    /**
     * Reset bold style.
     *
     * @return string Reset bold style.
     *
     * @access public
     */
    public function resetBold(): string
    {
        return terminal()->getCsi() . '22m';
    }

    /**
     * Set italic style.
     *
     * @return string Set italic style.
     *
     * @access public
     */
    public function setItalic(): string
    {
        return terminal()->getCsi() . '3m';
    }

    /**
     * Reset italic style.
     *
     * @return string Reset italic style.
     *
     * @access public
     */
    public function resetItalic(): string
    {
        return terminal()->getCsi() . '23m';
    }

    /**
     * Set underline style.
     *
     * @return string Set underline style.
     *
     * @access public
     */
    public function setUnderline(): string
    {
        return terminal()->getCsi() . '4m';
    }

    /**
     * Reset underline style.
     *
     * @return string Reset underline style.
     *
     * @access public
     */
    public function resetUnderline(): string
    {
        return terminal()->getCsi() . '24m';
    }

    /**
     * Set strikethrough style.
     *
     * @return string Set strikethrough style.
     *
     * @access public
     */
    public function setStrikethrough(): string
    {
        return terminal()->getCsi() . '9m';
    }

    /**
     * Reset strikethrough style.
     *
     * @return string Reset strikethrough style.
     *
     * @access public
     */
    public function resetStrikethrough(): string
    {
        return terminal()->getCsi() . '29m';
    }

    /**
     * Set dim style.
     *
     * @return string Set dim style.
     *
     * @access public
     */
    public function setDim(): string
    {
        return terminal()->getCsi() . '2m';
    }

    /**
     * Reset dim style.
     *
     * @return string Reset dim style.
     *
     * @access public
     */
    public function resetDim(): string
    {
        return terminal()->getCsi() . '22m';
    }

    /**
     * Set blink style.
     *
     * @return string Set blink style.
     *
     * @access public
     */
    public function setBlink(): string
    {
        return terminal()->getCsi() . '5m';
    }

    /**
     * Reset blink style.
     *
     * @return string Reset blink style.
     *
     * @access public
     */
    public function resetBlink(): string
    {
        return terminal()->getCsi() . '25m';
    }

    /**
     * Set reverse style.
     *
     * @return string Set reverse style.
     *
     * @access public
     */
    public function setReverse(): string
    {
        return terminal()->getCsi() . '7m';
    }

    /**
     * Reset reverse style.
     *
     * @return string Reset reverse style.
     *
     * @access public
     */
    public function resetReverse(): string
    {
        return terminal()->getCsi() . '27m';
    }

    /**
     * Set invisible style.
     *
     * @return string Set invisible style.
     *
     * @access public
     */
    public function setInvisible(): string
    {
        return terminal()->getCsi() . '8m';
    }

    /**
     * Reset invisible style.
     *
     * @return string Reset invisible style.
     *
     * @access public
     */
    public function resetInvisible(): string
    {
        return terminal()->getCsi() . '28m';
    }
}
