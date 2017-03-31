<?php

namespace FDC\CourtMetrageBundle\Entity;

use A2lix\I18nDoctrineBundle\Doctrine\ORM\Util\Translatable;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * CcmRubrique
 *
 * @ORM\Table(name="ccm_rubrique")
 * @ORM\Entity
 * @ORM\HasLifecycleCallbacks()
 */
class CcmRubrique
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
     * @ORM\OneToMany(targetEntity="CcmRubriqueQuestionsCollection", mappedBy="rubrique", cascade={"persist", "remove"}, orphanRemoval=true)
     * @ORM\OrderBy({"position" = "ASC"})
     */
    protected $questionsCollection;

    /**
     * @var ArrayCollection
     * @ORM\OneToMany(targetEntity="CcmRubriquesCollection", cascade={"persist", "remove"}, orphanRemoval=true, mappedBy="rubrique")
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
     * @param CcmRubriquesCollection $rubriquesCollection
     * @return $this
     */
    public function addRubriquesCollection(CcmRubriquesCollection $rubriquesCollection)
    {
        $rubriquesCollection->setRubrique($this);
        $this->rubriquesCollection[] = $rubriquesCollection;

        return $this;
    }

    /**
     * @param CcmRubriquesCollection $rubriquesCollection
     */
    public function removeRubriquesCollection(CcmRubriquesCollection $rubriquesCollection)
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
     * @param CcmRubriqueQuestionsCollection $rubriqueQuestionsCollection
     * @return $this
     */
    public function addQuestionsCollection(CcmRubriqueQuestionsCollection $rubriqueQuestionsCollection)
    {
        $rubriqueQuestionsCollection->setRubrique($this);
        $this->questionsCollection[] = $rubriqueQuestionsCollection;

        return $this;
    }

    /**
     * @param CcmRubriqueQuestionsCollection $rubriqueQuestionsCollection
     */
    public function removeQuestionsCollection(CcmRubriqueQuestionsCollection $rubriqueQuestionsCollection)
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

