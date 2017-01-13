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
     * @var string
     *
     * @ORM\Column(type="string", length=255)
     */
    private $name;

    /**
     * @var GalleryMdfMedia
     *
     * @ORM\OneToMany(targetEntity="GalleryMdfMedia", mappedBy="gallery", cascade={"persist", "remove"}, orphanRemoval=true)
     * @Groups({"news_list", "search", "news_show", "event_show", "home"})
     * @ORM\OrderBy({"position" = "ASC"})
     */
    private $medias;

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
    }
    
    public function __toString()
    {
        $string = substr(strrchr(get_class($this), '\\'), 1);

        if ($this->getId()) {
            $string .= ' "' . $this->getName() . '"';
            $string = $this->truncate($string, 40, '..."', true);
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

    /**
     * Set name
     *
     * @param string $name
     * @return GalleryMdf
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
