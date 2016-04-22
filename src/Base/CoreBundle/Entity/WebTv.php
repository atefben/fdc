<?php

namespace Base\CoreBundle\Entity;

use A2lix\I18nDoctrineBundle\Doctrine\ORM\Util\Translatable;

use Base\AdminBundle\Component\Admin\Export;
use Base\CoreBundle\Util\SeoMain;
use Base\CoreBundle\Util\Time;
use Base\CoreBundle\Util\TranslateMain;
use Base\CoreBundle\Interfaces\TranslateMainInterface;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

use JMS\Serializer\Annotation as Serializer;
use JMS\Serializer\Annotation\Groups;
use JMS\Serializer\Annotation\Since;

use Symfony\Component\Validator\Constraints as Assert;

/**
 * WebTv
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Base\CoreBundle\Repository\WebTvRepository")
 * @ORM\HasLifecycleCallbacks
 */
class WebTv implements TranslateMainInterface
{
    use Time;
    use TranslateMain;
    use Translatable;
    use SeoMain;

    /**
     * @var string
     *
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     *
     * @Groups({"live", "web_tv_show", "live"})
     */
    private $id;

    /**
     * @var FilmFestival
     *
     * @ORM\ManyToOne(targetEntity="FilmFestival")
     */
    private $festival;

    /**
     * @ORM\OneToMany(targetEntity="MediaVideo", mappedBy="webTv")
     *
     * @Groups({"live", "web_tv_show", "live"})
     */
    private $mediaVideos;

    /**
     * @var Homepage
     *
     * @ORM\ManyToOne(targetEntity="Homepage", inversedBy="topWebTvs")
     */
    private $homepage;

    /**
     * @ORM\ManyToOne(targetEntity="MediaImageSimple")
     *
     * @Groups({"live", "web_tv_show", "live"})
     */
    private $image;

    /**
     * @ORM\OneToMany(targetEntity="FDCPageWebTvLiveWebTvAssociated", mappedBy="association")
     *
     */
    private $associatedWebTvs;

    /**
     * @var ArrayCollection
     *
     * @Groups({"live", "web_tv_show", "live"})
     * @Assert\Valid()
     */
    protected $translations;

    public function __construct()
    {
        $this->translations = new ArrayCollection();
    }

    public function __toString()
    {
        $translationFr = $this->findTranslationByLocale('fr');
        if ($translationFr !== null) {
            return $translationFr->getName();
        }
        return '';
    }

    /**
     * Set id
     *
     * @param integer $id
     * @return WebTV
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
     * Add mediaVideos
     *
     * @param \Base\CoreBundle\Entity\MediaVideo $mediaVideos
     * @return WebTv
     */
    public function addMediaVideo(\Base\CoreBundle\Entity\MediaVideo $mediaVideos)
    {
        $this->mediaVideos[] = $mediaVideos;

        return $this;
    }

    /**
     * Remove mediaVideos
     *
     * @param \Base\CoreBundle\Entity\MediaVideo $mediaVideos
     */
    public function removeMediaVideo(\Base\CoreBundle\Entity\MediaVideo $mediaVideos)
    {
        $this->mediaVideos->removeElement($mediaVideos);
    }

    /**
     * Get mediaVideos
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getMediaVideos()
    {
        return $this->mediaVideos;
    }

    /**
     * @param $array
     * @return $this
     */
    public function setMediaVideos($array)
    {
        $collection = new ArrayCollection($array);
        $this->mediaVideos = $collection;
        return $this;
    }

    /**
     * Set homepage
     *
     * @param \Base\CoreBundle\Entity\Homepage $homepage
     * @return WebTv
     */
    public function setHomepage(\Base\CoreBundle\Entity\Homepage $homepage = null)
    {
        $this->homepage = $homepage;

        return $this;
    }

    /**
     * Get homepage
     *
     * @return \Base\CoreBundle\Entity\Homepage
     */
    public function getHomepage()
    {
        return $this->homepage;
    }


    /**
     * Set festival
     *
     * @param \Base\CoreBundle\Entity\FilmFestival $festival
     * @return WebTv
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
     * Set image
     *
     * @param \Base\CoreBundle\Entity\MediaImageSimple $image
     * @return WebTv
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

    public function getExportCreatedAt()
    {
        return Export::formatDate($this->getCreatedAt());
    }

    public function getExportUpdatedAt()
    {
        return Export::formatDate($this->getUpdatedAt());
    }

    public function getExportName()
    {
        return Export::translationField($this, 'name', 'fr');
    }

    public function getExportStatusMaster()
    {
        $status = $this->findTranslationByLocale('fr')->getStatus();
        return Export::formatTranslationStatus($status);
    }

    public function getExportTranslationEn()
    {
        return Export::translationField($this, 'name', 'en');
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

    public function getExportTranslationEs()
    {
        return Export::translationField($this, 'name', 'es');
    }

    public function getExportStatusZh()
    {
        $status = $this->findTranslationByLocale('zh')->getStatus();
        return Export::formatTranslationStatus($status);
    }

    public function getExportTranslationZh()
    {
        return Export::translationField($this, 'name', 'zh');
    }

    /**
     * Add associatedWebTvs
     *
     * @param \Base\CoreBundle\Entity\FDCPageWebTvLiveWebTvAssociated $associatedWebTvs
     * @return WebTv
     */
    public function addAssociatedWebTv(\Base\CoreBundle\Entity\FDCPageWebTvLiveWebTvAssociated $associatedWebTvs)
    {
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

    /**
     * Get associatedWebTvs
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getAssociatedWebTvs()
    {
        return $this->associatedWebTvs;
    }
}
