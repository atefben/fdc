<?php

namespace Base\CoreBundle\Twig\Extension;

use Base\CoreBundle\Entity\Site;
use \Twig_Extension;

/**
 * Class SiteExtension
 * @package Base\CoreBundle\Twig\Extension
 */
class SiteExtension extends Twig_Extension
{
    /**
     * @return array
     */
    public function getFilters()
    {
        return array(
            new \Twig_SimpleFilter('is_published_on', array($this, 'isPublishedOn')),
        );
    }

    /**
     * @param $item
     * @param string $slug
     * @return bool
     */
    public function isPublishedOn($item, $slug = 'site-evenementiel')
    {
        if (is_object($item) && method_exists($item, 'getSites')) {
            foreach ($item->getSites() as $site) {
                if ($site instanceof Site) {
                    if ($site->getSlug() == $slug) {
                        return true;
                    }
                }
            }
        }
        return false;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'site_extension';
    }
}