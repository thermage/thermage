<?php

declare(strict_types=1);

namespace Termage\Base;

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