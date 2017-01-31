<?php

namespace FDC\MarcheDuFilmBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Base\CoreBundle\Util\Time;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * ServiceWidgetCollection
 *
 * @ORM\Table(name="mdf_service_widget_collection")
 * @ORM\Entity(repositoryClass="FDC\MarcheDuFilmBundle\Repository\ServiceWidgetCollectionRepository")
 * @ORM\HasLifecycleCallbacks()
 */
class ServiceWidgetCollection
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
     * @ORM\ManyToOne(targetEntity="ServiceWidget", cascade={"all"}, inversedBy="widgetsCollection")
     * @Assert\Count(
     *      max = "4",
     *      min = "1",
     *      minMessage = "validation.service_widget_min",
     *      maxMessage = "validation.service_widget_max"
     * )
     * @ORM\JoinColumn(name="widget_id", referencedColumnName="id", onDelete="SET NULL")
     */
    private $widget;

    /**
     * @ORM\ManyToOne(targetEntity="Service", inversedBy="widgetCollections")
     * @ORM\JoinColumn(name="service_id", referencedColumnName="id", onDelete="SET NULL")
     */
    private $service;

    /**
     * @var integer
     *
     * @ORM\Column(type="integer", nullable=true)
     */
    private $position;


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
    public function getWidget()
    {
        return $this->widget;
    }

    /**
     * @param mixed $widget
     */
    public function setWidget($widget)
    {
        $this->widget = $widget;
    }

    /**
     * @return mixed
     */
    public function getService()
    {
        return $this->service;
    }

    /**
     * @param mixed $service
     */
    public function setService($service)
    {
        $this->service = $service;
    }
    
    /**
     * Set position
     *
     * @param integer $position
     * @return GalleryMdfMedia
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
}
