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
class CorpoAccredit implements TranslateMainInterface
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
     * @ORM\ManyToOne(targetEntity="MediaImageSimple")
     */
    protected $mainImage;

    /**
     * @var CorpoAccreditProcedure
     *
     * @ORM\OneToMany(targetEntity="CorpoAccreditHasProcedure", mappedBy="accredit", cascade={"persist"}, orphanRemoval=true)
     * @ORM\OrderBy({"position" = "ASC"})
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
        return 'S\'accréditer';
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
     * @param \Base\CoreBundle\Entity\CorpoAccreditHasProcedure $procedure
     * @return CorpoAccredit
     */
    public function addProcedure(\Base\CoreBundle\Entity\CorpoAccreditHasProcedure $procedure)
    {
        $procedure->setAccredit($this);
        $this->procedure->add($procedure);

    }

    /**
     * Remove procedure
     *
     * @param \Base\CoreBundle\Entity\CorpoAccreditHasProcedure $procedure
     */
    public function removeProcedure(\Base\CoreBundle\Entity\CorpoAccreditHasProcedure $procedure)
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
     * @return CorpoAccredit
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

    /**
     * Set mainImage
     *
     * @param \Base\CoreBundle\Entity\MediaImageSimple $mainImage
     * @return CorpoAccredit
     */
    public function setMainImage(\Base\CoreBundle\Entity\MediaImageSimple $mainImage = null)
    {
        $this->mainImage = $mainImage;

        return $this;
    }

    /**
     * Get mainImage
     *
     * @return \Base\CoreBundle\Entity\MediaImageSimple 
     */
    public function getMainImage()
    {
        return $this->mainImage;
    }
}
