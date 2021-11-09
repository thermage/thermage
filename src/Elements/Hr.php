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

namespace Termage\Elements;

use Atomastic\Arrays\Arrays as Collection;
use Termage\Base\Element;

use function arrays as collection;
use function intval;
use function strings;
use function Termage\div;
use function Termage\terminal;

final class Hr extends Element
{
    /**
     * Get hr element variables.
     *
     * @return Collection Hr element variables.
     *
     * @access public
     */
    public function getElementVariables(): Collection
    {
        return collection([
            'hr' => ['text-align' => 'left'],
        ]);
    }

    /**
     * Render hr element.
     *
     * @return string Returns rendered hr element.
     *
     * @access public
     */
    public function render(): string
    {
        $this->processClasses();

        $theme           = self::getTheme();
        $hrValuePaddingX = 2;
        $hrValueMarginX  = 3;
        $valueLength     = strings($this->stripDecorations($this->getValue() ?? ''))->length();
        $hrTextAlign     = $this->getStyles()['text-align'] ?? $theme->getVariables()->get('hr.text-align', $this->getElementVariables()['hr']['text-align']);

        if ($hrTextAlign === 'left' && $valueLength > 0) {
            $hr = strings('─')->repeat($hrValueMarginX) .
                    strings(' ')->repeat($hrValuePaddingX) .
                    $this->getValue() .
                    strings(' ')->repeat($hrValuePaddingX) .
                    strings('─')->repeat(terminal()->getWidth() - $this->getLength($this->getValue()) - $hrValueMarginX - $hrValuePaddingX * 2);

            return (string) div($hr)->styles($this->getStyles()->toArray());
        }

        if ($hrTextAlign === 'right' && $valueLength > 0) {
            $hr = strings('─')->repeat(terminal()->getWidth() - $this->getLength($this->getValue()) - $hrValueMarginX - $hrValuePaddingX * 2) .
                    strings(' ')->repeat($hrValuePaddingX) .
                    $this->getValue() .
                    strings(' ')->repeat($hrValuePaddingX) .
                    strings('─')->repeat($hrValueMarginX);

            return (string) div($hr)->styles($this->getStyles()->toArray());
        }

        if ($hrTextAlign === 'center' && $valueLength > 0) {
            $mod    = ($hrValuePaddingX + $hrValueMarginX) % 2 === 0 ? 0 : 1;
            $spaces = terminal()->getWidth() - $this->getLength($this->getValue()) - $hrValueMarginX - $hrValuePaddingX + $mod;

            $leftSpaces  = intval($spaces / 2);
            $rightSpaces = intval($spaces / 2);

            if (intval($leftSpaces * 2) < $spaces) {
                $leftSpaces++;
            }

            $hr = strings('─')->repeat($leftSpaces) .
                    strings(' ')->repeat($hrValuePaddingX) .
                    $this->getValue() .
                    strings(' ')->repeat($hrValuePaddingX) .
                    strings('─')->repeat($rightSpaces);

            return (string) div($hr)->styles($this->getStyles()->toArray());
        }

        return (string) div(strings('─')->repeat(terminal()->getWidth())->toString())->styles($this->getStyles()->toArray());
    }
}
