<?php

namespace FDC\CoreBundle\Entity;

use \DateTime;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

use FDC\CoreBundle\Util\Time;

/**
 * NewsWidgetText
 *
 * @ORM\Table()
 * @ORM\Entity
 * @ORM\HasLifecycleCallbacks()
 */
class NewsWidgetText extends NewsWidget
{
    /**
     * @var string
     *
     * @ORM\Column(type="text", nullable=false)
     */
    private $content;
    
}
