<?php

/*
 * This file is part of the Sonata package.
*
* (c) Thomas Rabaix <thomas.rabaix@sonata-project.org>
*
* For the full copyright and license information, please view the LICENSE
* file that was distributed with this source code.
*/

namespace Base\CoreBundle\Command;

use Sonata\MediaBundle\Command\BaseCommand;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

/**
 * This command can be used to re-generate the thumbnails for all uploaded medias.
 * Useful if you have existing media content and added new formats.
 */
class SyncThumbsCommand extends BaseCommand
{
    protected $quiet = false;
    protected $output;

    /**
     * {@inheritdoc}
     */
    public function configure()
    {
        $this->setName('base:media:sync-thumbnails')
             ->setDescription('Sync uploaded image thumbs with new media formats')
             ->setDefinition(array(
                     new InputArgument('providerName', InputArgument::OPTIONAL, 'The provider'),
                     new InputArgument('context', InputArgument::OPTIONAL, 'The context'),
                     new InputOption('id', null, InputOption::VALUE_REQUIRED | InputOption::VALUE_IS_ARRAY, 'The media identifier'),
                 )
             )
        ;
    }

    /**
     * {@inheritdoc}
     */
    public function execute(InputInterface $input, OutputInterface $output)
    {

        $provider = $input->getArgument('providerName');
        if (null === $provider) {
            $providers = array_keys($this->getMediaPool()->getProviders());
            $providerKey = $this->getHelperSet()->get('dialog')->select($output, 'Please select the provider', $providers);
            $provider = $providers[$providerKey];
        }

        $context = $input->getArgument('context');
        if (null === $context) {
            $contexts = array_keys($this->getMediaPool()->getContexts());
            $contextKey = $this->getHelperSet()->get('dialog')->select($output, 'Please select the context', $contexts);
            $context = $contexts[$contextKey];
        }

        $this->quiet = $input->getOption('quiet');
        $this->output = $output;

        $args = array(
            'providerName' => $provider,
            'context'      => $context,
        );

        $id = $input->getOption('id');
        if ($id !== null) {
            $args['id'] = $id;
        };

        $medias = $this->getMediaManager()->findBy($args);

        $this->log(sprintf('Loaded %s medias for generating thumbs (provider: %s, context: %s)', count($medias), $provider, $context));

        foreach ($medias as $media) {
            $provider = $this->getMediaPool()->getProvider($media->getProviderName());

            $this->log('Generating thumbs for ' . $media->getName() . ' - ' . $media->getId());

            try {
                $provider->removeThumbnails($media);
            } catch (\Exception $e) {
                $this->log(sprintf('<error>Unable to remove old thumbnails, media: %s - %s </error>', $media->getId(), $e->getMessage()));
                continue;
            }

            try {
                $provider->generateThumbnails($media);
            } catch (\Exception $e) {
                $this->log(sprintf('<error>Unable to generated new thumbnails, media: %s - %s </error>', $media->getId(), $e->getMessage()));
                continue;
            }
            $media
                ->setIgnoreListener(true)
                ->setThumbsGenerated(true)
            ;
            $this->getDoctrineManager()->flush();
        }

        $this->log('Done.');
    }

    /**
     * Write a message to the output.
     * @param string $message
     */
    protected function log($message)
    {
        if (false === $this->quiet) {
            $this->output->writeln($message);
        }
    }

    /**
     * @return \Doctrine\Common\Persistence\ObjectManager|object
     */
    private function getDoctrineManager()
    {
        return $this
            ->getContainer()
            ->get('doctrine')
            ->getManager()
            ;
    }
}
