<?php 

use function Termage\hr;

require_once __DIR__ . '/../../vendor/autoload.php';

$argv[1] ??= 'left';

switch ($argv[1]) {
    case 'center':
        echo (
            hr('Stay RAD!', 'text-align-center color-pink').
            hr('Stay RAD!', 'b-thin text-align-center color-pink').
            hr('Stay RAD!', 'b-heavy text-align-center color-pink').
            hr('Stay RAD!', 'b-super-heavy text-align-center color-pink').
            hr('Stay RAD!', 'b-double text-align-center color-pink').
            hr('Stay RAD!', 'b-triple text-align-center color-pink').
            hr('Stay RAD!', 'b-arrow-down text-align-center color-pink').
            hr('Stay RAD!', 'b-arrow-up text-align-center color-pink').
            hr('Stay RAD!', 'b-dashed text-align-center color-pink').
            hr('Stay RAD!', 'b-rope text-align-center color-pink').
            hr('Stay RAD!', 'b-rope-heavy text-align-center color-pink').
            hr('Stay RAD!', 'b-brick text-align-center color-pink').
            hr('Stay RAD!', 'b-block-small text-align-center color-pink').
            hr('Stay RAD!', 'b-block-small-heavy text-align-center color-pink').
            hr('Stay RAD!', 'b-block text-align-center color-pink').
            hr('Stay RAD!', 'b-noise text-align-center color-pink')
        );
        break;
    case 'right':
        echo (
            hr('Stay RAD!', 'text-align-right color-pink').
            hr('Stay RAD!', 'b-thin text-align-right color-pink').
            hr('Stay RAD!', 'b-heavy text-align-right color-pink').
            hr('Stay RAD!', 'b-super-heavy text-align-right color-pink').
            hr('Stay RAD!', 'b-double text-align-right color-pink').
            hr('Stay RAD!', 'b-triple text-align-right color-pink').
            hr('Stay RAD!', 'b-arrow-down text-align-right color-pink').
            hr('Stay RAD!', 'b-arrow-up text-align-right color-pink').
            hr('Stay RAD!', 'b-dashed text-align-right color-pink').
            hr('Stay RAD!', 'b-rope text-align-right color-pink').
            hr('Stay RAD!', 'b-rope-heavy text-align-right color-pink').
            hr('Stay RAD!', 'b-brick text-align-right color-pink').
            hr('Stay RAD!', 'b-block-small text-align-right color-pink').
            hr('Stay RAD!', 'b-block-small-heavy text-align-right color-pink').
            hr('Stay RAD!', 'b-block text-align-right color-pink').
            hr('Stay RAD!', 'b-noise text-align-right color-pink')
        );
        break;
    case 'left':
    default:
        echo (
            hr('Stay RAD!', 'color-pink').
            hr('Stay RAD!', 'b-thin color-pink').
            hr('Stay RAD!', 'b-heavy color-pink').
            hr('Stay RAD!', 'b-super-heavy color-pink').
            hr('Stay RAD!', 'b-double color-pink').
            hr('Stay RAD!', 'b-triple color-pink').
            hr('Stay RAD!', 'b-arrow-down color-pink').
            hr('Stay RAD!', 'b-arrow-up color-pink').
            hr('Stay RAD!', 'b-dashed color-pink').
            hr('Stay RAD!', 'b-rope color-pink').
            hr('Stay RAD!', 'b-rope-heavy color-pink').
            hr('Stay RAD!', 'b-brick color-pink').
            hr('Stay RAD!', 'b-block-small color-pink').
            hr('Stay RAD!', 'b-block-small-heavy color-pink').
            hr('Stay RAD!', 'b-block color-pink').
            hr('Stay RAD!', 'b-noise color-pink')
        );
        break;
}
