<?php

namespace Base\CoreBundle\Entity;

use A2lix\I18nDoctrineBundle\Doctrine\ORM\Util\Translation;

use Base\CoreBundle\Util\Time;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

use JMS\Serializer\Annotation\Groups;
use JMS\Serializer\Annotation\Since;

/**
 * FDCPageLaSelectionCannesClassicsWidgetTitleTranslation
 *
 * @ORM\Table()
 * @ORM\Entity
 * @ORM\HasLifecycleCallbacks()
 */
class FDCPageLaSelectionCannesClassicsWidgetTitleTranslation
{
    use Translation;
    use \Base\CoreBundle\Util\TranslationChanges;
    use Time;

    /**
     * @var string
     *
     * @ORM\Column(type="text", nullable=true)
     *
     * @Groups({"news_list", "search", "news_show"})
     */
    protected $title;

    /**
     * Set title
     *
     * @param string $title
     * @return FDCPageLaSelectionCannesClassicsWidgetTitleTranslation
     */
    public function setTitle($title)
    {
        $this->title = $title;

        return $this;
    }

    /**
     * Get subtitle
     *
     * @return string 
     */
    public function getTitle()
    {
        return $this->title;
    }
}
