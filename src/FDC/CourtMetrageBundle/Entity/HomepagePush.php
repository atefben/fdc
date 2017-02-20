<?php

namespace FDC\CourtMetrageBundle\Entity;

use Symfony\Component\Validator\Constraints as Assert;
use A2lix\I18nDoctrineBundle\Doctrine\ORM\Util\Translatable;
use Doctrine\Common\Collections\ArrayCollection;
use Base\CoreBundle\Entity\MediaImage;
use Doctrine\ORM\Mapping as ORM;

/**
 * HomepagePush
 * @ORM\Table(name="ccm_homepage_push")
 * @ORM\Entity
 */
class HomepagePush
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
     * @ORM\ManyToOne(targetEntity="Base\CoreBundle\Entity\MediaImage", inversedBy="homepagePushes")
     * @ORM\JoinColumn(name="image_id", referencedColumnName="id")
     */
    protected $image;

    /**
     * @var ArrayCollection
     */
    protected $translations;

    /**
     * @ORM\ManyToOne(targetEntity="Homepage", inversedBy="pushes")
     * @ORM\JoinColumn(name="homepage_id", referencedColumnName="id", onDelete="SET NULL")
     */
    protected $homepage;

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
     * @return MediaImage
     */
    public function getImage()
    {
        return $this->image;
    }

    /**
     * Set Image.
     *
     * @param MediaImage $image
     *
     * @return $this
     */
    public function setImage($image)
    {
        $this->image = $image;

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
     * Get Homepage.
     *
     * @return mixed
     */
    public function getHomepage()
    {
        return $this->homepage;
    }

    /**
     * Set Homepage.
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
}
