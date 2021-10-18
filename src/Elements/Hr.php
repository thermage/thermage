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
use Termage\Utils\Terminal;

use function strings;
use function Termage\span;

final class Hr extends Element
{
    /**
     * Rule text align.
     *
     * @access private
     */
    private string $ruleTextAlign;

    /**
     * Rule type.
     *
     * @access private
     */
    private string $ruleType;

    /**
     * Set hr text align left.
     *
     * @return self Returns instance of the Rule class.
     *
     * @access public
     */
    public function textAlignLeft(): self
    {
        $this->ruleTextAlign = 'left';

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
        $this->ruleTextAlign = 'right';

        return $this;
    }

    /**
     * Set hr color info.
     *
     * @return self Returns instance of the Rule class.
     *
     * @access public
     */
    public function info(): self
    {
        $this->ruleType = 'info';

        return $this;
    }

    /**
     * Set hr color warning.
     *
     * @return self Returns instance of the Rule class.
     *
     * @access public
     */
    public function warning(): self
    {
        $this->ruleType = 'warning';

        return $this;
    }

    /**
     * Set hr color danger.
     *
     * @return self Returns instance of the Rule class.
     *
     * @access public
     */
    public function danger(): self
    {
        $this->ruleType = 'danger';

        return $this;
    }

    /**
     * Set hr color success.
     *
     * @return self Returns instance of the Rule class.
     *
     * @access public
     */
    public function success(): self
    {
        $this->ruleType = 'success';

        return $this;
    }

    /**
     * Set hr color primary.
     *
     * @return self Returns instance of the Rule class.
     *
     * @access public
     */
    public function primary(): self
    {
        $this->ruleType = 'primary';

        return $this;
    }

    /**
     * Set hr color secondary.
     *
     * @return self Returns instance of the Rule class.
     *
     * @access public
     */
    public function secondary(): self
    {
        $this->ruleType = 'secondary';

        return $this;
    }

    /**
     * Get component properties.
     *
     * @return array Component properties.
     *
     * @access public
     */
    public function getComponentProperties(): array
    {
        return [
            'hr' => [
                'text-align' => 'left',
                'type' => [
                    'info' => ['color' => 'info'],
                    'warning' => ['color' => 'warning'],
                    'danger' => ['color' => 'danger'],
                    'success' => ['color' => 'success'],
                    'primary' => ['color' => 'primary'],
                    'secondary' => ['color' => 'secondary'],
                ],
            ],
        ];
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
        $componentProperties = $this->getComponentProperties();
        $theme               = self::getTheme();
        $ruleType            = $this->ruleType ?? 'info';
        $ruleColor           = $theme->variables()->get('hr.type.' . $ruleType . '.color', $componentProperties['hr']['type'][$ruleType]['color']);
        $ruleTextAlign       = $this->ruleTextAlign ?? $theme->variables()->get('hr.text-align', $componentProperties['hr']['text-align']);
        $rulePaddingX        = 5;
        $terminalWidth       = (new Terminal())->getWidth();
        $hr                  = '';

        if ($ruleTextAlign === 'right') {
            $ruleSize = $terminalWidth - $valueLength - $rulePaddingX;

            $rulePrepend = '';
            for ($i = 0; $i < $ruleSize; $i++) {
                $rulePrepend .= '―';
            }

            $ruleAppend = '';
            for ($i = 0; $i < $rulePaddingX - 2; $i++) {
                $ruleAppend .= '―';
            }

            $ruleAppend = ' ' . $ruleAppend;
            $value      = ' ' . $value;

            $hr = span($rulePrepend)->color($ruleColor) . span($value)->color($ruleColor) . span($ruleAppend)->color($ruleColor);
        }

        if ($ruleTextAlign === 'left') {
            $ruleSize = $terminalWidth - $valueLength - $rulePaddingX;

            $ruleAppend = '';
            for ($i = 0; $i < $ruleSize; $i++) {
                $ruleAppend .= '―';
            }

            $rulePrepend = '';
            for ($i = 0; $i < $rulePaddingX - 2; $i++) {
                $rulePrepend .= '―';
            }

            $rulePrepend .= ' ';
            $value       .= ' ';

            $hr = span($rulePrepend)->color($ruleColor) . span($value)->color($ruleColor) . span($ruleAppend)->color($ruleColor);
        }

        if ($valueLength === 0) {
            $ruleElement = '';
            for ($i = 0; $i < $terminalWidth; $i++) {
                $ruleElement .= '―';
            }

            $hr = span($ruleElement)->color($ruleColor);
        }

        return $hr;
    }
}
