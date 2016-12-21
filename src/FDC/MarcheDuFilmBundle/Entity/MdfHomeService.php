<?php

namespace FDC\MarcheDuFilmBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use A2lix\I18nDoctrineBundle\Doctrine\ORM\Util\Translatable;
use Application\Sonata\MediaBundle\Entity\Media;
use Doctrine\ORM\Mapping as ORM;

/**
 * MdfHomeService
 * @ORM\Table(name="mdf_home_service")
 * @ORM\Entity
 */
class MdfHomeService
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
     * @ORM\ManyToOne(targetEntity="MdfHomepage", inversedBy="services")
     * @ORM\JoinColumn(name="homepage_id", referencedColumnName="id")
     */
    protected $homepage;

    /**
     * @var ArrayCollection
     */
    protected $translations;

    /**
     * MdfHomeServices constructor.
     *
     * @param ArrayCollection $translations
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
