<?php

declare(strict_types=1);

namespace Termage\Base;

use Atomastic\Arrays\Arrays;

use function arrays;

abstract class Theme
{
    private ?Arrays $variables = null;

    public function __construct()
    {
        $this->variables = arrays($this->getDefaultVariables())->replace($this->getThemeVariables(), true);
    }

    public function variables() {
        return $this->variables;
    }

    public function getDefaultVariables(): array
    {
        return [
            'colors' => [
                'black'   => 'black',
                'gray'    => 'gray',
                'white'   => 'white',
                'red'     => 'red',
                'green'   => 'green',
                'yellow'  => 'yellow',
                'blue'    => 'blue',
                'magenta' => 'magenta',
                'cyan'    => 'cyan',
        
                'bright-red'     => 'bright-red',
                'bright-green'   => 'bright-green',
                'bright-yellow'  => 'bright-yellow',
                'bright-blue'    => 'bright-blue',
                'bright-magenta' => 'bright-magenta',
                'bright-cyan'    => 'bright-cyan',
                'bright-white'   => 'bright-white',
        
                'primary'   => 'blue',
                'secondary' => 'gray',
                'success'   => 'green',
                'info'      => 'cyan',
                'warning'   => 'yellow',
                'danger'    => 'red',
            ],
            'padding' => 0,
            'margin'  => 0
        ];
    }

    public function getThemeVariables(): array
    {
        return [];
    }
}
