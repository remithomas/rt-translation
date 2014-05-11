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
     * 
     * @return array
     */
    public function getLocales(){
        return $this->serviceManager->get("rt_translation_locale_table")->fetchAll();
    }
    
    
    /**
     * 
     * @param \RtTranslation\Entity\Locale $locale
     * @return boolean
     */
    public function addLocale(Entity\Locale $locale){
        \Zend\Debug\Debug::dump($locale);
        die;
        return true;
    }
    
    public function editLocale(Entity\Locale $locale){
        
    }
    
    public function changeLocale($locale = 'en_US'){
        
    }
    
    public function getKeys($paginator = false){
        return $this->serviceManager->get("rt_translation_key_table")->fetchAll($paginator);
    }
    
    public function addKey(Entity\Key $key){
        
    }
}