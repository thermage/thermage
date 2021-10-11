<?php

declare(strict_types=1);

namespace Termage\Components;

use Termage\Base\Color;
use Termage\Base\Element;

use function count;
use function intval;
use function max;
use function round;
use function strings;
use function termage;

final class Chart extends Element
{
    /**
     * Chart type.
     *
     * @access private
     */
    private string $chartType;

    /**
     * Chart data.
     *
     * @access private
     */
    private array $сhartData;

    /**
     * Chart value sufix.
     *
     * @access private
     */
    private string $valuesSufix;

    /**
     * Show percents.
     *
     * @access private
     */
    private bool $showPercents;

    /**
     * Show values.
     *
     * @access private
     */
    private bool $showValues;

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
        $this->сhartData = $data;

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
        return $this->сhartData;
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
     * Render chart component.
     *
     * @return string Returns rendered alert component.
     *
     * @access public
     */
    public function render(): string
    {
        $theme     = $this->getTheme();
        $output    = $this->getOutput();
        $value     = $this->getValue()->toString();
        $chartData = $this->сhartData ?? [];
        $chartType = $this->chartType ?? 'horizontal';

        // Get total value
        $total = 0;
        foreach ($chartData as $key => $value) {
            $total += $value['value'];
        }

        // Set percentage
        foreach ($chartData as $key => $value) {
            $chartData[$key]['percentage'] = intval(round($value['value'] / $total * 100));
        }

        // Selct chart type
        switch ($chartType) {
            case 'inline':
                $chart = $this->buildInlineChart($chartData);
                break;

            case 'horizontal':
            default:
                $chart = $this->buildHortizontalChart($chartData);
                break;
        }

        // Store chart
        $this->value($chart);

        // Render
        return parent::render();
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
    private function buildHortizontalChart(array $data): string
    {
        $theme  = $this->getTheme();
        $output = $this->getOutput();

        $line  = '';
        $i     = 0;
        $count = count($data);

        // Get label size
        foreach ($data as $key => $value) {
            $labelSizes[] = strings($this->getShortcodes()->stripShortcodes($value['label']))->length();
        }

        $labelSize = max($labelSizes);

        $showPercents = $this->showPercents ??= false;
        $showValues   = $this->showValues ??= false;
        $valuesSufix  = $this->valuesSufix ??= '';

        foreach ($data as $key => $value) {
            $i++;
            $_labelSize        = strings($this->getShortcodes()->stripShortcodes($value['label']))->length();
            $labelPaddingRight = $_labelSize < $labelSize ? $labelSize - $_labelSize + 2 : 2;

            $color = $value['color'] ?? (new Color())->getRandomHexColor();

            $line .= termage($output, $theme)->el((string) $value['label'])->pr($labelPaddingRight)->color($color)->render() .
                     termage($output, $theme)->el(strings(' ')->repeat($value['percentage'])->toString())->bg($color)->render() .
                     ($showPercents ? termage($output, $theme)->el((string) $value['percentage'] . '%')->pl1()->color($color)->render() : '') .
                     ($showValues ? termage($output, $theme)->el('(' . (string) $value['value'] . $valuesSufix . ')')->pl1()->color($color)->render() : '') .
                     ($i < $count ? "\n" : '');
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
    private function buildInlineChart(array $data): string
    {
        $theme  = $this->getTheme();
        $output = $this->getOutput();

        $showPercents = $this->showPercents ??= false;
        $showValues   = $this->showValues ??= false;
        $valuesSufix  = $this->valuesSufix ??= '';

        // Set random color if color isnt defined.
        foreach ($data as $key => $value) {
            $data[$key]['color'] = $value['color'] ?? (new Color())->getRandomHexColor();
        }

        $line = '';
        foreach ($data as $key => $value) {
            $line .= termage($output, $theme)->el(strings(' ')->repeat($value['percentage'])->toString())->bg($value['color'])->render();
        }

        $labels = '';
        $suffix = '';
        foreach ($data as $key => $value) {
            $suffix            = ($showPercents ? termage($output, $theme)->el((string) $value['percentage'] . '%')->pr1()->color($value['color'])->render() : '') .
                      ($showValues ? termage($output, $theme)->el('(' . (string) $value['value'] . $valuesSufix . ')')->pr1()->color($value['color'])->render() : '');
                      $labels .= termage($output, $theme)->el($value['label'] . (empty($suffix) ? ' ' : ' ' . $suffix))->color($value['color'])->render();
        }

        return $line . "\n\n" . $labels;
    }
}
