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
class CorpoTeam implements TranslateMainInterface
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
     * @ORM\OneToMany(targetEntity="CorpoTeamsAssociation", mappedBy="team", cascade={"persist"}, orphanRemoval=true)
     * @ORM\OrderBy({"position" = "ASC"})
     */
    protected $teams;

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
        return 'L\'équipe';
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
     * Add teams
     *
     * @param \Base\CoreBundle\Entity\CorpoTeamsAssociation $teams
     * @return CorpoTeam
     */
    public function addTeam(\Base\CoreBundle\Entity\CorpoTeamsAssociation $teams)
    {
        $teams->setTeam($this);
        $this->teams[] = $teams;

        return $this;
    }

    /**
     * Remove teams
     *
     * @param \Base\CoreBundle\Entity\CorpoTeamsAssociation $teams
     */
    public function removeTeam(\Base\CoreBundle\Entity\CorpoTeamsAssociation $teams)
    {
        $this->teams->removeElement($teams);
    }

    /**
     * Get teams
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getTeams()
    {
        return $this->teams;
    }
}
