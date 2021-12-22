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

use Thermage\Base\Element;
use Thermage\Base\Terminal;

use function strings;
use function Thermage\div;

use const PHP_EOL;

final class Heading extends Element
{
    /**
     * Heading size.
     *
     * @access private
     */
    private int $size = 1;

    /**
     * Set Heading size.
     *
     * @param int $value Heading size 1 - 5.
     *
     * @return self Returns instance of the Heading class.
     *
     * @access public
     */
    public function size(int $size): self
    {
        $this->size = $size;

        return $this;
    }

    /**
     * Get Heading element classes.
     *
     * @return array Array of element classes.
     *
     * @access public
     */
    public function getElementClasses(): array
    {
        return ['size'];
    }

    /**
     * Dynamically bind magic methods to the Heading class.
     *
     * @param string $method     Method.
     * @param array  $parameters Parameters.
     *
     * @return mixed Returns mixed content.
     *
     * @access public
     */
    public function __call(string $method, array $parameters)
    {
        if (strings($method)->startsWith('size')) {
            return $this->size(strings($method)->substr(4)->kebab()->toInteger());
        }

        return parent::__call($method, $parameters);
    }

    /**
     * Render Heading element.
     *
     * @return string Returns rendered Heading element.
     *
     * @access public
     */
    public function render(): string
    {
        $value = $this->getValue();
        $size  = $this->size;

        if ($size > 5) {
            $size = 5;
        }

        if ($size < 1) {
            $size = 1;
        }

        switch ($size) {
            case 1:
                $heading  = div($value, 'px-1 border-double text-align-center bold');
                $heading .= PHP_EOL;
                break;
            case 2:
                $heading  = div($value, 'px-1 border-heavy text-align-center bold');
                $heading .= PHP_EOL;
                break;
            case 3:
                $heading  = div($value, 'px-1 border-square text-align-center');
                $heading .= PHP_EOL;
                break;
            case 4:
                $heading  = div($value, 'px-1 bold text-align-center');
                $heading .= PHP_EOL;
                break;
            case 5:
            default:
                $heading  = div($value, 'px-1 dim text-align-center');
                $heading .= PHP_EOL;
                break;
        }

        return (string) $heading;
    }
}
