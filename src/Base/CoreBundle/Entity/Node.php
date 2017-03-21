<?php

namespace Base\CoreBundle\Entity;

use A2lix\I18nDoctrineBundle\Doctrine\ORM\Util\Translatable;
use Application\Sonata\UserBundle\Entity\User;
use Base\CoreBundle\Interfaces\TranslateMainInterface;
use Base\CoreBundle\Util\SeoMain;
use Base\CoreBundle\Util\Time;
use Base\CoreBundle\Util\TranslateMain;
use Base\CoreBundle\Util\TruncatePro;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Node
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Base\CoreBundle\Repository\NodeRepository")
 */
class Node implements TranslateMainInterface
{
    use Time;
    use SeoMain;
    use TranslateMain;
    use TruncatePro;
    use Translatable;

    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     * @ORM\Column(name="entity_class", type="text")
     */
    private $entityClass;

    /**
     * @var int
     * @ORM\Column(name="entity_id", type="integer")
     */
    private $entityId;

    /**
     * @var Theme
     *
     * @ORM\ManyToOne(targetEntity="Theme")
     * @ORM\JoinColumn(name="theme")
     */
    protected $theme;

    /**
     * @var FilmFestival
     * @ORM\ManyToOne(targetEntity="FilmFestival")
     * @ORM\JoinColumn(name="festival")
     */
    protected $festival;

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
     * @var User
     *
     * @ORM\ManyToOne(targetEntity="Application\Sonata\UserBundle\Entity\User")
     * @ORM\JoinColumn(name="created_by")
     */
    protected $createdBy;

    /**
     * @var User
     *
     * @ORM\ManyToOne(targetEntity="Application\Sonata\UserBundle\Entity\User")
     * @ORM\JoinColumn(name="updated_by")
     */
    protected $updatedBy;

    /**
     * @var boolean
     *
     * @ORM\Column(name="displayed_home", type="boolean", options={"default":0}, nullable=true)
     *
     */
    protected $displayedHome = false;


    /**
     * @var boolean
     *
     * @ORM\Column(name="type_clone", type="string", length=255, nullable=true)
     *
     */
    protected $typeClone;

    /**
     * @var boolean
     *
     * @ORM\Column(name="displayed_on_corpo_home", type="boolean", options={"default":0}, nullable=true)
     *
     */
    protected $displayedOnCorpoHome = false;

    /**
     * @var boolean
     *
     * @ORM\Column(name="displayed_mobile", type="boolean", options={"default":0}, nullable=true)
     */
    protected $displayedMobile = false;

    /**
     * @var string
     *
     * @ORM\Column(name="signature", type="string", nullable=true)
     */
    protected $signature;

    /**
     * @var MediaImage
     *
     * @ORM\ManyToOne(targetEntity="MediaImage")
     * @ORM\JoinColumn(name="main_image")
     *
     */
    protected $mainImage;

    /**
     * @var MediaVideo
     *
     * @ORM\ManyToOne(targetEntity="MediaVideo")
     * @ORM\JoinColumn(name="main_video")
     *
     */
    protected $mainVideo;

    /**
     * @var MediaAudio
     *
     * @ORM\ManyToOne(targetEntity="MediaAudio")
     * @ORM\JoinColumn(name="main_audio")
     *
     */
    protected $mainAudio;

    /**
     * @var Gallery
     *
     * @ORM\ManyToOne(targetEntity="Gallery")
     * @ORM\JoinColumn(name="main_gallery")
     *
     */
    protected $mainGallery;

    /**
     * @var ArrayCollection
     *
     * @ORM\ManyToMany(targetEntity="Site")
     *
     */
    protected $sites;

