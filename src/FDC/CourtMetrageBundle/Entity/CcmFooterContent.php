<?php

namespace FDC\CourtMetrageBundle\Entity;

use A2lix\I18nDoctrineBundle\Doctrine\ORM\Util\Translatable;
use Base\CoreBundle\Interfaces\TranslateMainInterface;
use Base\CoreBundle\Util\SeoMain;
use Base\CoreBundle\Util\Time;
use Base\CoreBundle\Util\TranslateMain;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * CcmFooterContent
 * @ORM\Table(name="ccm_footer_content")
 * @ORM\Entity
 * @ORM\HasLifecycleCallbacks()
 */
class CcmFooterContent implements TranslateMainInterface
{

    use Time;
    use SeoMain;
    use Translatable;
    use TranslateMain;

    const FOOTER_MENTIONES_LEGALES = 'mentions-legales';
    const FOOTER_CREDITS = 'credits';
    const FOOTER_CONFIDENTIALITE = 'politique-de-confidentialite';
    
    /**
     * @var integer
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @var string
     *
     * @ORM\Column(type="string", nullable=false)
     */
    protected $type;

    /**
     * @var ArrayCollection
     * @ORM\OneToMany(targetEntity="FDC\CourtMetrageBundle\Entity\CcmFooterContentText", mappedBy="footerContent", cascade={"persist", "remove"}, orphanRemoval=true)
     * @ORM\OrderBy({"position" = "ASC"})
     */
    protected $contentText;

    /**
     * @var ArrayCollection
     */
    protected $translations;

    public function __construct()
    {
        $this->translations = new ArrayCollection();
        $this->contentText = new  ArrayCollection();
    }

    public function __toString()
    {
        $translation = $this->findTranslationByLocale('fr');

        if ($translation !== null) {
            $string = $translation->getTitle();
        } else {
            $string = strval($this->getId());
        }
        return (string) $string;
    }

    public function getTitle()
    {
        $translation = $this->findTranslationByLocale('fr');
        $string = '';

        if ($translation !== null) {
            $string = $translation->getTitle();
        }

        return $string;
    }

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return ArrayCollection
     */
    public function getTranslations()
    {
        return $this->translations;
    }

    /**
     * @param ArrayCollection $translations
     */
    public function setTranslations($translations)
    {
        $this->translations = $translations;
    }

    /**
     * @return string
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * @param string $type
     */
    public function setType($type)
    {
        $this->type = $type;
    }

    /**
     * @param CcmFooterContentText $contentText
     * @return $this
     */
    public function addContentText(\FDC\CourtMetrageBundle\Entity\CcmFooterContentText $contentText)
    {
        $contentText->setFooterContent($this);
        $this->contentText[] = $contentText;

        return $this;
    }

    /**
     * @param CcmFooterContentText $contentText
     */
    public function removeContentText(\FDC\CourtMetrageBundle\Entity\CcmFooterContentText $contentText)
    {
        $this->contentText->removeElement($contentText);
    }

    /**
     * @return ArrayCollection
     */
    public function getContentText()
    {
        return $this->contentText;
    }
}