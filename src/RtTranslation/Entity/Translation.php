<?php

namespace RtTranslation\Entity;

class Translation {
    
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
     * @var type 
     */
    protected $translation;

    /**
     *
     * @var type 
     */
    protected $author;
    
    /**
     *
     * @var type 
     */
    protected $version;

    /**
     *
     * @var integer 
     */
    protected $timestamp;
    
    /**
     * 
     * @param integer $id
     * @return \RtTranslation\Entity\Translation
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
    
    public function setMessage($message){
        $this->message = $message;
        return $this;
    }
    
    public function getMessage(){
        return $this->message;
    }
    
    public function setLocale($locale){
        $this->locale = $locale;
        return $this;
    }
    
    public function getLocale(){
        return $this->locale;
    }
    
    public function setTranslation($translation){
        $this->translation = $translation;
        return $this;
    }
    
    public function getTranslation(){
        return $this->translation;
    }
    
    public function setAuthor($author){
        $this->author = $author;
        return $this;
    }
    
    public function getAuthor(){
        return $this->author;
    }
    
    public function setVersion($version){
        $this->version = (int) $version;
        return $this;
    }
    
    public function getVersion(){
        return $this->version;
    }
    
    public function setTimestamp($timestamp){
        $this->timestamp = (int) $timestamp;
        return $this;
    }
    
    public function getTimestamp(){
        return $this->timestamp;
    }
    
}