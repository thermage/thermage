<?php

declare(strict_types=1);

namespace Termage\Components;

use Termage\Base\Element;

final class Chart extends Element
{

    public function horizontal()
    {
        $this->chartType = 'horizontal';

        return $this;
    }

    public function inline()
    {
        $this->chartType = 'inline';

        return $this;
    }

    public function data(array $data) 
    {
        $this->data = $data;

        return $this;
    }

    public function showPercents() 
    {
        $this->showPercents = true;
        
        return $this;
    }

    public function showValues() 
    {
        $this->showValues = true;
        
        return $this;
    }

    public function getData() 
    {
        return $this->data;
    }

    public function getChartType() 
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
        $chartType = $this->getChartType();

        // Get total value
        $total = 0;
        foreach ($data as $key => $value) {
            $total += $value['value'];
        } 
      
        // Set percentage
        foreach ($data as $key => $value) {
            $data[$key]['percentage'] = intval(round(($value['value'] / $total) * 100));
        } 
        
        switch ($chartType) {
            case 'inline':
                $chart = $this->buildInlineChart($data);
                break;
            
            case 'horizontal':
            default:
                $chart = $this->buildHortizontalChart($data);
                break;
        }
    
        return $chart;
    }

    protected function buildHortizontalChart($data) 
    {
        $theme     = $this->getTheme();
        $output    = $this->getOutput();

        $line = '';
        $i = 0;
        $count = count($data);
        
        // Get label size
        foreach ($data as $key => $value) {
            $labelSizes[] = strings($value['label'])->length();
        } 
        $labelSize = max($labelSizes);

        $showPercents = $this->showPercents ??= false;
        $showValues   = $this->showValues ??= false;
        
        foreach ($data as $key => $value) {
            $i++;
            $_labelSize = strings($value['label'])->length();
            $labelPaddingRight = $_labelSize < $labelSize ? $labelSize - $_labelSize + 2 : 2;

            $line .= termage($output, $theme)->el((string) $value['label'])->pr($labelPaddingRight)->color($value['color'])->render() .
                     termage($output, $theme)->el(' ')->repeat($value['percentage'])->bg($value['color'])->render() .
                     ($showPercents ? termage($output, $theme)->el((string) $value['percentage'] . '%')->pl1()->color($value['color'])->render() : "") .
                     ($showValues ? termage($output, $theme)->el('(' . (string) $value['value'] . ')')->pl1()->color($value['color'])->render() : "").
                     (($i < $count) ? "\n": "");
        }

        return $line;
    }

    protected function buildInlineChart($data) 
    {

        $theme     = $this->getTheme();
        $output    = $this->getOutput();

        $line = '';
        foreach ($data as $key => $value) {
            $line .= termage($output, $theme)->el(' ')->repeat($value['percentage'])->bg($value['color'])->render();
        }
        
        $labels = '';
        foreach ($data as $key => $value) {
            $labels .= termage($output, $theme)->el($value['label'] . ' ' . $value['percentage'] . '% ')->color($value['color'])->render(); 
        }

        $line = $line . "\n\n" . $labels;

        return $line;
    }
}
