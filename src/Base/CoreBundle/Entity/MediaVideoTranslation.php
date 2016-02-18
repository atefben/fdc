<?php

namespace Base\CoreBundle\Entity;

use A2lix\I18nDoctrineBundle\Doctrine\ORM\Util\Translation;

use Base\CoreBundle\Interfaces\TranslateChildInterface;
use Base\CoreBundle\Util\Seo;
use Base\CoreBundle\Util\Time;
use Base\CoreBundle\Util\TranslateChild;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

use JMS\Serializer\Annotation\Groups;
use JMS\Serializer\Annotation\Since;

use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass="Base\CoreBundle\Repository\MediaVideoTranslationRepository")
 * @ORM\HasLifecycleCallbacks()
 */
class MediaVideoTranslation implements TranslateChildInterface
{
    use Seo;
    use Time;
    use Translation;
    use TranslateChild;

    /**
     * @var Application\Sonata\MediaBundle\Entity\Media
     *
     * @ORM\OneToOne(targetEntity="Application\Sonata\MediaBundle\Entity\Media", cascade={"persist"}, fetch="LAZY")
     * @ORM\JoinColumn(name="file_id", referencedColumnName="id")
     * @Assert\Valid()
     */
    private $file;

    /**
     * @var string
     *
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Groups({"trailer_show", "web_tv_list", "web_tv_show"})
     */
    private $title;

    /**
     * @var string
     *
     * @ORM\Column(type="string", nullable=true)
     */
    private $imageAmazonUrl;

    /**
     * @var integer
     *
     * @ORM\Column(type="integer", nullable=true, options={"default":0})
     */
    private $jobWebmState;

    /**
     * @var integer
     *
     * @ORM\Column(type="integer", nullable=true, options={"default":0})
     */
    private $jobMp4State;

    /**
     * @var string
     *
     * @ORM\Column(type="string", nullable=true)
     */
    private $jobMp4Id;

    /**
     * @var string
     *
     * @ORM\Column(type="string", nullable=true)
     */
    private $jobWebmId;

    /**
     * @var Theme
     *
     * @ORM\ManyToOne(targetEntity="Theme")
     */
    private $theme;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->state = 0;
    }


    /**
     * Set akamaiId
     *
     * @param integer $akamaiId
     * @return MediaVideoTranslation
     */
    public function setAkamaiId($akamaiId)
    {
        $this->akamaiId = $akamaiId;

        return $this;
    }

    /**
     * Get akamaiId
     *
     * @return integer 
     */
    public function getAkamaiId()
    {
        return $this->akamaiId;
    }

    /**
     * Set title
     *
     * @param string $title
     * @return MediaVideoTranslation
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
     * Set alt
     *
     * @param string $alt
     * @return MediaVideoTranslation
     */
    public function setAlt($alt)
    {
        $this->alt = $alt;

        return $this;
    }

    /**
     * Get alt
     *
     * @return string 
     */
    public function getAlt()
    {
        return $this->alt;
    }

    /**
     * Set copyright
     *
     * @param string $copyright
     * @return MediaVideoTranslation
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
     * Set file
     *
     * @param \Application\Sonata\MediaBundle\Entity\Media $file
     * @return MediaVideoTranslation
     */
    public function setFile(\Application\Sonata\MediaBundle\Entity\Media $file = null)
    {
        $this->file = $file;

        return $this;
    }

    /**
     * Get file
     *
     * @return \Application\Sonata\MediaBundle\Entity\Media 
     */
    public function getFile()
    {
        return $this->file;
    }

    /**
     * Set theme
     *
     * @param \Base\CoreBundle\Entity\Theme $theme
     * @return MediaVideoTranslation
     */
    public function setTheme(\Base\CoreBundle\Entity\Theme $theme = null)
    {
        $this->theme = $theme;

        return $this;
    }

    /**
     * Get theme
     *
     * @return \Base\CoreBundle\Entity\Theme 
     */
    public function getTheme()
    {
        return $this->theme;
    }

    /**
     * Set imageAmazonUrl
     *
     * @param string $imageAmazonUrl
     * @return MediaVideo
     */
    public function setImageAmazonUrl($imageAmazonUrl)
    {
        $this->imageAmazonUrl = $imageAmazonUrl;

        return $this;
    }

    /**
     * Get imageAmazonUrl
     *
     * @return string
     */
    public function getImageAmazonUrl()
    {
        return $this->imageAmazonUrl;
    }

    /**
     * Set jobWebmState
     *
     * @param integer $jobWebmState
     * @return MediaVideoTranslation
     */
    public function setJobWebmState($jobWebmState)
    {
        $this->jobWebmState = $jobWebmState;

        return $this;
    }

    /**
     * Get jobWebmState
     *
     * @return integer 
     */
    public function getJobWebmState()
    {
        return $this->jobWebmState;
    }

    /**
     * Set jobMp4State
     *
     * @param integer $jobMp4State
     * @return MediaVideoTranslation
     */
    public function setJobMp4State($jobMp4State)
    {
        $this->jobMp4State = $jobMp4State;

        return $this;
    }

    /**
     * Get jobMp4State
     *
     * @return integer 
     */
    public function getJobMp4State()
    {
        return $this->jobMp4State;
    }

    /**
     * Set jobMp4Id
     *
     * @param string $jobMp4Id
     * @return MediaVideoTranslation
     */
    public function setJobMp4Id($jobMp4Id)
    {
        $this->jobMp4Id = $jobMp4Id;

        return $this;
    }

    /**
     * Get jobMp4Id
     *
     * @return string 
     */
    public function getJobMp4Id()
    {
        return $this->jobMp4Id;
    }

    /**
     * Set jobWebmId
     *
     * @param string $jobWebmId
     * @return MediaVideoTranslation
     */
    public function setJobWebmId($jobWebmId)
    {
        $this->jobWebmId = $jobWebmId;

        return $this;
    }

    /**
     * Get jobWebmId
     *
     * @return string 
     */
    public function getJobWebmId()
    {
        return $this->jobWebmId;
    }
}
