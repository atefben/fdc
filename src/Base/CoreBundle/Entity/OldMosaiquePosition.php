<?php

namespace Base\CoreBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * OldMosaiquePosition
 *
 * @ORM\Table(name="old_mosaique_position", indexes={@ORM\Index(name="mosaique_position_FI_1", columns={"mosaique_id"}), @ORM\Index(name="mosaique_position_FI_2", columns={"article_id"})})
 * @ORM\Entity
 */
class OldMosaiquePosition
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var integer
     *
     * @ORM\Column(name="mosaique_id", type="integer", nullable=true)
     */
    private $mosaiqueId;

    /**
     * @var integer
     *
     * @ORM\Column(name="article_id", type="integer", nullable=true)
     */
    private $articleId;

    /**
     * @var integer
     *
     * @ORM\Column(name="position", type="integer", nullable=true)
     */
    private $position;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="publication_date", type="datetime", nullable=true)
     */
    private $publicationDate;



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
     * Set mosaiqueId
     *
     * @param integer $mosaiqueId
     * @return OldMosaiquePosition
     */
    public function setMosaiqueId($mosaiqueId)
    {
        $this->mosaiqueId = $mosaiqueId;

        return $this;
    }

    /**
     * Get mosaiqueId
     *
     * @return integer 
     */
    public function getMosaiqueId()
    {
        return $this->mosaiqueId;
    }

    /**
     * Set articleId
     *
     * @param integer $articleId
     * @return OldMosaiquePosition
     */
    public function setArticleId($articleId)
    {
        $this->articleId = $articleId;

        return $this;
    }

    /**
     * Get articleId
     *
     * @return integer 
     */
    public function getArticleId()
    {
        return $this->articleId;
    }

    /**
     * Set position
     *
     * @param integer $position
     * @return OldMosaiquePosition
     */
    public function setPosition($position)
    {
        $this->position = $position;

        return $this;
    }

    /**
     * Get position
     *
     * @return integer 
     */
    public function getPosition()
    {
        return $this->position;
    }

    /**
     * Set publicationDate
     *
     * @param \DateTime $publicationDate
     * @return OldMosaiquePosition
     */
    public function setPublicationDate($publicationDate)
    {
        $this->publicationDate = $publicationDate;

        return $this;
    }

    /**
     * Get publicationDate
     *
     * @return \DateTime 
     */
    public function getPublicationDate()
    {
        return $this->publicationDate;
    }
}
