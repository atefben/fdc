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
 * CorpoAccreditTranslation
 *
 * @ORM\Table()
 * @ORM\Entity
 * @ORM\HasLifecycleCallbacks()
 */
class CorpoAccreditTranslation implements TranslateChildInterface
{
    use Time;
    use TranslateChild;
    use Translation;
    use \Base\CoreBundle\Util\TranslationChanges;
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
     * @var integer
     *
     * @ORM\Column(name="title", type="string", length=255, nullable=true)
     */
    private $contactTitle;

    /**
     * @var string
     *
     * @ORM\Column(type="text", nullable=true)
     *
     */
    private $firstColumnContact;

    /**
     * @var string
     *
     * @ORM\Column(type="text", nullable=true)
     *
     */
    private $secondColumnContact;

    /**
     * Set commonContent
     *
     * @param string $commonContent
     * @return CorpoAccreditTranslation
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
     * @return CorpoAccreditTranslation
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
     * @return CorpoAccreditTranslation
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
     * @return CorpoAccreditTranslation
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

    /**
     * Set contactTitle
     *
     * @param string $contactTitle
     * @return CorpoAccreditTranslation
     */
    public function setContactTitle($contactTitle)
    {
        $this->contactTitle = $contactTitle;

        return $this;
    }

    /**
     * Get contactTitle
     *
     * @return string 
     */
    public function getContactTitle()
    {
        return $this->contactTitle;
    }

    /**
     * Set firstColumnContact
     *
     * @param string $firstColumnContact
     * @return CorpoAccreditTranslation
     */
    public function setFirstColumnContact($firstColumnContact)
    {
        $this->firstColumnContact = $firstColumnContact;

        return $this;
    }

    /**
     * Get firstColumnContact
     *
     * @return string 
     */
    public function getFirstColumnContact()
    {
        return $this->firstColumnContact;
    }

    /**
     * Set secondColumnContact
     *
     * @param string $secondColumnContact
     * @return CorpoAccreditTranslation
     */
    public function setSecondColumnContact($secondColumnContact)
    {
        $this->secondColumnContact = $secondColumnContact;

        return $this;
    }

    /**
     * Get secondColumnContact
     *
     * @return string 
     */
    public function getSecondColumnContact()
    {
        return $this->secondColumnContact;
    }
}
