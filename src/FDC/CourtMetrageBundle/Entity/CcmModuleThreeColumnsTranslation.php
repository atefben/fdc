<?php

namespace FDC\CourtMetrageBundle\Entity;

use A2lix\I18nDoctrineBundle\Doctrine\ORM\Util\Translation;
use Base\CoreBundle\Util\TranslationChanges;
use Doctrine\ORM\Mapping as ORM;

/**
 * CcmModuleThreeColumnsTranslation
 * @ORM\Table(name="ccm_module_three_columns_translation")
 * @ORM\Entity
 * @ORM\HasLifecycleCallbacks()
 */
class CcmModuleThreeColumnsTranslation
{

    use Translation;
    use TranslationChanges;

    /**
     * @var string
     *
     * @ORM\Column(name="title_1", type="string", length=255, nullable=true)
     */
    protected $title1;

    /**
     * @var string
     *
     * @ORM\Column(name="title_2", type="string", length=255, nullable=true)
     */
    protected $title2;

    /**
     * @var string
     *
     * @ORM\Column(name="title_3", type="string", length=255, nullable=true)
     */
    protected $title3;

    /**
     * @var string
     *
     * @ORM\Column(name="description_1", type="text", nullable=true)
     */
    protected $description1;

    /**
     * @var string
     *
     * @ORM\Column(name="description_2", type="text", nullable=true)
     */
    protected $description2;

    /**
     * @var string
     *
     * @ORM\Column(name="description_3", type="text", nullable=true)
     */
    protected $description3;

    /**
     * @return string
     */
    public function getTitle1()
    {
        return $this->title1;
    }

    /**
     * @param string $title1
     */
    public function setTitle1($title1)
    {
        $this->title1 = $title1;
    }

    /**
     * @return string
     */
    public function getTitle2()
    {
        return $this->title2;
    }

    /**
     * @param string $title2
     */
    public function setTitle2($title2)
    {
        $this->title2 = $title2;
    }

    /**
     * @return string
     */
    public function getTitle3()
    {
        return $this->title3;
    }

    /**
     * @param string $title3
     */
    public function setTitle3($title3)
    {
        $this->title3 = $title3;
    }

    /**
     * @return string
     */
    public function getDescription1()
    {
        return $this->description1;
    }

    /**
     * @param string $description1
     */
    public function setDescription1($description1)
    {
        $this->description1 = $description1;
    }

    /**
     * @return string
     */
    public function getDescription2()
    {
        return $this->description2;
    }

    /**
     * @param string $description2
     */
    public function setDescription2($description2)
    {
        $this->description2 = $description2;
    }

    /**
     * @return string
     */
    public function getDescription3()
    {
        return $this->description3;
    }

    /**
     * @param string $description3
     */
    public function setDescription3($description3)
    {
        $this->description3 = $description3;
    }
}

