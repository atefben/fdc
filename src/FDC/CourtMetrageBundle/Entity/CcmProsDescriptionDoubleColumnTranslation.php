<?php

namespace FDC\CourtMetrageBundle\Entity;

use A2lix\I18nDoctrineBundle\Doctrine\ORM\Util\Translation;
use Base\CoreBundle\Util\TranslationChanges;
use Doctrine\ORM\Mapping as ORM;


/**
 * CcmProsDescriptionDoubleColumnTranslation
 * @ORM\Table(name="ccm_pros_description_double_column_translation")
 * @ORM\Entity(repositoryClass="FDC\CourtMetrageBundle\Repository\CcmProsDescriptionDoubleColumnTranslationRepository")
 * @ORM\HasLifecycleCallbacks()
 */
class CcmProsDescriptionDoubleColumnTranslation
{

    use Translation;
    use TranslationChanges;

    /**
     * @var string
     *
     * @ORM\Column(name="title_first", type="string", length=255, nullable=true)
     */
    protected $titleFirst;

    /**
     * @var string
     *
     * @ORM\Column(name="title_second", type="string", length=255, nullable=true)
     */
    protected $titleSecond;

    /**
     * @var string
     *
     * @ORM\Column(name="description_first", type="text", nullable=true)
     */
    protected $descriptionFirst;

    /**
     * @var string
     *
     * @ORM\Column(name="description_second", type="text", nullable=true)
     */
    protected $descriptionSecond;

    /**
     * @return string
     */
    public function getTitleFirst()
    {
        return $this->titleFirst;
    }

    /**
     * @param string $titleFirst
     */
    public function setTitleFirst($titleFirst)
    {
        $this->titleFirst = $titleFirst;
    }

    /**
     * @return string
     */
    public function getTitleSecond()
    {
        return $this->titleSecond;
    }

    /**
     * @param string $titleSecond
     */
    public function setTitleSecond($titleSecond)
    {
        $this->titleSecond = $titleSecond;
    }

    /**
     * @return string
     */
    public function getDescriptionFirst()
    {
        return $this->descriptionFirst;
    }

    /**
     * @param string $descriptionFirst
     */
    public function setDescriptionFirst($descriptionFirst)
    {
        $this->descriptionFirst = $descriptionFirst;
    }

    /**
     * @return string
     */
    public function getDescriptionSecond()
    {
        return $this->descriptionSecond;
    }

    /**
     * @param string $descriptionSecond
     */
    public function setDescriptionSecond($descriptionSecond)
    {
        $this->descriptionSecond = $descriptionSecond;
    }
}

