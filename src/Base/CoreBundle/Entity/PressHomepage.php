<?php

namespace Base\CoreBundle\Entity;

use A2lix\I18nDoctrineBundle\Doctrine\ORM\Util\Translatable;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

use Base\CoreBundle\Util\Time;

/**
 * PressHomepage
 *
 * @ORM\Table()
 * @ORM\Entity
 * @ORM\HasLifecycleCallbacks()
 */
class PressHomepage
{
    use Translatable;
    use Time;
    /**
     * @var integer
     *
     * @ORM\Column(type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var PressHomepageSection
     * @ORM\OneToMany(targetEntity="PressHomepageSection", mappedBy="homepage", cascade={"persist"})
     * @ORM\OrderBy({"position" = "ASC"})
     */
    private $section;

    /**
     * @var PressHomepageMedia
     * @ORM\OneToMany(targetEntity="PressHomepageMedia", mappedBy="homepage", cascade={"persist"})
     * @ORM\OrderBy({"position" = "ASC"})
     */
    private $homeMedia;

    /**
     * @var PressHomepageDownload
     * @ORM\OneToMany(targetEntity="PressHomepageDownload", mappedBy="homepage", cascade={"persist"})
     * @ORM\OrderBy({"position" = "ASC"})
     */
    private $homeDownload;

    /**
     * @var PressHomepagePushMain
     *
     * @ORM\OneToMany(targetEntity="PressHomepagePushMain", mappedBy="homepage")
     */
    protected $pushsMain;

    /**
     * @var PressHomepagePushSecondary
     *
     * @ORM\OneToMany(targetEntity="PressHomepagePushSecondary", mappedBy="homepage")
     */
    protected $pushsSecondary;

    /**
     * var MediaImage
     * @ORM\ManyToOne(targetEntity="MediaImage")
     */
    protected $statImage;

    /**
     * var MediaImage
     * @ORM\ManyToOne(targetEntity="MediaImage")
     */
    protected $statImage2;

    /**
     * ArrayCollection
     */
    protected $translations;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->section = new ArrayCollection();
        $this->homeMedia = new ArrayCollection();
        $this->homeDownload = new ArrayCollection();
        $this->translations = new ArrayCollection();
        $this->pushsMain = new ArrayCollection();
        $this->pushsSecondary = new ArrayCollection();
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
     * Add section
     *
     * @param \Base\CoreBundle\Entity\PressHomepageSection $section
     * @return PressHomepage
     */
    public function addSection(\Base\CoreBundle\Entity\PressHomepageSection $section)
    {
        $this->section[] = $section;

        return $this;
    }

    /**
     * Remove section
     *
     * @param \Base\CoreBundle\Entity\PressHomepageSection $section
     */
    public function removeSection(\Base\CoreBundle\Entity\PressHomepageSection $section)
    {
        $this->section->removeElement($section);
    }

    /**
     * Get section
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getSection()
    {
        return $this->section;
    }

    /**
     * Add homeMedia
     *
     * @param \Base\CoreBundle\Entity\PressHomepageMedia $homeMedia
     * @return PressHomepage
     */
    public function addHomeMedia(\Base\CoreBundle\Entity\PressHomepageMedia $homeMedia)
    {
        $homeMedia->setHomepage($this);
        $this->homeMedia->add($homeMedia);
    }

    /**
     * @param $homeMedia
     * @return $this
     */
    public function setHomeMedia($homeMedia)
    {

        $this->homeMedia = $homeMedia;
        return $this;
    }

    /**
     * Remove homeMedia
     *
     * @param \Base\CoreBundle\Entity\PressHomepageMedia $homeMedia
     */
    public function removeHomeMedia(\Base\CoreBundle\Entity\PressHomepageMedia $homeMedia)
    {
        $this->homeMedia->removeElement($homeMedia);
    }

    /**
     * Get homeMedia
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getHomeMedia()
    {
        return $this->homeMedia;
    }


    /**
     * Add homeDownload
     *
     * @param \Base\CoreBundle\Entity\PressHomepageDownload $homeDownload
     * @return PressHomepage
     */
    public function addHomeDownload(\Base\CoreBundle\Entity\PressHomepageDownload $homeDownload)
    {
        $homeDownload->setHomepage($this);
        $this->homeDownload->add($homeDownload);
    }

    /**
     * @param $homeDownload
     * @return $this
     */
    public function setHomeDownload($homeDownload)
    {

        $this->homeDownload = $homeDownload;
        return $this;
    }

    /**
     * Remove homeDownload
     *
     * @param \Base\CoreBundle\Entity\PressHomepageDownload $homeDownload
     */
    public function removeHomeDownload(\Base\CoreBundle\Entity\PressHomepageDownload $homeDownload)
    {
        $this->homeDownload->removeElement($homeDownload);
    }

    /**
     * Get homeDownload
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getHomeDownload()
    {
        return $this->homeDownload;
    }


    /**
     * Add pushsMain
     *
     * @param \Base\CoreBundle\Entity\PressHomepagePushMain $pushsMain
     * @return PressHomepage
     */
    public function addPushsMain(\Base\CoreBundle\Entity\PressHomepagePushMain $pushsMain)
    {
        $this->pushsMain[] = $pushsMain;

        return $this;
    }

    /**
     * Remove pushsMain
     *
     * @param \Base\CoreBundle\Entity\PressHomepagePushMain $pushsMain
     */
    public function removePushsMain(\Base\CoreBundle\Entity\PressHomepagePushMain $pushsMain)
    {
        $this->pushsMain->removeElement($pushsMain);
    }

    /**
     * Get pushsMain
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getPushsMain()
    {
        return $this->pushsMain;
    }

    /**
     * Add pushsSecondary
     *
     * @param \Base\CoreBundle\Entity\PressHomepagePushSecondary $pushsSecondary
     * @return PressHomepage
     */
    public function addPushsSecondary(\Base\CoreBundle\Entity\PressHomepagePushSecondary $pushsSecondary)
    {
        $this->pushsSecondary[] = $pushsSecondary;

        return $this;
    }

    /**
     * Remove pushsSecondary
     *
     * @param \Base\CoreBundle\Entity\PressHomepagePushSecondary $pushsSecondary
     */
    public function removePushsSecondary(\Base\CoreBundle\Entity\PressHomepagePushSecondary $pushsSecondary)
    {
        $this->pushsSecondary->removeElement($pushsSecondary);
    }

    /**
     * Get pushsSecondary
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getPushsSecondary()
    {
        return $this->pushsSecondary;
    }

    /**
     * Set statImage
     *
     * @param \Base\CoreBundle\Entity\MediaImage $statImage
     * @return PressHomepage
     */
    public function setStatImage(\Base\CoreBundle\Entity\MediaImage $statImage = null)
    {
        $this->statImage = $statImage;

        return $this;
    }

    /**
     * Get statImage
     *
     * @return \Base\CoreBundle\Entity\MediaImage 
     */
    public function getStatImage()
    {
        return $this->statImage;
    }

    /**
     * Set statImage2
     *
     * @param \Base\CoreBundle\Entity\MediaImage $statImage2
     * @return PressHomepage
     */
    public function setStatImage2(\Base\CoreBundle\Entity\MediaImage $statImage2 = null)
    {
        $this->statImage2 = $statImage2;

        return $this;
    }

    /**
     * Get statImage2
     *
     * @return \Base\CoreBundle\Entity\MediaImage 
     */
    public function getStatImage2()
    {
        return $this->statImage2;
    }
}
