<?php

namespace FDC\CoreBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

use FDC\CoreBundle\Util\Time;

/**
 * FilmAddress
 *
 * @ORM\Table(indexes={@ORM\Index(name="updated_at", columns={"updated_at"})})
 * @ORM\Entity
 * @ORM\HasLifecycleCallbacks
 */
class FilmAddress
{
    use Time;

    /**
     * @var integer
     *
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(type="text", nullable=true)
     */
    private $content;

    /**
     * @var Country
     *
     * @ORM\ManyToOne(targetEntity="Country", inversedBy="addresses")
     */
    private $country;

    /**
     * @var string
     *
     * @ORM\Column(type="text", nullable=true)
     */
    private $contactsOptionals;
    
    /**
     * @ORM\OneToMany(targetEntity="FilmPerson", mappedBy="address")
     */
    private $persons;
    
    /**
     * @ORM\OneToMany(targetEntity="FilmFilm", mappedBy="directorAddress")
     */
    private $directorFilms;
    
    /**
     * @ORM\OneToMany(targetEntity="FilmAddressSchool", mappedBy="address")
     */
    private $schoolsFilms;

    /**
     * @ORM\OneToMany(targetEntity="FilmFilm", mappedBy="eventAddress")
     */
    private $eventFilms;

    /**
     * @ORM\OneToMany(targetEntity="FilmFilm", mappedBy="pressInternatAddress")
     */
    private $pressInternatFilms;

    /**
     * @ORM\OneToMany(targetEntity="FilmFilm", mappedBy="pressAddress")
     */
    private $pressFilms;

    /**
     * @ORM\OneToMany(targetEntity="FilmFilm", mappedBy="distributionAddress")
     */
    private $distributionFilms;

    /**
     * @ORM\OneToMany(targetEntity="FilmFilm", mappedBy="productionAddress")
     */
    private $productionFilms;
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->persons = new \Doctrine\Common\Collections\ArrayCollection();
        $this->directorFilms = new \Doctrine\Common\Collections\ArrayCollection();
        $this->schoolsFilms = new \Doctrine\Common\Collections\ArrayCollection();
        $this->eventFilms = new \Doctrine\Common\Collections\ArrayCollection();
        $this->pressInternatFilms = new \Doctrine\Common\Collections\ArrayCollection();
        $this->pressFilms = new \Doctrine\Common\Collections\ArrayCollection();
        $this->distributionFilms = new \Doctrine\Common\Collections\ArrayCollection();
        $this->productionFilms = new \Doctrine\Common\Collections\ArrayCollection();
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
     * Set content
     *
     * @param string $content
     * @return FilmAddress
     */
    public function setContent($content)
    {
        $this->content = $content;

        return $this;
    }

    /**
     * Get content
     *
     * @return string 
     */
    public function getContent()
    {
        return $this->content;
    }

    /**
     * Set contactsOptionals
     *
     * @param string $contactsOptionals
     * @return FilmAddress
     */
    public function setContactsOptionals($contactsOptionals)
    {
        $this->contactsOptionals = $contactsOptionals;

        return $this;
    }

    /**
     * Get contactsOptionals
     *
     * @return string 
     */
    public function getContactsOptionals()
    {
        return $this->contactsOptionals;
    }

    /**
     * Set country
     *
     * @param \FDC\CoreBundle\Entity\Country $country
     * @return FilmAddress
     */
    public function setCountry(\FDC\CoreBundle\Entity\Country $country = null)
    {
        $this->country = $country;

        return $this;
    }

    /**
     * Get country
     *
     * @return \FDC\CoreBundle\Entity\Country 
     */
    public function getCountry()
    {
        return $this->country;
    }

    /**
     * Add persons
     *
     * @param \FDC\CoreBundle\Entity\FilmPerson $persons
     * @return FilmAddress
     */
    public function addPerson(\FDC\CoreBundle\Entity\FilmPerson $persons)
    {
        $this->persons[] = $persons;

        return $this;
    }

