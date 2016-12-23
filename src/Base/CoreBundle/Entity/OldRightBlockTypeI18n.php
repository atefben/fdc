<?php

namespace Base\CoreBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * OldRightBlockTypeI18n
 *
 * @ORM\Table(name="old_right_block_type_i18n")
 * @ORM\Entity
 */
class OldRightBlockTypeI18n
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
     * @ORM\Column(name="culture", type="string", length=7, nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     */
    protected $culture;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=200, nullable=false)
     */
    protected $name;



    /**
     * Set id
     *
     * @param integer $id
     * @return OldRightBlockTypeI18n
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
     * Set culture
     *
     * @param string $culture
     * @return OldRightBlockTypeI18n
     */
    public function setCulture($culture)
    {
        $this->culture = $culture;

        return $this;
    }

    /**
     * Get culture
     *
     * @return string 
     */
    public function getCulture()
    {
        return $this->culture;
    }

    /**
     * Set name
     *
     * @param string $name
     * @return OldRightBlockTypeI18n
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string 
     */
    public function getName()
    {
        return $this->name;
    }
}
