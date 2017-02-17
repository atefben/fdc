<?php

namespace FDC\CourtMetrageBundle\Entity;

use A2lix\I18nDoctrineBundle\Doctrine\ORM\Util\Translation;
use Base\CoreBundle\Interfaces\TranslateChildInterface;
use Base\CoreBundle\Util\TranslateChild;
use Base\CoreBundle\Util\TranslationChanges;
use Doctrine\ORM\Mapping as ORM;

/**
 * CcmRegisterProcedureTranslation
 * @ORM\Table(name="ccm_register_procedure_translation")
 * @ORM\Entity()
 */
class CcmRegisterProcedureTranslation implements TranslateChildInterface
{
    use Translation;
    use TranslateChild;
    use TranslationChanges;

    /**
     * @var string
     *
     * @ORM\Column(type="string", nullable=true)
     */
    protected $name;

    /**
     * @var string
     *
     * @ORM\Column(type="text", nullable=true)
     */
    protected $procedureText;

    /**
     * @var string
     *
     * @ORM\Column(type="string", nullable=true)
     */
    protected $characteristicsTitle;

    /**
     * @var string
     *
     * @ORM\Column(type="text", nullable=true)
     */
    protected $characteristicsText;

    /**
     * @var string
     *
     * @ORM\Column(type="string", nullable=true)
     */
    protected $characteristicsButtonLabel;

    /**
     * @var boolean
     *
     * @ORM\Column(type="boolean", nullable=true)
     */
    protected $isCharacteristicsActive;

    /**
     * @var string
     *
     * @ORM\Column(type="string", nullable=true)
     */
    protected $regulationTitle;

    /**
     * @var string
     *
     * @ORM\Column(type="text", nullable=true)
     */
    protected $regulationText;

    /**
     * @var boolean
     *
     * @ORM\Column(type="boolean", nullable=true)
     */
    protected $isRegulationActive;

    /**
     * @var string
     *
     * @ORM\Column(type="string", nullable=true)
     */
    protected $registerFormTitle;

    /**
     * @var string
     *
     * @ORM\Column(type="text", nullable=true)
     */
    protected $registerFormText;

    /**
     * @var boolean
     *
     * @ORM\Column(type="boolean", nullable=true)
     */
    protected $isRegisterFormActive;

    /**
     * @var string
     *
     * @ORM\Column(type="string", nullable=true)
     */
    protected $contactUsTitle;

    /**
     * @var string
     *
     * @ORM\Column(type="text", nullable=true)
     */
    protected $contactUsLeftText;

    /**
     * @var string
     *
     * @ORM\Column(type="text", nullable=true)
     */
    protected $contactUsRightText;

    /**
     * @var string
     *
     * @ORM\Column(type="string", nullable=true)
     */
    protected $techniqueCharacteristicsTitle;

    /**
     * @var string
     *
     * @ORM\Column(type="text", nullable=true)
     */
    protected $techniqueCharacteristicsVideo;

    /**
     * @var string
     *
     * @ORM\Column(type="text", nullable=true)
     */
    protected $techniqueCharacteristicsAudio;

    /**
     * @var string
     *
     * @ORM\Column(type="text", nullable=true)
     */
    protected $techniqueCharacteristicsText;

    /**
     * @var string
     *
     * @ORM\Column(type="text", nullable=true)
     */
    protected $regulationDetailsText;

    /**
     * @var string
     *
     * @ORM\Column(type="string", nullable=true)
     */
    protected $regulationDetailsButtonLabel;

    /**
     * @var string
     *
     * @ORM\Column(type="string", nullable=true)
     */
    protected $regulationDetailsButtonUrl;

    /**
     * @return boolean
     */
    public function isIsRegisterFormActive()
    {
        return $this->isRegisterFormActive;
    }

    /**
     * @param $isActive
     *
     * @return $this
     */
    public function setIsRegisterFormActive($isActive)
    {
        $this->isRegisterFormActive = $isActive;

        return $this;
    }

