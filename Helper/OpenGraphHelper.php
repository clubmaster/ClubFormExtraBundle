<?php

namespace Club\FormExtraBundle\Helper;

class OpenGraphHelper
{
    private $title;
    private $type;
    private $url;
    private $image;
    private $use = false;

    public function getTitle()
    {
        return $this->title;
    }

    public function setTitle($title)
    {
        $this->use = true;
        $this->title = $title;
    }

    public function getType()
    {
        return $this->type;
    }

    public function setType($type)
    {
        $this->use = true;
        $this->type = $type;
    }

    public function getUrl()
    {
        return $this->url;
    }

    public function setUrl($url)
    {
        $this->use = true;
        $this->url = $url;
    }

    public function getImage()
    {
        return $this->image;
    }

    public function setImage($image)
    {
        $this->use = true;
        $this->image = $image;
    }

    public function inUse()
    {
        return $this->use;
    }
}
