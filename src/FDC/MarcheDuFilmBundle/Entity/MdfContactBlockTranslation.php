<?php

namespace FDC\MarcheDuFilmBundle\Entity;

use A2lix\I18nDoctrineBundle\Doctrine\ORM\Util\Translation;
use Base\CoreBundle\Util\Time;
use Base\CoreBundle\Util\TranslationChanges;
use Base\CoreBundle\Interfaces\TranslateChildInterface;
use Base\CoreBundle\Util\TranslateChild;
use Symfony\Component\Validator\Constraints as Assert;
use Doctrine\ORM\Mapping as ORM;

/**
 * MdfContactBlockTranslation
 *
 * @ORM\Table(name="mdf_contact_block_translation")
 * @ORM\Entity(repositoryClass="FDC\MarcheDuFilmBundle\Repository\MdfContactBlockTranslationRepository")
 * @ORM\HasLifecycleCallbacks()
 */
class MdfContactBlockTranslation
{
    use Translation;
    use TranslationChanges;

    /**
     * @var string
     *
     * @ORM\Column(name="contact_date", type="string", length=255, nullable=true)
     * @Assert\NotBlank()
     */
    private $contactDate;
    
    /**
     * @var string
     *
     * @ORM\Column(name="contact_address", type="string", length=255, nullable=true)
     * @Assert\NotBlank()
     */
    private $contactAddress;

    /**
     * @var string
     *
     * @ORM\Column(name="contactPhone", type="string", length=255, nullable=true)
     * @Assert\NotBlank()
     */
    private $contactPhone;

    /**
     * @return string
     */
    public function getContactDate()
    {
        return $this->contactDate;
    }

    /**
     * @param string $contactDate
     */
    public function setContactDate($contactDate)
    {
        $this->contactDate = $contactDate;
    }

    /**
     * @return string
     */
    public function getContactAddress()
    {
        return $this->contactAddress;
    }

    /**
     * @param string $contactAddress
     */
    public function setContactAddress($contactAddress)
    {
        $this->contactAddress = $contactAddress;
    }

    /**
     * @return string
     */
    public function getContactPhone()
    {
        return $this->contactPhone;
    }

    /**
     * @param string $contactPhone
     */
    public function setContactPhone($contactPhone)
    {
        $this->contactPhone = $contactPhone;
    }
}

