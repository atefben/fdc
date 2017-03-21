<?php

/**
 * This file is part of the <name> project.
 * (c) <yourname> <youremail>
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Application\Sonata\MediaBundle\Entity;

use Base\CoreBundle\Entity\FilmFilm;
use Base\CoreBundle\Entity\FilmMedia;
use Base\CoreBundle\Entity\FilmPerson;
use Base\CoreBundle\Entity\FilmProjectionMedia;
use Base\CoreBundle\Entity\MediaAudioTranslation;
use Base\CoreBundle\Entity\MediaVideoTranslation;
use FDC\CourtMetrageBundle\Entity\CcmMediaAudioTranslation;
use FDC\CourtMetrageBundle\Entity\CcmMediaVideoTranslation;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Sonata\MediaBundle\Entity\BaseMedia as SonataBaseMedia;

/**
 * Class Media
 * @package Application\Sonata\MediaBundle\Entity
 */
class Media extends SonataBaseMedia
{
    /**
     * @var integer $id
     */
    protected $id;

    protected $soifId;

    protected $projectionMedias;

    protected $filmMedias;

    protected $sites;

    protected $pressGuideWidgetAudios;

    protected $parentVideoTranslation;

    protected $parentAudioTranslation;

    protected $ccmParentVideoTranslation;

    protected $ccmParentAudioTranslation;

    private $thumbsGenerated = false;
    private $uploadedFromBO = false;
    private $ignoreListener = false;

    /**
     * @var string
     */
    private $oldMediaPhoto;

    /**
     * @var string
     */
    private $oldMediaPhotoType;

    /**
     * @var string
     */
    private $oldMediaPhotoJury;

    /**
     * @var string
     */
    private $oldMediaFilm;

    /**
     * @var string
     */
    private $oldMediaFestivalYear;

    /**
     * @var ArrayCollection
     */
    private $selfkitFilms;

    /**
     * @var ArrayCollection
     */
    private $selfkitPersons;

    public function __construct()
    {
        $this->enabled = true;
        $this->selfkitPersons = new ArrayCollection();
        $this->selfkitFilms = new ArrayCollection();
    }

    /**
     * Get id
     * @return integer $id
     */
    public function getId()
    {
        return $this->id;
    }

    public function setSoifId($soifId)
    {
        $this->soifId = $soifId;
    }

    public function getSoifId()
    {
        return $this->soifId;
    }

    /**
     * Set parentVideoTranslation
     * @param MediaVideoTranslation $parentVideoTranslation
     * $return $this
     */
    public function setParentVideoTranslation(MediaVideoTranslation $parentVideoTranslation = null)
    {
        $this->parentVideoTranslation = $parentVideoTranslation;

        return $this;
    }

    /**
     * Get parentVideoTranslation
     * @return MediaVideoTranslation
     */
    public function getParentVideoTranslation()
    {
        return $this->parentVideoTranslation;
    }

    /**
     * Set parentAudioTranslation
     * @param MediaAudioTranslation $parentAudioTranslation
     * $return $this
     */
    public function setParentAudioTranslation(MediaAudioTranslation $parentAudioTranslation = null)
    {
        $this->parentAudioTranslation = $parentAudioTranslation;

        return $this;
    }

    /**
     * Get parentAudioTranslation
     * @return MediaAudioTranslation
     */
    public function getParentAudioTranslation()
    {
        return $this->parentAudioTranslation;
    }

    /**
     * Set ccmParentVideoTranslation
     * @param CcmMediaVideoTranslation $ccmParentVideoTranslation
     * $return $this
     */
    public function setCcmParentVideoTranslation(CcmMediaVideoTranslation $ccmParentVideoTranslation = null)
    {
        $this->ccmParentVideoTranslation = $ccmParentVideoTranslation;

        return $this;
    }

    /**
     * Get ccmParentVideoTranslation
     * @return CcmMediaVideoTranslation
     */
    public function getCcmParentVideoTranslation()
    {
        return $this->ccmParentVideoTranslation;
    }

    /**
     * Set ccmParentAudioTranslation
     * @param CcmMediaAudioTranslation $ccmParentAudioTranslation
     * $return $this
     */
    public function setCcmParentAudioTranslation(CcmMediaAudioTranslation $ccmParentAudioTranslation = null)
    {
        $this->ccmParentAudioTranslation = $ccmParentAudioTranslation;

        return $this;
    }

    /**
     * Get ccmParentAudioTranslation
     * @return CcmMediaAudioTranslation
     */
    public function getCcmParentAudioTranslation()
    {
        return $this->ccmParentAudioTranslation;
    }

    /**
     * Set projectionMedias
     * @param FilmProjectionMedia $projectionMedias
     * $return $this
     */
    public function setProjectionMedias(FilmProjectionMedia $projectionMedias = null)
    {
        $this->projectionMedias = $projectionMedias;

        return $this;
    }

    /**
     * Get projectionMedias
     * @return FilmProjectionMedia
     */
    public function getProjectionMedias()
    {
        return $this->projectionMedias;
    }

    /**
     * Add filmMedias
     * @param FilmMedia $filmMedias
     * $return $this
     */
    public function addFilmMedia(FilmMedia $filmMedias)
    {
        $this->filmMedias[] = $filmMedias;

        return $this;
    }

    /**
     * Remove filmMedias
     * @param FilmMedia $filmMedias
     */
    public function removeFilmMedia(FilmMedia $filmMedias)
    {
        $this->filmMedias->removeElement($filmMedias);
    }

