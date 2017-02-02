<?php

namespace FDC\MarcheDuFilmBundle\Entity;

use A2lix\I18nDoctrineBundle\Doctrine\ORM\Util\Translatable;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * MdfWhoAreWeTeamContactWidget
 * @ORM\Table(name="mdf_who_are_we_team_contact_widget")
 * @ORM\Entity
 */
class MdfWhoAreWeTeamContactWidget
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
     * @ORM\ManyToOne(targetEntity="MdfWhoAreWeTeam", inversedBy="whoAreWeTeamContactWidgets")
     * @ORM\JoinColumn(name="who_are_we_team_id", referencedColumnName="id")
     */
    protected $whoAreWeTeam;

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
    public function getWhoAreWeTeam()
    {
        return $this->whoAreWeTeam;
    }

    /**
     * @param $whoAreWeTeam
     *
     * @return $this
     */
    public function setWhoAreWeTeam($whoAreWeTeam)
    {
        $this->whoAreWeTeam = $whoAreWeTeam;

        return $this;
    }
}
