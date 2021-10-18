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

use Termage\Elements\Div;
use Termage\Elements\Span;
use Termage\Elements\Paragraph;
use Termage\Elements\Strikethrough;
use Termage\Elements\Reverse;
use Termage\Elements\Underline;
use Termage\Elements\Italic;
use Termage\Elements\Invisible;
use Termage\Elements\Breakline;
use Termage\Elements\Bold;
use Termage\Elements\Blink;
use Termage\Elements\Anchor;
use Termage\Elements\Hr;
use Termage\Elements\Chart;
use Termage\Elements\Alert;

function setShortcodes($shortcodes)
{
    Termage::setShortcodes($theme);
}

function getShortcodes()
{
    Termage::getShortcodes();
}

function setTheme($theme)
{
    Termage::setTheme($theme);
}

function getTheme()
{
    Termage::getTheme();
}

function div(string $value = '', string $class = ''): Div
{
    return Termage::div($value, $class);
}

function p(string $value = '', string $class = ''): Paragraph
{
    return Termage::paragraph($value, $class);
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

function a(string $value = '', string $class = ''): Anchor
{
    return Termage::anchor($value, $class);
}

function anchor(string $value = '', string $class = ''): Anchor
{
    return Termage::anchor($value, $class);
}

function bold(string $value = '', string $class = ''): Bold
{
    return Termage::bold($value, $class);
}

function b(string $value = '', string $class = ''): Bold
{
    return Termage::bold($value, $class);
}

function italic(string $value = '', string $class = ''): Italic
{
    return Termage::italic($value, $class);
}

function i(string $value = '', string $class = ''): Italic
{
    return Termage::italic($value, $class);
}

function underline(string $value = '', string $class = ''): Underline
{
    return Termage::italic($value, $class);
}

function u(string $value = '', string $class = ''): Underline
{
    return Termage::italic($value, $class);
}

function strikethrough(string $value = '', string $class = ''): Strikethrough
{
    return Termage::strikethrough($value, $class);
}

function s(string $value = '', string $class = ''): Strikethrough
{
    return Termage::strikethrough($value, $class);
}

function blink(string $value = '', string $class = ''): Blink
{
    return Termage::blink($value, $class);
}

function reverse(string $value = '', string $class = ''): Reverse
{
    return Termage::reverse($value, $class);
}

function invisible(string $value = '', string $class = ''): Invisible
{
    return Termage::invisible($value, $class);
}

function breakline(string $value = '', string $class = ''): Breakline
{
    return Termage::breakline($value, $class);
}

function br(string $value = '', string $class = ''): Breakline
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