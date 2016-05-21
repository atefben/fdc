<?php

namespace Base\AdminBundle\Command;

use Base\CoreBundle\Interfaces\SocialWallInterface;
use Symfony\Component\Security\Acl\Domain\ObjectIdentity;

use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

/**
 * Class RegenerateAclCommand
 * @package FDC\EventBundle\Command
 */
class RegenerateAclCommand extends ContainerAwareCommand {
    /**
     * configure function.
     *
     * @access protected
     * @return void
     */
    protected function configure() {
        $this->setName('base:admin:regenerate_acl');
        $this->setDescription('Regenerate acl for specific entity');
        $this->addArgument(
            'entity'
        );

    }

    /**
     * execute function.
     *
     * @access protected
     * @param InputInterface $input
     * @param OutputInterface $output
     * @return void
     */
    protected function execute(InputInterface $input, OutputInterface $output) {

        $adminSecurityHandler = $this->getContainer()->get('sonata.admin.security.handler');
        $modelAdmin = $this->getContainer()->get('base.admin.social_wall');

        $em     = $this->getContainer()->get('doctrine')->getManager();
        $entity = $input->getArgument('entity');

        $ids = $em->getRepository($entity)->getIdsByNetwork(SocialWallInterface::NETWORK_TWITTER);

        $output->writeln('Updating: '. $entity);
        $output->writeln('Entities count: '. count($ids));

        //update ACL
        foreach ($ids as $key => $id) {
            $object = $em->getRepository($entity)->findOneById($id);
            $objectIdentity = ObjectIdentity::fromDomainObject($object);
            $acl = $adminSecurityHandler->getObjectAcl($objectIdentity);
            if (is_null($acl)) {
                $acl = $adminSecurityHandler->createAcl($objectIdentity);
            }
            $adminSecurityHandler->addObjectClassAces($acl, $adminSecurityHandler->buildSecurityInformation($modelAdmin));
            $adminSecurityHandler->updateAcl($acl);
            $output->writeln('Updated:'. ($key + 1). '/'. count($ids));
        }

        $output->writeln('Entities updated: '. count($ids));

    }

}