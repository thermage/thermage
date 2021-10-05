<?php

declare(strict_types=1);

namespace Termage\Components;

use Symfony\Component\Console\Terminal;
use Termage\Base\Element;

use function strings;
use function termage;

final class Alert extends Element
{
    /**
     * Alert size.
     *
     * @access private
     */
    private int $alertSize = 50;

    /**
     * Alert size auto.
     *
     * @access private
     */
    private bool $alertSizeAuto = false;

    /**
     * Alert padding x.
     *
     * @access private
     */
    private int $alertPaddingX = 1;

    /**
     * Alert type.
     *
     * @access private
     */
    private string $alertType = 'info';

    /**
     * Alert type color.
     *
     * @access private
     */
    private string $alertTypeColor = 'white';

    /**
     * Alert text align.
     *
     * @access private
     */
    private string $alertTextAlign = 'left';

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
        $this->alertType      = 'info';
        $this->alertTypeColor = 'black';

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
        $this->alertType      = 'warning';
        $this->alertTypeColor = 'black';

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
        $this->alertType      = 'danger';
        $this->alertTypeColor = 'white';

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
        $this->alertType      = 'success';
        $this->alertTypeColor = 'black';

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
        $this->alertType      = 'primary';
        $this->alertTypeColor = 'white';

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
        $this->alertType      = 'secondary';
        $this->alertTypeColor = 'white';

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
        $alertType      = $this->alertType;
        $alertTypeColor = $this->alertTypeColor;
        $alertTextAlign = $this->alertTextAlign;
        $alertPaddingX  = $this->alertPaddingX;
        $alertSizeAuto  = $this->alertSizeAuto;
        $alertSize      = $this->alertSize;
        $renderer       = $this->getRenderer();
        $theme          = $this->getTheme();
        $value          = $this->getValue()->toString();

        $px = strings($value)->length();

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

        $header = termage($renderer, $theme)->el()->px($alertSize)->bg($alertType)->render();
        $body   = termage($renderer, $theme)->el($value)->pl($pl)->pr($pr)->bg($alertType)->color($alertTypeColor)->render();
        $footer = termage($renderer, $theme)->el()->px($alertSize)->bg($alertType)->render();

        $this->value($header . "\n" . $body . "\n" . $footer);

        return parent::render();
    }
}
