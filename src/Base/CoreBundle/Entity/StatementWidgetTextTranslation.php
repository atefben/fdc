<?php

namespace Base\CoreBundle\Entity;

use \DateTime;

use A2lix\I18nDoctrineBundle\Doctrine\ORM\Util\Translation;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

use Base\CoreBundle\Util\Time;

/**
 * StatementWidgetTextTranslation
 *
 * @ORM\Table()
 * @ORM\Entity
 * @ORM\HasLifecycleCallbacks()
 */
class StatementWidgetTextTranslation
{
    use Translation;
    use Time;

    /**
     * @var string
     *
     * @ORM\Column(type="text", nullable=true)
     */
    private $content;

    /**
     * Set content
     *
     * @param string $content
     * @return StatementWidgetTextTranslation
     */
    public function setContent($content)
    {
        $this->content = $content;

        return $this;
    }

    /**
     * Get content
     *
     * @return string 
     */
    public function getContent()
    {
        return $this->content;
    }
}
