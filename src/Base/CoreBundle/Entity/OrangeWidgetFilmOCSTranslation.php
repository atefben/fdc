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
class OrangeWidgetFilmOCSTranslation
{
    use Translation;
    use Time;
    /**
     * @var string
     *
     * @ORM\Column(name="legend", type="text", nullable=true)
     * @Groups({
     *     "orange_programmation_ocs"
     * })
     */
    private $legend;

    /**
     * @var string
     *
     * @ORM\Column(name="title", type="text", nullable=true)
     * @Groups({
     *     "orange_programmation_ocs"
     * })
     */
    private $title;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="text", nullable=true)
     * @Groups({
     *     "orange_programmation_ocs"
     * })
     */
    private $description;

    /**
     * Set legend
     *
     * @param string $legend
     * @return OrangeWidgetFilmOCS
     */
    public function setLegend($legend)
    {
        $this->legend = $legend;

        return $this;
    }

    /**
     * Get legend
     *
     * @return string 
     */
    public function getLegend()
    {
        return $this->legend;
    }

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
