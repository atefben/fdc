<?php

namespace Base\CoreBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * PushMobile
 *
 * @ORM\Table()
 * @ORM\Entity
 */
class PushMobile
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @var string
     *
     * @ORM\Column(name="uuid", type="string", length=255)
     */
    protected $uuid;

    /**
     * @var string
     *
     * @ORM\Column(name="os", type="string", length=255)
     */
    protected $os;

    /**
     * @var string
     *
     * @ORM\Column(name="lang", type="string", length=255)
     */
    protected $lang;


    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set uuid
     *
     * @param string $uuid
     * @return PushMobile
     */
    public function setUuid($uuid)
    {
        $this->uuid = $uuid;

        return $this;
    }

    /**
     * Get uuid
     *
     * @return string 
     */
    public function getUuid()
    {
        return $this->uuid;
    }

    /**
     * Set os
     *
     * @param string $os
     * @return PushMobile
     */
    public function setOs($os)
    {
        $this->os = $os;

        return $this;
    }

    /**
     * Get os
     *
     * @return string 
     */
    public function getOs()
    {
        return $this->os;
    }

    /**
     * Set lang
     *
     * @param string $lang
     * @return PushMobile
     */
    public function setLang($lang)
    {
        $this->lang = $lang;

        return $this;
    }

    /**
     * Get lang
     *
     * @return string 
     */
    public function getLang()
    {
        return $this->lang;
    }
}
