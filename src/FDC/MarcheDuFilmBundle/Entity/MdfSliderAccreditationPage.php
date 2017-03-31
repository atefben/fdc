<?php

namespace FDC\MarcheDuFilmBundle\Entity;

use A2lix\I18nDoctrineBundle\Doctrine\ORM\Util\Translatable;
use Base\CoreBundle\Interfaces\TranslateMainInterface;
use Base\CoreBundle\Util\SeoMain;
use Base\CoreBundle\Util\Time;
use Base\CoreBundle\Util\TranslateMain;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Validator\Constraints as Assert;
use Doctrine\ORM\Mapping as ORM;

/**
 * MdfSliderAccreditationPage
 * @ORM\Table(name="mdf_slider_accreditation_page")
 * @ORM\Entity
 * @ORM\HasLifecycleCallbacks()
 */
class MdfSliderAccreditationPage implements TranslateMainInterface
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
     * @ORM\OneToMany(targetEntity="FDC\MarcheDuFilmBundle\Entity\MdfSliderAccreditation", mappedBy="sliderAccreditationPage", cascade={"persist", "remove"}, orphanRemoval=true)
     * @ORM\OrderBy({"position" = "ASC"})
     * @Assert\Count(
     *      max = "6",
     *      min = "1",
     *      minMessage = "validation.slider_accreditation_min",
     *      maxMessage = "validation.slider_accreditation_max"
     * )
     */
    protected $sliderAccreditation;

    public function __construct()
    {
        $this->translations = new ArrayCollection();
        $this->sliderAccreditation = new ArrayCollection();
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
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param MdfSliderAccreditation $sliderAccreditation
     * @return $this
     */
    public function addSliderAccreditation(\FDC\MarcheDuFilmBundle\Entity\MdfSliderAccreditation $sliderAccreditation)
    {
        $sliderAccreditation->setSliderAccreditationPage($this);
        $this->sliderAccreditation[] = $sliderAccreditation;

        return $this;
    }

    /**
     * @param MdfSliderAccreditation $sliderAccreditation
     */
    public function removeSliderAccreditation(\FDC\MarcheDuFilmBundle\Entity\MdfSliderAccreditation $sliderAccreditation)
    {
        $this->sliderAccreditation->removeElement($sliderAccreditation);
    }

    /**
     * @return ArrayCollection
     */
    public function getSliderAccreditation()
    {
        return $this->sliderAccreditation;
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