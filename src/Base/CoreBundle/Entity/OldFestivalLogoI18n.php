<?php

namespace Base\CoreBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * OldFestivalLogoI18n
 *
 * @ORM\Table(name="old_festival_logo_i18n")
 * @ORM\Entity
 */
class OldFestivalLogoI18n
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="culture", type="string", length=7, nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     */
    private $culture;

    /**
     * @var string
     *
     * @ORM\Column(name="legend", type="string", length=255, nullable=true)
     */
    private $legend;

    /**
     * @var string
     *
     * @ORM\Column(name="image", type="string", length=255, nullable=true)
     */
    private $image;

    /**
     * @var boolean
     *
     * @ORM\Column(name="is_translated", type="boolean", nullable=true)
     */
    private $isTranslated;



    /**
     * Set id
     *
     * @param integer $id
     * @return OldFestivalLogoI18n
     */
    public function setId($id)
    {
        $this->id = $id;

        return $this;
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
     * Set culture
     *
     * @param string $culture
     * @return OldFestivalLogoI18n
     */
    public function setCulture($culture)
    {
        $this->culture = $culture;

        return $this;
    }

    /**
     * Get culture
     *
     * @return string 
     */
    public function getCulture()
    {
        return $this->culture;
    }

    /**
     * Set legend
     *
     * @param string $legend
     * @return OldFestivalLogoI18n
     */
    public function setLegend($legend)
    {
        $this->legend = $legend;

        return $this;
    }

    /**
     * Get legend
     *
     * @return string 
     */
    public function getLegend()
    {
        return $this->legend;
    }

    /**
     * Set image
     *
     * @param string $image
     * @return OldFestivalLogoI18n
     */
    public function setImage($image)
    {
        $this->image = $image;

        return $this;
    }

    /**
     * Get image
     *
     * @return string 
     */
    public function getImage()
    {
        return $this->image;
    }

    /**
     * Set isTranslated
     *
     * @param boolean $isTranslated
     * @return OldFestivalLogoI18n
     */
    public function setIsTranslated($isTranslated)
    {
        $this->isTranslated = $isTranslated;

        return $this;
    }

    /**
     * Get isTranslated
     *
     * @return boolean 
     */
    public function getIsTranslated()
    {
        return $this->isTranslated;
    }
}
