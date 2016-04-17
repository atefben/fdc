<?php

namespace Base\CoreBundle\Entity;

use Base\CoreBundle\Util\Time;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

use JMS\Serializer\Annotation\Groups;
use JMS\Serializer\Annotation\Since;

/**
 * FilmProjectionRoom
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Base\CoreBundle\Repository\FilmProjectionRoomRepository")
 * @ORM\HasLifecycleCallbacks
 */
class FilmProjectionRoom
{
    use Time;

    /**
     * @var integer
     *
     * @ORM\Column(type="integer")
     * @ORM\Id
     *
     * @Groups({
     *     "projection_list",
     *     "projection_show",
     *     "home",
     *     "news_list"})
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(type="string", length=80, nullable=true)
     *
     * @Groups({
     *     "projection_list",
     *     "projection_show",
     *     "film_list",
     *     "film_show",
     *     "home",
     *     "news_list"
     * })
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\OneToMany(targetEntity="FilmProjection", mappedBy="room")
     * @Groups({
     *  "projection_list", "projection_show"
     * })
     */
    private $projections;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->projections = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Set id
     *
     * @param integer $id
     * @return FilmRoom
     */
    public function setId($id)
    {
        $this->id = $id;

        return $this;
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
     * Set name
     *
     * @param string $name
     * @return FilmRoom
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Add projections
     *
     * @param \Base\CoreBundle\Entity\FilmProjection $projections
     * @return FilmRoom
     */
    public function addProjection(\Base\CoreBundle\Entity\FilmProjection $projections)
    {
        if ($this->projections->contains($projections)) {
            return;
        }

        $this->projections[] = $projections;

        return $this;
    }

    /**
     * Remove projections
     *
     * @param \Base\CoreBundle\Entity\FilmProjection $projections
     */
    public function removeProjection(\Base\CoreBundle\Entity\FilmProjection $projections)
    {
        if (!$this->projections->contains($projections)) {
            return;
        }

        $this->projections->removeElement($projections);
    }

    /**
     * Get projections
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getProjections()
    {
        return $this->projections;
    }

    /**
     * @param ArrayCollection $projections
     * @return ArrayCollection|string
     */
    public function setProjections(ArrayCollection $projections)
    {
        $this->projections = $projections;

        return $this;
    }
}
