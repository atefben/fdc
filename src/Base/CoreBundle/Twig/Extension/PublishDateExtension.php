<?php

namespace Base\CoreBundle\Twig\Extension;

use \DateTime;
use \Twig_Extension;

/**
 * PublicationDateExtension class.
 *
 * @extends Twig_Extension
 * @author  Antoine Mineau
 * @company Ohwee
 */
class PublishDateExtension extends Twig_Extension
{
    public function getFilters()
    {
        return array(
            new \Twig_SimpleFilter('publish_date', array($this, 'publishDateFilter')),
        );
    }

    public function publishDateFilter($object)
    {
        if ($object && $object->getTranslatable() &&
            ($object->getTranslatable()->getPublishedAt() == null || $object->getTranslatable()->getPublishedAt() <= new DateTime()) &&
            ($object->getTranslatable()->getPublishedEndedAt() == null || $object->getTranslatable()->getPublishedEndedAt() >= new DateTime())) {
            return true;
        }


       return false;
    }

    /**
     * getName function.
     *
     * @access public
     * @return void
     */
    public function getName()
    {
        return 'publish_date_extension';
    }
}