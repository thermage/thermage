<?php

declare(strict_types=1);

/**
 * Termage - Totally RAD Terminal styling for PHP! (https://digital.flextype.org/termage/)
 * Copyright (c) Sergey Romanenko (https://awilum.github.io)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE
 * Redistributions of files must retain the above copyright notice.
 *
 * @author    Sergey Romanenko <sergey.romanenko@flextype.org>
 * @copyright Copyright (c) Sergey Romanenko (https://awilum.github.io)
 * @link      https://digital.flextype.org/termage/ Termage
 * @license   https://opensource.org/licenses/mit-license.php MIT License
 */

namespace Termage;

use Termage\Elements\Alert;
use Termage\Elements\Anchor;
use Termage\Elements\Blink;
use Termage\Elements\Bold;
use Termage\Elements\Breakline;
use Termage\Elements\Chart;
use Termage\Elements\Div;
use Termage\Elements\Hr;
use Termage\Elements\Invisible;
use Termage\Elements\Italic;
use Termage\Elements\Paragraph;
use Termage\Elements\Reverse;
use Termage\Elements\Span;
use Termage\Elements\Strikethrough;
use Termage\Elements\Heading;
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

function div(string $value = '', string $class = ''): Div
{
    return Termage::div($value, $class);
}

function paragraph(string $value = '', string $class = ''): Paragraph
{
    return Termage::paragraph($value, $class);
}

function span(string $value = '', string $class = ''): Span
{
    return Termage::span($value, $class);
}

function hr(string $value = '', string $class = ''): Hr
{
    return Termage::hr($value, $class);
}

function anchor(string $value = '', string $class = ''): Anchor
{
    return Termage::anchor($value, $class);
}

function bold(string $value = '', string $class = ''): Bold
{
    return Termage::bold($value, $class);
}

function italic(string $value = '', string $class = ''): Italic
{
    return Termage::italic($value, $class);
}

function underline(string $value = '', string $class = ''): Underline
{
    return Termage::underline($value, $class);
}

function strikethrough(string $value = '', string $class = ''): Strikethrough
{
    return Termage::strikethrough($value, $class);
}

function breakline(string $value = '', string $class = ''): Breakline
{
    return Termage::breakline($value, $class);
}

function chart(string $value = '', string $class = ''): Chart
{
    return Termage::chart($value, $class);
}

function alert(string $value = '', string $class = ''): Alert
{
    return Termage::alert($value, $class);
}

function heading(string $value = '', string $class = ''): Heading
{
    return Termage::heading($value, $class);
}

function color(): Color 
{
    return new Color();
}

function terminal(): Terminal 
{
    return new Terminal();
}