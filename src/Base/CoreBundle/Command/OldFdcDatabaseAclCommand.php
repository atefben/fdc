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
        $output->writeln('<info>Generate ACL for infos</info>');
        $infos = $this->getInfos();
        $output->writeln('<comment>'.count($infos).' items</comment>');
        $this->updateAcl($infos, 'base.admin.info_article');
        $this->getManager()->clear();
        unset($infos);

        $output->writeln('<info>Generate ACL for statements</info>');
        $statements = $this->getStatements();
        $output->writeln('<comment>'.count($statements).' items</comment>');
        $this->updateAcl($statements, 'base.admin.statement_article');
        $this->getManager()->clear();
        unset($statements);

        $output->writeln('<info>Generate ACL for news</info>');
        $news = $this->getNews();
        $output->writeln('<comment>'.count($news).' items</comment>');
        $this->updateAcl($news, 'base.admin.news_article');
        $this->getManager()->clear();
        unset($news);

        $output->writeln('<info>Generate ACL for images</info>');
        $images = $this->getImages();
        $output->writeln('<comment>'.count($images).' items</comment>');
        $this->updateAcl($images, 'base.admin.media_image');
        $this->getManager()->clear();
        unset($images);

        $output->writeln('<info>Generate ACL for audios/info>');
        $audios = $this->getAudios();
        $output->writeln('<comment>'.count($audios).' items</comment>');
        $this->updateAcl($audios, 'base.admin.media_image');
        $this->getManager()->clear();
        unset($audios);

        $output->writeln('<info>Generate ACL for videos</info>');
        $videos = $this->getVideos();
        $output->writeln('<comment>'.count($videos).' items</comment>');
        $this->updateAcl($videos, 'base.admin.media_image');
        $this->getManager()->clear();
        unset($videos);
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

    /**
     * @return InfoArticle[]
     */
    protected function getStatements()
    {
        return $this
            ->getManager()
            ->getRepository('BaseCoreBundle:StatementArticle')
            ->createQueryBuilder('i')
            ->andWhere('i.oldNewsId is not null')
            ->getQuery()
            ->getResult()
            ;
    }

    /**
     * @return InfoArticle[]
     */
    protected function getNews()
    {
        return $this
            ->getManager()
            ->getRepository('BaseCoreBundle:NewsArticle')
            ->createQueryBuilder('i')
            ->andWhere('i.oldNewsId is not null')
            ->getQuery()
            ->getResult()
            ;
    }

    /**
     * @return MediaImage[]
     */
    protected function getImages()
    {
        return $this
            ->getManager()
            ->getRepository('BaseCoreBundle:MediaImage')
            ->createQueryBuilder('m')
            ->andWhere('m.oldMediaId is not null')
            ->getQuery()
            ->getResult()
            ;
    }

    /**
     * @return MediaAudio[]
     */
    protected function getAudios()
    {
        return $this
            ->getManager()
            ->getRepository('BaseCoreBundle:MediaAudio')
            ->createQueryBuilder('m')
            ->andWhere('m.oldMediaId is not null')
            ->getQuery()
            ->getResult()
            ;
    }

    /**
     * @return MediaVideo[]
     */
    protected function getVideos()
    {
        return $this
            ->getManager()
            ->getRepository('BaseCoreBundle:MediaVideo')
            ->createQueryBuilder('m')
            ->andWhere('m.oldMediaId is not null')
            ->getQuery()
            ->getResult()
            ;
    }
}