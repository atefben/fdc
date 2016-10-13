<?php

namespace Base\CoreBundle\Entity;

use A2lix\I18nDoctrineBundle\Doctrine\ORM\Util\Translatable;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Base\CoreBundle\Interfaces\TranslateMainInterface;
use Base\CoreBundle\Util\TranslateMain;
use Base\CoreBundle\Util\Time;
use Base\CoreBundle\Util\SeoMain;

/**
 * CorpoMovieInscription
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Base\CoreBundle\Repository\TranslationRepository")
 * @ORM\HasLifecycleCallbacks()
 */
class CorpoMovieInscription implements TranslateMainInterface
{
    use Time;
    use Translatable;
    use TranslateMain;
    use SeoMain;

    /**
     * @var integer
     *
     * @ORM\Column(type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="MediaImageSimple")
     */
    private $mainImage;

    /**
     * @var CorpoMovieInscriptionHasProcedure
     *
     * @ORM\OneToMany(targetEntity="CorpoMovieInscriptionHasProcedure", mappedBy="accredit", cascade={"persist"}, orphanRemoval=true)
     */
    protected $procedure;

    /**
     * ArrayCollection
     */
    protected $translations;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->procedure = new \Doctrine\Common\Collections\ArrayCollection();
    }

    public function __toString() {
        return 'Inscrire un film';
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
     * Add procedure
     *
     * @param \Base\CoreBundle\Entity\CorpoMovieInscriptionHasProcedure $procedure
     * @return CorpoMovieInscription
     */
    public function addProcedure(\Base\CoreBundle\Entity\CorpoMovieInscriptionHasProcedure $procedure)
    {
        $procedure->setAccredit($this);
        $this->procedure->add($procedure);

    }

    /**
     * Remove procedure
     *
     * @param \Base\CoreBundle\Entity\CorpoMovieInscriptionHasProcedure $procedure
     */
    public function removeProcedure(\Base\CoreBundle\Entity\CorpoMovieInscriptionHasProcedure $procedure)
    {
        $this->procedure->removeElement($procedure);
    }

    /**
     * Get procedure
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getProcedure()
    {
        return $this->procedure;
    }

    /**
     * Set mainImage
     *
     * @param \Base\CoreBundle\Entity\MediaImageSimple $mainImage
     * @return CorpoMovieInscription
     */
    public function setMainImage(\Base\CoreBundle\Entity\MediaImageSimple $mainImage = null)
    {
        $this->mainImage = $mainImage;

        return $this;
    }

    /**
     * Get mainImage
     *
     * @return \Base\CoreBundle\Entity\MediaImageSimple 
     */
    public function getMainImage()
    {
        return $this->mainImage;
    }
}
