<?php

namespace FDC\MarcheDuFilmBundle\Entity;

use A2lix\I18nDoctrineBundle\Doctrine\ORM\Util\Translatable;
use Base\CoreBundle\Interfaces\TranslateMainInterface;

use Base\CoreBundle\Util\TranslateMain;
use Base\AdminBundle\Component\Admin\Export;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

use Base\CoreBundle\Util\Time;
use JMS\Serializer\Annotation\Groups;

/**
 * GalleryMdf
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Base\CoreBundle\Repository\TranslationRepository")
 * @ORM\HasLifecycleCallbacks()
 */
class GalleryMdf implements TranslateMainInterface
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
    private $id;

    /**
     * @var GalleryMdfMedia
     *
     * @ORM\OneToMany(targetEntity="GalleryMdfMedia", mappedBy="gallery", cascade={"persist", "remove"}, orphanRemoval=true)
     * @Groups({"news_list", "search", "news_show", "event_show", "home"})
     * @ORM\OrderBy({"position" = "ASC"})
     */
    private $medias;

    /**
     * @var GalleryMdfMedia
     *
     * @ORM\OneToMany(targetEntity="MdfContentTemplateWidgetGallery", mappedBy="gallery")
     * @ORM\OrderBy({"position" = "ASC"})
     */
    private $contentTemplate;

    /**
     * @var GalleryMdfMedia
     *
     * @ORM\OneToMany(targetEntity="MdfHomepage", mappedBy="gallery")
     * @ORM\OrderBy({"position" = "ASC"})
     */
    private $homepage;

    /**
     * ArrayCollection
     */
    protected $translations;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->translations = new ArrayCollection();
        $this->medias = new ArrayCollection();
        $this->contentTemplate = new ArrayCollection();
        $this->homepage = new ArrayCollection();
    }

    public function __toString()
    {
        $translation = $this->findTranslationByLocale('fr');

        if ($translation !== null) {
            $string = $translation->getName();
        } else {
            $string = strval($this->getId());
        }
        return (string) $string;
    }

    public function getName()
    {
        $translation = $this->findTranslationByLocale('fr');
        $string = '';

        if ($translation !== null) {
            $string = $translation->getName();
        }

        return $string;
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
     * @param MdfContentTemplateWidgetGallery $contentTemplate
     * @return $this
     */
    public function addContentTemplate(\FDC\MarcheDuFilmBundle\Entity\MdfContentTemplateWidgetGallery $contentTemplate)
    {
        $contentTemplate->setGallery($this);
        $this->contentTemplate[] = $contentTemplate;

        return $this;
    }

    /**
     * @param MdfContentTemplateWidgetGallery $contentTemplate
     */
    public function removeContentTemplate(\FDC\MarcheDuFilmBundle\Entity\MdfContentTemplateWidgetGallery $contentTemplate)
    {
        $this->contentTemplate->removeElement($contentTemplate);
    }

    /**
     * @return GalleryMdfMedia
     */
    public function getContentTemplate()
    {
        return $this->contentTemplate;
    }

    /**
     * @param MdfHomepage $homepage
     * @return $this
     */
    public function addHomepage(\FDC\MarcheDuFilmBundle\Entity\MdfHomepage $homepage)
    {
        $homepage->setGallery($this);
        $this->homepage[] = $homepage;

        return $this;
    }

    /**
     * @param MdfHomepage $homepage
     */
    public function removeHomepage(\FDC\MarcheDuFilmBundle\Entity\MdfHomepage $homepage)
    {
        $this->homepage->removeElement($homepage);
    }

    /**
     * @return GalleryMdfMedia
     */
    public function getHomepage()
    {
        return $this->homepage;
    }

    /**
     * Add medias
     *
     * @param \FDC\MarcheDuFilmBundle\Entity\GalleryMdfMedia $medias
     * @return MediaGallery
     */
    public function addMedia(\FDC\MarcheDuFilmBundle\Entity\GalleryMdfMedia $medias)
    {
        $medias->setGallery($this);
        $this->medias[] = $medias;

        return $this;
    }

    /**
     * Remove medias
     *
     * @param \FDC\MarcheDuFilmBundle\Entity\GalleryMdfMedia $medias
     */
    public function removeMedia(\FDC\MarcheDuFilmBundle\Entity\GalleryMdfMedia $medias)
    {
        $this->medias->removeElement($medias);
    }

    /**
     * Get medias
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getMedias()
    {
        return $this->medias;
    }

    public function getExportCreatedAt()
    {
        return Export::formatDate($this->getCreatedAt());
    }

    public function getExportUpdatedAt()
    {
        return Export::formatDate($this->getUpdatedAt());
    }
}
