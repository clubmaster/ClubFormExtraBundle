<?php

namespace Club\FormExtraBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Symfony\Component\Form\FormView;
use Symfony\Component\Form\FormInterface;
use Doctrine\Common\Persistence\ObjectManager;

class JQueryAutocompleteType extends AbstractType
{
    /**
     * @var ObjectManager
     */
    private $om;

    private $translator;

    /**
     * @param ObjectManager $om
     */
    public function __construct(ObjectManager $om, $translator)
    {
        $this->om = $om;
        $this->translator = $translator;
    }

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->setAttribute('noMatch', $options['noMatch']);
        $builder->setAttribute('fetchUrl', $options['fetchUrl']);
        $builder->setAttribute('scrollable', $options['scrollable']);
        $builder->setAttribute('minLength', $options['minLength']);
        $builder->setAttribute('displayValue', $options['displayValue']);
        $builder->setAttribute('handlebar', $options['handlebar']);

        if ($options['autoSubmit'] == false) {
            $builder->setAttribute('autoSubmit', 'false');
        } else {
            $builder->setAttribute('autoSubmit', $options['autoSubmit']);
        }
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'noMatch' => 'We could not find any matches for your search',
            'fetchUrl' => null,
            'scrollable' => true,
            'minLength' => 1,
            'displayValue' => 'value',
            'autoSubmit' => 'true',
            'handlebar' => '<p>{{value}}</p>'
        ));
    }

    public function finishView(FormView $view, FormInterface $form, array $options)
    {
        if ($form->getConfig()->getAttribute('fetchUrl')) {
            $view->vars['fetchUrl'] = $form->getConfig()->getAttribute('fetchUrl');
        }

        $view->vars['noMatch'] = $form->getConfig()->getAttribute('noMatch');
        $view->vars['scrollable'] = $form->getConfig()->getAttribute('scrollable');
        $view->vars['minLength'] = $form->getConfig()->getAttribute('minLength');
        $view->vars['displayValue'] = $form->getConfig()->getAttribute('displayValue');
        $view->vars['handlebar'] = $form->getConfig()->getAttribute('handlebar');
        $view->vars['autoSubmit'] = $form->getConfig()->getAttribute('autoSubmit');
    }

    public function getParent()
    {
        return 'text';
    }

    public function getName()
    {
        return 'jquery_autocomplete';
    }
}
