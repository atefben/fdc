<?php

namespace Base\CoreBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * CorpoMediatheque
 *
 * @ORM\Table()
 * @ORM\Entity
 */
class CorpoMediatheque
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
     * @var CorpoMediathequeMedia
     *
     * @ORM\OneToMany(targetEntity="CorpoMediathequeMedia", mappedBy="mediatheque", cascade={"persist", "remove"}, orphanRemoval=true)
     */
    private $medias;

    /**
     * @var boolean
     *
     * @ORM\Column(name="displayedSelection", type="boolean")
     */
    private $displayedSelection;


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
     * Set displayedSelection
     *
     * @param boolean $displayedSelection
     * @return CorpoMediatheque
     */
    public function setDisplayedSelection($displayedSelection)
    {
        $this->displayedSelection = $displayedSelection;

        return $this;
    }

    /**
     * Get displayedSelection
     *
     * @return boolean 
     */
    public function getDisplayedSelection()
    {
        return $this->displayedSelection;
    }
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->medias = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add medias
     *
     * @param \Base\CoreBundle\Entity\CorpoMediathequeMedia $medias
     * @return CorpoMediatheque
     */
    public function addMedia(\Base\CoreBundle\Entity\CorpoMediathequeMedia $medias)
    {
        $medias->setMediatheque($this);
        $this->medias[] = $medias;

        return $this;
    }

    /**
     * Remove medias
     *
     * @param \Base\CoreBundle\Entity\CorpoMediathequeMedia $medias
     */
    public function removeMedia(\Base\CoreBundle\Entity\CorpoMediathequeMedia $medias)
    {
        $this->medias->removeElement($medias);
    }

    /**
     * Get medias
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getMedias()
    {
        return $this->medias;
    }

    /**
     * Get medias
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getMediasSelection()
    {
        $medias = new ArrayCollection();
        foreach($this->getMedias() as $media) {
            $medias->add($media->getMedia());
        }

        return $medias;
    }
}
