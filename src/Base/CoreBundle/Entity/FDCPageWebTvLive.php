<?php

namespace Base\CoreBundle\Entity;

use A2lix\I18nDoctrineBundle\Doctrine\ORM\Util\Translatable;
use Base\CoreBundle\Interfaces\TranslateMainInterface;
use Base\CoreBundle\Util\SeoMain;
use Base\CoreBundle\Util\Time;
use Base\CoreBundle\Util\TranslateMain;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

use JMS\Serializer\Annotation\Groups;
use JMS\Serializer\Annotation\Since;

use Symfony\Component\Validator\Constraints as Assert;

/**
 * FDCPageWebTvLive
 *
 * @ORM\Table()
 * @ORM\Entity()
 * @ORM\HasLifecycleCallbacks
 */
class FDCPageWebTvLive implements TranslateMainInterface
{

    use Time;
    use Translatable;
    use TranslateMain;
    use SeoMain;

    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var boolean
     *
     * @ORM\Column(type="integer", nullable=true)
     */
    private $live;

    /**
     * @var boolean
     *
     * @ORM\Column(type="boolean")
     */
    private $doNotDisplayWebTvArea = false;

    /**
     * @var boolean
     *
     * @ORM\Column(type="boolean")
     */
    private $doNotDisplayTrailerArea = false;

    /**
     * @var boolean
     *
     * @ORM\Column(type="boolean")
     */
    private $doNotDisplayLastVideosArea = false;

    /**
     * @var MediaImageSimple
     *
     * @ORM\ManyToOne(targetEntity="MediaImageSimple")
     *
     * @Groups({"web_tv_list", "web_tv_show"})
     */
    private $image;

    /**
     * @var FDCPageWebTvLiveWebTvAssociated
     * @ORM\OneToMany(targetEntity="FDCPageWebTvLiveWebTvAssociated", mappedBy="FDCPageWebTvLive", cascade={"all"}, orphanRemoval=true)
     */
    private $associatedWebTvs;

    /**
     * @ORM\OneToMany(targetEntity="FDCPageWebTvLiveFilmFilmAssociated", mappedBy="FDCPageWebTvLive", cascade={"all"}, orphanRemoval=true)
     */
    private $associatedFilmFilms;

    /**
     * @var ArrayCollection
     *
     * @Assert\Valid()
     */
    protected $translations;


