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
 * @ORM\Entity
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
     * @var CcmShortFilmCornerWidget
     *
     * @ORM\OneToMany(targetEntity="CcmShortFilmCornerWidget", mappedBy="shortFilmCorner", cascade={"all"}, orphanRemoval=true)
     *
     * @ORM\OrderBy({"position" = "ASC"})
     */
    protected $widgets;

    /**
     * CcmShortFilmCorner constructor.
     */
    public function __construct()
    {
        $this->translations = new ArrayCollection();
        $this->widgets = new ArrayCollection();
    }

    public function __toString()
    {
        $translation = $this->findTranslationByLocale('fr');

        if ($translation !== null) {
            $string = $translation->getTitle();
        } else {
            $string = strval($this->getId());
        }
        return (string) $string;
    }

    public function getTitle()
    {
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
     * @param CcmShortFilmCornerWidget $shortFilmCornerWidget
     */
    public function addContentTemplateWidget(CcmShortFilmCornerWidget $shortFilmCornerWidget)
    {
        $shortFilmCornerWidget->setShortFilmCorner($this);
        $this->widgets->add($shortFilmCornerWidget);
    }

    /**
     * @param CcmShortFilmCornerWidget $shortFilmCornerWidget
     */
    public function removeContentTemplateWidget(CcmShortFilmCornerWidget $shortFilmCornerWidget)
    {
        $this->widgets->removeElement($shortFilmCornerWidget);
    }

    /**
     * @return ArrayCollection|CcmShortFilmCornerWidget
     */
    public function getContentTemplateWidgets()
    {
        return $this->widgets;
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
     * @return CcmShortFilmCornerWidgetVideoYoutube
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
}
