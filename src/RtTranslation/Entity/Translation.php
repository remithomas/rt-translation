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
    protected $locale;
    
    /**
     *
     * @var integer 
     */
    protected $keyId;
    
    /**
     *
     * @var string 
     */
    protected $translation;
    
    /**
     *
     * @var integer 
     */
    protected $pluralIndex;

    /**
     *
     * @var integer 
     */
    protected $author = 1;
    
    /**
     *
     * @var integer 
     */
    protected $version = 0;
    
    /**
     *
     * @var integer 
     */
    protected $timestamp;
    
    /**
     *
     * @var bool 
     */
    protected $published;
    
    /**
     * 
     * @param array $data
     * @return \RtTranslation\Entity\Translation
     */
    public function exchangeArray(array $data){
        $this->id = (isset($data['translation_id']) ? $data['translation_id'] : null);
        $this->locale = (isset($data['translation_locale']) ? (string) $data['translation_locale'] : null);
        $this->keyId = (isset($data['translation_key_id']) ? (integer) $data['translation_key_id'] : null);
        $this->translation = (isset($data['translation_translation']) ? (string) $data['translation_translation'] : null);
        $this->pluralIndex = (isset($data['translation_plural_index']) ? (integer) $data['translation_plural_index'] : null);
        $this->author = (isset($data['translation_author']) ? (integer) $data['translation_author'] : null);
        $this->version = (isset($data['translation_version']) ? (integer) $data['translation_version'] : null);
        $this->timestamp = (isset($data['translation_timestamp']) ? (integer) $data['translation_timestamp'] : null);
        $this->published = (isset($data['translation_published']) ? (bool) $data['translation_published'] : null);
        return $this;
    }
    
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
    
    /**
     * 
     * @param string $locale
     * @return \RtTranslation\Entity\Translation
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
     * @param integer $keyId
     * @return \RtTranslation\Entity\Translation
     */
    public function setKeyId($keyId){
        $this->keyId = $keyId;
        return $this;
    }
    
    /**
     * 
     * @return integer
     */
    public function getKeyId(){
        return $this->keyId;
    }
    
    /**
     * 
     * @param string $translation
     * @return \RtTranslation\Entity\Translation
     */
    public function setTranslation($translation){
        $this->translation = $translation;
        return $this;
    }
    
    /**
     * 
     * @return string
     */
    public function getTranslation(){
        return $this->translation;
    }
    
    /**
     * 
     * @param integer $pluralIndex
     * @return \RtTranslation\Entity\Translation
     */
    public function setPluralIndex($pluralIndex){
        $this->pluralIndex = $pluralIndex;
        return $this;
    }
    
    /**
     * 
     * @return integer
     */
    public function getPluralIndex(){
        return $this->pluralIndex;
    }
    
    /**
     * 
     * @param integer $author
     * @return \RtTranslation\Entity\Translation
     */
    public function setAuthor($author){
        $this->author = $author;
        return $this;
    }
    
    /**
     * 
     * @return integer
     */
    public function getAuthor(){
        return $this->author;
    }
    
    /**
     * 
     * @param integer $version
     * @return \RtTranslation\Entity\Translation
     */
    public function setVersion($version){
        $this->version = (int) $version;
        return $this;
    }
    
    /**
     * 
     * @return integer
     */
    public function getVersion(){
        return $this->version;
    }
    
    /**
     * 
     * @param integer $timestamp
     * @return \RtTranslation\Entity\Translation
     */
    public function setTimestamp($timestamp){
        $this->timestamp = (int) $timestamp;
        return $this;
    }
    
    /**
     * 
     * @return integer
     */
    public function getTimestamp(){
        return $this->timestamp;
    }
    
    /**
     * 
     * @param type $published
     * @return \RtTranslation\Entity\Translation
     */
    public function setPublished($published){
        $this->published = ($published === "1" || $published === true);
        return $this;
    }
    
    /**
     * 
     * @return bool
     */
    public function getPublished(){
        return $this->published;
    }
}