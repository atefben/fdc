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
    protected $FDCPageWebTvLive;
    
     /**
     * @var WebTv
     *
     * @ORM\ManyToOne(targetEntity="WebTv", inversedBy="associatedWebTvs")
     */
    protected $association;

    /**
     * @var integer
     *
     * @ORM\Column(type="integer", nullable=true)
     */
    private $position = 0;
    
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
     * Set FDCPageWebTvLive
     *
     * @param \Base\CoreBundle\Entity\FDCPageWebTvLive $FDCPageWebTvLive
     * @return FDCPageWebTvLiveWebTvAssociated
     */
    public function setFDCPageWebTvLive(\Base\CoreBundle\Entity\FDCPageWebTvLive $FDCPageWebTvLive = null)
    {
        $this->FDCPageWebTvLive = $FDCPageWebTvLive;

        return $this;
    }

    /**
     * Get FDCPageWebTvLive
     *
     * @return \Base\CoreBundle\Entity\FDCPageWebTvLive 
     */
    public function getFDCPageWebTvLive()
    {
        return $this->FDCPageWebTvLive;
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

    /**
     * Set position
     *
     * @param integer $position
     * @return FDCPageWebTvLiveWebTvAssociated
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
