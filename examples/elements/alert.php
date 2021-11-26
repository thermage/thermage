<?php 

use function Termage\alert;

require_once __DIR__ . '/../../vendor/autoload.php';

echo (
    alert('Stay RAD!')->success().
    alert('Stay RAD!')->warning().
    alert('Stay RAD!')->info().
    alert('Stay RAD!')->danger().
    alert('Stay RAD!')->primary().
    alert('Stay RAD!')->secondary()
);