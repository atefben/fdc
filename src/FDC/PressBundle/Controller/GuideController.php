<?php

namespace FDC\PressBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;


/**
 * @Route("/")
 */
class GuideController extends Controller
{

    /**
     * @Route("/guide")
     * @Template("FDCPressBundle:Guide:main.html.twig")
     * @return array
     */
    public function mainAction()
    {

        $headerInfo = array(
            'title' => 'Guide pratique',
            'description' => ''
        );

        $guideContent = array(
            'section' => array(
                'arrive' => array(
                    'title' => 'A votre arrivée',
                    'image' => array(
                        'path' => '//html.festival-cannes-2016.com.ohwee.fr/img/press/practical-guide/photo1.jpg'
                    ),
                    'content' => '<strong>Retrait des badges presse</strong><p>Votre badge personnalisé
                                  (nom - photo d\'identité - média représenté) est à retirer au bureau des
                                  accréditations au Palais des Festivals.<br>Il permet aux journalistes d\'accéder aux
                                  projections et conférences de presse dans la limite des places disponibles.<br>Le badge
                                  presse n\'est pas cessible et doit être porté de façon visible.</p>'
                ),
                'infos' => array(
                    'title' => 'Information',
                    'aside' => array(
                        'image'=> array(
                            'path' => '//html.festival-cannes-2016.com.ohwee.fr/img/press/practical-guide/photo2.jpg'
                        ),
                        'block' => array(
                            array(
                                'title' => 'Informations et tarifs',
                                'info' => array(
                                    array(
                                        'content' => '<span class="date">Jusqu\'au 31 mai :</span> <strong class="name">
                                                      Maïténa Chrétien : </strong><a href="mailto:mchretien@2p2l.com"
                                                      class="addr"> mchretien@2p2l.com</a> <span class="num">
                                                      +33(0)1 53 98 82 14 / +33 (0)7 86 72 98 12</span>'
                                    ),
                                    array(
                                        'content' => '<span class="date">A partir du 1er juin 2015 :</span>
                                                      <strong class="name">Muriel Sadoun : </strong>
                                                      <a href="mailto:muriel.sadoun@canal-plus.com"
                                                      class="addr">muriel.sadoun@canal-plus.com</a> <span class="num">
                                                      +33 (0) 1 71 35 28 29</span> <strong class="name">Delphine Beillard
                                                      : </strong><a href="mailto:delphine.beillard@canal-plus.com"
                                                      class="addr">delphine.beillard@canal-plus.com</a> <span class="num">
                                                      +33 (0) 1 71 35 25 15</span>'
                                    ),
                                )
                            ),
                            array(
                                'title' => 'Pour se procurer<br>des archives audiovisuelles',
                                'info' => array(
                                    array(
                                        'content' => '<span class="date">Télévision du Festival de Cannes de 2001 à 2014
                                                      <br>Cérémonies d\'ouvertures et clôtures de 1993 à 2014</span>
                                                      <strong class="name">Muriel Sadoun : </strong><a
                                                      href="mailto:muriel.sadoun@canal-plus.com" class="addr">
                                                      muriel.sadoun@canal-plus.com</a> <span class="num">
                                                      +33 (0) 1 71 35 28 29</span> <strong class="name">Delphine Beillard
                                                      : </strong><a href="mailto:delphine.beillard@canal-plus.com"
                                                      class="addr">delphine.beillard@canal-plus.com</a>
                                                      <span class="num"> +33 (0) 1 71 35 25 15</span>'
                                    ),
                                    array(
                                        'content' => '<span class="date">A partir du 1er juin 2015 :</span>
                                                      <strong class="name">Muriel Sadoun : </strong>
                                                      <a href="mailto:muriel.sadoun@canal-plus.com"
                                                      class="addr">muriel.sadoun@canal-plus.com</a> <span class="num">
                                                      +33 (0) 1 71 35 28 29</span> <strong class="name">Delphine Beillard
                                                      : </strong><a href="mailto:delphine.beillard@canal-plus.com"
                                                      class="addr">delphine.beillard@canal-plus.com</a> <span class="num">
                                                      +33 (0) 1 71 35 25 15</span>'
                                    ),
                                )
                            )
                        ),
                    ),
                    'article' => array(
                        'content' => '<strong>les publications du festival</strong> <p>Après le retrait du badge, les
                                      journalistes et photographes pourront retirer leur sac Festival aux comptoirs
                                      situés face aux banques d’accréditation. Ce sac contient notamment: le Programme
                                      officiel, le Catalogue officiel, l\'Horaire des projections et le Festival,
                                      mode d\'emploi.<br><br>Le Guide Horaire des projections presse vous est remis au
                                      moment du retrait de votre badge. Il est téléchargeable sur ce site quelques jours
                                      avant l\'ouverture du Festival.</p><strong>le quotidien</strong> <p>Il donne les
                                      horaires des projections du jour et du lendemain. Il est distribué la veille au
                                      soir aux accès du Palais et aux points infos.</p><strong>La Télévision du Festival
                                      </strong> <p>TV Festival de Cannes, coproduite par CANAL +, Orange et le Festival
                                      de Cannes, couvre les montées des marches, les conférences de presse, les photo-calls
                                      et les interviews ainsi que les événements officiels importants.<br><br>Diffusée en
                                      français et en anglais dans le Palais et des hôtels de la Croisette, la chaîne sera
                                      retransmise en exclusivité sur la TV d’Orange, Canal 30 et Canal 32 des offres CANAL+,
                                      CANALSAT en OTT. Elle sera également accessible dans le monde entier en direct et
                                      en Replay,<br>sur <a href="http://www.youtube.com/user/TVFestivaldeCannes"
                                      class="media">YouTube</a> et <a href="http://www.dailymotion.com/CannesFestTV"
                                      class="media">Dailymotion</a>, sur ordinateurs, smartphones et tablettes (iOS et Android)
                                      ainsi que sur le site officiel du Festival de Cannes. <br><br>L’ensemble des images
                                      est à disposition des médias et des Partenaires officiels du Festival à titre gracieux
                                      du 13 au 31 mai 2015 inclus, à condition qu’aucune exploitation commerciale n’en soit faite.
                                      <br><br>Pour plus d\'informations, consultez les <a href="">conditions d\'utilisation</a>
                                      ainsi que <a href="">le mode d\'emploi</a>. </p><p><a href="" class="media">
                                      Suivez le live TV Festival du 13 au 24 mai</a></p>'
                    ),
                    'secondArticle' => array(
                        'content' => '<strong>le site officiel du festival</strong> <p> Le site officiel couvrira la 68e
                                      édition en articles, interviews, photos et vidéos avec son Quotidien en ligne, et
                                      vous permettra d’écouter ou podcaster les conférences de presse et la Leçon de Cinéma.
                                      <br><br>La rubrique Presse permet d\'accéder aux informations pratiques et à
                                      divers téléchargements : le dossier de presse et l’affiche du Festival, les dossiers
                                      de presse des films de la Sélection officielle, leurs bandes-annonces et leurs photos
                                      libres de droit, ainsi qu’un choix de photos institutionnelles. Faites votre programme
                                      à la carte grâce à l’agenda presse interactif et souscrivez au flux RSS et à la Newsletter
                                      pour être les premiers informés de notre actualité.</p>',
                        'image' => array(
                            'path' => '//html.festival-cannes-2016.com.ohwee.fr/img/press/practical-guide/photo3.jpg'
                        )
                    )

                ),
                'appointment' => array(
                    'title' => 'Rendez-vous des médias',
                    'article' => array(
                        array(
                            'image' => array(
                                array(
                                    'path' => '//html.festival-cannes-2016.com.ohwee.fr/img/press/practical-guide/photo4.jpg'
                                ),
                                array(
                                    'path' => '//html.festival-cannes-2016.com.ohwee.fr/img/press/practical-guide/photo5.jpg'
                                )
                            ),
                            'content' => '<strong>Séances de presse de la Sélection officielle</strong> <p> Ces séances
                                          sont accessibles aux journalistes par priorité de carte et dans la limite des
                                          places disponibles.<br>Nous vous invitons à vérifier chaque jour dans le programme
                                          quotidien, distribué au service de presse et dans les casiers de presse, les
                                          horaires des projections ainsi que les modalités d\'accès. </p><strong>
                                          Projections du Marché du Film</strong> <p>Les badges presse ne donnent pas
                                          accès aux projections du Marché du Film, sauf si la société qui réserve la
                                          projection en a fait la demande. Pour plus d\'informations, reportez-vous au
                                          Daily screening program du Marché du Film.</p><strong>Projections des sections
                                          parallèles</strong> <p>Le badge presse permet d’assister aux projections de La
                                          Quinzaine des Réalisateurs et de La Semaine de la Critique dans la limite des
                                          places disponibles.</p>'
                        ),
                        array(
                            'image' => array(
                                array(
                                    'path' => '//html.festival-cannes-2016.com.ohwee.fr/img/press/practical-guide/photo6.jpg'
                                )
                            ),
                            'content' => '<strong>Conférences de Presse</strong> <p> L\'accès aux conférences de presse
                                          des films en Sélection officielle est exclusivement réservé aux journalistes
                                          accrédités, par priorité de carte et dans la limite des places disponibles.
                                          L\'accès des équipes de télévision à la salle de conférence de presse est
                                          organisé par le service de presse audiovisuelle du Festival.<br>Toutes les
                                          conférences de presse sont retransmises en français et en anglais sur TV
                                          Festival de Cannes. </p>'
                        ),
                        array(
                            'image' => array(
                                array(
                                    'path' => '//html.festival-cannes-2016.com.ohwee.fr/img/press/practical-guide/photo7.jpg'
                                )
                            ),
                            'content' => '<strong>Les Marches</strong> <p> Pour les séances de Gala, les télévisions et
                                          les photographes accrédités qui souhaitent bénéficier d’un emplacement réservé
                                          pour les prises de vue, doivent s\'inscrire auprès du service de presse
                                          audiovisuelle qui leur délivrera une autorisation d\'accès, dans la limite des
                                          places disponibles.<br>La tenue de soirée (smoking) est obligatoire pour toutes
                                          les séances du soir. </p>'
                        ),
                        array(
                            'image' => array(
                                array(
                                    'path' => '//html.festival-cannes-2016.com.ohwee.fr/img/press/practical-guide/photo8.jpg'
                                )
                            ),
                            'content' => '<strong>Photo-calls</strong> <p> Le photo-call, qui précède généralement la
                                          conférence de presse, permet aux photographes accrédités et munis d\'une
                                          autorisation spéciale délivrée par le service de presse audiovisuelle de
                                          prendre des photos des réalisateurs et acteurs des films de la Sélection
                                          officielle. Seule TV Festival de Cannes est autorisée à filmer les photo-calls.</p>'
                        ),
                    )
                ),
                'service' => array(
                    'title' => 'Services',
                    'services' => array(
                        array(
                            'content' => '<strong class="title-service">Espace wifi</strong> <p>Cet espace met à la
                                          disposition de la presse une large gamme de services multimédia et une
                                          connexion Wifi gratuite et illimitée dans un espace convivial.</p>',
                            'image' => array(
                                'path' => '//html.festival-cannes-2016.com.ohwee.fr/img/press/svg/wifi-grey.svg'
                            )
                        ),
                        array(
                            'content' => '<strong class="title-service">Espace wifi</strong> <p>Cet espace met à la
                                          disposition de la presse une large gamme de services multimédia et une
                                          connexion Wifi gratuite et illimitée dans un espace convivial.</p>',
                            'image' => array(
                                'path' => '//html.festival-cannes-2016.com.ohwee.fr/img/press/svg/wifi-grey.svg'
                            )
                        ),
                        array(
                            'content' => '<strong class="title-service">Espace wifi</strong> <p>Cet espace met à la
                                          disposition de la presse une large gamme de services multimédia et une
                                          connexion Wifi gratuite et illimitée dans un espace convivial.</p>',
                            'image' => array(
                                'path' => '//html.festival-cannes-2016.com.ohwee.fr/img/press/svg/wifi-grey.svg'
                            )
                        ),
                        array(
                            'content' => '<strong class="title-service">Espace wifi</strong> <p>Cet espace met à la
                                          disposition de la presse une large gamme de services multimédia et une
                                          connexion Wifi gratuite et illimitée dans un espace convivial.</p>',
                            'image' => array(
                                'path' => '//html.festival-cannes-2016.com.ohwee.fr/img/press/svg/wifi-grey.svg'
                            )
                        ),
                        array(
                            'content' => '<strong class="title-service">Espace wifi</strong> <p>Cet espace met à la
                                          disposition de la presse une large gamme de services multimédia et une
                                          connexion Wifi gratuite et illimitée dans un espace convivial.</p>',
                            'image' => array(
                                'path' => '//html.festival-cannes-2016.com.ohwee.fr/img/press/svg/wifi-grey.svg'
                            )
                        ),
                        array(
                            'content' => '<strong class="title-service">Espace wifi</strong> <p>Cet espace met à la
                                          disposition de la presse une large gamme de services multimédia et une
                                          connexion Wifi gratuite et illimitée dans un espace convivial.</p>',
                            'image' => array(
                                'path' => '//html.festival-cannes-2016.com.ohwee.fr/img/press/svg/wifi-grey.svg'
                            )
                        ),
                        array(
                            'content' => '<strong class="title-service">Espace wifi</strong> <p>Cet espace met à la
                                          disposition de la presse une large gamme de services multimédia et une
                                          connexion Wifi gratuite et illimitée dans un espace convivial.</p>',
                            'image' => array(
                                'path' => '//html.festival-cannes-2016.com.ohwee.fr/img/press/svg/wifi-grey.svg'
                            )
                        )
                    )
                ),
            )
        );

        return array(
            'headerInfo' => $headerInfo,
            'guideContent' => $guideContent,
        );

    }
}
