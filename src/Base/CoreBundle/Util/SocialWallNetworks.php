<?php

namespace Base\CoreBundle\Util;

/**
 * SocialWall trait.
 *
 * @author  Antoine Mineau
 * @company Ohwee
 */
trait SocialWallNetworks
{
    public static function getNetworks(){
        return array(
            self::NETWORK_TWITTER => 'form.social_wall.twitter',
            self::NETWORK_INSTAGRAM => 'form.social_wall.instagram',
            self::NETWORK_TUMBLR => 'form.social_wall.tumblr'
        );
    }

}