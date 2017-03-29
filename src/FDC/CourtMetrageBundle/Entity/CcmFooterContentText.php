<?php

namespace FDC\CourtMetrageBundle\Entity;

use A2lix\I18nDoctrineBundle\Doctrine\ORM\Util\Translatable;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * CcmFooterContentText
 *
 * @ORM\Table(name="ccm_footer_content_text")
 * @ORM\Entity
 * @ORM\HasLifecycleCallbacks()
 */
class CcmFooterContentText
{
    use Translatable;

    /**
     * @var integer
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var ArrayCollection
     */
    protected $translations;

    /**
     * @var integer
     * @ORM\Column(type="integer", nullable=true)
     */
    protected $position;

    /**
     * @ORM\ManyToOne(targetEntity="FDC\CourtMetrageBundle\Entity\CcmFooterContent", inversedBy="contentText")
     * @ORM\JoinColumn(name="footer_content_id", referencedColumnName="id", onDelete="SET NULL")
     */
    protected $footerContent;
    
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
     * @return int
     */
    public function getPosition()
    {
        return $this->position;
    }

    /**
     * @param int $position
     */
    public function setPosition($position)
    {
        $this->position = $position;
    }

    /**
     * @return mixed
     */
    public function getFooterContent()
    {
        return $this->footerContent;
    }

    /**
     * @param mixed $footerContent
     */
    public function setFooterContent($footerContent)
    {
        $this->footerContent = $footerContent;
    }
}
