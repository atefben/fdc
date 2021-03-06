<?php

namespace Base\CoreBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * OldWebsiteSectionAssociation
 *
 * @ORM\Table(name="old_website_section_association", indexes={@ORM\Index(name="object_id", columns={"object_id"}), @ORM\Index(name="object_class", columns={"object_class"})})
 * @ORM\Entity
 */
class OldWebsiteSectionAssociation
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     */
    protected $id;

    /**
     * @var integer
     *
     * @ORM\Column(name="object_id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     */
    protected $objectId;

    /**
     * @var string
     *
     * @ORM\Column(name="object_class", type="string", length=255, nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     */
    protected $objectClass;

    /**
     * @var string
     *
     * @ORM\Column(name="use_for", type="string", length=20, nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     */
    protected $useFor;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="position", type="datetime", nullable=false)
     */
    protected $position;

    /**
     * @var integer
     *
     * @ORM\Column(name="order", type="integer", nullable=false)
     */
    protected $order;



    /**
     * Set id
     *
     * @param integer $id
     * @return OldWebsiteSectionAssociation
     */
    public function setId($id)
    {
        $this->id = $id;

        return $this;
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
     * Set objectId
     *
     * @param integer $objectId
     * @return OldWebsiteSectionAssociation
     */
    public function setObjectId($objectId)
    {
        $this->objectId = $objectId;

        return $this;
    }

    /**
     * Get objectId
     *
     * @return integer 
     */
    public function getObjectId()
    {
        return $this->objectId;
    }

    /**
     * Set objectClass
     *
     * @param string $objectClass
     * @return OldWebsiteSectionAssociation
     */
    public function setObjectClass($objectClass)
    {
        $this->objectClass = $objectClass;

        return $this;
    }

    /**
     * Get objectClass
     *
     * @return string 
     */
    public function getObjectClass()
    {
        return $this->objectClass;
    }

    /**
     * Set useFor
     *
     * @param string $useFor
     * @return OldWebsiteSectionAssociation
     */
    public function setUseFor($useFor)
    {
        $this->useFor = $useFor;

        return $this;
    }

    /**
     * Get useFor
     *
     * @return string 
     */
    public function getUseFor()
    {
        return $this->useFor;
    }

    /**
     * Set position
     *
     * @param \DateTime $position
     * @return OldWebsiteSectionAssociation
     */
    public function setPosition($position)
    {
        $this->position = $position;

        return $this;
    }

    /**
     * Get position
     *
     * @return \DateTime 
     */
    public function getPosition()
    {
        return $this->position;
    }

    /**
     * Set order
     *
     * @param integer $order
     * @return OldWebsiteSectionAssociation
     */
    public function setOrder($order)
    {
        $this->order = $order;

        return $this;
    }

    /**
     * Get order
     *
     * @return integer 
     */
    public function getOrder()
    {
        return $this->order;
    }
}
