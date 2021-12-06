<?php 

use function Termage\hr;

require_once __DIR__ . '/../../vendor/autoload.php';

$argv[1] ??= 'left';

switch ($argv[1]) {
    case 'center':
        echo (
            hr('Stay RAD!', 'text-align-center color-pink').
            hr('Stay RAD!', 'border-thin text-align-center color-pink').
            hr('Stay RAD!', 'border-heavy text-align-center color-pink').
            hr('Stay RAD!', 'border-super-heavy text-align-center color-pink').
            hr('Stay RAD!', 'border-double text-align-center color-pink').
            hr('Stay RAD!', 'border-triple text-align-center color-pink').
            hr('Stay RAD!', 'border-arrow-down text-align-center color-pink').
            hr('Stay RAD!', 'border-arrow-up text-align-center color-pink').
            hr('Stay RAD!', 'border-dashed text-align-center color-pink').
            hr('Stay RAD!', 'border-rope text-align-center color-pink').
            hr('Stay RAD!', 'border-rope-heavy text-align-center color-pink').
            hr('Stay RAD!', 'border-brick text-align-center color-pink').
            hr('Stay RAD!', 'border-block-small text-align-center color-pink').
            hr('Stay RAD!', 'border-block-small-heavy text-align-center color-pink').
            hr('Stay RAD!', 'border-block text-align-center color-pink').
            hr('Stay RAD!', 'border-noise text-align-center color-pink')
        );
        break;
    case 'right':
        echo (
            hr('Stay RAD!', 'text-align-right color-pink').
            hr('Stay RAD!', 'border-thin text-align-right color-pink').
            hr('Stay RAD!', 'border-heavy text-align-right color-pink').
            hr('Stay RAD!', 'border-super-heavy text-align-right color-pink').
            hr('Stay RAD!', 'border-double text-align-right color-pink').
            hr('Stay RAD!', 'border-triple text-align-right color-pink').
            hr('Stay RAD!', 'border-arrow-down text-align-right color-pink').
            hr('Stay RAD!', 'border-arrow-up text-align-right color-pink').
            hr('Stay RAD!', 'border-dashed text-align-right color-pink').
            hr('Stay RAD!', 'border-rope text-align-right color-pink').
            hr('Stay RAD!', 'border-rope-heavy text-align-right color-pink').
            hr('Stay RAD!', 'border-brick text-align-right color-pink').
            hr('Stay RAD!', 'border-block-small text-align-right color-pink').
            hr('Stay RAD!', 'border-block-small-heavy text-align-right color-pink').
            hr('Stay RAD!', 'border-block text-align-right color-pink').
            hr('Stay RAD!', 'border-noise text-align-right color-pink')
        );
        break;
    case 'left':
    default:
        echo (
            hr('Stay RAD!', 'color-pink').
            hr('Stay RAD!', 'border-thin color-pink').
            hr('Stay RAD!', 'border-heavy color-pink').
            hr('Stay RAD!', 'border-super-heavy color-pink').
            hr('Stay RAD!', 'border-double color-pink').
            hr('Stay RAD!', 'border-triple color-pink').
            hr('Stay RAD!', 'border-arrow-down color-pink').
            hr('Stay RAD!', 'border-arrow-up color-pink').
            hr('Stay RAD!', 'border-dashed color-pink').
            hr('Stay RAD!', 'border-rope color-pink').
            hr('Stay RAD!', 'border-rope-heavy color-pink').
            hr('Stay RAD!', 'border-brick color-pink').
            hr('Stay RAD!', 'border-block-small color-pink').
            hr('Stay RAD!', 'border-block-small-heavy color-pink').
            hr('Stay RAD!', 'border-block color-pink').
            hr('Stay RAD!', 'border-noise color-pink')
        );
        break;
}
