<?php

namespace Base\CoreBundle\Manager;

use Base\CoreBundle\Entity\AmazonRemoteFile;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Aws\S3\S3Client;

class AmazonRemoteFileManager
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
			$entity = $this->container->get('doctrine')->getRepository('BaseCoreBundle:AmazonRemoteFile')->findOneBy(array('id' => $file['id']));
			if ($entity == null)
			{
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
                'key'    => $this->getParameter('s3_access_key'),
                'secret' => $this->getParameter('s3_secret_key'),
            ),
            'region'      => $this->getParameter('s3_video_region'),
		));

		$bucket = $this->getParameter('_video_bucket_name');
		$prefix = 'media_video_direct_upload/';
		$objects = $s3->getIterator('ListObjects', array(
		    "Bucket" => $bucket,
		    "Prefix" => $prefix
		));

		foreach ($objects as $object) {
			if(isset($object['Key']) && !empty(str_replace($prefix, '', $object['Key']))) {
				$files[] = array('id' => md5($object['Key']), 'name' => str_replace($prefix, '', $object['Key']), 'url' => $object['Key']);
			}
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