<!DOCTYPE html>
<html>

<head>
  <?php include('head.html'); ?>
</head>

<body>
<?php include('header.html'); ?>

<div id="main" class="all-photos grid loading">
  <h2 class="title">Toutes les photos</h2>
  <div class="filters">
    <div id="dates" class="filter">
      <span class="label">Dates :</span>
      <span class="select">
                        <span class="active" data-filter="all">
                                    [ Toutes ]
                            </span>
                        <span class="" data-filter="22-05-16">
                                                            dimanche 22 mai 2016
                                                </span>
                        <span class="" data-filter="21-05-16">
                                                            samedi 21 mai 2016
                                                </span>
                        <span class="" data-filter="20-05-16">
                                                            vendredi 20 mai 2016
                                                </span>
                        <span class="" data-filter="19-05-16">
                                                            jeudi 19 mai 2016
                                                </span>
                        <span class="" data-filter="18-05-16">
                                                            mercredi 18 mai 2016
                                                </span>
                        <span class="" data-filter="17-05-16">
                                                            mardi 17 mai 2016
                                                </span>
                        <span class="" data-filter="16-05-16">
                                                            lundi 16 mai 2016
                                                </span>
                        <span class="" data-filter="15-05-16">
                                                            dimanche 15 mai 2016
                                                </span>
                        <span class="" data-filter="14-05-16">
                                                            samedi 14 mai 2016
                                                </span>
                        <span class="" data-filter="13-05-16">
                                                            vendredi 13 mai 2016
                                                </span>
                        <span class="" data-filter="12-05-16">
                                                            jeudi 12 mai 2016
                                                </span>
                        <span class="" data-filter="11-05-16">
                                                            mercredi 11 mai 2016
                                                </span>
                        <span class="" data-filter="10-05-16">
                                                            mardi 10 mai 2016
                                                </span>
                        <span class="" data-filter="07-05-16">
                                                            samedi 7 mai 2016
                                                </span>
                        <span class="" data-filter="03-05-16">
                                                            mardi 3 mai 2016
                                                </span>
                        <span class="" data-filter="28-04-16">
                                                            jeudi 28 avril 2016
                                                </span>
                        <span class="" data-filter="25-04-16">
                                                            lundi 25 avril 2016
                                                </span>
                        <span class="" data-filter="20-04-16">
                                                            mercredi 20 avril 2016
                                                </span>
                        <span class="" data-filter="14-04-16">
                                                            jeudi 14 avril 2016
                                                </span>
                        <span class="" data-filter="11-04-16">
                                                            lundi 11 avril 2016
                                                </span>
                        <span class="" data-filter="07-04-16">
                                                            jeudi 7 avril 2016
                                                </span>
                        <span class="" data-filter="04-04-16">
                                                            lundi 4 avril 2016
                                                </span>
                        <span class="" data-filter="29-03-16">
                                                            mardi 29 mars 2016
                                                </span>
                        <span class="" data-filter="21-03-16">
                                                            lundi 21 mars 2016
                                                </span>
                        <span class="" data-filter="15-03-16">
                                                            mardi 15 mars 2016
                                                </span>
                        <span class="" data-filter="11-03-16">
                                                            vendredi 11 mars 2016
                                                </span>
                        <span class="" data-filter="02-03-16">
                                                            mercredi 2 mars 2016
                                                </span>
                        <i class="icon icon_fleche-down"></i>
          </span>
    </div>
    <div id="theme" class="filter">
      <span class="label">Thèmes :</span>
      <span class="select">
                        <span class="active" data-filter="all">
                                    [ Tous ]
                            </span>
                        <span class="" data-filter="photocall">
                                    Photocall
                            </span>
                        <span class="" data-filter="conference-de-presse">
                                    Conférence de Presse
                            </span>
                        <span class="" data-filter="palmares">
                                    Palmarès
                            </span>
                        <span class="" data-filter="montee-des-marches">
                                    Montée des Marches
                            </span>
                        <span class="" data-filter="oeil-du-photographe">
                                    Œil du photographe
                            </span>
                        <span class="" data-filter="evenement">
                                    Évènement
                            </span>
                        <span class="" data-filter="short-film-corner">
                                    Short Film Corner
                            </span>
                        <span class="" data-filter="sur-scene">
                                    Sur Scène
                            </span>
                        <span class="" data-filter="avant-la-projection">
                                    Avant la projection
                            </span>
                        <span class="" data-filter="un-certain-regard">
                                    Un Certain Regard
                            </span>
                        <span class="" data-filter="cannes-classics">
                                    Cannes Classics
                            </span>
                        <span class="" data-filter="competition">
                                    Compétition
                            </span>
                        <span class="" data-filter="ouverture">
                                    Ouverture
                            </span>
                        <span class="" data-filter="jury">
                                    Jury
                            </span>
                        <span class="" data-filter="selection-officielle">
                                    Sélection officielle
                            </span>
                        <span class="" data-filter="hors-competition">
                                    Hors Compétition
                            </span>
                        <span class="" data-filter="courts-metrages">
                                    Courts Métrages
                            </span>
                        <span class="" data-filter="lecon-de-cinema">
                                    Leçon de Cinéma
                            </span>
                        <span class="" data-filter="affiche">
                                    Affiche
                            </span>
                        <span class="" data-filter="l-atelier">
                                    L&#039;atelier
                            </span>
                        <i class="icon icon_fleche-down"></i>
        </span>
    </div>
  </div>
  <div id="gridPhotos" class="grid-wrapper" data-type="photos">
    <div class="grid-sizer"></div>
    <div class="images">

      <div class="item photocall 22-05-16 shadow-bottom photo paysage notloaded">
        <a id="photo1874" class="ajax chocolat-image" data-pid="1874"
           href="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/07/76a0658c2e4af6fbed7127f639a100de7c712f95.jpg"
           title='<span class="category">Photocall</span><span class="date">22.05.16 . 23:50</span><h2>Ken Loach, Palme d&#039;or - I, Daniel Blake (Moi, Daniel Blake)</h2>'
           data-credit="Crédit Image : Loïc Venance / AFP"></a>
        <img data-original="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/07/thumb_6110_media_image_640x404.jpg"  alt="" title="Ken Loach, Palme d&#039;or - I, Daniel Blake (Moi, Daniel Blake)" class="lazy">
        <div class="picto"><i class="icon icon_photo"></i></div>
        <div class="info">
          <div class="vCenter">
            <div class="vCenterKid">
              <span class="category">Photocall</span>
              <span class="date">22.05.16</span> . <span
                  class="hour">23:50</span>
              <p data-title="Ken Loach, Palme d&#039;or - I, Daniel Blake (Moi, Daniel Blake)">Ken Loach, Palme d&#039;or - I, Daniel Blake (Moi, Daniel Blake)</p>
            </div>
          </div>
        </div>
      </div>
      <div class="item conference-de-presse 22-05-16 shadow-bottom photo paysage notloaded">
        <a id="photo1897" class="ajax chocolat-image" data-pid="1897"
           href="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/07/7b8dca11e8eb716901d3c060c185e093e1a8fb02.jpg"
           title='<span class="category">Conférence de Presse</span><span class="date">22.05.16 . 23:20</span><h2>Jury des Longs métrages</h2>'
           data-credit="Crédit Image : Thomas Leibreich / FDC"></a>
        <img data-original="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/07/thumb_6132_media_image_640x404.jpg"  alt="" title="Jury des Longs métrages" class="lazy">
        <div class="picto"><i class="icon icon_photo"></i></div>
        <div class="info">
          <div class="vCenter">
            <div class="vCenterKid">
              <span class="category">Conférence de Presse</span>
              <span class="date">22.05.16</span> . <span
                  class="hour">23:20</span>
              <p data-title="Jury des Longs métrages">Jury des Longs métrages</p>
            </div>
          </div>
        </div>
      </div>
      <div class="item conference-de-presse 22-05-16 shadow-bottom photo paysage notloaded">
        <a id="photo1890" class="ajax chocolat-image" data-pid="1890"
           href="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/07/c232aaba9d0c570f42f38fd2ccb3a6d88fff3d0c.jpg"
           title='<span class="category">Conférence de Presse</span><span class="date">22.05.16 . 21:30</span><h2>Houda Benyamina, Caméra d&#039;or - Divines</h2>'
           data-credit="Crédit Image : Thomas Leibreich / FDC"></a>
        <img data-original="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/07/thumb_6124_media_image_640x404.jpg"  alt="" title="Houda Benyamina, Caméra d&#039;or - Divines" class="lazy">
        <div class="picto"><i class="icon icon_photo"></i></div>
        <div class="info">
          <div class="vCenter">
            <div class="vCenterKid">
              <span class="category">Conférence de Presse</span>
              <span class="date">22.05.16</span> . <span
                  class="hour">21:30</span>
              <p data-title="Houda Benyamina, Caméra d&#039;or - Divines">Houda Benyamina, Caméra d&#039;or - Divines</p>
            </div>
          </div>
        </div>
      </div>
      <div class="item conference-de-presse 22-05-16 shadow-bottom photo paysage notloaded">
        <a id="photo1896" class="ajax chocolat-image" data-pid="1896"
           href="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/07/506f6b6cc9f4ddfdf46cd119f86b6d78a6350101.jpg"
           title='<span class="category">Conférence de Presse</span><span class="date">22.05.16 . 21:30</span><h2>Ken Loach, Palme d&#039;or - I, Daniel Blake</h2>'
           data-credit="Crédit Image : Ian Gavan / Getty Images"></a>
        <img data-original="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/07/thumb_6131_media_image_640x404.jpg"  alt="" title="Ken Loach, Palme d&#039;or - I, Daniel Blake" class="lazy">
        <div class="picto"><i class="icon icon_photo"></i></div>
        <div class="info">
          <div class="vCenter">
            <div class="vCenterKid">
              <span class="category">Conférence de Presse</span>
              <span class="date">22.05.16</span> . <span
                  class="hour">21:30</span>
              <p data-title="Ken Loach, Palme d&#039;or - I, Daniel Blake">Ken Loach, Palme d&#039;or - I, Daniel Blake</p>
            </div>
          </div>
        </div>
      </div>
      <div class="item conference-de-presse 22-05-16 shadow-bottom photo paysage notloaded">
        <a id="photo1889" class="ajax chocolat-image" data-pid="1889"
           href="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/07/e549b53e12074df86e9fbd41b87f97d9800c111b.jpg"
           title='<span class="category">Conférence de Presse</span><span class="date">22.05.16 . 21:20</span><h2>Olivier Assayas, Prix de la mise en scène ex-æquo - Personal Shopper</h2>'
           data-credit="Crédit Image : Thomas Leibreich / FDC"></a>
        <img data-original="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/07/thumb_6123_media_image_640x404.jpg"  alt="" title="Olivier Assayas, Prix de la mise en scène ex-æquo - Personal Shopper" class="lazy">
        <div class="picto"><i class="icon icon_photo"></i></div>
        <div class="info">
          <div class="vCenter">
            <div class="vCenterKid">
              <span class="category">Conférence de Presse</span>
              <span class="date">22.05.16</span> . <span
                  class="hour">21:20</span>
              <p data-title="Olivier Assayas, Prix de la mise en scène ex-æquo - Personal Shopper">Olivier Assayas, Prix de la mise en scène ex-æquo - Personal Shopper</p>
            </div>
          </div>
        </div>
      </div>
      <div class="item conference-de-presse 22-05-16 shadow-bottom photo paysage notloaded">
        <a id="photo1888" class="ajax chocolat-image" data-pid="1888"
           href="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/07/7dbbc38d4a4bf81a1e5d52fdb236791c2280c580.jpg"
           title='<span class="category">Conférence de Presse</span><span class="date">22.05.16 . 21:17</span><h2>Asghar Farhadi et Shahab Hosseini,  Prix du scénario et  Prix d&#039;interprétation masculine - Forushande (Le Client)</h2>'
           data-credit="Crédit Image : Thomas Leibreich / FDC"></a>
        <img data-original="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/07/thumb_6122_media_image_640x404.jpg"  alt="" title="Asghar Farhadi et Shahab Hosseini,  Prix du scénario et  Prix d&#039;interprétation masculine - Forushande (Le Client)" class="lazy">
        <div class="picto"><i class="icon icon_photo"></i></div>
        <div class="info">
          <div class="vCenter">
            <div class="vCenterKid">
              <span class="category">Conférence de Presse</span>
              <span class="date">22.05.16</span> . <span
                  class="hour">21:17</span>
              <p data-title="Asghar Farhadi et Shahab Hosseini,  Prix du scénario et  Prix d&#039;interprétation masculine - Forushande (Le Client)">Asghar Farhadi et Shahab Hosseini,  Prix du scénario et  Prix d&#039;interprétation masculine - Forushande (Le Client)</p>
            </div>
          </div>
        </div>
      </div>
      <div class="item conference-de-presse 22-05-16 shadow-bottom photo paysage notloaded">
        <a id="photo1885" class="ajax chocolat-image" data-pid="1885"
           href="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/07/12a69f7546cacc1cbbd4c1c4e267048847f66d98.jpg"
           title='<span class="category">Conférence de Presse</span><span class="date">22.05.16 . 21:13</span><h2>Jaclyn Jose, Prix d&#039;interprétation féminine - Ma&#039;Rosa</h2>'
           data-credit="Crédit Image : Thomas Leibreich / FDC"></a>
        <img data-original="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/07/thumb_6120_media_image_640x404.jpg"  alt="" title="Jaclyn Jose, Prix d&#039;interprétation féminine - Ma&#039;Rosa" class="lazy">
        <div class="picto"><i class="icon icon_photo"></i></div>
        <div class="info">
          <div class="vCenter">
            <div class="vCenterKid">
              <span class="category">Conférence de Presse</span>
              <span class="date">22.05.16</span> . <span
                  class="hour">21:13</span>
              <p data-title="Jaclyn Jose, Prix d&#039;interprétation féminine - Ma&#039;Rosa">Jaclyn Jose, Prix d&#039;interprétation féminine - Ma&#039;Rosa</p>
            </div>
          </div>
        </div>
      </div>
      <div class="item conference-de-presse 22-05-16 shadow-bottom photo paysage notloaded">
        <a id="photo1882" class="ajax chocolat-image" data-pid="1882"
           href="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/07/32d83f2a5fc694ae15da691aaf6d2d61f3cd8a81.jpg"
           title='<span class="category">Conférence de Presse</span><span class="date">22.05.16 . 21:10</span><h2>Jury des Longs Métrages - Cérémonie de clôture</h2>'
           data-credit="Crédit Image : Thomas Leibreich / FDC"></a>
        <img data-original="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/07/thumb_6117_media_image_640x404.jpg"  alt="" title="Jury des Longs Métrages - Cérémonie de clôture" class="lazy">
        <div class="picto"><i class="icon icon_photo"></i></div>
        <div class="info">
          <div class="vCenter">
            <div class="vCenterKid">
              <span class="category">Conférence de Presse</span>
              <span class="date">22.05.16</span> . <span
                  class="hour">21:10</span>
              <p data-title="Jury des Longs Métrages - Cérémonie de clôture">Jury des Longs Métrages - Cérémonie de clôture</p>
            </div>
          </div>
        </div>
      </div>
      <div class="item conference-de-presse 22-05-16 shadow-bottom photo paysage notloaded">
        <a id="photo1892" class="ajax chocolat-image" data-pid="1892"
           href="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/07/62bb8d434b35a408382736aeaab803cab3cdc8d4.jpg"
           title='<span class="category">Conférence de Presse</span><span class="date">22.05.16 . 21:10</span><h2>George Miller, Président du Jury des Longs Métrages</h2>'
           data-credit="Crédit Image : Thomas Leibreich / FDC"></a>
        <img data-original="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/07/thumb_6127_media_image_640x404.jpg"  alt="" title="George Miller, Président du Jury des Longs Métrages" class="lazy">
        <div class="picto"><i class="icon icon_photo"></i></div>
        <div class="info">
          <div class="vCenter">
            <div class="vCenterKid">
              <span class="category">Conférence de Presse</span>
              <span class="date">22.05.16</span> . <span
                  class="hour">21:10</span>
              <p data-title="George Miller, Président du Jury des Longs Métrages">George Miller, Président du Jury des Longs Métrages</p>
            </div>
          </div>
        </div>
      </div>
      <div class="item conference-de-presse 22-05-16 shadow-bottom photo paysage notloaded">
        <a id="photo1895" class="ajax chocolat-image" data-pid="1895"
           href="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/07/1eb187bcbdc6fc0c730b554c0e389ba906a7cd97.jpg"
           title='<span class="category">Conférence de Presse</span><span class="date">22.05.16 . 21:10</span><h2>Jury des Longs métrages</h2>'
           data-credit="Crédit Image : thomas Leibreich / FDC"></a>
        <img data-original="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/07/thumb_6130_media_image_640x404.jpg"  alt="" title="Jury des Longs métrages" class="lazy">
        <div class="picto"><i class="icon icon_photo"></i></div>
        <div class="info">
          <div class="vCenter">
            <div class="vCenterKid">
              <span class="category">Conférence de Presse</span>
              <span class="date">22.05.16</span> . <span
                  class="hour">21:10</span>
              <p data-title="Jury des Longs métrages">Jury des Longs métrages</p>
            </div>
          </div>
        </div>
      </div>
      <div class="item photocall 22-05-16 shadow-bottom photo paysage notloaded">
        <a id="photo1891" class="ajax chocolat-image" data-pid="1891"
           href="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/07/cc1cf97ff91d70e73243f29366457e4f801c4eae.jpg"
           title='<span class="category">Photocall</span><span class="date">22.05.16 . 21:05</span><h2>João Paulo Miranda Maria, Mention Spéciale du Jury - Court métrage - A Moça Que Dançou Com O Diabo ( La Jeune fille qui dansait avec le diable)</h2>'
           data-credit="Crédit Image : Loïc Venance / AFP"></a>
        <img data-original="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/07/thumb_6126_media_image_640x404.jpg"  alt="" title="João Paulo Miranda Maria, Mention Spéciale du Jury - Court métrage - A Moça Que Dançou Com O Diabo ( La Jeune fille qui dansait avec le diable)" class="lazy">
        <div class="picto"><i class="icon icon_photo"></i></div>
        <div class="info">
          <div class="vCenter">
            <div class="vCenterKid">
              <span class="category">Photocall</span>
              <span class="date">22.05.16</span> . <span
                  class="hour">21:05</span>
              <p data-title="João Paulo Miranda Maria, Mention Spéciale du Jury - Court métrage - A Moça Que Dançou Com O Diabo ( La Jeune fille qui dansait avec le diable)">João Paulo Miranda Maria, Mention Spéciale du Jury - Court métrage - A Moça Que Dançou Com O Diabo ( La Jeune fille qui dansait avec le diable)</p>
            </div>
          </div>
        </div>
      </div>
      <div class="item photocall 22-05-16 shadow-bottom photo paysage notloaded">
        <a id="photo1879" class="ajax chocolat-image" data-pid="1879"
           href="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/07/200070ca7bd5ce4da354a195985aaff8d6a8cf33.jpg"
           title='<span class="category">Photocall</span><span class="date">22.05.16 . 21:00</span><h2>Shahab Hosseini, Prix d&#039;interprétation masculine - Forushande (Le Client)</h2>'
           data-credit="Crédit Image : Anne-Christine Poujoulat / AFP"></a>
        <img data-original="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/07/thumb_6114_media_image_640x404.jpg"  alt="" title="Shahab Hosseini, Prix d&#039;interprétation masculine - Forushande (Le Client)" class="lazy">
        <div class="picto"><i class="icon icon_photo"></i></div>
        <div class="info">
          <div class="vCenter">
            <div class="vCenterKid">
              <span class="category">Photocall</span>
              <span class="date">22.05.16</span> . <span
                  class="hour">21:00</span>
              <p data-title="Shahab Hosseini, Prix d&#039;interprétation masculine - Forushande (Le Client)">Shahab Hosseini, Prix d&#039;interprétation masculine - Forushande (Le Client)</p>
            </div>
          </div>
        </div>
      </div>
      <div class="item photocall 22-05-16 shadow-bottom photo paysage notloaded">
        <a id="photo1878" class="ajax chocolat-image" data-pid="1878"
           href="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/07/8d88d5c283ac989146f4c042b571fbd8099896cf.jpg"
           title='<span class="category">Photocall</span><span class="date">22.05.16 . 20:55</span><h2>Andrea Arnold, Prix du Jury - American Honey</h2>'
           data-credit="Crédit Image : Anne-Christine Poujoulat / AFP"></a>
        <img data-original="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/07/thumb_6113_media_image_640x404.jpg"  alt="" title="Andrea Arnold, Prix du Jury - American Honey" class="lazy">
        <div class="picto"><i class="icon icon_photo"></i></div>
        <div class="info">
          <div class="vCenter">
            <div class="vCenterKid">
              <span class="category">Photocall</span>
              <span class="date">22.05.16</span> . <span
                  class="hour">20:55</span>
              <p data-title="Andrea Arnold, Prix du Jury - American Honey">Andrea Arnold, Prix du Jury - American Honey</p>
            </div>
          </div>
        </div>
      </div>
      <div class="item photocall 22-05-16 shadow-bottom photo paysage notloaded">
        <a id="photo1876" class="ajax chocolat-image" data-pid="1876"
           href="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/07/32bdd3b43fad03f180eca48f6ad428fd15f0dd72.jpg"
           title='<span class="category">Photocall</span><span class="date">22.05.16 . 20:50</span><h2>Xavier Dolan, Grand Prix - Juste la Fin du Monde</h2>'
           data-credit="Crédit Image : Anne-Christine Poujoulat / AFP"></a>
        <img data-original="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/07/thumb_6112_media_image_640x404.jpg"  alt="" title="Xavier Dolan, Grand Prix - Juste la Fin du Monde" class="lazy">
        <div class="picto"><i class="icon icon_photo"></i></div>
        <div class="info">
          <div class="vCenter">
            <div class="vCenterKid">
              <span class="category">Photocall</span>
              <span class="date">22.05.16</span> . <span
                  class="hour">20:50</span>
              <p data-title="Xavier Dolan, Grand Prix - Juste la Fin du Monde">Xavier Dolan, Grand Prix - Juste la Fin du Monde</p>
            </div>
          </div>
        </div>
      </div>
      <div class="item photocall 22-05-16 shadow-bottom photo paysage notloaded">
        <a id="photo1875" class="ajax chocolat-image" data-pid="1875"
           href="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/07/fc78fc393f30ffba82a2efd7295262bc3065772e.jpg"
           title='<span class="category">Photocall</span><span class="date">22.05.16 . 20:40</span><h2>Cristian Mungiu, Prix de la mise en scène ex-æquo - Bacalaureat (Baccalauréat) - Maria Dragus</h2>'
           data-credit="Crédit Image : Anne-Christine Poujoulat / AFP"></a>
        <img data-original="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/07/thumb_6111_media_image_640x404.jpg"  alt="" title="Cristian Mungiu, Prix de la mise en scène ex-æquo - Bacalaureat (Baccalauréat) - Maria Dragus" class="lazy">
        <div class="picto"><i class="icon icon_photo"></i></div>
        <div class="info">
          <div class="vCenter">
            <div class="vCenterKid">
              <span class="category">Photocall</span>
              <span class="date">22.05.16</span> . <span
                  class="hour">20:40</span>
              <p data-title="Cristian Mungiu, Prix de la mise en scène ex-æquo - Bacalaureat (Baccalauréat) - Maria Dragus">Cristian Mungiu, Prix de la mise en scène ex-æquo - Bacalaureat (Baccalauréat) - Maria Dragus</p>
            </div>
          </div>
        </div>
      </div>
      <div class="item photocall 22-05-16 shadow-bottom photo paysage notloaded">
        <a id="photo1873" class="ajax chocolat-image" data-pid="1873"
           href="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/07/9012676776f041b6c961641b200dbc7c2f5841ca.jpg"
           title='<span class="category">Photocall</span><span class="date">22.05.16 . 20:30</span><h2>Juanjo Gimenez, Palme d&#039;or du court métrage - Timecode</h2>'
           data-credit="Crédit Image : Anne-Christine Poujoulat / AFP"></a>
        <img data-original="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/07/thumb_6109_media_image_640x404.jpg"  alt="" title="Juanjo Gimenez, Palme d&#039;or du court métrage - Timecode" class="lazy">
        <div class="picto"><i class="icon icon_photo"></i></div>
        <div class="info">
          <div class="vCenter">
            <div class="vCenterKid">
              <span class="category">Photocall</span>
              <span class="date">22.05.16</span> . <span
                  class="hour">20:30</span>
              <p data-title="Juanjo Gimenez, Palme d&#039;or du court métrage - Timecode">Juanjo Gimenez, Palme d&#039;or du court métrage - Timecode</p>
            </div>
          </div>
        </div>
      </div>
      <div class="item palmares 22-05-16 shadow-bottom photo paysage notloaded">
        <a id="photo1871" class="ajax chocolat-image" data-pid="1871"
           href="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/07/779d6fa5c4d8ce9c0a149922ccac0f1cdd3b2a8e.jpg"
           title='<span class="category">Palmarès</span><span class="date">22.05.16 . 20:20</span><h2>Le Jury et les Lauréats du 69e Festival de Cannes</h2>'
           data-credit="Crédit Image : Antonin Thuillier / AFP"></a>
        <img data-original="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/07/thumb_6108_media_image_640x404.jpg"  alt="" title="Le Jury et les Lauréats du 69e Festival de Cannes" class="lazy">
        <div class="picto"><i class="icon icon_photo"></i></div>
        <div class="info">
          <div class="vCenter">
            <div class="vCenterKid">
              <span class="category">Palmarès</span>
              <span class="date">22.05.16</span> . <span
                  class="hour">20:20</span>
              <p data-title="Le Jury et les Lauréats du 69e Festival de Cannes">Le Jury et les Lauréats du 69e Festival de Cannes</p>
            </div>
          </div>
        </div>
      </div>
      <div class="item palmares 22-05-16 shadow-bottom photo paysage notloaded">
        <a id="photo1870" class="ajax chocolat-image" data-pid="1870"
           href="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/07/5fc0a9051056f291dad99d040049b139a6407bea.jpg"
           title='<span class="category">Palmarès</span><span class="date">22.05.16 . 20:15</span><h2>Xavier Dolan, Ken Loach, Jaclyn Jose, Jean-Pierre Leaud, Shahab Hossein - Cérémonie de clôture</h2>'
           data-credit="Crédit Image : Alberto Pizzoli / AFP"></a>
        <img data-original="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/07/thumb_6107_media_image_640x404.jpg"  alt="" title="Xavier Dolan, Ken Loach, Jaclyn Jose, Jean-Pierre Leaud, Shahab Hossein - Cérémonie de clôture" class="lazy">
        <div class="picto"><i class="icon icon_photo"></i></div>
        <div class="info">
          <div class="vCenter">
            <div class="vCenterKid">
              <span class="category">Palmarès</span>
              <span class="date">22.05.16</span> . <span
                  class="hour">20:15</span>
              <p data-title="Xavier Dolan, Ken Loach, Jaclyn Jose, Jean-Pierre Leaud, Shahab Hossein - Cérémonie de clôture">Xavier Dolan, Ken Loach, Jaclyn Jose, Jean-Pierre Leaud, Shahab Hossein - Cérémonie de clôture</p>
            </div>
          </div>
        </div>
      </div>
      <div class="item palmares 22-05-16 shadow-bottom photo paysage notloaded">
        <a id="photo1866" class="ajax chocolat-image" data-pid="1866"
           href="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/07/77e05af09801dc3bde6c032c4ed2530dc73c292c.jpg"
           title='<span class="category">Palmarès</span><span class="date">22.05.16 . 20:10</span><h2>Ken Loach, Palme d&#039;or - I, Daniel Blake (Moi, Daniel Blake) - Paul Laverty, Rebecca O&#039;Brien</h2>'
           data-credit="Crédit Image : Valéry Hache / AFP"></a>
        <img data-original="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/07/thumb_6100_media_image_640x404.jpg"  alt="" title="Ken Loach, Palme d&#039;or - I, Daniel Blake (Moi, Daniel Blake) - Paul Laverty, Rebecca O&#039;Brien" class="lazy">
        <div class="picto"><i class="icon icon_photo"></i></div>
        <div class="info">
          <div class="vCenter">
            <div class="vCenterKid">
              <span class="category">Palmarès</span>
              <span class="date">22.05.16</span> . <span
                  class="hour">20:10</span>
              <p data-title="Ken Loach, Palme d&#039;or - I, Daniel Blake (Moi, Daniel Blake) - Paul Laverty, Rebecca O&#039;Brien">Ken Loach, Palme d&#039;or - I, Daniel Blake (Moi, Daniel Blake) - Paul Laverty, Rebecca O&#039;Brien</p>
            </div>
          </div>
        </div>
      </div>
      <div class="item palmares 22-05-16 shadow-bottom photo paysage notloaded">
        <a id="photo1865" class="ajax chocolat-image" data-pid="1865"
           href="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/07/06defb45b5adea5ffd695c3422f0e74ab15b294a.jpg"
           title='<span class="category">Palmarès</span><span class="date">22.05.16 . 20:00</span><h2>Ken Loach, Palme d&#039;or - I, Daniel Blake (Moi, Daniel Blake)</h2>'
           data-credit="Crédit Image : Valéry Hache / AFP"></a>
        <img data-original="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/07/thumb_6095_media_image_640x404.jpg"  alt="" title="Ken Loach, Palme d&#039;or - I, Daniel Blake (Moi, Daniel Blake)" class="lazy">
        <div class="picto"><i class="icon icon_photo"></i></div>
        <div class="info">
          <div class="vCenter">
            <div class="vCenterKid">
              <span class="category">Palmarès</span>
              <span class="date">22.05.16</span> . <span
                  class="hour">20:00</span>
              <p data-title="Ken Loach, Palme d&#039;or - I, Daniel Blake (Moi, Daniel Blake)">Ken Loach, Palme d&#039;or - I, Daniel Blake (Moi, Daniel Blake)</p>
            </div>
          </div>
        </div>
      </div>
      <div class="item palmares 22-05-16 shadow-bottom photo paysage notloaded">
        <a id="photo1869" class="ajax chocolat-image" data-pid="1869"
           href="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/07/73bfc30711016d62026df37c53434c44a8220ec7.jpg"
           title='<span class="category">Palmarès</span><span class="date">22.05.16 . 19:55</span><h2>Mel Gibson - Cérémonie de clôture</h2>'
           data-credit="Crédit Image : Valéry Hache / AFP"></a>
        <img data-original="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/07/thumb_6102_media_image_640x404.jpg"  alt="" title="Mel Gibson - Cérémonie de clôture" class="lazy">
        <div class="picto"><i class="icon icon_photo"></i></div>
        <div class="info">
          <div class="vCenter">
            <div class="vCenterKid">
              <span class="category">Palmarès</span>
              <span class="date">22.05.16</span> . <span
                  class="hour">19:55</span>
              <p data-title="Mel Gibson - Cérémonie de clôture">Mel Gibson - Cérémonie de clôture</p>
            </div>
          </div>
        </div>
      </div>
      <div class="item palmares 22-05-16 shadow-bottom photo paysage notloaded">
        <a id="photo1881" class="ajax chocolat-image" data-pid="1881"
           href="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/07/4cc5998bc7386c051df7d52bf9d08ea88bde0119.jpg"
           title='<span class="category">Palmarès</span><span class="date">22.05.16 . 19:53</span><h2>Grand Théâtre Lumière - Cérémonie de clôture</h2>'
           data-credit="Crédit Image : Antonin Thuillier / AFP"></a>
        <img data-original="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/07/thumb_6116_media_image_640x404.jpg"  alt="" title="Grand Théâtre Lumière - Cérémonie de clôture" class="lazy">
        <div class="picto"><i class="icon icon_photo"></i></div>
        <div class="info">
          <div class="vCenter">
            <div class="vCenterKid">
              <span class="category">Palmarès</span>
              <span class="date">22.05.16</span> . <span
                  class="hour">19:53</span>
              <p data-title="Grand Théâtre Lumière - Cérémonie de clôture">Grand Théâtre Lumière - Cérémonie de clôture</p>
            </div>
          </div>
        </div>
      </div>
      <div class="item palmares 22-05-16 shadow-bottom photo paysage notloaded">
        <a id="photo1864" class="ajax chocolat-image" data-pid="1864"
           href="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/07/b9858063bb3a8a58b3aa20baeee217aee81d3a14.jpg"
           title='<span class="category">Palmarès</span><span class="date">22.05.16 . 19:50</span><h2>Xavier Dolan, Grand Prix - Juste la Fin du Monde</h2>'
           data-credit="Crédit Image : Valéry Hache / AFP"></a>
        <img data-original="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/07/thumb_6094_media_image_640x404.jpg"  alt="" title="Xavier Dolan, Grand Prix - Juste la Fin du Monde" class="lazy">
        <div class="picto"><i class="icon icon_photo"></i></div>
        <div class="info">
          <div class="vCenter">
            <div class="vCenterKid">
              <span class="category">Palmarès</span>
              <span class="date">22.05.16</span> . <span
                  class="hour">19:50</span>
              <p data-title="Xavier Dolan, Grand Prix - Juste la Fin du Monde">Xavier Dolan, Grand Prix - Juste la Fin du Monde</p>
            </div>
          </div>
        </div>
      </div>
      <div class="item palmares 22-05-16 shadow-bottom photo paysage notloaded">
        <a id="photo1861" class="ajax chocolat-image" data-pid="1861"
           href="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/07/231a1dfaec3cbdd0150116ac30ee105ad177ac4e.jpg"
           title='<span class="category">Palmarès</span><span class="date">22.05.16 . 19:40</span><h2>Asghar Farhadi, Prix du scénario - Forushande (Le Client)</h2>'
           data-credit="Crédit Image : Alberto Pizzoli / AFP"></a>
        <img data-original="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/07/thumb_6098_media_image_640x404.jpg"  alt="" title="Asghar Farhadi, Prix du scénario - Forushande (Le Client)" class="lazy">
        <div class="picto"><i class="icon icon_photo"></i></div>
        <div class="info">
          <div class="vCenter">
            <div class="vCenterKid">
              <span class="category">Palmarès</span>
              <span class="date">22.05.16</span> . <span
                  class="hour">19:40</span>
              <p data-title="Asghar Farhadi, Prix du scénario - Forushande (Le Client)">Asghar Farhadi, Prix du scénario - Forushande (Le Client)</p>
            </div>
          </div>
        </div>
      </div>
      <div class="item palmares 22-05-16 shadow-bottom photo paysage notloaded">
        <a id="photo1863" class="ajax chocolat-image" data-pid="1863"
           href="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/07/5ee29d5f2fcd56c9a9d3d58f820cf89785539949.jpg"
           title='<span class="category">Palmarès</span><span class="date">22.05.16 . 19:35</span><h2>Cristian Mungiu, Prix de la mise en scène ex-æquo - Bacalaureat (Baccalauréat)</h2>'
           data-credit="Crédit Image : Alberto Pizzoli / AFP"></a>
        <img data-original="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/07/thumb_6092_media_image_640x404.jpg"  alt="" title="Cristian Mungiu, Prix de la mise en scène ex-æquo - Bacalaureat (Baccalauréat)" class="lazy">
        <div class="picto"><i class="icon icon_photo"></i></div>
        <div class="info">
          <div class="vCenter">
            <div class="vCenterKid">
              <span class="category">Palmarès</span>
              <span class="date">22.05.16</span> . <span
                  class="hour">19:35</span>
              <p data-title="Cristian Mungiu, Prix de la mise en scène ex-æquo - Bacalaureat (Baccalauréat)">Cristian Mungiu, Prix de la mise en scène ex-æquo - Bacalaureat (Baccalauréat)</p>
            </div>
          </div>
        </div>
      </div>
      <div class="item palmares 22-05-16 shadow-bottom photo paysage notloaded">
        <a id="photo1857" class="ajax chocolat-image" data-pid="1857"
           href="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/07/e6d30cc6920c17e29aa73aea08a385d0e3530dfb.jpg"
           title='<span class="category">Palmarès</span><span class="date">22.05.16 . 19:33</span><h2>Shahab Hosseini, Prix d&#039;interprétation masculine - Forushande (Le Client) - Katayoon Shahabi et Kirsten Dunst</h2>'
           data-credit="Crédit Image : Alberto Pizzoli / AFP"></a>
        <img data-original="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/07/thumb_6105_media_image_640x404.jpg"  alt="" title="Shahab Hosseini, Prix d&#039;interprétation masculine - Forushande (Le Client) - Katayoon Shahabi et Kirsten Dunst" class="lazy">
        <div class="picto"><i class="icon icon_photo"></i></div>
        <div class="info">
          <div class="vCenter">
            <div class="vCenterKid">
              <span class="category">Palmarès</span>
              <span class="date">22.05.16</span> . <span
                  class="hour">19:33</span>
              <p data-title="Shahab Hosseini, Prix d&#039;interprétation masculine - Forushande (Le Client) - Katayoon Shahabi et Kirsten Dunst">Shahab Hosseini, Prix d&#039;interprétation masculine - Forushande (Le Client) - Katayoon Shahabi et Kirsten Dunst</p>
            </div>
          </div>
        </div>
      </div>
      <div class="item palmares 22-05-16 shadow-bottom photo paysage notloaded">
        <a id="photo1858" class="ajax chocolat-image" data-pid="1858"
           href="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/07/fb4285cf4b8149620d7fe0701789e88a0bb4697b.jpg"
           title='<span class="category">Palmarès</span><span class="date">22.05.16 . 19:32</span><h2>Andrea Arnold, Prix du Jury - American Honey</h2>'
           data-credit="Crédit Image : Alberto Pizzoli / AFP"></a>
        <img data-original="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/07/thumb_6087_media_image_640x404.jpg"  alt="" title="Andrea Arnold, Prix du Jury - American Honey" class="lazy">
        <div class="picto"><i class="icon icon_photo"></i></div>
        <div class="info">
          <div class="vCenter">
            <div class="vCenterKid">
              <span class="category">Palmarès</span>
              <span class="date">22.05.16</span> . <span
                  class="hour">19:32</span>
              <p data-title="Andrea Arnold, Prix du Jury - American Honey">Andrea Arnold, Prix du Jury - American Honey</p>
            </div>
          </div>
        </div>
      </div>
      <div class="item palmares 22-05-16 shadow-bottom photo paysage notloaded">
        <a id="photo1859" class="ajax chocolat-image" data-pid="1859"
           href="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/07/886659c49872064f3b6dff5d4320ed5863e0eede.jpg"
           title='<span class="category">Palmarès</span><span class="date">22.05.16 . 19:30</span><h2>Jaclyn Jose, Prix d&#039;interprétation féminine - Ma&#039;Rosa</h2>'
           data-credit="Crédit Image : Valéry Hache / AFP"></a>
        <img data-original="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/07/thumb_6088_media_image_640x404.jpg"  alt="" title="Jaclyn Jose, Prix d&#039;interprétation féminine - Ma&#039;Rosa" class="lazy">
        <div class="picto"><i class="icon icon_photo"></i></div>
        <div class="info">
          <div class="vCenter">
            <div class="vCenterKid">
              <span class="category">Palmarès</span>
              <span class="date">22.05.16</span> . <span
                  class="hour">19:30</span>
              <p data-title="Jaclyn Jose, Prix d&#039;interprétation féminine - Ma&#039;Rosa">Jaclyn Jose, Prix d&#039;interprétation féminine - Ma&#039;Rosa</p>
            </div>
          </div>
        </div>
      </div>
      <div class="item palmares 22-05-16 shadow-bottom photo paysage notloaded">
        <a id="photo1856" class="ajax chocolat-image" data-pid="1856"
           href="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/07/3b7ebe9dd85de0817ed9db4618e707d0fa440552.jpg"
           title='<span class="category">Palmarès</span><span class="date">22.05.16 . 19:22</span><h2>Jean-Pierre Léaud, Palme d&#039;or d&#039;honneur - Arnaud Desplechin</h2>'
           data-credit="Crédit Image : Alberto Pizzoli / AFP"></a>
        <img data-original="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/07/thumb_6085_media_image_640x404.jpg"  alt="" title="Jean-Pierre Léaud, Palme d&#039;or d&#039;honneur - Arnaud Desplechin" class="lazy">
        <div class="picto"><i class="icon icon_photo"></i></div>
        <div class="info">
          <div class="vCenter">
            <div class="vCenterKid">
              <span class="category">Palmarès</span>
              <span class="date">22.05.16</span> . <span
                  class="hour">19:22</span>
              <p data-title="Jean-Pierre Léaud, Palme d&#039;or d&#039;honneur - Arnaud Desplechin">Jean-Pierre Léaud, Palme d&#039;or d&#039;honneur - Arnaud Desplechin</p>
            </div>
          </div>
        </div>
      </div>
      <div class="item palmares 22-05-16 shadow-bottom photo paysage notloaded">
        <a id="photo1860" class="ajax chocolat-image" data-pid="1860"
           href="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/07/d91569f635176d68a963215bace832f07c6db88e.jpg"
           title='<span class="category">Palmarès</span><span class="date">22.05.16 . 19:21</span><h2>Concert d&#039;Ibrahim Maalouf - Cérémonie de clôture</h2>'
           data-credit="Crédit Image : Valéry Hache / AFP"></a>
        <img data-original="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/07/thumb_6096_media_image_640x404.jpg"  alt="" title="Concert d&#039;Ibrahim Maalouf - Cérémonie de clôture" class="lazy">
        <div class="picto"><i class="icon icon_photo"></i></div>
        <div class="info">
          <div class="vCenter">
            <div class="vCenterKid">
              <span class="category">Palmarès</span>
              <span class="date">22.05.16</span> . <span
                  class="hour">19:21</span>
              <p data-title="Concert d&#039;Ibrahim Maalouf - Cérémonie de clôture">Concert d&#039;Ibrahim Maalouf - Cérémonie de clôture</p>
            </div>
          </div>
        </div>
      </div>
      <div class="item palmares 22-05-16 shadow-bottom photo paysage notloaded">
        <a id="photo1851" class="ajax chocolat-image" data-pid="1851"
           href="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/07/f0989144c0a4cf233766baf43b69c6ababdc7a23.jpg"
           title='<span class="category">Palmarès</span><span class="date">22.05.16 . 19:20</span><h2>Juanjo Gimenez, Palme d&#039;or du court métrage - Timecode - Naomi Kawase et Marina Foïs</h2>'
           data-credit="Crédit Image : Valéry Hache / AFP"></a>
        <img data-original="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/07/thumb_6101_media_image_640x404.jpg"  alt="" title="Juanjo Gimenez, Palme d&#039;or du court métrage - Timecode - Naomi Kawase et Marina Foïs" class="lazy">
        <div class="picto"><i class="icon icon_photo"></i></div>
        <div class="info">
          <div class="vCenter">
            <div class="vCenterKid">
              <span class="category">Palmarès</span>
              <span class="date">22.05.16</span> . <span
                  class="hour">19:20</span>
              <p data-title="Juanjo Gimenez, Palme d&#039;or du court métrage - Timecode - Naomi Kawase et Marina Foïs">Juanjo Gimenez, Palme d&#039;or du court métrage - Timecode - Naomi Kawase et Marina Foïs</p>
            </div>
          </div>
        </div>
      </div>
      <div class="item palmares 22-05-16 shadow-bottom photo paysage notloaded">
        <a id="photo1853" class="ajax chocolat-image" data-pid="1853"
           href="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/07/43d16572128cb70499cf772a907835f301191541.jpg"
           title='<span class="category">Palmarès</span><span class="date">22.05.16 . 19:15</span><h2>Houda Benyamina, Caméra d&#039;or - Divines - Willem Dafoe</h2>'
           data-credit="Crédit Image : Alberto Pizzoli / AFP"></a>
        <img data-original="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/07/thumb_6080_media_image_640x404.jpg"  alt="" title="Houda Benyamina, Caméra d&#039;or - Divines - Willem Dafoe" class="lazy">
        <div class="picto"><i class="icon icon_photo"></i></div>
        <div class="info">
          <div class="vCenter">
            <div class="vCenterKid">
              <span class="category">Palmarès</span>
              <span class="date">22.05.16</span> . <span
                  class="hour">19:15</span>
              <p data-title="Houda Benyamina, Caméra d&#039;or - Divines - Willem Dafoe">Houda Benyamina, Caméra d&#039;or - Divines - Willem Dafoe</p>
            </div>
          </div>
        </div>
      </div>
      <div class="item palmares 22-05-16 shadow-bottom photo portrait notloaded">
        <a id="photo1852" class="ajax chocolat-image" data-pid="1852"
           href="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/07/a67e1f2272dab95e5c40952933274d1ee1f502be.jpg"
           title='<span class="category">Palmarès</span><span class="date">22.05.16 . 19:10</span><h2>João Paulo Miranda Maria, Mention Spéciale du Jury - Court métrage - A Moça Que Dançou Com O Diabo ( La Jeune fille qui dansait avec le diable)</h2>'
           data-credit="Crédit Image : Valéry Hache / AFP"></a>
        <img data-original="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/07/thumb_6078_media_image_320x404.jpg"  alt="" title="João Paulo Miranda Maria, Mention Spéciale du Jury - Court métrage - A Moça Que Dançou Com O Diabo ( La Jeune fille qui dansait avec le diable)" class="lazy">
        <div class="picto"><i class="icon icon_photo"></i></div>
        <div class="info">
          <div class="vCenter">
            <div class="vCenterKid">
              <span class="category">Palmarès</span>
              <span class="date">22.05.16</span> . <span
                  class="hour">19:10</span>
              <p data-title="João Paulo Miranda Maria, Mention Spéciale du Jury - Court métrage - A Moça Que Dançou Com O Diabo ( La Jeune fille qui dansait avec le diable)">João Paulo Miranda Maria, Mention Spéciale du Jury - Court métrage - A Moça Que Dançou Com O Diabo ( La Jeune fille qui dansait avec le diable)</p>
            </div>
          </div>
        </div>
      </div>
      <div class="item palmares 22-05-16 shadow-bottom photo paysage notloaded">
        <a id="photo1854" class="ajax chocolat-image" data-pid="1854"
           href="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/07/43d68fdc67aa6f9b0712886e0e111490b0c4ea74.jpg"
           title='<span class="category">Palmarès</span><span class="date">22.05.16 . 19:10</span><h2>Kirsten Dunst - Membre du Jury des Longs Métrages</h2>'
           data-credit="Crédit Image : Valéry Hache / AFP"></a>
        <img data-original="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/07/thumb_6081_media_image_640x404.jpg"  alt="" title="Kirsten Dunst - Membre du Jury des Longs Métrages" class="lazy">
        <div class="picto"><i class="icon icon_photo"></i></div>
        <div class="info">
          <div class="vCenter">
            <div class="vCenterKid">
              <span class="category">Palmarès</span>
              <span class="date">22.05.16</span> . <span
                  class="hour">19:10</span>
              <p data-title="Kirsten Dunst - Membre du Jury des Longs Métrages">Kirsten Dunst - Membre du Jury des Longs Métrages</p>
            </div>
          </div>
        </div>
      </div>
      <div class="item montee-des-marches 22-05-16 shadow-bottom photo paysage notloaded">
        <a id="photo1855" class="ajax chocolat-image" data-pid="1855"
           href="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/07/e3b5adf6dd76df404a7e0853b1fd2db29fcdc185.jpg"
           title='<span class="category">Montée des Marches</span><span class="date">22.05.16 . 19:00</span><h2>Le Jury des Longs Métrages</h2>'
           data-credit="Crédit Image : Anne-Christine Poujoulat / AFP"></a>
        <img data-original="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/07/thumb_6083_media_image_640x404.jpg"  alt="" title="Le Jury des Longs Métrages" class="lazy">
        <div class="picto"><i class="icon icon_photo"></i></div>
        <div class="info">
          <div class="vCenter">
            <div class="vCenterKid">
              <span class="category">Montée des Marches</span>
              <span class="date">22.05.16</span> . <span
                  class="hour">19:00</span>
              <p data-title="Le Jury des Longs Métrages">Le Jury des Longs Métrages</p>
            </div>
          </div>
        </div>
      </div>
      <div class="item palmares 22-05-16 shadow-bottom photo paysage notloaded">
        <a id="photo1862" class="ajax chocolat-image" data-pid="1862"
           href="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/07/f348e0cb47b837a3c506bd5df323c392913ea7a4.jpg"
           title='<span class="category">Palmarès</span><span class="date">22.05.16 . 19:00</span><h2>Olivier Assayas, Prix de la mise en scène ex-æquo - Personal Shopper</h2>'
           data-credit="Crédit Image : Valéry Hache / AFP"></a>
        <img data-original="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/07/thumb_6091_media_image_640x404.jpg"  alt="" title="Olivier Assayas, Prix de la mise en scène ex-æquo - Personal Shopper" class="lazy">
        <div class="picto"><i class="icon icon_photo"></i></div>
        <div class="info">
          <div class="vCenter">
            <div class="vCenterKid">
              <span class="category">Palmarès</span>
              <span class="date">22.05.16</span> . <span
                  class="hour">19:00</span>
              <p data-title="Olivier Assayas, Prix de la mise en scène ex-æquo - Personal Shopper">Olivier Assayas, Prix de la mise en scène ex-æquo - Personal Shopper</p>
            </div>
          </div>
        </div>
      </div>
      <div class="item palmares 22-05-16 shadow-bottom photo paysage notloaded">
        <a id="photo1850" class="ajax chocolat-image" data-pid="1850"
           href="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/07/b5449fd0a991d54fd1ed871da2b7d80765f50e5b.jpg"
           title='<span class="category">Palmarès</span><span class="date">22.05.16 . 18:45</span><h2>Laurent Lafitte, Maître de cérémonie</h2>'
           data-credit="Crédit Image : Valéry Hache / AFP"></a>
        <img data-original="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/07/thumb_6076_media_image_640x404.jpg"  alt="" title="Laurent Lafitte, Maître de cérémonie" class="lazy">
        <div class="picto"><i class="icon icon_photo"></i></div>
        <div class="info">
          <div class="vCenter">
            <div class="vCenterKid">
              <span class="category">Palmarès</span>
              <span class="date">22.05.16</span> . <span
                  class="hour">18:45</span>
              <p data-title="Laurent Lafitte, Maître de cérémonie">Laurent Lafitte, Maître de cérémonie</p>
            </div>
          </div>
        </div>
      </div>
      <div class="item montee-des-marches 22-05-16 shadow-bottom photo paysage notloaded">
        <a id="photo1894" class="ajax chocolat-image" data-pid="1894"
           href="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/07/0c792a6de356fe36196a5b8696b849cbe20d5f74.jpg"
           title='<span class="category">Montée des Marches</span><span class="date">22.05.16 . 18:43</span><h2>Giada Colagrande et Willem Dafoe</h2>'
           data-credit="Crédit Image : Loic Venance / AFP"></a>
        <img data-original="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/07/thumb_6129_media_image_640x404.jpg"  alt="" title="Giada Colagrande et Willem Dafoe" class="lazy">
        <div class="picto"><i class="icon icon_photo"></i></div>
        <div class="info">
          <div class="vCenter">
            <div class="vCenterKid">
              <span class="category">Montée des Marches</span>
              <span class="date">22.05.16</span> . <span
                  class="hour">18:43</span>
              <p data-title="Giada Colagrande et Willem Dafoe">Giada Colagrande et Willem Dafoe</p>
            </div>
          </div>
        </div>
      </div>
      <div class="item montee-des-marches 22-05-16 shadow-bottom photo paysage notloaded">
        <a id="photo1893" class="ajax chocolat-image" data-pid="1893"
           href="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/07/860e2132fe93a51ae485d85193fec48f638b8874.jpg"
           title='<span class="category">Montée des Marches</span><span class="date">22.05.16 . 18:35</span><h2>Clemence Poesy</h2>'
           data-credit="Crédit Image : Anne-Christine Poujoulat / AFP"></a>
        <img data-original="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/07/thumb_6128_media_image_640x404.jpg"  alt="" title="Clemence Poesy" class="lazy">
        <div class="picto"><i class="icon icon_photo"></i></div>
        <div class="info">
          <div class="vCenter">
            <div class="vCenterKid">
              <span class="category">Montée des Marches</span>
              <span class="date">22.05.16</span> . <span
                  class="hour">18:35</span>
              <p data-title="Clemence Poesy">Clemence Poesy</p>
            </div>
          </div>
        </div>
      </div>
      <div class="item montee-des-marches 22-05-16 shadow-bottom photo portrait notloaded">
        <a id="photo1848" class="ajax chocolat-image" data-pid="1848"
           href="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/07/172355b7c330e7224b85a4f21a38b5e36d15f25c.jpg"
           title='<span class="category">Montée des Marches</span><span class="date">22.05.16 . 18:30</span><h2>Ken Loach</h2>'
           data-credit="Crédit Image : Dominique Charriau / Getty Images"></a>
        <img data-original="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/07/thumb_6074_media_image_320x404.jpg"  alt="" title="Ken Loach" class="lazy">
        <div class="picto"><i class="icon icon_photo"></i></div>
        <div class="info">
          <div class="vCenter">
            <div class="vCenterKid">
              <span class="category">Montée des Marches</span>
              <span class="date">22.05.16</span> . <span
                  class="hour">18:30</span>
              <p data-title="Ken Loach">Ken Loach</p>
            </div>
          </div>
        </div>
      </div>
      <div class="item montee-des-marches 22-05-16 shadow-bottom photo paysage notloaded">
        <a id="photo1847" class="ajax chocolat-image" data-pid="1847"
           href="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/07/3fd9a90505c9e95c6f859d9c1842481cc5afeff3.jpg"
           title='<span class="category">Montée des Marches</span><span class="date">22.05.16 . 18:13</span><h2>Xavier Dolan</h2>'
           data-credit="Crédit Image : Loïc Venance / AFP"></a>
        <img data-original="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/07/thumb_6073_media_image_640x404.jpg"  alt="" title="Xavier Dolan" class="lazy">
        <div class="picto"><i class="icon icon_photo"></i></div>
        <div class="info">
          <div class="vCenter">
            <div class="vCenterKid">
              <span class="category">Montée des Marches</span>
              <span class="date">22.05.16</span> . <span
                  class="hour">18:13</span>
              <p data-title="Xavier Dolan">Xavier Dolan</p>
            </div>
          </div>
        </div>
      </div>
      <div class="item montee-des-marches 22-05-16 shadow-bottom photo paysage notloaded">
        <a id="photo1845" class="ajax chocolat-image" data-pid="1845"
           href="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/07/7c508063a6c92732963b4a4fa31e05b9143a4e34.jpg"
           title='<span class="category">Montée des Marches</span><span class="date">22.05.16 . 18:12</span><h2>Alice Isaaz</h2>'
           data-credit="Crédit Image : Venturelli / Getty Images"></a>
        <img data-original="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/07/thumb_6072_media_image_640x404.jpg"  alt="" title="Alice Isaaz" class="lazy">
        <div class="picto"><i class="icon icon_photo"></i></div>
        <div class="info">
          <div class="vCenter">
            <div class="vCenterKid">
              <span class="category">Montée des Marches</span>
              <span class="date">22.05.16</span> . <span
                  class="hour">18:12</span>
              <p data-title="Alice Isaaz">Alice Isaaz</p>
            </div>
          </div>
        </div>
      </div>
      <div class="item montee-des-marches 22-05-16 shadow-bottom photo portrait notloaded">
        <a id="photo1844" class="ajax chocolat-image" data-pid="1844"
           href="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/07/5307b4b0d83d13feb5040debbbc90d5e724d16a5.jpg"
           title='<span class="category">Montée des Marches</span><span class="date">22.05.16 . 18:10</span><h2>Jean-Pierre Léaud</h2>'
           data-credit="Crédit Image : Anne-Christine Poujoulat / AFP"></a>
        <img data-original="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/07/thumb_6071_media_image_320x404.jpg"  alt="" title="Jean-Pierre Léaud" class="lazy">
        <div class="picto"><i class="icon icon_photo"></i></div>
        <div class="info">
          <div class="vCenter">
            <div class="vCenterKid">
              <span class="category">Montée des Marches</span>
              <span class="date">22.05.16</span> . <span
                  class="hour">18:10</span>
              <p data-title="Jean-Pierre Léaud">Jean-Pierre Léaud</p>
            </div>
          </div>
        </div>
      </div>
      <div class="item montee-des-marches 22-05-16 shadow-bottom photo portrait notloaded">
        <a id="photo1843" class="ajax chocolat-image" data-pid="1843"
           href="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/07/60b21aac9ae36d5623277295fa036d36e9bb802b.jpg"
           title='<span class="category">Montée des Marches</span><span class="date">22.05.16 . 18:05</span><h2>Marina Foïs</h2>'
           data-credit="Crédit Image : Venturelli / Getty Images"></a>
        <img data-original="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/07/thumb_6070_media_image_320x404.jpg"  alt="" title="Marina Foïs" class="lazy">
        <div class="picto"><i class="icon icon_photo"></i></div>
        <div class="info">
          <div class="vCenter">
            <div class="vCenterKid">
              <span class="category">Montée des Marches</span>
              <span class="date">22.05.16</span> . <span
                  class="hour">18:05</span>
              <p data-title="Marina Foïs">Marina Foïs</p>
            </div>
          </div>
        </div>
      </div>
      <div class="item oeil-du-photographe 22-05-16 shadow-bottom photo portrait notloaded">
        <a id="photo1809" class="ajax chocolat-image" data-pid="1809"
           href="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/07/2cda1c52a13c239741a2ea6f6c8e592678d9e8ea.jpg"
           title='<span class="category">Œil du photographe</span><span class="date">22.05.16 . 09:10</span><h2>Chiara Mastroianni</h2>'
           data-credit="Crédit Image : Ugo Richard / Getty Images"></a>
        <img data-original="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/07/thumb_6045_media_image_320x404.jpg"  alt="" title="Chiara Mastroianni" class="lazy">
        <div class="picto"><i class="icon icon_photo"></i></div>
        <div class="info">
          <div class="vCenter">
            <div class="vCenterKid">
              <span class="category">Œil du photographe</span>
              <span class="date">22.05.16</span> . <span
                  class="hour">09:10</span>
              <p data-title="Chiara Mastroianni">Chiara Mastroianni</p>
            </div>
          </div>
        </div>
      </div>
      <div class="item oeil-du-photographe 22-05-16 shadow-bottom photo portrait notloaded">
        <a id="photo1811" class="ajax chocolat-image" data-pid="1811"
           href="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/07/f5745ed98b86f5c410c16d957e8acd35370c494b.jpg"
           title='<span class="category">Œil du photographe</span><span class="date">22.05.16 . 09:10</span><h2>Jessica Chastain</h2>'
           data-credit="Crédit Image : Ugo Richard / Getty Images"></a>
        <img data-original="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/07/thumb_6047_media_image_320x404.jpg"  alt="" title="Jessica Chastain" class="lazy">
        <div class="picto"><i class="icon icon_photo"></i></div>
        <div class="info">
          <div class="vCenter">
            <div class="vCenterKid">
              <span class="category">Œil du photographe</span>
              <span class="date">22.05.16</span> . <span
                  class="hour">09:10</span>
              <p data-title="Jessica Chastain">Jessica Chastain</p>
            </div>
          </div>
        </div>
      </div>
      <div class="item oeil-du-photographe 22-05-16 shadow-bottom photo portrait notloaded">
        <a id="photo1813" class="ajax chocolat-image" data-pid="1813"
           href="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/07/d1943ba10def0c326a20ddeaf5c197b0480b8d99.jpg"
           title='<span class="category">Œil du photographe</span><span class="date">22.05.16 . 09:10</span><h2>Vanessa Paradis</h2>'
           data-credit="Crédit Image : Ugo Richard / Getty Images"></a>
        <img data-original="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/07/thumb_6049_media_image_320x404.jpg"  alt="" title="Vanessa Paradis" class="lazy">
        <div class="picto"><i class="icon icon_photo"></i></div>
        <div class="info">
          <div class="vCenter">
            <div class="vCenterKid">
              <span class="category">Œil du photographe</span>
              <span class="date">22.05.16</span> . <span
                  class="hour">09:10</span>
              <p data-title="Vanessa Paradis">Vanessa Paradis</p>
            </div>
          </div>
        </div>
      </div>
      <div class="item oeil-du-photographe 22-05-16 shadow-bottom photo portrait notloaded">
        <a id="photo1815" class="ajax chocolat-image" data-pid="1815"
           href="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/07/00aea94a88625c7525234d3a09753025456683ab.jpg"
           title='<span class="category">Œil du photographe</span><span class="date">22.05.16 . 09:10</span><h2>Milla Jovovich</h2>'
           data-credit="Crédit Image : Ugo Richard / Getty Images"></a>
        <img data-original="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/07/thumb_6051_media_image_320x404.jpg"  alt="" title="Milla Jovovich" class="lazy">
        <div class="picto"><i class="icon icon_photo"></i></div>
        <div class="info">
          <div class="vCenter">
            <div class="vCenterKid">
              <span class="category">Œil du photographe</span>
              <span class="date">22.05.16</span> . <span
                  class="hour">09:10</span>
              <p data-title="Milla Jovovich">Milla Jovovich</p>
            </div>
          </div>
        </div>
      </div>
      <div class="item montee-des-marches 21-05-16 shadow-bottom photo paysage notloaded">
        <a id="photo1828" class="ajax chocolat-image" data-pid="1828"
           href="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/07/52e4990cb8b21a5d13abee66d0f0aac9cd4370c5.jpg"
           title='<span class="category">Montée des Marches</span><span class="date">21.05.16 . 23:52</span><h2>Mel Gibson et Erin Moriarty - Blood Father</h2>'
           data-credit="Crédit Image : Dominique Charriau / Getty Images"></a>
        <img data-original="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/07/thumb_6062_media_image_640x404.jpg"  alt="" title="Mel Gibson et Erin Moriarty - Blood Father" class="lazy">
        <div class="picto"><i class="icon icon_photo"></i></div>
        <div class="info">
          <div class="vCenter">
            <div class="vCenterKid">
              <span class="category">Montée des Marches</span>
              <span class="date">21.05.16</span> . <span
                  class="hour">23:52</span>
              <p data-title="Mel Gibson et Erin Moriarty - Blood Father">Mel Gibson et Erin Moriarty - Blood Father</p>
            </div>
          </div>
        </div>
      </div>
      <div class="item montee-des-marches 21-05-16 shadow-bottom photo paysage notloaded">
        <a id="photo1827" class="ajax chocolat-image" data-pid="1827"
           href="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/07/0220e67d05e32b844592a36e16e88206d4d28388.jpg"
           title='<span class="category">Montée des Marches</span><span class="date">21.05.16 . 23:50</span><h2>Diego Luna, Erin Moriarty et Mel Gibson - Blood Father</h2>'
           data-credit="Crédit Image : Alberto Pizzoli / AFP"></a>
        <img data-original="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/07/thumb_6061_media_image_640x404.jpg"  alt="" title="Diego Luna, Erin Moriarty et Mel Gibson - Blood Father" class="lazy">
        <div class="picto"><i class="icon icon_photo"></i></div>
        <div class="info">
          <div class="vCenter">
            <div class="vCenterKid">
              <span class="category">Montée des Marches</span>
              <span class="date">21.05.16</span> . <span
                  class="hour">23:50</span>
              <p data-title="Diego Luna, Erin Moriarty et Mel Gibson - Blood Father">Diego Luna, Erin Moriarty et Mel Gibson - Blood Father</p>
            </div>
          </div>
        </div>
      </div>
      <div class="item montee-des-marches 21-05-16 shadow-bottom photo paysage notloaded">
        <a id="photo1829" class="ajax chocolat-image" data-pid="1829"
           href="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/07/c8afb221b9b66f5c92023c98f1935b6b5a46890d.jpg"
           title='<span class="category">Montée des Marches</span><span class="date">21.05.16 . 23:49</span><h2>Diego Luna, Erin Moriarty, Jean-Francois Richet et Mel Gibson - Blood Father</h2>'
           data-credit="Crédit Image : Andreas Rentz / Getty Images"></a>
        <img data-original="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/07/thumb_6063_media_image_640x404.jpg"  alt="" title="Diego Luna, Erin Moriarty, Jean-Francois Richet et Mel Gibson - Blood Father" class="lazy">
        <div class="picto"><i class="icon icon_photo"></i></div>
        <div class="info">
          <div class="vCenter">
            <div class="vCenterKid">
              <span class="category">Montée des Marches</span>
              <span class="date">21.05.16</span> . <span
                  class="hour">23:49</span>
              <p data-title="Diego Luna, Erin Moriarty, Jean-Francois Richet et Mel Gibson - Blood Father">Diego Luna, Erin Moriarty, Jean-Francois Richet et Mel Gibson - Blood Father</p>
            </div>
          </div>
        </div>
      </div>
      <div class="item montee-des-marches 21-05-16 shadow-bottom photo paysage notloaded">
        <a id="photo1830" class="ajax chocolat-image" data-pid="1830"
           href="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/07/af8f0889f4a3a7f56b316d79e370dc3b847ce1c8.jpg"
           title='<span class="category">Montée des Marches</span><span class="date">21.05.16 . 23:44</span><h2>Gaspar Noé</h2>'
           data-credit="Crédit Image : Loic Venance - AFP"></a>
        <img data-original="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/07/thumb_6064_media_image_640x404.jpg"  alt="" title="Gaspar Noé" class="lazy">
        <div class="picto"><i class="icon icon_photo"></i></div>
        <div class="info">
          <div class="vCenter">
            <div class="vCenterKid">
              <span class="category">Montée des Marches</span>
              <span class="date">21.05.16</span> . <span
                  class="hour">23:44</span>
              <p data-title="Gaspar Noé">Gaspar Noé</p>
            </div>
          </div>
        </div>
      </div>
      <div class="item montee-des-marches 21-05-16 shadow-bottom photo paysage notloaded">
        <a id="photo1821" class="ajax chocolat-image" data-pid="1821"
           href="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/07/93694af633d48436a1a3a1781d411c69d2eba730.jpg"
           title='<span class="category">Montée des Marches</span><span class="date">21.05.16 . 22:05</span><h2>Équipe du film - Forushande (Le Client)</h2>'
           data-credit="Crédit Image : Anne-Christine Poujoulat / AFP"></a>
        <img data-original="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/07/thumb_6055_media_image_640x404.jpg"  alt="" title="Équipe du film - Forushande (Le Client)" class="lazy">
        <div class="picto"><i class="icon icon_photo"></i></div>
        <div class="info">
          <div class="vCenter">
            <div class="vCenterKid">
              <span class="category">Montée des Marches</span>
              <span class="date">21.05.16</span> . <span
                  class="hour">22:05</span>
              <p data-title="Équipe du film - Forushande (Le Client)">Équipe du film - Forushande (Le Client)</p>
            </div>
          </div>
        </div>
      </div>
      <div class="item montee-des-marches 21-05-16 shadow-bottom photo paysage notloaded">
        <a id="photo1824" class="ajax chocolat-image" data-pid="1824"
           href="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/07/51e3d2e731cceebfec8937598819a38bf38aadd9.jpg"
           title='<span class="category">Montée des Marches</span><span class="date">21.05.16 . 22:03</span><h2>Shahab Hosseini et Asghar Farhadi - Forushande (Le client)</h2>'
           data-credit="Crédit Image : Alberto Pizzoli / AFP"></a>
        <img data-original="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/07/thumb_6059_media_image_640x404.jpg"  alt="" title="Shahab Hosseini et Asghar Farhadi - Forushande (Le client)" class="lazy">
        <div class="picto"><i class="icon icon_photo"></i></div>
        <div class="info">
          <div class="vCenter">
            <div class="vCenterKid">
              <span class="category">Montée des Marches</span>
              <span class="date">21.05.16</span> . <span
                  class="hour">22:03</span>
              <p data-title="Shahab Hosseini et Asghar Farhadi - Forushande (Le client)">Shahab Hosseini et Asghar Farhadi - Forushande (Le client)</p>
            </div>
          </div>
        </div>
      </div>
      <div class="item montee-des-marches 21-05-16 shadow-bottom photo paysage notloaded">
        <a id="photo1823" class="ajax chocolat-image" data-pid="1823"
           href="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/07/5461e05f9c0aad4cf6ffb340ba9339ca6104ecc5.jpg"
           title='<span class="category">Montée des Marches</span><span class="date">21.05.16 . 22:00</span><h2>Taraneh Alidoosti - Forushande (Le client)</h2>'
           data-credit="Crédit Image : Alberto Pizzoli / AFP"></a>
        <img data-original="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/07/thumb_6058_media_image_640x404.jpg"  alt="" title="Taraneh Alidoosti - Forushande (Le client)" class="lazy">
        <div class="picto"><i class="icon icon_photo"></i></div>
        <div class="info">
          <div class="vCenter">
            <div class="vCenterKid">
              <span class="category">Montée des Marches</span>
              <span class="date">21.05.16</span> . <span
                  class="hour">22:00</span>
              <p data-title="Taraneh Alidoosti - Forushande (Le client)">Taraneh Alidoosti - Forushande (Le client)</p>
            </div>
          </div>
        </div>
      </div>
      <div class="item montee-des-marches 21-05-16 shadow-bottom photo paysage notloaded">
        <a id="photo1820" class="ajax chocolat-image" data-pid="1820"
           href="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/07/986c1fd2ed20ec2c09c66eb044452d85673b889b.jpg"
           title='<span class="category">Montée des Marches</span><span class="date">21.05.16 . 21:45</span><h2>Équipe du film - Forushande (Le Client)</h2>'
           data-credit="Crédit Image : Anne-Christine Poujoulat / AFP"></a>
        <img data-original="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/07/thumb_6054_media_image_640x404.jpg"  alt="" title="Équipe du film - Forushande (Le Client)" class="lazy">
        <div class="picto"><i class="icon icon_photo"></i></div>
        <div class="info">
          <div class="vCenter">
            <div class="vCenterKid">
              <span class="category">Montée des Marches</span>
              <span class="date">21.05.16</span> . <span
                  class="hour">21:45</span>
              <p data-title="Équipe du film - Forushande (Le Client)">Équipe du film - Forushande (Le Client)</p>
            </div>
          </div>
        </div>
      </div>
      <div class="item palmares 21-05-16 shadow-bottom photo paysage notloaded">
        <a id="photo1802" class="ajax chocolat-image" data-pid="1802"
           href="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/07/add9366403da12b0904897e5025c1ebaf3274124.jpg"
           title='<span class="category">Palmarès</span><span class="date">21.05.16 . 19:51</span><h2>Matt Ross, Prix Un Certain Regard de la Mise en Scène - Captain Fantastic</h2>'
           data-credit="Crédit Image : Mathilde Petit / FDC"></a>
        <img data-original="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/07/thumb_6038_media_image_640x404.jpg"  alt="" title="Matt Ross, Prix Un Certain Regard de la Mise en Scène - Captain Fantastic" class="lazy">
        <div class="picto"><i class="icon icon_photo"></i></div>
        <div class="info">
          <div class="vCenter">
            <div class="vCenterKid">
              <span class="category">Palmarès</span>
              <span class="date">21.05.16</span> . <span
                  class="hour">19:51</span>
              <p data-title="Matt Ross, Prix Un Certain Regard de la Mise en Scène - Captain Fantastic">Matt Ross, Prix Un Certain Regard de la Mise en Scène - Captain Fantastic</p>
            </div>
          </div>
        </div>
      </div>
      <div class="item palmares 21-05-16 shadow-bottom photo paysage notloaded">
        <a id="photo1804" class="ajax chocolat-image" data-pid="1804"
           href="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/07/1c65e03780098979cf58cca0e91efd66162fedeb.jpg"
           title='<span class="category">Palmarès</span><span class="date">21.05.16 . 19:50</span><h2>Michaël Dudok de Wit, Prix Spécial Un Certain Regard - La Tortue Rouge</h2>'
           data-credit="Crédit Image : Mathilde Petit / FDC"></a>
        <img data-original="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/07/thumb_6040_media_image_640x404.jpg"  alt="" title="Michaël Dudok de Wit, Prix Spécial Un Certain Regard - La Tortue Rouge" class="lazy">
        <div class="picto"><i class="icon icon_photo"></i></div>
        <div class="info">
          <div class="vCenter">
            <div class="vCenterKid">
              <span class="category">Palmarès</span>
              <span class="date">21.05.16</span> . <span
                  class="hour">19:50</span>
              <p data-title="Michaël Dudok de Wit, Prix Spécial Un Certain Regard - La Tortue Rouge">Michaël Dudok de Wit, Prix Spécial Un Certain Regard - La Tortue Rouge</p>
            </div>
          </div>
        </div>
      </div>
      <div class="item palmares 21-05-16 shadow-bottom photo paysage notloaded">
        <a id="photo1803" class="ajax chocolat-image" data-pid="1803"
           href="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/07/cc61e8abcee8c42383eedd03dc1824bbb08fa768.jpg"
           title='<span class="category">Palmarès</span><span class="date">21.05.16 . 19:40</span><h2>Delphine Coulin, Muriel Coulin, Prix Un Certain Regard du Meilleur Scénario - Voir du Pays</h2>'
           data-credit="Crédit Image : Mathilde Petit / FDC"></a>
        <img data-original="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/07/thumb_6039_media_image_640x404.jpg"  alt="" title="Delphine Coulin, Muriel Coulin, Prix Un Certain Regard du Meilleur Scénario - Voir du Pays" class="lazy">
        <div class="picto"><i class="icon icon_photo"></i></div>
        <div class="info">
          <div class="vCenter">
            <div class="vCenterKid">
              <span class="category">Palmarès</span>
              <span class="date">21.05.16</span> . <span
                  class="hour">19:40</span>
              <p data-title="Delphine Coulin, Muriel Coulin, Prix Un Certain Regard du Meilleur Scénario - Voir du Pays">Delphine Coulin, Muriel Coulin, Prix Un Certain Regard du Meilleur Scénario - Voir du Pays</p>
            </div>
          </div>
        </div>
      </div>
      <div class="item palmares 21-05-16 shadow-bottom photo portrait notloaded">
        <a id="photo1800" class="ajax chocolat-image" data-pid="1800"
           href="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/07/a954f407f3533e311b80169ff2d1558ced933178.jpg"
           title='<span class="category">Palmarès</span><span class="date">21.05.16 . 19:35</span><h2>Juho Kuosmanen, Prix Un Certain Regard - Hymylevä Mies (The Happiest Day of Olli Mäki)</h2>'
           data-credit="Crédit Image : Mathilde Petit / FDC"></a>
        <img data-original="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/07/thumb_6036_media_image_320x404.jpg"  alt="" title="Juho Kuosmanen, Prix Un Certain Regard - Hymylevä Mies (The Happiest Day of Olli Mäki)" class="lazy">
        <div class="picto"><i class="icon icon_photo"></i></div>
        <div class="info">
          <div class="vCenter">
            <div class="vCenterKid">
              <span class="category">Palmarès</span>
              <span class="date">21.05.16</span> . <span
                  class="hour">19:35</span>
              <p data-title="Juho Kuosmanen, Prix Un Certain Regard - Hymylevä Mies (The Happiest Day of Olli Mäki)">Juho Kuosmanen, Prix Un Certain Regard - Hymylevä Mies (The Happiest Day of Olli Mäki)</p>
            </div>
          </div>
        </div>
      </div>
      <div class="item palmares 21-05-16 shadow-bottom photo paysage notloaded">
        <a id="photo1801" class="ajax chocolat-image" data-pid="1801"
           href="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/07/ddcc6a98ac01b93f226bfe23727be93c29b3dad9.jpg"
           title='<span class="category">Palmarès</span><span class="date">21.05.16 . 19:32</span><h2>Fukada Kôji, Prix du Jury Un Certain Regard - Fuchi Ni Tatsu (Harmonium)</h2>'
           data-credit="Crédit Image : Mathilde Petit / FDC"></a>
        <img data-original="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/07/thumb_6037_media_image_640x404.jpg"  alt="" title="Fukada Kôji, Prix du Jury Un Certain Regard - Fuchi Ni Tatsu (Harmonium)" class="lazy">
        <div class="picto"><i class="icon icon_photo"></i></div>
        <div class="info">
          <div class="vCenter">
            <div class="vCenterKid">
              <span class="category">Palmarès</span>
              <span class="date">21.05.16</span> . <span
                  class="hour">19:32</span>
              <p data-title="Fukada Kôji, Prix du Jury Un Certain Regard - Fuchi Ni Tatsu (Harmonium)">Fukada Kôji, Prix du Jury Un Certain Regard - Fuchi Ni Tatsu (Harmonium)</p>
            </div>
          </div>
        </div>
      </div>
      <div class="item palmares 21-05-16 shadow-bottom photo paysage notloaded">
        <a id="photo1799" class="ajax chocolat-image" data-pid="1799"
           href="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/07/b751470adf3129c44feb5b1ded81d101dcbf68ad.jpg"
           title='<span class="category">Palmarès</span><span class="date">21.05.16 . 19:30</span><h2>Le Jury et les Lauréats - Palmarès Un Certain Regard</h2>'
           data-credit="Crédit Image : Mathilde Petit / FDC"></a>
        <img data-original="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/07/thumb_6035_media_image_640x404.jpg"  alt="" title="Le Jury et les Lauréats - Palmarès Un Certain Regard" class="lazy">
        <div class="picto"><i class="icon icon_photo"></i></div>
        <div class="info">
          <div class="vCenter">
            <div class="vCenterKid">
              <span class="category">Palmarès</span>
              <span class="date">21.05.16</span> . <span
                  class="hour">19:30</span>
              <p data-title="Le Jury et les Lauréats - Palmarès Un Certain Regard">Le Jury et les Lauréats - Palmarès Un Certain Regard</p>
            </div>
          </div>
        </div>
      </div>
      <div class="item montee-des-marches 21-05-16 shadow-bottom photo paysage notloaded">
        <a id="photo1807" class="ajax chocolat-image" data-pid="1807"
           href="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/07/6f81276f1591b5f66cd904ed668947198a6d69ad.jpg"
           title='<span class="category">Montée des Marches</span><span class="date">21.05.16 . 18:50</span><h2>Gad Elmaleh</h2>'
           data-credit="Crédit Image : Alberto Pizzoli / AFP"></a>
        <img data-original="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/07/thumb_6043_media_image_640x404.jpg"  alt="" title="Gad Elmaleh" class="lazy">
        <div class="picto"><i class="icon icon_photo"></i></div>
        <div class="info">
          <div class="vCenter">
            <div class="vCenterKid">
              <span class="category">Montée des Marches</span>
              <span class="date">21.05.16</span> . <span
                  class="hour">18:50</span>
              <p data-title="Gad Elmaleh">Gad Elmaleh</p>
            </div>
          </div>
        </div>
      </div>
      <div class="item montee-des-marches 21-05-16 shadow-bottom photo paysage notloaded">
        <a id="photo1797" class="ajax chocolat-image" data-pid="1797"
           href="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/07/9a7475a2b2cbc978694639b3e3a4ac74d5d2beab.jpg"
           title='<span class="category">Montée des Marches</span><span class="date">21.05.16 . 18:00</span><h2>Sonia Braga</h2>'
           data-credit="Crédit Image : Anne-Christine Poujoulat / AFP"></a>
        <img data-original="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/07/thumb_6033_media_image_640x404.jpg"  alt="" title="Sonia Braga" class="lazy">
        <div class="picto"><i class="icon icon_photo"></i></div>
        <div class="info">
          <div class="vCenter">
            <div class="vCenterKid">
              <span class="category">Montée des Marches</span>
              <span class="date">21.05.16</span> . <span
                  class="hour">18:00</span>
              <p data-title="Sonia Braga">Sonia Braga</p>
            </div>
          </div>
        </div>
      </div>
      <div class="item montee-des-marches 21-05-16 shadow-bottom photo portrait notloaded">
        <a id="photo1796" class="ajax chocolat-image" data-pid="1796"
           href="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/07/7a6decd8186fb998dcb80ecd2c3586a64fdb5002.jpg"
           title='<span class="category">Montée des Marches</span><span class="date">21.05.16 . 17:56</span><h2>Anne Consigny - Elle</h2>'
           data-credit="Crédit Image : Alberto Pizzoli / AFP"></a>
        <img data-original="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/07/thumb_6032_media_image_320x404.jpg"  alt="" title="Anne Consigny - Elle" class="lazy">
        <div class="picto"><i class="icon icon_photo"></i></div>
        <div class="info">
          <div class="vCenter">
            <div class="vCenterKid">
              <span class="category">Montée des Marches</span>
              <span class="date">21.05.16</span> . <span
                  class="hour">17:56</span>
              <p data-title="Anne Consigny - Elle">Anne Consigny - Elle</p>
            </div>
          </div>
        </div>
      </div>
      <div class="item montee-des-marches 21-05-16 shadow-bottom photo portrait notloaded">
        <a id="photo1794" class="ajax chocolat-image" data-pid="1794"
           href="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/07/0babbe7869cff34f3876224a3bedd3747da25834.jpg"
           title='<span class="category">Montée des Marches</span><span class="date">21.05.16 . 17:55</span><h2>Virginie Efira - Elle</h2>'
           data-credit="Crédit Image : Venturelli / Getty Images"></a>
        <img data-original="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/07/thumb_6029_media_image_320x404.jpg"  alt="" title="Virginie Efira - Elle" class="lazy">
        <div class="picto"><i class="icon icon_photo"></i></div>
        <div class="info">
          <div class="vCenter">
            <div class="vCenterKid">
              <span class="category">Montée des Marches</span>
              <span class="date">21.05.16</span> . <span
                  class="hour">17:55</span>
              <p data-title="Virginie Efira - Elle">Virginie Efira - Elle</p>
            </div>
          </div>
        </div>
      </div>
      <div class="item montee-des-marches 21-05-16 shadow-bottom photo paysage notloaded">
        <a id="photo1792" class="ajax chocolat-image" data-pid="1792"
           href="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/07/3e1fd06f33b4dbaa7b68afc4a84c2077ace37047.jpg"
           title='<span class="category">Montée des Marches</span><span class="date">21.05.16 . 17:50</span><h2>Isabelle Hupert et Paul Verhoeven - Elle</h2>'
           data-credit="Crédit Image : Alberto Pizzoli / AFP"></a>
        <img data-original="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/07/thumb_6027_media_image_640x404.jpg"  alt="" title="Isabelle Hupert et Paul Verhoeven - Elle" class="lazy">
        <div class="picto"><i class="icon icon_photo"></i></div>
        <div class="info">
          <div class="vCenter">
            <div class="vCenterKid">
              <span class="category">Montée des Marches</span>
              <span class="date">21.05.16</span> . <span
                  class="hour">17:50</span>
              <p data-title="Isabelle Hupert et Paul Verhoeven - Elle">Isabelle Hupert et Paul Verhoeven - Elle</p>
            </div>
          </div>
        </div>
      </div>
      <div class="item montee-des-marches 21-05-16 shadow-bottom photo portrait notloaded">
        <a id="photo1818" class="ajax chocolat-image" data-pid="1818"
           href="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/07/bbf27816f414762378e2b83c3a4882e227581a80.jpg"
           title='<span class="category">Montée des Marches</span><span class="date">21.05.16 . 17:48</span><h2>Alice Isaaz - Elle</h2>'
           data-credit="Crédit Image : Venturelli / Getty Images"></a>
        <img data-original="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/07/thumb_6053_media_image_320x404.jpg"  alt="" title="Alice Isaaz - Elle" class="lazy">
        <div class="picto"><i class="icon icon_photo"></i></div>
        <div class="info">
          <div class="vCenter">
            <div class="vCenterKid">
              <span class="category">Montée des Marches</span>
              <span class="date">21.05.16</span> . <span
                  class="hour">17:48</span>
              <p data-title="Alice Isaaz - Elle">Alice Isaaz - Elle</p>
            </div>
          </div>
        </div>
      </div>
      <div class="item montee-des-marches 21-05-16 shadow-bottom photo paysage notloaded">
        <a id="photo1791" class="ajax chocolat-image" data-pid="1791"
           href="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/07/830cfcbd228fa5432eb517cd1171d477239ca9a3.jpg"
           title='<span class="category">Montée des Marches</span><span class="date">21.05.16 . 17:47</span><h2>Équipe du film - Elle</h2>'
           data-credit="Crédit Image : Valéry Hache / AFP"></a>
        <img data-original="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/07/thumb_6031_media_image_640x404.jpg"  alt="" title="Équipe du film - Elle" class="lazy">
        <div class="picto"><i class="icon icon_photo"></i></div>
        <div class="info">
          <div class="vCenter">
            <div class="vCenterKid">
              <span class="category">Montée des Marches</span>
              <span class="date">21.05.16</span> . <span
                  class="hour">17:47</span>
              <p data-title="Équipe du film - Elle">Équipe du film - Elle</p>
            </div>
          </div>
        </div>
      </div>
      <div class="item montee-des-marches 21-05-16 shadow-bottom photo paysage notloaded">
        <a id="photo1789" class="ajax chocolat-image" data-pid="1789"
           href="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/07/d76d6ff60afb1915a37748a9e4942040e84f2175.jpg"
           title='<span class="category">Montée des Marches</span><span class="date">21.05.16 . 17:46</span><h2>Marthe Keller, Présidente du Jury Un Certain Regard</h2>'
           data-credit="Crédit Image : Anne-Christine Poujoulat / AFP"></a>
        <img data-original="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/07/thumb_6023_media_image_640x404.jpg"  alt="" title="Marthe Keller, Présidente du Jury Un Certain Regard" class="lazy">
        <div class="picto"><i class="icon icon_photo"></i></div>
        <div class="info">
          <div class="vCenter">
            <div class="vCenterKid">
              <span class="category">Montée des Marches</span>
              <span class="date">21.05.16</span> . <span
                  class="hour">17:46</span>
              <p data-title="Marthe Keller, Présidente du Jury Un Certain Regard">Marthe Keller, Présidente du Jury Un Certain Regard</p>
            </div>
          </div>
        </div>
      </div>
      <div class="item montee-des-marches 21-05-16 shadow-bottom photo paysage notloaded">
        <a id="photo1790" class="ajax chocolat-image" data-pid="1790"
           href="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/07/16a779c8b58ed54d33621f8bad9210d7875a629f.jpg"
           title='<span class="category">Montée des Marches</span><span class="date">21.05.16 . 17:45</span><h2>Membres du Jury Un Certain Regard</h2>'
           data-credit="Crédit Image : Venturelli / Getty Images"></a>
        <img data-original="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/07/thumb_6025_media_image_640x404.jpg"  alt="" title="Membres du Jury Un Certain Regard" class="lazy">
        <div class="picto"><i class="icon icon_photo"></i></div>
        <div class="info">
          <div class="vCenter">
            <div class="vCenterKid">
              <span class="category">Montée des Marches</span>
              <span class="date">21.05.16</span> . <span
                  class="hour">17:45</span>
              <p data-title="Membres du Jury Un Certain Regard">Membres du Jury Un Certain Regard</p>
            </div>
          </div>
        </div>
      </div>
      <div class="item evenement 21-05-16 shadow-bottom photo paysage notloaded">
        <a id="photo1786" class="ajax chocolat-image" data-pid="1786"
           href="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/07/b479186598505ef2918eab58250abe19e494821b.jpg"
           title='<span class="category">Évènement</span><span class="date">21.05.16 . 16:15</span><h2>Discussion avec Thierry Frémaux</h2>'
           data-credit="Crédit Image : Mathilde Petit / FDC"></a>
        <img data-original="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/07/thumb_6021_media_image_640x404.jpg"  alt="" title="Discussion avec Thierry Frémaux" class="lazy">
        <div class="picto"><i class="icon icon_photo"></i></div>
        <div class="info">
          <div class="vCenter">
            <div class="vCenterKid">
              <span class="category">Évènement</span>
              <span class="date">21.05.16</span> . <span
                  class="hour">16:15</span>
              <p data-title="Discussion avec Thierry Frémaux">Discussion avec Thierry Frémaux</p>
            </div>
          </div>
        </div>
      </div>
      <div class="item oeil-du-photographe 21-05-16 shadow-bottom photo paysage notloaded">
        <a id="photo1718" class="ajax chocolat-image" data-pid="1718"
           href="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/06/5e3affd9dd3290ec1e4aa32af65e34d599695fc6.jpg"
           title='<span class="category">Œil du photographe</span><span class="date">21.05.16 . 13:20</span><h2>Bertrand Tavernier</h2>'
           data-credit="Crédit Image : Franck Tomps / Atelier du Jour"></a>
        <img data-original="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/06/thumb_5925_media_image_640x404.jpg"  alt="" title="Bertrand Tavernier" class="lazy">
        <div class="picto"><i class="icon icon_photo"></i></div>
        <div class="info">
          <div class="vCenter">
            <div class="vCenterKid">
              <span class="category">Œil du photographe</span>
              <span class="date">21.05.16</span> . <span
                  class="hour">13:20</span>
              <p data-title="Bertrand Tavernier">Bertrand Tavernier</p>
            </div>
          </div>
        </div>
      </div>
      <div class="item oeil-du-photographe 21-05-16 shadow-bottom photo paysage notloaded">
        <a id="photo1719" class="ajax chocolat-image" data-pid="1719"
           href="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/06/ef222cc4ff28e034e56f8e9ee22dffdec8bf8e41.jpg"
           title='<span class="category">Œil du photographe</span><span class="date">21.05.16 . 13:20</span><h2>Nicolas Winding Refn</h2>'
           data-credit="Crédit Image : Franck Tomps / Atelier du Jour"></a>
        <img data-original="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/06/thumb_5926_media_image_640x404.jpg"  alt="" title="Nicolas Winding Refn" class="lazy">
        <div class="picto"><i class="icon icon_photo"></i></div>
        <div class="info">
          <div class="vCenter">
            <div class="vCenterKid">
              <span class="category">Œil du photographe</span>
              <span class="date">21.05.16</span> . <span
                  class="hour">13:20</span>
              <p data-title="Nicolas Winding Refn">Nicolas Winding Refn</p>
            </div>
          </div>
        </div>
      </div>
      <div class="item oeil-du-photographe 21-05-16 shadow-bottom photo portrait notloaded">
        <a id="photo1728" class="ajax chocolat-image" data-pid="1728"
           href="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/06/8001b36d47881b397db54df3ce5492ca12df7281.jpg"
           title='<span class="category">Œil du photographe</span><span class="date">21.05.16 . 13:20</span><h2>Sandrine Kimberlain</h2>'
           data-credit="Crédit Image : Franck Tomps / Atelier du Jour"></a>
        <img data-original="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/06/thumb_5934_media_image_320x404.jpg"  alt="" title="Sandrine Kimberlain" class="lazy">
        <div class="picto"><i class="icon icon_photo"></i></div>
        <div class="info">
          <div class="vCenter">
            <div class="vCenterKid">
              <span class="category">Œil du photographe</span>
              <span class="date">21.05.16</span> . <span
                  class="hour">13:20</span>
              <p data-title="Sandrine Kimberlain">Sandrine Kimberlain</p>
            </div>
          </div>
        </div>
      </div>
      <div class="item oeil-du-photographe 21-05-16 shadow-bottom photo paysage notloaded">
        <a id="photo1732" class="ajax chocolat-image" data-pid="1732"
           href="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/07/8b469fc1f7e58084354fc81e5fa9010c94b387a9.jpg"
           title='<span class="category">Œil du photographe</span><span class="date">21.05.16 . 13:20</span><h2>Elle Fanning</h2>'
           data-credit="Crédit Image : Franck Tomps / Atelier du Jour"></a>
        <img data-original="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/07/thumb_6018_media_image_640x404.jpg"  alt="" title="Elle Fanning" class="lazy">
        <div class="picto"><i class="icon icon_photo"></i></div>
        <div class="info">
          <div class="vCenter">
            <div class="vCenterKid">
              <span class="category">Œil du photographe</span>
              <span class="date">21.05.16</span> . <span
                  class="hour">13:20</span>
              <p data-title="Elle Fanning">Elle Fanning</p>
            </div>
          </div>
        </div>
      </div>
      <div class="item conference-de-presse 21-05-16 shadow-bottom photo paysage notloaded">
        <a id="photo1782" class="ajax chocolat-image" data-pid="1782"
           href="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/07/b75fa083a18fbd8115a8f745f12275a30595610b.jpg"
           title='<span class="category">Conférence de Presse</span><span class="date">21.05.16 . 13:05</span><h2>Équipe du film - Forushande (Le Client)</h2>'
           data-credit="Crédit Image : Mathilde Petit / FDC"></a>
        <img data-original="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/07/thumb_6016_media_image_640x404.jpg"  alt="" title="Équipe du film - Forushande (Le Client)" class="lazy">
        <div class="picto"><i class="icon icon_photo"></i></div>
        <div class="info">
          <div class="vCenter">
            <div class="vCenterKid">
              <span class="category">Conférence de Presse</span>
              <span class="date">21.05.16</span> . <span
                  class="hour">13:05</span>
              <p data-title="Équipe du film - Forushande (Le Client)">Équipe du film - Forushande (Le Client)</p>
            </div>
          </div>
        </div>
      </div>
      <div class="item conference-de-presse 21-05-16 shadow-bottom photo paysage notloaded">
        <a id="photo1780" class="ajax chocolat-image" data-pid="1780"
           href="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/07/b460440ae33051273e1e05d7883ea057e313d7f3.jpg"
           title='<span class="category">Conférence de Presse</span><span class="date">21.05.16 . 13:00</span><h2>Taraneh Alidoosti - Forushande (Le Client)</h2>'
           data-credit="Crédit Image : Mathilde Petit / FDC"></a>
        <img data-original="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/07/thumb_6014_media_image_640x404.jpg"  alt="" title="Taraneh Alidoosti - Forushande (Le Client)" class="lazy">
        <div class="picto"><i class="icon icon_photo"></i></div>
        <div class="info">
          <div class="vCenter">
            <div class="vCenterKid">
              <span class="category">Conférence de Presse</span>
              <span class="date">21.05.16</span> . <span
                  class="hour">13:00</span>
              <p data-title="Taraneh Alidoosti - Forushande (Le Client)">Taraneh Alidoosti - Forushande (Le Client)</p>
            </div>
          </div>
        </div>
      </div>
      <div class="item photocall 21-05-16 shadow-bottom photo portrait notloaded">
        <a id="photo1775" class="ajax chocolat-image" data-pid="1775"
           href="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/07/39021dc6d0907640bfcc831953d781e129ac31da.jpg"
           title='<span class="category">Photocall</span><span class="date">21.05.16 . 12:47</span><h2>Jean- François Richet - Blood Father</h2>'
           data-credit="Crédit Image : Anne-Christine Poujoulat / AFP"></a>
        <img data-original="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/07/thumb_6020_media_image_320x404.jpg"  alt="" title="Jean- François Richet - Blood Father" class="lazy">
        <div class="picto"><i class="icon icon_photo"></i></div>
        <div class="info">
          <div class="vCenter">
            <div class="vCenterKid">
              <span class="category">Photocall</span>
              <span class="date">21.05.16</span> . <span
                  class="hour">12:47</span>
              <p data-title="Jean- François Richet - Blood Father">Jean- François Richet - Blood Father</p>
            </div>
          </div>
        </div>
      </div>
      <div class="item photocall 21-05-16 shadow-bottom photo paysage notloaded">
        <a id="photo1774" class="ajax chocolat-image" data-pid="1774"
           href="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/07/de2f03dd9cdbfe998f7d67ef2f1785b083fdfb5d.jpg"
           title='<span class="category">Photocall</span><span class="date">21.05.16 . 12:45</span><h2>Erin Moriarty et Mel Gibson - Blood Father</h2>'
           data-credit="Crédit Image : Léo Laumont / FDC"></a>
        <img data-original="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/07/thumb_6009_media_image_640x404.jpg"  alt="" title="Erin Moriarty et Mel Gibson - Blood Father" class="lazy">
        <div class="picto"><i class="icon icon_photo"></i></div>
        <div class="info">
          <div class="vCenter">
            <div class="vCenterKid">
              <span class="category">Photocall</span>
              <span class="date">21.05.16</span> . <span
                  class="hour">12:45</span>
              <p data-title="Erin Moriarty et Mel Gibson - Blood Father">Erin Moriarty et Mel Gibson - Blood Father</p>
            </div>
          </div>
        </div>
      </div>
      <div class="item photocall 21-05-16 shadow-bottom photo paysage notloaded">
        <a id="photo1773" class="ajax chocolat-image" data-pid="1773"
           href="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/07/290a4e7560be1fd57eae63dca4658b1aed3bdcf4.jpg"
           title='<span class="category">Photocall</span><span class="date">21.05.16 . 12:40</span><h2>Jean-François Richet, Erin Moriarty, Mel Gibson et Diego Luna - Blood Father</h2>'
           data-credit="Crédit Image : Léo Laumont / FDC"></a>
        <img data-original="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/07/thumb_6008_media_image_640x404.jpg"  alt="" title="Jean-François Richet, Erin Moriarty, Mel Gibson et Diego Luna - Blood Father" class="lazy">
        <div class="picto"><i class="icon icon_photo"></i></div>
        <div class="info">
          <div class="vCenter">
            <div class="vCenterKid">
              <span class="category">Photocall</span>
              <span class="date">21.05.16</span> . <span
                  class="hour">12:40</span>
              <p data-title="Jean-François Richet, Erin Moriarty, Mel Gibson et Diego Luna - Blood Father">Jean-François Richet, Erin Moriarty, Mel Gibson et Diego Luna - Blood Father</p>
            </div>
          </div>
        </div>
      </div>
      <div class="item photocall 21-05-16 shadow-bottom photo paysage notloaded">
        <a id="photo1768" class="ajax chocolat-image" data-pid="1768"
           href="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/07/1fcf86aef2cb5c6b4b14ce9caddf8b23503510dc.jpg"
           title='<span class="category">Photocall</span><span class="date">21.05.16 . 12:35</span><h2>Taraneh Alidoosti - Forushande (Le Client)</h2>'
           data-credit="Crédit Image : Léo Laumont / FDC"></a>
        <img data-original="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/07/thumb_6005_media_image_640x404.jpg"  alt="" title="Taraneh Alidoosti - Forushande (Le Client)" class="lazy">
        <div class="picto"><i class="icon icon_photo"></i></div>
        <div class="info">
          <div class="vCenter">
            <div class="vCenterKid">
              <span class="category">Photocall</span>
              <span class="date">21.05.16</span> . <span
                  class="hour">12:35</span>
              <p data-title="Taraneh Alidoosti - Forushande (Le Client)">Taraneh Alidoosti - Forushande (Le Client)</p>
            </div>
          </div>
        </div>
      </div>
      <div class="item photocall 21-05-16 shadow-bottom photo paysage notloaded">
        <a id="photo1767" class="ajax chocolat-image" data-pid="1767"
           href="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/07/fe138ab5c0ec3ad74dcded829aa5de26c89079f5.jpg"
           title='<span class="category">Photocall</span><span class="date">21.05.16 . 12:31</span><h2>Ashgar Farhadi - Forushande (Le Client)</h2>'
           data-credit="Crédit Image : Léo Laumont / FDC"></a>
        <img data-original="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/07/thumb_6003_media_image_640x404.jpg"  alt="" title="Ashgar Farhadi - Forushande (Le Client)" class="lazy">
        <div class="picto"><i class="icon icon_photo"></i></div>
        <div class="info">
          <div class="vCenter">
            <div class="vCenterKid">
              <span class="category">Photocall</span>
              <span class="date">21.05.16</span> . <span
                  class="hour">12:31</span>
              <p data-title="Ashgar Farhadi - Forushande (Le Client)">Ashgar Farhadi - Forushande (Le Client)</p>
            </div>
          </div>
        </div>
      </div>
      <div class="item photocall 21-05-16 shadow-bottom photo paysage notloaded">
        <a id="photo1765" class="ajax chocolat-image" data-pid="1765"
           href="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/07/a257c6058b7880c4b872659bf82cb3863056785e.jpg"
           title='<span class="category">Photocall</span><span class="date">21.05.16 . 12:30</span><h2>Équipe du film - Forushande (Le Client)</h2>'
           data-credit="Crédit Image : Léo Laumont / FDC"></a>
        <img data-original="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/07/thumb_6004_media_image_640x404.jpg"  alt="" title="Équipe du film - Forushande (Le Client)" class="lazy">
        <div class="picto"><i class="icon icon_photo"></i></div>
        <div class="info">
          <div class="vCenter">
            <div class="vCenterKid">
              <span class="category">Photocall</span>
              <span class="date">21.05.16</span> . <span
                  class="hour">12:30</span>
              <p data-title="Équipe du film - Forushande (Le Client)">Équipe du film - Forushande (Le Client)</p>
            </div>
          </div>
        </div>
      </div>
      <div class="item conference-de-presse 21-05-16 shadow-bottom photo paysage notloaded">
        <a id="photo1760" class="ajax chocolat-image" data-pid="1760"
           href="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/06/58ddba92d80fc5e127e781847a0839da3a953473.jpg"
           title='<span class="category">Conférence de Presse</span><span class="date">21.05.16 . 11:33</span><h2>Équipe du film - Elle</h2>'
           data-credit="Crédit Image : Léo Laumont / FDC"></a>
        <img data-original="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/06/thumb_5997_media_image_640x404.jpg"  alt="" title="Équipe du film - Elle" class="lazy">
        <div class="picto"><i class="icon icon_photo"></i></div>
        <div class="info">
          <div class="vCenter">
            <div class="vCenterKid">
              <span class="category">Conférence de Presse</span>
              <span class="date">21.05.16</span> . <span
                  class="hour">11:33</span>
              <p data-title="Équipe du film - Elle">Équipe du film - Elle</p>
            </div>
          </div>
        </div>
      </div>
      <div class="item conference-de-presse 21-05-16 shadow-bottom photo portrait notloaded">
        <a id="photo1759" class="ajax chocolat-image" data-pid="1759"
           href="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/06/c08783455c712fb506f5f0aa6b62db7e0012857a.jpg"
           title='<span class="category">Conférence de Presse</span><span class="date">21.05.16 . 11:30</span><h2>Virginie Efira - Elle</h2>'
           data-credit="Crédit Image : Léo Laumont / FDC"></a>
        <img data-original="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/06/thumb_5996_media_image_320x404.jpg"  alt="" title="Virginie Efira - Elle" class="lazy">
        <div class="picto"><i class="icon icon_photo"></i></div>
        <div class="info">
          <div class="vCenter">
            <div class="vCenterKid">
              <span class="category">Conférence de Presse</span>
              <span class="date">21.05.16</span> . <span
                  class="hour">11:30</span>
              <p data-title="Virginie Efira - Elle">Virginie Efira - Elle</p>
            </div>
          </div>
        </div>
      </div>
      <div class="item photocall 21-05-16 shadow-bottom photo portrait notloaded">
        <a id="photo1757" class="ajax chocolat-image" data-pid="1757"
           href="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/06/d5d48e122ab243a76828c30acb5b3a24dda2d3d1.jpg"
           title='<span class="category">Photocall</span><span class="date">21.05.16 . 11:29</span><h2>Alice Isaaz - Elle</h2>'
           data-credit="Crédit Image : Thomas Leibreich / FDC"></a>
        <img data-original="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/06/thumb_5994_media_image_320x404.jpg"  alt="" title="Alice Isaaz - Elle" class="lazy">
        <div class="picto"><i class="icon icon_photo"></i></div>
        <div class="info">
          <div class="vCenter">
            <div class="vCenterKid">
              <span class="category">Photocall</span>
              <span class="date">21.05.16</span> . <span
                  class="hour">11:29</span>
              <p data-title="Alice Isaaz - Elle">Alice Isaaz - Elle</p>
            </div>
          </div>
        </div>
      </div>
      <div class="item photocall 21-05-16 shadow-bottom photo paysage notloaded">
        <a id="photo1755" class="ajax chocolat-image" data-pid="1755"
           href="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/06/f95b981a3d2771f022e90564700e73c4b883af42.jpg"
           title='<span class="category">Photocall</span><span class="date">21.05.16 . 11:08</span><h2>Les Réalisateurs des Courts Métrages en Compétition</h2>'
           data-credit="Crédit Image : Mathilde Petit / FDC"></a>
        <img data-original="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/06/thumb_5992_media_image_640x404.jpg"  alt="" title="Les Réalisateurs des Courts Métrages en Compétition" class="lazy">
        <div class="picto"><i class="icon icon_photo"></i></div>
        <div class="info">
          <div class="vCenter">
            <div class="vCenterKid">
              <span class="category">Photocall</span>
              <span class="date">21.05.16</span> . <span
                  class="hour">11:08</span>
              <p data-title="Les Réalisateurs des Courts Métrages en Compétition">Les Réalisateurs des Courts Métrages en Compétition</p>
            </div>
          </div>
        </div>
      </div>
      <div class="item photocall 21-05-16 shadow-bottom photo portrait notloaded">
        <a id="photo1749" class="ajax chocolat-image" data-pid="1749"
           href="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/06/3769f606ab4b1cce381605dc7d542fafb5e7d933.jpg"
           title='<span class="category">Photocall</span><span class="date">21.05.16 . 11:07</span><h2>Charles Berling - Elle</h2>'
           data-credit="Crédit Image : Mathilde Petit / FDC"></a>
        <img data-original="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/06/thumb_5989_media_image_320x404.jpg"  alt="" title="Charles Berling - Elle" class="lazy">
        <div class="picto"><i class="icon icon_photo"></i></div>
        <div class="info">
          <div class="vCenter">
            <div class="vCenterKid">
              <span class="category">Photocall</span>
              <span class="date">21.05.16</span> . <span
                  class="hour">11:07</span>
              <p data-title="Charles Berling - Elle">Charles Berling - Elle</p>
            </div>
          </div>
        </div>
      </div>
      <div class="item photocall 21-05-16 shadow-bottom photo paysage notloaded">
        <a id="photo1748" class="ajax chocolat-image" data-pid="1748"
           href="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/06/9be3dc61064dcb6933e9ba0f41d17af7735bdfaa.jpg"
           title='<span class="category">Photocall</span><span class="date">21.05.16 . 11:05</span><h2>Paul Verhoeven et Isabelle Hupert - Elle</h2>'
           data-credit="Crédit Image : Mathilde Petit / FDC"></a>
        <img data-original="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/06/thumb_5987_media_image_640x404.jpg"  alt="" title="Paul Verhoeven et Isabelle Hupert - Elle" class="lazy">
        <div class="picto"><i class="icon icon_photo"></i></div>
        <div class="info">
          <div class="vCenter">
            <div class="vCenterKid">
              <span class="category">Photocall</span>
              <span class="date">21.05.16</span> . <span
                  class="hour">11:05</span>
              <p data-title="Paul Verhoeven et Isabelle Hupert - Elle">Paul Verhoeven et Isabelle Hupert - Elle</p>
            </div>
          </div>
        </div>
      </div>
      <div class="item photocall 21-05-16 shadow-bottom photo paysage notloaded">
        <a id="photo1747" class="ajax chocolat-image" data-pid="1747"
           href="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/06/b90c20671630513686feae99156d650f1270c770.jpg"
           title='<span class="category">Photocall</span><span class="date">21.05.16 . 11:03</span><h2>Alice Isaaz, Jonas Bloquet et Paul Verhoeven - Elle</h2>'
           data-credit="Crédit Image : Mathilde Petit / FDC"></a>
        <img data-original="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/06/thumb_5986_media_image_640x404.jpg"  alt="" title="Alice Isaaz, Jonas Bloquet et Paul Verhoeven - Elle" class="lazy">
        <div class="picto"><i class="icon icon_photo"></i></div>
        <div class="info">
          <div class="vCenter">
            <div class="vCenterKid">
              <span class="category">Photocall</span>
              <span class="date">21.05.16</span> . <span
                  class="hour">11:03</span>
              <p data-title="Alice Isaaz, Jonas Bloquet et Paul Verhoeven - Elle">Alice Isaaz, Jonas Bloquet et Paul Verhoeven - Elle</p>
            </div>
          </div>
        </div>
      </div>
      <div class="item photocall 21-05-16 shadow-bottom photo paysage notloaded">
        <a id="photo1746" class="ajax chocolat-image" data-pid="1746"
           href="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/06/518c25ce6298969a47148f5a9c856dcd2b899183.jpg"
           title='<span class="category">Photocall</span><span class="date">21.05.16 . 11:00</span><h2>Équipe du film - Elle</h2>'
           data-credit="Crédit Image : Mathilde Petit / FDC"></a>
        <img data-original="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/06/thumb_5985_media_image_640x404.jpg"  alt="" title="Équipe du film - Elle" class="lazy">
        <div class="picto"><i class="icon icon_photo"></i></div>
        <div class="info">
          <div class="vCenter">
            <div class="vCenterKid">
              <span class="category">Photocall</span>
              <span class="date">21.05.16</span> . <span
                  class="hour">11:00</span>
              <p data-title="Équipe du film - Elle">Équipe du film - Elle</p>
            </div>
          </div>
        </div>
      </div>
      <div class="item oeil-du-photographe 21-05-16 shadow-bottom photo paysage notloaded">
        <a id="photo1703" class="ajax chocolat-image" data-pid="1703"
           href="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/06/a1a8dfd41032cde9893482894041f386746ebccc.jpg"
           title='<span class="category">Œil du photographe</span><span class="date">21.05.16 . 09:00</span><h2>Invitation</h2>'
           data-credit="Crédit Image : Federico Meneghini"></a>
        <img data-original="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/06/thumb_5906_media_image_640x404.jpg"  alt="" title="Invitation" class="lazy">
        <div class="picto"><i class="icon icon_photo"></i></div>
        <div class="info">
          <div class="vCenter">
            <div class="vCenterKid">
              <span class="category">Œil du photographe</span>
              <span class="date">21.05.16</span> . <span
                  class="hour">09:00</span>
              <p data-title="Invitation">Invitation</p>
            </div>
          </div>
        </div>
      </div>
      <div class="item oeil-du-photographe 21-05-16 shadow-bottom photo portrait notloaded">
        <a id="photo1704" class="ajax chocolat-image" data-pid="1704"
           href="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/06/afb81e2983f2c277ce52202279acbd92151ccb33.jpg"
           title='<span class="category">Œil du photographe</span><span class="date">21.05.16 . 09:00</span><h2>Elina Lenina</h2>'
           data-credit="Crédit Image : Federico Meneghini"></a>
        <img data-original="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/06/thumb_5907_media_image_320x404.jpg"  alt="" title="Elina Lenina" class="lazy">
        <div class="picto"><i class="icon icon_photo"></i></div>
        <div class="info">
          <div class="vCenter">
            <div class="vCenterKid">
              <span class="category">Œil du photographe</span>
              <span class="date">21.05.16</span> . <span
                  class="hour">09:00</span>
              <p data-title="Elina Lenina">Elina Lenina</p>
            </div>
          </div>
        </div>
      </div>
      <div class="item oeil-du-photographe 21-05-16 shadow-bottom photo portrait notloaded">
        <a id="photo1705" class="ajax chocolat-image" data-pid="1705"
           href="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/06/1884061c5123bb8de6652d0ec48924923dbbf64c.jpg"
           title='<span class="category">Œil du photographe</span><span class="date">21.05.16 . 09:00</span><h2>À cheval</h2>'
           data-credit="Crédit Image : Federico Meneghini"></a>
        <img data-original="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/06/thumb_5908_media_image_320x404.jpg"  alt="" title="À cheval" class="lazy">
        <div class="picto"><i class="icon icon_photo"></i></div>
        <div class="info">
          <div class="vCenter">
            <div class="vCenterKid">
              <span class="category">Œil du photographe</span>
              <span class="date">21.05.16</span> . <span
                  class="hour">09:00</span>
              <p data-title="À cheval">À cheval</p>
            </div>
          </div>
        </div>
      </div>
      <div class="item oeil-du-photographe 21-05-16 shadow-bottom photo paysage notloaded">
        <a id="photo1707" class="ajax chocolat-image" data-pid="1707"
           href="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/06/defba2cc56e145a6a00400f61371232c15b82387.jpg"
           title='<span class="category">Œil du photographe</span><span class="date">21.05.16 . 09:00</span><h2>Sur la Croisette</h2>'
           data-credit="Crédit Image : Federico Meneghini"></a>
        <img data-original="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/06/thumb_5910_media_image_640x404.jpg"  alt="" title="Sur la Croisette" class="lazy">
        <div class="picto"><i class="icon icon_photo"></i></div>
        <div class="info">
          <div class="vCenter">
            <div class="vCenterKid">
              <span class="category">Œil du photographe</span>
              <span class="date">21.05.16</span> . <span
                  class="hour">09:00</span>
              <p data-title="Sur la Croisette">Sur la Croisette</p>
            </div>
          </div>
        </div>
      </div>
      <div class="item montee-des-marches 20-05-16 shadow-bottom photo paysage notloaded">
        <a id="photo1735" class="ajax chocolat-image" data-pid="1735"
           href="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/06/9bdaf9808f5d288f2563d3024de049e86a7ab286.jpg"
           title='<span class="category">Montée des Marches</span><span class="date">20.05.16 . 22:45</span><h2>Elle Fanning, Nicolas Winding Refn et Liv Corfixen - The Neon Demon</h2>'
           data-credit="Crédit Image : Alberto Pizzoli / AFP"></a>
        <img data-original="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/06/thumb_5941_media_image_640x404.jpg"  alt="" title="Elle Fanning, Nicolas Winding Refn et Liv Corfixen - The Neon Demon" class="lazy">
        <div class="picto"><i class="icon icon_photo"></i></div>
        <div class="info">
          <div class="vCenter">
            <div class="vCenterKid">
              <span class="category">Montée des Marches</span>
              <span class="date">20.05.16</span> . <span
                  class="hour">22:45</span>
              <p data-title="Elle Fanning, Nicolas Winding Refn et Liv Corfixen - The Neon Demon">Elle Fanning, Nicolas Winding Refn et Liv Corfixen - The Neon Demon</p>
            </div>
          </div>
        </div>
      </div>
      <div class="item montee-des-marches 20-05-16 shadow-bottom photo portrait notloaded">
        <a id="photo1733" class="ajax chocolat-image" data-pid="1733"
           href="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/06/9ccdcdd1c03cd87500aed6f52029a96f7b5f7616.jpg"
           title='<span class="category">Montée des Marches</span><span class="date">20.05.16 . 22:37</span><h2>Mads Mikkelsen et Kirsten Dunst - Membres du Jury des Longs Métrages</h2>'
           data-credit="Crédit Image : Alberto Pizzoli / AFP"></a>
        <img data-original="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/06/thumb_5939_media_image_320x404.jpg"  alt="" title="Mads Mikkelsen et Kirsten Dunst - Membres du Jury des Longs Métrages" class="lazy">
        <div class="picto"><i class="icon icon_photo"></i></div>
        <div class="info">
          <div class="vCenter">
            <div class="vCenterKid">
              <span class="category">Montée des Marches</span>
              <span class="date">20.05.16</span> . <span
                  class="hour">22:37</span>
              <p data-title="Mads Mikkelsen et Kirsten Dunst - Membres du Jury des Longs Métrages">Mads Mikkelsen et Kirsten Dunst - Membres du Jury des Longs Métrages</p>
            </div>
          </div>
        </div>
      </div>
      <div class="item montee-des-marches 20-05-16 shadow-bottom photo paysage notloaded">
        <a id="photo1731" class="ajax chocolat-image" data-pid="1731"
           href="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/06/a155f5c2c54e603963fcad673de5d84b01d5b62f.jpg"
           title='<span class="category">Montée des Marches</span><span class="date">20.05.16 . 22:35</span><h2>Bella Heathcote - The Neon Demon</h2>'
           data-credit="Crédit Image : Alberto Pizzoli / AFP"></a>
        <img data-original="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/06/thumb_5937_media_image_640x404.jpg"  alt="" title="Bella Heathcote - The Neon Demon" class="lazy">
        <div class="picto"><i class="icon icon_photo"></i></div>
        <div class="info">
          <div class="vCenter">
            <div class="vCenterKid">
              <span class="category">Montée des Marches</span>
              <span class="date">20.05.16</span> . <span
                  class="hour">22:35</span>
              <p data-title="Bella Heathcote - The Neon Demon">Bella Heathcote - The Neon Demon</p>
            </div>
          </div>
        </div>
      </div>
      <div class="item montee-des-marches 20-05-16 shadow-bottom photo paysage notloaded">
        <a id="photo1729" class="ajax chocolat-image" data-pid="1729"
           href="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/06/9795beeb186f9869e118af31bb23ff73f4843454.jpg"
           title='<span class="category">Montée des Marches</span><span class="date">20.05.16 . 22:25</span><h2>Liv Corfixen, Nicolas Winding Refn et Elle Fanning - The Neon Demon</h2>'
           data-credit="Crédit Image : Alberto Pizzoli / AFP"></a>
        <img data-original="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/06/thumb_5935_media_image_640x404.jpg"  alt="" title="Liv Corfixen, Nicolas Winding Refn et Elle Fanning - The Neon Demon" class="lazy">
        <div class="picto"><i class="icon icon_photo"></i></div>
        <div class="info">
          <div class="vCenter">
            <div class="vCenterKid">
              <span class="category">Montée des Marches</span>
              <span class="date">20.05.16</span> . <span
                  class="hour">22:25</span>
              <p data-title="Liv Corfixen, Nicolas Winding Refn et Elle Fanning - The Neon Demon">Liv Corfixen, Nicolas Winding Refn et Elle Fanning - The Neon Demon</p>
            </div>
          </div>
        </div>
      </div>
      <div class="item montee-des-marches 20-05-16 shadow-bottom photo paysage notloaded">
        <a id="photo1726" class="ajax chocolat-image" data-pid="1726"
           href="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/06/f0ab334b63a0b477c13c9c6bb11a20ebbd436079.jpg"
           title='<span class="category">Montée des Marches</span><span class="date">20.05.16 . 22:20</span><h2>Elle Fanning - The Neon Demon</h2>'
           data-credit="Crédit Image : Alberto Pizzoli / AFP"></a>
        <img data-original="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/06/thumb_5932_media_image_640x404.jpg"  alt="" title="Elle Fanning - The Neon Demon" class="lazy">
        <div class="picto"><i class="icon icon_photo"></i></div>
        <div class="info">
          <div class="vCenter">
            <div class="vCenterKid">
              <span class="category">Montée des Marches</span>
              <span class="date">20.05.16</span> . <span
                  class="hour">22:20</span>
              <p data-title="Elle Fanning - The Neon Demon">Elle Fanning - The Neon Demon</p>
            </div>
          </div>
        </div>
      </div>
      <div class="item montee-des-marches 20-05-16 shadow-bottom photo paysage notloaded">
        <a id="photo1720" class="ajax chocolat-image" data-pid="1720"
           href="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/06/a983b7b015f1b5ff642c843541494d034de5a939.jpg"
           title='<span class="category">Montée des Marches</span><span class="date">20.05.16 . 20:50</span><h2>Sean Penn et Dylan Penn - The Last Face</h2>'
           data-credit="Crédit Image : Loïc Venance / AFP"></a>
        <img data-original="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/06/thumb_5927_media_image_640x404.jpg"  alt="" title="Sean Penn et Dylan Penn - The Last Face" class="lazy">
        <div class="picto"><i class="icon icon_photo"></i></div>
        <div class="info">
          <div class="vCenter">
            <div class="vCenterKid">
              <span class="category">Montée des Marches</span>
              <span class="date">20.05.16</span> . <span
                  class="hour">20:50</span>
              <p data-title="Sean Penn et Dylan Penn - The Last Face">Sean Penn et Dylan Penn - The Last Face</p>
            </div>
          </div>
        </div>
      </div>
      <div class="item montee-des-marches 20-05-16 shadow-bottom photo paysage notloaded">
        <a id="photo1715" class="ajax chocolat-image" data-pid="1715"
           href="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/06/6bfd6c4e8a1a7c3033cc847a2329979a606b51ce.jpg"
           title='<span class="category">Montée des Marches</span><span class="date">20.05.16 . 20:40</span><h2>Luc Besson et Virginie Silla</h2>'
           data-credit="Crédit Image : Alberto Pizzoli / AFP"></a>
        <img data-original="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/06/thumb_5923_media_image_640x404.jpg"  alt="" title="Luc Besson et Virginie Silla" class="lazy">
        <div class="picto"><i class="icon icon_photo"></i></div>
        <div class="info">
          <div class="vCenter">
            <div class="vCenterKid">
              <span class="category">Montée des Marches</span>
              <span class="date">20.05.16</span> . <span
                  class="hour">20:40</span>
              <p data-title="Luc Besson et Virginie Silla">Luc Besson et Virginie Silla</p>
            </div>
          </div>
        </div>
      </div>
      <div class="item montee-des-marches 20-05-16 shadow-bottom photo portrait notloaded">
        <a id="photo1717" class="ajax chocolat-image" data-pid="1717"
           href="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/06/be38e53cd925bdf2d6c679706dc0ec73cce75b3a.jpg"
           title='<span class="category">Montée des Marches</span><span class="date">20.05.16 . 20:30</span><h2>Faye Dunaway</h2>'
           data-credit="Crédit Image : Valéry Hache / AFP"></a>
        <img data-original="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/06/thumb_5924_media_image_320x404.jpg"  alt="" title="Faye Dunaway" class="lazy">
        <div class="picto"><i class="icon icon_photo"></i></div>
        <div class="info">
          <div class="vCenter">
            <div class="vCenterKid">
              <span class="category">Montée des Marches</span>
              <span class="date">20.05.16</span> . <span
                  class="hour">20:30</span>
              <p data-title="Faye Dunaway">Faye Dunaway</p>
            </div>
          </div>
        </div>
      </div>
      <div class="item photocall 20-05-16 shadow-bottom photo paysage notloaded">
        <a id="photo1712" class="ajax chocolat-image" data-pid="1712"
           href="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/06/5e92af56109a58fa7f399540131555bf2c4fe1dc.jpg"
           title='<span class="category">Photocall</span><span class="date">20.05.16 . 19:45</span><h2>Juliette Binoche, Peter Suschitzky, Alba Rohrwacher et Matteo Garrone - Prix Angénieux</h2>'
           data-credit="Crédit Image : Mathilde Petit / FDC"></a>
        <img data-original="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/06/thumb_5914_media_image_640x404.jpg"  alt="" title="Juliette Binoche, Peter Suschitzky, Alba Rohrwacher et Matteo Garrone - Prix Angénieux" class="lazy">
        <div class="picto"><i class="icon icon_photo"></i></div>
        <div class="info">
          <div class="vCenter">
            <div class="vCenterKid">
              <span class="category">Photocall</span>
              <span class="date">20.05.16</span> . <span
                  class="hour">19:45</span>
              <p data-title="Juliette Binoche, Peter Suschitzky, Alba Rohrwacher et Matteo Garrone - Prix Angénieux">Juliette Binoche, Peter Suschitzky, Alba Rohrwacher et Matteo Garrone - Prix Angénieux</p>
            </div>
          </div>
        </div>
      </div>
      <div class="item photocall 20-05-16 shadow-bottom photo paysage notloaded">
        <a id="photo1710" class="ajax chocolat-image" data-pid="1710"
           href="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/06/215874c6250d26b93fd36d1ace94c8ba9924a811.jpg"
           title='<span class="category">Photocall</span><span class="date">20.05.16 . 19:40</span><h2>Juliette Binoche, Peter Suschitzky et Alba Rohrwacher - Prix Angénieux</h2>'
           data-credit="Crédit Image : Mathilde Petit / FDC"></a>
        <img data-original="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/06/thumb_5912_media_image_640x404.jpg"  alt="" title="Juliette Binoche, Peter Suschitzky et Alba Rohrwacher - Prix Angénieux" class="lazy">
        <div class="picto"><i class="icon icon_photo"></i></div>
        <div class="info">
          <div class="vCenter">
            <div class="vCenterKid">
              <span class="category">Photocall</span>
              <span class="date">20.05.16</span> . <span
                  class="hour">19:40</span>
              <p data-title="Juliette Binoche, Peter Suschitzky et Alba Rohrwacher - Prix Angénieux">Juliette Binoche, Peter Suschitzky et Alba Rohrwacher - Prix Angénieux</p>
            </div>
          </div>
        </div>
      </div>
      <div class="item montee-des-marches 20-05-16 shadow-bottom photo portrait notloaded">
        <a id="photo1706" class="ajax chocolat-image" data-pid="1706"
           href="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/06/109e497161ab7c565ba09a5067a5734990f282c0.jpg"
           title='<span class="category">Montée des Marches</span><span class="date">20.05.16 . 18:30</span><h2>Adèle Exarchopoulos - The Last Face</h2>'
           data-credit="Crédit Image : Alberto Pizzoli / AFP"></a>
        <img data-original="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/06/thumb_5909_media_image_320x404.jpg"  alt="" title="Adèle Exarchopoulos - The Last Face" class="lazy">
        <div class="picto"><i class="icon icon_photo"></i></div>
        <div class="info">
          <div class="vCenter">
            <div class="vCenterKid">
              <span class="category">Montée des Marches</span>
              <span class="date">20.05.16</span> . <span
                  class="hour">18:30</span>
              <p data-title="Adèle Exarchopoulos - The Last Face">Adèle Exarchopoulos - The Last Face</p>
            </div>
          </div>
        </div>
      </div>
      <div class="item montee-des-marches 20-05-16 shadow-bottom photo paysage notloaded">
        <a id="photo1701" class="ajax chocolat-image" data-pid="1701"
           href="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/06/1ad740a531bc0b6223d5d8478c818ba8cfbb963a.jpg"
           title='<span class="category">Montée des Marches</span><span class="date">20.05.16 . 18:27</span><h2>Équipe du film - The Last Face</h2>'
           data-credit="Crédit Image : Valéry Hache / AFP"></a>
        <img data-original="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/06/thumb_5904_media_image_640x404.jpg"  alt="" title="Équipe du film - The Last Face" class="lazy">
        <div class="picto"><i class="icon icon_photo"></i></div>
        <div class="info">
          <div class="vCenter">
            <div class="vCenterKid">
              <span class="category">Montée des Marches</span>
              <span class="date">20.05.16</span> . <span
                  class="hour">18:27</span>
              <p data-title="Équipe du film - The Last Face">Équipe du film - The Last Face</p>
            </div>
          </div>
        </div>
      </div>
      <div class="item montee-des-marches 20-05-16 shadow-bottom photo paysage notloaded">
        <a id="photo1699" class="ajax chocolat-image" data-pid="1699"
           href="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/06/dfb5ce7f5e0383446ef2fbf1fc145258ff6ed3e9.jpg"
           title='<span class="category">Montée des Marches</span><span class="date">20.05.16 . 18:20</span><h2>Jean Reno et Charlize Theron - The Last Face</h2>'
           data-credit="Crédit Image : Valéry Hache / AFP"></a>
        <img data-original="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/06/thumb_5902_media_image_640x404.jpg"  alt="" title="Jean Reno et Charlize Theron - The Last Face" class="lazy">
        <div class="picto"><i class="icon icon_photo"></i></div>
        <div class="info">
          <div class="vCenter">
            <div class="vCenterKid">
              <span class="category">Montée des Marches</span>
              <span class="date">20.05.16</span> . <span
                  class="hour">18:20</span>
              <p data-title="Jean Reno et Charlize Theron - The Last Face">Jean Reno et Charlize Theron - The Last Face</p>
            </div>
          </div>
        </div>
      </div>
      <div class="item montee-des-marches 20-05-16 shadow-bottom photo portrait notloaded">
        <a id="photo1697" class="ajax chocolat-image" data-pid="1697"
           href="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/06/f2fc86cf8eaae3ec66712a3666817d2cb18f5f73.jpg"
           title='<span class="category">Montée des Marches</span><span class="date">20.05.16 . 18:15</span><h2>Juliette Binoche</h2>'
           data-credit="Crédit Image : Alberto Pizzoli / AFP"></a>
        <img data-original="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/06/thumb_5900_media_image_320x404.jpg"  alt="" title="Juliette Binoche" class="lazy">
        <div class="picto"><i class="icon icon_photo"></i></div>
        <div class="info">
          <div class="vCenter">
            <div class="vCenterKid">
              <span class="category">Montée des Marches</span>
              <span class="date">20.05.16</span> . <span
                  class="hour">18:15</span>
              <p data-title="Juliette Binoche">Juliette Binoche</p>
            </div>
          </div>
        </div>
      </div>
      <div class="item montee-des-marches 20-05-16 shadow-bottom photo paysage notloaded">
        <a id="photo1698" class="ajax chocolat-image" data-pid="1698"
           href="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/06/04862eac3f0871d8eb94a398fb7b9dbe7f62f705.jpg"
           title='<span class="category">Montée des Marches</span><span class="date">20.05.16 . 18:15</span><h2>Adèle Exarchopoulos et Sean Penn - The Last Face</h2>'
           data-credit="Crédit Image : Valéry Hache / AFP"></a>
        <img data-original="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/06/thumb_5901_media_image_640x404.jpg"  alt="" title="Adèle Exarchopoulos et Sean Penn - The Last Face" class="lazy">
        <div class="picto"><i class="icon icon_photo"></i></div>
        <div class="info">
          <div class="vCenter">
            <div class="vCenterKid">
              <span class="category">Montée des Marches</span>
              <span class="date">20.05.16</span> . <span
                  class="hour">18:15</span>
              <p data-title="Adèle Exarchopoulos et Sean Penn - The Last Face">Adèle Exarchopoulos et Sean Penn - The Last Face</p>
            </div>
          </div>
        </div>
      </div>
      <div class="item palmares 20-05-16 shadow-bottom photo paysage notloaded">
        <a id="photo1693" class="ajax chocolat-image" data-pid="1693"
           href="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/06/7297a26cf51ff27471b5928d4ebc22ecf66ec93a.jpg"
           title='<span class="category">Palmarès</span><span class="date">20.05.16 . 16:45</span><h2>Les Lauréats du Prix de la Cinéfondation</h2>'
           data-credit="Crédit Image : Thomas Leibreich / FDC"></a>
        <img data-original="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/06/thumb_5898_media_image_640x404.jpg"  alt="Les Lauréats du Prix de la Cinéfondation" title="Les Lauréats du Prix de la Cinéfondation" class="lazy">
        <div class="picto"><i class="icon icon_photo"></i></div>
        <div class="info">
          <div class="vCenter">
            <div class="vCenterKid">
              <span class="category">Palmarès</span>
              <span class="date">20.05.16</span> . <span
                  class="hour">16:45</span>
              <p data-title="Les Lauréats du Prix de la Cinéfondation">Les Lauréats du Prix de la Cinéfondation</p>
            </div>
          </div>
        </div>
      </div>
      <div class="item palmares 20-05-16 shadow-bottom photo portrait notloaded">
        <a id="photo1694" class="ajax chocolat-image" data-pid="1694"
           href="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/06/29c18fed766dfa0851fbf880c5766d2503f4d102.jpg"
           title='<span class="category">Palmarès</span><span class="date">20.05.16 . 16:30</span><h2>Or Sinai, Premier Prix de la Cinéfondation - Anna</h2>'
           data-credit="Crédit Image : Thomas Leibreich / FDC"></a>
        <img data-original="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/06/thumb_5896_media_image_320x404.jpg"  alt="" title="Or Sinai, Premier Prix de la Cinéfondation - Anna" class="lazy">
        <div class="picto"><i class="icon icon_photo"></i></div>
        <div class="info">
          <div class="vCenter">
            <div class="vCenterKid">
              <span class="category">Palmarès</span>
              <span class="date">20.05.16</span> . <span
                  class="hour">16:30</span>
              <p data-title="Or Sinai, Premier Prix de la Cinéfondation - Anna">Or Sinai, Premier Prix de la Cinéfondation - Anna</p>
            </div>
          </div>
        </div>
      </div>
      <div class="item palmares 20-05-16 shadow-bottom photo portrait notloaded">
        <a id="photo1695" class="ajax chocolat-image" data-pid="1695"
           href="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/06/096b42813e670b60460fc7bbc31eb68a0f8e212c.jpg"
           title='<span class="category">Palmarès</span><span class="date">20.05.16 . 16:20</span><h2>Hamid Ahmadi, Deuxième Prix de la Cinéfondation - In the Hills</h2>'
           data-credit="Crédit Image : Thomas Leibreich / FDC"></a>
        <img data-original="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/06/thumb_5897_media_image_320x404.jpg"  alt="" title="Hamid Ahmadi, Deuxième Prix de la Cinéfondation - In the Hills" class="lazy">
        <div class="picto"><i class="icon icon_photo"></i></div>
        <div class="info">
          <div class="vCenter">
            <div class="vCenterKid">
              <span class="category">Palmarès</span>
              <span class="date">20.05.16</span> . <span
                  class="hour">16:20</span>
              <p data-title="Hamid Ahmadi, Deuxième Prix de la Cinéfondation - In the Hills">Hamid Ahmadi, Deuxième Prix de la Cinéfondation - In the Hills</p>
            </div>
          </div>
        </div>
      </div>
      <div class="item short-film-corner 20-05-16 shadow-bottom photo portrait notloaded">
        <a id="photo1692" class="ajax chocolat-image" data-pid="1692"
           href="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/06/a5e4f5a6ecbcec7f62b26d5e66f14fc29acb4608.jpg"
           title='<span class="category">Short Film Corner</span><span class="date">20.05.16 . 16:15</span><h2>Discussion avec Brillante Mendoza</h2>'
           data-credit="Crédit Image : Mathilde Petit / FDC"></a>
        <img data-original="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/06/thumb_5894_media_image_320x404.jpg"  alt="" title="Discussion avec Brillante Mendoza" class="lazy">
        <div class="picto"><i class="icon icon_photo"></i></div>
        <div class="info">
          <div class="vCenter">
            <div class="vCenterKid">
              <span class="category">Short Film Corner</span>
              <span class="date">20.05.16</span> . <span
                  class="hour">16:15</span>
              <p data-title="Discussion avec Brillante Mendoza">Discussion avec Brillante Mendoza</p>
            </div>
          </div>
        </div>
      </div>
      <div class="item montee-des-marches 20-05-16 shadow-bottom photo paysage notloaded">
        <a id="photo1713" class="ajax chocolat-image" data-pid="1713"
           href="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/06/9c01cc10555b16dc1fc40c2af67f5066902fbfea.jpg"
           title='<span class="category">Montée des Marches</span><span class="date">20.05.16 . 16:00</span><h2>Équipe du film - Peshmega</h2>'
           data-credit="Crédit Image : Valéry Hache / AFP"></a>
        <img data-original="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/06/thumb_5915_media_image_640x404.jpg"  alt="" title="Équipe du film - Peshmega" class="lazy">
        <div class="picto"><i class="icon icon_photo"></i></div>
        <div class="info">
          <div class="vCenter">
            <div class="vCenterKid">
              <span class="category">Montée des Marches</span>
              <span class="date">20.05.16</span> . <span
                  class="hour">16:00</span>
              <p data-title="Équipe du film - Peshmega">Équipe du film - Peshmega</p>
            </div>
          </div>
        </div>
      </div>
      <div class="item sur-scene 20-05-16 shadow-bottom photo paysage notloaded">
        <a id="photo1691" class="ajax chocolat-image" data-pid="1691"
           href="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/06/efa618341d59b0b7a9fe8951f04877cce3844bfe.jpg"
           title='<span class="category">Sur Scène</span><span class="date">20.05.16 . 15:00</span><h2>Équipe du film - Peshmerga</h2>'
           data-credit="Crédit Image : Cyril Duchêne / FDC"></a>
        <img data-original="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/06/thumb_5893_media_image_640x404.jpg"  alt="" title="Équipe du film - Peshmerga" class="lazy">
        <div class="picto"><i class="icon icon_photo"></i></div>
        <div class="info">
          <div class="vCenter">
            <div class="vCenterKid">
              <span class="category">Sur Scène</span>
              <span class="date">20.05.16</span> . <span
                  class="hour">15:00</span>
              <p data-title="Équipe du film - Peshmerga">Équipe du film - Peshmerga</p>
            </div>
          </div>
        </div>
      </div>
      <div class="item conference-de-presse 20-05-16 shadow-bottom photo paysage notloaded">
        <a id="photo1679" class="ajax chocolat-image" data-pid="1679"
           href="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/06/72eb72b08bc36c0ee179096369ba53f2727a68f8.jpg"
           title='<span class="category">Conférence de Presse</span><span class="date">20.05.16 . 14:27</span><h2>Javier Bardem - The Last Face</h2>'
           data-credit="Crédit Image : Mathilde Petit / FDC"></a>
        <img data-original="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/06/thumb_5892_media_image_640x404.jpg"  alt="" title="Javier Bardem - The Last Face" class="lazy">
        <div class="picto"><i class="icon icon_photo"></i></div>
        <div class="info">
          <div class="vCenter">
            <div class="vCenterKid">
              <span class="category">Conférence de Presse</span>
              <span class="date">20.05.16</span> . <span
                  class="hour">14:27</span>
              <p data-title="Javier Bardem - The Last Face">Javier Bardem - The Last Face</p>
            </div>
          </div>
        </div>
      </div>
      <div class="item conference-de-presse 20-05-16 shadow-bottom photo paysage notloaded">
        <a id="photo1678" class="ajax chocolat-image" data-pid="1678"
           href="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/06/b6f61d0190c840c76a3cdff89fd2af06b4c9de0e.jpg"
           title='<span class="category">Conférence de Presse</span><span class="date">20.05.16 . 14:25</span><h2>Équipe - The Last Face</h2>'
           data-credit="Crédit Image : Mathilde Petit / FDC"></a>
        <img data-original="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/06/thumb_5890_media_image_640x404.jpg"  alt="" title="Équipe - The Last Face" class="lazy">
        <div class="picto"><i class="icon icon_photo"></i></div>
        <div class="info">
          <div class="vCenter">
            <div class="vCenterKid">
              <span class="category">Conférence de Presse</span>
              <span class="date">20.05.16</span> . <span
                  class="hour">14:25</span>
              <p data-title="Équipe - The Last Face">Équipe - The Last Face</p>
            </div>
          </div>
        </div>
      </div>
      <div class="item photocall 20-05-16 shadow-bottom photo portrait notloaded">
        <a id="photo1675" class="ajax chocolat-image" data-pid="1675"
           href="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/06/7074ef05d160175e8611d3fca6f1ddc354a1b361.jpg"
           title='<span class="category">Photocall</span><span class="date">20.05.16 . 14:22</span><h2>Helly Luv - Peshmerga</h2>'
           data-credit="Crédit Image : Cyril Duchêne / FDC"></a>
        <img data-original="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/06/thumb_5879_media_image_320x404.jpg"  alt="" title="Helly Luv - Peshmerga" class="lazy">
        <div class="picto"><i class="icon icon_photo"></i></div>
        <div class="info">
          <div class="vCenter">
            <div class="vCenterKid">
              <span class="category">Photocall</span>
              <span class="date">20.05.16</span> . <span
                  class="hour">14:22</span>
              <p data-title="Helly Luv - Peshmerga">Helly Luv - Peshmerga</p>
            </div>
          </div>
        </div>
      </div>
      <div class="item photocall 20-05-16 shadow-bottom photo paysage notloaded">
        <a id="photo1673" class="ajax chocolat-image" data-pid="1673"
           href="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/06/5197f9ebd75b200bfff6db2e1641e35d387ba518.jpg"
           title='<span class="category">Photocall</span><span class="date">20.05.16 . 14:20</span><h2>Bernard Henry Levy - Peshmerga</h2>'
           data-credit="Crédit Image : Cyril Duchêne / FDC"></a>
        <img data-original="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/06/thumb_5878_media_image_640x404.jpg"  alt="" title="Bernard Henry Levy - Peshmerga" class="lazy">
        <div class="picto"><i class="icon icon_photo"></i></div>
        <div class="info">
          <div class="vCenter">
            <div class="vCenterKid">
              <span class="category">Photocall</span>
              <span class="date">20.05.16</span> . <span
                  class="hour">14:20</span>
              <p data-title="Bernard Henry Levy - Peshmerga">Bernard Henry Levy - Peshmerga</p>
            </div>
          </div>
        </div>
      </div>
      <div class="item photocall 20-05-16 shadow-bottom photo paysage notloaded">
        <a id="photo1672" class="ajax chocolat-image" data-pid="1672"
           href="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/06/81eb6e8f18f3b67d78ad3e82a4477f8f7a2262c3.jpg"
           title='<span class="category">Photocall</span><span class="date">20.05.16 . 14:15</span><h2>Équipe du film - Peshmerga</h2>'
           data-credit="Crédit Image : Cyril Duchêne / FDC"></a>
        <img data-original="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/06/thumb_5877_media_image_640x404.jpg"  alt="" title="Équipe du film - Peshmerga" class="lazy">
        <div class="picto"><i class="icon icon_photo"></i></div>
        <div class="info">
          <div class="vCenter">
            <div class="vCenterKid">
              <span class="category">Photocall</span>
              <span class="date">20.05.16</span> . <span
                  class="hour">14:15</span>
              <p data-title="Équipe du film - Peshmerga">Équipe du film - Peshmerga</p>
            </div>
          </div>
        </div>
      </div>
      <div class="item photocall 20-05-16 shadow-bottom photo portrait notloaded">
        <a id="photo1668" class="ajax chocolat-image" data-pid="1668"
           href="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/06/fe0e12c8bae3905f287b6cf1818b1abafc253e68.jpg"
           title='<span class="category">Photocall</span><span class="date">20.05.16 . 14:07</span><h2>Sean Penn - The Last Face</h2>'
           data-credit="Crédit Image : Cyril Duchêne / FDC"></a>
        <img data-original="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/06/thumb_5873_media_image_320x404.jpg"  alt="" title="Sean Penn - The Last Face" class="lazy">
        <div class="picto"><i class="icon icon_photo"></i></div>
        <div class="info">
          <div class="vCenter">
            <div class="vCenterKid">
              <span class="category">Photocall</span>
              <span class="date">20.05.16</span> . <span
                  class="hour">14:07</span>
              <p data-title="Sean Penn - The Last Face">Sean Penn - The Last Face</p>
            </div>
          </div>
        </div>
      </div>
      <div class="item photocall 20-05-16 shadow-bottom photo paysage notloaded">
        <a id="photo1671" class="ajax chocolat-image" data-pid="1671"
           href="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/06/1318241ec927554b5e3d8a19483ff4a2d17f6823.jpg"
           title='<span class="category">Photocall</span><span class="date">20.05.16 . 14:05</span><h2>Équipe du film - The last Face</h2>'
           data-credit="Crédit Image : Cyril Duchêne / FDC"></a>
        <img data-original="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/06/thumb_5875_media_image_640x404.jpg"  alt="" title="Équipe du film - The last Face" class="lazy">
        <div class="picto"><i class="icon icon_photo"></i></div>
        <div class="info">
          <div class="vCenter">
            <div class="vCenterKid">
              <span class="category">Photocall</span>
              <span class="date">20.05.16</span> . <span
                  class="hour">14:05</span>
              <p data-title="Équipe du film - The last Face">Équipe du film - The last Face</p>
            </div>
          </div>
        </div>
      </div>
      <div class="item photocall 20-05-16 shadow-bottom photo paysage notloaded">
        <a id="photo1667" class="ajax chocolat-image" data-pid="1667"
           href="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/06/c81c0115169b36c7a09e836684cd9926fea73ef9.jpg"
           title='<span class="category">Photocall</span><span class="date">20.05.16 . 14:00</span><h2>Charlize Theron et Adèle Exarchopoulos - The Last Face</h2>'
           data-credit="Crédit Image : Cyril Duchêne / FDC"></a>
        <img data-original="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/06/thumb_5872_media_image_640x404.jpg"  alt="" title="Charlize Theron et Adèle Exarchopoulos - The Last Face" class="lazy">
        <div class="picto"><i class="icon icon_photo"></i></div>
        <div class="info">
          <div class="vCenter">
            <div class="vCenterKid">
              <span class="category">Photocall</span>
              <span class="date">20.05.16</span> . <span
                  class="hour">14:00</span>
              <p data-title="Charlize Theron et Adèle Exarchopoulos - The Last Face">Charlize Theron et Adèle Exarchopoulos - The Last Face</p>
            </div>
          </div>
        </div>
      </div>
      <div class="item evenement 20-05-16 shadow-bottom photo paysage notloaded">
        <a id="photo1677" class="ajax chocolat-image" data-pid="1677"
           href="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/06/c28461624e3d2cc6919277ee50dc153f41605471.jpg"
           title='<span class="category">Évènement</span><span class="date">20.05.16 . 13:30</span><h2>Vanessa Paradis, George Miller et Valeria Golino, membres du Jury des Longs Métrages - Déjeuner du Maire de Cannes</h2>'
           data-credit="Crédit Image : Léo Laumont / FDC"></a>
        <img data-original="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/06/thumb_5881_media_image_640x404.jpg"  alt="" title="Vanessa Paradis, George Miller et Valeria Golino, membres du Jury des Longs Métrages - Déjeuner du Maire de Cannes" class="lazy">
        <div class="picto"><i class="icon icon_photo"></i></div>
        <div class="info">
          <div class="vCenter">
            <div class="vCenterKid">
              <span class="category">Évènement</span>
              <span class="date">20.05.16</span> . <span
                  class="hour">13:30</span>
              <p data-title="Vanessa Paradis, George Miller et Valeria Golino, membres du Jury des Longs Métrages - Déjeuner du Maire de Cannes">Vanessa Paradis, George Miller et Valeria Golino, membres du Jury des Longs Métrages - Déjeuner du Maire de Cannes</p>
            </div>
          </div>
        </div>
      </div>
      <div class="item evenement 20-05-16 shadow-bottom photo paysage notloaded">
        <a id="photo1676" class="ajax chocolat-image" data-pid="1676"
           href="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/06/6f06b2d88d029f4ba382827aa6150546ab01e380.jpg"
           title='<span class="category">Évènement</span><span class="date">20.05.16 . 13:00</span><h2>Déjeuner du maire de Cannes</h2>'
           data-credit="Crédit Image : Léo Laumont / FDC"></a>
        <img data-original="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/06/thumb_5880_media_image_640x404.jpg"  alt="" title="Déjeuner du maire de Cannes" class="lazy">
        <div class="picto"><i class="icon icon_photo"></i></div>
        <div class="info">
          <div class="vCenter">
            <div class="vCenterKid">
              <span class="category">Évènement</span>
              <span class="date">20.05.16</span> . <span
                  class="hour">13:00</span>
              <p data-title="Déjeuner du maire de Cannes">Déjeuner du maire de Cannes</p>
            </div>
          </div>
        </div>
      </div>
      <div class="item sur-scene 20-05-16 shadow-bottom photo paysage notloaded">
        <a id="photo1657" class="ajax chocolat-image" data-pid="1657"
           href="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/06/a1b38df789f3c7085a8703279f406ab8e05b4df6.jpg"
           title='<span class="category">Sur Scène</span><span class="date">20.05.16 . 11:20</span><h2>Équipe du film - La Larga Noche de Fransisco Sanctis (La longue nuit de Fransisco Sanctis)</h2>'
           data-credit="Crédit Image : Mathilde Petit / FDC"></a>
        <img data-original="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/06/thumb_5867_media_image_640x404.jpg"  alt="" title="Équipe du film - La Larga Noche de Fransisco Sanctis (La longue nuit de Fransisco Sanctis)" class="lazy">
        <div class="picto"><i class="icon icon_photo"></i></div>
        <div class="info">
          <div class="vCenter">
            <div class="vCenterKid">
              <span class="category">Sur Scène</span>
              <span class="date">20.05.16</span> . <span
                  class="hour">11:20</span>
              <p data-title="Équipe du film - La Larga Noche de Fransisco Sanctis (La longue nuit de Fransisco Sanctis)">Équipe du film - La Larga Noche de Fransisco Sanctis (La longue nuit de Fransisco Sanctis)</p>
            </div>
          </div>
        </div>
      </div>
      <div class="item avant-la-projection 20-05-16 shadow-bottom photo portrait notloaded">
        <a id="photo1656" class="ajax chocolat-image" data-pid="1656"
           href="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/06/9d0d7f80c2992df386189be311fb3a9d225392c2.jpg"
           title='<span class="category">Avant la projection</span><span class="date">20.05.16 . 11:15</span><h2>Andrea Testa - La Larga Noche de Fransisco Sanctis (La longue nuit de Fransisco Sanctis)</h2>'
           data-credit="Crédit Image : Mathilde Petit / FDC"></a>
        <img data-original="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/06/thumb_5866_media_image_320x404.jpg"  alt="" title="Andrea Testa - La Larga Noche de Fransisco Sanctis (La longue nuit de Fransisco Sanctis)" class="lazy">
        <div class="picto"><i class="icon icon_photo"></i></div>
        <div class="info">
          <div class="vCenter">
            <div class="vCenterKid">
              <span class="category">Avant la projection</span>
              <span class="date">20.05.16</span> . <span
                  class="hour">11:15</span>
              <p data-title="Andrea Testa - La Larga Noche de Fransisco Sanctis (La longue nuit de Fransisco Sanctis)">Andrea Testa - La Larga Noche de Fransisco Sanctis (La longue nuit de Fransisco Sanctis)</p>
            </div>
          </div>
        </div>
      </div>
      <div class="item montee-des-marches 20-05-16 shadow-bottom photo paysage notloaded">
        <a id="photo1651" class="ajax chocolat-image" data-pid="1651"
           href="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/06/7e573a2e030485ad462a0d4848a581df9527f301.jpg"
           title='<span class="category">Montée des Marches</span><span class="date">20.05.16 . 11:10</span><h2>Équipe du film - La Larga Noche de Fransisco Sanctis (La longue nuit de Fransisco Sanctis)</h2>'
           data-credit="Crédit Image : Mathilde Petit / FDC"></a>
        <img data-original="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/06/thumb_5863_media_image_640x404.jpg"  alt="" title="Équipe du film - La Larga Noche de Fransisco Sanctis (La longue nuit de Fransisco Sanctis)" class="lazy">
        <div class="picto"><i class="icon icon_photo"></i></div>
        <div class="info">
          <div class="vCenter">
            <div class="vCenterKid">
              <span class="category">Montée des Marches</span>
              <span class="date">20.05.16</span> . <span
                  class="hour">11:10</span>
              <p data-title="Équipe du film - La Larga Noche de Fransisco Sanctis (La longue nuit de Fransisco Sanctis)">Équipe du film - La Larga Noche de Fransisco Sanctis (La longue nuit de Fransisco Sanctis)</p>
            </div>
          </div>
        </div>
      </div>
      <div class="item photocall 20-05-16 shadow-bottom photo portrait notloaded">
        <a id="photo1646" class="ajax chocolat-image" data-pid="1646"
           href="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/06/b9ca219c324a22df75cfde20da9518803a98b03a.jpg"
           title='<span class="category">Photocall</span><span class="date">20.05.16 . 11:03</span><h2>Elle Fanning - The Neon Demon</h2>'
           data-credit="Crédit Image : Cyril Duchêne / FDC"></a>
        <img data-original="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/06/thumb_5859_media_image_320x404.jpg"  alt="" title="Elle Fanning - The Neon Demon" class="lazy">
        <div class="picto"><i class="icon icon_photo"></i></div>
        <div class="info">
          <div class="vCenter">
            <div class="vCenterKid">
              <span class="category">Photocall</span>
              <span class="date">20.05.16</span> . <span
                  class="hour">11:03</span>
              <p data-title="Elle Fanning - The Neon Demon">Elle Fanning - The Neon Demon</p>
            </div>
          </div>
        </div>
      </div>
      <div class="item conference-de-presse 20-05-16 shadow-bottom photo paysage notloaded">
        <a id="photo1643" class="ajax chocolat-image" data-pid="1643"
           href="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/06/8ed72298509dce3aa56914803bfd2a8caab40f88.jpg"
           title='<span class="category">Conférence de Presse</span><span class="date">20.05.16 . 11:00</span><h2>Équipe du film - The Neon Demon</h2>'
           data-credit="Crédit Image : Cyril Duchêne / FDC"></a>
        <img data-original="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/06/thumb_5857_media_image_640x404.jpg"  alt="" title="Équipe du film - The Neon Demon" class="lazy">
        <div class="picto"><i class="icon icon_photo"></i></div>
        <div class="info">
          <div class="vCenter">
            <div class="vCenterKid">
              <span class="category">Conférence de Presse</span>
              <span class="date">20.05.16</span> . <span
                  class="hour">11:00</span>
              <p data-title="Équipe du film - The Neon Demon">Équipe du film - The Neon Demon</p>
            </div>
          </div>
        </div>
      </div>
      <div class="item photocall 20-05-16 shadow-bottom photo paysage notloaded">
        <a id="photo1640" class="ajax chocolat-image" data-pid="1640"
           href="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/06/db178240189eae431ec93d3c68ec5e267df6211c.jpg"
           title='<span class="category">Photocall</span><span class="date">20.05.16 . 10:41</span><h2>Francisco Marquez et Andrea Testa - La Larga Noche de Francisco Sanctis (La longue nuit de Francisco Sanctis)</h2>'
           data-credit="Crédit Image : Thomas Leibreich / FDC"></a>
        <img data-original="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/06/thumb_5854_media_image_640x404.jpg"  alt="" title="Francisco Marquez et Andrea Testa - La Larga Noche de Francisco Sanctis (La longue nuit de Francisco Sanctis)" class="lazy">
        <div class="picto"><i class="icon icon_photo"></i></div>
        <div class="info">
          <div class="vCenter">
            <div class="vCenterKid">
              <span class="category">Photocall</span>
              <span class="date">20.05.16</span> . <span
                  class="hour">10:41</span>
              <p data-title="Francisco Marquez et Andrea Testa - La Larga Noche de Francisco Sanctis (La longue nuit de Francisco Sanctis)">Francisco Marquez et Andrea Testa - La Larga Noche de Francisco Sanctis (La longue nuit de Francisco Sanctis)</p>
            </div>
          </div>
        </div>
      </div>
      <div class="item photocall 20-05-16 shadow-bottom photo paysage notloaded">
        <a id="photo1638" class="ajax chocolat-image" data-pid="1638"
           href="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/06/bfa2a6bf89b10854550aae089761d7a551c78fbd.jpg"
           title='<span class="category">Photocall</span><span class="date">20.05.16 . 10:40</span><h2>Équipe du film -  La Larga Noche de Francisco Sanctis (La longue nuit de Francisco Sanctis)</h2>'
           data-credit="Crédit Image : Thomas Leibreich / FDC"></a>
        <img data-original="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/06/thumb_5852_media_image_640x404.jpg"  alt="" title="Équipe du film -  La Larga Noche de Francisco Sanctis (La longue nuit de Francisco Sanctis)" class="lazy">
        <div class="picto"><i class="icon icon_photo"></i></div>
        <div class="info">
          <div class="vCenter">
            <div class="vCenterKid">
              <span class="category">Photocall</span>
              <span class="date">20.05.16</span> . <span
                  class="hour">10:40</span>
              <p data-title="Équipe du film -  La Larga Noche de Francisco Sanctis (La longue nuit de Francisco Sanctis)">Équipe du film -  La Larga Noche de Francisco Sanctis (La longue nuit de Francisco Sanctis)</p>
            </div>
          </div>
        </div>
      </div>
      <div class="item photocall 20-05-16 shadow-bottom photo paysage notloaded">
        <a id="photo1641" class="ajax chocolat-image" data-pid="1641"
           href="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/06/466c294fadd3b8abb8ef5ebf07eac0cbc018739c.jpg"
           title='<span class="category">Photocall</span><span class="date">20.05.16 . 10:38</span><h2>Karl Glusman - The Neon Demon</h2>'
           data-credit="Crédit Image : Cyril Duchêne / FDC"></a>
        <img data-original="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/06/thumb_5855_media_image_640x404.jpg"  alt="" title="Karl Glusman - The Neon Demon" class="lazy">
        <div class="picto"><i class="icon icon_photo"></i></div>
        <div class="info">
          <div class="vCenter">
            <div class="vCenterKid">
              <span class="category">Photocall</span>
              <span class="date">20.05.16</span> . <span
                  class="hour">10:38</span>
              <p data-title="Karl Glusman - The Neon Demon">Karl Glusman - The Neon Demon</p>
            </div>
          </div>
        </div>
      </div>
      <div class="item photocall 20-05-16 shadow-bottom photo paysage notloaded">
        <a id="photo1637" class="ajax chocolat-image" data-pid="1637"
           href="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/06/f27990a134a0d65a07ed6b9e59ae3ffdc9c426d1.jpg"
           title='<span class="category">Photocall</span><span class="date">20.05.16 . 10:37</span><h2>Diego Velasquez - La Larga Noche de Francisco Sanctis (La longue nuit de Francisco Sanctis)</h2>'
           data-credit="Crédit Image : Thomas Leibreich / FDC"></a>
        <img data-original="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/06/thumb_5851_media_image_640x404.jpg"  alt="" title="Diego Velasquez - La Larga Noche de Francisco Sanctis (La longue nuit de Francisco Sanctis)" class="lazy">
        <div class="picto"><i class="icon icon_photo"></i></div>
        <div class="info">
          <div class="vCenter">
            <div class="vCenterKid">
              <span class="category">Photocall</span>
              <span class="date">20.05.16</span> . <span
                  class="hour">10:37</span>
              <p data-title="Diego Velasquez - La Larga Noche de Francisco Sanctis (La longue nuit de Francisco Sanctis)">Diego Velasquez - La Larga Noche de Francisco Sanctis (La longue nuit de Francisco Sanctis)</p>
            </div>
          </div>
        </div>
      </div>
      <div class="item photocall 20-05-16 shadow-bottom photo paysage notloaded">
        <a id="photo1634" class="ajax chocolat-image" data-pid="1634"
           href="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/06/c3ff90ddd84d8ac5907cd7a711fb5e6388e887cd.jpg"
           title='<span class="category">Photocall</span><span class="date">20.05.16 . 10:35</span><h2>Bella Heathcote - The Neon Demon</h2>'
           data-credit="Crédit Image : Anne-Christine Poujoulat / AFP"></a>
        <img data-original="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/06/thumb_5848_media_image_640x404.jpg"  alt="" title="Bella Heathcote - The Neon Demon" class="lazy">
        <div class="picto"><i class="icon icon_photo"></i></div>
        <div class="info">
          <div class="vCenter">
            <div class="vCenterKid">
              <span class="category">Photocall</span>
              <span class="date">20.05.16</span> . <span
                  class="hour">10:35</span>
              <p data-title="Bella Heathcote - The Neon Demon">Bella Heathcote - The Neon Demon</p>
            </div>
          </div>
        </div>
      </div>
      <div class="item photocall 20-05-16 shadow-bottom photo paysage notloaded">
        <a id="photo1631" class="ajax chocolat-image" data-pid="1631"
           href="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/06/a82a41a75c46e3f169b4269bc8f7c31eb1b67fdc.jpg"
           title='<span class="category">Photocall</span><span class="date">20.05.16 . 10:33</span><h2>Elle Fanning et Nicolas Winding Refn - The Neon Demon</h2>'
           data-credit="Crédit Image : Thomas Leibreich / FDC"></a>
        <img data-original="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/06/thumb_5846_media_image_640x404.jpg"  alt="" title="Elle Fanning et Nicolas Winding Refn - The Neon Demon" class="lazy">
        <div class="picto"><i class="icon icon_photo"></i></div>
        <div class="info">
          <div class="vCenter">
            <div class="vCenterKid">
              <span class="category">Photocall</span>
              <span class="date">20.05.16</span> . <span
                  class="hour">10:33</span>
              <p data-title="Elle Fanning et Nicolas Winding Refn - The Neon Demon">Elle Fanning et Nicolas Winding Refn - The Neon Demon</p>
            </div>
          </div>
        </div>
      </div>
      <div class="item photocall 20-05-16 shadow-bottom photo paysage notloaded">
        <a id="photo1630" class="ajax chocolat-image" data-pid="1630"
           href="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/06/d745bcd3fd430319607d93641752d879d7d5c3f4.jpg"
           title='<span class="category">Photocall</span><span class="date">20.05.16 . 10:30</span><h2>Équipe du film - The Neon Demon</h2>'
           data-credit="Crédit Image : Thomas Leibreich / FDC"></a>
        <img data-original="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/06/thumb_5845_media_image_640x404.jpg"  alt="" title="Équipe du film - The Neon Demon" class="lazy">
        <div class="picto"><i class="icon icon_photo"></i></div>
        <div class="info">
          <div class="vCenter">
            <div class="vCenterKid">
              <span class="category">Photocall</span>
              <span class="date">20.05.16</span> . <span
                  class="hour">10:30</span>
              <p data-title="Équipe du film - The Neon Demon">Équipe du film - The Neon Demon</p>
            </div>
          </div>
        </div>
      </div>
      <div class="item oeil-du-photographe 20-05-16 shadow-bottom photo portrait notloaded">
        <a id="photo1586" class="ajax chocolat-image" data-pid="1586"
           href="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/06/bbcaa20df75946e63221898f099f0f77cf2f5ce5.jpg"
           title='<span class="category">Œil du photographe</span><span class="date">20.05.16 . 08:32</span><h2>Gaspard Ulliel encadré de lumière. Club Albane. Cannes 2016</h2>'
           data-credit="Crédit Image : Thomas Laisné / Getty Images"></a>
        <img data-original="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/06/thumb_5810_media_image_320x404.jpg"  alt="" title="Gaspard Ulliel encadré de lumière. Club Albane. Cannes 2016" class="lazy">
        <div class="picto"><i class="icon icon_photo"></i></div>
        <div class="info">
          <div class="vCenter">
            <div class="vCenterKid">
              <span class="category">Œil du photographe</span>
              <span class="date">20.05.16</span> . <span
                  class="hour">08:32</span>
              <p data-title="Gaspard Ulliel encadré de lumière. Club Albane. Cannes 2016">Gaspard Ulliel encadré de lumière. Club Albane. Cannes 2016</p>
            </div>
          </div>
        </div>
      </div>
      <div class="item oeil-du-photographe 20-05-16 shadow-bottom photo portrait notloaded">
        <a id="photo1587" class="ajax chocolat-image" data-pid="1587"
           href="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/06/40d26dc6bbf5a2df9df68f6245105d3687e8c2e0.jpg"
           title='<span class="category">Œil du photographe</span><span class="date">20.05.16 . 08:32</span><h2>Instant singulier issu de l&#039;ombre avec la magnifique Adriana Ugarte. Cannes 2016.</h2>'
           data-credit="Crédit Image : Thomas Laisné / Getty Images"></a>
        <img data-original="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/06/thumb_5811_media_image_320x404.jpg"  alt="" title="Instant singulier issu de l&#039;ombre avec la magnifique Adriana Ugarte. Cannes 2016." class="lazy">
        <div class="picto"><i class="icon icon_photo"></i></div>
        <div class="info">
          <div class="vCenter">
            <div class="vCenterKid">
              <span class="category">Œil du photographe</span>
              <span class="date">20.05.16</span> . <span
                  class="hour">08:32</span>
              <p data-title="Instant singulier issu de l&#039;ombre avec la magnifique Adriana Ugarte. Cannes 2016.">Instant singulier issu de l&#039;ombre avec la magnifique Adriana Ugarte. Cannes 2016.</p>
            </div>
          </div>
        </div>
      </div>
      <div class="item oeil-du-photographe 20-05-16 shadow-bottom photo portrait notloaded">
        <a id="photo1588" class="ajax chocolat-image" data-pid="1588"
           href="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/06/9ea06cc1980deabd5f700125573a87eacb6a2425.jpg"
           title='<span class="category">Œil du photographe</span><span class="date">20.05.16 . 08:32</span><h2>Thomas Scimeca parmi une centaine de personnes photographiées avec un Leica s007 sur la Terrasse Unifrance. Cannes 2016.</h2>'
           data-credit="Crédit Image : Thomas Laisné / Getty Images"></a>
        <img data-original="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/06/thumb_5812_media_image_320x404.jpg"  alt="" title="Thomas Scimeca parmi une centaine de personnes photographiées avec un Leica s007 sur la Terrasse Unifrance. Cannes 2016." class="lazy">
        <div class="picto"><i class="icon icon_photo"></i></div>
        <div class="info">
          <div class="vCenter">
            <div class="vCenterKid">
              <span class="category">Œil du photographe</span>
              <span class="date">20.05.16</span> . <span
                  class="hour">08:32</span>
              <p data-title="Thomas Scimeca parmi une centaine de personnes photographiées avec un Leica s007 sur la Terrasse Unifrance. Cannes 2016.">Thomas Scimeca parmi une centaine de personnes photographiées avec un Leica s007 sur la Terrasse Unifrance. Cannes 2016.</p>
            </div>
          </div>
        </div>
      </div>
      <div class="item oeil-du-photographe 20-05-16 shadow-bottom photo portrait notloaded">
        <a id="photo1589" class="ajax chocolat-image" data-pid="1589"
           href="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/06/a4303c49a0fe31fa90be58efb624799f9953d1cd.jpg"
           title='<span class="category">Œil du photographe</span><span class="date">20.05.16 . 08:32</span><h2>Rithy Panh et demi. Terrasse du Festival, Cannes 2016</h2>'
           data-credit="Crédit Image : Thomas Laisné / Getty Images"></a>
        <img data-original="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/06/thumb_5813_media_image_320x404.jpg"  alt="" title="Rithy Panh et demi. Terrasse du Festival, Cannes 2016" class="lazy">
        <div class="picto"><i class="icon icon_photo"></i></div>
        <div class="info">
          <div class="vCenter">
            <div class="vCenterKid">
              <span class="category">Œil du photographe</span>
              <span class="date">20.05.16</span> . <span
                  class="hour">08:32</span>
              <p data-title="Rithy Panh et demi. Terrasse du Festival, Cannes 2016">Rithy Panh et demi. Terrasse du Festival, Cannes 2016</p>
            </div>
          </div>
        </div>
      </div>
      <div class="item montee-des-marches 19-05-16 shadow-bottom photo paysage notloaded">
        <a id="photo1618" class="ajax chocolat-image" data-pid="1618"
           href="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/06/6b4f636fa33db956f21c2ee2e1f139a5a2ffda84.jpg"
           title='<span class="category">Montée des Marches</span><span class="date">19.05.16 . 23:40</span><h2>Jim Jarmusch et Iggy Pop - Gimme Danger</h2>'
           data-credit="Crédit Image : Cyril Duchêne / FDC"></a>
        <img data-original="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/06/thumb_5837_media_image_640x404.jpg"  alt="" title="Jim Jarmusch et Iggy Pop - Gimme Danger" class="lazy">
        <div class="picto"><i class="icon icon_photo"></i></div>
        <div class="info">
          <div class="vCenter">
            <div class="vCenterKid">
              <span class="category">Montée des Marches</span>
              <span class="date">19.05.16</span> . <span
                  class="hour">23:40</span>
              <p data-title="Jim Jarmusch et Iggy Pop - Gimme Danger">Jim Jarmusch et Iggy Pop - Gimme Danger</p>
            </div>
          </div>
        </div>
      </div>
      <div class="item sur-scene 19-05-16 shadow-bottom photo paysage notloaded">
        <a id="photo1616" class="ajax chocolat-image" data-pid="1616"
           href="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/06/5d91f708d78dd05d7542d9b5a50c2850fc516a53.jpg"
           title='<span class="category">Sur Scène</span><span class="date">19.05.16 . 23:36</span><h2>Uma Thurman</h2>'
           data-credit="Crédit Image : Alberto Pizzoli / AFP"></a>
        <img data-original="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/06/thumb_5835_media_image_640x404.jpg"  alt="" title="Uma Thurman" class="lazy">
        <div class="picto"><i class="icon icon_photo"></i></div>
        <div class="info">
          <div class="vCenter">
            <div class="vCenterKid">
              <span class="category">Sur Scène</span>
              <span class="date">19.05.16</span> . <span
                  class="hour">23:36</span>
              <p data-title="Uma Thurman">Uma Thurman</p>
            </div>
          </div>
        </div>
      </div>
      <div class="item sur-scene 19-05-16 shadow-bottom photo paysage notloaded">
        <a id="photo1615" class="ajax chocolat-image" data-pid="1615"
           href="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/06/04195ba4e94f9d6a34306334c756d6a69c1c0bb5.jpg"
           title='<span class="category">Sur Scène</span><span class="date">19.05.16 . 23:31</span><h2>Kevin Spacey et Faye Dunaway</h2>'
           data-credit="Crédit Image : Alberto Pizzoli / AFP"></a>
        <img data-original="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/06/thumb_5834_media_image_640x404.jpg"  alt="" title="Kevin Spacey et Faye Dunaway" class="lazy">
        <div class="picto"><i class="icon icon_photo"></i></div>
        <div class="info">
          <div class="vCenter">
            <div class="vCenterKid">
              <span class="category">Sur Scène</span>
              <span class="date">19.05.16</span> . <span
                  class="hour">23:31</span>
              <p data-title="Kevin Spacey et Faye Dunaway">Kevin Spacey et Faye Dunaway</p>
            </div>
          </div>
        </div>
      </div>
      <div class="item montee-des-marches 19-05-16 shadow-bottom photo paysage notloaded">
        <a id="photo1617" class="ajax chocolat-image" data-pid="1617"
           href="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/06/abb9efea04ed3c81ff9dee05ceb1b230b3d65493.jpg"
           title='<span class="category">Montée des Marches</span><span class="date">19.05.16 . 23:30</span><h2>Iggy Pop et Jim Jarmusch - Gimme Danger</h2>'
           data-credit="Crédit Image : Cyril Duchêne / FDC"></a>
        <img data-original="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/06/thumb_5836_media_image_640x404.jpg"  alt="" title="Iggy Pop et Jim Jarmusch - Gimme Danger" class="lazy">
        <div class="picto"><i class="icon icon_photo"></i></div>
        <div class="info">
          <div class="vCenter">
            <div class="vCenterKid">
              <span class="category">Montée des Marches</span>
              <span class="date">19.05.16</span> . <span
                  class="hour">23:30</span>
              <p data-title="Iggy Pop et Jim Jarmusch - Gimme Danger">Iggy Pop et Jim Jarmusch - Gimme Danger</p>
            </div>
          </div>
        </div>
      </div>
      <div class="item sur-scene 19-05-16 shadow-bottom photo paysage notloaded">
        <a id="photo1625" class="ajax chocolat-image" data-pid="1625"
           href="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/06/97c6fcb25675db560038373640f97986d2bff7cf.jpg"
           title='<span class="category">Sur Scène</span><span class="date">19.05.16 . 23:10</span><h2>Anahid Nazarian et Michele Russo - The Family Whistle (Le Sifflet de la Famille)</h2>'
           data-credit="Crédit Image : Thomas Leibreich / FDC"></a>
        <img data-original="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/06/thumb_5841_media_image_640x404.jpg"  alt="" title="Anahid Nazarian et Michele Russo - The Family Whistle (Le Sifflet de la Famille)" class="lazy">
        <div class="picto"><i class="icon icon_photo"></i></div>
        <div class="info">
          <div class="vCenter">
            <div class="vCenterKid">
              <span class="category">Sur Scène</span>
              <span class="date">19.05.16</span> . <span
                  class="hour">23:10</span>
              <p data-title="Anahid Nazarian et Michele Russo - The Family Whistle (Le Sifflet de la Famille)">Anahid Nazarian et Michele Russo - The Family Whistle (Le Sifflet de la Famille)</p>
            </div>
          </div>
        </div>
      </div>
      <div class="item sur-scene 19-05-16 shadow-bottom photo paysage notloaded">
        <a id="photo1622" class="ajax chocolat-image" data-pid="1622"
           href="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/06/52dc273d930ffea737a58a5dd20f2753272e29b8.jpg"
           title='<span class="category">Sur Scène</span><span class="date">19.05.16 . 23:00</span><h2>Anahid Nazarian et Michele Russo - The Family Whistle (Le Sifflet de la Famille)</h2>'
           data-credit="Crédit Image : Thomas Leibreich / FDC"></a>
        <img data-original="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/06/thumb_5840_media_image_640x404.jpg"  alt="" title="Anahid Nazarian et Michele Russo - The Family Whistle (Le Sifflet de la Famille)" class="lazy">
        <div class="picto"><i class="icon icon_photo"></i></div>
        <div class="info">
          <div class="vCenter">
            <div class="vCenterKid">
              <span class="category">Sur Scène</span>
              <span class="date">19.05.16</span> . <span
                  class="hour">23:00</span>
              <p data-title="Anahid Nazarian et Michele Russo - The Family Whistle (Le Sifflet de la Famille)">Anahid Nazarian et Michele Russo - The Family Whistle (Le Sifflet de la Famille)</p>
            </div>
          </div>
        </div>
      </div>
      <div class="item sur-scene 19-05-16 shadow-bottom photo paysage notloaded">
        <a id="photo1610" class="ajax chocolat-image" data-pid="1610"
           href="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/06/50b1e7e4510039773cca1823c5dbdcfe6bf530b6.jpg"
           title='<span class="category">Sur Scène</span><span class="date">19.05.16 . 22:17</span><h2>Équipe du film - Pericle il nero (Pericle)</h2>'
           data-credit="Crédit Image : Cyril Duchêne / FDC"></a>
        <img data-original="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/06/thumb_5831_media_image_640x404.jpg"  alt="" title="Équipe du film - Pericle il nero (Pericle)" class="lazy">
        <div class="picto"><i class="icon icon_photo"></i></div>
        <div class="info">
          <div class="vCenter">
            <div class="vCenterKid">
              <span class="category">Sur Scène</span>
              <span class="date">19.05.16</span> . <span
                  class="hour">22:17</span>
              <p data-title="Équipe du film - Pericle il nero (Pericle)">Équipe du film - Pericle il nero (Pericle)</p>
            </div>
          </div>
        </div>
      </div>
      <div class="item sur-scene 19-05-16 shadow-bottom photo paysage notloaded">
        <a id="photo1607" class="ajax chocolat-image" data-pid="1607"
           href="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/06/31e63ee8f647a121348461ab245ddc980240f035.jpg"
           title='<span class="category">Sur Scène</span><span class="date">19.05.16 . 22:15</span><h2>Valeria Golino - Membre du Jury des Longs Métrages</h2>'
           data-credit="Crédit Image : Cyril Duchêne / FDC"></a>
        <img data-original="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/06/thumb_5827_media_image_640x404.jpg"  alt="" title="Valeria Golino - Membre du Jury des Longs Métrages" class="lazy">
        <div class="picto"><i class="icon icon_photo"></i></div>
        <div class="info">
          <div class="vCenter">
            <div class="vCenterKid">
              <span class="category">Sur Scène</span>
              <span class="date">19.05.16</span> . <span
                  class="hour">22:15</span>
              <p data-title="Valeria Golino - Membre du Jury des Longs Métrages">Valeria Golino - Membre du Jury des Longs Métrages</p>
            </div>
          </div>
        </div>
      </div>
      <div class="item montee-des-marches 19-05-16 shadow-bottom photo paysage notloaded">
        <a id="photo1595" class="ajax chocolat-image" data-pid="1595"
           href="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/06/a1ade08e08ecfc4503cf46bba7e45d9be2e2e408.jpg"
           title='<span class="category">Montée des Marches</span><span class="date">19.05.16 . 21:38</span><h2>Guillaume Canet</h2>'
           data-credit="Crédit Image : Anne-Christine Poujoulat / AFP"></a>
        <img data-original="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/06/thumb_5819_media_image_640x404.jpg"  alt="" title="Guillaume Canet" class="lazy">
        <div class="picto"><i class="icon icon_photo"></i></div>
        <div class="info">
          <div class="vCenter">
            <div class="vCenterKid">
              <span class="category">Montée des Marches</span>
              <span class="date">19.05.16</span> . <span
                  class="hour">21:38</span>
              <p data-title="Guillaume Canet">Guillaume Canet</p>
            </div>
          </div>
        </div>
      </div>
      <div class="item montee-des-marches 19-05-16 shadow-bottom photo paysage notloaded">
        <a id="photo1599" class="ajax chocolat-image" data-pid="1599"
           href="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/06/7a9767ec5fc0edfd53f7afae834da66d8228ebf8.jpg"
           title='<span class="category">Montée des Marches</span><span class="date">19.05.16 . 21:32</span><h2>Équipe du film - Juste la fin du monde</h2>'
           data-credit="Crédit Image : Valéry Hache / AFP"></a>
        <img data-original="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/06/thumb_5821_media_image_640x404.jpg"  alt="" title="Équipe du film - Juste la fin du monde" class="lazy">
        <div class="picto"><i class="icon icon_photo"></i></div>
        <div class="info">
          <div class="vCenter">
            <div class="vCenterKid">
              <span class="category">Montée des Marches</span>
              <span class="date">19.05.16</span> . <span
                  class="hour">21:32</span>
              <p data-title="Équipe du film - Juste la fin du monde">Équipe du film - Juste la fin du monde</p>
            </div>
          </div>
        </div>
      </div>
      <div class="item montee-des-marches 19-05-16 shadow-bottom photo paysage notloaded">
        <a id="photo1597" class="ajax chocolat-image" data-pid="1597"
           href="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/06/05fc38a5b6d95ec0e3ff1221edf54b3bc179bc71.jpg"
           title='<span class="category">Montée des Marches</span><span class="date">19.05.16 . 21:30</span><h2>Nathalie Baye, Marion Cotillard, Xavier Dolan et Lea Seydoux - Juste la fin du monde</h2>'
           data-credit="Crédit Image : Loïc Venance / AFP"></a>
        <img data-original="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/06/thumb_5820_media_image_640x404.jpg"  alt="" title="Nathalie Baye, Marion Cotillard, Xavier Dolan et Lea Seydoux - Juste la fin du monde" class="lazy">
        <div class="picto"><i class="icon icon_photo"></i></div>
        <div class="info">
          <div class="vCenter">
            <div class="vCenterKid">
              <span class="category">Montée des Marches</span>
              <span class="date">19.05.16</span> . <span
                  class="hour">21:30</span>
              <p data-title="Nathalie Baye, Marion Cotillard, Xavier Dolan et Lea Seydoux - Juste la fin du monde">Nathalie Baye, Marion Cotillard, Xavier Dolan et Lea Seydoux - Juste la fin du monde</p>
            </div>
          </div>
        </div>
      </div>
      <div class="item montee-des-marches 19-05-16 shadow-bottom photo paysage notloaded">
        <a id="photo1594" class="ajax chocolat-image" data-pid="1594"
           href="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/06/664fe64c795c52b4e01662afe36cf7fdad8d627f.jpg"
           title='<span class="category">Montée des Marches</span><span class="date">19.05.16 . 21:22</span><h2>Viola Prestieri, Riccardo Scamarcio, Marina Foïs et Stefano Mordini - Pericle il nero (Pericle)</h2>'
           data-credit="Crédit Image : Anne-Christine Poujoulat / AFP"></a>
        <img data-original="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/06/thumb_5818_media_image_640x404.jpg"  alt="" title="Viola Prestieri, Riccardo Scamarcio, Marina Foïs et Stefano Mordini - Pericle il nero (Pericle)" class="lazy">
        <div class="picto"><i class="icon icon_photo"></i></div>
        <div class="info">
          <div class="vCenter">
            <div class="vCenterKid">
              <span class="category">Montée des Marches</span>
              <span class="date">19.05.16</span> . <span
                  class="hour">21:22</span>
              <p data-title="Viola Prestieri, Riccardo Scamarcio, Marina Foïs et Stefano Mordini - Pericle il nero (Pericle)">Viola Prestieri, Riccardo Scamarcio, Marina Foïs et Stefano Mordini - Pericle il nero (Pericle)</p>
            </div>
          </div>
        </div>
      </div>
      <div class="item montee-des-marches 19-05-16 shadow-bottom photo paysage notloaded">
        <a id="photo1593" class="ajax chocolat-image" data-pid="1593"
           href="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/06/82fafa9fcb12985537f3ea90cedfcc1a85ae56c7.jpg"
           title='<span class="category">Montée des Marches</span><span class="date">19.05.16 . 21:20</span><h2>Équipe du film - Pericle il nero (Pericle)</h2>'
           data-credit="Crédit Image : Anne-Christine Poujoulat / AFP"></a>
        <img data-original="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/06/thumb_5817_media_image_640x404.jpg"  alt="" title="Équipe du film - Pericle il nero (Pericle)" class="lazy">
        <div class="picto"><i class="icon icon_photo"></i></div>
        <div class="info">
          <div class="vCenter">
            <div class="vCenterKid">
              <span class="category">Montée des Marches</span>
              <span class="date">19.05.16</span> . <span
                  class="hour">21:20</span>
              <p data-title="Équipe du film - Pericle il nero (Pericle)">Équipe du film - Pericle il nero (Pericle)</p>
            </div>
          </div>
        </div>
      </div>
      <div class="item montee-des-marches 19-05-16 shadow-bottom photo portrait notloaded">
        <a id="photo1592" class="ajax chocolat-image" data-pid="1592"
           href="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/06/6ee05dcd6478290d8fc71c51fc60387018c1c0cb.jpg"
           title='<span class="category">Montée des Marches</span><span class="date">19.05.16 . 21:18</span><h2>Valeria Golino et Stefano Mordini - Pericle il Nero (Pericle)</h2>'
           data-credit="Crédit Image : Loïc Venance / AFP"></a>
        <img data-original="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/06/thumb_5816_media_image_320x404.jpg"  alt="" title="Valeria Golino et Stefano Mordini - Pericle il Nero (Pericle)" class="lazy">
        <div class="picto"><i class="icon icon_photo"></i></div>
        <div class="info">
          <div class="vCenter">
            <div class="vCenterKid">
              <span class="category">Montée des Marches</span>
              <span class="date">19.05.16</span> . <span
                  class="hour">21:18</span>
              <p data-title="Valeria Golino et Stefano Mordini - Pericle il Nero (Pericle)">Valeria Golino et Stefano Mordini - Pericle il Nero (Pericle)</p>
            </div>
          </div>
        </div>
      </div>
      <div class="item montee-des-marches 19-05-16 shadow-bottom photo paysage notloaded">
        <a id="photo1591" class="ajax chocolat-image" data-pid="1591"
           href="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/06/7e11f215a733757a6656a79f3d9c2e0b1302f33e.jpg"
           title='<span class="category">Montée des Marches</span><span class="date">19.05.16 . 21:15</span><h2>Emmanuelle Béart</h2>'
           data-credit="Crédit Image : Loïc Venance / AFP"></a>
        <img data-original="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/06/thumb_5815_media_image_640x404.jpg"  alt="" title="Emmanuelle Béart" class="lazy">
        <div class="picto"><i class="icon icon_photo"></i></div>
        <div class="info">
          <div class="vCenter">
            <div class="vCenterKid">
              <span class="category">Montée des Marches</span>
              <span class="date">19.05.16</span> . <span
                  class="hour">21:15</span>
              <p data-title="Emmanuelle Béart">Emmanuelle Béart</p>
            </div>
          </div>
        </div>
      </div>
      <div class="item sur-scene 19-05-16 shadow-bottom photo paysage notloaded">
        <a id="photo1604" class="ajax chocolat-image" data-pid="1604"
           href="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/06/fa1e086c7795ba77256e5c28341b9970a96effa9.jpg"
           title='<span class="category">Sur Scène</span><span class="date">19.05.16 . 20:05</span><h2>Willem Dafoe et William Friedkin - To Live and Die in L.A. (Police Fédérale L.A.)</h2>'
           data-credit="Crédit Image : Mathilde Petit / FDC"></a>
        <img data-original="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/06/thumb_5825_media_image_640x404.jpg"  alt="" title="Willem Dafoe et William Friedkin - To Live and Die in L.A. (Police Fédérale L.A.)" class="lazy">
        <div class="picto"><i class="icon icon_photo"></i></div>
        <div class="info">
          <div class="vCenter">
            <div class="vCenterKid">
              <span class="category">Sur Scène</span>
              <span class="date">19.05.16</span> . <span
                  class="hour">20:05</span>
              <p data-title="Willem Dafoe et William Friedkin - To Live and Die in L.A. (Police Fédérale L.A.)">Willem Dafoe et William Friedkin - To Live and Die in L.A. (Police Fédérale L.A.)</p>
            </div>
          </div>
        </div>
      </div>
      <div class="item montee-des-marches 19-05-16 shadow-bottom photo paysage notloaded">
        <a id="photo1585" class="ajax chocolat-image" data-pid="1585"
           href="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/06/98a9c8588bef0c55ea96c413ff0a98b2a79aabdd.jpg"
           title='<span class="category">Montée des Marches</span><span class="date">19.05.16 . 19:00</span><h2>William Friedkin -To Live and Die in L.A (Police Fédérale L.A)</h2>'
           data-credit="Crédit Image : Mathilde Petit / FDC"></a>
        <img data-original="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/06/thumb_5809_media_image_640x404.jpg"  alt="" title="William Friedkin -To Live and Die in L.A (Police Fédérale L.A)" class="lazy">
        <div class="picto"><i class="icon icon_photo"></i></div>
        <div class="info">
          <div class="vCenter">
            <div class="vCenterKid">
              <span class="category">Montée des Marches</span>
              <span class="date">19.05.16</span> . <span
                  class="hour">19:00</span>
              <p data-title="William Friedkin -To Live and Die in L.A (Police Fédérale L.A)">William Friedkin -To Live and Die in L.A (Police Fédérale L.A)</p>
            </div>
          </div>
        </div>
      </div>
      <div class="item montee-des-marches 19-05-16 shadow-bottom photo paysage notloaded">
        <a id="photo1584" class="ajax chocolat-image" data-pid="1584"
           href="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/06/304d596e923c086962ce8ece818813cfec5d7ab6.jpg"
           title='<span class="category">Montée des Marches</span><span class="date">19.05.16 . 18:55</span><h2>Malina Manovici, Cristian Mungiu et Maria Dragus - Bacalaureat (Baccalauréat)</h2>'
           data-credit="Crédit Image : Loïc Venance / AFP"></a>
        <img data-original="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/06/thumb_5808_media_image_640x404.jpg"  alt="" title="Malina Manovici, Cristian Mungiu et Maria Dragus - Bacalaureat (Baccalauréat)" class="lazy">
        <div class="picto"><i class="icon icon_photo"></i></div>
        <div class="info">
          <div class="vCenter">
            <div class="vCenterKid">
              <span class="category">Montée des Marches</span>
              <span class="date">19.05.16</span> . <span
                  class="hour">18:55</span>
              <p data-title="Malina Manovici, Cristian Mungiu et Maria Dragus - Bacalaureat (Baccalauréat)">Malina Manovici, Cristian Mungiu et Maria Dragus - Bacalaureat (Baccalauréat)</p>
            </div>
          </div>
        </div>
      </div>
      <div class="item montee-des-marches 19-05-16 shadow-bottom photo paysage notloaded">
        <a id="photo1583" class="ajax chocolat-image" data-pid="1583"
           href="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/06/b921e1f8d909d7223cc8b949b4f9999b75414d47.jpg"
           title='<span class="category">Montée des Marches</span><span class="date">19.05.16 . 18:50</span><h2>Équipe du film - Bacalaureat (Baccalauréat)</h2>'
           data-credit="Crédit Image : Valéry Hache / AFP"></a>
        <img data-original="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/06/thumb_5807_media_image_640x404.jpg"  alt="" title="Équipe du film - Bacalaureat (Baccalauréat)" class="lazy">
        <div class="picto"><i class="icon icon_photo"></i></div>
        <div class="info">
          <div class="vCenter">
            <div class="vCenterKid">
              <span class="category">Montée des Marches</span>
              <span class="date">19.05.16</span> . <span
                  class="hour">18:50</span>
              <p data-title="Équipe du film - Bacalaureat (Baccalauréat)">Équipe du film - Bacalaureat (Baccalauréat)</p>
            </div>
          </div>
        </div>
      </div>
      <div class="item montee-des-marches 19-05-16 shadow-bottom photo paysage notloaded">
        <a id="photo1580" class="ajax chocolat-image" data-pid="1580"
           href="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/06/558d15e8a280985cadf60387417aed975a7b1993.jpg"
           title='<span class="category">Montée des Marches</span><span class="date">19.05.16 . 18:48</span><h2>Rares Andrici, Malina Manovici, Cristian Mungiu, Maria Dragus et Lia Bugnar - Bacalaureat (Baccalauréat)</h2>'
           data-credit="Crédit Image : Anne-Christine Poujoulat / AFP"></a>
        <img data-original="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/06/thumb_5805_media_image_640x404.jpg"  alt="" title="Rares Andrici, Malina Manovici, Cristian Mungiu, Maria Dragus et Lia Bugnar - Bacalaureat (Baccalauréat)" class="lazy">
        <div class="picto"><i class="icon icon_photo"></i></div>
        <div class="info">
          <div class="vCenter">
            <div class="vCenterKid">
              <span class="category">Montée des Marches</span>
              <span class="date">19.05.16</span> . <span
                  class="hour">18:48</span>
              <p data-title="Rares Andrici, Malina Manovici, Cristian Mungiu, Maria Dragus et Lia Bugnar - Bacalaureat (Baccalauréat)">Rares Andrici, Malina Manovici, Cristian Mungiu, Maria Dragus et Lia Bugnar - Bacalaureat (Baccalauréat)</p>
            </div>
          </div>
        </div>
      </div>
      <div class="item montee-des-marches 19-05-16 shadow-bottom photo paysage notloaded">
        <a id="photo1579" class="ajax chocolat-image" data-pid="1579"
           href="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/06/afd41b71cd7d5fcdcb1123ea0c247165b3607e54.jpg"
           title='<span class="category">Montée des Marches</span><span class="date">19.05.16 . 17:40</span><h2>Willem Dafoe - To Live and Die in L.A (Police Fédérale L.A)</h2>'
           data-credit="Crédit Image : Loïc Venance / AFP"></a>
        <img data-original="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/06/thumb_5804_media_image_640x404.jpg"  alt="" title="Willem Dafoe - To Live and Die in L.A (Police Fédérale L.A)" class="lazy">
        <div class="picto"><i class="icon icon_photo"></i></div>
        <div class="info">
          <div class="vCenter">
            <div class="vCenterKid">
              <span class="category">Montée des Marches</span>
              <span class="date">19.05.16</span> . <span
                  class="hour">17:40</span>
              <p data-title="Willem Dafoe - To Live and Die in L.A (Police Fédérale L.A)">Willem Dafoe - To Live and Die in L.A (Police Fédérale L.A)</p>
            </div>
          </div>
        </div>
      </div>
      <div class="item sur-scene 19-05-16 shadow-bottom photo paysage notloaded">
        <a id="photo1568" class="ajax chocolat-image" data-pid="1568"
           href="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/06/c1c3af16ae05381b9a852e2f20d3ae784c66ef87.jpg"
           title='<span class="category">Sur Scène</span><span class="date">19.05.16 . 16:37</span><h2>Équipe du film -  Hymylevä Miest (The Happiest Day in the Life of Olli Mäki)</h2>'
           data-credit="Crédit Image : Léo Laumont / FDC"></a>
        <img data-original="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/06/thumb_5798_media_image_640x404.jpg"  alt="" title="Équipe du film -  Hymylevä Miest (The Happiest Day in the Life of Olli Mäki)" class="lazy">
        <div class="picto"><i class="icon icon_photo"></i></div>
        <div class="info">
          <div class="vCenter">
            <div class="vCenterKid">
              <span class="category">Sur Scène</span>
              <span class="date">19.05.16</span> . <span
                  class="hour">16:37</span>
              <p data-title="Équipe du film -  Hymylevä Miest (The Happiest Day in the Life of Olli Mäki)">Équipe du film -  Hymylevä Miest (The Happiest Day in the Life of Olli Mäki)</p>
            </div>
          </div>
        </div>
      </div>
      <div class="item sur-scene 19-05-16 shadow-bottom photo portrait notloaded">
        <a id="photo1567" class="ajax chocolat-image" data-pid="1567"
           href="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/06/ec65dd6438cbaa8467549e93c5a654adcc98f9d5.jpg"
           title='<span class="category">Sur Scène</span><span class="date">19.05.16 . 16:35</span><h2>Juho Kuosmanen -  Hymylevä Miest (The Happiest Day in the Life of Olli Mäki)</h2>'
           data-credit="Crédit Image : Léo Laumont / FDC"></a>
        <img data-original="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/06/thumb_5797_media_image_320x404.jpg"  alt="" title="Juho Kuosmanen -  Hymylevä Miest (The Happiest Day in the Life of Olli Mäki)" class="lazy">
        <div class="picto"><i class="icon icon_photo"></i></div>
        <div class="info">
          <div class="vCenter">
            <div class="vCenterKid">
              <span class="category">Sur Scène</span>
              <span class="date">19.05.16</span> . <span
                  class="hour">16:35</span>
              <p data-title="Juho Kuosmanen -  Hymylevä Miest (The Happiest Day in the Life of Olli Mäki)">Juho Kuosmanen -  Hymylevä Miest (The Happiest Day in the Life of Olli Mäki)</p>
            </div>
          </div>
        </div>
      </div>
      <div class="item montee-des-marches 19-05-16 shadow-bottom photo paysage notloaded">
        <a id="photo1566" class="ajax chocolat-image" data-pid="1566"
           href="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/06/68a688a0011f78511840c25dd236d068e3c7f23d.jpg"
           title='<span class="category">Montée des Marches</span><span class="date">19.05.16 . 16:30</span><h2>Équipe du film -  Hymylevä Miest (The Happiest Day in the Life of Olli Mäki)</h2>'
           data-credit="Crédit Image : Léo Laumont / FDC"></a>
        <img data-original="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/06/thumb_5796_media_image_640x404.jpg"  alt="" title="Équipe du film -  Hymylevä Miest (The Happiest Day in the Life of Olli Mäki)" class="lazy">
        <div class="picto"><i class="icon icon_photo"></i></div>
        <div class="info">
          <div class="vCenter">
            <div class="vCenterKid">
              <span class="category">Montée des Marches</span>
              <span class="date">19.05.16</span> . <span
                  class="hour">16:30</span>
              <p data-title="Équipe du film -  Hymylevä Miest (The Happiest Day in the Life of Olli Mäki)">Équipe du film -  Hymylevä Miest (The Happiest Day in the Life of Olli Mäki)</p>
            </div>
          </div>
        </div>
      </div>
      <div class="item conference-de-presse 19-05-16 shadow-bottom photo paysage notloaded">
        <a id="photo1542" class="ajax chocolat-image" data-pid="1542"
           href="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/06/67aa4fceeeae64211ea2f16c2176805c55b133b2.jpg"
           title='<span class="category">Conférence de Presse</span><span class="date">19.05.16 . 14:47</span><h2>Équipe du film - Gimme Danger</h2>'
           data-credit="Crédit Image : Léo Laumont / FDC"></a>
        <img data-original="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/06/thumb_5789_media_image_640x404.jpg"  alt="" title="Équipe du film - Gimme Danger" class="lazy">
        <div class="picto"><i class="icon icon_photo"></i></div>
        <div class="info">
          <div class="vCenter">
            <div class="vCenterKid">
              <span class="category">Conférence de Presse</span>
              <span class="date">19.05.16</span> . <span
                  class="hour">14:47</span>
              <p data-title="Équipe du film - Gimme Danger">Équipe du film - Gimme Danger</p>
            </div>
          </div>
        </div>
      </div>
      <div class="item conference-de-presse 19-05-16 shadow-bottom photo portrait notloaded">
        <a id="photo1557" class="ajax chocolat-image" data-pid="1557"
           href="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/06/a9d9ebeec94f883c054e8564ff15f7348dba9ae8.jpg"
           title='<span class="category">Conférence de Presse</span><span class="date">19.05.16 . 14:45</span><h2>Jim Jarmusch - Gimme Danger</h2>'
           data-credit="Crédit Image : Léo Laumont / FDC"></a>
        <img data-original="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/06/thumb_5788_media_image_320x404.jpg"  alt="" title="Jim Jarmusch - Gimme Danger" class="lazy">
        <div class="picto"><i class="icon icon_photo"></i></div>
        <div class="info">
          <div class="vCenter">
            <div class="vCenterKid">
              <span class="category">Conférence de Presse</span>
              <span class="date">19.05.16</span> . <span
                  class="hour">14:45</span>
              <p data-title="Jim Jarmusch - Gimme Danger">Jim Jarmusch - Gimme Danger</p>
            </div>
          </div>
        </div>
      </div>
      <div class="item photocall 19-05-16 shadow-bottom photo paysage notloaded">
        <a id="photo1548" class="ajax chocolat-image" data-pid="1548"
           href="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/06/f950651ecae5357656cbfc97b12a0055cb1c260c.jpg"
           title='<span class="category">Photocall</span><span class="date">19.05.16 . 14:10</span><h2>Oona Airola - Hymylevä Miest (The Happiest Day in the Life of Olli Mäki)</h2>'
           data-credit="Crédit Image : Mathilde Petit / FDC"></a>
        <img data-original="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/06/thumb_5781_media_image_640x404.jpg"  alt="" title="Oona Airola - Hymylevä Miest (The Happiest Day in the Life of Olli Mäki)" class="lazy">
        <div class="picto"><i class="icon icon_photo"></i></div>
        <div class="info">
          <div class="vCenter">
            <div class="vCenterKid">
              <span class="category">Photocall</span>
              <span class="date">19.05.16</span> . <span
                  class="hour">14:10</span>
              <p data-title="Oona Airola - Hymylevä Miest (The Happiest Day in the Life of Olli Mäki)">Oona Airola - Hymylevä Miest (The Happiest Day in the Life of Olli Mäki)</p>
            </div>
          </div>
        </div>
      </div>
      <div class="item photocall 19-05-16 shadow-bottom photo paysage notloaded">
        <a id="photo1547" class="ajax chocolat-image" data-pid="1547"
           href="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/06/51da707eaee027448a66e994a16db248de8e556c.jpg"
           title='<span class="category">Photocall</span><span class="date">19.05.16 . 14:08</span><h2>Juho Kuosmanen  - Hymylevä Miest (The Happiest Day in the Life of Olli Mäki)</h2>'
           data-credit="Crédit Image : Mathilde Petit / FDC"></a>
        <img data-original="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/06/thumb_5780_media_image_640x404.jpg"  alt="" title="Juho Kuosmanen  - Hymylevä Miest (The Happiest Day in the Life of Olli Mäki)" class="lazy">
        <div class="picto"><i class="icon icon_photo"></i></div>
        <div class="info">
          <div class="vCenter">
            <div class="vCenterKid">
              <span class="category">Photocall</span>
              <span class="date">19.05.16</span> . <span
                  class="hour">14:08</span>
              <p data-title="Juho Kuosmanen  - Hymylevä Miest (The Happiest Day in the Life of Olli Mäki)">Juho Kuosmanen  - Hymylevä Miest (The Happiest Day in the Life of Olli Mäki)</p>
            </div>
          </div>
        </div>
      </div>
      <div class="item photocall 19-05-16 shadow-bottom photo paysage notloaded">
        <a id="photo1546" class="ajax chocolat-image" data-pid="1546"
           href="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/06/8f0bd9a155d6ac1724b2ee24e326dfcc1d7d4a6b.jpg"
           title='<span class="category">Photocall</span><span class="date">19.05.16 . 14:06</span><h2>Jarkko Lahti Oona Airola, Juho Kuosmanen et Eero Milonoff - Hymylevä Miest (The Happiest Day in the Life of Olli Mäki)</h2>'
           data-credit="Crédit Image : Mathilde Petit / FDC"></a>
        <img data-original="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/06/thumb_5779_media_image_640x404.jpg"  alt="" title="Jarkko Lahti Oona Airola, Juho Kuosmanen et Eero Milonoff - Hymylevä Miest (The Happiest Day in the Life of Olli Mäki)" class="lazy">
        <div class="picto"><i class="icon icon_photo"></i></div>
        <div class="info">
          <div class="vCenter">
            <div class="vCenterKid">
              <span class="category">Photocall</span>
              <span class="date">19.05.16</span> . <span
                  class="hour">14:06</span>
              <p data-title="Jarkko Lahti Oona Airola, Juho Kuosmanen et Eero Milonoff - Hymylevä Miest (The Happiest Day in the Life of Olli Mäki)">Jarkko Lahti Oona Airola, Juho Kuosmanen et Eero Milonoff - Hymylevä Miest (The Happiest Day in the Life of Olli Mäki)</p>
            </div>
          </div>
        </div>
      </div>
      <div class="item photocall 19-05-16 shadow-bottom photo paysage notloaded">
        <a id="photo1554" class="ajax chocolat-image" data-pid="1554"
           href="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/06/aefb875f4989465bff4202a041ea9e2fd0a4a480.jpg"
           title='<span class="category">Photocall</span><span class="date">19.05.16 . 14:06</span><h2>Iggy Pop - Gimme Danger</h2>'
           data-credit="Crédit Image : Cyril Duchêne / FDC"></a>
        <img data-original="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/06/thumb_5786_media_image_640x404.jpg"  alt="" title="Iggy Pop - Gimme Danger" class="lazy">
        <div class="picto"><i class="icon icon_photo"></i></div>
        <div class="info">
          <div class="vCenter">
            <div class="vCenterKid">
              <span class="category">Photocall</span>
              <span class="date">19.05.16</span> . <span
                  class="hour">14:06</span>
              <p data-title="Iggy Pop - Gimme Danger">Iggy Pop - Gimme Danger</p>
            </div>
          </div>
        </div>
      </div>
      <div class="item photocall 19-05-16 shadow-bottom photo paysage notloaded">
        <a id="photo1541" class="ajax chocolat-image" data-pid="1541"
           href="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/06/c5d328a4122d888f21b07328f4b4e81032b84b84.jpg"
           title='<span class="category">Photocall</span><span class="date">19.05.16 . 14:03</span><h2>Iggy Pop et Jim Jarmusch - Gimme Danger</h2>'
           data-credit="Crédit Image : Mathilde Petit / FDC"></a>
        <img data-original="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/06/thumb_5775_media_image_640x404.jpg"  alt="" title="Iggy Pop et Jim Jarmusch - Gimme Danger" class="lazy">
        <div class="picto"><i class="icon icon_photo"></i></div>
        <div class="info">
          <div class="vCenter">
            <div class="vCenterKid">
              <span class="category">Photocall</span>
              <span class="date">19.05.16</span> . <span
                  class="hour">14:03</span>
              <p data-title="Iggy Pop et Jim Jarmusch - Gimme Danger">Iggy Pop et Jim Jarmusch - Gimme Danger</p>
            </div>
          </div>
        </div>
      </div>
      <div class="item photocall 19-05-16 shadow-bottom photo paysage notloaded">
        <a id="photo1540" class="ajax chocolat-image" data-pid="1540"
           href="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/06/a0122850faac0c336880302bb59380b6dde7b70a.jpg"
           title='<span class="category">Photocall</span><span class="date">19.05.16 . 14:00</span><h2>Équipe du film - Gimme Danger</h2>'
           data-credit="Crédit Image : Mathilde Petit / FDC"></a>
        <img data-original="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/06/thumb_5774_media_image_640x404.jpg"  alt="" title="Équipe du film - Gimme Danger" class="lazy">
        <div class="picto"><i class="icon icon_photo"></i></div>
        <div class="info">
          <div class="vCenter">
            <div class="vCenterKid">
              <span class="category">Photocall</span>
              <span class="date">19.05.16</span> . <span
                  class="hour">14:00</span>
              <p data-title="Équipe du film - Gimme Danger">Équipe du film - Gimme Danger</p>
            </div>
          </div>
        </div>
      </div>
      <div class="item conference-de-presse 19-05-16 shadow-bottom photo portrait notloaded">
        <a id="photo1536" class="ajax chocolat-image" data-pid="1536"
           href="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/06/53366bda6d1073b68c781fa8b9345f64bf2cc41a.jpg"
           title='<span class="category">Conférence de Presse</span><span class="date">19.05.16 . 12:33</span><h2>Gaspard Ulliel - Juste la fin du monde</h2>'
           data-credit="Crédit Image : Mathilde Petit / FDC"></a>
        <img data-original="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/06/thumb_5770_media_image_320x404.jpg"  alt="" title="Gaspard Ulliel - Juste la fin du monde" class="lazy">
        <div class="picto"><i class="icon icon_photo"></i></div>
        <div class="info">
          <div class="vCenter">
            <div class="vCenterKid">
              <span class="category">Conférence de Presse</span>
              <span class="date">19.05.16</span> . <span
                  class="hour">12:33</span>
              <p data-title="Gaspard Ulliel - Juste la fin du monde">Gaspard Ulliel - Juste la fin du monde</p>
            </div>
          </div>
        </div>
      </div>
      <div class="item conference-de-presse 19-05-16 shadow-bottom photo paysage notloaded">
        <a id="photo1555" class="ajax chocolat-image" data-pid="1555"
           href="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/06/87b4c54440164b72cec2ffdb9c02420c396071b9.jpg"
           title='<span class="category">Conférence de Presse</span><span class="date">19.05.16 . 12:32</span><h2>Xavier Dolan - Juste la fin du monde</h2>'
           data-credit="Crédit Image : Mathilde Petit / FDC"></a>
        <img data-original="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/06/thumb_5787_media_image_640x404.jpg"  alt="" title="Xavier Dolan - Juste la fin du monde" class="lazy">
        <div class="picto"><i class="icon icon_photo"></i></div>
        <div class="info">
          <div class="vCenter">
            <div class="vCenterKid">
              <span class="category">Conférence de Presse</span>
              <span class="date">19.05.16</span> . <span
                  class="hour">12:32</span>
              <p data-title="Xavier Dolan - Juste la fin du monde">Xavier Dolan - Juste la fin du monde</p>
            </div>
          </div>
        </div>
      </div>
      <div class="item conference-de-presse 19-05-16 shadow-bottom photo paysage notloaded">
        <a id="photo1535" class="ajax chocolat-image" data-pid="1535"
           href="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/06/c6a44ba965686a0d08ce5a577fd4c432477dd810.jpg"
           title='<span class="category">Conférence de Presse</span><span class="date">19.05.16 . 12:30</span><h2>Équipe du film - Juste la fin du monde</h2>'
           data-credit="Crédit Image : Mathilde Petit / FDC"></a>
        <img data-original="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/06/thumb_5769_media_image_640x404.jpg"  alt="" title="Équipe du film - Juste la fin du monde" class="lazy">
        <div class="picto"><i class="icon icon_photo"></i></div>
        <div class="info">
          <div class="vCenter">
            <div class="vCenterKid">
              <span class="category">Conférence de Presse</span>
              <span class="date">19.05.16</span> . <span
                  class="hour">12:30</span>
              <p data-title="Équipe du film - Juste la fin du monde">Équipe du film - Juste la fin du monde</p>
            </div>
          </div>
        </div>
      </div>
      <div class="item photocall 19-05-16 shadow-bottom photo paysage notloaded">
        <a id="photo1531" class="ajax chocolat-image" data-pid="1531"
           href="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/06/38db035a61c014f21e856d25751a1c4d8f785a50.jpg"
           title='<span class="category">Photocall</span><span class="date">19.05.16 . 12:13</span><h2>Équipe du film - Pericle il nero (Pericle)</h2>'
           data-credit="Crédit Image : Léo Laumont / FDC"></a>
        <img data-original="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/06/thumb_5766_media_image_640x404.jpg"  alt="" title="Équipe du film - Pericle il nero (Pericle)" class="lazy">
        <div class="picto"><i class="icon icon_photo"></i></div>
        <div class="info">
          <div class="vCenter">
            <div class="vCenterKid">
              <span class="category">Photocall</span>
              <span class="date">19.05.16</span> . <span
                  class="hour">12:13</span>
              <p data-title="Équipe du film - Pericle il nero (Pericle)">Équipe du film - Pericle il nero (Pericle)</p>
            </div>
          </div>
        </div>
      </div>
      <div class="item photocall 19-05-16 shadow-bottom photo paysage notloaded">
        <a id="photo1530" class="ajax chocolat-image" data-pid="1530"
           href="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/06/0cec4da44aa95bf2e276a5ffc0e1deaa53be952f.jpg"
           title='<span class="category">Photocall</span><span class="date">19.05.16 . 12:12</span><h2>Marina Foïs - Pericle il nero (Pericle)</h2>'
           data-credit="Crédit Image : Léo Laumont / FDC"></a>
        <img data-original="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/06/thumb_5765_media_image_640x404.jpg"  alt="" title="Marina Foïs - Pericle il nero (Pericle)" class="lazy">
        <div class="picto"><i class="icon icon_photo"></i></div>
        <div class="info">
          <div class="vCenter">
            <div class="vCenterKid">
              <span class="category">Photocall</span>
              <span class="date">19.05.16</span> . <span
                  class="hour">12:12</span>
              <p data-title="Marina Foïs - Pericle il nero (Pericle)">Marina Foïs - Pericle il nero (Pericle)</p>
            </div>
          </div>
        </div>
      </div>
      <div class="item photocall 19-05-16 shadow-bottom photo paysage notloaded">
        <a id="photo1527" class="ajax chocolat-image" data-pid="1527"
           href="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/06/b1b5411ecd00f6b1294e9e838c5cf1633e437a20.jpg"
           title='<span class="category">Photocall</span><span class="date">19.05.16 . 12:10</span><h2>Stefano Mordini, Marina Foïs et Riccardo Scamarcio - Pericle il nero (Pericle)</h2>'
           data-credit="Crédit Image : Léo Laumont / FDC"></a>
        <img data-original="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/06/thumb_5763_media_image_640x404.jpg"  alt="" title="Stefano Mordini, Marina Foïs et Riccardo Scamarcio - Pericle il nero (Pericle)" class="lazy">
        <div class="picto"><i class="icon icon_photo"></i></div>
        <div class="info">
          <div class="vCenter">
            <div class="vCenterKid">
              <span class="category">Photocall</span>
              <span class="date">19.05.16</span> . <span
                  class="hour">12:10</span>
              <p data-title="Stefano Mordini, Marina Foïs et Riccardo Scamarcio - Pericle il nero (Pericle)">Stefano Mordini, Marina Foïs et Riccardo Scamarcio - Pericle il nero (Pericle)</p>
            </div>
          </div>
        </div>
      </div>
      <div class="item photocall 19-05-16 shadow-bottom photo paysage notloaded">
        <a id="photo1533" class="ajax chocolat-image" data-pid="1533"
           href="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/06/0b603b83cb24db1afedee66ddf658408c7dfc87a.jpg"
           title='<span class="category">Photocall</span><span class="date">19.05.16 . 12:09</span><h2>Nathalie Baye et Xavier Dolan - Juste la fin du monde</h2>'
           data-credit="Crédit Image : Thomas Leibreich / FDC"></a>
        <img data-original="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/06/thumb_5767_media_image_640x404.jpg"  alt="" title="Nathalie Baye et Xavier Dolan - Juste la fin du monde" class="lazy">
        <div class="picto"><i class="icon icon_photo"></i></div>
        <div class="info">
          <div class="vCenter">
            <div class="vCenterKid">
              <span class="category">Photocall</span>
              <span class="date">19.05.16</span> . <span
                  class="hour">12:09</span>
              <p data-title="Nathalie Baye et Xavier Dolan - Juste la fin du monde">Nathalie Baye et Xavier Dolan - Juste la fin du monde</p>
            </div>
          </div>
        </div>
      </div>
      <div class="item photocall 19-05-16 shadow-bottom photo paysage notloaded">
        <a id="photo1534" class="ajax chocolat-image" data-pid="1534"
           href="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/06/3045c9153024a1affc4f99b66a41752c77284ea7.jpg"
           title='<span class="category">Photocall</span><span class="date">19.05.16 . 12:09</span><h2>Marion Cotillard et Nathalie Baye - Juste la fin du monde</h2>'
           data-credit="Crédit Image : Thomas Leibreich / FDC"></a>
        <img data-original="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/06/thumb_5768_media_image_640x404.jpg"  alt="" title="Marion Cotillard et Nathalie Baye - Juste la fin du monde" class="lazy">
        <div class="picto"><i class="icon icon_photo"></i></div>
        <div class="info">
          <div class="vCenter">
            <div class="vCenterKid">
              <span class="category">Photocall</span>
              <span class="date">19.05.16</span> . <span
                  class="hour">12:09</span>
              <p data-title="Marion Cotillard et Nathalie Baye - Juste la fin du monde">Marion Cotillard et Nathalie Baye - Juste la fin du monde</p>
            </div>
          </div>
        </div>
      </div>
      <div class="item photocall 19-05-16 shadow-bottom photo paysage notloaded">
        <a id="photo1522" class="ajax chocolat-image" data-pid="1522"
           href="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/06/a5b925bc8a5e750b81f6d84421d3391a99b70ec0.jpg"
           title='<span class="category">Photocall</span><span class="date">19.05.16 . 12:05</span><h2>Vincent Cassel - Juste la fin du monde</h2>'
           data-credit="Crédit Image : Léo Laumont / FDC"></a>
        <img data-original="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/06/thumb_5759_media_image_640x404.jpg"  alt="" title="Vincent Cassel - Juste la fin du monde" class="lazy">
        <div class="picto"><i class="icon icon_photo"></i></div>
        <div class="info">
          <div class="vCenter">
            <div class="vCenterKid">
              <span class="category">Photocall</span>
              <span class="date">19.05.16</span> . <span
                  class="hour">12:05</span>
              <p data-title="Vincent Cassel - Juste la fin du monde">Vincent Cassel - Juste la fin du monde</p>
            </div>
          </div>
        </div>
      </div>
      <div class="item photocall 19-05-16 shadow-bottom photo paysage notloaded">
        <a id="photo1521" class="ajax chocolat-image" data-pid="1521"
           href="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/06/0c9dbc67fbd027663af914d4062a352bb80d083d.jpg"
           title='<span class="category">Photocall</span><span class="date">19.05.16 . 12:03</span><h2>Léa Seydoux - Juste la fin du monde</h2>'
           data-credit="Crédit Image : Léo Laumont / FDC"></a>
        <img data-original="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/06/thumb_5758_media_image_640x404.jpg"  alt="" title="Léa Seydoux - Juste la fin du monde" class="lazy">
        <div class="picto"><i class="icon icon_photo"></i></div>
        <div class="info">
          <div class="vCenter">
            <div class="vCenterKid">
              <span class="category">Photocall</span>
              <span class="date">19.05.16</span> . <span
                  class="hour">12:03</span>
              <p data-title="Léa Seydoux - Juste la fin du monde">Léa Seydoux - Juste la fin du monde</p>
            </div>
          </div>
        </div>
      </div>
      <div class="item photocall 19-05-16 shadow-bottom photo paysage notloaded">
        <a id="photo1520" class="ajax chocolat-image" data-pid="1520"
           href="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/06/003e1e49d85b85f5c4f34289d2a8edea6938ea2b.jpg"
           title='<span class="category">Photocall</span><span class="date">19.05.16 . 12:00</span><h2>Équipe du film - Juste la fin du monde</h2>'
           data-credit="Crédit Image : Léo Laumont / FDC"></a>
        <img data-original="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/06/thumb_5757_media_image_640x404.jpg"  alt="" title="Équipe du film - Juste la fin du monde" class="lazy">
        <div class="picto"><i class="icon icon_photo"></i></div>
        <div class="info">
          <div class="vCenter">
            <div class="vCenterKid">
              <span class="category">Photocall</span>
              <span class="date">19.05.16</span> . <span
                  class="hour">12:00</span>
              <p data-title="Équipe du film - Juste la fin du monde">Équipe du film - Juste la fin du monde</p>
            </div>
          </div>
        </div>
      </div>
      <div class="item conference-de-presse 19-05-16 shadow-bottom photo paysage notloaded">
        <a id="photo1513" class="ajax chocolat-image" data-pid="1513"
           href="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/06/370dc3182a78e39570be0c9eb73afd36a51e698e.jpg"
           title='<span class="category">Conférence de Presse</span><span class="date">19.05.16 . 11:02</span><h2>Équipe du film - Bacalaureat (Baccalauréat)</h2>'
           data-credit="Crédit Image : Cyril Duchêne / FDC"></a>
        <img data-original="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/06/thumb_5742_media_image_640x404.jpg"  alt="" title="Équipe du film - Bacalaureat (Baccalauréat)" class="lazy">
        <div class="picto"><i class="icon icon_photo"></i></div>
        <div class="info">
          <div class="vCenter">
            <div class="vCenterKid">
              <span class="category">Conférence de Presse</span>
              <span class="date">19.05.16</span> . <span
                  class="hour">11:02</span>
              <p data-title="Équipe du film - Bacalaureat (Baccalauréat)">Équipe du film - Bacalaureat (Baccalauréat)</p>
            </div>
          </div>
        </div>
      </div>
      <div class="item conference-de-presse 19-05-16 shadow-bottom photo paysage notloaded">
        <a id="photo1512" class="ajax chocolat-image" data-pid="1512"
           href="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/06/f5c552d1b37d8578074e85aae68c7e304c006507.jpg"
           title='<span class="category">Conférence de Presse</span><span class="date">19.05.16 . 11:00</span><h2>Rares Andrici - Bacalaureat (Baccalauréat)</h2>'
           data-credit="Crédit Image : Cyril Duchêne / FDC"></a>
        <img data-original="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/06/thumb_5741_media_image_640x404.jpg"  alt="" title="Rares Andrici - Bacalaureat (Baccalauréat)" class="lazy">
        <div class="picto"><i class="icon icon_photo"></i></div>
        <div class="info">
          <div class="vCenter">
            <div class="vCenterKid">
              <span class="category">Conférence de Presse</span>
              <span class="date">19.05.16</span> . <span
                  class="hour">11:00</span>
              <p data-title="Rares Andrici - Bacalaureat (Baccalauréat)">Rares Andrici - Bacalaureat (Baccalauréat)</p>
            </div>
          </div>
        </div>
      </div>
      <div class="item photocall 19-05-16 shadow-bottom photo paysage notloaded">
        <a id="photo1505" class="ajax chocolat-image" data-pid="1505"
           href="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/06/f647c8213ebfe680216fbdca400cfe3fb0abca88.jpg"
           title='<span class="category">Photocall</span><span class="date">19.05.16 . 10:37</span><h2>Albert Serra - La mort de Louis XIV</h2>'
           data-credit="Crédit Image : Thomas Leibreich / FDC"></a>
        <img data-original="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/06/thumb_5735_media_image_640x404.jpg"  alt="" title="Albert Serra - La mort de Louis XIV" class="lazy">
        <div class="picto"><i class="icon icon_photo"></i></div>
        <div class="info">
          <div class="vCenter">
            <div class="vCenterKid">
              <span class="category">Photocall</span>
              <span class="date">19.05.16</span> . <span
                  class="hour">10:37</span>
              <p data-title="Albert Serra - La mort de Louis XIV">Albert Serra - La mort de Louis XIV</p>
            </div>
          </div>
        </div>
      </div>
      <div class="item photocall 19-05-16 shadow-bottom photo paysage notloaded">
        <a id="photo1503" class="ajax chocolat-image" data-pid="1503"
           href="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/06/6c50e5ceccea27924148451d076894e338305351.jpg"
           title='<span class="category">Photocall</span><span class="date">19.05.16 . 10:35</span><h2>Albert Serra et Jean-Pierre Léaud - La mort de Louis XIV</h2>'
           data-credit="Crédit Image : Thomas Leibreich / FDC"></a>
        <img data-original="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/06/thumb_5733_media_image_640x404.jpg"  alt="" title="Albert Serra et Jean-Pierre Léaud - La mort de Louis XIV" class="lazy">
        <div class="picto"><i class="icon icon_photo"></i></div>
        <div class="info">
          <div class="vCenter">
            <div class="vCenterKid">
              <span class="category">Photocall</span>
              <span class="date">19.05.16</span> . <span
                  class="hour">10:35</span>
              <p data-title="Albert Serra et Jean-Pierre Léaud - La mort de Louis XIV">Albert Serra et Jean-Pierre Léaud - La mort de Louis XIV</p>
            </div>
          </div>
        </div>
      </div>
      <div class="item photocall 19-05-16 shadow-bottom photo portrait notloaded">
        <a id="photo1511" class="ajax chocolat-image" data-pid="1511"
           href="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/06/9b357a2ef0cdf31b7eed72e277009ac12cf5c398.jpg"
           title='<span class="category">Photocall</span><span class="date">19.05.16 . 10:34</span><h2>Malina Manovici et Maria Dragus - Bacalaureat (Baccalauréat)</h2>'
           data-credit="Crédit Image : Léo Laumont / FDC"></a>
        <img data-original="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/06/thumb_5740_media_image_320x404.jpg"  alt="" title="Malina Manovici et Maria Dragus - Bacalaureat (Baccalauréat)" class="lazy">
        <div class="picto"><i class="icon icon_photo"></i></div>
        <div class="info">
          <div class="vCenter">
            <div class="vCenterKid">
              <span class="category">Photocall</span>
              <span class="date">19.05.16</span> . <span
                  class="hour">10:34</span>
              <p data-title="Malina Manovici et Maria Dragus - Bacalaureat (Baccalauréat)">Malina Manovici et Maria Dragus - Bacalaureat (Baccalauréat)</p>
            </div>
          </div>
        </div>
      </div>
      <div class="item photocall 19-05-16 shadow-bottom photo paysage notloaded">
        <a id="photo1502" class="ajax chocolat-image" data-pid="1502"
           href="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/06/3d9ed4136e3047cc01d61b1aaef028814ff733b5.jpg"
           title='<span class="category">Photocall</span><span class="date">19.05.16 . 10:33</span><h2>Malina Manovici - Bacalaureat (Baccalauréat)</h2>'
           data-credit="Crédit Image : Thomas Leibreich / FDC"></a>
        <img data-original="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/06/thumb_5732_media_image_640x404.jpg"  alt="" title="Malina Manovici - Bacalaureat (Baccalauréat)" class="lazy">
        <div class="picto"><i class="icon icon_photo"></i></div>
        <div class="info">
          <div class="vCenter">
            <div class="vCenterKid">
              <span class="category">Photocall</span>
              <span class="date">19.05.16</span> . <span
                  class="hour">10:33</span>
              <p data-title="Malina Manovici - Bacalaureat (Baccalauréat)">Malina Manovici - Bacalaureat (Baccalauréat)</p>
            </div>
          </div>
        </div>
      </div>
      <div class="item photocall 19-05-16 shadow-bottom photo paysage notloaded">
        <a id="photo1500" class="ajax chocolat-image" data-pid="1500"
           href="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/06/f2ebec430ada897edf0419f1bb9ec421715cda8a.jpg"
           title='<span class="category">Photocall</span><span class="date">19.05.16 . 10:32</span><h2>Cristian Mungiu - Bacalaureat (Baccalauréat)</h2>'
           data-credit="Crédit Image : Thomas Leibreich / FDC"></a>
        <img data-original="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/06/thumb_5731_media_image_640x404.jpg"  alt="" title="Cristian Mungiu - Bacalaureat (Baccalauréat)" class="lazy">
        <div class="picto"><i class="icon icon_photo"></i></div>
        <div class="info">
          <div class="vCenter">
            <div class="vCenterKid">
              <span class="category">Photocall</span>
              <span class="date">19.05.16</span> . <span
                  class="hour">10:32</span>
              <p data-title="Cristian Mungiu - Bacalaureat (Baccalauréat)">Cristian Mungiu - Bacalaureat (Baccalauréat)</p>
            </div>
          </div>
        </div>
      </div>
      <div class="item photocall 19-05-16 shadow-bottom photo paysage notloaded">
        <a id="photo1498" class="ajax chocolat-image" data-pid="1498"
           href="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/06/e86bdd39d930a335a1b67f9f4ad0b6504369f0ce.jpg"
           title='<span class="category">Photocall</span><span class="date">19.05.16 . 10:30</span><h2>Équipe du film - Bacalaureat (Baccalauréat)</h2>'
           data-credit="Crédit Image : Thomas Leibreich / FDC"></a>
        <img data-original="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/06/thumb_5729_media_image_640x404.jpg"  alt="" title="Équipe du film - Bacalaureat (Baccalauréat)" class="lazy">
        <div class="picto"><i class="icon icon_photo"></i></div>
        <div class="info">
          <div class="vCenter">
            <div class="vCenterKid">
              <span class="category">Photocall</span>
              <span class="date">19.05.16</span> . <span
                  class="hour">10:30</span>
              <p data-title="Équipe du film - Bacalaureat (Baccalauréat)">Équipe du film - Bacalaureat (Baccalauréat)</p>
            </div>
          </div>
        </div>
      </div>
      <div class="item photocall 19-05-16 shadow-bottom photo paysage notloaded">
        <a id="photo1509" class="ajax chocolat-image" data-pid="1509"
           href="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/06/1902381ac33a5e10fbf48a59beda8548db4adb5c.jpg"
           title='<span class="category">Photocall</span><span class="date">19.05.16 . 10:25</span><h2>Naomi Kawase - Présidente du Jury de la Cinéfondation et des Courts Métrages</h2>'
           data-credit="Crédit Image : Thomas Leibreich / FDC"></a>
        <img data-original="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/06/thumb_5738_media_image_640x404.jpg"  alt="" title="Naomi Kawase - Présidente du Jury de la Cinéfondation et des Courts Métrages" class="lazy">
        <div class="picto"><i class="icon icon_photo"></i></div>
        <div class="info">
          <div class="vCenter">
            <div class="vCenterKid">
              <span class="category">Photocall</span>
              <span class="date">19.05.16</span> . <span
                  class="hour">10:25</span>
              <p data-title="Naomi Kawase - Présidente du Jury de la Cinéfondation et des Courts Métrages">Naomi Kawase - Présidente du Jury de la Cinéfondation et des Courts Métrages</p>
            </div>
          </div>
        </div>
      </div>
      <div class="item photocall 19-05-16 shadow-bottom photo paysage notloaded">
        <a id="photo1507" class="ajax chocolat-image" data-pid="1507"
           href="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/06/f3b521799033b0846806a77d381de3dd066d73a1.jpg"
           title='<span class="category">Photocall</span><span class="date">19.05.16 . 10:20</span><h2>Jury de la Cinéfondation et des Courts Métrages</h2>'
           data-credit="Crédit Image : Thomas Leibreich / FDC"></a>
        <img data-original="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/06/thumb_5736_media_image_640x404.jpg"  alt="" title="Jury de la Cinéfondation et des Courts Métrages" class="lazy">
        <div class="picto"><i class="icon icon_photo"></i></div>
        <div class="info">
          <div class="vCenter">
            <div class="vCenterKid">
              <span class="category">Photocall</span>
              <span class="date">19.05.16</span> . <span
                  class="hour">10:20</span>
              <p data-title="Jury de la Cinéfondation et des Courts Métrages">Jury de la Cinéfondation et des Courts Métrages</p>
            </div>
          </div>
        </div>
      </div>
      <div class="item oeil-du-photographe 19-05-16 shadow-bottom photo paysage notloaded">
        <a id="photo1455" class="ajax chocolat-image" data-pid="1455"
           href="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/06/547a60859729400536c75310ff3468140c3fac88.jpg"
           title='<span class="category">Œil du photographe</span><span class="date">19.05.16 . 09:00</span><h2>@justintimberlake dans sa suite avant de se rendre à la Cérémonie d&#039;ouverture du @festivaldecannes suite à la promotion de son film #DreamworksTrolls</h2>'
           data-credit="Crédit Image : Greg Williams"></a>
        <img data-original="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/06/thumb_5689_media_image_640x404.jpg"  alt="" title="@justintimberlake dans sa suite avant de se rendre à la Cérémonie d&#039;ouverture du @festivaldecannes suite à la promotion de son film #DreamworksTrolls" class="lazy">
        <div class="picto"><i class="icon icon_photo"></i></div>
        <div class="info">
          <div class="vCenter">
            <div class="vCenterKid">
              <span class="category">Œil du photographe</span>
              <span class="date">19.05.16</span> . <span
                  class="hour">09:00</span>
              <p data-title="@justintimberlake dans sa suite avant de se rendre à la Cérémonie d&#039;ouverture du @festivaldecannes suite à la promotion de son film #DreamworksTrolls">@justintimberlake dans sa suite avant de se rendre à la Cérémonie d&#039;ouverture du @festivaldecannes suite à la promotion de son film #DreamworksTrolls</p>
            </div>
          </div>
        </div>
      </div>
      <div class="item oeil-du-photographe 19-05-16 shadow-bottom photo paysage notloaded">
        <a id="photo1459" class="ajax chocolat-image" data-pid="1459"
           href="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/06/7f495a39c5a29c771a24030ccc615736d8a55bd3.jpg"
           title='<span class="category">Œil du photographe</span><span class="date">19.05.16 . 09:00</span><h2>#KateMoss#kma s&#039;arrête un instant dans le couloir de son hôtel avant de se rendre sur le Tapis rouge @Chopard</h2>'
           data-credit="Crédit Image : Greg Williams"></a>
        <img data-original="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/06/thumb_5692_media_image_640x404.jpg"  alt="" title="#KateMoss#kma s&#039;arrête un instant dans le couloir de son hôtel avant de se rendre sur le Tapis rouge @Chopard" class="lazy">
        <div class="picto"><i class="icon icon_photo"></i></div>
        <div class="info">
          <div class="vCenter">
            <div class="vCenterKid">
              <span class="category">Œil du photographe</span>
              <span class="date">19.05.16</span> . <span
                  class="hour">09:00</span>
              <p data-title="#KateMoss#kma s&#039;arrête un instant dans le couloir de son hôtel avant de se rendre sur le Tapis rouge @Chopard">#KateMoss#kma s&#039;arrête un instant dans le couloir de son hôtel avant de se rendre sur le Tapis rouge @Chopard</p>
            </div>
          </div>
        </div>
      </div>
      <div class="item oeil-du-photographe 19-05-16 shadow-bottom photo paysage notloaded">
        <a id="photo1462" class="ajax chocolat-image" data-pid="1462"
           href="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/06/8c94ca736023ea4ed6a36ae3a5257a330c7e83ac.jpg"
           title='<span class="category">Œil du photographe</span><span class="date">19.05.16 . 09:00</span><h2>Petite sieste à la fête @handsofstonemov à #Nikkibeach @festivaldecannes</h2>'
           data-credit="Crédit Image : Greg Williams"></a>
        <img data-original="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/06/thumb_5695_media_image_640x404.jpg"  alt="" title="Petite sieste à la fête @handsofstonemov à #Nikkibeach @festivaldecannes" class="lazy">
        <div class="picto"><i class="icon icon_photo"></i></div>
        <div class="info">
          <div class="vCenter">
            <div class="vCenterKid">
              <span class="category">Œil du photographe</span>
              <span class="date">19.05.16</span> . <span
                  class="hour">09:00</span>
              <p data-title="Petite sieste à la fête @handsofstonemov à #Nikkibeach @festivaldecannes">Petite sieste à la fête @handsofstonemov à #Nikkibeach @festivaldecannes</p>
            </div>
          </div>
        </div>
      </div>
      <div class="item oeil-du-photographe 19-05-16 shadow-bottom photo paysage notloaded">
        <a id="photo1464" class="ajax chocolat-image" data-pid="1464"
           href="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/06/1ab438b8d3510df3985e0e4d62b466b7351559ae.jpg"
           title='<span class="category">Œil du photographe</span><span class="date">19.05.16 . 09:00</span><h2>#RobertDeNiro recevant un hommage à la première de @handsofstonemov</h2>'
           data-credit="Crédit Image : Greg Williams"></a>
        <img data-original="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/06/thumb_5697_media_image_640x404.jpg"  alt="" title="#RobertDeNiro recevant un hommage à la première de @handsofstonemov" class="lazy">
        <div class="picto"><i class="icon icon_photo"></i></div>
        <div class="info">
          <div class="vCenter">
            <div class="vCenterKid">
              <span class="category">Œil du photographe</span>
              <span class="date">19.05.16</span> . <span
                  class="hour">09:00</span>
              <p data-title="#RobertDeNiro recevant un hommage à la première de @handsofstonemov">#RobertDeNiro recevant un hommage à la première de @handsofstonemov</p>
            </div>
          </div>
        </div>
      </div>
      <div class="item sur-scene 18-05-16 shadow-bottom photo paysage notloaded">
        <a id="photo1486" class="ajax chocolat-image" data-pid="1486"
           href="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/06/bbb861c60c0c02733545d758f88154e17ccd8074.jpg"
           title='<span class="category">Sur Scène</span><span class="date">18.05.16 . 22:43</span><h2>Kore-Eda Hirokazu - Umi Yorimo Mada Fukaku (Après la Tempête)</h2>'
           data-credit="Crédit Image : Léo Laumont / FDC"></a>
        <img data-original="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/06/thumb_5717_media_image_640x404.jpg"  alt="" title="Kore-Eda Hirokazu - Umi Yorimo Mada Fukaku (Après la Tempête)" class="lazy">
        <div class="picto"><i class="icon icon_photo"></i></div>
        <div class="info">
          <div class="vCenter">
            <div class="vCenterKid">
              <span class="category">Sur Scène</span>
              <span class="date">18.05.16</span> . <span
                  class="hour">22:43</span>
              <p data-title="Kore-Eda Hirokazu - Umi Yorimo Mada Fukaku (Après la Tempête)">Kore-Eda Hirokazu - Umi Yorimo Mada Fukaku (Après la Tempête)</p>
            </div>
          </div>
        </div>
      </div>
      <div class="item sur-scene 18-05-16 shadow-bottom photo paysage notloaded">
        <a id="photo1485" class="ajax chocolat-image" data-pid="1485"
           href="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/06/cec4fdcc02ae2a5e47a03a0f3a48ba951830d732.jpg"
           title='<span class="category">Sur Scène</span><span class="date">18.05.16 . 22:40</span><h2>Kore-Eda Hirokazu, Maki Yōko, Abe Hiroshi et Kiki Kilin - Umi Yorimo Mada Fukaku (Après la Tempête)</h2>'
           data-credit="Crédit Image : Léo Laumont / FDC"></a>
        <img data-original="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/06/thumb_5716_media_image_640x404.jpg"  alt="" title="Kore-Eda Hirokazu, Maki Yōko, Abe Hiroshi et Kiki Kilin - Umi Yorimo Mada Fukaku (Après la Tempête)" class="lazy">
        <div class="picto"><i class="icon icon_photo"></i></div>
        <div class="info">
          <div class="vCenter">
            <div class="vCenterKid">
              <span class="category">Sur Scène</span>
              <span class="date">18.05.16</span> . <span
                  class="hour">22:40</span>
              <p data-title="Kore-Eda Hirokazu, Maki Yōko, Abe Hiroshi et Kiki Kilin - Umi Yorimo Mada Fukaku (Après la Tempête)">Kore-Eda Hirokazu, Maki Yōko, Abe Hiroshi et Kiki Kilin - Umi Yorimo Mada Fukaku (Après la Tempête)</p>
            </div>
          </div>
        </div>
      </div>
      <div class="item montee-des-marches 18-05-16 shadow-bottom photo paysage notloaded">
        <a id="photo1484" class="ajax chocolat-image" data-pid="1484"
           href="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/06/34cab18023acf0d94b2a2fe840ff9c361fedfb96.jpg"
           title='<span class="category">Montée des Marches</span><span class="date">18.05.16 . 22:36</span><h2>Kore-Eda Hirokazu, Maki Yōko, Abe Hiroshi et Kiki Kilin - Umi Yorimo Mada Fukaku (Après la Tempête)</h2>'
           data-credit="Crédit Image : Cyril Duchêne / FDC"></a>
        <img data-original="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/06/thumb_5715_media_image_640x404.jpg"  alt="" title="Kore-Eda Hirokazu, Maki Yōko, Abe Hiroshi et Kiki Kilin - Umi Yorimo Mada Fukaku (Après la Tempête)" class="lazy">
        <div class="picto"><i class="icon icon_photo"></i></div>
        <div class="info">
          <div class="vCenter">
            <div class="vCenterKid">
              <span class="category">Montée des Marches</span>
              <span class="date">18.05.16</span> . <span
                  class="hour">22:36</span>
              <p data-title="Kore-Eda Hirokazu, Maki Yōko, Abe Hiroshi et Kiki Kilin - Umi Yorimo Mada Fukaku (Après la Tempête)">Kore-Eda Hirokazu, Maki Yōko, Abe Hiroshi et Kiki Kilin - Umi Yorimo Mada Fukaku (Après la Tempête)</p>
            </div>
          </div>
        </div>
      </div>
      <div class="item montee-des-marches 18-05-16 shadow-bottom photo paysage notloaded">
        <a id="photo1482" class="ajax chocolat-image" data-pid="1482"
           href="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/06/c7b182dbaec739b2ff747a3683e99ddac8aa1b76.jpg"
           title='<span class="category">Montée des Marches</span><span class="date">18.05.16 . 22:21</span><h2>Chun Woo Hee - Goksung (The Strangers)</h2>'
           data-credit="Crédit Image : Alberto Pizzoli / AFP"></a>
        <img data-original="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/06/thumb_5713_media_image_640x404.jpg"  alt="" title="Chun Woo Hee - Goksung (The Strangers)" class="lazy">
        <div class="picto"><i class="icon icon_photo"></i></div>
        <div class="info">
          <div class="vCenter">
            <div class="vCenterKid">
              <span class="category">Montée des Marches</span>
              <span class="date">18.05.16</span> . <span
                  class="hour">22:21</span>
              <p data-title="Chun Woo Hee - Goksung (The Strangers)">Chun Woo Hee - Goksung (The Strangers)</p>
            </div>
          </div>
        </div>
      </div>
      <div class="item montee-des-marches 18-05-16 shadow-bottom photo paysage notloaded">
        <a id="photo1480" class="ajax chocolat-image" data-pid="1480"
           href="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/06/693aea3793ffe5bf31dc1e6c061ac64004e2c3c6.jpg"
           title='<span class="category">Montée des Marches</span><span class="date">18.05.16 . 22:18</span><h2>Kunimura Jun, Na Hong-Jin, Chun Woo Hee et Kwak Do Won - Goksung (The Strangers)</h2>'
           data-credit="Crédit Image : Alberto Pizzoli / AFP"></a>
        <img data-original="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/06/thumb_5712_media_image_640x404.jpg"  alt="" title="Kunimura Jun, Na Hong-Jin, Chun Woo Hee et Kwak Do Won - Goksung (The Strangers)" class="lazy">
        <div class="picto"><i class="icon icon_photo"></i></div>
        <div class="info">
          <div class="vCenter">
            <div class="vCenterKid">
              <span class="category">Montée des Marches</span>
              <span class="date">18.05.16</span> . <span
                  class="hour">22:18</span>
              <p data-title="Kunimura Jun, Na Hong-Jin, Chun Woo Hee et Kwak Do Won - Goksung (The Strangers)">Kunimura Jun, Na Hong-Jin, Chun Woo Hee et Kwak Do Won - Goksung (The Strangers)</p>
            </div>
          </div>
        </div>
      </div>
      <div class="item sur-scene 18-05-16 shadow-bottom photo paysage notloaded">
        <a id="photo1479" class="ajax chocolat-image" data-pid="1479"
           href="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/06/463a72f441dd9524d84d5bdd49fae5a10433d1cd.jpg"
           title='<span class="category">Sur Scène</span><span class="date">18.05.16 . 21:20</span><h2>Eveline Wohlfeiler et Tugo Stiglic - Dolina Miru (La vallée de la paix)</h2>'
           data-credit="Crédit Image : Léo Laumont / FDC"></a>
        <img data-original="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/06/thumb_5711_media_image_640x404.jpg"  alt="" title="Eveline Wohlfeiler et Tugo Stiglic - Dolina Miru (La vallée de la paix)" class="lazy">
        <div class="picto"><i class="icon icon_photo"></i></div>
        <div class="info">
          <div class="vCenter">
            <div class="vCenterKid">
              <span class="category">Sur Scène</span>
              <span class="date">18.05.16</span> . <span
                  class="hour">21:20</span>
              <p data-title="Eveline Wohlfeiler et Tugo Stiglic - Dolina Miru (La vallée de la paix)">Eveline Wohlfeiler et Tugo Stiglic - Dolina Miru (La vallée de la paix)</p>
            </div>
          </div>
        </div>
      </div>
      <div class="item sur-scene 18-05-16 shadow-bottom photo paysage notloaded">
        <a id="photo1478" class="ajax chocolat-image" data-pid="1478"
           href="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/06/9d23e52f14f61298c3191f2c63f6a41e5a392d3f.jpg"
           title='<span class="category">Sur Scène</span><span class="date">18.05.16 . 21:15</span><h2>Eveline Wohlfeiler et Tugo Stiglic - Dolina Miru (La vallée de la paix)</h2>'
           data-credit="Crédit Image : Léo Laumont / FDC"></a>
        <img data-original="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/06/thumb_5710_media_image_640x404.jpg"  alt="" title="Eveline Wohlfeiler et Tugo Stiglic - Dolina Miru (La vallée de la paix)" class="lazy">
        <div class="picto"><i class="icon icon_photo"></i></div>
        <div class="info">
          <div class="vCenter">
            <div class="vCenterKid">
              <span class="category">Sur Scène</span>
              <span class="date">18.05.16</span> . <span
                  class="hour">21:15</span>
              <p data-title="Eveline Wohlfeiler et Tugo Stiglic - Dolina Miru (La vallée de la paix)">Eveline Wohlfeiler et Tugo Stiglic - Dolina Miru (La vallée de la paix)</p>
            </div>
          </div>
        </div>
      </div>
      <div class="item sur-scene 18-05-16 shadow-bottom photo paysage notloaded">
        <a id="photo1476" class="ajax chocolat-image" data-pid="1476"
           href="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/06/df05568276c38a821d2d05791e50d06193371d3e.jpg"
           title='<span class="category">Sur Scène</span><span class="date">18.05.16 . 19:30</span><h2>Esther Hoffenberg - Bernadette Lafont et Dieu créa la femme libre</h2>'
           data-credit="Crédit Image : Léo Laumont / FDC"></a>
        <img data-original="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/06/thumb_5709_media_image_640x404.jpg"  alt="" title="Esther Hoffenberg - Bernadette Lafont et Dieu créa la femme libre" class="lazy">
        <div class="picto"><i class="icon icon_photo"></i></div>
        <div class="info">
          <div class="vCenter">
            <div class="vCenterKid">
              <span class="category">Sur Scène</span>
              <span class="date">18.05.16</span> . <span
                  class="hour">19:30</span>
              <p data-title="Esther Hoffenberg - Bernadette Lafont et Dieu créa la femme libre">Esther Hoffenberg - Bernadette Lafont et Dieu créa la femme libre</p>
            </div>
          </div>
        </div>
      </div>
      <div class="item montee-des-marches 18-05-16 shadow-bottom photo paysage notloaded">
        <a id="photo1467" class="ajax chocolat-image" data-pid="1467"
           href="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/06/e4e2c45604c202cee586cc6289997f203e845910.jpg"
           title='<span class="category">Montée des Marches</span><span class="date">18.05.16 . 19:08</span><h2>Luc Dardenne, Adèle Haenel et Jean-Pierre Dardenne - La Fille Inconnue</h2>'
           data-credit="Crédit Image : Loic Venance / AFP"></a>
        <img data-original="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/06/thumb_5702_media_image_640x404.jpg"  alt="" title="Luc Dardenne, Adèle Haenel et Jean-Pierre Dardenne - La Fille Inconnue" class="lazy">
        <div class="picto"><i class="icon icon_photo"></i></div>
        <div class="info">
          <div class="vCenter">
            <div class="vCenterKid">
              <span class="category">Montée des Marches</span>
              <span class="date">18.05.16</span> . <span
                  class="hour">19:08</span>
              <p data-title="Luc Dardenne, Adèle Haenel et Jean-Pierre Dardenne - La Fille Inconnue">Luc Dardenne, Adèle Haenel et Jean-Pierre Dardenne - La Fille Inconnue</p>
            </div>
          </div>
        </div>
      </div>
      <div class="item montee-des-marches 18-05-16 shadow-bottom photo paysage notloaded">
        <a id="photo1456" class="ajax chocolat-image" data-pid="1456"
           href="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/06/270fa084e719e756a3b92f30716230c3155f4968.jpg"
           title='<span class="category">Montée des Marches</span><span class="date">18.05.16 . 19:00</span><h2>Nadège Ouedraogo, Luc Dardenne, Adèle Haenel, Jean-Pierre Dardenne et Louka Minnella - La Fille Inconnue</h2>'
           data-credit="Crédit Image : Alberto Pizzoli / AFP"></a>
        <img data-original="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/06/thumb_5690_media_image_640x404.jpg"  alt="" title="Nadège Ouedraogo, Luc Dardenne, Adèle Haenel, Jean-Pierre Dardenne et Louka Minnella - La Fille Inconnue" class="lazy">
        <div class="picto"><i class="icon icon_photo"></i></div>
        <div class="info">
          <div class="vCenter">
            <div class="vCenterKid">
              <span class="category">Montée des Marches</span>
              <span class="date">18.05.16</span> . <span
                  class="hour">19:00</span>
              <p data-title="Nadège Ouedraogo, Luc Dardenne, Adèle Haenel, Jean-Pierre Dardenne et Louka Minnella - La Fille Inconnue">Nadège Ouedraogo, Luc Dardenne, Adèle Haenel, Jean-Pierre Dardenne et Louka Minnella - La Fille Inconnue</p>
            </div>
          </div>
        </div>
      </div>
      <div class="item montee-des-marches 18-05-16 shadow-bottom photo paysage notloaded">
        <a id="photo1463" class="ajax chocolat-image" data-pid="1463"
           href="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/06/0ab9d2a36f5b7a2e1dfe081c300ae90c4e5b80da.jpg"
           title='<span class="category">Montée des Marches</span><span class="date">18.05.16 . 18:56</span><h2>Sandrine Kiberlain et Chiara Mastroianni</h2>'
           data-credit="Crédit Image : Cyril Duchêne / FDC"></a>
        <img data-original="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/06/thumb_5696_media_image_640x404.jpg"  alt="" title="Sandrine Kiberlain et Chiara Mastroianni" class="lazy">
        <div class="picto"><i class="icon icon_photo"></i></div>
        <div class="info">
          <div class="vCenter">
            <div class="vCenterKid">
              <span class="category">Montée des Marches</span>
              <span class="date">18.05.16</span> . <span
                  class="hour">18:56</span>
              <p data-title="Sandrine Kiberlain et Chiara Mastroianni">Sandrine Kiberlain et Chiara Mastroianni</p>
            </div>
          </div>
        </div>
      </div>
      <div class="item montee-des-marches 18-05-16 shadow-bottom photo paysage notloaded">
        <a id="photo1468" class="ajax chocolat-image" data-pid="1468"
           href="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/06/1cefa78d277aa3fa75051c36442ca3890fad7ca7.jpg"
           title='<span class="category">Montée des Marches</span><span class="date">18.05.16 . 18:53</span><h2>Camille Moreau, Julie Depardieu et Julie Gayet</h2>'
           data-credit="Crédit Image : Loic Venance / AFP"></a>
        <img data-original="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/06/thumb_5703_media_image_640x404.jpg"  alt="" title="Camille Moreau, Julie Depardieu et Julie Gayet" class="lazy">
        <div class="picto"><i class="icon icon_photo"></i></div>
        <div class="info">
          <div class="vCenter">
            <div class="vCenterKid">
              <span class="category">Montée des Marches</span>
              <span class="date">18.05.16</span> . <span
                  class="hour">18:53</span>
              <p data-title="Camille Moreau, Julie Depardieu et Julie Gayet">Camille Moreau, Julie Depardieu et Julie Gayet</p>
            </div>
          </div>
        </div>
      </div>
      <div class="item montee-des-marches 18-05-16 shadow-bottom photo paysage notloaded">
        <a id="photo1461" class="ajax chocolat-image" data-pid="1461"
           href="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/06/b379b2e9771bf3702250e5a976ffbb364a9308c1.jpg"
           title='<span class="category">Montée des Marches</span><span class="date">18.05.16 . 18:52</span><h2>Helen Mirren</h2>'
           data-credit="Crédit Image : Antonin Thuillier / AFP"></a>
        <img data-original="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/06/thumb_5694_media_image_640x404.jpg"  alt="" title="Helen Mirren" class="lazy">
        <div class="picto"><i class="icon icon_photo"></i></div>
        <div class="info">
          <div class="vCenter">
            <div class="vCenterKid">
              <span class="category">Montée des Marches</span>
              <span class="date">18.05.16</span> . <span
                  class="hour">18:52</span>
              <p data-title="Helen Mirren">Helen Mirren</p>
            </div>
          </div>
        </div>
      </div>
      <div class="item montee-des-marches 18-05-16 shadow-bottom photo paysage notloaded">
        <a id="photo1460" class="ajax chocolat-image" data-pid="1460"
           href="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/06/7b6867d45d521d0e79de123d3b1291a24e2a7bd5.jpg"
           title='<span class="category">Montée des Marches</span><span class="date">18.05.16 . 18:50</span><h2>Laetitia Casta</h2>'
           data-credit=""></a>
        <img data-original="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/06/thumb_5693_media_image_640x404.jpg"  alt="Cyril Duchêne / FDC" title="Laetitia Casta" class="lazy">
        <div class="picto"><i class="icon icon_photo"></i></div>
        <div class="info">
          <div class="vCenter">
            <div class="vCenterKid">
              <span class="category">Montée des Marches</span>
              <span class="date">18.05.16</span> . <span
                  class="hour">18:50</span>
              <p data-title="Laetitia Casta">Laetitia Casta</p>
            </div>
          </div>
        </div>
      </div>
      <div class="item evenement 18-05-16 shadow-bottom photo paysage notloaded">
        <a id="photo1474" class="ajax chocolat-image" data-pid="1474"
           href="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/06/885fcac73d5614936528b8e51f8c6899ae194c40.jpg"
           title='<span class="category">Évènement</span><span class="date">18.05.16 . 17:58</span><h2>William Friedkin - Leçon de Cinéma</h2>'
           data-credit="Crédit Image : Anne-Christine Poujoulat / AFP"></a>
        <img data-original="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/06/thumb_5707_media_image_640x404.jpg"  alt="" title="William Friedkin - Leçon de Cinéma" class="lazy">
        <div class="picto"><i class="icon icon_photo"></i></div>
        <div class="info">
          <div class="vCenter">
            <div class="vCenterKid">
              <span class="category">Évènement</span>
              <span class="date">18.05.16</span> . <span
                  class="hour">17:58</span>
              <p data-title="William Friedkin - Leçon de Cinéma">William Friedkin - Leçon de Cinéma</p>
            </div>
          </div>
        </div>
      </div>
      <div class="item evenement 18-05-16 shadow-bottom photo paysage notloaded">
        <a id="photo1472" class="ajax chocolat-image" data-pid="1472"
           href="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/06/2704ab063e25f19e70fdca151f0582129d617942.jpg"
           title='<span class="category">Évènement</span><span class="date">18.05.16 . 17:29</span><h2>William Friedkin - Leçon de cinéma</h2>'
           data-credit="Crédit Image : Cyril Duchêne / FDC"></a>
        <img data-original="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/06/thumb_5705_media_image_640x404.jpg"  alt="" title="William Friedkin - Leçon de cinéma" class="lazy">
        <div class="picto"><i class="icon icon_photo"></i></div>
        <div class="info">
          <div class="vCenter">
            <div class="vCenterKid">
              <span class="category">Évènement</span>
              <span class="date">18.05.16</span> . <span
                  class="hour">17:29</span>
              <p data-title="William Friedkin - Leçon de cinéma">William Friedkin - Leçon de cinéma</p>
            </div>
          </div>
        </div>
      </div>
      <div class="item evenement 18-05-16 shadow-bottom photo paysage notloaded">
        <a id="photo1443" class="ajax chocolat-image" data-pid="1443"
           href="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/06/f679707b539824478f0c2ad240f557d49121586d.jpg"
           title='<span class="category">Évènement</span><span class="date">18.05.16 . 17:15</span><h2>William Friedkin - Leçon de cinéma</h2>'
           data-credit="Crédit Image : Cyril Duchêne / FDC"></a>
        <img data-original="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/06/thumb_5682_media_image_640x404.jpg"  alt="" title="William Friedkin - Leçon de cinéma" class="lazy">
        <div class="picto"><i class="icon icon_photo"></i></div>
        <div class="info">
          <div class="vCenter">
            <div class="vCenterKid">
              <span class="category">Évènement</span>
              <span class="date">18.05.16</span> . <span
                  class="hour">17:15</span>
              <p data-title="William Friedkin - Leçon de cinéma">William Friedkin - Leçon de cinéma</p>
            </div>
          </div>
        </div>
      </div>
      <div class="item sur-scene 18-05-16 shadow-bottom photo paysage notloaded">
        <a id="photo1439" class="ajax chocolat-image" data-pid="1439"
           href="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/06/c10d0666d7d7c2a6748edaeabfce733d341de571.jpg"
           title='<span class="category">Sur Scène</span><span class="date">18.05.16 . 16:30</span><h2>Équipe du film - La Tortue Rouge</h2>'
           data-credit="Crédit Image : Thomas Leibreich / FDC"></a>
        <img data-original="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/06/thumb_5677_media_image_640x404.jpg"  alt="" title="Équipe du film - La Tortue Rouge" class="lazy">
        <div class="picto"><i class="icon icon_photo"></i></div>
        <div class="info">
          <div class="vCenter">
            <div class="vCenterKid">
              <span class="category">Sur Scène</span>
              <span class="date">18.05.16</span> . <span
                  class="hour">16:30</span>
              <p data-title="Équipe du film - La Tortue Rouge">Équipe du film - La Tortue Rouge</p>
            </div>
          </div>
        </div>
      </div>
      <div class="item montee-des-marches 18-05-16 shadow-bottom photo paysage notloaded">
        <a id="photo1430" class="ajax chocolat-image" data-pid="1430"
           href="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/06/e3a13cf1182b57cef533cbe86b9f3c1ce1172c04.jpg"
           title='<span class="category">Montée des Marches</span><span class="date">18.05.16 . 15:38</span><h2>Neil Ryan P.Sese, Andi Eigenmann et Brillante Mendoza - Ma&#039;Rosa</h2>'
           data-credit="Crédit Image : Loïc Venance / AFP"></a>
        <img data-original="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/06/thumb_5669_media_image_640x404.jpg"  alt="" title="Neil Ryan P.Sese, Andi Eigenmann et Brillante Mendoza - Ma&#039;Rosa" class="lazy">
        <div class="picto"><i class="icon icon_photo"></i></div>
        <div class="info">
          <div class="vCenter">
            <div class="vCenterKid">
              <span class="category">Montée des Marches</span>
              <span class="date">18.05.16</span> . <span
                  class="hour">15:38</span>
              <p data-title="Neil Ryan P.Sese, Andi Eigenmann et Brillante Mendoza - Ma&#039;Rosa">Neil Ryan P.Sese, Andi Eigenmann et Brillante Mendoza - Ma&#039;Rosa</p>
            </div>
          </div>
        </div>
      </div>
      <div class="item montee-des-marches 18-05-16 shadow-bottom photo paysage notloaded">
        <a id="photo1429" class="ajax chocolat-image" data-pid="1429"
           href="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/06/e188c8b8dec09475b2c3cb813c4a8a087c414e0f.jpg"
           title='<span class="category">Montée des Marches</span><span class="date">18.05.16 . 15:36</span><h2>Équipe du film - Ma&#039;Rosa</h2>'
           data-credit="Crédit Image : Loïc Venance / AFP"></a>
        <img data-original="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/06/thumb_5667_media_image_640x404.jpg"  alt="" title="Équipe du film - Ma&#039;Rosa" class="lazy">
        <div class="picto"><i class="icon icon_photo"></i></div>
        <div class="info">
          <div class="vCenter">
            <div class="vCenterKid">
              <span class="category">Montée des Marches</span>
              <span class="date">18.05.16</span> . <span
                  class="hour">15:36</span>
              <p data-title="Équipe du film - Ma&#039;Rosa">Équipe du film - Ma&#039;Rosa</p>
            </div>
          </div>
        </div>
      </div>
      <div class="item montee-des-marches 18-05-16 shadow-bottom photo paysage notloaded">
        <a id="photo1431" class="ajax chocolat-image" data-pid="1431"
           href="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/06/0f76a215e9b2892c5c55b020ebe938c52b95cf1e.jpg"
           title='<span class="category">Montée des Marches</span><span class="date">18.05.16 . 15:35</span><h2>Équipe du film - Ma&#039;Rosa</h2>'
           data-credit="Crédit Image : Léo Laumont / FDC"></a>
        <img data-original="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/06/thumb_5670_media_image_640x404.jpg"  alt="" title="Équipe du film - Ma&#039;Rosa" class="lazy">
        <div class="picto"><i class="icon icon_photo"></i></div>
        <div class="info">
          <div class="vCenter">
            <div class="vCenterKid">
              <span class="category">Montée des Marches</span>
              <span class="date">18.05.16</span> . <span
                  class="hour">15:35</span>
              <p data-title="Équipe du film - Ma&#039;Rosa">Équipe du film - Ma&#039;Rosa</p>
            </div>
          </div>
        </div>
      </div>
      <div class="item sur-scene 18-05-16 shadow-bottom photo paysage notloaded">
        <a id="photo1440" class="ajax chocolat-image" data-pid="1440"
           href="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/06/d867723291da0c699ad57d4f03661a3643d01a93.jpg"
           title='<span class="category">Sur Scène</span><span class="date">18.05.16 . 15:35</span><h2>Michaël Dukok - La Tortue Rouge</h2>'
           data-credit="Crédit Image : Thomas Leibreich / FDC"></a>
        <img data-original="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/06/thumb_5679_media_image_640x404.jpg"  alt="" title="Michaël Dukok - La Tortue Rouge" class="lazy">
        <div class="picto"><i class="icon icon_photo"></i></div>
        <div class="info">
          <div class="vCenter">
            <div class="vCenterKid">
              <span class="category">Sur Scène</span>
              <span class="date">18.05.16</span> . <span
                  class="hour">15:35</span>
              <p data-title="Michaël Dukok - La Tortue Rouge">Michaël Dukok - La Tortue Rouge</p>
            </div>
          </div>
        </div>
      </div>
      <div class="item montee-des-marches 18-05-16 shadow-bottom photo portrait notloaded">
        <a id="photo1428" class="ajax chocolat-image" data-pid="1428"
           href="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/06/35c72f7081db44df4601cd8da38964058adc8357.jpg"
           title='<span class="category">Montée des Marches</span><span class="date">18.05.16 . 15:34</span><h2>Jaclyn Jose et Andi Eigenmann - Ma&#039;Rosa</h2>'
           data-credit="Crédit Image : Loïc Venance / AFP"></a>
        <img data-original="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/06/thumb_5668_media_image_320x404.jpg"  alt="" title="Jaclyn Jose et Andi Eigenmann - Ma&#039;Rosa" class="lazy">
        <div class="picto"><i class="icon icon_photo"></i></div>
        <div class="info">
          <div class="vCenter">
            <div class="vCenterKid">
              <span class="category">Montée des Marches</span>
              <span class="date">18.05.16</span> . <span
                  class="hour">15:34</span>
              <p data-title="Jaclyn Jose et Andi Eigenmann - Ma&#039;Rosa">Jaclyn Jose et Andi Eigenmann - Ma&#039;Rosa</p>
            </div>
          </div>
        </div>
      </div>
      <div class="item conference-de-presse 18-05-16 shadow-bottom photo paysage notloaded">
        <a id="photo1425" class="ajax chocolat-image" data-pid="1425"
           href="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/06/7dbcee3f659e0162fc36485881329c4c43bb825a.jpg"
           title='<span class="category">Conférence de Presse</span><span class="date">18.05.16 . 15:32</span><h2>Kunimura Jun - Goksung (The Stranger)</h2>'
           data-credit="Crédit Image : Cyril Duchêne / FDC"></a>
        <img data-original="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/06/thumb_5665_media_image_640x404.jpg"  alt="" title="Kunimura Jun - Goksung (The Stranger)" class="lazy">
        <div class="picto"><i class="icon icon_photo"></i></div>
        <div class="info">
          <div class="vCenter">
            <div class="vCenterKid">
              <span class="category">Conférence de Presse</span>
              <span class="date">18.05.16</span> . <span
                  class="hour">15:32</span>
              <p data-title="Kunimura Jun - Goksung (The Stranger)">Kunimura Jun - Goksung (The Stranger)</p>
            </div>
          </div>
        </div>
      </div>
      <div class="item conference-de-presse 18-05-16 shadow-bottom photo paysage notloaded">
        <a id="photo1424" class="ajax chocolat-image" data-pid="1424"
           href="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/06/d362df3b71fa451e8d0b346d7dbc59e5e084de21.jpg"
           title='<span class="category">Conférence de Presse</span><span class="date">18.05.16 . 15:30</span><h2>Chun Woo Hee  et Na Hong Jin  - Goksung (The Strangers)</h2>'
           data-credit="Crédit Image : Cyril Duchêne / FDC"></a>
        <img data-original="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/06/thumb_5664_media_image_640x404.jpg"  alt="" title="Chun Woo Hee  et Na Hong Jin  - Goksung (The Strangers)" class="lazy">
        <div class="picto"><i class="icon icon_photo"></i></div>
        <div class="info">
          <div class="vCenter">
            <div class="vCenterKid">
              <span class="category">Conférence de Presse</span>
              <span class="date">18.05.16</span> . <span
                  class="hour">15:30</span>
              <p data-title="Chun Woo Hee  et Na Hong Jin  - Goksung (The Strangers)">Chun Woo Hee  et Na Hong Jin  - Goksung (The Strangers)</p>
            </div>
          </div>
        </div>
      </div>
      <div class="item sur-scene 18-05-16 shadow-bottom photo paysage notloaded">
        <a id="photo1422" class="ajax chocolat-image" data-pid="1422"
           href="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/06/4ce7115b0ab6c32e9301c24482353c4ad03a5fe0.jpg"
           title='<span class="category">Sur Scène</span><span class="date">18.05.16 . 15:15</span><h2>Thierry Frémaux et Guy Bedos - Dragées au poivre</h2>'
           data-credit="Crédit Image : Thomas Leibreich / FDC"></a>
        <img data-original="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/06/thumb_5662_media_image_640x404.jpg"  alt="" title="Thierry Frémaux et Guy Bedos - Dragées au poivre" class="lazy">
        <div class="picto"><i class="icon icon_photo"></i></div>
        <div class="info">
          <div class="vCenter">
            <div class="vCenterKid">
              <span class="category">Sur Scène</span>
              <span class="date">18.05.16</span> . <span
                  class="hour">15:15</span>
              <p data-title="Thierry Frémaux et Guy Bedos - Dragées au poivre">Thierry Frémaux et Guy Bedos - Dragées au poivre</p>
            </div>
          </div>
        </div>
      </div>
      <div class="item conference-de-presse 18-05-16 shadow-bottom photo portrait notloaded">
        <a id="photo1420" class="ajax chocolat-image" data-pid="1420"
           href="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/06/76d55b11b6770d07acfa9b8c93e19a26b0196725.jpg"
           title='<span class="category">Conférence de Presse</span><span class="date">18.05.16 . 14:03</span><h2>Sonia Braga - Aquarius</h2>'
           data-credit="Crédit Image : Léo Laumont / FDC"></a>
        <img data-original="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/06/thumb_5659_media_image_320x404.jpg"  alt="" title="Sonia Braga - Aquarius" class="lazy">
        <div class="picto"><i class="icon icon_photo"></i></div>
        <div class="info">
          <div class="vCenter">
            <div class="vCenterKid">
              <span class="category">Conférence de Presse</span>
              <span class="date">18.05.16</span> . <span
                  class="hour">14:03</span>
              <p data-title="Sonia Braga - Aquarius">Sonia Braga - Aquarius</p>
            </div>
          </div>
        </div>
      </div>
      <div class="item conference-de-presse 18-05-16 shadow-bottom photo paysage notloaded">
        <a id="photo1417" class="ajax chocolat-image" data-pid="1417"
           href="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/06/437c8ed8fe6a2aba6ca8f52c6955926652d8c5a4.jpg"
           title='<span class="category">Conférence de Presse</span><span class="date">18.05.16 . 14:00</span><h2>Kleber Mendoca Filho, Humberto Carrao et Émilie Lesclaux - Aquarius</h2>'
           data-credit="Crédit Image : Léo Laumont / FDC"></a>
        <img data-original="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/06/thumb_5656_media_image_640x404.jpg"  alt="" title="Kleber Mendoca Filho, Humberto Carrao et Émilie Lesclaux - Aquarius" class="lazy">
        <div class="picto"><i class="icon icon_photo"></i></div>
        <div class="info">
          <div class="vCenter">
            <div class="vCenterKid">
              <span class="category">Conférence de Presse</span>
              <span class="date">18.05.16</span> . <span
                  class="hour">14:00</span>
              <p data-title="Kleber Mendoca Filho, Humberto Carrao et Émilie Lesclaux - Aquarius">Kleber Mendoca Filho, Humberto Carrao et Émilie Lesclaux - Aquarius</p>
            </div>
          </div>
        </div>
      </div>
      <div class="item photocall 18-05-16 shadow-bottom photo paysage notloaded">
        <a id="photo1403" class="ajax chocolat-image" data-pid="1403"
           href="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/06/69cd415fd20d3247453c0c9f430bf8fc3d6afca4.jpg"
           title='<span class="category">Photocall</span><span class="date">18.05.16 . 13:43</span><h2>Équipe du film - Aquarius</h2>'
           data-credit="Crédit Image : Thomas Leibreich / FDC"></a>
        <img data-original="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/06/thumb_5649_media_image_640x404.jpg"  alt="" title="Équipe du film - Aquarius" class="lazy">
        <div class="picto"><i class="icon icon_photo"></i></div>
        <div class="info">
          <div class="vCenter">
            <div class="vCenterKid">
              <span class="category">Photocall</span>
              <span class="date">18.05.16</span> . <span
                  class="hour">13:43</span>
              <p data-title="Équipe du film - Aquarius">Équipe du film - Aquarius</p>
            </div>
          </div>
        </div>
      </div>
      <div class="item photocall 18-05-16 shadow-bottom photo portrait notloaded">
        <a id="photo1402" class="ajax chocolat-image" data-pid="1402"
           href="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/06/ef3872a2afed8e1a73851c1a42bd203e8b3cd586.jpg"
           title='<span class="category">Photocall</span><span class="date">18.05.16 . 13:40</span><h2>Michaël Dukok de Wit - La Tortue Rouge</h2>'
           data-credit="Crédit Image : Mathilde Petit / FDC"></a>
        <img data-original="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/06/thumb_5646_media_image_320x404.jpg"  alt="" title="Michaël Dukok de Wit - La Tortue Rouge" class="lazy">
        <div class="picto"><i class="icon icon_photo"></i></div>
        <div class="info">
          <div class="vCenter">
            <div class="vCenterKid">
              <span class="category">Photocall</span>
              <span class="date">18.05.16</span> . <span
                  class="hour">13:40</span>
              <p data-title="Michaël Dukok de Wit - La Tortue Rouge">Michaël Dukok de Wit - La Tortue Rouge</p>
            </div>
          </div>
        </div>
      </div>
      <div class="item photocall 18-05-16 shadow-bottom photo paysage notloaded">
        <a id="photo1401" class="ajax chocolat-image" data-pid="1401"
           href="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/06/4c4876f780f90c3b94ec4b3b6794638de9284a8d.jpg"
           title='<span class="category">Photocall</span><span class="date">18.05.16 . 13:38</span><h2>Toshio Suzuki et Michaël Dukok de Wit - La Tortue Rouge</h2>'
           data-credit="Crédit Image : Mathilde Petit / FDC"></a>
        <img data-original="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/06/thumb_5645_media_image_640x404.jpg"  alt="" title="Toshio Suzuki et Michaël Dukok de Wit - La Tortue Rouge" class="lazy">
        <div class="picto"><i class="icon icon_photo"></i></div>
        <div class="info">
          <div class="vCenter">
            <div class="vCenterKid">
              <span class="category">Photocall</span>
              <span class="date">18.05.16</span> . <span
                  class="hour">13:38</span>
              <p data-title="Toshio Suzuki et Michaël Dukok de Wit - La Tortue Rouge">Toshio Suzuki et Michaël Dukok de Wit - La Tortue Rouge</p>
            </div>
          </div>
        </div>
      </div>
      <div class="item photocall 18-05-16 shadow-bottom photo paysage notloaded">
        <a id="photo1400" class="ajax chocolat-image" data-pid="1400"
           href="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/06/dbf055222b4e93b7fd7f9ef3fce88b6f277c75d7.jpg"
           title='<span class="category">Photocall</span><span class="date">18.05.16 . 13:36</span><h2>Sahar Dolatshahi - Varoonegi (Inversion)</h2>'
           data-credit="Crédit Image : Mathilde Petit / FDC"></a>
        <img data-original="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/06/thumb_5644_media_image_640x404.jpg"  alt="" title="Sahar Dolatshahi - Varoonegi (Inversion)" class="lazy">
        <div class="picto"><i class="icon icon_photo"></i></div>
        <div class="info">
          <div class="vCenter">
            <div class="vCenterKid">
              <span class="category">Photocall</span>
              <span class="date">18.05.16</span> . <span
                  class="hour">13:36</span>
              <p data-title="Sahar Dolatshahi - Varoonegi (Inversion)">Sahar Dolatshahi - Varoonegi (Inversion)</p>
            </div>
          </div>
        </div>
      </div>
      <div class="item photocall 18-05-16 shadow-bottom photo paysage notloaded">
        <a id="photo1399" class="ajax chocolat-image" data-pid="1399"
           href="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/06/3e980a7efaa7edfdbef1510a685a2f6782c475f6.jpg"
           title='<span class="category">Photocall</span><span class="date">18.05.16 . 13:35</span><h2>Équipe du film - Varoonegi (Inversion)</h2>'
           data-credit="Crédit Image : Mathilde Petit / FDC"></a>
        <img data-original="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/06/thumb_5643_media_image_640x404.jpg"  alt="" title="Équipe du film - Varoonegi (Inversion)" class="lazy">
        <div class="picto"><i class="icon icon_photo"></i></div>
        <div class="info">
          <div class="vCenter">
            <div class="vCenterKid">
              <span class="category">Photocall</span>
              <span class="date">18.05.16</span> . <span
                  class="hour">13:35</span>
              <p data-title="Équipe du film - Varoonegi (Inversion)">Équipe du film - Varoonegi (Inversion)</p>
            </div>
          </div>
        </div>
      </div>
      <div class="item photocall 18-05-16 shadow-bottom photo paysage notloaded">
        <a id="photo1398" class="ajax chocolat-image" data-pid="1398"
           href="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/06/4c7ff7e604802d925ae2c3f2e0fd18c493c60504.jpg"
           title='<span class="category">Photocall</span><span class="date">18.05.16 . 13:33</span><h2>Équipe du film - Aquarius</h2>'
           data-credit="Crédit Image : Mathilde Petit / FDC"></a>
        <img data-original="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/06/thumb_5642_media_image_640x404.jpg"  alt="" title="Équipe du film - Aquarius" class="lazy">
        <div class="picto"><i class="icon icon_photo"></i></div>
        <div class="info">
          <div class="vCenter">
            <div class="vCenterKid">
              <span class="category">Photocall</span>
              <span class="date">18.05.16</span> . <span
                  class="hour">13:33</span>
              <p data-title="Équipe du film - Aquarius">Équipe du film - Aquarius</p>
            </div>
          </div>
        </div>
      </div>
      <div class="item conference-de-presse 18-05-16 shadow-bottom photo paysage notloaded">
        <a id="photo1394" class="ajax chocolat-image" data-pid="1394"
           href="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/06/6c9a6d9f81e854f0e0750cdc1822b5f363bf9631.jpg"
           title='<span class="category">Conférence de Presse</span><span class="date">18.05.16 . 13:32</span><h2>Andi Eigenmann - Ma&#039; Rosa</h2>'
           data-credit="Crédit Image : Thomas Leibreich / FDC"></a>
        <img data-original="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/06/thumb_5638_media_image_640x404.jpg"  alt="" title="Andi Eigenmann - Ma&#039; Rosa" class="lazy">
        <div class="picto"><i class="icon icon_photo"></i></div>
        <div class="info">
          <div class="vCenter">
            <div class="vCenterKid">
              <span class="category">Conférence de Presse</span>
              <span class="date">18.05.16</span> . <span
                  class="hour">13:32</span>
              <p data-title="Andi Eigenmann - Ma&#039; Rosa">Andi Eigenmann - Ma&#039; Rosa</p>
            </div>
          </div>
        </div>
      </div>
      <div class="item photocall 18-05-16 shadow-bottom photo portrait notloaded">
        <a id="photo1396" class="ajax chocolat-image" data-pid="1396"
           href="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/06/0e5f1a0deb140fc74db11681649e1bbde95d06f2.jpg"
           title='<span class="category">Photocall</span><span class="date">18.05.16 . 13:31</span><h2>Sonia Braga - Aquarius</h2>'
           data-credit="Crédit Image : Anne-Christine Poujoulat / AFP"></a>
        <img data-original="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/06/thumb_5640_media_image_320x404.jpg"  alt="" title="Sonia Braga - Aquarius" class="lazy">
        <div class="picto"><i class="icon icon_photo"></i></div>
        <div class="info">
          <div class="vCenter">
            <div class="vCenterKid">
              <span class="category">Photocall</span>
              <span class="date">18.05.16</span> . <span
                  class="hour">13:31</span>
              <p data-title="Sonia Braga - Aquarius">Sonia Braga - Aquarius</p>
            </div>
          </div>
        </div>
      </div>
      <div class="item photocall 18-05-16 shadow-bottom photo paysage notloaded">
        <a id="photo1397" class="ajax chocolat-image" data-pid="1397"
           href="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/06/15804a81328a6e937e36110e49f41dc31933d1f3.jpg"
           title='<span class="category">Photocall</span><span class="date">18.05.16 . 13:30</span><h2>Maeve Jinkings - Aquarius</h2>'
           data-credit="Crédit Image : Anne-Christine Poujoulat / AFP"></a>
        <img data-original="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/06/thumb_5641_media_image_640x404.jpg"  alt="" title="Maeve Jinkings - Aquarius" class="lazy">
        <div class="picto"><i class="icon icon_photo"></i></div>
        <div class="info">
          <div class="vCenter">
            <div class="vCenterKid">
              <span class="category">Photocall</span>
              <span class="date">18.05.16</span> . <span
                  class="hour">13:30</span>
              <p data-title="Maeve Jinkings - Aquarius">Maeve Jinkings - Aquarius</p>
            </div>
          </div>
        </div>
      </div>
      <div class="item conference-de-presse 18-05-16 shadow-bottom photo paysage notloaded">
        <a id="photo1392" class="ajax chocolat-image" data-pid="1392"
           href="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/06/1757d8ae123fe2d39510f92cc5d472c58ca290ea.jpg"
           title='<span class="category">Conférence de Presse</span><span class="date">18.05.16 . 12:30</span><h2>Équipe du film - Ma&#039; Rosa</h2>'
           data-credit="Crédit Image : Thomas Leibreich / FDC"></a>
        <img data-original="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/06/thumb_5636_media_image_640x404.jpg"  alt="" title="Équipe du film - Ma&#039; Rosa" class="lazy">
        <div class="picto"><i class="icon icon_photo"></i></div>
        <div class="info">
          <div class="vCenter">
            <div class="vCenterKid">
              <span class="category">Conférence de Presse</span>
              <span class="date">18.05.16</span> . <span
                  class="hour">12:30</span>
              <p data-title="Équipe du film - Ma&#039; Rosa">Équipe du film - Ma&#039; Rosa</p>
            </div>
          </div>
        </div>
      </div>
      <div class="item evenement 18-05-16 shadow-bottom photo paysage notloaded">
        <a id="photo1382" class="ajax chocolat-image" data-pid="1382"
           href="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/06/a5902a15291f5aece662d2d9e247a481a9a2d077.jpg"
           title='<span class="category">Évènement</span><span class="date">18.05.16 . 12:10</span><h2>William Friedkin - Leçon de Cinéma</h2>'
           data-credit="Crédit Image : Léo Laumont / FDC"></a>
        <img data-original="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/06/thumb_5627_media_image_640x404.jpg"  alt="" title="William Friedkin - Leçon de Cinéma" class="lazy">
        <div class="picto"><i class="icon icon_photo"></i></div>
        <div class="info">
          <div class="vCenter">
            <div class="vCenterKid">
              <span class="category">Évènement</span>
              <span class="date">18.05.16</span> . <span
                  class="hour">12:10</span>
              <p data-title="William Friedkin - Leçon de Cinéma">William Friedkin - Leçon de Cinéma</p>
            </div>
          </div>
        </div>
      </div>
      <div class="item photocall 18-05-16 shadow-bottom photo portrait notloaded">
        <a id="photo1377" class="ajax chocolat-image" data-pid="1377"
           href="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/06/e9841f6b3976055177d46cc3d7ac0883a74bebd0.jpg"
           title='<span class="category">Photocall</span><span class="date">18.05.16 . 12:08</span><h2>Kore Eda Hirokazu - Umi Yorimo Mada Fukaku (After the Storm)</h2>'
           data-credit="Crédit Image : Léo Laumont / FDC"></a>
        <img data-original="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/06/thumb_5623_media_image_320x404.jpg"  alt="" title="Kore Eda Hirokazu - Umi Yorimo Mada Fukaku (After the Storm)" class="lazy">
        <div class="picto"><i class="icon icon_photo"></i></div>
        <div class="info">
          <div class="vCenter">
            <div class="vCenterKid">
              <span class="category">Photocall</span>
              <span class="date">18.05.16</span> . <span
                  class="hour">12:08</span>
              <p data-title="Kore Eda Hirokazu - Umi Yorimo Mada Fukaku (After the Storm)">Kore Eda Hirokazu - Umi Yorimo Mada Fukaku (After the Storm)</p>
            </div>
          </div>
        </div>
      </div>
      <div class="item photocall 18-05-16 shadow-bottom photo paysage notloaded">
        <a id="photo1376" class="ajax chocolat-image" data-pid="1376"
           href="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/06/5828285d897bd752b4837eddb536e1ad3f2c2a0e.jpg"
           title='<span class="category">Photocall</span><span class="date">18.05.16 . 12:06</span><h2>Kilin Kiki, Abe Hiroshi, Maki Yoko et Kore Eda Hirokazu - Umi Yorimo Mada Fukaku (After the Storm)</h2>'
           data-credit="Crédit Image : Léo Laumont / FDC"></a>
        <img data-original="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/06/thumb_5622_media_image_640x404.jpg"  alt="" title="Kilin Kiki, Abe Hiroshi, Maki Yoko et Kore Eda Hirokazu - Umi Yorimo Mada Fukaku (After the Storm)" class="lazy">
        <div class="picto"><i class="icon icon_photo"></i></div>
        <div class="info">
          <div class="vCenter">
            <div class="vCenterKid">
              <span class="category">Photocall</span>
              <span class="date">18.05.16</span> . <span
                  class="hour">12:06</span>
              <p data-title="Kilin Kiki, Abe Hiroshi, Maki Yoko et Kore Eda Hirokazu - Umi Yorimo Mada Fukaku (After the Storm)">Kilin Kiki, Abe Hiroshi, Maki Yoko et Kore Eda Hirokazu - Umi Yorimo Mada Fukaku (After the Storm)</p>
            </div>
          </div>
        </div>
      </div>
      <div class="item photocall 18-05-16 shadow-bottom photo paysage notloaded">
        <a id="photo1375" class="ajax chocolat-image" data-pid="1375"
           href="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/06/13a6f0d59e9f9803d72b584f2c699434fcf1b707.jpg"
           title='<span class="category">Photocall</span><span class="date">18.05.16 . 12:05</span><h2>Équipe du film - Ma&#039;Rosa</h2>'
           data-credit="Crédit Image : Léo Laumont / FDC"></a>
        <img data-original="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/06/thumb_5620_media_image_640x404.jpg"  alt="" title="Équipe du film - Ma&#039;Rosa" class="lazy">
        <div class="picto"><i class="icon icon_photo"></i></div>
        <div class="info">
          <div class="vCenter">
            <div class="vCenterKid">
              <span class="category">Photocall</span>
              <span class="date">18.05.16</span> . <span
                  class="hour">12:05</span>
              <p data-title="Équipe du film - Ma&#039;Rosa">Équipe du film - Ma&#039;Rosa</p>
            </div>
          </div>
        </div>
      </div>
      <div class="item photocall 18-05-16 shadow-bottom photo paysage notloaded">
        <a id="photo1391" class="ajax chocolat-image" data-pid="1391"
           href="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/06/b73f92e347cdcc9afce127063fd9f6952fe3a537.jpg"
           title='<span class="category">Photocall</span><span class="date">18.05.16 . 12:05</span><h2>Ruby Ruiz - Ma&#039;Rosa</h2>'
           data-credit="Crédit Image : Mathilde Petit / FDC"></a>
        <img data-original="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/06/thumb_5635_media_image_640x404.jpg"  alt="" title="Ruby Ruiz - Ma&#039;Rosa" class="lazy">
        <div class="picto"><i class="icon icon_photo"></i></div>
        <div class="info">
          <div class="vCenter">
            <div class="vCenterKid">
              <span class="category">Photocall</span>
              <span class="date">18.05.16</span> . <span
                  class="hour">12:05</span>
              <p data-title="Ruby Ruiz - Ma&#039;Rosa">Ruby Ruiz - Ma&#039;Rosa</p>
            </div>
          </div>
        </div>
      </div>
      <div class="item photocall 18-05-16 shadow-bottom photo paysage notloaded">
        <a id="photo1374" class="ajax chocolat-image" data-pid="1374"
           href="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/06/69edd9e754cc98a72d1c95176702107a9e4f4f0c.jpg"
           title='<span class="category">Photocall</span><span class="date">18.05.16 . 12:01</span><h2>Maria Isabel Lopez, Jaclyn Jose, Angi Eigenmann - Ma&#039;Rosa</h2>'
           data-credit="Crédit Image : Léo Laumont / FDC"></a>
        <img data-original="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/06/thumb_5619_media_image_640x404.jpg"  alt="" title="Maria Isabel Lopez, Jaclyn Jose, Angi Eigenmann - Ma&#039;Rosa" class="lazy">
        <div class="picto"><i class="icon icon_photo"></i></div>
        <div class="info">
          <div class="vCenter">
            <div class="vCenterKid">
              <span class="category">Photocall</span>
              <span class="date">18.05.16</span> . <span
                  class="hour">12:01</span>
              <p data-title="Maria Isabel Lopez, Jaclyn Jose, Angi Eigenmann - Ma&#039;Rosa">Maria Isabel Lopez, Jaclyn Jose, Angi Eigenmann - Ma&#039;Rosa</p>
            </div>
          </div>
        </div>
      </div>
      <div class="item photocall 18-05-16 shadow-bottom photo paysage notloaded">
        <a id="photo1373" class="ajax chocolat-image" data-pid="1373"
           href="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/06/2abc4c0dc5aef0e6d593b8fc7369c93ec4fe5e6b.jpg"
           title='<span class="category">Photocall</span><span class="date">18.05.16 . 12:00</span><h2>Brillante Mendoza - Ma&#039;Rosa</h2>'
           data-credit="Crédit Image : Léo Laumont / FDC"></a>
        <img data-original="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/06/thumb_5618_media_image_640x404.jpg"  alt="" title="Brillante Mendoza - Ma&#039;Rosa" class="lazy">
        <div class="picto"><i class="icon icon_photo"></i></div>
        <div class="info">
          <div class="vCenter">
            <div class="vCenterKid">
              <span class="category">Photocall</span>
              <span class="date">18.05.16</span> . <span
                  class="hour">12:00</span>
              <p data-title="Brillante Mendoza - Ma&#039;Rosa">Brillante Mendoza - Ma&#039;Rosa</p>
            </div>
          </div>
        </div>
      </div>
      <div class="item evenement 18-05-16 shadow-bottom photo paysage notloaded">
        <a id="photo1381" class="ajax chocolat-image" data-pid="1381"
           href="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/06/89824a93971aec26a3191de6516ce68c4ec39a3d.jpg"
           title='<span class="category">Évènement</span><span class="date">18.05.16 . 11:28</span><h2>Naomi Kawase, Présidente du Jury Cinéfondation et Courts Métrages - Conversation avec Naomi Kawase</h2>'
           data-credit="Crédit Image : Cyril Duchêne / FDC"></a>
        <img data-original="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/06/thumb_5626_media_image_640x404.jpg"  alt="" title="Naomi Kawase, Présidente du Jury Cinéfondation et Courts Métrages - Conversation avec Naomi Kawase" class="lazy">
        <div class="picto"><i class="icon icon_photo"></i></div>
        <div class="info">
          <div class="vCenter">
            <div class="vCenterKid">
              <span class="category">Évènement</span>
              <span class="date">18.05.16</span> . <span
                  class="hour">11:28</span>
              <p data-title="Naomi Kawase, Présidente du Jury Cinéfondation et Courts Métrages - Conversation avec Naomi Kawase">Naomi Kawase, Présidente du Jury Cinéfondation et Courts Métrages - Conversation avec Naomi Kawase</p>
            </div>
          </div>
        </div>
      </div>
      <div class="item evenement 18-05-16 shadow-bottom photo paysage notloaded">
        <a id="photo1379" class="ajax chocolat-image" data-pid="1379"
           href="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/06/82e7de45401f1ea6b3b7d59049b14c3f61e45baa.jpg"
           title='<span class="category">Évènement</span><span class="date">18.05.16 . 11:25</span><h2>Naomi Kawase, Présidente du Jury Cinéfondation et Courts Métrages - Conversation avec Naomi Kawase</h2>'
           data-credit="Crédit Image : Cyril Duchêne / FDC"></a>
        <img data-original="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/06/thumb_5624_media_image_640x404.jpg"  alt="" title="Naomi Kawase, Présidente du Jury Cinéfondation et Courts Métrages - Conversation avec Naomi Kawase" class="lazy">
        <div class="picto"><i class="icon icon_photo"></i></div>
        <div class="info">
          <div class="vCenter">
            <div class="vCenterKid">
              <span class="category">Évènement</span>
              <span class="date">18.05.16</span> . <span
                  class="hour">11:25</span>
              <p data-title="Naomi Kawase, Présidente du Jury Cinéfondation et Courts Métrages - Conversation avec Naomi Kawase">Naomi Kawase, Présidente du Jury Cinéfondation et Courts Métrages - Conversation avec Naomi Kawase</p>
            </div>
          </div>
        </div>
      </div>
      <div class="item conference-de-presse 18-05-16 shadow-bottom photo paysage notloaded">
        <a id="photo1369" class="ajax chocolat-image" data-pid="1369"
           href="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/06/639a9ec3cf1107e69bd90cb88c9e82df3efd51c8.jpg"
           title='<span class="category">Conférence de Presse</span><span class="date">18.05.16 . 11:07</span><h2>Louka Minnella - La fille inconnue</h2>'
           data-credit="Crédit Image : Mathilde Petit / FDC"></a>
        <img data-original="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/06/thumb_5614_media_image_640x404.jpg"  alt="" title="Louka Minnella - La fille inconnue" class="lazy">
        <div class="picto"><i class="icon icon_photo"></i></div>
        <div class="info">
          <div class="vCenter">
            <div class="vCenterKid">
              <span class="category">Conférence de Presse</span>
              <span class="date">18.05.16</span> . <span
                  class="hour">11:07</span>
              <p data-title="Louka Minnella - La fille inconnue">Louka Minnella - La fille inconnue</p>
            </div>
          </div>
        </div>
      </div>
      <div class="item conference-de-presse 18-05-16 shadow-bottom photo paysage notloaded">
        <a id="photo1370" class="ajax chocolat-image" data-pid="1370"
           href="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/06/c98f07b965a56449b93525b769b3c850e5bf4144.jpg"
           title='<span class="category">Conférence de Presse</span><span class="date">18.05.16 . 11:05</span><h2>Olivier Bonnaud - La fille inconnue</h2>'
           data-credit="Crédit Image : Mathilde Petit / FDC"></a>
        <img data-original="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/06/thumb_5615_media_image_640x404.jpg"  alt="" title="Olivier Bonnaud - La fille inconnue" class="lazy">
        <div class="picto"><i class="icon icon_photo"></i></div>
        <div class="info">
          <div class="vCenter">
            <div class="vCenterKid">
              <span class="category">Conférence de Presse</span>
              <span class="date">18.05.16</span> . <span
                  class="hour">11:05</span>
              <p data-title="Olivier Bonnaud - La fille inconnue">Olivier Bonnaud - La fille inconnue</p>
            </div>
          </div>
        </div>
      </div>
      <div class="item sur-scene 18-05-16 shadow-bottom photo paysage notloaded">
        <a id="photo1367" class="ajax chocolat-image" data-pid="1367"
           href="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/06/8b25475bc50c82e3105805dda66d11a52072dd84.jpg"
           title='<span class="category">Sur Scène</span><span class="date">18.05.16 . 11:02</span><h2>Équipe du film - Varoonegi (Inversion)</h2>'
           data-credit="Crédit Image : Thomas Leibreich / FDC"></a>
        <img data-original="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/06/thumb_5611_media_image_640x404.jpg"  alt="" title="Équipe du film - Varoonegi (Inversion)" class="lazy">
        <div class="picto"><i class="icon icon_photo"></i></div>
        <div class="info">
          <div class="vCenter">
            <div class="vCenterKid">
              <span class="category">Sur Scène</span>
              <span class="date">18.05.16</span> . <span
                  class="hour">11:02</span>
              <p data-title="Équipe du film - Varoonegi (Inversion)">Équipe du film - Varoonegi (Inversion)</p>
            </div>
          </div>
        </div>
      </div>
      <div class="item montee-des-marches 18-05-16 shadow-bottom photo paysage notloaded">
        <a id="photo1365" class="ajax chocolat-image" data-pid="1365"
           href="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/06/f6c023ce3c16f3cc01c96961ca03efbb34214279.jpg"
           title='<span class="category">Montée des Marches</span><span class="date">18.05.16 . 11:00</span><h2>Équipe du film - Varoonegi (Inversion)</h2>'
           data-credit="Crédit Image : Thomas Leibreich / FDC"></a>
        <img data-original="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/06/thumb_5609_media_image_640x404.jpg"  alt="" title="Équipe du film - Varoonegi (Inversion)" class="lazy">
        <div class="picto"><i class="icon icon_photo"></i></div>
        <div class="info">
          <div class="vCenter">
            <div class="vCenterKid">
              <span class="category">Montée des Marches</span>
              <span class="date">18.05.16</span> . <span
                  class="hour">11:00</span>
              <p data-title="Équipe du film - Varoonegi (Inversion)">Équipe du film - Varoonegi (Inversion)</p>
            </div>
          </div>
        </div>
      </div>
      <div class="item photocall 18-05-16 shadow-bottom photo paysage notloaded">
        <a id="photo1362" class="ajax chocolat-image" data-pid="1362"
           href="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/06/8bd56bff8e3bb06059271cf982b244df9e80b180.jpg"
           title='<span class="category">Photocall</span><span class="date">18.05.16 . 10:57</span><h2>Ariane Labed, Muriel Colin, Delphine Colin et Soko - Voir du pays</h2>'
           data-credit="Crédit Image : Cyril Duchêne / FDC"></a>
        <img data-original="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/06/thumb_5606_media_image_640x404.jpg"  alt="" title="Ariane Labed, Muriel Colin, Delphine Colin et Soko - Voir du pays" class="lazy">
        <div class="picto"><i class="icon icon_photo"></i></div>
        <div class="info">
          <div class="vCenter">
            <div class="vCenterKid">
              <span class="category">Photocall</span>
              <span class="date">18.05.16</span> . <span
                  class="hour">10:57</span>
              <p data-title="Ariane Labed, Muriel Colin, Delphine Colin et Soko - Voir du pays">Ariane Labed, Muriel Colin, Delphine Colin et Soko - Voir du pays</p>
            </div>
          </div>
        </div>
      </div>
      <div class="item photocall 18-05-16 shadow-bottom photo paysage notloaded">
        <a id="photo1359" class="ajax chocolat-image" data-pid="1359"
           href="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/06/1c04b7de4e305072b96035805c4f22044bbe7baf.jpg"
           title='<span class="category">Photocall</span><span class="date">18.05.16 . 10:53</span><h2>Ariane Labed - Voir du pays</h2>'
           data-credit="Crédit Image : Cyril Duchêne / FDC"></a>
        <img data-original="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/06/thumb_5604_media_image_640x404.jpg"  alt="" title="Ariane Labed - Voir du pays" class="lazy">
        <div class="picto"><i class="icon icon_photo"></i></div>
        <div class="info">
          <div class="vCenter">
            <div class="vCenterKid">
              <span class="category">Photocall</span>
              <span class="date">18.05.16</span> . <span
                  class="hour">10:53</span>
              <p data-title="Ariane Labed - Voir du pays">Ariane Labed - Voir du pays</p>
            </div>
          </div>
        </div>
      </div>
      <div class="item photocall 18-05-16 shadow-bottom photo paysage notloaded">
        <a id="photo1358" class="ajax chocolat-image" data-pid="1358"
           href="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/06/e2fca00b14a17f32c046d11d3294c6fd96af6265.jpg"
           title='<span class="category">Photocall</span><span class="date">18.05.16 . 10:50</span><h2>Muriel et Delphine Coulin - Voir du pays</h2>'
           data-credit="Crédit Image : Cyril Duchêne / FDC"></a>
        <img data-original="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/06/thumb_5603_media_image_640x404.jpg"  alt="" title="Muriel et Delphine Coulin - Voir du pays" class="lazy">
        <div class="picto"><i class="icon icon_photo"></i></div>
        <div class="info">
          <div class="vCenter">
            <div class="vCenterKid">
              <span class="category">Photocall</span>
              <span class="date">18.05.16</span> . <span
                  class="hour">10:50</span>
              <p data-title="Muriel et Delphine Coulin - Voir du pays">Muriel et Delphine Coulin - Voir du pays</p>
            </div>
          </div>
        </div>
      </div>
      <div class="item photocall 18-05-16 shadow-bottom photo paysage notloaded">
        <a id="photo1357" class="ajax chocolat-image" data-pid="1357"
           href="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/06/daceafb5fe8c0eec020fcfb5e785c2b92d506e84.jpg"
           title='<span class="category">Photocall</span><span class="date">18.05.16 . 10:48</span><h2>Na Hong Jin, Kunimura Jun, Chun Woo Hee et Kwak Do Won - Goskung (The Strangers)</h2>'
           data-credit="Crédit Image : Cyril Duchêne / FDC"></a>
        <img data-original="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/06/thumb_5602_media_image_640x404.jpg"  alt="" title="Na Hong Jin, Kunimura Jun, Chun Woo Hee et Kwak Do Won - Goskung (The Strangers)" class="lazy">
        <div class="picto"><i class="icon icon_photo"></i></div>
        <div class="info">
          <div class="vCenter">
            <div class="vCenterKid">
              <span class="category">Photocall</span>
              <span class="date">18.05.16</span> . <span
                  class="hour">10:48</span>
              <p data-title="Na Hong Jin, Kunimura Jun, Chun Woo Hee et Kwak Do Won - Goskung (The Strangers)">Na Hong Jin, Kunimura Jun, Chun Woo Hee et Kwak Do Won - Goskung (The Strangers)</p>
            </div>
          </div>
        </div>
      </div>
      <div class="item photocall 18-05-16 shadow-bottom photo paysage notloaded">
        <a id="photo1355" class="ajax chocolat-image" data-pid="1355"
           href="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/06/3024553041c0fd9d5af3b9e3f23274e38a5d01c1.jpg"
           title='<span class="category">Photocall</span><span class="date">18.05.16 . 10:43</span><h2>Na Hong Jin - Goskung (The Strangers)</h2>'
           data-credit="Crédit Image : Cyril Duchêne / FDC"></a>
        <img data-original="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/06/thumb_5601_media_image_640x404.jpg"  alt="" title="Na Hong Jin - Goskung (The Strangers)" class="lazy">
        <div class="picto"><i class="icon icon_photo"></i></div>
        <div class="info">
          <div class="vCenter">
            <div class="vCenterKid">
              <span class="category">Photocall</span>
              <span class="date">18.05.16</span> . <span
                  class="hour">10:43</span>
              <p data-title="Na Hong Jin - Goskung (The Strangers)">Na Hong Jin - Goskung (The Strangers)</p>
            </div>
          </div>
        </div>
      </div>
      <div class="item photocall 18-05-16 shadow-bottom photo portrait notloaded">
        <a id="photo1354" class="ajax chocolat-image" data-pid="1354"
           href="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/06/a29d35eb485f774689a85ab490557720ac170a23.jpg"
           title='<span class="category">Photocall</span><span class="date">18.05.16 . 10:40</span><h2>Chun Woo Hee - Goksung (The Strangers)</h2>'
           data-credit="Crédit Image : Cyril Duchêne / FDC"></a>
        <img data-original="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/06/thumb_5600_media_image_320x404.jpg"  alt="" title="Chun Woo Hee - Goksung (The Strangers)" class="lazy">
        <div class="picto"><i class="icon icon_photo"></i></div>
        <div class="info">
          <div class="vCenter">
            <div class="vCenterKid">
              <span class="category">Photocall</span>
              <span class="date">18.05.16</span> . <span
                  class="hour">10:40</span>
              <p data-title="Chun Woo Hee - Goksung (The Strangers)">Chun Woo Hee - Goksung (The Strangers)</p>
            </div>
          </div>
        </div>
      </div>
      <div class="item photocall 18-05-16 shadow-bottom photo paysage notloaded">
        <a id="photo1360" class="ajax chocolat-image" data-pid="1360"
           href="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/06/3b2766c83e0898d04ae5d91dec2ac3a2d9cd9064.jpg"
           title='<span class="category">Photocall</span><span class="date">18.05.16 . 10:38</span><h2>Jean-Pierre Dardenne, Adèle Haenel et Luc Dardenne - La fille inconnue</h2>'
           data-credit="Crédit Image : Léo Laumont / FDC"></a>
        <img data-original="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/06/thumb_5605_media_image_640x404.jpg"  alt="" title="Jean-Pierre Dardenne, Adèle Haenel et Luc Dardenne - La fille inconnue" class="lazy">
        <div class="picto"><i class="icon icon_photo"></i></div>
        <div class="info">
          <div class="vCenter">
            <div class="vCenterKid">
              <span class="category">Photocall</span>
              <span class="date">18.05.16</span> . <span
                  class="hour">10:38</span>
              <p data-title="Jean-Pierre Dardenne, Adèle Haenel et Luc Dardenne - La fille inconnue">Jean-Pierre Dardenne, Adèle Haenel et Luc Dardenne - La fille inconnue</p>
            </div>
          </div>
        </div>
      </div>
      <div class="item photocall 18-05-16 shadow-bottom photo paysage notloaded">
        <a id="photo1353" class="ajax chocolat-image" data-pid="1353"
           href="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/06/c6176b3818af22978756718c26de19aab402c087.jpg"
           title='<span class="category">Photocall</span><span class="date">18.05.16 . 10:37</span><h2>La Fille inconnue de Jean-Pierre et Luc Dardenne</h2>'
           data-credit="Crédit Image : Cyril Duchêne"></a>
        <img data-original="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/06/thumb_5599_media_image_640x404.jpg"  alt="" title="La Fille inconnue de Jean-Pierre et Luc Dardenne" class="lazy">
        <div class="picto"><i class="icon icon_photo"></i></div>
        <div class="info">
          <div class="vCenter">
            <div class="vCenterKid">
              <span class="category">Photocall</span>
              <span class="date">18.05.16</span> . <span
                  class="hour">10:37</span>
              <p data-title="La Fille inconnue de Jean-Pierre et Luc Dardenne">La Fille inconnue de Jean-Pierre et Luc Dardenne</p>
            </div>
          </div>
        </div>
      </div>
      <div class="item photocall 18-05-16 shadow-bottom photo paysage notloaded">
        <a id="photo1351" class="ajax chocolat-image" data-pid="1351"
           href="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/06/77498767b83761a72df98440625634c7d8f9f8c2.jpg"
           title='<span class="category">Photocall</span><span class="date">18.05.16 . 10:35</span><h2>Adèle Haenel - La fille inconnue</h2>'
           data-credit="Crédit Image : Cyril Duchêne / FDC"></a>
        <img data-original="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/06/thumb_5598_media_image_640x404.jpg"  alt="" title="Adèle Haenel - La fille inconnue" class="lazy">
        <div class="picto"><i class="icon icon_photo"></i></div>
        <div class="info">
          <div class="vCenter">
            <div class="vCenterKid">
              <span class="category">Photocall</span>
              <span class="date">18.05.16</span> . <span
                  class="hour">10:35</span>
              <p data-title="Adèle Haenel - La fille inconnue">Adèle Haenel - La fille inconnue</p>
            </div>
          </div>
        </div>
      </div>
      <div class="item photocall 18-05-16 shadow-bottom photo paysage notloaded">
        <a id="photo1350" class="ajax chocolat-image" data-pid="1350"
           href="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/06/d3e572f46c85b85eee370b1fe8843383d6a77ed7.jpg"
           title='<span class="category">Photocall</span><span class="date">18.05.16 . 10:31</span><h2>Jean-Pierre et Luc Dardenne - La fille inconnue</h2>'
           data-credit="Crédit Image : Cyril Duchêne / FDC"></a>
        <img data-original="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/06/thumb_5597_media_image_640x404.jpg"  alt="" title="Jean-Pierre et Luc Dardenne - La fille inconnue" class="lazy">
        <div class="picto"><i class="icon icon_photo"></i></div>
        <div class="info">
          <div class="vCenter">
            <div class="vCenterKid">
              <span class="category">Photocall</span>
              <span class="date">18.05.16</span> . <span
                  class="hour">10:31</span>
              <p data-title="Jean-Pierre et Luc Dardenne - La fille inconnue">Jean-Pierre et Luc Dardenne - La fille inconnue</p>
            </div>
          </div>
        </div>
      </div>
      <div class="item photocall 18-05-16 shadow-bottom photo paysage notloaded">
        <a id="photo1349" class="ajax chocolat-image" data-pid="1349"
           href="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/06/85ef43da181ad7032946914c16791ab7b7bd65f1.jpg"
           title='<span class="category">Photocall</span><span class="date">18.05.16 . 10:30</span><h2>Équipe du film - La fille inconnue</h2>'
           data-credit="Crédit Image : Cyril Duchêne / FDC"></a>
        <img data-original="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/06/thumb_5596_media_image_640x404.jpg"  alt="" title="Équipe du film - La fille inconnue" class="lazy">
        <div class="picto"><i class="icon icon_photo"></i></div>
        <div class="info">
          <div class="vCenter">
            <div class="vCenterKid">
              <span class="category">Photocall</span>
              <span class="date">18.05.16</span> . <span
                  class="hour">10:30</span>
              <p data-title="Équipe du film - La fille inconnue">Équipe du film - La fille inconnue</p>
            </div>
          </div>
        </div>
      </div>
      <div class="item montee-des-marches 18-05-16 shadow-bottom photo paysage notloaded">
        <a id="photo1389" class="ajax chocolat-image" data-pid="1389"
           href="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/06/2fe03c93456324d6b3f4c388196abf689fd055c6.jpg"
           title='<span class="category">Montée des Marches</span><span class="date">18.05.16 . 10:30</span><h2>Les réalisateurs de la Sélection Cinéfondation 2016</h2>'
           data-credit="Crédit Image : Mathilde Petit / FDC"></a>
        <img data-original="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/06/thumb_5633_media_image_640x404.jpg"  alt="" title="Les réalisateurs de la Sélection Cinéfondation 2016" class="lazy">
        <div class="picto"><i class="icon icon_photo"></i></div>
        <div class="info">
          <div class="vCenter">
            <div class="vCenterKid">
              <span class="category">Montée des Marches</span>
              <span class="date">18.05.16</span> . <span
                  class="hour">10:30</span>
              <p data-title="Les réalisateurs de la Sélection Cinéfondation 2016">Les réalisateurs de la Sélection Cinéfondation 2016</p>
            </div>
          </div>
        </div>
      </div>
      <div class="item oeil-du-photographe 18-05-16 shadow-bottom photo portrait notloaded">
        <a id="photo1304" class="ajax chocolat-image" data-pid="1304"
           href="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/06/92b20a6bfe1ec3e3c9f660a0513c700dff90b645.jpg"
           title='<span class="category">Œil du photographe</span><span class="date">18.05.16 . 08:44</span><h2>Bérenice Bejo: Elle est arrivée très détendue et souriante en compagnie de son coiffeur.</h2>'
           data-credit="Crédit Image : Julien Lienard / Getty Images"></a>
        <img data-original="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/06/thumb_5527_media_image_320x404.jpg"  alt="" title="Bérenice Bejo: Elle est arrivée très détendue et souriante en compagnie de son coiffeur." class="lazy">
        <div class="picto"><i class="icon icon_photo"></i></div>
        <div class="info">
          <div class="vCenter">
            <div class="vCenterKid">
              <span class="category">Œil du photographe</span>
              <span class="date">18.05.16</span> . <span
                  class="hour">08:44</span>
              <p data-title="Bérenice Bejo: Elle est arrivée très détendue et souriante en compagnie de son coiffeur.">Bérenice Bejo: Elle est arrivée très détendue et souriante en compagnie de son coiffeur.</p>
            </div>
          </div>
        </div>
      </div>
      <div class="item oeil-du-photographe 18-05-16 shadow-bottom photo portrait notloaded">
        <a id="photo1305" class="ajax chocolat-image" data-pid="1305"
           href="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/06/9b4fc9536bb9ac0340c550f4f2e5a30b58f8d3ca.jpg"
           title='<span class="category">Œil du photographe</span><span class="date">18.05.16 . 08:44</span><h2>Céline Sciamma: Pour cette image, je me suis amusé avec des éléments devant mon objectif afin d’amener ce flou coloré.</h2>'
           data-credit="Crédit Image : Julien Lienard / Getty Images"></a>
        <img data-original="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/06/thumb_5528_media_image_320x404.jpg"  alt="" title="Céline Sciamma: Pour cette image, je me suis amusé avec des éléments devant mon objectif afin d’amener ce flou coloré." class="lazy">
        <div class="picto"><i class="icon icon_photo"></i></div>
        <div class="info">
          <div class="vCenter">
            <div class="vCenterKid">
              <span class="category">Œil du photographe</span>
              <span class="date">18.05.16</span> . <span
                  class="hour">08:44</span>
              <p data-title="Céline Sciamma: Pour cette image, je me suis amusé avec des éléments devant mon objectif afin d’amener ce flou coloré.">Céline Sciamma: Pour cette image, je me suis amusé avec des éléments devant mon objectif afin d’amener ce flou coloré.</p>
            </div>
          </div>
        </div>
      </div>
      <div class="item oeil-du-photographe 18-05-16 shadow-bottom photo portrait notloaded">
        <a id="photo1306" class="ajax chocolat-image" data-pid="1306"
           href="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/06/68e93c8cc954e26ac297f973e711f933cee285a1.jpg"
           title='<span class="category">Œil du photographe</span><span class="date">18.05.16 . 08:44</span><h2>Gérard Jugnot: Il a été très fort de proposition lors de ce shooting. À chacune des consignes que je lui donnais il les réinterprétait avec humour.</h2>'
           data-credit="Crédit Image : Julien Lienard / Getty Images"></a>
        <img data-original="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/06/thumb_5538_media_image_320x404.jpg"  alt="" title="Gérard Jugnot: Il a été très fort de proposition lors de ce shooting. À chacune des consignes que je lui donnais il les réinterprétait avec humour." class="lazy">
        <div class="picto"><i class="icon icon_photo"></i></div>
        <div class="info">
          <div class="vCenter">
            <div class="vCenterKid">
              <span class="category">Œil du photographe</span>
              <span class="date">18.05.16</span> . <span
                  class="hour">08:44</span>
              <p data-title="Gérard Jugnot: Il a été très fort de proposition lors de ce shooting. À chacune des consignes que je lui donnais il les réinterprétait avec humour.">Gérard Jugnot: Il a été très fort de proposition lors de ce shooting. À chacune des consignes que je lui donnais il les réinterprétait avec humour.</p>
            </div>
          </div>
        </div>
      </div>
      <div class="item oeil-du-photographe 18-05-16 shadow-bottom photo paysage notloaded">
        <a id="photo1307" class="ajax chocolat-image" data-pid="1307"
           href="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/06/474201a902df601397af23fa7dae299190eb3dd8.jpg"
           title='<span class="category">Œil du photographe</span><span class="date">18.05.16 . 08:44</span><h2>Nicole Garcia: La photo a eu lieu sur la terrasse Mouton Cadet. L’espace est très intéressant, car il y a beaucoup de miroirs. Ce qui m’a plu ici, c’est le fait que l’on découvre son visage dans le reflet.</h2>'
           data-credit="Crédit Image : Julien Lienard / Getty Images"></a>
        <img data-original="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/06/thumb_5539_media_image_640x404.jpg"  alt="" title="Nicole Garcia: La photo a eu lieu sur la terrasse Mouton Cadet. L’espace est très intéressant, car il y a beaucoup de miroirs. Ce qui m’a plu ici, c’est le fait que l’on découvre son visage dans le reflet." class="lazy">
        <div class="picto"><i class="icon icon_photo"></i></div>
        <div class="info">
          <div class="vCenter">
            <div class="vCenterKid">
              <span class="category">Œil du photographe</span>
              <span class="date">18.05.16</span> . <span
                  class="hour">08:44</span>
              <p data-title="Nicole Garcia: La photo a eu lieu sur la terrasse Mouton Cadet. L’espace est très intéressant, car il y a beaucoup de miroirs. Ce qui m’a plu ici, c’est le fait que l’on découvre son visage dans le reflet.">Nicole Garcia: La photo a eu lieu sur la terrasse Mouton Cadet. L’espace est très intéressant, car il y a beaucoup de miroirs. Ce qui m’a plu ici, c’est le fait que l’on découvre son visage dans le reflet.</p>
            </div>
          </div>
        </div>
      </div>
      <div class="item sur-scene 17-05-16 shadow-bottom photo paysage notloaded">
        <a id="photo1372" class="ajax chocolat-image" data-pid="1372"
           href="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/06/26e78cbb79e6ff16fcb4fd803e3fe8e4a44f4b9d.jpg"
           title='<span class="category">Sur Scène</span><span class="date">17.05.16 . 23:25</span><h2>Fulvio Lucisano - Terrore Nello Spazio (La planète des vampires)</h2>'
           data-credit="Crédit Image : Cyril Duchêne / FDC"></a>
        <img data-original="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/06/thumb_5639_media_image_640x404.jpg"  alt="" title="Fulvio Lucisano - Terrore Nello Spazio (La planète des vampires)" class="lazy">
        <div class="picto"><i class="icon icon_photo"></i></div>
        <div class="info">
          <div class="vCenter">
            <div class="vCenterKid">
              <span class="category">Sur Scène</span>
              <span class="date">17.05.16</span> . <span
                  class="hour">23:25</span>
              <p data-title="Fulvio Lucisano - Terrore Nello Spazio (La planète des vampires)">Fulvio Lucisano - Terrore Nello Spazio (La planète des vampires)</p>
            </div>
          </div>
        </div>
      </div>
      <div class="item sur-scene 17-05-16 shadow-bottom photo paysage notloaded">
        <a id="photo1346" class="ajax chocolat-image" data-pid="1346"
           href="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/06/6274317d050510f216dbb629eb370a79c01118a4.jpg"
           title='<span class="category">Sur Scène</span><span class="date">17.05.16 . 23:20</span><h2>Nicolas Winding Refn - Terrore Nello Spazio (La planète des vampires)</h2>'
           data-credit="Crédit Image : Cyril Duchêne / FDC"></a>
        <img data-original="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/06/thumb_5594_media_image_640x404.jpg"  alt="" title="Nicolas Winding Refn - Terrore Nello Spazio (La planète des vampires)" class="lazy">
        <div class="picto"><i class="icon icon_photo"></i></div>
        <div class="info">
          <div class="vCenter">
            <div class="vCenterKid">
              <span class="category">Sur Scène</span>
              <span class="date">17.05.16</span> . <span
                  class="hour">23:20</span>
              <p data-title="Nicolas Winding Refn - Terrore Nello Spazio (La planète des vampires)">Nicolas Winding Refn - Terrore Nello Spazio (La planète des vampires)</p>
            </div>
          </div>
        </div>
      </div>
      <div class="item avant-la-projection 17-05-16 shadow-bottom photo portrait notloaded">
        <a id="photo1344" class="ajax chocolat-image" data-pid="1344"
           href="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/06/7d6919aa82610ddfec1fd34b09273b06f515df1b.jpg"
           title='<span class="category">Avant la projection</span><span class="date">17.05.16 . 22:36</span><h2>Shree Crooks, Charlie Shotwell et Annalise Basso - Captain Fantastic</h2>'
           data-credit="Crédit Image : Mathilde Petit / FDC"></a>
        <img data-original="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/06/thumb_5592_media_image_320x404.jpg"  alt="" title="Shree Crooks, Charlie Shotwell et Annalise Basso - Captain Fantastic" class="lazy">
        <div class="picto"><i class="icon icon_photo"></i></div>
        <div class="info">
          <div class="vCenter">
            <div class="vCenterKid">
              <span class="category">Avant la projection</span>
              <span class="date">17.05.16</span> . <span
                  class="hour">22:36</span>
              <p data-title="Shree Crooks, Charlie Shotwell et Annalise Basso - Captain Fantastic">Shree Crooks, Charlie Shotwell et Annalise Basso - Captain Fantastic</p>
            </div>
          </div>
        </div>
      </div>
      <div class="item sur-scene 17-05-16 shadow-bottom photo paysage notloaded">
        <a id="photo1343" class="ajax chocolat-image" data-pid="1343"
           href="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/06/57ad4d9e5ef1ceb5df0df57f87d357987a6a2428.jpg"
           title='<span class="category">Sur Scène</span><span class="date">17.05.16 . 22:33</span><h2>Équipe du film - Captain Fantastic</h2>'
           data-credit="Crédit Image : Mathilde Petit / FDC"></a>
        <img data-original="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/06/thumb_5591_media_image_640x404.jpg"  alt="" title="Équipe du film - Captain Fantastic" class="lazy">
        <div class="picto"><i class="icon icon_photo"></i></div>
        <div class="info">
          <div class="vCenter">
            <div class="vCenterKid">
              <span class="category">Sur Scène</span>
              <span class="date">17.05.16</span> . <span
                  class="hour">22:33</span>
              <p data-title="Équipe du film - Captain Fantastic">Équipe du film - Captain Fantastic</p>
            </div>
          </div>
        </div>
      </div>
      <div class="item montee-des-marches 17-05-16 shadow-bottom photo paysage notloaded">
        <a id="photo1331" class="ajax chocolat-image" data-pid="1331"
           href="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/06/2017e3e1b7dc9d563a7a6051260affdb51b1f3dc.jpg"
           title='<span class="category">Montée des Marches</span><span class="date">17.05.16 . 22:20</span><h2>Personal Shopper d&#039;Olivier Assayas</h2>'
           data-credit="Crédit Image : Valery HACHE"></a>
        <img data-original="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/06/thumb_5565_media_image_640x404.jpg"  alt="" title="Personal Shopper d&#039;Olivier Assayas" class="lazy">
        <div class="picto"><i class="icon icon_photo"></i></div>
        <div class="info">
          <div class="vCenter">
            <div class="vCenterKid">
              <span class="category">Montée des Marches</span>
              <span class="date">17.05.16</span> . <span
                  class="hour">22:20</span>
              <p data-title="Personal Shopper d&#039;Olivier Assayas">Personal Shopper d&#039;Olivier Assayas</p>
            </div>
          </div>
        </div>
      </div>
      <div class="item montee-des-marches 17-05-16 shadow-bottom photo paysage notloaded">
        <a id="photo1330" class="ajax chocolat-image" data-pid="1330"
           href="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/06/d3808ce733f3deb75e7b790cc1fecdf9a63919cd.jpg"
           title='<span class="category">Montée des Marches</span><span class="date">17.05.16 . 21:22</span><h2>Équipe du film - Captain Fantastic</h2>'
           data-credit="Crédit Image : Anne-Christine Poujoulat / AFP"></a>
        <img data-original="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/06/thumb_5564_media_image_640x404.jpg"  alt="" title="Équipe du film - Captain Fantastic" class="lazy">
        <div class="picto"><i class="icon icon_photo"></i></div>
        <div class="info">
          <div class="vCenter">
            <div class="vCenterKid">
              <span class="category">Montée des Marches</span>
              <span class="date">17.05.16</span> . <span
                  class="hour">21:22</span>
              <p data-title="Équipe du film - Captain Fantastic">Équipe du film - Captain Fantastic</p>
            </div>
          </div>
        </div>
      </div>
      <div class="item montee-des-marches 17-05-16 shadow-bottom photo paysage notloaded">
        <a id="photo1328" class="ajax chocolat-image" data-pid="1328"
           href="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/06/a29e1618bd2936e4fb37571e4f298d2f882fe6a2.jpg"
           title='<span class="category">Montée des Marches</span><span class="date">17.05.16 . 21:20</span><h2>Lars Eidinger, Kristen Stewart, Olivier Assayas, Nora von Waldstatten, Sigrid Bouaziz et Anders Danielsen - Personal Shopper</h2>'
           data-credit="Crédit Image : Valéry Hache / AFP"></a>
        <img data-original="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/06/thumb_5562_media_image_640x404.jpg"  alt="" title="Lars Eidinger, Kristen Stewart, Olivier Assayas, Nora von Waldstatten, Sigrid Bouaziz et Anders Danielsen - Personal Shopper" class="lazy">
        <div class="picto"><i class="icon icon_photo"></i></div>
        <div class="info">
          <div class="vCenter">
            <div class="vCenterKid">
              <span class="category">Montée des Marches</span>
              <span class="date">17.05.16</span> . <span
                  class="hour">21:20</span>
              <p data-title="Lars Eidinger, Kristen Stewart, Olivier Assayas, Nora von Waldstatten, Sigrid Bouaziz et Anders Danielsen - Personal Shopper">Lars Eidinger, Kristen Stewart, Olivier Assayas, Nora von Waldstatten, Sigrid Bouaziz et Anders Danielsen - Personal Shopper</p>
            </div>
          </div>
        </div>
      </div>
      <div class="item un-certain-regard 17-05-16 shadow-bottom photo paysage notloaded">
        <a id="photo1333" class="ajax chocolat-image" data-pid="1333"
           href="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/06/579a0dab5785d938f780ab8e697cb3e191be7af9.jpg"
           title='<span class="category">Un Certain Regard</span><span class="date">17.05.16 . 21:20</span><h2>Viggo Mortensen - Captain Fantastic</h2>'
           data-credit="Crédit Image : Anne-Christine Poujoulat / AFP"></a>
        <img data-original="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/06/thumb_5566_media_image_640x404.jpg"  alt="Viggo Mortensen - Captain Fantastic" title="Viggo Mortensen - Captain Fantastic" class="lazy">
        <div class="picto"><i class="icon icon_photo"></i></div>
        <div class="info">
          <div class="vCenter">
            <div class="vCenterKid">
              <span class="category">Un Certain Regard</span>
              <span class="date">17.05.16</span> . <span
                  class="hour">21:20</span>
              <p data-title="Viggo Mortensen - Captain Fantastic">Viggo Mortensen - Captain Fantastic</p>
            </div>
          </div>
        </div>
      </div>
      <div class="item montee-des-marches 17-05-16 shadow-bottom photo paysage notloaded">
        <a id="photo1329" class="ajax chocolat-image" data-pid="1329"
           href="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/06/cb1c0016a9ca6d37a72ef30912620fe20fb9df15.jpg"
           title='<span class="category">Montée des Marches</span><span class="date">17.05.16 . 21:19</span><h2>Équipe du film - Captain Fantastic</h2>'
           data-credit="Crédit Image : Anne-Christine Poujoulat / AFP"></a>
        <img data-original="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/06/thumb_5563_media_image_640x404.jpg"  alt="" title="Équipe du film - Captain Fantastic" class="lazy">
        <div class="picto"><i class="icon icon_photo"></i></div>
        <div class="info">
          <div class="vCenter">
            <div class="vCenterKid">
              <span class="category">Montée des Marches</span>
              <span class="date">17.05.16</span> . <span
                  class="hour">21:19</span>
              <p data-title="Équipe du film - Captain Fantastic">Équipe du film - Captain Fantastic</p>
            </div>
          </div>
        </div>
      </div>
      <div class="item sur-scene 17-05-16 shadow-bottom photo paysage notloaded">
        <a id="photo1327" class="ajax chocolat-image" data-pid="1327"
           href="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/06/c0d06c423189bea209ac5e047539eeba61094f07.JPG"
           title='<span class="category">Sur Scène</span><span class="date">17.05.16 . 20:45</span><h2>Billy Hayes, Sally Sussman et Thierry Frémaux - Midnight Return  : the Story of Billy Hayes and Turkey</h2>'
           data-credit="Crédit Image : Thomas Leibreich / FDC"></a>
        <img data-original="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/06/thumb_5561_media_image_640x404.JPG"  alt="" title="Billy Hayes, Sally Sussman et Thierry Frémaux - Midnight Return  : the Story of Billy Hayes and Turkey" class="lazy">
        <div class="picto"><i class="icon icon_photo"></i></div>
        <div class="info">
          <div class="vCenter">
            <div class="vCenterKid">
              <span class="category">Sur Scène</span>
              <span class="date">17.05.16</span> . <span
                  class="hour">20:45</span>
              <p data-title="Billy Hayes, Sally Sussman et Thierry Frémaux - Midnight Return  : the Story of Billy Hayes and Turkey">Billy Hayes, Sally Sussman et Thierry Frémaux - Midnight Return  : the Story of Billy Hayes and Turkey</p>
            </div>
          </div>
        </div>
      </div>
      <div class="item montee-des-marches 17-05-16 shadow-bottom photo paysage notloaded">
        <a id="photo1326" class="ajax chocolat-image" data-pid="1326"
           href="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/06/5c48ab842ee163abc9bdf9e7959b38f4beabae41.jpg"
           title='<span class="category">Montée des Marches</span><span class="date">17.05.16 . 19:30</span><h2>Guy Bedos</h2>'
           data-credit="Crédit Image : Alberto Pizzoli / AFP"></a>
        <img data-original="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/06/thumb_5560_media_image_640x404.jpg"  alt="" title="Guy Bedos" class="lazy">
        <div class="picto"><i class="icon icon_photo"></i></div>
        <div class="info">
          <div class="vCenter">
            <div class="vCenterKid">
              <span class="category">Montée des Marches</span>
              <span class="date">17.05.16</span> . <span
                  class="hour">19:30</span>
              <p data-title="Guy Bedos">Guy Bedos</p>
            </div>
          </div>
        </div>
      </div>
      <div class="item montee-des-marches 17-05-16 shadow-bottom photo paysage notloaded">
        <a id="photo1323" class="ajax chocolat-image" data-pid="1323"
           href="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/06/d9833e4c14e774665f0597c655d3c460bf576c62.jpg"
           title='<span class="category">Montée des Marches</span><span class="date">17.05.16 . 19:20</span><h2>George Miller et Arnaud Desplechin, membres du Jury des Longs Métrages et Jean-Paul Gaultier</h2>'
           data-credit="Crédit Image : Alberto Pizzoli / AFP"></a>
        <img data-original="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/06/thumb_5556_media_image_640x404.jpg"  alt="" title="George Miller et Arnaud Desplechin, membres du Jury des Longs Métrages et Jean-Paul Gaultier" class="lazy">
        <div class="picto"><i class="icon icon_photo"></i></div>
        <div class="info">
          <div class="vCenter">
            <div class="vCenterKid">
              <span class="category">Montée des Marches</span>
              <span class="date">17.05.16</span> . <span
                  class="hour">19:20</span>
              <p data-title="George Miller et Arnaud Desplechin, membres du Jury des Longs Métrages et Jean-Paul Gaultier">George Miller et Arnaud Desplechin, membres du Jury des Longs Métrages et Jean-Paul Gaultier</p>
            </div>
          </div>
        </div>
      </div>
      <div class="item montee-des-marches 17-05-16 shadow-bottom photo paysage notloaded">
        <a id="photo1322" class="ajax chocolat-image" data-pid="1322"
           href="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/06/c74514f98efc5813f0921b62d89179dfa75a9490.jpg"
           title='<span class="category">Montée des Marches</span><span class="date">17.05.16 . 19:17</span><h2>Michelle Jenner - Julieta</h2>'
           data-credit="Crédit Image : Mathilde Petit / FDC"></a>
        <img data-original="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/06/thumb_5559_media_image_640x404.jpg"  alt="" title="Michelle Jenner - Julieta" class="lazy">
        <div class="picto"><i class="icon icon_photo"></i></div>
        <div class="info">
          <div class="vCenter">
            <div class="vCenterKid">
              <span class="category">Montée des Marches</span>
              <span class="date">17.05.16</span> . <span
                  class="hour">19:17</span>
              <p data-title="Michelle Jenner - Julieta">Michelle Jenner - Julieta</p>
            </div>
          </div>
        </div>
      </div>
      <div class="item montee-des-marches 17-05-16 shadow-bottom photo portrait notloaded">
        <a id="photo1318" class="ajax chocolat-image" data-pid="1318"
           href="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/06/d345954789cd99e784fb34661b8a674cb289fb84.jpg"
           title='<span class="category">Montée des Marches</span><span class="date">17.05.16 . 19:11</span><h2>Emma Suarez - Julieta</h2>'
           data-credit="Crédit Image : Dominique Charriau / Getty Images"></a>
        <img data-original="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/06/thumb_5549_media_image_320x404.jpg"  alt="" title="Emma Suarez - Julieta" class="lazy">
        <div class="picto"><i class="icon icon_photo"></i></div>
        <div class="info">
          <div class="vCenter">
            <div class="vCenterKid">
              <span class="category">Montée des Marches</span>
              <span class="date">17.05.16</span> . <span
                  class="hour">19:11</span>
              <p data-title="Emma Suarez - Julieta">Emma Suarez - Julieta</p>
            </div>
          </div>
        </div>
      </div>
      <div class="item montee-des-marches 17-05-16 shadow-bottom photo paysage notloaded">
        <a id="photo1317" class="ajax chocolat-image" data-pid="1317"
           href="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/06/2d9ac18ae85493a9c3ab320d585e41f0b7fd4c52.jpg"
           title='<span class="category">Montée des Marches</span><span class="date">17.05.16 . 19:10</span><h2>Équipe du film - Julieta</h2>'
           data-credit="Crédit Image : Dominique Charriau / Getty Images"></a>
        <img data-original="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/06/thumb_5547_media_image_640x404.jpg"  alt="" title="Équipe du film - Julieta" class="lazy">
        <div class="picto"><i class="icon icon_photo"></i></div>
        <div class="info">
          <div class="vCenter">
            <div class="vCenterKid">
              <span class="category">Montée des Marches</span>
              <span class="date">17.05.16</span> . <span
                  class="hour">19:10</span>
              <p data-title="Équipe du film - Julieta">Équipe du film - Julieta</p>
            </div>
          </div>
        </div>
      </div>
      <div class="item montee-des-marches 17-05-16 shadow-bottom photo paysage notloaded">
        <a id="photo1311" class="ajax chocolat-image" data-pid="1311"
           href="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/06/8ad32df5e75d30e8e0aecc8d12af1a9a259bdba0.jpg"
           title='<span class="category">Montée des Marches</span><span class="date">17.05.16 . 19:08</span><h2>Daniel Grao et Adriana Ugarte - Julieta</h2>'
           data-credit="Crédit Image : Alberto Pizzoli / AFP"></a>
        <img data-original="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/06/thumb_5543_media_image_640x404.jpg"  alt="" title="Daniel Grao et Adriana Ugarte - Julieta" class="lazy">
        <div class="picto"><i class="icon icon_photo"></i></div>
        <div class="info">
          <div class="vCenter">
            <div class="vCenterKid">
              <span class="category">Montée des Marches</span>
              <span class="date">17.05.16</span> . <span
                  class="hour">19:08</span>
              <p data-title="Daniel Grao et Adriana Ugarte - Julieta">Daniel Grao et Adriana Ugarte - Julieta</p>
            </div>
          </div>
        </div>
      </div>
      <div class="item montee-des-marches 17-05-16 shadow-bottom photo paysage notloaded">
        <a id="photo1308" class="ajax chocolat-image" data-pid="1308"
           href="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/06/9a3b8c87b2185d582b8aa3aa7456e2d4f27ee69b.jpg"
           title='<span class="category">Montée des Marches</span><span class="date">17.05.16 . 19:05</span><h2>Équipe du film - Julieta</h2>'
           data-credit="Crédit Image : Alberto Pizzoli / AFP"></a>
        <img data-original="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/06/thumb_5541_media_image_640x404.jpg"  alt="" title="Équipe du film - Julieta" class="lazy">
        <div class="picto"><i class="icon icon_photo"></i></div>
        <div class="info">
          <div class="vCenter">
            <div class="vCenterKid">
              <span class="category">Montée des Marches</span>
              <span class="date">17.05.16</span> . <span
                  class="hour">19:05</span>
              <p data-title="Équipe du film - Julieta">Équipe du film - Julieta</p>
            </div>
          </div>
        </div>
      </div>
      <div class="item montee-des-marches 17-05-16 shadow-bottom photo portrait notloaded">
        <a id="photo1310" class="ajax chocolat-image" data-pid="1310"
           href="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/06/6cd3a95fc203d2dfad551da4a43d1e4eefda103e.jpg"
           title='<span class="category">Montée des Marches</span><span class="date">17.05.16 . 19:00</span><h2>Pedro Almodóvar - Julieta</h2>'
           data-credit="Crédit Image : Valéry Hache / AFP"></a>
        <img data-original="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/06/thumb_5542_media_image_320x404.jpg"  alt="" title="Pedro Almodóvar - Julieta" class="lazy">
        <div class="picto"><i class="icon icon_photo"></i></div>
        <div class="info">
          <div class="vCenter">
            <div class="vCenterKid">
              <span class="category">Montée des Marches</span>
              <span class="date">17.05.16</span> . <span
                  class="hour">19:00</span>
              <p data-title="Pedro Almodóvar - Julieta">Pedro Almodóvar - Julieta</p>
            </div>
          </div>
        </div>
      </div>
      <div class="item montee-des-marches 17-05-16 shadow-bottom photo paysage notloaded">
        <a id="photo1294" class="ajax chocolat-image" data-pid="1294"
           href="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/06/44eaa38c52d5112f10962c54e646d0744e1747ec.jpg"
           title='<span class="category">Montée des Marches</span><span class="date">17.05.16 . 15:30</span><h2>Équipe du film - Aquarius</h2>'
           data-credit="Crédit Image : Mathilde Petit / FDC"></a>
        <img data-original="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/06/thumb_5520_media_image_640x404.jpg"  alt="" title="Équipe du film - Aquarius" class="lazy">
        <div class="picto"><i class="icon icon_photo"></i></div>
        <div class="info">
          <div class="vCenter">
            <div class="vCenterKid">
              <span class="category">Montée des Marches</span>
              <span class="date">17.05.16</span> . <span
                  class="hour">15:30</span>
              <p data-title="Équipe du film - Aquarius">Équipe du film - Aquarius</p>
            </div>
          </div>
        </div>
      </div>
      <div class="item montee-des-marches 17-05-16 shadow-bottom photo paysage notloaded">
        <a id="photo1295" class="ajax chocolat-image" data-pid="1295"
           href="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/06/fe45e549b4605fd7bf1eac8abcee10079dcf4078.jpg"
           title='<span class="category">Montée des Marches</span><span class="date">17.05.16 . 15:29</span><h2>Équipe du film - Aquarius</h2>'
           data-credit="Crédit Image : Mathilde Petit / FDC"></a>
        <img data-original="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/06/thumb_5521_media_image_640x404.jpg"  alt="" title="Équipe du film - Aquarius" class="lazy">
        <div class="picto"><i class="icon icon_photo"></i></div>
        <div class="info">
          <div class="vCenter">
            <div class="vCenterKid">
              <span class="category">Montée des Marches</span>
              <span class="date">17.05.16</span> . <span
                  class="hour">15:29</span>
              <p data-title="Équipe du film - Aquarius">Équipe du film - Aquarius</p>
            </div>
          </div>
        </div>
      </div>
      <div class="item conference-de-presse 17-05-16 shadow-bottom photo paysage notloaded">
        <a id="photo1280" class="ajax chocolat-image" data-pid="1280"
           href="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/06/30f3f3d50f787665722c9061feea25f506301b2e.jpg"
           title='<span class="category">Conférence de Presse</span><span class="date">17.05.16 . 12:31</span><h2>Lars Eidinger - Personal Shopper</h2>'
           data-credit="Crédit Image : Léo Laumont / FDC"></a>
        <img data-original="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/06/thumb_5505_media_image_640x404.jpg"  alt="" title="Lars Eidinger - Personal Shopper" class="lazy">
        <div class="picto"><i class="icon icon_photo"></i></div>
        <div class="info">
          <div class="vCenter">
            <div class="vCenterKid">
              <span class="category">Conférence de Presse</span>
              <span class="date">17.05.16</span> . <span
                  class="hour">12:31</span>
              <p data-title="Lars Eidinger - Personal Shopper">Lars Eidinger - Personal Shopper</p>
            </div>
          </div>
        </div>
      </div>
      <div class="item conference-de-presse 17-05-16 shadow-bottom photo paysage notloaded">
        <a id="photo1279" class="ajax chocolat-image" data-pid="1279"
           href="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/06/dca76d693068eb8ed2b4dbab8b107e32d454ea5e.jpg"
           title='<span class="category">Conférence de Presse</span><span class="date">17.05.16 . 12:30</span><h2>Équipe du film - Personal Shopper</h2>'
           data-credit="Crédit Image : Léo Laumont / FDC"></a>
        <img data-original="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/06/thumb_5504_media_image_640x404.jpg"  alt="" title="Équipe du film - Personal Shopper" class="lazy">
        <div class="picto"><i class="icon icon_photo"></i></div>
        <div class="info">
          <div class="vCenter">
            <div class="vCenterKid">
              <span class="category">Conférence de Presse</span>
              <span class="date">17.05.16</span> . <span
                  class="hour">12:30</span>
              <p data-title="Équipe du film - Personal Shopper">Équipe du film - Personal Shopper</p>
            </div>
          </div>
        </div>
      </div>
      <div class="item photocall 17-05-16 shadow-bottom photo paysage notloaded">
        <a id="photo1271" class="ajax chocolat-image" data-pid="1271"
           href="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/06/bddfb7ec6b97041b4d771620335a2ab54f337670.jpg"
           title='<span class="category">Photocall</span><span class="date">17.05.16 . 12:06</span><h2>Talents Adami Cannes 2016</h2>'
           data-credit="Crédit Image : Cyril Duchêne / FDC"></a>
        <img data-original="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/06/thumb_5498_media_image_640x404.jpg"  alt="" title="Talents Adami Cannes 2016" class="lazy">
        <div class="picto"><i class="icon icon_photo"></i></div>
        <div class="info">
          <div class="vCenter">
            <div class="vCenterKid">
              <span class="category">Photocall</span>
              <span class="date">17.05.16</span> . <span
                  class="hour">12:06</span>
              <p data-title="Talents Adami Cannes 2016">Talents Adami Cannes 2016</p>
            </div>
          </div>
        </div>
      </div>
      <div class="item photocall 17-05-16 shadow-bottom photo paysage notloaded">
        <a id="photo1268" class="ajax chocolat-image" data-pid="1268"
           href="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/06/75bf2d38966be18a4ef5309ac1a382524f0ed3e7.jpg"
           title='<span class="category">Photocall</span><span class="date">17.05.16 . 12:05</span><h2>Bertrand Tavernier - Voyage à travers le cinéma français</h2>'
           data-credit="Crédit Image : Cyril Duchêne / FDC"></a>
        <img data-original="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/06/thumb_5496_media_image_640x404.jpg"  alt="" title="Bertrand Tavernier - Voyage à travers le cinéma français" class="lazy">
        <div class="picto"><i class="icon icon_photo"></i></div>
        <div class="info">
          <div class="vCenter">
            <div class="vCenterKid">
              <span class="category">Photocall</span>
              <span class="date">17.05.16</span> . <span
                  class="hour">12:05</span>
              <p data-title="Bertrand Tavernier - Voyage à travers le cinéma français">Bertrand Tavernier - Voyage à travers le cinéma français</p>
            </div>
          </div>
        </div>
      </div>
      <div class="item photocall 17-05-16 shadow-bottom photo portrait notloaded">
        <a id="photo1276" class="ajax chocolat-image" data-pid="1276"
           href="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/06/43a49cc28c7f609f952b9dbe37f690382604e536.jpg"
           title='<span class="category">Photocall</span><span class="date">17.05.16 . 12:04</span><h2>Nora Von Waldstatten et Lars Eidinger - Personal Shopper</h2>'
           data-credit="Crédit Image : Thomas Leibreich / FDC"></a>
        <img data-original="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/06/thumb_5502_media_image_320x404.jpg"  alt="" title="Nora Von Waldstatten et Lars Eidinger - Personal Shopper" class="lazy">
        <div class="picto"><i class="icon icon_photo"></i></div>
        <div class="info">
          <div class="vCenter">
            <div class="vCenterKid">
              <span class="category">Photocall</span>
              <span class="date">17.05.16</span> . <span
                  class="hour">12:04</span>
              <p data-title="Nora Von Waldstatten et Lars Eidinger - Personal Shopper">Nora Von Waldstatten et Lars Eidinger - Personal Shopper</p>
            </div>
          </div>
        </div>
      </div>
      <div class="item photocall 17-05-16 shadow-bottom photo paysage notloaded">
        <a id="photo1267" class="ajax chocolat-image" data-pid="1267"
           href="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/06/07b70e109c39fb06e982f37a0d9b8887ff04140b.jpg"
           title='<span class="category">Photocall</span><span class="date">17.05.16 . 12:03</span><h2>Sigrid Bouaziz, Kristen Stewart et Nora Von Waldstatten - Personal Shopper</h2>'
           data-credit="Crédit Image : Cyril Duchêne / FDC"></a>
        <img data-original="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/06/thumb_5495_media_image_640x404.jpg"  alt="" title="Sigrid Bouaziz, Kristen Stewart et Nora Von Waldstatten - Personal Shopper" class="lazy">
        <div class="picto"><i class="icon icon_photo"></i></div>
        <div class="info">
          <div class="vCenter">
            <div class="vCenterKid">
              <span class="category">Photocall</span>
              <span class="date">17.05.16</span> . <span
                  class="hour">12:03</span>
              <p data-title="Sigrid Bouaziz, Kristen Stewart et Nora Von Waldstatten - Personal Shopper">Sigrid Bouaziz, Kristen Stewart et Nora Von Waldstatten - Personal Shopper</p>
            </div>
          </div>
        </div>
      </div>
      <div class="item photocall 17-05-16 shadow-bottom photo paysage notloaded">
        <a id="photo1265" class="ajax chocolat-image" data-pid="1265"
           href="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/06/d2956e4a59b909ef409efd11ed0cc4258aeb363c.jpg"
           title='<span class="category">Photocall</span><span class="date">17.05.16 . 12:02</span><h2>Olivier Assayas - Personal Shopper</h2>'
           data-credit="Crédit Image : Cyril Duchêne / FDC"></a>
        <img data-original="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/06/thumb_5493_media_image_640x404.jpg"  alt="" title="Olivier Assayas - Personal Shopper" class="lazy">
        <div class="picto"><i class="icon icon_photo"></i></div>
        <div class="info">
          <div class="vCenter">
            <div class="vCenterKid">
              <span class="category">Photocall</span>
              <span class="date">17.05.16</span> . <span
                  class="hour">12:02</span>
              <p data-title="Olivier Assayas - Personal Shopper">Olivier Assayas - Personal Shopper</p>
            </div>
          </div>
        </div>
      </div>
      <div class="item photocall 17-05-16 shadow-bottom photo paysage notloaded">
        <a id="photo1264" class="ajax chocolat-image" data-pid="1264"
           href="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/06/11fc9ae006c3c8c223042f6955fc5d0994436e7b.jpg"
           title='<span class="category">Photocall</span><span class="date">17.05.16 . 12:01</span><h2>Kristen Stewart - Personal Shopper</h2>'
           data-credit="Crédit Image : Cyril Duchêne / FDC"></a>
        <img data-original="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/06/thumb_5492_media_image_640x404.jpg"  alt="" title="Kristen Stewart - Personal Shopper" class="lazy">
        <div class="picto"><i class="icon icon_photo"></i></div>
        <div class="info">
          <div class="vCenter">
            <div class="vCenterKid">
              <span class="category">Photocall</span>
              <span class="date">17.05.16</span> . <span
                  class="hour">12:01</span>
              <p data-title="Kristen Stewart - Personal Shopper">Kristen Stewart - Personal Shopper</p>
            </div>
          </div>
        </div>
      </div>
      <div class="item photocall 17-05-16 shadow-bottom photo paysage notloaded">
        <a id="photo1263" class="ajax chocolat-image" data-pid="1263"
           href="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/06/f1710874f241b3486713bd9b89332d5d2dcb7abc.jpg"
           title='<span class="category">Photocall</span><span class="date">17.05.16 . 12:00</span><h2>Équipe du film - Personal Shopper</h2>'
           data-credit="Crédit Image : Cyril Duchêne / FDC"></a>
        <img data-original="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/06/thumb_5491_media_image_640x404.jpg"  alt="" title="Équipe du film - Personal Shopper" class="lazy">
        <div class="picto"><i class="icon icon_photo"></i></div>
        <div class="info">
          <div class="vCenter">
            <div class="vCenterKid">
              <span class="category">Photocall</span>
              <span class="date">17.05.16</span> . <span
                  class="hour">12:00</span>
              <p data-title="Équipe du film - Personal Shopper">Équipe du film - Personal Shopper</p>
            </div>
          </div>
        </div>
      </div>
      <div class="item montee-des-marches 17-05-16 shadow-bottom photo paysage notloaded">
        <a id="photo1261" class="ajax chocolat-image" data-pid="1261"
           href="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/06/792a55e905cff34d4cded37e144ce473d3ee4e10.jpg"
           title='<span class="category">Montée des Marches</span><span class="date">17.05.16 . 11:00</span><h2>Équipe du film - Voir du pays</h2>'
           data-credit="Crédit Image : Cyril Duchêne / FDC"></a>
        <img data-original="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/06/thumb_5489_media_image_640x404.jpg"  alt="" title="Équipe du film - Voir du pays" class="lazy">
        <div class="picto"><i class="icon icon_photo"></i></div>
        <div class="info">
          <div class="vCenter">
            <div class="vCenterKid">
              <span class="category">Montée des Marches</span>
              <span class="date">17.05.16</span> . <span
                  class="hour">11:00</span>
              <p data-title="Équipe du film - Voir du pays">Équipe du film - Voir du pays</p>
            </div>
          </div>
        </div>
      </div>
      <div class="item avant-la-projection 17-05-16 shadow-bottom photo paysage notloaded">
        <a id="photo1259" class="ajax chocolat-image" data-pid="1259"
           href="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/06/162eb2e5b273f147394882a194635b8172d76edd.jpg"
           title='<span class="category">Avant la projection</span><span class="date">17.05.16 . 10:58</span><h2>Delphine Coulin - Voir du pays</h2>'
           data-credit="Crédit Image : Cyril Duchêne / FDC"></a>
        <img data-original="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/06/thumb_5487_media_image_640x404.jpg"  alt="" title="Delphine Coulin - Voir du pays" class="lazy">
        <div class="picto"><i class="icon icon_photo"></i></div>
        <div class="info">
          <div class="vCenter">
            <div class="vCenterKid">
              <span class="category">Avant la projection</span>
              <span class="date">17.05.16</span> . <span
                  class="hour">10:58</span>
              <p data-title="Delphine Coulin - Voir du pays">Delphine Coulin - Voir du pays</p>
            </div>
          </div>
        </div>
      </div>
      <div class="item sur-scene 17-05-16 shadow-bottom photo paysage notloaded">
        <a id="photo1258" class="ajax chocolat-image" data-pid="1258"
           href="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/06/12e30fd4dab094c1493bc13fdd48f9534a4c8ca4.jpg"
           title='<span class="category">Sur Scène</span><span class="date">17.05.16 . 10:57</span><h2>Équipe du film - Voir du pays (The Stopover)</h2>'
           data-credit="Crédit Image : Cyril Duchêne / FDC"></a>
        <img data-original="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/06/thumb_5486_media_image_640x404.jpg"  alt="" title="Équipe du film - Voir du pays (The Stopover)" class="lazy">
        <div class="picto"><i class="icon icon_photo"></i></div>
        <div class="info">
          <div class="vCenter">
            <div class="vCenterKid">
              <span class="category">Sur Scène</span>
              <span class="date">17.05.16</span> . <span
                  class="hour">10:57</span>
              <p data-title="Équipe du film - Voir du pays (The Stopover)">Équipe du film - Voir du pays (The Stopover)</p>
            </div>
          </div>
        </div>
      </div>
      <div class="item sur-scene 17-05-16 shadow-bottom photo paysage notloaded">
        <a id="photo1257" class="ajax chocolat-image" data-pid="1257"
           href="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/06/dc2642031bd068555f552280ff75332bbf336218.jpg"
           title='<span class="category">Sur Scène</span><span class="date">17.05.16 . 10:55</span><h2>Équipe du film - Voir du pays</h2>'
           data-credit="Crédit Image : Cyril Duchêne / FDC"></a>
        <img data-original="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/06/thumb_5484_media_image_640x404.jpg"  alt="" title="Équipe du film - Voir du pays" class="lazy">
        <div class="picto"><i class="icon icon_photo"></i></div>
        <div class="info">
          <div class="vCenter">
            <div class="vCenterKid">
              <span class="category">Sur Scène</span>
              <span class="date">17.05.16</span> . <span
                  class="hour">10:55</span>
              <p data-title="Équipe du film - Voir du pays">Équipe du film - Voir du pays</p>
            </div>
          </div>
        </div>
      </div>
      <div class="item conference-de-presse 17-05-16 shadow-bottom photo paysage notloaded">
        <a id="photo1252" class="ajax chocolat-image" data-pid="1252"
           href="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/06/a663cdc8c80e0c5081c9160739ff5f260f5a87b0.jpg"
           title='<span class="category">Conférence de Presse</span><span class="date">17.05.16 . 10:54</span><h2>Pedro Almodóvar - Julieta</h2>'
           data-credit="Crédit Image : Thomas Leibreich / FDC"></a>
        <img data-original="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/06/thumb_5476_media_image_640x404.jpg"  alt="" title="Pedro Almodóvar - Julieta" class="lazy">
        <div class="picto"><i class="icon icon_photo"></i></div>
        <div class="info">
          <div class="vCenter">
            <div class="vCenterKid">
              <span class="category">Conférence de Presse</span>
              <span class="date">17.05.16</span> . <span
                  class="hour">10:54</span>
              <p data-title="Pedro Almodóvar - Julieta">Pedro Almodóvar - Julieta</p>
            </div>
          </div>
        </div>
      </div>
      <div class="item conference-de-presse 17-05-16 shadow-bottom photo paysage notloaded">
        <a id="photo1251" class="ajax chocolat-image" data-pid="1251"
           href="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/06/73ffff0db9366066c6bedc2d827574abcbf143a4.jpg"
           title='<span class="category">Conférence de Presse</span><span class="date">17.05.16 . 10:53</span><h2>Inma Cuesta - Julieta</h2>'
           data-credit="Crédit Image : Thomas Leibreich / FDC"></a>
        <img data-original="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/06/thumb_5475_media_image_640x404.jpg"  alt="" title="Inma Cuesta - Julieta" class="lazy">
        <div class="picto"><i class="icon icon_photo"></i></div>
        <div class="info">
          <div class="vCenter">
            <div class="vCenterKid">
              <span class="category">Conférence de Presse</span>
              <span class="date">17.05.16</span> . <span
                  class="hour">10:53</span>
              <p data-title="Inma Cuesta - Julieta">Inma Cuesta - Julieta</p>
            </div>
          </div>
        </div>
      </div>
      <div class="item conference-de-presse 17-05-16 shadow-bottom photo paysage notloaded">
        <a id="photo1250" class="ajax chocolat-image" data-pid="1250"
           href="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/06/078c2b945fabf89912bcf91c2919b2b4167a5422.jpg"
           title='<span class="category">Conférence de Presse</span><span class="date">17.05.16 . 10:50</span><h2>Équipe du film - Julieta</h2>'
           data-credit="Crédit Image : Thomas Leibreich / FDC"></a>
        <img data-original="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/06/thumb_5474_media_image_640x404.jpg"  alt="" title="Équipe du film - Julieta" class="lazy">
        <div class="picto"><i class="icon icon_photo"></i></div>
        <div class="info">
          <div class="vCenter">
            <div class="vCenterKid">
              <span class="category">Conférence de Presse</span>
              <span class="date">17.05.16</span> . <span
                  class="hour">10:50</span>
              <p data-title="Équipe du film - Julieta">Équipe du film - Julieta</p>
            </div>
          </div>
        </div>
      </div>
      <div class="item photocall 17-05-16 shadow-bottom photo paysage notloaded">
        <a id="photo1247" class="ajax chocolat-image" data-pid="1247"
           href="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/06/b77ddbe60d76fa59c0fbd0633137d32ae196a24f.jpg"
           title='<span class="category">Photocall</span><span class="date">17.05.16 . 10:49</span><h2>Amandine Truffy, Grégoire Leprince Ringuet et Pauline Caupenne - La forêt de quinconces</h2>'
           data-credit="Crédit Image : Léo Laumont / FDC"></a>
        <img data-original="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/06/thumb_5471_media_image_640x404.jpg"  alt="" title="Amandine Truffy, Grégoire Leprince Ringuet et Pauline Caupenne - La forêt de quinconces" class="lazy">
        <div class="picto"><i class="icon icon_photo"></i></div>
        <div class="info">
          <div class="vCenter">
            <div class="vCenterKid">
              <span class="category">Photocall</span>
              <span class="date">17.05.16</span> . <span
                  class="hour">10:49</span>
              <p data-title="Amandine Truffy, Grégoire Leprince Ringuet et Pauline Caupenne - La forêt de quinconces">Amandine Truffy, Grégoire Leprince Ringuet et Pauline Caupenne - La forêt de quinconces</p>
            </div>
          </div>
        </div>
      </div>
      <div class="item photocall 17-05-16 shadow-bottom photo paysage notloaded">
        <a id="photo1274" class="ajax chocolat-image" data-pid="1274"
           href="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/06/73e8276a85ca64d15ac64165e3b7ecea7e9593ee.jpg"
           title='<span class="category">Photocall</span><span class="date">17.05.16 . 10:49</span><h2>Gregoire Leprince-Ringuet - La forêt de quinconces</h2>'
           data-credit="Crédit Image : Valéry Hache / AFP"></a>
        <img data-original="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/06/thumb_5500_media_image_640x404.jpg"  alt="" title="Gregoire Leprince-Ringuet - La forêt de quinconces" class="lazy">
        <div class="picto"><i class="icon icon_photo"></i></div>
        <div class="info">
          <div class="vCenter">
            <div class="vCenterKid">
              <span class="category">Photocall</span>
              <span class="date">17.05.16</span> . <span
                  class="hour">10:49</span>
              <p data-title="Gregoire Leprince-Ringuet - La forêt de quinconces">Gregoire Leprince-Ringuet - La forêt de quinconces</p>
            </div>
          </div>
        </div>
      </div>
      <div class="item photocall 17-05-16 shadow-bottom photo paysage notloaded">
        <a id="photo1248" class="ajax chocolat-image" data-pid="1248"
           href="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/06/48677fee4e6e310b763ef7b3967b9d5d946f80d0.jpg"
           title='<span class="category">Photocall</span><span class="date">17.05.16 . 10:48</span><h2>Amandine Truffy - La forêt de quinconces</h2>'
           data-credit="Crédit Image : Léo Laumont / FDC"></a>
        <img data-original="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/06/thumb_5472_media_image_640x404.jpg"  alt="" title="Amandine Truffy - La forêt de quinconces" class="lazy">
        <div class="picto"><i class="icon icon_photo"></i></div>
        <div class="info">
          <div class="vCenter">
            <div class="vCenterKid">
              <span class="category">Photocall</span>
              <span class="date">17.05.16</span> . <span
                  class="hour">10:48</span>
              <p data-title="Amandine Truffy - La forêt de quinconces">Amandine Truffy - La forêt de quinconces</p>
            </div>
          </div>
        </div>
      </div>
      <div class="item photocall 17-05-16 shadow-bottom photo paysage notloaded">
        <a id="photo1244" class="ajax chocolat-image" data-pid="1244"
           href="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/06/38d3d00f38b862d6db6c94a363cf4ce3830e6f7d.jpg"
           title='<span class="category">Photocall</span><span class="date">17.05.16 . 10:45</span><h2>Matt Ross - Captain Fantastic</h2>'
           data-credit="Crédit Image : Léo Laumont / FDC"></a>
        <img data-original="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/06/thumb_5465_media_image_640x404.jpg"  alt="" title="Matt Ross - Captain Fantastic" class="lazy">
        <div class="picto"><i class="icon icon_photo"></i></div>
        <div class="info">
          <div class="vCenter">
            <div class="vCenterKid">
              <span class="category">Photocall</span>
              <span class="date">17.05.16</span> . <span
                  class="hour">10:45</span>
              <p data-title="Matt Ross - Captain Fantastic">Matt Ross - Captain Fantastic</p>
            </div>
          </div>
        </div>
      </div>
      <div class="item photocall 17-05-16 shadow-bottom photo portrait notloaded">
        <a id="photo1245" class="ajax chocolat-image" data-pid="1245"
           href="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/06/b8fea0202a2a6e0f6db3376693d4e4022e4ea2b2.jpg"
           title='<span class="category">Photocall</span><span class="date">17.05.16 . 10:45</span><h2>Billy Hayes - Midnight Return : the Story of Billy Hayes and Turkey</h2>'
           data-credit="Crédit Image : Léo Laumont / FDC"></a>
        <img data-original="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/06/thumb_5467_media_image_320x404.jpg"  alt="" title="Billy Hayes - Midnight Return : the Story of Billy Hayes and Turkey" class="lazy">
        <div class="picto"><i class="icon icon_photo"></i></div>
        <div class="info">
          <div class="vCenter">
            <div class="vCenterKid">
              <span class="category">Photocall</span>
              <span class="date">17.05.16</span> . <span
                  class="hour">10:45</span>
              <p data-title="Billy Hayes - Midnight Return : the Story of Billy Hayes and Turkey">Billy Hayes - Midnight Return : the Story of Billy Hayes and Turkey</p>
            </div>
          </div>
        </div>
      </div>
      <div class="item photocall 17-05-16 shadow-bottom photo paysage notloaded">
        <a id="photo1243" class="ajax chocolat-image" data-pid="1243"
           href="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/06/1f9b0872eda16a4e84416528cb7c472b270d554b.jpg"
           title='<span class="category">Photocall</span><span class="date">17.05.16 . 10:44</span><h2>Viggo Mortensen - Captain Fantastic</h2>'
           data-credit="Crédit Image : Léo Laumont / FDC"></a>
        <img data-original="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/06/thumb_5464_media_image_640x404.jpg"  alt="" title="Viggo Mortensen - Captain Fantastic" class="lazy">
        <div class="picto"><i class="icon icon_photo"></i></div>
        <div class="info">
          <div class="vCenter">
            <div class="vCenterKid">
              <span class="category">Photocall</span>
              <span class="date">17.05.16</span> . <span
                  class="hour">10:44</span>
              <p data-title="Viggo Mortensen - Captain Fantastic">Viggo Mortensen - Captain Fantastic</p>
            </div>
          </div>
        </div>
      </div>
      <div class="item photocall 17-05-16 shadow-bottom photo portrait notloaded">
        <a id="photo1253" class="ajax chocolat-image" data-pid="1253"
           href="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/06/7399cd46732fd23b5a8c3a4133f4df70a7da66df.jpg"
           title='<span class="category">Photocall</span><span class="date">17.05.16 . 10:44</span><h2>Annalise Basso - Captain Fantastic</h2>'
           data-credit="Crédit Image : Venturelli / Getty Images"></a>
        <img data-original="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/06/thumb_5477_media_image_320x404.jpg"  alt="" title="Annalise Basso - Captain Fantastic" class="lazy">
        <div class="picto"><i class="icon icon_photo"></i></div>
        <div class="info">
          <div class="vCenter">
            <div class="vCenterKid">
              <span class="category">Photocall</span>
              <span class="date">17.05.16</span> . <span
                  class="hour">10:44</span>
              <p data-title="Annalise Basso - Captain Fantastic">Annalise Basso - Captain Fantastic</p>
            </div>
          </div>
        </div>
      </div>
      <div class="item photocall 17-05-16 shadow-bottom photo paysage notloaded">
        <a id="photo1242" class="ajax chocolat-image" data-pid="1242"
           href="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/06/013eb869e20bd6d300e9cdd016bebc25cade2213.jpg"
           title='<span class="category">Photocall</span><span class="date">17.05.16 . 10:43</span><h2>Équipe du film - Captain Fantastic</h2>'
           data-credit="Crédit Image : Léo Laumont / FDC"></a>
        <img data-original="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/06/thumb_5463_media_image_640x404.jpg"  alt="" title="Équipe du film - Captain Fantastic" class="lazy">
        <div class="picto"><i class="icon icon_photo"></i></div>
        <div class="info">
          <div class="vCenter">
            <div class="vCenterKid">
              <span class="category">Photocall</span>
              <span class="date">17.05.16</span> . <span
                  class="hour">10:43</span>
              <p data-title="Équipe du film - Captain Fantastic">Équipe du film - Captain Fantastic</p>
            </div>
          </div>
        </div>
      </div>
      <div class="item photocall 17-05-16 shadow-bottom photo paysage notloaded">
        <a id="photo1237" class="ajax chocolat-image" data-pid="1237"
           href="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/06/ad09b564c2042c4966e7e98406f913008961a3b1.jpg"
           title='<span class="category">Photocall</span><span class="date">17.05.16 . 10:35</span><h2>Adriana Ugarte - Julieta</h2>'
           data-credit="Crédit Image : Léo Laumont / FDC"></a>
        <img data-original="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/06/thumb_5459_media_image_640x404.jpg"  alt="" title="Adriana Ugarte - Julieta" class="lazy">
        <div class="picto"><i class="icon icon_photo"></i></div>
        <div class="info">
          <div class="vCenter">
            <div class="vCenterKid">
              <span class="category">Photocall</span>
              <span class="date">17.05.16</span> . <span
                  class="hour">10:35</span>
              <p data-title="Adriana Ugarte - Julieta">Adriana Ugarte - Julieta</p>
            </div>
          </div>
        </div>
      </div>
      <div class="item photocall 17-05-16 shadow-bottom photo paysage notloaded">
        <a id="photo1236" class="ajax chocolat-image" data-pid="1236"
           href="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/06/46df6c5c6089c5d46bc4588445aca61480c04e22.jpg"
           title='<span class="category">Photocall</span><span class="date">17.05.16 . 10:33</span><h2>Emma Suarez, Pedro Almodóvar et Adriana Ugarte - Julieta</h2>'
           data-credit="Crédit Image : Léo Laumont / FDC"></a>
        <img data-original="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/06/thumb_5458_media_image_640x404.jpg"  alt="" title="Emma Suarez, Pedro Almodóvar et Adriana Ugarte - Julieta" class="lazy">
        <div class="picto"><i class="icon icon_photo"></i></div>
        <div class="info">
          <div class="vCenter">
            <div class="vCenterKid">
              <span class="category">Photocall</span>
              <span class="date">17.05.16</span> . <span
                  class="hour">10:33</span>
              <p data-title="Emma Suarez, Pedro Almodóvar et Adriana Ugarte - Julieta">Emma Suarez, Pedro Almodóvar et Adriana Ugarte - Julieta</p>
            </div>
          </div>
        </div>
      </div>
      <div class="item photocall 17-05-16 shadow-bottom photo paysage notloaded">
        <a id="photo1254" class="ajax chocolat-image" data-pid="1254"
           href="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/06/c5c340f7026230bf28e6e3ea986511e3c6f016d3.jpg"
           title='<span class="category">Photocall</span><span class="date">17.05.16 . 10:31</span><h2>Équipe du film - Julieta</h2>'
           data-credit="Crédit Image : Venturelli / Getty Images"></a>
        <img data-original="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/06/thumb_5478_media_image_640x404.jpg"  alt="" title="Équipe du film - Julieta" class="lazy">
        <div class="picto"><i class="icon icon_photo"></i></div>
        <div class="info">
          <div class="vCenter">
            <div class="vCenterKid">
              <span class="category">Photocall</span>
              <span class="date">17.05.16</span> . <span
                  class="hour">10:31</span>
              <p data-title="Équipe du film - Julieta">Équipe du film - Julieta</p>
            </div>
          </div>
        </div>
      </div>
      <div class="item photocall 17-05-16 shadow-bottom photo paysage notloaded">
        <a id="photo1235" class="ajax chocolat-image" data-pid="1235"
           href="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/06/7c065feb20f554d2f563a506d21a0a4e1ebea29c.jpg"
           title='<span class="category">Photocall</span><span class="date">17.05.16 . 10:30</span><h2>Équipe du film - Julieta</h2>'
           data-credit="Crédit Image : Léo Laumont / FDC"></a>
        <img data-original="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/06/thumb_5457_media_image_640x404.jpg"  alt="" title="Équipe du film - Julieta" class="lazy">
        <div class="picto"><i class="icon icon_photo"></i></div>
        <div class="info">
          <div class="vCenter">
            <div class="vCenterKid">
              <span class="category">Photocall</span>
              <span class="date">17.05.16</span> . <span
                  class="hour">10:30</span>
              <p data-title="Équipe du film - Julieta">Équipe du film - Julieta</p>
            </div>
          </div>
        </div>
      </div>
      <div class="item photocall 17-05-16 shadow-bottom photo portrait notloaded">
        <a id="photo1260" class="ajax chocolat-image" data-pid="1260"
           href="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/06/0b634cbc8c7c9db83805b2db47432e5eeab8ef46.jpg"
           title='<span class="category">Photocall</span><span class="date">17.05.16 . 10:30</span><h2>Rossy De Palma - Julieta de Pedro Almodovar</h2>'
           data-credit="Crédit Image : Valéry Hache / AFP"></a>
        <img data-original="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/06/thumb_5517_media_image_320x404.jpg"  alt="" title="Rossy De Palma - Julieta de Pedro Almodovar" class="lazy">
        <div class="picto"><i class="icon icon_photo"></i></div>
        <div class="info">
          <div class="vCenter">
            <div class="vCenterKid">
              <span class="category">Photocall</span>
              <span class="date">17.05.16</span> . <span
                  class="hour">10:30</span>
              <p data-title="Rossy De Palma - Julieta de Pedro Almodovar">Rossy De Palma - Julieta de Pedro Almodovar</p>
            </div>
          </div>
        </div>
      </div>
      <div class="item oeil-du-photographe 17-05-16 shadow-bottom photo paysage notloaded">
        <a id="photo1201" class="ajax chocolat-image" data-pid="1201"
           href="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/06/3fe3d6984b275fdf380d1c11ec34df46f04c9309.jpg"
           title='<span class="category">Œil du photographe</span><span class="date">17.05.16 . 08:48</span><h2>Soirée à la Villa Schweppes</h2>'
           data-credit="Crédit Image : Patrice Terraz / Signatures"></a>
        <img data-original="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/06/thumb_5423_media_image_640x404.jpg"  alt="" title="Soirée à la Villa Schweppes" class="lazy">
        <div class="picto"><i class="icon icon_photo"></i></div>
        <div class="info">
          <div class="vCenter">
            <div class="vCenterKid">
              <span class="category">Œil du photographe</span>
              <span class="date">17.05.16</span> . <span
                  class="hour">08:48</span>
              <p data-title="Soirée à la Villa Schweppes">Soirée à la Villa Schweppes</p>
            </div>
          </div>
        </div>
      </div>
      <div class="item oeil-du-photographe 17-05-16 shadow-bottom photo paysage notloaded">
        <a id="photo1202" class="ajax chocolat-image" data-pid="1202"
           href="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/06/1ece9543083afaa4438f0b8cd80b8e71a949ff8d.jpg"
           title='<span class="category">Œil du photographe</span><span class="date">17.05.16 . 08:48</span><h2>Pendant le concert de The Limiñanas à la Villa Schweppes.</h2>'
           data-credit="Crédit Image : Patrice Terraz / Signatures"></a>
        <img data-original="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/06/thumb_5425_media_image_640x404.jpg"  alt="" title="Pendant le concert de The Limiñanas à la Villa Schweppes." class="lazy">
        <div class="picto"><i class="icon icon_photo"></i></div>
        <div class="info">
          <div class="vCenter">
            <div class="vCenterKid">
              <span class="category">Œil du photographe</span>
              <span class="date">17.05.16</span> . <span
                  class="hour">08:48</span>
              <p data-title="Pendant le concert de The Limiñanas à la Villa Schweppes.">Pendant le concert de The Limiñanas à la Villa Schweppes.</p>
            </div>
          </div>
        </div>
      </div>
      <div class="item oeil-du-photographe 17-05-16 shadow-bottom photo paysage notloaded">
        <a id="photo1203" class="ajax chocolat-image" data-pid="1203"
           href="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/06/da75ec18bd138104fb454f71832b753cae47071b.jpg"
           title='<span class="category">Œil du photographe</span><span class="date">17.05.16 . 08:48</span><h2>Soirée à la Villa Schweppes</h2>'
           data-credit="Crédit Image : Patrice Terraz / Signatures"></a>
        <img data-original="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/06/thumb_5426_media_image_640x404.jpg"  alt="" title="Soirée à la Villa Schweppes" class="lazy">
        <div class="picto"><i class="icon icon_photo"></i></div>
        <div class="info">
          <div class="vCenter">
            <div class="vCenterKid">
              <span class="category">Œil du photographe</span>
              <span class="date">17.05.16</span> . <span
                  class="hour">08:48</span>
              <p data-title="Soirée à la Villa Schweppes">Soirée à la Villa Schweppes</p>
            </div>
          </div>
        </div>
      </div>
      <div class="item oeil-du-photographe 17-05-16 shadow-bottom photo paysage notloaded">
        <a id="photo1204" class="ajax chocolat-image" data-pid="1204"
           href="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/06/c86fddc414a45a012562babb1e9d24ee54b019dd.jpg"
           title='<span class="category">Œil du photographe</span><span class="date">17.05.16 . 08:48</span><h2>Philippe Manœuvre au concert de The Limiñanas</h2>'
           data-credit="Crédit Image : Patrice Terraz / Signatures"></a>
        <img data-original="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/06/thumb_5428_media_image_640x404.jpg"  alt="" title="Philippe Manœuvre au concert de The Limiñanas" class="lazy">
        <div class="picto"><i class="icon icon_photo"></i></div>
        <div class="info">
          <div class="vCenter">
            <div class="vCenterKid">
              <span class="category">Œil du photographe</span>
              <span class="date">17.05.16</span> . <span
                  class="hour">08:48</span>
              <p data-title="Philippe Manœuvre au concert de The Limiñanas">Philippe Manœuvre au concert de The Limiñanas</p>
            </div>
          </div>
        </div>
      </div>
      <div class="item oeil-du-photographe 17-05-16 shadow-bottom photo paysage notloaded">
        <a id="photo1249" class="ajax chocolat-image" data-pid="1249"
           href="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/06/ab1ef2e7976456362f0db6a10b891ec4280f7c85.jpg"
           title='<span class="category">Œil du photographe</span><span class="date">17.05.16 . 08:48</span><h2>Shéhérazade, Agent d&#039;entretien du Palais</h2>'
           data-credit="Crédit Image : Patrice Terraz / Signatures"></a>
        <img data-original="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/06/thumb_5473_media_image_640x404.jpg"  alt="" title="Shéhérazade, Agent d&#039;entretien du Palais" class="lazy">
        <div class="picto"><i class="icon icon_photo"></i></div>
        <div class="info">
          <div class="vCenter">
            <div class="vCenterKid">
              <span class="category">Œil du photographe</span>
              <span class="date">17.05.16</span> . <span
                  class="hour">08:48</span>
              <p data-title="Shéhérazade, Agent d&#039;entretien du Palais">Shéhérazade, Agent d&#039;entretien du Palais</p>
            </div>
          </div>
        </div>
      </div>
      <div class="item oeil-du-photographe 17-05-16 shadow-bottom photo paysage notloaded">
        <a id="photo1266" class="ajax chocolat-image" data-pid="1266"
           href="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/06/5e10c54b2fcb85d98355eb783a41bdcc588a445b.jpg"
           title='<span class="category">Œil du photographe</span><span class="date">17.05.16 . 08:48</span><h2>Soirée à la Villa Schweppes, concert de The Limiñanas</h2>'
           data-credit="Crédit Image : Patrice Terraz / Signatures"></a>
        <img data-original="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/06/thumb_5494_media_image_640x404.jpg"  alt="" title="Soirée à la Villa Schweppes, concert de The Limiñanas" class="lazy">
        <div class="picto"><i class="icon icon_photo"></i></div>
        <div class="info">
          <div class="vCenter">
            <div class="vCenterKid">
              <span class="category">Œil du photographe</span>
              <span class="date">17.05.16</span> . <span
                  class="hour">08:48</span>
              <p data-title="Soirée à la Villa Schweppes, concert de The Limiñanas">Soirée à la Villa Schweppes, concert de The Limiñanas</p>
            </div>
          </div>
        </div>
      </div>
      <div class="item oeil-du-photographe 17-05-16 shadow-bottom photo paysage notloaded">
        <a id="photo1269" class="ajax chocolat-image" data-pid="1269"
           href="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/06/c0bd3680119c24f25385d0ab99135a6b9a063793.jpg"
           title='<span class="category">Œil du photographe</span><span class="date">17.05.16 . 08:48</span><h2>Soirée à la Villa Schweppes</h2>'
           data-credit="Crédit Image : Patrice Terraz / Signatures"></a>
        <img data-original="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/06/thumb_5497_media_image_640x404.jpg"  alt="" title="Soirée à la Villa Schweppes" class="lazy">
        <div class="picto"><i class="icon icon_photo"></i></div>
        <div class="info">
          <div class="vCenter">
            <div class="vCenterKid">
              <span class="category">Œil du photographe</span>
              <span class="date">17.05.16</span> . <span
                  class="hour">08:48</span>
              <p data-title="Soirée à la Villa Schweppes">Soirée à la Villa Schweppes</p>
            </div>
          </div>
        </div>
      </div>
      <div class="item montee-des-marches 16-05-16 shadow-bottom photo paysage notloaded">
        <a id="photo1246" class="ajax chocolat-image" data-pid="1246"
           href="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/06/f25ee30a7f69e08121a2a3f2c281ceecf94b0e16.jpg"
           title='<span class="category">Montée des Marches</span><span class="date">16.05.16 . 23:45</span><h2>Équipe du film - Midnight Return : the Story of Billy Hayes and Turkey</h2>'
           data-credit="Crédit Image : Thomas Leibreich / FDC"></a>
        <img data-original="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/06/thumb_5468_media_image_640x404.jpg"  alt="" title="Équipe du film - Midnight Return : the Story of Billy Hayes and Turkey" class="lazy">
        <div class="picto"><i class="icon icon_photo"></i></div>
        <div class="info">
          <div class="vCenter">
            <div class="vCenterKid">
              <span class="category">Montée des Marches</span>
              <span class="date">16.05.16</span> . <span
                  class="hour">23:45</span>
              <p data-title="Équipe du film - Midnight Return : the Story of Billy Hayes and Turkey">Équipe du film - Midnight Return : the Story of Billy Hayes and Turkey</p>
            </div>
          </div>
        </div>
      </div>
      <div class="item sur-scene 16-05-16 shadow-bottom photo paysage notloaded">
        <a id="photo1227" class="ajax chocolat-image" data-pid="1227"
           href="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/06/d075005d97c7ee62282e217327a71c5f925296b7.jpg"
           title='<span class="category">Sur Scène</span><span class="date">16.05.16 . 22:59</span><h2>David Mackenzie, Chris Pine et Ben Foster - Hell or High Water (Comancheria)</h2>'
           data-credit="Crédit Image : Cyril Duchêne / FDC"></a>
        <img data-original="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/06/thumb_5447_media_image_640x404.jpg"  alt="" title="David Mackenzie, Chris Pine et Ben Foster - Hell or High Water (Comancheria)" class="lazy">
        <div class="picto"><i class="icon icon_photo"></i></div>
        <div class="info">
          <div class="vCenter">
            <div class="vCenterKid">
              <span class="category">Sur Scène</span>
              <span class="date">16.05.16</span> . <span
                  class="hour">22:59</span>
              <p data-title="David Mackenzie, Chris Pine et Ben Foster - Hell or High Water (Comancheria)">David Mackenzie, Chris Pine et Ben Foster - Hell or High Water (Comancheria)</p>
            </div>
          </div>
        </div>
      </div>
      <div class="item sur-scene 16-05-16 shadow-bottom photo paysage notloaded">
        <a id="photo1226" class="ajax chocolat-image" data-pid="1226"
           href="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/06/5f8c95fd2385bb541eb685aa3544ddbc9c2da893.jpg"
           title='<span class="category">Sur Scène</span><span class="date">16.05.16 . 22:30</span><h2>Équipe du film - Hell or High Water (Comancheria)</h2>'
           data-credit="Crédit Image : Cyril Duchêne / FDC"></a>
        <img data-original="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/06/thumb_5446_media_image_640x404.jpg"  alt="" title="Équipe du film - Hell or High Water (Comancheria)" class="lazy">
        <div class="picto"><i class="icon icon_photo"></i></div>
        <div class="info">
          <div class="vCenter">
            <div class="vCenterKid">
              <span class="category">Sur Scène</span>
              <span class="date">16.05.16</span> . <span
                  class="hour">22:30</span>
              <p data-title="Équipe du film - Hell or High Water (Comancheria)">Équipe du film - Hell or High Water (Comancheria)</p>
            </div>
          </div>
        </div>
      </div>
      <div class="item montee-des-marches 16-05-16 shadow-bottom photo paysage notloaded">
        <a id="photo1222" class="ajax chocolat-image" data-pid="1222"
           href="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/06/e9ea77621a0eed84e6a09f9c6bbf550fd0d5524c.jpg"
           title='<span class="category">Montée des Marches</span><span class="date">16.05.16 . 22:15</span><h2>Équipe du film - Hands of Stone</h2>'
           data-credit="Crédit Image : Alberto Pizzoli / AFP"></a>
        <img data-original="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/06/thumb_5443_media_image_640x404.jpg"  alt="" title="Équipe du film - Hands of Stone" class="lazy">
        <div class="picto"><i class="icon icon_photo"></i></div>
        <div class="info">
          <div class="vCenter">
            <div class="vCenterKid">
              <span class="category">Montée des Marches</span>
              <span class="date">16.05.16</span> . <span
                  class="hour">22:15</span>
              <p data-title="Équipe du film - Hands of Stone">Équipe du film - Hands of Stone</p>
            </div>
          </div>
        </div>
      </div>
      <div class="item montee-des-marches 16-05-16 shadow-bottom photo paysage notloaded">
        <a id="photo1221" class="ajax chocolat-image" data-pid="1221"
           href="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/06/6994d3964dbcd206f76ffae64f77599d37ff54ec.jpg"
           title='<span class="category">Montée des Marches</span><span class="date">16.05.16 . 22:12</span><h2>Edgar Ramirez, Ana de Armas et Roberto Duran - Hands of Stone</h2>'
           data-credit="Crédit Image : Alberto Pizzoli / AFP"></a>
        <img data-original="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/06/thumb_5442_media_image_640x404.jpg"  alt="" title="Edgar Ramirez, Ana de Armas et Roberto Duran - Hands of Stone" class="lazy">
        <div class="picto"><i class="icon icon_photo"></i></div>
        <div class="info">
          <div class="vCenter">
            <div class="vCenterKid">
              <span class="category">Montée des Marches</span>
              <span class="date">16.05.16</span> . <span
                  class="hour">22:12</span>
              <p data-title="Edgar Ramirez, Ana de Armas et Roberto Duran - Hands of Stone">Edgar Ramirez, Ana de Armas et Roberto Duran - Hands of Stone</p>
            </div>
          </div>
        </div>
      </div>
      <div class="item montee-des-marches 16-05-16 shadow-bottom photo portrait notloaded">
        <a id="photo1220" class="ajax chocolat-image" data-pid="1220"
           href="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/06/82d4372239f56df51a662458188ceb525bb4726c.jpg"
           title='<span class="category">Montée des Marches</span><span class="date">16.05.16 . 22:11</span><h2>Robert de Niro - Hands of Stone</h2>'
           data-credit="Crédit Image : Valéry Hache / AFP"></a>
        <img data-original="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/06/thumb_5441_media_image_320x404.jpg"  alt="" title="Robert de Niro - Hands of Stone" class="lazy">
        <div class="picto"><i class="icon icon_photo"></i></div>
        <div class="info">
          <div class="vCenter">
            <div class="vCenterKid">
              <span class="category">Montée des Marches</span>
              <span class="date">16.05.16</span> . <span
                  class="hour">22:11</span>
              <p data-title="Robert de Niro - Hands of Stone">Robert de Niro - Hands of Stone</p>
            </div>
          </div>
        </div>
      </div>
      <div class="item montee-des-marches 16-05-16 shadow-bottom photo paysage notloaded">
        <a id="photo1219" class="ajax chocolat-image" data-pid="1219"
           href="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/06/f5950b9b08551bd59210d06ec016628bae8f87a8.jpg"
           title='<span class="category">Montée des Marches</span><span class="date">16.05.16 . 22:10</span><h2>Jonathan Jakubowicz, Robert de Niro, Grace Hightower et Roberto Duran - Hands of Stone</h2>'
           data-credit="Crédit Image : Alberto Pizzoli / AFP"></a>
        <img data-original="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/06/thumb_5440_media_image_640x404.jpg"  alt="" title="Jonathan Jakubowicz, Robert de Niro, Grace Hightower et Roberto Duran - Hands of Stone" class="lazy">
        <div class="picto"><i class="icon icon_photo"></i></div>
        <div class="info">
          <div class="vCenter">
            <div class="vCenterKid">
              <span class="category">Montée des Marches</span>
              <span class="date">16.05.16</span> . <span
                  class="hour">22:10</span>
              <p data-title="Jonathan Jakubowicz, Robert de Niro, Grace Hightower et Roberto Duran - Hands of Stone">Jonathan Jakubowicz, Robert de Niro, Grace Hightower et Roberto Duran - Hands of Stone</p>
            </div>
          </div>
        </div>
      </div>
      <div class="item montee-des-marches 16-05-16 shadow-bottom photo paysage notloaded">
        <a id="photo1215" class="ajax chocolat-image" data-pid="1215"
           href="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/06/2db8d8f30cb1eedd713d06e1946c3bfffef6d5dc.jpg"
           title='<span class="category">Montée des Marches</span><span class="date">16.05.16 . 20:37</span><h2>Chris Pine - Hell or High Water (Comancheria)</h2>'
           data-credit="Crédit Image : Alberto Pizzoli / AFP"></a>
        <img data-original="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/06/thumb_5435_media_image_640x404.jpg"  alt="" title="Chris Pine - Hell or High Water (Comancheria)" class="lazy">
        <div class="picto"><i class="icon icon_photo"></i></div>
        <div class="info">
          <div class="vCenter">
            <div class="vCenterKid">
              <span class="category">Montée des Marches</span>
              <span class="date">16.05.16</span> . <span
                  class="hour">20:37</span>
              <p data-title="Chris Pine - Hell or High Water (Comancheria)">Chris Pine - Hell or High Water (Comancheria)</p>
            </div>
          </div>
        </div>
      </div>
      <div class="item montee-des-marches 16-05-16 shadow-bottom photo paysage notloaded">
        <a id="photo1217" class="ajax chocolat-image" data-pid="1217"
           href="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/06/01d4fee82c93e04c74b8e7335d6b7424a282b905.jpg"
           title='<span class="category">Montée des Marches</span><span class="date">16.05.16 . 20:35</span><h2>Ben Foster, Chris Pine et David Mackenzie - Hell or High Water (Comancheria)</h2>'
           data-credit="Crédit Image : Alberto Pizzoli / AFP"></a>
        <img data-original="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/06/thumb_5437_media_image_640x404.jpg"  alt="" title="Ben Foster, Chris Pine et David Mackenzie - Hell or High Water (Comancheria)" class="lazy">
        <div class="picto"><i class="icon icon_photo"></i></div>
        <div class="info">
          <div class="vCenter">
            <div class="vCenterKid">
              <span class="category">Montée des Marches</span>
              <span class="date">16.05.16</span> . <span
                  class="hour">20:35</span>
              <p data-title="Ben Foster, Chris Pine et David Mackenzie - Hell or High Water (Comancheria)">Ben Foster, Chris Pine et David Mackenzie - Hell or High Water (Comancheria)</p>
            </div>
          </div>
        </div>
      </div>
      <div class="item montee-des-marches 16-05-16 shadow-bottom photo paysage notloaded">
        <a id="photo1212" class="ajax chocolat-image" data-pid="1212"
           href="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/06/920501c892b912daef6ee067f02d944f489ceb7c.jpg"
           title='<span class="category">Montée des Marches</span><span class="date">16.05.16 . 20:30</span><h2>Mads Mikkelsen - Membre du Jury des Longs Métrages</h2>'
           data-credit="Crédit Image : Loïc Venance / AFP"></a>
        <img data-original="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/06/thumb_5433_media_image_640x404.jpg"  alt="" title="Mads Mikkelsen - Membre du Jury des Longs Métrages" class="lazy">
        <div class="picto"><i class="icon icon_photo"></i></div>
        <div class="info">
          <div class="vCenter">
            <div class="vCenterKid">
              <span class="category">Montée des Marches</span>
              <span class="date">16.05.16</span> . <span
                  class="hour">20:30</span>
              <p data-title="Mads Mikkelsen - Membre du Jury des Longs Métrages">Mads Mikkelsen - Membre du Jury des Longs Métrages</p>
            </div>
          </div>
        </div>
      </div>
      <div class="item montee-des-marches 16-05-16 shadow-bottom photo paysage notloaded">
        <a id="photo1213" class="ajax chocolat-image" data-pid="1213"
           href="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/06/955500ce6844113b02b3a0b44e82acb21f2cced9.jpg"
           title='<span class="category">Montée des Marches</span><span class="date">16.05.16 . 20:30</span><h2>Kate Moss</h2>'
           data-credit="Crédit Image : Loïc Venance / AFP"></a>
        <img data-original="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/06/thumb_5434_media_image_640x404.jpg"  alt="" title="Kate Moss" class="lazy">
        <div class="picto"><i class="icon icon_photo"></i></div>
        <div class="info">
          <div class="vCenter">
            <div class="vCenterKid">
              <span class="category">Montée des Marches</span>
              <span class="date">16.05.16</span> . <span
                  class="hour">20:30</span>
              <p data-title="Kate Moss">Kate Moss</p>
            </div>
          </div>
        </div>
      </div>
      <div class="item montee-des-marches 16-05-16 shadow-bottom photo paysage notloaded">
        <a id="photo1211" class="ajax chocolat-image" data-pid="1211"
           href="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/06/cd410009809db5b2d43675f6833a08b95d0bb658.jpg"
           title='<span class="category">Montée des Marches</span><span class="date">16.05.16 . 20:25</span><h2>Pascal Legitimus</h2>'
           data-credit="Crédit Image : Valéry Hache / AFP"></a>
        <img data-original="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/06/thumb_5432_media_image_640x404.jpg"  alt="" title="Pascal Legitimus" class="lazy">
        <div class="picto"><i class="icon icon_photo"></i></div>
        <div class="info">
          <div class="vCenter">
            <div class="vCenterKid">
              <span class="category">Montée des Marches</span>
              <span class="date">16.05.16</span> . <span
                  class="hour">20:25</span>
              <p data-title="Pascal Legitimus">Pascal Legitimus</p>
            </div>
          </div>
        </div>
      </div>
      <div class="item sur-scene 16-05-16 shadow-bottom photo paysage notloaded">
        <a id="photo1210" class="ajax chocolat-image" data-pid="1210"
           href="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/06/49e2f82e1479fc0c281b2bac8420041a4a3e529f.jpg"
           title='<span class="category">Sur Scène</span><span class="date">16.05.16 . 20:20</span><h2>Vincent Perez et Régis Wargnier - Indochine</h2>'
           data-credit="Crédit Image : Mathilde Petit / FDC"></a>
        <img data-original="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/06/thumb_5430_media_image_640x404.jpg"  alt="" title="Vincent Perez et Régis Wargnier - Indochine" class="lazy">
        <div class="picto"><i class="icon icon_photo"></i></div>
        <div class="info">
          <div class="vCenter">
            <div class="vCenterKid">
              <span class="category">Sur Scène</span>
              <span class="date">16.05.16</span> . <span
                  class="hour">20:20</span>
              <p data-title="Vincent Perez et Régis Wargnier - Indochine">Vincent Perez et Régis Wargnier - Indochine</p>
            </div>
          </div>
        </div>
      </div>
      <div class="item montee-des-marches 16-05-16 shadow-bottom photo portrait notloaded">
        <a id="photo1205" class="ajax chocolat-image" data-pid="1205"
           href="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/06/7e0fcad8bb3465dcc902c287926acb8f75856dde.jpg"
           title='<span class="category">Montée des Marches</span><span class="date">16.05.16 . 20:00</span><h2>Régis Wargnier et Vincent Perez - Indochine</h2>'
           data-credit="Crédit Image : Léo Laumont / FDC"></a>
        <img data-original="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/06/thumb_5424_media_image_320x404.jpg"  alt="" title="Régis Wargnier et Vincent Perez - Indochine" class="lazy">
        <div class="picto"><i class="icon icon_photo"></i></div>
        <div class="info">
          <div class="vCenter">
            <div class="vCenterKid">
              <span class="category">Montée des Marches</span>
              <span class="date">16.05.16</span> . <span
                  class="hour">20:00</span>
              <p data-title="Régis Wargnier et Vincent Perez - Indochine">Régis Wargnier et Vincent Perez - Indochine</p>
            </div>
          </div>
        </div>
      </div>
      <div class="item sur-scene 16-05-16 shadow-bottom photo paysage notloaded">
        <a id="photo1200" class="ajax chocolat-image" data-pid="1200"
           href="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/06/4d0c1aea6538492220bae0d52be2ed0670c99bbb.jpg"
           title='<span class="category">Sur Scène</span><span class="date">16.05.16 . 19:00</span><h2>Julia et Clara Kuperberg et Gérald Duchaussoy - Et la femme créa Hollywood</h2>'
           data-credit="Crédit Image : Thomas Leibreich / FDC"></a>
        <img data-original="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/06/thumb_5418_media_image_640x404.jpg"  alt="" title="Julia et Clara Kuperberg et Gérald Duchaussoy - Et la femme créa Hollywood" class="lazy">
        <div class="picto"><i class="icon icon_photo"></i></div>
        <div class="info">
          <div class="vCenter">
            <div class="vCenterKid">
              <span class="category">Sur Scène</span>
              <span class="date">16.05.16</span> . <span
                  class="hour">19:00</span>
              <p data-title="Julia et Clara Kuperberg et Gérald Duchaussoy - Et la femme créa Hollywood">Julia et Clara Kuperberg et Gérald Duchaussoy - Et la femme créa Hollywood</p>
            </div>
          </div>
        </div>
      </div>
      <div class="item montee-des-marches 16-05-16 shadow-bottom photo paysage notloaded">
        <a id="photo1197" class="ajax chocolat-image" data-pid="1197"
           href="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/06/08fdea615a6402dc6ae775b81db80c22fe7fff26.jpg"
           title='<span class="category">Montée des Marches</span><span class="date">16.05.16 . 18:35</span><h2>Jeff Nichols, Ruth Negga, Thierry Frémaux et Joel Edgerton - Loving</h2>'
           data-credit="Crédit Image : Valéry Hache / AFP"></a>
        <img data-original="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/06/thumb_5415_media_image_640x404.jpg"  alt="" title="Jeff Nichols, Ruth Negga, Thierry Frémaux et Joel Edgerton - Loving" class="lazy">
        <div class="picto"><i class="icon icon_photo"></i></div>
        <div class="info">
          <div class="vCenter">
            <div class="vCenterKid">
              <span class="category">Montée des Marches</span>
              <span class="date">16.05.16</span> . <span
                  class="hour">18:35</span>
              <p data-title="Jeff Nichols, Ruth Negga, Thierry Frémaux et Joel Edgerton - Loving">Jeff Nichols, Ruth Negga, Thierry Frémaux et Joel Edgerton - Loving</p>
            </div>
          </div>
        </div>
      </div>
      <div class="item montee-des-marches 16-05-16 shadow-bottom photo paysage notloaded">
        <a id="photo1195" class="ajax chocolat-image" data-pid="1195"
           href="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/06/7da21dbe35e2e197b3dc4c957c1e467aa18c5e79.jpg"
           title='<span class="category">Montée des Marches</span><span class="date">16.05.16 . 18:33</span><h2>Ruth Negga et Joel Edgerton - Loving</h2>'
           data-credit="Crédit Image : Valéry Hache / AFP"></a>
        <img data-original="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/06/thumb_5414_media_image_640x404.jpg"  alt="" title="Ruth Negga et Joel Edgerton - Loving" class="lazy">
        <div class="picto"><i class="icon icon_photo"></i></div>
        <div class="info">
          <div class="vCenter">
            <div class="vCenterKid">
              <span class="category">Montée des Marches</span>
              <span class="date">16.05.16</span> . <span
                  class="hour">18:33</span>
              <p data-title="Ruth Negga et Joel Edgerton - Loving">Ruth Negga et Joel Edgerton - Loving</p>
            </div>
          </div>
        </div>
      </div>
      <div class="item montee-des-marches 16-05-16 shadow-bottom photo paysage notloaded">
        <a id="photo1196" class="ajax chocolat-image" data-pid="1196"
           href="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/06/c0772fcf4cb897956ff5f04f6e700ba6426d711f.jpg"
           title='<span class="category">Montée des Marches</span><span class="date">16.05.16 . 18:30</span><h2>Jeff Nichols, Ruth Negga et Joel Edgerton - Loving</h2>'
           data-credit="Crédit Image : Alberto Pizzoli / AFP"></a>
        <img data-original="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/06/thumb_5413_media_image_640x404.jpg"  alt="" title="Jeff Nichols, Ruth Negga et Joel Edgerton - Loving" class="lazy">
        <div class="picto"><i class="icon icon_photo"></i></div>
        <div class="info">
          <div class="vCenter">
            <div class="vCenterKid">
              <span class="category">Montée des Marches</span>
              <span class="date">16.05.16</span> . <span
                  class="hour">18:30</span>
              <p data-title="Jeff Nichols, Ruth Negga et Joel Edgerton - Loving">Jeff Nichols, Ruth Negga et Joel Edgerton - Loving</p>
            </div>
          </div>
        </div>
      </div>
      <div class="item sur-scene 16-05-16 shadow-bottom photo paysage notloaded">
        <a id="photo1174" class="ajax chocolat-image" data-pid="1174"
           href="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/06/4b9ef57a234dc37ba5f89509792e0c200830fe8e.jpg"
           title='<span class="category">Sur Scène</span><span class="date">16.05.16 . 16:20</span><h2>Équipe du film - Apprentice</h2>'
           data-credit="Crédit Image : Thomas Leibreich / FDC"></a>
        <img data-original="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/06/thumb_5397_media_image_640x404.jpg"  alt="" title="Équipe du film - Apprentice" class="lazy">
        <div class="picto"><i class="icon icon_photo"></i></div>
        <div class="info">
          <div class="vCenter">
            <div class="vCenterKid">
              <span class="category">Sur Scène</span>
              <span class="date">16.05.16</span> . <span
                  class="hour">16:20</span>
              <p data-title="Équipe du film - Apprentice">Équipe du film - Apprentice</p>
            </div>
          </div>
        </div>
      </div>
      <div class="item avant-la-projection 16-05-16 shadow-bottom photo paysage notloaded">
        <a id="photo1173" class="ajax chocolat-image" data-pid="1173"
           href="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/06/4ebc34d70cd899045ffffe05bac5de61bc4cd290.jpg"
           title='<span class="category">Avant la projection</span><span class="date">16.05.16 . 16:15</span><h2>Équipe du film - Apprentice</h2>'
           data-credit="Crédit Image : Thomas Leibreich / FDC"></a>
        <img data-original="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/06/thumb_5396_media_image_640x404.jpg"  alt="" title="Équipe du film - Apprentice" class="lazy">
        <div class="picto"><i class="icon icon_photo"></i></div>
        <div class="info">
          <div class="vCenter">
            <div class="vCenterKid">
              <span class="category">Avant la projection</span>
              <span class="date">16.05.16</span> . <span
                  class="hour">16:15</span>
              <p data-title="Équipe du film - Apprentice">Équipe du film - Apprentice</p>
            </div>
          </div>
        </div>
      </div>
      <div class="item montee-des-marches 16-05-16 shadow-bottom photo paysage notloaded">
        <a id="photo1172" class="ajax chocolat-image" data-pid="1172"
           href="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/06/ddc4dc8e4104fe1956bf60c589fb6f73761b00c8.jpg"
           title='<span class="category">Montée des Marches</span><span class="date">16.05.16 . 16:13</span><h2>Wan Hanafisu, Mastura Ahmad, Boo Junfeng et Firdaus Rahman - Apprentice</h2>'
           data-credit="Crédit Image : Cyril Duchêne / FDC"></a>
        <img data-original="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/06/thumb_5395_media_image_640x404.jpg"  alt="" title="Wan Hanafisu, Mastura Ahmad, Boo Junfeng et Firdaus Rahman - Apprentice" class="lazy">
        <div class="picto"><i class="icon icon_photo"></i></div>
        <div class="info">
          <div class="vCenter">
            <div class="vCenterKid">
              <span class="category">Montée des Marches</span>
              <span class="date">16.05.16</span> . <span
                  class="hour">16:13</span>
              <p data-title="Wan Hanafisu, Mastura Ahmad, Boo Junfeng et Firdaus Rahman - Apprentice">Wan Hanafisu, Mastura Ahmad, Boo Junfeng et Firdaus Rahman - Apprentice</p>
            </div>
          </div>
        </div>
      </div>
      <div class="item montee-des-marches 16-05-16 shadow-bottom photo portrait notloaded">
        <a id="photo1163" class="ajax chocolat-image" data-pid="1163"
           href="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/06/b625dfdcb808b15bd99ee109710910bcdbb182f6.jpg"
           title='<span class="category">Montée des Marches</span><span class="date">16.05.16 . 15:40</span><h2>Jim Jarmusch - Paterson</h2>'
           data-credit="Crédit Image : Pascal Le Segretain / Getty Images"></a>
        <img data-original="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/06/thumb_5386_media_image_320x404.jpg"  alt="" title="Jim Jarmusch - Paterson" class="lazy">
        <div class="picto"><i class="icon icon_photo"></i></div>
        <div class="info">
          <div class="vCenter">
            <div class="vCenterKid">
              <span class="category">Montée des Marches</span>
              <span class="date">16.05.16</span> . <span
                  class="hour">15:40</span>
              <p data-title="Jim Jarmusch - Paterson">Jim Jarmusch - Paterson</p>
            </div>
          </div>
        </div>
      </div>
      <div class="item evenement 16-05-16 shadow-bottom photo paysage notloaded">
        <a id="photo1175" class="ajax chocolat-image" data-pid="1175"
           href="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/06/54f42f27e74bfcaa1c9ded0f3650b1a4fd1a2cd7.jpg"
           title='<span class="category">Évènement</span><span class="date">16.05.16 . 15:27</span><h2>Günther H. Oettinger - Conférence de presse de la Commission Européenne</h2>'
           data-credit="Crédit Image : Mathilde Petit / FDC"></a>
        <img data-original="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/06/thumb_5398_media_image_640x404.jpg"  alt="" title="Günther H. Oettinger - Conférence de presse de la Commission Européenne" class="lazy">
        <div class="picto"><i class="icon icon_photo"></i></div>
        <div class="info">
          <div class="vCenter">
            <div class="vCenterKid">
              <span class="category">Évènement</span>
              <span class="date">16.05.16</span> . <span
                  class="hour">15:27</span>
              <p data-title="Günther H. Oettinger - Conférence de presse de la Commission Européenne">Günther H. Oettinger - Conférence de presse de la Commission Européenne</p>
            </div>
          </div>
        </div>
      </div>
      <div class="item montee-des-marches 16-05-16 shadow-bottom photo portrait notloaded">
        <a id="photo1162" class="ajax chocolat-image" data-pid="1162"
           href="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/06/75fca231018703fb7e5cb0bd7ac72fa743f81ab0.jpg"
           title='<span class="category">Montée des Marches</span><span class="date">16.05.16 . 15:25</span><h2>Adam Driver, Golshifteh Farahani et Jim Jarmusch - Paterson</h2>'
           data-credit="Crédit Image : Pascal Le Segretain / Getty Images"></a>
        <img data-original="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/06/thumb_5385_media_image_320x404.jpg"  alt="" title="Adam Driver, Golshifteh Farahani et Jim Jarmusch - Paterson" class="lazy">
        <div class="picto"><i class="icon icon_photo"></i></div>
        <div class="info">
          <div class="vCenter">
            <div class="vCenterKid">
              <span class="category">Montée des Marches</span>
              <span class="date">16.05.16</span> . <span
                  class="hour">15:25</span>
              <p data-title="Adam Driver, Golshifteh Farahani et Jim Jarmusch - Paterson">Adam Driver, Golshifteh Farahani et Jim Jarmusch - Paterson</p>
            </div>
          </div>
        </div>
      </div>
      <div class="item evenement 16-05-16 shadow-bottom photo paysage notloaded">
        <a id="photo1165" class="ajax chocolat-image" data-pid="1165"
           href="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/06/bbb7dbacf51f65623c538c57c832b01ecf07f3c5.jpg"
           title='<span class="category">Évènement</span><span class="date">16.05.16 . 15:20</span><h2>Günther H.  Oettinger, Nathalie Vandystadt,  Costa Gavras et Pawel Pawlikowski - Point presse de la Commission Européenne</h2>'
           data-credit="Crédit Image : Cyril Duchêne / FDC"></a>
        <img data-original="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/06/thumb_5388_media_image_640x404.jpg"  alt="" title="Günther H.  Oettinger, Nathalie Vandystadt,  Costa Gavras et Pawel Pawlikowski - Point presse de la Commission Européenne" class="lazy">
        <div class="picto"><i class="icon icon_photo"></i></div>
        <div class="info">
          <div class="vCenter">
            <div class="vCenterKid">
              <span class="category">Évènement</span>
              <span class="date">16.05.16</span> . <span
                  class="hour">15:20</span>
              <p data-title="Günther H.  Oettinger, Nathalie Vandystadt,  Costa Gavras et Pawel Pawlikowski - Point presse de la Commission Européenne">Günther H.  Oettinger, Nathalie Vandystadt,  Costa Gavras et Pawel Pawlikowski - Point presse de la Commission Européenne</p>
            </div>
          </div>
        </div>
      </div>
      <div class="item sur-scene 16-05-16 shadow-bottom photo paysage notloaded">
        <a id="photo1161" class="ajax chocolat-image" data-pid="1161"
           href="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/06/89a6b66e0455ea349cb6abf8caa20169f676cd76.jpg"
           title='<span class="category">Sur Scène</span><span class="date">16.05.16 . 14:45</span><h2>Bertrand Tavernier et Thierry Frémaux - Voyage à travers le cinéma français</h2>'
           data-credit="Crédit Image : Thomas Leibreich / FDC"></a>
        <img data-original="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/06/thumb_5384_media_image_640x404.jpg"  alt="" title="Bertrand Tavernier et Thierry Frémaux - Voyage à travers le cinéma français" class="lazy">
        <div class="picto"><i class="icon icon_photo"></i></div>
        <div class="info">
          <div class="vCenter">
            <div class="vCenterKid">
              <span class="category">Sur Scène</span>
              <span class="date">16.05.16</span> . <span
                  class="hour">14:45</span>
              <p data-title="Bertrand Tavernier et Thierry Frémaux - Voyage à travers le cinéma français">Bertrand Tavernier et Thierry Frémaux - Voyage à travers le cinéma français</p>
            </div>
          </div>
        </div>
      </div>
      <div class="item conference-de-presse 16-05-16 shadow-bottom photo paysage notloaded">
        <a id="photo1160" class="ajax chocolat-image" data-pid="1160"
           href="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/06/40fed454ed158432e9e2629a6c2403daf2479486.jpg"
           title='<span class="category">Conférence de Presse</span><span class="date">16.05.16 . 14:35</span><h2>Équipe du film - Paterson</h2>'
           data-credit="Crédit Image : Cyril Duchêne / FDC"></a>
        <img data-original="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/06/thumb_5383_media_image_640x404.jpg"  alt="" title="Équipe du film - Paterson" class="lazy">
        <div class="picto"><i class="icon icon_photo"></i></div>
        <div class="info">
          <div class="vCenter">
            <div class="vCenterKid">
              <span class="category">Conférence de Presse</span>
              <span class="date">16.05.16</span> . <span
                  class="hour">14:35</span>
              <p data-title="Équipe du film - Paterson">Équipe du film - Paterson</p>
            </div>
          </div>
        </div>
      </div>
      <div class="item photocall 16-05-16 shadow-bottom photo portrait notloaded">
        <a id="photo1188" class="ajax chocolat-image" data-pid="1188"
           href="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/06/cfc8bac8b760aa121025b6c3b9c09ea0535e1aa4.jpg"
           title='<span class="category">Photocall</span><span class="date">16.05.16 . 14:35</span><h2>Robert de Niro et Roberto Duran - Hands of Stone</h2>'
           data-credit="Crédit Image : Loïc Venance / AFP"></a>
        <img data-original="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/06/thumb_5407_media_image_320x404.jpg"  alt="" title="Robert de Niro et Roberto Duran - Hands of Stone" class="lazy">
        <div class="picto"><i class="icon icon_photo"></i></div>
        <div class="info">
          <div class="vCenter">
            <div class="vCenterKid">
              <span class="category">Photocall</span>
              <span class="date">16.05.16</span> . <span
                  class="hour">14:35</span>
              <p data-title="Robert de Niro et Roberto Duran - Hands of Stone">Robert de Niro et Roberto Duran - Hands of Stone</p>
            </div>
          </div>
        </div>
      </div>
      <div class="item conference-de-presse 16-05-16 shadow-bottom photo paysage notloaded">
        <a id="photo1159" class="ajax chocolat-image" data-pid="1159"
           href="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/06/88a297b2a94873b1e4e0ab9ed8a401bd7aad92f3.jpg"
           title='<span class="category">Conférence de Presse</span><span class="date">16.05.16 . 14:33</span><h2>Adam Driver - Paterson</h2>'
           data-credit="Crédit Image : Cyril Duchêne / FDC"></a>
        <img data-original="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/06/thumb_5380_media_image_640x404.jpg"  alt="" title="Adam Driver - Paterson" class="lazy">
        <div class="picto"><i class="icon icon_photo"></i></div>
        <div class="info">
          <div class="vCenter">
            <div class="vCenterKid">
              <span class="category">Conférence de Presse</span>
              <span class="date">16.05.16</span> . <span
                  class="hour">14:33</span>
              <p data-title="Adam Driver - Paterson">Adam Driver - Paterson</p>
            </div>
          </div>
        </div>
      </div>
      <div class="item photocall 16-05-16 shadow-bottom photo portrait notloaded">
        <a id="photo1157" class="ajax chocolat-image" data-pid="1157"
           href="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/06/9cc58fe30cc006fdbaeb23275ad18065bba5e252.jpg"
           title='<span class="category">Photocall</span><span class="date">16.05.16 . 14:30</span><h2>Usher - Hands of Stone</h2>'
           data-credit="Crédit Image : Mathilde Petit / FDC"></a>
        <img data-original="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/06/thumb_5375_media_image_320x404.jpg"  alt="" title="Usher - Hands of Stone" class="lazy">
        <div class="picto"><i class="icon icon_photo"></i></div>
        <div class="info">
          <div class="vCenter">
            <div class="vCenterKid">
              <span class="category">Photocall</span>
              <span class="date">16.05.16</span> . <span
                  class="hour">14:30</span>
              <p data-title="Usher - Hands of Stone">Usher - Hands of Stone</p>
            </div>
          </div>
        </div>
      </div>
      <div class="item photocall 16-05-16 shadow-bottom photo paysage notloaded">
        <a id="photo1155" class="ajax chocolat-image" data-pid="1155"
           href="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/06/3f55ae0681a5778d863d6c3c13bfe104b4905cbc.jpg"
           title='<span class="category">Photocall</span><span class="date">16.05.16 . 14:25</span><h2>Équipe du film - Hands of Stone</h2>'
           data-credit="Crédit Image : Mathilde Petit / FDC"></a>
        <img data-original="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/06/thumb_5373_media_image_640x404.jpg"  alt="" title="Équipe du film - Hands of Stone" class="lazy">
        <div class="picto"><i class="icon icon_photo"></i></div>
        <div class="info">
          <div class="vCenter">
            <div class="vCenterKid">
              <span class="category">Photocall</span>
              <span class="date">16.05.16</span> . <span
                  class="hour">14:25</span>
              <p data-title="Équipe du film - Hands of Stone">Équipe du film - Hands of Stone</p>
            </div>
          </div>
        </div>
      </div>
      <div class="item photocall 16-05-16 shadow-bottom photo paysage notloaded">
        <a id="photo1142" class="ajax chocolat-image" data-pid="1142"
           href="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/06/68103ca03d031116e31abe2e36199df73059b1a3.jpg"
           title='<span class="category">Photocall</span><span class="date">16.05.16 . 14:15</span><h2>David Mackenzie - Hell or High Water (Comancheria)</h2>'
           data-credit="Crédit Image : Mathilde Petit / FDC"></a>
        <img data-original="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/06/thumb_5363_media_image_640x404.jpg"  alt="" title="David Mackenzie - Hell or High Water (Comancheria)" class="lazy">
        <div class="picto"><i class="icon icon_photo"></i></div>
        <div class="info">
          <div class="vCenter">
            <div class="vCenterKid">
              <span class="category">Photocall</span>
              <span class="date">16.05.16</span> . <span
                  class="hour">14:15</span>
              <p data-title="David Mackenzie - Hell or High Water (Comancheria)">David Mackenzie - Hell or High Water (Comancheria)</p>
            </div>
          </div>
        </div>
      </div>
      <div class="item photocall 16-05-16 shadow-bottom photo paysage notloaded">
        <a id="photo1141" class="ajax chocolat-image" data-pid="1141"
           href="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/06/e27655a8b857f483c758f37c5b396232f493dc2a.jpg"
           title='<span class="category">Photocall</span><span class="date">16.05.16 . 14:12</span><h2>David Mackenzie, Ben Foster et Chris Pine - Hell or High Water (Comancheria)</h2>'
           data-credit="Crédit Image : Mathilde Petit / FDC"></a>
        <img data-original="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/06/thumb_5362_media_image_640x404.jpg"  alt="" title="David Mackenzie, Ben Foster et Chris Pine - Hell or High Water (Comancheria)" class="lazy">
        <div class="picto"><i class="icon icon_photo"></i></div>
        <div class="info">
          <div class="vCenter">
            <div class="vCenterKid">
              <span class="category">Photocall</span>
              <span class="date">16.05.16</span> . <span
                  class="hour">14:12</span>
              <p data-title="David Mackenzie, Ben Foster et Chris Pine - Hell or High Water (Comancheria)">David Mackenzie, Ben Foster et Chris Pine - Hell or High Water (Comancheria)</p>
            </div>
          </div>
        </div>
      </div>
      <div class="item photocall 16-05-16 shadow-bottom photo paysage notloaded">
        <a id="photo1140" class="ajax chocolat-image" data-pid="1140"
           href="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/06/cb8e3447f8cef984af53f50a4e8866ddb6f3b1a9.jpg"
           title='<span class="category">Photocall</span><span class="date">16.05.16 . 14:10</span><h2>Jim Jarmusch - Paterson</h2>'
           data-credit="Crédit Image : Mathilde Petit / FDC"></a>
        <img data-original="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/06/thumb_5361_media_image_640x404.jpg"  alt="" title="Jim Jarmusch - Paterson" class="lazy">
        <div class="picto"><i class="icon icon_photo"></i></div>
        <div class="info">
          <div class="vCenter">
            <div class="vCenterKid">
              <span class="category">Photocall</span>
              <span class="date">16.05.16</span> . <span
                  class="hour">14:10</span>
              <p data-title="Jim Jarmusch - Paterson">Jim Jarmusch - Paterson</p>
            </div>
          </div>
        </div>
      </div>
      <div class="item photocall 16-05-16 shadow-bottom photo portrait notloaded">
        <a id="photo1139" class="ajax chocolat-image" data-pid="1139"
           href="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/06/c011a7f94f10ab9e083b0e679822cd81dc44ae24.jpg"
           title='<span class="category">Photocall</span><span class="date">16.05.16 . 14:07</span><h2>Golshifteh Farahani - Paterson</h2>'
           data-credit="Crédit Image : Léo Laumont / FDC"></a>
        <img data-original="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/06/thumb_5377_media_image_320x404.jpg"  alt="" title="Golshifteh Farahani - Paterson" class="lazy">
        <div class="picto"><i class="icon icon_photo"></i></div>
        <div class="info">
          <div class="vCenter">
            <div class="vCenterKid">
              <span class="category">Photocall</span>
              <span class="date">16.05.16</span> . <span
                  class="hour">14:07</span>
              <p data-title="Golshifteh Farahani - Paterson">Golshifteh Farahani - Paterson</p>
            </div>
          </div>
        </div>
      </div>
      <div class="item photocall 16-05-16 shadow-bottom photo paysage notloaded">
        <a id="photo1138" class="ajax chocolat-image" data-pid="1138"
           href="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/06/01aa4156c3d6fa9c0aaa23a7bbc0facd9a45adb4.jpg"
           title='<span class="category">Photocall</span><span class="date">16.05.16 . 14:05</span><h2>Équipe du film - Paterson</h2>'
           data-credit="Crédit Image : Mathilde Petit / FDC"></a>
        <img data-original="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/06/thumb_5359_media_image_640x404.jpg"  alt="" title="Équipe du film - Paterson" class="lazy">
        <div class="picto"><i class="icon icon_photo"></i></div>
        <div class="info">
          <div class="vCenter">
            <div class="vCenterKid">
              <span class="category">Photocall</span>
              <span class="date">16.05.16</span> . <span
                  class="hour">14:05</span>
              <p data-title="Équipe du film - Paterson">Équipe du film - Paterson</p>
            </div>
          </div>
        </div>
      </div>
      <div class="item photocall 16-05-16 shadow-bottom photo paysage notloaded">
        <a id="photo1137" class="ajax chocolat-image" data-pid="1137"
           href="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/06/7e8a8f05428b2ecd1a9a7af4e413070ebd47c28e.jpg"
           title='<span class="category">Photocall</span><span class="date">16.05.16 . 14:00</span><h2>Adam Driver - Paterson</h2>'
           data-credit="Crédit Image : Mathilde Petit / FDC"></a>
        <img data-original="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/06/thumb_5358_media_image_640x404.jpg"  alt="" title="Adam Driver - Paterson" class="lazy">
        <div class="picto"><i class="icon icon_photo"></i></div>
        <div class="info">
          <div class="vCenter">
            <div class="vCenterKid">
              <span class="category">Photocall</span>
              <span class="date">16.05.16</span> . <span
                  class="hour">14:00</span>
              <p data-title="Adam Driver - Paterson">Adam Driver - Paterson</p>
            </div>
          </div>
        </div>
      </div>
      <div class="item sur-scene 16-05-16 shadow-bottom photo paysage notloaded">
        <a id="photo1122" class="ajax chocolat-image" data-pid="1122"
           href="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/06/024c788342308dc6d43fa0b5e7594546a21e0d11.jpg"
           title='<span class="category">Sur Scène</span><span class="date">16.05.16 . 12:45</span><h2>Eryk Rocha et Thierry Frémaux - Cinema Novo</h2>'
           data-credit="Crédit Image : Thomas Leibreich / FDC"></a>
        <img data-original="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/06/thumb_5346_media_image_640x404.jpg"  alt="" title="Eryk Rocha et Thierry Frémaux - Cinema Novo" class="lazy">
        <div class="picto"><i class="icon icon_photo"></i></div>
        <div class="info">
          <div class="vCenter">
            <div class="vCenterKid">
              <span class="category">Sur Scène</span>
              <span class="date">16.05.16</span> . <span
                  class="hour">12:45</span>
              <p data-title="Eryk Rocha et Thierry Frémaux - Cinema Novo">Eryk Rocha et Thierry Frémaux - Cinema Novo</p>
            </div>
          </div>
        </div>
      </div>
      <div class="item conference-de-presse 16-05-16 shadow-bottom photo paysage notloaded">
        <a id="photo1129" class="ajax chocolat-image" data-pid="1129"
           href="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/06/84ad81fdc24a88febdaa76ab314414db73a9fc4e.jpg"
           title='<span class="category">Conférence de Presse</span><span class="date">16.05.16 . 11:10</span><h2>Jeff Nichols - Loving</h2>'
           data-credit="Crédit Image : Laurent Emmanuel / AFP"></a>
        <img data-original="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/06/thumb_5352_media_image_640x404.jpg"  alt="" title="Jeff Nichols - Loving" class="lazy">
        <div class="picto"><i class="icon icon_photo"></i></div>
        <div class="info">
          <div class="vCenter">
            <div class="vCenterKid">
              <span class="category">Conférence de Presse</span>
              <span class="date">16.05.16</span> . <span
                  class="hour">11:10</span>
              <p data-title="Jeff Nichols - Loving">Jeff Nichols - Loving</p>
            </div>
          </div>
        </div>
      </div>
      <div class="item conference-de-presse 16-05-16 shadow-bottom photo paysage notloaded">
        <a id="photo1115" class="ajax chocolat-image" data-pid="1115"
           href="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/06/22561fa42dfc55d20bb9f4de366884b8abfa2e20.jpg"
           title='<span class="category">Conférence de Presse</span><span class="date">16.05.16 . 11:00</span><h2>Joel Edgerton - Loving</h2>'
           data-credit="Crédit Image : Mathilde Petit / FDC"></a>
        <img data-original="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/06/thumb_5335_media_image_640x404.jpg"  alt="" title="Joel Edgerton - Loving" class="lazy">
        <div class="picto"><i class="icon icon_photo"></i></div>
        <div class="info">
          <div class="vCenter">
            <div class="vCenterKid">
              <span class="category">Conférence de Presse</span>
              <span class="date">16.05.16</span> . <span
                  class="hour">11:00</span>
              <p data-title="Joel Edgerton - Loving">Joel Edgerton - Loving</p>
            </div>
          </div>
        </div>
      </div>
      <div class="item sur-scene 16-05-16 shadow-bottom photo paysage notloaded">
        <a id="photo1110" class="ajax chocolat-image" data-pid="1110"
           href="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/06/b2a5e33001bdaf8c2b561fbcd73885eeb46963c8.jpg"
           title='<span class="category">Sur Scène</span><span class="date">16.05.16 . 10:53</span><h2>Thierry Frémaux et l&#039;équipe du film - Chouf</h2>'
           data-credit="Crédit Image : Mathilde Petit / FDC"></a>
        <img data-original="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/06/thumb_5330_media_image_640x404.jpg"  alt="" title="Thierry Frémaux et l&#039;équipe du film - Chouf" class="lazy">
        <div class="picto"><i class="icon icon_photo"></i></div>
        <div class="info">
          <div class="vCenter">
            <div class="vCenterKid">
              <span class="category">Sur Scène</span>
              <span class="date">16.05.16</span> . <span
                  class="hour">10:53</span>
              <p data-title="Thierry Frémaux et l&#039;équipe du film - Chouf">Thierry Frémaux et l&#039;équipe du film - Chouf</p>
            </div>
          </div>
        </div>
      </div>
      <div class="item sur-scene 16-05-16 shadow-bottom photo paysage notloaded">
        <a id="photo1109" class="ajax chocolat-image" data-pid="1109"
           href="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/06/30b54b86b1fda952ad9e47fe3f3a6b8d4e5f5b51.jpg"
           title='<span class="category">Sur Scène</span><span class="date">16.05.16 . 10:50</span><h2>Zine Darar et Oussama Abdul Aal - Chouf</h2>'
           data-credit="Crédit Image : Mathilde Petit / FDC"></a>
        <img data-original="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/06/thumb_5329_media_image_640x404.jpg"  alt="" title="Zine Darar et Oussama Abdul Aal - Chouf" class="lazy">
        <div class="picto"><i class="icon icon_photo"></i></div>
        <div class="info">
          <div class="vCenter">
            <div class="vCenterKid">
              <span class="category">Sur Scène</span>
              <span class="date">16.05.16</span> . <span
                  class="hour">10:50</span>
              <p data-title="Zine Darar et Oussama Abdul Aal - Chouf">Zine Darar et Oussama Abdul Aal - Chouf</p>
            </div>
          </div>
        </div>
      </div>
      <div class="item photocall 16-05-16 shadow-bottom photo paysage notloaded">
        <a id="photo1108" class="ajax chocolat-image" data-pid="1108"
           href="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/06/4cb89fe6a0394ed57f438b375af41e18f624eed5.jpg"
           title='<span class="category">Photocall</span><span class="date">16.05.16 . 10:42</span><h2>Sofian Khammes, Karim Dridi et Nailia Harzoune - Chouf</h2>'
           data-credit="Crédit Image : Cyril Duchêne / FDC"></a>
        <img data-original="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/06/thumb_5328_media_image_640x404.jpg"  alt="" title="Sofian Khammes, Karim Dridi et Nailia Harzoune - Chouf" class="lazy">
        <div class="picto"><i class="icon icon_photo"></i></div>
        <div class="info">
          <div class="vCenter">
            <div class="vCenterKid">
              <span class="category">Photocall</span>
              <span class="date">16.05.16</span> . <span
                  class="hour">10:42</span>
              <p data-title="Sofian Khammes, Karim Dridi et Nailia Harzoune - Chouf">Sofian Khammes, Karim Dridi et Nailia Harzoune - Chouf</p>
            </div>
          </div>
        </div>
      </div>
      <div class="item photocall 16-05-16 shadow-bottom photo paysage notloaded">
        <a id="photo1107" class="ajax chocolat-image" data-pid="1107"
           href="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/06/b3ed5cef8d0fbe6ec1ce6727b806f2c78e5193d7.jpg"
           title='<span class="category">Photocall</span><span class="date">16.05.16 . 10:40</span><h2>Équipe du film - Chouf</h2>'
           data-credit="Crédit Image : Cyril Duchêne / FDC"></a>
        <img data-original="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/06/thumb_5327_media_image_640x404.jpg"  alt="" title="Équipe du film - Chouf" class="lazy">
        <div class="picto"><i class="icon icon_photo"></i></div>
        <div class="info">
          <div class="vCenter">
            <div class="vCenterKid">
              <span class="category">Photocall</span>
              <span class="date">16.05.16</span> . <span
                  class="hour">10:40</span>
              <p data-title="Équipe du film - Chouf">Équipe du film - Chouf</p>
            </div>
          </div>
        </div>
      </div>
      <div class="item photocall 16-05-16 shadow-bottom photo paysage notloaded">
        <a id="photo1105" class="ajax chocolat-image" data-pid="1105"
           href="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/06/401e6a0fc3a13d80ff1f4c08281854c06278d958.jpg"
           title='<span class="category">Photocall</span><span class="date">16.05.16 . 10:35</span><h2>Boo Junfeng - Apprentice</h2>'
           data-credit="Crédit Image : Cyril Duchêne / FDC"></a>
        <img data-original="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/06/thumb_5325_media_image_640x404.jpg"  alt="" title="Boo Junfeng - Apprentice" class="lazy">
        <div class="picto"><i class="icon icon_photo"></i></div>
        <div class="info">
          <div class="vCenter">
            <div class="vCenterKid">
              <span class="category">Photocall</span>
              <span class="date">16.05.16</span> . <span
                  class="hour">10:35</span>
              <p data-title="Boo Junfeng - Apprentice">Boo Junfeng - Apprentice</p>
            </div>
          </div>
        </div>
      </div>
      <div class="item photocall 16-05-16 shadow-bottom photo paysage notloaded">
        <a id="photo1104" class="ajax chocolat-image" data-pid="1104"
           href="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/06/5e07c612da2c9dbc98f9771b53becf3302750645.jpg"
           title='<span class="category">Photocall</span><span class="date">16.05.16 . 10:32</span><h2>Équipe du film - Apprentice</h2>'
           data-credit="Crédit Image : Dominique Charriau / Getty Images"></a>
        <img data-original="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/06/thumb_5349_media_image_640x404.jpg"  alt="" title="Équipe du film - Apprentice" class="lazy">
        <div class="picto"><i class="icon icon_photo"></i></div>
        <div class="info">
          <div class="vCenter">
            <div class="vCenterKid">
              <span class="category">Photocall</span>
              <span class="date">16.05.16</span> . <span
                  class="hour">10:32</span>
              <p data-title="Équipe du film - Apprentice">Équipe du film - Apprentice</p>
            </div>
          </div>
        </div>
      </div>
      <div class="item photocall 16-05-16 shadow-bottom photo paysage notloaded">
        <a id="photo1103" class="ajax chocolat-image" data-pid="1103"
           href="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/06/dfd5c8a2a3bb283298642dfd4e6ae8ec665af792.jpg"
           title='<span class="category">Photocall</span><span class="date">16.05.16 . 10:30</span><h2>Su Wan Hanafi - Apprentice</h2>'
           data-credit="Crédit Image : Cyril Duchêne / FDC"></a>
        <img data-original="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/06/thumb_5323_media_image_640x404.jpg"  alt="" title="Su Wan Hanafi - Apprentice" class="lazy">
        <div class="picto"><i class="icon icon_photo"></i></div>
        <div class="info">
          <div class="vCenter">
            <div class="vCenterKid">
              <span class="category">Photocall</span>
              <span class="date">16.05.16</span> . <span
                  class="hour">10:30</span>
              <p data-title="Su Wan Hanafi - Apprentice">Su Wan Hanafi - Apprentice</p>
            </div>
          </div>
        </div>
      </div>
      <div class="item photocall 16-05-16 shadow-bottom photo paysage notloaded">
        <a id="photo1100" class="ajax chocolat-image" data-pid="1100"
           href="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/06/fdb00a0456c381ea8bbddd62cb03811f27ead5f8.jpg"
           title='<span class="category">Photocall</span><span class="date">16.05.16 . 10:27</span><h2>Ruth Negga - Loving</h2>'
           data-credit="Crédit Image : Cyril Duchêne / FDC"></a>
        <img data-original="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/06/thumb_5321_media_image_640x404.jpg"  alt="" title="Ruth Negga - Loving" class="lazy">
        <div class="picto"><i class="icon icon_photo"></i></div>
        <div class="info">
          <div class="vCenter">
            <div class="vCenterKid">
              <span class="category">Photocall</span>
              <span class="date">16.05.16</span> . <span
                  class="hour">10:27</span>
              <p data-title="Ruth Negga - Loving">Ruth Negga - Loving</p>
            </div>
          </div>
        </div>
      </div>
      <div class="item photocall 16-05-16 shadow-bottom photo paysage notloaded">
        <a id="photo1099" class="ajax chocolat-image" data-pid="1099"
           href="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/06/8c8eec724b17ffa357d029feb1c1fc20903be530.jpg"
           title='<span class="category">Photocall</span><span class="date">16.05.16 . 10:25</span><h2>Ruth Negga et Joel Edgerton - Loving</h2>'
           data-credit="Crédit Image : Cyril Duchêne / FDC"></a>
        <img data-original="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/06/thumb_5320_media_image_640x404.jpg"  alt="" title="Ruth Negga et Joel Edgerton - Loving" class="lazy">
        <div class="picto"><i class="icon icon_photo"></i></div>
        <div class="info">
          <div class="vCenter">
            <div class="vCenterKid">
              <span class="category">Photocall</span>
              <span class="date">16.05.16</span> . <span
                  class="hour">10:25</span>
              <p data-title="Ruth Negga et Joel Edgerton - Loving">Ruth Negga et Joel Edgerton - Loving</p>
            </div>
          </div>
        </div>
      </div>
      <div class="item photocall 16-05-16 shadow-bottom photo paysage notloaded">
        <a id="photo1098" class="ajax chocolat-image" data-pid="1098"
           href="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/06/f88f0c37ab4f9775225f5f67033f6363ae374350.jpg"
           title='<span class="category">Photocall</span><span class="date">16.05.16 . 10:20</span><h2>Joel Edgerton, Ruth Negga et Jeff Nichols - Loving</h2>'
           data-credit="Crédit Image : Thomas Leibreich / FDC"></a>
        <img data-original="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/06/thumb_5334_media_image_640x404.jpg"  alt="" title="Joel Edgerton, Ruth Negga et Jeff Nichols - Loving" class="lazy">
        <div class="picto"><i class="icon icon_photo"></i></div>
        <div class="info">
          <div class="vCenter">
            <div class="vCenterKid">
              <span class="category">Photocall</span>
              <span class="date">16.05.16</span> . <span
                  class="hour">10:20</span>
              <p data-title="Joel Edgerton, Ruth Negga et Jeff Nichols - Loving">Joel Edgerton, Ruth Negga et Jeff Nichols - Loving</p>
            </div>
          </div>
        </div>
      </div>
      <div class="item oeil-du-photographe 16-05-16 shadow-bottom photo portrait notloaded">
        <a id="photo1067" class="ajax chocolat-image" data-pid="1067"
           href="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/06/5e2ab29488bcb68c146a7594c0232ebc5c67ea31.jpg"
           title='<span class="category">Œil du photographe</span><span class="date">16.05.16 . 09:00</span><h2>Jean-Luc Vincent</h2>'
           data-credit="Crédit Image : Laurent Koffel"></a>
        <img data-original="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/06/thumb_5283_media_image_320x404.jpg"  alt="" title="Jean-Luc Vincent" class="lazy">
        <div class="picto"><i class="icon icon_photo"></i></div>
        <div class="info">
          <div class="vCenter">
            <div class="vCenterKid">
              <span class="category">Œil du photographe</span>
              <span class="date">16.05.16</span> . <span
                  class="hour">09:00</span>
              <p data-title="Jean-Luc Vincent">Jean-Luc Vincent</p>
            </div>
          </div>
        </div>
      </div>
      <div class="item oeil-du-photographe 16-05-16 shadow-bottom photo portrait notloaded">
        <a id="photo1063" class="ajax chocolat-image" data-pid="1063"
           href="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/06/046d2ce68371adcf62d2e55fb428db8d2feacfb6.jpg"
           title='<span class="category">Œil du photographe</span><span class="date">16.05.16 . 08:54</span><h2>Yeon Sang-Ho</h2>'
           data-credit="Crédit Image : Laurent Koffel"></a>
        <img data-original="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/06/thumb_5276_media_image_320x404.jpg"  alt="" title="Yeon Sang-Ho" class="lazy">
        <div class="picto"><i class="icon icon_photo"></i></div>
        <div class="info">
          <div class="vCenter">
            <div class="vCenterKid">
              <span class="category">Œil du photographe</span>
              <span class="date">16.05.16</span> . <span
                  class="hour">08:54</span>
              <p data-title="Yeon Sang-Ho">Yeon Sang-Ho</p>
            </div>
          </div>
        </div>
      </div>
      <div class="item oeil-du-photographe 16-05-16 shadow-bottom photo paysage notloaded">
        <a id="photo1064" class="ajax chocolat-image" data-pid="1064"
           href="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/06/84fc6ed5b363ed57a061c83a8b9c77ff98061c3f.jpg"
           title='<span class="category">Œil du photographe</span><span class="date">16.05.16 . 08:54</span><h2>Yeon Sang-Ho</h2>'
           data-credit="Crédit Image : Laurent Koffel"></a>
        <img data-original="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/06/thumb_5278_media_image_640x404.jpg"  alt="" title="Yeon Sang-Ho" class="lazy">
        <div class="picto"><i class="icon icon_photo"></i></div>
        <div class="info">
          <div class="vCenter">
            <div class="vCenterKid">
              <span class="category">Œil du photographe</span>
              <span class="date">16.05.16</span> . <span
                  class="hour">08:54</span>
              <p data-title="Yeon Sang-Ho">Yeon Sang-Ho</p>
            </div>
          </div>
        </div>
      </div>
      <div class="item oeil-du-photographe 16-05-16 shadow-bottom photo portrait notloaded">
        <a id="photo1065" class="ajax chocolat-image" data-pid="1065"
           href="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/06/7560a96e6eba6e3d0954a31510b5d3efd301551d.jpg"
           title='<span class="category">Œil du photographe</span><span class="date">16.05.16 . 08:54</span><h2>Kim Su-An</h2>'
           data-credit="Crédit Image : Laurent Koffel"></a>
        <img data-original="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/06/thumb_5279_media_image_320x404.jpg"  alt="" title="Kim Su-An" class="lazy">
        <div class="picto"><i class="icon icon_photo"></i></div>
        <div class="info">
          <div class="vCenter">
            <div class="vCenterKid">
              <span class="category">Œil du photographe</span>
              <span class="date">16.05.16</span> . <span
                  class="hour">08:54</span>
              <p data-title="Kim Su-An">Kim Su-An</p>
            </div>
          </div>
        </div>
      </div>
      <div class="item oeil-du-photographe 16-05-16 shadow-bottom photo portrait notloaded">
        <a id="photo1066" class="ajax chocolat-image" data-pid="1066"
           href="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/06/88d0a6ad296ab42e89b8feafecc385e9611673fd.jpg"
           title='<span class="category">Œil du photographe</span><span class="date">16.05.16 . 08:54</span><h2>Jung Yu-Mi</h2>'
           data-credit="Crédit Image : Laurent Koffel"></a>
        <img data-original="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/06/thumb_5281_media_image_320x404.jpg"  alt="" title="Jung Yu-Mi" class="lazy">
        <div class="picto"><i class="icon icon_photo"></i></div>
        <div class="info">
          <div class="vCenter">
            <div class="vCenterKid">
              <span class="category">Œil du photographe</span>
              <span class="date">16.05.16</span> . <span
                  class="hour">08:54</span>
              <p data-title="Jung Yu-Mi">Jung Yu-Mi</p>
            </div>
          </div>
        </div>
      </div>
      <div class="item montee-des-marches 15-05-16 shadow-bottom photo paysage notloaded">
        <a id="photo1091" class="ajax chocolat-image" data-pid="1091"
           href="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/06/f4fbc70ebf2f0befca04060c5edf495d2e60340a.jpg"
           title='<span class="category">Montée des Marches</span><span class="date">15.05.16 . 22:49</span><h2>Ryan Gosling, Matt Bomer, Angourie Rice et Russel Crowe - The Nice Guys</h2>'
           data-credit="Crédit Image : Anne-Christine Poujoulat / AFP"></a>
        <img data-original="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/06/thumb_5315_media_image_640x404.jpg"  alt="" title="Ryan Gosling, Matt Bomer, Angourie Rice et Russel Crowe - The Nice Guys" class="lazy">
        <div class="picto"><i class="icon icon_photo"></i></div>
        <div class="info">
          <div class="vCenter">
            <div class="vCenterKid">
              <span class="category">Montée des Marches</span>
              <span class="date">15.05.16</span> . <span
                  class="hour">22:49</span>
              <p data-title="Ryan Gosling, Matt Bomer, Angourie Rice et Russel Crowe - The Nice Guys">Ryan Gosling, Matt Bomer, Angourie Rice et Russel Crowe - The Nice Guys</p>
            </div>
          </div>
        </div>
      </div>
      <div class="item sur-scene 15-05-16 shadow-bottom photo paysage notloaded">
        <a id="photo1080" class="ajax chocolat-image" data-pid="1080"
           href="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/06/694fd3922ee36ae0ebbfb48dd7913e4fd72d990e.JPG"
           title='<span class="category">Sur Scène</span><span class="date">15.05.16 . 22:25</span><h2>Karoly Makk et Gérald Duchaussoy - Szerelem (Amour)</h2>'
           data-credit="Crédit Image : Léo Laumont / FDC"></a>
        <img data-original="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/06/thumb_5303_media_image_640x404.JPG"  alt="" title="Karoly Makk et Gérald Duchaussoy - Szerelem (Amour)" class="lazy">
        <div class="picto"><i class="icon icon_photo"></i></div>
        <div class="info">
          <div class="vCenter">
            <div class="vCenterKid">
              <span class="category">Sur Scène</span>
              <span class="date">15.05.16</span> . <span
                  class="hour">22:25</span>
              <p data-title="Karoly Makk et Gérald Duchaussoy - Szerelem (Amour)">Karoly Makk et Gérald Duchaussoy - Szerelem (Amour)</p>
            </div>
          </div>
        </div>
      </div>
      <div class="item sur-scene 15-05-16 shadow-bottom photo paysage notloaded">
        <a id="photo1077" class="ajax chocolat-image" data-pid="1077"
           href="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/06/07232bf444d34cd989944259a1c6e88c4744409a.JPG"
           title='<span class="category">Sur Scène</span><span class="date">15.05.16 . 22:20</span><h2>Équipe du film - Me&#039;ever laharim vehagvot (Beyond the Mountains and Hills)</h2>'
           data-credit="Crédit Image : Mathilde Petit / FDC"></a>
        <img data-original="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/06/thumb_5301_media_image_640x404.JPG"  alt="" title="Équipe du film - Me&#039;ever laharim vehagvot (Beyond the Mountains and Hills)" class="lazy">
        <div class="picto"><i class="icon icon_photo"></i></div>
        <div class="info">
          <div class="vCenter">
            <div class="vCenterKid">
              <span class="category">Sur Scène</span>
              <span class="date">15.05.16</span> . <span
                  class="hour">22:20</span>
              <p data-title="Équipe du film - Me&#039;ever laharim vehagvot (Beyond the Mountains and Hills)">Équipe du film - Me&#039;ever laharim vehagvot (Beyond the Mountains and Hills)</p>
            </div>
          </div>
        </div>
      </div>
      <div class="item montee-des-marches 15-05-16 shadow-bottom photo portrait notloaded">
        <a id="photo1075" class="ajax chocolat-image" data-pid="1075"
           href="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/06/3925ee5ea760d29b1ce97384a58c3c4a3389a32b.jpg"
           title='<span class="category">Montée des Marches</span><span class="date">15.05.16 . 22:10</span><h2>Matt Bomer - The Nice Guys</h2>'
           data-credit="Crédit Image : Antonio de Moraes Barros Filho / Getty Images"></a>
        <img data-original="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/06/thumb_5300_media_image_320x404.jpg"  alt="" title="Matt Bomer - The Nice Guys" class="lazy">
        <div class="picto"><i class="icon icon_photo"></i></div>
        <div class="info">
          <div class="vCenter">
            <div class="vCenterKid">
              <span class="category">Montée des Marches</span>
              <span class="date">15.05.16</span> . <span
                  class="hour">22:10</span>
              <p data-title="Matt Bomer - The Nice Guys">Matt Bomer - The Nice Guys</p>
            </div>
          </div>
        </div>
      </div>
      <div class="item montee-des-marches 15-05-16 shadow-bottom photo paysage notloaded">
        <a id="photo1074" class="ajax chocolat-image" data-pid="1074"
           href="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/06/a2b3cf83473eb12c83b6988b131b1e22020ee572.jpg"
           title='<span class="category">Montée des Marches</span><span class="date">15.05.16 . 22:03</span><h2>Équipe du film - The Nice Guys</h2>'
           data-credit="Crédit Image : Valéry Hache / AFP"></a>
        <img data-original="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/06/thumb_5299_media_image_640x404.jpg"  alt="" title="Équipe du film - The Nice Guys" class="lazy">
        <div class="picto"><i class="icon icon_photo"></i></div>
        <div class="info">
          <div class="vCenter">
            <div class="vCenterKid">
              <span class="category">Montée des Marches</span>
              <span class="date">15.05.16</span> . <span
                  class="hour">22:03</span>
              <p data-title="Équipe du film - The Nice Guys">Équipe du film - The Nice Guys</p>
            </div>
          </div>
        </div>
      </div>
      <div class="item montee-des-marches 15-05-16 shadow-bottom photo portrait notloaded">
        <a id="photo1071" class="ajax chocolat-image" data-pid="1071"
           href="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/06/269796cdc46134a14cac886770b0e5e35eb51ca2.jpg"
           title='<span class="category">Montée des Marches</span><span class="date">15.05.16 . 22:00</span><h2>Ryan Gosling - The Nice Guys</h2>'
           data-credit="Crédit Image : Dominique Charriau / Getty Images"></a>
        <img data-original="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/06/thumb_5296_media_image_320x404.jpg"  alt="" title="Ryan Gosling - The Nice Guys" class="lazy">
        <div class="picto"><i class="icon icon_photo"></i></div>
        <div class="info">
          <div class="vCenter">
            <div class="vCenterKid">
              <span class="category">Montée des Marches</span>
              <span class="date">15.05.16</span> . <span
                  class="hour">22:00</span>
              <p data-title="Ryan Gosling - The Nice Guys">Ryan Gosling - The Nice Guys</p>
            </div>
          </div>
        </div>
      </div>
      <div class="item sur-scene 15-05-16 shadow-bottom photo paysage notloaded">
        <a id="photo1070" class="ajax chocolat-image" data-pid="1070"
           href="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/06/e882b5a5c331f1c9bc800f066505bd976c70cac2.jpg"
           title='<span class="category">Sur Scène</span><span class="date">15.05.16 . 20:30</span><h2>Raymond Depardon et Thierry Frémaux - Faits divers</h2>'
           data-credit="Crédit Image : Thomas Leibreich / FDC"></a>
        <img data-original="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/06/thumb_5290_media_image_640x404.jpg"  alt="" title="Raymond Depardon et Thierry Frémaux - Faits divers" class="lazy">
        <div class="picto"><i class="icon icon_photo"></i></div>
        <div class="info">
          <div class="vCenter">
            <div class="vCenterKid">
              <span class="category">Sur Scène</span>
              <span class="date">15.05.16</span> . <span
                  class="hour">20:30</span>
              <p data-title="Raymond Depardon et Thierry Frémaux - Faits divers">Raymond Depardon et Thierry Frémaux - Faits divers</p>
            </div>
          </div>
        </div>
      </div>
      <div class="item montee-des-marches 15-05-16 shadow-bottom photo paysage notloaded">
        <a id="photo1062" class="ajax chocolat-image" data-pid="1062"
           href="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/06/0043e24be61c0494bfb0286a2588db1ec4ebb79c.jpg"
           title='<span class="category">Montée des Marches</span><span class="date">15.05.16 . 19:20</span><h2>Raymond Depardon</h2>'
           data-credit="Crédit Image : Valéry Hache / AFP"></a>
        <img data-original="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/06/thumb_5277_media_image_640x404.jpg"  alt="" title="Raymond Depardon" class="lazy">
        <div class="picto"><i class="icon icon_photo"></i></div>
        <div class="info">
          <div class="vCenter">
            <div class="vCenterKid">
              <span class="category">Montée des Marches</span>
              <span class="date">15.05.16</span> . <span
                  class="hour">19:20</span>
              <p data-title="Raymond Depardon">Raymond Depardon</p>
            </div>
          </div>
        </div>
      </div>
      <div class="item montee-des-marches 15-05-16 shadow-bottom photo paysage notloaded">
        <a id="photo1059" class="ajax chocolat-image" data-pid="1059"
           href="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/06/764df9bf6f41cd1662d26d77159163aee048ec49.jpg"
           title='<span class="category">Montée des Marches</span><span class="date">15.05.16 . 19:10</span><h2>Marion Cotillard et Louis Garell - Mal de pierres</h2>'
           data-credit="Crédit Image : Alberto Pizzoli / AFP"></a>
        <img data-original="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/06/thumb_5272_media_image_640x404.jpg"  alt="" title="Marion Cotillard et Louis Garell - Mal de pierres" class="lazy">
        <div class="picto"><i class="icon icon_photo"></i></div>
        <div class="info">
          <div class="vCenter">
            <div class="vCenterKid">
              <span class="category">Montée des Marches</span>
              <span class="date">15.05.16</span> . <span
                  class="hour">19:10</span>
              <p data-title="Marion Cotillard et Louis Garell - Mal de pierres">Marion Cotillard et Louis Garell - Mal de pierres</p>
            </div>
          </div>
        </div>
      </div>
      <div class="item montee-des-marches 15-05-16 shadow-bottom photo paysage notloaded">
        <a id="photo1057" class="ajax chocolat-image" data-pid="1057"
           href="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/06/48fcc4081519e7254490fd79d275b4b8322641aa.jpg"
           title='<span class="category">Montée des Marches</span><span class="date">15.05.16 . 19:05</span><h2>Marion Cotillard - Mal de pierres</h2>'
           data-credit="Crédit Image : Mike Marsland / Getty Images"></a>
        <img data-original="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/06/thumb_5273_media_image_640x404.jpg"  alt="" title="Marion Cotillard - Mal de pierres" class="lazy">
        <div class="picto"><i class="icon icon_photo"></i></div>
        <div class="info">
          <div class="vCenter">
            <div class="vCenterKid">
              <span class="category">Montée des Marches</span>
              <span class="date">15.05.16</span> . <span
                  class="hour">19:05</span>
              <p data-title="Marion Cotillard - Mal de pierres">Marion Cotillard - Mal de pierres</p>
            </div>
          </div>
        </div>
      </div>
      <div class="item montee-des-marches 15-05-16 shadow-bottom photo paysage notloaded">
        <a id="photo1056" class="ajax chocolat-image" data-pid="1056"
           href="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/06/5cf94420b33a43b913fe6d663e15b022de1a09cf.jpg"
           title='<span class="category">Montée des Marches</span><span class="date">15.05.16 . 19:00</span><h2>Nicole Garcia Alex Brendemuhl, Marion Cotillard et Louis Garell - Mal de pierres</h2>'
           data-credit="Crédit Image : Venturelli / Getty Images"></a>
        <img data-original="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/06/thumb_5271_media_image_640x404.jpg"  alt="" title="Nicole Garcia Alex Brendemuhl, Marion Cotillard et Louis Garell - Mal de pierres" class="lazy">
        <div class="picto"><i class="icon icon_photo"></i></div>
        <div class="info">
          <div class="vCenter">
            <div class="vCenterKid">
              <span class="category">Montée des Marches</span>
              <span class="date">15.05.16</span> . <span
                  class="hour">19:00</span>
              <p data-title="Nicole Garcia Alex Brendemuhl, Marion Cotillard et Louis Garell - Mal de pierres">Nicole Garcia Alex Brendemuhl, Marion Cotillard et Louis Garell - Mal de pierres</p>
            </div>
          </div>
        </div>
      </div>
      <div class="item montee-des-marches 15-05-16 shadow-bottom photo portrait notloaded">
        <a id="photo1054" class="ajax chocolat-image" data-pid="1054"
           href="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/06/4a853299e0fef3de060b1ec541782427d4d02c7d.jpg"
           title='<span class="category">Montée des Marches</span><span class="date">15.05.16 . 18:45</span><h2>Heike Makatsch</h2>'
           data-credit="Crédit Image : Venturelli / Getty Images"></a>
        <img data-original="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/06/thumb_5267_media_image_320x404.jpg"  alt="" title="Heike Makatsch" class="lazy">
        <div class="picto"><i class="icon icon_photo"></i></div>
        <div class="info">
          <div class="vCenter">
            <div class="vCenterKid">
              <span class="category">Montée des Marches</span>
              <span class="date">15.05.16</span> . <span
                  class="hour">18:45</span>
              <p data-title="Heike Makatsch">Heike Makatsch</p>
            </div>
          </div>
        </div>
      </div>
      <div class="item sur-scene 15-05-16 shadow-bottom photo paysage notloaded">
        <a id="photo1052" class="ajax chocolat-image" data-pid="1052"
           href="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/06/e0d7c691fa10bcdf4afde778f60da46d644fa06e.jpg"
           title='<span class="category">Sur Scène</span><span class="date">15.05.16 . 17:20</span><h2>Jean Becker et Thierry Frémaux - Rendez-vous de juillet</h2>'
           data-credit="Crédit Image : Cyril Duchêne / FDC"></a>
        <img data-original="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/06/thumb_5262_media_image_640x404.jpg"  alt="" title="Jean Becker et Thierry Frémaux - Rendez-vous de juillet" class="lazy">
        <div class="picto"><i class="icon icon_photo"></i></div>
        <div class="info">
          <div class="vCenter">
            <div class="vCenterKid">
              <span class="category">Sur Scène</span>
              <span class="date">15.05.16</span> . <span
                  class="hour">17:20</span>
              <p data-title="Jean Becker et Thierry Frémaux - Rendez-vous de juillet">Jean Becker et Thierry Frémaux - Rendez-vous de juillet</p>
            </div>
          </div>
        </div>
      </div>
      <div class="item montee-des-marches 15-05-16 shadow-bottom photo paysage notloaded">
        <a id="photo1043" class="ajax chocolat-image" data-pid="1043"
           href="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/06/d3dc03ba1d541ddcbbe89062335893a50239383c.jpg"
           title='<span class="category">Montée des Marches</span><span class="date">15.05.16 . 15:35</span><h2>Équipe du film - American Honey</h2>'
           data-credit="Crédit Image : Pascal Le Segretain / Getty Images"></a>
        <img data-original="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/06/thumb_5253_media_image_640x404.jpg"  alt="" title="Équipe du film - American Honey" class="lazy">
        <div class="picto"><i class="icon icon_photo"></i></div>
        <div class="info">
          <div class="vCenter">
            <div class="vCenterKid">
              <span class="category">Montée des Marches</span>
              <span class="date">15.05.16</span> . <span
                  class="hour">15:35</span>
              <p data-title="Équipe du film - American Honey">Équipe du film - American Honey</p>
            </div>
          </div>
        </div>
      </div>
      <div class="item montee-des-marches 15-05-16 shadow-bottom photo portrait notloaded">
        <a id="photo1041" class="ajax chocolat-image" data-pid="1041"
           href="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/06/eb85add83b7ca2ba4d777969ce5e867086f9c5d6.jpg"
           title='<span class="category">Montée des Marches</span><span class="date">15.05.16 . 15:30</span><h2>Riley Keough - American Honey</h2>'
           data-credit="Crédit Image : Pascal Le Segretain / Getty Images"></a>
        <img data-original="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/06/thumb_5264_media_image_320x404.jpg"  alt="" title="Riley Keough - American Honey" class="lazy">
        <div class="picto"><i class="icon icon_photo"></i></div>
        <div class="info">
          <div class="vCenter">
            <div class="vCenterKid">
              <span class="category">Montée des Marches</span>
              <span class="date">15.05.16</span> . <span
                  class="hour">15:30</span>
              <p data-title="Riley Keough - American Honey">Riley Keough - American Honey</p>
            </div>
          </div>
        </div>
      </div>
      <div class="item montee-des-marches 15-05-16 shadow-bottom photo paysage notloaded">
        <a id="photo1037" class="ajax chocolat-image" data-pid="1037"
           href="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/06/b4caaaf70df55bdf1d31c73272ddb0b98f3bb818.jpg"
           title='<span class="category">Montée des Marches</span><span class="date">15.05.16 . 15:23</span><h2>Shia Labeouf - American Honey</h2>'
           data-credit="Crédit Image : Pascal Le Segretain / Getty Images"></a>
        <img data-original="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/06/thumb_5247_media_image_640x404.jpg"  alt="" title="Shia Labeouf - American Honey" class="lazy">
        <div class="picto"><i class="icon icon_photo"></i></div>
        <div class="info">
          <div class="vCenter">
            <div class="vCenterKid">
              <span class="category">Montée des Marches</span>
              <span class="date">15.05.16</span> . <span
                  class="hour">15:23</span>
              <p data-title="Shia Labeouf - American Honey">Shia Labeouf - American Honey</p>
            </div>
          </div>
        </div>
      </div>
      <div class="item sur-scene 15-05-16 shadow-bottom photo portrait notloaded">
        <a id="photo1033" class="ajax chocolat-image" data-pid="1033"
           href="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/06/7242524ed4eb6372f5e3cc515c1f1aa74614a0ff.jpg"
           title='<span class="category">Sur Scène</span><span class="date">15.05.16 . 15:20</span><h2>Shirley ABRAHAM - Les cinémas voyageurs</h2>'
           data-credit="Crédit Image : Mathilde Petit / FDC"></a>
        <img data-original="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/06/thumb_5248_media_image_320x404.jpg"  alt="" title="Shirley ABRAHAM - Les cinémas voyageurs" class="lazy">
        <div class="picto"><i class="icon icon_photo"></i></div>
        <div class="info">
          <div class="vCenter">
            <div class="vCenterKid">
              <span class="category">Sur Scène</span>
              <span class="date">15.05.16</span> . <span
                  class="hour">15:20</span>
              <p data-title="Shirley ABRAHAM - Les cinémas voyageurs">Shirley ABRAHAM - Les cinémas voyageurs</p>
            </div>
          </div>
        </div>
      </div>
      <div class="item sur-scene 15-05-16 shadow-bottom photo paysage notloaded">
        <a id="photo1031" class="ajax chocolat-image" data-pid="1031"
           href="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/06/1064c21ee7f41287f812ca9b34efee8a5b91af2f.JPG"
           title='<span class="category">Sur Scène</span><span class="date">15.05.16 . 15:15</span><h2>Amit MADHESHIYA et Shirley ABRAHAM - Les cinémas voyageurs</h2>'
           data-credit="Crédit Image : Mathilde Petit / FDC"></a>
        <img data-original="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/06/thumb_5242_media_image_640x404.JPG"  alt="" title="Amit MADHESHIYA et Shirley ABRAHAM - Les cinémas voyageurs" class="lazy">
        <div class="picto"><i class="icon icon_photo"></i></div>
        <div class="info">
          <div class="vCenter">
            <div class="vCenterKid">
              <span class="category">Sur Scène</span>
              <span class="date">15.05.16</span> . <span
                  class="hour">15:15</span>
              <p data-title="Amit MADHESHIYA et Shirley ABRAHAM - Les cinémas voyageurs">Amit MADHESHIYA et Shirley ABRAHAM - Les cinémas voyageurs</p>
            </div>
          </div>
        </div>
      </div>
      <div class="item photocall 15-05-16 shadow-bottom photo paysage notloaded">
        <a id="photo1148" class="ajax chocolat-image" data-pid="1148"
           href="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/06/2cdca76f81ded4168acd8cef9af227d7197adc65.jpg"
           title='<span class="category">Photocall</span><span class="date">15.05.16 . 15:05</span><h2>Les réalisateurs de l&#039;Atelier 2016 de la Cinéfondation</h2>'
           data-credit="Crédit Image : Thomas Leibreich / FDC"></a>
        <img data-original="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/06/thumb_5367_media_image_640x404.jpg"  alt="" title="Les réalisateurs de l&#039;Atelier 2016 de la Cinéfondation" class="lazy">
        <div class="picto"><i class="icon icon_photo"></i></div>
        <div class="info">
          <div class="vCenter">
            <div class="vCenterKid">
              <span class="category">Photocall</span>
              <span class="date">15.05.16</span> . <span
                  class="hour">15:05</span>
              <p data-title="Les réalisateurs de l&#039;Atelier 2016 de la Cinéfondation">Les réalisateurs de l&#039;Atelier 2016 de la Cinéfondation</p>
            </div>
          </div>
        </div>
      </div>
      <div class="item montee-des-marches 15-05-16 shadow-bottom photo paysage notloaded">
        <a id="photo1147" class="ajax chocolat-image" data-pid="1147"
           href="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/06/a7afa720b5d57379172caa23c127859c688a2b1f.jpg"
           title='<span class="category">Montée des Marches</span><span class="date">15.05.16 . 15:00</span><h2>La résidence de la Cinéfondation</h2>'
           data-credit="Crédit Image : Léo Laumont / FDC"></a>
        <img data-original="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/06/thumb_5366_media_image_640x404.jpg"  alt="" title="La résidence de la Cinéfondation" class="lazy">
        <div class="picto"><i class="icon icon_photo"></i></div>
        <div class="info">
          <div class="vCenter">
            <div class="vCenterKid">
              <span class="category">Montée des Marches</span>
              <span class="date">15.05.16</span> . <span
                  class="hour">15:00</span>
              <p data-title="La résidence de la Cinéfondation">La résidence de la Cinéfondation</p>
            </div>
          </div>
        </div>
      </div>
      <div class="item conference-de-presse 15-05-16 shadow-bottom photo paysage notloaded">
        <a id="photo1030" class="ajax chocolat-image" data-pid="1030"
           href="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/06/944f509d03c34d014a5105db01f06433e7fdff81.jpg"
           title='<span class="category">Conférence de Presse</span><span class="date">15.05.16 . 14:35</span><h2>Shane Black - The Nice Guys</h2>'
           data-credit="Crédit Image : Thomas Leibreich / FDC"></a>
        <img data-original="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/06/thumb_5241_media_image_640x404.jpg"  alt="" title="Shane Black - The Nice Guys" class="lazy">
        <div class="picto"><i class="icon icon_photo"></i></div>
        <div class="info">
          <div class="vCenter">
            <div class="vCenterKid">
              <span class="category">Conférence de Presse</span>
              <span class="date">15.05.16</span> . <span
                  class="hour">14:35</span>
              <p data-title="Shane Black - The Nice Guys">Shane Black - The Nice Guys</p>
            </div>
          </div>
        </div>
      </div>
      <div class="item photocall 15-05-16 shadow-bottom photo portrait notloaded">
        <a id="photo1029" class="ajax chocolat-image" data-pid="1029"
           href="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/06/35f6ab006a17571365d486e51fab8e00eb5b0aab.jpg"
           title='<span class="category">Photocall</span><span class="date">15.05.16 . 14:15</span><h2>Russel Crowe - The Nice Guys</h2>'
           data-credit="Crédit Image : Cyril Duchêne / FDC"></a>
        <img data-original="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/06/thumb_5240_media_image_320x404.jpg"  alt="" title="Russel Crowe - The Nice Guys" class="lazy">
        <div class="picto"><i class="icon icon_photo"></i></div>
        <div class="info">
          <div class="vCenter">
            <div class="vCenterKid">
              <span class="category">Photocall</span>
              <span class="date">15.05.16</span> . <span
                  class="hour">14:15</span>
              <p data-title="Russel Crowe - The Nice Guys">Russel Crowe - The Nice Guys</p>
            </div>
          </div>
        </div>
      </div>
      <div class="item photocall 15-05-16 shadow-bottom photo paysage notloaded">
        <a id="photo1028" class="ajax chocolat-image" data-pid="1028"
           href="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/06/af88b1b05755d2e2778b5cdc4a54e1aa8187c051.jpg"
           title='<span class="category">Photocall</span><span class="date">15.05.16 . 14:13</span><h2>Ryan Gosling et Russel Crowe - The Nice Guys</h2>'
           data-credit="Crédit Image : Thomas Leibreich / FDC"></a>
        <img data-original="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/06/thumb_5239_media_image_640x404.jpg"  alt="" title="Ryan Gosling et Russel Crowe - The Nice Guys" class="lazy">
        <div class="picto"><i class="icon icon_photo"></i></div>
        <div class="info">
          <div class="vCenter">
            <div class="vCenterKid">
              <span class="category">Photocall</span>
              <span class="date">15.05.16</span> . <span
                  class="hour">14:13</span>
              <p data-title="Ryan Gosling et Russel Crowe - The Nice Guys">Ryan Gosling et Russel Crowe - The Nice Guys</p>
            </div>
          </div>
        </div>
      </div>
      <div class="item photocall 15-05-16 shadow-bottom photo paysage notloaded">
        <a id="photo1027" class="ajax chocolat-image" data-pid="1027"
           href="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/06/7a58f376a1666115043d82c47a64536902d3fbb8.jpg"
           title='<span class="category">Photocall</span><span class="date">15.05.16 . 14:10</span><h2>Ryan Gosling - The Nice Guys</h2>'
           data-credit="Crédit Image : Thomas Leibreich / FDC"></a>
        <img data-original="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/06/thumb_5238_media_image_640x404.jpg"  alt="" title="Ryan Gosling - The Nice Guys" class="lazy">
        <div class="picto"><i class="icon icon_photo"></i></div>
        <div class="info">
          <div class="vCenter">
            <div class="vCenterKid">
              <span class="category">Photocall</span>
              <span class="date">15.05.16</span> . <span
                  class="hour">14:10</span>
              <p data-title="Ryan Gosling - The Nice Guys">Ryan Gosling - The Nice Guys</p>
            </div>
          </div>
        </div>
      </div>
      <div class="item photocall 15-05-16 shadow-bottom photo paysage notloaded">
        <a id="photo1024" class="ajax chocolat-image" data-pid="1024"
           href="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/06/8b7122bdde9ff84559a5543aec913c41351797f1.jpg"
           title='<span class="category">Photocall</span><span class="date">15.05.16 . 14:03</span><h2>Angourie Rice - The Nice Guys</h2>'
           data-credit="Crédit Image : Thomas Leibreich / FDC"></a>
        <img data-original="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/06/thumb_5235_media_image_640x404.jpg"  alt="" title="Angourie Rice - The Nice Guys" class="lazy">
        <div class="picto"><i class="icon icon_photo"></i></div>
        <div class="info">
          <div class="vCenter">
            <div class="vCenterKid">
              <span class="category">Photocall</span>
              <span class="date">15.05.16</span> . <span
                  class="hour">14:03</span>
              <p data-title="Angourie Rice - The Nice Guys">Angourie Rice - The Nice Guys</p>
            </div>
          </div>
        </div>
      </div>
      <div class="item photocall 15-05-16 shadow-bottom photo paysage notloaded">
        <a id="photo1023" class="ajax chocolat-image" data-pid="1023"
           href="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/06/881d15ea91f53b38e223e0511234c69a6ad1c541.jpg"
           title='<span class="category">Photocall</span><span class="date">15.05.16 . 14:00</span><h2>Équipe du film - The Nice Guys</h2>'
           data-credit="Crédit Image : Thomas Leibreich / FDC"></a>
        <img data-original="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/06/thumb_5233_media_image_640x404.jpg"  alt="" title="Équipe du film - The Nice Guys" class="lazy">
        <div class="picto"><i class="icon icon_photo"></i></div>
        <div class="info">
          <div class="vCenter">
            <div class="vCenterKid">
              <span class="category">Photocall</span>
              <span class="date">15.05.16</span> . <span
                  class="hour">14:00</span>
              <p data-title="Équipe du film - The Nice Guys">Équipe du film - The Nice Guys</p>
            </div>
          </div>
        </div>
      </div>
      <div class="item sur-scene 15-05-16 shadow-bottom photo paysage notloaded">
        <a id="photo1021" class="ajax chocolat-image" data-pid="1021"
           href="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/06/9b59ea5d43bbfcda4319b18e1d89b8a85bd4d1b5.JPG"
           title='<span class="category">Sur Scène</span><span class="date">15.05.16 . 13:15</span><h2>Jiri Hlupy, Jeanne Pommeau, Michal Bregant et Gérald Duchaussoy - Ikarie XB1</h2>'
           data-credit="Crédit Image : Léo Laumont / FDC"></a>
        <img data-original="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/06/thumb_5231_media_image_640x404.JPG"  alt="" title="Jiri Hlupy, Jeanne Pommeau, Michal Bregant et Gérald Duchaussoy - Ikarie XB1" class="lazy">
        <div class="picto"><i class="icon icon_photo"></i></div>
        <div class="info">
          <div class="vCenter">
            <div class="vCenterKid">
              <span class="category">Sur Scène</span>
              <span class="date">15.05.16</span> . <span
                  class="hour">13:15</span>
              <p data-title="Jiri Hlupy, Jeanne Pommeau, Michal Bregant et Gérald Duchaussoy - Ikarie XB1">Jiri Hlupy, Jeanne Pommeau, Michal Bregant et Gérald Duchaussoy - Ikarie XB1</p>
            </div>
          </div>
        </div>
      </div>
      <div class="item conference-de-presse 15-05-16 shadow-bottom photo portrait notloaded">
        <a id="photo1014" class="ajax chocolat-image" data-pid="1014"
           href="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/06/c70232d230cd5da4baa65ad44b3198fe7ad4e932.jpg"
           title='<span class="category">Conférence de Presse</span><span class="date">15.05.16 . 12:33</span><h2>Raymond Coalson - American Honey</h2>'
           data-credit="Crédit Image : Cyril Duchêne / FDC"></a>
        <img data-original="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/06/thumb_5224_media_image_320x404.jpg"  alt="" title="Raymond Coalson - American Honey" class="lazy">
        <div class="picto"><i class="icon icon_photo"></i></div>
        <div class="info">
          <div class="vCenter">
            <div class="vCenterKid">
              <span class="category">Conférence de Presse</span>
              <span class="date">15.05.16</span> . <span
                  class="hour">12:33</span>
              <p data-title="Raymond Coalson - American Honey">Raymond Coalson - American Honey</p>
            </div>
          </div>
        </div>
      </div>
      <div class="item conference-de-presse 15-05-16 shadow-bottom photo paysage notloaded">
        <a id="photo1009" class="ajax chocolat-image" data-pid="1009"
           href="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/06/631b386a6ec63274e1ddfd21b5a3a63c8ef898d1.jpg"
           title='<span class="category">Conférence de Presse</span><span class="date">15.05.16 . 12:30</span><h2>Andrea Arnold - American Honey</h2>'
           data-credit="Crédit Image : Cyril Duchêne / FDC"></a>
        <img data-original="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/06/thumb_5223_media_image_640x404.jpg"  alt="" title="Andrea Arnold - American Honey" class="lazy">
        <div class="picto"><i class="icon icon_photo"></i></div>
        <div class="info">
          <div class="vCenter">
            <div class="vCenterKid">
              <span class="category">Conférence de Presse</span>
              <span class="date">15.05.16</span> . <span
                  class="hour">12:30</span>
              <p data-title="Andrea Arnold - American Honey">Andrea Arnold - American Honey</p>
            </div>
          </div>
        </div>
      </div>
      <div class="item photocall 15-05-16 shadow-bottom photo paysage notloaded">
        <a id="photo1011" class="ajax chocolat-image" data-pid="1011"
           href="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/06/4d4774b5c0466f8f292daa94ae971235608e3b45.jpg"
           title='<span class="category">Photocall</span><span class="date">15.05.16 . 12:10</span><h2>Riley Keough - American Honey</h2>'
           data-credit="Crédit Image : Léo Laumont / FDC"></a>
        <img data-original="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/06/thumb_5219_media_image_640x404.jpg"  alt="" title="Riley Keough - American Honey" class="lazy">
        <div class="picto"><i class="icon icon_photo"></i></div>
        <div class="info">
          <div class="vCenter">
            <div class="vCenterKid">
              <span class="category">Photocall</span>
              <span class="date">15.05.16</span> . <span
                  class="hour">12:10</span>
              <p data-title="Riley Keough - American Honey">Riley Keough - American Honey</p>
            </div>
          </div>
        </div>
      </div>
      <div class="item photocall 15-05-16 shadow-bottom photo portrait notloaded">
        <a id="photo1020" class="ajax chocolat-image" data-pid="1020"
           href="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/06/372e1613854455381453b84405307a9d93781274.jpg"
           title='<span class="category">Photocall</span><span class="date">15.05.16 . 12:08</span><h2>Sasha Lane - American Honey</h2>'
           data-credit="Crédit Image : Tony Barson / Getty Images"></a>
        <img data-original="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/06/thumb_5230_media_image_320x404.jpg"  alt="" title="Sasha Lane - American Honey" class="lazy">
        <div class="picto"><i class="icon icon_photo"></i></div>
        <div class="info">
          <div class="vCenter">
            <div class="vCenterKid">
              <span class="category">Photocall</span>
              <span class="date">15.05.16</span> . <span
                  class="hour">12:08</span>
              <p data-title="Sasha Lane - American Honey">Sasha Lane - American Honey</p>
            </div>
          </div>
        </div>
      </div>
      <div class="item photocall 15-05-16 shadow-bottom photo portrait notloaded">
        <a id="photo1010" class="ajax chocolat-image" data-pid="1010"
           href="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/06/44180252d6124a3279c3fd30301b35b3c4d9ebde.jpg"
           title='<span class="category">Photocall</span><span class="date">15.05.16 . 12:07</span><h2>Shia Labeouf et Mccaul Lombardi - American Honey</h2>'
           data-credit="Crédit Image : Thomas Leibreich / FDC"></a>
        <img data-original="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/06/thumb_5220_media_image_320x404.jpg"  alt="" title="Shia Labeouf et Mccaul Lombardi - American Honey" class="lazy">
        <div class="picto"><i class="icon icon_photo"></i></div>
        <div class="info">
          <div class="vCenter">
            <div class="vCenterKid">
              <span class="category">Photocall</span>
              <span class="date">15.05.16</span> . <span
                  class="hour">12:07</span>
              <p data-title="Shia Labeouf et Mccaul Lombardi - American Honey">Shia Labeouf et Mccaul Lombardi - American Honey</p>
            </div>
          </div>
        </div>
      </div>
      <div class="item photocall 15-05-16 shadow-bottom photo paysage notloaded">
        <a id="photo1008" class="ajax chocolat-image" data-pid="1008"
           href="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/06/2fed47248c45d844fae1c2e6179317cc8001c82a.jpg"
           title='<span class="category">Photocall</span><span class="date">15.05.16 . 12:03</span><h2>Riley Keough et Sasha Lane - American Honey</h2>'
           data-credit="Crédit Image : George Pimentel / Getty Images"></a>
        <img data-original="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/06/thumb_5222_media_image_640x404.jpg"  alt="" title="Riley Keough et Sasha Lane - American Honey" class="lazy">
        <div class="picto"><i class="icon icon_photo"></i></div>
        <div class="info">
          <div class="vCenter">
            <div class="vCenterKid">
              <span class="category">Photocall</span>
              <span class="date">15.05.16</span> . <span
                  class="hour">12:03</span>
              <p data-title="Riley Keough et Sasha Lane - American Honey">Riley Keough et Sasha Lane - American Honey</p>
            </div>
          </div>
        </div>
      </div>
      <div class="item photocall 15-05-16 shadow-bottom photo paysage notloaded">
        <a id="photo1007" class="ajax chocolat-image" data-pid="1007"
           href="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/06/016fd5af3c3051615d5b11719e0159e2ab28d72c.jpg"
           title='<span class="category">Photocall</span><span class="date">15.05.16 . 12:00</span><h2>Équipe du film - American Honey</h2>'
           data-credit="Crédit Image : Léo Laumont / FDC"></a>
        <img data-original="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/06/thumb_5215_media_image_640x404.jpg"  alt="" title="Équipe du film - American Honey" class="lazy">
        <div class="picto"><i class="icon icon_photo"></i></div>
        <div class="info">
          <div class="vCenter">
            <div class="vCenterKid">
              <span class="category">Photocall</span>
              <span class="date">15.05.16</span> . <span
                  class="hour">12:00</span>
              <p data-title="Équipe du film - American Honey">Équipe du film - American Honey</p>
            </div>
          </div>
        </div>
      </div>
      <div class="item conference-de-presse 15-05-16 shadow-bottom photo paysage notloaded">
        <a id="photo1000" class="ajax chocolat-image" data-pid="1000"
           href="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/06/61f2d5db8b8da336f84e3dd3df666cf47b0c4df0.jpg"
           title='<span class="category">Conférence de Presse</span><span class="date">15.05.16 . 11:27</span><h2>Alex Brendemuhl - Mal de pierres (From the Land of the Moon)</h2>'
           data-credit="Crédit Image : Mathilde Petit / FDC"></a>
        <img data-original="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/06/thumb_5211_media_image_640x404.jpg"  alt="" title="Alex Brendemuhl - Mal de pierres (From the Land of the Moon)" class="lazy">
        <div class="picto"><i class="icon icon_photo"></i></div>
        <div class="info">
          <div class="vCenter">
            <div class="vCenterKid">
              <span class="category">Conférence de Presse</span>
              <span class="date">15.05.16</span> . <span
                  class="hour">11:27</span>
              <p data-title="Alex Brendemuhl - Mal de pierres (From the Land of the Moon)">Alex Brendemuhl - Mal de pierres (From the Land of the Moon)</p>
            </div>
          </div>
        </div>
      </div>
      <div class="item conference-de-presse 15-05-16 shadow-bottom photo paysage notloaded">
        <a id="photo999" class="ajax chocolat-image" data-pid="999"
           href="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/06/941a463c7b989b223a40f71357c3b940bdc5eac8.jpg"
           title='<span class="category">Conférence de Presse</span><span class="date">15.05.16 . 11:25</span><h2>Équipe du film - Mal de pierres (From the Land of the Moon)</h2>'
           data-credit="Crédit Image : Mathilde Petit / FDC"></a>
        <img data-original="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/06/thumb_5210_media_image_640x404.jpg"  alt="" title="Équipe du film - Mal de pierres (From the Land of the Moon)" class="lazy">
        <div class="picto"><i class="icon icon_photo"></i></div>
        <div class="info">
          <div class="vCenter">
            <div class="vCenterKid">
              <span class="category">Conférence de Presse</span>
              <span class="date">15.05.16</span> . <span
                  class="hour">11:25</span>
              <p data-title="Équipe du film - Mal de pierres (From the Land of the Moon)">Équipe du film - Mal de pierres (From the Land of the Moon)</p>
            </div>
          </div>
        </div>
      </div>
      <div class="item montee-des-marches 15-05-16 shadow-bottom photo paysage notloaded">
        <a id="photo997" class="ajax chocolat-image" data-pid="997"
           href="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/06/585838268eaca273a812e126b0fa48c4846d3428.jpg"
           title='<span class="category">Montée des Marches</span><span class="date">15.05.16 . 11:20</span><h2>Équipe du film - Câini (Dogs)</h2>'
           data-credit="Crédit Image : Léo Laumont / FDC"></a>
        <img data-original="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/06/thumb_5208_media_image_640x404.jpg"  alt="" title="Équipe du film - Câini (Dogs)" class="lazy">
        <div class="picto"><i class="icon icon_photo"></i></div>
        <div class="info">
          <div class="vCenter">
            <div class="vCenterKid">
              <span class="category">Montée des Marches</span>
              <span class="date">15.05.16</span> . <span
                  class="hour">11:20</span>
              <p data-title="Équipe du film - Câini (Dogs)">Équipe du film - Câini (Dogs)</p>
            </div>
          </div>
        </div>
      </div>
      <div class="item photocall 15-05-16 shadow-bottom photo portrait notloaded">
        <a id="photo995" class="ajax chocolat-image" data-pid="995"
           href="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/06/c82f52f1fb8f989744c887d89c5a9483551aacbb.jpg"
           title='<span class="category">Photocall</span><span class="date">15.05.16 . 10:47</span><h2>Mili Eshet - Me&#039;Ever Laharim Vehagvaot (Beyond the Mountains and Hills)</h2>'
           data-credit="Crédit Image : Mathilde Petit / FDC"></a>
        <img data-original="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/06/thumb_5205_media_image_320x404.jpg"  alt="" title="Mili Eshet - Me&#039;Ever Laharim Vehagvaot (Beyond the Mountains and Hills)" class="lazy">
        <div class="picto"><i class="icon icon_photo"></i></div>
        <div class="info">
          <div class="vCenter">
            <div class="vCenterKid">
              <span class="category">Photocall</span>
              <span class="date">15.05.16</span> . <span
                  class="hour">10:47</span>
              <p data-title="Mili Eshet - Me&#039;Ever Laharim Vehagvaot (Beyond the Mountains and Hills)">Mili Eshet - Me&#039;Ever Laharim Vehagvaot (Beyond the Mountains and Hills)</p>
            </div>
          </div>
        </div>
      </div>
      <div class="item photocall 15-05-16 shadow-bottom photo paysage notloaded">
        <a id="photo994" class="ajax chocolat-image" data-pid="994"
           href="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/06/ce36662b39b0acbd5cb747823e98250b58860f6d.jpg"
           title='<span class="category">Photocall</span><span class="date">15.05.16 . 10:45</span><h2>Yoav Rotman, Alon Pdut et Noam Imber -  Me&#039;Ever Laharim Vehagvaot (Beyond the Mountains and Hills)</h2>'
           data-credit="Crédit Image : Mathilde Petit / FDC"></a>
        <img data-original="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/06/thumb_5204_media_image_640x404.jpg"  alt="" title="Yoav Rotman, Alon Pdut et Noam Imber -  Me&#039;Ever Laharim Vehagvaot (Beyond the Mountains and Hills)" class="lazy">
        <div class="picto"><i class="icon icon_photo"></i></div>
        <div class="info">
          <div class="vCenter">
            <div class="vCenterKid">
              <span class="category">Photocall</span>
              <span class="date">15.05.16</span> . <span
                  class="hour">10:45</span>
              <p data-title="Yoav Rotman, Alon Pdut et Noam Imber -  Me&#039;Ever Laharim Vehagvaot (Beyond the Mountains and Hills)">Yoav Rotman, Alon Pdut et Noam Imber -  Me&#039;Ever Laharim Vehagvaot (Beyond the Mountains and Hills)</p>
            </div>
          </div>
        </div>
      </div>
      <div class="item photocall 15-05-16 shadow-bottom photo paysage notloaded">
        <a id="photo993" class="ajax chocolat-image" data-pid="993"
           href="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/06/cb8768742417ca36c874d7164b1d758d8890b5bd.jpg"
           title='<span class="category">Photocall</span><span class="date">15.05.16 . 10:42</span><h2>Eran Kolirin - Me&#039;ever Laharim Vehagvaot (Beyond the Mountains and Hills)</h2>'
           data-credit="Crédit Image : Mathilde Petit / FDC"></a>
        <img data-original="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/06/thumb_5203_media_image_640x404.jpg"  alt="" title="Eran Kolirin - Me&#039;ever Laharim Vehagvaot (Beyond the Mountains and Hills)" class="lazy">
        <div class="picto"><i class="icon icon_photo"></i></div>
        <div class="info">
          <div class="vCenter">
            <div class="vCenterKid">
              <span class="category">Photocall</span>
              <span class="date">15.05.16</span> . <span
                  class="hour">10:42</span>
              <p data-title="Eran Kolirin - Me&#039;ever Laharim Vehagvaot (Beyond the Mountains and Hills)">Eran Kolirin - Me&#039;ever Laharim Vehagvaot (Beyond the Mountains and Hills)</p>
            </div>
          </div>
        </div>
      </div>
      <div class="item photocall 15-05-16 shadow-bottom photo paysage notloaded">
        <a id="photo988" class="ajax chocolat-image" data-pid="988"
           href="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/06/cc8148cfa238fceb9a9b08f0122538be187979e3.jpg"
           title='<span class="category">Photocall</span><span class="date">15.05.16 . 10:40</span><h2>Marion Cotillard et Louis Garrel- Mal de pierres (From the Land of the Moon)</h2>'
           data-credit="Crédit Image : Cyril Duchêne / FDC"></a>
        <img data-original="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/06/thumb_5206_media_image_640x404.jpg"  alt="" title="Marion Cotillard et Louis Garrel- Mal de pierres (From the Land of the Moon)" class="lazy">
        <div class="picto"><i class="icon icon_photo"></i></div>
        <div class="info">
          <div class="vCenter">
            <div class="vCenterKid">
              <span class="category">Photocall</span>
              <span class="date">15.05.16</span> . <span
                  class="hour">10:40</span>
              <p data-title="Marion Cotillard et Louis Garrel- Mal de pierres (From the Land of the Moon)">Marion Cotillard et Louis Garrel- Mal de pierres (From the Land of the Moon)</p>
            </div>
          </div>
        </div>
      </div>
      <div class="item photocall 15-05-16 shadow-bottom photo paysage notloaded">
        <a id="photo992" class="ajax chocolat-image" data-pid="992"
           href="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/06/91d8d99cb7a7d3002feaa69cd88ac149f1270e10.jpg"
           title='<span class="category">Photocall</span><span class="date">15.05.16 . 10:40</span><h2>Équipe du film - Me&#039;ever Laharim Vehagvaot (Beyond the Mountains and Hills)</h2>'
           data-credit="Crédit Image : Mathilde Petit / FDC"></a>
        <img data-original="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/06/thumb_5202_media_image_640x404.jpg"  alt="" title="Équipe du film - Me&#039;ever Laharim Vehagvaot (Beyond the Mountains and Hills)" class="lazy">
        <div class="picto"><i class="icon icon_photo"></i></div>
        <div class="info">
          <div class="vCenter">
            <div class="vCenterKid">
              <span class="category">Photocall</span>
              <span class="date">15.05.16</span> . <span
                  class="hour">10:40</span>
              <p data-title="Équipe du film - Me&#039;ever Laharim Vehagvaot (Beyond the Mountains and Hills)">Équipe du film - Me&#039;ever Laharim Vehagvaot (Beyond the Mountains and Hills)</p>
            </div>
          </div>
        </div>
      </div>
      <div class="item photocall 15-05-16 shadow-bottom photo paysage notloaded">
        <a id="photo989" class="ajax chocolat-image" data-pid="989"
           href="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/06/4f473debec7665fdb6b8ada6e732e37d671b9a28.jpg"
           title='<span class="category">Photocall</span><span class="date">15.05.16 . 10:35</span><h2>Nicole Garcia - Mal de pierres</h2>'
           data-credit="Crédit Image : Mathilde Petit / FDC"></a>
        <img data-original="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/06/thumb_5200_media_image_640x404.jpg"  alt="" title="Nicole Garcia - Mal de pierres" class="lazy">
        <div class="picto"><i class="icon icon_photo"></i></div>
        <div class="info">
          <div class="vCenter">
            <div class="vCenterKid">
              <span class="category">Photocall</span>
              <span class="date">15.05.16</span> . <span
                  class="hour">10:35</span>
              <p data-title="Nicole Garcia - Mal de pierres">Nicole Garcia - Mal de pierres</p>
            </div>
          </div>
        </div>
      </div>
      <div class="item photocall 15-05-16 shadow-bottom photo paysage notloaded">
        <a id="photo987" class="ajax chocolat-image" data-pid="987"
           href="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/06/bc313c584df4284a596d62c86be7f610e4e9e9dd.jpg"
           title='<span class="category">Photocall</span><span class="date">15.05.16 . 10:30</span><h2>Louis Garrel, Marion Cotillard, Nicole Garcia et Alex Brendemuhl - Mal de pierres</h2>'
           data-credit="Crédit Image : Thomas Leibreich / FDC"></a>
        <img data-original="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/06/thumb_5198_media_image_640x404.jpg"  alt="" title="Louis Garrel, Marion Cotillard, Nicole Garcia et Alex Brendemuhl - Mal de pierres" class="lazy">
        <div class="picto"><i class="icon icon_photo"></i></div>
        <div class="info">
          <div class="vCenter">
            <div class="vCenterKid">
              <span class="category">Photocall</span>
              <span class="date">15.05.16</span> . <span
                  class="hour">10:30</span>
              <p data-title="Louis Garrel, Marion Cotillard, Nicole Garcia et Alex Brendemuhl - Mal de pierres">Louis Garrel, Marion Cotillard, Nicole Garcia et Alex Brendemuhl - Mal de pierres</p>
            </div>
          </div>
        </div>
      </div>
      <div class="item oeil-du-photographe 15-05-16 shadow-bottom photo portrait notloaded">
        <a id="photo934" class="ajax chocolat-image" data-pid="934"
           href="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/06/e99c081d25c81ac3b64f69b1c6984dab3d5431e0.jpg"
           title='<span class="category">Œil du photographe</span><span class="date">15.05.16 . 09:00</span><h2>George Clooney et Julia Roberts étaient vraiment cool. George est arrivé le premier. Julia est arrivée un verre d&#039;eau à la main. Je lui ai dit de faire attention à la petite marche et elle a fait mine de tomber et de me renverser le verre dessus.</h2>'
           data-credit="Crédit Image : François Berthier / Getty Images"></a>
        <img data-original="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/06/thumb_5154_media_image_320x404.jpg"  alt="" title="George Clooney et Julia Roberts étaient vraiment cool. George est arrivé le premier. Julia est arrivée un verre d&#039;eau à la main. Je lui ai dit de faire attention à la petite marche et elle a fait mine de tomber et de me renverser le verre dessus." class="lazy">
        <div class="picto"><i class="icon icon_photo"></i></div>
        <div class="info">
          <div class="vCenter">
            <div class="vCenterKid">
              <span class="category">Œil du photographe</span>
              <span class="date">15.05.16</span> . <span
                  class="hour">09:00</span>
              <p data-title="George Clooney et Julia Roberts étaient vraiment cool. George est arrivé le premier. Julia est arrivée un verre d&#039;eau à la main. Je lui ai dit de faire attention à la petite marche et elle a fait mine de tomber et de me renverser le verre dessus.">George Clooney et Julia Roberts étaient vraiment cool. George est arrivé le premier. Julia est arrivée un verre d&#039;eau à la main. Je lui ai dit de faire attention à la petite marche et elle a fait mine de tomber et de me renverser le verre dessus.</p>
            </div>
          </div>
        </div>
      </div>
      <div class="item oeil-du-photographe 15-05-16 shadow-bottom photo portrait notloaded">
        <a id="photo935" class="ajax chocolat-image" data-pid="935"
           href="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/06/98698d7a9bcf4067d330ae23214896ddfb0e7eaf.jpg"
           title='<span class="category">Œil du photographe</span><span class="date">15.05.16 . 09:00</span><h2>Mark Weber : L&#039;Ex pilote F1 était à Cannes pour la présentation  de Le Mans 3D. Pour l&#039;anecdote, j&#039;ai commencé en travaillant dans un magazine de formule 1.</h2>'
           data-credit="Crédit Image : François Berthier / Getty Images"></a>
        <img data-original="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/06/thumb_5155_media_image_320x404.jpg"  alt="" title="Mark Weber : L&#039;Ex pilote F1 était à Cannes pour la présentation  de Le Mans 3D. Pour l&#039;anecdote, j&#039;ai commencé en travaillant dans un magazine de formule 1." class="lazy">
        <div class="picto"><i class="icon icon_photo"></i></div>
        <div class="info">
          <div class="vCenter">
            <div class="vCenterKid">
              <span class="category">Œil du photographe</span>
              <span class="date">15.05.16</span> . <span
                  class="hour">09:00</span>
              <p data-title="Mark Weber : L&#039;Ex pilote F1 était à Cannes pour la présentation  de Le Mans 3D. Pour l&#039;anecdote, j&#039;ai commencé en travaillant dans un magazine de formule 1.">Mark Weber : L&#039;Ex pilote F1 était à Cannes pour la présentation  de Le Mans 3D. Pour l&#039;anecdote, j&#039;ai commencé en travaillant dans un magazine de formule 1.</p>
            </div>
          </div>
        </div>
      </div>
      <div class="item oeil-du-photographe 15-05-16 shadow-bottom photo portrait notloaded">
        <a id="photo936" class="ajax chocolat-image" data-pid="936"
           href="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/06/fc853df43baaa3808ef8b2fdcb085504066d0b6c.jpg"
           title='<span class="category">Œil du photographe</span><span class="date">15.05.16 . 09:00</span><h2>Portrait de Mohamed Diab, c&#039;est la première image de la série et quasiment la meilleure. On remarque la main de mon assistant qui tient le fond en haut de l&#039;image.</h2>'
           data-credit="Crédit Image : François Berthier / Getty Images"></a>
        <img data-original="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/06/thumb_5156_media_image_320x404.jpg"  alt="" title="Portrait de Mohamed Diab, c&#039;est la première image de la série et quasiment la meilleure. On remarque la main de mon assistant qui tient le fond en haut de l&#039;image." class="lazy">
        <div class="picto"><i class="icon icon_photo"></i></div>
        <div class="info">
          <div class="vCenter">
            <div class="vCenterKid">
              <span class="category">Œil du photographe</span>
              <span class="date">15.05.16</span> . <span
                  class="hour">09:00</span>
              <p data-title="Portrait de Mohamed Diab, c&#039;est la première image de la série et quasiment la meilleure. On remarque la main de mon assistant qui tient le fond en haut de l&#039;image.">Portrait de Mohamed Diab, c&#039;est la première image de la série et quasiment la meilleure. On remarque la main de mon assistant qui tient le fond en haut de l&#039;image.</p>
            </div>
          </div>
        </div>
      </div>
      <div class="item oeil-du-photographe 15-05-16 shadow-bottom photo portrait notloaded">
        <a id="photo938" class="ajax chocolat-image" data-pid="938"
           href="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/06/c4802f4369eea32af54b0ea9ce8c103782715182.jpg"
           title='<span class="category">Œil du photographe</span><span class="date">15.05.16 . 09:00</span><h2>Un portrait de Shai Avivi, un acteur Israélien très sympa et très charismatique avec qui nous avons discuté de l&#039;ancienneté de l&#039;hébreu.</h2>'
           data-credit="Crédit Image : François Berthier / Getty Images"></a>
        <img data-original="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/06/thumb_5157_media_image_320x404.jpg"  alt="" title="Un portrait de Shai Avivi, un acteur Israélien très sympa et très charismatique avec qui nous avons discuté de l&#039;ancienneté de l&#039;hébreu." class="lazy">
        <div class="picto"><i class="icon icon_photo"></i></div>
        <div class="info">
          <div class="vCenter">
            <div class="vCenterKid">
              <span class="category">Œil du photographe</span>
              <span class="date">15.05.16</span> . <span
                  class="hour">09:00</span>
              <p data-title="Un portrait de Shai Avivi, un acteur Israélien très sympa et très charismatique avec qui nous avons discuté de l&#039;ancienneté de l&#039;hébreu.">Un portrait de Shai Avivi, un acteur Israélien très sympa et très charismatique avec qui nous avons discuté de l&#039;ancienneté de l&#039;hébreu.</p>
            </div>
          </div>
        </div>
      </div>
      <div class="item sur-scene 14-05-16 shadow-bottom photo paysage notloaded">
        <a id="photo968" class="ajax chocolat-image" data-pid="968"
           href="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/06/6e0113e8497a6da2c325bf9f6b3bfc45aae9914c.jpg"
           title='<span class="category">Sur Scène</span><span class="date">14.05.16 . 22:45</span><h2>Carrie Fisher et Fisher Stevens  - Bright Lights</h2>'
           data-credit="Crédit Image : Léo Laumont / FDC"></a>
        <img data-original="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/06/thumb_5195_media_image_640x404.jpg"  alt="" title="Carrie Fisher et Fisher Stevens  - Bright Lights" class="lazy">
        <div class="picto"><i class="icon icon_photo"></i></div>
        <div class="info">
          <div class="vCenter">
            <div class="vCenterKid">
              <span class="category">Sur Scène</span>
              <span class="date">14.05.16</span> . <span
                  class="hour">22:45</span>
              <p data-title="Carrie Fisher et Fisher Stevens  - Bright Lights">Carrie Fisher et Fisher Stevens  - Bright Lights</p>
            </div>
          </div>
        </div>
      </div>
      <div class="item montee-des-marches 14-05-16 shadow-bottom photo paysage notloaded">
        <a id="photo966" class="ajax chocolat-image" data-pid="966"
           href="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/06/de215f90a0e8d6d4241ade05d497e74511dfd271.jpg"
           title='<span class="category">Montée des Marches</span><span class="date">14.05.16 . 21:35</span><h2>Ha Jung-Woo et Kim Min-Hee  - Mademoiselle</h2>'
           data-credit="Crédit Image : Alberto Pizzoli / AFP"></a>
        <img data-original="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/06/thumb_5185_media_image_640x404.jpg"  alt="" title="Ha Jung-Woo et Kim Min-Hee  - Mademoiselle" class="lazy">
        <div class="picto"><i class="icon icon_photo"></i></div>
        <div class="info">
          <div class="vCenter">
            <div class="vCenterKid">
              <span class="category">Montée des Marches</span>
              <span class="date">14.05.16</span> . <span
                  class="hour">21:35</span>
              <p data-title="Ha Jung-Woo et Kim Min-Hee  - Mademoiselle">Ha Jung-Woo et Kim Min-Hee  - Mademoiselle</p>
            </div>
          </div>
        </div>
      </div>
      <div class="item montee-des-marches 14-05-16 shadow-bottom photo paysage notloaded">
        <a id="photo965" class="ajax chocolat-image" data-pid="965"
           href="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/06/dcc912bb603ce19a7b82eb83e27364127e074a16.jpg"
           title='<span class="category">Montée des Marches</span><span class="date">14.05.16 . 21:34</span><h2>Park Chan-Wook, South Korean, Kim Min-Hee et Ha Jung-Woo - Mademoiselle</h2>'
           data-credit="Crédit Image : Alberto Pizzoli / AFP"></a>
        <img data-original="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/06/thumb_5183_media_image_640x404.jpg"  alt="" title="Park Chan-Wook, South Korean, Kim Min-Hee et Ha Jung-Woo - Mademoiselle" class="lazy">
        <div class="picto"><i class="icon icon_photo"></i></div>
        <div class="info">
          <div class="vCenter">
            <div class="vCenterKid">
              <span class="category">Montée des Marches</span>
              <span class="date">14.05.16</span> . <span
                  class="hour">21:34</span>
              <p data-title="Park Chan-Wook, South Korean, Kim Min-Hee et Ha Jung-Woo - Mademoiselle">Park Chan-Wook, South Korean, Kim Min-Hee et Ha Jung-Woo - Mademoiselle</p>
            </div>
          </div>
        </div>
      </div>
      <div class="item montee-des-marches 14-05-16 shadow-bottom photo paysage notloaded">
        <a id="photo962" class="ajax chocolat-image" data-pid="962"
           href="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/06/5915712dafd725664288bfd659d3e0a1c01721cf.jpg"
           title='<span class="category">Montée des Marches</span><span class="date">14.05.16 . 21:30</span><h2>Équipe du film - Mademoiselle</h2>'
           data-credit="Crédit Image : Valéry Hache / AFP"></a>
        <img data-original="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/06/thumb_5180_media_image_640x404.jpg"  alt="" title="Équipe du film - Mademoiselle" class="lazy">
        <div class="picto"><i class="icon icon_photo"></i></div>
        <div class="info">
          <div class="vCenter">
            <div class="vCenterKid">
              <span class="category">Montée des Marches</span>
              <span class="date">14.05.16</span> . <span
                  class="hour">21:30</span>
              <p data-title="Équipe du film - Mademoiselle">Équipe du film - Mademoiselle</p>
            </div>
          </div>
        </div>
      </div>
      <div class="item montee-des-marches 14-05-16 shadow-bottom photo portrait notloaded">
        <a id="photo963" class="ajax chocolat-image" data-pid="963"
           href="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/06/d8a62379bb1990f3d4a9391ad88e93f41f1c79f8.jpg"
           title='<span class="category">Montée des Marches</span><span class="date">14.05.16 . 21:23</span><h2>Tsutsui Mariko - Fuchi Ni Tatsu (Harmonium)</h2>'
           data-credit="Crédit Image : Antonin Thuillier / AFP"></a>
        <img data-original="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/06/thumb_5181_media_image_320x404.jpg"  alt="" title="Tsutsui Mariko - Fuchi Ni Tatsu (Harmonium)" class="lazy">
        <div class="picto"><i class="icon icon_photo"></i></div>
        <div class="info">
          <div class="vCenter">
            <div class="vCenterKid">
              <span class="category">Montée des Marches</span>
              <span class="date">14.05.16</span> . <span
                  class="hour">21:23</span>
              <p data-title="Tsutsui Mariko - Fuchi Ni Tatsu (Harmonium)">Tsutsui Mariko - Fuchi Ni Tatsu (Harmonium)</p>
            </div>
          </div>
        </div>
      </div>
      <div class="item montee-des-marches 14-05-16 shadow-bottom photo paysage notloaded">
        <a id="photo964" class="ajax chocolat-image" data-pid="964"
           href="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/06/41e59064c0ca0364ca728d24e206485bf2d5af48.jpg"
           title='<span class="category">Montée des Marches</span><span class="date">14.05.16 . 21:20</span><h2>Équipe du film - Fuchi Ni Tatsu (Harmonium)</h2>'
           data-credit="Crédit Image : Loïc Venance / AFP"></a>
        <img data-original="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/06/thumb_5182_media_image_640x404.jpg"  alt="" title="Équipe du film - Fuchi Ni Tatsu (Harmonium)" class="lazy">
        <div class="picto"><i class="icon icon_photo"></i></div>
        <div class="info">
          <div class="vCenter">
            <div class="vCenterKid">
              <span class="category">Montée des Marches</span>
              <span class="date">14.05.16</span> . <span
                  class="hour">21:20</span>
              <p data-title="Équipe du film - Fuchi Ni Tatsu (Harmonium)">Équipe du film - Fuchi Ni Tatsu (Harmonium)</p>
            </div>
          </div>
        </div>
      </div>
      <div class="item montee-des-marches 14-05-16 shadow-bottom photo paysage notloaded">
        <a id="photo961" class="ajax chocolat-image" data-pid="961"
           href="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/06/3ef3f8200c33b3e8ff647f93b26d7e3af0ba5c7e.jpg"
           title='<span class="category">Montée des Marches</span><span class="date">14.05.16 . 20:10</span><h2>Carrie Fisher</h2>'
           data-credit="Crédit Image : DR"></a>
        <img data-original="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/06/thumb_5179_media_image_640x404.jpg"  alt="" title="Carrie Fisher" class="lazy">
        <div class="picto"><i class="icon icon_photo"></i></div>
        <div class="info">
          <div class="vCenter">
            <div class="vCenterKid">
              <span class="category">Montée des Marches</span>
              <span class="date">14.05.16</span> . <span
                  class="hour">20:10</span>
              <p data-title="Carrie Fisher">Carrie Fisher</p>
            </div>
          </div>
        </div>
      </div>
      <div class="item montee-des-marches 14-05-16 shadow-bottom photo paysage notloaded">
        <a id="photo956" class="ajax chocolat-image" data-pid="956"
           href="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/06/ffa0b196d1aab007ae125849ccf075d8ee5b567e.jpg"
           title='<span class="category">Montée des Marches</span><span class="date">14.05.16 . 20:00</span><h2>Bernard Menez</h2>'
           data-credit="Crédit Image : Valéry Hache / AFP"></a>
        <img data-original="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/06/thumb_5176_media_image_640x404.jpg"  alt="" title="Bernard Menez" class="lazy">
        <div class="picto"><i class="icon icon_photo"></i></div>
        <div class="info">
          <div class="vCenter">
            <div class="vCenterKid">
              <span class="category">Montée des Marches</span>
              <span class="date">14.05.16</span> . <span
                  class="hour">20:00</span>
              <p data-title="Bernard Menez">Bernard Menez</p>
            </div>
          </div>
        </div>
      </div>
      <div class="item cannes-classics 14-05-16 shadow-bottom photo paysage notloaded">
        <a id="photo954" class="ajax chocolat-image" data-pid="954"
           href="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/06/7571904eea2982e8fb328da87e13a1842f636b38.jpg"
           title='<span class="category">Cannes Classics</span><span class="date">14.05.16 . 19:45</span><h2>Claude Lelouch - Un homme et une femme</h2>'
           data-credit="Crédit Image : Mathilde Petit / FDC"></a>
        <img data-original="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/06/thumb_5173_media_image_640x404.jpg"  alt="" title="Claude Lelouch - Un homme et une femme" class="lazy">
        <div class="picto"><i class="icon icon_photo"></i></div>
        <div class="info">
          <div class="vCenter">
            <div class="vCenterKid">
              <span class="category">Cannes Classics</span>
              <span class="date">14.05.16</span> . <span
                  class="hour">19:45</span>
              <p data-title="Claude Lelouch - Un homme et une femme">Claude Lelouch - Un homme et une femme</p>
            </div>
          </div>
        </div>
      </div>
      <div class="item montee-des-marches 14-05-16 shadow-bottom photo paysage notloaded">
        <a id="photo955" class="ajax chocolat-image" data-pid="955"
           href="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/06/7f1893c6a38f6a1706afa4f258c4f488a458b337.jpg"
           title='<span class="category">Montée des Marches</span><span class="date">14.05.16 . 19:00</span><h2>Rebecca Hall - The BFG (Le Bon Gros Géant)</h2>'
           data-credit="Crédit Image : Danny Martindale / Getty Images"></a>
        <img data-original="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/06/thumb_5175_media_image_640x404.jpg"  alt="" title="Rebecca Hall - The BFG (Le Bon Gros Géant)" class="lazy">
        <div class="picto"><i class="icon icon_photo"></i></div>
        <div class="info">
          <div class="vCenter">
            <div class="vCenterKid">
              <span class="category">Montée des Marches</span>
              <span class="date">14.05.16</span> . <span
                  class="hour">19:00</span>
              <p data-title="Rebecca Hall - The BFG (Le Bon Gros Géant)">Rebecca Hall - The BFG (Le Bon Gros Géant)</p>
            </div>
          </div>
        </div>
      </div>
      <div class="item montee-des-marches 14-05-16 shadow-bottom photo paysage notloaded">
        <a id="photo950" class="ajax chocolat-image" data-pid="950"
           href="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/06/581c68f00f2f725374c9c3c81e59899393ca144d.jpg"
           title='<span class="category">Montée des Marches</span><span class="date">14.05.16 . 18:50</span><h2>Steven Spielberg, Ruby Barnhill et Mark Rylance</h2>'
           data-credit="Crédit Image : Loïc Venance / AFP"></a>
        <img data-original="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/06/thumb_5169_media_image_640x404.jpg"  alt="" title="Steven Spielberg, Ruby Barnhill et Mark Rylance" class="lazy">
        <div class="picto"><i class="icon icon_photo"></i></div>
        <div class="info">
          <div class="vCenter">
            <div class="vCenterKid">
              <span class="category">Montée des Marches</span>
              <span class="date">14.05.16</span> . <span
                  class="hour">18:50</span>
              <p data-title="Steven Spielberg, Ruby Barnhill et Mark Rylance">Steven Spielberg, Ruby Barnhill et Mark Rylance</p>
            </div>
          </div>
        </div>
      </div>
      <div class="item montee-des-marches 14-05-16 shadow-bottom photo portrait notloaded">
        <a id="photo951" class="ajax chocolat-image" data-pid="951"
           href="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/06/345fce2bdba4e39ff052a48a886000bf1000e60c.jpg"
           title='<span class="category">Montée des Marches</span><span class="date">14.05.16 . 18:49</span><h2>Agnès Varda et JR</h2>'
           data-credit="Crédit Image : Tony Barson / Getty Images"></a>
        <img data-original="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/06/thumb_5194_media_image_320x404.jpg"  alt="" title="Agnès Varda et JR" class="lazy">
        <div class="picto"><i class="icon icon_photo"></i></div>
        <div class="info">
          <div class="vCenter">
            <div class="vCenterKid">
              <span class="category">Montée des Marches</span>
              <span class="date">14.05.16</span> . <span
                  class="hour">18:49</span>
              <p data-title="Agnès Varda et JR">Agnès Varda et JR</p>
            </div>
          </div>
        </div>
      </div>
      <div class="item montee-des-marches 14-05-16 shadow-bottom photo paysage notloaded">
        <a id="photo949" class="ajax chocolat-image" data-pid="949"
           href="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/06/e00bff54db666fba78473eef0b59020465c4bcc7.jpg"
           title='<span class="category">Montée des Marches</span><span class="date">14.05.16 . 18:48</span><h2>Équipe du film - The BFG (Le Bon Gros Géant)</h2>'
           data-credit="Crédit Image : Valéry Hache / AFP"></a>
        <img data-original="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/06/thumb_5168_media_image_640x404.jpg"  alt="" title="Équipe du film - The BFG (Le Bon Gros Géant)" class="lazy">
        <div class="picto"><i class="icon icon_photo"></i></div>
        <div class="info">
          <div class="vCenter">
            <div class="vCenterKid">
              <span class="category">Montée des Marches</span>
              <span class="date">14.05.16</span> . <span
                  class="hour">18:48</span>
              <p data-title="Équipe du film - The BFG (Le Bon Gros Géant)">Équipe du film - The BFG (Le Bon Gros Géant)</p>
            </div>
          </div>
        </div>
      </div>
      <div class="item montee-des-marches 14-05-16 shadow-bottom photo portrait notloaded">
        <a id="photo944" class="ajax chocolat-image" data-pid="944"
           href="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/06/31912337cde3d48ad20e8a2c59f10553b1201f25.jpg"
           title='<span class="category">Montée des Marches</span><span class="date">14.05.16 . 18:40</span><h2>Mélanie Thierry</h2>'
           data-credit="Crédit Image : Alberto Pizzoli / AFP"></a>
        <img data-original="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/06/thumb_5164_media_image_320x404.jpg"  alt="" title="Mélanie Thierry" class="lazy">
        <div class="picto"><i class="icon icon_photo"></i></div>
        <div class="info">
          <div class="vCenter">
            <div class="vCenterKid">
              <span class="category">Montée des Marches</span>
              <span class="date">14.05.16</span> . <span
                  class="hour">18:40</span>
              <p data-title="Mélanie Thierry">Mélanie Thierry</p>
            </div>
          </div>
        </div>
      </div>
      <div class="item montee-des-marches 14-05-16 shadow-bottom photo portrait notloaded">
        <a id="photo942" class="ajax chocolat-image" data-pid="942"
           href="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/06/c7ecd3286c6c2e01ebf88a68fa1068ce4bbd710e.jpg"
           title='<span class="category">Montée des Marches</span><span class="date">14.05.16 . 18:35</span><h2>Paz Vega</h2>'
           data-credit="Crédit Image : Valéry Hache / AFP"></a>
        <img data-original="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/06/thumb_5161_media_image_320x404.jpg"  alt="" title="Paz Vega" class="lazy">
        <div class="picto"><i class="icon icon_photo"></i></div>
        <div class="info">
          <div class="vCenter">
            <div class="vCenterKid">
              <span class="category">Montée des Marches</span>
              <span class="date">14.05.16</span> . <span
                  class="hour">18:35</span>
              <p data-title="Paz Vega">Paz Vega</p>
            </div>
          </div>
        </div>
      </div>
      <div class="item montee-des-marches 14-05-16 shadow-bottom photo paysage notloaded">
        <a id="photo941" class="ajax chocolat-image" data-pid="941"
           href="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/06/ea9906e509223b14c4ac57d58084f6a8e24ecb12.jpg"
           title='<span class="category">Montée des Marches</span><span class="date">14.05.16 . 18:15</span><h2>Michel Hazanavicius et Bérénice Bejo - The BFG (Le Bon Gros Géant)</h2>'
           data-credit="Crédit Image : Alberto Pizzoli / AFP"></a>
        <img data-original="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/06/thumb_5163_media_image_640x404.jpg"  alt="" title="Michel Hazanavicius et Bérénice Bejo - The BFG (Le Bon Gros Géant)" class="lazy">
        <div class="picto"><i class="icon icon_photo"></i></div>
        <div class="info">
          <div class="vCenter">
            <div class="vCenterKid">
              <span class="category">Montée des Marches</span>
              <span class="date">14.05.16</span> . <span
                  class="hour">18:15</span>
              <p data-title="Michel Hazanavicius et Bérénice Bejo - The BFG (Le Bon Gros Géant)">Michel Hazanavicius et Bérénice Bejo - The BFG (Le Bon Gros Géant)</p>
            </div>
          </div>
        </div>
      </div>
      <div class="item sur-scene 14-05-16 shadow-bottom photo paysage notloaded">
        <a id="photo930" class="ajax chocolat-image" data-pid="930"
           href="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/06/eb3e47a32c11e864bc765f402ae6592ce86c2454.JPG"
           title='<span class="category">Sur Scène</span><span class="date">14.05.16 . 14:37</span><h2>Marcin Stefaniak et Gérald Duchaussoy - Dekalog V (Le Décalogue V)</h2>'
           data-credit="Crédit Image : Cyril Duchêne / FDC"></a>
        <img data-original="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/06/thumb_5148_media_image_640x404.JPG"  alt="" title="Marcin Stefaniak et Gérald Duchaussoy - Dekalog V (Le Décalogue V)" class="lazy">
        <div class="picto"><i class="icon icon_photo"></i></div>
        <div class="info">
          <div class="vCenter">
            <div class="vCenterKid">
              <span class="category">Sur Scène</span>
              <span class="date">14.05.16</span> . <span
                  class="hour">14:37</span>
              <p data-title="Marcin Stefaniak et Gérald Duchaussoy - Dekalog V (Le Décalogue V)">Marcin Stefaniak et Gérald Duchaussoy - Dekalog V (Le Décalogue V)</p>
            </div>
          </div>
        </div>
      </div>
      <div class="item montee-des-marches 14-05-16 shadow-bottom photo paysage notloaded">
        <a id="photo940" class="ajax chocolat-image" data-pid="940"
           href="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/06/5bfba3e7460034603213601d9f43800d11067411.jpg"
           title='<span class="category">Montée des Marches</span><span class="date">14.05.16 . 14:36</span><h2>Toni Erdmann de Maren Ade</h2>'
           data-credit="Crédit Image : Valery Hache / AFP"></a>
        <img data-original="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/06/thumb_5160_media_image_640x404.jpg"  alt="" title="Toni Erdmann de Maren Ade" class="lazy">
        <div class="picto"><i class="icon icon_photo"></i></div>
        <div class="info">
          <div class="vCenter">
            <div class="vCenterKid">
              <span class="category">Montée des Marches</span>
              <span class="date">14.05.16</span> . <span
                  class="hour">14:36</span>
              <p data-title="Toni Erdmann de Maren Ade">Toni Erdmann de Maren Ade</p>
            </div>
          </div>
        </div>
      </div>
      <div class="item montee-des-marches 14-05-16 shadow-bottom photo paysage notloaded">
        <a id="photo929" class="ajax chocolat-image" data-pid="929"
           href="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/06/50dba9b80057bd74026e0b86c31895412d551a5e.JPG"
           title='<span class="category">Montée des Marches</span><span class="date">14.05.16 . 14:35</span><h2>Équipe du film - Toni Erdmann</h2>'
           data-credit="Crédit Image : Léo Laumont / FDC"></a>
        <img data-original="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/06/thumb_5147_media_image_640x404.JPG"  alt="" title="Équipe du film - Toni Erdmann" class="lazy">
        <div class="picto"><i class="icon icon_photo"></i></div>
        <div class="info">
          <div class="vCenter">
            <div class="vCenterKid">
              <span class="category">Montée des Marches</span>
              <span class="date">14.05.16</span> . <span
                  class="hour">14:35</span>
              <p data-title="Équipe du film - Toni Erdmann">Équipe du film - Toni Erdmann</p>
            </div>
          </div>
        </div>
      </div>
      <div class="item conference-de-presse 14-05-16 shadow-bottom photo paysage notloaded">
        <a id="photo914" class="ajax chocolat-image" data-pid="914"
           href="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/06/55c8f35eb2a6caef82e379f93b4c7a3acd72a532.jpg"
           title='<span class="category">Conférence de Presse</span><span class="date">14.05.16 . 14:31</span><h2>Ruby Barnhill - The BFG (Le Bon Gros Géant)</h2>'
           data-credit="Crédit Image : Laurent Emmanuel / AFP"></a>
        <img data-original="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/06/thumb_5150_media_image_640x404.jpg"  alt="" title="Ruby Barnhill - The BFG (Le Bon Gros Géant)" class="lazy">
        <div class="picto"><i class="icon icon_photo"></i></div>
        <div class="info">
          <div class="vCenter">
            <div class="vCenterKid">
              <span class="category">Conférence de Presse</span>
              <span class="date">14.05.16</span> . <span
                  class="hour">14:31</span>
              <p data-title="Ruby Barnhill - The BFG (Le Bon Gros Géant)">Ruby Barnhill - The BFG (Le Bon Gros Géant)</p>
            </div>
          </div>
        </div>
      </div>
      <div class="item conference-de-presse 14-05-16 shadow-bottom photo paysage notloaded">
        <a id="photo913" class="ajax chocolat-image" data-pid="913"
           href="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/06/1b57110576ce78bb11ddb6bc6269a633fad046f4.jpg"
           title='<span class="category">Conférence de Presse</span><span class="date">14.05.16 . 14:30</span><h2>Équipe du film - The BFG (Le Bon Gros Géant)</h2>'
           data-credit="Crédit Image : Thomas Leibreich / FDC"></a>
        <img data-original="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/06/thumb_5130_media_image_640x404.jpg"  alt="" title="Équipe du film - The BFG (Le Bon Gros Géant)" class="lazy">
        <div class="picto"><i class="icon icon_photo"></i></div>
        <div class="info">
          <div class="vCenter">
            <div class="vCenterKid">
              <span class="category">Conférence de Presse</span>
              <span class="date">14.05.16</span> . <span
                  class="hour">14:30</span>
              <p data-title="Équipe du film - The BFG (Le Bon Gros Géant)">Équipe du film - The BFG (Le Bon Gros Géant)</p>
            </div>
          </div>
        </div>
      </div>
      <div class="item conference-de-presse 14-05-16 shadow-bottom photo paysage notloaded">
        <a id="photo920" class="ajax chocolat-image" data-pid="920"
           href="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/06/8bb8a6e78e852c04de7c49c5fd18178a4c2b4067.jpg"
           title='<span class="category">Conférence de Presse</span><span class="date">14.05.16 . 14:30</span><h2>Steven Spielberg - The BFG (Le Bon Gros Géant)</h2>'
           data-credit="Crédit Image : Laurent Emmanuel / AFP"></a>
        <img data-original="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/06/thumb_5149_media_image_640x404.jpg"  alt="" title="Steven Spielberg - The BFG (Le Bon Gros Géant)" class="lazy">
        <div class="picto"><i class="icon icon_photo"></i></div>
        <div class="info">
          <div class="vCenter">
            <div class="vCenterKid">
              <span class="category">Conférence de Presse</span>
              <span class="date">14.05.16</span> . <span
                  class="hour">14:30</span>
              <p data-title="Steven Spielberg - The BFG (Le Bon Gros Géant)">Steven Spielberg - The BFG (Le Bon Gros Géant)</p>
            </div>
          </div>
        </div>
      </div>
      <div class="item photocall 14-05-16 shadow-bottom photo portrait notloaded">
        <a id="photo933" class="ajax chocolat-image" data-pid="933"
           href="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/06/7d3b774b0c8ecec4b7f5dce568991b8a5bb35355.jpg"
           title='<span class="category">Photocall</span><span class="date">14.05.16 . 14:30</span><h2>Sandra Huller - Toni Erdmann</h2>'
           data-credit="Crédit Image : Dominique Charriau / Getty Images"></a>
        <img data-original="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/06/thumb_5153_media_image_320x404.jpg"  alt="" title="Sandra Huller - Toni Erdmann" class="lazy">
        <div class="picto"><i class="icon icon_photo"></i></div>
        <div class="info">
          <div class="vCenter">
            <div class="vCenterKid">
              <span class="category">Photocall</span>
              <span class="date">14.05.16</span> . <span
                  class="hour">14:30</span>
              <p data-title="Sandra Huller - Toni Erdmann">Sandra Huller - Toni Erdmann</p>
            </div>
          </div>
        </div>
      </div>
      <div class="item photocall 14-05-16 shadow-bottom photo paysage notloaded">
        <a id="photo945" class="ajax chocolat-image" data-pid="945"
           href="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/06/2651f33a3f18acf12301ea1bbe7540ccf0b92666.jpg"
           title='<span class="category">Photocall</span><span class="date">14.05.16 . 14:11</span><h2>Steven Spielberg et Ruby Barnhill - The BFG (Le Bon Gros Géant)</h2>'
           data-credit="Crédit Image : Tony Barson / Getty Images"></a>
        <img data-original="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/06/thumb_5165_media_image_640x404.jpg"  alt="" title="Steven Spielberg et Ruby Barnhill - The BFG (Le Bon Gros Géant)" class="lazy">
        <div class="picto"><i class="icon icon_photo"></i></div>
        <div class="info">
          <div class="vCenter">
            <div class="vCenterKid">
              <span class="category">Photocall</span>
              <span class="date">14.05.16</span> . <span
                  class="hour">14:11</span>
              <p data-title="Steven Spielberg et Ruby Barnhill - The BFG (Le Bon Gros Géant)">Steven Spielberg et Ruby Barnhill - The BFG (Le Bon Gros Géant)</p>
            </div>
          </div>
        </div>
      </div>
      <div class="item photocall 14-05-16 shadow-bottom photo paysage notloaded">
        <a id="photo912" class="ajax chocolat-image" data-pid="912"
           href="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/06/a31ef0ecd0e78f70188137e0980e97fc0c50ae58.JPG"
           title='<span class="category">Photocall</span><span class="date">14.05.16 . 14:10</span><h2>Ruby Barnhill - The BFG (Le Bon Gros Géant)</h2>'
           data-credit="Crédit Image : Léo Laumont / FDC"></a>
        <img data-original="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/06/thumb_5129_media_image_640x404.JPG"  alt="" title="Ruby Barnhill - The BFG (Le Bon Gros Géant)" class="lazy">
        <div class="picto"><i class="icon icon_photo"></i></div>
        <div class="info">
          <div class="vCenter">
            <div class="vCenterKid">
              <span class="category">Photocall</span>
              <span class="date">14.05.16</span> . <span
                  class="hour">14:10</span>
              <p data-title="Ruby Barnhill - The BFG (Le Bon Gros Géant)">Ruby Barnhill - The BFG (Le Bon Gros Géant)</p>
            </div>
          </div>
        </div>
      </div>
      <div class="item photocall 14-05-16 shadow-bottom photo paysage notloaded">
        <a id="photo911" class="ajax chocolat-image" data-pid="911"
           href="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/06/9b8463d63bc6d237c6b63eb533a47934d730b1de.JPG"
           title='<span class="category">Photocall</span><span class="date">14.05.16 . 14:07</span><h2>Steven Spielberg - The BFG (Le Bon Gros Géant)</h2>'
           data-credit="Crédit Image : Léo Laumont / FDC"></a>
        <img data-original="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/06/thumb_5128_media_image_640x404.JPG"  alt="" title="Steven Spielberg - The BFG (Le Bon Gros Géant)" class="lazy">
        <div class="picto"><i class="icon icon_photo"></i></div>
        <div class="info">
          <div class="vCenter">
            <div class="vCenterKid">
              <span class="category">Photocall</span>
              <span class="date">14.05.16</span> . <span
                  class="hour">14:07</span>
              <p data-title="Steven Spielberg - The BFG (Le Bon Gros Géant)">Steven Spielberg - The BFG (Le Bon Gros Géant)</p>
            </div>
          </div>
        </div>
      </div>
      <div class="item photocall 14-05-16 shadow-bottom photo paysage notloaded">
        <a id="photo908" class="ajax chocolat-image" data-pid="908"
           href="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/06/176a301cc9ecab8d34fe1efd11c700daac285f06.JPG"
           title='<span class="category">Photocall</span><span class="date">14.05.16 . 14:05</span><h2>Ruby Barnhill - The BFG (Le Bon Gros Géant)</h2>'
           data-credit="Crédit Image : Léo Laumont / FDC"></a>
        <img data-original="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/06/thumb_5126_media_image_640x404.JPG"  alt="" title="Ruby Barnhill - The BFG (Le Bon Gros Géant)" class="lazy">
        <div class="picto"><i class="icon icon_photo"></i></div>
        <div class="info">
          <div class="vCenter">
            <div class="vCenterKid">
              <span class="category">Photocall</span>
              <span class="date">14.05.16</span> . <span
                  class="hour">14:05</span>
              <p data-title="Ruby Barnhill - The BFG (Le Bon Gros Géant)">Ruby Barnhill - The BFG (Le Bon Gros Géant)</p>
            </div>
          </div>
        </div>
      </div>
      <div class="item photocall 14-05-16 shadow-bottom photo paysage notloaded">
        <a id="photo905" class="ajax chocolat-image" data-pid="905"
           href="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/06/44849ab7ada4a3773e47cf2c5b351c06f7ea55b6.JPG"
           title='<span class="category">Photocall</span><span class="date">14.05.16 . 14:03</span><h2>Jemaine Clement - The BFG (Le Bon Gros Géant)</h2>'
           data-credit="Crédit Image : Léo Laumont / FDC"></a>
        <img data-original="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/06/thumb_5123_media_image_640x404.JPG"  alt="" title="Jemaine Clement - The BFG (Le Bon Gros Géant)" class="lazy">
        <div class="picto"><i class="icon icon_photo"></i></div>
        <div class="info">
          <div class="vCenter">
            <div class="vCenterKid">
              <span class="category">Photocall</span>
              <span class="date">14.05.16</span> . <span
                  class="hour">14:03</span>
              <p data-title="Jemaine Clement - The BFG (Le Bon Gros Géant)">Jemaine Clement - The BFG (Le Bon Gros Géant)</p>
            </div>
          </div>
        </div>
      </div>
      <div class="item photocall 14-05-16 shadow-bottom photo paysage notloaded">
        <a id="photo906" class="ajax chocolat-image" data-pid="906"
           href="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/06/b91aeb6abdd0a5585fd8fbfc116d09a08b5bd101.JPG"
           title='<span class="category">Photocall</span><span class="date">14.05.16 . 14:00</span><h2>Équipe du film - The BFG (Le Bon Gros Géant)</h2>'
           data-credit="Crédit Image : Léo Laumont / FDC"></a>
        <img data-original="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/06/thumb_5124_media_image_640x404.JPG"  alt="" title="Équipe du film - The BFG (Le Bon Gros Géant)" class="lazy">
        <div class="picto"><i class="icon icon_photo"></i></div>
        <div class="info">
          <div class="vCenter">
            <div class="vCenterKid">
              <span class="category">Photocall</span>
              <span class="date">14.05.16</span> . <span
                  class="hour">14:00</span>
              <p data-title="Équipe du film - The BFG (Le Bon Gros Géant)">Équipe du film - The BFG (Le Bon Gros Géant)</p>
            </div>
          </div>
        </div>
      </div>
      <div class="item conference-de-presse 14-05-16 shadow-bottom photo paysage notloaded">
        <a id="photo894" class="ajax chocolat-image" data-pid="894"
           href="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/06/e6b2006fe380a8ff6ec7adb8cc75d020c8f64f87.jpg"
           title='<span class="category">Conférence de Presse</span><span class="date">14.05.16 . 12:49</span><h2>Équipe du film - Toni Erdmann</h2>'
           data-credit="Crédit Image : Léo Laumont / FDC"></a>
        <img data-original="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/06/thumb_5113_media_image_640x404.jpg"  alt="" title="Équipe du film - Toni Erdmann" class="lazy">
        <div class="picto"><i class="icon icon_photo"></i></div>
        <div class="info">
          <div class="vCenter">
            <div class="vCenterKid">
              <span class="category">Conférence de Presse</span>
              <span class="date">14.05.16</span> . <span
                  class="hour">12:49</span>
              <p data-title="Équipe du film - Toni Erdmann">Équipe du film - Toni Erdmann</p>
            </div>
          </div>
        </div>
      </div>
      <div class="item conference-de-presse 14-05-16 shadow-bottom photo paysage notloaded">
        <a id="photo898" class="ajax chocolat-image" data-pid="898"
           href="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/06/c29cc9631b2506ebc750506328f71dfe6f3d0dc8.jpg"
           title='<span class="category">Conférence de Presse</span><span class="date">14.05.16 . 12:47</span><h2>Maren Ade - Toni Erdmann</h2>'
           data-credit="Crédit Image : Laurent Emmanuel / AFP"></a>
        <img data-original="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/06/thumb_5118_media_image_640x404.jpg"  alt="" title="Maren Ade - Toni Erdmann" class="lazy">
        <div class="picto"><i class="icon icon_photo"></i></div>
        <div class="info">
          <div class="vCenter">
            <div class="vCenterKid">
              <span class="category">Conférence de Presse</span>
              <span class="date">14.05.16</span> . <span
                  class="hour">12:47</span>
              <p data-title="Maren Ade - Toni Erdmann">Maren Ade - Toni Erdmann</p>
            </div>
          </div>
        </div>
      </div>
      <div class="item photocall 14-05-16 shadow-bottom photo paysage notloaded">
        <a id="photo890" class="ajax chocolat-image" data-pid="890"
           href="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/06/f62db33d9e1c04938505e227fc9c131a88501e33.jpg"
           title='<span class="category">Photocall</span><span class="date">14.05.16 . 12:25</span><h2>Peter Simonischek - Toni Erdmann</h2>'
           data-credit="Crédit Image : Cyril Duchêne / FDC"></a>
        <img data-original="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/06/thumb_5102_media_image_640x404.jpg"  alt="" title="Peter Simonischek - Toni Erdmann" class="lazy">
        <div class="picto"><i class="icon icon_photo"></i></div>
        <div class="info">
          <div class="vCenter">
            <div class="vCenterKid">
              <span class="category">Photocall</span>
              <span class="date">14.05.16</span> . <span
                  class="hour">12:25</span>
              <p data-title="Peter Simonischek - Toni Erdmann">Peter Simonischek - Toni Erdmann</p>
            </div>
          </div>
        </div>
      </div>
      <div class="item photocall 14-05-16 shadow-bottom photo portrait notloaded">
        <a id="photo893" class="ajax chocolat-image" data-pid="893"
           href="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/06/675a9daee4f7a754f54f57b59e022b829eae7975.jpg"
           title='<span class="category">Photocall</span><span class="date">14.05.16 . 12:23</span><h2>Tsutsui Mariko - Fuchi Na Tatsu (Harmonium)</h2>'
           data-credit="Crédit Image : Thomas Leibreich / FDC"></a>
        <img data-original="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/06/thumb_5111_media_image_320x404.jpg"  alt="" title="Tsutsui Mariko - Fuchi Na Tatsu (Harmonium)" class="lazy">
        <div class="picto"><i class="icon icon_photo"></i></div>
        <div class="info">
          <div class="vCenter">
            <div class="vCenterKid">
              <span class="category">Photocall</span>
              <span class="date">14.05.16</span> . <span
                  class="hour">12:23</span>
              <p data-title="Tsutsui Mariko - Fuchi Na Tatsu (Harmonium)">Tsutsui Mariko - Fuchi Na Tatsu (Harmonium)</p>
            </div>
          </div>
        </div>
      </div>
      <div class="item conference-de-presse 14-05-16 shadow-bottom photo paysage notloaded">
        <a id="photo882" class="ajax chocolat-image" data-pid="882"
           href="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/06/2b45dc115868309eef09aa8d9cae89cd65fa6818.jpg"
           title='<span class="category">Conférence de Presse</span><span class="date">14.05.16 . 12:20</span><h2>Ha Jung-Woo - Mademoiselle</h2>'
           data-credit="Crédit Image : Mathilde Petit / FDC"></a>
        <img data-original="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/06/thumb_5090_media_image_640x404.jpg"  alt="" title="Ha Jung-Woo - Mademoiselle" class="lazy">
        <div class="picto"><i class="icon icon_photo"></i></div>
        <div class="info">
          <div class="vCenter">
            <div class="vCenterKid">
              <span class="category">Conférence de Presse</span>
              <span class="date">14.05.16</span> . <span
                  class="hour">12:20</span>
              <p data-title="Ha Jung-Woo - Mademoiselle">Ha Jung-Woo - Mademoiselle</p>
            </div>
          </div>
        </div>
      </div>
      <div class="item photocall 14-05-16 shadow-bottom photo paysage notloaded">
        <a id="photo892" class="ajax chocolat-image" data-pid="892"
           href="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/06/9e2a3393bb22bd212d8f4f1fa4886728d6da2d86.JPG"
           title='<span class="category">Photocall</span><span class="date">14.05.16 . 12:15</span><h2>Kanji Furutachi, Tsutsui Mariko et Koji Fukada - Fuchi Ni Tatsu (Harmonium)</h2>'
           data-credit="Crédit Image : Thomas Leibreich / FDC"></a>
        <img data-original="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/06/thumb_5100_media_image_640x404.JPG"  alt="" title="Kanji Furutachi, Tsutsui Mariko et Koji Fukada - Fuchi Ni Tatsu (Harmonium)" class="lazy">
        <div class="picto"><i class="icon icon_photo"></i></div>
        <div class="info">
          <div class="vCenter">
            <div class="vCenterKid">
              <span class="category">Photocall</span>
              <span class="date">14.05.16</span> . <span
                  class="hour">12:15</span>
              <p data-title="Kanji Furutachi, Tsutsui Mariko et Koji Fukada - Fuchi Ni Tatsu (Harmonium)">Kanji Furutachi, Tsutsui Mariko et Koji Fukada - Fuchi Ni Tatsu (Harmonium)</p>
            </div>
          </div>
        </div>
      </div>
      <div class="item photocall 14-05-16 shadow-bottom photo portrait notloaded">
        <a id="photo889" class="ajax chocolat-image" data-pid="889"
           href="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/06/4f40ca35c9651c67402f9449bbad40aeb025a5c4.jpg"
           title='<span class="category">Photocall</span><span class="date">14.05.16 . 12:03</span><h2>Sandra Huller - Toni Erdmann</h2>'
           data-credit="Crédit Image : Thomas Leibreich / FDC"></a>
        <img data-original="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/06/thumb_5099_media_image_320x404.jpg"  alt="" title="Sandra Huller - Toni Erdmann" class="lazy">
        <div class="picto"><i class="icon icon_photo"></i></div>
        <div class="info">
          <div class="vCenter">
            <div class="vCenterKid">
              <span class="category">Photocall</span>
              <span class="date">14.05.16</span> . <span
                  class="hour">12:03</span>
              <p data-title="Sandra Huller - Toni Erdmann">Sandra Huller - Toni Erdmann</p>
            </div>
          </div>
        </div>
      </div>
      <div class="item photocall 14-05-16 shadow-bottom photo paysage notloaded">
        <a id="photo887" class="ajax chocolat-image" data-pid="887"
           href="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/06/09323436bd6d617058dce678a0c9f9f7277ea5f1.jpg"
           title='<span class="category">Photocall</span><span class="date">14.05.16 . 12:00</span><h2>Équipe du film - Toni Erdmann</h2>'
           data-credit="Crédit Image : Thomas Leibreich / FDC"></a>
        <img data-original="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/06/thumb_5095_media_image_640x404.jpg"  alt="" title="Équipe du film - Toni Erdmann" class="lazy">
        <div class="picto"><i class="icon icon_photo"></i></div>
        <div class="info">
          <div class="vCenter">
            <div class="vCenterKid">
              <span class="category">Photocall</span>
              <span class="date">14.05.16</span> . <span
                  class="hour">12:00</span>
              <p data-title="Équipe du film - Toni Erdmann">Équipe du film - Toni Erdmann</p>
            </div>
          </div>
        </div>
      </div>
      <div class="item sur-scene 14-05-16 shadow-bottom photo paysage notloaded">
        <a id="photo879" class="ajax chocolat-image" data-pid="879"
           href="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/06/e8d7d04bbd8eb9c4ed901a03b9dde08cd705d778.JPG"
           title='<span class="category">Sur Scène</span><span class="date">14.05.16 . 11:35</span><h2>Équipe du film - Transfiguration</h2>'
           data-credit="Crédit Image : Cyril Duchêne / FDC"></a>
        <img data-original="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/06/thumb_5087_media_image_640x404.JPG"  alt="" title="Équipe du film - Transfiguration" class="lazy">
        <div class="picto"><i class="icon icon_photo"></i></div>
        <div class="info">
          <div class="vCenter">
            <div class="vCenterKid">
              <span class="category">Sur Scène</span>
              <span class="date">14.05.16</span> . <span
                  class="hour">11:35</span>
              <p data-title="Équipe du film - Transfiguration">Équipe du film - Transfiguration</p>
            </div>
          </div>
        </div>
      </div>
      <div class="item montee-des-marches 14-05-16 shadow-bottom photo paysage notloaded">
        <a id="photo878" class="ajax chocolat-image" data-pid="878"
           href="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/06/66c8051acdfa589be10c18ff2b08148cc758b378.jpg"
           title='<span class="category">Montée des Marches</span><span class="date">14.05.16 . 11:33</span><h2>Équipe du film - The Transfiguration</h2>'
           data-credit="Crédit Image : Léo Laumont / FDC"></a>
        <img data-original="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/06/thumb_5094_media_image_640x404.jpg"  alt="" title="Équipe du film - The Transfiguration" class="lazy">
        <div class="picto"><i class="icon icon_photo"></i></div>
        <div class="info">
          <div class="vCenter">
            <div class="vCenterKid">
              <span class="category">Montée des Marches</span>
              <span class="date">14.05.16</span> . <span
                  class="hour">11:33</span>
              <p data-title="Équipe du film - The Transfiguration">Équipe du film - The Transfiguration</p>
            </div>
          </div>
        </div>
      </div>
      <div class="item montee-des-marches 14-05-16 shadow-bottom photo paysage notloaded">
        <a id="photo877" class="ajax chocolat-image" data-pid="877"
           href="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/06/e9056f95cad1cb3bef5c0bffd46d96c607074e2b.jpg"
           title='<span class="category">Montée des Marches</span><span class="date">14.05.16 . 11:30</span><h2>Équipe du film - The Transfiguration</h2>'
           data-credit="Crédit Image : Léo Laumont / FDC"></a>
        <img data-original="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/06/thumb_5085_media_image_640x404.jpg"  alt="" title="Équipe du film - The Transfiguration" class="lazy">
        <div class="picto"><i class="icon icon_photo"></i></div>
        <div class="info">
          <div class="vCenter">
            <div class="vCenterKid">
              <span class="category">Montée des Marches</span>
              <span class="date">14.05.16</span> . <span
                  class="hour">11:30</span>
              <p data-title="Équipe du film - The Transfiguration">Équipe du film - The Transfiguration</p>
            </div>
          </div>
        </div>
      </div>
      <div class="item conference-de-presse 14-05-16 shadow-bottom photo paysage notloaded">
        <a id="photo885" class="ajax chocolat-image" data-pid="885"
           href="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/06/d543259462969d33daf511f2e402c6f5d64a7bb8.jpg"
           title='<span class="category">Conférence de Presse</span><span class="date">14.05.16 . 11:23</span><h2>Park Chan-Wook, Kim Tae-Ri et Jo Jing-Woong - Mademoiselle</h2>'
           data-credit="Crédit Image : Mathilde Petit / FDC"></a>
        <img data-original="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/06/thumb_5092_media_image_640x404.jpg"  alt="" title="Park Chan-Wook, Kim Tae-Ri et Jo Jing-Woong - Mademoiselle" class="lazy">
        <div class="picto"><i class="icon icon_photo"></i></div>
        <div class="info">
          <div class="vCenter">
            <div class="vCenterKid">
              <span class="category">Conférence de Presse</span>
              <span class="date">14.05.16</span> . <span
                  class="hour">11:23</span>
              <p data-title="Park Chan-Wook, Kim Tae-Ri et Jo Jing-Woong - Mademoiselle">Park Chan-Wook, Kim Tae-Ri et Jo Jing-Woong - Mademoiselle</p>
            </div>
          </div>
        </div>
      </div>
      <div class="item photocall 14-05-16 shadow-bottom photo paysage notloaded">
        <a id="photo872" class="ajax chocolat-image" data-pid="872"
           href="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/06/212368cf8af925e49c4b208208ca9ab5939da7b3.JPG"
           title='<span class="category">Photocall</span><span class="date">14.05.16 . 11:15</span><h2>Équipe du film - Bu San Haeng (Train to Busan)</h2>'
           data-credit="Crédit Image : Mathilde Petit / FDC"></a>
        <img data-original="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/06/thumb_5081_media_image_640x404.JPG"  alt="" title="Équipe du film - Bu San Haeng (Train to Busan)" class="lazy">
        <div class="picto"><i class="icon icon_photo"></i></div>
        <div class="info">
          <div class="vCenter">
            <div class="vCenterKid">
              <span class="category">Photocall</span>
              <span class="date">14.05.16</span> . <span
                  class="hour">11:15</span>
              <p data-title="Équipe du film - Bu San Haeng (Train to Busan)">Équipe du film - Bu San Haeng (Train to Busan)</p>
            </div>
          </div>
        </div>
      </div>
      <div class="item photocall 14-05-16 shadow-bottom photo paysage notloaded">
        <a id="photo871" class="ajax chocolat-image" data-pid="871"
           href="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/06/42a3155023eb90195f3a4fe0fe380623433a2be9.JPG"
           title='<span class="category">Photocall</span><span class="date">14.05.16 . 11:13</span><h2>Jung Yu-Mi - Bu San Haeng (Train to Busan)</h2>'
           data-credit="Crédit Image : Mathilde Petit / FDC"></a>
        <img data-original="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/06/thumb_5080_media_image_640x404.JPG"  alt="" title="Jung Yu-Mi - Bu San Haeng (Train to Busan)" class="lazy">
        <div class="picto"><i class="icon icon_photo"></i></div>
        <div class="info">
          <div class="vCenter">
            <div class="vCenterKid">
              <span class="category">Photocall</span>
              <span class="date">14.05.16</span> . <span
                  class="hour">11:13</span>
              <p data-title="Jung Yu-Mi - Bu San Haeng (Train to Busan)">Jung Yu-Mi - Bu San Haeng (Train to Busan)</p>
            </div>
          </div>
        </div>
      </div>
      <div class="item photocall 14-05-16 shadow-bottom photo paysage notloaded">
        <a id="photo870" class="ajax chocolat-image" data-pid="870"
           href="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/06/e544e1d9c8739b39d56020276ce528e7adc5d64f.JPG"
           title='<span class="category">Photocall</span><span class="date">14.05.16 . 11:10</span><h2>Gong Yoo - Bu San Haeng (Train to Busan)</h2>'
           data-credit="Crédit Image : Mathilde Petit / FDC"></a>
        <img data-original="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/06/thumb_5079_media_image_640x404.JPG"  alt="" title="Gong Yoo - Bu San Haeng (Train to Busan)" class="lazy">
        <div class="picto"><i class="icon icon_photo"></i></div>
        <div class="info">
          <div class="vCenter">
            <div class="vCenterKid">
              <span class="category">Photocall</span>
              <span class="date">14.05.16</span> . <span
                  class="hour">11:10</span>
              <p data-title="Gong Yoo - Bu San Haeng (Train to Busan)">Gong Yoo - Bu San Haeng (Train to Busan)</p>
            </div>
          </div>
        </div>
      </div>
      <div class="item photocall 14-05-16 shadow-bottom photo paysage notloaded">
        <a id="photo876" class="ajax chocolat-image" data-pid="876"
           href="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/06/d26680292b8b567c4d0336f8cda2512e45a1cca9.jpg"
           title='<span class="category">Photocall</span><span class="date">14.05.16 . 11:09</span><h2>Park Chan Wook - Mademoiselle</h2>'
           data-credit="Crédit Image : Thomas Leibreich / FDC"></a>
        <img data-original="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/06/thumb_5084_media_image_640x404.jpg"  alt="" title="Park Chan Wook - Mademoiselle" class="lazy">
        <div class="picto"><i class="icon icon_photo"></i></div>
        <div class="info">
          <div class="vCenter">
            <div class="vCenterKid">
              <span class="category">Photocall</span>
              <span class="date">14.05.16</span> . <span
                  class="hour">11:09</span>
              <p data-title="Park Chan Wook - Mademoiselle">Park Chan Wook - Mademoiselle</p>
            </div>
          </div>
        </div>
      </div>
      <div class="item photocall 14-05-16 shadow-bottom photo paysage notloaded">
        <a id="photo873" class="ajax chocolat-image" data-pid="873"
           href="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/06/fdc3583e76c2c4296ece9960b52cd60ad4dcae49.jpg"
           title='<span class="category">Photocall</span><span class="date">14.05.16 . 11:08</span><h2>Kim Tae-Ri - Mademoiselle</h2>'
           data-credit="Crédit Image : Thomas Leibreich / FDC"></a>
        <img data-original="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/06/thumb_5082_media_image_640x404.jpg"  alt="" title="Kim Tae-Ri - Mademoiselle" class="lazy">
        <div class="picto"><i class="icon icon_photo"></i></div>
        <div class="info">
          <div class="vCenter">
            <div class="vCenterKid">
              <span class="category">Photocall</span>
              <span class="date">14.05.16</span> . <span
                  class="hour">11:08</span>
              <p data-title="Kim Tae-Ri - Mademoiselle">Kim Tae-Ri - Mademoiselle</p>
            </div>
          </div>
        </div>
      </div>
      <div class="item photocall 14-05-16 shadow-bottom photo portrait notloaded">
        <a id="photo867" class="ajax chocolat-image" data-pid="867"
           href="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/06/f3b0c882adb53df6dd0d13c48c71591141025fb2.jpg"
           title='<span class="category">Photocall</span><span class="date">14.05.16 . 11:07</span><h2>Kim Tae-Ri et Kim Min-Hee - Mademoiselle</h2>'
           data-credit="Crédit Image : Mathilde Petit / FDC"></a>
        <img data-original="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/06/thumb_5077_media_image_320x404.jpg"  alt="" title="Kim Tae-Ri et Kim Min-Hee - Mademoiselle" class="lazy">
        <div class="picto"><i class="icon icon_photo"></i></div>
        <div class="info">
          <div class="vCenter">
            <div class="vCenterKid">
              <span class="category">Photocall</span>
              <span class="date">14.05.16</span> . <span
                  class="hour">11:07</span>
              <p data-title="Kim Tae-Ri et Kim Min-Hee - Mademoiselle">Kim Tae-Ri et Kim Min-Hee - Mademoiselle</p>
            </div>
          </div>
        </div>
      </div>
      <div class="item photocall 14-05-16 shadow-bottom photo paysage notloaded">
        <a id="photo902" class="ajax chocolat-image" data-pid="902"
           href="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/06/3a77e00bc1ad6ae06de5f2f0e7284063b56c0085.JPG"
           title='<span class="category">Photocall</span><span class="date">14.05.16 . 11:07</span><h2>Michael O&#039;Shea et Susan Leber - The Transfiguration</h2>'
           data-credit="Crédit Image : Mathilde Petit / FDC"></a>
        <img data-original="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/06/thumb_5121_media_image_640x404.JPG"  alt="" title="Michael O&#039;Shea et Susan Leber - The Transfiguration" class="lazy">
        <div class="picto"><i class="icon icon_photo"></i></div>
        <div class="info">
          <div class="vCenter">
            <div class="vCenterKid">
              <span class="category">Photocall</span>
              <span class="date">14.05.16</span> . <span
                  class="hour">11:07</span>
              <p data-title="Michael O&#039;Shea et Susan Leber - The Transfiguration">Michael O&#039;Shea et Susan Leber - The Transfiguration</p>
            </div>
          </div>
        </div>
      </div>
      <div class="item photocall 14-05-16 shadow-bottom photo paysage notloaded">
        <a id="photo866" class="ajax chocolat-image" data-pid="866"
           href="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/06/628e4c0f23638468ee46c0c0e60efd2b418ba51d.jpg"
           title='<span class="category">Photocall</span><span class="date">14.05.16 . 11:05</span><h2>Cho Jin-Woong, Park Chan-Wook et Ha Jung-Woo - Mademoiselle</h2>'
           data-credit="Crédit Image : Mathilde Petit / FDC"></a>
        <img data-original="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/06/thumb_5076_media_image_640x404.jpg"  alt="" title="Cho Jin-Woong, Park Chan-Wook et Ha Jung-Woo - Mademoiselle" class="lazy">
        <div class="picto"><i class="icon icon_photo"></i></div>
        <div class="info">
          <div class="vCenter">
            <div class="vCenterKid">
              <span class="category">Photocall</span>
              <span class="date">14.05.16</span> . <span
                  class="hour">11:05</span>
              <p data-title="Cho Jin-Woong, Park Chan-Wook et Ha Jung-Woo - Mademoiselle">Cho Jin-Woong, Park Chan-Wook et Ha Jung-Woo - Mademoiselle</p>
            </div>
          </div>
        </div>
      </div>
      <div class="item photocall 14-05-16 shadow-bottom photo paysage notloaded">
        <a id="photo865" class="ajax chocolat-image" data-pid="865"
           href="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/06/5759023f80611763e56d26a2b8325515fba07590.jpg"
           title='<span class="category">Photocall</span><span class="date">14.05.16 . 11:00</span><h2>Équipe du film - Mademoiselle</h2>'
           data-credit="Crédit Image : Mathilde Petit / FDC"></a>
        <img data-original="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/06/thumb_5075_media_image_640x404.jpg"  alt="" title="Équipe du film - Mademoiselle" class="lazy">
        <div class="picto"><i class="icon icon_photo"></i></div>
        <div class="info">
          <div class="vCenter">
            <div class="vCenterKid">
              <span class="category">Photocall</span>
              <span class="date">14.05.16</span> . <span
                  class="hour">11:00</span>
              <p data-title="Équipe du film - Mademoiselle">Équipe du film - Mademoiselle</p>
            </div>
          </div>
        </div>
      </div>
      <div class="item oeil-du-photographe 14-05-16 shadow-bottom photo paysage notloaded">
        <a id="photo822" class="ajax chocolat-image" data-pid="822"
           href="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/06/eed8cb4f1f994947e1f59d6eccbb796cdeca6799.jpg"
           title='<span class="category">Œil du photographe</span><span class="date">14.05.16 . 09:00</span><h2>Conférence de presse du film de Jodie Foster, Money Monster</h2>'
           data-credit="Crédit Image : Julien Mignot"></a>
        <img data-original="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/06/thumb_5039_media_image_640x404.jpg"  alt="Conférence de presse du film de Jodie Foster, Money Monster" title="Conférence de presse du film de Jodie Foster, Money Monster" class="lazy">
        <div class="picto"><i class="icon icon_photo"></i></div>
        <div class="info">
          <div class="vCenter">
            <div class="vCenterKid">
              <span class="category">Œil du photographe</span>
              <span class="date">14.05.16</span> . <span
                  class="hour">09:00</span>
              <p data-title="Conférence de presse du film de Jodie Foster, Money Monster">Conférence de presse du film de Jodie Foster, Money Monster</p>
            </div>
          </div>
        </div>
      </div>
      <div class="item oeil-du-photographe 14-05-16 shadow-bottom photo paysage notloaded">
        <a id="photo823" class="ajax chocolat-image" data-pid="823"
           href="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/06/bd55b022cb65ffdd723b9f94d42aae5a125c4c81.jpg"
           title='<span class="category">Œil du photographe</span><span class="date">14.05.16 . 09:00</span><h2>Valeria Golino</h2>'
           data-credit="Crédit Image : Julien Mignot"></a>
        <img data-original="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/06/thumb_5041_media_image_640x404.jpg"  alt="Valeria Golino" title="Valeria Golino" class="lazy">
        <div class="picto"><i class="icon icon_photo"></i></div>
        <div class="info">
          <div class="vCenter">
            <div class="vCenterKid">
              <span class="category">Œil du photographe</span>
              <span class="date">14.05.16</span> . <span
                  class="hour">09:00</span>
              <p data-title="Valeria Golino">Valeria Golino</p>
            </div>
          </div>
        </div>
      </div>
      <div class="item oeil-du-photographe 14-05-16 shadow-bottom photo portrait notloaded">
        <a id="photo825" class="ajax chocolat-image" data-pid="825"
           href="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/06/1d9e7c4808a23fb3900bfeb8aa2d3811ad9a80f2.jpg"
           title='<span class="category">Œil du photographe</span><span class="date">14.05.16 . 09:00</span><h2>Paul Verhoeven</h2>'
           data-credit="Crédit Image : Julien Mignot"></a>
        <img data-original="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/06/thumb_5044_media_image_320x404.jpg"  alt="Paul Verhoeven" title="Paul Verhoeven" class="lazy">
        <div class="picto"><i class="icon icon_photo"></i></div>
        <div class="info">
          <div class="vCenter">
            <div class="vCenterKid">
              <span class="category">Œil du photographe</span>
              <span class="date">14.05.16</span> . <span
                  class="hour">09:00</span>
              <p data-title="Paul Verhoeven">Paul Verhoeven</p>
            </div>
          </div>
        </div>
      </div>
      <div class="item oeil-du-photographe 14-05-16 shadow-bottom photo paysage notloaded">
        <a id="photo827" class="ajax chocolat-image" data-pid="827"
           href="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/06/194a588dec4c4953ad1a98d6d920a1e798bc5c65.jpg"
           title='<span class="category">Œil du photographe</span><span class="date">14.05.16 . 09:00</span><h2>La Croisette</h2>'
           data-credit="Crédit Image : Julien Mignot"></a>
        <img data-original="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/06/thumb_5046_media_image_640x404.jpg"  alt="La Croisette" title="La Croisette" class="lazy">
        <div class="picto"><i class="icon icon_photo"></i></div>
        <div class="info">
          <div class="vCenter">
            <div class="vCenterKid">
              <span class="category">Œil du photographe</span>
              <span class="date">14.05.16</span> . <span
                  class="hour">09:00</span>
              <p data-title="La Croisette">La Croisette</p>
            </div>
          </div>
        </div>
      </div>
      <div class="item oeil-du-photographe 14-05-16 shadow-bottom photo paysage notloaded">
        <a id="photo828" class="ajax chocolat-image" data-pid="828"
           href="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/06/33692399bf209bc2acd9f0e2ff3c848723b69b45.jpg"
           title='<span class="category">Œil du photographe</span><span class="date">14.05.16 . 09:00</span><h2>Soirée Chopard</h2>'
           data-credit="Crédit Image : Julien Mignot"></a>
        <img data-original="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/06/thumb_5047_media_image_640x404.jpg"  alt="Soirée Chopard" title="Soirée Chopard" class="lazy">
        <div class="picto"><i class="icon icon_photo"></i></div>
        <div class="info">
          <div class="vCenter">
            <div class="vCenterKid">
              <span class="category">Œil du photographe</span>
              <span class="date">14.05.16</span> . <span
                  class="hour">09:00</span>
              <p data-title="Soirée Chopard">Soirée Chopard</p>
            </div>
          </div>
        </div>
      </div>
      <div class="item oeil-du-photographe 14-05-16 shadow-bottom photo paysage notloaded">
        <a id="photo829" class="ajax chocolat-image" data-pid="829"
           href="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/06/25e290147a589abb7550e1ba506dcb6da43f58dd.jpg"
           title='<span class="category">Œil du photographe</span><span class="date">14.05.16 . 09:00</span><h2>Soirée Chopard</h2>'
           data-credit="Crédit Image : Julien Mignot"></a>
        <img data-original="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/06/thumb_5048_media_image_640x404.jpg"  alt="Soirée Chopard" title="Soirée Chopard" class="lazy">
        <div class="picto"><i class="icon icon_photo"></i></div>
        <div class="info">
          <div class="vCenter">
            <div class="vCenterKid">
              <span class="category">Œil du photographe</span>
              <span class="date">14.05.16</span> . <span
                  class="hour">09:00</span>
              <p data-title="Soirée Chopard">Soirée Chopard</p>
            </div>
          </div>
        </div>
      </div>
      <div class="item oeil-du-photographe 14-05-16 shadow-bottom photo portrait notloaded">
        <a id="photo831" class="ajax chocolat-image" data-pid="831"
           href="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/06/2cf117ec51b0a74103b9de357d02cb9a062b92f8.jpg"
           title='<span class="category">Œil du photographe</span><span class="date">14.05.16 . 09:00</span><h2>Damien Bonnard, Rester Vertical</h2>'
           data-credit="Crédit Image : Julien Mignot"></a>
        <img data-original="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/06/thumb_5050_media_image_320x404.jpg"  alt="Damien Bonnard, Rester Vertical" title="Damien Bonnard, Rester Vertical" class="lazy">
        <div class="picto"><i class="icon icon_photo"></i></div>
        <div class="info">
          <div class="vCenter">
            <div class="vCenterKid">
              <span class="category">Œil du photographe</span>
              <span class="date">14.05.16</span> . <span
                  class="hour">09:00</span>
              <p data-title="Damien Bonnard, Rester Vertical">Damien Bonnard, Rester Vertical</p>
            </div>
          </div>
        </div>
      </div>
      <div class="item oeil-du-photographe 14-05-16 shadow-bottom photo paysage notloaded">
        <a id="photo833" class="ajax chocolat-image" data-pid="833"
           href="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/06/841286b43d37bed924688e8b8a9f594d65161eb4.jpg"
           title='<span class="category">Œil du photographe</span><span class="date">14.05.16 . 09:00</span><h2>La Croisette</h2>'
           data-credit="Crédit Image : Julien Mignot"></a>
        <img data-original="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/06/thumb_5051_media_image_640x404.jpg"  alt="La Croisette" title="La Croisette" class="lazy">
        <div class="picto"><i class="icon icon_photo"></i></div>
        <div class="info">
          <div class="vCenter">
            <div class="vCenterKid">
              <span class="category">Œil du photographe</span>
              <span class="date">14.05.16</span> . <span
                  class="hour">09:00</span>
              <p data-title="La Croisette">La Croisette</p>
            </div>
          </div>
        </div>
      </div>
      <div class="item oeil-du-photographe 14-05-16 shadow-bottom photo paysage notloaded">
        <a id="photo835" class="ajax chocolat-image" data-pid="835"
           href="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/06/33a8ed15fefed820c01f5296ec207c62a0f07757.jpg"
           title='<span class="category">Œil du photographe</span><span class="date">14.05.16 . 09:00</span><h2>La Croisette</h2>'
           data-credit="Crédit Image : Julien Mignot"></a>
        <img data-original="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/06/thumb_5053_media_image_640x404.jpg"  alt="La Croisette" title="La Croisette" class="lazy">
        <div class="picto"><i class="icon icon_photo"></i></div>
        <div class="info">
          <div class="vCenter">
            <div class="vCenterKid">
              <span class="category">Œil du photographe</span>
              <span class="date">14.05.16</span> . <span
                  class="hour">09:00</span>
              <p data-title="La Croisette">La Croisette</p>
            </div>
          </div>
        </div>
      </div>
      <div class="item oeil-du-photographe 14-05-16 shadow-bottom photo portrait notloaded">
        <a id="photo836" class="ajax chocolat-image" data-pid="836"
           href="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/06/1930ca6e8073635083e9c0ff063d00038c5e8705.jpg"
           title='<span class="category">Œil du photographe</span><span class="date">14.05.16 . 09:00</span><h2>Soko - La Danseuse</h2>'
           data-credit="Crédit Image : Julien Mignot"></a>
        <img data-original="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/06/thumb_5054_media_image_320x404.jpg"  alt="Soko - La Danceuse" title="Soko - La Danseuse" class="lazy">
        <div class="picto"><i class="icon icon_photo"></i></div>
        <div class="info">
          <div class="vCenter">
            <div class="vCenterKid">
              <span class="category">Œil du photographe</span>
              <span class="date">14.05.16</span> . <span
                  class="hour">09:00</span>
              <p data-title="Soko - La Danseuse">Soko - La Danseuse</p>
            </div>
          </div>
        </div>
      </div>
      <div class="item montee-des-marches 13-05-16 shadow-bottom photo paysage notloaded">
        <a id="photo862" class="ajax chocolat-image" data-pid="862"
           href="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/06/d19a1b5fb8c02d2418ef1ccd020cc2f541084ab5.JPG"
           title='<span class="category">Montée des Marches</span><span class="date">13.05.16 . 23:23</span><h2>Jung Yumi - Bu San Haeng (Train to Busan)</h2>'
           data-credit="Crédit Image : Mathilde Petit / FDC"></a>
        <img data-original="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/06/thumb_5074_media_image_640x404.JPG"  alt="" title="Jung Yumi - Bu San Haeng (Train to Busan)" class="lazy">
        <div class="picto"><i class="icon icon_photo"></i></div>
        <div class="info">
          <div class="vCenter">
            <div class="vCenterKid">
              <span class="category">Montée des Marches</span>
              <span class="date">13.05.16</span> . <span
                  class="hour">23:23</span>
              <p data-title="Jung Yumi - Bu San Haeng (Train to Busan)">Jung Yumi - Bu San Haeng (Train to Busan)</p>
            </div>
          </div>
        </div>
      </div>
      <div class="item montee-des-marches 13-05-16 shadow-bottom photo paysage notloaded">
        <a id="photo861" class="ajax chocolat-image" data-pid="861"
           href="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/06/165163e7f9c26d94706165ef9a897d38e31cb136.jpg"
           title='<span class="category">Montée des Marches</span><span class="date">13.05.16 . 23:15</span><h2>Équipe du film - Bu San Haeng (Train to Busan)</h2>'
           data-credit="Crédit Image : Cyril Duchêne / FDC"></a>
        <img data-original="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/06/thumb_5073_media_image_640x404.jpg"  alt="" title="Équipe du film - Bu San Haeng (Train to Busan)" class="lazy">
        <div class="picto"><i class="icon icon_photo"></i></div>
        <div class="info">
          <div class="vCenter">
            <div class="vCenterKid">
              <span class="category">Montée des Marches</span>
              <span class="date">13.05.16</span> . <span
                  class="hour">23:15</span>
              <p data-title="Équipe du film - Bu San Haeng (Train to Busan)">Équipe du film - Bu San Haeng (Train to Busan)</p>
            </div>
          </div>
        </div>
      </div>
      <div class="item sur-scene 13-05-16 shadow-bottom photo paysage notloaded">
        <a id="photo843" class="ajax chocolat-image" data-pid="843"
           href="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/06/89baf734a09dd90fe9ebf3e047eb9271f7c61e34.jpg"
           title='<span class="category">Sur Scène</span><span class="date">13.05.16 . 21:30</span><h2>Équipe du film - La Danseuse</h2>'
           data-credit="Crédit Image : Thomas Leibreich / FDC"></a>
        <img data-original="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/06/thumb_5060_media_image_640x404.jpg"  alt="" title="Équipe du film - La Danseuse" class="lazy">
        <div class="picto"><i class="icon icon_photo"></i></div>
        <div class="info">
          <div class="vCenter">
            <div class="vCenterKid">
              <span class="category">Sur Scène</span>
              <span class="date">13.05.16</span> . <span
                  class="hour">21:30</span>
              <p data-title="Équipe du film - La Danseuse">Équipe du film - La Danseuse</p>
            </div>
          </div>
        </div>
      </div>
      <div class="item montee-des-marches 13-05-16 shadow-bottom photo paysage notloaded">
        <a id="photo834" class="ajax chocolat-image" data-pid="834"
           href="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/06/0710d23199f78ca859032b2a9dd4aa0ebfede696.jpg"
           title='<span class="category">Montée des Marches</span><span class="date">13.05.16 . 20:58</span><h2>Équipe du film - I, Daniel Blake (Moi, Daniel Blake)</h2>'
           data-credit="Crédit Image : Anne-Christine Poujoulat / AFP"></a>
        <img data-original="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/06/thumb_5052_media_image_640x404.jpg"  alt="" title="Équipe du film - I, Daniel Blake (Moi, Daniel Blake)" class="lazy">
        <div class="picto"><i class="icon icon_photo"></i></div>
        <div class="info">
          <div class="vCenter">
            <div class="vCenterKid">
              <span class="category">Montée des Marches</span>
              <span class="date">13.05.16</span> . <span
                  class="hour">20:58</span>
              <p data-title="Équipe du film - I, Daniel Blake (Moi, Daniel Blake)">Équipe du film - I, Daniel Blake (Moi, Daniel Blake)</p>
            </div>
          </div>
        </div>
      </div>
      <div class="item montee-des-marches 13-05-16 shadow-bottom photo paysage notloaded">
        <a id="photo826" class="ajax chocolat-image" data-pid="826"
           href="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/06/fcfa04f7f6b9eb9e91dcb6cad338ad2ca28f0b42.jpg"
           title='<span class="category">Montée des Marches</span><span class="date">13.05.16 . 20:55</span><h2>Ken Loach - I, Daniel Blake (Moi, Daniel Blake)</h2>'
           data-credit="Crédit Image : Valéry Hache / AFP"></a>
        <img data-original="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/06/thumb_5045_media_image_640x404.jpg"  alt="" title="Ken Loach - I, Daniel Blake (Moi, Daniel Blake)" class="lazy">
        <div class="picto"><i class="icon icon_photo"></i></div>
        <div class="info">
          <div class="vCenter">
            <div class="vCenterKid">
              <span class="category">Montée des Marches</span>
              <span class="date">13.05.16</span> . <span
                  class="hour">20:55</span>
              <p data-title="Ken Loach - I, Daniel Blake (Moi, Daniel Blake)">Ken Loach - I, Daniel Blake (Moi, Daniel Blake)</p>
            </div>
          </div>
        </div>
      </div>
      <div class="item montee-des-marches 13-05-16 shadow-bottom photo paysage notloaded">
        <a id="photo820" class="ajax chocolat-image" data-pid="820"
           href="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/06/4a0a0b7bb9ef47115096e69a8f9310a0954d87c3.jpg"
           title='<span class="category">Montée des Marches</span><span class="date">13.05.16 . 20:45</span><h2>Équipe du film -La Danseuse</h2>'
           data-credit="Crédit Image : Valéry Hache / AFP"></a>
        <img data-original="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/06/thumb_5040_media_image_640x404.jpg"  alt="" title="Équipe du film -La Danseuse" class="lazy">
        <div class="picto"><i class="icon icon_photo"></i></div>
        <div class="info">
          <div class="vCenter">
            <div class="vCenterKid">
              <span class="category">Montée des Marches</span>
              <span class="date">13.05.16</span> . <span
                  class="hour">20:45</span>
              <p data-title="Équipe du film -La Danseuse">Équipe du film -La Danseuse</p>
            </div>
          </div>
        </div>
      </div>
      <div class="item montee-des-marches 13-05-16 shadow-bottom photo paysage notloaded">
        <a id="photo844" class="ajax chocolat-image" data-pid="844"
           href="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/06/72951dd45cd24bc50baf6ab8912ffc6dd54fb004.jpg"
           title='<span class="category">Montée des Marches</span><span class="date">13.05.16 . 20:35</span><h2>Marthe Keller</h2>'
           data-credit="Crédit Image : Cyril Duchêne / FDC"></a>
        <img data-original="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/06/thumb_5061_media_image_640x404.jpg"  alt="" title="Marthe Keller" class="lazy">
        <div class="picto"><i class="icon icon_photo"></i></div>
        <div class="info">
          <div class="vCenter">
            <div class="vCenterKid">
              <span class="category">Montée des Marches</span>
              <span class="date">13.05.16</span> . <span
                  class="hour">20:35</span>
              <p data-title="Marthe Keller">Marthe Keller</p>
            </div>
          </div>
        </div>
      </div>
      <div class="item montee-des-marches 13-05-16 shadow-bottom photo paysage notloaded">
        <a id="photo819" class="ajax chocolat-image" data-pid="819"
           href="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/06/031bfe4514b31888743e5f5f1ad2ce968738eebc.jpg"
           title='<span class="category">Montée des Marches</span><span class="date">13.05.16 . 20:00</span><h2>Louis-Do de Lencquesaing, Lily-Rose Depp, Stephanie Sokolinski aka Soko, Stephanie Di Giusto et Thierry Fremaux - La Danseuse</h2>'
           data-credit="Crédit Image : Antonin Thuillier / AFP"></a>
        <img data-original="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/06/thumb_5038_media_image_640x404.jpg"  alt="" title="Louis-Do de Lencquesaing, Lily-Rose Depp, Stephanie Sokolinski aka Soko, Stephanie Di Giusto et Thierry Fremaux - La Danseuse" class="lazy">
        <div class="picto"><i class="icon icon_photo"></i></div>
        <div class="info">
          <div class="vCenter">
            <div class="vCenterKid">
              <span class="category">Montée des Marches</span>
              <span class="date">13.05.16</span> . <span
                  class="hour">20:00</span>
              <p data-title="Louis-Do de Lencquesaing, Lily-Rose Depp, Stephanie Sokolinski aka Soko, Stephanie Di Giusto et Thierry Fremaux - La Danseuse">Louis-Do de Lencquesaing, Lily-Rose Depp, Stephanie Sokolinski aka Soko, Stephanie Di Giusto et Thierry Fremaux - La Danseuse</p>
            </div>
          </div>
        </div>
      </div>
      <div class="item montee-des-marches 13-05-16 shadow-bottom photo portrait notloaded">
        <a id="photo813" class="ajax chocolat-image" data-pid="813"
           href="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/06/310e617891a564dcb0d2b0e69a6826e811f70cdc.jpg"
           title='<span class="category">Montée des Marches</span><span class="date">13.05.16 . 19:20</span><h2>Lola Bessis</h2>'
           data-credit="Crédit Image : Venturelli / Getty Images"></a>
        <img data-original="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/06/thumb_5029_media_image_320x404.jpg"  alt="" title="Lola Bessis" class="lazy">
        <div class="picto"><i class="icon icon_photo"></i></div>
        <div class="info">
          <div class="vCenter">
            <div class="vCenterKid">
              <span class="category">Montée des Marches</span>
              <span class="date">13.05.16</span> . <span
                  class="hour">19:20</span>
              <p data-title="Lola Bessis">Lola Bessis</p>
            </div>
          </div>
        </div>
      </div>
      <div class="item montee-des-marches 13-05-16 shadow-bottom photo portrait notloaded">
        <a id="photo814" class="ajax chocolat-image" data-pid="814"
           href="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/06/86b3e4d72ad0b2ce8acfc58eba81c4231e9eb839.jpg"
           title='<span class="category">Montée des Marches</span><span class="date">13.05.16 . 19:00</span><h2>Jean-Michel Jarre</h2>'
           data-credit="Crédit Image : Dominique Charriau / Getty Images"></a>
        <img data-original="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/06/thumb_5030_media_image_320x404.jpg"  alt="" title="Jean-Michel Jarre" class="lazy">
        <div class="picto"><i class="icon icon_photo"></i></div>
        <div class="info">
          <div class="vCenter">
            <div class="vCenterKid">
              <span class="category">Montée des Marches</span>
              <span class="date">13.05.16</span> . <span
                  class="hour">19:00</span>
              <p data-title="Jean-Michel Jarre">Jean-Michel Jarre</p>
            </div>
          </div>
        </div>
      </div>
      <div class="item montee-des-marches 13-05-16 shadow-bottom photo portrait notloaded">
        <a id="photo817" class="ajax chocolat-image" data-pid="817"
           href="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/06/214a04cd3d34c90a4dc4afc9de60285b13a18364.jpg"
           title='<span class="category">Montée des Marches</span><span class="date">13.05.16 . 18:45</span><h2>Costa Gavras</h2>'
           data-credit="Crédit Image : Anne-Christine Poujoulat / AFP"></a>
        <img data-original="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/06/thumb_5032_media_image_320x404.jpg"  alt="" title="Costa Gavras" class="lazy">
        <div class="picto"><i class="icon icon_photo"></i></div>
        <div class="info">
          <div class="vCenter">
            <div class="vCenterKid">
              <span class="category">Montée des Marches</span>
              <span class="date">13.05.16</span> . <span
                  class="hour">18:45</span>
              <p data-title="Costa Gavras">Costa Gavras</p>
            </div>
          </div>
        </div>
      </div>
      <div class="item montee-des-marches 13-05-16 shadow-bottom photo paysage notloaded">
        <a id="photo830" class="ajax chocolat-image" data-pid="830"
           href="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/06/40dd6308f5962e01b21e2003fdd5007fdf9ae15c.jpg"
           title='<span class="category">Montée des Marches</span><span class="date">13.05.16 . 18:43</span><h2>Juliette Binoche et Valeria Bruni Tedeschi - Ma Loute</h2>'
           data-credit="Crédit Image : Anne-Christine Poujoulat / AFP"></a>
        <img data-original="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/06/thumb_5049_media_image_640x404.jpg"  alt="" title="Juliette Binoche et Valeria Bruni Tedeschi - Ma Loute" class="lazy">
        <div class="picto"><i class="icon icon_photo"></i></div>
        <div class="info">
          <div class="vCenter">
            <div class="vCenterKid">
              <span class="category">Montée des Marches</span>
              <span class="date">13.05.16</span> . <span
                  class="hour">18:43</span>
              <p data-title="Juliette Binoche et Valeria Bruni Tedeschi - Ma Loute">Juliette Binoche et Valeria Bruni Tedeschi - Ma Loute</p>
            </div>
          </div>
        </div>
      </div>
      <div class="item montee-des-marches 13-05-16 shadow-bottom photo paysage notloaded">
        <a id="photo810" class="ajax chocolat-image" data-pid="810"
           href="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/06/50a440d3422943f8fc0119e9306ec0fa696de3a0.jpg"
           title='<span class="category">Montée des Marches</span><span class="date">13.05.16 . 18:40</span><h2>Raph, Fabrice Luchini, Valeria Bruni Tedeschi et Juliette Binoche - Ma Loute</h2>'
           data-credit="Crédit Image : Valéry Hache / AFP"></a>
        <img data-original="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/06/thumb_5042_media_image_640x404.jpg"  alt="" title="Raph, Fabrice Luchini, Valeria Bruni Tedeschi et Juliette Binoche - Ma Loute" class="lazy">
        <div class="picto"><i class="icon icon_photo"></i></div>
        <div class="info">
          <div class="vCenter">
            <div class="vCenterKid">
              <span class="category">Montée des Marches</span>
              <span class="date">13.05.16</span> . <span
                  class="hour">18:40</span>
              <p data-title="Raph, Fabrice Luchini, Valeria Bruni Tedeschi et Juliette Binoche - Ma Loute">Raph, Fabrice Luchini, Valeria Bruni Tedeschi et Juliette Binoche - Ma Loute</p>
            </div>
          </div>
        </div>
      </div>
      <div class="item montee-des-marches 13-05-16 shadow-bottom photo paysage notloaded">
        <a id="photo808" class="ajax chocolat-image" data-pid="808"
           href="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/06/817c8c79fd27d8f37a8ba4a18692520faa32c438.jpg"
           title='<span class="category">Montée des Marches</span><span class="date">13.05.16 . 18:28</span><h2>Équipe du film - Ma Loute</h2>'
           data-credit="Crédit Image : Valéry Hache / AFP"></a>
        <img data-original="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/06/thumb_5024_media_image_640x404.jpg"  alt="" title="Équipe du film - Ma Loute" class="lazy">
        <div class="picto"><i class="icon icon_photo"></i></div>
        <div class="info">
          <div class="vCenter">
            <div class="vCenterKid">
              <span class="category">Montée des Marches</span>
              <span class="date">13.05.16</span> . <span
                  class="hour">18:28</span>
              <p data-title="Équipe du film - Ma Loute">Équipe du film - Ma Loute</p>
            </div>
          </div>
        </div>
      </div>
      <div class="item competition 13-05-16 shadow-bottom photo portrait notloaded">
        <a id="photo807" class="ajax chocolat-image" data-pid="807"
           href="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/06/580803b6020a9d6317b6c1f403aa8435e91971ea.jpg"
           title='<span class="category">Compétition</span><span class="date">13.05.16 . 18:25</span><h2>Juliette Binoche -Ma Loute</h2>'
           data-credit="Crédit Image : Venturelli / Getty Images"></a>
        <img data-original="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/06/thumb_5023_media_image_320x404.jpg"  alt="" title="Juliette Binoche -Ma Loute" class="lazy">
        <div class="picto"><i class="icon icon_photo"></i></div>
        <div class="info">
          <div class="vCenter">
            <div class="vCenterKid">
              <span class="category">Compétition</span>
              <span class="date">13.05.16</span> . <span
                  class="hour">18:25</span>
              <p data-title="Juliette Binoche -Ma Loute">Juliette Binoche -Ma Loute</p>
            </div>
          </div>
        </div>
      </div>
      <div class="item sur-scene 13-05-16 shadow-bottom photo paysage notloaded">
        <a id="photo811" class="ajax chocolat-image" data-pid="811"
           href="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/06/c1810b752c6552747b77e71afd9988277d678b7a.JPG"
           title='<span class="category">Sur Scène</span><span class="date">13.05.16 . 17:20</span><h2>Frederick Wiseman et Thierry Frémaux - Hospital</h2>'
           data-credit="Crédit Image : Thomas Leibreich / FDC"></a>
        <img data-original="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/06/thumb_5026_media_image_640x404.JPG"  alt="" title="Frederick Wiseman et Thierry Frémaux - Hospital" class="lazy">
        <div class="picto"><i class="icon icon_photo"></i></div>
        <div class="info">
          <div class="vCenter">
            <div class="vCenterKid">
              <span class="category">Sur Scène</span>
              <span class="date">13.05.16</span> . <span
                  class="hour">17:20</span>
              <p data-title="Frederick Wiseman et Thierry Frémaux - Hospital">Frederick Wiseman et Thierry Frémaux - Hospital</p>
            </div>
          </div>
        </div>
      </div>
      <div class="item montee-des-marches 13-05-16 shadow-bottom photo portrait notloaded">
        <a id="photo805" class="ajax chocolat-image" data-pid="805"
           href="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/06/f59e0938e2a206fdd3066b05d2ff65af83a3267d.jpg"
           title='<span class="category">Montée des Marches</span><span class="date">13.05.16 . 15:30</span><h2>Jean-Paul Rouve</h2>'
           data-credit="Crédit Image : Valéry Hache / AFP"></a>
        <img data-original="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/06/thumb_5020_media_image_320x404.jpg"  alt="" title="Jean-Paul Rouve" class="lazy">
        <div class="picto"><i class="icon icon_photo"></i></div>
        <div class="info">
          <div class="vCenter">
            <div class="vCenterKid">
              <span class="category">Montée des Marches</span>
              <span class="date">13.05.16</span> . <span
                  class="hour">15:30</span>
              <p data-title="Jean-Paul Rouve">Jean-Paul Rouve</p>
            </div>
          </div>
        </div>
      </div>
      <div class="item montee-des-marches 13-05-16 shadow-bottom photo portrait notloaded">
        <a id="photo804" class="ajax chocolat-image" data-pid="804"
           href="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/06/647ef66e3cd80ab14aa245e64c7f363935dade3b.jpg"
           title='<span class="category">Montée des Marches</span><span class="date">13.05.16 . 15:00</span><h2>Aishwarya Rai</h2>'
           data-credit="Crédit Image : Valéry Hache / AFP"></a>
        <img data-original="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/06/thumb_5019_media_image_320x404.jpg"  alt="" title="Aishwarya Rai" class="lazy">
        <div class="picto"><i class="icon icon_photo"></i></div>
        <div class="info">
          <div class="vCenter">
            <div class="vCenterKid">
              <span class="category">Montée des Marches</span>
              <span class="date">13.05.16</span> . <span
                  class="hour">15:00</span>
              <p data-title="Aishwarya Rai">Aishwarya Rai</p>
            </div>
          </div>
        </div>
      </div>
      <div class="item sur-scene 13-05-16 shadow-bottom photo paysage notloaded">
        <a id="photo794" class="ajax chocolat-image" data-pid="794"
           href="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/06/edb4e4e1834cbe483650d6338a5cb06f560be465.jpg"
           title='<span class="category">Sur Scène</span><span class="date">13.05.16 . 13:40</span><h2>Alin Tasciyan, Maurice Rouquier, Brigiette Berg, et Gérald Duchaussoy - Farrebique</h2>'
           data-credit="Crédit Image : Mathilde Petit / FDC"></a>
        <img data-original="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/06/thumb_5011_media_image_640x404.jpg"  alt="" title="Alin Tasciyan, Maurice Rouquier, Brigiette Berg, et Gérald Duchaussoy - Farrebique" class="lazy">
        <div class="picto"><i class="icon icon_photo"></i></div>
        <div class="info">
          <div class="vCenter">
            <div class="vCenterKid">
              <span class="category">Sur Scène</span>
              <span class="date">13.05.16</span> . <span
                  class="hour">13:40</span>
              <p data-title="Alin Tasciyan, Maurice Rouquier, Brigiette Berg, et Gérald Duchaussoy - Farrebique">Alin Tasciyan, Maurice Rouquier, Brigiette Berg, et Gérald Duchaussoy - Farrebique</p>
            </div>
          </div>
        </div>
      </div>
      <div class="item conference-de-presse 13-05-16 shadow-bottom photo paysage notloaded">
        <a id="photo782" class="ajax chocolat-image" data-pid="782"
           href="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/05/0c884487b4fc88b0bf5c601ddb4acc6998b731a7.jpg"
           title='<span class="category">Conférence de Presse</span><span class="date">13.05.16 . 12:35</span><h2>Équipe du film - I, Daniel Blake (Moi, Daniel Blake)</h2>'
           data-credit="Crédit Image : Léo Laumont / FDC"></a>
        <img data-original="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/05/thumb_4996_media_image_640x404.jpg"  alt="Équipe du film - I, Daniel Blake (Moi, Daniel Blake)" title="Équipe du film - I, Daniel Blake (Moi, Daniel Blake)" class="lazy">
        <div class="picto"><i class="icon icon_photo"></i></div>
        <div class="info">
          <div class="vCenter">
            <div class="vCenterKid">
              <span class="category">Conférence de Presse</span>
              <span class="date">13.05.16</span> . <span
                  class="hour">12:35</span>
              <p data-title="Équipe du film - I, Daniel Blake (Moi, Daniel Blake)">Équipe du film - I, Daniel Blake (Moi, Daniel Blake)</p>
            </div>
          </div>
        </div>
      </div>
      <div class="item conference-de-presse 13-05-16 shadow-bottom photo paysage notloaded">
        <a id="photo783" class="ajax chocolat-image" data-pid="783"
           href="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/05/8361253de682bb65e7ff7d26e328e6702ea2a2f1.jpg"
           title='<span class="category">Conférence de Presse</span><span class="date">13.05.16 . 12:35</span><h2>Ken Loach - I, Daniel Blake (Moi, Daniel Blake)</h2>'
           data-credit="Crédit Image : Léo Laumont / FDC"></a>
        <img data-original="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/05/thumb_4995_media_image_640x404.jpg"  alt="Ken Loach -I, Daniel Blake (Moi, Daniel Blake)" title="Ken Loach - I, Daniel Blake (Moi, Daniel Blake)" class="lazy">
        <div class="picto"><i class="icon icon_photo"></i></div>
        <div class="info">
          <div class="vCenter">
            <div class="vCenterKid">
              <span class="category">Conférence de Presse</span>
              <span class="date">13.05.16</span> . <span
                  class="hour">12:35</span>
              <p data-title="Ken Loach - I, Daniel Blake (Moi, Daniel Blake)">Ken Loach - I, Daniel Blake (Moi, Daniel Blake)</p>
            </div>
          </div>
        </div>
      </div>
      <div class="item conference-de-presse 13-05-16 shadow-bottom photo paysage notloaded">
        <a id="photo780" class="ajax chocolat-image" data-pid="780"
           href="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/05/a80b5f8837fb8365463612a457a563eb1caefd60.JPG"
           title='<span class="category">Conférence de Presse</span><span class="date">13.05.16 . 12:30</span><h2>Dave Johns, Ken Loach et Hayley Squires - I, Daniel Blake (Moi, Daniel Blake)</h2>'
           data-credit="Crédit Image : Léo Laumont / FDC"></a>
        <img data-original="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/05/thumb_4992_media_image_640x404.JPG"  alt="" title="Dave Johns, Ken Loach et Hayley Squires - I, Daniel Blake (Moi, Daniel Blake)" class="lazy">
        <div class="picto"><i class="icon icon_photo"></i></div>
        <div class="info">
          <div class="vCenter">
            <div class="vCenterKid">
              <span class="category">Conférence de Presse</span>
              <span class="date">13.05.16</span> . <span
                  class="hour">12:30</span>
              <p data-title="Dave Johns, Ken Loach et Hayley Squires - I, Daniel Blake (Moi, Daniel Blake)">Dave Johns, Ken Loach et Hayley Squires - I, Daniel Blake (Moi, Daniel Blake)</p>
            </div>
          </div>
        </div>
      </div>
      <div class="item photocall 13-05-16 shadow-bottom photo portrait notloaded">
        <a id="photo773" class="ajax chocolat-image" data-pid="773"
           href="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/05/9fa3f3b9d11351ef6fd66d5d160df7b578f07200.jpg"
           title='<span class="category">Photocall</span><span class="date">13.05.16 . 12:19</span><h2>Mélanie Thierry - La Danseuse</h2>'
           data-credit="Crédit Image : Mathilde Petit / FDC"></a>
        <img data-original="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/05/thumb_4985_media_image_320x404.jpg"  alt="" title="Mélanie Thierry - La Danseuse" class="lazy">
        <div class="picto"><i class="icon icon_photo"></i></div>
        <div class="info">
          <div class="vCenter">
            <div class="vCenterKid">
              <span class="category">Photocall</span>
              <span class="date">13.05.16</span> . <span
                  class="hour">12:19</span>
              <p data-title="Mélanie Thierry - La Danseuse">Mélanie Thierry - La Danseuse</p>
            </div>
          </div>
        </div>
      </div>
      <div class="item photocall 13-05-16 shadow-bottom photo paysage notloaded">
        <a id="photo774" class="ajax chocolat-image" data-pid="774"
           href="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/06/c0a045ac4f5742b272226d07a4b23034ab134eca.jpg"
           title='<span class="category">Photocall</span><span class="date">13.05.16 . 12:19</span><h2>Lily Rose Depp - La Danseuse</h2>'
           data-credit="Crédit Image : Alberto Pizzoli / AFP"></a>
        <img data-original="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/06/thumb_5013_media_image_640x404.jpg"  alt="" title="Lily Rose Depp - La Danseuse" class="lazy">
        <div class="picto"><i class="icon icon_photo"></i></div>
        <div class="info">
          <div class="vCenter">
            <div class="vCenterKid">
              <span class="category">Photocall</span>
              <span class="date">13.05.16</span> . <span
                  class="hour">12:19</span>
              <p data-title="Lily Rose Depp - La Danseuse">Lily Rose Depp - La Danseuse</p>
            </div>
          </div>
        </div>
      </div>
      <div class="item photocall 13-05-16 shadow-bottom photo paysage notloaded">
        <a id="photo772" class="ajax chocolat-image" data-pid="772"
           href="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/05/04b9263bf4923b264c294143efa782a052f3cd8d.jpg"
           title='<span class="category">Photocall</span><span class="date">13.05.16 . 12:17</span><h2>Gaspard Ulliel - La Danseuse</h2>'
           data-credit="Crédit Image : Thomas Leibreich / FDC"></a>
        <img data-original="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/05/thumb_4984_media_image_640x404.jpg"  alt="" title="Gaspard Ulliel - La Danseuse" class="lazy">
        <div class="picto"><i class="icon icon_photo"></i></div>
        <div class="info">
          <div class="vCenter">
            <div class="vCenterKid">
              <span class="category">Photocall</span>
              <span class="date">13.05.16</span> . <span
                  class="hour">12:17</span>
              <p data-title="Gaspard Ulliel - La Danseuse">Gaspard Ulliel - La Danseuse</p>
            </div>
          </div>
        </div>
      </div>
      <div class="item photocall 13-05-16 shadow-bottom photo paysage notloaded">
        <a id="photo771" class="ajax chocolat-image" data-pid="771"
           href="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/05/6a5f1111b838508537cf74d6b1e3e515e5106873.JPG"
           title='<span class="category">Photocall</span><span class="date">13.05.16 . 12:15</span><h2>Équipe du film - La Danseuse</h2>'
           data-credit="Crédit Image : Mathilde Petit / FDC"></a>
        <img data-original="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/05/thumb_4983_media_image_640x404.JPG"  alt="" title="Équipe du film - La Danseuse" class="lazy">
        <div class="picto"><i class="icon icon_photo"></i></div>
        <div class="info">
          <div class="vCenter">
            <div class="vCenterKid">
              <span class="category">Photocall</span>
              <span class="date">13.05.16</span> . <span
                  class="hour">12:15</span>
              <p data-title="Équipe du film - La Danseuse">Équipe du film - La Danseuse</p>
            </div>
          </div>
        </div>
      </div>
      <div class="item photocall 13-05-16 shadow-bottom photo paysage notloaded">
        <a id="photo767" class="ajax chocolat-image" data-pid="767"
           href="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/05/44fa4eb49184b9ac87a811375be8c4f8a93257fd.jpg"
           title='<span class="category">Photocall</span><span class="date">13.05.16 . 12:10</span><h2>Jean-Christophe Berjon, Isabelle Frilley, Catherine Corsini, Alexander Rodnyansky et Jean-Marie Dreujou  - Jury Caméra d&#039;Or</h2>'
           data-credit="Crédit Image : Thomas Leibreich / FDC"></a>
        <img data-original="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/05/thumb_4979_media_image_640x404.jpg"  alt="" title="Jean-Christophe Berjon, Isabelle Frilley, Catherine Corsini, Alexander Rodnyansky et Jean-Marie Dreujou  - Jury Caméra d&#039;Or" class="lazy">
        <div class="picto"><i class="icon icon_photo"></i></div>
        <div class="info">
          <div class="vCenter">
            <div class="vCenterKid">
              <span class="category">Photocall</span>
              <span class="date">13.05.16</span> . <span
                  class="hour">12:10</span>
              <p data-title="Jean-Christophe Berjon, Isabelle Frilley, Catherine Corsini, Alexander Rodnyansky et Jean-Marie Dreujou  - Jury Caméra d&#039;Or">Jean-Christophe Berjon, Isabelle Frilley, Catherine Corsini, Alexander Rodnyansky et Jean-Marie Dreujou  - Jury Caméra d&#039;Or</p>
            </div>
          </div>
        </div>
      </div>
      <div class="item photocall 13-05-16 shadow-bottom photo paysage notloaded">
        <a id="photo766" class="ajax chocolat-image" data-pid="766"
           href="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/05/e361a6b95463413d8c4b41ebe288a3ff45081eb8.jpg"
           title='<span class="category">Photocall</span><span class="date">13.05.16 . 12:09</span><h2>Jessica Hausner, Diego Luna, Marthe Keller, Ruben Östlund et Céline Sallette - Jury Un Certain Regard</h2>'
           data-credit="Crédit Image : Thomas Leibreich / FDC"></a>
        <img data-original="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/05/thumb_4997_media_image_640x404.jpg"  alt="" title="Jessica Hausner, Diego Luna, Marthe Keller, Ruben Östlund et Céline Sallette - Jury Un Certain Regard" class="lazy">
        <div class="picto"><i class="icon icon_photo"></i></div>
        <div class="info">
          <div class="vCenter">
            <div class="vCenterKid">
              <span class="category">Photocall</span>
              <span class="date">13.05.16</span> . <span
                  class="hour">12:09</span>
              <p data-title="Jessica Hausner, Diego Luna, Marthe Keller, Ruben Östlund et Céline Sallette - Jury Un Certain Regard">Jessica Hausner, Diego Luna, Marthe Keller, Ruben Östlund et Céline Sallette - Jury Un Certain Regard</p>
            </div>
          </div>
        </div>
      </div>
      <div class="item photocall 13-05-16 shadow-bottom photo portrait notloaded">
        <a id="photo779" class="ajax chocolat-image" data-pid="779"
           href="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/05/bcd1f6be2d95e74f99f032525dd1d0e8446392c8.jpg"
           title='<span class="category">Photocall</span><span class="date">13.05.16 . 12:08</span><h2>Ken Loach - I, Daniel Blake (Moi, Daniel Blake)</h2>'
           data-credit="Crédit Image : Venturelli / Getty Images"></a>
        <img data-original="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/05/thumb_4991_media_image_320x404.jpg"  alt="" title="Ken Loach - I, Daniel Blake (Moi, Daniel Blake)" class="lazy">
        <div class="picto"><i class="icon icon_photo"></i></div>
        <div class="info">
          <div class="vCenter">
            <div class="vCenterKid">
              <span class="category">Photocall</span>
              <span class="date">13.05.16</span> . <span
                  class="hour">12:08</span>
              <p data-title="Ken Loach - I, Daniel Blake (Moi, Daniel Blake)">Ken Loach - I, Daniel Blake (Moi, Daniel Blake)</p>
            </div>
          </div>
        </div>
      </div>
      <div class="item photocall 13-05-16 shadow-bottom photo paysage notloaded">
        <a id="photo764" class="ajax chocolat-image" data-pid="764"
           href="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/05/e16d3233994265bb838fb0616a4f80d72ec9e2d1.jpg"
           title='<span class="category">Photocall</span><span class="date">13.05.16 . 12:07</span><h2>Diego Luna - Membre du Jury Un certain Regard</h2>'
           data-credit="Crédit Image : Thomas Leibreich / FDC"></a>
        <img data-original="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/05/thumb_4999_media_image_640x404.jpg"  alt="" title="Diego Luna - Membre du Jury Un certain Regard" class="lazy">
        <div class="picto"><i class="icon icon_photo"></i></div>
        <div class="info">
          <div class="vCenter">
            <div class="vCenterKid">
              <span class="category">Photocall</span>
              <span class="date">13.05.16</span> . <span
                  class="hour">12:07</span>
              <p data-title="Diego Luna - Membre du Jury Un certain Regard">Diego Luna - Membre du Jury Un certain Regard</p>
            </div>
          </div>
        </div>
      </div>
      <div class="item photocall 13-05-16 shadow-bottom photo paysage notloaded">
        <a id="photo770" class="ajax chocolat-image" data-pid="770"
           href="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/05/c76d221a5c94f3fce39c3e8a93ac8e36471153f3.jpg"
           title='<span class="category">Photocall</span><span class="date">13.05.16 . 12:06</span><h2>I, Daniel Blake Photocall</h2>'
           data-credit="Crédit Image : Valery HACHE / AFP"></a>
        <img data-original="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/05/thumb_4982_media_image_640x404.jpg"  alt="" title="I, Daniel Blake Photocall" class="lazy">
        <div class="picto"><i class="icon icon_photo"></i></div>
        <div class="info">
          <div class="vCenter">
            <div class="vCenterKid">
              <span class="category">Photocall</span>
              <span class="date">13.05.16</span> . <span
                  class="hour">12:06</span>
              <p data-title="I, Daniel Blake Photocall">I, Daniel Blake Photocall</p>
            </div>
          </div>
        </div>
      </div>
      <div class="item photocall 13-05-16 shadow-bottom photo paysage notloaded">
        <a id="photo763" class="ajax chocolat-image" data-pid="763"
           href="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/05/22e01c38d08260a2007ff16c0412c6eb909e1962.jpg"
           title='<span class="category">Photocall</span><span class="date">13.05.16 . 12:05</span><h2>Dave Johns, Ken Loach et Hayley Squires - I, Daniel Blake (Moi, Daniel Blake)</h2>'
           data-credit="Crédit Image : Thomas Leibreich / FDC"></a>
        <img data-original="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/05/thumb_4976_media_image_640x404.jpg"  alt="" title="Dave Johns, Ken Loach et Hayley Squires - I, Daniel Blake (Moi, Daniel Blake)" class="lazy">
        <div class="picto"><i class="icon icon_photo"></i></div>
        <div class="info">
          <div class="vCenter">
            <div class="vCenterKid">
              <span class="category">Photocall</span>
              <span class="date">13.05.16</span> . <span
                  class="hour">12:05</span>
              <p data-title="Dave Johns, Ken Loach et Hayley Squires - I, Daniel Blake (Moi, Daniel Blake)">Dave Johns, Ken Loach et Hayley Squires - I, Daniel Blake (Moi, Daniel Blake)</p>
            </div>
          </div>
        </div>
      </div>
      <div class="item photocall 13-05-16 shadow-bottom photo paysage notloaded">
        <a id="photo762" class="ajax chocolat-image" data-pid="762"
           href="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/05/7f8bf7ed3e43e97743002ef2e824fc2403bc8271.jpg"
           title='<span class="category">Photocall</span><span class="date">13.05.16 . 12:03</span><h2>Dave Johns and Hayley Squires - I, Daniel Blake</h2>'
           data-credit="Crédit Image : Thomas Leibreich / FDC"></a>
        <img data-original="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/05/thumb_4974_media_image_640x404.jpg"  alt="" title="Dave Johns and Hayley Squires - I, Daniel Blake" class="lazy">
        <div class="picto"><i class="icon icon_photo"></i></div>
        <div class="info">
          <div class="vCenter">
            <div class="vCenterKid">
              <span class="category">Photocall</span>
              <span class="date">13.05.16</span> . <span
                  class="hour">12:03</span>
              <p data-title="Dave Johns and Hayley Squires - I, Daniel Blake">Dave Johns and Hayley Squires - I, Daniel Blake</p>
            </div>
          </div>
        </div>
      </div>
      <div class="item sur-scene 13-05-16 shadow-bottom photo paysage notloaded">
        <a id="photo757" class="ajax chocolat-image" data-pid="757"
           href="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/05/63282f92b99d93d398b57505584f826478cf8541.jpg"
           title='<span class="category">Sur Scène</span><span class="date">13.05.16 . 12:00</span><h2>Équipe du film - Uchenik (Le Disciple)</h2>'
           data-credit="Crédit Image : Mathilde Petit / FDC"></a>
        <img data-original="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/05/thumb_4969_media_image_640x404.jpg"  alt="" title="Équipe du film - Uchenik (Le Disciple)" class="lazy">
        <div class="picto"><i class="icon icon_photo"></i></div>
        <div class="info">
          <div class="vCenter">
            <div class="vCenterKid">
              <span class="category">Sur Scène</span>
              <span class="date">13.05.16</span> . <span
                  class="hour">12:00</span>
              <p data-title="Équipe du film - Uchenik (Le Disciple)">Équipe du film - Uchenik (Le Disciple)</p>
            </div>
          </div>
        </div>
      </div>
      <div class="item photocall 13-05-16 shadow-bottom photo paysage notloaded">
        <a id="photo761" class="ajax chocolat-image" data-pid="761"
           href="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/05/1bbf10e8dd5a6c25a505fae8d4a32692ebfdd0c5.jpg"
           title='<span class="category">Photocall</span><span class="date">13.05.16 . 12:00</span><h2>Équipe du film - I, Daniel Blake (Moi, Daniel Blake)</h2>'
           data-credit="Crédit Image : Thomas Leibreich / FDC"></a>
        <img data-original="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/05/thumb_4973_media_image_640x404.jpg"  alt="" title="Équipe du film - I, Daniel Blake (Moi, Daniel Blake)" class="lazy">
        <div class="picto"><i class="icon icon_photo"></i></div>
        <div class="info">
          <div class="vCenter">
            <div class="vCenterKid">
              <span class="category">Photocall</span>
              <span class="date">13.05.16</span> . <span
                  class="hour">12:00</span>
              <p data-title="Équipe du film - I, Daniel Blake (Moi, Daniel Blake)">Équipe du film - I, Daniel Blake (Moi, Daniel Blake)</p>
            </div>
          </div>
        </div>
      </div>
      <div class="item conference-de-presse 13-05-16 shadow-bottom photo paysage notloaded">
        <a id="photo759" class="ajax chocolat-image" data-pid="759"
           href="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/05/e9eb1a59f8e71f25e43b325ea15bd509861c3e11.jpg"
           title='<span class="category">Conférence de Presse</span><span class="date">13.05.16 . 11:45</span><h2>Équipe du film - Ma Loute</h2>'
           data-credit="Crédit Image : Cyril Duchêne / FDC"></a>
        <img data-original="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/05/thumb_4971_media_image_640x404.jpg"  alt="" title="Équipe du film - Ma Loute" class="lazy">
        <div class="picto"><i class="icon icon_photo"></i></div>
        <div class="info">
          <div class="vCenter">
            <div class="vCenterKid">
              <span class="category">Conférence de Presse</span>
              <span class="date">13.05.16</span> . <span
                  class="hour">11:45</span>
              <p data-title="Équipe du film - Ma Loute">Équipe du film - Ma Loute</p>
            </div>
          </div>
        </div>
      </div>
      <div class="item conference-de-presse 13-05-16 shadow-bottom photo portrait notloaded">
        <a id="photo758" class="ajax chocolat-image" data-pid="758"
           href="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/05/413f6443c3c3517dc480f5d68ad0136f7e0f5ff7.jpg"
           title='<span class="category">Conférence de Presse</span><span class="date">13.05.16 . 11:40</span><h2>Raph - Ma Loute</h2>'
           data-credit="Crédit Image : Cyril Duchêne / FDC"></a>
        <img data-original="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/05/thumb_4970_media_image_320x404.jpg"  alt="" title="Raph - Ma Loute" class="lazy">
        <div class="picto"><i class="icon icon_photo"></i></div>
        <div class="info">
          <div class="vCenter">
            <div class="vCenterKid">
              <span class="category">Conférence de Presse</span>
              <span class="date">13.05.16</span> . <span
                  class="hour">11:40</span>
              <p data-title="Raph - Ma Loute">Raph - Ma Loute</p>
            </div>
          </div>
        </div>
      </div>
      <div class="item un-certain-regard 13-05-16 shadow-bottom photo paysage notloaded">
        <a id="photo756" class="ajax chocolat-image" data-pid="756"
           href="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/05/f1bcbed840327bf593e3cd3726cf0e46c640246c.jpg"
           title='<span class="category">Un Certain Regard</span><span class="date">13.05.16 . 11:17</span><h2>Kirill Serebrennikov - Uchenik (Le Disciple)</h2>'
           data-credit="Crédit Image : Mathilde Petit / FDC"></a>
        <img data-original="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/05/thumb_4968_media_image_640x404.jpg"  alt="" title="Kirill Serebrennikov - Uchenik (Le Disciple)" class="lazy">
        <div class="picto"><i class="icon icon_photo"></i></div>
        <div class="info">
          <div class="vCenter">
            <div class="vCenterKid">
              <span class="category">Un Certain Regard</span>
              <span class="date">13.05.16</span> . <span
                  class="hour">11:17</span>
              <p data-title="Kirill Serebrennikov - Uchenik (Le Disciple)">Kirill Serebrennikov - Uchenik (Le Disciple)</p>
            </div>
          </div>
        </div>
      </div>
      <div class="item un-certain-regard 13-05-16 shadow-bottom photo paysage notloaded">
        <a id="photo754" class="ajax chocolat-image" data-pid="754"
           href="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/05/b4ce2e15202eb626a1480ff370489d351d4c2ce5.jpg"
           title='<span class="category">Un Certain Regard</span><span class="date">13.05.16 . 11:15</span><h2>Petr Skortsov et Alexandr Gorchilin - Uchenik (Le Disciple)</h2>'
           data-credit="Crédit Image : Mathilde Petit / FDC"></a>
        <img data-original="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/05/thumb_4966_media_image_640x404.jpg"  alt="" title="Petr Skortsov et Alexandr Gorchilin - Uchenik (Le Disciple)" class="lazy">
        <div class="picto"><i class="icon icon_photo"></i></div>
        <div class="info">
          <div class="vCenter">
            <div class="vCenterKid">
              <span class="category">Un Certain Regard</span>
              <span class="date">13.05.16</span> . <span
                  class="hour">11:15</span>
              <p data-title="Petr Skortsov et Alexandr Gorchilin - Uchenik (Le Disciple)">Petr Skortsov et Alexandr Gorchilin - Uchenik (Le Disciple)</p>
            </div>
          </div>
        </div>
      </div>
      <div class="item montee-des-marches 13-05-16 shadow-bottom photo paysage notloaded">
        <a id="photo752" class="ajax chocolat-image" data-pid="752"
           href="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/05/7909b8855bd62bf4c110d7be0fb7ef807dc315c0.jpg"
           title='<span class="category">Montée des Marches</span><span class="date">13.05.16 . 11:00</span><h2>Équipe du film - Uchenik (Le Disciple)</h2>'
           data-credit="Crédit Image : Mathilde Petit / FDC"></a>
        <img data-original="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/05/thumb_4965_media_image_640x404.jpg"  alt="" title="Équipe du film - Uchenik (Le Disciple)" class="lazy">
        <div class="picto"><i class="icon icon_photo"></i></div>
        <div class="info">
          <div class="vCenter">
            <div class="vCenterKid">
              <span class="category">Montée des Marches</span>
              <span class="date">13.05.16</span> . <span
                  class="hour">11:00</span>
              <p data-title="Équipe du film - Uchenik (Le Disciple)">Équipe du film - Uchenik (Le Disciple)</p>
            </div>
          </div>
        </div>
      </div>
      <div class="item photocall 13-05-16 shadow-bottom photo paysage notloaded">
        <a id="photo747" class="ajax chocolat-image" data-pid="747"
           href="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/05/c5d2885f8a6391390bf9cfada93d4ca6b09e3faa.jpg"
           title='<span class="category">Photocall</span><span class="date">13.05.16 . 10:50</span><h2>Victoria Isakova - Uchenik (Le Disciple)</h2>'
           data-credit="Crédit Image : Cyril Duchêne / FDC"></a>
        <img data-original="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/05/thumb_4953_media_image_640x404.jpg"  alt="" title="Victoria Isakova - Uchenik (Le Disciple)" class="lazy">
        <div class="picto"><i class="icon icon_photo"></i></div>
        <div class="info">
          <div class="vCenter">
            <div class="vCenterKid">
              <span class="category">Photocall</span>
              <span class="date">13.05.16</span> . <span
                  class="hour">10:50</span>
              <p data-title="Victoria Isakova - Uchenik (Le Disciple)">Victoria Isakova - Uchenik (Le Disciple)</p>
            </div>
          </div>
        </div>
      </div>
      <div class="item photocall 13-05-16 shadow-bottom photo paysage notloaded">
        <a id="photo745" class="ajax chocolat-image" data-pid="745"
           href="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/05/95268b42ba79dc9c7474ece7eb2407b9b6b3a604.jpg"
           title='<span class="category">Photocall</span><span class="date">13.05.16 . 10:47</span><h2>Petr Skortsov, Victoria Isakova, Kirill Serebrennikov et Alexandr Gorchilin - Uchenik (Le Disciple)</h2>'
           data-credit="Crédit Image : Cyril Duchêne / FDC"></a>
        <img data-original="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/05/thumb_4951_media_image_640x404.jpg"  alt="" title="Petr Skortsov, Victoria Isakova, Kirill Serebrennikov et Alexandr Gorchilin - Uchenik (Le Disciple)" class="lazy">
        <div class="picto"><i class="icon icon_photo"></i></div>
        <div class="info">
          <div class="vCenter">
            <div class="vCenterKid">
              <span class="category">Photocall</span>
              <span class="date">13.05.16</span> . <span
                  class="hour">10:47</span>
              <p data-title="Petr Skortsov, Victoria Isakova, Kirill Serebrennikov et Alexandr Gorchilin - Uchenik (Le Disciple)">Petr Skortsov, Victoria Isakova, Kirill Serebrennikov et Alexandr Gorchilin - Uchenik (Le Disciple)</p>
            </div>
          </div>
        </div>
      </div>
      <div class="item photocall 13-05-16 shadow-bottom photo portrait notloaded">
        <a id="photo746" class="ajax chocolat-image" data-pid="746"
           href="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/05/689611b1f77318a7ec2e09188762c9add4d8197b.jpg"
           title='<span class="category">Photocall</span><span class="date">13.05.16 . 10:45</span><h2>Petr Skortsov et Alexandr Gorchilin - Uchenik (Le Disciple)</h2>'
           data-credit="Crédit Image : Cyril Duchêne / FDC"></a>
        <img data-original="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/05/thumb_4952_media_image_320x404.jpg"  alt="" title="Petr Skortsov et Alexandr Gorchilin - Uchenik (Le Disciple)" class="lazy">
        <div class="picto"><i class="icon icon_photo"></i></div>
        <div class="info">
          <div class="vCenter">
            <div class="vCenterKid">
              <span class="category">Photocall</span>
              <span class="date">13.05.16</span> . <span
                  class="hour">10:45</span>
              <p data-title="Petr Skortsov et Alexandr Gorchilin - Uchenik (Le Disciple)">Petr Skortsov et Alexandr Gorchilin - Uchenik (Le Disciple)</p>
            </div>
          </div>
        </div>
      </div>
      <div class="item photocall 13-05-16 shadow-bottom photo paysage notloaded">
        <a id="photo741" class="ajax chocolat-image" data-pid="741"
           href="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/05/c8033f4a30802bc2caa52b615297944cb1c81573.JPG"
           title='<span class="category">Photocall</span><span class="date">13.05.16 . 10:38</span><h2>Bruno Dumont - Ma Loute</h2>'
           data-credit="Crédit Image : Cyril Duchêne / FDC"></a>
        <img data-original="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/05/thumb_4948_media_image_640x404.JPG"  alt="" title="Bruno Dumont - Ma Loute" class="lazy">
        <div class="picto"><i class="icon icon_photo"></i></div>
        <div class="info">
          <div class="vCenter">
            <div class="vCenterKid">
              <span class="category">Photocall</span>
              <span class="date">13.05.16</span> . <span
                  class="hour">10:38</span>
              <p data-title="Bruno Dumont - Ma Loute">Bruno Dumont - Ma Loute</p>
            </div>
          </div>
        </div>
      </div>
      <div class="item photocall 13-05-16 shadow-bottom photo paysage notloaded">
        <a id="photo740" class="ajax chocolat-image" data-pid="740"
           href="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/05/b6f19a3c00ff4c7a3c7d6c05f47e0ddfdfcbb7d7.JPG"
           title='<span class="category">Photocall</span><span class="date">13.05.16 . 10:37</span><h2>Valeria Bruni Tedeschi, Fabrice Luchini et Juliette Binoche - Ma Loute</h2>'
           data-credit="Crédit Image : Cyril Duchêne / FDC"></a>
        <img data-original="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/05/thumb_4947_media_image_640x404.JPG"  alt="" title="Valeria Bruni Tedeschi, Fabrice Luchini et Juliette Binoche - Ma Loute" class="lazy">
        <div class="picto"><i class="icon icon_photo"></i></div>
        <div class="info">
          <div class="vCenter">
            <div class="vCenterKid">
              <span class="category">Photocall</span>
              <span class="date">13.05.16</span> . <span
                  class="hour">10:37</span>
              <p data-title="Valeria Bruni Tedeschi, Fabrice Luchini et Juliette Binoche - Ma Loute">Valeria Bruni Tedeschi, Fabrice Luchini et Juliette Binoche - Ma Loute</p>
            </div>
          </div>
        </div>
      </div>
      <div class="item photocall 13-05-16 shadow-bottom photo paysage notloaded">
        <a id="photo735" class="ajax chocolat-image" data-pid="735"
           href="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/05/cd77c3b524a6abcd1e419dbe4b86c7c18eeada9d.jpg"
           title='<span class="category">Photocall</span><span class="date">13.05.16 . 10:30</span><h2>Fabrice Luchini et Juliette Binoche - Ma Loute</h2>'
           data-credit="Crédit Image : Cyril Duchêne / FDC"></a>
        <img data-original="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/05/thumb_4944_media_image_640x404.jpg"  alt="" title="Fabrice Luchini et Juliette Binoche - Ma Loute" class="lazy">
        <div class="picto"><i class="icon icon_photo"></i></div>
        <div class="info">
          <div class="vCenter">
            <div class="vCenterKid">
              <span class="category">Photocall</span>
              <span class="date">13.05.16</span> . <span
                  class="hour">10:30</span>
              <p data-title="Fabrice Luchini et Juliette Binoche - Ma Loute">Fabrice Luchini et Juliette Binoche - Ma Loute</p>
            </div>
          </div>
        </div>
      </div>
      <div class="item photocall 13-05-16 shadow-bottom photo paysage notloaded">
        <a id="photo736" class="ajax chocolat-image" data-pid="736"
           href="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/05/cc29fe36818c357c8803ea4c57512b03063c6855.JPG"
           title='<span class="category">Photocall</span><span class="date">13.05.16 . 10:30</span><h2>Juliette Binoche - Ma Loute</h2>'
           data-credit="Crédit Image : Cyril Duchêne / FDC"></a>
        <img data-original="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/05/thumb_4945_media_image_640x404.JPG"  alt="" title="Juliette Binoche - Ma Loute" class="lazy">
        <div class="picto"><i class="icon icon_photo"></i></div>
        <div class="info">
          <div class="vCenter">
            <div class="vCenterKid">
              <span class="category">Photocall</span>
              <span class="date">13.05.16</span> . <span
                  class="hour">10:30</span>
              <p data-title="Juliette Binoche - Ma Loute">Juliette Binoche - Ma Loute</p>
            </div>
          </div>
        </div>
      </div>
      <div class="item oeil-du-photographe 13-05-16 shadow-bottom photo paysage notloaded">
        <a id="photo666" class="ajax chocolat-image" data-pid="666"
           href="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/05/c236efbdb11bb96592576777be318e8e35f05b55.jpg"
           title='<span class="category">Œil du photographe</span><span class="date">13.05.16 . 09:00</span><h2>Shu Qi</h2>'
           data-credit="Crédit Image : Yves Salmon (2015)"></a>
        <img data-original="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/05/thumb_4835_media_image_640x404.jpg"  alt="Shu Qi" title="Shu Qi" class="lazy">
        <div class="picto"><i class="icon icon_photo"></i></div>
        <div class="info">
          <div class="vCenter">
            <div class="vCenterKid">
              <span class="category">Œil du photographe</span>
              <span class="date">13.05.16</span> . <span
                  class="hour">09:00</span>
              <p data-title="Shu Qi">Shu Qi</p>
            </div>
          </div>
        </div>
      </div>
      <div class="item oeil-du-photographe 13-05-16 shadow-bottom photo paysage notloaded">
        <a id="photo667" class="ajax chocolat-image" data-pid="667"
           href="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/05/25c8d74bbaa45e77eea98415ab52fe55f7f63304.jpg"
           title='<span class="category">Œil du photographe</span><span class="date">13.05.16 . 09:00</span><h2>Tarzan et Arab Nasser</h2>'
           data-credit="Crédit Image : Yves Salmon (2015)"></a>
        <img data-original="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/05/thumb_4836_media_image_640x404.jpg"  alt="Tarzan et Arab Nasser" title="Tarzan et Arab Nasser" class="lazy">
        <div class="picto"><i class="icon icon_photo"></i></div>
        <div class="info">
          <div class="vCenter">
            <div class="vCenterKid">
              <span class="category">Œil du photographe</span>
              <span class="date">13.05.16</span> . <span
                  class="hour">09:00</span>
              <p data-title="Tarzan et Arab Nasser">Tarzan et Arab Nasser</p>
            </div>
          </div>
        </div>
      </div>
      <div class="item oeil-du-photographe 13-05-16 shadow-bottom photo portrait notloaded">
        <a id="photo668" class="ajax chocolat-image" data-pid="668"
           href="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/05/87928a3d17faee7ae59f8764fc5b4861d6c94b04.jpg"
           title='<span class="category">Œil du photographe</span><span class="date">13.05.16 . 09:00</span><h2>Gaspar Noé</h2>'
           data-credit="Crédit Image : Yves Salmon (2015)"></a>
        <img data-original="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/05/thumb_4837_media_image_320x404.jpg"  alt="Gaspar Noé" title="Gaspar Noé" class="lazy">
        <div class="picto"><i class="icon icon_photo"></i></div>
        <div class="info">
          <div class="vCenter">
            <div class="vCenterKid">
              <span class="category">Œil du photographe</span>
              <span class="date">13.05.16</span> . <span
                  class="hour">09:00</span>
              <p data-title="Gaspar Noé">Gaspar Noé</p>
            </div>
          </div>
        </div>
      </div>
      <div class="item oeil-du-photographe 13-05-16 shadow-bottom photo paysage notloaded">
        <a id="photo669" class="ajax chocolat-image" data-pid="669"
           href="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/05/78a8449fb18d0c8c784a3b005a6d61a39241fef1.jpg"
           title='<span class="category">Œil du photographe</span><span class="date">13.05.16 . 09:00</span><h2>Marthe Keller</h2>'
           data-credit="Crédit Image : Yves Salmon (2015)"></a>
        <img data-original="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/05/thumb_4838_media_image_640x404.jpg"  alt="Marthe Keller" title="Marthe Keller" class="lazy">
        <div class="picto"><i class="icon icon_photo"></i></div>
        <div class="info">
          <div class="vCenter">
            <div class="vCenterKid">
              <span class="category">Œil du photographe</span>
              <span class="date">13.05.16</span> . <span
                  class="hour">09:00</span>
              <p data-title="Marthe Keller">Marthe Keller</p>
            </div>
          </div>
        </div>
      </div>
      <div class="item sur-scene 12-05-16 shadow-bottom photo paysage notloaded">
        <a id="photo734" class="ajax chocolat-image" data-pid="734"
           href="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/05/73cb1276b378867c1522d2cb8aef5e7262a42c8f.jpg"
           title='<span class="category">Sur Scène</span><span class="date">12.05.16 . 22:50</span><h2>Équipe du film - Omor Shakhsiya (Personal Affairs)</h2>'
           data-credit="Crédit Image : Mathilde Petit / FDC"></a>
        <img data-original="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/05/thumb_4901_media_image_640x404.jpg"  alt="" title="Équipe du film - Omor Shakhsiya (Personal Affairs)" class="lazy">
        <div class="picto"><i class="icon icon_photo"></i></div>
        <div class="info">
          <div class="vCenter">
            <div class="vCenterKid">
              <span class="category">Sur Scène</span>
              <span class="date">12.05.16</span> . <span
                  class="hour">22:50</span>
              <p data-title="Équipe du film - Omor Shakhsiya (Personal Affairs)">Équipe du film - Omor Shakhsiya (Personal Affairs)</p>
            </div>
          </div>
        </div>
      </div>
      <div class="item un-certain-regard 12-05-16 shadow-bottom photo portrait notloaded">
        <a id="photo733" class="ajax chocolat-image" data-pid="733"
           href="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/05/50badc62d3cdac90ce553d9b575543bc4b0ecf28.jpg"
           title='<span class="category">Un Certain Regard</span><span class="date">12.05.16 . 22:35</span><h2>Maisa Abd Elhadi et Maha Haj - Omor Shakhsiya (Personal Affairs)</h2>'
           data-credit="Crédit Image : Antonin Thuillier / AFP"></a>
        <img data-original="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/05/thumb_4900_media_image_320x404.jpg"  alt="" title="Maisa Abd Elhadi et Maha Haj - Omor Shakhsiya (Personal Affairs)" class="lazy">
        <div class="picto"><i class="icon icon_photo"></i></div>
        <div class="info">
          <div class="vCenter">
            <div class="vCenterKid">
              <span class="category">Un Certain Regard</span>
              <span class="date">12.05.16</span> . <span
                  class="hour">22:35</span>
              <p data-title="Maisa Abd Elhadi et Maha Haj - Omor Shakhsiya (Personal Affairs)">Maisa Abd Elhadi et Maha Haj - Omor Shakhsiya (Personal Affairs)</p>
            </div>
          </div>
        </div>
      </div>
      <div class="item un-certain-regard 12-05-16 shadow-bottom photo paysage notloaded">
        <a id="photo732" class="ajax chocolat-image" data-pid="732"
           href="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/05/e5f316d11a3d800887ec73b91270e6786163eb58.jpg"
           title='<span class="category">Un Certain Regard</span><span class="date">12.05.16 . 22:30</span><h2>Amer Hlehel, Sana Shawahdeh et Mahmoud Shawahdeh - Omor Shakhsiya (Personal Affairs)</h2>'
           data-credit="Crédit Image : Antonin Thuillier / AFP"></a>
        <img data-original="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/05/thumb_4899_media_image_640x404.jpg"  alt="" title="Amer Hlehel, Sana Shawahdeh et Mahmoud Shawahdeh - Omor Shakhsiya (Personal Affairs)" class="lazy">
        <div class="picto"><i class="icon icon_photo"></i></div>
        <div class="info">
          <div class="vCenter">
            <div class="vCenterKid">
              <span class="category">Un Certain Regard</span>
              <span class="date">12.05.16</span> . <span
                  class="hour">22:30</span>
              <p data-title="Amer Hlehel, Sana Shawahdeh et Mahmoud Shawahdeh - Omor Shakhsiya (Personal Affairs)">Amer Hlehel, Sana Shawahdeh et Mahmoud Shawahdeh - Omor Shakhsiya (Personal Affairs)</p>
            </div>
          </div>
        </div>
      </div>
      <div class="item montee-des-marches 12-05-16 shadow-bottom photo paysage notloaded">
        <a id="photo730" class="ajax chocolat-image" data-pid="730"
           href="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/05/c79bc3833e20c59e4a2b95069e8e0a388e3064db.jpg"
           title='<span class="category">Montée des Marches</span><span class="date">12.05.16 . 22:13</span><h2>Équipe du film - Rester Vertical</h2>'
           data-credit="Crédit Image : Alberto Pizzoli / AFP"></a>
        <img data-original="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/05/thumb_4897_media_image_640x404.jpg"  alt="" title="Équipe du film - Rester Vertical" class="lazy">
        <div class="picto"><i class="icon icon_photo"></i></div>
        <div class="info">
          <div class="vCenter">
            <div class="vCenterKid">
              <span class="category">Montée des Marches</span>
              <span class="date">12.05.16</span> . <span
                  class="hour">22:13</span>
              <p data-title="Équipe du film - Rester Vertical">Équipe du film - Rester Vertical</p>
            </div>
          </div>
        </div>
      </div>
      <div class="item montee-des-marches 12-05-16 shadow-bottom photo paysage notloaded">
        <a id="photo728" class="ajax chocolat-image" data-pid="728"
           href="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/05/33a11a58669421bf33bcbdace9e9f2bb41f2bf64.jpg"
           title='<span class="category">Montée des Marches</span><span class="date">12.05.16 . 22:10</span><h2>Alain Guiraudie, Damien Bonnard et Laure Calamy - Rester Vertical</h2>'
           data-credit="Crédit Image : Alberto Pizzoli / AFP"></a>
        <img data-original="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/05/thumb_4896_media_image_640x404.jpg"  alt="" title="Alain Guiraudie, Damien Bonnard et Laure Calamy - Rester Vertical" class="lazy">
        <div class="picto"><i class="icon icon_photo"></i></div>
        <div class="info">
          <div class="vCenter">
            <div class="vCenterKid">
              <span class="category">Montée des Marches</span>
              <span class="date">12.05.16</span> . <span
                  class="hour">22:10</span>
              <p data-title="Alain Guiraudie, Damien Bonnard et Laure Calamy - Rester Vertical">Alain Guiraudie, Damien Bonnard et Laure Calamy - Rester Vertical</p>
            </div>
          </div>
        </div>
      </div>
      <div class="item montee-des-marches 12-05-16 shadow-bottom photo paysage notloaded">
        <a id="photo727" class="ajax chocolat-image" data-pid="727"
           href="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/05/d996cdfab026c59aceedbe1b2a78be4f12c0e2a6.jpg"
           title='<span class="category">Montée des Marches</span><span class="date">12.05.16 . 22:00</span><h2>Équipe du film - Rester Vertical</h2>'
           data-credit="Crédit Image : Thomas Leibreich / FDC"></a>
        <img data-original="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/05/thumb_4895_media_image_640x404.jpg"  alt="" title="Équipe du film - Rester Vertical" class="lazy">
        <div class="picto"><i class="icon icon_photo"></i></div>
        <div class="info">
          <div class="vCenter">
            <div class="vCenterKid">
              <span class="category">Montée des Marches</span>
              <span class="date">12.05.16</span> . <span
                  class="hour">22:00</span>
              <p data-title="Équipe du film - Rester Vertical">Équipe du film - Rester Vertical</p>
            </div>
          </div>
        </div>
      </div>
      <div class="item sur-scene 12-05-16 shadow-bottom photo paysage notloaded">
        <a id="photo718" class="ajax chocolat-image" data-pid="718"
           href="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/05/29761de0db8e948bee095d67b7c76eb72090ce0b.jpg"
           title='<span class="category">Sur Scène</span><span class="date">12.05.16 . 20:50</span><h2>Vanessa Redgrave - Howards End</h2>'
           data-credit="Crédit Image : Cyril Duchêne / FDC"></a>
        <img data-original="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/05/thumb_4890_media_image_640x404.jpg"  alt="" title="Vanessa Redgrave - Howards End" class="lazy">
        <div class="picto"><i class="icon icon_photo"></i></div>
        <div class="info">
          <div class="vCenter">
            <div class="vCenterKid">
              <span class="category">Sur Scène</span>
              <span class="date">12.05.16</span> . <span
                  class="hour">20:50</span>
              <p data-title="Vanessa Redgrave - Howards End">Vanessa Redgrave - Howards End</p>
            </div>
          </div>
        </div>
      </div>
      <div class="item sur-scene 12-05-16 shadow-bottom photo paysage notloaded">
        <a id="photo717" class="ajax chocolat-image" data-pid="717"
           href="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/05/1d04c9b877a323500efb8998347e94e9d52a6d9f.JPG"
           title='<span class="category">Sur Scène</span><span class="date">12.05.16 . 20:45</span><h2>Charles S.Cohen, Vanessa Redgrave et Thierry Frémaux - Howards End</h2>'
           data-credit="Crédit Image : Cyril Duchêne / FDC"></a>
        <img data-original="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/05/thumb_4888_media_image_640x404.JPG"  alt="" title="Charles S.Cohen, Vanessa Redgrave et Thierry Frémaux - Howards End" class="lazy">
        <div class="picto"><i class="icon icon_photo"></i></div>
        <div class="info">
          <div class="vCenter">
            <div class="vCenterKid">
              <span class="category">Sur Scène</span>
              <span class="date">12.05.16</span> . <span
                  class="hour">20:45</span>
              <p data-title="Charles S.Cohen, Vanessa Redgrave et Thierry Frémaux - Howards End">Charles S.Cohen, Vanessa Redgrave et Thierry Frémaux - Howards End</p>
            </div>
          </div>
        </div>
      </div>
      <div class="item sur-scene 12-05-16 shadow-bottom photo paysage notloaded">
        <a id="photo716" class="ajax chocolat-image" data-pid="716"
           href="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/05/3e859a2a3af194f6445ebda44235a16598dbf836.JPG"
           title='<span class="category">Sur Scène</span><span class="date">12.05.16 . 20:40</span><h2>Charles S.Cohen, Vanessa Redgrave et James Ivory et Thierry Frémaux - Howards End</h2>'
           data-credit="Crédit Image : Cyril Duchêne / FDC"></a>
        <img data-original="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/05/thumb_4886_media_image_640x404.JPG"  alt="" title="Charles S.Cohen, Vanessa Redgrave et James Ivory et Thierry Frémaux - Howards End" class="lazy">
        <div class="picto"><i class="icon icon_photo"></i></div>
        <div class="info">
          <div class="vCenter">
            <div class="vCenterKid">
              <span class="category">Sur Scène</span>
              <span class="date">12.05.16</span> . <span
                  class="hour">20:40</span>
              <p data-title="Charles S.Cohen, Vanessa Redgrave et James Ivory et Thierry Frémaux - Howards End">Charles S.Cohen, Vanessa Redgrave et James Ivory et Thierry Frémaux - Howards End</p>
            </div>
          </div>
        </div>
      </div>
      <div class="item montee-des-marches 12-05-16 shadow-bottom photo paysage notloaded">
        <a id="photo690" class="ajax chocolat-image" data-pid="690"
           href="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/05/838d1c1fab8fd06c0c5cba8c83cfee726dc5159a.jpg"
           title='<span class="category">Montée des Marches</span><span class="date">12.05.16 . 19:42</span><h2>Julianne Moore</h2>'
           data-credit="Crédit Image : Alberto Pizzoli / AFP"></a>
        <img data-original="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/05/thumb_4862_media_image_640x404.jpg"  alt="" title="Julianne Moore" class="lazy">
        <div class="picto"><i class="icon icon_photo"></i></div>
        <div class="info">
          <div class="vCenter">
            <div class="vCenterKid">
              <span class="category">Montée des Marches</span>
              <span class="date">12.05.16</span> . <span
                  class="hour">19:42</span>
              <p data-title="Julianne Moore">Julianne Moore</p>
            </div>
          </div>
        </div>
      </div>
      <div class="item sur-scene 12-05-16 shadow-bottom photo paysage notloaded">
        <a id="photo744" class="ajax chocolat-image" data-pid="744"
           href="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/05/478e87d8c7e86ec89507f05dad680e728d0774a7.jpg"
           title='<span class="category">Sur Scène</span><span class="date">12.05.16 . 19:30</span><h2>Mohamed Diab et l&#039;équipe du film Esthebak (Clash) - Cérémonie d&#039;ouverture dans la salle Debussy</h2>'
           data-credit="Crédit Image : Léo Laumont / FDC"></a>
        <img data-original="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/05/thumb_4950_media_image_640x404.jpg"  alt="" title="Mohamed Diab et l&#039;équipe du film Esthebak (Clash) - Cérémonie d&#039;ouverture dans la salle Debussy" class="lazy">
        <div class="picto"><i class="icon icon_photo"></i></div>
        <div class="info">
          <div class="vCenter">
            <div class="vCenterKid">
              <span class="category">Sur Scène</span>
              <span class="date">12.05.16</span> . <span
                  class="hour">19:30</span>
              <p data-title="Mohamed Diab et l&#039;équipe du film Esthebak (Clash) - Cérémonie d&#039;ouverture dans la salle Debussy">Mohamed Diab et l&#039;équipe du film Esthebak (Clash) - Cérémonie d&#039;ouverture dans la salle Debussy</p>
            </div>
          </div>
        </div>
      </div>
      <div class="item montee-des-marches 12-05-16 shadow-bottom photo paysage notloaded">
        <a id="photo697" class="ajax chocolat-image" data-pid="697"
           href="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/05/0beac49858983b0f47a90fc87cccf7a143239239.jpg"
           title='<span class="category">Montée des Marches</span><span class="date">12.05.16 . 19:23</span><h2>Julia Roberts et George Clooney - Money Monster</h2>'
           data-credit="Crédit Image : Alberto Pizzoli / AFP"></a>
        <img data-original="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/05/thumb_4869_media_image_640x404.jpg"  alt="" title="Julia Roberts et George Clooney - Money Monster" class="lazy">
        <div class="picto"><i class="icon icon_photo"></i></div>
        <div class="info">
          <div class="vCenter">
            <div class="vCenterKid">
              <span class="category">Montée des Marches</span>
              <span class="date">12.05.16</span> . <span
                  class="hour">19:23</span>
              <p data-title="Julia Roberts et George Clooney - Money Monster">Julia Roberts et George Clooney - Money Monster</p>
            </div>
          </div>
        </div>
      </div>
      <div class="item montee-des-marches 12-05-16 shadow-bottom photo paysage notloaded">
        <a id="photo696" class="ajax chocolat-image" data-pid="696"
           href="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/05/109c665124d406067c03eaf27206c9d1459d0f14.jpg"
           title='<span class="category">Montée des Marches</span><span class="date">12.05.16 . 19:20</span><h2>Pierre Lescure, Amal Clooney et l&#039;équipe du film Money Monster</h2>'
           data-credit="Crédit Image : Alberto Pizzoli / AFP"></a>
        <img data-original="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/05/thumb_4868_media_image_640x404.jpg"  alt="" title="Pierre Lescure, Amal Clooney et l&#039;équipe du film Money Monster" class="lazy">
        <div class="picto"><i class="icon icon_photo"></i></div>
        <div class="info">
          <div class="vCenter">
            <div class="vCenterKid">
              <span class="category">Montée des Marches</span>
              <span class="date">12.05.16</span> . <span
                  class="hour">19:20</span>
              <p data-title="Pierre Lescure, Amal Clooney et l&#039;équipe du film Money Monster">Pierre Lescure, Amal Clooney et l&#039;équipe du film Money Monster</p>
            </div>
          </div>
        </div>
      </div>
      <div class="item montee-des-marches 12-05-16 shadow-bottom photo portrait notloaded">
        <a id="photo695" class="ajax chocolat-image" data-pid="695"
           href="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/05/515ade8102375255bf1891cba7cd05edcf3d1ce9.jpg"
           title='<span class="category">Montée des Marches</span><span class="date">12.05.16 . 19:15</span><h2>Franck Gastambide et Anouar Toubali</h2>'
           data-credit="Crédit Image : Loïc Venance / AFP"></a>
        <img data-original="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/05/thumb_4867_media_image_320x404.jpg"  alt="" title="Franck Gastambide et Anouar Toubali" class="lazy">
        <div class="picto"><i class="icon icon_photo"></i></div>
        <div class="info">
          <div class="vCenter">
            <div class="vCenterKid">
              <span class="category">Montée des Marches</span>
              <span class="date">12.05.16</span> . <span
                  class="hour">19:15</span>
              <p data-title="Franck Gastambide et Anouar Toubali">Franck Gastambide et Anouar Toubali</p>
            </div>
          </div>
        </div>
      </div>
      <div class="item montee-des-marches 12-05-16 shadow-bottom photo paysage notloaded">
        <a id="photo694" class="ajax chocolat-image" data-pid="694"
           href="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/05/d2a51d8506886ee775af4f8cc496da650cf40a8b.jpg"
           title='<span class="category">Montée des Marches</span><span class="date">12.05.16 . 19:12</span><h2>Amal Clooney, George Clooney et Julia Roberts</h2>'
           data-credit="Crédit Image : Alberto Pizzoli / AFP"></a>
        <img data-original="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/05/thumb_4866_media_image_640x404.jpg"  alt="" title="Amal Clooney, George Clooney et Julia Roberts" class="lazy">
        <div class="picto"><i class="icon icon_photo"></i></div>
        <div class="info">
          <div class="vCenter">
            <div class="vCenterKid">
              <span class="category">Montée des Marches</span>
              <span class="date">12.05.16</span> . <span
                  class="hour">19:12</span>
              <p data-title="Amal Clooney, George Clooney et Julia Roberts">Amal Clooney, George Clooney et Julia Roberts</p>
            </div>
          </div>
        </div>
      </div>
      <div class="item montee-des-marches 12-05-16 shadow-bottom photo portrait notloaded">
        <a id="photo693" class="ajax chocolat-image" data-pid="693"
           href="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/05/12603f1100b677192d0a9e1ab603af669855991d.jpg"
           title='<span class="category">Montée des Marches</span><span class="date">12.05.16 . 19:10</span><h2>George et Amal Clooney</h2>'
           data-credit="Crédit Image : Valéry Hache / AFP"></a>
        <img data-original="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/05/thumb_4865_media_image_320x404.jpg"  alt="" title="George et Amal Clooney" class="lazy">
        <div class="picto"><i class="icon icon_photo"></i></div>
        <div class="info">
          <div class="vCenter">
            <div class="vCenterKid">
              <span class="category">Montée des Marches</span>
              <span class="date">12.05.16</span> . <span
                  class="hour">19:10</span>
              <p data-title="George et Amal Clooney">George et Amal Clooney</p>
            </div>
          </div>
        </div>
      </div>
      <div class="item montee-des-marches 12-05-16 shadow-bottom photo portrait notloaded">
        <a id="photo691" class="ajax chocolat-image" data-pid="691"
           href="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/05/5bd03b6731e057595899048b6e42ca2ee6ba2b70.jpg"
           title='<span class="category">Montée des Marches</span><span class="date">12.05.16 . 19:07</span><h2>Jessica Chastain</h2>'
           data-credit="Crédit Image : Venturelli / Getty Images"></a>
        <img data-original="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/05/thumb_4863_media_image_320x404.jpg"  alt="" title="Jessica Chastain" class="lazy">
        <div class="picto"><i class="icon icon_photo"></i></div>
        <div class="info">
          <div class="vCenter">
            <div class="vCenterKid">
              <span class="category">Montée des Marches</span>
              <span class="date">12.05.16</span> . <span
                  class="hour">19:07</span>
              <p data-title="Jessica Chastain">Jessica Chastain</p>
            </div>
          </div>
        </div>
      </div>
      <div class="item montee-des-marches 12-05-16 shadow-bottom photo portrait notloaded">
        <a id="photo692" class="ajax chocolat-image" data-pid="692"
           href="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/05/5c6b5d9c1406b00d2b6054c931d696f5c8ccac74.jpg"
           title='<span class="category">Montée des Marches</span><span class="date">12.05.16 . 19:05</span><h2>Julia Roberts - Money Monster</h2>'
           data-credit="Crédit Image : Venturelli / Getty Images"></a>
        <img data-original="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/05/thumb_4864_media_image_320x404.jpg"  alt="" title="Julia Roberts - Money Monster" class="lazy">
        <div class="picto"><i class="icon icon_photo"></i></div>
        <div class="info">
          <div class="vCenter">
            <div class="vCenterKid">
              <span class="category">Montée des Marches</span>
              <span class="date">12.05.16</span> . <span
                  class="hour">19:05</span>
              <p data-title="Julia Roberts - Money Monster">Julia Roberts - Money Monster</p>
            </div>
          </div>
        </div>
      </div>
      <div class="item un-certain-regard 12-05-16 shadow-bottom photo paysage notloaded">
        <a id="photo706" class="ajax chocolat-image" data-pid="706"
           href="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/05/baebb055c820e1c07114deb868cee4386ec47280.jpg"
           title='<span class="category">Un Certain Regard</span><span class="date">12.05.16 . 18:55</span><h2>Équipe du film - Eshtebak (Clash)</h2>'
           data-credit="Crédit Image : Léo Laumont / FDC"></a>
        <img data-original="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/05/thumb_4878_media_image_640x404.jpg"  alt="" title="Équipe du film - Eshtebak (Clash)" class="lazy">
        <div class="picto"><i class="icon icon_photo"></i></div>
        <div class="info">
          <div class="vCenter">
            <div class="vCenterKid">
              <span class="category">Un Certain Regard</span>
              <span class="date">12.05.16</span> . <span
                  class="hour">18:55</span>
              <p data-title="Équipe du film - Eshtebak (Clash)">Équipe du film - Eshtebak (Clash)</p>
            </div>
          </div>
        </div>
      </div>
      <div class="item un-certain-regard 12-05-16 shadow-bottom photo portrait notloaded">
        <a id="photo703" class="ajax chocolat-image" data-pid="703"
           href="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/05/4cdba66fb8305b3317bd9df27840e1558c1c3756.jpg"
           title='<span class="category">Un Certain Regard</span><span class="date">12.05.16 . 18:50</span><h2>Jury Un Certain Regard</h2>'
           data-credit="Crédit Image : Léo Laumont / FDC"></a>
        <img data-original="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/05/thumb_4875_media_image_320x404.jpg"  alt="" title="Jury Un Certain Regard" class="lazy">
        <div class="picto"><i class="icon icon_photo"></i></div>
        <div class="info">
          <div class="vCenter">
            <div class="vCenterKid">
              <span class="category">Un Certain Regard</span>
              <span class="date">12.05.16</span> . <span
                  class="hour">18:50</span>
              <p data-title="Jury Un Certain Regard">Jury Un Certain Regard</p>
            </div>
          </div>
        </div>
      </div>
      <div class="item un-certain-regard 12-05-16 shadow-bottom photo paysage notloaded">
        <a id="photo700" class="ajax chocolat-image" data-pid="700"
           href="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/05/1ce509cf56392781111b223beef6c1e9c14ddcea.jpg"
           title='<span class="category">Un Certain Regard</span><span class="date">12.05.16 . 18:45</span><h2>Hany Adel - Eshtebak (Clash)</h2>'
           data-credit="Crédit Image : Léo Laumont / FDC"></a>
        <img data-original="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/05/thumb_4874_media_image_640x404.jpg"  alt="" title="Hany Adel - Eshtebak (Clash)" class="lazy">
        <div class="picto"><i class="icon icon_photo"></i></div>
        <div class="info">
          <div class="vCenter">
            <div class="vCenterKid">
              <span class="category">Un Certain Regard</span>
              <span class="date">12.05.16</span> . <span
                  class="hour">18:45</span>
              <p data-title="Hany Adel - Eshtebak (Clash)">Hany Adel - Eshtebak (Clash)</p>
            </div>
          </div>
        </div>
      </div>
      <div class="item montee-des-marches 12-05-16 shadow-bottom photo paysage notloaded">
        <a id="photo713" class="ajax chocolat-image" data-pid="713"
           href="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/05/9f6061d026bf5fe3141f837c854fc08531963283.JPG"
           title='<span class="category">Montée des Marches</span><span class="date">12.05.16 . 17:30</span><h2>James Ivory, Vanessa Redgrave, Charles S.Cohen et Clo Cohen - Howards End</h2>'
           data-credit="Crédit Image : Mathilde Petit / FDC"></a>
        <img data-original="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/05/thumb_4885_media_image_640x404.JPG"  alt="" title="James Ivory, Vanessa Redgrave, Charles S.Cohen et Clo Cohen - Howards End" class="lazy">
        <div class="picto"><i class="icon icon_photo"></i></div>
        <div class="info">
          <div class="vCenter">
            <div class="vCenterKid">
              <span class="category">Montée des Marches</span>
              <span class="date">12.05.16</span> . <span
                  class="hour">17:30</span>
              <p data-title="James Ivory, Vanessa Redgrave, Charles S.Cohen et Clo Cohen - Howards End">James Ivory, Vanessa Redgrave, Charles S.Cohen et Clo Cohen - Howards End</p>
            </div>
          </div>
        </div>
      </div>
      <div class="item montee-des-marches 12-05-16 shadow-bottom photo paysage notloaded">
        <a id="photo689" class="ajax chocolat-image" data-pid="689"
           href="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/05/bf0658a3d03961c6c1d1c03d72486d2b476df818.jpg"
           title='<span class="category">Montée des Marches</span><span class="date">12.05.16 . 17:00</span><h2>Jury Un Certain Regard</h2>'
           data-credit="Crédit Image : Antonin Thuillier / AFP"></a>
        <img data-original="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/05/thumb_4860_media_image_640x404.jpg"  alt="" title="Jury Un Certain Regard" class="lazy">
        <div class="picto"><i class="icon icon_photo"></i></div>
        <div class="info">
          <div class="vCenter">
            <div class="vCenterKid">
              <span class="category">Montée des Marches</span>
              <span class="date">12.05.16</span> . <span
                  class="hour">17:00</span>
              <p data-title="Jury Un Certain Regard">Jury Un Certain Regard</p>
            </div>
          </div>
        </div>
      </div>
      <div class="item montee-des-marches 12-05-16 shadow-bottom photo paysage notloaded">
        <a id="photo665" class="ajax chocolat-image" data-pid="665"
           href="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/05/af492b95ff410aa642dc935b49545f4361ebaebc.jpg"
           title='<span class="category">Montée des Marches</span><span class="date">12.05.16 . 15:33</span><h2>Équipe du film - Sieranevada</h2>'
           data-credit="Crédit Image : Thomas Leibreich / FDC"></a>
        <img data-original="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/05/thumb_4834_media_image_640x404.jpg"  alt="" title="Équipe du film - Sieranevada" class="lazy">
        <div class="picto"><i class="icon icon_photo"></i></div>
        <div class="info">
          <div class="vCenter">
            <div class="vCenterKid">
              <span class="category">Montée des Marches</span>
              <span class="date">12.05.16</span> . <span
                  class="hour">15:33</span>
              <p data-title="Équipe du film - Sieranevada">Équipe du film - Sieranevada</p>
            </div>
          </div>
        </div>
      </div>
      <div class="item montee-des-marches 12-05-16 shadow-bottom photo paysage notloaded">
        <a id="photo662" class="ajax chocolat-image" data-pid="662"
           href="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/05/d8aee366564a8e43c534a5963e221b4dde0d5a96.jpg"
           title='<span class="category">Montée des Marches</span><span class="date">12.05.16 . 15:30</span><h2>Pierre Lescure et l&#039;équipe du film - Sieranevada</h2>'
           data-credit="Crédit Image : Thomas Leibreich / FDC"></a>
        <img data-original="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/05/thumb_4831_media_image_640x404.jpg"  alt="" title="Pierre Lescure et l&#039;équipe du film - Sieranevada" class="lazy">
        <div class="picto"><i class="icon icon_photo"></i></div>
        <div class="info">
          <div class="vCenter">
            <div class="vCenterKid">
              <span class="category">Montée des Marches</span>
              <span class="date">12.05.16</span> . <span
                  class="hour">15:30</span>
              <p data-title="Pierre Lescure et l&#039;équipe du film - Sieranevada">Pierre Lescure et l&#039;équipe du film - Sieranevada</p>
            </div>
          </div>
        </div>
      </div>
      <div class="item conference-de-presse 12-05-16 shadow-bottom photo paysage notloaded">
        <a id="photo704" class="ajax chocolat-image" data-pid="704"
           href="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/05/1ceedb76a6917a6140f3d8dc57f7dd91ff73a9c5.jpg"
           title='<span class="category">Conférence de Presse</span><span class="date">12.05.16 . 14:30</span><h2>Équipe du film - Money Monster</h2>'
           data-credit="Crédit Image : Mathilde Petit / FDC"></a>
        <img data-original="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/05/thumb_4877_media_image_640x404.jpg"  alt="" title="Équipe du film - Money Monster" class="lazy">
        <div class="picto"><i class="icon icon_photo"></i></div>
        <div class="info">
          <div class="vCenter">
            <div class="vCenterKid">
              <span class="category">Conférence de Presse</span>
              <span class="date">12.05.16</span> . <span
                  class="hour">14:30</span>
              <p data-title="Équipe du film - Money Monster">Équipe du film - Money Monster</p>
            </div>
          </div>
        </div>
      </div>
      <div class="item conference-de-presse 12-05-16 shadow-bottom photo paysage notloaded">
        <a id="photo653" class="ajax chocolat-image" data-pid="653"
           href="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/05/c6880af595b372c4a2c4fa282497880816d6f96d.JPG"
           title='<span class="category">Conférence de Presse</span><span class="date">12.05.16 . 14:15</span><h2>Julia Roberts et Georges Clooney - Money Monster</h2>'
           data-credit="Crédit Image : Thomas Leibreich / FDC"></a>
        <img data-original="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/05/thumb_4822_media_image_640x404.JPG"  alt="" title="Julia Roberts et Georges Clooney - Money Monster" class="lazy">
        <div class="picto"><i class="icon icon_photo"></i></div>
        <div class="info">
          <div class="vCenter">
            <div class="vCenterKid">
              <span class="category">Conférence de Presse</span>
              <span class="date">12.05.16</span> . <span
                  class="hour">14:15</span>
              <p data-title="Julia Roberts et Georges Clooney - Money Monster">Julia Roberts et Georges Clooney - Money Monster</p>
            </div>
          </div>
        </div>
      </div>
      <div class="item photocall 12-05-16 shadow-bottom photo paysage notloaded">
        <a id="photo652" class="ajax chocolat-image" data-pid="652"
           href="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/05/fc5ce312871168051e188723f3807555828b3a87.jpg"
           title='<span class="category">Photocall</span><span class="date">12.05.16 . 14:11</span><h2>James Ivory,  Vanessa Redgrave et Charles S.Cohen - Howards End (Retour à Howards End)</h2>'
           data-credit="Crédit Image : Loïc Venance / AFP"></a>
        <img data-original="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/05/thumb_4821_media_image_640x404.jpg"  alt="" title="James Ivory,  Vanessa Redgrave et Charles S.Cohen - Howards End (Retour à Howards End)" class="lazy">
        <div class="picto"><i class="icon icon_photo"></i></div>
        <div class="info">
          <div class="vCenter">
            <div class="vCenterKid">
              <span class="category">Photocall</span>
              <span class="date">12.05.16</span> . <span
                  class="hour">14:11</span>
              <p data-title="James Ivory,  Vanessa Redgrave et Charles S.Cohen - Howards End (Retour à Howards End)">James Ivory,  Vanessa Redgrave et Charles S.Cohen - Howards End (Retour à Howards End)</p>
            </div>
          </div>
        </div>
      </div>
      <div class="item photocall 12-05-16 shadow-bottom photo paysage notloaded">
        <a id="photo649" class="ajax chocolat-image" data-pid="649"
           href="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/05/70a35dbfa8c4089a0c1ab6e5a59b175007fadd18.jpg"
           title='<span class="category">Photocall</span><span class="date">12.05.16 . 14:09</span><h2>Vanessa Redgrave - Howards End (Retour à Howards End)</h2>'
           data-credit="Crédit Image : Loïc Venance / AFP"></a>
        <img data-original="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/05/thumb_4814_media_image_640x404.jpg"  alt="" title="Vanessa Redgrave - Howards End (Retour à Howards End)" class="lazy">
        <div class="picto"><i class="icon icon_photo"></i></div>
        <div class="info">
          <div class="vCenter">
            <div class="vCenterKid">
              <span class="category">Photocall</span>
              <span class="date">12.05.16</span> . <span
                  class="hour">14:09</span>
              <p data-title="Vanessa Redgrave - Howards End (Retour à Howards End)">Vanessa Redgrave - Howards End (Retour à Howards End)</p>
            </div>
          </div>
        </div>
      </div>
      <div class="item photocall 12-05-16 shadow-bottom photo paysage notloaded">
        <a id="photo679" class="ajax chocolat-image" data-pid="679"
           href="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/05/9ff4bef5ea823c89665bc8ecf462499454104a8a.jpg"
           title='<span class="category">Photocall</span><span class="date">12.05.16 . 14:05</span><h2>Équipe du film - Money Monster</h2>'
           data-credit="Crédit Image : Dominique Charriau / Getty Images"></a>
        <img data-original="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/05/thumb_4850_media_image_640x404.jpg"  alt="" title="Équipe du film - Money Monster" class="lazy">
        <div class="picto"><i class="icon icon_photo"></i></div>
        <div class="info">
          <div class="vCenter">
            <div class="vCenterKid">
              <span class="category">Photocall</span>
              <span class="date">12.05.16</span> . <span
                  class="hour">14:05</span>
              <p data-title="Équipe du film - Money Monster">Équipe du film - Money Monster</p>
            </div>
          </div>
        </div>
      </div>
      <div class="item photocall 12-05-16 shadow-bottom photo portrait notloaded">
        <a id="photo646" class="ajax chocolat-image" data-pid="646"
           href="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/05/b75678025615b08a62d3a3d60025977a51674d7b.jpg"
           title='<span class="category">Photocall</span><span class="date">12.05.16 . 14:04</span><h2>James Ivory - Howards End (Retour à Howards End)</h2>'
           data-credit="Crédit Image : Loïc Venance / AFP"></a>
        <img data-original="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/05/thumb_4813_media_image_320x404.jpg"  alt="" title="James Ivory - Howards End (Retour à Howards End)" class="lazy">
        <div class="picto"><i class="icon icon_photo"></i></div>
        <div class="info">
          <div class="vCenter">
            <div class="vCenterKid">
              <span class="category">Photocall</span>
              <span class="date">12.05.16</span> . <span
                  class="hour">14:04</span>
              <p data-title="James Ivory - Howards End (Retour à Howards End)">James Ivory - Howards End (Retour à Howards End)</p>
            </div>
          </div>
        </div>
      </div>
      <div class="item photocall 12-05-16 shadow-bottom photo portrait notloaded">
        <a id="photo650" class="ajax chocolat-image" data-pid="650"
           href="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/05/82cfae9fe59a6f36edf022abf353c306c64a126b.jpg"
           title='<span class="category">Photocall</span><span class="date">12.05.16 . 14:04</span><h2>Julia Roberts - Money Monster</h2>'
           data-credit="Crédit Image : George Pimentel / Getty Images"></a>
        <img data-original="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/05/thumb_4820_media_image_320x404.jpg"  alt="" title="Julia Roberts - Money Monster" class="lazy">
        <div class="picto"><i class="icon icon_photo"></i></div>
        <div class="info">
          <div class="vCenter">
            <div class="vCenterKid">
              <span class="category">Photocall</span>
              <span class="date">12.05.16</span> . <span
                  class="hour">14:04</span>
              <p data-title="Julia Roberts - Money Monster">Julia Roberts - Money Monster</p>
            </div>
          </div>
        </div>
      </div>
      <div class="item photocall 12-05-16 shadow-bottom photo paysage notloaded">
        <a id="photo636" class="ajax chocolat-image" data-pid="636"
           href="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/05/bf694763fb38b27f098c9128d56d57053e72af0d.jpg"
           title='<span class="category">Photocall</span><span class="date">12.05.16 . 14:03</span><h2>Jodie Foster - Money Monster</h2>'
           data-credit="Crédit Image : Venturelli / Getty Images"></a>
        <img data-original="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/05/thumb_4825_media_image_640x404.jpg"  alt="" title="Jodie Foster - Money Monster" class="lazy">
        <div class="picto"><i class="icon icon_photo"></i></div>
        <div class="info">
          <div class="vCenter">
            <div class="vCenterKid">
              <span class="category">Photocall</span>
              <span class="date">12.05.16</span> . <span
                  class="hour">14:03</span>
              <p data-title="Jodie Foster - Money Monster">Jodie Foster - Money Monster</p>
            </div>
          </div>
        </div>
      </div>
      <div class="item photocall 12-05-16 shadow-bottom photo paysage notloaded">
        <a id="photo642" class="ajax chocolat-image" data-pid="642"
           href="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/05/220deb7a6236803c12b17a917ad1839dca27f8d8.jpg"
           title='<span class="category">Photocall</span><span class="date">12.05.16 . 13:40</span><h2>George Clooney, Jodie Foster et Julia Roberts - Money Monster</h2>'
           data-credit="Crédit Image : Anne-Christine Poujoulat / AFP"></a>
        <img data-original="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/05/thumb_4804_media_image_640x404.jpg"  alt="" title="George Clooney, Jodie Foster et Julia Roberts - Money Monster" class="lazy">
        <div class="picto"><i class="icon icon_photo"></i></div>
        <div class="info">
          <div class="vCenter">
            <div class="vCenterKid">
              <span class="category">Photocall</span>
              <span class="date">12.05.16</span> . <span
                  class="hour">13:40</span>
              <p data-title="George Clooney, Jodie Foster et Julia Roberts - Money Monster">George Clooney, Jodie Foster et Julia Roberts - Money Monster</p>
            </div>
          </div>
        </div>
      </div>
      <div class="item photocall 12-05-16 shadow-bottom photo portrait notloaded">
        <a id="photo640" class="ajax chocolat-image" data-pid="640"
           href="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/05/a1c97a73bd90937810ff570ba092d85b12b2a761.jpg"
           title='<span class="category">Photocall</span><span class="date">12.05.16 . 13:38</span><h2>Jodie Foster - Money Monster</h2>'
           data-credit="Crédit Image : Venturelli / Getty Images"></a>
        <img data-original="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/05/thumb_4800_media_image_320x404.jpg"  alt="" title="Jodie Foster - Money Monster" class="lazy">
        <div class="picto"><i class="icon icon_photo"></i></div>
        <div class="info">
          <div class="vCenter">
            <div class="vCenterKid">
              <span class="category">Photocall</span>
              <span class="date">12.05.16</span> . <span
                  class="hour">13:38</span>
              <p data-title="Jodie Foster - Money Monster">Jodie Foster - Money Monster</p>
            </div>
          </div>
        </div>
      </div>
      <div class="item photocall 12-05-16 shadow-bottom photo portrait notloaded">
        <a id="photo638" class="ajax chocolat-image" data-pid="638"
           href="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/05/33e624e7c1ce9c28d8497f6ba0546919516bbd2a.jpg"
           title='<span class="category">Photocall</span><span class="date">12.05.16 . 13:35</span><h2>George Clooney - Money Monster</h2>'
           data-credit="Crédit Image : Venturelli / Getty Images"></a>
        <img data-original="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/05/thumb_4798_media_image_320x404.jpg"  alt="" title="George Clooney - Money Monster" class="lazy">
        <div class="picto"><i class="icon icon_photo"></i></div>
        <div class="info">
          <div class="vCenter">
            <div class="vCenterKid">
              <span class="category">Photocall</span>
              <span class="date">12.05.16</span> . <span
                  class="hour">13:35</span>
              <p data-title="George Clooney - Money Monster">George Clooney - Money Monster</p>
            </div>
          </div>
        </div>
      </div>
      <div class="item competition 12-05-16 shadow-bottom photo paysage notloaded">
        <a id="photo648" class="ajax chocolat-image" data-pid="648"
           href="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/05/a74fb715a649492995bbe335f5922c7829b8d07c.jpg"
           title='<span class="category">Compétition</span><span class="date">12.05.16 . 12:40</span><h2>Cristi Puiu - Sieranevada</h2>'
           data-credit="Crédit Image : Léo Laumont / FDC"></a>
        <img data-original="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/05/thumb_4816_media_image_640x404.jpg"  alt="" title="Cristi Puiu - Sieranevada" class="lazy">
        <div class="picto"><i class="icon icon_photo"></i></div>
        <div class="info">
          <div class="vCenter">
            <div class="vCenterKid">
              <span class="category">Compétition</span>
              <span class="date">12.05.16</span> . <span
                  class="hour">12:40</span>
              <p data-title="Cristi Puiu - Sieranevada">Cristi Puiu - Sieranevada</p>
            </div>
          </div>
        </div>
      </div>
      <div class="item conference-de-presse 12-05-16 shadow-bottom photo paysage notloaded">
        <a id="photo627" class="ajax chocolat-image" data-pid="627"
           href="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/05/78c23c5fea60260a8fe6b7bb2335629dc8943f56.jpg"
           title='<span class="category">Conférence de Presse</span><span class="date">12.05.16 . 12:20</span><h2>Mimi Branescu, Dana Dogaru et Anca Puiu - Sieranevada</h2>'
           data-credit="Crédit Image : Ian Gavan / Getty Images"></a>
        <img data-original="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/05/thumb_4791_media_image_640x404.jpg"  alt="" title="Mimi Branescu, Dana Dogaru et Anca Puiu - Sieranevada" class="lazy">
        <div class="picto"><i class="icon icon_photo"></i></div>
        <div class="info">
          <div class="vCenter">
            <div class="vCenterKid">
              <span class="category">Conférence de Presse</span>
              <span class="date">12.05.16</span> . <span
                  class="hour">12:20</span>
              <p data-title="Mimi Branescu, Dana Dogaru et Anca Puiu - Sieranevada">Mimi Branescu, Dana Dogaru et Anca Puiu - Sieranevada</p>
            </div>
          </div>
        </div>
      </div>
      <div class="item photocall 12-05-16 shadow-bottom photo paysage notloaded">
        <a id="photo623" class="ajax chocolat-image" data-pid="623"
           href="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/05/57c1924adf3eaec7432afd9b822665414d05a2ab.jpg"
           title='<span class="category">Photocall</span><span class="date">12.05.16 . 12:15</span><h2>Doraid Liddawi - Sieranevada</h2>'
           data-credit="Crédit Image : Valéry Hache / AFP"></a>
        <img data-original="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/05/thumb_4786_media_image_640x404.jpg"  alt="" title="Doraid Liddawi - Sieranevada" class="lazy">
        <div class="picto"><i class="icon icon_photo"></i></div>
        <div class="info">
          <div class="vCenter">
            <div class="vCenterKid">
              <span class="category">Photocall</span>
              <span class="date">12.05.16</span> . <span
                  class="hour">12:15</span>
              <p data-title="Doraid Liddawi - Sieranevada">Doraid Liddawi - Sieranevada</p>
            </div>
          </div>
        </div>
      </div>
      <div class="item photocall 12-05-16 shadow-bottom photo paysage notloaded">
        <a id="photo622" class="ajax chocolat-image" data-pid="622"
           href="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/05/38608348eb34bd4ed666a17449ab815eaf74f8d4.jpg"
           title='<span class="category">Photocall</span><span class="date">12.05.16 . 12:13</span><h2>Cristi Puiu - Sieranevada</h2>'
           data-credit="Crédit Image : Thomas Leibreich / FDC"></a>
        <img data-original="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/05/thumb_4785_media_image_640x404.jpg"  alt="" title="Cristi Puiu - Sieranevada" class="lazy">
        <div class="picto"><i class="icon icon_photo"></i></div>
        <div class="info">
          <div class="vCenter">
            <div class="vCenterKid">
              <span class="category">Photocall</span>
              <span class="date">12.05.16</span> . <span
                  class="hour">12:13</span>
              <p data-title="Cristi Puiu - Sieranevada">Cristi Puiu - Sieranevada</p>
            </div>
          </div>
        </div>
      </div>
      <div class="item photocall 12-05-16 shadow-bottom photo paysage notloaded">
        <a id="photo621" class="ajax chocolat-image" data-pid="621"
           href="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/05/50b2be78ffecb0926fc4610a37dec27c46395a24.jpg"
           title='<span class="category">Photocall</span><span class="date">12.05.16 . 12:10</span><h2>Mimi Branescu et Dana Dogaru - Sieranevada</h2>'
           data-credit="Crédit Image : Thomas Leibreich / FDC"></a>
        <img data-original="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/05/thumb_4784_media_image_640x404.jpg"  alt="" title="Mimi Branescu et Dana Dogaru - Sieranevada" class="lazy">
        <div class="picto"><i class="icon icon_photo"></i></div>
        <div class="info">
          <div class="vCenter">
            <div class="vCenterKid">
              <span class="category">Photocall</span>
              <span class="date">12.05.16</span> . <span
                  class="hour">12:10</span>
              <p data-title="Mimi Branescu et Dana Dogaru - Sieranevada">Mimi Branescu et Dana Dogaru - Sieranevada</p>
            </div>
          </div>
        </div>
      </div>
      <div class="item photocall 12-05-16 shadow-bottom photo paysage notloaded">
        <a id="photo619" class="ajax chocolat-image" data-pid="619"
           href="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/05/451b931fa0252811bbf2452b238754058ca72820.jpg"
           title='<span class="category">Photocall</span><span class="date">12.05.16 . 12:07</span><h2>Mimi Branescu, Anca Puiu, Dana Dogaru et Cristi Puiu - Sieranevada</h2>'
           data-credit="Crédit Image : Thomas Leibreich / FDC"></a>
        <img data-original="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/05/thumb_4780_media_image_640x404.jpg"  alt="" title="Mimi Branescu, Anca Puiu, Dana Dogaru et Cristi Puiu - Sieranevada" class="lazy">
        <div class="picto"><i class="icon icon_photo"></i></div>
        <div class="info">
          <div class="vCenter">
            <div class="vCenterKid">
              <span class="category">Photocall</span>
              <span class="date">12.05.16</span> . <span
                  class="hour">12:07</span>
              <p data-title="Mimi Branescu, Anca Puiu, Dana Dogaru et Cristi Puiu - Sieranevada">Mimi Branescu, Anca Puiu, Dana Dogaru et Cristi Puiu - Sieranevada</p>
            </div>
          </div>
        </div>
      </div>
      <div class="item photocall 12-05-16 shadow-bottom photo paysage notloaded">
        <a id="photo616" class="ajax chocolat-image" data-pid="616"
           href="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/05/2f90c061b65b56fafe955c7dcda9ffe24fb917eb.JPG"
           title='<span class="category">Photocall</span><span class="date">12.05.16 . 12:06</span><h2>Maisa Abd Elhadi - Omor Shakhsiya (Personal Affairs)</h2>'
           data-credit="Crédit Image : Thomas Leibreich / FDC"></a>
        <img data-original="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/05/thumb_4778_media_image_640x404.JPG"  alt="" title="Maisa Abd Elhadi - Omor Shakhsiya (Personal Affairs)" class="lazy">
        <div class="picto"><i class="icon icon_photo"></i></div>
        <div class="info">
          <div class="vCenter">
            <div class="vCenterKid">
              <span class="category">Photocall</span>
              <span class="date">12.05.16</span> . <span
                  class="hour">12:06</span>
              <p data-title="Maisa Abd Elhadi - Omor Shakhsiya (Personal Affairs)">Maisa Abd Elhadi - Omor Shakhsiya (Personal Affairs)</p>
            </div>
          </div>
        </div>
      </div>
      <div class="item photocall 12-05-16 shadow-bottom photo paysage notloaded">
        <a id="photo615" class="ajax chocolat-image" data-pid="615"
           href="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/05/7dd79405e28a0b2763870773d24a8d1e020770a1.JPG"
           title='<span class="category">Photocall</span><span class="date">12.05.16 . 12:05</span><h2>Maha Haj - Omor Shakhsiya (Personal Affairs)</h2>'
           data-credit="Crédit Image : Thomas Leibreich / FDC"></a>
        <img data-original="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/05/thumb_4777_media_image_640x404.JPG"  alt="" title="Maha Haj - Omor Shakhsiya (Personal Affairs)" class="lazy">
        <div class="picto"><i class="icon icon_photo"></i></div>
        <div class="info">
          <div class="vCenter">
            <div class="vCenterKid">
              <span class="category">Photocall</span>
              <span class="date">12.05.16</span> . <span
                  class="hour">12:05</span>
              <p data-title="Maha Haj - Omor Shakhsiya (Personal Affairs)">Maha Haj - Omor Shakhsiya (Personal Affairs)</p>
            </div>
          </div>
        </div>
      </div>
      <div class="item photocall 12-05-16 shadow-bottom photo paysage notloaded">
        <a id="photo614" class="ajax chocolat-image" data-pid="614"
           href="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/05/2a112e5b50e3eb4f09499112f83c398abdd01972.JPG"
           title='<span class="category">Photocall</span><span class="date">12.05.16 . 12:03</span><h2>Équipe du film - Omor Shakhsiya (Personal Affairs)</h2>'
           data-credit="Crédit Image : Thomas Leibreich / FDC"></a>
        <img data-original="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/05/thumb_4776_media_image_640x404.JPG"  alt="" title="Équipe du film - Omor Shakhsiya (Personal Affairs)" class="lazy">
        <div class="picto"><i class="icon icon_photo"></i></div>
        <div class="info">
          <div class="vCenter">
            <div class="vCenterKid">
              <span class="category">Photocall</span>
              <span class="date">12.05.16</span> . <span
                  class="hour">12:03</span>
              <p data-title="Équipe du film - Omor Shakhsiya (Personal Affairs)">Équipe du film - Omor Shakhsiya (Personal Affairs)</p>
            </div>
          </div>
        </div>
      </div>
      <div class="item photocall 12-05-16 shadow-bottom photo paysage notloaded">
        <a id="photo613" class="ajax chocolat-image" data-pid="613"
           href="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/05/5287b091058042e3f86c399b8669047e2b8e3791.JPG"
           title='<span class="category">Photocall</span><span class="date">12.05.16 . 12:00</span><h2>Maisa Abd Elhadi - Omor Shakhsiya (Personal Affairs)</h2>'
           data-credit="Crédit Image : Thomas Leibreich / FDC"></a>
        <img data-original="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/05/thumb_4775_media_image_640x404.JPG"  alt="" title="Maisa Abd Elhadi - Omor Shakhsiya (Personal Affairs)" class="lazy">
        <div class="picto"><i class="icon icon_photo"></i></div>
        <div class="info">
          <div class="vCenter">
            <div class="vCenterKid">
              <span class="category">Photocall</span>
              <span class="date">12.05.16</span> . <span
                  class="hour">12:00</span>
              <p data-title="Maisa Abd Elhadi - Omor Shakhsiya (Personal Affairs)">Maisa Abd Elhadi - Omor Shakhsiya (Personal Affairs)</p>
            </div>
          </div>
        </div>
      </div>
      <div class="item conference-de-presse 12-05-16 shadow-bottom photo paysage notloaded">
        <a id="photo609" class="ajax chocolat-image" data-pid="609"
           href="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/05/82cdd8221c5f9eac4b751bc6e98bf04bbb8d1ceb.JPG"
           title='<span class="category">Conférence de Presse</span><span class="date">12.05.16 . 11:05</span><h2>Raphaël Thiery - Rester Vertical</h2>'
           data-credit="Crédit Image : Thomas Leibreich / FDC"></a>
        <img data-original="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/05/thumb_4773_media_image_640x404.JPG"  alt="" title="Raphaël Thiery - Rester Vertical" class="lazy">
        <div class="picto"><i class="icon icon_photo"></i></div>
        <div class="info">
          <div class="vCenter">
            <div class="vCenterKid">
              <span class="category">Conférence de Presse</span>
              <span class="date">12.05.16</span> . <span
                  class="hour">11:05</span>
              <p data-title="Raphaël Thiery - Rester Vertical">Raphaël Thiery - Rester Vertical</p>
            </div>
          </div>
        </div>
      </div>
      <div class="item conference-de-presse 12-05-16 shadow-bottom photo paysage notloaded">
        <a id="photo608" class="ajax chocolat-image" data-pid="608"
           href="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/05/c6df828d66fa2fe31af4f8e9e25cba7495262fb7.JPG"
           title='<span class="category">Conférence de Presse</span><span class="date">12.05.16 . 11:00</span><h2>Équipe du film - Rester Vertical</h2>'
           data-credit="Crédit Image : Thomas Leibreich / FDC"></a>
        <img data-original="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/05/thumb_4772_media_image_640x404.JPG"  alt="" title="Équipe du film - Rester Vertical" class="lazy">
        <div class="picto"><i class="icon icon_photo"></i></div>
        <div class="info">
          <div class="vCenter">
            <div class="vCenterKid">
              <span class="category">Conférence de Presse</span>
              <span class="date">12.05.16</span> . <span
                  class="hour">11:00</span>
              <p data-title="Équipe du film - Rester Vertical">Équipe du film - Rester Vertical</p>
            </div>
          </div>
        </div>
      </div>
      <div class="item photocall 12-05-16 shadow-bottom photo portrait notloaded">
        <a id="photo673" class="ajax chocolat-image" data-pid="673"
           href="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/05/6c851b655074d04af522ea5623131981cb6b9e49.jpg"
           title='<span class="category">Photocall</span><span class="date">12.05.16 . 10:49</span><h2>Davide Del Degan - l&#039;Ultima Spiaggia</h2>'
           data-credit="Crédit Image : Alberto Pizzoli / AFP"></a>
        <img data-original="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/05/thumb_4845_media_image_320x404.jpg"  alt="" title="Davide Del Degan - l&#039;Ultima Spiaggia" class="lazy">
        <div class="picto"><i class="icon icon_photo"></i></div>
        <div class="info">
          <div class="vCenter">
            <div class="vCenterKid">
              <span class="category">Photocall</span>
              <span class="date">12.05.16</span> . <span
                  class="hour">10:49</span>
              <p data-title="Davide Del Degan - l&#039;Ultima Spiaggia">Davide Del Degan - l&#039;Ultima Spiaggia</p>
            </div>
          </div>
        </div>
      </div>
      <div class="item photocall 12-05-16 shadow-bottom photo paysage notloaded">
        <a id="photo671" class="ajax chocolat-image" data-pid="671"
           href="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/05/16e943f8dc09c0a63f4b12831879be78fe4dba8b.jpg"
           title='<span class="category">Photocall</span><span class="date">12.05.16 . 10:48</span><h2>Thanos Anastopoulos - L&#039;Ultima Spiaggia</h2>'
           data-credit="Crédit Image : Alberto Pizzoli / AFP"></a>
        <img data-original="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/05/thumb_4843_media_image_640x404.jpg"  alt="" title="Thanos Anastopoulos - L&#039;Ultima Spiaggia" class="lazy">
        <div class="picto"><i class="icon icon_photo"></i></div>
        <div class="info">
          <div class="vCenter">
            <div class="vCenterKid">
              <span class="category">Photocall</span>
              <span class="date">12.05.16</span> . <span
                  class="hour">10:48</span>
              <p data-title="Thanos Anastopoulos - L&#039;Ultima Spiaggia">Thanos Anastopoulos - L&#039;Ultima Spiaggia</p>
            </div>
          </div>
        </div>
      </div>
      <div class="item photocall 12-05-16 shadow-bottom photo paysage notloaded">
        <a id="photo599" class="ajax chocolat-image" data-pid="599"
           href="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/05/86ff16560094a2f187acde1efc871ea59a431114.jpg"
           title='<span class="category">Photocall</span><span class="date">12.05.16 . 10:46</span><h2>Laure Calamy - Rester Vertical</h2>'
           data-credit="Crédit Image : Alberto Pizzoli / AFP"></a>
        <img data-original="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/05/thumb_4766_media_image_640x404.jpg"  alt="" title="Laure Calamy - Rester Vertical" class="lazy">
        <div class="picto"><i class="icon icon_photo"></i></div>
        <div class="info">
          <div class="vCenter">
            <div class="vCenterKid">
              <span class="category">Photocall</span>
              <span class="date">12.05.16</span> . <span
                  class="hour">10:46</span>
              <p data-title="Laure Calamy - Rester Vertical">Laure Calamy - Rester Vertical</p>
            </div>
          </div>
        </div>
      </div>
      <div class="item photocall 12-05-16 shadow-bottom photo paysage notloaded">
        <a id="photo602" class="ajax chocolat-image" data-pid="602"
           href="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/05/3125bb2f3501a2c802efa984044ab90ac85c108e.jpg"
           title='<span class="category">Photocall</span><span class="date">12.05.16 . 10:46</span><h2>Davide Del Degan et  Thanos Anastopoulos - L&#039;Ultima Spiaggia</h2>'
           data-credit="Crédit Image : Alberto Pizzoli / AFP"></a>
        <img data-original="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/05/thumb_4767_media_image_640x404.jpg"  alt="" title="Davide Del Degan et  Thanos Anastopoulos - L&#039;Ultima Spiaggia" class="lazy">
        <div class="picto"><i class="icon icon_photo"></i></div>
        <div class="info">
          <div class="vCenter">
            <div class="vCenterKid">
              <span class="category">Photocall</span>
              <span class="date">12.05.16</span> . <span
                  class="hour">10:46</span>
              <p data-title="Davide Del Degan et  Thanos Anastopoulos - L&#039;Ultima Spiaggia">Davide Del Degan et  Thanos Anastopoulos - L&#039;Ultima Spiaggia</p>
            </div>
          </div>
        </div>
      </div>
      <div class="item photocall 12-05-16 shadow-bottom photo paysage notloaded">
        <a id="photo598" class="ajax chocolat-image" data-pid="598"
           href="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/05/1415e7fdc71d4364890a4b14ee7bf0a5bf7c372b.JPG"
           title='<span class="category">Photocall</span><span class="date">12.05.16 . 10:42</span><h2>Équipe du film - Rester Vertical</h2>'
           data-credit="Crédit Image : Léo Laumont / FDC"></a>
        <img data-original="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/05/thumb_4764_media_image_640x404.JPG"  alt="" title="Équipe du film - Rester Vertical" class="lazy">
        <div class="picto"><i class="icon icon_photo"></i></div>
        <div class="info">
          <div class="vCenter">
            <div class="vCenterKid">
              <span class="category">Photocall</span>
              <span class="date">12.05.16</span> . <span
                  class="hour">10:42</span>
              <p data-title="Équipe du film - Rester Vertical">Équipe du film - Rester Vertical</p>
            </div>
          </div>
        </div>
      </div>
      <div class="item photocall 12-05-16 shadow-bottom photo paysage notloaded">
        <a id="photo595" class="ajax chocolat-image" data-pid="595"
           href="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/05/e3e74c172820574649a4736c099d0efaa214ad9d.JPG"
           title='<span class="category">Photocall</span><span class="date">12.05.16 . 10:40</span><h2>Damien Bonnard, Alain Guiraudie et India Hair - Rester Vertical</h2>'
           data-credit="Crédit Image : Léo Laumont / FDC"></a>
        <img data-original="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/05/thumb_4762_media_image_640x404.JPG"  alt="" title="Damien Bonnard, Alain Guiraudie et India Hair - Rester Vertical" class="lazy">
        <div class="picto"><i class="icon icon_photo"></i></div>
        <div class="info">
          <div class="vCenter">
            <div class="vCenterKid">
              <span class="category">Photocall</span>
              <span class="date">12.05.16</span> . <span
                  class="hour">10:40</span>
              <p data-title="Damien Bonnard, Alain Guiraudie et India Hair - Rester Vertical">Damien Bonnard, Alain Guiraudie et India Hair - Rester Vertical</p>
            </div>
          </div>
        </div>
      </div>
      <div class="item photocall 12-05-16 shadow-bottom photo paysage notloaded">
        <a id="photo593" class="ajax chocolat-image" data-pid="593"
           href="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/05/53f0e95d4d7c63955f7862acc081c347da4000de.jpg"
           title='<span class="category">Photocall</span><span class="date">12.05.16 . 10:35</span><h2>Damien Bonnard - Rester Vertical</h2>'
           data-credit="Crédit Image : Léo Laumont / FDC"></a>
        <img data-original="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/05/thumb_4761_media_image_640x404.jpg"  alt="" title="Damien Bonnard - Rester Vertical" class="lazy">
        <div class="picto"><i class="icon icon_photo"></i></div>
        <div class="info">
          <div class="vCenter">
            <div class="vCenterKid">
              <span class="category">Photocall</span>
              <span class="date">12.05.16</span> . <span
                  class="hour">10:35</span>
              <p data-title="Damien Bonnard - Rester Vertical">Damien Bonnard - Rester Vertical</p>
            </div>
          </div>
        </div>
      </div>
      <div class="item photocall 12-05-16 shadow-bottom photo paysage notloaded">
        <a id="photo594" class="ajax chocolat-image" data-pid="594"
           href="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/05/ecd7e86a26537aa69515bb7832438f6bcfab78cb.jpg"
           title='<span class="category">Photocall</span><span class="date">12.05.16 . 10:30</span><h2>India Hair - Rester Vertical</h2>'
           data-credit="Crédit Image : Valery Hache / AFP"></a>
        <img data-original="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/05/thumb_4760_media_image_640x404.jpg"  alt="" title="India Hair - Rester Vertical" class="lazy">
        <div class="picto"><i class="icon icon_photo"></i></div>
        <div class="info">
          <div class="vCenter">
            <div class="vCenterKid">
              <span class="category">Photocall</span>
              <span class="date">12.05.16</span> . <span
                  class="hour">10:30</span>
              <p data-title="India Hair - Rester Vertical">India Hair - Rester Vertical</p>
            </div>
          </div>
        </div>
      </div>
      <div class="item oeil-du-photographe 12-05-16 shadow-bottom photo paysage notloaded">
        <a id="photo569" class="ajax chocolat-image" data-pid="569"
           href="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/05/fde706ecea2bcbf0b9ee1f70b0d7630e8214feb5.jpg"
           title='<span class="category">Œil du photographe</span><span class="date">12.05.16 . 09:00</span><h2>69 - La plage</h2>'
           data-credit="Crédit Image : Léo Laumont"></a>
        <img data-original="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/05/thumb_4739_media_image_640x404.jpg"  alt="69 - La plage" title="69 - La plage" class="lazy">
        <div class="picto"><i class="icon icon_photo"></i></div>
        <div class="info">
          <div class="vCenter">
            <div class="vCenterKid">
              <span class="category">Œil du photographe</span>
              <span class="date">12.05.16</span> . <span
                  class="hour">09:00</span>
              <p data-title="69 - La plage">69 - La plage</p>
            </div>
          </div>
        </div>
      </div>
      <div class="item oeil-du-photographe 12-05-16 shadow-bottom photo paysage notloaded">
        <a id="photo570" class="ajax chocolat-image" data-pid="570"
           href="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/05/c0b479321a60fd92bb08e7f4113e868a7c6593e9.jpg"
           title='<span class="category">Œil du photographe</span><span class="date">12.05.16 . 09:00</span><h2>69 - L&#039;adresse</h2>'
           data-credit="Crédit Image : Léo Laumont"></a>
        <img data-original="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/05/thumb_4741_media_image_640x404.jpg"  alt="69 - L&#039;adresse" title="69 - L&#039;adresse" class="lazy">
        <div class="picto"><i class="icon icon_photo"></i></div>
        <div class="info">
          <div class="vCenter">
            <div class="vCenterKid">
              <span class="category">Œil du photographe</span>
              <span class="date">12.05.16</span> . <span
                  class="hour">09:00</span>
              <p data-title="69 - L&#039;adresse">69 - L&#039;adresse</p>
            </div>
          </div>
        </div>
      </div>
      <div class="item oeil-du-photographe 12-05-16 shadow-bottom photo paysage notloaded">
        <a id="photo572" class="ajax chocolat-image" data-pid="572"
           href="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/05/30ea0f3b5fd814789b0db48892dcdb1d23b5c18b.jpg"
           title='<span class="category">Œil du photographe</span><span class="date">12.05.16 . 09:00</span><h2>69 - Le cinéma</h2>'
           data-credit="Crédit Image : Léo Laumont"></a>
        <img data-original="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/05/thumb_4743_media_image_640x404.jpg"  alt="69 - Le cinéma" title="69 - Le cinéma" class="lazy">
        <div class="picto"><i class="icon icon_photo"></i></div>
        <div class="info">
          <div class="vCenter">
            <div class="vCenterKid">
              <span class="category">Œil du photographe</span>
              <span class="date">12.05.16</span> . <span
                  class="hour">09:00</span>
              <p data-title="69 - Le cinéma">69 - Le cinéma</p>
            </div>
          </div>
        </div>
      </div>
      <div class="item oeil-du-photographe 12-05-16 shadow-bottom photo paysage notloaded">
        <a id="photo587" class="ajax chocolat-image" data-pid="587"
           href="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/05/faed000344b3e1f2a2c413785e17c8982963727b.jpg"
           title='<span class="category">Œil du photographe</span><span class="date">12.05.16 . 09:00</span><h2>69 - Au sol</h2>'
           data-credit="Crédit Image : Léo Laumont"></a>
        <img data-original="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/05/thumb_4756_media_image_640x404.jpg"  alt="69 - Au sol" title="69 - Au sol" class="lazy">
        <div class="picto"><i class="icon icon_photo"></i></div>
        <div class="info">
          <div class="vCenter">
            <div class="vCenterKid">
              <span class="category">Œil du photographe</span>
              <span class="date">12.05.16</span> . <span
                  class="hour">09:00</span>
              <p data-title="69 - Au sol">69 - Au sol</p>
            </div>
          </div>
        </div>
      </div>
      <div class="item oeil-du-photographe 12-05-16 shadow-bottom photo paysage notloaded">
        <a id="photo588" class="ajax chocolat-image" data-pid="588"
           href="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/05/1038446827ea92a676da13913c3b0a6375d24875.jpg"
           title='<span class="category">Œil du photographe</span><span class="date">12.05.16 . 09:00</span><h2>69 - La rue</h2>'
           data-credit="Crédit Image : Léo Laumont"></a>
        <img data-original="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/05/thumb_4757_media_image_640x404.jpg"  alt="69 - La rue" title="69 - La rue" class="lazy">
        <div class="picto"><i class="icon icon_photo"></i></div>
        <div class="info">
          <div class="vCenter">
            <div class="vCenterKid">
              <span class="category">Œil du photographe</span>
              <span class="date">12.05.16</span> . <span
                  class="hour">09:00</span>
              <p data-title="69 - La rue">69 - La rue</p>
            </div>
          </div>
        </div>
      </div>
      <div class="item ouverture 11-05-16 shadow-bottom photo paysage notloaded">
        <a id="photo583" class="ajax chocolat-image" data-pid="583"
           href="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/05/eea496ff854b89a819f6ce5a647c0f818b9c2e1c.jpg"
           title='<span class="category">Ouverture</span><span class="date">11.05.16 . 23:40</span><h2>Thierry Frémaux et Kristen Stewart - Dîner d&#039;Ouverture</h2>'
           data-credit="Crédit Image : Mathilde Petit / FDC"></a>
        <img data-original="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/05/thumb_4753_media_image_640x404.jpg"  alt="" title="Thierry Frémaux et Kristen Stewart - Dîner d&#039;Ouverture" class="lazy">
        <div class="picto"><i class="icon icon_photo"></i></div>
        <div class="info">
          <div class="vCenter">
            <div class="vCenterKid">
              <span class="category">Ouverture</span>
              <span class="date">11.05.16</span> . <span
                  class="hour">23:40</span>
              <p data-title="Thierry Frémaux et Kristen Stewart - Dîner d&#039;Ouverture">Thierry Frémaux et Kristen Stewart - Dîner d&#039;Ouverture</p>
            </div>
          </div>
        </div>
      </div>
      <div class="item ouverture 11-05-16 shadow-bottom photo paysage notloaded">
        <a id="photo585" class="ajax chocolat-image" data-pid="585"
           href="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/05/87a55fc436c53a13185d9d42839905ecb3cd13d8.jpg"
           title='<span class="category">Ouverture</span><span class="date">11.05.16 . 22:00</span><h2>Jury des Longs Métrages</h2>'
           data-credit="Crédit Image : Cyril Duchêne / FDC"></a>
        <img data-original="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/05/thumb_4755_media_image_640x404.jpg"  alt="" title="Jury des Longs Métrages" class="lazy">
        <div class="picto"><i class="icon icon_photo"></i></div>
        <div class="info">
          <div class="vCenter">
            <div class="vCenterKid">
              <span class="category">Ouverture</span>
              <span class="date">11.05.16</span> . <span
                  class="hour">22:00</span>
              <p data-title="Jury des Longs Métrages">Jury des Longs Métrages</p>
            </div>
          </div>
        </div>
      </div>
      <div class="item ouverture 11-05-16 shadow-bottom photo paysage notloaded">
        <a id="photo584" class="ajax chocolat-image" data-pid="584"
           href="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/05/a10b71ddabd5cc5ddfbcc6cb026c022d93ae627e.JPG"
           title='<span class="category">Ouverture</span><span class="date">11.05.16 . 21:40</span><h2>Matthieu Chedid - Coulisses</h2>'
           data-credit="Crédit Image : Mathilde Petit / FDC"></a>
        <img data-original="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/05/thumb_4754_media_image_640x404.JPG"  alt="" title="Matthieu Chedid - Coulisses" class="lazy">
        <div class="picto"><i class="icon icon_photo"></i></div>
        <div class="info">
          <div class="vCenter">
            <div class="vCenterKid">
              <span class="category">Ouverture</span>
              <span class="date">11.05.16</span> . <span
                  class="hour">21:40</span>
              <p data-title="Matthieu Chedid - Coulisses">Matthieu Chedid - Coulisses</p>
            </div>
          </div>
        </div>
      </div>
      <div class="item ouverture 11-05-16 shadow-bottom photo paysage notloaded">
        <a id="photo575" class="ajax chocolat-image" data-pid="575"
           href="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/05/b01d3148fac8216ce538769d327ae2291252d061.jpg"
           title='<span class="category">Ouverture</span><span class="date">11.05.16 . 20:40</span><h2>Cérémonie dans le Grand Theâtre Lumière</h2>'
           data-credit="Crédit Image : Alberto Pizzoli / AFP"></a>
        <img data-original="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/05/thumb_4746_media_image_640x404.jpg"  alt="" title="Cérémonie dans le Grand Theâtre Lumière" class="lazy">
        <div class="picto"><i class="icon icon_photo"></i></div>
        <div class="info">
          <div class="vCenter">
            <div class="vCenterKid">
              <span class="category">Ouverture</span>
              <span class="date">11.05.16</span> . <span
                  class="hour">20:40</span>
              <p data-title="Cérémonie dans le Grand Theâtre Lumière">Cérémonie dans le Grand Theâtre Lumière</p>
            </div>
          </div>
        </div>
      </div>
      <div class="item ouverture 11-05-16 shadow-bottom photo portrait notloaded">
        <a id="photo564" class="ajax chocolat-image" data-pid="564"
           href="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/05/e054ce371697ce2a0917718dd04b39d9ab588396.jpg"
           title='<span class="category">Ouverture</span><span class="date">11.05.16 . 20:05</span><h2>Laurent Lafitte et Catherine Deneuve</h2>'
           data-credit="Crédit Image : Valery Hache"></a>
        <img data-original="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/05/thumb_4740_media_image_320x404.jpg"  alt="" title="Laurent Lafitte et Catherine Deneuve" class="lazy">
        <div class="picto"><i class="icon icon_photo"></i></div>
        <div class="info">
          <div class="vCenter">
            <div class="vCenterKid">
              <span class="category">Ouverture</span>
              <span class="date">11.05.16</span> . <span
                  class="hour">20:05</span>
              <p data-title="Laurent Lafitte et Catherine Deneuve">Laurent Lafitte et Catherine Deneuve</p>
            </div>
          </div>
        </div>
      </div>
      <div class="item ouverture 11-05-16 shadow-bottom photo paysage notloaded">
        <a id="photo565" class="ajax chocolat-image" data-pid="565"
           href="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/05/4f0a3d6babf42d7f3675ad6baa7a6514ee6efff6.jpg"
           title='<span class="category">Ouverture</span><span class="date">11.05.16 . 20:05</span><h2>Cérémonie dans le Grand Théâtre Lumière</h2>'
           data-credit="Crédit Image : Alberto Pizzoli  / AFP"></a>
        <img data-original="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/05/thumb_4733_media_image_640x404.jpg"  alt="" title="Cérémonie dans le Grand Théâtre Lumière" class="lazy">
        <div class="picto"><i class="icon icon_photo"></i></div>
        <div class="info">
          <div class="vCenter">
            <div class="vCenterKid">
              <span class="category">Ouverture</span>
              <span class="date">11.05.16</span> . <span
                  class="hour">20:05</span>
              <p data-title="Cérémonie dans le Grand Théâtre Lumière">Cérémonie dans le Grand Théâtre Lumière</p>
            </div>
          </div>
        </div>
      </div>
      <div class="item ouverture 11-05-16 shadow-bottom photo paysage notloaded">
        <a id="photo566" class="ajax chocolat-image" data-pid="566"
           href="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/05/551a22edcee334cfd914aba4abe506b178d63890.jpg"
           title='<span class="category">Ouverture</span><span class="date">11.05.16 . 20:05</span><h2>Laurent Lafitte, Vincent Lindon et Jessica Chastain</h2>'
           data-credit="Crédit Image : Valery Hache / AFP"></a>
        <img data-original="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/05/thumb_4734_media_image_640x404.jpg"  alt="" title="Laurent Lafitte, Vincent Lindon et Jessica Chastain" class="lazy">
        <div class="picto"><i class="icon icon_photo"></i></div>
        <div class="info">
          <div class="vCenter">
            <div class="vCenterKid">
              <span class="category">Ouverture</span>
              <span class="date">11.05.16</span> . <span
                  class="hour">20:05</span>
              <p data-title="Laurent Lafitte, Vincent Lindon et Jessica Chastain">Laurent Lafitte, Vincent Lindon et Jessica Chastain</p>
            </div>
          </div>
        </div>
      </div>
      <div class="item ouverture 11-05-16 shadow-bottom photo paysage notloaded">
        <a id="photo557" class="ajax chocolat-image" data-pid="557"
           href="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/05/ffa8290e5bbbfe0b8105eead4df596d0816d0dd6.jpg"
           title='<span class="category">Ouverture</span><span class="date">11.05.16 . 20:00</span><h2>Vincent Lindon et Jessica Chastain, Maîtres d&#039;Ouverture</h2>'
           data-credit="Crédit Image : Alberto Pizzoli  / AFP"></a>
        <img data-original="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/05/thumb_4727_media_image_640x404.jpg"  alt="" title="Vincent Lindon et Jessica Chastain, Maîtres d&#039;Ouverture" class="lazy">
        <div class="picto"><i class="icon icon_photo"></i></div>
        <div class="info">
          <div class="vCenter">
            <div class="vCenterKid">
              <span class="category">Ouverture</span>
              <span class="date">11.05.16</span> . <span
                  class="hour">20:00</span>
              <p data-title="Vincent Lindon et Jessica Chastain, Maîtres d&#039;Ouverture">Vincent Lindon et Jessica Chastain, Maîtres d&#039;Ouverture</p>
            </div>
          </div>
        </div>
      </div>
      <div class="item ouverture 11-05-16 shadow-bottom photo portrait notloaded">
        <a id="photo562" class="ajax chocolat-image" data-pid="562"
           href="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/05/eb1391aceb0dd45112fe865ae3aea32d076d789f.jpg"
           title='<span class="category">Ouverture</span><span class="date">11.05.16 . 20:00</span><h2>Laurent Lafitte et le Jury des Longs Métrages</h2>'
           data-credit="Crédit Image : Antonin Thuillier / AFP"></a>
        <img data-original="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/05/thumb_4730_media_image_320x404.jpg"  alt="" title="Laurent Lafitte et le Jury des Longs Métrages" class="lazy">
        <div class="picto"><i class="icon icon_photo"></i></div>
        <div class="info">
          <div class="vCenter">
            <div class="vCenterKid">
              <span class="category">Ouverture</span>
              <span class="date">11.05.16</span> . <span
                  class="hour">20:00</span>
              <p data-title="Laurent Lafitte et le Jury des Longs Métrages">Laurent Lafitte et le Jury des Longs Métrages</p>
            </div>
          </div>
        </div>
      </div>
      <div class="item ouverture 11-05-16 shadow-bottom photo paysage notloaded">
        <a id="photo559" class="ajax chocolat-image" data-pid="559"
           href="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/05/509e8f8442cce9ba4b007feee178c8b658c076e1.jpg"
           title='<span class="category">Ouverture</span><span class="date">11.05.16 . 19:50</span><h2>George Miller, président du Jury des Longs Métrages</h2>'
           data-credit="Crédit Image : Valery Hache / AFP"></a>
        <img data-original="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/05/thumb_4728_media_image_640x404.jpg"  alt="" title="George Miller, président du Jury des Longs Métrages" class="lazy">
        <div class="picto"><i class="icon icon_photo"></i></div>
        <div class="info">
          <div class="vCenter">
            <div class="vCenterKid">
              <span class="category">Ouverture</span>
              <span class="date">11.05.16</span> . <span
                  class="hour">19:50</span>
              <p data-title="George Miller, président du Jury des Longs Métrages">George Miller, président du Jury des Longs Métrages</p>
            </div>
          </div>
        </div>
      </div>
      <div class="item montee-des-marches 11-05-16 shadow-bottom photo paysage notloaded">
        <a id="photo574" class="ajax chocolat-image" data-pid="574"
           href="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/05/2df85fd95af148f28b81e68f96194c7b1daa5695.jpg"
           title='<span class="category">Montée des Marches</span><span class="date">11.05.16 . 19:50</span><h2>Équipe du film - Café Society</h2>'
           data-credit="Crédit Image : Venturelli / WireImage / Getty Images"></a>
        <img data-original="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/05/thumb_4745_media_image_640x404.jpg"  alt="" title="Équipe du film - Café Society" class="lazy">
        <div class="picto"><i class="icon icon_photo"></i></div>
        <div class="info">
          <div class="vCenter">
            <div class="vCenterKid">
              <span class="category">Montée des Marches</span>
              <span class="date">11.05.16</span> . <span
                  class="hour">19:50</span>
              <p data-title="Équipe du film - Café Society">Équipe du film - Café Society</p>
            </div>
          </div>
        </div>
      </div>
      <div class="item ouverture 11-05-16 shadow-bottom photo portrait notloaded">
        <a id="photo556" class="ajax chocolat-image" data-pid="556"
           href="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/05/3b9a2cb6277cae45976465d2076bade5781efb30.jpg"
           title='<span class="category">Ouverture</span><span class="date">11.05.16 . 19:35</span><h2>Donald Sutherland, membre du Jury des Longs Métrages</h2>'
           data-credit="Crédit Image : Alberto Pizzoli / AFP"></a>
        <img data-original="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/05/thumb_4726_media_image_320x404.jpg"  alt="" title="Donald Sutherland, membre du Jury des Longs Métrages" class="lazy">
        <div class="picto"><i class="icon icon_photo"></i></div>
        <div class="info">
          <div class="vCenter">
            <div class="vCenterKid">
              <span class="category">Ouverture</span>
              <span class="date">11.05.16</span> . <span
                  class="hour">19:35</span>
              <p data-title="Donald Sutherland, membre du Jury des Longs Métrages">Donald Sutherland, membre du Jury des Longs Métrages</p>
            </div>
          </div>
        </div>
      </div>
      <div class="item ouverture 11-05-16 shadow-bottom photo paysage notloaded">
        <a id="photo555" class="ajax chocolat-image" data-pid="555"
           href="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/05/5fbaad2581e0bf4599d5cda36f862dbf26c98c49.jpg"
           title='<span class="category">Ouverture</span><span class="date">11.05.16 . 19:30</span><h2>Laszlo Nemes, membre du Jury des Longs Métrages</h2>'
           data-credit="Crédit Image : Valery Hache / AFP"></a>
        <img data-original="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/05/thumb_4725_media_image_640x404.jpg"  alt="" title="Laszlo Nemes, membre du Jury des Longs Métrages" class="lazy">
        <div class="picto"><i class="icon icon_photo"></i></div>
        <div class="info">
          <div class="vCenter">
            <div class="vCenterKid">
              <span class="category">Ouverture</span>
              <span class="date">11.05.16</span> . <span
                  class="hour">19:30</span>
              <p data-title="Laszlo Nemes, membre du Jury des Longs Métrages">Laszlo Nemes, membre du Jury des Longs Métrages</p>
            </div>
          </div>
        </div>
      </div>
      <div class="item montee-des-marches 11-05-16 shadow-bottom photo paysage notloaded">
        <a id="photo553" class="ajax chocolat-image" data-pid="553"
           href="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/05/e0067b05772125bdf9857d2e236e9e016dac5486.jpg"
           title='<span class="category">Montée des Marches</span><span class="date">11.05.16 . 19:28</span><h2>Équipe du film - Café Society</h2>'
           data-credit="Crédit Image : Valery Hache / AFP"></a>
        <img data-original="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/05/thumb_4723_media_image_640x404.jpg"  alt="" title="Équipe du film - Café Society" class="lazy">
        <div class="picto"><i class="icon icon_photo"></i></div>
        <div class="info">
          <div class="vCenter">
            <div class="vCenterKid">
              <span class="category">Montée des Marches</span>
              <span class="date">11.05.16</span> . <span
                  class="hour">19:28</span>
              <p data-title="Équipe du film - Café Society">Équipe du film - Café Society</p>
            </div>
          </div>
        </div>
      </div>
      <div class="item montee-des-marches 11-05-16 shadow-bottom photo paysage notloaded">
        <a id="photo567" class="ajax chocolat-image" data-pid="567"
           href="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/05/c8c3003b25523e0b6e3191ef74b3120fc71eeb4c.jpg"
           title='<span class="category">Montée des Marches</span><span class="date">11.05.16 . 18:50</span><h2>Thierry Frémaux</h2>'
           data-credit="Crédit Image : Anne-Christine Poujoulat / AFP"></a>
        <img data-original="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/05/thumb_4735_media_image_640x404.jpg"  alt="" title="Thierry Frémaux" class="lazy">
        <div class="picto"><i class="icon icon_photo"></i></div>
        <div class="info">
          <div class="vCenter">
            <div class="vCenterKid">
              <span class="category">Montée des Marches</span>
              <span class="date">11.05.16</span> . <span
                  class="hour">18:50</span>
              <p data-title="Thierry Frémaux">Thierry Frémaux</p>
            </div>
          </div>
        </div>
      </div>
      <div class="item montee-des-marches 11-05-16 shadow-bottom photo paysage notloaded">
        <a id="photo568" class="ajax chocolat-image" data-pid="568"
           href="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/05/a43c3ac8ec189fbca62b685b45470717ad1ec176.jpg"
           title='<span class="category">Montée des Marches</span><span class="date">11.05.16 . 18:43</span><h2>Justin Timberlake</h2>'
           data-credit="Crédit Image : Anne-Christine Poujoulat / AFP"></a>
        <img data-original="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/05/thumb_4737_media_image_640x404.jpg"  alt="" title="Justin Timberlake" class="lazy">
        <div class="picto"><i class="icon icon_photo"></i></div>
        <div class="info">
          <div class="vCenter">
            <div class="vCenterKid">
              <span class="category">Montée des Marches</span>
              <span class="date">11.05.16</span> . <span
                  class="hour">18:43</span>
              <p data-title="Justin Timberlake">Justin Timberlake</p>
            </div>
          </div>
        </div>
      </div>
      <div class="item montee-des-marches 11-05-16 shadow-bottom photo paysage notloaded">
        <a id="photo577" class="ajax chocolat-image" data-pid="577"
           href="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/05/6433dcdd6a8da1c853c62faf3cddcdf8acf431e9.jpg"
           title='<span class="category">Montée des Marches</span><span class="date">11.05.16 . 18:40</span><h2>Julianne Moore</h2>'
           data-credit="Crédit Image : Anne Christine Poujoulat / AFP"></a>
        <img data-original="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/05/thumb_4748_media_image_640x404.jpg"  alt="" title="Julianne Moore" class="lazy">
        <div class="picto"><i class="icon icon_photo"></i></div>
        <div class="info">
          <div class="vCenter">
            <div class="vCenterKid">
              <span class="category">Montée des Marches</span>
              <span class="date">11.05.16</span> . <span
                  class="hour">18:40</span>
              <p data-title="Julianne Moore">Julianne Moore</p>
            </div>
          </div>
        </div>
      </div>
      <div class="item ouverture 11-05-16 shadow-bottom photo paysage notloaded">
        <a id="photo576" class="ajax chocolat-image" data-pid="576"
           href="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/05/84e5665109f377465254ae1acddf471ac05d3d90.jpg"
           title='<span class="category">Ouverture</span><span class="date">11.05.16 . 18:30</span><h2>Susan Sarandon</h2>'
           data-credit="Crédit Image : Dominique Charriau / Getty Images"></a>
        <img data-original="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/05/thumb_4747_media_image_640x404.jpg"  alt="" title="Susan Sarandon" class="lazy">
        <div class="picto"><i class="icon icon_photo"></i></div>
        <div class="info">
          <div class="vCenter">
            <div class="vCenterKid">
              <span class="category">Ouverture</span>
              <span class="date">11.05.16</span> . <span
                  class="hour">18:30</span>
              <p data-title="Susan Sarandon">Susan Sarandon</p>
            </div>
          </div>
        </div>
      </div>
      <div class="item montee-des-marches 11-05-16 shadow-bottom photo paysage notloaded">
        <a id="photo552" class="ajax chocolat-image" data-pid="552"
           href="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/05/d8eaed5a61793137b6bafacbb98d73f73a1faaaa.jpg"
           title='<span class="category">Montée des Marches</span><span class="date">11.05.16 . 17:45</span><h2>Naomi Watts</h2>'
           data-credit="Crédit Image : Alberto Pizzoli / AFP"></a>
        <img data-original="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/05/thumb_4722_media_image_640x404.jpg"  alt="" title="Naomi Watts" class="lazy">
        <div class="picto"><i class="icon icon_photo"></i></div>
        <div class="info">
          <div class="vCenter">
            <div class="vCenterKid">
              <span class="category">Montée des Marches</span>
              <span class="date">11.05.16</span> . <span
                  class="hour">17:45</span>
              <p data-title="Naomi Watts">Naomi Watts</p>
            </div>
          </div>
        </div>
      </div>
      <div class="item montee-des-marches 11-05-16 shadow-bottom photo portrait notloaded">
        <a id="photo551" class="ajax chocolat-image" data-pid="551"
           href="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/05/26517738e7693f2f85dc1e73778a193a12f62f4f.jpg"
           title='<span class="category">Montée des Marches</span><span class="date">11.05.16 . 17:40</span><h2>Julianne Moore, Susan Sarandon et Naomi Watts</h2>'
           data-credit="Crédit Image : Anne-Christine Poujoulat / AFP"></a>
        <img data-original="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/05/thumb_4721_media_image_320x404.jpg"  alt="" title="Julianne Moore, Susan Sarandon et Naomi Watts" class="lazy">
        <div class="picto"><i class="icon icon_photo"></i></div>
        <div class="info">
          <div class="vCenter">
            <div class="vCenterKid">
              <span class="category">Montée des Marches</span>
              <span class="date">11.05.16</span> . <span
                  class="hour">17:40</span>
              <p data-title="Julianne Moore, Susan Sarandon et Naomi Watts">Julianne Moore, Susan Sarandon et Naomi Watts</p>
            </div>
          </div>
        </div>
      </div>
      <div class="item oeil-du-photographe 11-05-16 shadow-bottom photo paysage notloaded">
        <a id="photo458" class="ajax chocolat-image" data-pid="458"
           href="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/05/295ee88faa29751428aad560a2b061d1584f82b3.jpg"
           title='<span class="category">Œil du photographe</span><span class="date">11.05.16 . 15:40</span><h2>Grand Théâtre Lumière 1</h2>'
           data-credit="Crédit Image : Mathilde Petit"></a>
        <img data-original="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/05/thumb_4633_media_image_640x404.jpg"  alt="Grand Théâtre Lumière 1" title="Grand Théâtre Lumière 1" class="lazy">
        <div class="picto"><i class="icon icon_photo"></i></div>
        <div class="info">
          <div class="vCenter">
            <div class="vCenterKid">
              <span class="category">Œil du photographe</span>
              <span class="date">11.05.16</span> . <span
                  class="hour">15:40</span>
              <p data-title="Grand Théâtre Lumière 1">Grand Théâtre Lumière 1</p>
            </div>
          </div>
        </div>
      </div>
      <div class="item oeil-du-photographe 11-05-16 shadow-bottom photo paysage notloaded">
        <a id="photo459" class="ajax chocolat-image" data-pid="459"
           href="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/05/169ded192c7f099ddab5205d0785a15903efc7ff.jpg"
           title='<span class="category">Œil du photographe</span><span class="date">11.05.16 . 15:40</span><h2>Grand Théâtre Lumière 2</h2>'
           data-credit="Crédit Image : Mathilde Petit"></a>
        <img data-original="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/05/thumb_4634_media_image_640x404.jpg"  alt="Grand Théâtre Lumière 2" title="Grand Théâtre Lumière 2" class="lazy">
        <div class="picto"><i class="icon icon_photo"></i></div>
        <div class="info">
          <div class="vCenter">
            <div class="vCenterKid">
              <span class="category">Œil du photographe</span>
              <span class="date">11.05.16</span> . <span
                  class="hour">15:40</span>
              <p data-title="Grand Théâtre Lumière 2">Grand Théâtre Lumière 2</p>
            </div>
          </div>
        </div>
      </div>
      <div class="item oeil-du-photographe 11-05-16 shadow-bottom photo paysage notloaded">
        <a id="photo462" class="ajax chocolat-image" data-pid="462"
           href="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/05/d3eee4ef7e87ecb61b2c4088a739accfbddbc969.jpg"
           title='<span class="category">Œil du photographe</span><span class="date">11.05.16 . 15:40</span><h2>Grand Théâtre Lumière 3</h2>'
           data-credit="Crédit Image : Mathilde Petit"></a>
        <img data-original="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/05/thumb_4637_media_image_640x404.jpg"  alt="Grand Théâtre Lumière 3" title="Grand Théâtre Lumière 3" class="lazy">
        <div class="picto"><i class="icon icon_photo"></i></div>
        <div class="info">
          <div class="vCenter">
            <div class="vCenterKid">
              <span class="category">Œil du photographe</span>
              <span class="date">11.05.16</span> . <span
                  class="hour">15:40</span>
              <p data-title="Grand Théâtre Lumière 3">Grand Théâtre Lumière 3</p>
            </div>
          </div>
        </div>
      </div>
      <div class="item oeil-du-photographe 11-05-16 shadow-bottom photo paysage notloaded">
        <a id="photo463" class="ajax chocolat-image" data-pid="463"
           href="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/05/889698aaa904b584bab83e75c73e58a8bc4263a4.jpg"
           title='<span class="category">Œil du photographe</span><span class="date">11.05.16 . 15:40</span><h2>Grand Théâtre Lumière 4</h2>'
           data-credit="Crédit Image : Mathilde Petit"></a>
        <img data-original="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/05/thumb_4638_media_image_640x404.jpg"  alt="Grand Théâtre Lumière 4" title="Grand Théâtre Lumière 4" class="lazy">
        <div class="picto"><i class="icon icon_photo"></i></div>
        <div class="info">
          <div class="vCenter">
            <div class="vCenterKid">
              <span class="category">Œil du photographe</span>
              <span class="date">11.05.16</span> . <span
                  class="hour">15:40</span>
              <p data-title="Grand Théâtre Lumière 4">Grand Théâtre Lumière 4</p>
            </div>
          </div>
        </div>
      </div>
      <div class="item conference-de-presse 11-05-16 shadow-bottom photo paysage notloaded">
        <a id="photo539" class="ajax chocolat-image" data-pid="539"
           href="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/05/a0ae9b497977f3184697220614a563a23eb79fa0.jpg"
           title='<span class="category">Conférence de Presse</span><span class="date">11.05.16 . 14:10</span><h2>Jury des Longs métrages</h2>'
           data-credit="Crédit Image : Alberto Pizzoli / AFP"></a>
        <img data-original="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/05/thumb_4700_media_image_640x404.jpg"  alt="" title="Jury des Longs métrages" class="lazy">
        <div class="picto"><i class="icon icon_photo"></i></div>
        <div class="info">
          <div class="vCenter">
            <div class="vCenterKid">
              <span class="category">Conférence de Presse</span>
              <span class="date">11.05.16</span> . <span
                  class="hour">14:10</span>
              <p data-title="Jury des Longs métrages">Jury des Longs métrages</p>
            </div>
          </div>
        </div>
      </div>
      <div class="item ouverture 11-05-16 shadow-bottom photo portrait notloaded">
        <a id="photo517" class="ajax chocolat-image" data-pid="517"
           href="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/05/375bae1c32f49d9f5f9f04d3c22100c1ec16a568.jpg"
           title='<span class="category">Ouverture</span><span class="date">11.05.16 . 13:50</span><h2>Laurent Lafitte, Maître de cérémonie</h2>'
           data-credit="Crédit Image : 2016 Antonio de Moraes Barros Filho / Getty Images"></a>
        <img data-original="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/05/thumb_4683_media_image_320x404.jpg"  alt="" title="Laurent Lafitte, Maître de cérémonie" class="lazy">
        <div class="picto"><i class="icon icon_photo"></i></div>
        <div class="info">
          <div class="vCenter">
            <div class="vCenterKid">
              <span class="category">Ouverture</span>
              <span class="date">11.05.16</span> . <span
                  class="hour">13:50</span>
              <p data-title="Laurent Lafitte, Maître de cérémonie">Laurent Lafitte, Maître de cérémonie</p>
            </div>
          </div>
        </div>
      </div>
      <div class="item conference-de-presse 11-05-16 shadow-bottom photo paysage notloaded">
        <a id="photo541" class="ajax chocolat-image" data-pid="541"
           href="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/05/9c51f0c1912bc0b1f7dd50825dad1f885e6719da.jpg"
           title='<span class="category">Conférence de Presse</span><span class="date">11.05.16 . 13:50</span><h2>Katayoon Shahabi, membre du Jury des Longs Métrages</h2>'
           data-credit="Crédit Image : Alberto Pizzoli / AFP"></a>
        <img data-original="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/05/thumb_4701_media_image_640x404.jpg"  alt="" title="Katayoon Shahabi, membre du Jury des Longs Métrages" class="lazy">
        <div class="picto"><i class="icon icon_photo"></i></div>
        <div class="info">
          <div class="vCenter">
            <div class="vCenterKid">
              <span class="category">Conférence de Presse</span>
              <span class="date">11.05.16</span> . <span
                  class="hour">13:50</span>
              <p data-title="Katayoon Shahabi, membre du Jury des Longs Métrages">Katayoon Shahabi, membre du Jury des Longs Métrages</p>
            </div>
          </div>
        </div>
      </div>
      <div class="item photocall 11-05-16 shadow-bottom photo portrait notloaded">
        <a id="photo528" class="ajax chocolat-image" data-pid="528"
           href="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/05/c3bfbac2829320750ce5c30bb7d8a85d3f4d9798.jpg"
           title='<span class="category">Photocall</span><span class="date">11.05.16 . 13:10</span><h2>Kirsten Dunst, membre du Jury des Longs Métrages</h2>'
           data-credit="Crédit Image : Venturelli / Getty Images"></a>
        <img data-original="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/05/thumb_4691_media_image_320x404.jpg"  alt="" title="Kirsten Dunst, membre du Jury des Longs Métrages" class="lazy">
        <div class="picto"><i class="icon icon_photo"></i></div>
        <div class="info">
          <div class="vCenter">
            <div class="vCenterKid">
              <span class="category">Photocall</span>
              <span class="date">11.05.16</span> . <span
                  class="hour">13:10</span>
              <p data-title="Kirsten Dunst, membre du Jury des Longs Métrages">Kirsten Dunst, membre du Jury des Longs Métrages</p>
            </div>
          </div>
        </div>
      </div>
      <div class="item photocall 11-05-16 shadow-bottom photo paysage notloaded">
        <a id="photo530" class="ajax chocolat-image" data-pid="530"
           href="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/05/0b532e4616514ef487962624bf00c4483625f882.JPG"
           title='<span class="category">Photocall</span><span class="date">11.05.16 . 13:10</span><h2>Jury des Longs Métrages</h2>'
           data-credit="Crédit Image : Mathilde Petit / FDC"></a>
        <img data-original="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/05/thumb_4693_media_image_640x404.JPG"  alt="" title="Jury des Longs Métrages" class="lazy">
        <div class="picto"><i class="icon icon_photo"></i></div>
        <div class="info">
          <div class="vCenter">
            <div class="vCenterKid">
              <span class="category">Photocall</span>
              <span class="date">11.05.16</span> . <span
                  class="hour">13:10</span>
              <p data-title="Jury des Longs Métrages">Jury des Longs Métrages</p>
            </div>
          </div>
        </div>
      </div>
      <div class="item photocall 11-05-16 shadow-bottom photo paysage notloaded">
        <a id="photo532" class="ajax chocolat-image" data-pid="532"
           href="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/05/bc6abee778f659a36cdaeed8b7a92b39cf8fb39c.JPG"
           title='<span class="category">Photocall</span><span class="date">11.05.16 . 13:10</span><h2>Kirsten Dunst, Vanessa Paradis et Valeria Golino, membres du Jury des Longs Métrages</h2>'
           data-credit="Crédit Image : Mathilde Petit / FDC"></a>
        <img data-original="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/05/thumb_4695_media_image_640x404.JPG"  alt="" title="Kirsten Dunst, Vanessa Paradis et Valeria Golino, membres du Jury des Longs Métrages" class="lazy">
        <div class="picto"><i class="icon icon_photo"></i></div>
        <div class="info">
          <div class="vCenter">
            <div class="vCenterKid">
              <span class="category">Photocall</span>
              <span class="date">11.05.16</span> . <span
                  class="hour">13:10</span>
              <p data-title="Kirsten Dunst, Vanessa Paradis et Valeria Golino, membres du Jury des Longs Métrages">Kirsten Dunst, Vanessa Paradis et Valeria Golino, membres du Jury des Longs Métrages</p>
            </div>
          </div>
        </div>
      </div>
      <div class="item photocall 11-05-16 shadow-bottom photo paysage notloaded">
        <a id="photo538" class="ajax chocolat-image" data-pid="538"
           href="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/05/74783dfac782c03b9eb332f00cf707b7caead745.jpg"
           title='<span class="category">Photocall</span><span class="date">11.05.16 . 13:10</span><h2>Kirsten Dunst et Vanessa Paradis, membres du Jury des Longs Métrages</h2>'
           data-credit="Crédit Image : Venturelli Daniele / Getty Images"></a>
        <img data-original="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/05/thumb_4699_media_image_640x404.jpg"  alt="" title="Kirsten Dunst et Vanessa Paradis, membres du Jury des Longs Métrages" class="lazy">
        <div class="picto"><i class="icon icon_photo"></i></div>
        <div class="info">
          <div class="vCenter">
            <div class="vCenterKid">
              <span class="category">Photocall</span>
              <span class="date">11.05.16</span> . <span
                  class="hour">13:10</span>
              <p data-title="Kirsten Dunst et Vanessa Paradis, membres du Jury des Longs Métrages">Kirsten Dunst et Vanessa Paradis, membres du Jury des Longs Métrages</p>
            </div>
          </div>
        </div>
      </div>
      <div class="item ouverture 11-05-16 shadow-bottom photo paysage notloaded">
        <a id="photo518" class="ajax chocolat-image" data-pid="518"
           href="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/05/19df43188c3d8a5b7eb5bbaed0239dbbd0c34bd5.JPG"
           title='<span class="category">Ouverture</span><span class="date">11.05.16 . 12:50</span><h2>Laurent Lafitte, Maître de cérémonie</h2>'
           data-credit="Crédit Image : Mathilde Petit / FDC"></a>
        <img data-original="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/05/thumb_4684_media_image_640x404.JPG"  alt="" title="Laurent Lafitte, Maître de cérémonie" class="lazy">
        <div class="picto"><i class="icon icon_photo"></i></div>
        <div class="info">
          <div class="vCenter">
            <div class="vCenterKid">
              <span class="category">Ouverture</span>
              <span class="date">11.05.16</span> . <span
                  class="hour">12:50</span>
              <p data-title="Laurent Lafitte, Maître de cérémonie">Laurent Lafitte, Maître de cérémonie</p>
            </div>
          </div>
        </div>
      </div>
      <div class="item photocall 11-05-16 shadow-bottom photo paysage notloaded">
        <a id="photo519" class="ajax chocolat-image" data-pid="519"
           href="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/05/1c35ca545be90c71814671eccf82fd766af201b3.jpg"
           title='<span class="category">Photocall</span><span class="date">11.05.16 . 12:20</span><h2>Blake Lively - Café Society</h2>'
           data-credit="Crédit Image : Samir Hussein / Getty Images"></a>
        <img data-original="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/05/thumb_4706_media_image_640x404.jpg"  alt="" title="Blake Lively - Café Society" class="lazy">
        <div class="picto"><i class="icon icon_photo"></i></div>
        <div class="info">
          <div class="vCenter">
            <div class="vCenterKid">
              <span class="category">Photocall</span>
              <span class="date">11.05.16</span> . <span
                  class="hour">12:20</span>
              <p data-title="Blake Lively - Café Society">Blake Lively - Café Society</p>
            </div>
          </div>
        </div>
      </div>
      <div class="item photocall 11-05-16 shadow-bottom photo paysage notloaded">
        <a id="photo502" class="ajax chocolat-image" data-pid="502"
           href="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/05/69cad6847d86582a1c75d7769a285c75980b5cbd.jpg"
           title='<span class="category">Photocall</span><span class="date">11.05.16 . 12:10</span><h2>Équipe du film - Café Society</h2>'
           data-credit="Crédit Image : Alberto Pizzoli / AFP"></a>
        <img data-original="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/05/thumb_4671_media_image_640x404.jpg"  alt="" title="Équipe du film - Café Society" class="lazy">
        <div class="picto"><i class="icon icon_photo"></i></div>
        <div class="info">
          <div class="vCenter">
            <div class="vCenterKid">
              <span class="category">Photocall</span>
              <span class="date">11.05.16</span> . <span
                  class="hour">12:10</span>
              <p data-title="Équipe du film - Café Society">Équipe du film - Café Society</p>
            </div>
          </div>
        </div>
      </div>
      <div class="item conference-de-presse 11-05-16 shadow-bottom photo paysage notloaded">
        <a id="photo507" class="ajax chocolat-image" data-pid="507"
           href="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/05/ee7c5b2a950017ec9a0f2feb5c30a4c28b06dab9.jpg"
           title='<span class="category">Conférence de Presse</span><span class="date">11.05.16 . 12:02</span><h2>Woody Allen - Café Society</h2>'
           data-credit="Crédit Image : Mathilde Petit / FDC"></a>
        <img data-original="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/05/thumb_4676_media_image_640x404.jpg"  alt="" title="Woody Allen - Café Society" class="lazy">
        <div class="picto"><i class="icon icon_photo"></i></div>
        <div class="info">
          <div class="vCenter">
            <div class="vCenterKid">
              <span class="category">Conférence de Presse</span>
              <span class="date">11.05.16</span> . <span
                  class="hour">12:02</span>
              <p data-title="Woody Allen - Café Society">Woody Allen - Café Society</p>
            </div>
          </div>
        </div>
      </div>
      <div class="item conference-de-presse 11-05-16 shadow-bottom photo portrait notloaded">
        <a id="photo506" class="ajax chocolat-image" data-pid="506"
           href="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/05/3a98b4c52470189d3635d5b4cf336d26063f9561.jpg"
           title='<span class="category">Conférence de Presse</span><span class="date">11.05.16 . 12:00</span><h2>Corey Stoll - Café Society</h2>'
           data-credit="Crédit Image : Loïc Venance / AFP"></a>
        <img data-original="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/05/thumb_4675_media_image_320x404.jpg"  alt="" title="Corey Stoll - Café Society" class="lazy">
        <div class="picto"><i class="icon icon_photo"></i></div>
        <div class="info">
          <div class="vCenter">
            <div class="vCenterKid">
              <span class="category">Conférence de Presse</span>
              <span class="date">11.05.16</span> . <span
                  class="hour">12:00</span>
              <p data-title="Corey Stoll - Café Society">Corey Stoll - Café Society</p>
            </div>
          </div>
        </div>
      </div>
      <div class="item conference-de-presse 11-05-16 shadow-bottom photo paysage notloaded">
        <a id="photo509" class="ajax chocolat-image" data-pid="509"
           href="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/05/a3b11f0332f7fa99c0e37adf69ec27625a1a2f08.JPG"
           title='<span class="category">Conférence de Presse</span><span class="date">11.05.16 . 12:00</span><h2>Équipe du film - Café Society</h2>'
           data-credit="Crédit Image : Mathilde Petit / FDC"></a>
        <img data-original="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/05/thumb_4677_media_image_640x404.JPG"  alt="" title="Équipe du film - Café Society" class="lazy">
        <div class="picto"><i class="icon icon_photo"></i></div>
        <div class="info">
          <div class="vCenter">
            <div class="vCenterKid">
              <span class="category">Conférence de Presse</span>
              <span class="date">11.05.16</span> . <span
                  class="hour">12:00</span>
              <p data-title="Équipe du film - Café Society">Équipe du film - Café Society</p>
            </div>
          </div>
        </div>
      </div>
      <div class="item conference-de-presse 11-05-16 shadow-bottom photo paysage notloaded">
        <a id="photo510" class="ajax chocolat-image" data-pid="510"
           href="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/05/3d38902c9b2107e54055582656bd07691410156f.JPG"
           title='<span class="category">Conférence de Presse</span><span class="date">11.05.16 . 12:00</span><h2>Jesse Eisenberg - Café Society</h2>'
           data-credit="Crédit Image : Mathilde Petit / FDC"></a>
        <img data-original="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/05/thumb_4678_media_image_640x404.JPG"  alt="" title="Jesse Eisenberg - Café Society" class="lazy">
        <div class="picto"><i class="icon icon_photo"></i></div>
        <div class="info">
          <div class="vCenter">
            <div class="vCenterKid">
              <span class="category">Conférence de Presse</span>
              <span class="date">11.05.16</span> . <span
                  class="hour">12:00</span>
              <p data-title="Jesse Eisenberg - Café Society">Jesse Eisenberg - Café Society</p>
            </div>
          </div>
        </div>
      </div>
      <div class="item conference-de-presse 11-05-16 shadow-bottom photo paysage notloaded">
        <a id="photo512" class="ajax chocolat-image" data-pid="512"
           href="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/05/e353b22ff9fc16e14798ea6e22303a2fdf5ec897.JPG"
           title='<span class="category">Conférence de Presse</span><span class="date">11.05.16 . 12:00</span><h2>Kristen Stewart - Café Society</h2>'
           data-credit="Crédit Image : Mathilde Petit / FDC"></a>
        <img data-original="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/05/thumb_4680_media_image_640x404.JPG"  alt="" title="Kristen Stewart - Café Society" class="lazy">
        <div class="picto"><i class="icon icon_photo"></i></div>
        <div class="info">
          <div class="vCenter">
            <div class="vCenterKid">
              <span class="category">Conférence de Presse</span>
              <span class="date">11.05.16</span> . <span
                  class="hour">12:00</span>
              <p data-title="Kristen Stewart - Café Society">Kristen Stewart - Café Society</p>
            </div>
          </div>
        </div>
      </div>
      <div class="item photocall 11-05-16 shadow-bottom photo paysage notloaded">
        <a id="photo503" class="ajax chocolat-image" data-pid="503"
           href="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/05/ef25f4f9ca68ae08fbd61b74e8d35a537a5f1a8a.JPG"
           title='<span class="category">Photocall</span><span class="date">11.05.16 . 11:20</span><h2>Blake Lively, Woody Allen et Kristen Stewart - Café Society</h2>'
           data-credit="Crédit Image : Thomas Leibreich / FDC"></a>
        <img data-original="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/05/thumb_4672_media_image_640x404.JPG"  alt="" title="Blake Lively, Woody Allen et Kristen Stewart - Café Society" class="lazy">
        <div class="picto"><i class="icon icon_photo"></i></div>
        <div class="info">
          <div class="vCenter">
            <div class="vCenterKid">
              <span class="category">Photocall</span>
              <span class="date">11.05.16</span> . <span
                  class="hour">11:20</span>
              <p data-title="Blake Lively, Woody Allen et Kristen Stewart - Café Society">Blake Lively, Woody Allen et Kristen Stewart - Café Society</p>
            </div>
          </div>
        </div>
      </div>
      <div class="item photocall 11-05-16 shadow-bottom photo paysage notloaded">
        <a id="photo504" class="ajax chocolat-image" data-pid="504"
           href="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/05/090862eab6910270c384bc761e0f343230ad7629.JPG"
           title='<span class="category">Photocall</span><span class="date">11.05.16 . 11:20</span><h2>Woody Allen - Café Society</h2>'
           data-credit="Crédit Image : Thomas Leibreich / FDC"></a>
        <img data-original="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/05/thumb_4673_media_image_640x404.JPG"  alt="" title="Woody Allen - Café Society" class="lazy">
        <div class="picto"><i class="icon icon_photo"></i></div>
        <div class="info">
          <div class="vCenter">
            <div class="vCenterKid">
              <span class="category">Photocall</span>
              <span class="date">11.05.16</span> . <span
                  class="hour">11:20</span>
              <p data-title="Woody Allen - Café Society">Woody Allen - Café Society</p>
            </div>
          </div>
        </div>
      </div>
      <div class="item photocall 11-05-16 shadow-bottom photo paysage notloaded">
        <a id="photo505" class="ajax chocolat-image" data-pid="505"
           href="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/05/b9ec0221e77be30290c4abced16137747a11e71e.JPG"
           title='<span class="category">Photocall</span><span class="date">11.05.16 . 11:20</span><h2>Équipe du film - Café Society</h2>'
           data-credit="Crédit Image : Thomas Leibreich / FDC"></a>
        <img data-original="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/05/thumb_4674_media_image_640x404.JPG"  alt="" title="Équipe du film - Café Society" class="lazy">
        <div class="picto"><i class="icon icon_photo"></i></div>
        <div class="info">
          <div class="vCenter">
            <div class="vCenterKid">
              <span class="category">Photocall</span>
              <span class="date">11.05.16</span> . <span
                  class="hour">11:20</span>
              <p data-title="Équipe du film - Café Society">Équipe du film - Café Society</p>
            </div>
          </div>
        </div>
      </div>
      <div class="item photocall 11-05-16 shadow-bottom photo paysage notloaded">
        <a id="photo516" class="ajax chocolat-image" data-pid="516"
           href="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/05/bcdfc2546801a7cd5748c59c9ef8266cc73bf150.jpg"
           title='<span class="category">Photocall</span><span class="date">11.05.16 . 11:10</span><h2>Kristen Stewart - Café Society</h2>'
           data-credit="Crédit Image : Valery Hache / AFP"></a>
        <img data-original="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/05/thumb_4682_media_image_640x404.jpg"  alt="" title="Kristen Stewart - Café Society" class="lazy">
        <div class="picto"><i class="icon icon_photo"></i></div>
        <div class="info">
          <div class="vCenter">
            <div class="vCenterKid">
              <span class="category">Photocall</span>
              <span class="date">11.05.16</span> . <span
                  class="hour">11:10</span>
              <p data-title="Kristen Stewart - Café Society">Kristen Stewart - Café Society</p>
            </div>
          </div>
        </div>
      </div>
      <div class="item oeil-du-photographe 11-05-16 shadow-bottom photo paysage notloaded">
        <a id="photo571" class="ajax chocolat-image" data-pid="571"
           href="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/05/c78fc707fa8f91fe953a9b1f267d8b2cdc82d2e5.jpg"
           title='<span class="category">Œil du photographe</span><span class="date">11.05.16 . 09:00</span><h2>69 - Le Palais</h2>'
           data-credit="Crédit Image : Léo Laumont"></a>
        <img data-original="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/05/thumb_4742_media_image_640x404.jpg"  alt="69 - Le Palais" title="69 - Le Palais" class="lazy">
        <div class="picto"><i class="icon icon_photo"></i></div>
        <div class="info">
          <div class="vCenter">
            <div class="vCenterKid">
              <span class="category">Œil du photographe</span>
              <span class="date">11.05.16</span> . <span
                  class="hour">09:00</span>
              <p data-title="69 - Le Palais">69 - Le Palais</p>
            </div>
          </div>
        </div>
      </div>
      <div class="item oeil-du-photographe 11-05-16 shadow-bottom photo portrait notloaded">
        <a id="photo573" class="ajax chocolat-image" data-pid="573"
           href="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/05/a019d5ecf148964283551fec7fc878e8b8a12d09.jpg"
           title='<span class="category">Œil du photographe</span><span class="date">11.05.16 . 09:00</span><h2>69 - Les Anémones</h2>'
           data-credit="Crédit Image : Léo Laumont"></a>
        <img data-original="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/05/thumb_4744_media_image_320x404.jpg"  alt="69 - Les Anémones" title="69 - Les Anémones" class="lazy">
        <div class="picto"><i class="icon icon_photo"></i></div>
        <div class="info">
          <div class="vCenter">
            <div class="vCenterKid">
              <span class="category">Œil du photographe</span>
              <span class="date">11.05.16</span> . <span
                  class="hour">09:00</span>
              <p data-title="69 - Les Anémones">69 - Les Anémones</p>
            </div>
          </div>
        </div>
      </div>
      <div class="item jury 10-05-16 shadow-bottom photo paysage notloaded">
        <a id="photo471" class="ajax chocolat-image" data-pid="471"
           href="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/05/817adbcf7f03dd495a456f676e0c9abcba43960c.JPG"
           title='<span class="category">Jury</span><span class="date">10.05.16 . 20:40</span><h2>George Miller - Dîner du Jury des Longs Métrages</h2>'
           data-credit="Crédit Image : Thomas Leibreich / FDC"></a>
        <img data-original="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/05/thumb_4648_media_image_640x404.JPG"  alt="" title="George Miller - Dîner du Jury des Longs Métrages" class="lazy">
        <div class="picto"><i class="icon icon_photo"></i></div>
        <div class="info">
          <div class="vCenter">
            <div class="vCenterKid">
              <span class="category">Jury</span>
              <span class="date">10.05.16</span> . <span
                  class="hour">20:40</span>
              <p data-title="George Miller - Dîner du Jury des Longs Métrages">George Miller - Dîner du Jury des Longs Métrages</p>
            </div>
          </div>
        </div>
      </div>
      <div class="item jury 10-05-16 shadow-bottom photo paysage notloaded">
        <a id="photo472" class="ajax chocolat-image" data-pid="472"
           href="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/05/8d06655826d2f3718a2e1c10bb0cd65c8fc61000.JPG"
           title='<span class="category">Jury</span><span class="date">10.05.16 . 20:19</span><h2>Pierre Lescure et les Membres du Jury - Dîner du Jury des Longs Métrages</h2>'
           data-credit="Crédit Image : Thomas Leibreich / FDC"></a>
        <img data-original="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/05/thumb_4649_media_image_640x404.JPG"  alt="" title="Pierre Lescure et les Membres du Jury - Dîner du Jury des Longs Métrages" class="lazy">
        <div class="picto"><i class="icon icon_photo"></i></div>
        <div class="info">
          <div class="vCenter">
            <div class="vCenterKid">
              <span class="category">Jury</span>
              <span class="date">10.05.16</span> . <span
                  class="hour">20:19</span>
              <p data-title="Pierre Lescure et les Membres du Jury - Dîner du Jury des Longs Métrages">Pierre Lescure et les Membres du Jury - Dîner du Jury des Longs Métrages</p>
            </div>
          </div>
        </div>
      </div>
      <div class="item photocall 10-05-16 shadow-bottom photo paysage notloaded">
        <a id="photo739" class="ajax chocolat-image" data-pid="739"
           href="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/05/8640c4d558d2c6fcd3e89189595283c6073054df.JPG"
           title='<span class="category">Photocall</span><span class="date">10.05.16 . 10:35</span><h2>Valeria Bruni Tedeschi et Fabrice Luchini - Ma Loute</h2>'
           data-credit="Crédit Image : Cyril Duchêne / FDC"></a>
        <img data-original="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/05/thumb_4946_media_image_640x404.JPG"  alt="" title="Valeria Bruni Tedeschi et Fabrice Luchini - Ma Loute" class="lazy">
        <div class="picto"><i class="icon icon_photo"></i></div>
        <div class="info">
          <div class="vCenter">
            <div class="vCenterKid">
              <span class="category">Photocall</span>
              <span class="date">10.05.16</span> . <span
                  class="hour">10:35</span>
              <p data-title="Valeria Bruni Tedeschi et Fabrice Luchini - Ma Loute">Valeria Bruni Tedeschi et Fabrice Luchini - Ma Loute</p>
            </div>
          </div>
        </div>
      </div>
      <div class="item selection-officielle 07-05-16 shadow-bottom photo paysage notloaded">
        <a id="photo342" class="ajax chocolat-image" data-pid="342"
           href="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/03/b087430e57f009e5b0ec302446e1befbedfd924a.jpg"
           title='<span class="category">Sélection officielle</span><span class="date">07.05.16 . 09:18</span><h2>L&#039;Horaire des projections</h2>'
           data-credit="Crédit Image : DR"></a>
        <img data-original="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/03/thumb_2247_media_image_640x404.jpg"  alt="" title="L&#039;Horaire des projections" class="lazy">
        <div class="picto"><i class="icon icon_photo"></i></div>
        <div class="info">
          <div class="vCenter">
            <div class="vCenterKid">
              <span class="category">Sélection officielle</span>
              <span class="date">07.05.16</span> . <span
                  class="hour">09:18</span>
              <p data-title="L&#039;Horaire des projections">L&#039;Horaire des projections</p>
            </div>
          </div>
        </div>
      </div>
      <div class="item hors-competition 03-05-16 shadow-bottom photo paysage notloaded">
        <a id="photo54" class="ajax chocolat-image" data-pid="54"
           href="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/02/e22aedce598dff887c30de974545bda82d962345.jpg"
           title='<span class="category">Hors Compétition</span><span class="date">03.05.16 . 12:45</span><h2>Photo du film Hands of Stone</h2>'
           data-credit="Crédit Image : Daniel McFadden"></a>
        <img data-original="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/02/thumb_1856_media_image_640x404.jpg"  alt="Photo du film Hands of Stone" title="Photo du film Hands of Stone" class="lazy">
        <div class="picto"><i class="icon icon_photo"></i></div>
        <div class="info">
          <div class="vCenter">
            <div class="vCenterKid">
              <span class="category">Hors Compétition</span>
              <span class="date">03.05.16</span> . <span
                  class="hour">12:45</span>
              <p data-title="Photo du film Hands of Stone">Photo du film Hands of Stone</p>
            </div>
          </div>
        </div>
      </div>
      <div class="item jury 28-04-16 shadow-bottom photo paysage notloaded">
        <a id="photo18" class="ajax chocolat-image" data-pid="18"
           href="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/02/93379bb572705c3747f113fc9ea47f7d71ea8b85.jpg"
           title='<span class="category">Jury</span><span class="date">28.04.16 . 13:00</span><h2>Le Jury des Courts métrages et de la Cinéfondation 2016</h2>'
           data-credit="Crédit Image : DR"></a>
        <img data-original="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/02/thumb_1639_media_image_640x404.jpg"  alt="Le Jury des Courts métrages et de la Cinéfondation 2016" title="Le Jury des Courts métrages et de la Cinéfondation 2016" class="lazy">
        <div class="picto"><i class="icon icon_photo"></i></div>
        <div class="info">
          <div class="vCenter">
            <div class="vCenterKid">
              <span class="category">Jury</span>
              <span class="date">28.04.16</span> . <span
                  class="hour">13:00</span>
              <p data-title="Le Jury des Courts métrages et de la Cinéfondation 2016">Le Jury des Courts métrages et de la Cinéfondation 2016</p>
            </div>
          </div>
        </div>
      </div>
      <div class="item jury 25-04-16 shadow-bottom photo paysage notloaded">
        <a id="photo14" class="ajax chocolat-image" data-pid="14"
           href="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/01/a1accdd8573fdad5ddef587b8ddbcb1ac24b5564.jpg"
           title='<span class="category">Jury</span><span class="date">25.04.16 . 18:00</span><h2>Le Jury du 69e Festival de Cannes</h2>'
           data-credit="Crédit Image : DR"></a>
        <img data-original="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/01/thumb_205_media_image_640x404.jpg"  alt="Le Jury du 69e Festival de Cannes" title="Le Jury du 69e Festival de Cannes" class="lazy">
        <div class="picto"><i class="icon icon_photo"></i></div>
        <div class="info">
          <div class="vCenter">
            <div class="vCenterKid">
              <span class="category">Jury</span>
              <span class="date">25.04.16</span> . <span
                  class="hour">18:00</span>
              <p data-title="Le Jury du 69e Festival de Cannes">Le Jury du 69e Festival de Cannes</p>
            </div>
          </div>
        </div>
      </div>
      <div class="item cannes-classics 20-04-16 shadow-bottom photo paysage notloaded">
        <a id="photo13" class="ajax chocolat-image" data-pid="13"
           href="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/01/4636be18985aca3987c1c3d426a6445db24f7fe4.jpg"
           title='<span class="category">Cannes Classics</span><span class="date">20.04.16 . 16:00</span><h2>Bertrand Tavernier</h2>'
           data-credit="Crédit Image : 2016 - Little Bear - Gaumont - Pathé Production"></a>
        <img data-original="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/01/thumb_204_media_image_640x404.jpg"  alt="Bertrand Tavernier" title="Bertrand Tavernier" class="lazy">
        <div class="picto"><i class="icon icon_photo"></i></div>
        <div class="info">
          <div class="vCenter">
            <div class="vCenterKid">
              <span class="category">Cannes Classics</span>
              <span class="date">20.04.16</span> . <span
                  class="hour">16:00</span>
              <p data-title="Bertrand Tavernier">Bertrand Tavernier</p>
            </div>
          </div>
        </div>
      </div>
      <div class="item conference-de-presse 14-04-16 shadow-bottom photo paysage notloaded">
        <a id="photo11" class="ajax chocolat-image" data-pid="11"
           href="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/01/880e361a928e62d26930ef70c012916b6f69a41f.jpg"
           title='<span class="category">Conférence de Presse</span><span class="date">14.04.16 . 17:46</span><h2>Conférence de presse 2016 - Pierre Lescure &amp; Thierry Frémaux</h2>'
           data-credit="Crédit Image : FDC / Olivier Vigerie"></a>
        <img data-original="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/01/thumb_202_media_image_640x404.jpg"  alt="Conférence de presse 2016 -  Pierre Lescure et Thierry Frémaux" title="Conférence de presse 2016 - Pierre Lescure &amp; Thierry Frémaux" class="lazy">
        <div class="picto"><i class="icon icon_photo"></i></div>
        <div class="info">
          <div class="vCenter">
            <div class="vCenterKid">
              <span class="category">Conférence de Presse</span>
              <span class="date">14.04.16</span> . <span
                  class="hour">17:46</span>
              <p data-title="Conférence de presse 2016 - Pierre Lescure &amp; Thierry Frémaux">Conférence de presse 2016 - Pierre Lescure &amp; Thierry Frémaux</p>
            </div>
          </div>
        </div>
      </div>
      <div class="item conference-de-presse 14-04-16 shadow-bottom photo paysage notloaded">
        <a id="photo9" class="ajax chocolat-image" data-pid="9"
           href="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/01/f494b943a63053efc6d9af0ac00b422f8c9ee064.jpg"
           title='<span class="category">Conférence de Presse</span><span class="date">14.04.16 . 17:29</span><h2>Conférence de presse 2016 - Thierry Frémaux</h2>'
           data-credit="Crédit Image : FDC / Olivier Vigerie"></a>
        <img data-original="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/01/thumb_201_media_image_640x404.jpg"  alt="Conférence de presse 2016 - Thierry Frémaux" title="Conférence de presse 2016 - Thierry Frémaux" class="lazy">
        <div class="picto"><i class="icon icon_photo"></i></div>
        <div class="info">
          <div class="vCenter">
            <div class="vCenterKid">
              <span class="category">Conférence de Presse</span>
              <span class="date">14.04.16</span> . <span
                  class="hour">17:29</span>
              <p data-title="Conférence de presse 2016 - Thierry Frémaux">Conférence de presse 2016 - Thierry Frémaux</p>
            </div>
          </div>
        </div>
      </div>
      <div class="item selection-officielle 14-04-16 shadow-bottom photo paysage notloaded">
        <a id="photo333" class="ajax chocolat-image" data-pid="333"
           href="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/03/52908933d55880398042c2cd850bdd6fbf97a946.jpg"
           title='<span class="category">Sélection officielle</span><span class="date">14.04.16 . 14:58</span><h2>La Sélection officielle 2016</h2>'
           data-credit="Crédit Image : DR"></a>
        <img data-original="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/03/thumb_2237_media_image_640x404.jpg"  alt="" title="La Sélection officielle 2016" class="lazy">
        <div class="picto"><i class="icon icon_photo"></i></div>
        <div class="info">
          <div class="vCenter">
            <div class="vCenterKid">
              <span class="category">Sélection officielle</span>
              <span class="date">14.04.16</span> . <span
                  class="hour">14:58</span>
              <p data-title="La Sélection officielle 2016">La Sélection officielle 2016</p>
            </div>
          </div>
        </div>
      </div>
      <div class="item courts-metrages 11-04-16 shadow-bottom photo paysage notloaded">
        <a id="photo8" class="ajax chocolat-image" data-pid="8"
           href="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/01/f21a807f1184a47b2fef7769b4ea982c6c750b7e.jpg"
           title='<span class="category">Courts Métrages</span><span class="date">11.04.16 . 14:42</span><h2>Les Sélections de courts métrages au 69e Festival de Cannes</h2>'
           data-credit="Crédit Image : DR"></a>
        <img data-original="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/01/thumb_100_media_image_640x404.jpg"  alt="Les Sélections de courts métrages au 69e Festival de Cannes" title="Les Sélections de courts métrages au 69e Festival de Cannes" class="lazy">
        <div class="picto"><i class="icon icon_photo"></i></div>
        <div class="info">
          <div class="vCenter">
            <div class="vCenterKid">
              <span class="category">Courts Métrages</span>
              <span class="date">11.04.16</span> . <span
                  class="hour">14:42</span>
              <p data-title="Les Sélections de courts métrages au 69e Festival de Cannes">Les Sélections de courts métrages au 69e Festival de Cannes</p>
            </div>
          </div>
        </div>
      </div>
      <div class="item jury 07-04-16 shadow-bottom photo paysage notloaded">
        <a id="photo1" class="ajax chocolat-image" data-pid="1"
           href="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/07/71ae66c59a1db7943d3f5f382f98f0ee87b0d1d4.jpg"
           title='<span class="category">Jury</span><span class="date">07.04.16 . 15:30</span><h2>George Miller</h2>'
           data-credit="Crédit Image : Carl Court / AFP"></a>
        <img data-original="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/07/thumb_6259_media_image_640x404.jpg"  alt="George Miller" title="George Miller" class="lazy">
        <div class="picto"><i class="icon icon_photo"></i></div>
        <div class="info">
          <div class="vCenter">
            <div class="vCenterKid">
              <span class="category">Jury</span>
              <span class="date">07.04.16</span> . <span
                  class="hour">15:30</span>
              <p data-title="George Miller">George Miller</p>
            </div>
          </div>
        </div>
      </div>
      <div class="item lecon-de-cinema 04-04-16 shadow-bottom photo paysage notloaded">
        <a id="photo7" class="ajax chocolat-image" data-pid="7"
           href="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/01/156e114008a86c288bb45129e57deac48b7fee14.jpg"
           title='<span class="category">Leçon de Cinéma</span><span class="date">04.04.16 . 12:15</span><h2>William Friedkin</h2>'
           data-credit="Crédit Image : Pat York"></a>
        <img data-original="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/01/thumb_14_media_image_640x404.jpg"  alt="William Friedkin" title="William Friedkin" class="lazy">
        <div class="picto"><i class="icon icon_photo"></i></div>
        <div class="info">
          <div class="vCenter">
            <div class="vCenterKid">
              <span class="category">Leçon de Cinéma</span>
              <span class="date">04.04.16</span> . <span
                  class="hour">12:15</span>
              <p data-title="William Friedkin">William Friedkin</p>
            </div>
          </div>
        </div>
      </div>
      <div class="item ouverture 29-03-16 shadow-bottom photo paysage notloaded">
        <a id="photo6" class="ajax chocolat-image" data-pid="6"
           href="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/01/763719de3ccabc8cc2498f459d196a37d5586f28.jpg"
           title='<span class="category">Ouverture</span><span class="date">29.03.16 . 10:00</span><h2>Photo du film Café Society</h2>'
           data-credit="Crédit Image : Gravier Productions, Inc., Photographe - Sabrina Lantos"></a>
        <img data-original="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/01/thumb_6_media_image_640x404.jpg"  alt="Photo du film Café Society" title="Photo du film Café Society" class="lazy">
        <div class="picto"><i class="icon icon_photo"></i></div>
        <div class="info">
          <div class="vCenter">
            <div class="vCenterKid">
              <span class="category">Ouverture</span>
              <span class="date">29.03.16</span> . <span
                  class="hour">10:00</span>
              <p data-title="Photo du film Café Society">Photo du film Café Society</p>
            </div>
          </div>
        </div>
      </div>
      <div class="item affiche 21-03-16 shadow-bottom photo paysage notloaded">
        <a id="photo5" class="ajax chocolat-image" data-pid="5"
           href="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/01/3d1bd272e25205320293b27e5db81e1c0431380b.jpg"
           title='<span class="category">Affiche</span><span class="date">21.03.16 . 12:30</span><h2>L’affiche officielle du 69e Festival de Cannes</h2>'
           data-credit="Crédit Image : Lagency / Taste (Paris) / Le Mépris © 1963 StudioCanal - Compagnia Cinematografica Champion S.P.A. - Tous droits réservés"></a>
        <img data-original="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/01/thumb_5_media_image_640x404.jpg"  alt="L’affiche officielle du 69e Festival de Cannes" title="L’affiche officielle du 69e Festival de Cannes" class="lazy">
        <div class="picto"><i class="icon icon_photo"></i></div>
        <div class="info">
          <div class="vCenter">
            <div class="vCenterKid">
              <span class="category">Affiche</span>
              <span class="date">21.03.16</span> . <span
                  class="hour">12:30</span>
              <p data-title="L’affiche officielle du 69e Festival de Cannes">L’affiche officielle du 69e Festival de Cannes</p>
            </div>
          </div>
        </div>
      </div>
      <div class="item jury 15-03-16 shadow-bottom photo paysage notloaded">
        <a id="photo4" class="ajax chocolat-image" data-pid="4"
           href="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/01/ae5d38d8fa2bcac34bd2f5ac5d5cf8e40733f907.jpg"
           title='<span class="category">Jury</span><span class="date">15.03.16 . 14:48</span><h2>Naomi Kawase</h2>'
           data-credit="Crédit Image : DR"></a>
        <img data-original="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/01/thumb_4_media_image_640x404.jpg"  alt="Naomi Kawase" title="Naomi Kawase" class="lazy">
        <div class="picto"><i class="icon icon_photo"></i></div>
        <div class="info">
          <div class="vCenter">
            <div class="vCenterKid">
              <span class="category">Jury</span>
              <span class="date">15.03.16</span> . <span
                  class="hour">14:48</span>
              <p data-title="Naomi Kawase">Naomi Kawase</p>
            </div>
          </div>
        </div>
      </div>
      <div class="item ouverture 11-03-16 shadow-bottom photo paysage notloaded">
        <a id="photo3" class="ajax chocolat-image" data-pid="3"
           href="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/01/bc3143f5708c716fd6b7996aeb305847cc0af37f.jpg"
           title='<span class="category">Ouverture</span><span class="date">11.03.16 . 12:55</span><h2>Laurent Lafitte, Maître de cérémonie</h2>'
           data-credit="Crédit Image : Traverso/L&#039;Oreal/Getty Images"></a>
        <img data-original="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/01/thumb_3_media_image_640x404.jpg"  alt="Laurent Lafitte" title="Laurent Lafitte, Maître de cérémonie" class="lazy">
        <div class="picto"><i class="icon icon_photo"></i></div>
        <div class="info">
          <div class="vCenter">
            <div class="vCenterKid">
              <span class="category">Ouverture</span>
              <span class="date">11.03.16</span> . <span
                  class="hour">12:55</span>
              <p data-title="Laurent Lafitte, Maître de cérémonie">Laurent Lafitte, Maître de cérémonie</p>
            </div>
          </div>
        </div>
      </div>
      <div class="item l-atelier 02-03-16 shadow-bottom photo paysage notloaded">
        <a id="photo2" class="ajax chocolat-image" data-pid="2"
           href="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/01/09a5b6712208544dfc29ffae5737b098ea0f39ca.jpg"
           title='<span class="category">L&#039;atelier</span><span class="date">02.03.16 . 12:36</span><h2>L&#039;Atelier 2016</h2>'
           data-credit=""></a>
        <img data-original="http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image/0001/01/thumb_2_media_image_640x404.jpg"  alt="L&#039;Atelier 2016" title="L&#039;Atelier 2016" class="lazy">
        <div class="picto"><i class="icon icon_photo"></i></div>
        <div class="info">
          <div class="vCenter">
            <div class="vCenterKid">
              <span class="category">L&#039;atelier</span>
              <span class="date">02.03.16</span> . <span
                  class="hour">12:36</span>
              <p data-title="L&#039;Atelier 2016">L&#039;Atelier 2016</p>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <a id="next" href="audios2.html"></a>
</div>

<?php include('footer.html'); ?>

<!-- //// SCRIPTS \\\\ -->
<?php include('scripts.inc.php'); ?>
</body>
</html>
