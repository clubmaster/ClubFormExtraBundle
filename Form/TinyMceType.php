<?php

namespace Club\FormExtraBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormView;
use Symfony\Component\Form\FormInterface;

class TinyMceType extends AbstractType
{
    protected $container;

    public function __construct($container)
    {
        $this->container = $container;
    }

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->setAttribute('type', $options['type']);
    }

    public function finishView(FormView $view, FormInterface $form, array $options)
    {
        if ($form->getConfig()->getAttribute('type')) {
            $type = $form->getConfig()->getAttribute('type');
            $view->vars['type'] = $type;
        }

        $view->vars['tinymce_height'] = $this->container->getParameter('club_form_extra.tinymce_height');
        $view->vars['tinymce_width'] = $this->container->getParameter('club_form_extra.tinymce_width');

        if ($this->container->getParameter('club_form_extra.tinymce_language_url')) {
            $view->vars['tinymce_language_url'] = $this->container->getParameter('club_form_extra.tinymce_language_url');
        }
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'type' => null,
        ));
    }

    public function getParent()
    {
        return 'textarea';
    }

    public function getName()
    {
        return 'tinymce';
    }
}
