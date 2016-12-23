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
 * HomepageCorporateStatementsAssociated
 *
 * @ORM\Table()
 * @ORM\Entity
 * @ORM\HasLifecycleCallbacks()
 */
class HomepageCorporateStatementsAssociated
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
     * @var HomepageCorporate
     *
     * @ORM\ManyToOne(targetEntity="HomepageCorporate", inversedBy="statementsAssociated")
     */
    protected $homepage;

    /**
     * @var Statement
     *
     * @ORM\ManyToOne(targetEntity="Statement")
     */
    protected $association;

    /**
     * @var position
     *
     * @ORM\Column(type="integer", nullable=true)
     */
    protected $position;

    public function __toString() {
        $string = substr(strrchr(get_class($this), '\\'), 1);

        if ($this->getId()) {
            $string .= ' #'. $this->getId();
        }

        return $string;
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
     * Set homepage
     *
     * @param \Base\CoreBundle\Entity\HomepageCorporate $homepage
     * @return HomepageCorporateStatementsAssociated
     */
    public function setHomepage(\Base\CoreBundle\Entity\HomepageCorporate $homepage = null)
    {
        $this->homepage = $homepage;

        return $this;
    }

    /**
     * Get homepage
     *
     * @return \Base\CoreBundle\Entity\HomepageCorporate
     */
    public function getHomepage()
    {
        return $this->homepage;
    }

    /**
     * Set association
     *
     * @param \Base\CoreBundle\Entity\Statement $association
     * @return HomepageCorporateStatementsAssociated
     */
    public function setAssociation(\Base\CoreBundle\Entity\Statement $association = null)
    {
        $this->association = $association;

        return $this;
    }

    /**
     * Get association
     *
     * @return \Base\CoreBundle\Entity\Statement
     */
    public function getAssociation()
    {
        return $this->association;
    }

    /**
     * Set position
     *
     * @param integer $position
     * @return HomepageCorporateStatementsAssociated
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
}
