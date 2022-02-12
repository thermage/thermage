<a name="0.16.0"></a>
# [0.16.0](https://github.com/thermage/thermage) (2022-02-12)
* Added new element `Spark`.
* Added new helper `render`.
* Added new helper `renderToFile`.
* Added new helper `terminal`.
* Added new shortcode `raw`.
* Added new public static method `render` for Thermage.
* Added new public static method `renderToFile` Thermage.
* Added new system space symbol `§` and new public static methods `space`, `getSpace`, `replaceSystemChars` for Element.
* Added`makeClasses` to create array of classes from string of classes.
* Added `media` to set classes for specific media.
* Added ability to set specific classes for specific media queries.
* Fixed chart element issue with cyrillic char in variable chartData.

BREAKING CHANGES

* Use new `renderToString` element method instead of `render`.
* Use new `render` or `renderToFile` helper to render element(s).
* All public methods for Base Classes are not static anymore, use helpers to access them, or create instance of the Classes.
* Method `getClasses` returns Collection of classes instead of string.


<a name="0.15.2"></a>
# [0.15.2](https://github.com/thermage/thermage) (2021-12-24)
* Fixed dependencies.
* Add tests for PHP 8.1

<a name="0.15.1"></a>
# [0.15.1](https://github.com/thermage/thermage) (2021-12-17)
* Moved thermage playground to `bin` directory.
* Tests improvements. 

<a name="0.15.0"></a>
# [0.15.0](https://github.com/thermage/thermage) (2021-12-14)
* Added CFonts support.
* Added new element public method `font`.
* Added new element public method `fontFrom`.
* Added new element public method `fontLetterSpacing`.
* Added new element public method `colors`.
* Added new element public method `applyFont`.
* Added new public method `pixels` for `Canvas` element.
* Added new magic classes `font`, `colors`.
* Fixed issues with paddings calculations.
* Fixed issues with value length calculations including shortcodes.

<a name="0.14.2"></a>
# [0.14.2](https://github.com/thermage/thermage) (2021-12-08)
* Fixed `Element` display inline-block style.
* Fixed `Element` display inline style.

<a name="0.14.1"></a>
# [0.14.1](https://github.com/thermage/thermage) (2021-12-07)
* Fixed `Canvas` element notice: undefined variable `$result`.
* Fixed `Element` vertical text align position.

<a name="0.14.0"></a>
# [0.14.0](https://github.com/thermage/thermage) (2021-12-02)
* Added new element `Canvas`.
* Added display `inline-block` for elements.
* Added new magic class `text-overflow`.
* Aded new chart border variants.
* Added ability to send elements styles array argument.
* Added ability to set element text vertical alignment.
* Improved calucations for non auto width elements.
* Fixed height style logic.

### BREAKING CHANGES

- public method `b` renamed to `border` and magic class `b` renamed to `b`
- public method `bColor` renamed to `borderColor` and magic class `b-color` renamed to `border-color`

<a name="0.13.0"></a>
# [0.13.0](https://github.com/thermage/thermage) (2021-11-26)
* Added new public method `textOverflow` for element.
* Added ability to set variants of predefined and custom borders for `hr` element.
* Improved box model with new text overflow and word wrap functionality for muli-line values.
* Improved calculations for text alignment center.

<a name="0.12.0"></a>
# [0.12.0](https://github.com/thermage/thermage) (2021-11-21)
* Added `getEsc` for method `stripStyles`.
* Fixed terminal width detection for `hr` element.
* Fixed calculations for element width.
* Improved element styles definition.
* Redefined value length if clearfix is true.
* Redefined value and value length if value length is higher then width style.
* Updated styles for `heading` element.
* Removed unused helper functions.

<a name="0.11.0"></a>
# [0.11.0](https://github.com/thermage/thermage) (2021-11-17)
* Added ability to set element custom borders.
* Added new base class `Styles`.
* Added new base class `Screen`.
* Added new base class `Cursor`.
* Added new public static thermage method: `getCsi` to get Control Sequence Introducer.
* Added new public static thermage method: `setCsi` to set Control Sequence Introducer.
* Added new public static thermage method: `getEsc` to get Control Sequence Escape.
* Added new public static thermage method: `setEsc` to set Control Sequence Escape.
* Added new public static thermage method: `getOsc` to get Operating System Command.
* Added new public static thermage method: `setOsc` to set Operating System Command.
* Added new public element method `b` to set border style.
* Added new public element method `bColor` to set border color.
* Added new magic classes: `b`, `b-color`.

### BREAKING CHANGES

* Terminal public method `getWidth` changed to public static.
* Terminal public method `setWidth` changed to public static.
* Terminal public method `getHeight` changed to public static.
* Terminal public method `setHeight` changed to public static.
* Color public method `textColor` changed to public static and renamed to `applyForegroundColor`.
* Color public method `bgColor` changed to public static and renamed to `applyBackgroundColor`.
* Classes `Color` and `Terminal` moved from `Utils` to `Base`.

