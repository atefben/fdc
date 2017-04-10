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
class CorpoTeamTeams implements TranslateMainInterface
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
     * ArrayCollection
     */
    protected $translations;

    /**
     *
     * @ORM\OneToMany(targetEntity="CorpoTeamTeamsAssociation", mappedBy="teamTeams", cascade={"persist"}, orphanRemoval=true)
     * @ORM\OrderBy({"position" = "ASC"})
     */
    protected $departement;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->procedure = new \Doctrine\Common\Collections\ArrayCollection();
    }

    public function __toString() {
        $string = 'Les équipes';

        if ($this->getId()) {
            $string = ' "'. $this->findTranslationByLocale('fr')->getTeamName()  .'"';
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
     * Add departement
     *
     * @param \Base\CoreBundle\Entity\CorpoTeamTeamsAssociation $departement
     * @return CorpoTeamTeams
     */
    public function addDepartement(\Base\CoreBundle\Entity\CorpoTeamTeamsAssociation $departement)
    {
        $departement->setTeamTeams($this);
        $this->departement[] = $departement;

        return $this;
    }

    /**
     * Remove departement
     *
     * @param \Base\CoreBundle\Entity\CorpoTeamTeamsAssociation $departement
     */
    public function removeDepartement(\Base\CoreBundle\Entity\CorpoTeamTeamsAssociation $departement)
    {
        $this->departement->removeElement($departement);
    }

    /**
     * Get departement
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getDepartement()
    {
        return $this->departement;
    }
}
