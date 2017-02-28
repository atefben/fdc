<?php

namespace FDC\CourtMetrageBundle\Controller;

use FOS\RestBundle\Controller\Annotations\Route;
use Sonata\AdminBundle\Tests\Datagrid\PagerTest;
use FDC\CourtMetrageBundle\Component\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class SocialWallController extends Controller
{
    /**
     * @Route("social-wall", name="fdc_courtmetrage_social_wall")
     */
    public function socialAction(Request $request)
    {
        $socialManager = $this->get('ccm.manager.social_wall');

        $posts = $socialManager->getRandomPosts();

//        if (!$posts) {
//            throw new NotFoundHttpException("Page not found");
//        }

        return $this->render('FDCCourtMetrageBundle:social:wall.html.twig', array(
                'posts' => $posts,
            )
        );
    }
}
