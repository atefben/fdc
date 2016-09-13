<?php

namespace Base\CoreBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * OldFilmAdresse
 *
 * @ORM\Table(name="old_FILM_ADRESSE", indexes={@ORM\Index(name="DATEMODIFICATION", columns={"DATEMODIFICATION"})})
 * @ORM\Entity
 */
class OldFilmAdresse
{
    /**
     * @var string
     *
     * @ORM\Column(name="BLOCADRESSE", type="text", nullable=true)
     */
    private $blocadresse;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="DATECREATION", type="datetime", nullable=true)
     */
    private $datecreation;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="DATEMODIFICATION", type="datetime", nullable=true)
     */
    private $datemodification;

    /**
     * @var integer
     *
     * @ORM\Column(name="IDADRESSE", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idadresse;

    /**
     * @var string
     *
     * @ORM\Column(name="PAYS", type="string", length=3, nullable=true)
     */
    private $pays;

    /**
     * @var string
     *
     * @ORM\Column(name="CONTACTSECS", type="text", nullable=true)
     */
    private $contactsecs;



    /**
     * Set blocadresse
     *
     * @param string $blocadresse
     * @return OldFilmAdresse
     */
    public function setBlocadresse($blocadresse)
    {
        $this->blocadresse = $blocadresse;

        return $this;
    }

    /**
     * Get blocadresse
     *
     * @return string 
     */
    public function getBlocadresse()
    {
        return $this->blocadresse;
    }

    /**
     * Set datecreation
     *
     * @param \DateTime $datecreation
     * @return OldFilmAdresse
     */
    public function setDatecreation($datecreation)
    {
        $this->datecreation = $datecreation;

        return $this;
    }

    /**
     * Get datecreation
     *
     * @return \DateTime 
     */
    public function getDatecreation()
    {
        return $this->datecreation;
    }

    /**
     * Set datemodification
     *
     * @param \DateTime $datemodification
     * @return OldFilmAdresse
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
     * Get idadresse
     *
     * @return integer 
     */
    public function getIdadresse()
    {
        return $this->idadresse;
    }

    /**
     * Set pays
     *
     * @param string $pays
     * @return OldFilmAdresse
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
     * Set contactsecs
     *
     * @param string $contactsecs
     * @return OldFilmAdresse
     */
    public function setContactsecs($contactsecs)
    {
        $this->contactsecs = $contactsecs;

        return $this;
    }

    /**
     * Get contactsecs
     *
     * @return string 
     */
    public function getContactsecs()
    {
        return $this->contactsecs;
    }
}
