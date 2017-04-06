<?php

namespace Base\AdminBundle\Command;

use Base\CoreBundle\Entity\GraphicalCharter;
use Base\CoreBundle\Entity\GraphicalCharterTranslation;
use Base\CoreBundle\Interfaces\SocialWallInterface;
use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Security\Acl\Domain\ObjectIdentity;

/**
 * Class RegenerateAclSocialWallTwitterCommand
 * @package FDC\EventBundle\Command
 */
class GraphicalCharterCommand extends ContainerAwareCommand
{
    /**
     * configure function.
     *
     * @access protected
     * @return void
     */
    protected function configure()
    {
        $this->setName('base:admin:graphical-charter');

    }

    /**
     * execute function.
     *
     * @access protected
     * @param InputInterface $input
     * @param OutputInterface $output
     * @return void
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $gc = $this
            ->getDoctrineManager()
            ->getRepository('BaseCoreBundle:GraphicalCharter')
            ->find(1)
        ;

        if (!$gc) {
            $gc = new GraphicalCharter();
            $this->getDoctrineManager()->persist($gc);

            foreach (['fr', 'en', 'es', 'zh'] as $locale) {
                $gct = new GraphicalCharterTranslation();
                $gct->setLocale($locale);
                $gct->setTranslatable($gc);
                $this->getDoctrineManager()->persist($gct);
            }

            $this->getDoctrineManager()->flush();
            $output->writeln('Graphical charter (with id 1) has been added');
        }
        else {
            $output->writeln('Graphical charter (with id 1) already exists');
        }

        $adminSecurityHandler = $this->getContainer()->get('sonata.admin.security.handler');
        $modelAdmin = $this->getContainer()->get('base.admin.graphical_charter');
        $securityInformation = $adminSecurityHandler->buildSecurityInformation($modelAdmin);

        $objectIdentity = ObjectIdentity::fromDomainObject($gc);
        $acl = $adminSecurityHandler->getObjectAcl($objectIdentity);
        if (is_null($acl)) {
            $acl = $adminSecurityHandler->createAcl($objectIdentity);
        }

        $adminSecurityHandler->addObjectClassAces($acl, $securityInformation);
        $adminSecurityHandler->updateAcl($acl);
    }


    private function getDoctrineManager()
    {
        return $this->getContainer()->get('doctrine')->getManager();
    }
}