<?php

namespace FDC\CourtMetrageBundle\Entity;

use A2lix\I18nDoctrineBundle\Doctrine\ORM\Util\Translation;
use Base\CoreBundle\Util\TranslationChanges;
use FDC\CourtMetrageBundle\Interfaces\CcmPictoInterface;
use FDC\CourtMetrageBundle\Util\CcmPicto;
use Doctrine\ORM\Mapping as ORM;

/**
 * CcmModuleFourColumnsTranslation
 * @ORM\Table(name="ccm_module_four_columns_translation")
 * @ORM\Entity
 * @ORM\HasLifecycleCallbacks()
 */
class CcmModuleFourColumnsTranslation implements CcmPictoInterface
{

    use Translation;
    use TranslationChanges;
    use CcmPicto;

    /**
     * @var string
     *
     * @ORM\Column(name="picto1", type="string", length=255, nullable=true)
     */
    protected $picto1;

    /**
     * @var string
     *
     * @ORM\Column(name="picto2", type="string", length=255, nullable=true)
     */
    protected $picto2;

    /**
     * @var string
     *
     * @ORM\Column(name="picto3", type="string", length=255, nullable=true)
     */
    protected $picto3;

    /**
     * @var string
     *
     * @ORM\Column(name="picto4", type="string", length=255, nullable=true)
     */
    protected $picto4;

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
     * @var string
     *
     * @ORM\Column(name="description_4", type="text", nullable=true)
     */
    protected $description4;

    /**
     * @return string
     */
    public function getPicto1()
    {
        return $this->picto1;
    }

    /**
     * @param string $picto1
     */
    public function setPicto1($picto1)
    {
        $this->picto1 = $picto1;
    }

    /**
     * @return string
     */
    public function getPicto2()
    {
        return $this->picto2;
    }

    /**
     * @param string $picto2
     */
    public function setPicto2($picto2)
    {
        $this->picto2 = $picto2;
    }

    /**
     * @return string
     */
    public function getPicto3()
    {
        return $this->picto3;
    }

    /**
     * @param string $picto3
     */
    public function setPicto3($picto3)
    {
        $this->picto3 = $picto3;
    }

    /**
     * @return string
     */
    public function getPicto4()
    {
        return $this->picto4;
    }

    /**
     * @param string $picto4
     */
    public function setPicto4($picto4)
    {
        $this->picto4 = $picto4;
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

    /**
     * @return string
     */
    public function getDescription4()
    {
        return $this->description4;
    }

    /**
     * @param string $description4
     */
    public function setDescription4($description4)
    {
        $this->description4 = $description4;
    }
}

