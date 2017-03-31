<?php

namespace Base\CoreBundle\Entity;

use A2lix\I18nDoctrineBundle\Doctrine\ORM\Util\Translatable;
use Base\CoreBundle\Interfaces\TranslateMainInterface;
use Base\CoreBundle\Util\SeoMain;
use Base\CoreBundle\Util\Time;
use Base\CoreBundle\Util\TranslateMain;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use JMS\Serializer\Annotation\Groups;
use JMS\Serializer\Annotation\VirtualProperty;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * FDCPageLaSelectionCannesClassics
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Base\CoreBundle\Repository\FDCPageLaSelectionCannesClassicsRepository")
 * @ORM\HasLifecycleCallbacks
 */
class FDCPageLaSelectionCannesClassics implements TranslateMainInterface
{
    use Time;
    use Translatable;
    use TranslateMain;
    use SeoMain;

    /**
     * @var integer
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @Groups({"classics"})
     */
    protected $id;

    /**
     * @var MediaImageSimple
     * @ORM\ManyToOne(targetEntity="MediaImageSimple")
     */
    protected $image;

    /**
     * @var NewsWidget
     * @ORM\OneToMany(targetEntity="FDCPageLaSelectionCannesClassicsWidget", mappedBy="FDCPageLaSelectionCannesClassics",
     *     cascade={"all"}, orphanRemoval=true)
     * @ORM\OrderBy({"position" = "ASC"})
     */
    protected $widgets;

    /**
     * @var integer
     * @ORM\Column(type="integer", nullable=false)
     */
    protected $weight;

    /**
     * @var \Application\Sonata\UserBundle\Entity\User
     * @ORM\ManyToOne(targetEntity="Application\Sonata\UserBundle\Entity\User")
     */
    protected $createdBy;

    /**
     * @var \Application\Sonata\UserBundle\Entity\User
     * @ORM\ManyToOne(targetEntity="Application\Sonata\UserBundle\Entity\User")
     */
    protected $updatedBy;

    /**
     * @var ArrayCollection
     * @Assert\Valid()
     * @Groups({"classics"})
     */
    protected $translations;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    protected $oldNewsId;

    /**
     * @var string
     * @ORM\Column(type="string", nullable=true)
     */
    protected $oldNewsTable;

    /**
     * @var \DateTime
     * @ORM\Column(name="published_at", type="datetime", nullable=true)
     */
    protected $publishedAt;

    /**
     * @var \DateTime
     * @ORM\Column(name="publish_ended_at", type="datetime", nullable=true)
     */
    protected $publishEndedAt;

    /**
     * @var Site
     *
     * @ORM\ManyToMany(targetEntity="Site")
     *
     */
    protected $sites;

    /**
     * @var FilmFestival
     *
     * @ORM\ManyToOne(targetEntity="FilmFestival")
     */
    protected $festival;


    /**
     * FDCPageLaSelection constructor.
     */
    public function __construct()
    {
        $this->translations = new ArrayCollection();
        $this->widgets = new ArrayCollection();
        $this->sites = new ArrayCollection();
    }

    /**
     * @return string
     */
    public function __toString()
    {
        $string = 'Cannes Classics';

        if ($this->getId()) {
            $trans = $this->findTranslationByLocale('fr');
            if ($trans !== null && $trans->getTitle() !== null) {
                $string = $trans->getTitle();
            }
        }

        return $string;
    }

    /**
     * Get id
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set image
     * @param \Base\CoreBundle\Entity\MediaImageSimple $image
     * @return $this
     */
    public function setImage(\Base\CoreBundle\Entity\MediaImageSimple $image = null)
    {
        $this->image = $image;

        return $this;
    }

    /**
     * Get image
     * @return \Base\CoreBundle\Entity\MediaImageSimple
     */
    public function getImage()
    {
        return $this->image;
    }

    /**
     * Add widgets
     * @param \Base\CoreBundle\Entity\FDCPageLaSelectionCannesClassicsWidget $widgets
     * @return FDCPageLaSelectionCannesClassics
     */
    public function addWidget(\Base\CoreBundle\Entity\FDCPageLaSelectionCannesClassicsWidget $widgets)
    {
        $widgets->setFDCPageLaSelectionCannesClassics($this);
        $this->widgets[] = $widgets;

        return $this;
    }

    /**
     * Remove widgets
     * @param \Base\CoreBundle\Entity\FDCPageLaSelectionCannesClassicsWidget $widgets
     */
    public function removeWidget(\Base\CoreBundle\Entity\FDCPageLaSelectionCannesClassicsWidget $widgets)
    {
        $this->widgets->removeElement($widgets);
    }

    /**
     * Get widgets
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getWidgets()
    {
        return $this->widgets;
    }

    /**
     * @VirtualProperty()
     * @Groups({"classics"})
     * @return array
     */
    public function getMovieWidgets()
    {
        $widgets = array();
        foreach ($this->widgets as $widget) {
            if ($widget instanceof FDCPageLaSelectionCannesClassicsWidgetMovie) {
                $widgets[] = $widget;
            }
        }
        return $widgets;
    }

    /**
     * Set createdBy
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
     * @return \Application\Sonata\UserBundle\Entity\User
     */
    public function getCreatedBy()
    {
        return $this->createdBy;
    }

    /**
     * Set updatedBy
     * @param \Application\Sonata\UserBundle\Entity\User $updatedBy
     * @return FDCPageLaSelectionCannesClassics
     */
    public function setUpdatedBy(\Application\Sonata\UserBundle\Entity\User $updatedBy = null)
    {
        $this->updatedBy = $updatedBy;

        return $this;
    }

    /**
     * Get updatedBy
     * @return \Application\Sonata\UserBundle\Entity\User
     */
    public function getUpdatedBy()
    {
        return $this->updatedBy;
    }

    /**
     * Set weight
     * @param integer $weight
     * @return FDCPageLaSelectionCannesClassics
     */
    public function setWeight($weight)
    {
        $this->weight = $weight;

        return $this;
    }

    /**
     * Get weight
     * @return integer
     */
    public function getWeight()
    {
        return $this->weight;
    }

    /**
     * Set oldNewsId
     * @param integer $oldNewsId
     * @return FDCPageLaSelectionCannesClassics
     */
    public function setOldNewsId($oldNewsId)
    {
        $this->oldNewsId = $oldNewsId;

        return $this;
    }

    /**
     * Get oldNewsId
     * @return integer
     */
    public function getOldNewsId()
    {
        return $this->oldNewsId;
    }

    /**
     * Set oldNewsTable
     * @param string $oldNewsTable
     * @return FDCPageLaSelectionCannesClassics
     */
    public function setOldNewsTable($oldNewsTable)
    {
        $this->oldNewsTable = $oldNewsTable;

        return $this;
    }

    /**
     * Get oldNewsTable
     * @return string
     */
    public function getOldNewsTable()
    {
        return $this->oldNewsTable;
    }

    /**
     * Set publishedAt
     *
     * @param \DateTime $publishedAt
     * @return $this
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
     * @return $this
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
     * Set festival
     *
     * @param \Base\CoreBundle\Entity\FilmFestival $festival
     * @return FDCPageLaSelectionCannesClassics
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
}
