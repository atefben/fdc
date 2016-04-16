<?php

namespace Base\CoreBundle\Entity;

use \DateTime;

use A2lix\I18nDoctrineBundle\Doctrine\ORM\Util\Translatable;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

use Base\CoreBundle\Util\Time;

use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * StatementFilmProjectionAssociated
 *
 * @ORM\Table()
 * @ORM\Entity
 * @ORM\HasLifecycleCallbacks()
 */
class StatementFilmProjectionAssociated
{
    use Time;

    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @var Statement
     *
     * @ORM\ManyToOne(targetEntity="Statement", inversedBy="associatedProjections")
     */
    protected $statement;

    /**
     * @var FilmProjection
     *
     * @ORM\ManyToOne(targetEntity="FilmProjection")
     */
    protected $association;

    public function __toString() {
        $string = substr(strrchr(get_class($this), '\\'), 1);

        if ($this->getId()) {
            $string .= ' #'. $this->getId();
        }

        return $string;
    }

    /**
     * Constructor
     */
    public function __construct()
    {
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
     * Set statement
     *
     * @param \Base\CoreBundle\Entity\Statement $statement
     * @return StatementAssociatedStatement
     */
    public function setStatement(\Base\CoreBundle\Entity\Statement $statement = null)
    {
        $this->statement = $statement;

        return $this;
    }

    /**
     * Get statement
     *
     * @return \Base\CoreBundle\Entity\Statement 
     */
    public function getStatement()
    {
        return $this->statement;
    }

    /**
     * Set association
     *
     * @param \Base\CoreBundle\Entity\FilmProjection $association
     * @return StatementFilmProjectionAssociated
     */
    public function setAssociation(\Base\CoreBundle\Entity\FilmProjection $association = null)
    {
        $this->association = $association;

        return $this;
    }

    /**
     * Get association
     *
     * @return \Base\CoreBundle\Entity\FilmProjection 
     */
    public function getAssociation()
    {
        return $this->association;
    }
}
