<?php

namespace FDC\MarcheDuFilmBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * MdfProgramFile
 * @ORM\Table(name="mdf_program_file")
 * @ORM\Entity
 */
class MdfProgramFile
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
     * @ORM\ManyToOne(targetEntity="MdfConferenceProgram", inversedBy="files")
     * @ORM\JoinColumn(name="conference_program_id", referencedColumnName="id", onDelete="SET NULL")
     */
    protected $conferenceProgram;

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
    public function getConferenceProgram()
    {
        return $this->conferenceProgram;
    }

    /**
     * @param $conferenceProgram
     *
     * @return $this
     */
    public function setConferenceProgram($conferenceProgram)
    {
        $this->conferenceProgram = $conferenceProgram;

        return $this;
    }
}
