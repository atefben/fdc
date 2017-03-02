<?php

namespace FDC\CourtMetrageBundle\Entity;

use Symfony\Component\Validator\Constraints as Assert;
use A2lix\I18nDoctrineBundle\Doctrine\ORM\Util\Translatable;
use Base\CoreBundle\Interfaces\TranslateMainInterface;
use Base\CoreBundle\Util\SeoMain;
use Base\CoreBundle\Util\Time;
use Base\CoreBundle\Util\TranslateMain;
use Doctrine\Common\Collections\ArrayCollection;
use Base\CoreBundle\Entity\MediaImage;
use Doctrine\ORM\Mapping as ORM;

/**
 * CcmProsPage
 * @ORM\Table(name="ccm_pros_page")
 * @ORM\Entity
 * @ORM\HasLifecycleCallbacks() 
 */
class CcmProsPage implements TranslateMainInterface
{

    use Time;
    use SeoMain;
    use Translatable;
    use TranslateMain;

    /**
     * @var integer
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @var ArrayCollection
     */
    protected $translations;

    /**
     * @var MediaImage
     *
     * @ORM\ManyToOne(targetEntity="Base\CoreBundle\Entity\MediaImage")
     */
    protected $image;
    
    /**
     * @var ArrayCollection
     * @ORM\OneToMany(targetEntity="FDC\CourtMetrageBundle\Entity\CcmDomainCollection", mappedBy="prosPage", cascade={"persist", "remove"}, orphanRemoval=true)
     * @ORM\OrderBy({"position" = "ASC"})
     */
    protected $domainsCollection;

    /**
     * @ORM\OneToMany(targetEntity="FDC\CourtMetrageBundle\Entity\HomepageSejour", mappedBy="prosPage", cascade={"persist", "remove", "refresh"}, orphanRemoval=true)
     * @Assert\Count(
     *      min = "1",
     *      minMessage = "ccm.validation.homepage.sejour_min",
     *      max = "1",
     *      maxMessage = "ccm.validation.homepage.sejour_max"
     * )
     * @Assert\Valid
     */
    protected $sejoures;

    /**
     * @var boolean
     *
     * @ORM\Column(type="boolean")
     */
    protected $sejourIsActive = false;

    /**
     * @var integer
     *
     * @ORM\Column(type="integer")
     */
    protected $positionSejour;

    /**
     * @var boolean
     *
     * @ORM\Column(type="boolean")
     */
    protected $actualiteIsActive = false;

    /**
     * @var integer
     *
     * @ORM\Column(type="integer")
     */
    protected $positionActualites;

    /**
     * @var boolean
     *
     * @ORM\Column(type="boolean")
     */
    protected $socialIsActive = false;

    /**
     * @var integer
     *
     * @ORM\Column(type="integer")
     */
    protected $positionSocial;

    /**
     * @var integer
     *
     * @ORM\Column(type="integer")
     */
    protected $positionCatalog;

    /**
     * @var boolean
     *
     * @ORM\Column(type="boolean")
     */
    protected $catalogIsActive = false;

    public function __construct()
    {
        $this->translations = new ArrayCollection();
        $this->domainsCollection = new ArrayCollection();
        $this->sejoures =  new ArrayCollection();
    }

    public function __toString()
    {
        $translation = $this->findTranslationByLocale('fr');

        if ($translation !== null) {
            $string = $translation->getTitle();
        } else {
            $string = strval($this->getId());
        }
        return (string) $string;
    }

    public function getTitle()
    {
        $translation = $this->findTranslationByLocale('fr');
        $string = '';

        if ($translation !== null) {
            $string = $translation->getTitle();
        }

        return $string;
    }

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param CcmDomainCollection $domainCollection
     * @return $this
     */
    public function addDomainsCollection(\FDC\CourtMetrageBundle\Entity\CcmDomainCollection $domainCollection)
    {
        $domainCollection->setProsPage($this);
        $this->domainsCollection[] = $domainCollection;

        return $this;
    }

    /**
     * @param CcmDomainCollection $domainCollection
     */
    public function removeDomainsCollection(\FDC\CourtMetrageBundle\Entity\CcmDomainCollection $domainCollection)
    {
        $this->domainsCollection->removeElement($domainCollection);
    }

    /**
     * @return ArrayCollection
     */
    public function getDomainsCollection()
    {
        return $this->domainsCollection;
    }

