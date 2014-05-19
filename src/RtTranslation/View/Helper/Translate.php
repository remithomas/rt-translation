<?php

namespace RtTranslation\View\Helper;

use Zend\View\Helper\AbstractHelper,
    Zend\Session\Container;

class Translate extends \Zend\I18n\View\Helper\AbstractTranslatorHelper
{
    
    protected $serviveLocator;

    /**
     * 
     * @param type $serviceLocator
     * @return \RtTranslation\View\Helper\Translate
     */
    public function setServiceLocator($serviceLocator){
        $this->serviveLocator = $serviceLocator;
        return $this;
    }

    /**
     * 
     * @param type $message
     * @param type $textDomain
     * @param type $locale
     * @return type
     * @throws Exception\RuntimeException
     */
    public function __invoke($message, $textDomain = null, $locale = null)
    {
        $translator = $this->getTranslator();
        if (null === $translator) {
            throw new Exception\RuntimeException('Translator has not been set');
        }
        if (null === $textDomain) {
            $textDomain = $this->getTranslatorTextDomain();
        }
        
        // collector
        $collector = $this->serviveLocator->get("RtTranslation\ConfigCollector");
        $collector->addTranslationCall($message, $textDomain, $locale);
        return $translator->translate($message, $textDomain, $locale);
    }
}
