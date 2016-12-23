<?php

namespace Base\CoreBundle\Entity;

use A2lix\I18nDoctrineBundle\Doctrine\ORM\Util\Translatable;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Base\CoreBundle\Interfaces\TranslateMainInterface;
use Base\CoreBundle\Util\TranslateMain;
use Base\CoreBundle\Util\Time;
use Base\CoreBundle\Util\SeoMain;

/**
 * PressAccredit
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Base\CoreBundle\Repository\TranslationRepository")
 * @ORM\HasLifecycleCallbacks()
 */
class PressAccredit implements TranslateMainInterface
{
    use Time;
    use Translatable;
    use TranslateMain;
    use SeoMain;

    /**
     * @var integer
     *
     * @ORM\Column(type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    protected $id;

    /**
     * @var PressAccreditProcedure
     *
     * @ORM\OneToMany(targetEntity="PressAccreditHasProcedure", mappedBy="accredit", cascade={"persist"}, orphanRemoval=true)
     */
    protected $procedure;

    /**
     * @var boolean
     *
     * @ORM\Column(type="boolean", options={"default":0})
     */
    protected $hideCommonContent;

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
        $this->procedure = new ArrayCollection();
    }

    public function __toString() {

        $string = substr(strrchr(get_class($this), '\\'), 1);

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
     * Add procedure
     *
     * @param \Base\CoreBundle\Entity\PressAccreditHasProcedure $procedure
     * @return PressAccredit
     */
    public function addProcedure(\Base\CoreBundle\Entity\PressAccreditHasProcedure $procedure)
    {
        $procedure->setAccredit($this);
        $this->procedure->add($procedure);

    }

    /**
     * Remove procedure
     *
     * @param \Base\CoreBundle\Entity\PressAccreditHasProcedure $procedure
     */
    public function removeProcedure(\Base\CoreBundle\Entity\PressAccreditHasProcedure $procedure)
    {
        $this->procedure->removeElement($procedure);
    }

    /**
     * Get procedure
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getProcedure()
    {
        return $this->procedure;
    }


    /**
     * Set hideCommonContent
     *
     * @param boolean $hideCommonContent
     * @return PressAccredit
     */
    public function setHideCommonContent($hideCommonContent)
    {
        $this->hideCommonContent = $hideCommonContent;

        return $this;
    }

    /**
     * Get hideCommonContent
     *
     * @return boolean 
     */
    public function getHideCommonContent()
    {
        return $this->hideCommonContent;
    }
}
