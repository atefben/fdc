<?php

namespace FDC\CourtMetrageBundle\Entity;


use Symfony\Component\Validator\Constraints as Assert;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use JMS\Serializer\Annotation as Serializer;
use JMS\Serializer\Annotation\VirtualProperty;
use Application\Sonata\UserBundle\Entity\User;
use Base\CoreBundle\Interfaces\TranslateChildInterface;
use Base\CoreBundle\Interfaces\TranslateMainInterface;
use Base\CoreBundle\Util\SeoMain;
use Base\CoreBundle\Util\TranslateMain;
use Base\CoreBundle\Util\Time;
use Base\CoreBundle\Util\TruncatePro;

/**
 * CcmMedia
 *
 * @ORM\Entity()
 * @ORM\HasLifecycleCallbacks()
 * @ORM\InheritanceType("JOINED")
 * @ORM\DiscriminatorColumn(name="type", type="string")
 * @ORM\DiscriminatorMap({"image" = "CcmMediaImage", "audio" = "CcmMediaAudio", "video" = "CcmMediaVideo"})
 */
abstract class CcmMedia implements TranslateMainInterface
{
    use Time;
    use SeoMain;
    use TranslateMain;
    use TruncatePro;

    /**
     * @var integer
     *
     * @ORM\Column(type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    protected $id;

    /**
     * @var CcmTheme
     *
     * @ORM\ManyToOne(targetEntity="FDC\CourtMetrageBundle\Entity\CcmTheme", cascade={"persist"})
     */
    protected $theme;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="published_at", type="datetime", nullable=true)
     * @Serializer\Accessor(getter="getApiPublishedAt")
     */
    protected $publishedAt;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="publish_ended_at", type="datetime", nullable=true)
     *
     */
    protected $publishEndedAt;

    /**
     * @var ArrayCollection
     * @Assert\Valid()
     */
    protected $translations;

    /**
     * @var User
     *
     * @ORM\ManyToOne(targetEntity="Application\Sonata\UserBundle\Entity\User")
     */
    protected $createdBy;

    /**
     * @var User
     *
     * @ORM\ManyToOne(targetEntity="Application\Sonata\UserBundle\Entity\User")
     */
    protected $updatedBy;
    

    public function __construct()
    {
        $this->translations = new ArrayCollection();
    }

    public function __toString()
    {
        $string = substr(strrchr(get_class($this), '\\'), 1);

        if ($this->getId()) {
            if ($string != 'CcmMediaImage') {
                if ($this->findTranslationByLocale('fr') != null) {
                    $string = $this->findTranslationByLocale('fr')->getTitle();
                }
            } else {
                if ($this->findTranslationByLocale('fr') != null) {
                    $string = $this->findTranslationByLocale('fr')->getLegend();
                }
            }
        }

        return $string;
    }

    /**
     * Get the class type in the Api
     *
     * @VirtualProperty
     */
    public function getMediaType()
    {
        return substr(strrchr(get_called_class(), '\\'), 1);
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
     * Set publishedAt
     *
     * @param \DateTime $publishedAt
     * @return $this
     */
    public function setPublishedAt($publishedAt)
    {
        $this->publishedAt = $publishedAt;

        return $this;
    }

    /**
     * Get publishedAt
     *
     * @return \DateTime
     */
    public function getPublishedAt()
    {
        return $this->publishedAt;
    }

    /**
     * Get publishedAt
     *
     * @return \DateTime
     */
    public function getApiPublishedAt()
    {
        return $this->publishedAt ? $this->publishedAt : new \DateTime();
    }

    /**
     * Set publishEndedAt
     *
     * @param \DateTime $publishEndedAt
     * @return $this
     */
    public function setPublishEndedAt($publishEndedAt)
    {
        $this->publishEndedAt = $publishEndedAt;

        return $this;
    }

    /**
     * Get publishEndedAt
     *
     * @return \DateTime
     */
    public function getPublishEndedAt()
    {
        return $this->publishEndedAt;
    }

    /**
     * Set theme
     *
     * @param CcmTheme $theme
     * @return CcmMedia
     */
    public function setTheme(CcmTheme $theme = null)
    {
        $this->theme = $theme;

        return $this;
    }

    /**
     * Get theme
     *
     * @return CcmTheme
     */
    public function getTheme()
    {
        return $this->theme;
    }

    /**
     * Set createdBy
     *
     * @param \Application\Sonata\UserBundle\Entity\User $createdBy
     * @return CcmMedia
     */
    public function setCreatedBy(User $createdBy = null)
    {
        $this->createdBy = $createdBy;

        return $this;
    }

    /**
     * Get createdBy
     *
     * @return \Application\Sonata\UserBundle\Entity\User
     */
    public function getCreatedBy()
    {
        return $this->createdBy;
    }

    /**
     * Set updatedBy
     *
     * @param \Application\Sonata\UserBundle\Entity\User $updatedBy
     * @return CcmMedia
     */
    public function setUpdatedBy(User $updatedBy = null)
    {
        $this->updatedBy = $updatedBy;

        return $this;
    }

    /**
     * Get updatedBy
     *
     * @return \Application\Sonata\UserBundle\Entity\User
     */
    public function getUpdatedBy()
    {
        return $this->updatedBy;
    }
}
