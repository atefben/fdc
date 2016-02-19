<?php

namespace Base\CoreBundle\Entity;

use \DateTime;

use A2lix\I18nDoctrineBundle\Doctrine\ORM\Util\Translatable;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

use JMS\Serializer\Annotation\Groups;
use JMS\Serializer\Annotation\Since;

use Symfony\Component\Validator\Constraints as Assert;

/**
 * InfoWidgetVideoYoutube
 *
 * @ORM\Table()
 * @ORM\Entity
 * @ORM\HasLifecycleCallbacks()
 */
class InfoWidgetVideoYoutube extends InfoWidget
{
    use Translatable;

    /**
     * @var ArrayCollection
     *
     * @Groups({"news_list", "news_show"})
     */
    protected $translations;

    public function __construct()
    {
        $this->translations = new ArrayCollection();
    }
}
