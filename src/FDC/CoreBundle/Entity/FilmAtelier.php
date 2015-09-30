<?php

namespace FDC\CoreBundle\Entity;

use A2lix\I18nDoctrineBundle\Doctrine\ORM\Util\Translatable;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

use FDC\CoreBundle\Util\TranslationByLocale;
use FDC\CoreBundle\Util\Time;
use FDC\CoreBundle\Util\Soif;

use JMS\Serializer\Annotation\Groups;
use JMS\Serializer\Annotation\Since;

/**
 * FilmAtelier
 *
 * @ORM\Table()
 * @ORM\Entity
 * @ORM\HasLifecycleCallbacks
 */
class FilmAtelier
{
    use Translatable;
    use TranslationByLocale;
    use Time;
    use Soif;

    /**
     * @var string
     *
     * @ORM\Column(type="integer", nullable=false)
     * @ORM\Id
     *
     * @Groups({"film_atelier_list", "film_atelier_show"})
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(type="string", nullable=true)
     *
     * @Groups({"film_atelier_list", "film_atelier_show"})
     */
    private $titleVO;
    
    /**
     * @var string
     *
     * @ORM\Column(type="integer", nullable=true)
     *
     * @Groups({"film_atelier_list", "film_atelier_show"})
     */
    private $productionYear;
    
    /**
     * @var string
     *
     * @ORM\Column(type="string", nullable=true)
     *
     * @Groups({"film_atelier_list", "film_atelier_show"})
     */
    private $budgetEstimation;
    
    /**
     * @var datetime
     *
     * @ORM\Column(type="datetime", nullable=true)
     *
     * @Groups({"film_atelier_list", "film_atelier_show"})
     */
    private $filmingDate;

    /**
     * @var text
     *
     * @ORM\Column(type="text", nullable=true)
     *
     * @Groups({"film_atelier_list", "film_atelier_show"})
     */
    private $filmingPlace;

    /**
     * @var string
     *
     * @ORM\Column(type="decimal", precision=22, scale=2, nullable=true)
     *
     * @Groups({"film_atelier_list", "film_atelier_show"})
     */
    private $duration;
    
    /**
     * @var string
     *
     * @ORM\Column(type="string", nullable=true)
     *
     * @Groups({"film_atelier_list", "film_atelier_show"})s
     */
    private $sessionName;
    
    /**
     * @var string
     *
     * @ORM\Column(type="text", nullable=true)
     *
     * @Groups({"film_atelier_list", "film_atelier_show"})
     */
    private $budgetAcquired;

    /**
     * @var string
     *
     * @ORM\Column(type="string", length=255, nullable=true)
     *
     * @Groups({"film_atelier_list", "film_atelier_show"})
     */
    private $cinandoUrl;
    
    /**
     * @var FilmSelectionSection
     *
     * @ORM\ManyToOne(targetEntity="FilmSelectionSection", inversedBy="filmAteliers")
     *
     * @Groups({"film_atelier_list", "film_atelier_show"})
     */
    private $selectionSection;
    
    /**
     * @var FilmFestival
     *
     * @ORM\ManyToOne(targetEntity="FilmFestival", inversedBy="films")
     *
     * @Groups({"film_atelier_list", "film_atelier_show"})
     */
    private $festival;
    
    /**
     * @var FilmAtelierPerson
     *
     * @ORM\OneToMany(targetEntity="FilmAtelierPerson", mappedBy="film", cascade={"persist"})
     *
     * @Groups({"film_atelier_list", "film_atelier_show"})
     */
    private $persons;

    /**
     * @var FilmAtelierProductionCompany
     *
     * @ORM\ManyToOne(targetEntity="FilmAtelierProductionCompany", cascade={"persist"})
     *
     * @Groups({"film_atelier_list", "film_atelier_show"})
     */
    private $productionCompany;

    /**
     * @var FilmMedia
     *
     * @ORM\OneToMany(targetEntity="FilmMedia", mappedBy="filmAtelier")
     *
     * @Groups({"film_atelier_list", "film_atelier_show"})
     */
    private $medias;
    
    /**
     * @var FilmCountry
     *
     * @ORM\OneToMany(targetEntity="FilmAtelierCountry", mappedBy="film", cascade={"persist"})
     *
     * @Groups({"film_atelier_list", "film_atelier_show"})
     */
    private $countries;
    
