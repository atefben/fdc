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
     * @ORM\Column(name="procedure_link", type="string", length=122, nullable=true)
     */
    protected $procedureLink;


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

    public function __toString() {
        if (is_object($this->getTranslations()->first())) {
            $string = $this->getTranslations()->first()->getTitle();
        }
        else {
            $string = substr(strrchr(get_class($this), '\\'), 1);
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
}
