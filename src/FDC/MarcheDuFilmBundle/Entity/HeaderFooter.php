<?php

namespace FDC\MarcheDuFilmBundle\Entity;

use Application\Sonata\MediaBundle\Entity\Media;
use A2lix\I18nDoctrineBundle\Doctrine\ORM\Util\Translatable;
use Base\CoreBundle\Interfaces\TranslateMainInterface;
use Doctrine\Common\Collections\ArrayCollection;
use Base\CoreBundle\Util\SeoMain;
use Base\CoreBundle\Util\Time;
use Base\CoreBundle\Util\TranslateMain;
use Doctrine\ORM\Mapping as ORM;

/**
 * HeaderFooter
 * @ORM\Table(name="mdf_header_footer")
 * @ORM\Entity
 */
class HeaderFooter
{
    use Translatable;

    /**
     * @var integer
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @var Media
     *
     * @ORM\ManyToOne(targetEntity="Application\Sonata\MediaBundle\Entity\Media")
     * @ORM\JoinColumns({
     *     @ORM\JoinColumn(name="headerBanner", referencedColumnName="id")
     * })
     */
    protected $headerBanner;

    /**
     * @var ArrayCollection
     */
    protected $translations;

    /**
     * HeaderFooter constructor.
     */
    public function __construct()
    {
        $this->translations = new ArrayCollection();
    }

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return Media
     */
    public function getHeaderBanner()
    {
        return $this->headerBanner;
    }

    /**
     * @param $headerBanner
     *
     * @return $this
     */
    public function setHeaderBanner($headerBanner)
    {
        $this->headerBanner = $headerBanner;

        return $this;
    }
}
