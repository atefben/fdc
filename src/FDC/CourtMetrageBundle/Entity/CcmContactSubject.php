<?php

namespace FDC\CourtMetrageBundle\Entity;

use A2lix\I18nDoctrineBundle\Doctrine\ORM\Util\Translatable;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * MdfContactSubject
 *
 * @ORM\Table(name="ccm_contact_subject")
 * @ORM\Entity
 * @ORM\HasLifecycleCallbacks()
 */
class CcmContactSubject
{
    use Translatable;

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
     * @var ArrayCollection
     * @ORM\OneToMany(targetEntity="CcmContactSubjectsCollection", cascade={"persist", "remove"}, orphanRemoval=true, mappedBy="contactSubject")
     */
    protected $contactSubjectsCollection;

    /**
     * @var ArrayCollection
     */
    protected $translations;

    public function __construct()
    {
        $this->translations = new ArrayCollection();
        $this->contactSubjectsCollection = new ArrayCollection();
    }

    public function __toString()
    {
        $translation = $this->findTranslationByLocale('fr');

        if ($translation !== null) {
            $string = $translation->getContactTheme();
        } else {
            $string = strval($this->getId());
        }

        return (string) $string;
    }

    public function getContactTheme()
    {
        $translation = $this->findTranslationByLocale('fr');
        $string = '';

        if ($translation !== null) {
            $string = $translation->getContactTheme();
        }

        return $string;
    }

    /**
     * findTranslationByLocale function.
     *
     * @access public
     * @param mixed $locale
     * @return array
     */
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
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param CcmContactSubjectsCollection $contactSubjectsCollection
     * @return $this
     */
    public function addContactSubjectsCollection(CcmContactSubjectsCollection $contactSubjectsCollection)
    {
        $contactSubjectsCollection->setContactSubject($this);
        $this->contactSubjectsCollection[] = $contactSubjectsCollection;

        return $this;
    }

    /**
     * @param CcmContactSubjectsCollection $contactSubjectsCollection
     */
    public function removeContactSubjectsCollection(CcmContactSubjectsCollection $contactSubjectsCollection)
    {
        $this->contactSubjectsCollection->removeElement($contactSubjectsCollection);
    }

    /**
     * @return ArrayCollection
     */
    public function getContactSubjectsCollection()
    {
        return $this->contactSubjectsCollection;
    }

    /**
     * @return int
     */
    public function getPosition()
    {
        return $this->position;
    }

    /**
     * @param int $position
     */
    public function setPosition($position)
    {
        $this->position = $position;
    }
}

