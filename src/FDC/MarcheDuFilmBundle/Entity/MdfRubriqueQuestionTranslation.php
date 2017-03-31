<?php

namespace FDC\MarcheDuFilmBundle\Entity;

use A2lix\I18nDoctrineBundle\Doctrine\ORM\Util\Translation;
use Base\CoreBundle\Interfaces\TranslateChildInterface;
use Base\CoreBundle\Util\Time;
use Base\CoreBundle\Util\TranslateChild;
use Base\CoreBundle\Util\TranslationChanges;
use Doctrine\ORM\Mapping as ORM;

/**
 * MdfRubriqueQuestionTranslation
 *
 * @ORM\Table(name="mdf_rubrique_question_translation")
 * @ORM\Entity(repositoryClass="FDC\MarcheDuFilmBundle\Repository\MdfRubriqueQuestionTranslationRepository")
 * @ORM\HasLifecycleCallbacks()
 */
class MdfRubriqueQuestionTranslation implements TranslateChildInterface
{
    use Translation;
    use TranslationChanges;
    use Time;
    use TranslateChild;

    /**
     * @var string
     *
     * @ORM\Column(name="question_text", type="string", length=255, nullable=true)
     */
    private $questionText;

    /**
     * @var string
     *
     * @ORM\Column(name="answer_text", type="text", nullable=true)
     */
    private $answerText;

    /**
     * @return string
     */
    public function getQuestionText()
    {
        return $this->questionText;
    }

    /**
     * @param string $questionText
     */
    public function setQuestionText($questionText)
    {
        $this->questionText = $questionText;
    }

    /**
     * @return string
     */
    public function getAnswerText()
    {
        return $this->answerText;
    }

    /**
     * @param string $answerText
     */
    public function setAnswerText($answerText)
    {
        $this->answerText = $answerText;
    }
}