    /**
     * @return boolean
     */
    public function isIsRegulationActive()
    {
        return $this->isRegulationActive;
    }

    /**
     * @param $isActive
     *
     * @return $this
     */
    public function setIsRegulationActive($isActive)
    {
        $this->isRegulationActive = $isActive;

        return $this;
    }

    /**
     * @return boolean
     */
    public function isIsCharacteristicsActive()
    {
        return $this->isCharacteristicsActive;
    }

    /**
     * @param $isActive
     *
     * @return $this
     */
    public function setIsCharacteristicsActive($isActive)
    {
        $this->isCharacteristicsActive = $isActive;

        return $this;
    }

    /**
     * @return string
     */
    public function getRegulationDetailsText()
    {
        return $this->regulationDetailsText;
    }

    /**
     * @param $regulationDetailsText
     *
     * @return $this
     */
    public function setRegulationDetailsText($regulationDetailsText)
    {
        $this->regulationDetailsText = $regulationDetailsText;

        return $this;
    }

    /**
     * @return string
     */
    public function getRegulationDetailsButtonLabel()
    {
        return $this->regulationDetailsButtonLabel;
    }

    /**
     * @param $regulationDetailsButtonLabel
     *
     * @return $this
     */
    public function setRegulationDetailsButtonLabel($regulationDetailsButtonLabel)
    {
        $this->regulationDetailsButtonLabel = $regulationDetailsButtonLabel;

        return $this;
    }

    /**
     * @return string
     */
    public function getRegulationDetailsButtonUrl()
    {
        return $this->regulationDetailsButtonUrl;
    }

    /**
     * @param $regulationDetailsButtonUrl
     *
     * @return $this
     */
    public function setRegulationDetailsButtonUrl($regulationDetailsButtonUrl)
    {
        $this->regulationDetailsButtonUrl = $regulationDetailsButtonUrl;

        return $this;
    }

    /**
     * @return string
     */
    public function getTechniqueCharacteristicsTitle()
    {
        return $this->techniqueCharacteristicsTitle;
    }

    /**
     * @param $techniqueCharacteristicsTitle
     *
     * @return $this
     */
    public function setTechniqueCharacteristicsTitle($techniqueCharacteristicsTitle)
    {
        $this->techniqueCharacteristicsTitle = $techniqueCharacteristicsTitle;

        return $this;
    }

    /**
     * @return string
     */
    public function getTechniqueCharacteristicsVideo()
    {
        return $this->techniqueCharacteristicsVideo;
    }

    /**
     * @param $techniqueCharacteristicsVideo
     *
     * @return $this
     */
    public function setTechniqueCharacteristicsVideo($techniqueCharacteristicsVideo)
    {
        $this->techniqueCharacteristicsVideo = $techniqueCharacteristicsVideo;

        return $this;
    }

    /**
     * @return string
     */
    public function getTechniqueCharacteristicsAudio()
    {
        return $this->techniqueCharacteristicsAudio;
    }

    /**
     * @param $techniqueCharacteristicsAudio
     *
     * @return $this
     */
    public function setTechniqueCharacteristicsAudio($techniqueCharacteristicsAudio)
    {
        $this->techniqueCharacteristicsAudio = $techniqueCharacteristicsAudio;

        return $this;
    }

    /**
     * @return string
     */
    public function getTechniqueCharacteristicsText()
    {
        return $this->techniqueCharacteristicsText;
    }

    /**
     * @param $techniqueCharacteristicsText
     *
     * @return $this
     */
    public function setTechniqueCharacteristicsText($techniqueCharacteristicsText)
    {
        $this->techniqueCharacteristicsText = $techniqueCharacteristicsText;

        return $this;
    }

    /**
     * @return string
     */
    public function getContactUsTitle()
    {
        return $this->contactUsTitle;
    }

