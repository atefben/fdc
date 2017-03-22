<?php

namespace FDC\CourtMetrageBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * CcmModule
 * @ORM\Table(name="ccm_module")
 * @ORM\Entity
 * @ORM\InheritanceType("JOINED")
 * @ORM\DiscriminatorColumn(name="type", type="string")
 * @ORM\DiscriminatorMap({
 *  "imagetext" = "CcmModuleImageText",
 *  "pf" = "CcmModulePF",
 *  "pictos" = "CcmModulePictos",
 *  "threecolumns" = "CcmModuleThreeColumns",
 *  "fourcolumns" = "CcmModuleFourColumns",
 *  "subtitle" = "CcmModuleSubtitle",
 *  "transport" = "CcmModuleTransport",
 *  "googlemaps" = "CcmModuleGoogleMaps",
 * })
 */
abstract class CcmModule
{

    /**
     * @var integer
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @var integer
     * @ORM\Column(type="integer", nullable=true)
     */
    protected $position;

    /**
     * @ORM\ManyToOne(targetEntity="FDC\CourtMetrageBundle\Entity\CcmParticiperPageLayer", inversedBy="modules")
     * @ORM\JoinColumn(name="page_layer_id", referencedColumnName="id", onDelete="SET NULL")
     */
    protected $pageLayer;

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
     * @return mixed
     */
    public function getPageLayer()
    {
        return $this->pageLayer;
    }

    /**
     * @param mixed $pageLayer
     */
    public function setPageLayer($pageLayer)
    {
        $this->pageLayer = $pageLayer;
    }

    public function getWidgetType()
    {
        return substr(strrchr(get_called_class(), '\\'), 1);
    }

    /**
     * @return string
     */
    public function getType()
     {
         return strtolower(str_replace('CcmModule', '', $this->getWidgetType()));
     }
}

