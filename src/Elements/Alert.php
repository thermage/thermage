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

use function Termage\terminal;
use function strings;
use function Termage\div;
use function Termage\br;

final class Alert extends Element
{
    /**
     * Alert size.
     *
     * @access private
     */
    private int $alertWidth;

    /**
     * Alert size auto.
     *
     * @access private
     */
    private bool $alertWidthFull;

    /**
     * Alert padding x.
     *
     * @access private
     */
    private int $alertPaddingX;

    /**
     * Alert type.
     *
     * @access private
     */
    private string $alertType;

    /**
     * Alert text align.
     *
     * @access private
     */
    private string $alertTextAlign;

    /** 
     * Get element classes.
     * 
     * @return array Array of element classes.
     *
     * @access public
     */
    public function getElementClasses(): array
    {
        return ['danger', 'info', 'warning', 'success', 'success', 'primary', 'secondary', 'w', 'w-full', 'text-align-left', 'text-align-right'];
    }

    /**
     * Get element variables.
     *
     * @return array Element variables.
     *
     * @access public
     */
    public function getElementVariables(): array
    {
        return [
            'alert' => [
                'text-align' => 'left',
                'width-full' => false,
                'width' => 50,
                'type' => [
                    'info' => [
                        'bg' => 'info',
                        'color' => 'black',
                    ],
                    'warning' => [
                        'bg' => 'warning',
                        'color' => 'black',
                    ],
                    'danger' => [
                        'bg' => 'danger',
                        'color' => 'white',
                    ],
                    'success' => [
                        'bg' => 'success',
                        'color' => 'black',
                    ],
                    'primary' => [
                        'bg' => 'primary',
                        'color' => 'white',
                    ],
                    'secondary' => [
                        'bg' => 'secondary',
                        'color' => 'white',
                    ],
                ],
            ],
        ];
    }

    /**
     * Set alert text align left.
     *
     * @return self Returns instance of the Alert class.
     *
     * @access public
     */
    public function textAlignLeft(): self
    {
        $this->alertTextAlign = 'left';

        return $this;
    }

    /**
     * Set alert text align right.
     *
     * @return self Returns instance of the Alert class.
     *
     * @access public
     */
    public function textAlignRight(): self
    {
        $this->alertTextAlign = 'right';

        return $this;
    }

    /**
     * Set alert type info.
     *
     * @return self Returns instance of the Alert class.
     *
     * @access public
     */
    public function info(): self
    {
        $this->alertType = 'info';

        return $this;
    }

    /**
     * Set alert type warning.
     *
     * @return self Returns instance of the Alert class.
     *
     * @access public
     */
    public function warning(): self
    {
        $this->alertType = 'warning';

        return $this;
    }

    /**
     * Set alert type danger.
     *
     * @return self Returns instance of the Alert class.
     *
     * @access public
     */
    public function danger(): self
    {
        $this->alertType = 'danger';

        return $this;
    }

    /**
     * Set alert type success.
     *
     * @return self Returns instance of the Alert class.
     *
     * @access public
     */
    public function success(): self
    {
        $this->alertType = 'success';

        return $this;
    }

    /**
     * Set alert type primary.
     *
     * @return self Returns instance of the Alert class.
     *
     * @access public
     */
    public function primary(): self
    {
        $this->alertType = 'primary';

        return $this;
    }

    /**
     * Set alert type secondary.
     *
     * @return self Returns instance of the Alert class.
     *
     * @access public
     */
    public function secondary(): self
    {
        $this->alertType = 'secondary';

        return $this;
    }

    /**
     * Set alert width
     *
     * @param int $value Alert width.
     *
     * @return self Returns instance of the Alert class.
     *
     * @access public
     */
    public function w(int $value): self
    {
        $this->alertWidth = $value;

        return $this;
    }

    /**
     * Set alert width full.
     *
     * @return self Returns instance of the Alert class.
     *
     * @access public
     */
    public function wFull(): self
    {
        $this->alertWidthFull = true;

        return $this;
    }

    /**
     * Dynamically bind magic methods to the Element class.
     *
     * @param string $method     Method.
     * @param array  $parameters Parameters.
     *
     * @return mixed Returns mixed content.
     *
     * @throws BadMethodCallException If method not found.
     *
     * @access public
     */
    public function __call(string $method, array $parameters)
    {
        if ($method == 'wFull') {
            return $this->wFull();
        }

        if (strings($method)->startsWith('w')) {
            return $this->w(strings(substr($method, 1))->kebab()->toInteger());
        }

        return parent::__call($method, $parameters);
    }

    /**
     * Render alert element.
     *
     * @return string Returns rendered alert element.
     *
     * @access public
     */
    public function render(): string
    {
        $value               = parent::render();
        $theme               = $this->getTheme();
        $elementVariables    = $this->getElementVariables();
        $alertType           = $this->alertType ?? 'info';
        $alertTextAlign      = $this->alertTextAlign ?? $theme->variables()->get('alert.text-align', $elementVariables['alert']['text-align']);
        $alertPaddingX       = 2;
        $alertWidthFull      = $this->alertWidthFull ?? $theme->variables()->get('alert.size-auto', $elementVariables['alert']['size-auto']);
        $alertWidth          = $this->alertWidth ?? $theme->variables()->get('alert.size', $elementVariables['alert']['size']);
        $alertBg             = $theme->variables()->get('alert.type.' . $alertType . '.bg', $elementVariables['alert']['type'][$alertType]['bg']);
        $alertColor          = $theme->variables()->get('alert.type.' . $alertType . '.color', $elementVariables['alert']['type'][$alertType]['color']);

        $pl = 0;
        $pr = 0;
        $valueLength = strings($this->stripDecorations($value))->length();
        $terminalWidth = terminal()->getWidth();

        if ($alertWidthFull) {
            $alertWidth = $terminalWidth;
        }

        if ($alertWidth > $terminalWidth) {
            $alertWidth = $terminalWidth;
        }

        if ($alertTextAlign === 'right') {
            $pr  = $alertPaddingX;
            $pl  = $alertWidth - $alertPaddingX;
            $pl -= $valueLength;
        }

        if ($alertTextAlign === 'left') {
            $pl  = $alertPaddingX;
            $pr  = $alertWidth - $alertPaddingX;
            $pr -= $valueLength;
        }

        $header = div()->pl($alertWidth)->bg($alertBg);
        $body   = div($value)->pl($pl)->pr($pr)->bg($alertBg)->color($alertColor);
        $footer = div()->pl($alertWidth)->bg($alertBg);

        return $header . $body . $footer;
    }
}
