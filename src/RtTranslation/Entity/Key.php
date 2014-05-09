<?php

namespace RtTranslation\Entity;

class Key{
    
    /**
     *
     * @var integer 
     */
    protected $id;

    /**
     * 
     * @var string 
     */
    protected $message;
    
    /**
     *
     * @var string 
     */
    protected $locale;

    /**
     *
     * @var string 
     */
    protected $textDomain = 'default';

    /**
     * 
     * @param integer $id
     * @return \RtTranslation\Entity\Key
     */
    public function setId($id){
        $this->id = (int) $id;
        return $this;
    }
    
    /**
     * 
     * @return integer
     */
    public function getId(){
        return $this->id;
    }

    /**
     * 
     * @param string $message
     * @return \RtTranslation\Entity\Key
     */
    public function setMessage($message){
        $this->message = $message;
        return $this;
    }
    
    /**
     * 
     * @return string
     */
    public function getMessage(){
        return $this->message;
    }
    
    /**
     * 
     * @param string $locale
     * @return \RtTranslation\Entity\Key
     */
    public function setLocale($locale){
        $this->locale = $locale;
        return $this;
    }
    
    /**
     * 
     * @return string
     */
    public function getLocale(){
        return $this->locale;
    }
    
    /**
     * 
     * @param string $message
     * @return \RtTranslation\Entity\Key
     */
    public function setTextDomain($textDomain){
        $this->textDomain = $textDomain;
        return $this;
    }
    
    /**
     * 
     * @return string
     */
    public function getTextDomain(){
        return $this->textDomain;
    }
}