    /**
     * @param $contactUsTitle
     *
     * @return $this
     */
    public function setContactUsTitle($contactUsTitle)
    {
        $this->contactUsTitle = $contactUsTitle;

        return $this;
    }

    /**
     * @return string
     */
    public function getContactUsLeftText()
    {
        return $this->contactUsLeftText;
    }

    /**
     * @param $contactUsLeftText
     *
     * @return $this
     */
    public function setContactUsLeftText($contactUsLeftText)
    {
        $this->contactUsLeftText = $contactUsLeftText;

        return $this;
    }

    /**
     * @return string
     */
    public function getContactUsRightText()
    {
        return $this->contactUsRightText;
    }

    /**
     * @param $contactUsRightText
     *
     * @return $this
     */
    public function setContactUsRightText($contactUsRightText)
    {
        $this->contactUsRightText = $contactUsRightText;

        return $this;
    }

    /**
     * @return string
     */
    public function getRegisterFormTitle()
    {
        return $this->registerFormTitle;
    }

    /**
     * @param $registerFormTitle
     *
     * @return $this
     */
    public function setRegisterFormTitle($registerFormTitle)
    {
        $this->registerFormTitle = $registerFormTitle;

        return $this;
    }

    /**
     * @return string
     */
    public function getRegisterFormText()
    {
        return $this->registerFormText;
    }

    /**
     * @param $registerFormText
     *
     * @return $this
     */
    public function setRegisterFormText($registerFormText)
    {
        $this->registerFormText = $registerFormText;

        return $this;
    }

    /**
     * @return string
     */
    public function getRegulationTitle()
    {
        return $this->regulationTitle;
    }

    /**
     * @param $regulationTitle
     *
     * @return $this
     */
    public function setRegulationTitle($regulationTitle)
    {
        $this->regulationTitle = $regulationTitle;

        return $this;
    }

    /**
     * @return string
     */
    public function getRegulationText()
    {
        return $this->regulationText;
    }

    /**
     * @param $regulationText
     *
     * @return $this
     */
    public function setRegulationText($regulationText)
    {
        $this->regulationText = $regulationText;

        return $this;
    }

    /**
     * @return string
     */
    public function getProcedureText()
    {
        return $this->procedureText;
    }

    /**
     * @param $procedureText
     *
     * @return $this
     */
    public function setProcedureText($procedureText)
    {
        $this->procedureText = $procedureText;

        return $this;
    }

    /**
     * @return string
     */
    public function getCharacteristicsTitle()
    {
        return $this->characteristicsTitle;
    }

    /**
     * @param $characteristicsTitle
     *
     * @return $this
     */
    public function setCharacteristicsTitle($characteristicsTitle)
    {
        $this->characteristicsTitle = $characteristicsTitle;

        return $this;
    }

    /**
     * @return string
     */
    public function getCharacteristicsText()
    {
        return $this->characteristicsText;
    }

    /**
     * @param $characteristicsText
     *
     * @return $this
     */
    public function setCharacteristicsText($characteristicsText)
    {
        $this->characteristicsText = $characteristicsText;

        return $this;
    }

    /**
     * @return string
     */
    public function getCharacteristicsUrl()
    {
        return $this->characteristicsUrl;
    }

    /**
     * @param $characteristicsUrl
     *
     * @return $this
     */
    public function setCharacteristicsUrl($characteristicsUrl)
    {
        $this->characteristicsUrl = $characteristicsUrl;

        return $this;
    }

    /**
     * @return string
     */
    public function getCharacteristicsButtonLabel()
    {
        return $this->characteristicsButtonLabel;
    }

    /**
     * @param $characteristicsButtonLabel
     *
     * @return $this
     */
    public function setCharacteristicsButtonLabel($characteristicsButtonLabel)
    {
        $this->characteristicsButtonLabel = $characteristicsButtonLabel;

        return $this;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param $name
     *
     * @return $this
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }
}
