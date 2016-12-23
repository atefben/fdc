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
 * CorpoAccreditProcedureTranslation
 *
 * @ORM\Table()
 * @ORM\Entity
 * @ORM\HasLifecycleCallbacks()
 */
class CorpoAccreditProcedureTranslation implements TranslateChildInterface
{
    use Seo;
    use TranslateChild;
    use Time;
    use Translation;
    use \Base\CoreBundle\Util\TranslationChanges;

    /**
     * @var string
     *
     * @ORM\Column(name="title", type="string", length=255, nullable=true)
     */
    protected $title;

    /**
     * @var string
     *
     * @ORM\Column(name="procedure_content", type="text", nullable=true)
     */
    protected $procedureContent;

    /**
     * @var integer
     *
     * @ORM\Column(name="contactTitle", type="string", length=255, nullable=true)
     */
    protected $contactTitle;

    /**
     * @var string
     *
     * @ORM\Column(type="text", nullable=true)
     *
     */
    protected $firstColumnContact;

    /**
     * @var string
     *
     * @ORM\Column(type="text", nullable=true)
     *
     */
    protected $secondColumnContact;

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
     * Constructor
     */
    public function __construct()
    {
    }

    /**
     * Set title
     *
     * @param string $title
     * @return CorpoAccreditProcedureTranslation
     */
    public function setTitle($title)
    {
        $this->title = $title;

        return $this;
    }

    /**
     * Get title
     *
     * @return string 
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Set procedureContent
     *
     * @param string $procedureContent
     * @return CorpoAccreditProcedureTranslation
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

    /**
     * Set contactTitle
     *
     * @param string $contactTitle
     * @return CorpoAccreditProcedure
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
     * @return CorpoAccreditProcedure
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
     * @return CorpoAccreditProcedure
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


    /**
     * Set btnLabel
     *
     * @param string $btnLabel
     * @return CorpoAccreditProcedureTranslation
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
     * @return CorpoAccreditProcedureTranslation
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
     * @return CorpoAccreditProcedureTranslation
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
