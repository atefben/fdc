<?php

namespace Base\CoreBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * OldPressKitAssociation
 *
 * @ORM\Table(name="old_press_kit_association", indexes={@ORM\Index(name="pm_id_cat", columns={"id_categorie"}), @ORM\Index(name="pm_idart_idcat", columns={"id_article", "id_categorie"})})
 * @ORM\Entity
 */
class OldPressKitAssociation
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id_article", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idArticle;

    /**
     * @var integer
     *
     * @ORM\Column(name="id_categorie", type="integer", nullable=false)
     */
    private $idCategorie;

    /**
     * @var integer
     *
     * @ORM\Column(name="id_sous_categorie", type="integer", nullable=false)
     */
    private $idSousCategorie;



    /**
     * Get idArticle
     *
     * @return integer 
     */
    public function getIdArticle()
    {
        return $this->idArticle;
    }

    /**
     * Set idCategorie
     *
     * @param integer $idCategorie
     * @return OldPressKitAssociation
     */
    public function setIdCategorie($idCategorie)
    {
        $this->idCategorie = $idCategorie;

        return $this;
    }

    /**
     * Get idCategorie
     *
     * @return integer 
     */
    public function getIdCategorie()
    {
        return $this->idCategorie;
    }

    /**
     * Set idSousCategorie
     *
     * @param integer $idSousCategorie
     * @return OldPressKitAssociation
     */
    public function setIdSousCategorie($idSousCategorie)
    {
        $this->idSousCategorie = $idSousCategorie;

        return $this;
    }

    /**
     * Get idSousCategorie
     *
     * @return integer 
     */
    public function getIdSousCategorie()
    {
        return $this->idSousCategorie;
    }
}
