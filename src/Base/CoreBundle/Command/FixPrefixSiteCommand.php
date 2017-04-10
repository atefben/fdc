<?php

namespace Base\CoreBundle\Command;

use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Finder\Finder;
use Symfony\Component\Finder\SplFileInfo;

class FixPrefixSiteCommand extends ContainerAwareCommand
{
    protected function configure()
    {
        $this
            ->setName('base:core:fix-prefix-site')
            ->addOption('site', null, InputOption::VALUE_REQUIRED, 'fdc_event or fdc_corporate')
            ->addOption('prefix', null, InputOption::VALUE_REQUIRED, 'Prefix to add or remove')
            ->addOption('remove', null, InputOption::VALUE_NONE)
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $finder = new Finder();
        $finder->name('routes.*.xliff');
        $site = $input->getOption('site');
        $prefix = $input->getOption('prefix');
        $remove = $input->getOption('remove');

        foreach ($finder->in($this->getTranslationsPath()) as $file) {
            if ($file instanceof SplFileInfo) {
                copy($file->getPathname(), $file->getPathname() . '.backup-'.date('Y-m-d-H:i:s'));
                $doc = new \DOMDocument('1.0', 'utf-8');
                $doc->load($file->getPathname());
                foreach ($doc->getElementsByTagName('trans-unit') as $e) {
                    if ($e instanceof \DOMElement && $e->hasAttribute('resname') && strpos($e->getAttribute('resname'), $site) !== false) {
                        $source = $e->getElementsByTagName('source')->item(0);
                        $target = $e->getElementsByTagName('target')->item(0);
                        if ($remove) {
                            $source->nodeValue = str_replace($prefix, '', $source->nodeValue);
                            $target->nodeValue = str_replace($prefix, '', $target->nodeValue);
                        } else {
                            $source->nodeValue = $prefix . $source->nodeValue;
                            $target->nodeValue = $prefix . $target->nodeValue;
                        }
                    }
                }
                $doc->save($file->getPathname());
            }
        }

    }

    private function getTranslationsPath()
    {
        return $this->getContainer()->get('kernel')->getRootDir() . '/Resources/translations';
    }

}