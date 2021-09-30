<?php

declare(strict_types=1);

use Clirad\Clirad;

if (! function_exists('clirad')) {
    function clirad($string = '')
    {
        return new Clirad($string);
    }
}