<a name="0.10.0"></a>
# [0.10.0](https://github.com/thermage/thermage) (2021-11-09)
* Improved box model for elements with ability to manage element width, height, text alignment.
* Added ability to set text alignment `center` for base element.
* Added ability to set text alignment `center` for hr element.
* Added ability to set text alignment `center` for alert element.
* Added new public terminal method `width` to set terminal inner width.
* Added new public terminal method `height` to set terminal inner height.
* Added new public element method `my` to set vertical margins.
* Added new public element method `py` to set vertical paddings.
* Added new public element method `pt` to set top padding.
* Added new public element method `pb` to set bottom padding.
* Added new public element method `mt` to set top margin.
* Added new public element method `mb` to set bottom margin.
* Added new public element method `h` to set element height.
* Added ability to set `top`, `right`, `bottom`, `left` margins with updated element method `m`. 
* Added ability to set `top`, `right`, `bottom`, `left` paddings with updated element method `p`. 
* Added new magic classes: `strikethrough`, `my`, `py`, `mt`, `mb`, `pt`, `pb`, `h`, `m`, `p`.

<a name="0.9.0"></a>
# [0.9.0](https://github.com/thermage/thermage) (2021-11-05)
* Improved box model for elements with ability to set element display state and width. 
* Added new public element method `p` to set left and right paddings.
* Added new public element method `m` to set left and right margins.
* Added new public element method `d` to set display state.
* Added new public element method `w` to set width.
* Added new public element method `textAlign` to set text alignment.
* Added new public element method `clearfix` to force element self-clear its children block elements linebreaks.
* Added new magic classes `w`, `d`, `clearfix`, `text-align`.
* Fixes for Theme default color scheme.
* Tests improvements. 

### BREAKING CHANGES

* Removed shortcodes `[p]`, `[px]`, `[pr]`, `[pl]`, `[m]`, `[mx]`, `[mr]`, `[ml]`

<a name="0.8.0"></a>
# [0.8.0](https://github.com/thermage/thermage) (2021-10-27)
* Added `Heading` element.
* Added new element methods `styles` and `getStyles`.
* Added new element methods `classes` and `getClasses`.
* Added new theme method `getVariables` and changed logic for method `variables`.
* Added `classes` method to set element classes.
* Fixed `getSaturation` method for non TRUECOLOR terminals.
* Fixed margin and padding calculations using global `spacer`.
* Fixes and improvements for Theming.
* Fixes and improvements for all Elements.
* Tests improvements. 

### BREAKING CHANGES

* Removed non semantic elements: blink, invisible, reverse. Use styles instead.
* Removed theme variables for margins and paddings, use spacer variable instead.

<a name="0.7.0"></a>
# [0.7.0](https://github.com/thermage/thermage) (2021-10-21)
* Added new **rendering framework agnostic** logic instead of **old symfony** based. 
* Added new powerful Shortcodes API with a lot of predefined shortcodes.
* Added RGB Colors support.
* Added magic classes pipeline for `Element`.
* Added new method `dim` for `Element`.
* Added new method `strikethrough` for `Element`.
* Added new method `italic` for `Element`.
* Added new method `invisible` for `Element`.
* Added new element `Chart`.
* Added new element `Bold`.
* Added new element `Italic`.
* Added new element `Reverse`.
* Added new element `Paragraph`.
* Added new element `Anchor`.
* Added new element `Strikethrough`.
* Added new element `Underline`.
* Added new element `Div`.
* Added new element `Span`.
* Added new element `Hr`.
* Added new element `Breakline`.
* Added new element `Blink`.
* Added a lot of new new helpers.
* Fixes and improvements for Theming.
* Fixes and improvements for all Elements.
* Tests improvements. 

### BREAKING CHANGES

* Removed all strings manipulations methods `lower`, `upper`, `limit`, `repeat`, `camel`, `capitalize` from `Element` due new markup based logic.
* New rendering and elements access logic with help of namespaced helpers.
* Use new element `Hr` instead of `Rule`
* Use new element `Span` instead of `El`
* Emojies removed.

<a name="0.6.0"></a>
# [0.6.0](https://github.com/thermage/thermage) (2021-10-08)
* Added theme support for components: Alert, Rule.
* Added new extended color scheme.

<a name="0.5.1"></a>
# [0.5.1](https://github.com/thermage/thermage) (2021-10-07)
* Fixed `thermage` helper 

<a name="0.5.0"></a>
# [0.5.0](https://github.com/thermage/thermage) (2021-10-07)
* Added new `getTerminal` method for Thermage and Element class.

### BREAKING CHANGES

* method `renderer` renamed to `output`

<a name="0.4.0"></a>
# [0.4.0](https://github.com/thermage/thermage) (2021-10-06)
* Updated colors for default theme.
* Added new method `getTheme` for `Element` Class.
* Added new `Alert` Component.
* Added new `Rule` Component.
* Added new `Link` Component.

<a name="0.3.0"></a>
# [0.3.0](https://github.com/thermage/thermage) (2021-10-04)
* Added Themes (instead of Colors)
* Renderer engine imrovements.
* Tests improvements. 

### BREAKING CHANGES

* Component `block` renamed to `el`
* Colors removed, use Themes instead.

<a name="0.2.0"></a>
# [0.2.0](https://github.com/thermage/thermage) (2021-10-03)
* Renderer engine imrovements.
* New Emoji Emoji Component.
* New Colors Class.

<a name="0.1.0"></a>
# [0.1.0](https://github.com/thermage/thermage) (2021-10-01)
* Initial release
