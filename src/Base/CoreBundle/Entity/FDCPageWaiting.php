<?php

namespace Base\CoreBundle\Entity;

use A2lix\I18nDoctrineBundle\Doctrine\ORM\Util\Translatable;
use Base\CoreBundle\Interfaces\TranslateMainInterface;
use Base\CoreBundle\Util\SeoMain;
use Base\CoreBundle\Util\Time;
use Base\CoreBundle\Util\TranslateMain;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use FDC\EventBundle\FDCEventBundle;
use Symfony\Component\Validator\Constraints as Assert;

use JMS\Serializer\Annotation\Groups;
use JMS\Serializer\Annotation\Since;

/**
 * FDCPageWaiting
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Base\CoreBundle\Repository\FDCPageWaitingRepository")
 * @ORM\HasLifecycleCallbacks
 */
class FDCPageWaiting implements TranslateMainInterface
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
    private $id;

    /**
     * @var boolean
     *
     * @ORM\Column(name="enabled", type="boolean")
     */
    private $enabled;

    /**
     * @ORM\ManyToOne(targetEntity="MediaImageSimple")
     */
    private $banner;

    /**
     * @var ArrayCollection
     *
     * @Assert\Valid()
     */
    protected $translations;

    /**
     * @var FDCEventRoutes
     * @ORM\ManyToOne(targetEntity="FDCEventRoutes")
     *
     */
    protected $page;

    public function __toString()
    {
        $string = strval($this->getId());

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
     * Set enabled
     *
     * @param boolean $enabled
     * @return FDCPageWaiting
     */
    public function setEnabled($enabled)
    {
        $this->enabled = $enabled;

        return $this;
    }

    /**
     * Get enabled
     *
     * @return boolean 
     */
    public function getEnabled()
    {
        return $this->enabled;
    }


    /**
     * Set page
     *
     * @param \Base\CoreBundle\Entity\FDCEventRoutes $page
     * @return FDCPageWaiting
     */
    public function setPage(\Base\CoreBundle\Entity\FDCEventRoutes $page = null)
    {
        $this->page = $page;

        return $this;
    }

    /**
     * Get page
     *
     * @return \Base\CoreBundle\Entity\FDCEventRoutes 
     */
    public function getPage()
    {
        return $this->page;
    }

    /**
     * Set banner
     *
     * @param \Base\CoreBundle\Entity\MediaImageSimple $banner
     * @return FDCPageWaiting
     */
    public function setBanner(\Base\CoreBundle\Entity\MediaImageSimple $banner = null)
    {
        $this->banner = $banner;

        return $this;
    }

    /**
     * Get banner
     *
     * @return \Base\CoreBundle\Entity\MediaImageSimple 
     */
    public function getBanner()
    {
        return $this->banner;
    }
}
