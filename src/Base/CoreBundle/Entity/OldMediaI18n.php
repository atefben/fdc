<?php

namespace Base\CoreBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * OldMediaI18n
 *
 * @ORM\Table(name="old_media_i18n", indexes={@ORM\Index(name="pm_hd_format_filename", columns={"hd_format_filename"})})
 * @ORM\Entity
 */
class OldMediaI18n
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
     * @ORM\Column(name="label", type="string", length=255, nullable=true)
     */
    private $label;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="text", nullable=true)
     */
    private $description;

    /**
     * @var string
     *
     * @ORM\Column(name="code", type="string", length=255, nullable=true)
     */
    private $code;

    /**
     * @var string
     *
     * @ORM\Column(name="wmv_format_filename", type="string", length=255, nullable=true)
     */
    private $wmvFormatFilename;

    /**
     * @var string
     *
     * @ORM\Column(name="rm_format_filename", type="string", length=255, nullable=true)
     */
    private $rmFormatFilename;

    /**
     * @var string
     *
     * @ORM\Column(name="hd_format_filename", type="string", length=255, nullable=true)
     */
    private $hdFormatFilename;

    /**
     * @var string
     *
     * @ORM\Column(name="bd_format_filename", type="string", length=255, nullable=true)
     */
    private $bdFormatFilename;

    /**
     * @var string
     *
     * @ORM\Column(name="filename_thumbnail", type="string", length=255, nullable=true)
     */
    private $filenameThumbnail;

    /**
     * @var string
     *
     * @ORM\Column(name="thumbnail_copyright", type="string", length=255, nullable=true)
     */
    private $thumbnailCopyright;

    /**
     * @var string
     *
     * @ORM\Column(name="copyright", type="string", length=255, nullable=true)
     */
    private $copyright;

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
     * @var boolean
     *
     * @ORM\Column(name="akamai_status", type="boolean", nullable=true)
     */
    private $akamaiStatus;

    /**
     * @var string
     *
     * @ORM\Column(name="delivery_url", type="string", length=255, nullable=true)
     */
    private $deliveryUrl;

    /**
     * @var string
     *
     * @ORM\Column(name="image_url", type="string", length=255, nullable=true)
     */
    private $imageUrl;

    /**
     * @var string
     *
     * @ORM\Column(name="akamai_thumbnail", type="string", length=255, nullable=true)
     */
    private $akamaiThumbnail;

    /**
     * @var string
     *
     * @ORM\Column(name="error_code", type="string", length=255, nullable=true)
     */
    private $errorCode;



    /**
     * Set id
     *
     * @param integer $id
     * @return OldMediaI18n
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
     * @return OldMediaI18n
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
     * Set label
     *
     * @param string $label
     * @return OldMediaI18n
     */
    public function setLabel($label)
    {
        $this->label = $label;

        return $this;
    }

    /**
     * Get label
     *
     * @return string 
     */
    public function getLabel()
    {
        return $this->label;
    }

    /**
     * Set description
     *
     * @param string $description
     * @return OldMediaI18n
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get description
     *
     * @return string 
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set code
     *
     * @param string $code
     * @return OldMediaI18n
     */
    public function setCode($code)
    {
        $this->code = $code;

        return $this;
    }

    /**
     * Get code
     *
     * @return string 
     */
    public function getCode()
    {
        return $this->code;
    }

    /**
     * Set wmvFormatFilename
     *
     * @param string $wmvFormatFilename
     * @return OldMediaI18n
     */
    public function setWmvFormatFilename($wmvFormatFilename)
    {
        $this->wmvFormatFilename = $wmvFormatFilename;

        return $this;
    }

    /**
     * Get wmvFormatFilename
     *
     * @return string 
     */
    public function getWmvFormatFilename()
    {
        return $this->wmvFormatFilename;
    }

    /**
     * Set rmFormatFilename
     *
     * @param string $rmFormatFilename
     * @return OldMediaI18n
     */
    public function setRmFormatFilename($rmFormatFilename)
    {
        $this->rmFormatFilename = $rmFormatFilename;

        return $this;
    }

    /**
     * Get rmFormatFilename
     *
     * @return string 
     */
    public function getRmFormatFilename()
    {
        return $this->rmFormatFilename;
    }

    /**
     * Set hdFormatFilename
     *
     * @param string $hdFormatFilename
     * @return OldMediaI18n
     */
    public function setHdFormatFilename($hdFormatFilename)
    {
        $this->hdFormatFilename = $hdFormatFilename;

        return $this;
    }

    /**
     * Get hdFormatFilename
     *
     * @return string 
     */
    public function getHdFormatFilename()
    {
        return $this->hdFormatFilename;
    }

    /**
     * Set bdFormatFilename
     *
     * @param string $bdFormatFilename
     * @return OldMediaI18n
     */
    public function setBdFormatFilename($bdFormatFilename)
    {
        $this->bdFormatFilename = $bdFormatFilename;

        return $this;
    }

    /**
     * Get bdFormatFilename
     *
     * @return string 
     */
    public function getBdFormatFilename()
    {
        return $this->bdFormatFilename;
    }

    /**
     * Set filenameThumbnail
     *
     * @param string $filenameThumbnail
     * @return OldMediaI18n
     */
    public function setFilenameThumbnail($filenameThumbnail)
    {
        $this->filenameThumbnail = $filenameThumbnail;

        return $this;
    }

    /**
     * Get filenameThumbnail
     *
     * @return string 
     */
    public function getFilenameThumbnail()
    {
        return $this->filenameThumbnail;
    }

    /**
     * Set thumbnailCopyright
     *
     * @param string $thumbnailCopyright
     * @return OldMediaI18n
     */
    public function setThumbnailCopyright($thumbnailCopyright)
    {
        $this->thumbnailCopyright = $thumbnailCopyright;

        return $this;
    }

    /**
     * Get thumbnailCopyright
     *
     * @return string 
     */
    public function getThumbnailCopyright()
    {
        return $this->thumbnailCopyright;
    }

    /**
     * Set copyright
     *
     * @param string $copyright
     * @return OldMediaI18n
     */
    public function setCopyright($copyright)
    {
        $this->copyright = $copyright;

        return $this;
    }

    /**
     * Get copyright
     *
     * @return string 
     */
    public function getCopyright()
    {
        return $this->copyright;
    }

    /**
     * Set isTranslated
     *
     * @param boolean $isTranslated
     * @return OldMediaI18n
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
     * @return OldMediaI18n
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
     * Set akamaiStatus
     *
     * @param boolean $akamaiStatus
     * @return OldMediaI18n
     */
    public function setAkamaiStatus($akamaiStatus)
    {
        $this->akamaiStatus = $akamaiStatus;

        return $this;
    }

    /**
     * Get akamaiStatus
     *
     * @return boolean 
     */
    public function getAkamaiStatus()
    {
        return $this->akamaiStatus;
    }

    /**
     * Set deliveryUrl
     *
     * @param string $deliveryUrl
     * @return OldMediaI18n
     */
    public function setDeliveryUrl($deliveryUrl)
    {
        $this->deliveryUrl = $deliveryUrl;

        return $this;
    }

    /**
     * Get deliveryUrl
     *
     * @return string 
     */
    public function getDeliveryUrl()
    {
        return $this->deliveryUrl;
    }

    /**
     * Set imageUrl
     *
     * @param string $imageUrl
     * @return OldMediaI18n
     */
    public function setImageUrl($imageUrl)
    {
        $this->imageUrl = $imageUrl;

        return $this;
    }

    /**
     * Get imageUrl
     *
     * @return string 
     */
    public function getImageUrl()
    {
        return $this->imageUrl;
    }

    /**
     * Set akamaiThumbnail
     *
     * @param string $akamaiThumbnail
     * @return OldMediaI18n
     */
    public function setAkamaiThumbnail($akamaiThumbnail)
    {
        $this->akamaiThumbnail = $akamaiThumbnail;

        return $this;
    }

    /**
     * Get akamaiThumbnail
     *
     * @return string 
     */
    public function getAkamaiThumbnail()
    {
        return $this->akamaiThumbnail;
    }

    /**
     * Set errorCode
     *
     * @param string $errorCode
     * @return OldMediaI18n
     */
    public function setErrorCode($errorCode)
    {
        $this->errorCode = $errorCode;

        return $this;
    }

    /**
     * Get errorCode
     *
     * @return string 
     */
    public function getErrorCode()
    {
        return $this->errorCode;
    }
}
