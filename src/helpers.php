<?php

declare(strict_types=1);

use Termage\Themes\ThemeInterface;
use Termage\Termage;

if (! function_exists('termage')) {
    /**
     * Create a new Termage instance.
     *
     * @param ThemeInterface $theme Implementation of Theme interface.
     */
    function termage(?ThemeInterface $theme = null): Termage
    {
        return new Termage($theme);
    }
}
