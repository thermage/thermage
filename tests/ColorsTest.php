<?php

declare(strict_types=1);

use Termage\Base\Colors;

test('test get color', function (): void {
    expect(Colors::get('red'))->toBe('red');
});

test('test set color', function (): void {
    Colors::set('pink', '#FFC0CB');
    expect(Colors::get('pink'))->toBe('#FFC0CB');
});

test('test has color', function (): void {
    expect(Colors::has('red'))->toBeTrue();
    expect(Colors::has('foo'))->toBeFalse();
});

test('test delete color', function (): void {
    Colors::set('purple', '#800080');
    Colors::delete('purple');
    expect(Colors::get('purple'))->toBe('purple');
});

test('test set colors pallete', function (): void {
    Colors::setPallete(['purple' => '#800080']);
    expect(Colors::get('purple'))->toBe('#800080');
});

test('test get colors pallete', function (): void {
    $pallete = Colors::getPallete();
    expect($pallete)->toBeArray();
});