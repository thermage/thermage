<?php

declare(strict_types = 1);

use Clirad\Clirad;
use Clirad\Components\Element;
use Symfony\Component\Console\Output\ConsoleOutput as Renderer;
use Symfony\Component\Console\Output\OutputInterface as RendererInterface;

test('test el() helper', function() {
    $this->assertInstanceOf(Element::class, el());
});

test('test el() helper', function() {
    $this->assertInstanceOf(Element::class, el());
});