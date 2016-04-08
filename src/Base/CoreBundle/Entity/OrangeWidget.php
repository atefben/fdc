<?php

namespace Base\CoreBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

use Doctrine\Common\Collections\ArrayCollection;
use JMS\Serializer\Annotation\Groups;
use JMS\Serializer\Annotation\VirtualProperty;

/**
 * OrangeWidgetFilm
 *
 * @ORM\Table()
 * @ORM\Entity
 * @ORM\InheritanceType("JOINED")
 * @ORM\DiscriminatorColumn(name="type", type="string")
 * @ORM\DiscriminatorMap({
 *  "video_youtube" = "OrangeWidgetMovieYoutube",
 *  "film_ocs" = "OrangeWidgetFilmOCS",
 *  "film_vod" = "OrangeWidgetFilmVOD",
 *  "film_studio" = "OrangeWidgetFilmStudio",
 * })
 */
abstract class OrangeWidget
{
     
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var integer
     *
     * @ORM\ManyToOne(targetEntity="Orange", inversedBy="widgets")
     */
    private $parent;
    
    /**
     * @var integer
     *
     * @ORM\Column(type="integer", nullable=false)
     * @Groups({
     *     "orange_series_and_cie",
     *     "orange_programmation_ocs",
     *     "orange_video_on_demand"
     * })
     */
    protected $position;

    /**
     * @var ArrayCollection
     * @Groups({
     *     "orange_series_and_cie",
     *     "orange_programmation_ocs",
     *     "orange_video_on_demand"
     * })
     */
    protected $translations;
    
    public function __construct()
    {
        $this->translations = new ArrayCollection();
    }

    /**
     * Get the class type in the Api
     *
     * @VirtualProperty()
     * @Groups({
     *     "orange_series_and_cie"
     * })
     */
    public function getWidgetType()
    {
        return substr(strrchr(get_called_class(), '\\'), 1);
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
     * Set parent
     *
     * @param integer $parent
     * @return OrangeWidget
     */
    public function setParent($parent)
    {
        $this->parent = $parent;

        return $this;
    }

    /**
     * Get parent
     *
     * @return integer 
     */
    public function getParent()
    {
        return $this->parent;
    }
    
    /**
     * Set position
     *
     * @param integer $position
     * @return OrangeWidget
     */
    public function setPosition($position)
    {
        $this->position = $position;

        return $this;
    }

    /**
     * Get position
     *
     * @return integer 
     */
    public function getPosition()
    {
        return $this->position;
    }
}
