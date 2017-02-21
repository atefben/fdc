<?php

namespace FDC\CourtMetrageBundle\Entity;

use A2lix\I18nDoctrineBundle\Doctrine\ORM\Util\Translatable;
use Base\CoreBundle\Util\Time;
use Base\CoreBundle\Util\SeoMain;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * CcmDomain
 * @ORM\Table(name="ccm_domain")
 * @ORM\Entity
 */
class CcmDomain
{
    use Time;
    use Translatable;
    use SeoMain;

    /**
     * @var integer
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @var integer
     *
     * @ORM\Column(type="integer", nullable=true)
     */
    protected $position;

    /**
     * @var
     * @ORM\OneToMany(targetEntity="FDC\CourtMetrageBundle\Entity\CcmDomainCollection", cascade={"persist", "remove"}, orphanRemoval=true, mappedBy="domain")
     */
    protected $domainsCollection;

    /**
     * @var ArrayCollection
     */
    protected $translations;

    public function __construct()
    {
        $this->translations = new ArrayCollection();
        $this->domainsCollection = new ArrayCollection();
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

    public function findTranslationByLocale($locale)
    {
        foreach ($this->getTranslations() as $translation) {
            if ($translation->getLocale() == $locale) {
                return $translation;
            }
        }

        return null;
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
     * @param CcmDomainCollection $domainCollection
     * @return $this
     */
    public function addDomainsCollection(\FDC\CourtMetrageBundle\Entity\CcmDomainCollection $domainCollection)
    {
        $domainCollection->setDomain($this);
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
     * @param $position
     * @return $this
     */
    public function setPosition($position)
    {
        $this->position = $position;

        return $this;
    }

    /**
     * Get position
     *
     * @return integer
     */
    public function getPosition()
    {
        return $this->position;
    }
}
