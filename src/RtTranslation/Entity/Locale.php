<?php

namespace RtTranslation\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * TranslationLocale
 *
 * @ORM\Table(name="translation_locale")
 * @ORM\Entity
 */
class Locale
{
    /**
     * @var integer
     *
     * @ORM\Column(name="locale_id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $localeId;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=255, nullable=false)
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(name="locale", type="string", length=6, nullable=false)
     */
    private $locale;

    /**
     * @var boolean
     *
     * @ORM\Column(name="published", type="boolean", nullable=false)
     */
    private $published;

    /**
     * @var boolean
     *
     * @ORM\Column(name="`default`", type="boolean", nullable=false)
     */
    private $default;

    /**
     * @var string
     *
     * @ORM\Column(name="plural_forms", type="string", length=255, nullable=false)
     */
    private $pluralForms = 'nplurals=2; plural=(n==1 ? 0 : 1)';


    /**
     * Get localeId
     *
     * @return integer 
     */
    public function getLocaleId()
    {
        return $this->localeId;
    }

    /**
     * Set name
     *
     * @param string $name
     * @return TranslationLocale
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string 
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set locale
     *
     * @param string $locale
     * @return TranslationLocale
     */
    public function setLocale($locale)
    {
        $this->locale = $locale;

        return $this;
    }

    /**
     * Get locale
     *
     * @return string 
     */
    public function getLocale()
    {
        return $this->locale;
    }

    /**
     * Set published
     *
     * @param boolean $published
     * @return TranslationLocale
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
     * Set default
     *
     * @param boolean $default
     * @return TranslationLocale
     */
    public function setDefault($default)
    {
        $this->default = $default;

        return $this;
    }

    /**
     * Get default
     *
     * @return boolean 
     */
    public function getDefault()
    {
        return $this->default;
    }

    /**
     * Set pluralForms
     *
     * @param string $pluralForms
     * @return TranslationLocale
     */
    public function setPluralForms($pluralForms)
    {
        $this->pluralForms = $pluralForms;

        return $this;
    }

    /**
     * Get pluralForms
     *
     * @return string 
     */
    public function getPluralForms()
    {
        return $this->pluralForms;
    }
}
