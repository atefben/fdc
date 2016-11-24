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
 * HomepageCorporateInfosAssociated
 *
 * @ORM\Table()
 * @ORM\Entity
 * @ORM\HasLifecycleCallbacks()
 */
class HomepageCorporateInfosAssociated
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
     * @ORM\ManyToOne(targetEntity="HomepageCorporate", inversedBy="infosAssociated")
     */
    protected $homepage;

    /**
     * @var Info
     *
     * @ORM\ManyToOne(targetEntity="Info")
     */
    protected $association;

    /**
     * @var position
     *
     * @ORM\Column(type="integer", nullable=true)
     */
    private $position;

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
     * @return HomepageCorporateInfosAssociated
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
     * @param \Base\CoreBundle\Entity\Info $association
     * @return HomepageCorporateinfosAssociated
     */
    public function setAssociation(\Base\CoreBundle\Entity\Info $association = null)
    {
        $this->association = $association;

        return $this;
    }

    /**
     * Get association
     *
     * @return \Base\CoreBundle\Entity\Info
     */
    public function getAssociation()
    {
        return $this->association;
    }

    /**
     * Set position
     *
     * @param integer $position
     * @return HomepageCorporateInfosAssociated
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
