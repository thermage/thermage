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

namespace Thermage\Elements;

use Glowy\Arrays\Arrays as Collection;
use Thermage\Base\Element;
use Thermage\Base\Terminal;

use function arrays as collection;
use function intval;
use function strings;
use function Thermage\div;

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
            'hr' => [
                'text-align' => 'left',
                'border' => 'thin',
            ]
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
        $borderStyle     = $this->getStyles()['border'] ?? $theme->getVariables()->get('hr.border', $this->getElementVariables()['hr']['border']);

        // Helper function for determine is border exist.
        $hasBorder = static function () use ($borderStyle, $theme) {
            return $theme->getVariables()->has('hr.borders.' . $borderStyle);
        };

        $borderCharacter = ($hasBorder() ? $theme->getVariables()->get('hr.borders.' . $borderStyle . '.top') : $theme->getVariables()->get('hr.borders.thin.top'));
       
        if ($hrTextAlign === 'left' && $valueLength > 0) {
            $hr = strings($borderCharacter)->repeat($hrValueMarginX) .
                    strings(' ')->repeat($hrValuePaddingX) .
                    $this->getValue() .
                    strings(' ')->repeat($hrValuePaddingX) .
                    strings($borderCharacter)->repeat(Terminal::getWidth() - $this->getLength($this->getValue()) - $hrValueMarginX - $hrValuePaddingX * 2);

            return (string) div($hr)->styles($this->getStyles()->delete('border')->toArray())->textOverflow('hidden');
        }

        if ($hrTextAlign === 'right' && $valueLength > 0) {
            $hr = strings($borderCharacter)->repeat(Terminal::getWidth() - $this->getLength($this->getValue()) - $hrValueMarginX - $hrValuePaddingX * 2) .
                    strings(' ')->repeat($hrValuePaddingX) .
                    $this->getValue() .
                    strings(' ')->repeat($hrValuePaddingX) .
                    strings($borderCharacter)->repeat($hrValueMarginX);

            return (string) div($hr)->styles($this->getStyles()->delete('border')->toArray())->textOverflow('hidden');
        }

        if ($hrTextAlign === 'center' && $valueLength > 0) {
            $mod    = ($hrValuePaddingX + $hrValueMarginX) % 2 === 0 ? 0 : 1;
            $spaces = Terminal::getWidth() - $this->getLength($this->getValue()) - $hrValueMarginX - $hrValuePaddingX + $mod;

            $leftSpaces  = intval($spaces / 2);
            $rightSpaces = intval($spaces / 2);

            if (intval($leftSpaces * 2) < $spaces) {
                $leftSpaces++;
            }

            $hr = strings($borderCharacter)->repeat($leftSpaces) .
                    strings(' ')->repeat($hrValuePaddingX) .
                    $this->getValue() .
                    strings(' ')->repeat($hrValuePaddingX) .
                    strings($borderCharacter)->repeat($rightSpaces);

            return (string) div($hr)->styles($this->getStyles()->delete('border')->toArray())->textOverflow('hidden');
        }

        return (string) div(strings($borderCharacter)->repeat(Terminal::getWidth())->toString())->styles($this->getStyles()->delete('border')->toArray())->textOverflow('hidden');
    }
}
