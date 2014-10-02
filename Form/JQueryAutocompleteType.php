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
        $builder->setAttribute('fetchUrl', $options['fetchUrl']);
        $builder->setAttribute('scrollable', $options['scrollable']);
        $builder->setAttribute('minLength', $options['minLength']);
        $builder->setAttribute('displayValue', $options['displayValue']);
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'fetchUrl' => null,
            'scrollable' => true,
            'minLength' => 1,
            'displayValue' => 'value'
        ));
    }

    public function finishView(FormView $view, FormInterface $form, array $options)
    {
        if ($form->getConfig()->getAttribute('fetchUrl')) {
            $view->vars['fetchUrl'] = $form->getConfig()->getAttribute('fetchUrl');
        }

        $view->vars['scrollable'] = $form->getConfig()->getAttribute('scrollable');
        $view->vars['minLength'] = $form->getConfig()->getAttribute('minLength');
        $view->vars['displayValue'] = $form->getConfig()->getAttribute('displayValue');
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