    /**
     * Get filmMedias
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getFilmMedias()
    {
        return $this->filmMedias;
    }

    /**
     * Add galleryHasMedias
     * @param GalleryHasMedia $galleryHasMedias
     * $return $this
     */
    public function addGalleryHasMedia(GalleryHasMedia $galleryHasMedias)
    {
        $this->galleryHasMedias[] = $galleryHasMedias;

        return $this;
    }

    /**
     * Remove galleryHasMedias
     * @param GalleryHasMedia $galleryHasMedias
     */
    public function removeGalleryHasMedia(GalleryHasMedia $galleryHasMedias)
    {
        $this->galleryHasMedias->removeElement($galleryHasMedias);
    }

    /**
     * Set thumbsGenerated
     * @param boolean $thumbsGenerated
     * $return $this
     */
    public function setThumbsGenerated($thumbsGenerated)
    {
        $this->thumbsGenerated = $thumbsGenerated;

        return $this;
    }

    /**
     * Get thumbsGenerated
     * @return boolean
     */
    public function getThumbsGenerated()
    {
        return $this->thumbsGenerated;
    }

    /**
     * @return boolean
     */
    public function getIgnoreListener()
    {
        return $this->ignoreListener;
    }

    /**
     * @param boolean $ignoreListener
     * $return $this
     */
    public function setIgnoreListener($ignoreListener)
    {
        $this->ignoreListener = $ignoreListener;
        return $this;
    }

    /**
     * Set oldMediaPhoto
     * @param string $oldMediaPhoto
     * @return $this
     */
    public function setOldMediaPhoto($oldMediaPhoto)
    {
        $this->oldMediaPhoto = $oldMediaPhoto;

        return $this;
    }

    /**
     * Get oldMediaPhoto
     * @return string
     */
    public function getOldMediaPhoto()
    {
        return $this->oldMediaPhoto;
    }

    /**
     * Set oldMediaPhotoType
     *
     * @param string $oldMediaPhotoType
     * $return $this
     */
    public function setOldMediaPhotoType($oldMediaPhotoType)
    {
        $this->oldMediaPhotoType = $oldMediaPhotoType;

        return $this;
    }

    /**
     * Get oldMediaPhotoType
     *
     * @return string
     */
    public function getOldMediaPhotoType()
    {
        return $this->oldMediaPhotoType;
    }

    /**
     * Set oldMediaPhotoJury
     *
     * @param string $oldMediaPhotoJury
     * $return $this
     */
    public function setOldMediaPhotoJury($oldMediaPhotoJury)
    {
        $this->oldMediaPhotoJury = $oldMediaPhotoJury;

        return $this;
    }

    /**
     * Get oldMediaPhotoJury
     *
     * @return string
     */
    public function getOldMediaPhotoJury()
    {
        return $this->oldMediaPhotoJury;
    }

    /**
     * Set uploadedFromBO
     *
     * @param boolean $uploadedFromBO
     * $return $this
     */
    public function setUploadedFromBO($uploadedFromBO)
    {
        $this->uploadedFromBO = $uploadedFromBO;

        return $this;
    }

    /**
     * Get uploadedFromBO
     *
     * @return boolean
     */
    public function getUploadedFromBO()
    {
        return $this->uploadedFromBO;
    }

    /**
     * Set oldMediaFilm
     *
     * @param string $oldMediaFilm
     * $return $this
     */
    public function setOldMediaFilm($oldMediaFilm)
    {
        $this->oldMediaFilm = $oldMediaFilm;

        return $this;
    }

    /**
     * Get oldMediaFilm
     *
     * @return string
     */
    public function getOldMediaFilm()
    {
        return $this->oldMediaFilm;
    }

    /**
     * Add selfkitFilms
     *
     * @param FilmFilm $selfkitFilm
     * $return $this
     */
    public function addSelfkitFilm(FilmFilm $selfkitFilm)
    {
        $this->selfkitFilms[] = $selfkitFilm;
        $selfkitFilm->addSelfkitImage($this);

        return $this;
    }

    /**
     * Remove selfkitFilms
     *
     * @param FilmFilm $selfkitFilm
     */
    public function removeSelfkitFilm(FilmFilm $selfkitFilm)
    {
        $this->selfkitFilms->removeElement($selfkitFilm);
    }

    /**
     * Get selfkitFilms
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getSelfkitFilms()
    {
        return $this->selfkitFilms;
    }

    /**
     * Add selfkitPersons
     *
     * @param FilmPerson $selfkitPerson
     * $return $this
     */
    public function addSelfkitPerson(FilmPerson $selfkitPerson)
    {
        $this->selfkitPersons[] = $selfkitPerson;
        $selfkitPerson->addSelfkitImage($this);

        return $this;
    }

    /**
     * Remove selfkitPersons
     *
     * @param FilmPerson $selfkitPerson
     */
    public function removeSelfkitPerson(FilmPerson $selfkitPerson)
    {
        $this->selfkitPersons->removeElement($selfkitPerson);
    }

    /**
     * Get selfkitPersons
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getSelfkitPersons()
    {
        return $this->selfkitPersons;
    }

    /**
     * Set oldMediaFestivalYear
     *
     * @param string $oldMediaFestivalYear
     * @return Media
     */
    public function setOldMediaFestivalYear($oldMediaFestivalYear)
    {
        $this->oldMediaFestivalYear = $oldMediaFestivalYear;

        return $this;
    }

    /**
     * Get oldMediaFestivalYear
     *
     * @return string 
     */
    public function getOldMediaFestivalYear()
    {
        return $this->oldMediaFestivalYear;
    }
}
