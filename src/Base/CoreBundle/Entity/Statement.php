<?php

namespace Base\CoreBundle\Entity;

use A2lix\I18nDoctrineBundle\Doctrine\ORM\Util\Translatable;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

use Base\CoreBundle\Util\Time;
use Base\CoreBundle\Util\TranslationByLocale;

use JMS\Serializer\Annotation\Groups;
use JMS\Serializer\Annotation\Since;

/**
 * Statement
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Base\CoreBundle\Repository\StatementRepository")
 * @ORM\InheritanceType("JOINED")
 * @ORM\DiscriminatorColumn(name="type", type="string")
 * @ORM\DiscriminatorMap({"article" = "StatementArticle", "audio" = "StatementAudio", "image" = "StatementImage", "video" = "StatementVideo"})
 */
abstract class Statement
{
    use TranslationByLocale;
    use Translatable;
    use Time;

    /**
     * @var string
     *
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(type="boolean", nullable=false)
     */
    private $translate;

    /**
     * @var FilmFestival
     *
     * @ORM\ManyToOne(targetEntity="FilmFestival", inversedBy="statements", cascade={"persist"})
     *
     */
    private $festival;

    /**
     * @var StatementTheme
     *
     * @ORM\ManyToOne(targetEntity="StatementTheme", inversedBy="statements", cascade={"persist"})
     *
     */
    private $theme;

    /**
     * @TODO
     */
    private $image;

    /**
     * @var string
     *
     * @ORM\Column(type="string", nullable=false)
     */
    private $title;

    /**
     * @var StatementWidget
     *
     * @ORM\OneToMany(targetEntity="StatementWidget", mappedBy="statement", cascade={"persist"})
     */
    private $widgets;

    /**
     * @var NewsTag
     *
     * @ORM\OneToMany(targetEntity="StatementNewsTag", mappedBy="statement", cascade={"persist"})
     */
    private $tags;

    /**
     * ArrayCollection
     */
    protected $translations;


    public function __construct()
    {
        $this->translations = new ArrayCollection();
        $this->widgets = new ArrayCollection();
    }
}
