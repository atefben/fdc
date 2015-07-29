<?php

namespace FDC\CoreBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

use FDC\CoreBundle\Util\Time;

/**
 * FilmTranslationType
 *
 * @ORM\Table()
 * @ORM\Entity
 * @ORM\HasLifecycleCallbacks
 */
class FilmTranslationType
{
    use Time;

    /**
     * @var string
     *
     * @ORM\Column(type="integer")
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
     * @ORM\Column(type="string", length=200)
     */
    private $wording;

    /**
     * @var string
     *
     * @ORM\Column(type="string", length=50, nullable=true)
     */
    private $tableDest;

    /**
     * @var string
     *
     * @ORM\Column(type="string", length=50, nullable=true)
     */
    private $tableOrig;

    /**
     * @var string
     *
     * @ORM\Column(type="string", length=50, nullable=true)
     */
    private $tableKey;

    /**
     * @var string
     *
     * @ORM\Column(type="string", length=50)
     */
    private $tableColumn;
    
    /**
     * @var FilmTranslation
     *
     * @ORM\OneToMany(targetEntity="FilmFilmTranslation", mappedBy="type")
     */
    private $filmTranslations;
    
    /**
     * @var FilmTranslation
     *
     * @ORM\OneToMany(targetEntity="FilmAtelierTranslation", mappedBy="type")
     */
    private $filmAtelierTranslations;
}
