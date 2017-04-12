<?php

namespace FDC\CourtMetrageBundle\Entity;

use Symfony\Component\Validator\Constraints as Assert;
use A2lix\I18nDoctrineBundle\Doctrine\ORM\Util\Translatable;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * HomepageSlider
 * @ORM\Table(name="ccm_homepage_slider")
 * @ORM\Entity
 */
class HomepageSlider
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
     * @var CcmMediaImage
     * @ORM\ManyToOne(targetEntity="FDC\CourtMetrageBundle\Entity\CcmMediaImage", inversedBy="homepageSliders")
     * @ORM\JoinColumn(name="image_id", referencedColumnName="id")
     */
    protected $image;

    /**
     * @var ArrayCollection
     */
    protected $translations;

    /**
     * @ORM\ManyToOne(targetEntity="Homepage", inversedBy="sliders")
     * @ORM\JoinColumn(name="homepage_id", referencedColumnName="id", onDelete="SET NULL")
     */
    protected $homepage;

    /**
     * @var integer
     *
     * @ORM\Column(type="integer", nullable=true)
     */
    private $position;

    /**
     * HomepageSlider constructor.
     */
    public function __construct()
    {
        $this->translations = new ArrayCollection();
    }

    /**
     * Get id.
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Get Image.
     *
     * @return CcmMediaImage
     */
    public function getImage()
    {
        return $this->image;
    }

    /**
     * Set Image.
     *
     * @param CcmMediaImage $image
     *
     * @return $this
     */
    public function setImage($image)
    {
        $this->image = $image;

        return $this;
    }

    /**
     * Get Homepage.
     *
     * @return mixed
     */
    public function getHomepage()
    {
        return $this->homepage;
    }

    /**
     * Set Homepage
     *
     * @param $homepage
     *
     * @return $this
     */
    public function setHomepage($homepage)
    {
        $this->homepage = $homepage;

        return $this;
    }

    /**
     * Get Translations.
     *
     * @return ArrayCollection
     */
    public function getTranslations()
    {
        return $this->translations;
    }

    /**
     * Set Translations.
     *
     * @param ArrayCollection $translations
     *
     * @return $this
     */
    public function setTranslations($translations)
    {
        $this->translations = $translations;

        return $this;
    }

    /**
     * @return int
     */
    public function getPosition()
    {
        return $this->position;
    }

    /**
     * @param int $position
     */
    public function setPosition($position)
    {
        $this->position = $position;
    }
}
