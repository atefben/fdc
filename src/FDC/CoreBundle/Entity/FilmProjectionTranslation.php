<?php

namespace FDC\CoreBundle\Entity;

use A2lix\I18nDoctrineBundle\Doctrine\ORM\Util\Translation;

use Doctrine\ORM\Mapping as ORM;

use FDC\CoreBundle\Util\Time;

/**
 * FilmProjectionTranslation
 *
 * @ORM\Table()
 * @ORM\Entity
 * @ORM\HasLifecycleCallbacks
 */
class FilmProjectionTranslation
{
    use Time;
    use Translation;

    
    /**
     * @var string
     *
     * @ORM\Column(type="text", nullable=true)
     */
    private $programSection;

    /**
     * Set programSection
     *
     * @param string $programSection
     * @return FilmFilmTranslation
     */
    public function setProgramSection($programSection)
    {
        $this->programSection = $programSection;

        return $this;
    }

    /**
     * Get programSection
     *
     * @return string 
     */
    public function getProgramSection()
    {
        return $this->programSection;
    }
}
