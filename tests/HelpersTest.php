<?php

declare(strict_types=1);

use Termage\Termage;
use Termage\Elements\Alert;
use Termage\Elements\Anchor;
use Termage\Elements\Blink;
use Termage\Elements\Bold;
use Termage\Elements\Breakline;
use Termage\Elements\Chart;
use Termage\Elements\Div;
use Termage\Elements\Span;
use Termage\Elements\Hr;
use Termage\Elements\Invisible;
use Termage\Elements\Italic;
use Termage\Elements\Paragraph;
use Termage\Elements\Reverse;
use Termage\Elements\Strikethrough;
use Termage\Elements\Underline;
use function Termage\alert;
use function Termage\anchor;
use function Termage\blink;
use function Termage\bold;
use function Termage\breakline as br;
use function Termage\chart;
use function Termage\div;
use function Termage\span;
use function Termage\hr;
use function Termage\invisible;
use function Termage\italic;
use function Termage\paragraph;
use function Termage\reverse;
use function Termage\strikethrough;
use function Termage\underline;

test('test alert helper', function (): void {
    $this->assertInstanceOf(Alert::class, alert());
});

test('test anchor helper', function (): void {
    $this->assertInstanceOf(Anchor::class, anchor());
});

test('test chart helper', function (): void {
    $this->assertInstanceOf(Chart::class, chart());
});

test('test blink helper', function (): void {
    $this->assertInstanceOf(Blink::class, blink());
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

test('test invisible helper', function (): void {
    $this->assertInstanceOf(Invisible::class, invisible());
});

test('test italic helper', function (): void {
    $this->assertInstanceOf(Italic::class, italic());
});

test('test paragraph helper', function (): void {
    $this->assertInstanceOf(Paragraph::class, paragraph());
});

test('test reverse helper', function (): void {
    $this->assertInstanceOf(Reverse::class, reverse());
});

test('test strikethrough helper', function (): void {
    $this->assertInstanceOf(Strikethrough::class, strikethrough());
});

test('test underline helper', function (): void {
    $this->assertInstanceOf(Underline::class, underline());
});