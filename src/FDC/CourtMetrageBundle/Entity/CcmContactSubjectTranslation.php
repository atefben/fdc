<?php

namespace FDC\CourtMetrageBundle\Entity;

use A2lix\I18nDoctrineBundle\Doctrine\ORM\Util\Translation;
use Base\CoreBundle\Util\Time;
use Base\CoreBundle\Util\TranslationChanges;
use Base\CoreBundle\Interfaces\TranslateChildInterface;
use Base\CoreBundle\Util\TranslateChild;
use Gedmo\Mapping\Annotation as Gedmo;
use Symfony\Component\Validator\Constraints as Assert;
use Doctrine\ORM\Mapping as ORM;

/**
 * CcmContactSubjectTranslation
 *
 * @ORM\Table(name="ccm_contact_subject_translation")
 * @ORM\Entity()
 * @ORM\HasLifecycleCallbacks()
 */
class CcmContactSubjectTranslation implements TranslateChildInterface
{
    use Translation;
    use TranslationChanges;
    use TranslateChild;
    use Time;

    /**
     * @var string
     *
     * @ORM\Column(name="contact_theme", type="string", length=255, nullable=true)
     * @Assert\NotBlank()
     */
    private $contactTheme;

    /**
     * @var string
     * @ORM\Column(name="receiver_email", type="string", length=255, nullable=true)
     * @Assert\Email
     * @Assert\NotBlank()
     */
    protected $receiverEmail;

    /**
     * @var string
     *
     * @Gedmo\Slug(fields={"contactTheme"}, updatable=false)
     * @ORM\Column(name="slug", type="string", length=255, unique=true)
     */
    protected $slug;

    /**
     * @return string
     */
    public function getContactTheme()
    {
        return $this->contactTheme;
    }

    /**
     * @param string $contactTheme
     */
    public function setContactTheme($contactTheme)
    {
        $this->contactTheme = $contactTheme;
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

    /**
     * @param $slug
     *
     * @return $this
     */
    public function setSlug($slug)
    {
        $this->slug = $slug;

        return $this;
    }
    
    /**
     * @return string
     */
    public function getReceiverEmail()
    {
        return $this->receiverEmail;
    }

    /**
     * @param string $receiverEmail
     */
    public function setReceiverEmail($receiverEmail)
    {
        $this->receiverEmail = $receiverEmail;
    }
}

