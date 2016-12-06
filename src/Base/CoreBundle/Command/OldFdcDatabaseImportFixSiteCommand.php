<?php

namespace Base\CoreBundle\Command;

use Base\CoreBundle\Entity\InfoArticle;
use Base\CoreBundle\Entity\NewsArticle;
use Base\CoreBundle\Entity\StatementArticle;
use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Helper\ProgressBar;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class OldFdcDatabaseImportFixSiteCommand extends ContainerAwareCommand
{
    protected function configure()
    {
        $this
            ->setName('base:import:old_fdc_fix_site');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $news = $this->getNews();
        $infos = $this->getInfos();
        $statements = $this->getStatements();

        $items = array_merge($news, $infos, $statements);

        $bar = new ProgressBar($output, count($items));
        $bar->setFormat(' %current%/%max% [%bar%] %percent:3s%% %elapsed:6s%/%estimated:-6s% %memory:6s%');
        $bar->start();

        $site = $this->getSite();
        $count = 0;
        foreach ($items as $item) {
            $bar->advance();
            ++$count;
            if (!$item->getSites()->contains($site)) {
                $item->addSite($site);
            }
            if ($count == 100) {
                $count = 0;
                $this->getManager()->flush();
            }
        }

        $bar->finish();
        $output->writeln('');
    }

    protected function getManager()
    {
        return $this->getContainer()->get('doctrine')->getManager();
    }

    protected function getSite()
    {
        return $this->getManager()->getRepository('BaseCoreBundle:Site')->findOneBy(['slug' => 'site-institutionnel']);
    }

    /**
     * @return NewsArticle[]
     */
    protected function getNews()
    {
        return $this
            ->getManager()
            ->getRepository('BaseCoreBundle:NewsArticle')
            ->createQueryBuilder('n')
            ->andWhere('n.oldNewsId is not null')
            ->getQuery()
            ->getResult()
            ;
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
     * @return StatementArticle[]
     */
    protected function getStatements()
    {
        return $this
            ->getManager()
            ->getRepository('BaseCoreBundle:StatementArticle')
            ->createQueryBuilder('s')
            ->andWhere('s.oldNewsId is not null')
            ->getQuery()
            ->getResult()
            ;
    }
}