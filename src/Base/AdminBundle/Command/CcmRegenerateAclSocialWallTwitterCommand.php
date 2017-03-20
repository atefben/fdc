<?php

namespace Base\AdminBundle\Command;

use FDC\CourtMetrageBundle\Entity\CcmSocialWall;
use Symfony\Component\Security\Acl\Domain\ObjectIdentity;

use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class CcmRegenerateAclSocialWallTwitterCommand extends ContainerAwareCommand {
    /**
     * configure function.
     *
     * @access protected
     * @return void
     */
    protected function configure() {
        $this->setName('base:admin:ccm_regenerate_acl_social_wall_twitter');
        $this->setDescription('Regenerate acl for Ccm Social Wall Twitter');
        $this->addArgument('count');

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
        $modelAdmin = $this->getContainer()->get('base.admin.ccm_social_wall');
        $securityInformation = $adminSecurityHandler->buildSecurityInformation($modelAdmin);

        $em  = $this->getContainer()->get('doctrine')->getManager();
        $count = $input->getArgument('count');
        $divisor = $count / 10;

        if ($count > 2000) {
            $count = 2000;
        }

        $ids = $em->getRepository('FDCCourtMetrageBundle:CcmSocialWall')->getIdsByNetwork(CcmSocialWall::NETWORK_TWITTER, $count);

        //update ACL
        foreach ($ids as $key => $id) {
            $object = $em->getRepository('FDCCourtMetrageBundle:CcmSocialWall')->findOneById($id);
            $objectIdentity = ObjectIdentity::fromDomainObject($object);
            $acl = $adminSecurityHandler->getObjectAcl($objectIdentity);
            if (is_null($acl)) {
                $acl = $adminSecurityHandler->createAcl($objectIdentity);
            }
            $adminSecurityHandler->addObjectClassAces($acl, $securityInformation);
            $adminSecurityHandler->updateAcl($acl);
            unset($object);
            if ($key % $divisor == 0) {
                $output->writeln('Updated:' . $key . '/' . $count);
            }
        }

        $output->writeln('Entities updated: '. $count);
    }
}
