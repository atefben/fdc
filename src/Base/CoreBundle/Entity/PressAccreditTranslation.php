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
     * @ORM\Column(type="text", nullable=true)
     */
    protected $commonContent;

    /**
     * @var string
     *
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    protected $btnLabel;

    /**
     * @var string
     *
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    protected $btnLink;

    /**
     * @var string
     *
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    protected $btnText;

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
     * Set btnLabel
     *
     * @param string $btnLabel
     * @return PressAccreditTranslation
     */
    public function setBtnLabel($btnLabel)
    {
        $this->btnLabel = $btnLabel;

        return $this;
    }

    /**
     * Get btnLabel
     *
     * @return string 
     */
    public function getBtnLabel()
    {
        return $this->btnLabel;
    }

    /**
     * Set btnLink
     *
     * @param string $btnLink
     * @return PressAccreditTranslation
     */
    public function setBtnLink($btnLink)
    {
        $this->btnLink = $btnLink;

        return $this;
    }

    /**
     * Get btnLink
     *
     * @return string 
     */
    public function getBtnLink()
    {
        return $this->btnLink;
    }

    /**
     * Set btnText
     *
     * @param string $btnText
     * @return PressAccreditTranslation
     */
    public function setBtnText($btnText)
    {
        $this->btnText = $btnText;

        return $this;
    }

    /**
     * Get btnText
     *
     * @return string 
     */
    public function getBtnText()
    {
        return $this->btnText;
    }
}
