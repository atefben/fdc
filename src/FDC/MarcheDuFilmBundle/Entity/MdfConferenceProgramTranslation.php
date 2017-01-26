<?php

namespace FDC\MarcheDuFilmBundle\Entity;

use A2lix\I18nDoctrineBundle\Doctrine\ORM\Util\Translation;
use Base\CoreBundle\Util\TranslationChanges;
use Doctrine\ORM\Mapping as ORM;

/**
 * MdfConferenceProgramTranslation
 * @ORM\Table(name="mdf_conference_program_translation")
 * @ORM\Entity(repositoryClass="FDC\MarcheDuFilmBundle\Repository\MdfConferenceProgramTranslationRepository")
 */
class MdfConferenceProgramTranslation
{
    use Translation;
    use TranslationChanges;

    /**
     * @var string
     *
     * @ORM\Column(type="string", nullable=true)
     */
    protected $subTitle;

    /**
     * @var string
     *
     * @ORM\Column(type="text", nullable=true)
     */
    protected $header;

    /**
     * @return string
     */
    public function getSubTitle()
    {
        return $this->subTitle;
    }

    /**
     * @param $subTitle
     *
     * @return $this
     */
    public function setSubTitle($subTitle)
    {
        $this->subTitle = $subTitle;

        return $this;
    }

    /**
     * @return string
     */
    public function getHeader()
    {
        return $this->header;
    }

    /**
     * @param $header
     *
     * @return $this
     */
    public function setHeader($header)
    {
        $this->header = $header;

        return $this;
    }
}
