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

use const PHP_EOL;

final class Alert extends Element
{
    /**
     * Alert size.
     *
     * @access private
     */
    private int $alertSize;

    /**
     * Alert size auto.
     *
     * @access private
     */
    private bool $alertSizeAuto;

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
     * Get component properties.
     *
     * @return array Component properties.
     *
     * @access public
     */
    public function getComponentProperties(): array
    {
        return [
            'alert' => [
                'text-align' => 'left',
                'size-auto' => false,
                'size' => 50,
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
     * Set alert size
     *
     * @param int $value Alert size.
     *
     * @return self Returns instance of the Alert class.
     *
     * @access public
     */
    public function size(int $value): self
    {
        $this->alertSize = $value;

        return $this;
    }

    /**
     * Set alert size auto.
     *
     * @return self Returns instance of the Alert class.
     *
     * @access public
     */
    public function sizeAuto(): self
    {
        $this->alertSizeAuto = true;

        return $this;
    }

    /**
     * Render alert component.
     *
     * @return string Returns rendered alert component.
     *
     * @access public
     */
    public function render(): string
    {
        $theme               = $this->getTheme();
        $componentProperties = $this->getComponentProperties();
        $alertType           = $this->alertType ?? 'info';
        $alertTextAlign      = $this->alertTextAlign ?? $theme->variables()->get('alert.text-align', $componentProperties['alert']['text-align']);
        $alertPaddingX       = 2;
        $alertSizeAuto       = $this->alertSizeAuto ?? $theme->variables()->get('alert.size-auto', $componentProperties['alert']['size-auto']);
        $alertSize           = $this->alertSize ?? $theme->variables()->get('alert.size', $componentProperties['alert']['size']);
        $value               = $this->getValue();
        $alertBg             = $theme->variables()->get('alert.type.' . $alertType . '.bg', $componentProperties['alert']['type'][$alertType]['bg']);
        $alertColor          = $theme->variables()->get('alert.type.' . $alertType . '.color', $componentProperties['alert']['type'][$alertType]['color']);

        $px = strings($this->getShortcodes()->stripShortcodes($value))->length();

        if ($alertSizeAuto) {
            $terminal  = new Terminal();
            $alertSize = $terminal->getWidth() - $alertPaddingX;
        }

        if ($alertTextAlign === 'right') {
            $pr  = $alertPaddingX;
            $pl  = $alertSize - $alertPaddingX;
            $pl -= $px;
        }

        if ($alertTextAlign === 'left') {
            $pl  = $alertPaddingX;
            $pr  = $alertSize - $alertPaddingX;
            $pr -= $px;
        }

        $header = span()->px($alertSize)->bg($alertBg);
        $body   = span($value)->pl($pl)->pr($pr)->bg($alertBg)->color($alertColor);
        $footer = span()->px($alertSize)->bg($alertBg);

        $this->setValue($header . PHP_EOL . $body . PHP_EOL . $footer . PHP_EOL);

        return parent::render();
    }
}
