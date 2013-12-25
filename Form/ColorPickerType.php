<?php

namespace Club\FormExtraBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormView;
use Symfony\Component\Form\FormInterface;

class ColorPickerType extends AbstractType
{
    protected $container;

    public function __construct($container)
    {
        $this->container = $container;
    }

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
    }

    public function finishView(FormView $view, FormInterface $form, array $options)
    {
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
    }

    public function getParent()
    {
        return 'text';
    }

    public function getName()
    {
        return 'colorpicker';
    }
}
