<?php

namespace Base\CoreBundle\Entity;

use A2lix\I18nDoctrineBundle\Doctrine\ORM\Util\Translation;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Base\CoreBundle\Util\Seo;
use Base\CoreBundle\Util\TranslateChild;
use Base\CoreBundle\Interfaces\TranslateChildInterface;
use Base\CoreBundle\Util\Time;

/**
 * FDCPageParticipateTranslation
 *
 * @ORM\Table()
 * @ORM\Entity
 * @ORM\HasLifecycleCallbacks()
 */
class FDCPageParticipateTranslation implements TranslateChildInterface
{
    use TranslateChild;
    use Time;
    use Translation;
    use Seo;

    /**
     * @var string
     *
     * @ORM\Column(name="participate_main_title", type="string", length=122, nullable=true)
     */
    protected $mainTitle;

    /**
     * @var string
     *
     * @ORM\Column(name="participate_main_description", type="text", nullable=true)
     */
    protected $mainDescription;

    /**
     * Set mainTitle
     *
     * @param string $mainTitle
     * @return FDCPageParticipateTranslation
     */
    public function setMainTitle($mainTitle)
    {
        $this->mainTitle = $mainTitle;

        return $this;
    }

    /**
     * Get mainTitle
     *
     * @return string 
     */
    public function getMainTitle()
    {
        return $this->mainTitle;
    }

    /**
     * Set mainDescription
     *
     * @param string $mainDescription
     * @return FDCPageParticipateTranslation
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
