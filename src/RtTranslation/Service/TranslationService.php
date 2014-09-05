<?php

namespace RtTranslation\Service;

use Zend\Authentication\AuthenticationService;
use Zend\Form\Form;
use Zend\ServiceManager\ServiceManagerAwareInterface;
use Zend\ServiceManager\ServiceManager;
use Zend\Stdlib\Hydrator;

use RtTranslation\Options\ModuleOptions;
use RtTranslation\Entity;

class TranslationService implements ServiceManagerAwareInterface {
    
    /**
     *
     * @var \RtTranslation\Options\ModuleOptions 
     */
    protected $options;

    /**
     *
     * @var type 
     */
    protected $serviceManager;

    /**
     * get service options
     *
     * @return ModuleOptions
     */
    public function getOptions()
    {
        if (!$this->options instanceof ModuleOptions) {
            $this->setOptions($this->getServiceManager()->get('rt_translation_module_options'));
        }
        return $this->options;
    }

    /**
     * set service options
     *
     * @param ModuleOptions $options
     */
    public function setOptions(ModuleOptions $options)
    {
        $this->options = $options;
        return $this;
    }

    /**
     * Retrieve service manager instance
     *
     * @return ServiceManager
     */
    public function getServiceManager()
    {
        return $this->serviceManager;
    }

    /**
     * Set service manager instance
     *
     * @param ServiceManager $serviceManager
     * @return \RtTranslation\Service\TranslationService
     */
    public function setServiceManager(ServiceManager $serviceManager)
    {
        $this->serviceManager = $serviceManager;
        return $this;
    }
    
    public function getLocaleTable(){
        $this->serviceManager;
    }
    
    
    /**
     * List all locales
     * @return array
     */
    public function getLocales(){
        return $this->serviceManager->get("rt_translation_locale_table")->fetchAll();
    }
    
    
    /**
     * 
     * @todo check if exist locale
     * @todo check if one locale is already default
     * 
     * @param \RtTranslation\Entity\Locale $locale
     * @return boolean
     */
    public function addLocale(Entity\Locale $locale){
        $this->serviceManager->get("rt_translation_locale_table")->insert(array(
            'locale_name' => utf8_decode($locale->getName()),
            'locale_locale' => utf8_decode($locale->getLocale()),
            'locale_published' => (integer) $locale->getPublished(),
            'locale_default' => (integer) $locale->getDefault(),
            'locale_plural_forms'   => $locale->getPluralForms(),
        ));
        return true;
    }
    
    public function editLocale(Entity\Locale $locale){
        
    }
    
    public function changeLocale($locale = 'en_US'){
        
    }
    
    public function getKeys($paginator = false){
        return $this->serviceManager->get("rt_translation_key_table")->fetchAll($paginator);
    }
    
    /**
     * Add key message
     * @param \RtTranslation\Entity\Key $key
     * @return boolean
     */
    public function addKey(Entity\Key $key){
        $this->serviceManager->get("rt_translation_key_table")->insert(array(
            'key_message' => utf8_decode($key->getMessage()),
            'key_text_domain' => utf8_decode($key->getTextDomain()),
        ));
        return true;
    }
    
    public function editKey(Entity\Key $key){
        
    }
   
    public function addTranslation(){
        
    }
    
    public function editTranslation(){
        
    }
    
    /**
     * List all translations
     * @return array
     */
    public function getTranslations($paginator = false){
        return $this->serviceManager->get("rt_translation_translation_table")->fetchAll($paginator);
    }
}