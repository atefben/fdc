<?php

namespace Base\CoreBundle\Entity;

use A2lix\I18nDoctrineBundle\Doctrine\ORM\Util\Translatable;
use Base\CoreBundle\Interfaces\TranslateMainInterface;
use Base\CoreBundle\Util\SeoMain;

use Base\CoreBundle\Util\TranslateMain;
use Base\AdminBundle\Component\Admin\Export;
use Base\CoreBundle\Util\TruncatePro;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

use Base\CoreBundle\Util\Time;
use JMS\Serializer\Annotation\Groups;

/**
 * Gallery
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Base\CoreBundle\Repository\TranslationRepository")
 * @ORM\HasLifecycleCallbacks()
 */
class Gallery implements TranslateMainInterface
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
     * @ORM\Column(type="string", length=255)
     */
    protected $name;

    /**
     * @var GalleryMedia
     *
     * @ORM\OneToMany(targetEntity="GalleryMedia", mappedBy="gallery", cascade={"persist", "remove"}, orphanRemoval=true)
     * @Groups({"news_list", "search", "news_show", "event_show", "home"})
     * @ORM\OrderBy({"position" = "ASC"})
     */
    protected $medias;

    /**
     * @var boolean
     *
     * @ORM\Column(type="boolean", nullable=false, options={"default":0})
     */
    protected $displayedHomeCorpo;

    /**
     * @var Theme
     *
     * @ORM\ManyToOne(targetEntity="Theme")
     *
     */
    protected $themeHomeCorpo;

    /**
     * @var \DateTime
     *
     * @ORM\Column(type="datetime", nullable=true)
     */
    protected $dateHomeCorpo;

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
            $string = 'Gallery : ' . $this->getName();
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
     * @param \Base\CoreBundle\Entity\GalleryMedia $medias
     * @return MediaGallery
     */
    public function addMedia(\Base\CoreBundle\Entity\GalleryMedia $medias)
    {
        $medias->setGallery($this);
        $this->medias[] = $medias;

        return $this;
    }

    /**
     * Remove medias
     *
     * @param \Base\CoreBundle\Entity\GalleryMedia $medias
     */
    public function removeMedia(\Base\CoreBundle\Entity\GalleryMedia $medias)
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
     * @return Gallery
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
     * @return Gallery
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
     * @return Gallery
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
     * @param \Base\CoreBundle\Entity\Theme $themeHomeCorpo
     * @return Gallery
     */
    public function setThemeHomeCorpo(\Base\CoreBundle\Entity\Theme $themeHomeCorpo = null)
    {
        $this->themeHomeCorpo = $themeHomeCorpo;

        return $this;
    }

    /**
     * Get themeHomeCorpo
     *
     * @return \Base\CoreBundle\Entity\Theme 
     */
    public function getThemeHomeCorpo()
    {
        return $this->themeHomeCorpo;
    }
}
