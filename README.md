
<img src="assets/termage.png" alt="Termage" align="center" title="Totally RAD Terminal styling!">

<br>

<p align="center">
<a href="https://github.com/termage/termage/releases"><img alt="Version" src="https://img.shields.io/github/release/termage/termage.svg?label=version&color=f623a6"></a> <a href="https://github.com/termage/termage"><img src="https://img.shields.io/badge/license-MIT-blue.svg?color=f623a6" alt="License"></a> <a href="https://github.com/termage/termage"><img src="http://poser.pugx.org/termage/termage/downloads" alt="Total downloads"></a> <img src="https://github.com/termage/termage/workflows/Static%20Analysis/badge.svg?branch=dev"> <img src="https://github.com/termage/termage/actions/workflows/static.yml/badge.svg?branch=dev">
    <img src="http://poser.pugx.org/termage/termage/require/php">
</p>

<br>

Termage provides a fluent and powerful, object-oriented interface for customizing CLI output text color, background, formatting, and more.

### Installation

#### With [Composer](https://getcomposer.org)

```
composer require termage/termage
```

### Documentation

#### Basic Usage

Simple example of usage with default renderer:

```php 
termage()
  ->value('Stay Rad!')
  ->px20()
  ->mx10()
  ->colorBrightGreen()
  ->bgBrightMagenta()
  ->underline()
  ->upper()
  ->display();
```

Using custom renderer:

```php 
termage()
  ->rendrer($output)
  ->value('Stay Rad!')
  ->px20()
  ->mx10()
  ->colorBrightGreen()
  ->bgBrightMagenta()
  ->underline()
  ->upper()
  ->display();
```

[Symfony Console](https://github.com/symfony/console) integration example:

```php 
protected function execute(InputInterface $input, OutputInterface $output): int
{
    
    termage()
      ->renderer($output)
      ->value('Stay Rad!')
      ->px20()
      ->mx10()
      ->colorBrightGreen()
      ->bgBrightMagenta()
      ->underline()
      ->upper()
      ->display();
      
    // ...
}
```

#### \Termage\Termage

Common Termage class. 

##### Methods 

<table>
    <thead>
        <tr>
            <th>Method</th>
            <th>Description</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td><a href="#methods-renderer">renderer</a></td>
            <td>Set renderer.</td>
        </tr>
        <tr>
            <td><a href="#methods-getRenderer">getRenderer</a></td>
            <td>Get renderer.</td>
        </tr>
        <tr>
            <td><a href="#methods-block">block</a></td>
            <td>Create block component.</td>
        </tr>
    </tbody>
</table>

#### \Termage\Base\BaseElement

Root element for all Termage Components.

##### Methods 

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
        <tr>
            <td><a href="#methods-getProperties">getProperties</a></td>
            <td>Get base element properties.</td>
        </tr>
        <tr>
            <td><a href="#methods-value">value</a></td>
            <td>Set base element value.</td>
        </tr>
        <tr>
            <td><a href="#methods-renderer">renderer</a></td>
            <td>Set base element renderer.</td>
        </tr>
        <tr>
            <td><a href="#methods-properties">properties</a></td>
            <td>Set base element properties.</td>
        </tr>
        <tr>
            <td><a href="#methods-color">color</a></td>
            <td>Set base element color.</td>
        </tr>
        <tr>
            <td><a href="#methods-bg">bg</a></td>
            <td>Set base element background.</td>
        </tr>
        <tr>
            <td><a href="#methods-bold">bold</a></td>
            <td>Set base element bold property.</td>
        </tr>
        <tr>
            <td><a href="#methods-underline">underline</a></td>
            <td>Set base element underline property, alias to underscore.</td>
        </tr>
        <tr>
            <td><a href="#methods-underscore">underscore</a></td>
            <td>Set base element underscore property.</td>
        </tr>
        <tr>
            <td><a href="#methods-blink">blink</a></td>
            <td>Set base element blink property.</td>
        </tr>
        <tr>
            <td><a href="#methods-reverse">reverse</a></td>
            <td>Set base element reverse property.</td>
        </tr>
        <tr>
            <td><a href="#methods-conceal">conceal</a></td>
            <td>Set base element conceal property.</td>
        </tr>
        <tr>
            <td><a href="#methods-mx">mx</a></td>
            <td>Set base element margin x property.</td>
        </tr>
        <tr>
            <td><a href="#methods-ml">ml</a></td>
            <td>Set base element margin left property.</td>
        </tr>
        <tr>
            <td><a href="#methods-mr">mr</a></td>
            <td>Set base element margin right property.</td>
        </tr>
        <tr>
            <td><a href="#methods-mx">mx</a></td>
            <td>Set base element padding x property.</td>
        </tr>
        <tr>
            <td><a href="#methods-ml">ml</a></td>
            <td>Set base element padding left property.</td>
        </tr>
        <tr>
            <td><a href="#methods-mr">mr</a></td>
            <td>Set base element padding right property.</td>
        </tr>
        <tr>
            <td><a href="#methods-lower">lower</a></td>
            <td>Convert base element value to lower-case.</td>
        </tr>
        <tr>
            <td><a href="#methods-upper">upper</a></td>
            <td>Convert base element value to upper-case.</td>
        </tr>
        <tr>
            <td><a href="#methods-camel">camel</a></td>
            <td>Convert base element value to camel case.</td>
        </tr>
        <tr>
            <td><a href="#methods-capitalize">capitalize</a></td>
            <td>Convert base element value first character of every word of string to upper case and the others to lower case.</td>
        </tr>
        <tr>
            <td><a href="#methods-limit">limit</a></td>
            <td>Limit the number of characters in the base element value.</td>
        </tr>
        <tr>
            <td><a href="#methods-repeat">repeat</a></td>
            <td>Repeated base element value given a multiplier.</td>
        </tr>
        <tr>
            <td><a href="#methods-render">render</a></td>
            <td>Render base element.</td>
        </tr>
        <tr>
            <td><a href="#methods-display">display</a></td>
            <td>Display base element.</td>
        </tr>
    </tbody>
</table>

#### \Termage\Components

##### \Termage\Components\Element

Same methods as for [Base Element](#base-element).

#### Helpers 

##### Methods 

<table>
    <thead>
        <tr>
            <th>Helper</th>
            <th>Description</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td><a href="#methods-el">el</a></td>
            <td>Create element component.</td>
        </tr>
    </tbody>
</table>

#### Magic Methods

There is a few built-in magic methods 🧙

`color` + **ColorName**  
Examples: `colorRed()`, `colorBrightWhite()`, ...

`bg` + **ColorName**  
Examples: `bgRed()`, `bgBrightWhite()`, ...

`display` + **Value**  
Examples: `displayNone()`, `displayRow()`, `displayCol()`

`mx` + **Value**  
Examples: `mx10()`, `mx20()`, ...

`ml` + **Value**  
Examples: `ml10()`, `ml20()`, ...

`mr` + **Value**  
Examples: `mr10()`, `mr20()`, ...

`px` + **Value**  
Examples: `px10()`, `px20()`, ...

`pl` + **Value**  
Examples: `pl10()`, `pl20()`, ...

`pr` + **Value**  
Examples: `pr10()`, `pr20()`, ...

### Tests

Run tests

```
./vendor/bin/pest
```

### License
[The MIT License (MIT)](https://github.com/termage/termage/blob/master/LICENSE)
Copyright (c) 2021 [Sergey Romanenko](https://awilum.github.io)
