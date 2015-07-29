<?php

namespace FDC\CoreBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

use FDC\CoreBundle\Util\Time;

/**
 * SiteTranslation
 *
 * @ORM\Table()
 * @ORM\Entity
 * @ORM\HasLifecycleCallbacks
 */
class SiteTranslation
{
    use Time;

    /**
     * @var string
     *
     * @ORM\Column(name="ID", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var \DateTime
     *
     * @ORM\Column(type="datetime")
     */
    private $createdAt;
    
    /**
     * @var \DateTime
     *
     * @ORM\Column(type="datetime")
     */
    private $updatedAt;

    /**
     * @var string
     *
     * @ORM\Column(type="string", length=3, nullable=true)
     */
    private $language;

    /**
     * @var string
     *
     * @ORM\Column(type="integer", nullable=true)
     */
    private $userId;

    /**
     * @var FilmAddress
     *
     * @ORM\ManyToOne(targetEntity="FilmTranslationType", inversedBy="translations")
     */
    private $type;

    /**
     * @var string
     *
     * @ORM\Column(type="integer", nullable=true)
     */
    private $enregId;

    /**
     * @var string
     *
     * @ORM\Column(type="text")
     */
    private $title;
}
