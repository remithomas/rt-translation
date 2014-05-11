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
    protected $textDomain = 'default';

    /**
     * 
     * @param array $data
     * @return \RtTranslation\Entity\Key
     */
    public function exchangeArray(array $data){
        $this->id = (isset($data['key_id']) ? $data['key_id'] : null);
        $this->message = (isset($data['key_message']) ? $data['key_message'] : null);
        $this->textDomain = (isset($data['key_text_domain']) ? $data['key_text_domain'] : null);
        return $this;
    }
    
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
