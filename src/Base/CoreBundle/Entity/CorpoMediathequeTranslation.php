<?php

namespace Base\CoreBundle\Entity;

use A2lix\I18nDoctrineBundle\Doctrine\ORM\Util\Translation;

use Base\CoreBundle\Util\Seo;
use Base\CoreBundle\Interfaces\TranslateChildInterface;
use Base\CoreBundle\Util\Time;
use Base\CoreBundle\Util\TranslateChild;

use Gedmo\Mapping\Annotation as Gedmo;

use Doctrine\ORM\Mapping as ORM;

use Symfony\Component\Validator\Constraints as Assert;

/**
 * CorpoMediathequeTranslation
 *
 * @ORM\Table()
 * @ORM\Entity()
 * @ORM\HasLifecycleCallbacks
 */
class CorpoMediathequeTranslation implements TranslateChildInterface
{
    use Time;
    use Translation;
    use \Base\CoreBundle\Util\TranslationChanges;
    use TranslateChild;
    use Seo;
    
    /**
     * @var string
     *
     * @ORM\Column(type="string", nullable=true)
     *
     */
    protected $title;


    /**
     * Set title
     *
     * @param string $title
     * @return CorpoMediathequeTranslation
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
}
