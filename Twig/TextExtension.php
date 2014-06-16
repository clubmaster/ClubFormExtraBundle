<?php

namespace Club\FormExtraBundle\Twig;

class TextExtension extends \Twig_Extension
{
    public function getFilters()
    {
        return array(
            'club_wordwrap' => new \Twig_Filter_Method($this, 'wordwrap')
        );
    }

    public function wordwrap($text, $width=20)
    {
        return wordwrap($text, $width, "<br>", true);
    }

    public function getName()
    {
        return 'text';
    }
}
