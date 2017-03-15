<?php

namespace Base\CoreBundle\Entity;

use A2lix\I18nDoctrineBundle\Doctrine\ORM\Util\Translatable;

use Application\Sonata\MediaBundle\Entity\Media as SonataMedia;
use Base\CoreBundle\Interfaces\TranslateMainInterface;
use Base\CoreBundle\Util\TranslateMain;
use Base\CoreBundle\Util\Time;
use Base\CoreBundle\Util\Soif;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * FilmFestivalPoster
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Base\CoreBundle\Repository\FilmFestivalPosterRepository")
 * @ORM\HasLifecycleCallbacks
 */
class FilmFestivalPoster implements FilmFestivalPosterInterface, TranslateMainInterface
{
    use Time;
    use Translatable;
    use TranslateMain;
    use Soif;

    /**
     * @var int
     *
     * @ORM\Column(type="integer")
     * @ORM\Id
     */
    protected $id;

    /**
     * @var int
     *
     * @ORM\Column(type="string", nullable=true)
     */
    protected $copyright;

    /**
     * @var int
     *
     * @ORM\Column(type="integer", nullable=true)
     */
    protected $type;

    /**
     * @ORM\ManyToOne(targetEntity="FilmFestival")
     */
    protected $festival;

    /**
     * @var SonataMedia
     *
     * @ORM\ManyToOne(targetEntity="Application\Sonata\MediaBundle\Entity\Media")
     */
    protected $file;
    
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
     * Set copyright
     *
     * @param string $copyright
     * @return FilmFestivalPoster
     */
    public function setCopyright($copyright)
    {
        $this->copyright = $copyright;

        return $this;
    }

    /**
     * Get copyright
     *
     * @return string 
     */
    public function getCopyright()
    {
        return $this->copyright;
    }

    /**
     * Set festival
     *
     * @param \Base\CoreBundle\Entity\FilmFestival $festival
     * @return FilmFestivalPoster
     */
    public function setFestival(\Base\CoreBundle\Entity\FilmFestival $festival = null)
    {
        $this->festival = $festival;

        return $this;
    }

    /**
     * Get festival
     *
     * @return \Base\CoreBundle\Entity\FilmFestival
     */
    public function getFestival()
    {
        return $this->festival;
    }

    /**
     * Set file
     *
     * @param \Application\Sonata\MediaBundle\Entity\Media $media
     * @return FilmFestivalPoster
     */
    public function setFile(\Application\Sonata\MediaBundle\Entity\Media $file = null)
    {
        $this->file = $file;

        return $this;
    }

    /**
     * Get file
     *
     * @return \Application\Sonata\MediaBundle\Entity\Media 
     */
    public function getFile()
    {
        return $this->file;
    }

    /**
     * Set type
     *
     * @param integer $type
     * @return FilmFestivalPoster
     */
    public function setType($type)
    {
        $this->type = $type;

        return $this;
    }

    /**
     * Get type
     *
     * @return integer 
     */
    public function getType()
    {
        return $this->type;
    }
}
