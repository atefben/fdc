<?php

namespace Base\CoreBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * OldArchivesImageBackground
 *
 * @ORM\Table(name="old_archives_image_background")
 * @ORM\Entity
 */
class OldArchivesImageBackground
{
    /**
     * @var integer
     *
     * @ORM\Column(name="year", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    protected $year;

    /**
     * @var string
     *
     * @ORM\Column(name="image", type="string", length=255, nullable=true)
     */
    protected $image;



    /**
     * Get year
     *
     * @return integer 
     */
    public function getYear()
    {
        return $this->year;
    }

    /**
     * Set image
     *
     * @param string $image
     * @return OldArchivesImageBackground
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
