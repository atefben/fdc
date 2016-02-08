<?php

namespace Base\CoreBundle\Entity;

use A2lix\I18nDoctrineBundle\Doctrine\ORM\Util\Translation;

use Base\CoreBundle\Interfaces\TranslateChildInterface;
use Base\CoreBundle\Util\Seo;
use Base\CoreBundle\Util\Time;
use Base\CoreBundle\Util\TranslateChild;

use Doctrine\ORM\Mapping as ORM;

use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity
 * @ORM\HasLifecycleCallbacks()
 */
class HomepagePushMainTranslation
{
    use Time;
    use Translation;
    use Seo;

    /**
     * @var string
     *
     * @ORM\Column(type="string", nullable=false)
     **/
    private $title;

    /**
     * @var string
     *
     * @ORM\Column(type="string", nullable=false)
     **/
    private $alt;

    /**
     * @var string
     *
     * @ORM\Column(type="string", nullable=false)
     **/
    private $url;

    /**
     *
     * @ORM\ManyToOne(targetEntity="MediaImageSimple")
     */
    private $file;

    /**
     * Set title
     *
     * @param string $title
     * @return HomepagePushMainTranslation
     */
    public function setTitle($title)
    {
        $this->title = $title;

        return $this;
    }

    /**
     * Get title
     *
     * @return string 
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Set alt
     *
     * @param string $alt
     * @return HomepagePushMainTranslation
     */
    public function setAlt($alt)
    {
        $this->alt = $alt;

        return $this;
    }

    /**
     * Get alt
     *
     * @return string 
     */
    public function getAlt()
    {
        return $this->alt;
    }

    /**
     * Set url
     *
     * @param string $url
     * @return HomepagePushMainTranslation
     */
    public function setUrl($url)
    {
        $this->url = $url;

        return $this;
    }

    /**
     * Get url
     *
     * @return string 
     */
    public function getUrl()
    {
        return $this->url;
    }
    

    /**
     * Set file
     *
     * @param \Base\CoreBundle\Entity\MediaImageSimple $file
     * @return HomepagePushMainTranslation
     */
    public function setFile(\Base\CoreBundle\Entity\MediaImageSimple $file = null)
    {
        $this->file = $file;

        return $this;
    }

    /**
     * Get file
     *
     * @return \Base\CoreBundle\Entity\MediaImageSimple 
     */
    public function getFile()
    {
        return $this->file;
    }
}
