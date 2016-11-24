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
class CorpoTeamsAssociation
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
     * @ORM\ManyToOne(targetEntity="CorpoTeam", inversedBy="teams")
     */
    protected $team;

    /**
     * @var integer
     * @Gedmo\SortablePosition
     * @ORM\Column(name="position", type="integer")
     */
    protected $position;

    /**
     *
     * @ORM\ManyToOne(targetEntity="CorpoTeamTeams")
     */
    protected $teams;

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
     * @return CorpoTeamsAssociation
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
     * Set team
     *
     * @param \Base\CoreBundle\Entity\CorpoTeam $team
     * @return CorpoTeamsAssociation
     */
    public function setTeam(\Base\CoreBundle\Entity\CorpoTeam $team = null)
    {
        $this->team = $team;

        return $this;
    }

    /**
     * Get team
     *
     * @return \Base\CoreBundle\Entity\CorpoTeam 
     */
    public function getTeam()
    {
        return $this->team;
    }

    /**
     * Set teams
     *
     * @param \Base\CoreBundle\Entity\CorpoTeamTeams $teams
     * @return CorpoTeamsAssociation
     */
    public function setTeams(\Base\CoreBundle\Entity\CorpoTeamTeams $teams = null)
    {
        $this->teams = $teams;

        return $this;
    }

    /**
     * Get teams
     *
     * @return \Base\CoreBundle\Entity\CorpoTeamTeams 
     */
    public function getTeams()
    {
        return $this->teams;
    }
}
