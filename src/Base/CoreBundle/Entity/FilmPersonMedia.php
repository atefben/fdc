<?php

namespace Base\CoreBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

use Base\CoreBundle\Util\Time;

use JMS\Serializer\Annotation\Groups;
use JMS\Serializer\Annotation\Since;

use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * FilmPersonMedia
 *
 * @ORM\Table(
uniqueConstraints = {@ORM\UniqueConstraint(name="film_person_media", columns={"person_id", "media_id"})}
)
 * @ORM\Entity
 * @ORM\HasLifecycleCallbacks()
 * @UniqueEntity({"person", "media"})
 *
 */
class FilmPersonMedia implements FilmFilmMediaInterface
{
    use Time;

    /**
     * @var string
     *
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var FilmPerson
     *
     * @ORM\ManyToOne(targetEntity="FilmPerson", inversedBy="medias", cascade={"persist"})
     */
    private $person;

    /**
     * @var FilmMedia
     *
     * @ORM\ManyToOne(targetEntity="FilmMedia", cascade={"persist"})
     *
     * @Groups({
     *  "person_list", "person_show",
     *  "jury_list", "jury_show"
     * })
     */
    private $media;

    /**
     * @var string
     *
     * @ORM\Column(type="integer", nullable=true)
     *
     * @Groups({
     *  "person_list", "person_show",
     *  "jury_list", "jury_show"
     * })
     */
    private $position;

    /**
     * @var string
     *
     * @ORM\Column(type="string", length=255, nullable=true)
     *
     * @Groups({
     *  "person_list", "person_show",
     *  "jury_list", "jury_show"
     * })
     */
    private $filename;

    /**
     * @var string
     *
     * @ORM\Column(type="integer", nullable=true)
     *
     * @Groups({
     *  "person_list", "person_show",
     *  "jury_list", "jury_show"
     * })
     */
    private $type;

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
     * Set position
     *
     * @param integer $position
     * @return FilmFilmMedia
     */
    public function setPosition($position)
    {
        $this->position = $position;

        return $this;
    }

    /**
     * Get position
     *
     * @return integer
     */
    public function getPosition()
    {
        return $this->position;
    }

    /**
     * Set filename
     *
     * @param string $filename
     * @return FilmFilmMedia
     */
    public function setFilename($filename)
    {
        $this->filename = $filename;

        return $this;
    }

    /**
     * Get filename
     *
     * @return string
     */
    public function getFilename()
    {
        return $this->filename;
    }

    /**
     * Set type
     *
     * @param integer $type
     * @return FilmFilmMedia
     */
    public function setType($type)
    {
        $this->type = $type;

        return $this;
    }

    /**
     * Get type
     *
     * @return integer
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * Set person
     *
     * @param \Base\CoreBundle\Entity\FilmPerson $person
     * @return FilmPersonMedia
     */
    public function setPerson(\Base\CoreBundle\Entity\FilmPerson $person = null)
    {
        $this->person = $person;

        return $this;
    }

    /**
     * Get person
     *
     * @return \Base\CoreBundle\Entity\FilmPerson
     */
    public function getPerson()
    {
        return $this->person;
    }

    /**
     * Set media
     *
     * @param \Base\CoreBundle\Entity\FilmMedia $media
     * @return FilmPersonMedia
     */
    public function setMedia(\Base\CoreBundle\Entity\FilmMedia $media = null)
    {
        $this->media = $media;

        return $this;
    }

    /**
     * Get media
     *
     * @return \Base\CoreBundle\Entity\FilmMedia
     */
    public function getMedia()
    {
        return $this->media;
    }
}
