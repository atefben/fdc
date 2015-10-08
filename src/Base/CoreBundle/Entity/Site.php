<?php

namespace Base\CoreBundle\Entity;

use \DateTime;

use A2lix\I18nDoctrineBundle\Doctrine\ORM\Util\Translatable;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

use Base\CoreBundle\Util\Time;

use Gedmo\Mapping\Annotation as Gedmo;

/**
 * Site
 *
 * @ORM\Table()
 * @ORM\Entity
 * @ORM\HasLifecycleCallbacks()
 */
class Site
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
     * @ORM\Column(name="class_color", type="string", length=255, nullable=true)
     */
    protected $classColor;
    
    /**
     * @var string
     *
     * @Gedmo\Slug(fields={"name"})
     * @ORM\Column(name="slug", type="string", length=255, unique=true)
     */
    protected $slug;
    
    /**
     * @var Site
     *
     * @ORM\ManyToMany(targetEntity="NewsAudioTranslation", mappedBy="sites")
     */
    protected $newsAudios;

    /**
     * @var Site
     *
     * @ORM\ManyToMany(targetEntity="NewsArticleTranslation", mappedBy="sites")
     */
    protected $newsArticles;

    /**
     * @var ArrayCollection
     *
     */
    protected $translations;
    
    public function __construct()
    {
        $this->translations = new ArrayCollection();
        $this->articles = new ArrayCollection();
    }
    
    public function __toString() { 
        if ($this->getId()) {
            return $this->getName();
        } else {
            return substr(strrchr(get_class($this), '\\'), 1); 
        }
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
     * @return Site
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
     * @return Site
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
     * Set classColor
     *
     * @param string $classColor
     * @return Site
     */
    public function setClassColor($classColor)
    {
        $this->classColor = $classColor;

        return $this;
    }

    /**
     * Get classColor
     *
     * @return string 
     */
    public function getClassColor()
    {
        return $this->classColor;
    }
}
