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

}
