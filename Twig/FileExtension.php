<?php

namespace Club\FormExtraBundle\Twig;

class FileExtension extends \Twig_Extension
{
    public function getFilters()
    {
        return array(
            new \Twig_SimpleFilter('club_filesize', array(
                $this,
                'getFilesize'
            ))
        );
    }

    public function getFilesize($bytes, $decimals = 2)
    {
        $sz = 'BKMGTP';
        $factor = floor((strlen($bytes) - 1) / 3);

        return sprintf("%.{$decimals}f", $bytes / pow(1024, $factor)) . @$sz[$factor];
    }

    public function getName()
    {
        return 'filesize';
    }
}
