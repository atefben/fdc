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
 * @ORM\Entity
 * @ORM\HasLifecycleCallbacks()
 */
class MediaImageSimpleTranslation implements TranslateChildInterface
{
    use Time;
    use Translation;
    use TranslateChild;

    /**
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
     * @Groups({"news_list", "news_show"})
     */
    private $alt;
    
    /**
     * @var Site
     *
     * @ORM\ManyToMany(targetEntity="Site")
     */
    private $sites;


    /**
     * Set alt
     *
     * @param string $alt
     * @return MediaImageTranslation
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
     * Set file
     *
     * @param \Application\Sonata\MediaBundle\Entity\Media $file
     * @return MediaImageTranslation
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
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->sites = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add sites
     *
     * @param \Base\CoreBundle\Entity\Site $sites
     * @return MediaImageSimpleTranslation
     */
    public function addSite(\Base\CoreBundle\Entity\Site $sites)
    {
        $this->sites[] = $sites;

        return $this;
    }

    /**
     * Remove sites
     *
     * @param \Base\CoreBundle\Entity\Site $sites
     */
    public function removeSite(\Base\CoreBundle\Entity\Site $sites)
    {
        $this->sites->removeElement($sites);
    }

    /**
     * Get sites
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getSites()
    {
        return $this->sites;
    }
}
