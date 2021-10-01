<?php

declare(strict_types=1);

use Clirad\Clirad;

function el(string $value = '', array $properties = []) {
    return Clirad::element($value, $properties);
}