<?php
/**
 * Created by PhpStorm.
 * User: piebel
 * Date: 22/01/2016
 * Time: 14:44
 */

namespace Base\CoreBundle\Twig\Extension;

use Base\CoreBundle\Entity\FilmFilm;
use Doctrine\DBAL\Connection;
use Doctrine\ORM\Query;
use Twig_Extension;
use Twig_SimpleFunction;

class LegacyFilmImageExtension extends Twig_Extension
{

    /**
     * @var Connection
     */
    private $connection;

    /**
     * LegacyFilmImageExtension constructor.
     * @param Connection $connection
     */
    public function __construct(Connection $connection)
    {
        $this->connection = $connection;
    }

    /**
     * @return array
     */
    public function getFunctions()
    {
        return array(
            new Twig_SimpleFunction('get_legacy_film_image', array($this, 'getLegacyFilmImage')),
        );
    }

    /**
     * @param FilmFilm $movie
     * @return mixed
     */
    public function getLegacyFilmImage(FilmFilm $movie)
    {
        if ((int)$movie->getProductionYear() < 2014) {
            $query = 'SELECT DISTINCT p.*
            FROM
              legacy_mapping_film_photo p
            LEFT JOIN legacy_mapping_film_festival_poster fp ON p.IDPOSTER = fp.IDPOSTER
            WHERE
              IDFILM = :id_film
              AND TYPE = :type
              AND (TITRE = "Photo du Film" OR IDTYPEPHOTO IN (51, 14))
              ORDER BY IDTYPEPHOTO DESC, fp.DATEMODIFICATION ASC, IDPHOTO DESC';
            $stmt = $this->connection->prepare($query);
            $stmt->bindValue('id_film', $movie->getId());
            $stmt->bindValue('type', 'I');
            $stmt->execute();
            $results = $stmt->fetchAll(Query::HYDRATE_ARRAY);
            foreach ($results as $result) {
                if (is_array($result) && array_key_exists('FICHIER', $result) && $result['FICHIER']) {
                    return $result;
                }
            }
            return false;
        }
    }


    /**
     * @return string
     */
    public function getName()
    {
        return 'legacy_film_image_extension';
    }
}