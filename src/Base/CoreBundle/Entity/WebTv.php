<?php

namespace Base\CoreBundle\Entity;

use A2lix\I18nDoctrineBundle\Doctrine\ORM\Util\Translatable;

use Base\CoreBundle\Util\Time;
use Base\CoreBundle\Util\TranslateMain;
use Base\CoreBundle\Interfaces\TranslateMainInterface;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

use JMS\Serializer\Annotation\Groups;
use JMS\Serializer\Annotation\Since;

use Symfony\Component\Validator\Constraints as Assert;

/**
 * WebTv
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Base\CoreBundle\Repository\WebTvRepository")
 * @ORM\HasLifecycleCallbacks
 */
class WebTv implements TranslateMainInterface
{
    use Time;
    use TranslateMain;
    use Translatable;

    /**
     * @var string
     *
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     *
     * @Groups({"web_tv_list", "web_tv_show"})
     */
    private $id;

    /**
     * @var FilmFestival
     *
     * @ORM\ManyToOne(targetEntity="FilmFestival")
     */
    private $festival;

    /**
     * @ORM\OneToMany(targetEntity="MediaVideo", mappedBy="webTv")
     *
     * @Groups({"web_tv_list", "web_tv_show"})
     */
    private $mediaVideos;

    /**
     * @var Homepage
     *
     * @ORM\ManyToOne(targetEntity="Homepage", inversedBy="topWebTvs")
     */
    private $homepage;

    /**
     * @ORM\ManyToOne(targetEntity="MediaImage")
     *
     * @Groups({"web_tv_list", "web_tv_show"})
     */
    private $image;

    /**
     * @var ArrayCollection
     *
     * @Groups({"web_tv_list", "web_tv_show"})
     * @Assert\Valid()
     */
    protected $translations;

    public function __construct()
    {
        $this->translations = new ArrayCollection();
    }

    public function __toString()
    {
        $translationFr = $this->findTranslationByLocale('fr');
        if ($translationFr !== null) {
            return $translationFr->getName();
        }
        return '';
    }
    /**
     * Set id
     *
     * @param integer $id
     * @return WebTV
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
     * Add mediaVideos
     *
     * @param \Base\CoreBundle\Entity\MediaVideo $mediaVideos
     * @return WebTv
     */
    public function addMediaVideo(\Base\CoreBundle\Entity\MediaVideo $mediaVideos)
    {
        $this->mediaVideos[] = $mediaVideos;

        return $this;
    }

    /**
     * Remove mediaVideos
     *
     * @param \Base\CoreBundle\Entity\MediaVideo $mediaVideos
     */
    public function removeMediaVideo(\Base\CoreBundle\Entity\MediaVideo $mediaVideos)
    {
        $this->mediaVideos->removeElement($mediaVideos);
    }

    /**
     * Get mediaVideos
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getMediaVideos()
    {
        return $this->mediaVideos;
    }

    /**
     * Set homepage
     *
     * @param \Base\CoreBundle\Entity\Homepage $homepage
     * @return WebTv
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
     * Set image
     *
     * @param \Base\CoreBundle\Entity\MediaImage $image
     * @return WebTv
     */
    public function setImage(\Base\CoreBundle\Entity\MediaImage $image = null)
    {
        $this->image = $image;

        return $this;
    }

    /**
     * Get image
     *
     * @return \Base\CoreBundle\Entity\MediaImage 
     */
    public function getImage()
    {
        return $this->image;
    }


    /**
     * Set festival
     *
     * @param \Base\CoreBundle\Entity\FilmFestival $festival
     * @return WebTv
     */
    public function setFestival(\Base\CoreBundle\Entity\FilmFestival $festival = null)
    {
        $this->festival = $festival;

        return $this;
    }

    /**
     * Get festival
     *
     * @return \Base\CoreBundle\Entity\FilmFestival 
     */
    public function getFestival()
    {
        return $this->festival;
    }
}
