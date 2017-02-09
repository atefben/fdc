<?php

namespace FDC\MarcheDuFilmBundle\Entity;

use A2lix\I18nDoctrineBundle\Doctrine\ORM\Util\Translation;
use Base\CoreBundle\Util\TranslationChanges;
use Doctrine\ORM\Mapping as ORM;

/**
 * DispatchDeServicecTranslation
 * @ORM\Table(name="mdf_dispatch_de_service_translation")
 * @ORM\Entity(repositoryClass="FDC\MarcheDuFilmBundle\Repository\DispatchDeServiceTranslationRepository")
 */
class DispatchDeServiceTranslation
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
     * @ORM\Column(type="text", nullable=true)
     */
    protected $description;

    /**
     * @var string
     *
     * @ORM\Column(type="string", nullable=true)
     */
    protected $contactTitle;

    /**
     * @var string
     *
     * @ORM\Column(type="text", nullable=true)
     */
    protected $contactDescription;

    /**
     * @var string
     *
     * @ORM\Column(type="string", nullable=true)
     */
    protected $contactSeeMoreUrl;

    /**
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * @param $title
     *
     * @return $this
     */
    public function setTitle($title)
    {
        $this->title = $title;

        return $this;
    }

    /**
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @param $description
     *
     * @return $this
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * @return string
     */
    public function getContactTitle()
    {
        return $this->contactTitle;
    }

    /**
     * @param $contactTitle
     *
     * @return $this
     */
    public function setContactTitle($contactTitle)
    {
        $this->contactTitle = $contactTitle;

        return $this;
    }

    /**
     * @return string
     */
    public function getContactDescription()
    {
        return $this->contactDescription;
    }

    /**
     * @param $contactDescription
     *
     * @return $this
     */
    public function setContactDescription($contactDescription)
    {
        $this->contactDescription = $contactDescription;

        return $this;
    }

    /**
     * @return string
     */
    public function getContactSeeMoreUrl()
    {
        return $this->contactSeeMoreUrl;
    }

    /**
     * @param $contactSeeMoreUrl
     *
     * @return $this
     */
    public function setContactSeeMoreUrl($contactSeeMoreUrl)
    {
        $this->contactSeeMoreUrl = $contactSeeMoreUrl;

        return $this;
    }
}
