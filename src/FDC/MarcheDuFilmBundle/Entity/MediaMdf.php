<?php

namespace FDC\MarcheDuFilmBundle\Entity;

use Application\Sonata\UserBundle\Entity\User;
use Base\CoreBundle\Interfaces\TranslateChildInterface;
use Base\CoreBundle\Interfaces\TranslateMainInterface;
use Base\CoreBundle\Util\SeoMain;
use Base\CoreBundle\Util\TranslateMain;
use Base\CoreBundle\Util\Time;

use Base\CoreBundle\Util\TruncatePro;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

use JMS\Serializer\Annotation as Serializer;
use JMS\Serializer\Annotation\Groups;
use JMS\Serializer\Annotation\Since;

use JMS\Serializer\Annotation\VirtualProperty;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * MediaMdf
 *
 * @ORM\Entity(repositoryClass="FDC\MarcheDuFilmBundle\Repository\MediaMdfRepository")
 * @ORM\HasLifecycleCallbacks()
 * @ORM\InheritanceType("JOINED")
 * @ORM\DiscriminatorColumn(name="type", type="string")
 * @ORM\DiscriminatorMap({"image" = "MediaMdfImage", "audio" = "MediaMdfAudio", "video" = "MediaMdfVideo"})
 */
abstract class MediaMdf implements TranslateMainInterface
{
    use Time;
    use SeoMain;
    use TranslateMain;
    use TruncatePro;

    /**
     * @var integer
     *
     * @ORM\Column(type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     * @Groups({"news_list", "search"})
     */
    protected $id;

    /**
     * @var Theme
     *
     * @ORM\ManyToOne(targetEntity="\FDC\MarcheDuFilmBundle\Entity\MdfTheme")
     *
     * @Groups({"news_list", "search", "news_show", "film_show", "live", "event_show", "home", "search"})
     */
    private $theme;

