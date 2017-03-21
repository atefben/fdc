<?php

namespace FDC\CourtMetrageBundle\Entity;

use A2lix\I18nDoctrineBundle\Doctrine\ORM\Util\Translation;
use Base\CoreBundle\Interfaces\TranslateChildInterface;
use Base\CoreBundle\Util\TranslateChild;
use Base\CoreBundle\Util\TranslationChanges;
use Doctrine\ORM\Mapping as ORM;


/**
 * CcmLabelFileTranslation
 * @ORM\Table(name="ccm_label_file_translation")
 * @ORM\Entity(repositoryClass="FDC\CourtMetrageBundle\Repository\CcmLabelFileTranslationRepository")
 */
class CcmLabelFileTranslation implements TranslateChildInterface
{
    use Translation;
    use TranslateChild;
    use TranslationChanges;

    /**
     * @var string
     *
     * @ORM\Column(type="string", nullable=true)
     */
    protected $fileTitle;

    /**
     * @var \Application\Sonata\MediaBundle\Entity\Media
     *
     * @ORM\OneToOne(targetEntity="Application\Sonata\MediaBundle\Entity\Media", cascade={"persist"}, fetch="LAZY")
     * @ORM\JoinColumn(name="file_id", referencedColumnName="id")
     *
     */
    protected $file;

    /**
     * @return string
     */
    public function getFileTitle()
    {
        return $this->fileTitle;
    }

    /**
     * @param string $fileTitle
     */
    public function setFileTitle($fileTitle)
    {
        $this->fileTitle = $fileTitle;
    }

    /**
     * @return \Application\Sonata\MediaBundle\Entity\Media
     */
    public function getFile()
    {
        return $this->file;
    }

    /**
     * @param \Application\Sonata\MediaBundle\Entity\Media $file
     */
    public function setFile($file)
    {
        $this->file = $file;
    }
}
