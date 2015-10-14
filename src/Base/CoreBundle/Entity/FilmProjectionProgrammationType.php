<?php

namespace Base\CoreBundle\Entity;

use Base\CoreBundle\Util\Time;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

use JMS\Serializer\Annotation\Groups;
use JMS\Serializer\Annotation\Since;
/**
 * FilmProjectionProgrammationType
 *
 * @ORM\Table()
 * @ORM\Entity
 * @ORM\HasLifecycleCallbacks
 */
class FilmProjectionProgrammationType
{
    use Time;
    
    /**
     * @var integer
     *
     * @ORM\Column(type="integer")
     * @ORM\Id
     *
     * @Groups({"projection_list", "projection_show"})
     */
    private $id;
    
    /**
     * @var integer
     *
     * @ORM\Column(type="integer", nullable=true)
     *
     * @Groups({"projection_list", "projection_show"})
     */
    private $type;

    /**
     * @var string
     *
     * @ORM\Column(type="string")
     *
     * @Groups({"projection_list", "projection_show"})
     */
    private $name;

    /**
     * Set id
     *
     * @param integer $id
     * @return FilmProjectionProgrammationType
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
     * Set type
     *
     * @param integer $type
     * @return FilmProjectionProgrammationType
     */
    public function setType($type)
    {
        $this->type = $type;

        return $this;
    }

    /**
     * Get type
     *
     * @return integer 
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * Set name
     *
     * @param string $name
     * @return FilmProjectionProgrammationType
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
