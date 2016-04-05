<?php

namespace Base\CoreBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use A2lix\I18nDoctrineBundle\Doctrine\ORM\Util\Translation;

use Base\CoreBundle\Util\Time;

/**
 * FDCPageParticipateSectionWidgetTypetwoTranslation
 *
 * @ORM\Table()
 * @ORM\Entity
 * @ORM\HasLifecycleCallbacks()
 */
class FDCPageParticipateSectionWidgetTypetwoTranslation
{

    use Translation;
    use Time;

    /**
     * @var string
     *
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    protected $title;

    /**
     * @var string
     *
     * @ORM\Column(type="text", nullable=true)
     */
    protected $content;

    /**
     * @var string
     *
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    protected $sponsorFirstName;

    /**
     * @var string
     *
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    protected $sponsorLastName;

    /**
     * @var string
     *
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    protected $sponsorRole;


    /**
     * Set label
     *
     * @param string $title
     * @return FDCPageParticipateSectionWidgetTypetwoTranslation
     */
    public function setTitle($title)
    {
        $this->title = $title;

        return $this;
    }

    /**
     * Get label
     *
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Set content
     *
     * @param string $content
     * @return FDCPageParticipateSectionWidgetTypetwoTranslation
     */
    public function setContent($content)
    {
        $this->content = $content;

        return $this;
    }

    /**
     * Get content
     *
     * @return string
     */
    public function getContent()
    {
        return $this->content;
    }

    /**
     * Set sponsorFirstName
     *
     * @param string $sponsorFirstName
     * @return FDCPageParticipateSectionWidgetTypetwoTranslation
     */
    public function setSponsorFirstName($sponsorFirstName)
    {
        $this->sponsorFirstName = $sponsorFirstName;

        return $this;
    }

    /**
     * Get sponsorFirstName
     *
     * @return string 
     */
    public function getSponsorFirstName()
    {
        return $this->sponsorFirstName;
    }

    /**
     * Set sponsorLastName
     *
     * @param string $sponsorLastName
     * @return FDCPageParticipateSectionWidgetTypetwoTranslation
     */
    public function setSponsorLastName($sponsorLastName)
    {
        $this->sponsorLastName = $sponsorLastName;

        return $this;
    }

    /**
     * Get sponsorLastName
     *
     * @return string 
     */
    public function getSponsorLastName()
    {
        return $this->sponsorLastName;
    }

    /**
     * Set sponsorRole
     *
     * @param string $sponsorRole
     * @return FDCPageParticipateSectionWidgetTypetwoTranslation
     */
    public function setSponsorRole($sponsorRole)
    {
        $this->sponsorRole = $sponsorRole;

        return $this;
    }

    /**
     * Get sponsorRole
     *
     * @return string 
     */
    public function getSponsorRole()
    {
        return $this->sponsorRole;
    }
}
