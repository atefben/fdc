<?php

namespace FDC\MarcheDuFilmBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

use Base\CoreBundle\Util\Time;
use JMS\Serializer\Annotation\Groups;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * MdfRubriqueQuestionsCollection
 *
 * @ORM\Table(name="mdf_rubrique_questions_collection")
 * @ORM\Entity(repositoryClass="FDC\MarcheDuFilmBundle\Repository\MdfRubriqueQuestionsCollectionRepository")
 * @ORM\HasLifecycleCallbacks()
 */
class MdfRubriqueQuestionsCollection
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
     * @ORM\ManyToOne(targetEntity="FDC\MarcheDuFilmBundle\Entity\MdfRubrique", inversedBy="questionsCollection")
     * @ORM\JoinColumn(name="rubrique_id", referencedColumnName="id", onDelete="SET NULL")
     */
    private $rubrique;

    /**
     * @ORM\ManyToOne(targetEntity="FDC\MarcheDuFilmBundle\Entity\MdfRubriqueQuestion", inversedBy="rubriqueQuestionsCollection")
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
