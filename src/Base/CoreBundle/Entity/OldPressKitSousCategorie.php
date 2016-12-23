<?php

namespace Base\CoreBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * OldPressKitSousCategorie
 *
 * @ORM\Table(name="old_press_kit_sous_categorie")
 * @ORM\Entity
 */
class OldPressKitSousCategorie
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
     * @ORM\Column(name="categorie_vf", type="string", length=50, nullable=true)
     */
    protected $categorieVf;

    /**
     * @var string
     *
     * @ORM\Column(name="categorie_en", type="string", length=50, nullable=true)
     */
    protected $categorieEn;

    /**
     * @var integer
     *
     * @ORM\Column(name="ordre", type="integer", nullable=false)
     */
    protected $ordre;



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
     * Set categorieVf
     *
     * @param string $categorieVf
     * @return OldPressKitSousCategorie
     */
    public function setCategorieVf($categorieVf)
    {
        $this->categorieVf = $categorieVf;

        return $this;
    }

    /**
     * Get categorieVf
     *
     * @return string 
     */
    public function getCategorieVf()
    {
        return $this->categorieVf;
    }

    /**
     * Set categorieEn
     *
     * @param string $categorieEn
     * @return OldPressKitSousCategorie
     */
    public function setCategorieEn($categorieEn)
    {
        $this->categorieEn = $categorieEn;

        return $this;
    }

    /**
     * Get categorieEn
     *
     * @return string 
     */
    public function getCategorieEn()
    {
        return $this->categorieEn;
    }

    /**
     * Set ordre
     *
     * @param integer $ordre
     * @return OldPressKitSousCategorie
     */
    public function setOrdre($ordre)
    {
        $this->ordre = $ordre;

        return $this;
    }

    /**
     * Get ordre
     *
     * @return integer 
     */
    public function getOrdre()
    {
        return $this->ordre;
    }
}
