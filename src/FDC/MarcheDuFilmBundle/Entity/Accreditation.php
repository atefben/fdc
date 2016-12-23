<?php

namespace FDC\MarcheDuFilmBundle\Entity;

use Application\Sonata\MediaBundle\Entity\Media;
use A2lix\I18nDoctrineBundle\Doctrine\ORM\Util\Translatable;
use Base\CoreBundle\Interfaces\TranslateMainInterface;
use Doctrine\Common\Collections\ArrayCollection;
use Base\CoreBundle\Util\SeoMain;
use Base\CoreBundle\Util\Time;
use Base\CoreBundle\Util\TranslateMain;
use Doctrine\ORM\Mapping as ORM;

/**
 * Accreditation
 * @ORM\Table(name="mdf_accreditation")
 * @ORM\Entity
 */
class Accreditation
{
    use Translatable;

    /**
     * @var integer
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\OneToMany(targetEntity="AccreditationWidget", mappedBy="accreditation", cascade={"persist", "remove", "refresh"}, orphanRemoval=true)
     * @ORM\OrderBy({"position" = "ASC"})
     */
    protected $accreditationWidgets;

    /**
     * @var ArrayCollection
     */
    protected $translations;

    /**
     * HeaderFooter constructor.
     */
    public function __construct()
    {
        $this->accreditationWidgets = new ArrayCollection();
        $this->translations = new ArrayCollection();
    }

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return mixed
     */
    public function getAccreditationWidgets()
    {
        return $this->accreditationWidgets;
    }

    /**
     * @param AccreditationWidget $accreditationWidget
     *
     * @return $this
     */
    public function addAccreditationWidget(AccreditationWidget $accreditationWidget)
    {
        if (!$this->accreditationWidgets->contains($accreditationWidget)) {
            $this->accreditationWidgets->add($accreditationWidget);
            $accreditationWidget->setAccreditation($this);
        }

        return $this;
    }

    /**
     * @param AccreditationWidget $accreditationWidget
     *
     * @return $this
     */
    public function removeAccreditationWidget(AccreditationWidget $accreditationWidget)
    {
        if ($this->accreditationWidgets->contains($accreditationWidget)) {
            $this->accreditationWidgets->removeElement($accreditationWidget);
        }

        return $this;
    }
}
