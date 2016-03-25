<?php

namespace Base\CoreBundle\Manager;

use Base\CoreBundle\Entity\AmazonRemoteFile;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Aws\S3\S3Client;

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
        $files = array();
		
		$s3 = S3Client::factory(array(
            'credentials' => array(
                'key'    => 'AKIAJHXD67GEPPA2F4TQ',
                'secret' => '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',
            ),
            'region'      => 'eu-west-1',
		));

		$bucket = 'ohwee-symfony-test-video';
		$prefix = 'media_video_direct_upload/';
		$objects = $s3->getIterator('ListObjects', array(
		    "Bucket" => $bucket,
		    "Prefix" => $prefix
		));

		error_log(print_r(\Doctrine\Common\Util\Debug::export($objects, 6),1));

		foreach ($objects as $object) {
			$files[] = array('id' => md5(rand(0,10000000)), 'name' =>  $object['Key'], 'url' => $bucket . '/' . $prefix . $object['Key']);
		}
		
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