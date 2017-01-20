<?php

namespace FDC\MarcheDuFilmBundle\Entity;

use A2lix\I18nDoctrineBundle\Doctrine\ORM\Util\Translatable;
use Base\CoreBundle\Interfaces\TranslateMainInterface;
use Base\CoreBundle\Util\SeoMain;

use Base\CoreBundle\Util\TranslateMain;
use Base\AdminBundle\Component\Admin\Export;
use Base\CoreBundle\Util\TruncatePro;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use FDC\MarcheDuFilmBundle\Entity\MdfTheme;

use Base\CoreBundle\Util\Time;
use JMS\Serializer\Annotation\Groups;

/**
 * MdfServiceGallery
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Base\CoreBundle\Repository\TranslationRepository")
 * @ORM\HasLifecycleCallbacks()
 */
class MdfServiceGallery implements TranslateMainInterface
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
     * @ORM\OneToMany(targetEntity="MdfServiceGalleryMedia", mappedBy="gallery", cascade={"persist", "remove"}, orphanRemoval=true)
     * @Groups({"news_list", "search", "news_show", "event_show", "home"})
     * @ORM\OrderBy({"position" = "ASC"})
     */
    private $medias;

    /**
     * @var GalleryMdfMedia
     *
     * @ORM\OneToMany(targetEntity="ServiceWidgetProduct", mappedBy="gallery")
     * @ORM\OrderBy({"position" = "ASC"})
     */
    private $product;

    /**
     * @var boolean
     *
     * @ORM\Column(type="boolean", nullable=false, options={"default":0})
     */
    private $displayedHomeCorpo;

    /**
     * @var MdfTheme
     *
     * @ORM\ManyToOne(targetEntity="\FDC\MarcheDuFilmBundle\Entity\MdfTheme")
     *
     */
    private $themeHomeCorpo;

    /**
     * @var \DateTime
     *
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $dateHomeCorpo;
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
        $this->product = new ArrayCollection();
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
     * @param ServiceWidgetProduct $product
     * @return $this
     */
    public function addProduct(\FDC\MarcheDuFilmBundle\Entity\ServiceWidgetProduct $product)
    {
        $product->setGallery($this);
        $this->product[] = $product;

        return $this;
    }

    /**
     * @param ServiceWidgetProduct $product
     */
    public function removeProduct(\FDC\MarcheDuFilmBundle\Entity\ServiceWidgetProduct $product)
    {
        $this->product->removeElement($product);
    }

    /**
     * @return ArrayCollection|GalleryMdfMedia
     */
    public function getProduct()
    {
        return $this->product;
    }

    /**
     * @param MdfServiceGalleryMedia $medias
     * @return $this
     */
    public function addMedia(\FDC\MarcheDuFilmBundle\Entity\MdfServiceGalleryMedia $medias)
    {
        $medias->setGallery($this);
        $this->medias[] = $medias;

        return $this;
    }

    /**
     * @param MdfServiceGalleryMedia $medias
     */
    public function removeMedia(\FDC\MarcheDuFilmBundle\Entity\MdfServiceGalleryMedia $medias)
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


    /**
     * Set displayedHomeCorpo
     *
     * @param boolean $displayedHomeCorpo
     * @return GalleryMdf
     */
    public function setDisplayedHomeCorpo($displayedHomeCorpo)
    {
        $this->displayedHomeCorpo = $displayedHomeCorpo;

        return $this;
    }

    /**
     * Get displayedHomeCorpo
     *
     * @return boolean 
     */
    public function getDisplayedHomeCorpo()
    {
        return $this->displayedHomeCorpo;
    }

    /**
     * Set dateHomeCorpo
     *
     * @param \DateTime $dateHomeCorpo
     * @return GalleryMdf
     */
    public function setDateHomeCorpo($dateHomeCorpo)
    {
        $this->dateHomeCorpo = $dateHomeCorpo;

        return $this;
    }

    /**
     * Get dateHomeCorpo
     *
     * @return \DateTime 
     */
    public function getDateHomeCorpo()
    {
        return $this->dateHomeCorpo;
    }

    /**
     * Set themeHomeCorpo
     *
     * @param \FDC\MarcheDuFilmBundle\Entity\MdfTheme $themeHomeCorpo
     * @return GalleryMdf
     */
    public function setThemeHomeCorpo(\FDC\MarcheDuFilmBundle\Entity\MdfTheme $themeHomeCorpo = null)
    {
        $this->themeHomeCorpo = $themeHomeCorpo;

        return $this;
    }

    /**
     * Get themeHomeCorpo
     *
     * @return \FDC\MarcheDuFilmBundle\Entity\MdfTheme
     */
    public function getThemeHomeCorpo()
    {
        return $this->themeHomeCorpo;
    }
}
