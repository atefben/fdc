<?php

namespace Base\CoreBundle\Entity;

use A2lix\I18nDoctrineBundle\Doctrine\ORM\Util\Translatable;
use Base\CoreBundle\Interfaces\TranslateMainInterface;
use Base\CoreBundle\Util\SeoMain;
use Base\CoreBundle\Util\Time;
use Base\CoreBundle\Util\TranslateMain;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation\Groups;
use JMS\Serializer\Annotation\VirtualProperty;
use Symfony\Component\Validator\Constraints as Assert;
use Gedmo\Mapping\Annotation as Gedmo;
/**
 * CorpoWhoAreWe
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Base\CoreBundle\Repository\CorpoWhoAreWeRepository")
 * @ORM\HasLifecycleCallbacks
 */
class CorpoWhoAreWe implements TranslateMainInterface
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
     * @Groups({"classics"})
     */
    protected $id;

    /**
     * @var MediaImageSimple
     *
     * @ORM\ManyToOne(targetEntity="MediaImageSimple")
     *
     */
    protected $image;

    /**
     * @var integer
     *
     * @ORM\Column(type="integer", nullable=false)
     *
     */
    protected $weight;

    /**
     * @var \Application\Sonata\UserBundle\Entity\User
     *
     * @ORM\ManyToOne(targetEntity="Application\Sonata\UserBundle\Entity\User")
     *
     */
    protected $createdBy;

    /**
     * @var \Application\Sonata\UserBundle\Entity\User
     *
     * @ORM\ManyToOne(targetEntity="Application\Sonata\UserBundle\Entity\User")
     *
     */
    protected $updatedBy;

    /**
     * @var NewsWidget
     *
     * @ORM\OneToMany(targetEntity="FDCPageLaSelectionCannesClassicsWidget", mappedBy="corpoWhoAreWe", cascade={"all"}, orphanRemoval=true)
     *
     * @ORM\OrderBy({"position" = "ASC"})
     */
    protected $widgets;

    /**
     * @var ArrayCollection
     *
     * @Assert\Valid()
     * @Groups({"classics"})
     */
    protected $translations;

    public function __toString() {
        return 'Qui sommes nous';
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
     * Set weight
     *
     * @param integer $weight
     * @return CorpoWhoAreWe
     */
    public function setWeight($weight)
    {
        $this->weight = $weight;

        return $this;
    }

    /**
     * Get weight
     *
     * @return integer 
     */
    public function getWeight()
    {
        return $this->weight;
    }

    /**
     * Set image
     *
     * @param \Base\CoreBundle\Entity\MediaImageSimple $image
     * @return CorpoWhoAreWe
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
     * Set createdBy
     *
     * @param \Application\Sonata\UserBundle\Entity\User $createdBy
     * @return CorpoWhoAreWe
     */
    public function setCreatedBy(\Application\Sonata\UserBundle\Entity\User $createdBy = null)
    {
        $this->createdBy = $createdBy;

        return $this;
    }

    /**
     * Get createdBy
     *
     * @return \Application\Sonata\UserBundle\Entity\User 
     */
    public function getCreatedBy()
    {
        return $this->createdBy;
    }

    /**
     * Set updatedBy
     *
     * @param \Application\Sonata\UserBundle\Entity\User $updatedBy
     * @return CorpoWhoAreWe
     */
    public function setUpdatedBy(\Application\Sonata\UserBundle\Entity\User $updatedBy = null)
    {
        $this->updatedBy = $updatedBy;

        return $this;
    }

    /**
     * Get updatedBy
     *
     * @return \Application\Sonata\UserBundle\Entity\User 
     */
    public function getUpdatedBy()
    {
        return $this->updatedBy;
    }
    
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->widgets = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add widgets
     *
     * @param \Base\CoreBundle\Entity\FDCPageLaSelectionCannesClassicsWidget $widgets
     * @return CorpoWhoAreWe
     */
    public function addWidget(\Base\CoreBundle\Entity\FDCPageLaSelectionCannesClassicsWidget $widgets)
    {
        $widgets->setCorpoWhoAreWe($this);
        $this->widgets[] = $widgets;

        return $this;
    }

    /**
     * Remove widgets
     *
     * @param \Base\CoreBundle\Entity\FDCPageLaSelectionCannesClassicsWidget $widgets
     */
    public function removeWidget(\Base\CoreBundle\Entity\FDCPageLaSelectionCannesClassicsWidget $widgets)
    {
        $this->widgets->removeElement($widgets);
    }

    /**
     * Get widgets
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getWidgets()
    {
        return $this->widgets;
    }
}
