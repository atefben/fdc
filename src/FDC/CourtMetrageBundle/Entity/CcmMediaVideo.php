<?php

namespace FDC\CourtMetrageBundle\Entity;


use Symfony\Component\Validator\Constraints as Assert;
use Doctrine\ORM\Mapping as ORM;
use A2lix\I18nDoctrineBundle\Doctrine\ORM\Util\Translatable;
use Base\AdminBundle\Component\Admin\Export;

/**
 * CcmMediaVideo
 *
 * @ORM\Table(name="ccm_media_video")
 * @ORM\Entity()
 * @ORM\HasLifecycleCallbacks()
 */
class CcmMediaVideo extends CcmMedia
{
    use Translatable;

    /**
     * @var CcmMediaImage
     *
     * @ORM\ManyToOne(targetEntity="FDC\CourtMetrageBundle\Entity\CcmMediaImage", cascade={"persist"})
     */
    protected $image;

    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Set image
     *
     * @param CcmMediaImage $image
     * @return CcmMediaVideo
     */
    public function setImage(CcmMediaImage $image = null)
    {
        $this->image = $image;

        return $this;
    }

    /**
     * Get image
     *
     * @return CcmMediaImage
     */
    public function getImage()
    {
        return $this->image;
    }

    public function getExportTitle()
    {
        return Export::translationField($this, 'title', 'fr');
    }

    public function getExportTheme()
    {
        return Export::translationField($this->getTheme(), 'name', 'fr');
    }

    public function getExportAuthor()
    {
        if (!$this->getCreatedBy()) {
            return '';
        }
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
        if (!$this->findTranslationByLocale('fr')) {
            return '';
        }
        $status = $this->findTranslationByLocale('fr')->getStatus();
        return Export::formatTranslationStatus($status);
    }

    public function getExportStatusEn()
    {
        if (!$this->findTranslationByLocale('en')) {
            return '';
        }
        $status = $this->findTranslationByLocale('en')->getStatus();
        return Export::formatTranslationStatus($status);
    }
}
