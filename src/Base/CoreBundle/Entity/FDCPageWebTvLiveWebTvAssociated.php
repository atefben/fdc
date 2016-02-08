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
 * NewsNewsAssociated
 *
 * @ORM\Table()
 * @ORM\Entity
 * @ORM\HasLifecycleCallbacks()
 */
class FDCPageWebTvLiveWebTvAssociated
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
     * @var FDCPageWebTvLive
     *
     * @ORM\ManyToOne(targetEntity="FDCPageWebTvLive", inversedBy="associatedWebTvs")
     */
    protected $fDCPageWebTvLive;
    
     /**
     * @var WebTv
     *
     * @ORM\ManyToOne(targetEntity="WebTv")
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
     * Set fDCPageWebTvLive
     *
     * @param \Base\CoreBundle\Entity\FDCPageWebTvLive $fDCPageWebTvLive
     * @return FDCPageWebTvLiveWebTvAssociated
     */
    public function setFDCPageWebTvLive(\Base\CoreBundle\Entity\FDCPageWebTvLive $fDCPageWebTvLive = null)
    {
        $this->fDCPageWebTvLive = $fDCPageWebTvLive;

        return $this;
    }

    /**
     * Get fDCPageWebTvLive
     *
     * @return \Base\CoreBundle\Entity\FDCPageWebTvLive 
     */
    public function getFDCPageWebTvLive()
    {
        return $this->fDCPageWebTvLive;
    }

    /**
     * Set association
     *
     * @param \Base\CoreBundle\Entity\WebTv $association
     * @return FDCPageWebTvLiveWebTvAssociated
     */
    public function setAssociation(\Base\CoreBundle\Entity\WebTv $association = null)
    {
        $this->association = $association;

        return $this;
    }

    /**
     * Get association
     *
     * @return \Base\CoreBundle\Entity\WebTv 
     */
    public function getAssociation()
    {
        return $this->association;
    }
}
