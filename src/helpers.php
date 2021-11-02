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
use Termage\Elements\Strikethrough;
use Termage\Elements\Underline;
use Termage\Utils\Color;
use Termage\Utils\Terminal;

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

function div(string $value = '', string $classes = ''): Div
{
    return Termage::div($value, $classes);
}

function paragraph(string $value = '', string $classes = ''): Paragraph
{
    return Termage::paragraph($value, $classes);
}

function span(string $value = '', string $classes = ''): Span
{
    return Termage::span($value, $classes);
}

function hr(string $value = '', string $classes = ''): Hr
{
    return Termage::hr($value, $classes);
}

function anchor(string $value = '', string $classes = ''): Anchor
{
    return Termage::anchor($value, $classes);
}

function bold(string $value = '', string $classes = ''): Bold
{
    return Termage::bold($value, $classes);
}

function italic(string $value = '', string $classes = ''): Italic
{
    return Termage::italic($value, $classes);
}

function underline(string $value = '', string $classes = ''): Underline
{
    return Termage::underline($value, $classes);
}

function strikethrough(string $value = '', string $classes = ''): Strikethrough
{
    return Termage::strikethrough($value, $classes);
}

function breakline(string $value = '', string $classes = ''): Breakline
{
    return Termage::breakline($value, $classes);
}

function chart(string $value = '', string $classes = ''): Chart
{
    return Termage::chart($value, $classes);
}

function alert(string $value = '', string $classes = ''): Alert
{
    return Termage::alert($value, $classes);
}

function heading(string $value = '', string $classes = ''): Heading
{
    return Termage::heading($value, $classes);
}

function color(): Color
{
    return new Color();
}

function terminal(): Terminal
{
    return new Terminal();
}

function render(string $element): string
{
    return Termage::render($element);
}