    /**
     * @return ArrayCollection
     */
    public function getTranslations()
    {
        return $this->translations;
    }

    /**
     * @param ArrayCollection $translations
     */
    public function setTranslations($translations)
    {
        $this->translations = $translations;
    }

    /**
     * @return MediaImage
     */
    public function getImage()
    {
        return $this->image;
    }

    /**
     * @param MediaImage $image
     */
    public function setImage($image)
    {
        $this->image = $image;
    }

    /**
     * Get sejoures.
     *
     * @return mixed
     */
    public function getSejoures()
    {
        return $this->sejoures;
    }

    /**
     * Set sejoures.
     *
     * @param mixed $sejoures
     */
    public function setSejoures($sejoures)
    {
        $this->sejoures = $sejoures;

        return $this;
    }

    /**
     * Get sejourIsActive.
     *
     * @return bool
     */
    public function getSejourIsActive()
    {
        return $this->sejourIsActive;
    }

    /**
     * Set sejourIsActive.
     *
     * @param bool $sejourIsActive
     */
    public function setSejourIsActive($sejourIsActive)
    {
        $this->sejourIsActive = $sejourIsActive;

        return $this;
    }

    /**
     * Get positionSejour.
     *
     * @return int
     */
    public function getPositionSejour()
    {
        return $this->positionSejour;
    }

    /**
     * Set positionSejour.
     *
     * @param int $positionSejour
     */
    public function setPositionSejour($positionSejour)
    {
        $this->positionSejour = $positionSejour;

        return $this;
    }

    /**
     * Add sejour.
     *
     * @param HomepageSejour $sejour
     *
     * @return $this
     */
    public function addSejour(HomepageSejour $sejour)
    {
        $this->sejoures->add($sejour);
        $sejour->setProsPage($this);

        return $this;
    }

    /**
     * Remove sejour.
     *
     * @param HomepageSejour $sejour
     */
    public function removeSejour(HomepageSejour $sejour)
    {
        $this->sejoures->removeElement($sejour);
    }

    /**
     * Get actualiteIsActive.
     *
     * @return bool
     */
    public function getActualiteIsActive()
    {
        return $this->actualiteIsActive;
    }

    /**
     * Set actualiteIsActive.
     *
     * @param bool $actualiteIsActive
     */
    public function setActualiteIsActive($actualiteIsActive)
    {
        $this->actualiteIsActive = $actualiteIsActive;

        return $this;
    }

    /**
     * Get positionActualites.
     *
     * @return int
     */
    public function getPositionActualites()
    {
        return $this->positionActualites;
    }

    /**
     * Set positionActualite.
     *
     * @param int $positionActualites
     */
    public function setPositionActualites($positionActualites)
    {
        $this->positionActualites = $positionActualites;

        return $this;
    }

    /**
     * Get socialIsActive.
     *
     * @return bool
     */
    public function getSocialIsActive()
    {
        return $this->socialIsActive;
    }

    /**
     * Set socialIsActive.
     *
     * @param bool $socialIsActive
     */
    public function setSocialIsActive($socialIsActive)
    {
        $this->socialIsActive = $socialIsActive;

        return $this;
    }

    /**
     * Get PositionSocial.
     *
     * @return int
     */
    public function getPositionSocial()
    {
        return $this->positionSocial;
    }

    /**
     * Set positionSocial.
     *
     * @param int $positionSocial
     */
    public function setPositionSocial($positionSocial)
    {
        $this->positionSocial = $positionSocial;

        return $this;
    }

    /**
     * Get positionCatalog.
     *
     * @return int
     */
    public function getPositionCatalog()
    {
        return $this->positionCatalog;
    }

    /**
     * Set positionCatalog.
     *
     * @param int $positionCatalog
     */
    public function setPositionCatalog($positionCatalog)
    {
        $this->positionCatalog = $positionCatalog;

        return $this;
    }

    /**
     * Get catalogIsActive.
     *
     * @return bool
     */
    public function getCatalogIsActive()
    {
        return $this->catalogIsActive;
    }

    /**
     * Set catalogIsActive.
     *
     * @param bool $catalogIsActive
     */
    public function setCatalogIsActive($catalogIsActive)
    {
        $this->catalogIsActive = $catalogIsActive;
    }
}