<?php

namespace FDC\CourtMetrageBundle\Entity;


use Symfony\Component\Validator\Constraints as Assert;
use A2lix\I18nDoctrineBundle\Doctrine\ORM\Util\Translatable;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation as Serializer;
use Application\Sonata\UserBundle\Entity\User;
use Base\AdminBundle\Component\Admin\Export;
use Base\CoreBundle\Interfaces\TranslateMainInterface;
use Base\CoreBundle\Util\Time;
use Base\CoreBundle\Util\TranslateMain;

/**
 * CcmMediaPdf
 *
 * @ORM\Table(name="ccm_media_pdf")
 * @ORM\Entity()
 * @ORM\HasLifecycleCallbacks()
 */
class CcmMediaPdf implements TranslateMainInterface
{
    use Translatable;
    use TranslateMain;
    use Time;

    /**
     * @var integer
     *
     * @ORM\Column(type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    protected $id;

    /**
     * @var ArrayCollection
     * @Assert\Valid()
     * @Serializer\Accessor(getter="getApiTranslations")
     */
    protected $translations;

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
     */
    protected $publishEndedAt;

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

    public function getApiTranslations()
    {
        $en = $this->findTranslationByLocale('en');
        $fr = $this->findTranslationByLocale('fr');
        if ((!$en || !$en->getFile() || $en->getStatus() !== CcmMediaImageTranslation::STATUS_TRANSLATED) && $fr) {
            $this->translations->set('en', $fr);
        }
        return $this->translations;
    }

    public function __toString()
    {
        $transFr = $this->findTranslationByLocale('fr');

        return ($transFr && $transFr->getName() !== null) ? $transFr->getName() : 'Nouveau Media pdf';
    }


    public function getExportName()
    {
        return Export::translationField($this, 'name', 'fr');
    }

    public function getExportAuthor()
    {
        return $this->getCreatedBy()->getId();
    }

    public function getExportCreatedAt()
    {
        return Export::formatDate($this->getCreatedAt());
    }

    public function getExportPublishDates()
    {
        return Export::publishsDates($this->getPublishedAt(), $this->getPublishEndedAt());
    }

    public function getExportUpdatedAt()
    {
        return Export::formatDate($this->getUpdatedAt());
    }

    public function getExportStatusMaster()
    {
        $status = $this->findTranslationByLocale('fr')->getStatus();
        return Export::formatTranslationStatus($status);
    }

    public function getExportStatusEn()
    {
        $status = $this->findTranslationByLocale('en')->getStatus();
        return Export::formatTranslationStatus($status);
    }

    /**
     * Constructor
     */
    public function __construct()
    {
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
     * @return CcmMediaPdf
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
     * Set publishEndedAt
     *
     * @param \DateTime $publishEndedAt
     * @return CcmMediaPdf
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
     * Set createdBy
     *
     * @param \Application\Sonata\UserBundle\Entity\User $createdBy
     * @return CcmMediaPdf
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
     * @return CcmMediaPdf
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
