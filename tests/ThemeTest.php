<?php

declare(strict_types=1);

use Termage\Termage;
use Termage\Base\Theme;
use Termage\Themes\DefaultTheme;
use Symfony\Component\Console\Output\BufferedOutput;
use Symfony\Component\Console\Output\ConsoleOutput;

test('test set and get theme', function (): void {
    $termage = termage();
    $this->assertInstanceOf(DefaultTheme::class, $termage->getTheme());

    $termage = termage()->theme(new DefaultTheme());
    $this->assertInstanceOf(DefaultTheme::class, $termage->getTheme());
});
