<?php

namespace Base\CoreBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * OldSfGuardUserProfile
 *
 * @ORM\Table(name="old_sf_guard_user_profile")
 * @ORM\Entity
 */
class OldSfGuardUserProfile
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
     * @var integer
     *
     * @ORM\Column(name="user_id", type="integer", nullable=false)
     */
    protected $userId;

    /**
     * @var string
     *
     * @ORM\Column(name="complete_name", type="string", length=255, nullable=false)
     */
    protected $completeName;

    /**
     * @var string
     *
     * @ORM\Column(name="referent_language", type="string", length=10, nullable=false)
     */
    protected $referentLanguage;

    /**
     * @var string
     *
     * @ORM\Column(name="email", type="string", length=255, nullable=false)
     */
    protected $email;

    /**
     * @var string
     *
     * @ORM\Column(name="telephone", type="string", length=15, nullable=false)
     */
    protected $telephone;



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
     * Set userId
     *
     * @param integer $userId
     * @return OldSfGuardUserProfile
     */
    public function setUserId($userId)
    {
        $this->userId = $userId;

        return $this;
    }

    /**
     * Get userId
     *
     * @return integer 
     */
    public function getUserId()
    {
        return $this->userId;
    }

    /**
     * Set completeName
     *
     * @param string $completeName
     * @return OldSfGuardUserProfile
     */
    public function setCompleteName($completeName)
    {
        $this->completeName = $completeName;

        return $this;
    }

    /**
     * Get completeName
     *
     * @return string 
     */
    public function getCompleteName()
    {
        return $this->completeName;
    }

    /**
     * Set referentLanguage
     *
     * @param string $referentLanguage
     * @return OldSfGuardUserProfile
     */
    public function setReferentLanguage($referentLanguage)
    {
        $this->referentLanguage = $referentLanguage;

        return $this;
    }

    /**
     * Get referentLanguage
     *
     * @return string 
     */
    public function getReferentLanguage()
    {
        return $this->referentLanguage;
    }

    /**
     * Set email
     *
     * @param string $email
     * @return OldSfGuardUserProfile
     */
    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }

    /**
     * Get email
     *
     * @return string 
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set telephone
     *
     * @param string $telephone
     * @return OldSfGuardUserProfile
     */
    public function setTelephone($telephone)
    {
        $this->telephone = $telephone;

        return $this;
    }

    /**
     * Get telephone
     *
     * @return string 
     */
    public function getTelephone()
    {
        return $this->telephone;
    }
}
