<?php

namespace FDC\MarcheDuFilmBundle\Entity;

use A2lix\I18nDoctrineBundle\Doctrine\ORM\Util\Translatable;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * AccreditationWidget
 * @ORM\Table(name="mdf_accreditation_widget")
 * @ORM\Entity
 */
class AccreditationWidget
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
     * @var integer
     *
     * @ORM\Column(type="integer", nullable=true)
     */
    protected $position;

    /**
     * @ORM\ManyToOne(targetEntity="Accreditation", inversedBy="accreditationWidgets")
     * @ORM\JoinColumn(name="accreditation_id", referencedColumnName="id")
     */
    protected $accreditation;

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
    public function getAccreditation()
    {
        return $this->accreditation;
    }

    /**
     * @param $accreditation
     *
     * @return $this
     */
    public function setAccreditation($accreditation)
    {
        $this->accreditation = $accreditation;

        return $this;
    }
}
