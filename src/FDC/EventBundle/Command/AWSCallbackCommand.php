<?php

namespace FDC\EventBundle\Command;

use Aws\ElasticTranscoder\ElasticTranscoderClient;
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
class AWSCallbackCommand extends ContainerAwareCommand
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
            ->setName('aws:callback')
            ->setDescription('Update job status for MediaVideoTranslation and MediaAudiTransation')
            ->addOption('with-output', null, InputOption::VALUE_NONE, 'Display progress bar.')
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
        $em = $this->getDoctrineManager();

        $medias = $em->getRepository('BaseCoreBundle:MediaVideoTranslation')->findBy(array('jobMp4State' => '1'));
        $this->batch($input, $output, $medias, 'mp4');

        $medias = $em->getRepository('BaseCoreBundle:MediaVideoTranslation')->findBy(array('jobWebmState' => '1'));
        $this->batch($input, $output, $medias, 'webm');

        $medias = $em->getRepository('BaseCoreBundle:MediaAudioTranslation')->findBy(array('jobMp3State' => '1'));
        $this->batch($input, $output, $medias, 'mp3');

        $em->flush();
    }

    public function batch(InputInterface $input, OutputInterface $output, $medias, $type)
    {
        $vars = array(
            'mp4'  => array(
                'method' => 'JobMp4',
            ),
            'webm' => array(
                'method' => 'JobWebm',
            ),
            'mp3'  => array(
                'method' => 'JobMp3',
            ),
        );

        if ($medias) {
            if ($input->getOption('with-output')) {
                $output->writeln('<info>Update statuses for ' . $type . '.</info>');
                $progress = new ProgressBar($output, count($medias));
                $progress->start();
            }

            foreach ($medias as $media) {
                $this->updateAmazonStatus($media, $media->{'get' . $vars[$type]['method'] . 'Id'}(), $vars[$type]['method']);
                if ($input->getOption('with-output')) {
                    $progress->advance();
                }
            }

            if ($input->getOption('with-output')) {
                $progress->finish();
                $output->writeln('');
            }
        }
    }

    public function updateAmazonStatus($media, $jobid, $type)
    {
        $elasticTranscoder = ElasticTranscoderClient::factory(array(
            'credentials' => array(
                'key'    => 'AKIAJHXD67GEPPA2F4TQ',
                'secret' => '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',
            ),
            'region'      => 'eu-west-1',
        ));
        $response = $elasticTranscoder->readJob(array('Id' => $jobid));
        $jobData = $response->get('Job');

        $statuses = array(
            'Complete'    => 3,
            'Error'       => 2,
            'Progressing' => 1,
        );

        $media->{'set' . $type . 'State'}($statuses[$jobData['Status']]);

        $this->getDoctrineManager()->persist($media);
    }

    /**
     * @return \Doctrine\Common\Persistence\ObjectManager|object
     */
    public function getDoctrineManager()
    {
        return $this->getContainer()->get('doctrine')->getManager();
    }

}