<?php
namespace FDC\MarcheDuFilmBundle\Manager;

use Symfony\Component\HttpFoundation\RequestStack;
use Doctrine\ORM\EntityManager;
use FDC\MarcheDuFilmBundle\Entity\MdfContactSubjectTranslation;

class MailerManager
{
    /**
     * @var
     */
    private $mailer;
    /**
     * @var
     */
    private $templating;
    /**
     * @var
     */
    private $translator;
    /**
     * @var EntityManager
     */
    private $em;
    /**
     * @var RequestStack
     */
    private $requestStack;

    /**
     * MailerManager constructor.
     * @param $mailer
     * @param $templating
     * @param $translator
     * @param EntityManager $entityManager
     * @param RequestStack $requestStack
     */
    public function __construct($mailer, $templating, $translator, EntityManager $entityManager, RequestStack $requestStack)
    {
        $this->mailer = $mailer;
        $this->templating = $templating;
        $this->translator = $translator;
        $this->em = $entityManager;
        $this->requestStack = $requestStack;
    }

    public function sendMessage($emailData)
    {
        $theme = $this->em->getRepository(MdfContactSubjectTranslation::class)
            ->findOneBy(
                array(
                    'slug' => $emailData['select'],
                    'locale' => $this->requestStack->getMasterRequest()->get('_locale')
                )
            );

        if ($theme) {
            $message = \Swift_Message::newInstance();
            $message
                ->setSubject($emailData['object'])
                ->setFrom($this->translator->trans('email.from'))
                ->setTo($emailData['emailTo'])
                ->setBody(
                    $this->templating->render(
                        'FDCMarcheDuFilmBundle::emails/contact.html.twig',
                        array(
                            'message' => $emailData['message'],
                            'theme' => $theme->getContactTheme(),
                            'name' => $emailData['name'],
                            'email' => $emailData['email']
                        )
                    ),
                    'text/html'
                );

            $this->mailer->send($message);
        }
    }
}