    /**
     * @var MediaMdfTag
     *
     * @ORM\OneToMany(targetEntity="MediaMdfTag", mappedBy="media", cascade={"persist"})
     */
    private $tags;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="published_at", type="datetime", nullable=true)
     * @Groups({
     *     "live",
     *     "web_tv_show",
     *     "film_list",
     *     "film_show",
     *     "news_list", "search",
     *     "news_show",
     *     "event_show",
     *     "home",
     *     "orange_video_on_demand",
     *     "search"
     * })
     * @Serializer\Accessor(getter="getApiPublishedAt")
     */
    private $publishedAt;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="publish_ended_at", type="datetime", nullable=true)
     * @Groups({
     *     "live",
     *     "web_tv_show",
     *     "film_list",
     *     "film_show",
     *     "news_list", "search",
     *     "news_show",
     *     "event_show",
     *     "home",
     *     "orange_video_on_demand",
     *     "search"
     * })
     *
     */
    private $publishEndedAt;

    /**
     * @var boolean
     *
     * @ORM\Column(type="boolean", options={"default":0})
     */
    private $displayedAll;

    /**
     * @var boolean
     *
     * @ORM\Column(type="boolean", options={"default":0}, nullable=true)
     */
    private $excludeFromSearch;

    /**
     * @var ArrayCollection
     * @Groups({
     *     "news_show",
     *     "news_list", "search",
     *     "trailer_show",
     *     "live",
     *     "web_tv_show",
     *     "live",
     *     "film_list",
     *     "film_show",
     *     "event_list", "search",
     *     "event_show",
     *     "home",
     *     "today_images",
     *     "live",
     *     "home",
     *     "orange_video_on_demand",
     *     "search"
     * })
     *
     * @Assert\Valid()
     */
    protected $translations;

    /**
     * @var User
     *
     * @ORM\ManyToOne(targetEntity="Application\Sonata\UserBundle\Entity\User")
     */
    private $createdBy;

    /**
     * @var User
     *
     * @ORM\ManyToOne(targetEntity="Application\Sonata\UserBundle\Entity\User")
     */
    private $updatedBy;

    public function __construct()
    {
        $this->translations = new ArrayCollection();
        $this->tags = new ArrayCollection();
        $this->displayedAll = false;
    }

    public function __toString()
    {
        $string = substr(strrchr(get_class($this), '\\'), 1);

        if ($this->getId()) {
            if ($string != 'MediaMdfImage') {
                if ($this->findTranslationByLocale('fr') != null) {
                    $string .= ' "' . $this->findTranslationByLocale('fr')->getTitle() . '"';
                    $string = $this->truncate($string, 40, '..."', true);
                }
            } else {
                if ($this->findTranslationByLocale('fr') != null) {
                    $string .= ' "' . $this->findTranslationByLocale('fr')->getLegend() . '"';
                    $string = $this->truncate($string, 40, '..."', true);
                }
            }
        }

        return $string;
    }

    /**
     * Get the class type in the Api
     *
     * @VirtualProperty
     * @Groups({"home", "news_list", "search", "news_show", "search"})
     */
    public function getMediaType()
    {
        return substr(strrchr(get_called_class(), '\\'), 1);
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
     * Add tags
     *
     * @param \FDC\MarcheDuFilmBundle\Entity\MediaMdfTag $tags
     * @return Media
     */
    public function addTag(\FDC\MarcheDuFilmBundle\Entity\MediaMdfTag $tags)
    {
        if ($this->tags->contains($tags)) {
            return;
        }

        $tags->setMedia($this);
        $this->tags[] = $tags;

        return $this;
    }

    /**
     * Remove tags
     *
     * @param \FDC\MarcheDuFilmBundle\Entity\MediaMdfTag $tags
     */
    public function removeTag(\FDC\MarcheDuFilmBundle\Entity\MediaMdfTag $tags)
    {
        if (!$this->tags->contains($tags)) {
            return;
        }

        $this->tags->removeElement($tags);
    }

    /**
     * Get tags
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getTags()
    {
        return $this->tags;
    }

    /**
     * Set publishedAt
     *
     * @param \DateTime $publishedAt
     * @return MediaMdfImageTranslation
     */
    public function setPublishedAt($publishedAt)
    {
        $this->publishedAt = $publishedAt;

        return $this;
    }

    /**
     * Get publishedAt
     *
     * @return \DateTime
     */
    public function getPublishedAt()
    {
        return $this->publishedAt;
    }

    /**
     * Set publishEndedAt
     *
     * @param \DateTime $publishEndedAt
     * @return MediaMdfImageTranslation
     */
    public function setPublishEndedAt($publishEndedAt)
    {
        $this->publishEndedAt = $publishEndedAt;

        return $this;
    }

    /**
     * Get publishEndedAt
     *
     * @return \DateTime
     */
    public function getPublishEndedAt()
    {
        return $this->publishEndedAt;
    }

    /**
     * Set displayedAll
     *
     * @param boolean $displayedAll
     * @return Media
     */
    public function setDisplayedAll($displayedAll)
    {
        $this->displayedAll = $displayedAll;

        return $this;
    }

    /**
     * Get displayedAll
     *
     * @return boolean
     */
    public function getDisplayedAll()
    {
        return $this->displayedAll;
    }

    /**
     * Set theme
     *
     * @param \FDC\MarcheDuFilmBundle\Entity\MdfTheme $theme
     * @return Media
     */
    public function setTheme(\FDC\MarcheDuFilmBundle\Entity\MdfTheme $theme = null)
    {
        $this->theme = $theme;

        return $this;
    }

    /**
     * Get theme
     *
     * @return \FDC\MarcheDuFilmBundle\Entity\MdfTheme
     */
    public function getTheme()
    {
        return $this->theme;
    }

    /**
     * Set createdBy
     *
     * @param \Application\Sonata\UserBundle\Entity\User $createdBy
     * @return Media
     */
    public function setCreatedBy(\Application\Sonata\UserBundle\Entity\User $createdBy = null)
    {
        $this->createdBy = $createdBy;

        return $this;
    }

    /**
     * Get createdBy
     *
     * @return \Application\Sonata\UserBundle\Entity\User
     */
    public function getCreatedBy()
    {
        return $this->createdBy;
    }

    /**
     * Set updatedBy
     *
     * @param \Application\Sonata\UserBundle\Entity\User $updatedBy
     * @return Media
     */
    public function setUpdatedBy(\Application\Sonata\UserBundle\Entity\User $updatedBy = null)
    {
        $this->updatedBy = $updatedBy;

        return $this;
    }

    /**
     * Get updatedBy
     *
     * @return \Application\Sonata\UserBundle\Entity\User
     */
    public function getUpdatedBy()
    {
        return $this->updatedBy;
    }

    public function isElasticable()
    {
        $isElasticable = true;
        $fr = $this->findTranslationByLocale('fr');
        if (!$fr || $fr->getStatus() !== TranslateChildInterface::STATUS_PUBLISHED) {
            $isElasticable = false;
        }
        if ($this->getExcludeFromSearch()) {
            $isElasticable = false;
        }
        return $isElasticable;
    }

    /**
     * Set excludeFromSearch
     *
     * @param boolean $excludeFromSearch
     * @return Media
     */
    public function setExcludeFromSearch($excludeFromSearch)
    {
        $this->excludeFromSearch = $excludeFromSearch;

        return $this;
    }

    /**
     * Get excludeFromSearch
     *
     * @return boolean
     */
    public function getExcludeFromSearch()
    {
        return $this->excludeFromSearch;
    }
}
