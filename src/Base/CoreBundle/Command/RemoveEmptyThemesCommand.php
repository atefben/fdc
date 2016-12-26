<?php

namespace Base\CoreBundle\Command;

use Base\CoreBundle\Entity\Theme;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Helper\ProgressBar;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class RemoveEmptyThemesCommand extends ContainerAwareCommand
{

    protected function configure()
    {
        $this->setName('base:remove-empty-themes');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $this->fixTheme($output);
        $themes = $this->getManager()->getRepository('BaseCoreBundle:Theme')->findAll();
        $deleted = 0;
        $progress = new ProgressBar($output, count($themes));
        $progress->setFormat(' %current%/%max% [%bar%] %percent:3s%% %elapsed:6s%/%estimated:-6s% %memory:6s%');
        $progress->start();
        foreach ($themes as $theme) {
            $progress->advance();
            if (!count($theme->getTranslations())) {
                $this->fixUniqueTheme($theme);
                $this->getManager()->remove($theme);
                $this->getManager()->flush();
                ++$deleted;
            }
        }
        $progress->finish();
        $output->writeln("<info>$deleted themes have been deleted.</info>");
    }


    /**
     * @return ObjectManager
     */
    private function getManager()
    {
        return $this->getContainer()->get('doctrine')->getManager();
    }


    private function fixTheme(OutputInterface $output)
    {
        $output->writeln('<info>Fix news theme</info>');
        $this
            ->getManager()
            ->getRepository('BaseCoreBundle:NewsArticle')
            ->createQueryBuilder('n')
            ->update('BaseCoreBundle:NewsArticle', 'n')
            ->andWhere('n.oldNewsId is not null')
            ->set('n.theme', 48)
            ->getQuery()
            ->execute()
        ;
        $output->writeln('<info>Fix info theme</info>');
        $this
            ->getManager()
            ->getRepository('BaseCoreBundle:InfoArticle')
            ->createQueryBuilder('n')
            ->update('BaseCoreBundle:InfoArticle', 'n')
            ->andWhere('n.oldNewsId is not null')
            ->set('n.theme', 48)
            ->getQuery()
            ->execute()
        ;
        $output->writeln('<info>Fix statement theme</info>');
        $this
            ->getManager()
            ->getRepository('BaseCoreBundle:StatementArticle')
            ->createQueryBuilder('n')
            ->update('BaseCoreBundle:StatementArticle', 'n')
            ->andWhere('n.oldNewsId is not null')
            ->set('n.theme', 48)
            ->getQuery()
            ->execute()
        ;
        $output->writeln('<info>Fix media theme</info>');
        $this
            ->getManager()
            ->getRepository('BaseCoreBundle:Media')
            ->createQueryBuilder('n')
            ->update('BaseCoreBundle:Media', 'n')
            ->andWhere('n.oldMediaId is not null')
            ->set('n.theme', 48)
            ->getQuery()
            ->execute()
        ;
    }


    private function fixUniqueTheme(Theme $theme)
    {
        $this
            ->getManager()
            ->getRepository('BaseCoreBundle:News')
            ->createQueryBuilder('n')
            ->update('BaseCoreBundle:News', 'n')
            ->andWhere('n.theme = :theme')
            ->setParameter(':theme', $theme->getId())
            ->set('n.theme', 48)
            ->getQuery()
            ->execute()
        ;
        $this
            ->getManager()
            ->getRepository('BaseCoreBundle:Info')
            ->createQueryBuilder('n')
            ->update('BaseCoreBundle:Info', 'n')
            ->andWhere('n.theme = :theme')
            ->setParameter(':theme', $theme->getId())
            ->set('n.theme', 48)
            ->getQuery()
            ->execute()
        ;
        $this
            ->getManager()
            ->getRepository('BaseCoreBundle:Statement')
            ->createQueryBuilder('n')
            ->update('BaseCoreBundle:Statement', 'n')
            ->andWhere('n.theme = :theme')
            ->setParameter(':theme', $theme->getId())
            ->set('n.theme', 48)
            ->getQuery()
            ->execute()
        ;
        $this
            ->getManager()
            ->getRepository('BaseCoreBundle:Media')
            ->createQueryBuilder('n')
            ->update('BaseCoreBundle:Media', 'n')
            ->andWhere('n.theme = :theme')
            ->setParameter(':theme', $theme->getId())
            ->set('n.theme', 48)
            ->getQuery()
            ->execute()
        ;
    }
}