<?php

namespace Base\CoreBundle\Entity;

use A2lix\I18nDoctrineBundle\Doctrine\ORM\Util\Translation;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Base\CoreBundle\Util\Seo;

use Base\CoreBundle\Util\Time;
/**
 * PressGuideTranslation
 *
 * @ORM\Table()
 * @ORM\Entity
 * @ORM\HasLifecycleCallbacks()
 */
class PressGuideTranslation
{
    use Time;
    use Translation;
    use Seo;

    /**
     * @var string
     *
     * @ORM\Column(name="procedure_title", type="string", length=255)
     */
    protected $procedureTitle;


    /**
     * Set procedureTitle
     *
     * @param string $procedureTitle
     * @return PressGuideTranslation
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
}
