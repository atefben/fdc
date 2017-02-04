<?php

namespace FDC\MarcheDuFilmBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

use Base\CoreBundle\Util\Time;
use JMS\Serializer\Annotation\Groups;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * MdfRubriquesCollection
 *
 * @ORM\Table(name="mdf_rubriques_collection")
 * @ORM\Entity(repositoryClass="FDC\MarcheDuFilmBundle\Repository\MdfRubriquesCollectionRepository")
 * @ORM\HasLifecycleCallbacks()
 */
class MdfRubriquesCollection
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
     * @ORM\ManyToOne(targetEntity="FDC\MarcheDuFilmBundle\Entity\MdfRubrique", inversedBy="rubriquesCollection")
     * @ORM\JoinColumn(name="rubrique_id", referencedColumnName="id", onDelete="SET NULL")
     */
    private $rubrique;

    /**
     * @ORM\ManyToOne(targetEntity="FDC\MarcheDuFilmBundle\Entity\MdfInformations", inversedBy="rubriquesCollection")
     * @ORM\JoinColumn(name="information_page_id", referencedColumnName="id", onDelete="SET NULL")
     */
    private $informationPage;

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
    public function getInformationPage()
    {
        return $this->informationPage;
    }

    /**
     * @param mixed $informationPage
     */
    public function setInformationPage($informationPage)
    {
        $this->informationPage = $informationPage;
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
