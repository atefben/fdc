<?php

namespace Base\CoreBundle\Entity;

use A2lix\I18nDoctrineBundle\Doctrine\ORM\Util\Translation;

use Base\CoreBundle\Util\Time;
use Base\CoreBundle\Util\Status;

use Doctrine\ORM\Mapping as ORM;

use JMS\Serializer\Annotation\Groups;
use JMS\Serializer\Annotation\Since;

use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity
 * @ORM\HasLifecycleCallbacks()
 * @UniqueEntity("name")
 */
class WebTvTranslation implements WebTvTranslationInterface
{
    use Time;
    use Translation;
    use Status;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=255, nullable=true, unique=true)
     *
     * @Groups({"web_tv_list", "web_tv_show"})
     */
    protected $name;

    /**
     * @var integer
     *
     * @ORM\Column(type="integer", nullable=false)
     * @Assert\NotBlank()
     *
     * @Groups({"web_tv_list", "web_tv_show"})
     */
    private $status;

    /**
     * Set name
     *
     * @param string $name
     * @return WebTv
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set status
     *
     * @param integer $status
     * @return WebTvTranslation
     */
    public function setStatus($status)
    {
        $this->status = $status;

        return $this;
    }

    /**
     * Get status
     *
     * @return integer 
     */
    public function getStatus()
    {
        return $this->status;
    }
}
