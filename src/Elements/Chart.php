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

namespace Thermage\Elements;

use Glowy\Arrays\Arrays as Collection;
use Thermage\Base\Element;

use function Glowy\Arrays\arrays as collection;
use function array_column;
use function array_sum;
use function count;
use function intval;
use function max;
use function round;
use function Glowy\Strings\strings;
use function Thermage\breakline as br;
use function Thermage\span;
use function Thermage\terminal;

final class Chart extends Element
{
    /**
     * Chart type.
     *
     * @access private
     */
    private string $chartType = 'horizontal';

    /**
     * Chart data.
     *
     * @access private
     */
    private array $chartData = [];

    /**
     * Chart value sufix.
     *
     * @access private
     */
    private string $valuesSufix = '';

    /**
     * Show percents.
     *
     * @access private
     */
    private bool $showPercents = false;

    /**
     * Show values.
     *
     * @access private
     */
    private bool $showValues = false;

    /**
     * Get Chart element variables.
     *
     * @return Collection Chart element variables.
     *
     * @access public
     */
    public function getElementVariables(): Collection
    {
        return collection([
            'chart' => [
                'type' => 'horizontal',
                'border' => 'filled',
            ]
        ]);
    }

    /**
     * Set chart type = horizontal.
     *
     * @return self Returns instance of the Chart class.
     *
     * @access public
     */
    public function horizontal(): self
    {
        $this->chartType = 'horizontal';

        return $this;
    }

    /**
     * Set chart type = inline.
     *
     * @return self Returns instance of the Chart class.
     *
     * @access public
     */
    public function inline(): self
    {
        $this->chartType = 'inline';

        return $this;
    }

    /**
     * Set chart data.
     *
     * @param array $data Data.
     *
     * @return self Returns instance of the Chart class.
     *
     * @access public
     */
    public function data(array $data): self
    {
        $this->chartData = $data;

        return $this;
    }

    /**
     * Set chart values sufix.
     *
     * @param string $value Sufix value.
     *
     * @return self Returns instance of the Chart class.
     *
     * @access public
     */
    public function valuesSufix(string $value): self
    {
        $this->valuesSufix = $value;

        return $this;
    }

    /**
     * Set chart show percents flag = true.
     *
     * @return self Returns instance of the Chart class.
     *
     * @access public
     */
    public function showPercents(): self
    {
        $this->showPercents = true;

        return $this;
    }

    /**
     * Set chart show values flag = true.
     *
     * @return self Returns instance of the Chart class.
     *
     * @access public
     */
    public function showValues(): self
    {
        $this->showValues = true;

        return $this;
    }

    /**
     * Get chart Data.
     *
     * @return array Chart data.
     */
    public function getData(): array
    {
        return $this->chartData;
    }

    /**
     * Get chart Type.
     *
     * @return string Chart type.
     *
     * @access public
     */
    public function getType(): string
    {
        return $this->chartType;
    }

    /**
     * Get element classes.
     *
     * @return Collection Collection of element classes.
     *
     * @access public
     */
    public function getElementClasses(): Collection
    {
        return collection(['show-values', 'show-percents', 'inline', 'horizontal']);
    }

    /**
     * Render chart element.
     *
     * @return string Returns rendered chart element.
     *
     * @access public
     */
    public function renderToString(): string
    {
        $value       = parent::renderToString();
        $theme       = self::getTheme();
        $chartData   = $this->chartData;
        $chartType   = $this->chartType;
        $borderStyle = $this->getStyles()['border'] ?? $theme->getVariables()->get('chart.border', $this->getElementVariables()['chart']['border']);

        // Helper function for determine is border exist.
        $hasBorder = static function () use ($borderStyle, $theme) {
            return $theme->getVariables()->has('hr.borders.' . $borderStyle);
        };
        
        $borderCharacter = ($hasBorder() ? $theme->getVariables()->get('chart.borders.' . $borderStyle . '.top') : $theme->getVariables()->get('chart.borders.thin.top'));

        // Get total value
        $total = array_sum(array_column($chartData, 'value'));

        // Set percentage for each chart value
        foreach ($chartData as $key => $value) {
            $chartData[$key]['percentage'] = intval(round($value['value'] / $total * 100));
        }

        // Select chart type
        switch ($chartType) {
            case 'inline':
                $chart = $this->buildInlineChart($chartData, $borderStyle, $borderCharacter);
                break;

            case 'horizontal':
            default:
                $chart = $this->buildHortizontalChart($chartData, $borderStyle, $borderCharacter);
                break;
        }

        return $chart . br();
    }

