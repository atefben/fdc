<?php

namespace FDC\CoreBundle\Entity;


use A2lix\I18nDoctrineBundle\Doctrine\ORM\Util\Translatable;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

use FDC\CoreBundle\Util\Time;
use FDC\CoreBundle\Util\Soif;

/**
 * FilmPersonFilmFilm
 *
 * @ORM\Table()
 * @ORM\Entity()
 * @ORM\HasLifecycleCallbacks
 */
class FilmPersonFilmFilm
{
    use Time;
    
    /**
     * @var integer
     *
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\ManyToOne(targetEntity="FilmFilm", inversedBy="team")
     */
    private $film;
    
    /**
     * @var string
     *
     * @ORM\ManyToOne(targetEntity="FilmPerson", inversedBy="team")
     */
    private $person;

    /**
     * @var string
     *
     * @ORM\ManyToOne(targetEntity="FilmFunctions", inversedBy="team")
     */
    private $function;
}
