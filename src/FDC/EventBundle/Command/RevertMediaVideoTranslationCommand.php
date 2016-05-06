<?php

namespace FDC\EventBundle\Command;

use Aws\ElasticTranscoder\ElasticTranscoderClient;
use Base\CoreBundle\Entity\MediaVideoTranslation;
use Doctrine\ORM\QueryBuilder;
use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Helper\ProgressBar;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Filesystem\Filesystem;
use Symfony\Component\Filesystem\Exception\IOExceptionInterface;

/**
 * Class AWSCallbackCommand
 * @package FDC\EventBundle\Command
 */
class RevertMediaVideoTranslationCommand extends ContainerAwareCommand
{
    /**
     * configure function.
     *
     * @access protected
     * @return void
     */
    protected function configure()
    {
        $this
            ->setName('revert-media-video-translation');
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
        $result = $this
            ->getManager()
            ->getRepository('BaseCoreBundle:MediaVideoTranslation')
            ->createQueryBuilder('mv')
            ->andWhere('mv.amazonRemoteFile is null')
            ->andWhere('mv.file is null')
            ->andWhere('mv.jobWebmState = 3')
            ->andWhere('mv.jobMp4State = 3')
            ->getQuery()
            ->getResult()
        ;

        if (count($result)) {
            $progress = new ProgressBar($output, count($result));
            $progress->start();

            foreach ($result as $mv) {
                if ($mv instanceof MediaVideoTranslation) {
                    if (strpos($mv->getMp4Url(), 'media_video_encoded/direct_encoded/') !== false) {
                        $search = str_replace(array('media_video_encoded/direct_encoded/', '.mp4'), '', $mv->getMp4Url());
                        $arf = $this->getAmazonRemoteFile($search);
                        $mv->setAmazonRemoteFile($arf);
                        $this->getManager()->persist($mv);
                        $progress->advance();
                    }
                }

            }
            $this->getManager()->flush();
        }

        $progress->finish();
    }

    protected function getAmazonRemoteFile($string)
    {
        return $this
            ->getManager()
            ->getRepository('BaseCoreBundle:AmazonRemoteFile')
            ->createQueryBuilder('a')
            ->andWhere('a.url like :url')
            ->setMaxResults(1)
            ->setParameter('url', "%$string%")
            ->getQuery()
            ->getOneOrNullResult()
            ;

    }

    /**
     * @return \Doctrine\Common\Persistence\ObjectManager|object
     */
    protected function getManager()
    {
        return $this->getContainer()->get('doctrine')->getManager();
    }

}