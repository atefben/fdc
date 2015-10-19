<?php

namespace Base\CoreBundle\Entity;

use \DateTime;

use A2lix\I18nDoctrineBundle\Doctrine\ORM\Util\Translatable;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

use Base\CoreBundle\Util\Time;

/**
 * StatementWidgetText
 *
 * @ORM\Table()
 * @ORM\Entity
 * @ORM\HasLifecycleCallbacks()
 */
class StatementWidgetText extends StatementWidget
{
    use Translatable;

    /**
     * @var ArrayCollection
     *
     */
    protected $translations;

    public function __construct()
    {
        $this->translations = new ArrayCollection();
    }
}
