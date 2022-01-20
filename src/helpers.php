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

function terminal(): Terminal
{
    return new Terminal();
}

function render(string $elements)
{
    Thermage::render($elements);
}

function renderToFile(string $elements, string $file)
{
    Thermage::renderToFile($elements, $file);
}

function div(string $value = '', string $classes = '', array $styles = []): Div
{
    return new Div(
        Thermage::getTheme(),
        Thermage::getShortcodes(),
        $value,
        $classes,
        $styles
    );
}

function paragraph(string $value = '', string $classes = '', array $styles = []): Paragraph
{
    return new Paragraph(
        Thermage::getTheme(),
        Thermage::getShortcodes(),
        $value,
        $classes,
        $styles
    );
}

function span(string $value = '', string $classes = '', array $styles = []): Span
{
    return new Span(
        Thermage::getTheme(),
        Thermage::getShortcodes(),
        $value,
        $classes,
        $styles
    );
}

function hr(string $value = '', string $classes = '', array $styles = []): Hr
{
    return new Hr(
        Thermage::getTheme(),
        Thermage::getShortcodes(),
        $value,
        $classes,
        $styles
    );
}

function anchor(string $value = '', string $classes = '', array $styles = []): Anchor
{
    return new Anchor(
        Thermage::getTheme(),
        Thermage::getShortcodes(),
        $value,
        $classes,
        $styles
    );
}

function bold(string $value = '', string $classes = '', array $styles = []): Bold
{
    return new Bold(
        Thermage::getTheme(),
        Thermage::getShortcodes(),
        $value,
        $classes,
        $styles
    );
}

function italic(string $value = '', string $classes = '', array $styles = []): Italic
{
    return new Italic(
        Thermage::getTheme(),
        Thermage::getShortcodes(),
        $value,
        $classes,
        $styles
    );
}

function underline(string $value = '', string $classes = '', array $styles = []): Underline
{
    return new Underline(
        Thermage::getTheme(),
        Thermage::getShortcodes(),
        $value,
        $classes,
        $styles
    );
}

function strikethrough(string $value = '', string $classes = '', array $styles = []): Strikethrough
{
    return new Strikethrough(
        Thermage::getTheme(),
        Thermage::getShortcodes(),
        $value,
        $classes,
        $styles
    );
}

function breakline(string $value = '', string $classes = '', array $styles = []): Breakline
{
    return new Breakline(
        Thermage::getTheme(),
        Thermage::getShortcodes(),
        $value,
        $classes,
        $styles
    );
}

function chart(string $value = '', string $classes = '', array $styles = []): Chart
{
    return new Chart(
        Thermage::getTheme(),
        Thermage::getShortcodes(),
        $value,
        $classes,
        $styles
    );
}

function alert(string $value = '', string $classes = '', array $styles = []): Alert
{
    return new Alert(
        Thermage::getTheme(),
        Thermage::getShortcodes(),
        $value,
        $classes,
        $styles
    );
}

function heading(string $value = '', string $classes = '', array $styles = []): Heading
{
    return new Heading(
        Thermage::getTheme(),
        Thermage::getShortcodes(),
        $value,
        $classes,
        $styles
    );
}

function canvas(string $value = '', string $classes = '', array $styles = []): Canvas
{
    return new Canvas(
        Thermage::getTheme(),
        Thermage::getShortcodes(),
        $value,
        $classes,
        $styles
    );
}