<?php

namespace FDC\MarcheDuFilmBundle\Entity;

use A2lix\I18nDoctrineBundle\Doctrine\ORM\Util\Translatable;
use Base\CoreBundle\Interfaces\TranslateMainInterface;
use Base\CoreBundle\Util\SeoMain;
use Base\CoreBundle\Util\Time;
use Base\CoreBundle\Util\TranslateMain;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Service
 * @ORM\Table(name="service")
 * @ORM\Entity(repositoryClass="FDC\MarcheDuFilmBundle\Repository\ServiceRepository")
 * @ORM\HasLifecycleCallbacks()
 */
class Service implements TranslateMainInterface
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
     * @var \DateTime
     * @ORM\Column(name="published_at", type="datetime", nullable=true)
     */
    private $publishedAt;

    /**
     * @var \DateTime
     * @ORM\Column(name="publish_ended_at", type="datetime", nullable=true)
     */
    private $publishEndedAt;

    /**
     * @var ArrayCollection
     */
    protected $translations;

    /**
     * @var ArrayCollection
     * @ORM\OneToMany(targetEntity="FDC\MarcheDuFilmBundle\Entity\ServiceWidget", mappedBy="service", cascade={"all"}, orphanRemoval=true)
     * @ORM\OrderBy({"position" = "ASC"})
     */
    protected $widgets;

    public function __construct()
    {
        $this->translations = new ArrayCollection();
        $this->widgets = new ArrayCollection();
    }

    public function __toString()
    {
        foreach ($this->translations as $translation) {
            if ($translation->getLocale() == 'fr' && $translation->getTitle()) {
                return (string)$translation->getTitle();
            }
        }
        return 'Service';
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
     * Set publishedAt
     *
     * @param \DateTime $publishedAt
     * @return Service
     */
    public function setPublishedAt($publishedAt)
    {
        $this->publishedAt = $publishedAt;

        return $this;
    }

    /**
     * Get publishedAt
     *
     * @return \DateTime 
     */
    public function getPublishedAt()
    {
        return $this->publishedAt;
    }

    /**
     * Set publishEndedAt
     *
     * @param \DateTime $publishEndedAt
     * @return Service
     */
    public function setPublishEndedAt($publishEndedAt)
    {
        $this->publishEndedAt = $publishEndedAt;

        return $this;
    }

    /**
     * Get publishEndedAt
     *
     * @return \DateTime 
     */
    public function getPublishEndedAt()
    {
        return $this->publishEndedAt;
    }

    /**
     * Add widgets
     *
     * @param \FDC\MarcheDuFilmBundle\Entity\ServiceWidget $widgets
     * @return Service
     */
    public function addWidget(\FDC\MarcheDuFilmBundle\Entity\ServiceWidget $widgets)
    {
        $widgets->setService($this);
        $this->widgets[] = $widgets;

        return $this;
    }

    /**
     * Remove widgets
     *
     * @param \FDC\MarcheDuFilmBundle\Entity\ServiceWidget $widgets
     */
    public function removeWidget(\FDC\MarcheDuFilmBundle\Entity\ServiceWidget $widgets)
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
