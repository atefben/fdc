<?php

namespace FDC\MarcheDuFilmBundle\Entity;

use A2lix\I18nDoctrineBundle\Doctrine\ORM\Util\Translatable;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * PressGallery
 * @ORM\Table(name="mdf_press_gallery")
 * @ORM\Entity
 */
class MdfPressGallery
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
     * @ORM\OneToMany(targetEntity="MdfPressGalleryWidget", mappedBy="pressGallery", cascade={"persist", "remove", "refresh"}, orphanRemoval=true)
     * @ORM\OrderBy({"position" = "ASC"})
     */
    protected $pressGalleryWidgets;

    /**
     * @var ArrayCollection
     */
    protected $translations;

    /**
     * HeaderFooter constructor.
     */
    public function __construct()
    {
        $this->pressGalleryWidgets = new ArrayCollection();
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
    public function getPressGalleryWidgets()
    {
        return $this->pressGalleryWidgets;
    }

    /**
     * @param MdfPressGalleryWidget $pressGalleryWidget
     *
     * @return $this
     */
    public function addPressGalleryWidget(MdfPressGalleryWidget $pressGalleryWidget)
    {
        if (!$this->pressGalleryWidgets->contains($pressGalleryWidget)) {
            $this->pressGalleryWidgets->add($pressGalleryWidget);
            $pressGalleryWidget->setPressGallery($this);
        }

        return $this;
    }

    /**
     * @param MdfPressGalleryWidget $pressGalleryWidget
     *
     * @return $this
     */
    public function removePressGalleryWidget(MdfPressGalleryWidget $pressGalleryWidget)
    {
        if ($this->pressGalleryWidgets->contains($pressGalleryWidget)) {
            $this->pressGalleryWidgets->removeElement($pressGalleryWidget);
        }

        return $this;
    }
}
