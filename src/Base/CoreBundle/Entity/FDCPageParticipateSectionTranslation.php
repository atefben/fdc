<?php

namespace Base\CoreBundle\Entity;

use A2lix\I18nDoctrineBundle\Doctrine\ORM\Util\Translation;
use Gedmo\Mapping\Annotation as Gedmo;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

use Base\CoreBundle\Util\Seo;
use Base\CoreBundle\Util\Time;
use Base\CoreBundle\Util\TranslateChild;
use Base\CoreBundle\Interfaces\TranslateChildInterface;

/**
 * FDCPageParticipateSectionTranslation
 *
 * @ORM\Table()
 * @ORM\Entity
 * @ORM\HasLifecycleCallbacks()
 */
class FDCPageParticipateSectionTranslation implements TranslateChildInterface
{
    use TranslateChild;
    use Time;
    use Translation;

    /**
     * @var string
     *
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    protected $mainTitle;

    /**
     * @var string
     *
     * @ORM\Column(type="string", length=122)
     */
    protected $mainIcon;

    /**
     * @var string
     *
     * @ORM\Column(type="text", nullable=true)
     */
    protected $mainDescription;

    /**
     * Set title
     *
     * @param string $title
     * @return FDCPageParticipateSectionTranslation
     */
    public function setMainTitle($mainTitle)
    {
        $this->mainTitle = $mainTitle;

        return $this;
    }

    /**
     * Get title
     *
     * @return string 
     */
    public function getMainTitle()
    {
        return $this->mainTitle;
    }

    /**
     * Set mainIcon
     *
     * @param string $mainIcon
     * @return FDCPagePrepare
     */
    public function setMainIcon($mainIcon)
    {
        $this->mainIcon = $mainIcon;

        return $this;
    }

    /**
     * Get mainIcon
     *
     * @return string
     */
    public function getMainIcon()
    {
        return $this->mainIcon;
    }

    /**
     * Set mainDescription
     *
     * @param string $mainDescription
     * @return FDCPagePrepareTranslation
     */
    public function setMainDescription($mainDescription)
    {
        $this->mainDescription = $mainDescription;

        return $this;
    }

    /**
     * Get mainDescription
     *
     * @return string
     */
    public function getMainDescription()
    {
        return $this->mainDescription;
    }
}
