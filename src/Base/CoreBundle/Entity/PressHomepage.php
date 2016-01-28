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
}
