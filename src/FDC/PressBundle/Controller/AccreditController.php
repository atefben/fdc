<?php

namespace FDC\PressBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;


/**
 * @Route("/")
 */
class AccreditController extends Controller
{

    /**
     * @Route("/accredit")
     * @Template("FDCPressBundle:Accredit:main.html.twig")
     * @return array
     */
    public function mainAction()
    {

        $em = $this->getDoctrine()->getManager();
        $locale = $this->getRequest()->getLocale();

        // GET FDC SETTINGS
        $settings = $em->getRepository('BaseCoreBundle:Settings')->findOneBySlug('fdc-year');
        if ($settings === null || $settings->getFestival() === null) {
            throw new NotFoundHttpException();
        }

        // GET ACCREDIT PAGE
        $accredit = $em->getRepository('BaseCoreBundle:PressAccredit')->findOneBy(array(
            'festival' => $settings->getFestival()->getId()
        ));

        if ($accredit === null) {
            throw new NotFoundHttpException();
        }

        $headerInfo = array(
            'title' => 'S\'accréditer',
            'description' => 'Le Festival de Cannes est réservé aux professionels du Cinéma. Pour y participer, ceux-ci
                              doivent être accrédités. Les accréditations sont attribuées en fonction de l’activité
                              professionnelle.'
        );


        $sectionContent = array(
            'section' => array(
                array(
                    'title' => 'Presse écrite et digitale',
                    'slug' => 'presse',
                    'content' => '<h4>Agence de presse</h4> <p>Merci d’adresser au service de presse les éléments nécessaires à
                         votre demande d\'accréditation :</p><ul> <li> <strong>- pour une première demande
                         d’accréditation :</strong> <p>Une lettre officielle à l\'en-tête de votre média, signée du
                         rédacteur en chef ou du directeur, vous mandatant pour couvrir le Festival. Merci de nous
                         donner des informations relatives à l\'importance de l\'agence que vous représentez
                         (zone géographique de diffusion, listes des médias abonnés…) ainsi que la couverture que le
                         média compte faire du Festival. Si votre média souhaite mandater plusieurs journalistes, merci
                         de nous préciser leurs noms et fonctions. Si votre agence de presse fournit du contenu à des
                         médias web, merci de nous préciser si vous mandatez une équipe technique (vidéastes, techniciens).
                         Pour un photographe, veuillez vous référer à la rubrique « Agence photo ». - vos coordonnées
                         (ligne directe, portable, adresse e-mail) - la photocopie de votre carte professionnelle
                         (si le journaliste n’en possède pas, merci de l’indiquer sur la lettre officielle) - 3 dépêches
                         et/ou reportages récents signés de vous ou de l\'agence</p></li><li> <strong>- si vous avez été
                         accrédité(e) l’an dernier :</strong> <p>Toutes les dépêches et/ou reportages, signés de vous ou
                         de l\'agence, consacrés au Festival de l\'année précédente ainsi que vos éventuelles
                         interventions sur d’autres médias (presse écrite, web, radio, TV). </p></li></ul> <h5>Envoi de
                         votre couverture presse :</h5> <p> Les dépêches et/ou reportages au format PDF et/ou tout autre
                         fichier numérique peuvent nous être envoyés :<br>- par e-mail à l\'adresse
                         <a href="mailto:mediareport@festival-cannes.fr">mediareport@festival-cannes.fr</a><br>-
                         par serveur FTP<br>- par courrier (envoi de CD, DVD, clef USB)<br>Les liens Internet adressés
                         par email ne seront pas pris en compte.<br></p>',
                ),
                array(
                    'title' => 'Presse écrite et digitale',
                    'slug' => 'test',
                    'content' => '<h4>Agence de presse</h4> <p>Merci d’adresser au service de presse les éléments nécessaires à
                         votre demande d\'accréditation :</p><ul> <li> <strong>- pour une première demande
                         d’accréditation :</strong> <p>Une lettre officielle à l\'en-tête de votre média, signée du
                         rédacteur en chef ou du directeur, vous mandatant pour couvrir le Festival. Merci de nous
                         donner des informations relatives à l\'importance de l\'agence que vous représentez
                         (zone géographique de diffusion, listes des médias abonnés…) ainsi que la couverture que le
                         média compte faire du Festival. Si votre média souhaite mandater plusieurs journalistes, merci
                         de nous préciser leurs noms et fonctions. Si votre agence de presse fournit du contenu à des
                         médias web, merci de nous préciser si vous mandatez une équipe technique (vidéastes, techniciens).
                         Pour un photographe, veuillez vous référer à la rubrique « Agence photo ». - vos coordonnées
                         (ligne directe, portable, adresse e-mail) - la photocopie de votre carte professionnelle
                         (si le journaliste n’en possède pas, merci de l’indiquer sur la lettre officielle) - 3 dépêches
                         et/ou reportages récents signés de vous ou de l\'agence</p></li><li> <strong>- si vous avez été
                         accrédité(e) l’an dernier :</strong> <p>Toutes les dépêches et/ou reportages, signés de vous ou
                         de l\'agence, consacrés au Festival de l\'année précédente ainsi que vos éventuelles
                         interventions sur d’autres médias (presse écrite, web, radio, TV). </p></li></ul> <h5>Envoi de
                         votre couverture presse :</h5> <p> Les dépêches et/ou reportages au format PDF et/ou tout autre
                         fichier numérique peuvent nous être envoyés :<br>- par e-mail à l\'adresse
                         <a href="mailto:mediareport@festival-cannes.fr">mediareport@festival-cannes.fr</a><br>-
                         par serveur FTP<br>- par courrier (envoi de CD, DVD, clef USB)<br>Les liens Internet adressés
                         par email ne seront pas pris en compte.<br></p>',
                ),
                array(
                    'title' => 'Presse écrite et digitale',
                    'slug' => 'testt',
                    'content' => '<h4>Agence de presse</h4> <p>Merci d’adresser au service de presse les éléments nécessaires à
                         votre demande d\'accréditation :</p><ul> <li> <strong>- pour une première demande
                         d’accréditation :</strong> <p>Une lettre officielle à l\'en-tête de votre média, signée du
                         rédacteur en chef ou du directeur, vous mandatant pour couvrir le Festival. Merci de nous
                         donner des informations relatives à l\'importance de l\'agence que vous représentez
                         (zone géographique de diffusion, listes des médias abonnés…) ainsi que la couverture que le
                         média compte faire du Festival. Si votre média souhaite mandater plusieurs journalistes, merci
                         de nous préciser leurs noms et fonctions. Si votre agence de presse fournit du contenu à des
                         médias web, merci de nous préciser si vous mandatez une équipe technique (vidéastes, techniciens).
                         Pour un photographe, veuillez vous référer à la rubrique « Agence photo ». - vos coordonnées
                         (ligne directe, portable, adresse e-mail) - la photocopie de votre carte professionnelle
                         (si le journaliste n’en possède pas, merci de l’indiquer sur la lettre officielle) - 3 dépêches
                         et/ou reportages récents signés de vous ou de l\'agence</p></li><li> <strong>- si vous avez été
                         accrédité(e) l’an dernier :</strong> <p>Toutes les dépêches et/ou reportages, signés de vous ou
                         de l\'agence, consacrés au Festival de l\'année précédente ainsi que vos éventuelles
                         interventions sur d’autres médias (presse écrite, web, radio, TV). </p></li></ul> <h5>Envoi de
                         votre couverture presse :</h5> <p> Les dépêches et/ou reportages au format PDF et/ou tout autre
                         fichier numérique peuvent nous être envoyés :<br>- par e-mail à l\'adresse
                         <a href="mailto:mediareport@festival-cannes.fr">mediareport@festival-cannes.fr</a><br>-
                         par serveur FTP<br>- par courrier (envoi de CD, DVD, clef USB)<br>Les liens Internet adressés
                         par email ne seront pas pris en compte.<br></p>',
                ),
                array(
                    'title' => 'Presse écrite et digitale',
                    'slug' => 'testtt',
                    'content' => '<h4>Agence de presse</h4> <p>Merci d’adresser au service de presse les éléments nécessaires à
                         votre demande d\'accréditation :</p><ul> <li> <strong>- pour une première demande
                         d’accréditation :</strong> <p>Une lettre officielle à l\'en-tête de votre média, signée du
                         rédacteur en chef ou du directeur, vous mandatant pour couvrir le Festival. Merci de nous
                         donner des informations relatives à l\'importance de l\'agence que vous représentez
                         (zone géographique de diffusion, listes des médias abonnés…) ainsi que la couverture que le
                         média compte faire du Festival. Si votre média souhaite mandater plusieurs journalistes, merci
                         de nous préciser leurs noms et fonctions. Si votre agence de presse fournit du contenu à des
                         médias web, merci de nous préciser si vous mandatez une équipe technique (vidéastes, techniciens).
                         Pour un photographe, veuillez vous référer à la rubrique « Agence photo ». - vos coordonnées
                         (ligne directe, portable, adresse e-mail) - la photocopie de votre carte professionnelle
                         (si le journaliste n’en possède pas, merci de l’indiquer sur la lettre officielle) - 3 dépêches
                         et/ou reportages récents signés de vous ou de l\'agence</p></li><li> <strong>- si vous avez été
                         accrédité(e) l’an dernier :</strong> <p>Toutes les dépêches et/ou reportages, signés de vous ou
                         de l\'agence, consacrés au Festival de l\'année précédente ainsi que vos éventuelles
                         interventions sur d’autres médias (presse écrite, web, radio, TV). </p></li></ul> <h5>Envoi de
                         votre couverture presse :</h5> <p> Les dépêches et/ou reportages au format PDF et/ou tout autre
                         fichier numérique peuvent nous être envoyés :<br>- par e-mail à l\'adresse
                         <a href="mailto:mediareport@festival-cannes.fr">mediareport@festival-cannes.fr</a><br>-
                         par serveur FTP<br>- par courrier (envoi de CD, DVD, clef USB)<br>Les liens Internet adressés
                         par email ne seront pas pris en compte.<br></p>',
                ),
                array(
                    'title' => 'Presse écrite et digitale',
                    'slug' => 'testttt',
                    'content' => '<h4>Agence de presse</h4> <p>Merci d’adresser au service de presse les éléments nécessaires à
                         votre demande d\'accréditation :</p><ul> <li> <strong>- pour une première demande
                         d’accréditation :</strong> <p>Une lettre officielle à l\'en-tête de votre média, signée du
                         rédacteur en chef ou du directeur, vous mandatant pour couvrir le Festival. Merci de nous
                         donner des informations relatives à l\'importance de l\'agence que vous représentez
                         (zone géographique de diffusion, listes des médias abonnés…) ainsi que la couverture que le
                         média compte faire du Festival. Si votre média souhaite mandater plusieurs journalistes, merci
                         de nous préciser leurs noms et fonctions. Si votre agence de presse fournit du contenu à des
                         médias web, merci de nous préciser si vous mandatez une équipe technique (vidéastes, techniciens).
                         Pour un photographe, veuillez vous référer à la rubrique « Agence photo ». - vos coordonnées
                         (ligne directe, portable, adresse e-mail) - la photocopie de votre carte professionnelle
                         (si le journaliste n’en possède pas, merci de l’indiquer sur la lettre officielle) - 3 dépêches
                         et/ou reportages récents signés de vous ou de l\'agence</p></li><li> <strong>- si vous avez été
                         accrédité(e) l’an dernier :</strong> <p>Toutes les dépêches et/ou reportages, signés de vous ou
                         de l\'agence, consacrés au Festival de l\'année précédente ainsi que vos éventuelles
                         interventions sur d’autres médias (presse écrite, web, radio, TV). </p></li></ul> <h5>Envoi de
                         votre couverture presse :</h5> <p> Les dépêches et/ou reportages au format PDF et/ou tout autre
                         fichier numérique peuvent nous être envoyés :<br>- par e-mail à l\'adresse
                         <a href="mailto:mediareport@festival-cannes.fr">mediareport@festival-cannes.fr</a><br>-
                         par serveur FTP<br>- par courrier (envoi de CD, DVD, clef USB)<br>Les liens Internet adressés
                         par email ne seront pas pris en compte.<br></p>',
                )
            )
        );

        return array(
            'headerInfo' => $headerInfo,
            'accredit' => $accredit,
            'sectionContent' => $sectionContent
        );

    }
}
