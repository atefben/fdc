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
class CorpoTeamDepartements implements TranslateMainInterface
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
     * @ORM\OneToMany(targetEntity="CorpoTeamDepartementsAssociation", mappedBy="departement", cascade={"persist"}, orphanRemoval=true)
     * @ORM\OrderBy({"position" = "ASC"})
     */
    protected $members;

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
            $string = ' "' . $this->findTranslationByLocale('fr')->getDepartementName()  .'"';
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
     * Add members
     *
     * @param \Base\CoreBundle\Entity\CorpoTeamDepartementsAssociation $members
     * @return CorpoTeamDepartements
     */
    public function addMember(\Base\CoreBundle\Entity\CorpoTeamDepartementsAssociation $members)
    {
        $members->setDepartement($this);
        $this->members[] = $members;

        return $this;
    }

    /**
     * Remove members
     *
     * @param \Base\CoreBundle\Entity\CorpoTeamDepartementsAssociation $members
     */
    public function removeMember(\Base\CoreBundle\Entity\CorpoTeamDepartementsAssociation $members)
    {
        $this->members->removeElement($members);
    }

    /**
     * Get members
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getMembers()
    {
        return $this->members;
    }
}
