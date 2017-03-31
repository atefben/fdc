<?php

namespace FDC\CourtMetrageBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

use Base\CoreBundle\Util\Time;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * CcmRubriqueQuestionsCollection
 *
 * @ORM\Table(name="ccm_rubrique_questions_collection")
 * @ORM\Entity(repositoryClass="FDC\CourtMetrageBundle\Repository\CcmRubriqueQuestionsCollectionRepository")
 * @ORM\HasLifecycleCallbacks()
 */
class CcmRubriqueQuestionsCollection
{
    use Time;

    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="CcmRubrique", inversedBy="questionsCollection")
     * @ORM\JoinColumn(name="rubrique_id", referencedColumnName="id", onDelete="SET NULL")
     */
    private $rubrique;

    /**
     * @ORM\ManyToOne(targetEntity="CcmRubriqueQuestion", inversedBy="rubriqueQuestionsCollection")
     * @ORM\JoinColumn(name="rubrique_question_id", referencedColumnName="id", onDelete="SET NULL")
     */
    private $rubriqueQuestion;

    /**
     * @var integer
     *
     * @ORM\Column(type="integer", nullable=true)
     */
    protected $position;

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
     * @return mixed
     */
    public function getRubrique()
    {
        return $this->rubrique;
    }

    /**
     * @param mixed $rubrique
     */
    public function setRubrique($rubrique)
    {
        $this->rubrique = $rubrique;
    }

    /**
     * @return mixed
     */
    public function getRubriqueQuestion()
    {
        return $this->rubriqueQuestion;
    }

    /**
     * @param mixed $rubriqueQuestion
     */
    public function setRubriqueQuestion($rubriqueQuestion)
    {
        $this->rubriqueQuestion = $rubriqueQuestion;
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
