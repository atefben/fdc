<?php
/**
 * Created by PhpStorm.
 * User: piebel
 * Date: 22/01/2016
 * Time: 14:44
 */

namespace Base\CoreBundle\Twig\Extension;

use Base\CoreBundle\Entity\FilmFilm;
use Base\CoreBundle\Entity\FilmPerson;
use Doctrine\Bundle\DoctrineBundle\Registry;
use Doctrine\DBAL\Connection;
use Doctrine\ORM\Query;
use Twig_Extension;
use Twig_SimpleFunction;

class LegacyImageExtension extends Twig_Extension
{

    /**
     * @var Connection
     */
    private $connection;

    /**
     * @var Registry
     */
    private $doctrine;

    /**
     * LegacyFilmImageExtension constructor.
     * @param Connection $connection
     */
    public function __construct(Connection $connection)
    {
        $this->connection = $connection;
    }

    /**
     * @param \Doctrine\Bundle\DoctrineBundle\Registry $doctrine
     * @return \Doctrine\Bundle\DoctrineBundle\Registry
     */
    public function setDoctrine(Registry $doctrine)
    {
        return $this->doctrine = $doctrine;
    }

    /**
     * @return \Doctrine\Common\Persistence\ObjectManager|object
     */
    public function getDoctrineManager()
    {
        return $this->doctrine->getManager();
    }

    /**
     * @return array
     */
    public function getFunctions()
    {
        return array(
            new Twig_SimpleFunction('get_legacy_film_image', array($this, 'getLegacyFilmImage')),
            //new Twig_SimpleFunction('get_legacy_person_image', array($this, 'getLegacyPersonImage')),
        );
    }

    /**
     * @param FilmFilm $movie
     * @return mixed
     */
    public function getLegacyFilmImage(FilmFilm $movie)
    {
        if ((int)$movie->getProductionYear() < 2014) {
            $output = $this
                ->getDoctrineManager()
                ->getRepository('BaseCoreBundle:OldFilmPhoto')
                ->getLegacyFilmImage($movie)
            ;

            return $output;
        }
    }

    ///**
    // * @param \Base\CoreBundle\Entity\FilmPerson $person
    // * @return bool
    // */
    //public function getLegacyPersonImage(FilmPerson $person)
    //{
    //    if ((int)$movie->getProductionYear() < 2014) {
    //        $query = 'SELECT DISTINCT p.*
    //        FROM
    //          legacy_mapping_film_photo p
    //        LEFT JOIN legacy_mapping_film_festival_poster fp ON p.IDPOSTER = fp.IDPOSTER
    //        WHERE
    //          IDFILM = :id_film
    //          AND TYPE = :type
    //          AND (TITRE = "Photo du Film" OR IDTYPEPHOTO IN (51, 14))
    //          ORDER BY IDTYPEPHOTO DESC, fp.DATEMODIFICATION ASC, IDPHOTO DESC';
    //        $stmt = $this->connection->prepare($query);
    //        $stmt->bindValue('id_film', $movie->getId());
    //        $stmt->bindValue('type', 'I');
    //        $stmt->execute();
    //        $results = $stmt->fetchAll(Query::HYDRATE_ARRAY);
    //        foreach ($results as $result) {
    //            if (is_array($result) && array_key_exists('FICHIER', $result) && $result['FICHIER']) {
    //                return $result;
    //            }
    //        }
    //        return false;
    //    }
    //}


    /**
     * @return string
     */
    public function getName()
    {
        return 'legacy_image_extension';
    }
}