<?php

use Symfony\Component\HttpKernel\Kernel;
use Symfony\Component\Config\Loader\LoaderInterface;

class AppKernel extends Kernel
{
    public function registerBundles()
    {
        $bundles = array(
            /* Symfony */
            new Symfony\Bundle\FrameworkBundle\FrameworkBundle(),
            new Symfony\Bundle\SecurityBundle\SecurityBundle(),
            new Symfony\Bundle\TwigBundle\TwigBundle(),
            new Symfony\Bundle\MonologBundle\MonologBundle(),
            new Symfony\Bundle\SwiftmailerBundle\SwiftmailerBundle(),
            new Symfony\Bundle\AsseticBundle\AsseticBundle(),
            new Doctrine\Bundle\DoctrineBundle\DoctrineBundle(),
            new Sensio\Bundle\FrameworkExtraBundle\SensioFrameworkExtraBundle(),
            /* Sonata */
            new Sonata\CoreBundle\SonataCoreBundle(),
            new Sonata\BlockBundle\SonataBlockBundle(),
            new Sonata\AdminBundle\SonataAdminBundle(),
            new Sonata\DoctrineORMAdminBundle\SonataDoctrineORMAdminBundle(),
            new Sonata\MediaBundle\SonataMediaBundle(),
            new Sonata\IntlBundle\SonataIntlBundle(),
            new Sonata\EasyExtendsBundle\SonataEasyExtendsBundle(),
            new Sonata\SeoBundle\SonataSeoBundle(),
            new JMS\SerializerBundle\JMSSerializerBundle(),
            new Knp\Bundle\MenuBundle\KnpMenuBundle(),
            new Application\Sonata\AdminBundle\ApplicationSonataAdminBundle(),
            new Application\Sonata\DoctrineORMAdminBundle\ApplicationSonataDoctrineORMAdminBundle(),
            new Application\Sonata\MediaBundle\ApplicationSonataMediaBundle(),
            new Application\Sonata\UserBundle\ApplicationSonataUserBundle(),
            new CoopTilleuls\Bundle\CKEditorSonataMediaBundle\CoopTilleulsCKEditorSonataMediaBundle(),
            /* Api */
            new FOS\RestBundle\FOSRestBundle(),
            new Nelmio\ApiDocBundle\NelmioApiDocBundle(),
            new Knp\Bundle\PaginatorBundle\KnpPaginatorBundle(),
            /* Doctrine Fixtures */
            new Doctrine\Bundle\FixturesBundle\DoctrineFixturesBundle(),
            /* CMS tools */
            new Infinite\FormBundle\InfiniteFormBundle(),
            new Ivory\CKEditorBundle\IvoryCKEditorBundle(),
            /* sluggable */
            new Stof\DoctrineExtensionsBundle\StofDoctrineExtensionsBundle(),
            /* Translations */
            new A2lix\I18nDoctrineBundle\A2lixI18nDoctrineBundle(),
            new A2lix\TranslationFormBundle\A2lixTranslationFormBundle(),
            new JMS\TranslationBundle\JMSTranslationBundle(),
            new JMS\DiExtraBundle\JMSDiExtraBundle($this),
            new JMS\AopBundle\JMSAopBundle(),
            new JMS\I18nRoutingBundle\JMSI18nRoutingBundle(),
            /* Front tools */
            new FOS\JsRoutingBundle\FOSJsRoutingBundle(),
            /* User Management */
            new FOS\UserBundle\FOSUserBundle(),
            new Sonata\UserBundle\SonataUserBundle('FOSUserBundle'),
            /* Application */
            new Base\CoreBundle\BaseCoreBundle(),
            new Base\AdminBundle\BaseAdminBundle(),
            new Base\SoifBundle\BaseSoifBundle(),
            new Base\ApiBundle\BaseApiBundle(),
            new FDC\CorporateBundle\FDCCorporateBundle(),
            new FDC\EventBundle\FDCEventBundle(),
            new FDC\PressBundle\FDCPressBundle(),
        );

        if (in_array($this->getEnvironment(), array('dev', 'test'))) {
            $bundles[] = new Symfony\Bundle\DebugBundle\DebugBundle();
            $bundles[] = new Symfony\Bundle\WebProfilerBundle\WebProfilerBundle();
            $bundles[] = new Sensio\Bundle\DistributionBundle\SensioDistributionBundle();
            $bundles[] = new Sensio\Bundle\GeneratorBundle\SensioGeneratorBundle();
        }

        return $bundles;
    }

    public function registerContainerConfiguration(LoaderInterface $loader)
    {
        $loader->load($this->getRootDir().'/config/config_'.$this->getEnvironment().'.yml');
    }
}
