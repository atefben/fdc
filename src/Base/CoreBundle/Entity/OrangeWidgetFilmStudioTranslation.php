<?php

namespace Base\CoreBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

use Base\CoreBundle\Util\Time;
use A2lix\I18nDoctrineBundle\Doctrine\ORM\Util\Translation;
use JMS\Serializer\Annotation\Groups;

/**
 * OrangeWidgetFilmOCS
 *
 * @ORM\Table()
 * @ORM\Entity
 * @ORM\HasLifecycleCallbacks()
 */
class OrangeWidgetFilmStudioTranslation
{
    use Translation;
    use \Base\CoreBundle\Util\TranslationChanges;
    use Time;

    /**
     * @var string
     *
     * @ORM\Column(name="title", type="text", nullable=true)
     * @Groups({"orange_studio"})
     */
    private $title;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="text", nullable=true)
     * @Groups({"orange_studio"})
     */
    private $description;

    /**
     * Set title
     *
     * @param string $title
     * @return OrangeWidgetFilmOCS
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

    /**
     * Set description
     *
     * @param string $description
     * @return OrangeWidgetFilmOCS
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get description
     *
     * @return string 
     */
    public function getDescription()
    {
        return $this->description;
    }
}
