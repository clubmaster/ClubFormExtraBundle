<?php

namespace Club\FormExtraBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Symfony\Component\Form\FormView;
use Symfony\Component\Form\FormInterface;

class JQueryBirthdayType extends AbstractType
{
    private $container;

    public function __construct($container)
    {
        $this->container = $container;
    }

    public function finishView(FormView $view, FormInterface $form, array $options)
    {
        $view->vars['firstDay'] = $this->container->getParameter('club_form_extra.datepicker_firstday');
    }

    public function getParent()
    {
        return 'birthday';
    }

    public function getName()
    {
        return 'jquery_birthday';
    }
}
