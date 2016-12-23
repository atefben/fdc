<?php

namespace Base\CoreBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * OldEncartI18n
 *
 * @ORM\Table(name="old_encart_i18n")
 * @ORM\Entity
 */
class OldEncartI18n
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
     * @ORM\Column(name="legende", type="text", nullable=true)
     */
    protected $legende;

    /**
     * @var string
     *
     * @ORM\Column(name="link", type="text", nullable=true)
     */
    protected $link;

    /**
     * @var string
     *
     * @ORM\Column(name="tag", type="string", length=255, nullable=true)
     */
    protected $tag;

    /**
     * @var string
     *
     * @ORM\Column(name="image", type="string", length=255, nullable=true)
     */
    protected $image;



    /**
     * Set id
     *
     * @param integer $id
     * @return OldEncartI18n
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
     * @return OldEncartI18n
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
     * @return OldEncartI18n
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
     * Set legende
     *
     * @param string $legende
     * @return OldEncartI18n
     */
    public function setLegende($legende)
    {
        $this->legende = $legende;

        return $this;
    }

    /**
     * Get legende
     *
     * @return string 
     */
    public function getLegende()
    {
        return $this->legende;
    }

    /**
     * Set link
     *
     * @param string $link
     * @return OldEncartI18n
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
     * Set tag
     *
     * @param string $tag
     * @return OldEncartI18n
     */
    public function setTag($tag)
    {
        $this->tag = $tag;

        return $this;
    }

    /**
     * Get tag
     *
     * @return string 
     */
    public function getTag()
    {
        return $this->tag;
    }

    /**
     * Set image
     *
     * @param string $image
     * @return OldEncartI18n
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
}
