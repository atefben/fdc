<?php

namespace FDC\CourtMetrageBundle\Entity;


use Symfony\Component\Validator\Constraints as Assert;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use A2lix\I18nDoctrineBundle\Doctrine\ORM\Util\Translatable;
use Base\CoreBundle\Interfaces\TranslateMainInterface;
use Base\CoreBundle\Util\TranslateMain;
use Base\CoreBundle\Util\Time;

/**
 * Tag
 *
 * @ORM\Table(name="ccm_tag")
 * @ORM\Entity()
 * @ORM\HasLifecycleCallbacks()
 */
class CcmTag implements TranslateMainInterface
{
    use Time;
    use TranslateMain;
    use Translatable;
    
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * ArrayCollection
     */
    protected $translations;

    public function __construct()
    {
        $this->translations = new ArrayCollection();
    }

    public function __toString()
    {
        $translation = $this->findTranslationByLocale('fr');
        if ($translation !== null) {
            $string = $translation->getName();
        } else {
            $string = strval($this->getId());
        }
        
        return $string;
    }

    public function getName()
    {
        $translation = $this->findTranslationByLocale('fr');
        $string = '';

        if ($translation !== null) {
            $string = $translation->getName();
        }

        return $string;
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
}
