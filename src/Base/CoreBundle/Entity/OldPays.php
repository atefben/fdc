<?php

namespace Base\CoreBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * OldPays
 *
 * @ORM\Table(name="old_PAYS", indexes={@ORM\Index(name="DATEMODIFICATION", columns={"DATEMODIFICATION"})})
 * @ORM\Entity
 */
class OldPays
{
    /**
     * @var string
     *
     * @ORM\Column(name="CODEISO", type="string", length=3, nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $codeiso;

    /**
     * @var string
     *
     * @ORM\Column(name="PAYS", type="string", length=35, nullable=true)
     */
    private $pays;

    /**
     * @var string
     *
     * @ORM\Column(name="COUNTRY", type="string", length=35, nullable=true)
     */
    private $country;

    /**
     * @var string
     *
     * @ORM\Column(name="LANGUE", type="string", length=35, nullable=true)
     */
    private $langue;

    /**
     * @var string
     *
     * @ORM\Column(name="LANGUAGE", type="string", length=35, nullable=true)
     */
    private $language;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="DATEMODIFICATION", type="datetime", nullable=true)
     */
    private $datemodification;

    /**
     * @var integer
     *
     * @ORM\Column(name="ID", type="integer", nullable=false)
     */
    private $id;



    /**
     * Get codeiso
     *
     * @return string 
     */
    public function getCodeiso()
    {
        return $this->codeiso;
    }

    /**
     * Set pays
     *
     * @param string $pays
     * @return OldPays
     */
    public function setPays($pays)
    {
        $this->pays = $pays;

        return $this;
    }

    /**
     * Get pays
     *
     * @return string 
     */
    public function getPays()
    {
        return $this->pays;
    }

    /**
     * Set country
     *
     * @param string $country
     * @return OldPays
     */
    public function setCountry($country)
    {
        $this->country = $country;

        return $this;
    }

    /**
     * Get country
     *
     * @return string 
     */
    public function getCountry()
    {
        return $this->country;
    }

    /**
     * Set langue
     *
     * @param string $langue
     * @return OldPays
     */
    public function setLangue($langue)
    {
        $this->langue = $langue;

        return $this;
    }

    /**
     * Get langue
     *
     * @return string 
     */
    public function getLangue()
    {
        return $this->langue;
    }

    /**
     * Set language
     *
     * @param string $language
     * @return OldPays
     */
    public function setLanguage($language)
    {
        $this->language = $language;

        return $this;
    }

    /**
     * Get language
     *
     * @return string 
     */
    public function getLanguage()
    {
        return $this->language;
    }

    /**
     * Set datemodification
     *
     * @param \DateTime $datemodification
     * @return OldPays
     */
    public function setDatemodification($datemodification)
    {
        $this->datemodification = $datemodification;

        return $this;
    }

    /**
     * Get datemodification
     *
     * @return \DateTime 
     */
    public function getDatemodification()
    {
        return $this->datemodification;
    }

    /**
     * Set id
     *
     * @param integer $id
     * @return OldPays
     */
    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }

    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }
}
