<?php

namespace Base\CoreBundle\Entity;

use A2lix\I18nDoctrineBundle\Doctrine\ORM\Util\Translatable;
use Base\CoreBundle\Component\Interfaces\NodeAudioInterface;
use Base\CoreBundle\Component\Traits\NodeAudio;
use Base\CoreBundle\Util\TruncatePro;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * StatementAudio
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Base\CoreBundle\Repository\TranslationRepository")
 * @ORM\HasLifecycleCallbacks()
 */
class StatementAudio extends Statement implements NodeAudioInterface
{
    use Translatable;
    use TruncatePro;
    use NodeAudio;
}
