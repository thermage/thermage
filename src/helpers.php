<?php

declare(strict_types=1);

use Symfony\Component\Console\Output\OutputInterface as RendererInterface;
use Termage\Termage;

if (! function_exists('termage')) {
    /**
     * Create a new Termage instance.
     *
     * @param RendererInterface $renderer Renderer interface.
     */
    function termage(?RendererInterface $renderer = null): Termage
    {
        return new Termage($renderer);
    }
}
