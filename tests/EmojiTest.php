<?php

declare(strict_types=1);

use Termage\Termage;
use Termage\Base\Theme;
use Termage\Components\Emoji;
use Symfony\Component\Console\Output\BufferedOutput;
use Symfony\Component\Console\Output\ConsoleOutput as Renderer;

test('test termage emoji method', function (): void {
    $this->assertInstanceOf(Emoji::class, termage()->emoji());
});

test('test emoji all method', function (): void {
    expect(termage()->emoji()->all())->toBeArray();
});

test('test emoji countryFlag method', function (): void {
    expect(termage()->emoji()->countryFlag('us')->render())->toEqual('🇺🇸');
});

test('test emoji magic method', function (): void {
    expect(termage()->emoji()->mage()->render())->toEqual('🧙');
});

test('test emoji magic parent method', function (): void {
    expect(termage()->emoji()->countryFlag('us')->blink()->render())->toEqual('<options=blink;>🇺🇸</>');
});