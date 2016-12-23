<?php

namespace Base\CoreBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * OldArticleI18n
 *
 * @ORM\Table(name="old_article_i18n", indexes={@ORM\Index(name="cArticle", columns={"cArticle"}), @ORM\Index(name="uid", columns={"uid"})})
 * @ORM\Entity
 */
class OldArticleI18n
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
     * @ORM\Column(name="title", type="text", nullable=true)
     */
    protected $title;

    /**
     * @var string
     *
     * @ORM\Column(name="link_url", type="string", length=255, nullable=false)
     */
    protected $linkUrl;

    /**
     * @var string
     *
     * @ORM\Column(name="resume", type="text", nullable=true)
     */
    protected $resume;

    /**
     * @var string
     *
     * @ORM\Column(name="body", type="text", nullable=true)
     */
    protected $body;

    /**
     * @var string
     *
     * @ORM\Column(name="mobile_body", type="text", nullable=true)
     */
    protected $mobileBody;

    /**
     * @var boolean
     *
     * @ORM\Column(name="enable_mobile_body", type="boolean", nullable=false)
     */
    protected $enableMobileBody;

    /**
     * @var string
     *
     * @ORM\Column(name="image_resume", type="string", length=255, nullable=true)
     */
    protected $imageResume;

    /**
     * @var string
     *
     * @ORM\Column(name="title_image_resume", type="string", length=256, nullable=true)
     */
    protected $titleImageResume;

    /**
     * @var boolean
     *
     * @ORM\Column(name="enable_image_in_body", type="boolean", nullable=false)
     */
    protected $enableImageInBody;

    /**
     * @var string
     *
     * @ORM\Column(name="modified_by", type="string", length=255, nullable=true)
     */
    protected $modifiedBy;

    /**
     * @var string
     *
     * @ORM\Column(name="mosaique_image", type="string", length=255, nullable=true)
     */
    protected $mosaiqueImage;

    /**
     * @var integer
     *
     * @ORM\Column(name="cArticle", type="integer", nullable=true)
     */
    protected $carticle;

    /**
     * @var integer
     *
     * @ORM\Column(name="uid", type="integer", nullable=true)
     */
    protected $uid;

    /**
     * @var string
     *
     * @ORM\Column(name="mosaique_title", type="string", length=500, nullable=false)
     */
    protected $mosaiqueTitle;

    /**
     * @var string
     *
     * @ORM\Column(name="mosaique_resume", type="text", nullable=false)
     */
    protected $mosaiqueResume;

    /**
     * @var string
     *
     * @ORM\Column(name="mosaique_tag", type="string", length=255, nullable=true)
     */
    protected $mosaiqueTag;

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
     * @var boolean
     *
     * @ORM\Column(name="mosaique_image_active", type="boolean", nullable=true)
     */
    protected $mosaiqueImageActive;

    /**
     * @var string
     *
     * @ORM\Column(name="youtube_link", type="string", length=255, nullable=false)
     */
    protected $youtubeLink;

    /**
     * @var string
     *
     * @ORM\Column(name="youtube_link_description", type="string", length=255, nullable=false)
     */
    protected $youtubeLinkDescription;



    /**
     * Set id
     *
     * @param integer $id
     * @return OldArticleI18n
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
     * @return OldArticleI18n
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
     * @return OldArticleI18n
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
     * Set linkUrl
     *
     * @param string $linkUrl
     * @return OldArticleI18n
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
     * Set resume
     *
     * @param string $resume
     * @return OldArticleI18n
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
     * @return OldArticleI18n
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
     * Set mobileBody
     *
     * @param string $mobileBody
     * @return OldArticleI18n
     */
    public function setMobileBody($mobileBody)
    {
        $this->mobileBody = $mobileBody;

        return $this;
    }

    /**
     * Get mobileBody
     *
     * @return string 
     */
    public function getMobileBody()
    {
        return $this->mobileBody;
    }

    /**
     * Set enableMobileBody
     *
     * @param boolean $enableMobileBody
     * @return OldArticleI18n
     */
    public function setEnableMobileBody($enableMobileBody)
    {
        $this->enableMobileBody = $enableMobileBody;

        return $this;
    }

    /**
     * Get enableMobileBody
     *
     * @return boolean 
     */
    public function getEnableMobileBody()
    {
        return $this->enableMobileBody;
    }

    /**
     * Set imageResume
     *
     * @param string $imageResume
     * @return OldArticleI18n
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
     * Set titleImageResume
     *
     * @param string $titleImageResume
     * @return OldArticleI18n
     */
    public function setTitleImageResume($titleImageResume)
    {
        $this->titleImageResume = $titleImageResume;

        return $this;
    }

    /**
     * Get titleImageResume
     *
     * @return string 
     */
    public function getTitleImageResume()
    {
        return $this->titleImageResume;
    }

    /**
     * Set enableImageInBody
     *
     * @param boolean $enableImageInBody
     * @return OldArticleI18n
     */
    public function setEnableImageInBody($enableImageInBody)
    {
        $this->enableImageInBody = $enableImageInBody;

        return $this;
    }

    /**
     * Get enableImageInBody
     *
     * @return boolean 
     */
    public function getEnableImageInBody()
    {
        return $this->enableImageInBody;
    }

    /**
     * Set modifiedBy
     *
     * @param string $modifiedBy
     * @return OldArticleI18n
     */
    public function setModifiedBy($modifiedBy)
    {
        $this->modifiedBy = $modifiedBy;

        return $this;
    }

    /**
     * Get modifiedBy
     *
     * @return string 
     */
    public function getModifiedBy()
    {
        return $this->modifiedBy;
    }

    /**
     * Set mosaiqueImage
     *
     * @param string $mosaiqueImage
     * @return OldArticleI18n
     */
    public function setMosaiqueImage($mosaiqueImage)
    {
        $this->mosaiqueImage = $mosaiqueImage;

        return $this;
    }

    /**
     * Get mosaiqueImage
     *
     * @return string 
     */
    public function getMosaiqueImage()
    {
        return $this->mosaiqueImage;
    }

    /**
     * Set carticle
     *
     * @param integer $carticle
     * @return OldArticleI18n
     */
    public function setCarticle($carticle)
    {
        $this->carticle = $carticle;

        return $this;
    }

    /**
     * Get carticle
     *
     * @return integer 
     */
    public function getCarticle()
    {
        return $this->carticle;
    }

    /**
     * Set uid
     *
     * @param integer $uid
     * @return OldArticleI18n
     */
    public function setUid($uid)
    {
        $this->uid = $uid;

        return $this;
    }

    /**
     * Get uid
     *
     * @return integer 
     */
    public function getUid()
    {
        return $this->uid;
    }

    /**
     * Set mosaiqueTitle
     *
     * @param string $mosaiqueTitle
     * @return OldArticleI18n
     */
    public function setMosaiqueTitle($mosaiqueTitle)
    {
        $this->mosaiqueTitle = $mosaiqueTitle;

        return $this;
    }

    /**
     * Get mosaiqueTitle
     *
     * @return string 
     */
    public function getMosaiqueTitle()
    {
        return $this->mosaiqueTitle;
    }

    /**
     * Set mosaiqueResume
     *
     * @param string $mosaiqueResume
     * @return OldArticleI18n
     */
    public function setMosaiqueResume($mosaiqueResume)
    {
        $this->mosaiqueResume = $mosaiqueResume;

        return $this;
    }

    /**
     * Get mosaiqueResume
     *
     * @return string 
     */
    public function getMosaiqueResume()
    {
        return $this->mosaiqueResume;
    }

    /**
     * Set mosaiqueTag
     *
     * @param string $mosaiqueTag
     * @return OldArticleI18n
     */
    public function setMosaiqueTag($mosaiqueTag)
    {
        $this->mosaiqueTag = $mosaiqueTag;

        return $this;
    }

    /**
     * Get mosaiqueTag
     *
     * @return string 
     */
    public function getMosaiqueTag()
    {
        return $this->mosaiqueTag;
    }

    /**
     * Set isTranslated
     *
     * @param boolean $isTranslated
     * @return OldArticleI18n
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
     * @return OldArticleI18n
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
     * Set mosaiqueImageActive
     *
     * @param boolean $mosaiqueImageActive
     * @return OldArticleI18n
     */
    public function setMosaiqueImageActive($mosaiqueImageActive)
    {
        $this->mosaiqueImageActive = $mosaiqueImageActive;

        return $this;
    }

    /**
     * Get mosaiqueImageActive
     *
     * @return boolean 
     */
    public function getMosaiqueImageActive()
    {
        return $this->mosaiqueImageActive;
    }

    /**
     * Set youtubeLink
     *
     * @param string $youtubeLink
     * @return OldArticleI18n
     */
    public function setYoutubeLink($youtubeLink)
    {
        $this->youtubeLink = $youtubeLink;

        return $this;
    }

    /**
     * Get youtubeLink
     *
     * @return string 
     */
    public function getYoutubeLink()
    {
        return $this->youtubeLink;
    }

    /**
     * Set youtubeLinkDescription
     *
     * @param string $youtubeLinkDescription
     * @return OldArticleI18n
     */
    public function setYoutubeLinkDescription($youtubeLinkDescription)
    {
        $this->youtubeLinkDescription = $youtubeLinkDescription;

        return $this;
    }

    /**
     * Get youtubeLinkDescription
     *
     * @return string 
     */
    public function getYoutubeLinkDescription()
    {
        return $this->youtubeLinkDescription;
    }
}
