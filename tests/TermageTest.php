<?php

declare(strict_types=1);

use Termage\Termage;
use Termage\Components\El;
use Symfony\Component\Console\Output\BufferedOutput;
use Symfony\Component\Console\Output\ConsoleOutput;
use Symfony\Component\Console\Terminal;

test('test set and get output', function (): void {
    $termage = termage();
    $this->assertInstanceOf(ConsoleOutput::class, $termage->getOutput());

    $termage = termage(new ConsoleOutput());
    $this->assertInstanceOf(ConsoleOutput::class, $termage->getOutput());

    $termage = termage(new BufferedOutput());
    $this->assertInstanceOf(BufferedOutput::class, $termage->getOutput());

    $termage = termage()->output(new BufferedOutput());
    $this->assertInstanceOf(BufferedOutput::class, $termage->getOutput());
});

test('test getTerminal', function (): void {
    $termage = termage();

    $this->assertInstanceOf(Terminal::class, $termage->getTerminal());
});