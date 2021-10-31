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

use Termage\Base\Element;

use function Termage\div;

final class Alert extends Element
{
    /**
     * Alert type.
     *
     * @access private
     */
    private string $alertType;

    /**
     * Get element classes.
     *
     * @return array Array of element classes.
     *
     * @access public
     */
    public function getElementClasses(): array
    {
        return ['danger', 'info', 'warning', 'success', 'success', 'primary', 'secondary'];
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
     * Render alert element.
     *
     * @return string Returns rendered alert element.
     *
     * @access public
     */
    public function render(): string
    {
        $this->processClasses();

        $theme            = $this->getTheme();
        $elementVariables = $this->getElementVariables();
        $alertType        = $this->alertType ?? 'info';
        $alertTextAlign   = $this->getStyles()['text-align'] ?? $theme->getVariables()->get('alert.text-align', $elementVariables['alert']['text-align']);
        $alertWidth       = $this->getStyles()['width'] ?? $theme->getVariables()->get('alert.width', $elementVariables['alert']['width']);
        $alertBg          = $theme->getVariables()->get('alert.type.' . $alertType . '.bg', $elementVariables['alert']['type'][$alertType]['bg']);
        $alertColor       = $theme->getVariables()->get('alert.type.' . $alertType . '.color', $elementVariables['alert']['type'][$alertType]['color']);
        $alertPaddingX    = 2;

        $this->textAlign($alertTextAlign);
        $this->color($alertColor);
        $this->bg($alertBg);
        $this->w($alertWidth);
        $this->px($alertPaddingX);

        return (string) div()->styles($this->getStyles()->toArray()) .
                        div()->value($this->getValue())->styles($this->getStyles()->toArray()) .
                        div()->styles($this->getStyles()->toArray());
    }
}
