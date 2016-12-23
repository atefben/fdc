<?php

namespace Base\CoreBundle\Entity;

use A2lix\I18nDoctrineBundle\Doctrine\ORM\Util\Translatable;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Base\CoreBundle\Interfaces\TranslateMainInterface;
use Base\CoreBundle\Util\TranslateMain;
use Base\CoreBundle\Util\Time;
use Base\CoreBundle\Util\SeoMain;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * CorpoSearch
 *
 * @ORM\Table()
 * @ORM\Entity
 * @ORM\HasLifecycleCallbacks()
 */
class CorpoSearch implements TranslateMainInterface
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
     */
    protected $id;

    /**
     * @var MediaImageSimple
     *
     * @ORM\ManyToOne(targetEntity="MediaImageSimple")
     */
    protected $pushImage1;

    /**
     * @var MediaImageSimple
     *
     * @ORM\ManyToOne(targetEntity="MediaImageSimple")
     */
    protected $pushImage2;

    /**
     * @var MediaImageSimple
     *
     * @ORM\ManyToOne(targetEntity="MediaImageSimple")
     */
    protected $pushImage3;

    /**
     * @var ArrayCollection
     *
     * @Assert\Valid()
     */
    protected $translations;


    /**
     * FDCPageMediatheque constructor.
     */
    public function __construct()
    {
        $this->translations = new ArrayCollection();
        $this->medias = new \Doctrine\Common\Collections\ArrayCollection();
    }

    public function __toString() {
        return 'Search Pushs';
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
     * Set pushImage1
     *
     * @param \Base\CoreBundle\Entity\MediaImageSimple $pushImage1
     * @return CorpoSearch
     */
    public function setPushImage1(\Base\CoreBundle\Entity\MediaImageSimple $pushImage1 = null)
    {
        $this->pushImage1 = $pushImage1;

        return $this;
    }

    /**
     * Get pushImage1
     *
     * @return \Base\CoreBundle\Entity\MediaImageSimple 
     */
    public function getPushImage1()
    {
        return $this->pushImage1;
    }

    /**
     * Set pushImage2
     *
     * @param \Base\CoreBundle\Entity\MediaImageSimple $pushImage2
     * @return CorpoSearch
     */
    public function setPushImage2(\Base\CoreBundle\Entity\MediaImageSimple $pushImage2 = null)
    {
        $this->pushImage2 = $pushImage2;

        return $this;
    }

    /**
     * Get pushImage2
     *
     * @return \Base\CoreBundle\Entity\MediaImageSimple 
     */
    public function getPushImage2()
    {
        return $this->pushImage2;
    }

    /**
     * Set pushImage3
     *
     * @param \Base\CoreBundle\Entity\MediaImageSimple $pushImage3
     * @return CorpoSearch
     */
    public function setPushImage3(\Base\CoreBundle\Entity\MediaImageSimple $pushImage3 = null)
    {
        $this->pushImage3 = $pushImage3;

        return $this;
    }

    /**
     * Get pushImage3
     *
     * @return \Base\CoreBundle\Entity\MediaImageSimple 
     */
    public function getPushImage3()
    {
        return $this->pushImage3;
    }
}
