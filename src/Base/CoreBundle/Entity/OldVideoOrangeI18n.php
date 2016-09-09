<?php

namespace Base\CoreBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * OldVideoOrangeI18n
 *
 * @ORM\Table(name="old_video_orange_i18n")
 * @ORM\Entity
 */
class OldVideoOrangeI18n
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
     * @ORM\Column(name="title", type="string", length=500, nullable=true)
     */
    private $title;

    /**
     * @var string
     *
     * @ORM\Column(name="link", type="string", length=500, nullable=true)
     */
    private $link;

    /**
     * @var string
     *
     * @ORM\Column(name="detail_image_filename", type="string", length=255, nullable=true)
     */
    private $detailImageFilename;

    /**
     * @var string
     *
     * @ORM\Column(name="detail_image_copyright", type="string", length=255, nullable=true)
     */
    private $detailImageCopyright;



    /**
     * Set id
     *
     * @param integer $id
     * @return OldVideoOrangeI18n
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
     * @return OldVideoOrangeI18n
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
     * Set title
     *
     * @param string $title
     * @return OldVideoOrangeI18n
     */
    public function setTitle($title)
    {
        $this->title = $title;

        return $this;
    }

    /**
     * Get title
     *
     * @return string 
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Set link
     *
     * @param string $link
     * @return OldVideoOrangeI18n
     */
    public function setLink($link)
    {
        $this->link = $link;

        return $this;
    }

    /**
     * Get link
     *
     * @return string 
     */
    public function getLink()
    {
        return $this->link;
    }

    /**
     * Set detailImageFilename
     *
     * @param string $detailImageFilename
     * @return OldVideoOrangeI18n
     */
    public function setDetailImageFilename($detailImageFilename)
    {
        $this->detailImageFilename = $detailImageFilename;

        return $this;
    }

    /**
     * Get detailImageFilename
     *
     * @return string 
     */
    public function getDetailImageFilename()
    {
        return $this->detailImageFilename;
    }

    /**
     * Set detailImageCopyright
     *
     * @param string $detailImageCopyright
     * @return OldVideoOrangeI18n
     */
    public function setDetailImageCopyright($detailImageCopyright)
    {
        $this->detailImageCopyright = $detailImageCopyright;

        return $this;
    }

    /**
     * Get detailImageCopyright
     *
     * @return string 
     */
    public function getDetailImageCopyright()
    {
        return $this->detailImageCopyright;
    }
}
