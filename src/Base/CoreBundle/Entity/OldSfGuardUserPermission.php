<?php

namespace Base\CoreBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * OldSfGuardUserPermission
 *
 * @ORM\Table(name="old_sf_guard_user_permission", indexes={@ORM\Index(name="sf_guard_user_permission_FI_2", columns={"permission_id"})})
 * @ORM\Entity
 */
class OldSfGuardUserPermission
{
    /**
     * @var integer
     *
     * @ORM\Column(name="user_id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     */
    private $userId;

    /**
     * @var integer
     *
     * @ORM\Column(name="permission_id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     */
    private $permissionId;



    /**
     * Set userId
     *
     * @param integer $userId
     * @return OldSfGuardUserPermission
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
     * Set permissionId
     *
     * @param integer $permissionId
     * @return OldSfGuardUserPermission
     */
    public function setPermissionId($permissionId)
    {
        $this->permissionId = $permissionId;

        return $this;
    }

    /**
     * Get permissionId
     *
     * @return integer 
     */
    public function getPermissionId()
    {
        return $this->permissionId;
    }
}
