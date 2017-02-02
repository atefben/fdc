<?php

namespace FDC\MarcheDuFilmBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use A2lix\I18nDoctrineBundle\Doctrine\ORM\Util\Translatable;
use Doctrine\ORM\Mapping as ORM;

/**
 * MdfPressRelease
 * @ORM\Table(name="mdf_press_release")
 * @ORM\Entity
 */
class MdfPressRelease
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
     * @ORM\OneToMany(targetEntity="MdfPressReleaseFile", mappedBy="pressRelease", cascade={"persist", "remove", "refresh"}, orphanRemoval=true)
     * @ORM\OrderBy({"position" = "ASC"})
     */
    protected $files;

    /**
     * @var ArrayCollection
     */
    protected $translations;

    public function __construct() {
        $this->translations = new ArrayCollection();
        $this->files = new ArrayCollection();
    }

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return ArrayCollection
     */
    public function getTranslations()
    {
        return $this->translations;
    }

    /**
     * @param $translations
     *
     * @return $this
     */
    public function setTranslations($translations)
    {
        $this->translations = $translations;

        return $this;
    }

    /**
     * @param MdfPressReleaseFile $file
     */
    public function addFil(MdfPressReleaseFile $file)
    {
        $file->setPressRelease($this);
        $this->files->add($file);
    }

    /**
     * @param MdfPressReleaseFile $file
     */
    public function removeFil(MdfPressReleaseFile $file)
    {
        $this->files->removeElement($file);
    }

    /**
     * @return ArrayCollection
     */
    public function getFiles()
    {
        return $this->files;
    }
}
