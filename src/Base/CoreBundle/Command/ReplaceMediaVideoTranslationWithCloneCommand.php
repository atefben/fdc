<?php

namespace Base\CoreBundle\Command;

use Application\Sonata\MediaBundle\Entity\Media;
use Base\CoreBundle\Entity\MediaVideo;
use Base\CoreBundle\Entity\MediaVideoTranslation;
use Base\CoreBundle\Entity\OldMediaI18n;
use Base\CoreBundle\Interfaces\TranslateChildInterface;
use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Helper\ProgressBar;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\DomCrawler\Crawler;

class ReplaceMediaVideoTranslationWithCloneCommand extends ContainerAwareCommand
{
    /**
     * @var OutputInterface
     */
    private $output;

    /**
     * @var InputInterface
     */
    private $input;

    private $locales = ['en', 'es', 'zh'];

    protected function configure()
    {
        $this
            ->setName('base:core:replace-video-translation-with-clone')
            ->addOption('id', null, InputOption::VALUE_OPTIONAL, 'media-video-id')
            ->addOption('offset', null, InputOption::VALUE_OPTIONAL, null)
            ->addOption('limit', null, InputOption::VALUE_OPTIONAL, null)
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $this->input = $input;
        $this->output = $output;

        $id = $input->getOption('id');
        $offset = $input->getOption('offset');
        $limit = $input->getOption('limit');

        if ($id) {
            $mediaVideoTranslation = $this
                ->getDoctrineManager()
                ->getRepository('BaseCoreBundle:MediaVideoTranslation')
                ->find($id)
            ;
            if ($mediaVideoTranslation instanceof MediaVideoTranslation) {
                $this->replaceWithClone($mediaVideoTranslation);
            }
            $output->writeln("<info>Video $id has been checked</info>");
        } else {
            $mediaVideoTranslations = $this
                ->getDoctrineManager()
                ->getRepository('BaseCoreBundle:MediaVideoTranslation')
                ->createQueryBuilder('m')
                ->andWhere('m.locale LIKE :clone')
                ->setParameter(':clone', "%clone")
                ->setFirstResult($offset)
                ->setMaxResults($limit)
                ->getQuery()
                ->getResult()
            ;

            if ($mediaVideoTranslations) {
                $progress = new ProgressBar($output, count($mediaVideoTranslations));
                $progress->setFormat(' %current%/%max% [%bar%] %percent:3s%% %elapsed:6s%/%estimated:-6s% %memory:6s%');
                $progress->start();
                foreach ($mediaVideoTranslations as $mediaVideoTranslation) {
                    $progress->advance();
                    if ($mediaVideoTranslation instanceof MediaVideoTranslation) {
                        $this->replaceWithClone($mediaVideoTranslation);
                    }
                }

                $progress->finish();
                $output->writeln('<info>Done</info>');
            } else {
                $output->writeln('<info>Videos not found</info>');
            }

        }
    }

    private function replaceWithClone(MediaVideoTranslation $mediaVideoTranslation)
    {
        $original = $this->getOrinalTranslation($mediaVideoTranslation);

        if ($original) {
            $this->getDoctrineManager()->remove($original);
            $mediaVideoTranslation->setLocale(str_replace('-clone', '', $mediaVideoTranslation->getLocale()));
            $this->getDoctrineManager()->flush();
        }
    }

    /**
     * @param MediaVideoTranslation $mediaVideoTranslation
     * @return MediaVideoTranslation
     */
    private function getOrinalTranslation(MediaVideoTranslation $mediaVideoTranslation)
    {
        return $this
            ->getDoctrineManager()
            ->getRepository('BaseCoreBundle:MediaVideoTranslation')
            ->findOneBy([
                'translatable' => $mediaVideoTranslation->getTranslatable()->getId(),
                'locale' => str_replace('-clone', '', $mediaVideoTranslation->getLocale()),
            ])
            ;
    }

    /**
     * @return \Doctrine\Common\Persistence\ObjectManager|object
     */
    private function getDoctrineManager()
    {
        return $this->getContainer()->get('doctrine')->getManager();
    }
}