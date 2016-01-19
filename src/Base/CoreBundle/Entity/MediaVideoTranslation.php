<?php

namespace Base\CoreBundle\Entity;

use A2lix\I18nDoctrineBundle\Doctrine\ORM\Util\Translation;

use Base\CoreBundle\Interfaces\TranslateChildInterface;
use Base\CoreBundle\Util\Time;
use Base\CoreBundle\Util\TranslateChild;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

use JMS\Serializer\Annotation\Groups;
use JMS\Serializer\Annotation\Since;

use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity
 * @ORM\HasLifecycleCallbacks()
 */
class MediaVideoTranslation implements TranslateChildInterface
{
    use Time;
    use Translation;
    use TranslateChild;

    /**
     * @var Application\Sonata\MediaBundle\Entity\Media
     *
     * @ORM\OneToOne(targetEntity="Application\Sonata\MediaBundle\Entity\Media", cascade={"persist"}, fetch="LAZY")
     * @ORM\JoinColumn(name="file_id", referencedColumnName="id")
     */
    private $file;

    /**
     * @var string
     *
     * @ORM\Column(type="integer", nullable=true)
     * @Groups({"trailer_show", "web_tv_list", "web_tv_show"})
     */
    private $akamaiId;

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
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Groups({"trailer_show", "web_tv_list", "web_tv_show"})
     */
    private $alt;

    /**
     * @var string
     *
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Groups({"trailer_show", "web_tv_list", "web_tv_show"})
     */
    private $copyright;

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
        $this->sites = new ArrayCollection();
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
     * @param \Base\CoreBundle\Entity\NewsTheme $theme
     * @return MediaVideoTranslation
     */
    public function setTheme(\Base\CoreBundle\Entity\NewsTheme $theme = null)
    {
        $this->theme = $theme;

        return $this;
    }

    /**
     * Get theme
     *
     * @return \Base\CoreBundle\Entity\NewsTheme 
     */
    public function getTheme()
    {
        return $this->theme;
    }
}
