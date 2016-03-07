<?php

namespace Base\CoreBundle\Entity;

use A2lix\I18nDoctrineBundle\Doctrine\ORM\Util\Translation;

use Base\CoreBundle\Interfaces\TranslateChildInterface;
use Base\CoreBundle\Util\Seo;
use Base\CoreBundle\Util\Time;
use Base\CoreBundle\Util\TranslateChild;

use Gedmo\Mapping\Annotation as Gedmo;

use Doctrine\ORM\Mapping as ORM;

use Gedmo\Sluggable\Util\Urlizer;
use Symfony\Component\Validator\Constraints as Assert;
use DateTime;

/**
 * FDCPageWaitingTranslation
 *
 * @ORM\Table()
 * @ORM\Entity
 * @ORM\HasLifecycleCallbacks
 */
class FDCPageWaitingTranslation implements TranslateChildInterface
{
    use Time;
    use Translation;
    use TranslateChild;
    use Seo;

    /**
     * @var string
     *
     * @ORM\Column(name="title", type="string", length=255, nullable=true)
     */
    private $title;

    /**
     * @var \Application\Sonata\MediaBundle\Entity\Media
     *
     * @ORM\OneToOne(targetEntity="Application\Sonata\MediaBundle\Entity\Media", cascade={"persist"}, fetch="LAZY")
     * @ORM\JoinColumn(name="file_id", referencedColumnName="id", nullable=true)
     * @Assert\Valid()
     */
    private $banner;

    /**
     * @var string
     *
     * @Gedmo\Slug(fields={"title"}, updatable=false)
     * @ORM\Column(name="slug", type="string", length=255, unique=false, nullable=true)
     */
    private $slug;

    /**
     * @var string
     *
     * @ORM\Column(name="text", type="text", nullable=true)
     */
    private $text;

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
     * Set title
     *
     * @param string $title
     * @return FDCPageWaitingTranslation
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
     * Set text
     *
     * @param string $text
     * @return FDCPageWaitingTranslation
     */
    public function setText($text)
    {
        $this->text = $text;

        return $this;
    }

    /**
     * Get text
     *
     * @return string 
     */
    public function getText()
    {
        return $this->text;
    }

    /**
     * Set slug
     *
     * @param string $slug
     * @return FDCPageWaitingTranslation
     */
    public function setSlug($slug)
    {
        $this->slug = $slug;

        return $this;
    }

    /**
     * Get slug
     *
     * @return string 
     */
    public function getSlug()
    {
        return $this->slug;
    }
    

    /**
     * Set banner
     *
     * @param \Application\Sonata\MediaBundle\Entity\Media $banner
     * @return FDCPageWaitingTranslation
     */
    public function setBanner(\Application\Sonata\MediaBundle\Entity\Media $banner = null)
    {
        $this->banner = $banner;

        return $this;
    }

    /**
     * Get banner
     *
     * @return \Application\Sonata\MediaBundle\Entity\Media 
     */
    public function getBanner()
    {
        return $this->banner;
    }
}
