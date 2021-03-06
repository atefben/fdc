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
 * CorpoTeam
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Base\CoreBundle\Repository\TranslationRepository")
 * @ORM\HasLifecycleCallbacks()
 */
class CorpoTeamMembers implements TranslateMainInterface
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
    protected $id;

    /**
     * @ORM\ManyToOne(targetEntity="MediaImageSimple")
     */
    protected $mainImage;

    /**
     * ArrayCollection
     */
    protected $translations;
    
    /**
     *
     * @ORM\OneToMany(targetEntity="CorpoTeamDepartementsAssociation", mappedBy="members", cascade={"persist"}, orphanRemoval=true)
     * 
     */
    protected $departements;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->procedure = new \Doctrine\Common\Collections\ArrayCollection();
    }

    public function __toString() {
        $string = substr(strrchr(get_class($this), '\\'), 1);

        if ($this->getId()) {
            $string = ' "' . $this->findTranslationByLocale('fr')->getFirstName() . ' ' . $this->findTranslationByLocale('fr')->getLastName() .'"';
        }

        return $string;
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
     * Set mainImage
     *
     * @param \Base\CoreBundle\Entity\MediaImageSimple $mainImage
     * @return CorpoTeam
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

    /**
     * Add members
     *
     * @param \Base\CoreBundle\Entity\CorpoTeamDepartementsAssociation $departements
     * @return CorpoTeamDepartements
     */
    public function addDepartement(\Base\CoreBundle\Entity\CorpoTeamDepartementsAssociation $departement)
    {
        $departement->setDepartement($this);
        $this->departements[] = $departement;

        return $this;
    }

    /**
     * Remove departement
     *
     * @param \Base\CoreBundle\Entity\CorpoTeamDepartementsAssociation $departements
     */
    public function removeDepartement(\Base\CoreBundle\Entity\CorpoTeamDepartementsAssociation $departement)
    {
        $this->departements->removeElement($departement);
    }

    /**
     * Get members
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getDepartements()
    {
        return $this->departements;
    }
}
