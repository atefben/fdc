<?php

namespace FDC\CorporateBundle\Controller;

use Base\CoreBundle\Entity\MediaAudio;
use Base\CoreBundle\Entity\News;
use Base\CoreBundle\Interfaces\FDCEventRoutesInterface;

use Eko\FeedBundle\Field\Channel\ChannelField;
use FDC\EventBundle\Component\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

use FDC\EventBundle\Form\Type\ContactType;
use FDC\EventBundle\Form\Type\NewsletterType;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\Validator\Constraints\DateTime;


/**
 * @Route("/")
 */
class FooterController extends Controller
{
    /**
     * @Route("/static-{page}")
     *
     * @param $page
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function staticAction($page)
    {
        if ($page != 'application-mobile') {
            throw new NotFoundHttpException();
        }
        $pageContent = '';

        return $this->render(
            "FDCEventBundle:Footer:$page.html.twig",
            array('content' => $pageContent)
        );
    }

    /**
     * @Route("/privacy")
     * @Template("FDCCorporateBundle:Footer:footer_page.html.twig")
     * @return array
     */
    public function privacyAction(Request $request) {

        $locale   = $request->getLocale();
        $pageId = $this->getParameter('admin_fdc_footer_confidentialite_id');
        $em = $this->get('doctrine')->getManager();

        $content = $em->getRepository('BaseCoreBundle:FDCPageFooter')->findOneBy(
            array('id' => $pageId)
        );

        // SEO
        $this->get('base.manager.seo')->setFDCPageFooterSeo($content, $locale);

        return array(
            'page' => $content,
        );
    }

    /**
     * @Route("/mentions-legales")
     * @Template("FDCCorporateBundle:Footer:footer_page.html.twig")
     * @return array
     */
    public function mentionsLegalesAction(Request $request) {

        $locale   = $request->getLocale();
        $pageId = $this->getParameter('admin_fdc_footer_mentions_legales_id');
        $em = $this->get('doctrine')->getManager();

        $content = $em->getRepository('BaseCoreBundle:FDCPageFooter')->findOneBy(
            array('id' => $pageId)
        );

        // SEO
        $this->get('base.manager.seo')->setFDCPageFooterSeo($content, $locale);

        return array(
            'page' => $content,
        );
    }

    /**
     * @Route("/credits")
     * @Template("FDCCorporateBundle:Footer:footer_page.html.twig")
     * @return array
     */
    public function creditsAction(Request $request) {

        $locale   = $request->getLocale();
        $pageId = $this->getParameter('admin_fdc_footer_credits_id');
        $em = $this->get('doctrine')->getManager();

        $content = $em->getRepository('BaseCoreBundle:FDCPageFooter')->findOneBy(
            array('id' => $pageId)
        );

        // SEO
        $this->get('base.manager.seo')->setFDCPageFooterSeo($content, $locale);

        return array(
            'page' => $content,
        );
    }

    /**
     * @Route("/page/{slug}", options={"expose"=true})
     * @Template("FDCCorporateBundle:Footer:footer_page.html.twig")
     * @return array
     */
    public function pageLibresAction(Request $request, $slug) {

        $locale   = $request->getLocale();
        $em = $this->get('doctrine')->getManager();

        $content = $em->getRepository('BaseCoreBundle:FDCPageFooter')->getPageBySlug($slug, $locale);
        if ($content == null) {
            throw new NotFoundHttpException();
        }
        $localeSlugs = $content->getLocaleSlugs();

        // SEO
        $this->get('base.manager.seo')->setFDCPageFooterSeo($content, $locale);

        return array(
            'page' => $content,
            'localeSlugs' => $localeSlugs,
        );
    }

    /**
     * @Route("/faq")
     * @Template("FDCCorporateBundle:Footer:faq.html.twig")
     * @return array
     */
    public function faqAction(Request $request) {

        $em = $this->get('doctrine')->getManager();
        $themes = $em->getRepository('BaseCoreBundle:FAQTheme')->findAll();
        $faq = array();
        foreach($themes as $key => $theme) {
            $faq[$key]['faq'] = $em->getRepository('BaseCoreBundle:FAQPage')->findby(
                array('theme' => $theme)
            );
            $faq[$key]['theme'] = $theme;
        }

        return array(
            'faq' => $faq
        );
    }

