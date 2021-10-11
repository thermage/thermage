<a name="0.7.0"></a>
# [0.7.0](https://github.com/termage/termage) (2021-xx-xx)
* Added new **rendering shortcodes to ansi markup** based logic instead of **old symfony** based. 
* Added new shortcodes functionality with a lot of predefined shortcodes.
* Added new method `dim` for `Element`
* Added new method `strikethrough` for `Element`
* Added new method `italic` for `Element`
* Added new method `invisible` for `Element`
* Added new component `Chart`
* Fixes and improvements for all components.
* Tests improvements. 

### BREAKING CHANGES

* Removed all strings manipulations methods `lower`, `upper`, `limit`, `repeat`, `camel`, `capitalize` from `Element` due new markup based logic.

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
