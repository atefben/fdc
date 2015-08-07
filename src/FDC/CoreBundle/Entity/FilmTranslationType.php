<?php

namespace FDC\CoreBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

use FDC\CoreBundle\Util\Time;

/**
 * FilmTranslationType
 *
 * @ORM\Table()
 * @ORM\Entity
 * @ORM\HasLifecycleCallbacks
 */
class FilmTranslationType
{
    use Time;

    /**
     * @var string
     *
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(type="string", length=200)
     */
    private $wording;

    /**
     * @var string
     *
     * @ORM\Column(type="string", length=50, nullable=true)
     */
    private $tableDest;

    /**
     * @var string
     *
     * @ORM\Column(type="string", length=50, nullable=true)
     */
    private $tableOrig;

    /**
     * @var string
     *
     * @ORM\Column(type="string", length=50, nullable=true)
     */
    private $tableKey;

    /**
     * @var string
     *
     * @ORM\Column(type="string", length=50)
     */
    private $tableColumn;
    
    /**
     * @var FilmTranslation
     *
     * @ORM\OneToMany(targetEntity="FilmFilmTranslation", mappedBy="type")
     */
    private $filmTranslations;
    
    /**
     * @var FilmTranslation
     *
     * @ORM\OneToMany(targetEntity="FilmAtelierTranslation", mappedBy="type")
     */
    private $filmAtelierTranslations;
    
    /**
     * @var SiteTranslation
     *
     * @ORM\OneToMany(targetEntity="SiteTranslation", mappedBy="type")
     */
    private $siteTranslations;
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->filmTranslations = new \Doctrine\Common\Collections\ArrayCollection();
        $this->filmAtelierTranslations = new \Doctrine\Common\Collections\ArrayCollection();
        $this->siteTranslations = new \Doctrine\Common\Collections\ArrayCollection();
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
     * Set wording
     *
     * @param string $wording
     * @return FilmTranslationType
     */
    public function setWording($wording)
    {
        $this->wording = $wording;

        return $this;
    }

    /**
     * Get wording
     *
     * @return string 
     */
    public function getWording()
    {
        return $this->wording;
    }

    /**
     * Set tableDest
     *
     * @param string $tableDest
     * @return FilmTranslationType
     */
    public function setTableDest($tableDest)
    {
        $this->tableDest = $tableDest;

        return $this;
    }

    /**
     * Get tableDest
     *
     * @return string 
     */
    public function getTableDest()
    {
        return $this->tableDest;
    }

    /**
     * Set tableOrig
     *
     * @param string $tableOrig
     * @return FilmTranslationType
     */
    public function setTableOrig($tableOrig)
    {
        $this->tableOrig = $tableOrig;

        return $this;
    }

    /**
     * Get tableOrig
     *
     * @return string 
     */
    public function getTableOrig()
    {
        return $this->tableOrig;
    }

    /**
     * Set tableKey
     *
     * @param string $tableKey
     * @return FilmTranslationType
     */
    public function setTableKey($tableKey)
    {
        $this->tableKey = $tableKey;

        return $this;
    }

    /**
     * Get tableKey
     *
     * @return string 
     */
    public function getTableKey()
    {
        return $this->tableKey;
    }

    /**
     * Set tableColumn
     *
     * @param string $tableColumn
     * @return FilmTranslationType
     */
    public function setTableColumn($tableColumn)
    {
        $this->tableColumn = $tableColumn;

        return $this;
    }

    /**
     * Get tableColumn
     *
     * @return string 
     */
    public function getTableColumn()
    {
        return $this->tableColumn;
    }

    /**
     * Add filmTranslations
     *
     * @param \FDC\CoreBundle\Entity\FilmFilmTranslation $filmTranslations
     * @return FilmTranslationType
     */
    public function addFilmTranslation(\FDC\CoreBundle\Entity\FilmFilmTranslation $filmTranslations)
    {
        $this->filmTranslations[] = $filmTranslations;

        return $this;
    }

    /**
     * Remove filmTranslations
     *
     * @param \FDC\CoreBundle\Entity\FilmFilmTranslation $filmTranslations
     */
    public function removeFilmTranslation(\FDC\CoreBundle\Entity\FilmFilmTranslation $filmTranslations)
    {
        $this->filmTranslations->removeElement($filmTranslations);
    }

    /**
     * Get filmTranslations
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getFilmTranslations()
    {
        return $this->filmTranslations;
    }

    /**
     * Add filmAtelierTranslations
     *
     * @param \FDC\CoreBundle\Entity\FilmAtelierTranslation $filmAtelierTranslations
     * @return FilmTranslationType
     */
    public function addFilmAtelierTranslation(\FDC\CoreBundle\Entity\FilmAtelierTranslation $filmAtelierTranslations)
    {
        $this->filmAtelierTranslations[] = $filmAtelierTranslations;

        return $this;
    }

    /**
     * Remove filmAtelierTranslations
     *
     * @param \FDC\CoreBundle\Entity\FilmAtelierTranslation $filmAtelierTranslations
     */
    public function removeFilmAtelierTranslation(\FDC\CoreBundle\Entity\FilmAtelierTranslation $filmAtelierTranslations)
    {
        $this->filmAtelierTranslations->removeElement($filmAtelierTranslations);
    }

    /**
     * Get filmAtelierTranslations
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getFilmAtelierTranslations()
    {
        return $this->filmAtelierTranslations;
    }

    /**
     * Add siteTranslations
     *
     * @param \FDC\CoreBundle\Entity\SiteTranslation $siteTranslations
     * @return FilmTranslationType
     */
    public function addSiteTranslation(\FDC\CoreBundle\Entity\SiteTranslation $siteTranslations)
    {
        $this->siteTranslations[] = $siteTranslations;

        return $this;
    }

    /**
     * Remove siteTranslations
     *
     * @param \FDC\CoreBundle\Entity\SiteTranslation $siteTranslations
     */
    public function removeSiteTranslation(\FDC\CoreBundle\Entity\SiteTranslation $siteTranslations)
    {
        $this->siteTranslations->removeElement($siteTranslations);
    }

    /**
     * Get siteTranslations
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getSiteTranslations()
    {
        return $this->siteTranslations;
    }
}
