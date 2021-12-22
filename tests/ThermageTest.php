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

test('test getTheme', function (): void {
    $this->assertInstanceOf(Theme::class, Thermage::getTheme());
});

test('test alert', function (): void {
    $this->assertInstanceOf(Alert::class, Thermage::alert());
});

test('test anchor', function (): void {
    $this->assertInstanceOf(Anchor::class, Thermage::anchor());
});

test('test bold', function (): void {
    $this->assertInstanceOf(Bold::class, Thermage::bold());
});

test('test breakline', function (): void {
    $this->assertInstanceOf(Breakline::class, Thermage::breakline());
});

test('test chart', function (): void {
    $this->assertInstanceOf(Chart::class, Thermage::chart());
});

test('test italic', function (): void {
    $this->assertInstanceOf(Italic::class, Thermage::italic());
});

test('test paragraph', function (): void {
    $this->assertInstanceOf(Paragraph::class, Thermage::paragraph());
});

test('test span', function (): void {
    $this->assertInstanceOf(Span::class, Thermage::span());
});

test('test strikethrough', function (): void {
    $this->assertInstanceOf(Strikethrough::class, Thermage::strikethrough());
});

test('test underline', function (): void {
    $this->assertInstanceOf(Underline::class, Thermage::underline());
});

test('test getShortcodes', function (): void {
    $this->assertInstanceOf(Shortcodes::class, Thermage::getShortcodes());
});

test('test setShortcodes', function (): void {
    Thermage::setShortcodes(Thermage::getShortcodes());
    $this->assertInstanceOf(Shortcodes::class, Thermage::getShortcodes());
});

test('test setCsi and getCsi', function (): void {
    Thermage::setCsi('foo');
    expect(Thermage::getCsi('foo'))->toEqual("foo");
});

test('test setOsc and getOsc', function (): void {
    Thermage::setOsc('foo');
    expect(Thermage::getOsc('foo'))->toEqual("foo");
});