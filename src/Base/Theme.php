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
            // Base.
            'colors' => [
                'white'   => '#ffffff',
                'gray100' => '#f8f9fa',
                'gray200' => '#e9ecef',
                'gray300' => '#dee2e6',
                'gray400' => '#ced4da',
                'gray500' => '#adb5bd',
                'gray600' => '#6c757d',
                'gray700' => '#495057',
                'gray800' => '#343a40',
                'gray900' => '#212529',
                'black'   => '#000000',

                'blue'    => '#007bff',
                'blue100' => '#a8cbfe',
                'blue200' => '#81b4fe',
                'blue300' => '#5a9cfe',
                'blue400' => '#3485fd',
                'blue500' => '#0d6efd',
                'blue600' => '#0b5cd5',
                'blue700' => '#094bac',
                'blue800' => '#073984',
                'blue900' => '#05285b',

                'indigo'    => '#6610f2',
                'indigo100' => '#c8a9fa',
                'indigo200' => '#af83f8',
                'indigo300' => '#975cf6',
                'indigo400' => '#7e36f4',
                'indigo500' => '#6610f2',
                'indigo600' => '#560dcb',
                'indigo700' => '#450ba5',
                'indigo800' => '#35087e',
                'indigo900' => '#250657',

                'purple'    => '#6f42c1',
                'purple100' => '#cbbbe9',
                'purple200' => '#b49ddf',
                'purple300' => '#9d7ed5',
                'purple400' => '#8660cb',
                'purple500' => '#6f42c1',
                'purple600' => '#5d37a2',
                'purple700' => '#4b2d83',
                'purple800' => '#3a2264',
                'purple900' => '#281845',

                'pink'    => '#e83e8c',
                'pink100' => '#f0b6d3',
                'pink200' => '#ea95bf',
                'pink300' => '#e374ab',
                'pink400' => '#dd5498',
                'pink500' => '#d63384',
                'pink600' => '#5d37a2',
                'pink700' => '#4b2d83',
                'pink800' => '#3a2264',
                'pink900' => '#281845',

                'red'    => '#dc3545',
                'red100' => '#f2b6bc',
                'red200' => '#ed969e',
                'red300' => '#e77681',
                'red400' => '#e25563',
                'red500' => '#dc3545',
                'red600' => '#b92d3a',
                'red700' => '#96242f',
                'red800' => '#721c24',
                'red900' => '#4f1319',

                'orange'    => '#fd7e14',
                'orange100' => '#fed1aa',
                'orange200' => '#febc85',
                'orange300' => '#fea75f',
                'orange400' => '#fd933a',
                'orange500' => '#fd7e14',
                'orange600' => '#d56a11',
                'orange700' => '#ac560e',
                'orange800' => '#84420a',
                'orange900' => '#5b2d07',

                'yellow'    => '#ffc107',
                'yellow100' => '#ffe9a6',
                'yellow200' => '#ffdf7e',
                'yellow300' => '#ffd556',
                'yellow400' => '#ffcb2f',
                'yellow500' => '#ffc107',
                'yellow600' => '#d6a206',
                'yellow700' => '#ad8305',
                'yellow800' => '#856404',
                'yellow900' => '#5c4503',

                'green'    => '#28a745',
                'green100' => '#b2dfbc',
                'green200' => '#8fd19e',
                'green300' => '#6dc381',
                'green400' => '#4ab563',
                'green500' => '#28a745',
                'green600' => '#228c3a',
                'green700' => '#1b722f',
                'green800' => '#155724',
                'green900' => '#0e3c19',

                'teal'    => '#20c997',
                'teal100' => '#afecda',
                'teal200' => '#8be3c9',
                'teal300' => '#67dab8',
                'teal400' => '#44d2a8',
                'teal500' => '#20c997',
                'teal600' => '#1ba97f',
                'teal700' => '#168967',
                'teal800' => '#11694f',
                'teal900' => '#0c4836',

                'cyan'    => '#17a2b8',
                'cyan100' => '#abdee5',
                'cyan200' => '#86cfda',
                'cyan300' => '#61c0cf',
                'cyan400' => '#3cb1c3',
                'cyan500' => '#17a2b8',
                'cyan600' => '#13889b',
                'cyan700' => '#106e7d',
                'cyan800' => '#0c5460',
                'cyan900' => '#083a42',

                'primary'   => '#007bff', // blue
                'secondary' => '#6c757d', // gray600
                'success'   => '#28a745', // green
                'info'      => '#17a2b8', // cyan
                'warning'   => '#ffc107', // yellow
                'danger'    => '#dc3545', // red
                'light'     => '#f8f9fa', // gray100
                'dark'      => '#212529', // gray900
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

            // Alert Component.
            'alert' => [
                'text-align' => 'left',
                'size-auto' => false,
                'size' => 50,
                'alert-type' => [
                    'info' => [
                        'bg' => 'info',
                        'color' => 'black',
                    ],
                    'warning' => [
                        'bg' => 'warning',
                        'color' => 'black',
                    ],
                    'danger' => [
                        'bg' => 'danger',
                        'color' => 'white',
                    ],
                    'success' => [
                        'bg' => 'success',
                        'color' => 'black',
                    ],
                    'primary' => [
                        'bg' => 'primary',
                        'color' => 'white',
                    ],
                    'secondary' => [
                        'bg' => 'secondary',
                        'color' => 'white',
                    ],
                ],
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
