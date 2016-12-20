<?php

namespace FDC\MarcheDuFilmBundle\Entity;

use Application\Sonata\MediaBundle\Entity\Media;
use A2lix\I18nDoctrineBundle\Doctrine\ORM\Util\Translatable;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * DispatchDeServiceContact
 * @ORM\Table(name="mdf_dispatch_de_service_contact")
 * @ORM\Entity
 */
class DispatchDeServiceContact
{
    use Translatable;

    /**
     * @var integer
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @var ArrayCollection
     */
    protected $translations;

    /**
     * @ORM\ManyToOne(targetEntity="DispatchDeService", inversedBy="dispatchDeServiceContacts")
     * @ORM\JoinColumn(name="dispatch_de_service_id", referencedColumnName="id")
     */
    protected $dispatchDeService;

    /**
     * HomeSliderTop constructor.
     */
    public function __construct()
    {
        $this->translations = new ArrayCollection();
    }

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
    public function getDispatchDeService()
    {
        return $this->dispatchDeService;
    }

    /**
     * @param $dispatchDeService
     *
     * @return $this
     */
    public function setDispatchDeService($dispatchDeService)
    {
        $this->dispatchDeService = $dispatchDeService;

        return $this;
    }
}
