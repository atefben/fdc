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
 * FDCPageLaSelectionCannesClassics
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Base\CoreBundle\Repository\FDCPageLaSelectionCannesClassicsRepository")
 * @ORM\HasLifecycleCallbacks
 */
class FDCPageLaSelectionCannesClassics implements TranslateMainInterface
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
    private $id;

    /**
     * @var MediaImageSimple
     *
     * @ORM\ManyToOne(targetEntity="MediaImageSimple")
     *
     */
    private $image;

    /**
     * @var NewsWidget
     *
     * @ORM\OneToMany(targetEntity="FDCPageLaSelectionCannesClassicsWidget", mappedBy="FDCPageLaSelectionCannesClassics", cascade={"all"}, orphanRemoval=true)
     *
     * @ORM\OrderBy({"position" = "ASC"})
     */
    private $widgets;

    /**
     * @var \Application\Sonata\UserBundle\Entity\User
     *
     * @ORM\ManyToOne(targetEntity="Application\Sonata\UserBundle\Entity\User")
     *
     */
    private $createdBy;

    /**
     * @var \Application\Sonata\UserBundle\Entity\User
     *
     * @ORM\ManyToOne(targetEntity="Application\Sonata\UserBundle\Entity\User")
     *
     */
    private $updatedBy;

    /**
     * @var ArrayCollection
     *
     * @Assert\Valid()
     * @Groups({"classics"})
     */
    protected $translations;

    /**
     * FDCPageLaSelection constructor.
     */
    public function __construct()
    {
        $this->translations = new ArrayCollection();
        $this->widgets = new ArrayCollection();
    }

    /**
     * @return string
     */
    public function __toString()
    {
        $string = 'Cannes Classics';

        if ($this->getId()) {
            $trans = $this->findTranslationByLocale('fr');
            if ($trans !== null && $trans->getTitle() !== null) {
                $string = $trans->getTitle();
            }
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
     * Set image
     *
     * @param \Base\CoreBundle\Entity\MediaImageSimple $image
     * @return FDCPageLaSelection
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
     * Add widgets
     *
     * @param \Base\CoreBundle\Entity\FDCPageLaSelectionCannesClassicsWidget $widgets
     * @return FDCPageLaSelectionCannesClassics
     */
    public function addWidget(\Base\CoreBundle\Entity\FDCPageLaSelectionCannesClassicsWidget $widgets)
    {
        $widgets->setFDCPageLaSelectionCannesClassics($this);
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

    /**
     * @VirtualProperty()
     * @Groups({"classics"})
     * @return array
     */
    public function getMovieWidgets()
    {
        $widgets = array();
        foreach ($this->widgets as $widget) {
            if ($widget instanceof FDCPageLaSelectionCannesClassicsWidgetMovie) {
                $widgets[] = $widget;
            }
        }
        return $widgets;
    }

    /**
     * Set createdBy
     *
     * @param \Application\Sonata\UserBundle\Entity\User $createdBy
     * @return FDCPageLaSelectionCannesClassics
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
     * @return FDCPageLaSelectionCannesClassics
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
}
