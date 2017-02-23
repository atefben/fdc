<?php

namespace FDC\CourtMetrageBundle\Entity;

use Symfony\Component\Validator\Constraints as Assert;
use A2lix\I18nDoctrineBundle\Doctrine\ORM\Util\Translatable;
use Doctrine\Common\Collections\ArrayCollection;
use Base\CoreBundle\Entity\MediaImage;
use Doctrine\ORM\Mapping as ORM;

/**
 * HomepageSejour
 * @ORM\Table(name="ccm_homepage_sejour")
 * @ORM\Entity
 */
class HomepageSejour
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
     * @ORM\ManyToOne(targetEntity="Base\CoreBundle\Entity\MediaImage", inversedBy="homepageSejoures")
     * @ORM\JoinColumn(name="image_id", referencedColumnName="id")
     */
    protected $image;

    /**
     * @var ArrayCollection
     */
    protected $translations;

    /**
     * @ORM\ManyToOne(targetEntity="Homepage", inversedBy="sejoures")
     * @ORM\JoinColumn(name="homepage_id", referencedColumnName="id", onDelete="SET NULL")
     */
    protected $homepage;

    /**
     * HomepageSejour constructor.
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
     * Set image.
     *
     * @param MediaImage $image
     */
    public function setImage($image)
    {
        $this->image = $image;

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
     * Set translations
     *
     * @param ArrayCollection $translations
     */
    public function setTranslations($translations)
    {
        $this->translations = $translations;

        return $this;
    }
}
