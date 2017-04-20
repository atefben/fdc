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
class CorpoTeamDepartementsAssociation
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
     * @ORM\ManyToOne(targetEntity="CorpoTeamDepartements", inversedBy="members")
     */
    protected $departement;

    /**
     * @var integer
     * @Gedmo\SortablePosition
     * @ORM\Column(name="position", type="integer")
     */
    protected $position;

    /**
     *
     * @ORM\ManyToOne(targetEntity="CorpoTeamMembers", inversedBy="$departements")
     */
    protected $members;
    

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
     * @return CorpoTeamDepartementsAssociation
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
     * Set departement
     *
     * @param \Base\CoreBundle\Entity\CorpoTeamDepartements $departement
     * @return CorpoTeamDepartementsAssociation
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

    /**
     * Set members
     *
     * @param \Base\CoreBundle\Entity\CorpoTeamMembers $members
     * @return CorpoTeamDepartementsAssociation
     */
    public function setMembers(\Base\CoreBundle\Entity\CorpoTeamMembers $members = null)
    {
        $this->members = $members;

        return $this;
    }

    /**
     * Get members
     *
     * @return \Base\CoreBundle\Entity\CorpoTeamMembers 
     */
    public function getMembers()
    {
        return $this->members;
    }
}