    public function __construct()
    {
        $this->translations =  new ArrayCollection();
        $this->associatedWebTvs =  new ArrayCollection();
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
     * Set live
     *
     * @param boolean $live
     * @return FDCPageWebTvLive
     */
    public function setLive($live)
    {
        $this->live = $live;

        return $this;
    }

    /**
     * Get live
     *
     * @return boolean 
     */
    public function getLive()
    {
        return $this->live;
    }

    /**
     * Set doNotDisplayWebTvArea
     *
     * @param boolean $doNotDisplayWebTvArea
     * @return FDCPageWebTvLive
     */
    public function setDoNotDisplayWebTvArea($doNotDisplayWebTvArea)
    {
        $this->doNotDisplayWebTvArea = $doNotDisplayWebTvArea;

        return $this;
    }

    /**
     * Get doNotDisplayWebTvArea
     *
     * @return boolean 
     */
    public function getDoNotDisplayWebTvArea()
    {
        return $this->doNotDisplayWebTvArea;
    }

    /**
     * Set doNotDisplayTrailerArea
     *
     * @param boolean $doNotDisplayTrailerArea
     * @return FDCPageWebTvLive
     */
    public function setDoNotDisplayTrailerArea($doNotDisplayTrailerArea)
    {
        $this->doNotDisplayTrailerArea = $doNotDisplayTrailerArea;

        return $this;
    }

    /**
     * Get doNotDisplayTrailerArea
     *
     * @return boolean 
     */
    public function getDoNotDisplayTrailerArea()
    {
        return $this->doNotDisplayTrailerArea;
    }

    /**
     * Set doNotDisplayLastVideosArea
     *
     * @param boolean $doNotDisplayLastVideosArea
     * @return FDCPageWebTvLive
     */
    public function setDoNotDisplayLastVideosArea($doNotDisplayLastVideosArea)
    {
        $this->doNotDisplayLastVideosArea = $doNotDisplayLastVideosArea;

        return $this;
    }

    /**
     * Get doNotDisplayLastVideosArea
     *
     * @return boolean 
     */
    public function getDoNotDisplayLastVideosArea()
    {
        return $this->doNotDisplayLastVideosArea;
    }

    /**
     * Set image
     *
     * @param \Base\CoreBundle\Entity\MediaImageSimple $image
     * @return FDCPageWebTvLive
     */
    public function setImage(\Base\CoreBundle\Entity\MediaImageSimple $image = null)
    {
        $this->image = $image;

        return $this;
    }

    /**
     * Get image
     *
     * @return \Base\CoreBundle\Entity\MediaImageSimple 
     */
    public function getImage()
    {
        return $this->image;
    }

    /**
     * Add webTvs
     *
     * @param \Base\CoreBundle\Entity\WebTv $webTvs
     * @return FDCPageWebTvLive
     */
    public function addWebTv(\Base\CoreBundle\Entity\WebTv $webTvs)
    {
        $this->webTvs[] = $webTvs;

        return $this;
    }

    /**
     * Remove webTvs
     *
     * @param \Base\CoreBundle\Entity\WebTv $webTvs
     */
    public function removeWebTv(\Base\CoreBundle\Entity\WebTv $webTvs)
    {
        $this->webTvs->removeElement($webTvs);
    }

    /**
     * Get webTvs
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getWebTvs()
    {
        return $this->webTvs;
    }

    /**
     * Get associatedWebTvs
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getAssociatedWebTvs()
    {
        if ($this->associatedWebTvs->count() < 3) {
            while ($this->associatedWebTvs->count() != 3) {
                $entity = new FDCPageWebTvLiveWebTvAssociated();
                $entity->setFDCPageWebTvLive($this);
                $this->associatedWebTvs->add($entity);
            }
        }

        return $this->associatedWebTvs;
    }


    /**
     * Add associatedWebTvs
     *
     * @param \Base\CoreBundle\Entity\FDCPageWebTvLiveWebTvAssociated $associatedWebTvs
     * @return FDCPageWebTvLive
     */
    public function addAssociatedWebTv(\Base\CoreBundle\Entity\FDCPageWebTvLiveWebTvAssociated $associatedWebTvs)
    {
        $associatedWebTvs->setFDCPageWebTvLive($this);
        $this->associatedWebTvs[] = $associatedWebTvs;

        return $this;
    }

    /**
     * Remove associatedWebTvs
     *
     * @param \Base\CoreBundle\Entity\FDCPageWebTvLiveWebTvAssociated $associatedWebTvs
     */
    public function removeAssociatedWebTv(\Base\CoreBundle\Entity\FDCPageWebTvLiveWebTvAssociated $associatedWebTvs)
    {
        $this->associatedWebTvs->removeElement($associatedWebTvs);
    }

    public function __toString()
    {
        return (string) $this->getCurrentTranslation()->getTitle();
    }


    /**
     * Add associatedFilmFilms
     *
     * @param \Base\CoreBundle\Entity\FDCPageWebTvLiveFilmFilmAssociated $associatedFilmFilms
     * @return FDCPageWebTvLive
     */
    public function addAssociatedFilmFilm(\Base\CoreBundle\Entity\FDCPageWebTvLiveFilmFilmAssociated $associatedFilmFilms)
    {
        $associatedFilmFilms->setFDCPageWebTvLive($this);
        $this->associatedFilmFilms[] = $associatedFilmFilms;

        return $this;
    }

    /**
     * Remove associatedFilmFilms
     *
     * @param \Base\CoreBundle\Entity\FDCPageWebTvLiveFilmFilmAssociated $associatedFilmFilms
     */
    public function removeAssociatedFilmFilm(\Base\CoreBundle\Entity\FDCPageWebTvLiveFilmFilmAssociated $associatedFilmFilms)
    {
        $this->associatedFilmFilms->removeElement($associatedFilmFilms);
    }

    /**
     * Get associatedFilmFilms
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getAssociatedFilmFilms()
    {
        if ($this->associatedFilmFilms->count() < 3) {
            while ($this->associatedFilmFilms->count() != 3) {
                $entity = new FDCPageWebTvLiveFilmFilmAssociated();
                $entity->setFDCPageWebTvLive($this);
                $this->associatedFilmFilms->add($entity);
            }
        }
        return $this->associatedFilmFilms;
    }
}
