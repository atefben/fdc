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
 * FDCPageAward
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Base\CoreBundle\Repository\FDCPageAwardRepository")
 * @ORM\HasLifecycleCallbacks
 */
class FDCPageAward implements TranslateMainInterface
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
     * @ORM\ManyToOne(targetEntity="FilmSelectionSection")
     * @ORM\JoinColumn(nullable=true)
     */
    private $selectionLongsMetrages;

    /**
     * @var FilmSelectionSection
     * @ORM\ManyToOne(targetEntity="FilmSelectionSection")
     * @ORM\JoinColumn(nullable=true)
     */
    private $selectionCourtsMetrages;

    /**
     * @var ArrayCollection
     * @ORM\OneToMany(targetEntity="FDCPageAwardOtherSelectionSectionsAssociated", mappedBy="FDCPageAward", cascade={"persist"})
     * @ORM\JoinColumn(nullable=true)
     */
    private $otherSelectionSectionsAssociated;


    protected $translations;

    public function __construct()
    {
        $this->translations = new ArrayCollection();
        $this->otherSelectionSectionsAssociated = new ArrayCollection();
    }

    /**
     * @return string
     */
    public function __toString()
    {
        if (!$this->getId()) {
            return 'Nouvelle page Le Palmarès';
        }

        $names = array(
            'La palmarès COMPETITION',
            'Le palmarès UN CERTAIN REGARD',
            'Le palmarès CINÉFONDATION',
            'La sélection CAMÉRA D\'OR',
            'La sélection TOUT LE PALMARÈS',
        );
        return $names[$this->getId() - 1];
    }

    public function getCategory()
    {
        $names = array(
            'Compétition',
            'Un Certain Regard',
            'Cinéfondation',
            'Caméra d\'or',
        );

        if (array_key_exists($this->getId() - 1, $names)) {
            return $names[$this->getId() - 1];
        }
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
     * @param MediaImageSimple $image
     * @return FDCPageAward
     */
    public function setImage(MediaImageSimple $image = null)
    {
        $this->image = $image;

        return $this;
    }

    /**
     * Get image
     *
     * @return MediaImageSimple 
     */
    public function getImage()
    {
        return $this->image;
    }


    /**
     * Set selectionLongsMetrages
     *
     * @param FilmSelectionSection $selectionLongsMetrages
     * @return FDCPageAward
     */
    public function setSelectionLongsMetrages(FilmSelectionSection $selectionLongsMetrages = null)
    {
        $this->selectionLongsMetrages = $selectionLongsMetrages;

        return $this;
    }

    /**
     * Get selectionLongsMetrages
     *
     * @return FilmSelectionSection 
     */
    public function getSelectionLongsMetrages()
    {
        return $this->selectionLongsMetrages;
    }

    /**
     * Set selectionCourtsMetrages
     *
     * @param FilmSelectionSection $selectionCourtsMetrages
     * @return FDCPageAward
     */
    public function setSelectionCourtsMetrages(FilmSelectionSection $selectionCourtsMetrages = null)
    {
        $this->selectionCourtsMetrages = $selectionCourtsMetrages;

        return $this;
    }

    /**
     * Get selectionCourtsMetrages
     *
     * @return FilmSelectionSection 
     */
    public function getSelectionCourtsMetrages()
    {
        return $this->selectionCourtsMetrages;
    }

    /**
     * Add otherSelectionSectionsAssociated
     *
     * @param FDCPageAwardOtherSelectionSectionsAssociated $otherSelectionSectionsAssociated
     * @return FDCPageAward
     */
    public function addOtherSelectionSectionsAssociated(FDCPageAwardOtherSelectionSectionsAssociated $otherSelectionSectionsAssociated)
    {
        $otherSelectionSectionsAssociated->setFDCPageAward($this);
        $this->otherSelectionSectionsAssociated[] = $otherSelectionSectionsAssociated;

        return $this;
    }

    /**
     * Remove otherSelectionSectionsAssociated
     *
     * @param FDCPageAwardOtherSelectionSectionsAssociated $otherSelectionSectionsAssociated
     */
    public function removeOtherSelectionSectionsAssociated(FDCPageAwardOtherSelectionSectionsAssociated $otherSelectionSectionsAssociated)
    {
        $this->otherSelectionSectionsAssociated->removeElement($otherSelectionSectionsAssociated);
    }

    /**
     * Get otherSelectionSectionsAssociated
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getOtherSelectionSectionsAssociated()
    {
        if ($this->otherSelectionSectionsAssociated->count() < 2) {
            while ($this->otherSelectionSectionsAssociated->count() != 2) {
                $entity = new FDCPageAwardOtherSelectionSectionsAssociated();
                $entity->setFDCPageAward($this);
                $this->otherSelectionSectionsAssociated->add($entity);
            }
        }
        return $this->otherSelectionSectionsAssociated;
    }
}
