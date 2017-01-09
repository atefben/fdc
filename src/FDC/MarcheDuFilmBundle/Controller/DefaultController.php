<?php

namespace FDC\MarcheDuFilmBundle\Controller;

use FDC\MarcheDuFilmBundle\Entity\MdfContentTemplate;
use FOS\RestBundle\Controller\Annotations\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    /**
     * @Route("/")
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function indexAction()
    {
        $newsContent = [];
        $homepageManager = $this->get('mdf.manager.homepage');
        $contentTemplateManager = $this->get('mdf.manager.content_template');
        $contactManager = $this->get('mdf.manager.contact');
        $pageType = MdfContentTemplate::TYPE_NEWS_DETAILS;

        $news = $contentTemplateManager->getHomepageNews($pageType);

        foreach ($news as $key => $newsItem) {
            $newsContent[$key]['content'] = $newsItem;
            $newsContent[$key]['image'] = $contentTemplateManager->getContentTemplateImageWidgetsByPageId($newsItem->getTranslatable()->getId());
        }

        $slidersTop = $homepageManager->getSlidersTop();
        $sliders = $homepageManager->getSliders();
        $homepageContent = $homepageManager->getHomepageContent();
        $contact = $contactManager->getContactInfo();
        $services = $homepageManager->getHomepageServices();

        return $this->render('FDCMarcheDuFilmBundle::homepage/homepage.html.twig', array(
            'sliderTop' => $slidersTop,
            'slider' => $sliders,
            'homepageContent' => $homepageContent,
            'news' => $newsContent,
            'contact' => $contact,
            'services' => $services
        ));
    }
}
