<?php

namespace Base\CoreBundle\Entity;

use A2lix\I18nDoctrineBundle\Doctrine\ORM\Util\Translatable;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

use Base\CoreBundle\Util\Time;
use Base\CoreBundle\Util\SeoMain;

/**
 * PressDownload
 *
 * @ORM\Table()
 * @ORM\Entity
 * @ORM\HasLifecycleCallbacks()
 */
class PressProjection
{
    use Time;
    use Translatable;
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
     * @ORM\OneToOne(targetEntity="Media", cascade={"persist"})
     */
    protected $scheduling;

    /**
     * @var string
     *
     * @ORM\OneToOne(targetEntity="Media", cascade={"persist"})
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
}
