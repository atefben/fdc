<?php

namespace Base\CoreBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * OldTagCloudI18n
 *
 * @ORM\Table(name="old_tag_cloud_i18n")
 * @ORM\Entity
 */
class OldTagCloudI18n
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
     * @ORM\Column(name="link", type="string", length=255, nullable=true)
     */
    private $link;

    /**
     * @var string
     *
     * @ORM\Column(name="libelle", type="string", length=255, nullable=true)
     */
    private $libelle;

    /**
     * @var integer
     *
     * @ORM\Column(name="tag_color", type="integer", nullable=true)
     */
    private $tagColor;

    /**
     * @var integer
     *
     * @ORM\Column(name="tag_order", type="integer", nullable=true)
     */
    private $tagOrder;

    /**
     * @var integer
     *
     * @ORM\Column(name="tag_size", type="integer", nullable=true)
     */
    private $tagSize;

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
     * @var integer
     *
     * @ORM\Column(name="font_style", type="integer", nullable=true)
     */
    private $fontStyle;

    /**
     * @var string
     *
     * @ORM\Column(name="font_name", type="string", length=255, nullable=true)
     */
    private $fontName;



    /**
     * Set id
     *
     * @param integer $id
     * @return OldTagCloudI18n
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
     * @return OldTagCloudI18n
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
     * Set link
     *
     * @param string $link
     * @return OldTagCloudI18n
     */
    public function setLink($link)
    {
        $this->link = $link;

        return $this;
    }

    /**
     * Get link
     *
     * @return string 
     */
    public function getLink()
    {
        return $this->link;
    }

    /**
     * Set libelle
     *
     * @param string $libelle
     * @return OldTagCloudI18n
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
     * Set tagColor
     *
     * @param integer $tagColor
     * @return OldTagCloudI18n
     */
    public function setTagColor($tagColor)
    {
        $this->tagColor = $tagColor;

        return $this;
    }

    /**
     * Get tagColor
     *
     * @return integer 
     */
    public function getTagColor()
    {
        return $this->tagColor;
    }

    /**
     * Set tagOrder
     *
     * @param integer $tagOrder
     * @return OldTagCloudI18n
     */
    public function setTagOrder($tagOrder)
    {
        $this->tagOrder = $tagOrder;

        return $this;
    }

    /**
     * Get tagOrder
     *
     * @return integer 
     */
    public function getTagOrder()
    {
        return $this->tagOrder;
    }

    /**
     * Set tagSize
     *
     * @param integer $tagSize
     * @return OldTagCloudI18n
     */
    public function setTagSize($tagSize)
    {
        $this->tagSize = $tagSize;

        return $this;
    }

    /**
     * Get tagSize
     *
     * @return integer 
     */
    public function getTagSize()
    {
        return $this->tagSize;
    }

    /**
     * Set isTranslated
     *
     * @param boolean $isTranslated
     * @return OldTagCloudI18n
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
     * @return OldTagCloudI18n
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
     * Set fontStyle
     *
     * @param integer $fontStyle
     * @return OldTagCloudI18n
     */
    public function setFontStyle($fontStyle)
    {
        $this->fontStyle = $fontStyle;

        return $this;
    }

    /**
     * Get fontStyle
     *
     * @return integer 
     */
    public function getFontStyle()
    {
        return $this->fontStyle;
    }

    /**
     * Set fontName
     *
     * @param string $fontName
     * @return OldTagCloudI18n
     */
    public function setFontName($fontName)
    {
        $this->fontName = $fontName;

        return $this;
    }

    /**
     * Get fontName
     *
     * @return string 
     */
    public function getFontName()
    {
        return $this->fontName;
    }
}
