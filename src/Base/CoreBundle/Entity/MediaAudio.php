<?php

namespace Base\CoreBundle\Entity;

use A2lix\I18nDoctrineBundle\Doctrine\ORM\Util\Translatable;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

use JMS\Serializer\Annotation\Groups;
use JMS\Serializer\Annotation\Since;

/**
 * MediaAudio
 *
 * @ORM\Table()
 * @ORM\Entity
 * @ORM\HasLifecycleCallbacks()
 */
class MediaAudio extends Media
{
    use Translatable;

    /**
     * @var Media
     *
     * @ORM\ManyToOne(targetEntity="MediaImage", cascade={"persist"})
     *
     * @Groups({"trailer_list", "trailer_show", "web_tv_list", "web_tv_show"})
     */
    private $image;

    /**
     * @ORM\OneToMany(targetEntity="MediaAudioFilmFilmAssociated", mappedBy="mediaAudio", cascade={"persist"})
     *
     * @Groups({"trailer_list", "trailer_show"})
     */
    private $associatedFilms;

    /**
     * Set image
     *
     * @param \Base\CoreBundle\Entity\MediaImage $image
     * @return MediaAudio
     */
    public function setImage(\Base\CoreBundle\Entity\MediaImage $image = null)
    {
        $this->image = $image;

        return $this;
    }

    /**
     * Get image
     *
     * @return \Base\CoreBundle\Entity\MediaImage
     */
    public function getImage()
    {
        return $this->image;
    }


    /**
     * Add associatedFilms
     *
     * @param \Base\CoreBundle\Entity\MediaAudioFilmFilmAssociated $associatedFilms
     * @return MediaAudio
     */
    public function addAssociatedFilm(\Base\CoreBundle\Entity\MediaAudioFilmFilmAssociated $associatedFilms)
    {
        $this->associatedFilms[] = $associatedFilms;

        return $this;
    }

    /**
     * Remove associatedFilms
     *
     * @param \Base\CoreBundle\Entity\MediaAudioFilmFilmAssociated $associatedFilms
     */
    public function removeAssociatedFilm(\Base\CoreBundle\Entity\MediaAudioFilmFilmAssociated $associatedFilms)
    {
        $this->associatedFilms->removeElement($associatedFilms);
    }

    /**
     * Get associatedFilms
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getAssociatedFilms()
    {
        return $this->associatedFilms;
    }
}
