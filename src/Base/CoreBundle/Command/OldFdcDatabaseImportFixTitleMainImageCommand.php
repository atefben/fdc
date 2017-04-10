<?php

namespace Base\CoreBundle\Command;

use Base\CoreBundle\Entity\OldArticleI18n;
use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

class OldFdcDatabaseImportFixTitleMainImageCommand extends ContainerAwareCommand
{

    private $locales = [
        'fr' => 'fr',
        'en' => 'en',
        'es' => 'fr',
        'zh' => 'cn',
    ];


    protected function configure()
    {
        $this
            ->setName('base:import:old_fdc_fix_title_image_main')
            ->addArgument('entity', InputArgument::REQUIRED)
            ->addOption('limit', null, InputOption::VALUE_OPTIONAL, '', null)
            ->addOption('offset', null, InputOption::VALUE_OPTIONAL, '', null)
            ->addOption('id', null, InputOption::VALUE_OPTIONAL | InputOption::VALUE_IS_ARRAY, '', [])
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $qb = $this
            ->getManager()
            ->getRepository('BaseCoreBundle:' . $input->getArgument('entity'))
            ->createQueryBuilder('o')
            ->andWhere('o.oldNewsId is not null')
        ;
        if ($input->getOption('id') && is_array($input->getOption('id'))) {
            $qb
                ->andWhere('o.id in (:id)')
                ->setParameter(':id', $input->getOption('id'))
            ;
        }
        $items = $qb
            ->getQuery()
            ->getResult()
        ;

        foreach ($items as $item) {
            $this->fixTitle($item);
        }
    }

    private function fixTitle($item)
    {
        if ($item->getOldNewsId() && $item->getHeader()) {
            foreach ($item->getHeader()->getTranslations() as $imageTrans) {
                $oldArticleI18n = $this
                    ->getManager()
                    ->getRepository('BaseCoreBundle:OldArticleI18n')
                    ->findOneBy([
                        'id'      => $item->getOldNewsId(),
                        'culture' => $this->locales[$imageTrans->getLocale()],
                    ])
                ;

                if ($oldArticleI18n instanceof OldArticleI18n) {
                    $imageTrans->setLegend($oldArticleI18n->getTitleImageResume());
                    $this->getManager()->flush();
                }
            }
        }
    }

    /**
     * @return \Doctrine\Common\Persistence\ObjectManager|object
     */
    protected function getManager()
    {
        return $this->getContainer()->get('doctrine')->getManager();
    }

}