    /**
     * Remove persons
     *
     * @param \FDC\CoreBundle\Entity\FilmPerson $persons
     */
    public function removePerson(\FDC\CoreBundle\Entity\FilmPerson $persons)
    {
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
     * Add directorFilms
     *
     * @param \FDC\CoreBundle\Entity\FilmFilm $directorFilms
     * @return FilmAddress
     */
    public function addDirectorFilm(\FDC\CoreBundle\Entity\FilmFilm $directorFilms)
    {
        $this->directorFilms[] = $directorFilms;

        return $this;
    }

    /**
     * Remove directorFilms
     *
     * @param \FDC\CoreBundle\Entity\FilmFilm $directorFilms
     */
    public function removeDirectorFilm(\FDC\CoreBundle\Entity\FilmFilm $directorFilms)
    {
        $this->directorFilms->removeElement($directorFilms);
    }

    /**
     * Get directorFilms
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getDirectorFilms()
    {
        return $this->directorFilms;
    }

    /**
     * Add schoolsFilms
     *
     * @param \FDC\CoreBundle\Entity\FilmAddressSchool $schoolsFilms
     * @return FilmAddress
     */
    public function addSchoolsFilm(\FDC\CoreBundle\Entity\FilmAddressSchool $schoolsFilms)
    {
        $this->schoolsFilms[] = $schoolsFilms;

        return $this;
    }

    /**
     * Remove schoolsFilms
     *
     * @param \FDC\CoreBundle\Entity\FilmAddressSchool $schoolsFilms
     */
    public function removeSchoolsFilm(\FDC\CoreBundle\Entity\FilmAddressSchool $schoolsFilms)
    {
        $this->schoolsFilms->removeElement($schoolsFilms);
    }

    /**
     * Get schoolsFilms
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getSchoolsFilms()
    {
        return $this->schoolsFilms;
    }

    /**
     * Add eventFilms
     *
     * @param \FDC\CoreBundle\Entity\FilmFilm $eventFilms
     * @return FilmAddress
     */
    public function addEventFilm(\FDC\CoreBundle\Entity\FilmFilm $eventFilms)
    {
        $this->eventFilms[] = $eventFilms;

        return $this;
    }

    /**
     * Remove eventFilms
     *
     * @param \FDC\CoreBundle\Entity\FilmFilm $eventFilms
     */
    public function removeEventFilm(\FDC\CoreBundle\Entity\FilmFilm $eventFilms)
    {
        $this->eventFilms->removeElement($eventFilms);
    }

    /**
     * Get eventFilms
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getEventFilms()
    {
        return $this->eventFilms;
    }

    /**
     * Add pressInternatFilms
     *
     * @param \FDC\CoreBundle\Entity\FilmFilm $pressInternatFilms
     * @return FilmAddress
     */
    public function addPressInternatFilm(\FDC\CoreBundle\Entity\FilmFilm $pressInternatFilms)
    {
        $this->pressInternatFilms[] = $pressInternatFilms;

        return $this;
    }

    /**
     * Remove pressInternatFilms
     *
     * @param \FDC\CoreBundle\Entity\FilmFilm $pressInternatFilms
     */
    public function removePressInternatFilm(\FDC\CoreBundle\Entity\FilmFilm $pressInternatFilms)
    {
        $this->pressInternatFilms->removeElement($pressInternatFilms);
    }

    /**
     * Get pressInternatFilms
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getPressInternatFilms()
    {
        return $this->pressInternatFilms;
    }

    /**
     * Add pressFilms
     *
     * @param \FDC\CoreBundle\Entity\FilmFilm $pressFilms
     * @return FilmAddress
     */
    public function addPressFilm(\FDC\CoreBundle\Entity\FilmFilm $pressFilms)
    {
        $this->pressFilms[] = $pressFilms;

        return $this;
    }

    /**
     * Remove pressFilms
     *
     * @param \FDC\CoreBundle\Entity\FilmFilm $pressFilms
     */
    public function removePressFilm(\FDC\CoreBundle\Entity\FilmFilm $pressFilms)
    {
        $this->pressFilms->removeElement($pressFilms);
    }

    /**
     * Get pressFilms
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getPressFilms()
    {
        return $this->pressFilms;
    }

    /**
     * Add distributionFilms
     *
     * @param \FDC\CoreBundle\Entity\FilmFilm $distributionFilms
     * @return FilmAddress
     */
    public function addDistributionFilm(\FDC\CoreBundle\Entity\FilmFilm $distributionFilms)
    {
        $this->distributionFilms[] = $distributionFilms;

        return $this;
    }

    /**
     * Remove distributionFilms
     *
     * @param \FDC\CoreBundle\Entity\FilmFilm $distributionFilms
     */
    public function removeDistributionFilm(\FDC\CoreBundle\Entity\FilmFilm $distributionFilms)
    {
        $this->distributionFilms->removeElement($distributionFilms);
    }

    /**
     * Get distributionFilms
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getDistributionFilms()
    {
        return $this->distributionFilms;
    }

    /**
     * Add productionFilms
     *
     * @param \FDC\CoreBundle\Entity\FilmFilm $productionFilms
     * @return FilmAddress
     */
    public function addProductionFilm(\FDC\CoreBundle\Entity\FilmFilm $productionFilms)
    {
        $this->productionFilms[] = $productionFilms;

        return $this;
    }

    /**
     * Remove productionFilms
     *
     * @param \FDC\CoreBundle\Entity\FilmFilm $productionFilms
     */
    public function removeProductionFilm(\FDC\CoreBundle\Entity\FilmFilm $productionFilms)
    {
        $this->productionFilms->removeElement($productionFilms);
    }

    /**
     * Get productionFilms
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getProductionFilms()
    {
        return $this->productionFilms;
    }
}
