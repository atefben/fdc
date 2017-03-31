<?php

namespace FDC\CourtMetrageBundle\Entity;

use A2lix\I18nDoctrineBundle\Doctrine\ORM\Util\Translation;
use Base\CoreBundle\Util\TranslationChanges;
use Doctrine\ORM\Mapping as ORM;

/**
 * CcmModulePFTranslation
 * @ORM\Table(name="ccm_module_pf_translation")
 * @ORM\Entity
 * @ORM\HasLifecycleCallbacks()
 */
class CcmModulePFTranslation
{

    use Translation;
    use TranslationChanges;

    /**
     * @var string
     *
     * @ORM\Column(name="name_pf", type="string", length=255, nullable=true)
     */
    protected $namePF;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="text", nullable=true)
     */
    protected $description;

    /**
     * @var string
     *
     * @ORM\Column(name="name_surname", type="string", length=255, nullable=true)
     */
    protected $nameSurname;

    /**
     * @var string
     *
     * @ORM\Column(name="function", type="string", length=255, nullable=true)
     */
    protected $function;

    /**
     * @return string
     */
    public function getNamePF()
    {
        return $this->namePF;
    }

    /**
     * @param string $namePF
     */
    public function setNamePF($namePF)
    {
        $this->namePF = $namePF;
    }

    /**
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @param string $description
     */
    public function setDescription($description)
    {
        $this->description = $description;
    }

    /**
     * @return string
     */
    public function getNameSurname()
    {
        return $this->nameSurname;
    }

    /**
     * @param string $nameSurname
     */
    public function setNameSurname($nameSurname)
    {
        $this->nameSurname = $nameSurname;
    }

    /**
     * @return string
     */
    public function getFunction()
    {
        return $this->function;
    }

    /**
     * @param string $function
     */
    public function setFunction($function)
    {
        $this->function = $function;
    }
}

