<?php

namespace FDC\MarcheDuFilmBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Annual graphic charter
 * @ORM\Table(name="mdf_annual_graphic_charters")
 * @ORM\Entity
 */
class MdfAnnualGraphicCharter
{
    /**
     * @var integer
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @var \FDC\MarcheDuFilmBundle\Entity\MediaMdfImage
     *
     * @ORM\ManyToOne(targetEntity="\FDC\MarcheDuFilmBundle\Entity\MediaMdfImage")
     * @ORM\JoinColumn(name="background_image1_id", referencedColumnName="id", onDelete="SET NULL")
     */
    protected $backgroundImage1;

    /**
     * @var \FDC\MarcheDuFilmBundle\Entity\MediaMdfImage
     *
     * @ORM\ManyToOne(targetEntity="\FDC\MarcheDuFilmBundle\Entity\MediaMdfImage")
     * @ORM\JoinColumn(name="background_image2_id", referencedColumnName="id", onDelete="SET NULL")
     */
    protected $backgroundImage2;

    /**
     * @var \FDC\MarcheDuFilmBundle\Entity\MediaMdfImage
     *
     * @ORM\ManyToOne(targetEntity="\FDC\MarcheDuFilmBundle\Entity\MediaMdfImage")
     * @ORM\JoinColumn(name="background_image3_id", referencedColumnName="id", onDelete="SET NULL")
     */
    protected $backgroundImage3;

    /**
     * @var string
     *
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $color1;

    /**
     * @var string
     *
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $color2;

    /**
     * @var string
     *
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $color3;

    /**
     * @var string
     *
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $color4;

    /**
     * @var string
     *
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $color5;

    /**
     * @var string
     *
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $color6;

    /**
     * @var string
     *
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $color7;


    /**
     * HeaderFooter constructor.
     */
    public function __construct()
    {
    }

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set backgroundImage1
     *
     * @param \FDC\MarcheDuFilmBundle\Entity\MediaMdfImage $backgroundImage1
     * @return MdfAnnualGraphicCharter
     */
    public function setBackgroundImage1(\FDC\MarcheDuFilmBundle\Entity\MediaMdfImage $backgroundImage1)
    {
        $this->backgroundImage1 = $backgroundImage1;

        return $this;
    }

    /**
     * Get backgroundImage1
     *
     * @return \FDC\MarcheDuFilmBundle\Entity\MediaMdfImage
     */
    public function getBackgroundImage1()
    {
        return $this->backgroundImage1;
    }

    /**
     * Set backgroundImage2
     *
     * @param \FDC\MarcheDuFilmBundle\Entity\MediaMdfImage $backgroundImage2
     * @return MdfAnnualGraphicCharter
     */
    public function setBackgroundImage2(\FDC\MarcheDuFilmBundle\Entity\MediaMdfImage $backgroundImage2)
    {
        $this->backgroundImage2 = $backgroundImage2;

        return $this;
    }

    /**
     * Get backgroundImage2
     *
     * @return \FDC\MarcheDuFilmBundle\Entity\MediaMdfImage
     */
    public function getBackgroundImage2()
    {
        return $this->backgroundImage2;
    }

    /**
     * Set backgroundImage3
     *
     * @param \FDC\MarcheDuFilmBundle\Entity\MediaMdfImage $backgroundImage3
     * @return MdfAnnualGraphicCharter
     */
    public function setBackgroundImage3(\FDC\MarcheDuFilmBundle\Entity\MediaMdfImage $backgroundImage3)
    {
        $this->backgroundImage3 = $backgroundImage3;

        return $this;
    }

    /**
     * Get backgroundImage3
     *
     * @return \FDC\MarcheDuFilmBundle\Entity\MediaMdfImage
     */
    public function getBackgroundImage3()
    {
        return $this->backgroundImage3;
    }

    /**
     * Set color1
     *
     * @param string $color1
     * @return MdfAnnualGraphicCharter
     */
    public function setColor1($color1)
    {
        $this->color1 = $color1;

        return $this;
    }

    /**
     * Get color1
     *
     * @return string
     */
    public function getColor1()
    {
        return $this->color1;
    }

    /**
     * Set color2
     *
     * @param string $color2
     * @return MdfAnnualGraphicCharter
     */
    public function setColor2($color2)
    {
        $this->color2 = $color2;

        return $this;
    }

    /**
     * Get color2
     *
     * @return string
     */
    public function getColor2()
    {
        return $this->color2;
    }

    /**
     * Set color3
     *
     * @param string $color3
     * @return MdfAnnualGraphicCharter
     */
    public function setColor3($color3)
    {
        $this->color3 = $color3;

        return $this;
    }

    /**
     * Get color3
     *
     * @return string
     */
    public function getColor3()
    {
        return $this->color3;
    }

    /**
     * Set color4
     *
     * @param string $color4
     * @return MdfAnnualGraphicCharter
     */
    public function setColor4($color4)
    {
        $this->color4 = $color4;

        return $this;
    }

    /**
     * Get color4
     *
     * @return string
     */
    public function getColor4()
    {
        return $this->color4;
    }

    /**
     * Set color5
     *
     * @param string $color5
     * @return MdfAnnualGraphicCharter
     */
    public function setColor5($color5)
    {
        $this->color5 = $color5;

        return $this;
    }

    /**
     * Get color5
     *
     * @return string
     */
    public function getColor5()
    {
        return $this->color5;
    }

    /**
     * Set color6
     *
     * @param string $color6
     * @return MdfAnnualGraphicCharter
     */
    public function setColor6($color6)
    {
        $this->color6 = $color6;

        return $this;
    }

    /**
     * Get color16
     *
     * @return string
     */
    public function getColor6()
    {
        return $this->color6;
    }

    /**
     * Set color7
     *
     * @param string $color7
     * @return MdfAnnualGraphicCharter
     */
    public function setColor7($color7)
    {
        $this->color7 = $color7;

        return $this;
    }

    /**
     * Get color7
     *
     * @return string
     */
    public function getColor7()
    {
        return $this->color7;
    }

    public function getTitle()
    {
        return 'Charte graphique annuelle';
    }

    public function __toString()
    {
        return 'Charte graphique annuelle';
    }
}
