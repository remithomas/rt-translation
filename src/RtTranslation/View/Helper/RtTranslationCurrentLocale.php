<?php

namespace RtTranslation\View\Helper;

use Zend\View\Helper\AbstractHelper,
    Zend\Session\Container;

class RtTranslationCurrentLocale  extends AbstractHelper
{
    /**
     * 
     * @return string
     */
    public function __invoke() {
        $sessionContainer = new Container(\RtTranslation\Module::SESSION_LOCALE);
        if(!$sessionContainer->offsetExists('mylocale')){
            return 'en_US';
        }
        return $sessionContainer->mylocale == "" ? "en_US" : $sessionContainer->mylocale;
    }
}
