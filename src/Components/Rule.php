<?php

declare(strict_types=1);

namespace Termage\Components;

use Symfony\Component\Console\Terminal;
use Termage\Base\Element;

use function strings;
use function termage;

final class Rule extends Element
{
    /**
     * Rule text align.
     *
     * @access private
     */
    private string $ruleTextAlign = 'left';

    /**
     * Rule padding x.
     *
     * @access private
     */
    private int $rulePaddingX = 5;

    /**
     * Rule color.
     *
     * @access private
     */
    private string $ruleColor = 'info';

    /**
     * Set rule text align left.
     *
     * @return self Returns instance of the Alert class.
     *
     * @access public
     */
    public function textAlignLeft(): self
    {
        $this->ruleTextAlign = 'left';

        return $this;
    }

    /**
     * Set rule text align right.
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
     * Set rule color info.
     *
     * @return self Returns instance of the Alert class.
     *
     * @access public
     */
    public function info(): self
    {
        $this->ruleColor = 'info';

        return $this;
    }

    /**
     * Set rule color warning.
     *
     * @return self Returns instance of the Alert class.
     *
     * @access public
     */
    public function warning(): self
    {
        $this->ruleColor = 'warning';

        return $this;
    }

    /**
     * Set rule color danger.
     *
     * @return self Returns instance of the Alert class.
     *
     * @access public
     */
    public function danger(): self
    {
        $this->ruleColor = 'danger';

        return $this;
    }

    /**
     * Set rule color success.
     *
     * @return self Returns instance of the Alert class.
     *
     * @access public
     */
    public function success(): self
    {
        $this->ruleColor = 'success';

        return $this;
    }

    /**
     * Set rule color primary.
     *
     * @return self Returns instance of the Alert class.
     *
     * @access public
     */
    public function primary(): self
    {
        $this->ruleColor = 'primary';

        return $this;
    }

    /**
     * Set rule color secondary.
     *
     * @return self Returns instance of the Alert class.
     *
     * @access public
     */
    public function secondary(): self
    {
        $this->ruleColor = 'secondary';

        return $this;
    }

    /**
     * Render rule component.
     *
     * @return string Returns rendered alert component.
     *
     * @access public
     */
    public function render(): string
    {
        $ruleTextAlign = $this->ruleTextAlign;
        $rulePaddingX  = $this->rulePaddingX;
        $ruleColor     = $this->ruleColor;
        $renderer      = $this->getRenderer();
        $theme         = $this->getTheme();
        $value         = $this->getValue()->toString();

        $valueLength   = strings($value)->length();
        $terminalWidth = (new Terminal())->getWidth();

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

            $rule = termage($renderer, $theme)->el($rulePrepend)->color($ruleColor)->render() .
                    termage($renderer, $theme)->el($value)->color($ruleColor)->render() .
                    termage($renderer, $theme)->el($ruleAppend)->color($ruleColor)->render();
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

            $rule = termage($renderer, $theme)->el($rulePrepend)->color($ruleColor)->render() .
                    termage($renderer, $theme)->el($value)->color($ruleColor)->render() .
                    termage($renderer, $theme)->el($ruleAppend)->color($ruleColor)->render();
        }

        if ($valueLength === 0) {
            $ruleElement = '';
            for ($i = 0; $i < $terminalWidth; $i++) {
                $ruleElement .= '―';
            }

            $rule = termage($renderer, $theme)->el($ruleElement)->color($ruleColor)->render();
        }

        $this->value($rule);

        return parent::render();
    }
}
