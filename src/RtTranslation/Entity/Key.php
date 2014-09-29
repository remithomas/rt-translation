<?php

namespace RtTranslation\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * TranslationKey
 *
 * @ORM\Table(name="translation_key")
 * @ORM\Entity
 */
class Key
{
    /**
     * @var integer
     *
     * @ORM\Column(name="key_id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $keyId;

    /**
     * @var string
     *
     * @ORM\Column(name="message", type="string", length=512, nullable=false)
     */
    private $message;

    /**
     * @var string
     *
     * @ORM\Column(name="text_domain", type="string", length=255, nullable=false)
     */
    private $textDomain = 'default';


    /**
     * Get keyId
     *
     * @return integer 
     */
    public function getKeyId()
    {
        return $this->keyId;
    }

    /**
     * Set message
     *
     * @param string $message
     * @return TranslationKey
     */
    public function setMessage($message)
    {
        $this->message = $message;

        return $this;
    }

    /**
     * Get message
     *
     * @return string 
     */
    public function getMessage()
    {
        return $this->message;
    }

    /**
     * Set textDomain
     *
     * @param string $textDomain
     * @return TranslationKey
     */
    public function setTextDomain($textDomain)
    {
        $this->textDomain = $textDomain;

        return $this;
    }

    /**
     * Get textDomain
     *
     * @return string 
     */
    public function getTextDomain()
    {
        return $this->textDomain;
    }
}
