<?php

declare(strict_types=1);

use Termage\Termage;
use Symfony\Component\Console\Output\BufferedOutput;
use Symfony\Component\Console\Output\ConsoleOutput;
use Symfony\Component\Console\Terminal;
use Termage\Components\Alert;
use Termage\Components\El;
use Termage\Components\Emoji;
use Termage\Components\Link;
use Termage\Components\Rule;
use Termage\Components\Chart;
use Termage\Base\Theme;
use Termage\Parsers\Shortcodes;

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

test('test getTheme', function (): void {
    $termage = termage();

    $this->assertInstanceOf(Theme::class, $termage->getTheme());
});

test('test alert', function (): void {
    $termage = termage();

    $this->assertInstanceOf(Alert::class, $termage->alert());
});

test('test el', function (): void {
    $termage = termage();

    $this->assertInstanceOf(El::class, $termage->el());
});

test('test rule', function (): void {
    $termage = termage();

    $this->assertInstanceOf(Rule::class, $termage->rule());
});

test('test emoji', function (): void {
    $termage = termage();

    $this->assertInstanceOf(Emoji::class, $termage->emoji());
});

test('test link', function (): void {
    $termage = termage();

    $this->assertInstanceOf(Link::class, $termage->link());
});

test('test chart', function (): void {
    $termage = termage();

    $this->assertInstanceOf(Chart::class, $termage->chart());
});

test('test getShortcodes', function (): void {
    $termage = termage();

    $this->assertInstanceOf(Shortcodes::class, $termage->getShortcodes());
});