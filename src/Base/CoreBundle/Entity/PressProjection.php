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
 * PressDownload
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Base\CoreBundle\Repository\TranslationRepository")
 * @ORM\HasLifecycleCallbacks()
 */
class PressProjection implements TranslateMainInterface
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
    private $id;

    /**
     * @var string
     *
     * @ORM\ManyToOne(targetEntity="Application\Sonata\MediaBundle\Entity\Media")
     */
    protected $scheduling;

    /**
     * @var string
     *
     * @ORM\ManyToOne(targetEntity="Application\Sonata\MediaBundle\Entity\Media")
     */
    protected $pressScheduling;

    /**
     * ArrayCollection
     */
    protected $translations;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->translations = new ArrayCollection();
    }

    public function __toString()
    {
        $string = substr(strrchr(get_class($this), '\\'), 1);

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
     * Set scheduling
     *
     * @param \Application\Sonata\MediaBundle\Entity\Media $scheduling
     * @return PressProjection
     */
    public function setScheduling(\Application\Sonata\MediaBundle\Entity\Media $scheduling = null)
    {
        $this->scheduling = $scheduling;

        return $this;
    }

    /**
     * Get scheduling
     *
     * @return \Application\Sonata\MediaBundle\Entity\Media 
     */
    public function getScheduling()
    {
        return $this->scheduling;
    }

    /**
     * Set pressScheduling
     *
     * @param \Application\Sonata\MediaBundle\Entity\Media $pressScheduling
     * @return PressProjection
     */
    public function setPressScheduling(\Application\Sonata\MediaBundle\Entity\Media $pressScheduling = null)
    {
        $this->pressScheduling = $pressScheduling;

        return $this;
    }

    /**
     * Get pressScheduling
     *
     * @return \Application\Sonata\MediaBundle\Entity\Media 
     */
    public function getPressScheduling()
    {
        return $this->pressScheduling;
    }
}
