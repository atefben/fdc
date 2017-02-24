<?php

namespace FDC\CourtMetrageBundle\Manager;

use Doctrine\ORM\EntityManager;
use FDC\CourtMetrageBundle\Entity\CcmContactPage;
use FDC\CourtMetrageBundle\Entity\CcmContactSubject;
use FDC\CourtMetrageBundle\Entity\CcmContactSubjectsCollection;
use FDC\CourtMetrageBundle\Entity\CcmContactSubjectTranslation;
use Symfony\Bundle\TwigBundle\TwigEngine;
use Symfony\Component\Form\Form;
use Symfony\Component\Form\FormError;

/**
 * Class ContactPageManager
 * @package FDC\CourtMetrageBundle\Manager
 */
class ContactPageManager
{
    /**
     * @var EntityManager
     */
    protected $em;

    /**
     * @var TwigEngine
     */
    protected $twig;

    /**
     * @var \Swift_Mailer
     */
    protected $mailer;

    /**
     * ContactPageManager constructor.
     * @param EntityManager $entityManager
     * @param TwigEngine $twigEngine
     * @param \Swift_Mailer $mailer
     */
    public function __construct(EntityManager $entityManager, TwigEngine $twigEngine, \Swift_Mailer $mailer)
    {
        $this->em     = $entityManager;
        $this->twig   = $twigEngine;
        $this->mailer = $mailer;
    }

    /**
     * @return CcmContactPage|null
     */
    public function getContactPage()
    {
        return $this->em->getRepository(CcmContactPage::class)->findOneBy([]);
    }

    /**
     * @param CcmContactPage $contactPage
     * @param string $locale
     * @return array
     */
    public function getContactPageSubjects(CcmContactPage $contactPage, $locale = 'fr')
    {
        $contactSubjects = [];
        /** @var CcmContactSubjectsCollection $contactSubjectList */
        foreach ($contactPage->getSubjectsList() as $contactSubjectList) {
            /** @var CcmContactSubject $subject */
            $subject = $contactSubjectList->getContactSubject();
            /** @var CcmContactSubjectTranslation $translation */
            $translation = $subject->findTranslationByLocale($locale);
            if ($translation != null) {
                $contactSubjects[$translation->getSlug()] = $translation->getContactTheme();
            }
        }
        
        return $contactSubjects;
    }

    /**
     * @param $slug
     * @param string $locale
     * @return CcmContactSubjectTranslation
     */
    public function getSubjectTranslationBySlugAndLocale($slug, $locale = 'fr')
    {
        return $this->em->getRepository(CcmContactSubjectTranslation::class)->findOneBy([
            'slug'   => $slug,
            'locale' => $locale
        ]);
    }

    /**
     * @param Form $form
     * @param $locale
     * @return Form
     */
    public function validateFormData(Form $form, $locale = 'fr')
    {
        $formData = $form->getData();
        $email = $formData['email'];
        
        if (!filter_var(trim($email), FILTER_VALIDATE_EMAIL)) {
            $error = new FormError('email.invalid');
            $form->addError($error);
        }

        if ($this->getSubjectTranslationBySlugAndLocale($formData['select'], $locale) == null) {
            $error = new FormError('ccm.contact.theme_error');
            $form->addError($error);
        }
        
        return $form;
    }

    /**
     * @param $data
     * @throws \Twig_Error
     */
    public function sendEmail($data)
    {
        $message = \Swift_Message::newInstance()
            ->setSubject($data['subject'])
            ->setFrom($data['from'])
            ->setTo($data['to'])
            ->setBody($this->twig->render('@FDCCourtMetrage/Emails/contact.html.twig', [
                'name'    => $data['name'],
                'email'   => $data['email'],
                'theme'   => $data['theme'],
                'message' => $data['message']
            ]), 'text/html')
        ;
        /** @noinspection PhpParamsInspection */
        $this->mailer->send($message);
    }
}
