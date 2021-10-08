<?php

declare(strict_types=1);

namespace Termage\Components;

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
        $this->data = $data;

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
        return $this->data;
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
        $data      = $this->getData();
        $chartType = $this->getType();

        // Get total value
        $total = 0;
        foreach ($data as $key => $value) {
            $total += $value['value'];
        }

        // Set percentage
        foreach ($data as $key => $value) {
            $data[$key]['percentage'] = intval(round($value['value'] / $total * 100));
        }

        // Selct chart type
        switch ($chartType) {
            case 'inline':
                $chart = $this->buildInlineChart($data);
                break;

            case 'horizontal':
            default:
                $chart = $this->buildHortizontalChart($data);
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
            $labelSizes[] = strings($value['label'])->length();
        }

        $labelSize = max($labelSizes);

        $showPercents = $this->showPercents ??= false;
        $showValues   = $this->showValues ??= false;
        $valuesSufix  = $this->valuesSufix ??= '';

        foreach ($data as $key => $value) {
            $i++;
            $_labelSize        = strings($value['label'])->length();
            $labelPaddingRight = $_labelSize < $labelSize ? $labelSize - $_labelSize + 2 : 2;

            $line .= termage($output, $theme)->el((string) $value['label'])->pr($labelPaddingRight)->color($value['color'])->render() .
                     termage($output, $theme)->el(' ')->repeat($value['percentage'])->bg($value['color'])->render() .
                     ($showPercents ? termage($output, $theme)->el((string) $value['percentage'] . '%')->pl1()->color($value['color'])->render() : '') .
                     ($showValues ? termage($output, $theme)->el('(' . (string) $value['value'] . $valuesSufix . ')')->pl1()->color($value['color'])->render() : '') .
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

        $line = '';
        foreach ($data as $key => $value) {
            $line .= termage($output, $theme)->el(' ')->repeat($value['percentage'])->bg($value['color'])->render();
        }

        $labels = '';
        $suffix = '';
        foreach ($data as $key => $value) {
            $suffix = ($showPercents ? termage($output, $theme)->el((string) $value['percentage'] . '%')->pr1()->color($value['color'])->render() : '') .
                      ($showValues ? termage($output, $theme)->el('(' . (string) $value['value'] . $valuesSufix . ')')->pr1()->color($value['color'])->render() : '');
                      $labels .= termage($output, $theme)->el($value['label'] . (empty($suffix) ? ' ' : ' ' . $suffix))->color($value['color'])->render();
        }

        return $line . "\n\n" . $labels;
    }
}
