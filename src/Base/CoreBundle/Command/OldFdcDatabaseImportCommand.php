<?php

namespace Base\CoreBundle\Command;

use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

class OldFdcDatabaseImportCommand extends ContainerAwareCommand
{


    protected function configure()
    {
        $this
            ->setName('base:import:old_fdc')
            ->setDescription('Import old fdc database data')
            ->addOption('count', null, InputOption::VALUE_NONE, 'Count entities total')
            ->addOption('only-create', null, InputOption::VALUE_NONE, 'Create only new entities')
            ->addOption('only-infos', null, InputOption::VALUE_NONE, 'Only import infos')
            ->addOption('only-news', null, InputOption::VALUE_NONE, 'Only import news')
            ->addOption('only-statements', null, InputOption::VALUE_NONE, 'Only import statements')
            ->addOption('only-classics', null, InputOption::VALUE_NONE, 'Only import classics')
            ->addOption('only-media-images', null, InputOption::VALUE_NONE, 'Only import media images')
            ->addOption('only-media-audios', null, InputOption::VALUE_NONE, 'Only import media audios')
            ->addOption('only-media-videos', null, InputOption::VALUE_NONE, 'Only import media videos')
            ->addOption('only-events', null, InputOption::VALUE_NONE, 'Only import events')
            ->addOption('theme', null, InputOption::VALUE_OPTIONAL, 'Default Theme')
            ->addOption('page', null, InputOption::VALUE_OPTIONAL, 'Pagination')
            ->addOption('id', null, InputOption::VALUE_OPTIONAL, 'The id')
            ->addOption('force-reupload', null, InputOption::VALUE_OPTIONAL, 'Force upload image again')
            ->addOption('update-films-only', null, InputOption::VALUE_NONE, 'Upload films only')
            ->addOption('update-widget-video-only', null, InputOption::VALUE_NONE, 'Upload widget video only')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {

        $themeId = $input->getOption('theme');

        $onlyInfos = $input->getOption('only-infos');
        $onlyNews = $input->getOption('only-news');
        $onlyStatements = $input->getOption('only-statements');
        $onlyClassics = $input->getOption('only-classics');
        $onlyMediaImages = $input->getOption('only-media-images');
        $onlyMediaAudios = $input->getOption('only-media-audios');
        $onlyMediaVideos = $input->getOption('only-media-videos');
        $onlyEvents = $input->getOption('only-events');

        if ($onlyInfos) {
            $infoImporter = $this->getContainer()->get('old_import.info_importer');
            $infoImporter->setInput($input)->setOutput($output)->setDefaultThemeId($themeId);
            if ($input->getOption('id')) {
                $infoImporter->importOneInfo($input->getOption('id'));
            } elseif ($input->getOption('count')) {
                $output->writeln('Infos to import ' . $infoImporter->countInfos());
            } else {
                $infoImporter->importInfos();
            }
        } elseif ($onlyNews) {
            $newsImporter = $this->getContainer()->get('old_import.news_importer');
            $newsImporter->setInput($input)->setOutput($output)->setDefaultThemeId($themeId);
            if ($input->getOption('id')) {
                $newsImporter->importOneNews($input->getOption('id'));
            } elseif ($input->getOption('count')) {
                $output->writeln('News to import ' . $newsImporter->countNews());
            } else {
                $newsImporter->importNews($input->getOption('page'));
            }
        } elseif ($onlyStatements) {
            $statementImporter = $this->getContainer()->get('old_import.statement_importer');
            $statementImporter->setInput($input)->setOutput($output)->setDefaultThemeId($themeId);
            if ($input->getOption('count')) {
                $output->writeln('Statements to import: ' . $statementImporter->countStatements());
            } else {
                $statementImporter->importStatements();
            }
        } elseif ($onlyClassics) {
            $classicsImporter = $this->getContainer()->get('old_import.classics_importer');
            $classicsImporter->setInput($input)->setOutput($output)->setDefaultThemeId($themeId);
            if ($input->getOption('count')) {
                $output->writeln('Classics to import: ' . $classicsImporter->countClassics());
            } else {
                $classicsImporter->importClassics();
            }
        } elseif ($onlyEvents) {
            $eventImporter = $this->getContainer()->get('old_import.events_importer');
            $eventImporter->setInput($input)->setOutput($output)->setDefaultThemeId($themeId);
            if ($input->getOption('count')) {
                $output->writeln('Events to import: ' . $eventImporter->countEvents());
            } else if ($input->getOption('id')) {
                $eventImporter->importOneEvent($input->getOption('id'));
            } else {
                $eventImporter->importEvents();
            }
        } elseif ($onlyMediaImages) {
            $mediaImageImporter = $this->getContainer()->get('old_import.media_image_importer');
            $mediaImageImporter->setInput($input)->setOutput($output)->setDefaultThemeId($themeId);
            if ($input->getOption('count')) {
                $output->writeln('Media Images to import: ' . $mediaImageImporter->countMediaImages());
            } else if ($input->getOption('id')) {
                $mediaImageImporter->importOneMediaImage($input->getOption('id'));
            } else {
                $mediaImageImporter->importMediaImages($input->getOption('page'));
            }
        } elseif ($onlyMediaAudios) {
            $mediaAudioImporter = $this->getContainer()->get('old_import.media_audio_importer');
            $mediaAudioImporter->setInput($input)->setOutput($output)->setDefaultThemeId($themeId);
            if ($input->getOption('count')) {
                $output->writeln('Media Audios to import: ' . $mediaAudioImporter->countMediaAudios());
            } else if ($input->getOption('id')) {
                $mediaAudioImporter->importOneMediaAudio($input->getOption('id'));
            } else {
                $mediaAudioImporter->importMediaAudios($input->getOption('page'));
            }
        } elseif ($onlyMediaVideos) {
            $mediaVideoImporter = $this->getContainer()->get('old_import.media_video_importer');
            $mediaVideoImporter->setInput($input)->setOutput($output)->setDefaultThemeId($themeId);
            if ($input->getOption('count')) {
                $output->writeln('Media Videos to import: ' . $mediaVideoImporter->countMediaVideos());
            } else if ($input->getOption('id')) {
                $mediaVideoImporter->importOneMediaVideo($input->getOption('id'));
            } else {
                $mediaVideoImporter->importMediaVideos($input->getOption('page'));
            }
        }
    }

    protected function getManager()
    {
        return $this->getContainer()->get('doctrine')->getManager();
    }

}