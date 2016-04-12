<?php

namespace Club\FormExtraBundle\Twig;

class CurrencyExtension extends \Twig_Extension
{
    private $container;
    private $em;
    private $session;
    private $locale;

    public function __construct($container)
    {
        $this->container = $container;
        $this->em = $container->get('doctrine.orm.default_entity_manager');
        $this->session = $container->get('session');
    }

    public function getFilters()
    {
        return array(
            new \Twig_SimpleFilter('club_price', array(
                $this,
                'getPrice'
            ))
        );
    }

    public function getPrice($value)
    {
        if (!$this->intlExists()) return $value;

        $currency = $this->container->get('club_user.currency')->getCurrency();

        $this->locale = $this->container->get('request')->getLocale();
        $fmt = new \NumberFormatter($this->locale, \NumberFormatter::CURRENCY);
        return $fmt->formatCurrency($value, $currency->getCode());
    }

    protected function intlExists()
    {
        return extension_loaded('intl');
    }

    public function getName()
    {
        return 'currency';
    }
}
