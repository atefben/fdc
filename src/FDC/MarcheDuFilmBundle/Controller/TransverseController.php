<?php

namespace FDC\MarcheDuFilmBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class TransverseController extends Controller
{
    public function headerAction()
    {
        $headerFooterManager = $this->get('mdf.manager.header_footer');
        $banner = $headerFooterManager->getHeaderBanner();

        return $this->render(
            'FDCMarcheDuFilmBundle::shared/header.html.twig',
            [
                'banner' => $banner[0]
            ]
        );
    }

    public function footerAction()
    {
        $headerFooterManager = $this->get('mdf.manager.header_footer');

        return $this->render(
            'FDCMarcheDuFilmBundle::shared/footer.html.twig',
            [
                'footerUrls' => $headerFooterManager->getFooterUrls()
            ]
        );
    }
}
