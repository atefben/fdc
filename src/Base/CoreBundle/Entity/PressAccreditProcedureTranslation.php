<?php

namespace Base\CoreBundle\Entity;

use A2lix\I18nDoctrineBundle\Doctrine\ORM\Util\Translation;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

use Base\CoreBundle\Interfaces\TranslateChildInterface;
use Base\CoreBundle\Util\Time;
use Base\CoreBundle\Util\TranslateChild;
use Base\CoreBundle\Util\Seo;
/**
 * PressAccreditProcedureTranslation
 *
 * @ORM\Table()
 * @ORM\Entity
 * @ORM\HasLifecycleCallbacks()
 */
class PressAccreditProcedureTranslation implements TranslateChildInterface
{
    use Seo;
    use TranslateChild;
    use Time;
    use Translation;

    /**
     * @var string
     *
     * @ORM\Column(name="procedure_title", type="string", length=255, nullable=true)
     */
    protected $procedureTitle;

    /**
     * @var string
     *
     * @ORM\Column(name="procedure_content", type="text", nullable=true)
     */
    protected $procedureContent;


    /**
     * Constructor
     */
    public function __construct()
    {
    }

    /**
     * Set procedureTitle
     *
     * @param string $procedureTitle
     * @return PressAccreditProcedureTranslation
     */
    public function setProcedureTitle($procedureTitle)
    {
        $this->procedureTitle = $procedureTitle;

        return $this;
    }

    /**
     * Get procedureTitle
     *
     * @return string 
     */
    public function getProcedureTitle()
    {
        return $this->procedureTitle;
    }

    /**
     * Set procedureContent
     *
     * @param string $procedureContent
     * @return PressAccreditProcedureTranslation
     */
    public function setProcedureContent($procedureContent)
    {
        $this->procedureContent = $procedureContent;

        return $this;
    }

    /**
     * Get procedureContent
     *
     * @return string 
     */
    public function getProcedureContent()
    {
        return $this->procedureContent;
    }
}