    /**
     * @var FilmCountry
     *
     * @ORM\OneToMany(targetEntity="FilmAtelierLanguage", mappedBy="film", cascade={"persist"})
     *
     * @Groups({"film_atelier_list", "film_atelier_show"})
     */
    private $languages;
    
    /**
     * @var ArrayCollection
     *
     * @Groups({"film_atelier_list", "film_atelier_show"})
     */
    protected $translations;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->medias = new ArrayCollection();
        $this->countries = new ArrayCollection();
        $this->languages = new ArrayCollection();
        $this->translations = new ArrayCollection();
    }

    /**
     * Set id
     *
     * @param integer $id
     * @return FilmAtelier
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
     * Set titleVO
     *
     * @param string $titleVO
     * @return FilmAtelier
     */
    public function setTitleVO($titleVO)
    {
        $this->titleVO = $titleVO;

        return $this;
    }

    /**
     * Get titleVO
     *
     * @return string 
     */
    public function getTitleVO()
    {
        return $this->titleVO;
    }

    /**
     * Set productionYear
     *
     * @param integer $productionYear
     * @return FilmAtelier
     */
    public function setProductionYear($productionYear)
    {
        $this->productionYear = $productionYear;

        return $this;
    }

    /**
     * Get productionYear
     *
     * @return integer 
     */
    public function getProductionYear()
    {
        return $this->productionYear;
    }

    /**
     * Set budgetEstimation
     *
     * @param string $budgetEstimation
     * @return FilmAtelier
     */
    public function setBudgetEstimation($budgetEstimation)
    {
        $this->budgetEstimation = $budgetEstimation;

        return $this;
    }

    /**
     * Get budgetEstimation
     *
     * @return string 
     */
    public function getBudgetEstimation()
    {
        return $this->budgetEstimation;
    }

    /**
     * Set filmingDate
     *
     * @param \DateTime $filmingDate
     * @return FilmAtelier
     */
    public function setFilmingDate($filmingDate)
    {
        $this->filmingDate = $filmingDate;

        return $this;
    }

    /**
     * Get filmingDate
     *
     * @return \DateTime 
     */
    public function getFilmingDate()
    {
        return $this->filmingDate;
    }

    /**
     * Set filmingPlace
     *
     * @param string $filmingPlace
     * @return FilmAtelier
     */
    public function setFilmingPlace($filmingPlace)
    {
        $this->filmingPlace = $filmingPlace;

        return $this;
    }

    /**
     * Get filmingPlace
     *
     * @return string 
     */
    public function getFilmingPlace()
    {
        return $this->filmingPlace;
    }

    /**
     * Set duration
     *
     * @param string $duration
     * @return FilmAtelier
     */
    public function setDuration($duration)
    {
        $this->duration = $duration;

        return $this;
    }

    /**
     * Get duration
     *
     * @return string 
     */
    public function getDuration()
    {
        return $this->duration;
    }

    /**
     * Set sessionName
     *
     * @param string $sessionName
     * @return FilmAtelier
     */
    public function setSessionName($sessionName)
    {
        $this->sessionName = $sessionName;

        return $this;
    }

    /**
     * Get sessionName
     *
     * @return string 
     */
    public function getSessionName()
    {
        return $this->sessionName;
    }

    /**
     * Set budgetAcquired
     *
     * @param string $budgetAcquired
     * @return FilmAtelier
     */
    public function setBudgetAcquired($budgetAcquired)
    {
        $this->budgetAcquired = $budgetAcquired;

        return $this;
    }

    /**
     * Get budgetAcquired
     *
     * @return string 
     */
    public function getBudgetAcquired()
    {
        return $this->budgetAcquired;
    }

    /**
     * Set cinandoUrl
     *
     * @param string $cinandoUrl
     * @return FilmAtelier
     */
    public function setCinandoUrl($cinandoUrl)
    {
        $this->cinandoUrl = $cinandoUrl;

        return $this;
    }

    /**
     * Get cinandoUrl
     *
     * @return string 
     */
    public function getCinandoUrl()
    {
        return $this->cinandoUrl;
    }

    /**
     * Set selectionSection
     *
     * @param \FDC\CoreBundle\Entity\FilmSelectionSection $selectionSection
     * @return FilmAtelier
     */
    public function setSelectionSection(\FDC\CoreBundle\Entity\FilmSelectionSection $selectionSection = null)
    {
        $this->selectionSection = $selectionSection;

        return $this;
    }

    /**
     * Get selectionSection
     *
     * @return \FDC\CoreBundle\Entity\FilmSelectionSection 
     */
    public function getSelectionSection()
    {
        return $this->selectionSection;
    }

    /**
     * Set festival
     *
     * @param \FDC\CoreBundle\Entity\FilmFestival $festival
     * @return FilmAtelier
     */
    public function setFestival(\FDC\CoreBundle\Entity\FilmFestival $festival = null)
    {
        $this->festival = $festival;

        return $this;
    }

    /**
     * Get festival
     *
     * @return \FDC\CoreBundle\Entity\FilmFestival 
     */
    public function getFestival()
    {
        return $this->festival;
    }

    /**
     * Add persons
     *
     * @param \FDC\CoreBundle\Entity\FilmAtelierPerson $persons
     * @return FilmAtelier
     */
    public function addPerson(\FDC\CoreBundle\Entity\FilmAtelierPerson $persons)
    {
        if ($this->persons->contains($persons)) {
            return;
        }

        $this->persons[] = $persons;

        return $this;
    }

    /**
     * Remove persons
     *
     * @param \FDC\CoreBundle\Entity\FilmAtelierPerson $persons
     */
    public function removePerson(\FDC\CoreBundle\Entity\FilmAtelierPerson $persons)
    {
        if (!$this->persons->contains($persons)) {
            return;
        }
        
        $this->persons->removeElement($persons);
    }

    /**
     * Get persons
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getPersons()
    {
        return $this->persons;
    }

    /**
     * Set productionCompany
     *
     * @param \FDC\CoreBundle\Entity\FilmAtelierProductionCompany $productionCompany
     * @return FilmAtelier
     */
    public function setProductionCompany(\FDC\CoreBundle\Entity\FilmAtelierProductionCompany $productionCompany = null)
    {
        $this->productionCompany = $productionCompany;

        return $this;
    }

    /**
     * Get productionCompany
     *
     * @return \FDC\CoreBundle\Entity\FilmAtelierProductionCompany 
     */
    public function getProductionCompany()
    {
        return $this->productionCompany;
    }

    /**
     * Add medias
     *
     * @param \FDC\CoreBundle\Entity\FilmMedia $medias
     * @return FilmAtelier
     */
    public function addMedia(\FDC\CoreBundle\Entity\FilmMedia $medias)
    {
        if ($this->medias->contains($medias)) {
            return;
        }
        
        $this->medias[] = $medias;

        return $this;
    }

    /**
     * Remove medias
     *
     * @param \FDC\CoreBundle\Entity\FilmMedia $medias
     */
    public function removeMedia(\FDC\CoreBundle\Entity\FilmMedia $medias)
    {
        if (!$this->medias->contains($medias)) {
            return;
        }
        
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
     * Add countries
     *
     * @param \FDC\CoreBundle\Entity\FilmAtelierCountry $countries
     * @return FilmAtelier
     */
    public function addCountry(\FDC\CoreBundle\Entity\FilmAtelierCountry $countries)
    {
        if ($this->countries->contains($countries)) {
            return;
        }
        
        $this->countries[] = $countries;

        return $this;
    }

    /**
     * Remove countries
     *
     * @param \FDC\CoreBundle\Entity\FilmAtelierCountry $countries
     */
    public function removeCountry(\FDC\CoreBundle\Entity\FilmAtelierCountry $countries)
    {
        if (!$this->countries->contains($countries)) {
            return;
        }
        
        $this->countries->removeElement($countries);
    }

    /**
     * Get countries
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getCountries()
    {
        return $this->countries;
    }

    /**
     * Add languages
     *
     * @param \FDC\CoreBundle\Entity\FilmAtelierLanguage $languages
     * @return FilmAtelier
     */
    public function addLanguage(\FDC\CoreBundle\Entity\FilmAtelierLanguage $languages)
    {
        if ($this->languages->contains($languages)) {
            return;
        }
        
        $this->languages[] = $languages;

        return $this;
    }

    /**
     * Remove languages
     *
     * @param \FDC\CoreBundle\Entity\FilmAtelierLanguage $languages
     */
    public function removeLanguage(\FDC\CoreBundle\Entity\FilmAtelierLanguage $languages)
    {
        if (!$this->languages->contains($languages)) {
            return;
        }
        
        $this->languages->removeElement($languages);
    }

    /**
     * Get languages
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getLanguages()
    {
        return $this->languages;
    }
}
