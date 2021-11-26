<?php

declare(strict_types=1);

use Termage\Termage;
use Termage\Elements\Alert;
use Termage\Elements\Div;
use Termage\Elements\Anchor;
use Termage\Elements\Bold;
use Termage\Elements\Breakline;
use Termage\Elements\Chart;
use Termage\Elements\Hr;
use Termage\Elements\Italic;
use Termage\Elements\Paragraph;
use Termage\Elements\Span;
use Termage\Elements\Strikethrough;
use Termage\Elements\Underline;
use Termage\Themes\Theme;
use Termage\Parsers\Shortcodes;

test('test getTheme', function (): void {
    $this->assertInstanceOf(Theme::class, Termage::getTheme());
});

test('test alert', function (): void {
    $this->assertInstanceOf(Alert::class, Termage::alert());
});

test('test anchor', function (): void {
    $this->assertInstanceOf(Anchor::class, Termage::anchor());
});

test('test bold', function (): void {
    $this->assertInstanceOf(Bold::class, Termage::bold());
});

test('test breakline', function (): void {
    $this->assertInstanceOf(Breakline::class, Termage::breakline());
});

test('test chart', function (): void {
    $this->assertInstanceOf(Chart::class, Termage::chart());
});

test('test italic', function (): void {
    $this->assertInstanceOf(Italic::class, Termage::italic());
});

test('test paragraph', function (): void {
    $this->assertInstanceOf(Paragraph::class, Termage::paragraph());
});

test('test span', function (): void {
    $this->assertInstanceOf(Span::class, Termage::span());
});

test('test strikethrough', function (): void {
    $this->assertInstanceOf(Strikethrough::class, Termage::strikethrough());
});

test('test underline', function (): void {
    $this->assertInstanceOf(Underline::class, Termage::underline());
});

test('test getShortcodes', function (): void {
    $this->assertInstanceOf(Shortcodes::class, Termage::getShortcodes());
});

test('test setShortcodes', function (): void {
    Termage::setShortcodes(Termage::getShortcodes());
    $this->assertInstanceOf(Shortcodes::class, Termage::getShortcodes());
});

test('test setCsi and getCsi', function (): void {
    Termage::setCsi('foo');
    expect(Termage::getCsi('foo'))->toEqual("foo");
});

test('test setOsc and getOsc', function (): void {
    Termage::setOsc('foo');
    expect(Termage::getOsc('foo'))->toEqual("foo");
});