<?php

namespace Base\SoifBundle\Command;

use \DateTime;

use Base\CoreBundle\Entity\SoifTask;

use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\DependencyInjection\Exception\ServiceNotFoundException;

/**
 * Update class.
 * 
 * @extends ContainerAwareCommand
 * @author  Antoine Mineau <a.mineau@ohwee.fr>
 * @company Ohwee
 */
class UpdateCommand extends ContainerAwareCommand
{
    private $taskName = 'update';
    
    /**
     * configure function.
     * 
     * @access protected
     * @return void
     */
    protected function configure()
    {
        $this
            ->setName('base:soif:update')
            ->setDescription('Update the database with SOIF call timestamp interval')
            ->addOption('start', null, InputOption::VALUE_REQUIRED, 'the start timestamp')
            ->addOption('end', null, InputOption::VALUE_REQUIRED, 'the end timestamp', time())
            ->addOption('entity', null, InputOption::VALUE_REQUIRED, 'If defined, will update the only entity selected')
            ->addOption('save', null, InputOption::VALUE_NONE, 'If defined, will save the end timestamp in database')
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
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $em = $this->getContainer()->get('doctrine.orm.entity_manager');
        $end = $input->getOption('end');
        $entity = $input->getOption('entity');
        $save = $input->getOption('save');
        $logger = $this->getContainer()->get('logger');
        
        // start
        $start = $input->getOption('start');
        if ($start === null) {
            $soifTask = $em->getRepository('BaseCoreBundle:SoifTask')->findOneBy(array('taskName' => $this->taskName));
            if ($soifTask === null) {
                $msg = __METHOD__. " Couldn't find the taskName {$this->taskName} in table SoifTask";
                $output->writeln($msg);
                $this->getContainer()->get('logger')->error($msg);
                exit;
            }
            if (get_class($soifTask->getEndTimestamp()) !== 'DateTime') {
                $msg = 'Last call timestamp is not of type DateTime : '. get_class($soifTask->getEndTimestamp());
                $output->writeln($msg);
                $logger->err($msg);
                exit;
            }
            $start = $soifTask->getEndTimestamp()->getTimestamp();
        }
        
        // managers
        $managers = array(
          //  $this->getContainer()->get('base.soif.country_manager'),
          //  $this->getContainer()->get('base.soif.festival_manager'),
            $this->getContainer()->get('base.soif.award_manager'),
          /*  $this->getContainer()->get('base.soif.festival_poster_manager'),
            $this->getContainer()->get('base.soif.film_atelier_manager'),
            $this->getContainer()->get('base.soif.film_manager'),
            $this->getContainer()->get('base.soif.person_manager'),
            $this->getContainer()->get('base.soif.jury_manager'),
            $this->getContainer()->get('base.soif.projection_manager')*/
        );
        
        // check if manager exist when targetting a specific entity
        if ($entity) {
            try {
                $managers = array($this->getContainer()->get("base.soif.{$entity}_manager"));
            } catch (ServiceNotFoundException $e){
                $output->writeln("The entity {$entity} and its related service base.soif.{$entity}_manager are not found");
                exit;
           }
        }
        
        // call the managers
        foreach ($managers as $manager) {
            $manager->getModified($start, $end);
            // verify if method exists before call because prize manager doenst have a getRemoved method
            if (method_exists($manager, 'getRemoved')) {
                $manager->getRemoved($start, $end);
            }
        }
        
        // save in database the end timestamp
        if ($save !== null) {
            $soifTask = $em->getRepository('BaseCoreBundle:SoifTask')->findOneBy(array('taskName' => $this->taskName));
            $soifTask = ($soifTask !== null) ? $soifTask : new SoifTask();
            
            $dateTime = new DateTime();
            $dateTime->setTimestamp((int)$end);
            
            $soifTask->setTaskName($this->taskName);
            $soifTask->setEndTimestamp($dateTime);
            
            if ($soifTask->getId() == null) {
                $em->persist($soifTask);
            }
            $em->flush();
        }
    }

}