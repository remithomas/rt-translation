<?php

namespace RtTranslation\Service;

use Zend\Authentication\AuthenticationService;
use Zend\Form\Form;
use Zend\ServiceManager\ServiceManagerAwareInterface;
use Zend\ServiceManager\ServiceManager;
use Zend\Stdlib\Hydrator;

 use DoctrineORMModule\Paginator\Adapter\DoctrinePaginator as DoctrineAdapter;
 use Doctrine\ORM\Tools\Pagination\Paginator as ORMPaginator;
 use Zend\Paginator\Paginator;

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
     *
     * @var type 
     */
    protected $entityManager;

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

    public function getEntityManager(){
        if(is_null($this->entityManager)){
            $this->entityManager = $this->getServiceManager()->get('doctrine.entitymanager.orm_default');
        }
        return $this->entityManager;
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
     * @param bool $paginator
     * @return \Zend\Paginator\Paginator
     */
    public function getLocales($paginator = true){
        if($paginator){
            $repository = $this->getEntityManager()->getRepository('RtTranslation\Entity\Locale');
            $adapter = new DoctrineAdapter(new ORMPaginator($repository->createQueryBuilder('user')));
            $paginator = new Paginator($adapter);
            return $paginator;
        }
    }
    
    /**
     * get id of all published locales
     * @return array
     */
    public function getIdLocales(){
        $return  = array();
        $locales = $this->getEntityManager()->getRepository('RtTranslation\Entity\Locale')->findby(array(
            'published' => 1
        ));
        foreach ($locales as $locale){
            $return[] = $locale->getLocale();
        }
        return $return;
    }
    
    /**
     * Get one locale
     * @param integer $localeId
     * @return RtTranslation\Entity\Locale
     */
    public function getLocale($localeId){
        return $this->getEntityManager()->find('RtTranslation\Entity\Locale', $localeId);
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
        $this->getEntityManager()->persist($locale);
        $this->getEntityManager()->flush();
        return true;
    }
    
    /**
     * 
     * @param \RtTranslation\Entity\Locale $locale
     * @return boolean
     */
    public function editLocale(Entity\Locale $locale){
        $this->getEntityManager()->merge($locale);
        $this->getEntityManager()->flush();
        return true;
    }
    
    public function changeLocale($locale = 'en_US'){
        
    }
    
    /**
     * 
     * @param bool $paginator
     * @return \Zend\Paginator\Paginator
     */
    public function getKeys($paginator = true){
        if($paginator){
            $repository = $this->getEntityManager()->getRepository('RtTranslation\Entity\Key');
            $adapter = new DoctrineAdapter(new ORMPaginator($repository->createQueryBuilder('user')));
            $paginator = new Paginator($adapter);
            return $paginator;
        }
        //return $this->serviceManager->get("rt_translation_key_table")->fetchAll($paginator);
    }
    
    /**
     * 
     * @return array
     */
    public function getTextDomains(){
        return $this->serviceManager->get("rt_translation_key_table")->fetchTextDomains();
    }
    
    /**
     * Add key message
     * @param \RtTranslation\Entity\Key $key
     * @return boolean
     */
    public function addKey(Entity\Key $key){
        $this->getEntityManager()->persist($key);
        $this->getEntityManager()->flush();
        return true;
    }
    
    /**
     * 
     * @param \RtTranslation\Entity\Key $key
     * @return boolean
     */
    public function editKey(Entity\Key $key){
        $this->getEntityManager()->merge($key);
        $this->getEntityManager()->flush();
        return true;
    }
    
    /**
     * 
     * @param integer $keyId
     * @return \RtTranslation\Entity\Key
     */
    public function getKey($keyId){
        return $this->getEntityManager()->find('RtTranslation\Entity\Key', $keyId);
    }
   
    public function addTranslation(Entity\Translation $translation){
        $this->serviceManager->get("rt_translation_locale_table")->insert(array(
            'locale_name' => utf8_decode($locale->getName()),
            'locale_locale' => utf8_decode($locale->getLocale()),
            'locale_published' => (integer) $locale->getPublished(),
            'locale_default' => (integer) $locale->getDefault(),
            'locale_plural_forms'   => $locale->getPluralForms(),
        ));
        return true;
    }
    
    public function editTranslation(){
        
    }
    
    /**
     * List all translations
     * @return array
     */
    public function getTranslations($paginator = false){
        if($paginator){
            $repository = $this->getEntityManager()->getRepository('RtTranslation\Entity\Translation');
            $adapter = new DoctrineAdapter(new ORMPaginator($repository->createQueryBuilder('user')));
            $paginator = new Paginator($adapter);
            return $paginator;
        }
    }
}