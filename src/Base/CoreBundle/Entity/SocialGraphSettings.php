<?php

namespace Base\CoreBundle\Entity;

use \DateTime;

use Doctrine\ORM\Mapping as ORM;

use Base\CoreBundle\Util\Time;

use Gedmo\Mapping\Annotation as Gedmo;

/**
 * SocialGraphSettings
 *
 * @ORM\Table()
 * @ORM\Entity
 * @ORM\HasLifecycleCallbacks()
 */
class SocialGraphSettings
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
     * @ORM\Column(type="string")
     */
    protected $twitterHashtag;

    /**
     * @var FilmFestival
     *
     * @ORM\ManyToOne(targetEntity="FilmFestival")
     */
    private $festival;

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
     * Set twitterHashtag
     *
     * @param string $twitterHashtag
     * @return SocialGraphSettings
     */
    public function setTwitterHashtag($twitterHashtag)
    {
        $this->twitterHashtag = $twitterHashtag;

        return $this;
    }

    /**
     * Get twitterHashtag
     *
     * @return string 
     */
    public function getTwitterHashtag()
    {
        return $this->twitterHashtag;
    }

    /**
     * Set festival
     *
     * @param \Base\CoreBundle\Entity\FilmFestival $festival
     * @return SocialGraphSettings
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
