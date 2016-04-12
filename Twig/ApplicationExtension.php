<?php

namespace Club\FormExtraBundle\Twig;

class ApplicationExtension extends \Twig_Extension implements \Twig_Extension_GlobalsInterface
{
    private $container;
    private $opengraph;

    public function __construct($container)
    {
        $this->container = $container;
        $this->opengraph = $container->get('club_extra.opengraph');
    }

    public function getFunctions()
    {
        return array(
            new \Twig_SimpleFunction('club_opengraph', array($this, 'renderOpenGraph'), array(
                'needs_environment' => true,
                'is_safe' => array('html')
            ))
        );
    }

    public function getGlobals()
    {
        return array(
            'club_title' => $this->getTitle(),
            'club_description' => $this->getDescription()
        );
    }

    private function getTitle()
    {
        switch (true) {
        case (strlen($this->container->get('club_extra.storage')->getTitle()) > 0):
            $title = $this->container->get('club_extra.storage')->getTitle();
            break;

        default:
            $title = $this->container->getParameter('club_form_extra.title');
            break;
        }

        return $title;
    }

    private function getDescription()
    {
        switch (true) {
        case (strlen($this->container->get('club_extra.storage')->getDescription()) > 0):
            $description = $this->container->get('club_extra.storage')->getDescription();
            break;

        default:
            $description = $this->container->getParameter('club_form_extra.description');
            break;
        }

        return $description;
    }

    public function renderOpenGraph(\Twig_Environment $environment)
    {
        if ($this->opengraph->inUse() === false) {
            return;
        }

        return $environment->render('ClubFormExtraBundle:Helper:opengraph.html.twig', array(
            'opengraph' => $this->opengraph
        ));
    }

    public function getName()
    {
        return 'club_application';
    }
}
