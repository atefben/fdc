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
 * CorpoMovieInscriptionProcedureTranslation
 *
 * @ORM\Table()
 * @ORM\Entity
 * @ORM\HasLifecycleCallbacks()
 */
class CorpoMovieInscriptionProcedureTranslation implements TranslateChildInterface
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
     * @ORM\Column(name="btn_selection_label", type="string", length=255, nullable=true)
     */
    protected $btnSelectionLabel;

    /**
     * @var string
     *
     * @ORM\Column(name="btn_selection_link", type="string", length=255, nullable=true)
     */
    protected $btnSelectionLink;

    /**
     * @var string
     *
     * @ORM\Column(name="btn_inscription_label", type="string", length=255, nullable=true)
     */
    protected $btnInscriptionLabel;

    /**
     * @var string
     *
     * @ORM\Column(name="btn_inscription_link", type="string", length=255, nullable=true)
     */
    protected $btnInscriptionLink;

    /**
     * @var string
     *
     * @ORM\Column(name="procedure_content", type="text", nullable=true)
     */
    protected $procedureContent;

    /**
     * @var string
     *
     * @ORM\Column(name="rules_content", type="text", nullable=true)
     */
    protected $rulesContent;

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
     * @var string
     *
     * @ORM\Column(type="text", nullable=true)
     */
    protected $inscriptionContent;

    /**
     * Set title
     *
     * @param string $title
     * @return CorpoMovieInscriptionProcedureTranslation
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
     * @return CorpoMovieInscriptionProcedureTranslation
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
     * Set btnSelectionLabel
     *
     * @param string $btnSelectionLabel
     * @return CorpoMovieInscriptionProcedureTranslation
     */
    public function setBtnSelectionLabel($btnSelectionLabel)
    {
        $this->btnSelectionLabel = $btnSelectionLabel;

        return $this;
    }

    /**
     * Get btnSelectionLabel
     *
     * @return string 
     */
    public function getBtnSelectionLabel()
    {
        return $this->btnSelectionLabel;
    }

    /**
     * Set btnSelectionLink
     *
     * @param string $btnSelectionLink
     * @return CorpoMovieInscriptionProcedureTranslation
     */
    public function setBtnSelectionLink($btnSelectionLink)
    {
        $this->btnSelectionLink = $btnSelectionLink;

        return $this;
    }

    /**
     * Get btnSelectionLink
     *
     * @return string 
     */
    public function getBtnSelectionLink()
    {
        return $this->btnSelectionLink;
    }

    /**
     * Set btnInscriptionLabel
     *
     * @param string $btnInscriptionLabel
     * @return CorpoMovieInscriptionProcedureTranslation
     */
    public function setBtnInscriptionLabel($btnInscriptionLabel)
    {
        $this->btnInscriptionLabel = $btnInscriptionLabel;

        return $this;
    }

    /**
     * Get btnInscriptionLabel
     *
     * @return string 
     */
    public function getBtnInscriptionLabel()
    {
        return $this->btnInscriptionLabel;
    }

    /**
     * Set btnInscriptionLink
     *
     * @param string $btnInscriptionLink
     * @return CorpoMovieInscriptionProcedureTranslation
     */
    public function setBtnInscriptionLink($btnInscriptionLink)
    {
        $this->btnInscriptionLink = $btnInscriptionLink;

        return $this;
    }

    /**
     * Get btnInscriptionLink
     *
     * @return string 
     */
    public function getBtnInscriptionLink()
    {
        return $this->btnInscriptionLink;
    }

    /**
     * Set rulesContent
     *
     * @param string $rulesContent
     * @return CorpoMovieInscriptionProcedureTranslation
     */
    public function setRulesContent($rulesContent)
    {
        $this->rulesContent = $rulesContent;

        return $this;
    }

    /**
     * Get rulesContent
     *
     * @return string 
     */
    public function getRulesContent()
    {
        return $this->rulesContent;
    }

    /**
     * Set contactTitle
     *
     * @param string $contactTitle
     * @return CorpoMovieInscriptionProcedureTranslation
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
     * @return CorpoMovieInscriptionProcedureTranslation
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
     * @return CorpoMovieInscriptionProcedureTranslation
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
     * Set inscriptionContent
     *
     * @param string $inscriptionContent
     * @return CorpoMovieInscriptionProcedureTranslation
     */
    public function setInscriptionContent($inscriptionContent)
    {
        $this->inscriptionContent = $inscriptionContent;

        return $this;
    }

    /**
     * Get inscriptionContent
     *
     * @return string 
     */
    public function getInscriptionContent()
    {
        return $this->inscriptionContent;
    }
}
