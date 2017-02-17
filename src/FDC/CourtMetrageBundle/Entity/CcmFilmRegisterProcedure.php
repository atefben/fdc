<?php

namespace FDC\CourtMetrageBundle\Entity;


use A2lix\I18nDoctrineBundle\Doctrine\ORM\Util\Translatable;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * CcmFilmRegisterProcedure
 * @ORM\Table(name="ccm_film_register_procedure")
 * @ORM\Entity
 */
class CcmFilmRegisterProcedure
{
    /**
     * @var integer
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @var CcmRegisterProcedure
     *
     * @ORM\ManyToOne(targetEntity="FDC\CourtMetrageBundle\Entity\CcmRegisterProcedure")
     *
     */
    protected $procedure;

    /**
     * @ORM\ManyToOne(targetEntity="CcmFilmRegister", inversedBy="filmRegisterProcedure")
     * @ORM\JoinColumn(name="film_register_id", referencedColumnName="id", onDelete="SET NULL")
     */
    protected $filmRegister;

    /**
     * @var ArrayCollection
     */
    protected $translations;

    /**
     * CcmFilmRegisterProcedure constructor.
     */
    public function __construct()
    {
        $this->translations = new ArrayCollection();
    }

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return mixed
     */
    public function getFilmRegister()
    {
        return $this->filmRegister;
    }

    /**
     * @param $filmRegister
     *
     * @return $this
     */
    public function setFilmRegister($filmRegister)
    {
        $this->filmRegister = $filmRegister;

        return $this;
    }

    /**
     * @return CcmRegisterProcedure
     */
    public function getProcedure()
    {
        return $this->procedure;
    }

    /**
     * @param $procedure
     *
     * @return $this
     */
    public function setProcedure($procedure)
    {
        $this->procedure = $procedure;

        return $this;
    }

    /**
     * @return ArrayCollection
     */
    public function getTranslations()
    {
        return $this->translations;
    }

    /**
     * @param $translations
     *
     * @return $this
     */
    public function setTranslations($translations)
    {
        $this->translations = $translations;

        return $this;
    }
}
