<?php

namespace RtTranslation\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * TranslationTranslation
 *
 * @ORM\Table(name="translation_translation", indexes={@ORM\Index(name="translation_locale_id", columns={"locale_id"}), @ORM\Index(name="translation_key_id", columns={"key_id"})})
 * @ORM\Entity
 */
class Translation
{
    /**
     * @var integer
     *
     * @ORM\Column(name="translation_id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $translationId;

    /**
     * @var string
     *
     * @ORM\Column(name="translation", type="text", nullable=false)
     */
    private $translation;

    /**
     * @var boolean
     *
     * @ORM\Column(name="plural_index", type="boolean", nullable=false)
     */
    private $pluralIndex = '1';

    /**
     * @var integer
     *
     * @ORM\Column(name="author", type="integer", nullable=false)
     */
    private $author;

    /**
     * @var integer
     *
     * @ORM\Column(name="version", type="integer", nullable=false)
     */
    private $version = '0';

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="timestamp", type="datetime", nullable=false)
     */
    private $timestamp;

    /**
     * @var boolean
     *
     * @ORM\Column(name="published", type="boolean", nullable=false)
     */
    private $published = '0';

    /**
     * @var \TranslationKey
     *
     * @ORM\ManyToOne(targetEntity="Key")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="key_id", referencedColumnName="key_id")
     * })
     */
    private $key;

    /**
     * @var \TranslationLocale
     *
     * @ORM\ManyToOne(targetEntity="Locale")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="locale_id", referencedColumnName="locale_id")
     * })
     */
    private $locale;


    /**
     * Get translationId
     *
     * @return integer 
     */
    public function getTranslationId()
    {
        return $this->translationId;
    }

    /**
     * Set translation
     *
     * @param string $translation
     * @return TranslationTranslation
     */
    public function setTranslation($translation)
    {
        $this->translation = $translation;

        return $this;
    }

    /**
     * Get translation
     *
     * @return string 
     */
    public function getTranslation()
    {
        return $this->translation;
    }

    /**
     * Set pluralIndex
     *
     * @param boolean $pluralIndex
     * @return TranslationTranslation
     */
    public function setPluralIndex($pluralIndex)
    {
        $this->pluralIndex = $pluralIndex;

        return $this;
    }

    /**
     * Get pluralIndex
     *
     * @return boolean 
     */
    public function getPluralIndex()
    {
        return $this->pluralIndex;
    }

    /**
     * Set author
     *
     * @param integer $author
     * @return TranslationTranslation
     */
    public function setAuthor($author)
    {
        $this->author = $author;

        return $this;
    }

    /**
     * Get author
     *
     * @return integer 
     */
    public function getAuthor()
    {
        return $this->author;
    }

    /**
     * Set version
     *
     * @param integer $version
     * @return TranslationTranslation
     */
    public function setVersion($version)
    {
        $this->version = $version;

        return $this;
    }

    /**
     * Get version
     *
     * @return integer 
     */
    public function getVersion()
    {
        return $this->version;
    }

    /**
     * Set timestamp
     *
     * @param \DateTime $timestamp
     * @return TranslationTranslation
     */
    public function setTimestamp($timestamp)
    {
        $this->timestamp = $timestamp;

        return $this;
    }

    /**
     * Get timestamp
     *
     * @return \DateTime 
     */
    public function getTimestamp()
    {
        return $this->timestamp;
    }

    /**
     * Set published
     *
     * @param boolean $published
     * @return TranslationTranslation
     */
    public function setPublished($published)
    {
        $this->published = $published;

        return $this;
    }

    /**
     * Get published
     *
     * @return boolean 
     */
    public function getPublished()
    {
        return $this->published;
    }

    /**
     * Set key
     *
     * @param \TranslationKey $key
     * @return TranslationTranslation
     */
    public function setKey(\TranslationKey $key = null)
    {
        $this->key = $key;

        return $this;
    }

    /**
     * Get key
     *
     * @return \TranslationKey 
     */
    public function getKey()
    {
        return $this->key;
    }

    /**
     * Set locale
     *
     * @param \TranslationLocale $locale
     * @return TranslationTranslation
     */
    public function setLocale(\TranslationLocale $locale = null)
    {
        $this->locale = $locale;

        return $this;
    }

    /**
     * Get locale
     *
     * @return \TranslationLocale 
     */
    public function getLocale()
    {
        return $this->locale;
    }
}
