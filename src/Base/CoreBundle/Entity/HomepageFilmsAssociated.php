<?php

namespace Base\CoreBundle\Entity;

use \DateTime;

use A2lix\I18nDoctrineBundle\Doctrine\ORM\Util\Translatable;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

use Base\CoreBundle\Util\Time;

use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * HomepageFilmsAssociated
 *
 * @ORM\Table()
 * @ORM\Entity
 * @ORM\HasLifecycleCallbacks()
 */
class HomepageFilmsAssociated
{
    use Time;

    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @var News
     *
     * @ORM\ManyToOne(targetEntity="Homepage", inversedBy="filmsAssociated")
     */
    protected $homepage;

    /**
     * @var NewsArticle
     *
     * @ORM\ManyToOne(targetEntity="MediaVideo")
     */
    protected $video;

    /**
     * @var NewsArticle
     *
     * @ORM\ManyToOne(targetEntity="MediaImage")
     */
    protected $tabletImage;

    /**
     * @var NewsArticle
     *
     * @ORM\ManyToOne(targetEntity="MediaImage")
     */
    protected $mobileImage;

    /**
     * @var NewsArticle
     *
     * @ORM\ManyToOne(targetEntity="FilmFilm")
     */
    protected $association;

    public function __toString() {
        $string = substr(strrchr(get_class($this), '\\'), 1);

        if ($this->getId()) {
            $string .= ' #'. $this->getId();
        }

        return $string;
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
     * Set homepage
     *
     * @param \Base\CoreBundle\Entity\Homepage $homepage
     * @return HomepageFilmsAssociated
     */
    public function setHomepage(\Base\CoreBundle\Entity\Homepage $homepage = null)
    {
        $this->homepage = $homepage;

        return $this;
    }

    /**
     * Get homepage
     *
     * @return \Base\CoreBundle\Entity\Homepage 
     */
    public function getHomepage()
    {
        return $this->homepage;
    }

    /**
     * Set association
     *
     * @param \Base\CoreBundle\Entity\FilmFilm $association
     * @return HomepageFilmsAssociated
     */
    public function setAssociation(\Base\CoreBundle\Entity\FilmFilm $association = null)
    {
        $this->association = $association;

        return $this;
    }

    /**
     * Get association
     *
     * @return \Base\CoreBundle\Entity\FilmFilm 
     */
    public function getAssociation()
    {
        return $this->association;
    }

    /**
     * Set video
     *
     * @param \Base\CoreBundle\Entity\MediaVideo $video
     * @return HomepageFilmsAssociated
     */
    public function setVideo(\Base\CoreBundle\Entity\MediaVideo $video = null)
    {
        $this->video = $video;

        return $this;
    }

    /**
     * Get video
     *
     * @return \Base\CoreBundle\Entity\MediaVideo 
     */
    public function getVideo()
    {
        return $this->video;
    }

    /**
     * Set tabletImage
     *
     * @param \Base\CoreBundle\Entity\MediaImage $tabletImage
     * @return HomepageFilmsAssociated
     */
    public function setTabletImage(\Base\CoreBundle\Entity\MediaImage $tabletImage = null)
    {
        $this->tabletImage = $tabletImage;

        return $this;
    }

    /**
     * Get tabletImage
     *
     * @return \Base\CoreBundle\Entity\MediaImage 
     */
    public function getTabletImage()
    {
        return $this->tabletImage;
    }

    /**
     * Set mobileImage
     *
     * @param \Base\CoreBundle\Entity\MediaImage $mobileImage
     * @return HomepageFilmsAssociated
     */
    public function setMobileImage(\Base\CoreBundle\Entity\MediaImage $mobileImage = null)
    {
        $this->mobileImage = $mobileImage;

        return $this;
    }

    /**
     * Get mobileImage
     *
     * @return \Base\CoreBundle\Entity\MediaImage 
     */
    public function getMobileImage()
    {
        return $this->mobileImage;
    }
}
