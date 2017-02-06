<?php

namespace FDC\MarcheDuFilmBundle\Entity;

use A2lix\I18nDoctrineBundle\Doctrine\ORM\Util\Translatable;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * MdfConferenceInfoAndContactWidget
 * @ORM\Table(name="mdf_conference_info_and_contact_widget")
 * @ORM\Entity
 */
class MdfConferenceInfoAndContactWidget
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
     * @var MediaMdf
     *
     * @ORM\ManyToOne(targetEntity="FDC\MarcheDuFilmBundle\Entity\MediaMdfImage", inversedBy="infoAndContact")
     * @ORM\JoinColumn(name="image_id", referencedColumnName="id", onDelete="SET NULL")
     */
    protected $image;

    /**
     * @var integer
     *
     * @ORM\Column(type="integer", nullable=true)
     */
    protected $position;

    /**
     * @ORM\ManyToOne(targetEntity="MdfConferenceInfoAndContact", inversedBy="conferenceInfoAndContactWidgets")
     * @ORM\JoinColumn(name="conference_info_and_contact_id", referencedColumnName="id")
     */
    protected $conferenceInfoAndContact;

    /**
     * @var ArrayCollection
     */
    protected $translations;

    /**
     * HeaderFooter constructor.
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
     * @return MediaMdf
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
     * @return int
     */
    public function getPosition()
    {
        return $this->position;
    }

    /**
     * @param $position
     *
     * @return $this
     */
    public function setPosition($position)
    {
        $this->position = $position;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getConferenceInfoAndContact()
    {
        return $this->conferenceInfoAndContact;
    }

    /**
     * @param $conferenceInfoAndContact
     *
     * @return $this
     */
    public function setConferenceInfoAndContact($conferenceInfoAndContact)
    {
        $this->conferenceInfoAndContact = $conferenceInfoAndContact;

        return $this;
    }
}
