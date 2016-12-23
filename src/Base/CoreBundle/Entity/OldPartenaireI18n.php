<?php

namespace Base\CoreBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * OldPartenaireI18n
 *
 * @ORM\Table(name="old_partenaire_i18n")
 * @ORM\Entity
 */
class OldPartenaireI18n
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
     * @ORM\Column(name="name", type="string", length=255, nullable=true)
     */
    protected $name;

    /**
     * @var string
     *
     * @ORM\Column(name="logo", type="string", length=255, nullable=true)
     */
    protected $logo;

    /**
     * @var string
     *
     * @ORM\Column(name="image", type="string", length=255, nullable=true)
     */
    protected $image;

    /**
     * @var string
     *
     * @ORM\Column(name="image_title", type="string", length=500, nullable=true)
     */
    protected $imageTitle;

    /**
     * @var string
     *
     * @ORM\Column(name="paragraph", type="string", length=1000, nullable=true)
     */
    protected $paragraph;

    /**
     * @var string
     *
     * @ORM\Column(name="link_1", type="string", length=255, nullable=true)
     */
    protected $link1;

    /**
     * @var string
     *
     * @ORM\Column(name="link_1_label", type="string", length=255, nullable=true)
     */
    protected $link1Label;

    /**
     * @var string
     *
     * @ORM\Column(name="link_2", type="string", length=255, nullable=true)
     */
    protected $link2;

    /**
     * @var string
     *
     * @ORM\Column(name="link_2_label", type="string", length=255, nullable=true)
     */
    protected $link2Label;

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
     * Set id
     *
     * @param integer $id
     * @return OldPartenaireI18n
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
     * @return OldPartenaireI18n
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
     * Set name
     *
     * @param string $name
     * @return OldPartenaireI18n
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
     * Set logo
     *
     * @param string $logo
     * @return OldPartenaireI18n
     */
    public function setLogo($logo)
    {
        $this->logo = $logo;

        return $this;
    }

    /**
     * Get logo
     *
     * @return string 
     */
    public function getLogo()
    {
        return $this->logo;
    }

    /**
     * Set image
     *
     * @param string $image
     * @return OldPartenaireI18n
     */
    public function setImage($image)
    {
        $this->image = $image;

        return $this;
    }

    /**
     * Get image
     *
     * @return string 
     */
    public function getImage()
    {
        return $this->image;
    }

    /**
     * Set imageTitle
     *
     * @param string $imageTitle
     * @return OldPartenaireI18n
     */
    public function setImageTitle($imageTitle)
    {
        $this->imageTitle = $imageTitle;

        return $this;
    }

    /**
     * Get imageTitle
     *
     * @return string 
     */
    public function getImageTitle()
    {
        return $this->imageTitle;
    }

    /**
     * Set paragraph
     *
     * @param string $paragraph
     * @return OldPartenaireI18n
     */
    public function setParagraph($paragraph)
    {
        $this->paragraph = $paragraph;

        return $this;
    }

    /**
     * Get paragraph
     *
     * @return string 
     */
    public function getParagraph()
    {
        return $this->paragraph;
    }

    /**
     * Set link1
     *
     * @param string $link1
     * @return OldPartenaireI18n
     */
    public function setLink1($link1)
    {
        $this->link1 = $link1;

        return $this;
    }

    /**
     * Get link1
     *
     * @return string 
     */
    public function getLink1()
    {
        return $this->link1;
    }

    /**
     * Set link1Label
     *
     * @param string $link1Label
     * @return OldPartenaireI18n
     */
    public function setLink1Label($link1Label)
    {
        $this->link1Label = $link1Label;

        return $this;
    }

    /**
     * Get link1Label
     *
     * @return string 
     */
    public function getLink1Label()
    {
        return $this->link1Label;
    }

    /**
     * Set link2
     *
     * @param string $link2
     * @return OldPartenaireI18n
     */
    public function setLink2($link2)
    {
        $this->link2 = $link2;

        return $this;
    }

    /**
     * Get link2
     *
     * @return string 
     */
    public function getLink2()
    {
        return $this->link2;
    }

    /**
     * Set link2Label
     *
     * @param string $link2Label
     * @return OldPartenaireI18n
     */
    public function setLink2Label($link2Label)
    {
        $this->link2Label = $link2Label;

        return $this;
    }

    /**
     * Get link2Label
     *
     * @return string 
     */
    public function getLink2Label()
    {
        return $this->link2Label;
    }

    /**
     * Set isTranslated
     *
     * @param boolean $isTranslated
     * @return OldPartenaireI18n
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
     * @return OldPartenaireI18n
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
