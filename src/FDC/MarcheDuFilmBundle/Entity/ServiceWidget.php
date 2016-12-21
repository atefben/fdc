<?php

namespace FDC\MarcheDuFilmBundle\Entity;

use Base\CoreBundle\Util\Time;
use Doctrine\ORM\Mapping as ORM;

/**
 * ServiceWidget
 * @ORM\Table(name="service_widget")
 * @ORM\Entity(repositoryClass="FDC\MarcheDuFilmBundle\Repository\ServiceWidgetRepository")
 * @ORM\HasLifecycleCallbacks()
 * @ORM\InheritanceType("JOINED")
 * @ORM\DiscriminatorColumn(name="type", type="string")
 * @ORM\DiscriminatorMap({
 *  "product" = "ServiceWidgetProduct",
 * })
 */
abstract class ServiceWidget
{
    use Time;

    /**
     * @var integer
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @var integer
     *
     * @ORM\Column(type="integer", nullable=true)
     */
    protected $position;

    /**
     * @var Service
     * @ORM\ManyToOne(targetEntity="FDC\MarcheDuFilmBundle\Entity\Service", inversedBy="widgets")
     */
    protected $service;


    public function getWidgetType()
    {
        return substr(strrchr(get_called_class(), '\\'), 1);
    }

    /**
     * Get id
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set position
     *
     * @param integer $position
     * @return ServiceWidget
     */
    public function setPosition($position)
    {
        $this->position = $position;

        return $this;
    }

    /**
     * Get position
     *
     * @return integer 
     */
    public function getPosition()
    {
        return $this->position;
    }

    /**
     * Set service
     *
     * @param \FDC\MarcheDuFilmBundle\Entity\Service $service
     * @return ServiceWidget
     */
    public function setService(\FDC\MarcheDuFilmBundle\Entity\Service $service = null)
    {
        $this->service = $service;

        return $this;
    }

    /**
     * Get service
     *
     * @return \FDC\MarcheDuFilmBundle\Entity\Service 
     */
    public function getService()
    {
        return $this->service;
    }
}
