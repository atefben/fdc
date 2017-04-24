<?php

namespace Base\CoreBundle\Entity;

use A2lix\I18nDoctrineBundle\Doctrine\ORM\Util\Translatable;
use Base\CoreBundle\Component\Interfaces\NodeVideoInterface;
use Base\CoreBundle\Component\Traits\NodeVideo;
use Base\CoreBundle\Util\TruncatePro;
use Doctrine\ORM\Mapping as ORM;

/**
 * InfoVideo
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Base\CoreBundle\Repository\TranslationRepository")
 * @ORM\HasLifecycleCallbacks()
 */
class InfoVideo extends Info implements NodeVideoInterface
{
    use Translatable;
    use TruncatePro;
    use NodeVideo;
}
