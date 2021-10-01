<?php

declare(strict_types=1);

use Clirad\Clirad;
use Clirad\Components\Element;
use Symfony\Component\Console\Output\ConsoleOutput as Renderer;

test('test setRenderer and getRenderer', function (): void {
    Clirad::setRenderer(new Renderer());
    $this->assertInstanceOf(Renderer::class, Clirad::getRenderer());
});

test('test element', function (): void {
    $this->assertInstanceOf(Element::class, Clirad::element());
});
