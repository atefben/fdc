<?php

namespace FDC\CourtMetrageBundle\Entity;

use A2lix\I18nDoctrineBundle\Doctrine\ORM\Util\Translation;
use Base\CoreBundle\Util\TranslationChanges;
use Doctrine\ORM\Mapping as ORM;

/**
 * HomeSliderTopTranslation
 * @ORM\Table(name="ccm_homepage_translation")
 * @ORM\Entity
 */
class HomepageTranslation
{
    use Translation;
    use TranslationChanges;

    /**
     * @var string
     *
     * @ORM\Column(type="string", nullable=true)
     */
    protected $title;

    /**
     * @var string
     *
     * @ORM\Column(name="a_propos_label", type="string", length=255, nullable=true)
     */
    protected $aProposLabel;

    /**
     * @var string
     *
     * @ORM\Column(name="a_propos_title", type="string", length=255, nullable=true)
     */
    protected $aProposTitle;

    /**
     * @var string
     *
     * @ORM\Column(name="a_propos_description", type="text", nullable=true)
     */
    protected $aProposDescription;

    /**
     * @var string
     *
     * @ORM\Column(name="a_propos_url", type="string", length=255, nullable=true)
     */
    protected $aProposUrl;

    /**
     * Get title.
     *
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Set title.
     *
     * @param string $title
     */
    public function setTitle($title)
    {
        $this->title = $title;

        return $this;
    }

    /**
     * @return string
     */
    public function getAProposLabel()
    {
        return $this->aProposLabel;
    }

    /**
     * @param string $aProposLabel
     */
    public function setAProposLabel($aProposLabel)
    {
        $this->aProposLabel = $aProposLabel;
    }

    /**
     * @return string
     */
    public function getAProposTitle()
    {
        return $this->aProposTitle;
    }

    /**
     * @param string $aProposTitle
     */
    public function setAProposTitle($aProposTitle)
    {
        $this->aProposTitle = $aProposTitle;
    }

    /**
     * @return string
     */
    public function getAProposDescription()
    {
        return $this->aProposDescription;
    }

    /**
     * @param string $aProposDescription
     */
    public function setAProposDescription($aProposDescription)
    {
        $this->aProposDescription = $aProposDescription;
    }

    /**
     * @return string
     */
    public function getAProposUrl()
    {
        return $this->aProposUrl;
    }

    /**
     * @param string $aProposUrl
     */
    public function setAProposUrl($aProposUrl)
    {
        $this->aProposUrl = $aProposUrl;
    }
}
