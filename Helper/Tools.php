<?php

namespace Club\FormExtraBundle\Helper;

class Tools
{
    public function slugify($string)
    {
        // Remove accents from characters
        $string = iconv('UTF-8', 'ASCII//TRANSLIT', $string);

        // Everything lowercase
        $string = strtolower($string);

        // Replace all non-word characters by dashes
        $string = preg_replace("/\W/", "-", $string);

        // Replace double dashes by single dashes
        $string = preg_replace("/-+/", '-', $string);

        // Trim dashes from the beginning and end of string
        $string = trim($string, '-');

        return $string;
    }
}
