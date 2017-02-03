<?php

namespace FDC\MarcheDuFilmBundle\Entity;

use A2lix\I18nDoctrineBundle\Doctrine\ORM\Util\Translatable;
use Base\CoreBundle\Interfaces\TranslateMainInterface;
use Base\CoreBundle\Util\SeoMain;
use Base\CoreBundle\Util\Time;
use Base\CoreBundle\Util\TranslateMain;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Validator\Constraints as Assert;
use Doctrine\ORM\Mapping as ORM;

/**
 * MdfContactPage
 * @ORM\Table(name="mdf_contact_page")
 * @ORM\Entity
 * @ORM\HasLifecycleCallbacks()
 */
class MdfContactPage implements TranslateMainInterface
{
    use Time;
    use SeoMain;
    use Translatable;
    use TranslateMain;

    /**
     * @var integer
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @var ArrayCollection
     */
    protected $translations;

    /**
     * @var ArrayCollection
     * 
     * @ORM\OneToMany(targetEntity="FDC\MarcheDuFilmBundle\Entity\MdfContactBlock", mappedBy="contactPage", cascade={"persist", "remove"}, orphanRemoval=true)
     * @ORM\OrderBy({"position" = "ASC"})
     * @Assert\Count(
     *      max = "2",
     *      min = "1",
     *      maxMessage = "validation.contact_block_max",
     *      minMessage = "validation.contact_block_min"
     * )
     * @Assert\NotBlank()
     */
    protected $contactBlock;

    /**
     * @var ArrayCollection
     * @ORM\OneToMany(targetEntity="FDC\MarcheDuFilmBundle\Entity\MdfContactSubjectsCollection", mappedBy="contactPage", cascade={"persist", "remove"}, orphanRemoval=true)
     * @Assert\NotBlank()
     */
    protected $subjectsList;

    public function __construct()
    {
        $this->translations = new ArrayCollection();
        $this->subjectsList = new ArrayCollection();
        $this->contactBlock = new ArrayCollection();
    }

    public function __toString()
    {
        $translation = $this->findTranslationByLocale('fr');

        if ($translation !== null) {
            $string = $translation->getTitle();
        } else {
            $string = strval($this->getId());
        }
        return (string) $string;
    }

    public function getTitle()
    {
        $translation = $this->findTranslationByLocale('fr');
        $string = '';

        if ($translation !== null) {
            $string = $translation->getTitle();
        }

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
     * @param MdfContactSubjectsCollection $contactSubjectsCollection
     * @return $this
     */
    public function addSubjectsList(\FDC\MarcheDuFilmBundle\Entity\MdfContactSubjectsCollection $contactSubjectsCollection)
    {
        $contactSubjectsCollection->setContactPage($this);
        $this->subjectsList[] = $contactSubjectsCollection;

        return $this;
    }

    /**
     * @param MdfContactSubjectsCollection $contactSubjectsCollection
     */
    public function removeSubjectsList(\FDC\MarcheDuFilmBundle\Entity\MdfContactSubjectsCollection $contactSubjectsCollection)
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

    /**
     * @param MdfContactBlock $contactBlock
     * @return $this
     */
    public function addContactBlock(\FDC\MarcheDuFilmBundle\Entity\MdfContactBlock $contactBlock)
    {
        $contactBlock->setContactPage($this);
        $this->contactBlock[] = $contactBlock;

        return $this;
    }

    /**
     * @param MdfContactBlock $contactBlock
     */
    public function removeContactBlock(\FDC\MarcheDuFilmBundle\Entity\MdfContactBlock $contactBlock)
    {
        $this->contactBlock->removeElement($contactBlock);
    }

    /**
     * @return ArrayCollection
     */
    public function getContactBlock()
    {
        return $this->contactBlock;
    }
}
