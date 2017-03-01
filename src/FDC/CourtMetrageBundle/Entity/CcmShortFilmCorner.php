<?php

namespace FDC\CourtMetrageBundle\Entity;

use A2lix\I18nDoctrineBundle\Doctrine\ORM\Util\Translatable;
use Base\CoreBundle\Entity\MediaImageSimple;
use Base\CoreBundle\Util\TranslateMain;
use Base\CoreBundle\Interfaces\TranslateMainInterface;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * CcmShortFilmCorner
 * @ORM\Table(name="ccm_short_film_corner")
 * @ORM\Entity(repositoryClass="FDC\CourtMetrageBundle\Repository\CcmShortFilmCornerRepository")
 */
class CcmShortFilmCorner implements TranslateMainInterface
{
    use Translatable;
    use TranslateMain;

    const TYPE_WHO_ARE_WE = 'who_are_we';
    const TYPE_OUR_EVENTS = 'our_events';
    const TYPE_RELIVE_EDITION = 'relive_edition';

    /**
     * @var integer
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @var string
     *
     * @ORM\Column(type="string", nullable=false)
     */
    protected $type;

    /**
     * @var MediaImageSimple
     *
     * @ORM\ManyToOne(targetEntity="Base\CoreBundle\Entity\MediaImageSimple")
     */
    protected $image;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="published_at", type="datetime", nullable=true)
     */
    protected $publishedAt;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="publish_ended_at", type="datetime", nullable=true)
     */
    protected $publishEndedAt;

    /**
     * @var ArrayCollection
     */
    protected $translations;

    /**
     * @var int
     *
     * @ORM\Column(name="menu_order", type="smallint", nullable=true, options={"unsigned": true})
     */
    protected $menuOrder;

    /**
     * @var CcmShortFilmCornerWidget
     *
     * @ORM\OneToMany(targetEntity="CcmShortFilmCornerWidget", mappedBy="shortFilmCorner", cascade={"all"}, orphanRemoval=true)
     *
     * @ORM\OrderBy({"position" = "ASC"})
     */
    protected $widgets;

    /**
     * @ORM\OneToMany(targetEntity="HomepageSejour", mappedBy="shortFilm", cascade={"persist", "remove", "refresh"}, orphanRemoval=true)
     * @Assert\Count(
     *      min = "1",
     *      minMessage = "ccm.validation.homepage.sejour_min",
     *      max = "1",
     *      maxMessage = "ccm.validation.homepage.sejour_max"
     * )
     * @Assert\Valid
     */
    protected $sejoures;

    /**
     * @var boolean
     *
     * @ORM\Column(type="boolean")
     */
    protected $sejourIsActive = false;

    /**
     * @var integer
     *
     * @ORM\Column(type="integer")
     */
    protected $positionSejour;

    /**
     * @var boolean
     *
     * @ORM\Column(type="boolean")
     */
    protected $actualiteIsActive = false;

    /**
     * @var integer
     *
     * @ORM\Column(type="integer")
     */
    protected $positionActualites;

    /**
     * @var boolean
     *
     * @ORM\Column(type="boolean")
     */
    protected $socialIsActive = false;

    /**
     * @var integer
     *
     * @ORM\Column(type="integer")
     */
    protected $positionSocial;

    /**
     * @var integer
     *
     * @ORM\Column(type="integer")
     */
    protected $positionCatalog;

    /**
     * @var boolean
     *
     * @ORM\Column(type="boolean")
     */
    protected $catalogIsActive = false;

    /**
     * CcmShortFilmCorner constructor.
     */
    public function __construct()
    {
        $this->translations = new ArrayCollection();
        $this->widgets = new ArrayCollection();
        $this->sejoures =  new ArrayCollection();
    }

    /**
     * @return string
     */
    public function __toString()
    {
        /** @var CcmShortFilmCornerTranslation $translation */
        $translation = $this->findTranslationByLocale('fr');

        if ($translation !== null) {
            $string = $translation->getTitle();
        } else {
            $string = strval($this->getId());
        }

        return (string) $string;
    }

    /**
     * @return string
     */
    public function getTitle()
    {
        /** @var CcmShortFilmCornerTranslation $translation */
        $translation = $this->findTranslationByLocale('fr');
        $string = '';

        if ($translation !== null) {
            $string = $translation->getTitle();
        }

        return $string;
    }

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * @param $type
     *
     * @return $this
     */
    public function setType($type)
    {
        $this->type = $type;

        return $this;
    }

    /**
     * @return \DateTime
     */
    public function getPublishedAt()
    {
        return $this->publishedAt;
    }

    /**
     * @param $publishedAt
     *
     * @return $this
     */
    public function setPublishedAt($publishedAt)
    {
        $this->publishedAt = $publishedAt;

        return $this;
    }

    /**
     * @return \DateTime
     */
    public function getPublishEndedAt()
    {
        return $this->publishEndedAt;
    }

    /**
     * @param $publishEndedAt
     *
     * @return $this
     */
    public function setPublishEndedAt($publishEndedAt)
    {
        $this->publishEndedAt = $publishEndedAt;

        return $this;
    }
    
    /**
     * Set image
     *
     * @param MediaImageSimple $image
     * @return CcmShortFilmCorner
     */
    public function setImage(MediaImageSimple $image = null)
    {
        $this->image = $image;

        return $this;
    }

    /**
     * Get image
     *
     * @return MediaImageSimple
     */
    public function getImage()
    {
        return $this->image;
    }

    /**
     * Add widgets
     *
     * @param \FDC\CourtMetrageBundle\Entity\CcmShortFilmCornerWidget $widget
     * @return CcmShortFilmCorner
     */
    public function addWidget(CcmShortFilmCornerWidget $widget)
    {
        $widget->setShortFilmCorner($this);
        $this->widgets[] = $widget;

        return $this;
    }

    /**
     * Remove widgets
     *
     * @param \FDC\CourtMetrageBundle\Entity\CcmShortFilmCornerWidget $widget
     */
    public function removeWidget(CcmShortFilmCornerWidget $widget)
    {
        $this->widgets->removeElement($widget);
    }

    /**
     * Get widgets
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getWidgets()
    {
        return $this->widgets;
    }

    /**
     * @return int
     */
    public function getMenuOrder()
    {
        return $this->menuOrder;
    }

    /**
     * @param $menuOrder
     * @return CcmShortFilmCorner
     */
    public function setMenuOrder($menuOrder)
    {
        $this->menuOrder = $menuOrder;

        return $this;
    }

    /**
     * Get sejoures.
     *
     * @return mixed
     */
    public function getSejoures()
    {
        return $this->sejoures;
    }

    /**
     * Set sejoures.
     *
     * @param mixed $sejoures
     */
    public function setSejoures($sejoures)
    {
        $this->sejoures = $sejoures;

        return $this;
    }

    /**
     * Get sejourIsActive.
     *
     * @return bool
     */
    public function getSejourIsActive()
    {
        return $this->sejourIsActive;
    }

    /**
     * Set sejourIsActive.
     *
     * @param bool $sejourIsActive
     */
    public function setSejourIsActive($sejourIsActive)
    {
        $this->sejourIsActive = $sejourIsActive;

        return $this;
    }

    /**
     * Get positionSejour.
     *
     * @return int
     */
    public function getPositionSejour()
    {
        return $this->positionSejour;
    }

    /**
     * Set positionSejour.
     *
     * @param int $positionSejour
     */
    public function setPositionSejour($positionSejour)
    {
        $this->positionSejour = $positionSejour;

        return $this;
    }

    /**
     * Add sejour.
     *
     * @param HomepageSejour $sejour
     *
     * @return $this
     */
    public function addSejour(HomepageSejour $sejour)
    {
        $this->sejoures->add($sejour);
        $sejour->setShortFilm($this);

        return $this;
    }

    /**
     * Remove sejour.
     *
     * @param HomepageSejour $sejour
     */
    public function removeSejour(HomepageSejour $sejour)
    {
        $this->sejoures->removeElement($sejour);
    }

    /**
     * Get actualiteIsActive.
     *
     * @return bool
     */
    public function getActualiteIsActive()
    {
        return $this->actualiteIsActive;
    }

    /**
     * Set actualiteIsActive.
     *
     * @param bool $actualiteIsActive
     */
    public function setActualiteIsActive($actualiteIsActive)
    {
        $this->actualiteIsActive = $actualiteIsActive;

        return $this;
    }

    /**
     * Get positionActualites.
     *
     * @return int
     */
    public function getPositionActualites()
    {
        return $this->positionActualites;
    }

    /**
     * Set positionActualite.
     *
     * @param int $positionActualites
     */
    public function setPositionActualites($positionActualites)
    {
        $this->positionActualites = $positionActualites;

        return $this;
    }

    /**
     * Get socialIsActive.
     *
     * @return bool
     */
    public function getSocialIsActive()
    {
        return $this->socialIsActive;
    }

    /**
     * Set socialIsActive.
     *
     * @param bool $socialIsActive
     */
    public function setSocialIsActive($socialIsActive)
    {
        $this->socialIsActive = $socialIsActive;

        return $this;
    }

    /**
     * Get PositionSocial.
     *
     * @return int
     */
    public function getPositionSocial()
    {
        return $this->positionSocial;
    }

    /**
     * Set positionSocial.
     *
     * @param int $positionSocial
     */
    public function setPositionSocial($positionSocial)
    {
        $this->positionSocial = $positionSocial;

        return $this;
    }

    /**
     * Get positionCatalog.
     *
     * @return int
     */
    public function getPositionCatalog()
    {
        return $this->positionCatalog;
    }

    /**
     * Set positionCatalog.
     *
     * @param int $positionCatalog
     */
    public function setPositionCatalog($positionCatalog)
    {
        $this->positionCatalog = $positionCatalog;

        return $this;
    }

    /**
     * Get catalogIsActive.
     *
     * @return bool
     */
    public function getCatalogIsActive()
    {
        return $this->catalogIsActive;
    }

    /**
     * Set catalogIsActive.
     *
     * @param bool $catalogIsActive
     */
    public function setCatalogIsActive($catalogIsActive)
    {
        $this->catalogIsActive = $catalogIsActive;
    }
}
