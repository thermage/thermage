
<img src="assets/banner.png" alt="Clirad" align="center" title="Totally RAD Terminal styling!">

<br>

<p align="center">
<a href="https://github.com/clirad/clirad/releases"><img alt="Version" src="https://img.shields.io/github/release/clirad/clirad.svg?label=version&color=f623a6"></a> <a href="https://github.com/clirad/clirad"><img src="https://img.shields.io/badge/license-MIT-blue.svg?color=f623a6" alt="License"></a> <a href="https://github.com/clirad/clirad"><img src="https://img.shields.io/github/downloads/clirad/clirad/total.svg?color=f623a6" alt="Total downloads"></a> <img src="https://github.com/atomastic/strings/workflows/Static%20Analysis/badge.svg?branch=dev"> <img src="https://github.com/atomastic/strings/workflows/Tests/badge.svg">
</p>

<br>

Clirad provides a fluent and powerful, object-oriented interface for customizing CLI output text color, background, formatting, and more.

### Installation

#### With [Composer](https://getcomposer.org)

```
composer require clirad/clirad
```

### Documentation

#### Basic Usage

```php 
// Display: Stay Rad!
el('Stay Rad!')
  ->px20()
  ->mx10()
  ->colorBrightGreen()
  ->bgBrightMagenta()
  ->underline()
  ->upper()
  ->display();
```

```php 
// Display: TAKE A CHILL PILL!
el()
  ->value("TAKE A CHILL PILL!") 
  ->properties(['padding' => [
                    'left' => 10, 
                    'right' => 10
                    ], 
                    'margin' => [
                        'left' => 5, 
                        'right' => 5
                    ],
                    'color' => 'bright-greeen', 
                    'bg' => 'bright-magenta'
                ])
  ->underline()
  ->upper()
  ->display();
```

#### Base Element

#### Methods 

<table>
    <thead>
        <tr>
            <th>Method</th>
            <th>Description</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td><a href="#methods-getValue">getValue</a></td>
            <td>Get base element value.</td>
        </tr>
        <tr>
            <td><a href="#methods-getRenderer">getRenderer</a></td>
            <td>Get base element renderer.</td>
        </tr>
    </tbody>
</table>

### Tests

Run tests

```
./vendor/bin/pest
```

### License
[The MIT License (MIT)](https://github.com/clirad/clirad/blob/master/LICENSE)
Copyright (c) 2021 [Sergey Romanenko](https://awilum.github.io)
