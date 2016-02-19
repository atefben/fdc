<?php

namespace Base\CoreBundle\Entity;

use A2lix\I18nDoctrineBundle\Doctrine\ORM\Util\Translation;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

use Base\CoreBundle\Util\Seo;
use Base\CoreBundle\Interfaces\TranslateChildInterface;
use Base\CoreBundle\Util\Time;
use Base\CoreBundle\Util\TranslateChild;

/**
 * PressAccreditTranslation
 *
 * @ORM\Table()
 * @ORM\Entity
 * @ORM\HasLifecycleCallbacks()
 */
class PressAccreditTranslation implements TranslateChildInterface
{
    use Time;
    use TranslateChild;
    use Translation;
    use Seo;

    /**
     * @var string
     *
     * @ORM\Column(name="common_title", type="string", length=255, nullable=true)
     */
    protected $commonTitle;

    /**
     * @var string
     *
     * @ORM\Column(name="common_content", type="text", nullable=true)
     */
    protected $commonContent;

    /**
     * @var string
     *
     * @ORM\Column(name="procedure_main_title", type="string", length=255, nullable=true)
     */
    protected $procedureMainTitle;


    /**
     * Set commonTitle
     *
     * @param string $commonTitle
     * @return PressAccreditTranslation
     */
    public function setCommonTitle($commonTitle)
    {
        $this->commonTitle = $commonTitle;

        return $this;
    }

    /**
     * Get commonTitle
     *
     * @return string 
     */
    public function getCommonTitle()
    {
        return $this->commonTitle;
    }

    /**
     * Set commonContent
     *
     * @param string $commonContent
     * @return PressAccreditTranslation
     */
    public function setCommonContent($commonContent)
    {
        $this->commonContent = $commonContent;

        return $this;
    }

    /**
     * Get commonContent
     *
     * @return string 
     */
    public function getCommonContent()
    {
        return $this->commonContent;
    }

    /**
     * Set procedureMainTitle
     *
     * @param string $procedureMainTitle
     * @return PressAccreditTranslation
     */
    public function setProcedureMainTitle($procedureMainTitle)
    {
        $this->procedureMainTitle = $procedureMainTitle;

        return $this;
    }

    /**
     * Get procedureMainTitle
     *
     * @return string 
     */
    public function getProcedureMainTitle()
    {
        return $this->procedureMainTitle;
    }
}
