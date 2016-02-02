<?php

namespace Base\CoreBundle\Entity;


use A2lix\I18nDoctrineBundle\Doctrine\ORM\Util\Translatable;

use Base\CoreBundle\Interfaces\TranslateMainInterface;
use Base\CoreBundle\Util\TranslateMain;
use Base\CoreBundle\Util\Time;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;

/**
 * PressAccreditProcedure
 *
 * @ORM\Table()
 * @ORM\Entity
 * @ORM\HasLifecycleCallbacks()
 */
class PressAccreditProcedure implements TranslateMainInterface
{

    use Time;
    use Translatable;
    use TranslateMain;

    /**
     * @var integer
     *
     * @ORM\Column(type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="procedure_link", type="string", length=255)
     */
    protected $procedureLink;

    /**
     * @var integer
     * @Gedmo\SortablePosition
     * @ORM\Column(name="position", type="integer")
     */
    protected $position;

    /**
     * @var PressAccredit
     *
     * @ORM\ManyToOne(targetEntity="PressAccredit", inversedBy="procedure")
     */
    protected $accredit;

    /**
     * ArrayCollection
     */
    protected $translations;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->translations = new ArrayCollection();
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
     * Set procedureLink
     *
     * @param string $procedureLink
     * @return PressAccreditProcedure
     */
    public function setProcedureLink($procedureLink)
    {
        $this->procedureLink = $procedureLink;

        return $this;
    }

    /**
     * Get procedureLink
     *
     * @return string 
     */
    public function getProcedureLink()
    {
        return $this->procedureLink;
    }

    /**
     * Set position
     *
     * @param integer $position
     * @return PressAccreditProcedure
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
     * Set accredit
     *
     * @param \Base\CoreBundle\Entity\PressAccredit $accredit
     * @return PressAccreditProcedure
     */
    public function setAccredit(\Base\CoreBundle\Entity\PressAccredit $accredit = null)
    {
        $this->accredit = $accredit;

        return $this;
    }

    /**
     * Get accredit
     *
     * @return \Base\CoreBundle\Entity\PressAccredit 
     */
    public function getAccredit()
    {
        return $this->accredit;
    }
}
