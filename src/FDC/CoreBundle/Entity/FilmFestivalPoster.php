<?php

namespace FDC\CoreBundle\Entity;

use A2lix\I18nDoctrineBundle\Doctrine\ORM\Util\Translatable;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

use FDC\CoreBundle\Util\Time;
use FDC\CoreBundle\Util\Translation;
use FDC\CoreBundle\Util\Soif;

/**
 * FilmFestivalPoster
 *
 * @ORM\Table()
 * @ORM\Entity
 * @ORM\HasLifecycleCallbacks
 */
class FilmFestivalPoster implements FilmFestivalPosterInterface
{
    use Time;
    use Translatable;
    use Translation;
    use Soif;

    /**
     * @var int
     *
     * @ORM\Column(type="integer")
     * @ORM\Id
     */
    private $id;

    /**
     * @var int
     *
     * @ORM\Column(type="string", nullable=true)
     */
    private $copyright;


    private $type;

    /**
     * @ORM\ManyToOne(targetEntity="FilmFestival")
     */
    private $festival;

    /**
     * @var string
     *
     * @ORM\ManyToOne(targetEntity="Application\Sonata\MediaBundle\Entity\Media")
     */
    private $media;
    
    /**
     * @var ArrayCollection
     */
    protected $translations;
    
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->translations = new ArrayCollection();
    }

    /**
     * Set id
     *
     * @param integer $id
     * @return FilmFestivalPoster
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

    /**
     * Set titleVf
     *
     * @param string $titleVf
     * @return FilmFestivalPoster
     */
    public function setTitleVf($titleVf)
    {
        $this->titleVf = $titleVf;

        return $this;
    }

    /**
     * Get titleVf
     *
     * @return string 
     */
    public function getTitleVf()
    {
        return $this->titleVf;
    }

    /**
     * Set titleVa
     *
     * @param string $titleVa
     * @return FilmFestivalPoster
     */
    public function setTitleVa($titleVa)
    {
        $this->titleVa = $titleVa;

        return $this;
    }

    /**
     * Get titleVa
     *
     * @return string 
     */
    public function getTitleVa()
    {
        return $this->titleVa;
    }

    /**
     * Set posterTypeId
     *
     * @param integer $posterTypeId
     * @return FilmFestivalPoster
     */
    public function setPosterTypeId($posterTypeId)
    {
        $this->posterTypeId = $posterTypeId;

        return $this;
    }

    /**
     * Get posterTypeId
     *
     * @return integer 
     */
    public function getPosterTypeId()
    {
        return $this->posterTypeId;
    }

    /**
     * Set descriptionVf
     *
     * @param string $descriptionVf
     * @return FilmFestivalPoster
     */
    public function setDescriptionVf($descriptionVf)
    {
        $this->descriptionVf = $descriptionVf;

        return $this;
    }

    /**
     * Get descriptionVf
     *
     * @return string 
     */
    public function getDescriptionVf()
    {
        return $this->descriptionVf;
    }

    /**
     * Set descriptionVa
     *
     * @param string $descriptionVa
     * @return FilmFestivalPoster
     */
    public function setDescriptionVa($descriptionVa)
    {
        $this->descriptionVa = $descriptionVa;

        return $this;
    }

    /**
     * Get descriptionVa
     *
     * @return string 
     */
    public function getDescriptionVa()
    {
        return $this->descriptionVa;
    }

    /**
     * Set internet
     *
     * @param string $internet
     * @return FilmFestivalPoster
     */
    public function setInternet($internet)
    {
        $this->internet = $internet;

        return $this;
    }

    /**
     * Get internet
     *
     * @return string 
     */
    public function getInternet()
    {
        return $this->internet;
    }

    /**
     * Add medias
     *
     * @param \FDC\CoreBundle\Entity\FilmMedia $medias
     * @return FilmFestivalPoster
     */
    public function addMedia(\FDC\CoreBundle\Entity\FilmMedia $medias)
    {
        $this->medias[] = $medias;

        return $this;
    }

    /**
     * Remove medias
     *
     * @param \FDC\CoreBundle\Entity\FilmMedia $medias
     */
    public function removeMedia(\FDC\CoreBundle\Entity\FilmMedia $medias)
    {
        $this->medias->removeElement($medias);
    }

    /**
     * Get medias
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getMedias()
    {
        return $this->medias;
    }
}
