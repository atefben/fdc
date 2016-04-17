<?php
/**
 * Created by PhpStorm.
 * User: piebel
 * Date: 22/01/2016
 * Time: 14:44
 */

namespace Base\CoreBundle\Twig\Extension;

use \Twig_Extension;

class StatementTypeExtension extends Twig_Extension
{

    private $em;

    public function __construct($em)
    {
        $this->em = $em;
    }

    public function getFilters()
    {
        return array(
            new \Twig_SimpleFilter('get_statement_type', array($this, 'getStatementType')),
        );
    }

    public function getStatementType($statementType)
    {
        $type = null;

        switch ($statementType) {
            case "StatementArticle":
                $type = 'article';
                break;
            case "StatementAudio":
                $type = 'audio';
                break;
            case "StatementImage":
                $type = 'photo';
                break;
            case "StatementVideo":
                $type = 'video';
                break;
        }

        return $type;
    }


    /**
     * getName function.
     *
     * @access public
     * @return void
     */
    public function getName()
    {
        return 'statement_type_extension';
    }
}