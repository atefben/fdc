<?php

namespace Base\CoreBundle\Entity;

use A2lix\I18nDoctrineBundle\Doctrine\ORM\Util\Translatable;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Base\CoreBundle\Interfaces\TranslateMainInterface;
use Base\CoreBundle\Util\TranslateMain;
use Base\CoreBundle\Util\Time;
use Base\CoreBundle\Util\SeoMain;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * CorpoMediatheque
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Base\CoreBundle\Repository\TranslationRepository")
 */
class CorpoMediatheque implements TranslateMainInterface
{
    use Time;
    use Translatable;
    use TranslateMain;
    use SeoMain;

    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @var MediaImageSimple
     *
     * @ORM\ManyToOne(targetEntity="MediaImageSimple")
     *
     */
    protected $image;

    /**
     * @var ArrayCollection
     *
     * @Assert\Valid()
     */
    protected $translations;

    /**
     * @var CorpoMediathequeMedia
     *
     * @ORM\OneToMany(targetEntity="CorpoMediathequeMedia", mappedBy="mediatheque", cascade={"persist", "remove"}, orphanRemoval=true)
     */
    protected $medias;

    /**
     * @var boolean
     *
     * @ORM\Column(name="displayedSelection", type="boolean")
     */
    protected $displayedSelection;


    /**
     * FDCPageMediatheque constructor.
     */
    public function __construct()
    {
        $this->translations = new ArrayCollection();
        $this->medias = new \Doctrine\Common\Collections\ArrayCollection();
    }

    public function __toString() {
        return 'Notre sélection';
    }

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

    /**
     * Set image
     *
     * @param \Base\CoreBundle\Entity\MediaImageSimple $image
     * @return CorpoMediatheque
     */
    public function setImage(\Base\CoreBundle\Entity\MediaImageSimple $image = null)
    {
        $this->image = $image;

        return $this;
    }

    /**
     * Get image
     *
     * @return \Base\CoreBundle\Entity\MediaImageSimple 
     */
    public function getImage()
    {
        return $this->image;
    }
}
