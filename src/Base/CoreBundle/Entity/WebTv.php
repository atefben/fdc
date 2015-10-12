<?php

namespace Base\CoreBundle\Entity;

use A2lix\I18nDoctrineBundle\Doctrine\ORM\Util\Translatable;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

use Base\CoreBundle\Util\Time;
use Base\CoreBundle\Util\TranslationByLocale;

use JMS\Serializer\Annotation\Groups;
use JMS\Serializer\Annotation\Since;

/**
 * WebTv
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Base\CoreBundle\Repository\WebTvRepository")
 * @ORM\HasLifecycleCallbacks
 */
class WebTv
{
    use Time;
    use TranslationByLocale;
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
     * @ORM\OneToMany(targetEntity="MediaVideo", mappedBy="webTv")
     *
     * @Groups({"web_tv_list", "web_tv_show"})
     */
    private $mediaVideos;

    /**
     * @var ArrayCollection
     *
     * @Groups({"web_tv_list", "web_tv_show"})
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
}
