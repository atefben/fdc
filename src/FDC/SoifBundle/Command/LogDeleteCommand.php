<?php

namespace FDC\SoifBundle\Command;

use \DateInterval;
use \DateTime;

use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

/**
 * LogDeleteCommand class.
 * 
 * @extends ContainerAwareCommand
 */
class LogDeleteCommand extends ContainerAwareCommand
{
    /**
     * configure function.
     * 
     * @access protected
     * @return void
     */
    protected function configure() {
        $this
            ->setName('fdc:soif:log_delete')
            ->setDescription('Delete the soif log file based on soif_log_expiration parameter')
        ;
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
        $soifLogDir = $this->getContainer()->getParameter('soif_log_directory');
        $soifLogExpiration = $this->getContainer()->getParameter('soif_log_expiration');
        $logger = $this->getContainer()->get('logger');
        
        $fileExclusions = array('.', '..');
        $files = scandir($soifLogDir);
        
        $dateDelete = new DateTime();
        $dateDelete->sub(DateInterval::createFromDateString($soifLogExpiration));
        
        foreach ($files as $file) {
            if (in_array($file, $fileExclusions)) {
                continue;
            }
            
            if (filemtime($soifLogDir. $file) <= $dateDelete->getTimestamp()) {
                if (@unlink($soifLogDir. $file) === false) {
                    $logger->warn(__METHOD__. 'Couldn\'t delete the soif log file : '. $soifLogDir. $file);
                } else {
                    $logger->info('Soif log file deleted :'. $soifLogDir. $file);
                }
            }
        }
    }

}