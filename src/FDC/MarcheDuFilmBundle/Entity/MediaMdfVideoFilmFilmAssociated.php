<?php

namespace FDC\MarcheDuFilmBundle\Entity;

use \DateTime;

use A2lix\I18nDoctrineBundle\Doctrine\ORM\Util\Translatable;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

use Base\CoreBundle\Util\Time;

use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Validator\Constraints as Assert;

use JMS\Serializer\Annotation\Groups;

/**
 * MediaMdfVideoFilmFilmAssociated
 *
 * @ORM\Table()
 * @ORM\Entity
 * @ORM\HasLifecycleCallbacks()
 */
class MediaMdfVideoFilmFilmAssociated
{
    use Time;

    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @var MediaMdfVideo
     *
     * @ORM\ManyToOne(targetEntity="MediaMdfVideo", inversedBy="associatedFilms")
     * @Groups({
     *  "film_show"
     * })
     */
    protected $mediaVideo;

    /**
     * @var \Base\CoreBundle\Entity\FilmFilm
     *
     * @ORM\ManyToOne(targetEntity="\Base\CoreBundle\Entity\FilmFilm", inversedBy="associatedMediaVideos")
     */
    protected $association;

    public function __toString() {
        $string = substr(strrchr(get_class($this), '\\'), 1);

        if ($this->getId()) {
            $string .= ' #'. $this->getId();
        }

        return $string;
    }

    /**
     * Constructor
     */
    public function __construct()
    {
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
     * Set mediaVideo
     *
     * @param \FDC\MarcheDuFilmBundle\Entity\MediaMdfVideo $mediaVideo
     * @return MediaMdfVideoFilmFilmAssociated
     */
    public function setMediaVideo(\FDC\MarcheDuFilmBundle\Entity\MediaMdfVideo $mediaVideo = null)
    {
        $this->mediaVideo = $mediaVideo;

        return $this;
    }

    /**
     * Get mediaVideo
     *
     * @return \FDC\MarcheDuFilmBundle\Entity\MediaMdfVideo
     */
    public function getMediaVideo()
    {
        return $this->mediaVideo;
    }

    /**
     * Set association
     *
     * @param \Base\CoreBundle\Entity\FilmFilm $association
     * @return MediaMdfVideoFilmFilmAssociated
     */
    public function setAssociation(\Base\CoreBundle\Entity\FilmFilm $association = null)
    {
        $this->association = $association;

        return $this;
    }

    /**
     * Get association
     *
     * @return \Base\CoreBundle\Entity\FilmFilm 
     */
    public function getAssociation()
    {
        return $this->association;
    }
}
