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

use JMS\Serializer\Annotation\Groups;
use JMS\Serializer\Annotation\Since;

/**
 * FDCPageWebTvTrailers
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Base\CoreBundle\Repository\FDCPageWebTvTrailersRepository")
 * @ORM\HasLifecycleCallbacks
 */
class FDCPageWebTvTrailers implements TranslateMainInterface
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
     * @return FDCPageWebTvTrailers
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
     * @return string
     */
    public function __toString()
    {
        if (!$this->getId()) {
            return 'Nouvelle Page Web TV - Ba et extraits';
        }

        $names = array(
            'WebTV - BA et extraits (Compétition)',
            'WebTV - BA et extraits (Un certain regard)',
            'WebTV - BA et extraits (Hors compétition)',
            'WebTV - BA et extraits (Séances spéciales)',
            'WebTV - BA et extraits (Cinéfondation)',
            'WebTV - BA et extraits (Courts métrages)',
            'WebTV - BA et extraits (Cannes Classics)',
            'WebTV - BA et extraits (Cinéma de plage)',
        );
        return $names[$this->getId()];
    }


    /**
     * Set selectionSection
     *
     * @param \Base\CoreBundle\Entity\FilmSelectionSection $selectionSection
     * @return FDCPageWebTvTrailers
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
