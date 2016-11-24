<?php

namespace Base\CoreBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * OldMosaiqueI18n
 *
 * @ORM\Table(name="old_mosaique_i18n")
 * @ORM\Entity
 */
class OldMosaiqueI18n
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
     * @ORM\Column(name="no_video_link", type="string", length=255, nullable=true)
     */
    private $noVideoLink;

    /**
     * @var string
     *
     * @ORM\Column(name="big_image", type="string", length=500, nullable=true)
     */
    private $bigImage;

    /**
     * @var string
     *
     * @ORM\Column(name="big_flash", type="string", length=500, nullable=true)
     */
    private $bigFlash;



    /**
     * Set id
     *
     * @param integer $id
     * @return OldMosaiqueI18n
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
     * @return OldMosaiqueI18n
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
     * Set noVideoLink
     *
     * @param string $noVideoLink
     * @return OldMosaiqueI18n
     */
    public function setNoVideoLink($noVideoLink)
    {
        $this->noVideoLink = $noVideoLink;

        return $this;
    }

    /**
     * Get noVideoLink
     *
     * @return string 
     */
    public function getNoVideoLink()
    {
        return $this->noVideoLink;
    }

    /**
     * Set bigImage
     *
     * @param string $bigImage
     * @return OldMosaiqueI18n
     */
    public function setBigImage($bigImage)
    {
        $this->bigImage = $bigImage;

        return $this;
    }

    /**
     * Get bigImage
     *
     * @return string 
     */
    public function getBigImage()
    {
        return $this->bigImage;
    }

    /**
     * Set bigFlash
     *
     * @param string $bigFlash
     * @return OldMosaiqueI18n
     */
    public function setBigFlash($bigFlash)
    {
        $this->bigFlash = $bigFlash;

        return $this;
    }

    /**
     * Get bigFlash
     *
     * @return string 
     */
    public function getBigFlash()
    {
        return $this->bigFlash;
    }
}
