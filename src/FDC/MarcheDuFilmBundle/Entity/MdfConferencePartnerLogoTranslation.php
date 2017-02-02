<?php

namespace FDC\MarcheDuFilmBundle\Entity;

use A2lix\I18nDoctrineBundle\Doctrine\ORM\Util\Translation;
use Base\CoreBundle\Util\TranslationChanges;
use Doctrine\ORM\Mapping as ORM;
use Base\CoreBundle\Util\TranslateChild;
use Base\CoreBundle\Interfaces\TranslateChildInterface;

/**
 * MdfConferencePartnerLogoTranslation
 * @ORM\Table(name="mdf_conference_partner_logo_translation")
 * @ORM\Entity(repositoryClass="FDC\MarcheDuFilmBundle\Repository\MdfConferencePartnerLogoTranslationRepository")
 */
class MdfConferencePartnerLogoTranslation implements TranslateChildInterface
{
    use Translation;
    use TranslationChanges;

    use TranslateChild;

    /**
     * @var string
     *
     * @ORM\Column(type="string", nullable=true)
     */
    protected $url;

    /**
     * @return string
     */
    public function getUrl()
    {
        return $this->url;
    }

    /**
     * @param string $url
     */
    public function setUrl($url)
    {
        $this->url = $url;
    }
}
