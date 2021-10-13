<?php

declare(strict_types=1);

namespace Termage\Base;

use Atomastic\Arrays\Arrays;

use function arrays;

interface ThemeInterface
{
    /**
     * Get Theme variables.
     *
     * @return array Theme variables.
     *
     * @access public
     */
    public function getThemeVariables(): array;
}