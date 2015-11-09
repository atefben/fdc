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
 * InfoInfoAssociated
 *
 * @ORM\Table()
 * @ORM\Entity
 * @ORM\HasLifecycleCallbacks()
 */
class InfoInfoAssociated
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
     * @var Info
     *
     * @ORM\ManyToOne(targetEntity="Info", inversedBy="associations")
     */
    protected $info;

    /**
     * @var Info
     *
     * @ORM\ManyToOne(targetEntity="Info")
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
     * Set info
     *
     * @param \Base\CoreBundle\Entity\Info $info
     * @return InfoInfoAssociated
     */
    public function setInfo(\Base\CoreBundle\Entity\Info $info = null)
    {
        $this->info = $info;

        return $this;
    }

    /**
     * Get info
     *
     * @return \Base\CoreBundle\Entity\Info 
     */
    public function getInfo()
    {
        return $this->info;
    }

    /**
     * Set association
     *
     * @param \Base\CoreBundle\Entity\Info $association
     * @return InfoInfoAssociated
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
}
