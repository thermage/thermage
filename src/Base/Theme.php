<?php

declare(strict_types=1);

namespace Termage\Base;

use Atomastic\Arrays\Arrays;

use function arrays;

abstract class Theme
{
    /**
     * Theme variables.
     */
    private Arrays $variables;

    /**
     * Create a new Theme instance.
     *
     * @access public
     */
    final public function __construct()
    {
        $this->variables = arrays($this->getDefaultVariables())->replace($this->getThemeVariables(), true);
    }

    /**
     * Get Theme default variables.
     *
     * @return array Theme default variables.
     *
     * @access public
     */
    final public function getDefaultVariables(): array
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

                'primary'   => 'bright-blue',
                'secondary' => 'gray',
                'success'   => 'bright-green',
                'info'      => 'bright-cyan',
                'warning'   => 'bright-yellow',
                'danger'    => 'bright-red',
            ],
            'padding' => [
                'global' => 1,
                'left'   => 1,
                'right'  => 1,
            ],
            'margin' => [
                'global' => 1,
                'left'   => 1,
                'right'  => 1,
            ],
        ];
    }

    /**
     * Get Theme variables.
     *
     * @return array Theme variables.
     *
     * @access public
     */
    public function getThemeVariables(): array
    {
        return [];
    }

    /**
     * Get Theme variables.
     *
     * @return Arrays Theme variables.
     *
     * @access public
     */
    public function variables(): Arrays
    {
        return $this->variables;
    }
}