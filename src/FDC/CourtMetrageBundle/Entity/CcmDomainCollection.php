<?php

namespace FDC\CourtMetrageBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Base\CoreBundle\Util\Time;
use JMS\Serializer\Annotation\Groups;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * CcmDomainCollection
 *
 * @ORM\Table(name="ccm_domain_collection")
 * @ORM\Entity
 */
class CcmDomainCollection
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="FDC\CourtMetrageBundle\Entity\CcmDomain", inversedBy="domainsCollection")
     * @ORM\JoinColumn(name="domain_id", referencedColumnName="id", onDelete="SET NULL")
     * @Assert\NotBlank()
     */
    private $domain;

    /**
     * @ORM\ManyToOne(targetEntity="FDC\CourtMetrageBundle\Entity\CcmProsPage", inversedBy="domainsCollection")
     * @ORM\JoinColumn(name="pros_page_id", referencedColumnName="id", onDelete="SET NULL")
     */
    private $prosPage;

    /**
     * @ORM\ManyToOne(targetEntity="FDC\CourtMetrageBundle\Entity\CcmProsDetail", inversedBy="domainsCollection")
     * @ORM\JoinColumn(name="pros_detail_id", referencedColumnName="id", onDelete="SET NULL")
     */
    private $prosDetail;

    /**
     * @var integer
     *
     * @ORM\Column(type="integer", nullable=true)
     */
    private $position;

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return mixed
     */
    public function getDomain()
    {
        return $this->domain;
    }

    /**
     * @param mixed $domain
     */
    public function setDomain($domain)
    {
        $this->domain = $domain;
    }

    /**
     * @return mixed
     */
    public function getProsPage()
    {
        return $this->prosPage;
    }

    /**
     * @param mixed $prosPage
     */
    public function setProsPage($prosPage)
    {
        $this->prosPage = $prosPage;
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
     * @return mixed
     */
    public function getProsDetail()
    {
        return $this->prosDetail;
    }

    /**
     * @param mixed $prosDetail
     */
    public function setProsDetail($prosDetail)
    {
        $this->prosDetail = $prosDetail;
    }
}

