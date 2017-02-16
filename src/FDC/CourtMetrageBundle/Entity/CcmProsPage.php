<?php

namespace FDC\CourtMetrageBundle\Entity;

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

    public function __construct()
    {
        $this->translations = new ArrayCollection();
        $this->domainsCollection = new ArrayCollection();
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
}