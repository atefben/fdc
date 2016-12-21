<?php

namespace FDC\MarcheDuFilmBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use A2lix\I18nDoctrineBundle\Doctrine\ORM\Util\Translatable;
use Doctrine\ORM\Mapping as ORM;

/**
 * DispatchDeService
 * @ORM\Table(name="mdf_dispatch_de_service")
 * @ORM\Entity
 */
class DispatchDeService
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
     * @ORM\OneToMany(targetEntity="DispatchDeServiceWidget", mappedBy="dispatchDeService", cascade={"persist", "remove", "refresh"}, orphanRemoval=true)
     */
    protected $dispatchDeServiceWidgets;

    /**
     * @ORM\OneToMany(targetEntity="DispatchDeServiceContact", mappedBy="dispatchDeService", cascade={"persist", "remove", "refresh"}, orphanRemoval=true)
     */
    protected $dispatchDeServiceContacts;

    /**
     * @var ArrayCollection
     */
    protected $translations;

    public function __construct() {
        $this->dispatchDeServiceWidgets = new ArrayCollection();
        $this->dispatchDeServiceContacts = new ArrayCollection();
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
    public function getDispatchDeServiceWidgets()
    {
        return $this->dispatchDeServiceWidgets;
    }

    /**
     * @param DispatchDeServiceWidget $dispatchDeServiceWidget
     *
     * @return $this
     */
    public function addDispatchDeServiceWidget(DispatchDeServiceWidget $dispatchDeServiceWidget)
    {
        if (!$this->dispatchDeServiceWidgets->contains($dispatchDeServiceWidget)) {
            $this->dispatchDeServiceWidgets->add($dispatchDeServiceWidget);
            $dispatchDeServiceWidget->setDispatchDeService($this);
        }

        return $this;
    }

    /**
     * @param DispatchDeServiceWidget $dispatchDeServiceWidget
     *
     * @return $this
     */
    public function removeDispatchDeServiceWidget(DispatchDeServiceWidget $dispatchDeServiceWidget)
    {
        if ($this->dispatchDeServiceWidgets->contains($dispatchDeServiceWidget)) {
            $this->dispatchDeServiceWidgets->removeElement($dispatchDeServiceWidget);
        }

        return $this;
    }

    /**
     * @return mixed
     */
    public function getDispatchDeServiceContacts()
    {
        return $this->dispatchDeServiceContacts;
    }

    /**
     * @param DispatchDeServiceContact $dispatchDeServiceContact
     *
     * @return $this
     */
    public function addDispatchDeServiceContact(DispatchDeServiceContact $dispatchDeServiceContact)
    {
        if (!$this->dispatchDeServiceContacts->contains($dispatchDeServiceContact)) {
            $this->dispatchDeServiceContacts->add($dispatchDeServiceContact);
            $dispatchDeServiceContact->setDispatchDeService($this);
        }

        return $this;
    }

    /**
     * @param DispatchDeServiceContact $dispatchDeServiceContact
     *
     * @return $this
     */
    public function removeDispatchDeServiceContact(DispatchDeServiceContact $dispatchDeServiceContact)
    {
        if ($this->dispatchDeServiceContacts->contains($dispatchDeServiceContact)) {
            $this->dispatchDeServiceContacts->removeElement($dispatchDeServiceContact);
        }

        return $this;
    }
}
