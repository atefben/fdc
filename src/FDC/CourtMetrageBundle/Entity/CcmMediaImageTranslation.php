<?php

namespace FDC\CourtMetrageBundle\Entity;

use A2lix\I18nDoctrineBundle\Doctrine\ORM\Util\Translation;


use Symfony\Component\Validator\Constraints as Assert;
use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation as Serializer;
use Base\CoreBundle\Interfaces\TranslateChildInterface;
use Base\CoreBundle\Util\Seo;
use Base\CoreBundle\Util\Time;
use Base\CoreBundle\Util\TranslateChild;

/**
 * @ORM\Entity()
 * @ORM\HasLifecycleCallbacks()
 */
class CcmMediaImageTranslation implements TranslateChildInterface
{
    use Seo;
    use Time;
    use Translation;
    use \Base\CoreBundle\Util\TranslationChanges;
    use TranslateChild;

    /**
     * @var \Application\Sonata\MediaBundle\Entity\Media
     *
     * @ORM\OneToOne(targetEntity="Application\Sonata\MediaBundle\Entity\Media", cascade={"persist"}, fetch="LAZY")
     * @ORM\JoinColumn(name="file_id", referencedColumnName="id")
     * @Assert\Valid()
     */
    protected $file;

    /**
     * @var string
     *
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    protected $legend;

    /**
     * @var string
     *
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    protected $alt;

    /**
     * @var string
     *
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Serializer\Accessor(getter="getApiCopyright")
     */
    protected $copyright;

    /**
     * Constructor
     */
    public function __construct()
    {
    }

    /**
     * Set legend
     *
     * @param string $legend
     * @return CcmMediaImageTranslation
     */
    public function setLegend($legend)
    {
        $this->legend = $legend;

        return $this;
    }

    /**
     * Get legend
     *
     * @return string 
     */
    public function getLegend()
    {
        return $this->legend;
    }

    /**
     * Set alt
     *
     * @param string $alt
     * @return CcmMediaImageTranslation
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
     * @return CcmMediaImageTranslation
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
     * Get copyright
     *
     * @return string
     */
    public function getApiCopyright()
    {
        
        return $this->copyright === null ? ' ' : $this->copyright;
    }

    /**
     * Set file
     *
     * @param \Application\Sonata\MediaBundle\Entity\Media $file
     * @return CcmMediaImageTranslation
     */
    public function setFile(\Application\Sonata\MediaBundle\Entity\Media $file)
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
}
