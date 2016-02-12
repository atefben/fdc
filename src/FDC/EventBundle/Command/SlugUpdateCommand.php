<?php

namespace FDC\EventBundle\Command;

use Doctrine\Bundle\DoctrineBundle\Registry;
use Doctrine\Common\Persistence\ObjectManager;
use Gedmo\Sluggable\Util\Urlizer;
use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Helper\ProgressBar;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Filesystem\Filesystem;
use Symfony\Component\Filesystem\Exception\IOExceptionInterface;

/**
 * Class SlugUpdateCommand
 * @package FDC\EventBundle\Command
 */
class SlugUpdateCommand extends ContainerAwareCommand
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
            ->setName('fdc:slug:update')
            ->setDescription('Start or stop the fdc event')
            ->addArgument('entity', InputArgument::REQUIRED, 'The entity shortName to update')
            ->addOption('field', null, InputOption::VALUE_REQUIRED|InputOption::VALUE_IS_ARRAY, 'The fields used to build the slug')
        ;
    }

    /**
     * @param InputInterface $input
     * @param OutputInterface $output
     * @return null|int
     * @throws \Exception
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {

        // Check if the given fields and slug are used by the entity
        $metadata = $this->getManager()->getClassMetadata($input->getArgument('entity'));
        $fields = $input->getOption('field');
        foreach (array_merge(['slug'], $fields) as $field) {
            if (!$metadata->hasField($field)) {
                $output->writeln("<error>Field $field not found</error>");
            }
        }

        $objects = $this->getManager()->getRepository($input->getArgument('entity'))->findAll();

        $progress = new ProgressBar($output, count($objects));
        $progress->start();

        foreach ($objects as $object) {
            $slug = '';
            foreach ($fields as $field) {
                $slug .= $slug ? '-': '';
                $slug .= Urlizer::urlize($object->{'get'.ucfirst($field)}());
            }
            $object->setSlug($slug);
            $this->getManager()->persist($object);
            $this->getManager()->flush();
            $this->getManager()->clear($object);
            $progress->advance();
        }

        $progress->finish();
        $output->writeln('<info>The slug have been updated.</info>');

        return;
    }

    /**
     * @return ObjectManager
     */
    protected function getManager()
    {
        return $this->getDoctrine()->getManager();
    }

    /**
     * @return Registry
     */
    protected function getDoctrine()
    {
        return $this->getContainer()->get('doctrine');
    }

}