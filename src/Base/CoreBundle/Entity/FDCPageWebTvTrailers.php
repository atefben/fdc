<?php

namespace Base\CoreBundle\Entity;

use A2lix\I18nDoctrineBundle\Doctrine\ORM\Util\Translatable;
use Base\CoreBundle\Interfaces\TranslateMainInterface;
use Base\CoreBundle\Util\SeoMain;
use Base\CoreBundle\Util\Time;
use Base\CoreBundle\Util\TranslateMain;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

use JMS\Serializer\Annotation\Groups;
use JMS\Serializer\Annotation\Since;

/**
 * FDCPageWebTvTrailers
 *
 * @ORM\Table()
 * @ORM\Entity
 * @ORM\HasLifecycleCallbacks
 */
class FDCPageWebTvTrailers implements TranslateMainInterface
{
    use Time;
    use Translatable;
    use TranslateMain;
    use SeoMain;

    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var MediaImageSimple
     *
     * @ORM\ManyToOne(targetEntity="MediaImageSimple")
     *
     * @Groups({"web_tv_list", "web_tv_show"})
     */
    private $image;

    /**
     * @var ArrayCollection
     *
     * @Assert\Valid()
     */
    protected $translations;


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
     * @var string
     *
     * @ORM\Column(name="slug", type="string", length=255, unique=true)
     */
    private $slug;

    /**
     * Set image
     *
     * @param \Base\CoreBundle\Entity\MediaImageSimple $image
     * @return FDCPageWebTvTrailers
     */
    public function setImage(\Base\CoreBundle\Entity\MediaImageSimple $image = null)
    {
        $this->image = $image;

        return $this;
    }

    /**
     * Get image
     *
     * @return \Base\CoreBundle\Entity\MediaImageSimple 
     */
    public function getImage()
    {
        return $this->image;
    }

    public function __toString()
    {
        return 'Page WebTV - Les bandes-annonces - Compétition';
    }

    /**
     * Set slug
     *
     * @param string $slug
     * @return FDCPageWebTvTrailers
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
}
