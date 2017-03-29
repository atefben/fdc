<?php

namespace Base\CoreBundle\Entity;

use A2lix\I18nDoctrineBundle\Doctrine\ORM\Util\Translatable;
use Base\CoreBundle\Component\Interfaces\NodeImageInterface;
use Base\CoreBundle\Component\Traits\NodeImage;
use Base\CoreBundle\Util\TruncatePro;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * NewsImage
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Base\CoreBundle\Repository\TranslationRepository")
 * @ORM\HasLifecycleCallbacks()
 */
class NewsImage extends News implements NodeImageInterface
{
    use Translatable;
    use TruncatePro;
    use NodeImage;
}
