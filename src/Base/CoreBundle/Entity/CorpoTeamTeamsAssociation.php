<?php

namespace Base\CoreBundle\Entity;

use Gedmo\Mapping\Annotation as Gedmo;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

use Base\CoreBundle\Util\Time;

/**
 * CorpoTeamMembersGroupAssociation
 *
 * @ORM\Table()
 * @ORM\Entity
 * @ORM\HasLifecycleCallbacks()
 */
class CorpoTeamTeamsAssociation
{
    use Time;

    /**
     * @var integer
     *
     * @ORM\Column(type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    protected $id;

    /**
     *
     * @ORM\ManyToOne(targetEntity="CorpoTeamTeams", inversedBy="departement")
     */
    protected $teamTeams;

    /**
     * @var integer
     * @Gedmo\SortablePosition
     * @ORM\Column(name="position", type="integer")
     */
    protected $position;

    /**
     *
     * @ORM\ManyToOne(targetEntity="CorpoTeamDepartements")
     */
    protected $departement;


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
     * Set position
     *
     * @param integer $position
     * @return CorpoTeamTeamsAssociation
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

    /**
     * Set teamTeams
     *
     * @param \Base\CoreBundle\Entity\CorpoTeamTeams $teamTeams
     * @return CorpoTeamTeamsAssociation
     */
    public function setTeamTeams(\Base\CoreBundle\Entity\CorpoTeamTeams $teamTeams = null)
    {
        $this->teamTeams = $teamTeams;

        return $this;
    }

    /**
     * Get teamTeams
     *
     * @return \Base\CoreBundle\Entity\CorpoTeamTeams 
     */
    public function getTeamTeams()
    {
        return $this->teamTeams;
    }

    /**
     * Set departement
     *
     * @param \Base\CoreBundle\Entity\CorpoTeamDepartements $departement
     * @return CorpoTeamTeamsAssociation
     */
    public function setDepartement(\Base\CoreBundle\Entity\CorpoTeamDepartements $departement = null)
    {
        $this->departement = $departement;

        return $this;
    }

    /**
     * Get departement
     *
     * @return \Base\CoreBundle\Entity\CorpoTeamDepartements 
     */
    public function getDepartement()
    {
        return $this->departement;
    }
}
