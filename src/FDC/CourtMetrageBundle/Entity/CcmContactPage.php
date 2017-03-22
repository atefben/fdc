<?php

namespace FDC\CourtMetrageBundle\Entity;

use Base\CoreBundle\Util\SeoMain;
use Base\CoreBundle\Util\Time;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Validator\Constraints as Assert;
use Doctrine\ORM\Mapping as ORM;

/**
 * CcmContactPage
 * @ORM\Table(name="ccm_contact_page")
 * @ORM\Entity
 * @ORM\HasLifecycleCallbacks()
 */
class CcmContactPage
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
     * @ORM\OneToMany(targetEntity="CcmContactSubjectsCollection", mappedBy="contactPage", cascade={"persist", "remove"}, orphanRemoval=true)
     * @ORM\OrderBy({"position" = "ASC"})
     * @Assert\NotBlank()
     */
    protected $subjectsList;

    public function __construct()
    {
        $this->subjectsList = new ArrayCollection();
    }

    public function __toString()
    {
        return $this->getTitle();
    }

    public function getTitle()
    {
        $string = "Contact Page";

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
     * @param CcmContactSubjectsCollection $contactSubjectsCollection
     * @return $this
     */
    public function addSubjectsList(CcmContactSubjectsCollection $contactSubjectsCollection)
    {
        $contactSubjectsCollection->setContactPage($this);
        $this->subjectsList[] = $contactSubjectsCollection;

        return $this;
    }

    /**
     * @param CcmContactSubjectsCollection $contactSubjectsCollection
     */
    public function removeSubjectsList(CcmContactSubjectsCollection $contactSubjectsCollection)
    {
        $this->subjectsList->removeElement($contactSubjectsCollection);
    }

    /**
     * @return ArrayCollection
     */
    public function getSubjectsList()
    {
        return $this->subjectsList;
    }
}
