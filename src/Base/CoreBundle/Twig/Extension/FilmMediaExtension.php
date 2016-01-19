<?php

namespace Base\CoreBundle\Twig\Extension;

use \Twig_Extension;

/**
 * FilmMediaExtension class.
 *
 * @extends Twig_Extension
 * @author  Antoine Mineau
 * @company Ohwee
 */
class FilmMediaExtension extends Twig_Extension
{

    private $em;

    public function __construct($em)
    {
        $this->em = $em;
    }

    public function getFilters()
    {
        return array(
            new \Twig_SimpleFilter('film_media', array($this, 'getMedias')),
        );
    }

    public function getMedias($film, $type)
    {
        $medias = array();
        foreach($film->getMedias() as $media) {
            if($media->getType() == $type) {
                $medias[] = $media->getMedia()->getFile();
            }
        }
        return $medias;
    }


    /**
     * getName function.
     *
     * @access public
     * @return void
     */
    public function getName()
    {
        return 'film_media_extension';
    }
}