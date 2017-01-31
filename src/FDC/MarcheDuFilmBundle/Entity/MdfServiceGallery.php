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
}

