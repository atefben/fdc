<?php

namespace Base\CoreBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * OldMoviesToCome
 *
 * @ORM\Table(name="old_movies_to_come")
 * @ORM\Entity
 */
class OldMoviesToCome
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
     * @var \DateTime
     *
     * @ORM\Column(name="show_date", type="datetime", nullable=false)
     */
    private $showDate;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="publication_date", type="datetime", nullable=false)
     */
    private $publicationDate;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="unpublication_date", type="datetime", nullable=true)
     */
    private $unpublicationDate;

    /**
     * @var string
     *
     * @ORM\Column(name="film_id", type="string", length=255, nullable=false)
     */
    private $filmId;

    /**
     * @var string
     *
     * @ORM\Column(name="artist_id", type="string", length=255, nullable=false)
     */
    private $artistId;

    /**
     * @var string
     *
     * @ORM\Column(name="photo", type="string", length=255, nullable=false)
     */
    private $photo;



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
     * Set showDate
     *
     * @param \DateTime $showDate
     * @return OldMoviesToCome
     */
    public function setShowDate($showDate)
    {
        $this->showDate = $showDate;

        return $this;
    }

    /**
     * Get showDate
     *
     * @return \DateTime 
     */
    public function getShowDate()
    {
        return $this->showDate;
    }

    /**
     * Set publicationDate
     *
     * @param \DateTime $publicationDate
     * @return OldMoviesToCome
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

    /**
     * Set unpublicationDate
     *
     * @param \DateTime $unpublicationDate
     * @return OldMoviesToCome
     */
    public function setUnpublicationDate($unpublicationDate)
    {
        $this->unpublicationDate = $unpublicationDate;

        return $this;
    }

    /**
     * Get unpublicationDate
     *
     * @return \DateTime 
     */
    public function getUnpublicationDate()
    {
        return $this->unpublicationDate;
    }

    /**
     * Set filmId
     *
     * @param string $filmId
     * @return OldMoviesToCome
     */
    public function setFilmId($filmId)
    {
        $this->filmId = $filmId;

        return $this;
    }

    /**
     * Get filmId
     *
     * @return string 
     */
    public function getFilmId()
    {
        return $this->filmId;
    }

    /**
     * Set artistId
     *
     * @param string $artistId
     * @return OldMoviesToCome
     */
    public function setArtistId($artistId)
    {
        $this->artistId = $artistId;

        return $this;
    }

    /**
     * Get artistId
     *
     * @return string 
     */
    public function getArtistId()
    {
        return $this->artistId;
    }

    /**
     * Set photo
     *
     * @param string $photo
     * @return OldMoviesToCome
     */
    public function setPhoto($photo)
    {
        $this->photo = $photo;

        return $this;
    }

    /**
     * Get photo
     *
     * @return string 
     */
    public function getPhoto()
    {
        return $this->photo;
    }
}
