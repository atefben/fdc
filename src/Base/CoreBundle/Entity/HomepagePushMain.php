<?php

namespace Base\CoreBundle\Entity;

use A2lix\I18nDoctrineBundle\Doctrine\ORM\Util\Translatable;
use Base\CoreBundle\Interfaces\TranslateMainInterface;
use Base\CoreBundle\Util\SeoMain;
use Base\CoreBundle\Util\Time;
use Base\CoreBundle\Util\TranslateMain;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;


/**
 * HomepagePushMain
 *
 * @ORM\Table()
 * @ORM\Entity
 * @ORM\HasLifecycleCallbacks()
 */
class HomepagePushMain implements TranslateMainInterface
{
    use Time;
    use Translatable;
    use TranslateMain;
    use SeoMain;

    /**
     * @var ArrayCollection
     *
     * @Assert\Valid()
     */
    protected $translations;

    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     *
     * @ORM\ManyToOne(targetEntity="HomepageTranslation", inversedBy="pushsMain")
     */
    private $homepageTranslation;

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
     * Set homepageTranslation
     *
     * @param \Base\CoreBundle\Entity\HomepageTranslation $homepageTranslation
     * @return HomepagePushMain
     */
    public function setHomepageTranslation(\Base\CoreBundle\Entity\HomepageTranslation $homepageTranslation = null)
    {
        $this->homepageTranslation = $homepageTranslation;

        return $this;
    }

    /**
     * Get homepageTranslation
     *
     * @return \Base\CoreBundle\Entity\HomepageTranslation 
     */
    public function getHomepageTranslation()
    {
        return $this->homepageTranslation;
    }
}
