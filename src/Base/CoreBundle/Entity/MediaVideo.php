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
 * @ORM\Entity(repositoryClass="Base\CoreBundle\Repository\MediaVideoRepository")
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
     * @var WebTv
     *
     * @ORM\ManyToOne(targetEntity="WebTv", inversedBy="mediaVideos")
     */
    private $webTv;

    /**
     * @var Media
     *
     * @ORM\ManyToOne(targetEntity="MediaImage", cascade={"persist"})
     *
     * @Groups({"trailer_list", "trailer_show", "web_tv_list", "web_tv_show"})
     */
    private $image;

    /**
     * @ORM\oneToMany(targetEntity="MediaVideoFilmFilmAssociated", mappedBy="mediaVideo", cascade={"persist"})
     *
     * @Groups({"trailer_list", "trailer_show"})
     */
    private $associatedFilms;

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
     * @param \Base\CoreBundle\Entity\MediaImage $image
     * @return MediaVideo
     */
    public function setImage(\Base\CoreBundle\Entity\MediaImage $image = null)
    {
        $this->image = $image;

        return $this;
    }

    /**
     * Get image
     *
     * @return \Base\CoreBundle\Entity\MediaImage 
     */
    public function getImage()
    {
        return $this->image;
    }


    /**
     * Add associatedFilms
     *
     * @param \Base\CoreBundle\Entity\MediaVideoFilmFilmAssociated $associatedFilms
     * @return MediaVideo
     */
    public function addAssociatedFilm(\Base\CoreBundle\Entity\MediaVideoFilmFilmAssociated $associatedFilms)
    {
        $associatedFilms->setMediaVideo($this);
        $this->associatedFilms[] = $associatedFilms;

        return $this;
    }

    /**
     * Remove associatedFilms
     *
     * @param \Base\CoreBundle\Entity\MediaVideoFilmFilmAssociated $associatedFilms
     */
    public function removeAssociatedFilm(\Base\CoreBundle\Entity\MediaVideoFilmFilmAssociated $associatedFilms)
    {
        $this->associatedFilms->removeElement($associatedFilms);
    }

    /**
     * Get associatedFilms
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getAssociatedFilms()
    {
        return $this->associatedFilms;
    }
}
