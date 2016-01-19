<?php

namespace Base\CoreBundle\Entity;

use A2lix\I18nDoctrineBundle\Doctrine\ORM\Util\Translatable;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

use JMS\Serializer\Annotation\Groups;
use JMS\Serializer\Annotation\Since;

/**
 * MediaVideo
 *
 * @ORM\Table()
 * @ORM\Entity
 * @ORM\HasLifecycleCallbacks()
 */
class MediaVideo extends Media
{
    use Translatable;

    /**
     * @var boolean
     *
     * @ORM\Column(type="boolean", nullable=false, options={"default":0})
     */
    private $inAllVideos;

    /**
     * @var boolean
     *
     * @ORM\Column(type="boolean", nullable=false, options={"default":0})
     */
    private $displayedWebTv;

    /**
     * @var boolean
     *
     * @ORM\Column(type="boolean", nullable=false, options={"default":0})
     */
    private $displayedTrailer;

    /**
     * @var Homepage
     *
     * @ORM\ManyToOne(targetEntity="Homepage", inversedBy="topVideos")
     */
    private $homepage;

    /**
     * @var FilmFilm
     *
     * @ORM\ManyToOne(targetEntity="FilmFilm", inversedBy="mediaVideos")
     */
    private $film;

    /**
     * @var WebTv
     *
     * @ORM\ManyToOne(targetEntity="WebTv", inversedBy="mediaVideos")
     */
    private $webTv;

    /**
     * @var Media
     *
     * @ORM\ManyToOne(targetEntity="\Application\Sonata\MediaBundle\Entity\Media", cascade={"persist"})
     *
     * @Groups({"trailer_list", "trailer_show", "web_tv_list", "web_tv_show"})
     */
    private $image;

    /**
     * @var FilmFestival
     *
     * @ORM\ManyToOne(targetEntity="FilmFestival", inversedBy="mediaVideos")
     * @ORM\JoinColumn(nullable=false)
     *
     * @Groups({"trailer_list", "trailer_show"})
     *
     */
    private $festival;

    /**
     * Constructor
     */
    public function __construct()
    {
    }

    /**
     * Set inAllVideos
     *
     * @param boolean $inAllVideos
     * @return MediaVideo
     */
    public function setInAllVideos($inAllVideos)
    {
        $this->inAllVideos = $inAllVideos;

        return $this;
    }

    /**
     * Get inAllVideos
     *
     * @return boolean 
     */
    public function getInAllVideos()
    {
        return $this->inAllVideos;
    }

    /**
     * Set displayedWebTv
     *
     * @param boolean $displayedWebTv
     * @return MediaVideo
     */
    public function setDisplayedWebTv($displayedWebTv)
    {
        $this->displayedWebTv = $displayedWebTv;

        return $this;
    }

    /**
     * Get displayedWebTv
     *
     * @return boolean 
     */
    public function getDisplayedWebTv()
    {
        return $this->displayedWebTv;
    }

    /**
     * Set displayedTrailer
     *
     * @param boolean $displayedTrailer
     * @return MediaVideo
     */
    public function setDisplayedTrailer($displayedTrailer)
    {
        $this->displayedTrailer = $displayedTrailer;

        return $this;
    }

    /**
     * Get displayedTrailer
     *
     * @return boolean 
     */
    public function getDisplayedTrailer()
    {
        return $this->displayedTrailer;
    }

    /**
     * Set homepage
     *
     * @param \Base\CoreBundle\Entity\Homepage $homepage
     * @return MediaVideo
     */
    public function setHomepage(\Base\CoreBundle\Entity\Homepage $homepage = null)
    {
        $this->homepage = $homepage;

        return $this;
    }

    /**
     * Get homepage
     *
     * @return \Base\CoreBundle\Entity\Homepage 
     */
    public function getHomepage()
    {
        return $this->homepage;
    }

    /**
     * Set film
     *
     * @param \Base\CoreBundle\Entity\FilmFilm $film
     * @return MediaVideo
     */
    public function setFilm(\Base\CoreBundle\Entity\FilmFilm $film = null)
    {
        $this->film = $film;

        return $this;
    }

    /**
     * Get film
     *
     * @return \Base\CoreBundle\Entity\FilmFilm 
     */
    public function getFilm()
    {
        return $this->film;
    }

    /**
     * Set webTv
     *
     * @param \Base\CoreBundle\Entity\WebTv $webTv
     * @return MediaVideo
     */
    public function setWebTv(\Base\CoreBundle\Entity\WebTv $webTv = null)
    {
        $this->webTv = $webTv;

        return $this;
    }

    /**
     * Get webTv
     *
     * @return \Base\CoreBundle\Entity\WebTv 
     */
    public function getWebTv()
    {
        return $this->webTv;
    }

    /**
     * Set image
     *
     * @param \Application\Sonata\MediaBundle\Entity\Media $image
     * @return MediaVideo
     */
    public function setImage(\Application\Sonata\MediaBundle\Entity\Media $image = null)
    {
        $this->image = $image;

        return $this;
    }

    /**
     * Get image
     *
     * @return \Application\Sonata\MediaBundle\Entity\Media 
     */
    public function getImage()
    {
        return $this->image;
    }

    /**
     * Set festival
     *
     * @param \Base\CoreBundle\Entity\FilmFestival $festival
     * @return MediaVideo
     */
    public function setFestival(\Base\CoreBundle\Entity\FilmFestival $festival)
    {
        $this->festival = $festival;

        return $this;
    }

    /**
     * Get festival
     *
     * @return \Base\CoreBundle\Entity\FilmFestival 
     */
    public function getFestival()
    {
        return $this->festival;
    }

}
