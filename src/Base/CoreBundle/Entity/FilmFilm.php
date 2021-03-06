<?php

namespace Base\CoreBundle\Entity;

use A2lix\I18nDoctrineBundle\Doctrine\ORM\Util\Translatable;
use Base\CoreBundle\Interfaces\FilmFunctionInterface;
use Base\CoreBundle\Interfaces\TranslateMainInterface;
use Base\CoreBundle\Util\Soif;
use Base\CoreBundle\Util\Time;
use Base\CoreBundle\Util\TranslateMain;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use FDC\CourtMetrageBundle\Entity\CcmNewsFilmFilmAssociated;
use Gedmo\Mapping\Annotation as Gedmo;
use JMS\Serializer\Annotation as Serializer;
use JMS\Serializer\Annotation\Groups;
use JMS\Serializer\Annotation\VirtualProperty;

/**
 * FilmFilm
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Base\CoreBundle\Repository\FilmFilmRepository")
 * @ORM\HasLifecycleCallbacks
 *
 */
class FilmFilm implements FilmFilmInterface, TranslateMainInterface
{
    use Translatable;
    use TranslateMain;
    use Time;
    use Soif;

    protected $api2017 = false;

    /**
     * @var string
     *
     * @ORM\Column(type="string", length=36)
     * @ORM\Id
     *
     * @Groups({
     *     "trailer_list",
     *     "trailer_show",
     *     "film_list",
     *     "film_show",
     *     "award_list",
     *     "award_show",
     *     "projection_list", "projection_list_2017", "programmation",
     *     "projection_show", "programmation_main",
     *     "news_list", "search",
     *     "news_show",
     *     "film_selection_section_show",
     *     "home",
     *     "news_list", "search",
     *     "classics",
     *     "orange_studio",
     *     "search"
     * })
     *
     */
    protected $id;

    /**
     * @var string
     *
     * @Gedmo\Slug(fields={"titleVO"}, updatable=false)
     * @ORM\Column(name="slug", type="string", length=255, unique=true)
     *
     * @Groups({
     *     "trailer_list",
     *     "trailer_show",
     *     "film_list",
     *     "film_show",
     *     "award_list",
     *     "award_show",
     *     "projection_list", "projection_list_2017", "programmation",
     *     "projection_show", "programmation_main",
     *     "film_selection_section_show",
     *     "classics"
     * })
     */
    protected $slug;

    /**
     * @var boolean
     *
     * @ORM\Column(type="boolean")
     *
     * @Groups({
     *     "trailer_list",
     *     "trailer_show",
     *     "award_list",
     *     "award_show",
     *     "projection_list", "projection_list_2017", "programmation",
     *     "projection_show", "programmation_main",
     *     "film_list",
     *     "film_show",
     *     "film_selection_section_show",
     * })
     *
     */
    protected $directorFirst;

