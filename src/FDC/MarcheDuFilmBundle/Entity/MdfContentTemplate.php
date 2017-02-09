<?php

namespace FDC\MarcheDuFilmBundle\Entity;

use A2lix\I18nDoctrineBundle\Doctrine\ORM\Util\Translatable;
use Base\CoreBundle\Util\TranslateMain;
use Base\CoreBundle\Interfaces\TranslateMainInterface;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * MdfContentTemplate
 * @ORM\Table(name="mdf_content_template")
 * @ORM\Entity
 */
class MdfContentTemplate implements TranslateMainInterface
{
    use Translatable;
    use TranslateMain;

    const TYPE_EDITION_PRESENTATION = 'edition_presentation';
    const TYPE_EDITION_PROJECTIONS = 'edition_projections';
    const TYPE_INDUSTRY_PROGRAM_HOME = 'industry_program_home';
    const TYPE_WHO_ARE_WE_HISTORY = 'who_are_we_history';
    const TYPE_WHO_ARE_WE_KEY_FIGURES = 'who_are_we_key_figures';
    const TYPE_WHO_ARE_WE_ENVIRONMENTAL_APPROACHES = 'who_are_we_environmental_approaches';
    const TYPE_LEGAL_MENTIONS = 'legal_mentions';
    const TYPE_GENERAL_CONDITIONS = 'general_conditions';
    const TYPE_NEWS_DETAILS = 'news_details';

    public static $CONTENT_TEMPLATE_OPTIONS = array(
        self::TYPE_EDITION_PRESENTATION,
        self::TYPE_EDITION_PROJECTIONS,
        self::TYPE_INDUSTRY_PROGRAM_HOME,
        self::TYPE_WHO_ARE_WE_HISTORY,
        self::TYPE_WHO_ARE_WE_KEY_FIGURES,
        self::TYPE_WHO_ARE_WE_ENVIRONMENTAL_APPROACHES,
        self::TYPE_LEGAL_MENTIONS,
        self::TYPE_GENERAL_CONDITIONS,
        self::TYPE_NEWS_DETAILS,
    );

    /**
     * @var integer
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @var string
     *
     * @ORM\Column(type="string", nullable=false)
     */
    protected $type;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="published_at", type="datetime", nullable=true)
     */
    protected $publishedAt;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="publish_ended_at", type="datetime", nullable=true)
     */
    protected $publishEndedAt;

    /**
     * @var Theme
     *
     * @ORM\ManyToOne(targetEntity="FDC\MarcheDuFilmBundle\Entity\MdfTheme", inversedBy="contentTemplate")
     * @ORM\JoinColumn(name="theme_id", referencedColumnName="id", onDelete="SET NULL")
     * @Assert\NotBlank(groups={"news"})
     */
    private $theme;

    /**
     * @var ArrayCollection
     */
    protected $translations;

    /**
     * @var MdfContentTemplateWidget
     *
     * @ORM\OneToMany(targetEntity="MdfContentTemplateWidget", mappedBy="contentTemplate", cascade={"persist", "remove"}, orphanRemoval=true)
     * @ORM\OrderBy({"position" = "ASC"})
     */
    private $contentTemplateWidgets;

    /**
     * MdfContentTemplate constructor.
     */
    public function __construct()
    {
        $this->translations = new ArrayCollection();
        $this->contentTemplateWidgets = new ArrayCollection();
    }

    public function __toString()
    {
        $translation = $this->findTranslationByLocale('fr');

        if ($translation !== null) {
            $string = $translation->getTitle();
        } else {
            $string = strval($this->getId());
        }
        return (string) $string;
    }

    public function getTitle()
    {
        $translation = $this->findTranslationByLocale('fr');
        $string = '';

        if ($translation !== null) {
            $string = $translation->getTitle();
        }

        return $string;
    }

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param MdfContentTemplateWidget $contentTemplateWidget
     */
    public function addContentTemplateWidget(MdfContentTemplateWidget $contentTemplateWidget)
    {
        $contentTemplateWidget->setContentTemplate($this);
        $this->contentTemplateWidgets->add($contentTemplateWidget);
    }

    /**
     * @param MdfContentTemplateWidget $contentTemplateWidget
     */
    public function removeContentTemplateWidget(MdfContentTemplateWidget $contentTemplateWidget)
    {
        $this->contentTemplateWidgets->removeElement($contentTemplateWidget);
    }

    /**
     * @return ArrayCollection|MdfContentTemplateWidget
     */
    public function getContentTemplateWidgets()
    {
        return $this->contentTemplateWidgets;
    }

    /**
     * @return string
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * @param $type
     *
     * @return $this
     */
    public function setType($type)
    {
        $this->type = $type;

        return $this;
    }

    /**
     * @return \DateTime
     */
    public function getPublishedAt()
    {
        return $this->publishedAt;
    }

    /**
     * @param $publishedAt
     *
     * @return $this
     */
    public function setPublishedAt($publishedAt)
    {
        $this->publishedAt = $publishedAt;

        return $this;
    }

    /**
     * @return \DateTime
     */
    public function getPublishEndedAt()
    {
        return $this->publishEndedAt;
    }

    /**
     * @param $publishEndedAt
     *
     * @return $this
     */
    public function setPublishEndedAt($publishEndedAt)
    {
        $this->publishEndedAt = $publishEndedAt;

        return $this;
    }

    /**
     * Set theme
     *
     * @param \FDC\MarcheDuFilmBundle\Entity\MdfTheme $theme
     * @return MdfTheme
     */
    public function setTheme(\FDC\MarcheDuFilmBundle\Entity\MdfTheme $theme = null)
    {
        $this->theme = $theme;

        return $this;
    }

    /**
     * Get theme
     *
     * @return \FDC\MarcheDuFilmBundle\Entity\MdfTheme
     */
    public function getTheme()
    {
        return $this->theme;
    }
}
