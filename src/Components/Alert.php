<?php

declare(strict_types=1);

namespace Termage\Components;

use Termage\Base\Element;

final class Alert extends Element
{
    /**
     * Alert size
     *
     * @access private
     */
    private int $alertSize = 50;

    /**
     * Alert padding x
     *
     * @access private
     */
    private int $alertPaddingX = 1;

    /**
     * Alert type
     *
     * @access private
     */
    private string $alertType = 'info';


    /**
     * Alert text align
     *
     * @access private
     */
    private string $alertTextAlign = 'left';

    /**
     * Set alert text align left
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
     * Set alert text align right
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
     * Set alert type info
     * 
     * @return self Returns instance of the Alert class.
     *
     * @access public
     */
    public function info(): self 
    {
        $this->alertType = 'info';
        $this->alertTypeColor = 'black';

        return $this;
    }

    /**
     * Set alert type warning
     * 
     * @return self Returns instance of the Alert class.
     *
     * @access public
     */
    public function warning(): self 
    {
        $this->alertType = 'warning';
        $this->alertTypeColor = 'black';

        return $this;
    }

    /**
     * Set alert type danger
     * 
     * @return self Returns instance of the Alert class.
     *
     * @access public
     */
    public function danger(): self
    {
        $this->alertType = 'danger';
        $this->alertTypeColor = 'white';

        return $this;
    }

    /**
     * Set alert type success
     * 
     * @return self Returns instance of the Alert class.
     *
     * @access public
     */
    public function success(): self
    {
        $this->alertType = 'success';
        $this->alertTypeColor = 'black';

        return $this;
    }

    /**
     * Set alert type primary
     * 
     * @return self Returns instance of the Alert class.
     *
     * @access public
     */
    public function primary(): self
    {
        $this->alertType = 'primary';
        $this->alertTypeColor = 'white';

        return $this;
    }

    /**
     * Set alert type secondary
     * 
     * @return self Returns instance of the Alert class.
     *
     * @access public
     */
    public function secondary(): self 
    {
        $this->alertType = 'secondary';
        $this->alertTypeColor = 'white';

        return $this;
    }

    /**
     * Set alert size
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
        $alertSize      = $this->alertSize;
        $renderer       = $this->getRenderer();
        $theme          = $this->getTheme();
        $value          = $this->getValue()->toString();

        $px = strings($value)->length();

        if ($this->alertTextAlign == 'right') {
            $pr = $this->alertPaddingX;
            $pl = $this->alertSize - $alertPaddingX;
            $pl = $pl - $px;
        }

        if ($this->alertTextAlign == 'left') {
            $pl = $this->alertPaddingX;
            $pr = $this->alertSize - $this->alertPaddingX;
            $pr = $pr - $px;
        }

        $header = termage($renderer, $theme)->el()->px($this->alertSize)->bg($this->alertType)->render();
        $body   = termage($renderer, $theme)->el($value)->pl($pl)->pr($pr)->bg($this->alertType)->color($this->alertTypeColor)->render();
        $footer = termage($renderer, $theme)->el()->px($this->alertSize)->bg($this->alertType)->render();
        
        $this->value($header . "\n" .  $body . "\n" . $footer);

        return parent::render();
    }
}
