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

namespace Thermage\Base;

use function defined;
use function fopen;
use function fread;
use function function_exists;
use function fwrite;
use function proc_open;
use function shell_exec;
use function sprintf;
use function sscanf;
use function Thermage\terminal;
use function trim;

use const STDIN;

final class Cursor
{
    /**
     * Show cursor sequence.
     *
     * @return string Returns show cursor sequence.
     *
     * @access public
     */
    public function show(): string
    {
        return terminal()->getCsi() . '?25h';
    }

    /**
     * Hide cursor sequence.
     *
     * @return string Returns hide cursor sequence.
     *
     * @access public
     */
    public function hide(): string
    {
        return terminal()->getCsi() . '?25l';
    }

    /**
     * Move cursor up sequence.
     *
     * @param int $rows Rows.
     *
     * @return string Returns move cursor up sequence.
     *
     * @access public
     */
    public function up(int $rows = 1): string
    {
        return terminal()->getCsi() . "{$rows}A";
    }

    /**
     * Move cursor up to begin of the line sequence.
     *
     * @param int $rows Rows.
     *
     * @return string Returns move cursor up to begin of the line sequence.
     *
     * @access public
     */
    public function upLine(int $rows = 1): string
    {
        return terminal()->getCsi() . "{$rows}F";
    }

    /**
     * Move cursor down to begin of the line sequence.
     *
     * @param int $rows Rows.
     *
     * @return string Returns move cursor down to begin of the line sequence.
     *
     * @access public
     */
    public function downLine(int $rows = 1): string
    {
        return terminal()->getCsi() . "{$rows}E";
    }

    /**
     * Move cursor down sequence.
     *
     * @param int $rows Rows.
     *
     * @return string Returns Move cursor down sequence.
     *
     * @access public
     */
    public function down(int $rows = 1): string
    {
        return terminal()->getCsi() . "{$rows}B";
    }

    /**
     * Move cursor forward sequence.
     *
     * @param int $cols Cols.
     *
     * @return string Returns move cursor forward sequence.
     *
     * @access public
     */
    public function forward(int $cols = 1): string
    {
        return terminal()->getCsi() . "{$cols}C";
    }

    /**
     * Move cursor back sequence.
     *
     * @param int $cols Cols.
     *
     * @return string Returns move cursor back sequence.
     *
     * @access public
     */
    public function back(int $cols = 1): string
    {
        return terminal()->getCsi() . "{$cols}D";
    }

    /**
     * Move cursor to sequence.
     *
     * @param int $col Col.
     * @param int $row Row.
     *
     * @return string Returns move cursor to sequence.
     *
     * @access public
     */
    public function goTo(int $col = 1, int $row = 1): string
    {
        return terminal()->getCsi() . "{$row};{$col}f";
    }

    /**
     * Move cursor to position in current line sequence.
     *
     * @param int $col Col.
     *
     * @return string Returns move cursor to position in current line sequence.
     *
     * @access public
     */
    public function absX(int $col = 1): string
    {
        return terminal()->getCsi() . "{$col}G";
    }

    /**
     * Move cursor to position in current column sequence.
     *
     * @param int $row Row.
     *
     * @return string Returns move cursor to position in current column sequence.
     *
     * @access public
     */
    public function absY(int $row = 1): string
    {
        return terminal()->getCsi() . "{$row}d";
    }

    /**
     * Save cursor position sequence.
     *
     * @return string Returns save cursor position sequence.
     *
     * @access public
     */
    public function savePosition(): string
    {
        return terminal()->getCsi() . 's';
    }

    /**
     * Restore cursor position sequence.
     *
     * @return string Returns restore cursor position sequence.
     *
     * @access public
     */
    public function restorePosition(): string
    {
        return terminal()->getCsi() . 'u';
    }

    /**
     * Save cursor position and attributes sequence.
     *
     * @return string Returns save cursor position and attributes sequence.
     *
     * @access public
     */
    public function save(): string
    {
        return terminal()->getCsi() . '7';
    }

    /**
     * Restore cursor position and attributes sequence.
     *
     * @return string Returns restore cursor position and attributes sequence.
     *
     * @access public
     */
    public function restore(): string
    {
        return terminal()->getCsi() . '8';
    }

    /**
     * Returns the current cursor position as x,y coordinates.
     *
     * @return array Returns the current cursor position as x,y coordinates.
     *
     * @access public
     */
    public function getCurrentPosition(): array
    {
        static $isTtySupported;

        $input = (defined('STDIN') ? STDIN : fopen('php://input', 'r+'));

        if ($isTtySupported === null && function_exists('proc_open')) {
            $isTtySupported = (bool) @proc_open('echo 1 >/dev/null', [['file', '/dev/tty', 'r'], ['file', '/dev/tty', 'w'], ['file', '/dev/tty', 'w']], $pipes);
        }

        if (! $isTtySupported) {
            return [1, 1];
        }

        $sttyMode = shell_exec('stty -g');
        shell_exec('stty -icanon -echo');

        @fwrite($input, terminal()->getCsi() . '6n');

        $code = trim(fread($input, 1024));

        shell_exec(sprintf('stty %s', $sttyMode));

        sscanf($code, terminal()->getCsi() . '%d;%dR', $row, $col);

        return [$col, $row];
    }
}
