<?php

namespace Base\CoreBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * OldLanguage
 *
 * @ORM\Table(name="old_language")
 * @ORM\Entity
 */
class OldLanguage
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    protected $id;

    /**
     * @var string
     *
     * @ORM\Column(name="culture", type="string", length=5, nullable=true)
     */
    protected $culture;

    /**
     * @var string
     *
     * @ORM\Column(name="label", type="string", length=100, nullable=true)
     */
    protected $label;

    /**
     * @var string
     *
     * @ORM\Column(name="label_en", type="string", length=100, nullable=true)
     */
    protected $labelEn;

    /**
     * @var string
     *
     * @ORM\Column(name="dir", type="string", length=3, nullable=true)
     */
    protected $dir;

    /**
     * @var string
     *
     * @ORM\Column(name="codeiso", type="string", length=3, nullable=false)
     */
    protected $codeiso;



    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set culture
     *
     * @param string $culture
     * @return OldLanguage
     */
    public function setCulture($culture)
    {
        $this->culture = $culture;

        return $this;
    }

    /**
     * Get culture
     *
     * @return string 
     */
    public function getCulture()
    {
        return $this->culture;
    }

    /**
     * Set label
     *
     * @param string $label
     * @return OldLanguage
     */
    public function setLabel($label)
    {
        $this->label = $label;

        return $this;
    }

    /**
     * Get label
     *
     * @return string 
     */
    public function getLabel()
    {
        return $this->label;
    }

    /**
     * Set labelEn
     *
     * @param string $labelEn
     * @return OldLanguage
     */
    public function setLabelEn($labelEn)
    {
        $this->labelEn = $labelEn;

        return $this;
    }

    /**
     * Get labelEn
     *
     * @return string 
     */
    public function getLabelEn()
    {
        return $this->labelEn;
    }

    /**
     * Set dir
     *
     * @param string $dir
     * @return OldLanguage
     */
    public function setDir($dir)
    {
        $this->dir = $dir;

        return $this;
    }

    /**
     * Get dir
     *
     * @return string 
     */
    public function getDir()
    {
        return $this->dir;
    }

    /**
     * Set codeiso
     *
     * @param string $codeiso
     * @return OldLanguage
     */
    public function setCodeiso($codeiso)
    {
        $this->codeiso = $codeiso;

        return $this;
    }

    /**
     * Get codeiso
     *
     * @return string 
     */
    public function getCodeiso()
    {
        return $this->codeiso;
    }
}
