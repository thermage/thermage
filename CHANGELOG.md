<a name="0.10.0"></a>
# [0.10.0](https://github.com/termage/termage) (2021-xx-xx)
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
# [0.9.0](https://github.com/termage/termage) (2021-11-05)
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
# [0.8.0](https://github.com/termage/termage) (2021-10-27)
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
# [0.7.0](https://github.com/termage/termage) (2021-10-21)
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
# [0.6.0](https://github.com/termage/termage) (2021-10-08)
* Added theme support for components: Alert, Rule.
* Added new extended color scheme.

<a name="0.5.1"></a>
# [0.5.1](https://github.com/termage/termage) (2021-10-07)
* Fixed `termage` helper 

<a name="0.5.0"></a>
# [0.5.0](https://github.com/termage/termage) (2021-10-07)
* Added new `getTerminal` method for Termage and Element class.

### BREAKING CHANGES

* method `renderer` renamed to `output`

<a name="0.4.0"></a>
# [0.4.0](https://github.com/termage/termage) (2021-10-06)
* Updated colors for default theme.
* Added new method `getTheme` for `Element` Class.
* Added new `Alert` Component.
* Added new `Rule` Component.
* Added new `Link` Component.

<a name="0.3.0"></a>
# [0.3.0](https://github.com/termage/termage) (2021-10-04)
* Added Themes (instead of Colors)
* Renderer engine imrovements.
* Tests improvements. 

### BREAKING CHANGES

* Component `block` renamed to `el`
* Colors removed, use Themes instead.

<a name="0.2.0"></a>
# [0.2.0](https://github.com/termage/termage) (2021-10-03)
* Renderer engine imrovements.
* New Emoji Emoji Component.
* New Colors Class.

<a name="0.1.0"></a>
# [0.1.0](https://github.com/termage/termage) (2021-10-01)
* Initial release
