<?php

namespace Base\CoreBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * OldSysSession
 *
 * @ORM\Table(name="old_sys_session", indexes={@ORM\Index(name="sesId", columns={"sesid"})})
 * @ORM\Entity
 */
class OldSysSession
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    protected $id;

    /**
     * @var string
     *
     * @ORM\Column(name="sesid", type="string", length=40, nullable=false)
     */
    protected $sesid;

    /**
     * @var string
     *
     * @ORM\Column(name="data", type="blob", nullable=false)
     */
    protected $data;

    /**
     * @var integer
     *
     * @ORM\Column(name="time", type="integer", nullable=false)
     */
    protected $time;



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
     * Set sesid
     *
     * @param string $sesid
     * @return OldSysSession
     */
    public function setSesid($sesid)
    {
        $this->sesid = $sesid;

        return $this;
    }

    /**
     * Get sesid
     *
     * @return string 
     */
    public function getSesid()
    {
        return $this->sesid;
    }

    /**
     * Set data
     *
     * @param string $data
     * @return OldSysSession
     */
    public function setData($data)
    {
        $this->data = $data;

        return $this;
    }

    /**
     * Get data
     *
     * @return string 
     */
    public function getData()
    {
        return $this->data;
    }

    /**
     * Set time
     *
     * @param integer $time
     * @return OldSysSession
     */
    public function setTime($time)
    {
        $this->time = $time;

        return $this;
    }

    /**
     * Get time
     *
     * @return integer 
     */
    public function getTime()
    {
        return $this->time;
    }
}
