<?php

namespace Base\AdminBundle\Security\Authorization\Voter;

use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Acl\Voter\AclVoter;

/**
 * Block users to access locked objects that doesnt belong to them
 *
 * Class NewsAclVoter
 * @package Base\AdminBundle\Security\Authorization\Voter
 */
class NewsAclVoter extends AclVoter
{
    /**
     * @var array
     */
    private $classes = array(
        'Base\CoreBundle\Entity\News'
    );

    /**
     * @param string $class
     * @return bool
     */
    public function supportsClass($class)
    {
        foreach ($this->classes as $lockedClass) {
            if ($class === $lockedClass || is_subclass_of($class, $lockedClass)) {
                return true;
            }
        }

        return false;
    }

    /**
     * @param string $attribute
     * @return bool
     */
    public function supportsAttribute($attribute)
    {
        return $attribute === 'EDIT';
    }

    /**
     * @param TokenInterface $token
     * @param null|object $object
     * @param array $attributes
     * @return int
     */
    public function vote(TokenInterface $token, $object, array $attributes)
    {
        $user = $token->getUser();

        if (!$this->supportsClass(get_class($object))) {
            return self::ACCESS_ABSTAIN;
        }

        foreach ($attributes as $attribute) {
            if ($this->supportsAttribute($attribute)) {
                if ($object->getLockedBy() !== null && $user->getId() !== $object->getLockedBy()->getId()) {
                    return self::ACCESS_DENIED;
                }
            }
        }

        return self::ACCESS_ABSTAIN;
    }
}