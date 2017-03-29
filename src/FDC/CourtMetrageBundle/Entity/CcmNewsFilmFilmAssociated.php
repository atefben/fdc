<?php

namespace FDC\CourtMetrageBundle\Entity;


use Base\CoreBundle\Entity\FilmFilm;
use Doctrine\ORM\Mapping as ORM;
use Base\CoreBundle\Util\Time;
use Symfony\Component\Validator\Constraints as Assert;
/**
 * CcmNewsFilmFilmAssociated
 *
 * @ORM\Table(name="ccm_news_film_film_associated")
 * @ORM\Entity
 * @ORM\HasLifecycleCallbacks()
 */
class CcmNewsFilmFilmAssociated
{
    use Time;

    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @var CcmNews
     *
     * @ORM\ManyToOne(targetEntity="CcmNews", inversedBy="associatedFilms", cascade={"persist"})
     *
     */
    protected $ccmNews;

    /**
     * @var FilmFilm
     *
     * @ORM\ManyToOne(targetEntity="Base\CoreBundle\Entity\FilmFilm", inversedBy="associatedCcmNews")
     */
    protected $association;

    public function __toString() {
        $string = substr(strrchr(get_class($this), '\\'), 1);

        if ($this->getId()) {
            $string .= ' #'. $this->getId();
        }

        return $string;
    }

    /**
     * Constructor
     */
    public function __construct()
    {
    }

    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set news
     *
     * @param CcmNews $news
     * @return $this
     */
    public function setCcmNews(CcmNews $news = null)
    {
        $this->ccmNews = $news;

        return $this;
    }

    /**
     * Get news
     *
     * @return CcmNews
     */
    public function getCcmNews()
    {
        return $this->ccmNews;
    }

    /**
     * Set association
     *
     * @param \Base\CoreBundle\Entity\FilmFilm $association
     * @return $this
     */
    public function setAssociation(\Base\CoreBundle\Entity\FilmFilm $association = null)
    {
        $this->association = $association;

        return $this;
    }

    /**
     * Get association
     *
     * @return \Base\CoreBundle\Entity\FilmFilm 
     */
    public function getAssociation()
    {
        return $this->association;
    }
}
