<?php

declare(strict_types=1);

use Symfony\Component\Console\Output\OutputInterface;
use Termage\Base\Theme;
use Termage\Termage;

if (! function_exists('termage')) {
    /**
     * Create a new Termage instance.
     *
     * @param OutputInterface $output Output interface.
     * @param Theme           $theme  Instance of the Theme class.
     */
    function termage(?OutputInterface $output = null, ?Theme $theme = null): Termage
    {
        return new Termage($output, $theme);
    }
}
