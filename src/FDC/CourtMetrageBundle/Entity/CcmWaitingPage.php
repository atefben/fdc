<?php

namespace FDC\CourtMetrageBundle\Entity;

use A2lix\I18nDoctrineBundle\Doctrine\ORM\Util\Translatable;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Base\CoreBundle\Entity\MediaImage;

/**
 * CcmWaitingPage
 * @ORM\Table(name="ccm_waiting_page")
 * @ORM\Entity
 */
class CcmWaitingPage
{
    use Translatable;

    /**
     * @var integer
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @var MediaImage
     *
     * @ORM\ManyToOne(targetEntity="Base\CoreBundle\Entity\MediaImageSimple")
     *
     */
    protected $image;

    /**
     * @var CcmShortFilmCompetitionTab
     * @ORM\ManyToOne(targetEntity="CcmShortFilmCompetitionTab")
     *
     */
    protected $page;

    /**
     * @var boolean
     *
     * @ORM\Column(type="boolean", nullable=true)
     */
    protected $enabled = false;

    /**
     * @var ArrayCollection
     */
    protected $translations;

    /**
     * CcmWaitingPage constructor.
     */
    public function __construct()
    {
        $this->translations = new ArrayCollection();
    }

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return CcmShortFilmCompetitionTab
     */
    public function getPage()
    {
        return $this->page;
    }

    /**
     * @param $page
     *
     * @return $this
     */
    public function setPage($page)
    {
        $this->page = $page;

        return $this;
    }

    /**
     * @return MediaImage
     */
    public function getImage()
    {
        return $this->image;
    }

    /**
     * @param $image
     *
     * @return $this
     */
    public function setImage($image)
    {
        $this->image = $image;

        return $this;
    }

    /**
     * @return boolean
     */
    public function isEnabled()
    {
        return $this->enabled;
    }

    /**
     * @param $isActive
     *
     * @return $this
     */
    public function setEnabled($isActive)
    {
        $this->enabled = $isActive;

        return $this;
    }

    /**
     * @return ArrayCollection
     */
    public function getTranslations()
    {
        return $this->translations;
    }

    /**
     * @param $translations
     *
     * @return $this
     */
    public function setTranslations($translations)
    {
        $this->translations = $translations;

        return $this;
    }
}
