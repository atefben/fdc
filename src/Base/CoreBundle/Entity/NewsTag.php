<?php

namespace Base\CoreBundle\Entity;

use \DateTime;

use A2lix\I18nDoctrineBundle\Doctrine\ORM\Util\Translatable;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

use Base\CoreBundle\Util\Time;

use Symfony\Component\Validator\Constraints as Assert;

/**
 * NewsNewsTag
 *
 * @ORM\Table()
 * @ORM\Entity
 * @ORM\HasLifecycleCallbacks()
 */
class NewsTag
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
     * @var News
     *
     * @ORM\ManyToOne(targetEntity="News", inversedBy="tags")
     */
    protected $news;
    
    /**
     * @var Tag
     *
     * @ORM\ManyToOne(targetEntity="Tag")
     */
    protected $tag;
    
    public function __toString() {
        $string = substr(strrchr(get_class($this), '\\'), 1);
        
        if ($this->getId() && $this->getTags()) {
            $translation = $this->getTags()->findTranslationByLocale('fr');
            if ($translation !== null) {
                return $translation->getName();
            }
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
     * @param \Base\CoreBundle\Entity\News $news
     * @return NewsNewsTag
     */
    public function setNews(\Base\CoreBundle\Entity\News $news = null)
    {
        $this->news = $news;

        return $this;
    }

    /**
     * Get news
     *
     * @return \Base\CoreBundle\Entity\News
     */
    public function getNews()
    {
        return $this->news;
    }

    /**
     * Set tag
     *
     * @param \Base\CoreBundle\Entity\Tag $tag
     * @return NewsTag
     */
    public function setTag(\Base\CoreBundle\Entity\Tag $tag = null)
    {
        $this->tag = $tag;

        return $this;
    }

    /**
     * Get tag
     *
     * @return \Base\CoreBundle\Entity\Tag 
     */
    public function getTag()
    {
        return $this->tag;
    }
}
