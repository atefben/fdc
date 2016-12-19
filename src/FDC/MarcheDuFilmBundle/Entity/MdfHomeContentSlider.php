<?php

namespace FDC\MarcheDuFilmBundle\Entity;

use Application\Sonata\MediaBundle\Entity\Media;
use A2lix\I18nDoctrineBundle\Doctrine\ORM\Util\Translatable;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * MdfHomeContentSlider
 * @ORM\Table(name="mdf_home_content_slider")
 * @ORM\Entity
 */
class MdfHomeContentSlider
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
     * @var Media
     *
     * @ORM\ManyToOne(targetEntity="Application\Sonata\MediaBundle\Entity\Media")
     * @ORM\JoinColumns({
     *     @ORM\JoinColumn(name="image", referencedColumnName="id")
     * })
     */
    protected $image;

    /**
     * @ORM\ManyToOne(targetEntity="MdfHomepage", inversedBy="contentSliders")
     * @ORM\JoinColumn(name="homepage_id", referencedColumnName="id")
     */
    protected $homepage;

    /**
     * @var ArrayCollection
     */
    protected $translations;

    /**
     * MdfHomeContentSlider constructor.
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
     * @return Media
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
     * @return mixed
     */
    public function getHomepage()
    {
        return $this->homepage;
    }

    /**
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