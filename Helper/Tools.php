<?php

namespace Club\FormExtraBundle\Helper;

class Tools
{
    private $container;

    public function __construct($container)
    {
        $this->container = $container;
    }

    public function slugify($string)
    {
        $string = iconv('UTF-8', 'ASCII//TRANSLIT', $string);
        $string = strtolower($string);
        $string = preg_replace("/\W/", "-", $string);
        $string = preg_replace("/-+/", '-', $string);
        $string = trim($string, '-');

        return $string;
    }

    public function checkUserAgent($type, $userAgent=null)
    {
        if (!strlen($userAgent)) {
            $userAgent = $this
                ->container
                ->get('request_stack')
                ->getMasterRequest()
                ->server
                ->get('HTTP_USER_AGENT')
                ;
        }

        if ( $type == 'bot' ) {
            if ( preg_match ( "/googlebot|adsbot|yahooseeker|yahoobot|msnbot|watchmouse|pingdom\.com|feedfetcher-google/", $userAgent ) ) {
                return true;
            }
        } else if ( $type == 'browser' ) {
            if ( preg_match ( "/mozilla\/|opera\//", $userAgent ) ) {
                return true;
            }
        } else if ( $type == 'mobile' ) {
            if ( preg_match ( "/phone|iphone|itouch|ipod|symbian|android|htc_|htc-|palmos|blackberry|opera mini|iemobile|windows ce|nokia|fennec|hiptop|kindle|mot |mot-|webos\/|samsung|sonyericsson|^sie-|nintendo/", $userAgent ) ) {
                return true;
            } else if ( preg_match ( "/mobile|pda;|avantgo|eudoraweb|minimo|netfront|brew|teleca|lg;|lge |wap;| wap /", $userAgent ) ) {
                return true;
            }
        }

        return false;
    }
}
