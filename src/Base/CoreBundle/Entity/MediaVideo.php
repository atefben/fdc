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
     * @ORM\Column(type="boolean", nullable=false)
     */
    private $inAllVideos;

    /**
     * @var boolean
     *
     * @ORM\Column(type="boolean", nullable=false)
     */
    private $inHomepage;

    /**
     * @var boolean
     *
     * @ORM\Column(type="boolean", nullable=false)
     */
    private $inWebTv;

    /**
     * @var boolean
     *
     * @ORM\Column(type="boolean", nullable=false)
     */
    private $inTrailer;

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
     * @var NewsTheme
     *
     * @ORM\ManyToOne(targetEntity="NewsTheme")
     *
     * @Groups({"trailer_list", "trailer_show"})
     */
    private $theme;

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
     * @var ArrayCollection
     * @Groups({"trailer_show", "web_tv_list", "web_tv_show"})
     */
    protected $translations;

    public function __construct()
    {
        $this->translations = new ArrayCollection();
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
     * Set inHomepage
     *
     * @param boolean $inHomepage
     * @return MediaVideo
     */
    public function setInHomepage($inHomepage)
    {
        $this->inHomepage = $inHomepage;

        return $this;
    }

    /**
     * Get inHomepage
     *
     * @return boolean 
     */
    public function getInHomepage()
    {
        return $this->inHomepage;
    }

    /**
     * Set inWebTv
     *
     * @param boolean $inWebTv
     * @return MediaVideo
     */
    public function setInWebTv($inWebTv)
    {
        $this->inWebTv = $inWebTv;

        return $this;
    }

    /**
     * Get inWebTv
     *
     * @return boolean 
     */
    public function getInWebTv()
    {
        return $this->inWebTv;
    }

    /**
     * Set inTrailer
     *
     * @param boolean $inTrailer
     * @return MediaVideo
     */
    public function setInTrailer($inTrailer)
    {
        $this->inTrailer = $inTrailer;

        return $this;
    }

    /**
     * Get inTrailer
     *
     * @return boolean 
     */
    public function getInTrailer()
    {
        return $this->inTrailer;
    }

    /**
     * Set theme
     *
     * @param \Base\CoreBundle\Entity\NewsTheme $theme
     * @return MediaVideo
     */
    public function setTheme(\Base\CoreBundle\Entity\NewsTheme $theme = null)
    {
        $this->theme = $theme;

        return $this;
    }

    /**
     * Get theme
     *
     * @return \Base\CoreBundle\Entity\NewsTheme 
     */
    public function getTheme()
    {
        return $this->theme;
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
    public function setFestival(\Base\CoreBundle\Entity\FilmFestival $festival = null)
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
