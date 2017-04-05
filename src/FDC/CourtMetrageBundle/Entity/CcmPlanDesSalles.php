<?php

namespace FDC\CourtMetrageBundle\Entity;


use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * CcmPlanDesSalles
 * @ORM\Table(name="ccm_plan_des_salles")
 * @ORM\Entity()
 */
class CcmPlanDesSalles
{
    /**
     * @var integer
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @var CcmPlanDesSallesSector
     *
     * @ORM\OneToMany(targetEntity="FDC\CourtMetrageBundle\Entity\CcmPlanDesSallesSectorCollection", mappedBy="planDesSalles", cascade={"persist", "remove"}, orphanRemoval=true)
     * @Assert\NotBlank()
     * @ORM\OrderBy({"position" = "ASC"})
     */
    protected $sectorList;

    /**
     * CcmPlanDesSalles constructor.
     */
    public function __construct()
    {
        $this->sectorList = new ArrayCollection();
    }

    /**
     * @return string
     */
    public function __toString()
    {
        return $this->getTitle();
    }

    /**
     * @return string
     */
    public function getTitle()
    {
        return 'Plan des salles';
    }

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param CcmPlanDesSallesSectorCollection $sectorCollection
     * @return $this
     */
    public function addSectorList(CcmPlanDesSallesSectorCollection $sectorCollection)
    {
        $sectorCollection->setPlanDesSalles($this);
        $this->sectorList[] = $sectorCollection;

        return $this;
    }

    /**
     * @param CcmPlanDesSallesSectorCollection $sectorCollection
     */
    public function removeSectorList(CcmPlanDesSallesSectorCollection $sectorCollection)
    {
        $this->sectorList->removeElement($sectorCollection);
    }

    /**
     * Get sectors
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getSectorList()
    {
        return $this->sectorList;
    }
}