    /**
     * @Route("/sitemap")
     * @Template("FDCCorporateBundle:Footer:plan-du-site.html.twig")
     * @return array
     */
    public function siteMapAction(Request $request) {

        $locale = $request->getLocale();
        $em     = $this->get('doctrine')->getManager();

        //routes from menu
        $routes = $em->getRepository('BaseCoreBundle:FDCEventRoutes')->childrenHierarchy();

        $participatePage = $em->getRepository('BaseCoreBundle:FDCPageParticipate')->findAll();
        $preparePage = $em->getRepository('BaseCoreBundle:FDCPagePrepare')->findById($this->getParameter('admin_fdc_page_prepare_id'));

        $participateMenu = array_merge($preparePage, $participatePage);

        $displayedRoutes = array();
        $press = array();
        foreach($routes as $menu){
            if($menu['site'] == FDCEventRoutesInterface::CORPO){
                if($menu['type'] == 1)
                $displayedRoutes[] = $menu;
            }
        }


        // la selection
        $aboutUs = $this
            ->getDoctrineManager()
            ->getRepository('BaseCoreBundle:CorpoWhoAreWe')
            ->findAll()
        ;
        $about = array();
        foreach($aboutUs as $n){
            if($n->findTranslationByLocale('fr')->getStatus() == 1) {
                $about[] = $n;
            }
        }

        //jury
        $jury = $em
            ->getRepository('BaseCoreBundle:FDCPageJury')
            ->getPages($locale)
        ;

        //palmares
        $award = $em
            ->getRepository('BaseCoreBundle:FDCPageAward')
            ->getPages($locale)
        ;

        //footer
        $displayedFooterElements = $em->getRepository('BaseCoreBundle:FDCEventRoutes')->findBy(
            array('type' => 2,'site' => 3),
            array('position' => 'asc'),
            null,
            null
        );

        //events
        $festival = $this->getFestival()->getId();
        $events = $em
            ->getRepository('BaseCoreBundle:Event')
            ->getEvents($festival, $locale)
        ;

        return array(
            'events'            => $events,
            'participateMenu'       => $participateMenu,
            'footer'            => $displayedFooterElements,
            'press'             => $press,
            'award'             => $award,
            'jury'              => $jury,
            'aboutUs'          => $about,
            'routes'            => $displayedRoutes
        );
    }

    /**
     * @Route("/contact")
     * @Template("FDCCorporateBundle:Footer:contact.html.twig")
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     */
    public function contactAction(Request $request)
    {
        $locale = $request->getLocale();
        $em = $this->getDoctrine()->getManager();
        $translator = $this->get('translator');
        $hasErrors = false;
        $themes = $em->getRepository('BaseCoreBundle:ContactTheme')->findSelectValues($locale);
        $form = $this->createForm(new ContactType($themes, $translator));

        if ($request->isMethod('POST')) {
            $form->submit($request);
            $theme = $em->getRepository('BaseCoreBundle:ContactTheme')->findOneById($form->get('select')->getData());
            if ($form->isValid()) {
                $message = \Swift_Message::newInstance()
                    ->setSubject($form->get('subject')->getData())
                    ->setFrom('noreply@festival-cannes.com')
                    ->setTo($theme->getEmail())
                    ->setContentType('text/html')
                    ->setBody(
                        $this->renderView(
                            'FDCEventBundle:Mail:contact.html.twig',
                            array(
                                'contact_email' => $form->get('email')->getData(),
                                'contact_ip' => $request->getClientIp(),
                                'contact_name' => $form->get('name')->getData(),
                                'contact_subject' => $form->get('subject')->getData(),
                                'contact_theme' => $form->get('select')->getData(),
                                'contact_message' => $form->get('message')->getData()
                            )
                        )
                    );

                $this->get('mailer')->send($message);
                $this->get('session')->getFlashBag()->add('success', 'Email sent');
            } else {
                $hasErrors = true;
            }
        }

        return array(
            'form' => $form->createView(),
            'hasErrors' => $hasErrors
        );

    }

    /**
     * Generate the podcast feed
     * @Route("/podcast")
     * @return Response XML Feed
     */
    public function podcastAction(Request $request)
    {
        $locale = $request->getLocale();
        $em = $this->getDoctrine()->getManager();
        $settings = $em->getRepository('BaseCoreBundle:Settings')->findOneBySlug('fdc-year');
        $dateTime = new DateTime();

        $audios = $em->getRepository('BaseCoreBundle:Media')->getAudioMedia($locale, $settings->getFestival()->getId(), $dateTime);

        MediaAudio::$localeTemp = $locale;
        $feed = $this->get('eko_feed.feed.manager')->get('article');
        $feed->addFromArray($audios);

        return new Response($feed->render('rss')); // ou 'atom'
    }

    /**
     * Generate the news rss feed
     * @Route("/rss")
     * @return Response XML Feed
     * @param Request $request
     * @return Response
     */
    public function rssFeedAction(Request $request)
    {
        $locale = $request->getLocale();
        $em = $this->getDoctrine()->getManager();
        $settings = $em->getRepository('BaseCoreBundle:Settings')->findOneBySlug('fdc-year');

        $newsArticles = $em->getRepository('BaseCoreBundle:News')->getAllNews($locale, $settings->getFestival()->getId());
        $newsArticles = $this->removeUnpublishedNewsAudioVideo($newsArticles, $locale);

        News::$localeTemp = $locale;
        $feed = $this->get('eko_feed.feed.manager')->get('article');
        $feed->addChannelField(new ChannelField('test', 'lol'));
        $feed->addFromArray($newsArticles);

        return new Response($feed->render('rss')); // ou 'atom'
    }

    /**
     * @Route("/sharing")
     * @Template("FDCEventBundle:Footer:sharing.html.twig")
     */
    public function sharingAction(Request $request)
    {

    }
}
