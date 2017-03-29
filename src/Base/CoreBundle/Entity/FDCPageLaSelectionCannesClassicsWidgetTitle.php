<?php

namespace Base\CoreBundle\Entity;

use A2lix\I18nDoctrineBundle\Doctrine\ORM\Util\Translatable;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

use JMS\Serializer\Annotation\Groups;
use JMS\Serializer\Annotation\Since;

/**
 * FDCPageLaSelectionCannesClassicsWidgetTitle
 *
 * @ORM\Table()
 * @ORM\Entity
 * @ORM\HasLifecycleCallbacks()
 */
class FDCPageLaSelectionCannesClassicsWidgetTitle extends FDCPageLaSelectionCannesClassicsWidget
{
    use Translatable;

    /**
     * @var ArrayCollection
     *
     * @Groups({"news_list", "search", "news_show"})
     */
    protected $translations;

    public function __construct()
    {
        $this->translations = new ArrayCollection();
    }
}
