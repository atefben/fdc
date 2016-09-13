<?php

namespace Base\CoreBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * OldFicheFilmOrangeAssociation
 *
 * @ORM\Table(name="old_fiche_film_orange_association")
 * @ORM\Entity
 */
class OldFicheFilmOrangeAssociation
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     */
    private $id;

    /**
     * @var integer
     *
     * @ORM\Column(name="object_id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     */
    private $objectId;

    /**
     * @var string
     *
     * @ORM\Column(name="object_class", type="string", length=255, nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     */
    private $objectClass;

    /**
     * @var integer
     *
     * @ORM\Column(name="order", type="integer", nullable=false)
     */
    private $order;



    /**
     * Set id
     *
     * @param integer $id
     * @return OldFicheFilmOrangeAssociation
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
     * @return OldFicheFilmOrangeAssociation
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
     * @return OldFicheFilmOrangeAssociation
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
     * @return OldFicheFilmOrangeAssociation
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
