<?php
/**
 * Created by PhpStorm.
 * User: piebel
 * Date: 22/01/2016
 * Time: 14:44
 */

namespace Base\CoreBundle\Twig\Extension;

use \Twig_Extension;

class InfoTypeExtension extends Twig_Extension
{

    private $em;

    public function __construct($em)
    {
        $this->em = $em;
    }

    public function getFilters()
    {
        return array(
            new \Twig_SimpleFilter('get_info_type', array($this, 'getInfoType')),
        );
    }

    public function getInfoType($infoType)
    {
        $type = null;

        switch ($infoType) {
            case "InfoArticle":
                $type = 'article';
                break;
            case "InfoAudio":
                $type = 'audio';
                break;
            case "InfoImage":
                $type = 'image';
                break;
            case "InfoVideo":
                $type = 'video';
                break;
        }

        return $type;
    }


    /**
     * getName function.
     *
     * @access public
     * @return void
     */
    public function getName()
    {
        return 'info_type_extension';
    }
}