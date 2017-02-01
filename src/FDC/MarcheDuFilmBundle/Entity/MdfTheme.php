<?php

namespace FDC\MarcheDuFilmBundle\Entity;

use A2lix\I18nDoctrineBundle\Doctrine\ORM\Util\Translatable;
use Base\CoreBundle\Interfaces\TranslateMainInterface;
use Base\CoreBundle\Util\TranslateMain;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Theme
 * @ORM\Table(name="mdf_theme")
 * @ORM\Entity
 */
class MdfTheme implements TranslateMainInterface
{
    use Translatable;
    use TranslateMain;

    /**
     * @var integer
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @var ArrayCollection
     */
    protected $translations;

    /**
     * @ORM\OneToMany(targetEntity="MdfContentTemplateWidget", mappedBy="theme")
     */
    protected $contentTemplate;

    /**
     * HeaderFooter constructor.
     */
    public function __construct()
    {
        $this->translations = new ArrayCollection();
        $this->contentTemplate = new ArrayCollection();
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
     * @param MdfContentTemplate $contentTemplate
     * @return $this
     */
    public function addContentTemplate(\FDC\MarcheDuFilmBundle\Entity\MdfContentTemplate $contentTemplate)
    {
        $contentTemplate->setTheme($this);
        $this->contentTemplate[] = $contentTemplate;

        return $this;
    }

    /**
     * @param MdfContentTemplate $contentTemplate
     */
    public function removeContentTemplate(\FDC\MarcheDuFilmBundle\Entity\MdfContentTemplate $contentTemplate)
    {
        $this->contentTemplate->removeElement($contentTemplate);
    }

    /**
     * @return mixed
     */
    public function getContentTemplate()
    {
        return $this->contentTemplate;
    }
}
