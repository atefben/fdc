<?php

namespace Base\CoreBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * OldRightBlockI18n
 *
 * @ORM\Table(name="old_right_block_i18n")
 * @ORM\Entity
 */
class OldRightBlockI18n
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="culture", type="string", length=7, nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     */
    private $culture;

    /**
     * @var string
     *
     * @ORM\Column(name="title", type="text", nullable=true)
     */
    private $title;

    /**
     * @var string
     *
     * @ORM\Column(name="resume", type="text", nullable=true)
     */
    private $resume;

    /**
     * @var string
     *
     * @ORM\Column(name="body", type="text", nullable=true)
     */
    private $body;

    /**
     * @var string
     *
     * @ORM\Column(name="link_name", type="string", length=255, nullable=true)
     */
    private $linkName;

    /**
     * @var string
     *
     * @ORM\Column(name="link_url", type="string", length=255, nullable=true)
     */
    private $linkUrl;

    /**
     * @var string
     *
     * @ORM\Column(name="image_logo", type="string", length=255, nullable=true)
     */
    private $imageLogo;

    /**
     * @var string
     *
     * @ORM\Column(name="image_resume", type="string", length=255, nullable=true)
     */
    private $imageResume;

    /**
     * @var boolean
     *
     * @ORM\Column(name="is_translated", type="boolean", nullable=true)
     */
    private $isTranslated;

    /**
     * @var integer
     *
     * @ORM\Column(name="i18n_translation_status", type="integer", nullable=false)
     */
    private $i18nTranslationStatus;



    /**
     * Set id
     *
     * @param integer $id
     * @return OldRightBlockI18n
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
     * @return OldRightBlockI18n
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
     * Set title
     *
     * @param string $title
     * @return OldRightBlockI18n
     */
    public function setTitle($title)
    {
        $this->title = $title;

        return $this;
    }

    /**
     * Get title
     *
     * @return string 
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Set resume
     *
     * @param string $resume
     * @return OldRightBlockI18n
     */
    public function setResume($resume)
    {
        $this->resume = $resume;

        return $this;
    }

    /**
     * Get resume
     *
     * @return string 
     */
    public function getResume()
    {
        return $this->resume;
    }

    /**
     * Set body
     *
     * @param string $body
     * @return OldRightBlockI18n
     */
    public function setBody($body)
    {
        $this->body = $body;

        return $this;
    }

    /**
     * Get body
     *
     * @return string 
     */
    public function getBody()
    {
        return $this->body;
    }

    /**
     * Set linkName
     *
     * @param string $linkName
     * @return OldRightBlockI18n
     */
    public function setLinkName($linkName)
    {
        $this->linkName = $linkName;

        return $this;
    }

    /**
     * Get linkName
     *
     * @return string 
     */
    public function getLinkName()
    {
        return $this->linkName;
    }

    /**
     * Set linkUrl
     *
     * @param string $linkUrl
     * @return OldRightBlockI18n
     */
    public function setLinkUrl($linkUrl)
    {
        $this->linkUrl = $linkUrl;

        return $this;
    }

    /**
     * Get linkUrl
     *
     * @return string 
     */
    public function getLinkUrl()
    {
        return $this->linkUrl;
    }

    /**
     * Set imageLogo
     *
     * @param string $imageLogo
     * @return OldRightBlockI18n
     */
    public function setImageLogo($imageLogo)
    {
        $this->imageLogo = $imageLogo;

        return $this;
    }

    /**
     * Get imageLogo
     *
     * @return string 
     */
    public function getImageLogo()
    {
        return $this->imageLogo;
    }

    /**
     * Set imageResume
     *
     * @param string $imageResume
     * @return OldRightBlockI18n
     */
    public function setImageResume($imageResume)
    {
        $this->imageResume = $imageResume;

        return $this;
    }

    /**
     * Get imageResume
     *
     * @return string 
     */
    public function getImageResume()
    {
        return $this->imageResume;
    }

    /**
     * Set isTranslated
     *
     * @param boolean $isTranslated
     * @return OldRightBlockI18n
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
     * @return OldRightBlockI18n
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
}
