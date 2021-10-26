<?php

declare(strict_types=1);

/**
 * Termage - Totally RAD Terminal styling for PHP! (https://digital.flextype.org/termage/)
 * Copyright (c) Sergey Romanenko (https://awilum.github.io)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE
 * Redistributions of files must retain the above copyright notice.
 *
 * @author    Sergey Romanenko <sergey.romanenko@flextype.org>
 * @copyright Copyright (c) Sergey Romanenko (https://awilum.github.io)
 * @link      https://digital.flextype.org/termage/ Termage
 * @license   https://opensource.org/licenses/mit-license.php MIT License
 */

namespace Termage\Elements;

use Termage\Base\Element;
use Atomastic\Arrays\Arrays as Collection;

use function strings;
use function Termage\div;
use function Termage\span;
use function Termage\terminal;

final class Hr extends Element
{
    /**
     * Hr text align.
     *
     * @access private
     */
    private string $hrTextAlign;

    /**
     * Get element styles.
     *
     * @return Collection Element styles.
     *
     * @access public
     */
    public function getElementStyles(): Collection
    {
        return collection([
            'hr' => [
                'text-align' => 'left',
            ],
        ]);
    }

    /**
     * Set hr text align left.
     *
     * @return self Returns instance of the Rule class.
     *
     * @access public
     */
    public function textAlignLeft(): self
    {
        $this->hrTextAlign = 'left';

        return $this;
    }

    /**
     * Set hr text align right.
     *
     * @return self Returns instance of the Rule class.
     *
     * @access public
     */
    public function textAlignRight(): self
    {
        $this->hrTextAlign = 'right';

        return $this;
    }

    /** 
     * Get element classes.
     * 
     * @return array Array of element classes.
     *
     * @access public
     */
    public function getElementClasses(): array
    {
        return ['text-align-left', 'text-align-right'];
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
        $value               = parent::render();
        $valueLength         = strings($this->stripDecorations($value))->length();
        $theme               = self::getTheme();
        $hrColor             = $this->getStyles()['color'] ?? white;
        $hrTextAlign         = $this->hrTextAlign ?? $theme->getVariables()->get('hr.text-align', $elementStyles['hr']['text-align']);
        $hrPaddingX          = 5;
        $terminalWidth       = terminal()->getWidth();
        $hr                  = '';

        if ($hrTextAlign === 'right') {
            $ruleSize = $terminalWidth - $valueLength - $hrPaddingX;

            $rulePrepend = '';
            for ($i = 0; $i < $ruleSize; $i++) {
                $rulePrepend .= '─';
            }

            $ruleAppend = '';
            for ($i = 0; $i < $hrPaddingX - 2; $i++) {
                $ruleAppend .= '─';
            }

            $ruleAppend = ' ' . $ruleAppend;
            $value      = ' ' . $value;

            $hr = span($rulePrepend)->color($hrColor) . span($value)->color($hrColor) . span($ruleAppend)->color($hrColor);
        }

        if ($hrTextAlign === 'left') {
            $ruleSize = $terminalWidth - $valueLength - $hrPaddingX;

            $ruleAppend = '';
            for ($i = 0; $i < $ruleSize; $i++) {
                $ruleAppend .= '─';
            }

            $rulePrepend = '';
            for ($i = 0; $i < $hrPaddingX - 2; $i++) {
                $rulePrepend .= '─';
            }

            $rulePrepend .= ' ';
            $value       .= ' ';

            $hr = span($rulePrepend)->color($hrColor) . span($value)->color($hrColor) . span($ruleAppend)->color($hrColor);
        }

        if ($valueLength === 0) {
            $ruleElement = '';
            for ($i = 0; $i < $terminalWidth; $i++) {
                $ruleElement .= '─';
            }

            $hr = span($ruleElement)->color($hrColor);
        }

        return (string) div((string) $hr);
    }
}
