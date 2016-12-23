<?php

namespace Base\CoreBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * OldArticleOrangeI18n
 *
 * @ORM\Table(name="old_article_orange_i18n")
 * @ORM\Entity
 */
class OldArticleOrangeI18n
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     */
    protected $id;

    /**
     * @var string
     *
     * @ORM\Column(name="culture", type="string", length=7, nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     */
    protected $culture;

    /**
     * @var string
     *
     * @ORM\Column(name="title", type="string", length=500, nullable=true)
     */
    protected $title;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="text", nullable=true)
     */
    protected $description;

    /**
     * @var string
     *
     * @ORM\Column(name="image_filename", type="string", length=255, nullable=true)
     */
    protected $imageFilename;

    /**
     * @var string
     *
     * @ORM\Column(name="image_copyright", type="string", length=255, nullable=true)
     */
    protected $imageCopyright;



    /**
     * Set id
     *
     * @param integer $id
     * @return OldArticleOrangeI18n
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
     * @return OldArticleOrangeI18n
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
     * @return OldArticleOrangeI18n
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
     * Set description
     *
     * @param string $description
     * @return OldArticleOrangeI18n
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get description
     *
     * @return string 
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set imageFilename
     *
     * @param string $imageFilename
     * @return OldArticleOrangeI18n
     */
    public function setImageFilename($imageFilename)
    {
        $this->imageFilename = $imageFilename;

        return $this;
    }

    /**
     * Get imageFilename
     *
     * @return string 
     */
    public function getImageFilename()
    {
        return $this->imageFilename;
    }

    /**
     * Set imageCopyright
     *
     * @param string $imageCopyright
     * @return OldArticleOrangeI18n
     */
    public function setImageCopyright($imageCopyright)
    {
        $this->imageCopyright = $imageCopyright;

        return $this;
    }

    /**
     * Get imageCopyright
     *
     * @return string 
     */
    public function getImageCopyright()
    {
        return $this->imageCopyright;
    }
}
