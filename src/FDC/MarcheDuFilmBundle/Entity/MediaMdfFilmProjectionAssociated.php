<?php

namespace FDC\MarcheDuFilmBundle\Entity;

use \DateTime;

use A2lix\I18nDoctrineBundle\Doctrine\ORM\Util\Translatable;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

use Base\CoreBundle\Util\Time;

use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * MediaMdfFilmProjectionAssociated
 *
 * @ORM\Table()
 * @ORM\Entity
 * @ORM\HasLifecycleCallbacks()
 */
class MediaMdfFilmProjectionAssociated
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
     * @ORM\ManyToOne(targetEntity="MediaMdf", inversedBy="associatedProjections")
     */
    protected $media;

    /**
     * @var \Base\CoreBundle\Entity\FilmProjection
     *
     * @ORM\ManyToOne(targetEntity="\Base\CoreBundle\Entity\FilmProjection")
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
     * Set association
     *
     * @param \Base\CoreBundle\Entity\FilmProjection $association
     * @return NewsFilmProjectionAssociated
     */
    public function setAssociation(\Base\CoreBundle\Entity\FilmProjection $association = null)
    {
        $this->association = $association;

        return $this;
    }

    /**
     * Get association
     *
     * @return \Base\CoreBundle\Entity\FilmProjection
     */
    public function getAssociation()
    {
        return $this->association;
    }

    /**
     * Set media
     *
     * @param \FDC\MarcheDuFilmBundle\Entity\MediaMdf $media
     * @return MediaMdfFilmProjectionAssociated
     */
    public function setMedia(\FDC\MarcheDuFilmBundle\Entity\MediaMdf $media = null)
    {
        $this->media = $media;

        return $this;
    }

    /**
     * Get media
     *
     * @return \FDC\MarcheDuFilmBundle\Entity\MediaMdf
     */
    public function getMedia()
    {
        return $this->media;
    }
}
