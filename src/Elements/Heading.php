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

use function strings;
use function Termage\bold;
use function Termage\span;
use function Termage\terminal;

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
     * Set heading size.
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
     * Get element classes.
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
     * Render heading element.
     *
     * @return string Returns rendered heading element.
     *
     * @access public
     */
    public function render(): string
    {
        $value         = $this->getValue();
        $valueLength   = $this->getLength($value);
        $terminalWidth = terminal()->getWidth();
        $size          = $this->size;
        $paddingLeft   = $this->getStyles()['padding']['left'] ?? 1;

        if ($size > 5) {
            $size = 5;
        }

        if ($size < 1) {
            $size = 1;
        }

        switch ($size) {
            case 1:
                $heading  = '╔';
                $heading .= strings('═')->repeat($terminalWidth - 2);
                $heading .= '╗';
                $heading .= '║' . span($value)->pl($paddingLeft)->pr($terminalWidth - $paddingLeft - $valueLength - 2) . '║' . PHP_EOL;
                $heading .= '╚';
                $heading .= strings('═')->repeat($terminalWidth - 2);
                $heading .=  '╝';
                $heading .= PHP_EOL . PHP_EOL;
                $heading  = bold($heading);
                break;
            case 2:
                $heading  = '┌';
                $heading .= strings('─')->repeat($terminalWidth - 2);
                $heading .= '┐';
                $heading .= '│' . span($value)->pl($paddingLeft)->pr($terminalWidth - $paddingLeft - $valueLength - 2) . '│' . PHP_EOL;
                $heading .= '└';
                $heading .= strings('─')->repeat($terminalWidth - 2);
                $heading .=  '┘';
                $heading .= PHP_EOL . PHP_EOL;
                $heading  = bold($heading);
                break;
            case 3:
                $heading  = bold($value);
                $heading .= PHP_EOL . PHP_EOL;
                break;
            case 4:
                $heading  = bold($value);
                $heading .= PHP_EOL . PHP_EOL;
                break;
            case 5:
            default:
                $heading  = span($value)->dim();
                $heading .= PHP_EOL . PHP_EOL;
                break;
        }

        return (string) $heading;
    }
}
