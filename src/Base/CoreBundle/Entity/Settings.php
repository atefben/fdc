<?php

namespace Base\CoreBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

use Base\CoreBundle\Util\Time;

use Gedmo\Mapping\Annotation as Gedmo;

use Symfony\Component\Validator\Constraints as Assert;

/**
 * Settings
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Base\CoreBundle\Repository\SettingsRepository")
 * @ORM\HasLifecycleCallbacks()
 */
class Settings
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
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=255)
     */
    protected $name;

    /**
     * @var string
     *
     * @Gedmo\Slug(fields={"name"})
     * @ORM\Column(name="slug", type="string", length=255, unique=true)
     */
    protected $slug;

    /**
     * @var FilmFestival
     *
     * @ORM\ManyToOne(targetEntity="FilmFestival", inversedBy="settings")
     *
     * @Assert\NotBlank()
     */
    protected $festival;

    public function getYear()
    {
        return $this->getFestival()->getFestivalStartsAt()->format('Y');
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
     * @return Settings
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
     * Set festival
     *
     * @param \Base\CoreBundle\Entity\FilmFestival $festival
     * @return Settings
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
}
