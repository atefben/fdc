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
class CorpoTeamMembersGroupAssociation
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
     * @ORM\ManyToOne(targetEntity="CorpoTeamMembersWidgetGroup", inversedBy="members")
     */
    protected $widgetGroup;

    /**
     * @var integer
     * @Gedmo\SortablePosition
     * @ORM\Column(name="position", type="integer")
     */
    protected $position;

    /**
     *
     * @ORM\ManyToOne(targetEntity="CorpoTeamMembers")
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
     * @return CorpoTeamMembersGroupAssociation
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
     * Set widgetGroup
     *
     * @param \Base\CoreBundle\Entity\CorpoTeamMembersWidgetGroup $widgetGroup
     * @return CorpoTeamMembersGroupAssociation
     */
    public function setWidgetGroup(\Base\CoreBundle\Entity\CorpoTeamMembersWidgetGroup $widgetGroup = null)
    {
        $this->widgetGroup = $widgetGroup;

        return $this;
    }

    /**
     * Get widgetGroup
     *
     * @return \Base\CoreBundle\Entity\CorpoTeamMembersWidgetGroup 
     */
    public function getWidgetGroup()
    {
        return $this->widgetGroup;
    }

    /**
     * Set members
     *
     * @param \Base\CoreBundle\Entity\CorpoTeamMembers $members
     * @return CorpoTeamMembersGroupAssociation
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
