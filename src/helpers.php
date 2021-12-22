<?php

declare(strict_types=1);

/**
 * Thermage - Totally RAD Terminal styling for PHP! (https://digital.flextype.org/thermage/)
 * Copyright (c) Sergey Romanenko (https://awilum.github.io)
 *
 * Licensed under The MIT License.
 *
 * For full copyright and license information, please see the LICENSE
 * Redistributions of files must retain the above copyright notice.
 */

namespace Thermage;

use Thermage\Base\Color;
use Thermage\Base\Terminal;
use Thermage\Elements\Alert;
use Thermage\Elements\Anchor;
use Thermage\Elements\Bold;
use Thermage\Elements\Breakline;
use Thermage\Elements\Chart;
use Thermage\Elements\Div;
use Thermage\Elements\Heading;
use Thermage\Elements\Hr;
use Thermage\Elements\Italic;
use Thermage\Elements\Paragraph;
use Thermage\Elements\Span;
use Thermage\Elements\Canvas;
use Thermage\Elements\Spinner;
use Thermage\Elements\Strikethrough;
use Thermage\Elements\Underline;

function setShortcodes($shortcodes): void
{
    Thermage::setShortcodes($shortcodes);
}

function getShortcodes()
{
    return Thermage::getShortcodes();
}

function setTheme($theme): void
{
    Thermage::setTheme($theme);
}

function getTheme()
{
    return Thermage::getTheme();
}

function getCsi()
{
    return Thermage::getCsi();
}

function setCsi($value)
{
    return Thermage::setCsi($value);
}

function getOsc()
{
    return Thermage::getOsc();
}

function setOsc($value)
{
    return Thermage::setOsc($value);
}

function getEsc()
{
    return Thermage::getEsc();
}

function setEsc($value)
{
    return Thermage::setEsc($value);
}

function div(string $value = '', string $classes = '', array $styles = []): Div
{
    return Thermage::div($value, $classes, $styles);
}

function paragraph(string $value = '', string $classes = '', array $styles = []): Paragraph
{
    return Thermage::paragraph($value, $classes, $styles);
}

function span(string $value = '', string $classes = '', array $styles = []): Span
{
    return Thermage::span($value, $classes, $styles);
}

function hr(string $value = '', string $classes = '', array $styles = []): Hr
{
    return Thermage::hr($value, $classes, $styles);
}

function anchor(string $value = '', string $classes = '', array $styles = []): Anchor
{
    return Thermage::anchor($value, $classes, $styles);
}

function bold(string $value = '', string $classes = '', array $styles = []): Bold
{
    return Thermage::bold($value, $classes, $styles);
}

function italic(string $value = '', string $classes = '', array $styles = []): Italic
{
    return Thermage::italic($value, $classes, $styles);
}

function underline(string $value = '', string $classes = '', array $styles = []): Underline
{
    return Thermage::underline($value, $classes, $styles);
}

function strikethrough(string $value = '', string $classes = '', array $styles = []): Strikethrough
{
    return Thermage::strikethrough($value, $classes, $styles);
}

function breakline(string $value = '', string $classes = '', array $styles = []): Breakline
{
    return Thermage::breakline($value, $classes, $styles);
}

function chart(string $value = '', string $classes = '', array $styles = []): Chart
{
    return Thermage::chart($value, $classes, $styles);
}

function alert(string $value = '', string $classes = '', array $styles = []): Alert
{
    return Thermage::alert($value, $classes, $styles);
}

function heading(string $value = '', string $classes = '', array $styles = []): Heading
{
    return Thermage::heading($value, $classes, $styles);
}

function canvas(string $value = '', string $classes = '', array $styles = []): Canvas
{
    return Thermage::canvas($value, $classes, $styles);
}

