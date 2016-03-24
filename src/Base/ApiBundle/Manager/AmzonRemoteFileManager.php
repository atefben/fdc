<?php

namespace Base\CoreBundle\Manager;

use Base\CoreBundle\Entity\AmazonRemoteFile;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\DependencyInjection\ContainerInterface;

class AmzonRemoteFileManager
{
    /**
     * @var ContainerInterface
     */
    protected  $container;

    /**
     * AmzonRemoteFileManager constructor.
     * @param ContainerInterface $container
     */
    public function __construct(ContainerInterface $container)
    {
        $this->container = $container;
    }

    /**
     * Update/Create amazon remote file.
     * @param array $files
     */
    public function populate(array $files)
    {
        $i = 0;
        foreach ($files as $key => $file) {
            $amazonRemoteFile = new AmazonRemoteFile();
            $amazonRemoteFile
                ->setId($file['id'])
                ->setName($file['name'])
                ->setUrl($file['url'])
            ;
            ++$i;
            $this->getDoctrineManager()->persist($amazonRemoteFile);
            if ($i === 99) {
                $i = 0;
                $this->getDoctrineManager()->flush();
                $this->getDoctrineManager()->clear();
            }
        }
        if ($i) {
            $this->getDoctrineManager()->flush();
            $this->getDoctrineManager()->clear();
        }
    }

    public function sync()
    {
        $files = array(array('id' => 1, 'name' => 'test video', 'url' => '/amazon/test.mp4'));

        /**
         * @todo Put here the amazon sync code.
         */
		
        $this->populate($files);
    }

    /**
     * @return ObjectManager
     */
    protected function getDoctrineManager()
    {
        return $this
            ->container
            ->get('doctrine')
            ->getManager()
            ;
    }


}