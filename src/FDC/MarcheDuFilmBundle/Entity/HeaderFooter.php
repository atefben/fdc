<?php

namespace FDC\MarcheDuFilmBundle\Entity;

use A2lix\I18nDoctrineBundle\Doctrine\ORM\Util\Translatable;
use Doctrine\Common\Collections\ArrayCollection;
use FDC\MarcheDuFilmBundle\Entity\MediaMdf;
use Doctrine\ORM\Mapping as ORM;

/**
 * HeaderFooter
 * @ORM\Table(name="mdf_header_footer")
 * @ORM\Entity
 */
class HeaderFooter
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
     * @var MediaMdf
     * @ORM\ManyToOne(targetEntity="FDC\MarcheDuFilmBundle\Entity\MediaMdfImage", inversedBy="headerFooter")
     * @ORM\JoinColumn(name="header_banner_id", referencedColumnName="id", onDelete="SET NULL")
     */
    protected $headerBanner;

    /**
     * @var ArrayCollection
     */
    protected $translations;

    /**
     * HeaderFooter constructor.
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
     * @return MediaMdf
     */
    public function getHeaderBanner()
    {
        return $this->headerBanner;
    }

    /**
     * @param $headerBanner
     *
     * @return $this
     */
    public function setHeaderBanner($headerBanner)
    {
        $this->headerBanner = $headerBanner;

        return $this;
    }
}
