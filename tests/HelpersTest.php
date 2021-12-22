<?php

declare(strict_types=1);

use Thermage\Thermage;
use Thermage\Elements\Alert;
use Thermage\Elements\Anchor;
use Thermage\Elements\Bold;
use Thermage\Elements\Breakline;
use Thermage\Elements\Chart;
use Thermage\Elements\Div;
use Thermage\Elements\Span;
use Thermage\Elements\Hr;
use Thermage\Elements\Italic;
use Thermage\Elements\Paragraph;
use Thermage\Elements\Strikethrough;
use Thermage\Elements\Underline;
use Thermage\Parsers\Shortcodes;
use Thermage\Themes\Theme;
use function Thermage\alert;
use function Thermage\anchor;
use function Thermage\bold;
use function Thermage\breakline as br;
use function Thermage\chart;
use function Thermage\div;
use function Thermage\span;
use function Thermage\hr;
use function Thermage\italic;
use function Thermage\paragraph;
use function Thermage\strikethrough;
use function Thermage\underline;
use function Thermage\setShortcodes;
use function Thermage\getShortcodes;
use function Thermage\setTheme;
use function Thermage\getTheme;

test('test alert helper', function (): void {
    $this->assertInstanceOf(Alert::class, alert());
});

test('test anchor helper', function (): void {
    $this->assertInstanceOf(Anchor::class, anchor());
});

test('test chart helper', function (): void {
    $this->assertInstanceOf(Chart::class, chart());
});

test('test bold helper', function (): void {
    $this->assertInstanceOf(Bold::class, bold());
});

test('test br helper', function (): void {
    $this->assertInstanceOf(Breakline::class, br());
});

test('test div helper', function (): void {
    $this->assertInstanceOf(Div::class, div());
});

test('test span helper', function (): void {
    $this->assertInstanceOf(Span::class, span());
});

test('test hr helper', function (): void {
    $this->assertInstanceOf(Hr::class, hr());
});

test('test italic helper', function (): void {
    $this->assertInstanceOf(Italic::class, italic());
});

test('test paragraph helper', function (): void {
    $this->assertInstanceOf(Paragraph::class, paragraph());
});

test('test strikethrough helper', function (): void {
    $this->assertInstanceOf(Strikethrough::class, strikethrough());
});

test('test underline helper', function (): void {
    $this->assertInstanceOf(Underline::class, underline());
});

test('test getShortcodes', function (): void {
    $this->assertInstanceOf(Shortcodes::class, getShortcodes());
});

test('test setShortcodes', function (): void {
    setShortcodes(getShortcodes());
    $this->assertInstanceOf(Shortcodes::class, getShortcodes());
});

test('test getTheme', function (): void {
    $this->assertInstanceOf(Theme::class, getTheme());
});

test('test setTheme', function (): void {
    setTheme(getTheme());
    $this->assertInstanceOf(Theme::class, getTheme());
});