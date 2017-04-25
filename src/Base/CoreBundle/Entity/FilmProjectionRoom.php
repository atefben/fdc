<?php

namespace Base\CoreBundle\Entity;

use Base\CoreBundle\Util\Time;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation as Serializer;
use JMS\Serializer\Annotation\Groups;

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
     *     "projection_list", "projection_list_2017", "programmation",
     *     "projection_show",
     *     "home",
     *     "news_list", "search"})
     */
    protected $id;

    /**
     * @var string
     *
     * @ORM\Column(type="string", length=80, nullable=true)
     *
     * @Groups({
     *     "projection_list", "projection_list_2017", "programmation",
     *     "projection_show",
     *     "film_list",
     *     "film_show",
     *     "home",
     *     "news_list", "search"
     * })
     * @Serializer\Accessor(getter="getApiName")
     */
    protected $name;

    /**
     * @var string
     *
     * @ORM\OneToMany(targetEntity="FilmProjection", mappedBy="room")
     * @Groups({
     *  "projection_list", "projection_show"
     * })
     */
    protected $projections;

    /**
     * @var string
     *
     * @ORM\Column(name="home_projection_2017_order", nullable=true)
     */
    protected $homeProjection2017Order = 50;

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
     * @return $this
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
     * @return $this
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
     * Get name
     *
     * @return string
     */
    public function getApiName()
    {
        return str_replace('Salle de Conférence de Presse', 'Salle de presse', $this->name);
    }

    /**
     * Add projections
     *
     * @param \Base\CoreBundle\Entity\FilmProjection $projections
     * @return $this
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
     * @Serializer\VirtualProperty()
     * @Groups({
     *  "projection_list_2017"
     * })
     * @return array
     */
    public function getProjectionsGroupedByDay()
    {
        $days = [];
        foreach ($this->getProjections() as $projection) {
            if (!($projection instanceof FilmProjection)) {
                continue;
            }
                if ((int)$projection->getStartsAt()->format('H') < 4) {
                    $tomorrow = clone $projection->getStartsAt();
                    $tomorrow->add(date_interval_create_from_date_string('-1 day'));
                    $keyDay = $tomorrow->format('Y-m-d');
                    $key = $tomorrow->getTimestamp() . '-' . $projection->getId();
                } else {
                    $keyDay = $projection->getStartsAt()->format('Y-m-d');
                    $key = $projection->getTimestamp() . '-' . $projection->getId();;
                }
                $days[$keyDay][$key] = $projection;
        }
        foreach ($days as &$day) {
            ksort($day);
            $day = array_values($day);
        }
        return $days;
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

    /**
     * @return string
     */
    public function getHomeProjection2017Order()
    {
        return $this->homeProjection2017Order;
    }

    /**
     * @param string $homeProjection2017Order
     * @return $this
     */
    public function setHomeProjection2017Order($homeProjection2017Order)
    {
        $this->homeProjection2017Order = $homeProjection2017Order;
        return $this;
    }


}
