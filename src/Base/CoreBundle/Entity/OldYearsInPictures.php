<?php

namespace Base\CoreBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * OldYearsInPictures
 *
 * @ORM\Table(name="old_years_in_pictures", indexes={@ORM\Index(name="pm_edition", columns={"edition"})})
 * @ORM\Entity
 */
class OldYearsInPictures
{
    /**
     * @var string
     *
     * @ORM\Column(name="image", type="string", length=255, nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    protected $image;

    /**
     * @var string
     *
     * @ORM\Column(name="title", type="string", length=255, nullable=true)
     */
    protected $title;

    /**
     * @var integer
     *
     * @ORM\Column(name="edition", type="smallint", nullable=false)
     */
    protected $edition;

    /**
     * @var string
     *
     * @ORM\Column(name="copyright", type="string", length=255, nullable=false)
     */
    protected $copyright;

    /**
     * @var integer
     *
     * @ORM\Column(name="order_number", type="smallint", nullable=true)
     */
    protected $orderNumber;



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
     * Set title
     *
     * @param string $title
     * @return OldYearsInPictures
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
     * Set edition
     *
     * @param integer $edition
     * @return OldYearsInPictures
     */
    public function setEdition($edition)
    {
        $this->edition = $edition;

        return $this;
    }

    /**
     * Get edition
     *
     * @return integer 
     */
    public function getEdition()
    {
        return $this->edition;
    }

    /**
     * Set copyright
     *
     * @param string $copyright
     * @return OldYearsInPictures
     */
    public function setCopyright($copyright)
    {
        $this->copyright = $copyright;

        return $this;
    }

    /**
     * Get copyright
     *
     * @return string 
     */
    public function getCopyright()
    {
        return $this->copyright;
    }

    /**
     * Set orderNumber
     *
     * @param integer $orderNumber
     * @return OldYearsInPictures
     */
    public function setOrderNumber($orderNumber)
    {
        $this->orderNumber = $orderNumber;

        return $this;
    }

    /**
     * Get orderNumber
     *
     * @return integer 
     */
    public function getOrderNumber()
    {
        return $this->orderNumber;
    }
}
