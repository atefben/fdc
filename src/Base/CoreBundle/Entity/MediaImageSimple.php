<?php

namespace Base\CoreBundle\Entity;

use A2lix\I18nDoctrineBundle\Doctrine\ORM\Util\Translatable;

use Base\AdminBundle\Component\Admin\Export;
use Base\CoreBundle\Interfaces\TranslateMainInterface;
use Base\CoreBundle\Util\Time;
use Base\CoreBundle\Util\TranslateMain;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

use JMS\Serializer\Annotation as Serializer;
use JMS\Serializer\Annotation\Groups;
use JMS\Serializer\Annotation\Since;

use Symfony\Component\Validator\Constraints as Assert;

use Application\Sonata\UserBundle\Entity\User;

/**
 * MediaImageSimple
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Base\CoreBundle\Repository\TranslationRepository")
 * @ORM\HasLifecycleCallbacks()
 */
class MediaImageSimple implements TranslateMainInterface
{
    use Translatable;
    use Time;
    use TranslateMain;

    /**
     * @var integer
     *
     * @ORM\Column(type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    protected $id;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=255)
     *
     * @Groups({
     *     "news_list", "search",
     *     "news_show",
     *     "live",
     *     "web_tv_show", "live",
     *     "film_show",
     *     "person_list",
     *     "person_show",
     *     "film_list",
     *     "film_show",
     *     "award_list",
     *     "award_show",
     *     "projection_list", "projection_list_2017", "programmation",
     *     "projection_show", "programmation_main",
     *     "film_selection_section_show",
     *     "event_show",
     *     "jury_list",
     *     "jury_show",
     *     "classics",
     *     "orange_programmation_ocs",
     *     "orange_video_on_demand",
     *     "orange_studio",
     *     "search"
     * })
     */
    protected $name;
    
    /**
     * @var User
     *
     * @ORM\ManyToOne(targetEntity="Application\Sonata\UserBundle\Entity\User")
     *
     */
    protected $createdBy;

    /**
     * @var User
     *
     * @ORM\ManyToOne(targetEntity="Application\Sonata\UserBundle\Entity\User")
     *
     */
    protected $updatedBy;


    /**
     * @var ArrayCollection
     *
     *
     * @Assert\Valid()
     * @Groups({
     *     "news_list", "search",
     *     "news_show",
     *     "live",
     *     "web_tv_show", "live",
     *     "film_list",
     *     "film_show",
     *     "event_show",
     *     "jury_list",
     *     "jury_show",
     *     "classics",
     *     "orange_programmation_ocs",
     *     "orange_video_on_demand",
     *     "orange_studio",
     *     "projection_list", "projection_list_2017", "programmation",
     *     "projection_show", "programmation_main",
     *     "search"
     * })
     * @Serializer\Accessor(getter="getApiTranslations")
     */
    protected $translations;

    /**
     * @var ArrayCollection
     *
     * @ORM\ManyToMany(targetEntity="Site")
     */
    protected $sites;

    /**
     * @var ArrayCollection
     *
     * @ORM\OneToMany(targetEntity="Base\CoreBundle\Entity\FilmFilm", mappedBy="imageMain")
     */
    protected $imageMainFilms;

    /**
     * @var ArrayCollection
     *
     * @ORM\OneToMany(targetEntity="Base\CoreBundle\Entity\FilmFilm", mappedBy="imageCover")
     */
    protected $imageCoverFilms;

    /**
     * MediaImageSimple constructor.
     */
    public function __construct()
    {
        $this->sites = new ArrayCollection();
        $this->imageMainFilms = new ArrayCollection();
        $this->imageCoverFilms = new ArrayCollection();
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
     * Set createdBy
     *
     * @param \Application\Sonata\UserBundle\Entity\User $createdBy
     * @return $this
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
     * @return $this
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
     * Add sites
     *
     * @param \Base\CoreBundle\Entity\Site $sites
     * @return $this
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

    /**
     * Set name
     *
     * @param string $name
     * @return $this
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string 
     */
    public function getName()
    {
        return $this->name;
    }

    public function __toString()
    {
        $string = substr(strrchr(get_class($this), '\\'), 1);

        if ($this->getId()) {
            $string = $this->getName();
        }

        return $string;
    }


    public function getExportAlt()
    {
        return Export::translationField($this, 'alt', 'fr');
    }


    public function getExportCreatedAt()
    {
        return Export::formatDate($this->getCreatedAt());
    }

    public function getExportUpdatedAt()
    {
        return Export::formatDate($this->getUpdatedAt());
    }

    public function getExportStatusMaster()
    {
        $status = $this->findTranslationByLocale('fr')->getStatus();
        return Export::formatTranslationStatus($status);
    }

    public function getExportStatusEn()
    {
        $status = $this->findTranslationByLocale('en')->getStatus();
        return Export::formatTranslationStatus($status);
    }

    public function getExportStatusEs()
    {
        $status = $this->findTranslationByLocale('es')->getStatus();
        return Export::formatTranslationStatus($status);
    }

    public function getExportStatusZh()
    {
        $status = $this->findTranslationByLocale('zh')->getStatus();
        return Export::formatTranslationStatus($status);
    }

    public function getApiTranslations()
    {
        $en = $this->findTranslationByLocale('en');
        $fr = $this->findTranslationByLocale('fr');
        if ((!$en || !$en->getFile() || $en->getStatus() !== MediaImageSimpleTranslation::STATUS_TRANSLATED) && $fr) {
            $this->translations->set('en', $fr);
        }

        return $this->translations;
    }


    /**
     * Add imageMainFilms
     *
     * @param \Base\CoreBundle\Entity\FilmFilm $imageMainFilms
     * @return $this
     */
    public function addImageMainFilm(\Base\CoreBundle\Entity\FilmFilm $imageMainFilms)
    {
        $this->imageMainFilms[] = $imageMainFilms;

        return $this;
    }

    /**
     * Remove imageMainFilms
     *
     * @param \Base\CoreBundle\Entity\FilmFilm $imageMainFilms
     */
    public function removeImageMainFilm(\Base\CoreBundle\Entity\FilmFilm $imageMainFilms)
    {
        $this->imageMainFilms->removeElement($imageMainFilms);
    }

    /**
     * Get imageMainFilms
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getImageMainFilms()
    {
        return $this->imageMainFilms;
    }

    /**
     * Add imageCoverFilms
     *
     * @param \Base\CoreBundle\Entity\FilmFilm $imageCoverFilms
     * @return $this
     */
    public function addImageCoverFilm(\Base\CoreBundle\Entity\FilmFilm $imageCoverFilms)
    {
        $this->imageCoverFilms[] = $imageCoverFilms;

        return $this;
    }

    /**
     * Remove imageCoverFilms
     *
     * @param \Base\CoreBundle\Entity\FilmFilm $imageCoverFilms
     */
    public function removeImageCoverFilm(\Base\CoreBundle\Entity\FilmFilm $imageCoverFilms)
    {
        $this->imageCoverFilms->removeElement($imageCoverFilms);
    }

    /**
     * Get imageCoverFilms
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getImageCoverFilms()
    {
        return $this->imageCoverFilms;
    }
}
