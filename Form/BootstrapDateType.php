<?php

namespace Club\FormExtraBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Symfony\Component\Form\FormView;
use Symfony\Component\Form\FormInterface;

class BootstrapDateType extends AbstractType
{
    private $container;

    public function __construct($container)
    {
        $this->container = $container;
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'date_format' => 'yyyy-mm-dd'
        ));
    }

    public function finishView(FormView $view, FormInterface $form, array $options)
    {
        $view->vars['date_format'] = $options['date_format'];
    }

    public function getParent()
    {
        return 'date';
    }

    public function getName()
    {
        return 'bootstrap_date';
    }
}
