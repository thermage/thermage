<?php

declare(strict_types=1);

use Symfony\Component\Console\Output\OutputInterface as RendererInterface;
use Termage\Base\Theme;
use Termage\Termage;

if (! function_exists('termage')) {
    /**
     * Create a new Termage instance.
     *
     * @param RendererInterface $renderer Renderer interface.
     * @param Theme             $theme    Instance of the Theme class.
     */
    function termage(?RendererInterface $renderer = null, ?Theme $theme = null): Termage
    {
        return new Termage($renderer, $theme);
    }
}
