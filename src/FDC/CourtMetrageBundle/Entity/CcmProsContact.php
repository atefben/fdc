<?php

namespace FDC\CourtMetrageBundle\Entity;

use A2lix\I18nDoctrineBundle\Doctrine\ORM\Util\Translatable;
use Base\CoreBundle\Util\Time;
use Base\CoreBundle\Util\SeoMain;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * CcmProsContact
 * @ORM\Table(name="ccm_pros_contact")
 * @ORM\Entity
 */
class CcmProsContact
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
     * @ORM\OneToMany(targetEntity="FDC\CourtMetrageBundle\Entity\CcmProsContactCollection", cascade={"persist", "remove"}, orphanRemoval=true, mappedBy="contact")
     */
    protected $contactsCollection;

    /**
     * @var ArrayCollection
     */
    protected $translations;

    public function __construct()
    {
        $this->translations = new ArrayCollection();
        $this->contactsCollection = new ArrayCollection();
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
     * @param CcmProsContactCollection $contactCollection
     * @return $this
     */
    public function addContactsCollection(\FDC\CourtMetrageBundle\Entity\CcmProsContactCollection $contactCollection)
    {
        $contactCollection->setContact($this);
        $this->contactsCollection[] = $contactCollection;

        return $this;
    }

    /**
     * @param CcmProsContactCollection $contactCollection
     */
    public function removeContactsCollection(\FDC\CourtMetrageBundle\Entity\CcmProsContactCollection $contactCollection)
    {
        $this->contactsCollection->removeElement($contactCollection);
    }

    /**
     * @return ArrayCollection
     */
    public function getContactsCollection()
    {
        return $this->contactsCollection;
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
