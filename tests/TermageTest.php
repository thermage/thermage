<?php

declare(strict_types=1);

use Termage\Termage;
use Termage\Components\Block;
use Symfony\Component\Console\Output\BufferedOutput;
use Symfony\Component\Console\Output\ConsoleOutput;

test('test set and get renderer', function (): void {
    $termage = termage();
    $this->assertInstanceOf(ConsoleOutput::class, $termage->getRenderer());

    $termage = termage(new ConsoleOutput());
    $this->assertInstanceOf(ConsoleOutput::class, $termage->getRenderer());

    $termage = termage(new BufferedOutput());
    $this->assertInstanceOf(BufferedOutput::class, $termage->getRenderer());
});

test('test termage block', function (): void {
    $this->assertInstanceOf(Block::class, termage()->block());
});
