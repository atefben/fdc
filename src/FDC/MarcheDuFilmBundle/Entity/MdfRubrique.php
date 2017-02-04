<?php

namespace FDC\MarcheDuFilmBundle\Entity;

use A2lix\I18nDoctrineBundle\Doctrine\ORM\Util\Translatable;
use FDC\MarcheDuFilmBundle\Entity\GalleryMdf;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * MdfRubrique
 *
 * @ORM\Table(name="mdf_rubrique")
 * @ORM\Entity
 * @ORM\HasLifecycleCallbacks()
 */
class MdfRubrique
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
     * @var ArrayCollection
     * @ORM\OneToMany(targetEntity="FDC\MarcheDuFilmBundle\Entity\MdfRubriqueQuestionsCollection", mappedBy="rubrique", cascade={"persist", "remove"}, orphanRemoval=true)
     * @ORM\OrderBy({"position" = "ASC"})
     */
    protected $questionsCollection;

    /**
     * @var ArrayCollection
     * @ORM\OneToMany(targetEntity="FDC\MarcheDuFilmBundle\Entity\MdfRubriquesCollection", cascade={"persist", "remove"}, orphanRemoval=true, mappedBy="rubrique")
     * 
     */
    protected $rubriquesCollection;

    /**
     * @var integer
     *
     * @ORM\Column(type="integer", nullable=true)
     */
    protected $position;

    /**
     * @var ArrayCollection
     *
     */
    protected $translations;

    public function __construct()
    {
        $this->translations = new ArrayCollection();
        $this->questionsCollection = new ArrayCollection();
        $this->rubriquesCollection = new ArrayCollection();
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

    /**
     * @param MdfRubriquesCollection $rubriquesCollection
     * @return $this
     */
    public function addRubriquesCollection(\FDC\MarcheDuFilmBundle\Entity\MdfRubriquesCollection $rubriquesCollection)
    {
        $rubriquesCollection->setRubrique($this);
        $this->rubriquesCollection[] = $rubriquesCollection;

        return $this;
    }

    /**
     * @param MdfRubriquesCollection $rubriquesCollection
     */
    public function removeRubriquesCollection(\FDC\MarcheDuFilmBundle\Entity\MdfRubriquesCollection $rubriquesCollection)
    {
        $this->rubriquesCollection->removeElement($rubriquesCollection);
    }

    /**
     * @return ArrayCollection
     */
    public function getRubriquesCollection()
    {
        return $this->rubriquesCollection;
    }

    /**
     * @param MdfRubriquesCollection $rubriquesCollection
     * @return $this
     */
    public function addQuestionsCollection(\FDC\MarcheDuFilmBundle\Entity\MdfRubriqueQuestionsCollection $rubriqueQuestionsCollection)
    {
        $rubriqueQuestionsCollection->setRubrique($this);
        $this->questionsCollection[] = $rubriqueQuestionsCollection;

        return $this;
    }

    /**
     * @param MdfRubriquesCollection $rubriquesCollection
     */
    public function removeQuestionsCollection(\FDC\MarcheDuFilmBundle\Entity\MdfRubriqueQuestionsCollection $rubriqueQuestionsCollection)
    {
        $this->questionsCollection->removeElement($rubriqueQuestionsCollection);
    }

    /**
     * @return ArrayCollection
     */
    public function getQuestionsCollection()
    {
        return $this->questionsCollection;
    }
}

