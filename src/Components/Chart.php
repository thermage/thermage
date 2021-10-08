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

    public function line()
    {
        $this->chartType = 'line';

        return $this;
    }

    public function data(array $data) 
    {
        $this->data = $data;

        return $this;
    }

    public function getData() 
    {
        return $this->data;
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
        $theme  = $this->getTheme();
        $output = $this->getOutput();
        $value  = $this->getValue()->toString();
        $data   = $this->data;


        // Get total value
        $total = 0;
        foreach ($data as $key => $value) {
            $total += $value['value'];
        } 

        // Get label size
        foreach ($data as $key => $value) {
            $labelSizes[] = strings($value['label'])->length();
        } 
        $labelSize = max($labelSizes);
      

        // Set percentage
        foreach ($data as $key => $value) {
            $data[$key]['percentage'] = intval(round(($value['value'] / $total) * 100));
        } 
        
        $line = "\n";
        $line .= $this->buildHortizontalChart($data, $labelSize);
        $line .= "\n";
        $line .= $this->buildInlineChart($data, $labelSize);
        $line .= "\n";
        
        return $line;
    }

    protected function buildHortizontalChart($data, $labelSize) {
        $line = '';
        foreach ($data as $key => $value) {
            $_labelSize = strings($value['label'])->length();
            $labelPaddingRight = $_labelSize < $labelSize ? $labelSize - $_labelSize + 2 : 2;

            $line .= termage($output, $theme)
                        ->el((string) $value['label'])
                        ->pr($labelPaddingRight)
                        ->color($value['color'])->render() .
                     termage($output, $theme)->el(' ')->repeat($value['percentage'])->bg($value['color'])->render() .
                     termage($output, $theme)->el((string) $value['percentage'] . '%')->pl1()->color($value['color'])->render() .
                     
                     "\n";
        }
        return $line;
    }

    protected function buildInlineChart($data, $labelSize) {
        $line = '';
        foreach ($data as $key => $value) {
            $_labelSize = strings($value['label'])->length();
            $labelPaddingRight = $_labelSize < $labelSize ? $labelSize - $_labelSize + 2 : 2;

            $line .= 
                     termage($output, $theme)->el(' ')->repeat($value['percentage'])->bg($value['color'])->render();
        }
        
        $labels = '';

        foreach ($data as $key => $value) {
            $labels .= termage($output, $theme)->el($value['label'] . ' ' . $value['percentage'] . '% ')->color($value['color'])->render(); 
        }

        $line = $line . "\n\n" . $labels;

        return $line;
    }
}
