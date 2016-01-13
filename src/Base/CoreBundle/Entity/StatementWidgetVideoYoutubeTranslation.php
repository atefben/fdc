<?php

namespace Base\CoreBundle\Entity;

use A2lix\I18nDoctrineBundle\Doctrine\ORM\Util\Translation;

use Base\CoreBundle\Util\Time;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

use JMS\Serializer\Annotation\Groups;
use JMS\Serializer\Annotation\Since;

use Symfony\Component\Validator\Constraints as Assert;

/**
 * StatementWidgetVideoYoutubeTranslation
 *
 * @ORM\Table()
 * @ORM\Entity
 * @ORM\HasLifecycleCallbacks()
 */
class StatementWidgetVideoYoutubeTranslation
{
    use Translation;
    use Time;

    /**
     * @var string
     *
     * @ORM\Column(type="text", nullable=false)
     *
     * @Groups({"statement_list", "statement_show"})
     */
    private $youtubeId;

    /**
     * @var string
     *
     * @ORM\Column(type="text", nullable=false)
     *
     * @Groups({"statement_list", "statement_show"})
     */
    private $title;

    /**
     * Set youtubeId
     *
     * @param string $youtubeId
     * @return StatementWidgetVideoYoutubeTranslation
     */
    public function setYoutubeId($youtubeId)
    {
        $this->youtubeId = $youtubeId;

        return $this;
    }

    /**
     * Get youtubeId
     *
     * @return string 
     */
    public function getYoutubeId()
    {
        return $this->youtubeId;
    }

    /**
     * Set title
     *
     * @param string $title
     * @return StatementWidgetVideoYoutubeTranslation
     */
    public function setTitle($title)
    {
        $this->title = $title;

        return $this;
    }

    /**
     * Get title
     *
     * @return string 
     */
    public function getTitle()
    {
        return $this->title;
    }
}
