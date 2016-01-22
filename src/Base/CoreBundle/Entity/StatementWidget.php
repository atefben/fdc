<?php

namespace Base\CoreBundle\Entity;

use \DateTime;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

use Base\CoreBundle\Util\Time;

/**
 * StatementWidget
 *
 * @ORM\Entity
 * @ORM\HasLifecycleCallbacks()
 * @ORM\InheritanceType("JOINED")
 * @ORM\DiscriminatorColumn(name="type", type="string")
 * @ORM\DiscriminatorMap({
 *  "text" = "StatementWidgetText",
 *  "quote" = "StatementWidgetQuote",
 *  "audio" = "StatementWidgetAudio",
 *  "image" = "StatementWidgetImage",
 *  "image_dual_align" = "StatementWidgetImageDualAlign",
 *  "video" = "StatementWidgetVideo",
 *  "video_youtube" = "StatementWidgetVideoYoutube",
 * })
 */
abstract class StatementWidget
{
    use Time;

    /**
     * @var integer
     *
     * @ORM\Column(type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    protected $id;

    /**
     * @var integer
     *
     * @ORM\Column(type="integer", nullable=false)
     */
    protected $position;

    /**
     * @var Statement
     *
     * @ORM\ManyToOne(targetEntity="Statement", inversedBy="widgets")
     */
    protected $statement;

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
     * Set position
     *
     * @param integer $position
     * @return StatementWidget
     */
    public function setPosition($position)
    {
        $this->position = $position;

        return $this;
    }

    /**
     * Get position
     *
     * @return integer
     */
    public function getPosition()
    {
        return $this->position;
    }

    /**
     * Set statement
     *
     * @param \Base\CoreBundle\Entity\Statement $statement
     * @return StatementWidget
     */
    public function setStatement(\Base\CoreBundle\Entity\Statement $statement = null)
    {
        $this->statement = $statement;

        return $this;
    }

    /**
     * Get statement
     *
     * @return \Base\CoreBundle\Entity\Statement 
     */
    public function getStatement()
    {
        return $this->statement;
    }
}
