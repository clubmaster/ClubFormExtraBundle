<?php

namespace Club\FormExtraBundle\Twig;

class DateExtension extends \Twig_Extension
{
    private $container;
    private $em;
    private $session;
    private $locale;
    private $timezone;

    public function __construct($container)
    {
        $this->container = $container;
        $this->em = $container->get('doctrine.orm.default_entity_manager');
        $this->session = $container->get('session');
        $this->translator = $container->get('translator');
        $this->timezone = date_default_timezone_get();

        $timezone = $this->session->get('club_user_timezone');
        if ($timezone) $this->timezone = $timezone;
    }

    public function getLocale()
    {
        $dateformat = $this->session->get('club_user_dateformat');

        if ($dateformat) {
            return $dateformat;
        }

        return $this->container->get('request')->getLocale();
    }

    public function getFilters()
    {
        return array(
            new \Twig_SimpleFilter('club_date', array($this, 'getDate')),
            new \Twig_SimpleFilter('club_datetime', array($this, 'getDateTime')),
            new \Twig_SimpleFilter('club_time', array($this, 'getTime')),
            new \Twig_SimpleFilter('club_day', array($this, 'getDay')),
            new \Twig_SimpleFilter('club_ago', array($this, 'getAgo')),
            new \Twig_SimpleFilter('club_ical', array($this, 'getIcal'))
        );
    }

    public function getDate($value, $type='SHORT')
    {
        if (!$this->intlExists())

            return $value->format('Y-m-d');

        $type = strtoupper($type);
        switch ($type) {
        case 'FULL':
            $date = \IntlDateFormatter::FULL;
            break;
        case 'LONG':
            $date = \IntlDateFormatter::LONG;
            break;
        case 'SHORT':
            $date = \IntlDateFormatter::SHORT;
            break;
        default:
            $date = \IntlDateFormatter::MEDIUM;
            break;
        }
        $fmt = new \IntlDateFormatter($this->getLocale(), $date, \IntlDateFormatter::NONE, $this->timezone);

        return $fmt->format($value);
    }

    public function getDateTime($value, $type='SHORT')
    {
        if (!$this->intlExists())

            return $value->format('Y-m-d H:i');

        $type = strtoupper($type);
        switch ($type) {
        case 'FULL':
            $date = \IntlDateFormatter::FULL;
            $time = \IntlDateFormatter::FULL;
            break;
        case 'LONG':
            $date = \IntlDateFormatter::LONG;
            $time = \IntlDateFormatter::LONG;
            break;
        case 'SHORT':
            $date = \IntlDateFormatter::SHORT;
            $time = \IntlDateFormatter::SHORT;
            break;
        default:
            $date = \IntlDateFormatter::MEDIUM;
            $time = \IntlDateFormatter::MEDIUM;
            break;
        }
        $fmt = new \IntlDateFormatter($this->getLocale(), $date, $time, $this->timezone);

        return $fmt->format($value);
    }

    public function getTime($value, $type='SHORT')
    {
        if (!$this->intlExists())

            return $value->format('H:i');

        $type = strtoupper($type);
        switch ($type) {
        case 'FULL':
            $time = \IntlDateFormatter::FULL;
            break;
        case 'LONG':
            $time = \IntlDateFormatter::LONG;
            break;
        case 'SHORT':
            $time = \IntlDateFormatter::SHORT;
            break;
        default:
            $time = \IntlDateFormatter::MEDIUM;
            break;
        }
        $fmt = new \IntlDateFormatter($this->getLocale(), \IntlDateFormatter::NONE, $time, $this->timezone);

        return $fmt->format($value);
    }

    public function getDay($value)
    {
        if ($value instanceof \DateTime) {
            $date = $value;
        } elseif (preg_match("/^\d{4}\-\d{2}\-\d{2}/", $value)) {
            $date = new \DateTime($value);
        } elseif (!$value instanceof \DateTime) {
            $date = new \DateTime('next monday');
            $date->add(new \DateInterval('P'.($value-1).'D'));
        } else {
            $date = $value;
        }

        if (!$this->intlExists())

            return strtolower($date->format('l'));

        $fmt = new \IntlDateFormatter($this->getLocale(), \IntlDateFormatter::NONE, \IntlDateFormatter::NONE, $this->timezone);
        $fmt->setPattern('eeee');

        return $fmt->format($date);
    }

    public function getAgo($value)
    {
        return $this->time_ago($value);
    }

    public function getIcal($value)
    {
        return 'TZID='.$this->timezone.':'.$value->format('Ymd\THis');
    }

    protected function intlExists()
    {
        return extension_loaded('intl');
    }

    private function time_ago(\DateTime $date)
    {
        if(empty($date)) {
            return $this->translator->trans("No date provided");
        }
        $lengths = array("60","60","24","7","4.35","12","10");
        $now = time();
        $unix_date = $date->format('U');
        // check validity of date
        if(empty($unix_date)) {
            return $this->translator->trans("Bad date");
        }
        // is it future date or past date
        if($now > $unix_date) {
            $difference = $now - $unix_date;
            $tense = $this->translator->trans("ago");
        } else {
            $difference = $unix_date - $now;
            $tense = $this->translator->trans("from now");
        }
        for($j = 0; $difference >= $lengths[$j] && $j < count($lengths)-1; $j++) {
            $difference /= $lengths[$j];
        }
        $difference = (int) round($difference);

        $periods = array(
            $this->translator->transChoice("{1}second|]1,Inf]seconds", $difference),
            $this->translator->transChoice("{1}minute|]1,Inf]minutes", $difference),
            $this->translator->transChoice("{1}hour|]1,Inf]hours", $difference),
            $this->translator->transChoice("{1}day|]1,Inf]days", $difference),
            $this->translator->transChoice("{1}week|]1,Inf]weeks", $difference),
            $this->translator->transChoice("{1}month|]1,Inf]months", $difference),
            $this->translator->transChoice("{1}year|]1,Inf]years", $difference),
            $this->translator->transChoice("{1}decade|]1,Inf]decades", $difference)
        );

        return "$difference $periods[$j] {$tense}";

    }

    public function getName()
    {
        return 'date';
    }
}
