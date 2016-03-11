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
 * FDCPageJury
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Base\CoreBundle\Repository\FDCPageJuryRepository")
 * @ORM\HasLifecycleCallbacks
 */
class FDCPageJury implements TranslateMainInterface
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
     * @var FilmJuryType
     *
     * @ORM\ManyToOne(targetEntity="FilmJuryType")
     */
    private $juryType;

    /**
     * @var ArrayCollection
     *
     * @Assert\Valid()
     */
    protected $translations;


    public function __construct()
    {
        $this->translations = new ArrayCollection();
    }

    public function __toString()
    {
        if (!$this->getId()) {
            return 'Nouvelle page jurys';
        }

        $names = array(
            'Les jurys LONGS METRAGES',
            'Les jurys CINEFONDATION & COURTS METRAGES',
            'Les jurys UN CERTAIN REGARD',
            'Les jurys CAMERA D\'OR',
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
     * @return FDCPageJury
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
     * Set juryType
     *
     * @param \Base\CoreBundle\Entity\FilmJuryType $juryType
     * @return FDCPageJury
     */
    public function setJuryType(\Base\CoreBundle\Entity\FilmJuryType $juryType = null)
    {
        $this->juryType = $juryType;

        return $this;
    }

    /**
     * Get juryType
     *
     * @return \Base\CoreBundle\Entity\FilmJuryType 
     */
    public function getJuryType()
    {
        return $this->juryType;
    }
}