    public function __construct()
    {
        $this->translations = new ArrayCollection();
        $this->sites = new ArrayCollection();
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
     * Set entityClass
     *
     * @param string $entityClass
     * @return Node
     */
    public function setEntityClass($entityClass)
    {
        $this->entityClass = $entityClass;

        return $this;
    }

    /**
     * Get entityClass
     *
     * @return string 
     */
    public function getEntityClass()
    {
        return $this->entityClass;
    }

    /**
     * Set entityId
     *
     * @param integer $entityId
     * @return Node
     */
    public function setEntityId($entityId)
    {
        $this->entityId = $entityId;

        return $this;
    }

    /**
     * Get entityId
     *
     * @return integer 
     */
    public function getEntityId()
    {
        return $this->entityId;
    }

    /**
     * Set publishedAt
     *
     * @param \DateTime $publishedAt
     * @return Node
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
     * @return Node
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
     * Set displayedHome
     *
     * @param boolean $displayedHome
     * @return Node
     */
    public function setDisplayedHome($displayedHome)
    {
        $this->displayedHome = $displayedHome;

        return $this;
    }

    /**
     * Get displayedHome
     *
     * @return boolean 
     */
    public function getDisplayedHome()
    {
        return $this->displayedHome;
    }

    /**
     * Set displayedOnCorpoHome
     *
     * @param boolean $displayedOnCorpoHome
     * @return Node
     */
    public function setDisplayedOnCorpoHome($displayedOnCorpoHome)
    {
        $this->displayedOnCorpoHome = $displayedOnCorpoHome;

        return $this;
    }

    /**
     * Get displayedOnCorpoHome
     *
     * @return boolean 
     */
    public function getDisplayedOnCorpoHome()
    {
        return $this->displayedOnCorpoHome;
    }

    /**
     * Set displayedMobile
     *
     * @param boolean $displayedMobile
     * @return Node
     */
    public function setDisplayedMobile($displayedMobile)
    {
        $this->displayedMobile = $displayedMobile;

        return $this;
    }

    /**
     * Get displayedMobile
     *
     * @return boolean 
     */
    public function getDisplayedMobile()
    {
        return $this->displayedMobile;
    }

    /**
     * Set signature
     *
     * @param string $signature
     * @return Node
     */
    public function setSignature($signature)
    {
        $this->signature = $signature;

        return $this;
    }

    /**
     * Get signature
     *
     * @return string 
     */
    public function getSignature()
    {
        return $this->signature;
    }

    /**
     * Set theme
     *
     * @param \Base\CoreBundle\Entity\Theme $theme
     * @return Node
     */
    public function setTheme(\Base\CoreBundle\Entity\Theme $theme = null)
    {
        $this->theme = $theme;

        return $this;
    }

    /**
     * Get theme
     *
     * @return \Base\CoreBundle\Entity\Theme 
     */
    public function getTheme()
    {
        return $this->theme;
    }

    /**
     * Set festival
     *
     * @param \Base\CoreBundle\Entity\FilmFestival $festival
     * @return Node
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
     * Set createdBy
     *
     * @param \Application\Sonata\UserBundle\Entity\User $createdBy
     * @return Node
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
     * @return Node
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

    /**
     * Set mainImage
     *
     * @param \Base\CoreBundle\Entity\MediaImage $mainImage
     * @return Node
     */
    public function setMainImage(\Base\CoreBundle\Entity\MediaImage $mainImage = null)
    {
        $this->mainImage = $mainImage;

        return $this;
    }

    /**
     * Get mainImage
     *
     * @return \Base\CoreBundle\Entity\MediaImage 
     */
    public function getMainImage()
    {
        return $this->mainImage;
    }

    /**
     * Set mainVideo
     *
     * @param \Base\CoreBundle\Entity\MediaVideo $mainVideo
     * @return Node
     */
    public function setMainVideo(\Base\CoreBundle\Entity\MediaVideo $mainVideo = null)
    {
        $this->mainVideo = $mainVideo;

        return $this;
    }

    /**
     * Get mainVideo
     *
     * @return \Base\CoreBundle\Entity\MediaVideo 
     */
    public function getMainVideo()
    {
        return $this->mainVideo;
    }

    /**
     * Set mainAudio
     *
     * @param \Base\CoreBundle\Entity\MediaAudio $mainAudio
     * @return Node
     */
    public function setMainAudio(\Base\CoreBundle\Entity\MediaAudio $mainAudio = null)
    {
        $this->mainAudio = $mainAudio;

        return $this;
    }

    /**
     * Get mainAudio
     *
     * @return \Base\CoreBundle\Entity\MediaAudio 
     */
    public function getMainAudio()
    {
        return $this->mainAudio;
    }

    /**
     * Set mainGallery
     *
     * @param \Base\CoreBundle\Entity\Gallery $mainGallery
     * @return Node
     */
    public function setMainGallery(\Base\CoreBundle\Entity\Gallery $mainGallery = null)
    {
        $this->mainGallery = $mainGallery;

        return $this;
    }

    /**
     * Get mainGallery
     *
     * @return \Base\CoreBundle\Entity\Gallery 
     */
    public function getMainGallery()
    {
        return $this->mainGallery;
    }

    /**
     * Add sites
     *
     * @param \Base\CoreBundle\Entity\Site $sites
     * @return Node
     */
    public function addSite(\Base\CoreBundle\Entity\Site $sites)
    {
        $this->sites[] = $sites;

        return $this;
    }

    /**
     * Remove sites
     *
     * @param \Base\CoreBundle\Entity\Site $sites
     */
    public function removeSite(\Base\CoreBundle\Entity\Site $sites)
    {
        $this->sites->removeElement($sites);
    }

    /**
     * Get sites
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getSites()
    {
        return $this->sites;
    }
}
