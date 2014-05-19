<?php
namespace RtTranslation\Collector;

use ZendDeveloperTools\Collector;

use Zend\Mvc\MvcEvent;

/**
 * Collector to be used in ZendDeveloperTools to record and display personal information
 *
 * @license MIT
 * @author  Vinicius Garcia <vinigar[...].com>
 */
class ConfigCollector extends \ZendDeveloperTools\Collector\AbstractCollector
{

    /**
     * Constructore
     * Initialize
     */
    public function __construct() {
        $this->data = array(
            'locale' => "",
            'translations' => array()
        );
    }

    /**
     * {@inheritDoc}
     */
    public function getName()
    {
        return 'rt_translation_translations';
    }

    /**
     * {@inheritDoc}
     */
    public function getPriority()
    {
        return 1;
    }

    /**
     * {@inheritDoc}
     */
    public function collect(MvcEvent $mvcEvent)
    {
        /*$this->data = array(
            'locale' => "fr",
            'translations' => array()
        );*/
        
    }
    
    /**
     * 
     * @param type $message
     * @param type $textDomain
     * @param type $locale
     * @param type $missing
     * @return \RtTranslation\Collector\ConfigCollector
     */
    public function addTranslationCall($message, $textDomain = "default", $locale = null, $missing = false){
        $this->data['translations'][md5($textDomain.$message)] = array(
            'message' => $message,
            'textDomain' => $textDomain,
            'locale' => $locale,
            'missing' => $missing
        );
        return $this;
    }
    
    

    /**
     * Returns the locale
     *
     * @return string
     */
    public function getLocale()
    {
        return $this->data['locale'];
    }

    /**
     * Returns the default locale
     *
     * @return string
     */
    public function getTranslations()
    {
        return $this->data['translations'];
    }
    
}