<?php

namespace Base\CoreBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

use Base\CoreBundle\Util\Time;

/**
 * HomepagePushSecondary
 *
 * @ORM\Table()
 * @ORM\Entity
 * @ORM\HasLifecycleCallbacks()
 */
class HomepagePushSecondary
{
    use Time;

    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(type="string", nullable=false)
     **/
    private $title;

    /**
     * @var string
     *
     * @ORM\Column(type="string", nullable=false)
     **/
    private $alt;

    /**
     * @var string
     *
     * @ORM\Column(type="string", nullable=false)
     **/
    private $url;

    /**
     *
     * @ORM\ManyToOne(targetEntity="Application\Sonata\MediaBundle\Entity\Media")
     */
    private $file;

    /**
     *
     * @ORM\ManyToOne(targetEntity="HomepageTranslation", inversedBy="pushsSecondary")
     */
    private $homepageTranslation;

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
     * Set title
     *
     * @param string $title
     * @return HomepagePushSecondary
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
     * Set alt
     *
     * @param string $alt
     * @return HomepagePushSecondary
     */
    public function setAlt($alt)
    {
        $this->alt = $alt;

        return $this;
    }

    /**
     * Get alt
     *
     * @return string 
     */
    public function getAlt()
    {
        return $this->alt;
    }

    /**
     * Set url
     *
     * @param string $url
     * @return HomepagePushSecondary
     */
    public function setUrl($url)
    {
        $this->url = $url;

        return $this;
    }

    /**
     * Get url
     *
     * @return string 
     */
    public function getUrl()
    {
        return $this->url;
    }

    /**
     * Set file
     *
     * @param \Application\Sonata\MediaBundle\Entity\Media $file
     * @return HomepagePushSecondary
     */
    public function setFile(\Application\Sonata\MediaBundle\Entity\Media $file = null)
    {
        $this->file = $file;

        return $this;
    }

    /**
     * Get file
     *
     * @return \Application\Sonata\MediaBundle\Entity\Media 
     */
    public function getFile()
    {
        return $this->file;
    }

    /**
     * Set homepageTranslation
     *
     * @param \Base\CoreBundle\Entity\HomepageTranslation $homepageTranslation
     * @return HomepagePushSecondary
     */
    public function setHomepageTranslation(\Base\CoreBundle\Entity\HomepageTranslation $homepageTranslation = null)
    {
        $this->homepageTranslation = $homepageTranslation;

        return $this;
    }

    /**
     * Get homepageTranslation
     *
     * @return \Base\CoreBundle\Entity\HomepageTranslation 
     */
    public function getHomepageTranslation()
    {
        return $this->homepageTranslation;
    }
}
