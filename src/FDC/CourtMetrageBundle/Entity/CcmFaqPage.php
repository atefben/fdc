<?php

namespace FDC\CourtMetrageBundle\Entity;

use Base\CoreBundle\Util\SeoMain;
use Base\CoreBundle\Util\Time;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * CcmFaqPage
 *
 * @ORM\Table(name="ccm_faq_page")
 * @ORM\Entity()
 * @ORM\HasLifecycleCallbacks()
 */
class CcmFaqPage
{
    use Time;
    use SeoMain;

    /**
     * @var integer
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @var ArrayCollection
     * @ORM\OneToMany(targetEntity="CcmRubriquesCollection", mappedBy="faqPage", cascade={"persist", "remove"}, orphanRemoval=true)
     * @ORM\OrderBy({"position" = "ASC"})
     */
    protected $rubriquesCollection;

    public function __construct()
    {
        $this->rubriquesCollection = new ArrayCollection();
    }

    public function __toString()
    {
        return $this->getTitle();
    }

    public function getTitle()
    {
        //$string = substr(strrchr(get_class($this), '\\'), 1);
        $string = "Informations utiles";

        return $string;
    }

    /**
     * Get id
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }


    /**
     * @param CcmRubriquesCollection $rubriquesCollection
     * @return $this
     */
    public function addRubriquesCollection(CcmRubriquesCollection $rubriquesCollection)
    {
        $rubriquesCollection->setFaqPage($this);
        $this->rubriquesCollection[] = $rubriquesCollection;

        return $this;
    }

    /**
     * @param CcmRubriquesCollection $rubriquesCollection
     */
    public function removeRubriquesCollection(CcmRubriquesCollection $rubriquesCollection)
    {
        $this->rubriquesCollection->removeElement($rubriquesCollection);
    }

    /**
     * @return ArrayCollection
     */
    public function getRubriquesCollection()
    {
        return $this->rubriquesCollection;
    }
}
