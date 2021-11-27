<?php

declare(strict_types=1);

/**
 * Termage - Totally RAD Terminal styling for PHP! (https://digital.flextype.org/termage/)
 * Copyright (c) Sergey Romanenko (https://awilum.github.io)
 *
 * Licensed under The MIT License.
 *
 * For full copyright and license information, please see the LICENSE
 * Redistributions of files must retain the above copyright notice.
 */

namespace Termage;

use Termage\Base\Color;
use Termage\Base\Terminal;
use Termage\Elements\Alert;
use Termage\Elements\Anchor;
use Termage\Elements\Bold;
use Termage\Elements\Breakline;
use Termage\Elements\Chart;
use Termage\Elements\Div;
use Termage\Elements\Heading;
use Termage\Elements\Hr;
use Termage\Elements\Italic;
use Termage\Elements\Paragraph;
use Termage\Elements\Span;
use Termage\Elements\Canvas;
use Termage\Elements\Spinner;
use Termage\Elements\Strikethrough;
use Termage\Elements\Underline;

function setShortcodes($shortcodes): void
{
    Termage::setShortcodes($shortcodes);
}

function getShortcodes()
{
    return Termage::getShortcodes();
}

function setTheme($theme): void
{
    Termage::setTheme($theme);
}

function getTheme()
{
    return Termage::getTheme();
}

function getCsi()
{
    return Termage::getCsi();
}

function setCsi($value)
{
    return Termage::setCsi($value);
}

function getOsc()
{
    return Termage::getOsc();
}

function setOsc($value)
{
    return Termage::setOsc($value);
}

function getEsc()
{
    return Termage::getEsc();
}

function setEsc($value)
{
    return Termage::setEsc($value);
}

function div(string $value = '', string $classes = '', array $styles = []): Div
{
    return Termage::div($value, $classes, $styles);
}

function paragraph(string $value = '', string $classes = '', array $styles = []): Paragraph
{
    return Termage::paragraph($value, $classes, $styles);
}

function span(string $value = '', string $classes = '', array $styles = []): Span
{
    return Termage::span($value, $classes, $styles);
}

function hr(string $value = '', string $classes = '', array $styles = []): Hr
{
    return Termage::hr($value, $classes, $styles);
}

function anchor(string $value = '', string $classes = '', array $styles = []): Anchor
{
    return Termage::anchor($value, $classes, $styles);
}

function bold(string $value = '', string $classes = '', array $styles = []): Bold
{
    return Termage::bold($value, $classes, $styles);
}

function italic(string $value = '', string $classes = '', array $styles = []): Italic
{
    return Termage::italic($value, $classes, $styles);
}

function underline(string $value = '', string $classes = '', array $styles = []): Underline
{
    return Termage::underline($value, $classes, $styles);
}

function strikethrough(string $value = '', string $classes = '', array $styles = []): Strikethrough
{
    return Termage::strikethrough($value, $classes, $styles);
}

function breakline(string $value = '', string $classes = '', array $styles = []): Breakline
{
    return Termage::breakline($value, $classes, $styles);
}

function chart(string $value = '', string $classes = '', array $styles = []): Chart
{
    return Termage::chart($value, $classes, $styles);
}

function alert(string $value = '', string $classes = '', array $styles = []): Alert
{
    return Termage::alert($value, $classes, $styles);
}

function heading(string $value = '', string $classes = '', array $styles = []): Heading
{
    return Termage::heading($value, $classes, $styles);
}

function canvas(string $value = '', string $classes = '', array $styles = []): Canvas
{
    return Termage::canvas($value, $classes, $styles);
}

