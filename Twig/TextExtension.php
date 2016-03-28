<?php

namespace Club\FormExtraBundle\Twig;

class TextExtension extends \Twig_Extension
{
    private $container;

    public function __construct($container)
    {
        $this->container = $container;
    }

    public function getFilters()
    {
        return array(
            'club_wordwrap' => new \Twig_Filter_Method($this, 'wordwrap'),
            'club_linkify' => new \Twig_Filter_Method($this, 'linkify'),
            'club_slugify' => new \Twig_Filter_Method($this, 'slugify')
        );
    }

    public function wordwrap($text, $width=20)
    {
        return wordwrap($text, $width, "<br>", true);
    }

    public function linkify($text)
    {
         return preg_replace(
             '%(https?|ftp)://([-A-Z0-9./_*?&;=#]+)%i',
             '<a target="blank" rel="nofollow" href="$0" target="_blank">$0</a>', $text);
    }

    public function slugify($text)
    {
        return $this->container->get('club_extra.tools')->slugify($text);
    }

    public function getName()
    {
        return 'text';
    }
}
