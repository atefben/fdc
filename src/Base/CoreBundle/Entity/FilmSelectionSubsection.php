<?php

namespace Base\CoreBundle\Entity;

use A2lix\I18nDoctrineBundle\Doctrine\ORM\Util\Translatable;

use Base\CoreBundle\Interfaces\TranslateMainInterface;
use Base\CoreBundle\Util\Time;
use Base\CoreBundle\Util\TranslateMain;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

use JMS\Serializer\Annotation\Groups;
use JMS\Serializer\Annotation\Since;


/**
 * FilmSelectionSubsection
 *
 * @ORM\Table()
 * @ORM\Entity
 * @ORM\HasLifecycleCallbacks
 */
class FilmSelectionSubsection implements TranslateMainInterface
{
    use Time;
    use Translatable;
    use TranslateMain;

    /**
     * @var string
     *
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     *
     * @Groups({
     *     "film_show",
     *     "film_list",
     *     "film_selection_list",
     *     "film_selection_section_list",
     *     "film_selection_section_show",
     *     "news_list", "search",
     *     "news_show",
     *     "home"
     * })
     */
    protected $id;
    
    
    /**
     * @var ArrayCollection
     *
     * @Groups({
     *     "film_show",
     *     "film_list",
     *     "film_selection_list",
     *     "film_selection_section_list",
     *     "film_selection_section_show",
     *     "news_list", "search",
     *     "news_show",
     *     "home"
     * })
     */
    protected $translations;
    
    /**
     * @var string
     *
     * @ORM\ManyToOne(targetEntity="FilmSelection", inversedBy="subsections", cascade={"persist"})
     */
    protected $selection;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->translations = new ArrayCollection();
    }

    /**
     * Set selection
     *
     * @param \Base\CoreBundle\Entity\FilmSelection $selection
     * @return FilmSelectionSubsection
     */
    public function setSelection(\Base\CoreBundle\Entity\FilmSelection $selection = null)
    {
        $this->selection = $selection;

        return $this;
    }

    /**
     * Get selection
     *
     * @return \Base\CoreBundle\Entity\FilmSelection
     */
    public function getSelection()
    {
        return $this->selection;
    }


    /**
     * Set id
     *
     * @param string $id
     * @return FilmSelectionSubsection
     */
    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }

    /**
     * Get id
     *
     * @return string 
     */
    public function getId()
    {
        return $this->id;
    }
}
