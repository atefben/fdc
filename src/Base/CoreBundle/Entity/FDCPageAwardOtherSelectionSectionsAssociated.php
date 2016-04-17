<?php

namespace Base\CoreBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * FDCPageAwardOtherSelectionSectionsAssociated
 *
 * @ORM\Table()
 * @ORM\Entity
 */
class FDCPageAwardOtherSelectionSectionsAssociated
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var FDCPageAward
     *
     * @ORM\ManyToOne(targetEntity="FDCPageAward", inversedBy="otherSelectionSectionsAssociated")
     */
    protected $FDCPageAward;

    /**
     * @var FilmSelectionSection
     *
     * @ORM\ManyToOne(targetEntity="FilmSelectionSection")
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
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set position
     *
     * @param integer $position
     * @return FDCPageAwardOtherSelectionSectionsAssociated
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

    /**
     * Set FDCPageAward
     *
     * @param FDCPageAward $fDCPageAward
     * @return FDCPageAwardOtherSelectionSectionsAssociated
     */
    public function setFDCPageAward(FDCPageAward $fDCPageAward = null)
    {
        $this->FDCPageAward = $fDCPageAward;

        return $this;
    }

    /**
     * Get FDCPageAward
     *
     * @return \Base\CoreBundle\Entity\FDCPageAward 
     */
    public function getFDCPageAward()
    {
        return $this->FDCPageAward;
    }

    /**
     * Set association
     *
     * @param FilmSelectionSection $association
     * @return FDCPageAwardOtherSelectionSectionsAssociated
     */
    public function setAssociation(FilmSelectionSection $association = null)
    {
        $this->association = $association;

        return $this;
    }

    /**
     * Get association
     *
     * @return FilmSelectionSection
     */
    public function getAssociation()
    {
        return $this->association;
    }
}
