<?php

namespace FDC\CourtMetrageBundle\Entity;

use Base\CoreBundle\Entity\MediaVideo;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * CcmVideosCollection
 *
 * @ORM\Table(name="ccm_videos_collection")
 * @ORM\Entity
 * @ORM\HasLifecycleCallbacks()
 */
class CcmVideosCollection
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var MediaVideo
     *
     * @ORM\ManyToOne(targetEntity="Base\CoreBundle\Entity\MediaVideo")
     * @ORM\JoinColumn(name="video_id", referencedColumnName="id", onDelete="SET NULL")
     *
     */
    protected $video;

    /**
     * @ORM\ManyToOne(targetEntity="FDC\CourtMetrageBundle\Entity\Homepage", inversedBy="videosCollection")
     * @ORM\JoinColumn(name="homepage_id", referencedColumnName="id", onDelete="SET NULL")
     */
    private $homepage;

    /**
     * @var integer
     *
     * @ORM\Column(type="integer", nullable=true)
     */
    private $position;

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return int
     */
    public function getPosition()
    {
        return $this->position;
    }

    /**
     * @param int $position
     */
    public function setPosition($position)
    {
        $this->position = $position;
    }

    /**
     * @return MediaVideo
     */
    public function getVideo()
    {
        return $this->video;
    }

    /**
     * @param MediaVideo $video
     */
    public function setVideo($video)
    {
        $this->video = $video;
    }

    /**
     * @return mixed
     */
    public function getHomepage()
    {
        return $this->homepage;
    }

    /**
     * @param mixed $homepage
     */
    public function setHomepage($homepage)
    {
        $this->homepage = $homepage;
    }
}

