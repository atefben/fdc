<?php

namespace Base\CoreBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * OldNewsFeedI18n
 *
 * @ORM\Table(name="old_news_feed_i18n")
 * @ORM\Entity
 */
class OldNewsFeedI18n
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     */
    protected $id;

    /**
     * @var string
     *
     * @ORM\Column(name="culture", type="string", length=7, nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     */
    protected $culture;

    /**
     * @var string
     *
     * @ORM\Column(name="type", type="string", length=40, nullable=true)
     */
    protected $type;

    /**
     * @var string
     *
     * @ORM\Column(name="libelle", type="text", nullable=true)
     */
    protected $libelle;

    /**
     * @var boolean
     *
     * @ORM\Column(name="is_translated", type="boolean", nullable=true)
     */
    protected $isTranslated;

    /**
     * @var integer
     *
     * @ORM\Column(name="i18n_translation_status", type="integer", nullable=false)
     */
    protected $i18nTranslationStatus;

    /**
     * @var string
     *
     * @ORM\Column(name="url", type="string", length=255, nullable=false)
     */
    protected $url;

    /**
     * @var boolean
     *
     * @ORM\Column(name="target_blank", type="boolean", nullable=false)
     */
    protected $targetBlank;



    /**
     * Set id
     *
     * @param integer $id
     * @return OldNewsFeedI18n
     */
    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }

    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set culture
     *
     * @param string $culture
     * @return OldNewsFeedI18n
     */
    public function setCulture($culture)
    {
        $this->culture = $culture;

        return $this;
    }

    /**
     * Get culture
     *
     * @return string 
     */
    public function getCulture()
    {
        return $this->culture;
    }

    /**
     * Set type
     *
     * @param string $type
     * @return OldNewsFeedI18n
     */
    public function setType($type)
    {
        $this->type = $type;

        return $this;
    }

    /**
     * Get type
     *
     * @return string 
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * Set libelle
     *
     * @param string $libelle
     * @return OldNewsFeedI18n
     */
    public function setLibelle($libelle)
    {
        $this->libelle = $libelle;

        return $this;
    }

    /**
     * Get libelle
     *
     * @return string 
     */
    public function getLibelle()
    {
        return $this->libelle;
    }

    /**
     * Set isTranslated
     *
     * @param boolean $isTranslated
     * @return OldNewsFeedI18n
     */
    public function setIsTranslated($isTranslated)
    {
        $this->isTranslated = $isTranslated;

        return $this;
    }

    /**
     * Get isTranslated
     *
     * @return boolean 
     */
    public function getIsTranslated()
    {
        return $this->isTranslated;
    }

    /**
     * Set i18nTranslationStatus
     *
     * @param integer $i18nTranslationStatus
     * @return OldNewsFeedI18n
     */
    public function setI18nTranslationStatus($i18nTranslationStatus)
    {
        $this->i18nTranslationStatus = $i18nTranslationStatus;

        return $this;
    }

    /**
     * Get i18nTranslationStatus
     *
     * @return integer 
     */
    public function getI18nTranslationStatus()
    {
        return $this->i18nTranslationStatus;
    }

    /**
     * Set url
     *
     * @param string $url
     * @return OldNewsFeedI18n
     */
    public function setUrl($url)
    {
        $this->url = $url;

        return $this;
    }

    /**
     * Get url
     *
     * @return string 
     */
    public function getUrl()
    {
        return $this->url;
    }

    /**
     * Set targetBlank
     *
     * @param boolean $targetBlank
     * @return OldNewsFeedI18n
     */
    public function setTargetBlank($targetBlank)
    {
        $this->targetBlank = $targetBlank;

        return $this;
    }

    /**
     * Get targetBlank
     *
     * @return boolean 
     */
    public function getTargetBlank()
    {
        return $this->targetBlank;
    }
}