    /**
     * @var boolean
     *
     * @ORM\Column(type="boolean")
     *
     */
    protected $restored;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="published_at", type="datetime", nullable=true)
     * @Groups({"film_list", "film_show", "classics"})
     */
    protected $publishedAt;

    /**
     * @var string
     *
     * @ORM\Column(type="string", length=255)
     *
     * @Groups({
     *     "trailer_list",
     *     "trailer_show",
     *     "film_list",
     *     "film_show",
     *     "award_list",
     *     "award_show",
     *     "projection_list", "projection_list_2017", "programmation",
     *     "projection_show", "programmation_main",
     *     "news_list", "search",
     *     "news_show",
     *     "film_selection_section_show",
     *     "classics",
     *     "orange_studio",
     *     "search"
     * })
     *
     */
    protected $titleVO;

    /**
     * @var string
     *
     * @ORM\Column(type="string", length=255, nullable=true)
     *
     * @Groups({
     *     "trailer_list",
     *     "trailer_show",
     *     "film_list",
     *     "film_show",
     *     "award_list",
     *     "award_show",
     *     "projection_list", "projection_list_2017", "programmation",
     *     "projection_show", "programmation_main",
     *     "film_selection_section_show",
     *     "classics",
     *     "orange_studio",
     *     "search"
     * })
     *
     */
    protected $titleVOAlphabet;

    /**
     * @var string
     *
     * @ORM\Column(type="string", length=4, nullable=true)
     *
     * @Groups({
     *     "trailer_list",
     *     "trailer_show",
     *     "film_list",
     *     "film_show",
     *     "award_list",
     *     "award_show",
     *     "projection_list", "projection_list_2017", "programmation",
     *     "projection_show", "programmation_main",
     *     "news_show",
     *     "classics"
     * })
     *
     */
    protected $productionYear;

    /**
     * @var string
     *
     * @ORM\Column(type="decimal", precision=22, scale=2)
     *
     * @Groups({
     *     "trailer_list",
     *     "trailer_show",
     *     "film_list",
     *     "film_show",
     *     "award_list",
     *     "award_show",
     *     "projection_list", "projection_list_2017", "programmation",
     *     "projection_show", "programmation_main",
     *     "news_show",
     *     "classics"
     * })
     *
     */
    protected $duration;

    /**
     * @var string
     *
     * @ORM\Column(type="text", nullable=true)
     *
     */
    protected $castingCommentary;

    /**
     * @var string
     *
     * @ORM\Column(type="string", length=255, nullable=true)
     *
     */
    protected $website;

    /**
     * @var string
     *
     * @ORM\Column(type="string", length=255, nullable=true)
     *
     */
    protected $facebook;

    /**
     * @var string
     *
     * @ORM\Column(type="string", length=255, nullable=true)
     *
     */
    protected $twitter;

    /**
     * @var integer
     *
     * @ORM\Column(type="integer", nullable=true)
     *
     * @Groups({
     *     "trailer_list",
     *     "trailer_show",
     *     "film_list",
     *     "film_show",
     *     "award_list",
     *     "award_show",
     *     "projection_list", "projection_list_2017", "programmation",
     *     "projection_show", "programmation_main"
     * })
     */
    protected $galaId;

    /**
     * @var string
     *
     * @ORM\Column(type="string", length=255, nullable=true)
     *
     * @Groups({
     *     "trailer_list",
     *     "trailer_show",
     *     "film_list",
     *     "film_show",
     *     "award_list",
     *     "award_show",
     *     "projection_list", "projection_list_2017", "programmation",
     *     "projection_show", "programmation_main"
     * })
     *
     */
    protected $galaName;

    /**
     * @var FilmSelection
     *
     * @ORM\ManyToOne(targetEntity="FilmSelection", inversedBy="films", cascade={"persist"})
     *
     * @Groups({"film_list", "film_show"})
     *
     */
    protected $selection;

    /**
     * @var FilmSelectionSection
     *
     * @ORM\ManyToOne(targetEntity="FilmSelectionSection", inversedBy="films", cascade={"persist"})
     *
     * @Groups({"film_list", "film_show", "news_list", "search", "news_show", "home", "orange_studio", "search"})
     *
     */
    protected $selectionSection;

    /**
     * @var FilmSelectionSubsection
     *
     * @ORM\ManyToOne(targetEntity="FilmSelectionSubsection", inversedBy="films", cascade={"persist"})
     *
     * @Groups({"film_list", "film_show", "news_list", "search", "news_show", "home"})
     *
     */
    protected $selectionSubsection;

    /**
     * @var FilmFestival
     *
     * @ORM\ManyToOne(targetEntity="FilmFestival", inversedBy="films", cascade={"persist"})
     *
     */
    protected $festival;

    /**
     * @var FilmFilmPerson
     *
     * @ORM\OneToMany(targetEntity="FilmFilmPerson", mappedBy="film", cascade={"all"}, orphanRemoval=true)
     *
     * @ORM\OrderBy({"position" = "ASC"})
     */
    protected $persons;

    /**
     * @ORM\OneToMany(targetEntity="FilmLanguage", mappedBy="film", cascade={"persist"})
     */
    protected $languages;

    /**
     * @ORM\ManyToMany(targetEntity="FilmContact", inversedBy="films", cascade={"persist"})
     * @Groups({
     *     "film_show"
     * })
     * @ORM\OrderBy({"position"="ASC"})
     */
    protected $contacts;

    /**
     * @ORM\OneToMany(targetEntity="FilmFilmMedia", mappedBy="film", cascade={"all"}, orphanRemoval=true)
     * @ORM\OrderBy({"position"="ASC"})
     *
     * @Groups({
     *     "film_list",
     *     "film_show",
     *     "projection_list", "programmation",
     *     "projection_show", "programmation_main",
     *     "film_selection_section_show",
     *     "news_list", "search",
     *     "news_show",
     *     "award_list",
     *     "classics",
     *     "orange_studio",
     *     "search"
     * })
     */
    protected $medias;

    /**
     * @ORM\OneToMany(targetEntity="FilmMinorProduction", mappedBy="film", cascade={"persist"})
     */
    protected $minorProductions;

    /**
     * @ORM\OneToMany(targetEntity="FilmFilmCountry", mappedBy="film", cascade={"all"})
     * @Groups({
     *     "film_list",
     *     "film_show",
     *     "trailer_list",
     *     "trailer_show",
     *     "award_list",
     *     "award_show",
     *     "projection_list", "projection_list_2017", "programmation",
     *     "projection_show", "programmation_main",
     *     "news_show",
     *     "search"
     *
     * })
     */
    protected $countries;

    /**
     * @ORM\OneToMany(targetEntity="FilmAwardAssociation", mappedBy="film", cascade={"persist", "merge"})
     *
     * @Groups({
     *  "film_list", "film_show",
     *  "trailer_list", "trailer_show",
     *  "award_list", "award_show"
     * })
     */
    protected $awards;

    /**
     * @var ArrayCollection
     *
     * @Groups({
     *     "trailer_list",
     *     "trailer_show",
     *     "film_list",
     *     "film_show",
     *     "news_show",
     *     "projection_list", "projection_list_2017", "programmation",
     *     "film_selection_section_show",
     *     "home",
     *     "news_list", "search",
     *     "classics",
     *     "orange_studio",
     *     "search"
     * })
     *
     */
    protected $translations;

    /**
     * @ORM\OneToMany(targetEntity="FilmProjectionProgrammationFilm", mappedBy="film", cascade={"all"})
     */
    protected $projectionProgrammationFilms;

    /**
     * @ORM\ManyToMany(targetEntity="FilmProjectionProgrammationFilmList", mappedBy="films", cascade={"all"})
     */
    protected $projectionProgrammationFilmsList;

    /**
     * @ORM\OneToMany(targetEntity="NewsFilmFilmAssociated", mappedBy="association", cascade={"all"}, orphanRemoval=true)
     *
     * @Groups({"film_show"})
     */
    protected $associatedNews;

    /**
     * @ORM\OneToMany(targetEntity="FDC\CourtMetrageBundle\Entity\CcmNewsFilmFilmAssociated", mappedBy="association", cascade={"all"}, orphanRemoval=true)
     */
    protected $associatedCcmNews;

    /**
     * @var ArrayCollection
     * @ORM\OneToMany(targetEntity="News", mappedBy="associatedFilm")
     */
    protected $news;

    /**
     * @var ArrayCollection
     * @ORM\OneToMany(targetEntity="FDC\CourtMetrageBundle\Entity\CcmNews", mappedBy="associatedFilm")
     */
    protected $ccmNews;

    /**
     * @ORM\OneToMany(targetEntity="MediaVideoFilmFilmAssociated", mappedBy="association", cascade={"all"}, orphanRemoval=true)
     * @Groups({
     *     "trailer_show",
     *     "film_show"
     * })
     */
    protected $associatedMediaVideos;

    /**
     * @ORM\OneToMany(targetEntity="MediaAudioFilmFilmAssociated", mappedBy="association", cascade={"all"}, orphanRemoval=true)
     * @Groups({
     *  "trailer_show",
     *  "film_show"
     * })
     */
    protected $associatedMediaAudios;

    /**
     * @ORM\OneToMany(targetEntity="StatementFilmFilmAssociated", mappedBy="association", cascade={"all"}, orphanRemoval=true)
     *
     * @Groups({"statement_list", "statement_show"})
     */
    protected $associatedStatement;

    /**
     * @ORM\OneToMany(targetEntity="InfoFilmFilmAssociated", mappedBy="association", cascade={"all"}, orphanRemoval=true)
     *
     * @Groups({"info_list", "info_show"})
     */
    protected $associatedInfo;

    /**
     * @var MediaImageSimple
     * @ORM\ManyToOne(targetEntity="MediaImageSimple", inversedBy="imageMainFilms")
     * @Groups({
     *     "film_list",
     *     "film_show",
     *     "film_selection_section_show",
     *     "news_list", "search",
     *     "award_list",
     *     "classics",
     *     "orange_studio",
     *     "projection_list", "projection_list_2017", "programmation",
     *     "projection_show", "programmation_main",
     *     "search"
     * })
     * @Serializer\Accessor(getter="getApiImageMain")
     */
    protected $imageMain;

    /**
     * @ORM\ManyToOne(targetEntity="MediaImageSimple", inversedBy="imageCoverFilms")
     * @Groups({
     *     "film_list",
     *     "film_show",
     *     "film_selection_section_show",
     *     "news_list", "search",
     *     "award_list",
     *     "classics",
     *     "orange_studio",
     *     "projection_list", "projection_list_2017", "programmation",
     *     "projection_show", "programmation_main",
     * })
     */
    protected $imageCover;

    /**
     * @ORM\ManyToOne(targetEntity="MediaVideo")
     * @Groups({
     *     "film_list",
     *     "film_show",
     *     "film_selection_section_show"
     * })
     */
    protected $videoMain;

    /**
     * @var NewsTag
     *
     * @ORM\OneToMany(targetEntity="FilmFilmTag", mappedBy="film", cascade={"all"}, orphanRemoval=true)
     *
     */
    protected $tags;

    /**
     * @var ArrayCollection
     * @ORM\ManyToMany(targetEntity="Application\Sonata\MediaBundle\Entity\Media", inversedBy="selfkitFilms")
     * @ORM\JoinTable(name="film_film_selfkit_images",
     *      joinColumns={@ORM\JoinColumn(name="film", referencedColumnName="id")},
     *      inverseJoinColumns={@ORM\JoinColumn(name="image", referencedColumnName="id")}
     *      )
     *
     */
    protected $selfkitImages;

    /**
     * @var ArrayCollection
     * @ORM\ManyToMany(targetEntity="Application\Sonata\MediaBundle\Entity\Media")
     * @ORM\JoinTable(name="film_film_selfkit_pdf",
     *      joinColumns={@ORM\JoinColumn(name="film", referencedColumnName="id")},
     *      inverseJoinColumns={@ORM\JoinColumn(name="pdf", referencedColumnName="id")}
     *      )
     * @ORM\OrderBy({"updatedAt"="asc"})
     */
    protected $selfkitPdfFiles;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->persons = new ArrayCollection();
        $this->contacts = new ArrayCollection();
        $this->awards = new ArrayCollection();
        $this->medias = new ArrayCollection();
        $this->associatedMediaVideos = new ArrayCollection();
        $this->associatedMediaAudios = new ArrayCollection();
        $this->minorProductions = new ArrayCollection();
        $this->countries = new ArrayCollection();
        $this->translations = new ArrayCollection();
        $this->languages = new ArrayCollection();
        $this->projectionProgrammationFilms = new ArrayCollection();
        $this->associatedNews = new ArrayCollection();
        $this->associatedCcmNews = new ArrayCollection();
        $this->associatedInfo = new ArrayCollection();
        $this->associatedStatement = new ArrayCollection();
        $this->tags = new ArrayCollection();
        $this->news = new ArrayCollection();
        $this->selfkitImages = new ArrayCollection();
        $this->ccmNews = new ArrayCollection();
        $this->selfkitPdfFiles = new ArrayCollection();
    }

    public function __toString()
    {
        return $this->getTitleVO();
    }

    /**
     * @VirtualProperty()
     * @Groups({
     *     "film_list",
     *     "film_show",
     *     "projection_list", "projection_list_2017", "programmation",
     *     "projection_show", "programmation_main"
     * })
     * @return array|ArrayCollection
     */
    public function getActors()
    {
        $collection = new ArrayCollection();
        if ($this->getPersons()->count() > 0) {
            foreach ($this->getPersons() as $person) {
                if ($person->getFunctions()->count() > 0) {
                    foreach ($person->getFunctions() as $personFunction) {
                        if ($personFunction->getFunction() &&
                            $personFunction->getFunction()->getId() == FilmFunctionInterface::FUNCTION_ACTOR
                        ) {
                            $collection->add($person);
                            break;
                        }
                    }
                }
            }
            $collection = $this->orderByNullLast($collection, 'ASC');
        }

        return $collection;
    }

    /**
     * @VirtualProperty()
     * @Groups({
     *     "film_list",
     *     "film_show",
     *     "projection_list", "projection_list_2017", "programmation",
     *     "projection_show", "programmation_main",
     *     "news_list", "search",
     *     "news_show",
     *     "film_selection_section_show",
     *     "home",
     *     "news_list", "search",
     *     "award_list",
     *     "classics",
     *     "orange_studio",
     *     "search"
     * })
     * @return array|ArrayCollection
     */
    public function getDirectors($collection = false)
    {
        $collection = new ArrayCollection();
        if ($this->getPersons()->count() > 0) {
            foreach ($this->getPersons() as $person) {
                if ($person->getFunctions()->count() > 0) {
                    foreach ($person->getFunctions() as $personFunction) {
                        if ($personFunction->getFunction() &&
                            $personFunction->getFunction()->getId() == FilmFunctionInterface::FUNCTION_DIRECTOR
                        ) {
                            $collection->add($person);
                            break;
                        }
                    }
                }
            }

            $collection = $this->orderByNullLast($collection, 'ASC');
        }
        if ($collection && is_array($collection)) {
            $collection = new ArrayCollection($collection);
        }
        return $collection;
    }

    /**
     * @VirtualProperty()
     * @Groups({
     *     "film_list",
     *     "film_show",
     *     "projection_list", "projection_list_2017", "programmation",
     *     "projection_show", "programmation_main"
     * })
     * @return array|ArrayCollection
     */
    public function getOtherCredits()
    {
        $collection = new ArrayCollection();
        if ($this->getPersons()->count() > 0) {
            foreach ($this->getPersons() as $person) {
                $hasCredit = false;
                if ($person->getFunctions()->count() > 0) {
                    foreach ($person->getFunctions() as $personFunction) {
                        if ($personFunction->getFunction()) {
                            $exclude = [
                                FilmFunctionInterface::FUNCTION_DIRECTOR,
                                FilmFunctionInterface::FUNCTION_ACTOR,
                            ];
                            $personFunctionFunctionId = $personFunction->getFunction()->getId();

                            $clone = clone $person;
                            $functions = new ArrayCollection();
                            foreach ($person->getFunctions() as $function) {
                                $functions->add($function);
                            }
                            $clone->setFunctions($functions);
                            if (!in_array($personFunctionFunctionId, $exclude)) {
                                if ($collection->contains($clone)) {
                                    $collection->removeElement($clone);
                                }
                                break;
                            } else {
                                $collection->add($clone);
                            }
                        }
                    }
                }
            }

            $collection = $this->removeMultipleFunctions($collection);
            $collection = $this->orderByNullLast($collection, 'ASC');
        }

        return $collection;
    }

    /**
     * @param bool $avoidRemoveMultipleFunctions
     * @return array|ArrayCollection
     * @VirtualProperty()
     * @Groups({
     *     "film_list",
     *     "film_show",
     *     "projection_list", "projection_list_2017", "programmation",
     *     "projection_show", "programmation_main"
     * })
     *
     */
    public function getCredits($avoidRemoveMultipleFunctions = false)
    {
        $done = [];
        $collection = new ArrayCollection();
        if ($this->getPersons()->count() > 0) {
            foreach ($this->getPersons() as $person) {
                if ($person->getFunctions()->count() > 0) {
                    foreach ($person->getFunctions() as $personFunction) {
                        if ($personFunction->getFunction() &&
                            $personFunction->getFunction()->getId() != FilmFunctionInterface::FUNCTION_ACTOR
                        ) {
                            $valueDone = $person->getId();
                            if (!in_array($valueDone, $done)) {
                                $clone = clone $person;
                                $functions = new ArrayCollection();
                                foreach ($person->getFunctions() as $function) {
                                    $functions->add($function);
                                }
                                $clone->setFunctions($functions);
                                $collection->add($clone);
                                $done[] = $valueDone;
                            }
                        }
                    }
                }
            }

            if (!$avoidRemoveMultipleFunctions) {
                $collection = $this->removeMultipleFunctions($collection);
            }
            $collection = $this->orderByNullLast($collection, 'ASC');
        }

        return $collection;
    }

    private function orderByNullLast($array, $order)
    {
        if (!is_array($array)) {
            $array = $array->toArray();
        }
        usort($array, function ($a, $b) use ($order) {
            if (null === $a->getPosition())
                return 1;
            if (null === $b->getPosition())
                return -1;

            if (strtoupper($order) == "DESC") {
                if ($a->getPosition() > $b->getPosition())
                    return -1;
                if ($b->getPosition() > $a->getPosition())
                    return 1;
            } else {
                if ($a->getPosition() < $b->getPosition())
                    return -1;
                if ($b->getPosition() < $a->getPosition())
                    return 1;
            }
        });

        return $array;
    }

    private function removeMultipleFunctions($collection)
    {
        foreach ($collection as $key => $filmPerson) {
            if ($filmPerson->getFunctions()->count() > 1) {
                $count = 0;
                foreach ($collection as $key2 => $filmPerson2) {
                    if ($filmPerson->getPerson() && $filmPerson2->getPerson() && $filmPerson->getPerson()->getId() == $filmPerson2->getPerson()->getId()) {
                        foreach ($collection->get($key2)->getFunctions() as $keyFunction => $function) {
                            if ($keyFunction != $count) {
                                $collection->get($key2)->getFunctions()->remove($keyFunction);
                            }
                        }
                        $collection->get($key2)->setFunctions($this->orderCollection($collection->get($key2)->getFunctions()));
                        $count++;
                    }
                }
            }

            if ($collection->get($key)->getFunctions()->count() > 0) {
                $collection->get($key)->setPosition($collection->get($key)->getFunctions()->get(0)->getPosition());
            }
        }

        return $collection;
    }

    private function orderCollection($collection)
    {
        $collectionOrdered = new ArrayCollection();
        foreach ($collection as $row) {
            $collectionOrdered->add($row);
        }

        return $collectionOrdered;
    }


    /**
     * Set id
     *
     * @param string $id
     * @return FilmFilm
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

    /**
     * Set slug
     *
     * @param string $slug
     * @return Settings
     */
    public function setSlug($slug)
    {
        $this->slug = $slug;

        return $this;
    }

    /**
     * Get slug
     *
     * @return string
     */
    public function getSlug()
    {
        return $this->slug;
    }

    /**
     * Set titleVO
     *
     * @param string $titleVO
     * @return FilmFilm
     */
    public function setTitleVO($titleVO)
    {
        $this->titleVO = $titleVO;

        return $this;
    }

    /**
     * Get titleVO
     *
     * @return string
     */
    public function getTitleVO()
    {
        return $this->titleVO;
    }

    /**
     * Set titleVF
     *
     * @param string $titleVF
     * @return FilmFilm
     */
    public function setTitleVF($titleVF)
    {
        $this->titleVF = $titleVF;

        return $this;
    }

    /**
     * Get titleVF
     *
     * @return string
     */
    public function getTitleVF()
    {
        return $this->titleVF;
    }

    /**
     * Set titleVA
     *
     * @param string $titleVA
     * @return FilmFilm
     */
    public function setTitleVA($titleVA)
    {
        $this->titleVA = $titleVA;

        return $this;
    }

    /**
     * Get titleVA
     *
     * @return string
     */
    public function getTitleVA()
    {
        return $this->titleVA;
    }

    /**
     * Set courtlong
     *
     * @param string $courtlong
     * @return FilmFilm
     */
    public function setCourtlong($courtlong)
    {
        $this->courtlong = $courtlong;

        return $this;
    }

    /**
     * Get courtlong
     *
     * @return string
     */
    public function getCourtlong()
    {
        return $this->courtlong;
    }

    /**
     * Set duration
     *
     * @param string $duration
     * @return FilmFilm
     */
    public function setDuration($duration)
    {
        $this->duration = $duration;

        return $this;
    }

    /**
     * Get duration
     *
     * @return string
     */
    public function getDuration()
    {
        return $this->duration;
    }

    /**
     * Set filmFirst
     *
     * @param string $filmFirst
     * @return FilmFilm
     */
    public function setFilmFirst($filmFirst)
    {
        $this->filmFirst = $filmFirst;

        return $this;
    }

    /**
     * Get filmFirst
     *
     * @return string
     */
    public function getFilmFirst()
    {
        return $this->filmFirst;
    }

    /**
     * Set worldFirst
     *
     * @param string $worldFirst
     * @return FilmFilm
     */
    public function setWorldFirst($worldFirst)
    {
        $this->worldFirst = $worldFirst;

        return $this;
    }

    /**
     * Get worldFirst
     *
     * @return string
     */
    public function getWorldFirst()
    {
        return $this->worldFirst;
    }

    /**
     * Set productionYear
     *
     * @param string $productionYear
     * @return FilmFilm
     */
    public function setProductionYear($productionYear)
    {
        $this->productionYear = $productionYear;

        return $this;
    }

    /**
     * Get productionYear
     *
     * @return string
     */
    public function getProductionYear()
    {
        return $this->productionYear;
    }

    /**
     * Set genre
     *
     * @param string $genre
     * @return FilmFilm
     */
    public function setGenre($genre)
    {
        $this->genre = $genre;

        return $this;
    }

    /**
     * Get genre
     *
     * @return string
     */
    public function getGenre()
    {
        return $this->genre;
    }

    /**
     * Set section
     *
     * @param string $section
     * @return FilmFilm
     */
    public function setSection($section)
    {
        $this->section = $section;

        return $this;
    }

    /**
     * Get section
     *
     * @return string
     */
    public function getSection()
    {
        return $this->section;
    }

    /**
     * Set synopsisVf
     *
     * @param string $synopsisVf
     * @return FilmFilm
     */
    public function setSynopsisVf($synopsisVf)
    {
        $this->synopsisVf = $synopsisVf;

        return $this;
    }

    /**
     * Get synopsisVf
     *
     * @return string
     */
    public function getSynopsisVf()
    {
        return $this->synopsisVf;
    }

    /**
     * Set synopsisVa
     *
     * @param string $synopsisVa
     * @return FilmFilm
     */
    public function setSynopsisVa($synopsisVa)
    {
        $this->synopsisVa = $synopsisVa;

        return $this;
    }

    /**
     * Get synopsisVa
     *
     * @return string
     */
    public function getSynopsisVa()
    {
        return $this->synopsisVa;
    }

    /**
     * Set dialogueVf
     *
     * @param string $dialogueVf
     * @return FilmFilm
     */
    public function setDialogueVf($dialogueVf)
    {
        $this->dialogueVf = $dialogueVf;

        return $this;
    }

    /**
     * Get dialogueVf
     *
     * @return string
     */
    public function getDialogueVf()
    {
        return $this->dialogueVf;
    }

    /**
     * Set dialogueVa
     *
     * @param string $dialogueVa
     * @return FilmFilm
     */
    public function setDialogueVa($dialogueVa)
    {
        $this->dialogueVa = $dialogueVa;

        return $this;
    }

    /**
     * Get dialogueVa
     *
     * @return string
     */
    public function getDialogueVa()
    {
        return $this->dialogueVa;
    }

    /**
     * Set previousEvent
     *
     * @param string $previousEvent
     * @return FilmFilm
     */
    public function setPreviousEvent($previousEvent)
    {
        $this->previousEvent = $previousEvent;

        return $this;
    }

    /**
     * Get previousEvent
     *
     * @return string
     */
    public function getPreviousEvent()
    {
        return $this->previousEvent;
    }

    /**
     * Set exploitationCountries
     *
     * @param string $exploitationCountries
     * @return FilmFilm
     */
    public function setExploitationCountries($exploitationCountries)
    {
        $this->exploitationCountries = $exploitationCountries;

        return $this;
    }

    /**
     * Get exploitationCountries
     *
     * @return string
     */
    public function getExploitationCountries()
    {
        return $this->exploitationCountries;
    }

    /**
     * Set internetDisplayed
     *
     * @param string $internetDisplayed
     * @return FilmFilm
     */
    public function setInternetDisplayed($internetDisplayed)
    {
        $this->internetDisplayed = $internetDisplayed;

        return $this;
    }

    /**
     * Get internetDisplayed
     *
     * @return string
     */
    public function getInternetDisplayed()
    {
        return $this->internetDisplayed;
    }

    /**
     * Set internet
     *
     * @param string $internet
     * @return FilmFilm
     */
    public function setInternet($internet)
    {
        $this->internet = $internet;

        return $this;
    }

    /**
     * Get internet
     *
     * @return string
     */
    public function getInternet()
    {
        return $this->internet;
    }

    /**
     * Set restaurantOwner
     *
     * @param string $restaurantOwner
     * @return FilmFilm
     */
    public function setRestaurantOwner($restaurantOwner)
    {
        $this->restaurantOwner = $restaurantOwner;

        return $this;
    }

    /**
     * Get restaurantOwner
     *
     * @return string
     */
    public function getRestaurantOwner()
    {
        return $this->restaurantOwner;
    }

    /**
     * Set restorationType
     *
     * @param string $restorationType
     * @return FilmFilm
     */
    public function setRestorationType($restorationType)
    {
        $this->restorationType = $restorationType;

        return $this;
    }

    /**
     * Get restorationType
     *
     * @return string
     */
    public function getRestorationType()
    {
        return $this->restorationType;
    }

    /**
     * Set noDialog
     *
     * @param string $noDialog
     * @return FilmFilm
     */
    public function setNoDialog($noDialog)
    {
        $this->noDialog = $noDialog;

        return $this;
    }

    /**
     * Get noDialog
     *
     * @return string
     */
    public function getNoDialog()
    {
        return $this->noDialog;
    }

    /**
     * Set color
     *
     * @param string $color
     * @return FilmFilm
     */
    public function setColor($color)
    {
        $this->color = $color;

        return $this;
    }

    /**
     * Get color
     *
     * @return string
     */
    public function getColor()
    {
        return $this->color;
    }

    /**
     * Set festival
     *
     * @param \Base\CoreBundle\Entity\FilmFestival $festival
     * @return $this
     */
    public function setFestival(\Base\CoreBundle\Entity\FilmFestival $festival = null)
    {
        $this->festival = $festival;

        return $this;
    }

    /**
     * Get festival
     *
     * @return \Base\CoreBundle\Entity\FilmFestival
     */
    public function getFestival()
    {
        return $this->festival;
    }

    /**
     * Set website
     *
     * @param string $website
     * @return FilmFilm
     */
    public function setWebsite($website)
    {
        $this->website = $website;

        return $this;
    }

    /**
     * Get website
     *
     * @return string
     */
    public function getWebsite()
    {
        return $this->website;
    }

    /**
     * Set gala
     *
     * @param string $gala
     * @return FilmFilm
     */
    public function setGala($gala)
    {
        $this->gala = $gala;

        return $this;
    }

    /**
     * Get gala
     *
     * @return string
     */
    public function getGala()
    {
        return $this->gala;
    }

    /**
     * Set subSelectionVF
     *
     * @param string $subSelectionVF
     * @return FilmFilm
     */
    public function setSubSelectionVF($subSelectionVF)
    {
        $this->subSelectionVF = $subSelectionVF;

        return $this;
    }

    /**
     * Get subSelectionVF
     *
     * @return string
     */
    public function getSubSelectionVF()
    {
        return $this->subSelectionVF;
    }

    /**
     * Set subSelectionVA
     *
     * @param string $subSelectionVA
     * @return FilmFilm
     */
    public function setSubSelectionVA($subSelectionVA)
    {
        $this->subSelectionVA = $subSelectionVA;

        return $this;
    }

    /**
     * Get subSelectionVA
     *
     * @return string
     */
    public function getSubSelectionVA()
    {
        return $this->subSelectionVA;
    }

    /**
     * Add minorProductions
     *
     * @param \Base\CoreBundle\Entity\FilmMinorProduction $minorProductions
     * @return FilmFilm
     */
    public function addMinorProduction(\Base\CoreBundle\Entity\FilmMinorProduction $minorProductions)
    {
        if ($this->minorProductions->contains($minorProductions)) {
            return;
        }

        $this->minorProductions[] = $minorProductions;

        return $this;
    }

    /**
     * Remove minorProductions
     *
     * @param \Base\CoreBundle\Entity\FilmMinorProduction $minorProductions
     */
    public function removeMinorProduction(\Base\CoreBundle\Entity\FilmMinorProduction $minorProductions)
    {
        if (!$this->minorProductions->contains($minorProductions)) {
            return;
        }

        $this->minorProductions->removeElement($minorProductions);
    }

    /**
     * Get minorProductions
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getMinorProductions()
    {
        return $this->minorProductions;
    }

    /**
     * Add countries
     *
     * @param \Base\CoreBundle\Entity\FilmFilmCountry $countries
     * @return FilmFilm
     */
    public function addCountry(\Base\CoreBundle\Entity\FilmFilmCountry $countries)
    {
        if ($this->countries->contains($countries)) {
            return;
        }

        $countries->setFilm($this);
        $this->countries[] = $countries;

        return $this;
    }

    /**
     * Remove countries
     *
     * @param \Base\CoreBundle\Entity\FilmFilmCountry $countries
     */
    public function removeCountry(\Base\CoreBundle\Entity\FilmFilmCountry $countries)
    {
        if (!$this->countries->contains($countries)) {
            return;
        }

        $this->countries->removeElement($countries);
    }

    /**
     * Get countries
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getCountries()
    {
        return $this->countries;
    }

    /**
     * Add languages
     *
     * @param \Base\CoreBundle\Entity\FilmLanguage $languages
     * @return FilmFilm
     */
    public function addLanguage(\Base\CoreBundle\Entity\FilmLanguage $languages)
    {
        if ($this->languages->contains($languages)) {
            return;
        }

        $this->languages[] = $languages;

        return $this;
    }

    /**
     * Remove languages
     *
     * @param \Base\CoreBundle\Entity\FilmLanguage $languages
     */
    public function removeLanguage(\Base\CoreBundle\Entity\FilmLanguage $languages)
    {
        if (!$this->languages->contains($languages)) {
            return;
        }

        $this->languages->removeElement($languages);
    }

    /**
     * Get languages
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getLanguages()
    {
        return $this->languages;
    }

    /**
     * Add medias
     *
     * @param \Base\CoreBundle\Entity\FilmFilmMedia $medias
     * @return FilmFilm
     */
    public function addMedia(\Base\CoreBundle\Entity\FilmFilmMedia $medias)
    {
        if ($this->medias->contains($medias)) {
            return;
        }
        $medias->setFilm($this);

        $this->medias[] = $medias;

        return $this;
    }

    /**
     * Remove medias
     *
     * @param \Base\CoreBundle\Entity\FilmFilmMedia $medias
     */
    public function removeMedia(\Base\CoreBundle\Entity\FilmFilmMedia $medias)
    {
        if (!$this->medias->contains($medias)) {
            return;
        }

        $this->medias->removeElement($medias);
    }

    /**
     * Get medias
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getMedias()
    {
        return $this->medias;
    }

    public function hasMedia($id)
    {
        foreach ($this->medias as $media) {
            if ($media->getMedia() && $media->getMedia()->getId() == $id) {
                return $media;
            }
        }

        return null;
    }

    /**
     * Set directorFirst
     *
     * @param boolean $directorFirst
     * @return FilmFilm
     */
    public function setDirectorFirst($directorFirst)
    {
        $this->directorFirst = $directorFirst;

        return $this;
    }

    /**
     * Get directorFirst
     *
     * @return boolean
     */
    public function getDirectorFirst()
    {
        return $this->directorFirst;
    }

    /**
     * Set restored
     *
     * @param boolean $restored
     * @return FilmFilm
     */
    public function setRestored($restored)
    {
        $this->restored = $restored;

        return $this;
    }

    /**
     * Get restored
     *
     * @return boolean
     */
    public function getRestored()
    {
        return $this->restored;
    }

    /**
     * Set titleVOAlphabet
     *
     * @param string $titleVOAlphabet
     * @return FilmFilm
     */
    public function setTitleVOAlphabet($titleVOAlphabet)
    {
        $this->titleVOAlphabet = $titleVOAlphabet;

        return $this;
    }

    /**
     * Get titleVOAlphabet
     *
     * @return string
     */
    public function getTitleVOAlphabet()
    {
        return $this->titleVOAlphabet;
    }

    /**
     * Set castingCommentary
     *
     * @param string $castingCommentary
     * @return FilmFilm
     */
    public function setCastingCommentary($castingCommentary)
    {
        $this->castingCommentary = $castingCommentary;

        return $this;
    }

    /**
     * Get commentaryCasting
     *
     * @return string
     */
    public function getCastingCommentary()
    {
        return $this->castingCommentary;
    }

    /**
     * Set galaId
     *
     * @param integer $galaId
     * @return FilmFilm
     */
    public function setGalaId($galaId)
    {
        $this->galaId = $galaId;

        return $this;
    }

    /**
     * Get galaId
     *
     * @return integer
     */
    public function getGalaId()
    {
        return $this->galaId;
    }

    /**
     * Set galaName
     *
     * @param string $galaName
     * @return FilmFilm
     */
    public function setGalaName($galaName)
    {
        $this->galaName = $galaName;

        return $this;
    }

    /**
     * Get galaName
     *
     * @return string
     */
    public function getGalaName()
    {
        return $this->galaName;
    }

    /**
     * Set selection
     *
     * @param \Base\CoreBundle\Entity\FilmSelection $selection
     * @return FilmFilm
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
     * Add persons
     *
     * @param \Base\CoreBundle\Entity\FilmFilmPerson $persons
     * @return FilmFilm
     */
    public function addPerson(\Base\CoreBundle\Entity\FilmFilmPerson $persons)
    {
        if ($this->persons->contains($persons)) {
            return;
        }

        $persons->setFilm($this);
        $this->persons[] = $persons;

        return $this;
    }

    /**
     * Remove persons
     *
     * @param \Base\CoreBundle\Entity\FilmFilmPerson $persons
     */
    public function removePerson(\Base\CoreBundle\Entity\FilmFilmPerson $persons)
    {
        if (!$this->persons->contains($persons)) {
            return;
        }

        $this->persons->removeElement($persons);
    }

    /**
     * Get persons
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getPersons()
    {
        return $this->persons;
    }

    /**
     * @param ArrayCollection $persons
     * @return $this
     */
    public function setPersons($persons)
    {
        $this->persons = $persons;
        return $this;
    }

    public function getPerson($id)
    {
        foreach ($this->persons as $person) {
            if ($person->getId() == $id) {
                return $person;
            }
        }

        return null;

    }

    /**
     * Add contacts
     *
     * @param \Base\CoreBundle\Entity\FilmContact $contacts
     * @return FilmFilm
     */
    public function addContact(\Base\CoreBundle\Entity\FilmContact $contacts)
    {
        if ($this->contacts->contains($contacts)) {
            return;
        }

        $this->contacts[] = $contacts;

        return $this;
    }

    /**
     * Remove contacts
     *
     * @param \Base\CoreBundle\Entity\FilmContact $contacts
     */
    public function removeContact(\Base\CoreBundle\Entity\FilmContact $contacts)
    {
        if (!$this->contacts->contains($contacts)) {
            return;
        }

        $this->contacts->removeElement($contacts);
    }

    /**
     * Get contacts
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getContacts()
    {
        $collection = $this->orderByNullLast($this->contacts, 'ASC');

        return $collection;
    }

    /**
     * Get contacts
     *
     * @VirtualProperty()
     * @Groups({
     *     "film_show"
     * })
     * @return array
     */
    public function getOrdoredContacts()
    {
        $contacts = $this->getContacts();

        $collection = [];

        $translation = $this->selectionSection ? $this->selectionSection->findTranslationByLocale('fr') : null;

        if ($translation && mb_strtoupper($translation->getName()) == 'CINÉFONDATION') {
            $order = [
                FilmContactInterface::TYPE_PRODUCTION_COMPANY,
                FilmContactInterface::TYPE_FRENCH_DISTRIBUTION,
                FilmContactInterface::TYPE_SCHOOL,
            ];
        } else {
            $order = [
                FilmContactInterface::TYPE_PRODUCTION_COMPANY,
                FilmContactInterface::TYPE_MINOR_PRODUCTION_COMPANY,
                FilmContactInterface::TYPE_FRENCH_DISTRIBUTION,
                FilmContactInterface::TYPE_FRENCH_PRESS_COMPANY,
                FilmContactInterface::TYPE_INTERNATIONAL_PRESS_COMPANY,
                FilmContactInterface::TYPE_INTERNATIONAL_SELLING,
            ];
        }

        foreach ($order as $type) {
            foreach ($contacts as $contact) {
                if ($contact instanceof FilmContact) {
                    if ((integer)$contact->getType() == $type) {
                        $collection[] = $contact;
                    }
                }
            }
        }

        return $collection;
    }

    /**
     * Add awards
     *
     * @param \Base\CoreBundle\Entity\FilmAwardAssociation $awards
     * @return FilmFilm
     */
    public function addAward(\Base\CoreBundle\Entity\FilmAwardAssociation $awards)
    {
        $this->awards[] = $awards;

        return $this;
    }

    /**
     * Remove awards
     *
     * @param \Base\CoreBundle\Entity\FilmAwardAssociation $awards
     */
    public function removeAward(\Base\CoreBundle\Entity\FilmAwardAssociation $awards)
    {
        $this->awards->removeElement($awards);
    }

    /**
     * Get awards
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getAwards()
    {
        return $this->awards;
    }

    /**
     * Add projectionProgrammationFilms
     *
     * @param \Base\CoreBundle\Entity\FilmProjectionProgrammationFilm $projectionProgrammationFilms
     * @return FilmFilm
     */
    public function addProjectionProgrammationFilm(\Base\CoreBundle\Entity\FilmProjectionProgrammationFilm $projectionProgrammationFilms)
    {
        $this->projectionProgrammationFilms[] = $projectionProgrammationFilms;

        return $this;
    }

    /**
     * Remove projectionProgrammationFilms
     *
     * @param \Base\CoreBundle\Entity\FilmProjectionProgrammationFilm $projectionProgrammationFilms
     */
    public function removeProjectionProgrammationFilm(\Base\CoreBundle\Entity\FilmProjectionProgrammationFilm $projectionProgrammationFilms)
    {
        $this->projectionProgrammationFilms->removeElement($projectionProgrammationFilms);
    }

    /**
     * Get projectionProgrammationFilms
     *
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getProjectionProgrammationFilms()
    {
        return $this->projectionProgrammationFilms;
    }

    /**
     * Get projectionProgrammationFilms
     *
     * @VirtualProperty()
     * @Groups({
     *     "film_list",
     *     "film_show"
     * })
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getProjections()
    {
        $now = time();

        $days = [];
        $typeUCR = false;
        if (!isset($_GET['v'])) {
            $exclude = ['Séance de presse', 'Conférence de presse'];
        } else {
            $exclude = [];
        }

        foreach ($this->projectionProgrammationFilms as $projection) {
            if ($projection instanceof FilmProjectionProgrammationFilm) {
                $programSection = $projection->getProjection()->getProgrammationSection();
                $cond = $programSection != 'Cinéfondation';
                $cond = $cond && $programSection != 'En Compétition - Courts métrages';
                if ($cond || $this->api2017) {
                    $typeUCR = false;
                    if ($this->getSelectionSection()->getId() == FilmSelectionSectionInterface::FILM_SELECTION_SECTION_UNCERTAINREGARD) {
                        $typeUCR = true;
                    }
                    if ($projection->getProjection()->getStartsAt()->format('H') < 4) {
                        $tomorrow = clone $projection->getProjection()->getStartsAt();
                        $tomorrow->add(date_interval_create_from_date_string('1 day'));
                        $key = $tomorrow->getTimestamp();
                    } else {
                        $key = $projection->getProjection()->getStartsAt()->getTimestamp();
                    }
                    if ($key > $now) {
                        $dayKey = $projection->getProjection()->getStartsAt()->format('Y-m-d');
                        $newTime = clone $projection->getProjection()->getStartsAt();
                        $newTime->setTime(3, 0, 0);
                        if (!array_key_exists($dayKey, $days)) {
                            $days[$dayKey]['date'] = $newTime->getTimestamp();
                            $days[$dayKey]['projections'] = [];
                        }
                        if (!in_array($projection->getProjection()->getType(), $exclude)) {
                            $days[$dayKey]['projections'][$key] = $projection->getProjection();
                        }
                    }
                }
            }
        }

        foreach ($days as $key => $projection) {
            $tempDayProjections = $days[$key]['projections'];
            ksort($tempDayProjections);
            $days[$key]['projections'] = array_values($tempDayProjections);
        }
        if ($typeUCR) {
            return array_values(array_reverse($days));
        } else {
            return array_values($days);
        }
    }

    /**
     * Get projectionProgrammationFilms
     *
     * @VirtualProperty()
     * @Groups({
     *     "film_show"
     * })
     */
    public function getIsOpenningFilm()
    {
        foreach ($this->projectionProgrammationFilms as $projection) {
            if ($projection instanceof FilmProjectionProgrammationFilm) {
                if ($projection->getType()->getId() == 3 || $this->getGalaName() != '') {
                    return true;
                }
            }
        }
        return false;
    }

    /**
     * Get projectionProgrammationFilms
     *
     * @VirtualProperty()
     * @Groups({
     *     "film_show"
     * })
     */
    public function getIsClosingFilm()
    {
        foreach ($this->projectionProgrammationFilms as $projection) {
            if ($projection instanceof FilmProjectionProgrammationFilm) {
                if ($projection->getType()->getId() == 4) {
                    return true;
                }
            }
        }
        return false;
    }

    /**
     * Add projectionProgrammationFilmsList
     *
     * @param \Base\CoreBundle\Entity\FilmProjectionProgrammationFilmList $projectionProgrammationFilmsList
     * @return FilmFilm
     */
    public function addProjectionProgrammationFilmsList(\Base\CoreBundle\Entity\FilmProjectionProgrammationFilmList $projectionProgrammationFilmsList)
    {
        $this->projectionProgrammationFilmsList[] = $projectionProgrammationFilmsList;

        return $this;
    }

    /**
     * Remove projectionProgrammationFilmsList
     *
     * @param \Base\CoreBundle\Entity\FilmProjectionProgrammationFilmList $projectionProgrammationFilmsList
     */
    public function removeProjectionProgrammationFilmsList(\Base\CoreBundle\Entity\FilmProjectionProgrammationFilmList $projectionProgrammationFilmsList)
    {
        $this->projectionProgrammationFilmsList->removeElement($projectionProgrammationFilmsList);
    }

    /**
     * Get projectionProgrammationFilmsList
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getProjectionProgrammationFilmsList()
    {
        return $this->projectionProgrammationFilmsList;
    }


    /**
     * Set publishedAt
     *
     * @param \DateTime $publishedAt
     * @return FilmFilm
     */
    public function setPublishedAt($publishedAt)
    {
        $this->publishedAt = $publishedAt;

        return $this;
    }

    /**
     * Get publishedAt
     *
     * @return \DateTime
     */
    public function getPublishedAt()
    {
        return $this->publishedAt;
    }

    /**
     * Set selectionSection
     *
     * @param \Base\CoreBundle\Entity\FilmSelectionSection $selectionSection
     * @return FilmFilm
     */
    public function setSelectionSection(\Base\CoreBundle\Entity\FilmSelectionSection $selectionSection = null)
    {
        $this->selectionSection = $selectionSection;

        return $this;
    }

    /**
     * Get selectionSection
     *
     * @return \Base\CoreBundle\Entity\FilmSelectionSection
     */
    public function getSelectionSection()
    {
        return $this->selectionSection;
    }

    /**
     * Add associatedNews
     *
     * @param \Base\CoreBundle\Entity\NewsFilmFilmAssociated $associatedNews
     * @return FilmFilm
     */
    public function addAssociatedNew(\Base\CoreBundle\Entity\NewsFilmFilmAssociated $associatedNews)
    {
        $associatedNews->setAssociation($this);
        $this->associatedNews[] = $associatedNews;

        return $this;
    }

    /**
     * Remove associatedNews
     *
     * @param \Base\CoreBundle\Entity\NewsFilmFilmAssociated $associatedNews
     */
    public function removeAssociatedNew(\Base\CoreBundle\Entity\NewsFilmFilmAssociated $associatedNews)
    {
        $this->associatedNews->removeElement($associatedNews);
    }

    /**
     * Get associatedNews
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getAssociatedNews()
    {
        return $this->associatedNews;
    }

    /**
     * Add ccm associatedNews
     *
     * @param CcmNewsFilmFilmAssociated $associatedNews
     * @return FilmFilm
     */
    public function addAssociatedCcmNew(CcmNewsFilmFilmAssociated $associatedNews)
    {
        $associatedNews->setAssociation($this);
        $this->associatedCcmNews[] = $associatedNews;

        return $this;
    }

    /**
     * Remove ccm associatedNews
     *
     * @param CcmNewsFilmFilmAssociated $associatedNews
     */
    public function removeAssociatedCcmNew(CcmNewsFilmFilmAssociated $associatedNews)
    {
        $this->associatedCcmNews->removeElement($associatedNews);
    }

    /**
     * Get ccm associatedNews
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getAssociatedCcmNews()
    {
        return $this->associatedCcmNews;
    }

    /**
     * Add associatedMediaVideos
     *
     * @param \Base\CoreBundle\Entity\MediaVideoFilmFilmAssociated $associatedMediaVideos
     * @return FilmFilm
     */
    public function addAssociatedMediaVideo(\Base\CoreBundle\Entity\MediaVideoFilmFilmAssociated $associatedMediaVideos)
    {
        $associatedMediaVideos->setAssociation($this);
        $this->associatedMediaVideos[] = $associatedMediaVideos;

        return $this;
    }

    /**
     * Remove associatedMediaVideos
     *
     * @param \Base\CoreBundle\Entity\MediaVideoFilmFilmAssociated $associatedMediaVideos
     */
    public function removeAssociatedMediaVideo(\Base\CoreBundle\Entity\MediaVideoFilmFilmAssociated $associatedMediaVideos)
    {
        $this->associatedMediaVideos->removeElement($associatedMediaVideos);
    }

    /**
     * Get associatedMediaVideos
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getAssociatedMediaVideos()
    {
        return $this->associatedMediaVideos;
    }

    /**
     * Get associatedMediaVideos
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getPublishedAssociatedMediaVideos($locale)
    {
        $collection = [];
        foreach ($this->associatedMediaVideos as $associatedMediaVideo) {
            if ($associatedMediaVideo) {
                $mediaVideo = $associatedMediaVideo->getMediaVideo();
                if ($mediaVideo) {
                    $fr = $mediaVideo->findTranslationByLocale('fr');
                    $trans = $mediaVideo->findTranslationByLocale($locale);

                    if ($trans && $fr) {
                        $status = $fr->getStatus() === MediaVideoTranslation::STATUS_PUBLISHED;
                        if ($trans->getLocale() != $fr->getLocale()) {
                            $status = $status;
                        }
                        $encoded = $trans->getJobMp4State() == MediaVideoTranslation::ENCODING_STATE_READY;
                        $hasURL = $trans->getWebmUrl() && $trans->getMp4Url();
                        if ($status && $encoded && $hasURL) {
                            if ($mediaVideo->getPublishedAt()) {

                                $key = $mediaVideo->getPublishedAt()->getTimestamp() . '-' . $associatedMediaVideo->getId();
                                $collection[$key] = $associatedMediaVideo;
                            }
                        }
                    }
                }
            }
        }
        ksort($collection);
        return new ArrayCollection(array_values($collection));
    }

    /**
     * Add associatedMediaAudios
     *
     * @param \Base\CoreBundle\Entity\MediaAudioFilmFilmAssociated $associatedMediaAudios
     * @return FilmFilm
     */
    public function addAssociatedMediaAudio(\Base\CoreBundle\Entity\MediaAudioFilmFilmAssociated $associatedMediaAudios)
    {
        $associatedMediaAudios->setAssociation($this);
        $this->associatedMediaAudios[] = $associatedMediaAudios;

        return $this;
    }

    /**
     * Remove associatedMediaAudios
     *
     * @param \Base\CoreBundle\Entity\MediaAudioFilmFilmAssociated $associatedMediaAudios
     */
    public function removeAssociatedMediaAudio(\Base\CoreBundle\Entity\MediaAudioFilmFilmAssociated $associatedMediaAudios)
    {
        $this->associatedMediaAudios->removeElement($associatedMediaAudios);
    }

    /**
     * Get associatedMediaAudios
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getAssociatedMediaAudios()
    {
        return $this->associatedMediaAudios;
    }

    /**
     * Add associatedStatement
     *
     * @param \Base\CoreBundle\Entity\StatementFilmFilmAssociated $associatedStatement
     * @return FilmFilm
     */
    public function addAssociatedStatement(\Base\CoreBundle\Entity\StatementFilmFilmAssociated $associatedStatement)
    {
        $associatedStatement->setAssociation($this);
        $this->associatedStatement[] = $associatedStatement;

        return $this;
    }

    /**
     * Remove associatedStatement
     *
     * @param \Base\CoreBundle\Entity\StatementFilmFilmAssociated $associatedStatement
     */
    public function removeAssociatedStatement(\Base\CoreBundle\Entity\StatementFilmFilmAssociated $associatedStatement)
    {
        $this->associatedStatement->removeElement($associatedStatement);
    }

    /**
     * Get associatedStatement
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getAssociatedStatement()
    {
        return $this->associatedStatement;
    }

    /**
     * Add associatedInfo
     *
     * @param \Base\CoreBundle\Entity\InfoFilmFilmAssociated $associatedInfo
     * @return FilmFilm
     */
    public function addAssociatedInfo(\Base\CoreBundle\Entity\InfoFilmFilmAssociated $associatedInfo)
    {
        $associatedInfo->setAssociation($this);
        $this->associatedInfo[] = $associatedInfo;

        return $this;
    }

    /**
     * Remove associatedInfo
     *
     * @param \Base\CoreBundle\Entity\InfoFilmFilmAssociated $associatedInfo
     */
    public function removeAssociatedInfo(\Base\CoreBundle\Entity\InfoFilmFilmAssociated $associatedInfo)
    {
        $this->associatedInfo->removeElement($associatedInfo);
    }

    /**
     * Get associatedInfo
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getAssociatedInfo()
    {
        return $this->associatedInfo;
    }

    /**
     * Add associatedNews
     *
     * @param \Base\CoreBundle\Entity\NewsFilmFilmAssociated $associatedNews
     * @return FilmFilm
     */
    public function addAssociatedNews(\Base\CoreBundle\Entity\NewsFilmFilmAssociated $associatedNews)
    {
        $associatedNews->setAssociation($this);
        $this->associatedNews[] = $associatedNews;

        return $this;
    }

    /**
     * Remove associatedNews
     *
     * @param \Base\CoreBundle\Entity\NewsFilmFilmAssociated $associatedNews
     */
    public function removeAssociatedNews(\Base\CoreBundle\Entity\NewsFilmFilmAssociated $associatedNews)
    {
        $this->associatedNews->removeElement($associatedNews);
    }

    /**
     * Set videoMain
     *
     * @param \Base\CoreBundle\Entity\MediaVideo $videoMain
     * @return FilmFilm
     */
    public function setVideoMain(\Base\CoreBundle\Entity\MediaVideo $videoMain = null)
    {
        $this->videoMain = $videoMain;

        return $this;
    }

    /**
     * Get videoMain
     *
     * @return \Base\CoreBundle\Entity\MediaVideo
     */
    public function getVideoMain()
    {
        return $this->videoMain;
    }

    /**
     * Set imageMain
     *
     * @param \Base\CoreBundle\Entity\MediaImageSimple $imageMain
     * @return FilmFilm
     */
    public function setImageMain(\Base\CoreBundle\Entity\MediaImageSimple $imageMain = null)
    {
        $this->imageMain = $imageMain;

        return $this;
    }

    /**
     * Get imageMain
     *
     * @return \Base\CoreBundle\Entity\MediaImageSimple
     */
    public function getImageMain()
    {
        return $this->imageMain;
    }

    public function getApiImageMain()
    {
        return null;
    }

    /**
     * Set imageCover
     *
     * @param \Base\CoreBundle\Entity\MediaImageSimple $imageCover
     * @return FilmFilm
     */
    public function setImageCover(\Base\CoreBundle\Entity\MediaImageSimple $imageCover = null)
    {
        $this->imageCover = $imageCover;

        return $this;
    }

    /**
     * Get imageCover
     *
     * @return \Base\CoreBundle\Entity\MediaImageSimple
     */
    public function getImageCover()
    {
        return $this->imageCover;
    }

    /**
     * Add tags
     *
     * @param \Base\CoreBundle\Entity\FilmFilmTag $tags
     * @return FilmFilm
     */
    public function addTag(\Base\CoreBundle\Entity\FilmFilmTag $tags)
    {
        $tags->setFilm($this);
        $this->tags[] = $tags;

        return $this;
    }

    /**
     * Remove tags
     *
     * @param \Base\CoreBundle\Entity\FilmFilmTag $tags
     */
    public function removeTag(\Base\CoreBundle\Entity\FilmFilmTag $tags)
    {
        $this->tags->removeElement($tags);
    }

    /**
     * Get tags
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getTags()
    {
        return $this->tags;
    }

    /**
     * Set facebook
     *
     * @param string $facebook
     * @return FilmFilm
     */
    public function setFacebook($facebook)
    {
        $this->facebook = $facebook;

        return $this;
    }

    /**
     * Get facebook
     *
     * @return string
     */
    public function getFacebook()
    {
        return $this->facebook;
    }

    /**
     * Set twitter
     *
     * @param string $twitter
     * @return FilmFilm
     */
    public function setTwitter($twitter)
    {
        $this->twitter = $twitter;

        return $this;
    }

    /**
     * Get twitter
     *
     * @return string
     */
    public function getTwitter()
    {
        return $this->twitter;
    }

    /**
     * Set selectionSubsection
     *
     * @param \Base\CoreBundle\Entity\FilmSelectionSubsection $selectionSubsection
     * @return FilmFilm
     */
    public function setSelectionSubsection(\Base\CoreBundle\Entity\FilmSelectionSubsection $selectionSubsection = null)
    {
        $this->selectionSubsection = $selectionSubsection;

        return $this;
    }

    /**
     * Get selectionSubsection
     *
     * @return \Base\CoreBundle\Entity\FilmSelectionSubsection
     */
    public function getSelectionSubsection()
    {
        return $this->selectionSubsection;
    }

    /**
     * Add news
     *
     * @param \Base\CoreBundle\Entity\News $news
     * @return FilmFilm
     */
    public function addNews(\Base\CoreBundle\Entity\News $news)
    {
        $this->news[] = $news;

        return $this;
    }

    /**
     * Remove news
     *
     * @param \Base\CoreBundle\Entity\News $news
     */
    public function removeNews(\Base\CoreBundle\Entity\News $news)
    {
        $news->setAssociatedFilm(null);
        $this->news->removeElement($news);
    }

    /**
     * Get news
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getNews()
    {
        return $this->news;
    }

    /**
     * Add selfkitImages
     *
     * @param \Application\Sonata\MediaBundle\Entity\Media $selfkitImages
     * @return FilmFilm
     */
    public function addSelfkitImage(\Application\Sonata\MediaBundle\Entity\Media $selfkitImages)
    {
        $this->selfkitImages[] = $selfkitImages;

        return $this;
    }

    /**
     * Remove selfkitImages
     *
     * @param \Application\Sonata\MediaBundle\Entity\Media $selfkitImages
     */
    public function removeSelfkitImage(\Application\Sonata\MediaBundle\Entity\Media $selfkitImages)
    {
        $this->selfkitImages->removeElement($selfkitImages);
    }

    /**
     * Get selfkitImages
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getSelfkitImages()
    {
        return $this->selfkitImages;
    }

    /**
     * Add selfkitPdfFiles
     *
     * @param \Application\Sonata\MediaBundle\Entity\Media $selfkitPdfFiles
     * @return FilmFilm
     */
    public function addSelfkitPdfFile(\Application\Sonata\MediaBundle\Entity\Media $selfkitPdfFiles)
    {
        $this->selfkitPdfFiles[] = $selfkitPdfFiles;

        return $this;
    }

    /**
     * Remove selfkitPdfFiles
     *
     * @param \Application\Sonata\MediaBundle\Entity\Media $selfkitPdfFiles
     */
    public function removeSelfkitPdfFile(\Application\Sonata\MediaBundle\Entity\Media $selfkitPdfFiles)
    {
        $this->selfkitPdfFiles->removeElement($selfkitPdfFiles);
    }

    /**
     * Get selfkitPdfFiles
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getSelfkitPdfFiles()
    {
        return $this->selfkitPdfFiles;
    }

    /**
     * @param \FDC\CourtMetrageBundle\Entity\CcmNews $ccmNews
     * @return $this
     */
    public function addCcmNews(\FDC\CourtMetrageBundle\Entity\CcmNews $ccmNews)
    {
        $ccmNews->setAssociatedFilm($this);
        $this->ccmNews[] = $ccmNews;

        return $this;
    }

    /**
     * @param \FDC\CourtMetrageBundle\Entity\CcmNews $ccmNews
     */
    public function removeCcmNews(\FDC\CourtMetrageBundle\Entity\CcmNews $ccmNews)
    {
        $this->ccmNews->removeElement($ccmNews);
    }

    /**
     * @return mixed
     */
    public function getCcmNews()
    {
        return $this->ccmNews;
    }

    public function setApi2017($api2017)
    {
        $this->api2017 = $api2017;
    }
}
