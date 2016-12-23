<?php

namespace Base\CoreBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * OldMediaAssociation
 *
 * @ORM\Table(name="old_media_association", indexes={@ORM\Index(name="object_id", columns={"object_id"}), @ORM\Index(name="object_class", columns={"object_class"})})
 * @ORM\Entity
 */
class OldMediaAssociation
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
     * @var string
     *
     * @ORM\Column(name="object_id", type="string", length=36, nullable=false)
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
     * @var integer
     *
     * @ORM\Column(name="order", type="integer", nullable=false)
     */
    protected $order;



    /**
     * Set id
     *
     * @param integer $id
     * @return OldMediaAssociation
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
     * @param string $objectId
     * @return OldMediaAssociation
     */
    public function setObjectId($objectId)
    {
        $this->objectId = $objectId;

        return $this;
    }

    /**
     * Get objectId
     *
     * @return string 
     */
    public function getObjectId()
    {
        return $this->objectId;
    }

    /**
     * Set objectClass
     *
     * @param string $objectClass
     * @return OldMediaAssociation
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
     * Set order
     *
     * @param integer $order
     * @return OldMediaAssociation
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
