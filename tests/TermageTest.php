<?php

declare(strict_types=1);

use Termage\Termage;
use Termage\Components\El;
use Symfony\Component\Console\Output\BufferedOutput;
use Symfony\Component\Console\Output\ConsoleOutput;

test('test set and get renderer', function (): void {
    $termage = termage();
    $this->assertInstanceOf(ConsoleOutput::class, $termage->getRenderer());

    $termage = termage(new ConsoleOutput());
    $this->assertInstanceOf(ConsoleOutput::class, $termage->getRenderer());

    $termage = termage(new BufferedOutput());
    $this->assertInstanceOf(BufferedOutput::class, $termage->getRenderer());

    $termage = termage()->renderer(new BufferedOutput());
    $this->assertInstanceOf(BufferedOutput::class, $termage->getRenderer());
});

test('test termage el', function (): void {
    $this->assertInstanceOf(El::class, termage()->el());
});
