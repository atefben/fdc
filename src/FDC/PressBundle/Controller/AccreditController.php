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

        $commonContent = array(
            'firstBlock' => '<h3>demande d’accréditation</h3>
                             <h4>accréditation presse</h4>
                             <p>Le Festival de Cannes est l\'une des plus importantes manifestations médiatiques au
                             monde couverte par plus de <strong>4000 journalistes</strong> et plus de
                             <strong>2000 médias</strong> en provenance d’environ <strong>90 pays</strong>.<br>
                             L\'accréditation presse est délivrée par le service de presse aux seuls représentants des
                             médias.<br><br>Le nombre d\'accréditations par média et la catégorie du badge
                             (niveaux d\'accès et de priorités) sont attribués en fonction de la profession
                             représentée (journaliste, photographe, technicien média), de la périodicité du média,
                             de son importance (tirage, audience), de sa spécialisation cinéma et de la couverture
                             qu\'il envisage de faire du Festival de Cannes.</p>',
            'infoBlock' => '<strong>La date limite pour déposer votre demande d’accréditation est fixée au 31 mars.</strong>
                            Pour préserver votre confort et vos conditions de travail le nombre d`\'accréditations est
                            limité. Nous insistons donc sur la nécessité de nous adresser votre demande avant la date
                            limite',
            'secondBlock' => '<h4>comment déposer votre demande ?</h4><p>Dès janvier, vous pouvez faire votre
                              demande d\'accréditation en envoyant au service de presse les pièces justificatives
                              listées dans la rubrique vous concernant : Presse écrite et multimédia, Média web,
                              Agence de presse, Agence de presse audiovisuelle, Agence Photo, Photographe de presse,
                              Télévision, Radio.<br> Les documents peuvent être adressés :</p><ul><li><strong>-
                              par email au format pdf :</strong><p>Presse écrite et multimédia – Agences de presse :
                               <a href="mailto:presse@festival-cannes.fr">presse@festival-cannes.fr</a><br>Média web
                               : <a href="mailto:webmedia@festival-cannes.fr">webmedia@festival-cannes.fr</a><br>
                               Télévision – Radio – Agences de presse audiovisuelle :
                               <a href="presseaudio@festival-cannes.fr">presseaudio@festival-cannes.fr</a><br>
                               Photographes de presse – Agences photo :
                               <a href="presseaudio@festival-cannes.fr">presseaudio@festival-cannes.fr</a></p></li>
                               <li><strong>- par courrier :</strong><p>Festival de Cannes - Service de Presse<br>3,
                               rue Amélie, 75007 Paris, France<br>En février, à réception des pièces demandées,
                               le service de presse vous communiquera l\'adresse Internet d’un portail de
                               pré-inscription ainsi qu\'une référence personnalisée donnant accès à un formulaire
                               d\'accréditation en ligne que vous devez compléter et valider. Ce portail vous
                               permettra également de suivre le traitement de votre inscription en ligne.<br><br>
                               Les journalistes ayant pour la plupart une activité web, le Festival de Cannes a
                               établi une « Charte de bonne conduite » que nous vous demandons d’accepter au moment
                               de votre demande d’accréditation en ligne. Si votre accréditation est acceptée, vous
                               recevrez une confirmation par e-mail. Depuis votre formulaire en ligne, imprimez les
                               documents qui vous permettront de retirer votre badge à Cannes au niveau 01 du
                               Palais des Festivals.</p></li></ul><h5>cas particuliers :</h5><p>Si vous représentez
                               plusieurs médias, nous vous remercions de donner les informations relatives à chacun
                               d\'eux. Merci de nous préciser le média pour lequel vous voulez être accrédité en
                               priorité. Si vous exercez plusieurs fonctions (journaliste, photographe…), merci de
                               nous préciser votre fonction première car le service de presse ne délivre pas de
                               double accréditation.<br><br>Si vous avez changé de média par rapport à l\'année
                               précédente, merci de nous adresser une lettre officielle sur papier en-tête signée de
                               votre rédacteur en chef comportant les informations relatives à votre nouveau média
                               (périodicité, tirage, audience, couverture envisagée...), votre couverture de l\'année
                               précédente, ainsi qu\'un exemplaire récent de votre nouvelle publication pour la
                               presse écrite.</p>',
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
