<?php

declare(strict_types=1);

use Clirad\Clirad;
use Clirad\Components\Element;

if (! function_exists('el')) {
    /**
     * Create element component.
     *
     * @param string $value      Element value.
     * @param array  $properties Element properties.
     *
     * @return Element Returns element component.
     */
    function el(string $value = '', array $properties = []): Element
    {
        return Clirad::element($value, $properties);
    }
}
