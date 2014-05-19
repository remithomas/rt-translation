<?php

namespace RtTranslation\Options;

use Zend\Stdlib\AbstractOptions;

class ModuleOptions extends AbstractOptions 
{
    /**
     *
     * @var bool 
     */
    protected $useCache = true;

    /**
     * Default route
     * @var string 
     */
    protected $defaultRoute = "home";

    /**
     *
     * @var string 
     */
    protected $defaultLanguage = 'en_EN';

    /**
     *
     * @var array|bool 
     */
    protected $textDomains = true;

    /**
     * Db Adapter
     * @var string 
     */
    protected $dbAdapter = "Zend\Db\Adapter\Adapter";

    /**
     *
     * @var bool 
     */
    protected $debugger = false;

    /**
     * Set use cache
     * @param bool $useCache
     * @return \RtTranslation\Options\ModuleOptions
     */
    public function setUseCache($useCache)
    {
        $this->useCache = $useCache;
        return $this;
    }

    /**
     * Get use cache
     * @return bool
     */
    public function getUseCache()
    {
        return $this->useCache;
    }

    /**
     * 
     * @param string $defaultRoute
     * @return \RtTranslation\Options\ModuleOptions
     */
    public function setDefaultRoute($defaultRoute = "home"){
        $this->defaultRoute = $defaultRoute;
        return $this;
    }
    
    /**
     * 
     * @return string
     */
    public function getDefaultRoute(){
        return $this->defaultRoute;
    }
    
    /**
     * 
     * @param string $defaultRoute
     * @return \RtTranslation\Options\ModuleOptions
     */
    public function setDbAdapter($dbAdapter = "Zend\Db\Adapter\Adapter"){
        $this->dbAdapter = $dbAdapter;
        return $this;
    }
    
    /**
     * 
     * @return string
     */
    public function getDbAdapter(){
        return $this->dbAdapter;
    }
    
    public function setTextDomains($textDomains){
        $this->textDomains = $textDomains;
        return $this;
    }

    public function getTextDomains(){
        return $this->textDomains;
    }
    
    /**
     * 
     * @param string $defaultLanguage
     * @return \RtTranslation\Options\ModuleOptions
     */
    public function setDefaultLanguage($defaultLanguage){
        $this->defaultLanguage = $defaultLanguage;
        return $this;
    }
    
    /**
     * 
     * @return string
     */
    public function getDefaultLanguage(){
        return $this->defaultLanguage;
    }
    
    /**
     * 
     * @param bool $debugger
     * @return \RtTranslation\Options\ModuleOptions
     */
    public function setDebugger($debugger = false){
        $this->debugger = $debugger;
        return $this;
    }
    
    /**
     * 
     * @return bool
     */
    public function getDebugger(){
        return $this->debugger;
    }
}
