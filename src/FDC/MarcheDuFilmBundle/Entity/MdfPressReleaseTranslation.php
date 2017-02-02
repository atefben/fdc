<?php

namespace FDC\MarcheDuFilmBundle\Entity;

use A2lix\I18nDoctrineBundle\Doctrine\ORM\Util\Translation;
use Base\CoreBundle\Util\TranslationChanges;
use Doctrine\ORM\Mapping as ORM;

/**
 * MdfPressReleaseTranslation
 * @ORM\Table(name="mdf_press_release_translation")
 * @ORM\Entity
 */
class MdfPressReleaseTranslation
{
    use Translation;
    use TranslationChanges;

    /**
     * @var string
     *
     * @ORM\Column(type="string", nullable=true)
     */
    protected $subtitle;

    /**
     * @var string
     *
     * @ORM\Column(type="text", nullable=true)
     */
    protected $description;

    /**
     * @return string
     */
    public function getSubtitle()
    {
        return $this->subtitle;
    }

    /**
     * @param $subtitle
     *
     * @return $this
     */
    public function setSubtitle($subtitle)
    {
        $this->subtitle = $subtitle;

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
}
