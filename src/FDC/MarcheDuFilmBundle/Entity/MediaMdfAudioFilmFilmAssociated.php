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
 * MediaMdfAudioFilmFilmAssociated
 *
 * @ORM\Table()
 * @ORM\Entity
 * @ORM\HasLifecycleCallbacks()
 */
class MediaMdfAudioFilmFilmAssociated
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
     * @var News
     *
     * @ORM\ManyToOne(targetEntity="MediaMdfAudio", inversedBy="associatedFilms")
     * @Groups("film_show")
     */
    protected $mediaAudio;

    /**
     * @var FilmFilm
     *
     * @ORM\ManyToOne(targetEntity="\Base\CoreBundle\Entity\FilmFilm", inversedBy="associatedMediaAudios")
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
     * Set mediaAudio
     *
     * @param \FDC\MarcheDuFilmBundle\Entity\MediaMdfAudio $mediaAudio
     * @return MediaMdfAudioFilmFilmAssociated
     */
    public function setMediaAudio(\FDC\MarcheDuFilmBundle\Entity\MediaMdfAudio $mediaAudio = null)
    {
        $this->mediaAudio= $mediaAudio;

        return $this;
    }

    /**
     * Get mediaAudio
     *
     * @return \FDC\MarcheDuFilmBundle\Entity\MediaMdfAudio
     */
    public function getMediaAudio()
    {
        return $this->mediaAudio;
    }

    /**
     * Set association
     *
     * @param \Base\CoreBundle\Entity\FilmFilm $association
     * @return MediaMdfAudioFilmFilmAssociated
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
