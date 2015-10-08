<?php

/**
 * This file is part of the <name> project.
 *
 * (c) <yourname> <youremail>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Application\Sonata\MediaBundle\Entity;

use Sonata\MediaBundle\Entity\BaseMedia as SonataBaseMedia;

use JMS\Serializer\Annotation\Groups;
use JMS\Serializer\Annotation\Since;

/**
 * This file has been generated by the Sonata EasyExtends bundle ( http://sonata-project.org/bundles/easy-extends )
 *
 * References :
 *   working with object : http://www.doctrine-project.org/projects/orm/2.0/docs/reference/working-with-objects/en
 *
 * @author <yourname> <youremail>
 */
class Media extends SonataBaseMedia
{
    /**
     * @var integer $id
     */
    protected $id;

    protected $soifId;

    protected $projectionMedias;

    protected $filmMedias;

    protected $sites;
    
    protected $newsWidgetAudios;
    
    public function __construct()
    {
        $this->enabled = true;
    }

    /**
     * Get id
     *
     * @return integer $id
     */
    public function getId()
    {
        return $this->id;
    }
    
    public function setSoifId($soifId)
    {
        $this->soifId = $soifId;
    }
    
    public function getSoifId()
    {
        return $this->soifId;
    }
}