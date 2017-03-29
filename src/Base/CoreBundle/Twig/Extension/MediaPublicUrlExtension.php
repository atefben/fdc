<?php

namespace Base\CoreBundle\Twig\Extension;

use Symfony\Component\DependencyInjection\ContainerInterface;
use Twig_Extension;

/**
 * Class MediaExtension
 * @package Base\CoreBundle\Twig\Extension
 */
class MediaPublicUrlExtension extends Twig_Extension
{

    /**
     * @var ContainerInterface
     */
    protected $container;

    public function __construct(ContainerInterface $container)
    {
        $this->container = $container;
    }

    public function getFilters()
    {
        return [
            new \Twig_SimpleFilter('media_public_url', [$this, 'getMediaPublicUrl']),
        ];
    }

    public function getFunctions()
    {
        return [
            new \Twig_SimpleFunction('media_public_url', [$this, 'getMediaPublicUrl']),
        ];
    }

    /**
     * @param $media
     * @param $format
     * @return mixed
     */
    public function getMediaPublicUrl($media, $format)
    {
        $provider = $this->container->get($media->getProviderName());
        $format = $provider->getFormatName($media, $format);
        return $provider->generatePublicUrl($media, $format);
    }

    /**
     * @return string
     *
     */
    public function getName()
    {
        return 'media_public_url_extension';
    }
}