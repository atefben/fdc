<?php

namespace FDC\CourtMetrageBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

use Base\CoreBundle\Util\Time;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * CcmRubriquesCollection
 *
 * @ORM\Table(name="ccm_rubriques_collection")
 * @ORM\Entity(repositoryClass="FDC\CourtMetrageBundle\Repository\CcmRubriquesCollectionRepository")
 * @ORM\HasLifecycleCallbacks()
 */
class CcmRubriquesCollection
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
     * @ORM\ManyToOne(targetEntity="CcmRubrique", inversedBy="rubriquesCollection")
     * @ORM\JoinColumn(name="rubrique_id", referencedColumnName="id", onDelete="SET NULL")
     */
    private $rubrique;

    /**
     * @ORM\ManyToOne(targetEntity="CcmFaqPage", inversedBy="rubriquesCollection")
     * @ORM\JoinColumn(name="faq_page_id", referencedColumnName="id", onDelete="SET NULL")
     */
    private $faqPage;

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
    public function getFaqPage()
    {
        return $this->faqPage;
    }

    /**
     * @param CcmFaqPage $faqPage
     */
    public function setFaqPage(CcmFaqPage $faqPage)
    {
        $this->faqPage = $faqPage;
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
