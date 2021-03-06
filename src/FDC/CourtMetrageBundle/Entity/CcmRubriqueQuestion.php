<?php

namespace FDC\CourtMetrageBundle\Entity;

use A2lix\I18nDoctrineBundle\Doctrine\ORM\Util\Translatable;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * CcmRubriqueQuestion
 *
 * @ORM\Table(name="ccm_rubrique_question")
 * @ORM\Entity
 * @ORM\HasLifecycleCallbacks()
 */
class CcmRubriqueQuestion
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
     * @ORM\OneToMany(targetEntity="CcmRubriqueQuestionsCollection", mappedBy="rubriqueQuestion", cascade={"persist", "remove"}, orphanRemoval=true)
     * @ORM\OrderBy({"position" = "ASC"})
     */
    protected $rubriqueQuestionsCollection;

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
    }

    public function __toString()
    {
        $translation = $this->findTranslationByLocale('fr');

        if ($translation !== null) {
            $string = $translation->getQuestionText();
        } else {
            $string = strval($this->getId());
        }
        return (string) $string;
    }

    public function getQuestionText()
    {
        $translation = $this->findTranslationByLocale('fr');
        $string = '';

        if ($translation !== null) {
            $string = $translation->getQuestionText();
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
     * @param CcmRubriqueQuestionsCollection $rubriqueQuestionsCollection
     * @return $this
     */
    public function addRubriqueQuestionsCollection(CcmRubriqueQuestionsCollection $rubriqueQuestionsCollection)
    {
        $rubriqueQuestionsCollection->setRubrique($this);
        $this->rubriqueQuestionsCollection[] = $rubriqueQuestionsCollection;

        return $this;
    }

    /**
     * @param CcmRubriqueQuestionsCollection $rubriqueQuestionsCollection
     */
    public function removeRubriqueQuestionsCollection(CcmRubriqueQuestionsCollection $rubriqueQuestionsCollection)
    {
        $this->rubriqueQuestionsCollection->removeElement($rubriqueQuestionsCollection);
    }

    /**
     * @return ArrayCollection
     */
    public function getRubriqueQuestionsCollection()
    {
        return $this->rubriqueQuestionsCollection;
    }
}

