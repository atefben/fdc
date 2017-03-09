<?php

namespace FDC\CourtMetrageBundle\Entity;

use A2lix\I18nDoctrineBundle\Doctrine\ORM\Util\Translation;
use Base\CoreBundle\Interfaces\TranslateChildInterface;
use Base\CoreBundle\Util\TranslateChild;
use Base\CoreBundle\Util\TranslationChanges;
use Doctrine\ORM\Mapping as ORM;

/**
 * CcmFilmRegisterTranslation
 * @ORM\Table(name="ccm_film_register_translation")
 * @ORM\Entity()
 */
class CcmFilmRegisterTranslation implements TranslateChildInterface
{
    use Translation;
    use TranslateChild;
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
    protected $text;

    /**
     * @var string
     *
     * @ORM\Column(type="string", nullable=true)
     */
    protected $proceduresTitle;

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
    public function getText()
    {
        return $this->text;
    }

    /**
     * @param $text
     *
     * @return $this
     */
    public function setText($text)
    {
        $this->text = $text;

        return $this;
    }

    /**
     * @return string
     */
    public function getProceduresTitle()
    {
        return $this->proceduresTitle;
    }

    /**
     * @param $proceduresTitle
     *
     * @return $this
     */
    public function setProceduresTitle($proceduresTitle)
    {
        $this->proceduresTitle = $proceduresTitle;

        return $this;
    }
}
