<?php

namespace RtTranslation\Entity;

class Locale{
   
    /**
     *
     * @var string 
     */
    protected $name;
    
    /**
     *
     * @var string 
     */
    protected $locale;

    /**
     *
     * @var bool 
     */
    protected $default;
    
    /**
     *
     * @var bool 
     */
    protected $published;

    /**
     *
     * @var string 
     */
    protected $pluralForms;

    /**
     * Constructor
     */
    public function __construct() {
        ;
    }
    
    /**
     * Set name of the locale
     * @param string $name
     * @return \RtTranslation\Entity\Locale
     */
    public function setName($name){
        $this->name = $name;
        return $this;
    }
    
    /**
     * Get name of the locale
     * @return string
     */
    public function getName(){
        return $this->name;
    }
    
    /**
     * Set locale
     * @param string $locale
     * @return \RtTranslation\Entity\Locale
     */
    public function setLocale($locale){
        $this->locale = $locale;
        return $this;
    }
    
    /**
     * Get locale
     * @return string
     */
    public function getLocale(){
        return $this->locale;
    }
    
    /**
     * 
     * @param type $published
     * @return \RtTranslation\Entity\Locale
     */
    public function setPublished($published){
        $this->published = ($published === "1" || $published === true);
        return $this;
    }
    
    /**
     * 
     * @return type
     */
    public function getPublished(){
        return $this->published;
    }
    
    /**
     * 
     * @param string $pluralForms
     * @return \RtTranslation\Entity\Locale
     */
    public function setPluralForms($pluralForms){
        $this->pluralForms = $pluralForms;
        return $this;
    }
    
    /**
     * 
     * @return string
     */
    public function getPluralForms(){
        return $this->pluralForms;
    }
    
    /**
     * 
     * @param integer|bool $default
     * @return \RtTranslation\Entity\Locale
     */
    public function setDefault($default){
        $this->default = ($default === "1" || $default === true);
        return $this;
    }
    
    /**
     * 
     * @return bool
     */
    public function getDefault(){
        return $this->default;
    }
}