<?php

namespace Base\CoreBundle\Entity;

use A2lix\I18nDoctrineBundle\Doctrine\ORM\Util\Translatable;
use Base\CoreBundle\Interfaces\TranslateMainInterface;
use Base\CoreBundle\Util\SeoMain;
use Base\CoreBundle\Util\Time;
use Base\CoreBundle\Util\TranslateMain;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * FDCPageLaSelection
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Base\CoreBundle\Repository\FDCPageLaSelectionRepository")
 * * @ORM\HasLifecycleCallbacks
 */
class FDCPageLaSelection implements TranslateMainInterface
{
    use Time;
    use Translatable;
    use TranslateMain;
    use SeoMain;

    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var MediaImageSimple
     *
     * @ORM\ManyToOne(targetEntity="MediaImageSimple")
     *
     */
    private $image;

    /**
     * @var FilmSelectionSection
     *
     * @ORM\ManyToOne(targetEntity="FilmSelectionSection")
     */
    private $selectionSection;

    /**
     * @var ArrayCollection
     *
     * @Assert\Valid()
     */
    protected $translations;

    /**
     * FDCPageLaSelection constructor.
     */
    public function __construct()
    {
        $this->translations = new ArrayCollection();
    }

    /**
     * @return string
     */
    public function __toString()
    {
        if (!$this->getId()) {
            return 'Nouvelle page sélection';
        }

        $names = array(
            'La sélection COMPETITION',
            'La sélection UN CERTAIN REGARD',
            'La sélection HORS COMPÉTITION',
            'La sélection SÉANCES SPÉCIALES',
            'La sélection CINÉFONDATION',
            'La sélection COURTS MÉTRAGES',
        );
        return $names[$this->getId() - 1];
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
     * Set image
     *
     * @param \Base\CoreBundle\Entity\MediaImageSimple $image
     * @return FDCPageLaSelection
     */
    public function setImage(\Base\CoreBundle\Entity\MediaImageSimple $image = null)
    {
        $this->image = $image;

        return $this;
    }

    /**
     * Get image
     *
     * @return \Base\CoreBundle\Entity\MediaImageSimple
     */
    public function getImage()
    {
        return $this->image;
    }

    /**
     * Set selectionSection
     *
     * @param \Base\CoreBundle\Entity\FilmSelectionSection $selectionSection
     * @return FDCPageLaSelection
     */
    public function setSelectionSection(\Base\CoreBundle\Entity\FilmSelectionSection $selectionSection = null)
    {
        $this->selectionSection = $selectionSection;

        return $this;
    }

    /**
     * Get selectionSection
     *
     * @return \Base\CoreBundle\Entity\FilmSelectionSection
     */
    public function getSelectionSection()
    {
        return $this->selectionSection;
    }
}
