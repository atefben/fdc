<?php

namespace Base\CoreBundle\Command;

use Application\Sonata\MediaBundle\Entity\Media;
use Base\CoreBundle\Entity\InfoArticle;
use Base\CoreBundle\Entity\MediaAudio;
use Base\CoreBundle\Entity\MediaAudioFilmFilmAssociated;
use Base\CoreBundle\Entity\MediaAudioTranslation;
use Base\CoreBundle\Entity\MediaImage;
use Base\CoreBundle\Entity\MediaImageTranslation;
use Base\CoreBundle\Entity\NewsArticleTranslation;
use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Security\Acl\Domain\ObjectIdentity;

class OldFdcDatabaseAclCommand extends ContainerAwareCommand
{
    protected function configure()
    {
        $this
            ->setName('base:acl:old_fdc')
            ->setDescription('Update ACL')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $infos = $this->getInfos();
        dump(count($infos));
        $this->updateAcl($infos, 'base.admin.info_article');
    }

    private function updateAcl($entities, $service)
    {
        $adminSecurityHandler = $this->getContainer()->get('sonata.admin.security.handler');
        $modelAdmin = $this->getContainer()->get($service);
        $securityInformation = $adminSecurityHandler->buildSecurityInformation($modelAdmin);

        foreach ($entities as $key => $object) {
            $objectIdentity = ObjectIdentity::fromDomainObject($object);
            $acl = $adminSecurityHandler->getObjectAcl($objectIdentity);
            if (is_null($acl)) {
                $acl = $adminSecurityHandler->createAcl($objectIdentity);
            }
            $adminSecurityHandler->addObjectClassAces($acl, $securityInformation);
            $adminSecurityHandler->updateAcl($acl);
            unset($object);
        }
    }

    /**
     * @return \Doctrine\Common\Persistence\ObjectManager|object
     */
    protected function getManager()
    {
        return $this->getContainer()->get('doctrine')->getManager();
    }

    /**
     * @return InfoArticle[]
     */
    protected function getInfos()
    {
        return $this
            ->getManager()
            ->getRepository('BaseCoreBundle:InfoArticle')
            ->createQueryBuilder('i')
            ->andWhere('i.oldNewsId is not null')
            ->getQuery()
            ->getResult()
            ;
    }
}