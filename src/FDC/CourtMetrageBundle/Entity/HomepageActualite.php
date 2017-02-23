<?php

namespace FDC\CourtMetrageBundle\Entity;

use Symfony\Component\Validator\Constraints as Assert;
use A2lix\I18nDoctrineBundle\Doctrine\ORM\Util\Translatable;
use Doctrine\Common\Collections\ArrayCollection;
use Base\CoreBundle\Entity\MediaImage;
use Doctrine\ORM\Mapping as ORM;
use Base\CoreBundle\Entity\Theme;
use \DateTime;

/**
 * HomepageActualite
 * @ORM\Table(name="ccm_homepage_actualite")
 * @ORM\Entity
 */
class HomepageActualite
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
     * @var datetime
     *
     * @ORM\Column(type="datetime", nullable=false)
     */
    protected $date;

    /**
     * @var MediaImage
     * @ORM\ManyToOne(targetEntity="Base\CoreBundle\Entity\MediaImage", inversedBy="homepageActualites")
     * @ORM\JoinColumn(name="image_id", referencedColumnName="id")
     */
    protected $image;

    /**
     * @var ArrayCollection
     */
    protected $translations;

    /**
     * @var Theme
     *
     * @ORM\ManyToOne(targetEntity="Base\CoreBundle\Entity\Theme", inversedBy="homepageActualites")
     * @ORM\JoinColumn(name="theme_id", referencedColumnName="id", nullable=true)
     *
     */
    protected $theme;

    /**
     * @ORM\ManyToOne(targetEntity="Homepage", inversedBy="actualites")
     * @ORM\JoinColumn(name="homepage_id", referencedColumnName="id", onDelete="SET NULL")
     */
    protected $homepage;

    /**
     * HomepageActualite constructor.
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
     * Get image.
     *
     * @return MediaImage
     */
    public function getImage()
    {
        return $this->image;
    }

    /**
     * Set iamge.
     *
     * @param MediaImage $image
     */
    public function setImage($image)
    {
        $this->image = $image;

        return $this;
    }

    /**
     * Get translations.
     *
     * @return ArrayCollection
     */
    public function getTranslations()
    {
        return $this->translations;
    }

    /**
     * Set translations.
     *
     * @param ArrayCollection $translations
     */
    public function setTranslations($translations)
    {
        $this->translations = $translations;

        return $this;
    }

    /**
     * Get theme.
     *
     * @return Theme
     */
    public function getTheme()
    {
        return $this->theme;
    }

    /**
     * Set theme.
     *
     * @param Theme $theme
     */
    public function setTheme($theme)
    {
        $this->theme = $theme;

        return $this;
    }

    /**
     * Get homepage.
     *
     * @return mixed
     */
    public function getHomepage()
    {
        return $this->homepage;
    }

    /**
     * Set homepage.
     *
     * @param mixed $homepage
     */
    public function setHomepage($homepage)
    {
        $this->homepage = $homepage;
    }

    /**
     * Get date.
     *
     * @return DateTime
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * Set Date.
     *
     * @param DateTime $date
     */
    public function setDate($date)
    {
        $this->date = $date;

        return $this;
    }

}
