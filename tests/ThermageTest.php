<?php

declare(strict_types=1);

use Thermage\Thermage;
use Thermage\Elements\Alert;
use Thermage\Elements\Div;
use Thermage\Elements\Anchor;
use Thermage\Elements\Bold;
use Thermage\Elements\Breakline;
use Thermage\Elements\Chart;
use Thermage\Elements\Hr;
use Thermage\Elements\Italic;
use Thermage\Elements\Paragraph;
use Thermage\Elements\Span;
use Thermage\Elements\Strikethrough;
use Thermage\Elements\Underline;
use Thermage\Themes\Theme;
use Thermage\Parsers\Shortcodes;

use function Thermage\terminal;
use function Thermage\div;
use function Thermage\span;
use function Thermage\paragraph;
use function Thermage\alert;
use function Thermage\anchor;
use function Thermage\bold;
use function Thermage\italic;
use function Thermage\breakline;
use function Thermage\chart;
use function Thermage\strikethrough;
use function Thermage\underline;

test('test getTheme', function (): void {
    $this->assertInstanceOf(Theme::class, Thermage::getTheme());
});

test('test alert', function (): void {
    $this->assertInstanceOf(Alert::class, alert());
});

test('test anchor', function (): void {
    $this->assertInstanceOf(Anchor::class, anchor());
});

test('test bold', function (): void {
    $this->assertInstanceOf(Bold::class, bold());
});

test('test breakline', function (): void {
    $this->assertInstanceOf(Breakline::class, breakline());
});

test('test chart', function (): void {
    $this->assertInstanceOf(Chart::class, chart());
});

test('test italic', function (): void {
    $this->assertInstanceOf(Italic::class, italic());
});

test('test paragraph', function (): void {
    $this->assertInstanceOf(Paragraph::class, paragraph());
});

test('test span', function (): void {
    $this->assertInstanceOf(Span::class, span());
});

test('test strikethrough', function (): void {
    $this->assertInstanceOf(Strikethrough::class, strikethrough());
});

test('test underline', function (): void {
    $this->assertInstanceOf(Underline::class, underline());
});

test('test getShortcodes', function (): void {
    $this->assertInstanceOf(Shortcodes::class, Thermage::getShortcodes());
});

test('test setShortcodes', function (): void {
    Thermage::setShortcodes(Thermage::getShortcodes());
    $this->assertInstanceOf(Shortcodes::class, Thermage::getShortcodes());
});

test('test csi and getCsi', function (): void {
    terminal()->csi('foo');
    terminal()->csi('bar');
    expect(terminal()->getCsi('bar'))->toEqual("bar");
});

test('test osc and getOsc', function (): void {
    terminal()->osc('foo');
    terminal()->osc('bar');
    expect(terminal()->getOsc('bar'))->toEqual("bar");
});