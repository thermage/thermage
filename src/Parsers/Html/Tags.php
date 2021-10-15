<?php

declare(strict_types=1);

namespace Termage\Parsers\Html;

use Termage\Theme\ThemeInterface;
use Termage\Utils\Color;
use Thunder\Shortcode\Shortcode\ShortcodeInterface;
use Thunder\Shortcode\ShortcodeFacade;
use Thunder\Shortcode\HandlerContainer\HandlerContainer;
use Thunder\Shortcode\Parser\RegexParser;
use Thunder\Shortcode\Parser\RegularParser;
use Thunder\Shortcode\Processor\Processor;
use Thunder\Shortcode\Syntax\CommonSyntax;
use Thunder\Shortcode\Syntax\Syntax;
use Thunder\Shortcode\Syntax\SyntaxBuilder;

use function intval;
use function str_replace;
use function strings;
use function strip_tags;

class Tags
{
    /**
     * The implementation of Theme interface.
     *
     * @access private
     */
    private $theme;

    /**
     * Create a new Shortcodes instance.
     *
     * @access public
     */
    public function __construct($theme)
    {
        $syntaxBuilder = (new SyntaxBuilder())
                            ->setOpeningTag('<')
                            ->setClosingTag('>')
                            ->setClosingTagMarker('/')
                            ->setParameterValueSeparator('=')
                            ->setParameterValueDelimiter('"')
                            ->getSyntax();

        $syntaxParser = new RegexParser($syntaxBuilder);

        $this->tagsHandler   = new HandlerContainer();
        $this->tagsProcessor = new Processor(new RegexParser($syntaxBuilder), $this->tagsHandler);
   
        $this->theme = $theme;
        $this->addDefaultTags();
    }

    /**
     * Get the implementation of Theme interface.
     *
     * @return ThemeInterface Returns the implementation of Theme interface.
     *
     * @return self Returns instance of the Shortcodes class.
     *
     * @access public
     */
    public function getTheme(): ThemeInterface
    {
        return $this->theme;
    }

    /**
     * Get tags processor.
     *
     * @return Processor Returns the implementation of Theme interface.
     *
     * @return self Returns instance of the Shortcodes class.
     *
     * @access public
     */
    public function getTagsProcessor()
    {
        return $this->tagsProcessor;
    }

    public function getTagsHandler()
    {
        return $this->tagsHandler;
    }

    /**
     * Add tag handler.
     *
     * @param string   $name    Tag name.
     * @param callable $handler Tag handler.
     *
     * @return self Returns instance of the Tags class.
     *
     * @access public
     */
    public function addTag(string $name, callable $handler)
    {
        $this->tagsHandler->add($name, $handler);

        return $this;
    }

    /**
     * Add tag alias handler.
     *
     * @param string $name Tag alias name.
     * @param string $name Tag name.
     *
     * @return self Returns instance of the Tags class.
     *
     * @access public
     */
    public function addTagAlias(string $name, callable $handler)
    {
        $this->tagsHandler->addAlias($name, $handler);

        return $this;
    }

    /**
     * Remove tag handler.
     *
     * @param string $name Tag name.
     *
     * @return self Returns instance of the Tags class.
     *
     * @access public
     */
    public function removeTag(string $name)
    {
        $this->tagsHandler->remove($name);

        return $this;
    }

    /**
     * Get tag handler.
     *
     * @param string $name Tag name.
     *
     * @return self Returns instance of the Tags class.
     *
     * @access public
     */
    public function getTag(string $name)
    {
        $this->tagsHandler->get($name);

        return $this;
    }

    /**
     * Has tag handler.
     *
     * @param string $name Tag name.
     *
     * @return self Returns instance of the Tags class.
     *
     * @access public
     */
    public function hasTag(string $name)
    {
        $this->tagsHandler->has($name);

        return $this;
    }

    /**
     * Parse and processes text to replaces tags.
     *
     * @param string $input A text containing Tags.
     *
     * @access public
     */
    public function parseTags(string $input): string
    {
        return $this->tagsProcessor->process($input);
    }

    /**
     * Add default shortcode.
     *
     * @access protected
     */
    protected function addDefaultTags(): void
    {
        $this->tagsHandler->add('div', fn (ShortcodeInterface $s) => $this->divTag($s));
        $this->tagsHandler->add('span', fn (ShortcodeInterface $s) => $this->spanTag($s));
        $this->tagsHandler->add('br', fn (ShortcodeInterface $s) => $this->breaklineTag($s));
        $this->tagsHandler->add('b', fn (ShortcodeInterface $s) => $this->boldTag($s));
        $this->tagsHandler->add('i', fn (ShortcodeInterface $s) => $this->italicTag($s));
        $this->tagsHandler->add('u', fn (ShortcodeInterface $s) => $this->underlineTag($s));
        $this->tagsHandler->add('s', fn (ShortcodeInterface $s) => $this->strikethroughTag($s));
        $this->tagsHandler->add('a', fn (ShortcodeInterface $s) => $this->anchorShortcode($s));
    }

    /**
     * Strip tags.
     *
     * @param string $value Value with tags.
     *
     * @return string Value without tags.
     *
     * @access public
     */
    public function stripTags(string $value): string
    {
        return strip_tags($value);
    }

    protected function divTag(ShortcodeInterface $s): string
    {
        $class = $s->getParameter('class') ? $s->getParameter('class') : '';

        return (string) termage()->div($s->getContent(), $class, []);
    }

    protected function spanTag(ShortcodeInterface $s): string
    {
        $class = $s->getParameter('class') ? $s->getParameter('class') : '';
        
        return (string) termage()->span($s->getContent(), $class, []);
    }

    protected function breaklineTag(ShortcodeInterface $s): string
    {
        return (string) termage()->br($s->getContent());
    }

    protected function boldTag(ShortcodeInterface $s): string
    {
        return (string) termage()->bold($s->getContent());
    }

    protected function italicTag(ShortcodeInterface $s): string
    {
        return (string) termage()->italic($s->getContent());
    }

    protected function underlineTag(ShortcodeInterface $s): string
    {
        return (string) termage()->underline($s->getContent());
    }

    protected function strikethroughTag(ShortcodeInterface $s): string
    {
        return (string) termage()->strikethrough($s->getContent());
    }

    protected function anchorTag(ShortcodeInterface $s): string
    {
        $class = $s->getParameter('class') ? $s->getParameter('class') : '';
        $href  = $s->getParameter('href') ? $s->getParameter('href') : '';

        return (string) termage()->anchor($s->getContent(), $class)->href($href);
    }
}
