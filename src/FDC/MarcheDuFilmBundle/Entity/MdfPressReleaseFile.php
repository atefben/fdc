<?php

namespace FDC\MarcheDuFilmBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * MdfPressReleaseFile
 * @ORM\Table(name="mdf_press_release_file")
 * @ORM\Entity
 */
class MdfPressReleaseFile
{
    /**
     * @var integer
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @var MediaMdfPdf
     * @ORM\ManyToOne(targetEntity="FDC\MarcheDuFilmBundle\Entity\MediaMdfPdf")
     */
    protected $file;

    /**
     * @var integer
     *
     * @ORM\Column(type="integer", nullable=true)
     */
    protected $position;

    /**
     * @ORM\ManyToOne(targetEntity="MdfPressRelease", inversedBy="files")
     * @ORM\JoinColumn(name="press_release_id", referencedColumnName="id", onDelete="SET NULL")
     */
    protected $pressRelease;

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return MediaMdfPdf
     */
    public function getFile()
    {
        return $this->file;
    }

    /**
     * @param $file
     *
     * @return $this
     */
    public function setFile($file)
    {
        $this->file = $file;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getPressRelease()
    {
        return $this->pressRelease;
    }

    /**
     * @param $pressRelease
     *
     * @return $this
     */
    public function setPressRelease($pressRelease)
    {
        $this->pressRelease = $pressRelease;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getPosition()
    {
        return $this->position;
    }

    /**
     * @param $position
     *
     * @return $this
     */
    public function setPosition($position)
    {
        $this->position = $position;

        return $this;
    }
}