    /**
     * Build hortizontal chart.
     *
     * @param  array $data Data.
     *
     * @return string Horizontal chart.
     *
     * @access private
     */
    private function buildHortizontalChart(array $data, $borderStyle, $borderCharacter): string
    {
        $line  = '';
        $i     = 0;
        $count = count($data);

        // Get label size
        $labelSizes = [];
        foreach ($data as $key => $value) {
            $labelSizes[] = strings($this->stripDecorations($value['label']))->length();
        }

        $labelSize = max($labelSizes);

        $showPercents = $this->showPercents ?? false;
        $showValues   = $this->showValues ?? false;
        $valuesSufix  = $this->valuesSufix ?? '';

        foreach ($data as $key => $value) {
            $i++;
            $_labelSize        = strings($this->stripDecorations($value['label']))->length();
            $labelPaddingRight = $_labelSize < $labelSize ? $labelSize - $_labelSize + 2 : 2;

            $color = $value['color'] ?? terminal()->color()->getRandomHexColor();

            if ($borderStyle == 'filled') {
                $borderValue = span(strings(Element::getSpace())->repeat($value['percentage'])->toString())->bg($color)->renderToString();
            } else {
                $borderValue = span(strings($borderCharacter)->repeat($value['percentage'])->toString())->color($color)->renderToString();
            }
            
            $line .= span((string) $value['label'])->pr($labelPaddingRight)->color($color)->renderToString() .
                     $borderValue .
                     ($showPercents ? span((string) $value['percentage'] . '%')->pl(1)->color($color)->renderToString() : '') .
                     ($showValues ? span('(' . (string) $value['value'] . $valuesSufix . ')')->pl(1)->color($color)->renderToString() : '') .
                     ($i < $count ? br() : '');
        }

        return $line;
    }

    /**
     * Build inline chart.
     *
     * @param  array $data Data.
     *
     * @return string Inline chart.
     *
     * @access private
     */
    private function buildInlineChart(array $data, $borderStyle, $borderCharacter): string
    {
        $showPercents = $this->showPercents ?? false;
        $showValues   = $this->showValues ?? false;
        $valuesSufix  = $this->valuesSufix ?? '';

        
        // Set random color if color isnt defined.
        foreach ($data as $key => $value) {
            $data[$key]['color'] = $value['color'] ?? terminal()->color()->getRandomHexColor();
        }

        $line = '';
        foreach ($data as $key => $value) {

            if ($borderStyle == 'filled') {
                $borderValue = span(strings(Element::getSpace())->repeat($value['percentage'])->toString())->bg($value['color'])->renderToString();
            } else {
                $borderValue = span(strings($borderCharacter)->repeat($value['percentage'])->toString())->color($value['color'])->renderToString();
            }

            $line .= $borderValue;
        }

        $labels = '';
        $suffix = '';
        foreach ($data as $key => $value) {
            $suffix  = ($showPercents ? span((string) $value['percentage'] . '%')->pr(1)->color($value['color'])->renderToString() : '') .
                      ($showValues ? span('(' . (string) $value['value'] . $valuesSufix . ')')->pr(1)->color($value['color'])->renderToString() : '');
                      $labels .= span($value['label'] . (empty($suffix) ? Element::getSpace() : Element::getSpace() . $suffix))->color($value['color'])->renderToString();
        }

        return $line . br() . br() . $labels;
    }
}
