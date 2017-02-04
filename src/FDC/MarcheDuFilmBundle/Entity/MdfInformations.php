<?php

namespace FDC\MarcheDuFilmBundle\Entity;

use A2lix\I18nDoctrineBundle\Doctrine\ORM\Util\Translatable;
use Base\CoreBundle\Interfaces\TranslateMainInterface;
use Base\CoreBundle\Util\SeoMain;
use Base\CoreBundle\Util\Time;
use Base\CoreBundle\Util\TranslateMain;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * MdfInformations
 * @ORM\Table(name="mdf_informations")
 * @ORM\Entity
 * @ORM\HasLifecycleCallbacks()
 */
class MdfInformations implements TranslateMainInterface
{
    use Time;
    use SeoMain;
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
     * @var ArrayCollection
     * @ORM\OneToMany(targetEntity="FDC\MarcheDuFilmBundle\Entity\MdfRubriquesCollection", mappedBy="informationPage", cascade={"persist", "remove"}, orphanRemoval=true)
     * @ORM\OrderBy({"position" = "ASC"})
     */
    protected $rubriquesCollection;

    public function __construct()
    {
        $this->translations = new ArrayCollection();
        $this->rubriquesCollection = new ArrayCollection();
    }

    public function __toString()
    {
        return $this->getTitle();
    }

    public function getTitle()
    {
        $string = substr(strrchr(get_class($this), '\\'), 1);

        return $string;
    }

    /**
     * Get id
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }


    /**
     * @param MdfRubriquesCollection $rubriquesCollection
     * @return $this
     */
    public function addRubriquesCollection(\FDC\MarcheDuFilmBundle\Entity\MdfRubriquesCollection $rubriquesCollection)
    {
        $rubriquesCollection->setInformationPage($this);
        $this->rubriquesCollection[] = $rubriquesCollection;

        return $this;
    }

    /**
     * @param MdfRubriquesCollection $rubriquesCollection
     */
    public function removeRubriquesCollection(\FDC\MarcheDuFilmBundle\Entity\MdfRubriquesCollection $rubriquesCollection)
    {
        $this->rubriquesCollection->removeElement($rubriquesCollection);
    }

    /**
     * @return ArrayCollection
     */
    public function getRubriquesCollection()
    {
        return $this->rubriquesCollection;
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
}
