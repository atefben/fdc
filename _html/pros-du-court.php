<!DOCTYPE html>
<html>

  <head>
    <?php include('head.html'); ?>
  </head>


  <body>
    <div id="prehome-container">
      <div id="prehome"></div>
    </div>
    <?php include('header.html'); ?>
    <div id="main" class="home loading eventsPage">
          <div class="list-article">
            <div class="bandeau-list">
              <div class="bandeau-list-img bandeau-head vCenter subHeader eventsHeader" style="background-image:url('img/skyCam7.png')">
                  <h3>Les pros du court</h3>
              </div>
            </div>
            <!--<div class="subNavigation">
                <nav>
                  <ul class="main">
                    <li>
                      <a href="stands.php">screening</a>
                    </li>
                    <li>
                      <a href="#">ateliers</a>
                    </li>
                    <li>
                      <a href="projections.php">projections</a>
                    </li>
                    <li>
                      <a href="equipements-services.php">petits dejeuners</a>
                    </li>
                    <li>
                      <a href="opportunites-pub.php" class="active">conférences</a>
                    </li>
                  </ul>
                 </nav>
            </div>-->
           </div>


          <div class="minPadding">   
            <div class="container">    
              <h5 class="minMargin">Le Lorem Ipsum est simplement du faux texte employé dans la composition et la mise en page avant impression. Le Lorem Ipsum est le faux texte standard de l'imprimerie depuis les années 1500, quand un peintre anonyme assembla ensemble des morceaux de texte pour réaliser un livre spécimen de polices de texte. Il n'a pas fait que survivre cinq siècles, mais s'est aussi adapté à la bureautique informatique, sans que son contenu n'en soit modifié. Il a été popularisé dans les années 1960.</h5>
            </div>
          </div>

          <div class="bigContainer">
            <div id="accordion-conf" class="conferences confcourtaccordion">
                
                <div class="dropdown"> 
                  <span>AFFICHER</span>
                  <div id="eventSelector">

                    <div class="selectText" id="short-fim-corner">Présent au short film corner</div>
                    <div class="selectText" id="helping-hand">Helping hand,</div>
                    <div class="selectText" id="screening">Screening,</div>
                    <div class="selectText" id="pitching-training">Pitching Training</div>
                    
                  </div>
                  <!--<div class="dropArrow">
                    <i class="icon icon_flecheGauche"></i>
                  </div>-->
                </div><br>
                <div class="selector">
                  <!--<div class="purpleBtn selectbtn" id="all">Tous</div>-->
                  <div class="selectbtn bigSelectbtn" id="d" rel="short-fim-corner">
                    Présent au short film corner <img src="img/sfcLogo.png" alt="">
                  </div>
                  <div class="selectbtn" id="a" rel="helping-hand">Helping Hand</div>
                  <div class="selectbtn" id="b" rel="screening">Screening</div>
                  <div class="selectbtn" id="c" rel="pitching-training">Pitching Training</div>

                </div>
              </div>
            </div>
              <div class="conferencesMenu confcourt">
                  <div class="content firstContent">
                    <div class="parent">
                      <!-- The base class is the box. Categories are then given as accessory classes. Any div can be in more than one category -->
     
                    <div class="box a events modal-toggle">
                      <div class="eventPhoto">
                        <div class="eventPhotoContainer">
                          <img src="img/person.png" alt="">
                        </div>
                        <div class="sfcLogo">
                          <img src="img/sfcLogo.png" alt="">
                        </div>
                      </div>
                      <div class="eventTitle"><h3>L’agence du court métrage</h3></div>
                      <div class="eventCat"><span>distribution</span><span>achat</span><span>vente</span></div>
                    </div>
                    <div class="box b events">
                      <div class="eventPhoto">
                        <div class="eventPhotoContainer">
                          <img class="containerFit" src="img/member.jpg" alt="">
                        </div>
                        <div class="sfcLogo">
                          <img src="img/sfcLogo.png" alt="">
                        </div>
                      </div>
                      <div class="eventTitle"><h3>L’agence du court métrage</h3></div>
                      <div class="eventCat"><span>distribution</span><span>achat</span><span>vente</span></div>                 
                    </div>
                    <div class="box c events">
                      <div class="eventPhoto">
                        <div class="eventPhotoContainer">
                          <img src="img/person.png" alt="">
                        </div>
                      </div>
                      <div class="eventTitle"><h3>L’agence du court métrage, agence spécialisée</h3></div>
                      <div class="eventCat"><span>distribution</span><span>achat</span><span>vente</span></div>             
                    </div>
                    <div class="box c events">
                      <div class="eventPhoto">
                        <div class="eventPhotoContainer backgroundPhotoContainer" style="background-image:url(http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/media_image_simple/0001/03/367fb90b242b369e6cf8a808049dc113af178f93.jpg)">
                        </div>
                        <div class="sfcLogo">
                          <img src="img/sfcLogo.png" alt="">
                        </div>
                      </div>
                      <div class="eventTitle"><h3>L’agence du court métrage</h3></div>
                      <div class="eventCat"><span>distribution</span><span>achat</span><span>vente</span></div>              
                    </div>
                    <div class="box a events">
                      <div class="eventPhoto">
                        <div class="eventPhotoContainer">
                          <img class="containerFit" src="img/member.jpg" alt="">
                        </div>
                      </div>
                      <div class="eventTitle"><h3>L’agence du court métrage, agence spécialisée</h3></div>
                      <div class="eventCat"><span>distribution</span><span>achat</span><span>vente</span><br><span>distribution</span><span>vente</span><span>vente</span></div>                   
                    </div>
                    <div class="box a events">
                      <div class="eventPhoto">
                        <div class="eventPhotoContainer">
                          <img src="img/person.png" alt="">
                        </div>
                        <div class="sfcLogo">
                          <img src="img/sfcLogo.png" alt="">
                        </div>
                      </div>
                      <div class="eventTitle"><h3>L’agence du court métrage</h3></div>
                      <div class="eventCat"><span>distribution</span><span>achat</span><span>vente</span></div>           
                    </div>
                    <div class="box a events">
                      <div class="eventPhoto">
                        <div class="eventPhotoContainer">
                          <img class="containerFit" src="img/member.jpg" alt="">
                        </div>
                      </div>
                      <div class="eventTitle"><h3>L’agence du court métrage</h3></div>
                      <div class="eventCat"><span>distribution</span><span>achat</span><span>vente</span></div>         
                    </div>
                    <div class="box d events">
                      <div class="eventPhoto">
                        <div class="eventPhotoContainer">
                          <img class="containerFit" src="img/member.jpg" alt="">
                        </div>
                        <div class="sfcLogo">
                          <img src="img/sfcLogo.png" alt="">
                        </div>
                      </div>
                      <div class="eventTitle"><h3>L’agence du court métrage</h3></div>
                      <div class="eventCat"><span>distribution</span><span>achat</span><span>vente</span></div>          
                    </div>
                    <div class="box d events">
                      <div class="eventPhoto">
                        <div class="eventPhotoContainer">
                          <img class="containerFit" src="img/member.jpg" alt="">
                        </div>
                        <div class="sfcLogo">
                          <img src="img/sfcLogo.png" alt="">
                        </div>
                      </div>
                      <div class="eventTitle"><h3>L’agence du court métrage</h3></div>
                      <div class="eventCat"><span>distribution</span><span>achat</span><span>vente</span></div>          
                    </div>
                    <div class="box d events">
                      <div class="eventPhoto">
                        <div class="eventPhotoContainer">
                          <img class="containerFit" src="img/member.jpg" alt="">
                        </div>
                        <div class="sfcLogo">
                          <img src="img/sfcLogo.png" alt="">
                        </div>
                      </div>
                      <div class="eventTitle"><h3>L’agence du court métrage</h3></div>
                      <div class="eventCat"><span>distribution</span><span>achat</span><span>vente</span></div>         
                    </div>
                    <div class="box d events">
                      <div class="eventPhoto">
                        <div class="eventPhotoContainer">
                          <img class="containerFit" src="img/member.jpg" alt="">
                        </div>
                        <div class="sfcLogo">
                          <img src="img/sfcLogo.png" alt="">
                        </div>
                      </div>
                      <div class="eventTitle"><h3>L’agence du court métrage</h3></div>
                      <div class="eventCat"><span>distribution</span><span>achat</span><span>vente</span></div>          
                    </div>
                    <div class="box b events">
                      <div class="eventPhoto">
                        <div class="eventPhotoContainer">
                          <img class="containerFit" src="img/member.jpg" alt="">
                        </div>
                        <div class="sfcLogo">
                          <img src="img/sfcLogo.png" alt="">
                        </div>
                      </div>
                      <div class="eventTitle"><h3>L’agence du court métrage</h3></div>
                      <div class="eventCat"><span>distribution</span><span>achat</span><span>vente</span></div>                 
                    </div>
                    <div class="box c events">
                      <div class="eventPhoto">
                        <div class="eventPhotoContainer">
                          <img src="img/person.png" alt="">
                        </div>
                      </div>
                      <div class="eventTitle"><h3>L’agence du court métrage, agence spécialisée</h3></div>
                      <div class="eventCat"><span>distribution</span><span>achat</span><span>vente</span></div>             
                    </div>
                    <div class="box c events">
                      <div class="eventPhoto">
                        <div class="eventPhotoContainer">
                          <img class="containerFit" src="img/member.jpg" alt="">
                        </div>
                        <div class="sfcLogo">
                          <img src="img/sfcLogo.png" alt="">
                        </div>
                      </div>
                      <div class="eventTitle"><h3>L’agence du court métrage</h3></div>
                      <div class="eventCat"><span>distribution</span><span>achat</span><span>vente</span></div>              
                    </div>
                    <div class="box a events">
                      <div class="eventPhoto">
                        <div class="eventPhotoContainer">
                          <img class="containerFit" src="img/member.jpg" alt="">
                        </div>
                      </div>
                      <div class="eventTitle"><h3>L’agence du court métrage, agence spécialisée</h3></div>
                      <div class="eventCat"><span>distribution</span><span>achat</span><span>vente</span><br><span>distribution</span><span>vente</span><span>vente</span></div>                   
                    </div>
                    <div class="box a events">
                      <div class="eventPhoto">
                        <div class="eventPhotoContainer">
                          <img src="img/person.png" alt="">
                        </div>
                        <div class="sfcLogo">
                          <img src="img/sfcLogo.png" alt="">
                        </div>
                      </div>
                      <div class="eventTitle"><h3>L’agence du court métrage</h3></div>
                      <div class="eventCat"><span>distribution</span><span>achat</span><span>vente</span></div>           
                    </div>
                    <div class="box a events">
                      <div class="eventPhoto">
                        <div class="eventPhotoContainer">
                          <img class="containerFit" src="img/member.jpg" alt="">
                        </div>
                      </div>
                      <div class="eventTitle"><h3>L’agence du court métrage</h3></div>
                      <div class="eventCat"><span>distribution</span><span>achat</span><span>vente</span></div>         
                    </div>
                    <div class="box d events">
                      <div class="eventPhoto">
                        <div class="eventPhotoContainer">
                          <img class="containerFit" src="img/member.jpg" alt="">
                        </div>
                        <div class="sfcLogo">
                          <img src="img/sfcLogo.png" alt="">
                        </div>
                      </div>
                      <div class="eventTitle"><h3>L’agence du court métrage</h3></div>
                      <div class="eventCat"><span>distribution</span><span>achat</span><span>vente</span></div>          
                    </div>
                    <div class="box d events">
                      <div class="eventPhoto">
                        <div class="eventPhotoContainer">
                          <img class="containerFit" src="img/member.jpg" alt="">
                        </div>
                        <div class="sfcLogo">
                          <img src="img/sfcLogo.png" alt="">
                        </div>
                      </div>
                      <div class="eventTitle"><h3>L’agence du court métrage</h3></div>
                      <div class="eventCat"><span>distribution</span><span>achat</span><span>vente</span></div>          
                    </div>
                    <div class="box d events">
                      <div class="eventPhoto">
                        <div class="eventPhotoContainer">
                          <img class="containerFit" src="img/member.jpg" alt="">
                        </div>
                        <div class="sfcLogo">
                          <img src="img/sfcLogo.png" alt="">
                        </div>
                      </div>
                      <div class="eventTitle"><h3>L’agence du court métrage</h3></div>
                      <div class="eventCat"><span>distribution</span><span>achat</span><span>vente</span></div>         
                    </div>
                    <div class="box d events">
                      <div class="eventPhoto">
                        <div class="eventPhotoContainer">
                          <img class="containerFit" src="img/member.jpg" alt="">
                        </div>
                        <div class="sfcLogo">
                          <img src="img/sfcLogo.png" alt="">
                        </div>
                      </div>
                      <div class="eventTitle"><h3>L’agence du court métrage</h3></div>
                      <div class="eventCat"><span>distribution</span><span>achat</span><span>vente</span></div>          
                    </div>
                  </div>
                </div>
              </div>

          <div class="share" id="share" >
              <p>Partagez</p>
              <div class="buttons square">
                <a href="//www.facebook.com/sharer.php?u=html.festival-cannes-2016.com.ohwee.fr&t=le%20titre" rel="nofollow" class="button facebook ajax"><i class="icon icon_facebook"></i></a>
                <a href="//twitter.com/intent/tweet?text=Enrages%20Polar%20Hybride" class="button twitter"><i class="icon icon_twitter"></i>
                </a>
                <a href="#" class="button link self"><i class="icon icon_link"></i></a>
                <a href="#" class="button email self"><i class="icon icon_lettre"></i></a>
                <a onclick="javascript:window.print()" href="#" class="button print"><i class="icon icon_print"></i></a>
              </div>
          </div>



    <!-- POP PERSONS -->
    <div class="modal">
      <div class="modal-overlay modal-toggle"></div>
        <div class="modal-wrapper modal-transition">   
          <div class="modal-body">
            <div class="modal-goldBackg"></div>
              <div class="modal-content">
                <div class="half">
                  <div class="photo">
                    <div class="photoContainer">
                      <img src="img/person.png" alt="">
                      <img class="containerFit" src="img/member.jpg" alt="">
                    </div>
                    <div class="sfcLogo">
                        <img src="img/sfcLogo.png" alt="">
                    </div>
                  </div>
                  <div class="titleBig">
                    <h2>Soyez professionnels, exigeants et originaux et profressionnels et exigeants!</h2>
                    <!--<h2<span>&#8220;</span>Soyez professionnels, exigeants et originaux et profressionnels et exigeants!<span>&#8221;</span></h2>-->
                    <div class="bckgQuote">&#8220;</div>
                  </div>
                  <div class="contactInfo">
                      <div class="world"><img src="img/world.png" alt=""> <h3>Japan zefazefartze  rzze</h3></div>
                      <div class="contactInfoEmail"><img src="img/computer.png" alt=""><h3><a href="www.shortshorts.org/en/" target="blank">shortshorts.org sgsergze ezrgze zert zer</a></h3></div>
                      <!--<div><img src="img/flyingPaper.png" alt=""><h3><a href="mailto:aki@shortshorts.org" >aki@shortshorts.org</h3></a></div>
                      <div><img src="img/flyingPaper.png" alt=""><h3>jessica@shortshorts.org</h3></div>
                      <div><img src="img/flyingPaper.png" alt=""><h3>clairechauvat@shortshorts.org</h3></div>-->
                  </div>
                </div>
                <div class="half">
                  <div class="maj">Dernière mise à jour le 27 oct. 2016</div>
                   <!--<div class="cats">distribution • achat • vente</div>-->
                  <div class="titleHalf"><h3>L’agence du court métrage</h3></div>
                  <div class="cats"><span>distribution</span><span>achat</span><span>vente</span></div>
                  <div class="authors">
                    <div class="full">
                      <a href="mailto:aki@shortshorts.org"><h4 class="mailName">Florence KELLER von midtag</h4></a>
                      <div class="job"><h4>productrice</h4></div>
                    </div>
                    <div class="full">
                      <a href="mailto:aki@shortshorts.org"><h4 class="mailName">Augustin Keller von Keller</h4></a>
                      <div class="job"><h4>acheteuse</h4></div>
                    </div>
                    <div class="full">
                      <a href="mailto:aki@shortshorts.org"><h4 class="mailName">Gertrude von Munchen</h4></a>
                      <div class="job"><h4>actrice</h4></div>
                    </div>
                  </div>
                  <div class="content">
                    <h5>title ergezrg</h5>
                    <p>Pacific Voice Inc. est la société en charge des opérations du Short Shorts Film Festival & Asia. Le Short Shorts Film Festival (SSFF) a vu le jour à Harajuku, Tokyo en 1999. En 2004, il a été reconnu par l'Academy of Motion Pictures Arts and Sciences en tant que festival qualifiant pour la catégorie court métrage de l'Academy Awards annuel. Pacific Voice Inc. étant un distributeur de courts métrages, nous avons pour but d'introduire les courts internationaux au public japonais et les courts métrages japonais aux spectateurs tout autour du monde.</p>
                    <p>Pacific Voice Inc. est la société en charge des opérations du Short Shorts Film Festival & Asia. Le Short Shorts Film Festival (SSFF) a vu le jour à Harajuku, Tokyo en 1999. En 2004, il a été reconnu par l'Academy of Motion Pictures Arts and Sciences en tant que festival qualifiant pour la catégorie court métrage de l'Academy Awards annuel. Pacific Voice Inc. étant un distributeur de courts métrages, nous avons pour but d'introduire les courts internationaux au public japonais et les courts métrages japonais aux spectateurs tout autour du monde.</p>
                    <div class="content halfContent">
                      <h5>title ergezrg</h5>
                      <p>Pacific Voice Inc..</p>
                    </div>
                    <div class="content halfContent">
                      <h5>title ergezrg</h5>
                      <p>Pacific Voice Inc..</p>
                    </div>
                    <div class="content halfContent">
                      <h5>title ergezrg</h5>
                      <p>Pacific Voice Inc..</p>
                    </div>
                    <div class="content halfContent">
                      <h5>title ergezrg</h5>
                      <p>Pacific Voice Inc..</p>
                    </div>
                    <p>Pacific Voice Inc. est la société en charge des opérations du Short Shorts Film Festival & Asia. Le Short Shorts Film Festival (SSFF) a vu le jour à Harajuku, Tokyo en 1999. En 2004, il a été reconnu par l'Academy of Motion Pictures Arts and Sciences en tant que festival qualifiant pour la catégorie court métrage de l'Academy Awards annuel. Pacific Voice Inc. étant un distributeur de courts métrages, nous avons pour but d'introduire les courts internationaux au public japonais et les courts métrages japonais aux spectateurs tout autour du monde.</p>
                    <p>Pacific Voice Inc. est la société en charge des opérations du Short Shorts Film Festival & Asia. Le Short Shorts Film Festival (SSFF) a vu le jour à Harajuku, Tokyo en 1999. En 2004, il a été reconnu par l'Academy of Motion Pictures Arts and Sciences en tant que festival qualifiant pour la catégorie court métrage de l'Academy Awards annuel. Pacific Voice Inc. étant un distributeur de courts métrages, nous avons pour but d'introduire les courts internationaux au public japonais et les courts métrages japonais aux spectateurs tout autour du monde.</p>
                    <p>Pacific Voice Inc. est la société en charge des opérations du Short Shorts Film Festival & Asia. Le Short Shorts Film Festival (SSFF) a vu le jour à Harajuku, Tokyo en 1999. En 2004, il a été reconnu par l'Academy of Motion Pictures Arts and Sciences en tant que festival qualifiant pour la catégorie court métrage de l'Academy Awards annuel. Pacific Voice Inc. étant un distributeur de courts métrages, nous avons pour but d'introduire les courts internationaux au public japonais et les courts métrages japonais aux spectateurs tout autour du monde.</p>
                    <p>Pacific Voice Inc. est la société en charge des opérations du Short Shorts Film Festival & Asia. Le Short Shorts Film Festival (SSFF) a vu le jour à Harajuku, Tokyo en 1999. En 2004, il a été reconnu par l'Academy of Motion Pictures Arts and Sciences en tant que festival qualifiant pour la catégorie court métrage de l'Academy Awards annuel. Pacific Voice Inc. étant un distributeur de courts métrages, nous avons pour but d'introduire les courts internationaux au public japonais et les courts métrages japonais aux spectateurs tout autour du monde.</p>
                    <p>Pacific Voice Inc. est la société en charge des opérations du Short Shorts Film Festival & Asia. Le Short Shorts Film Festival (SSFF) a vu le jour à Harajuku, Tokyo en 1999. En 2004, il a été reconnu par l'Academy of Motion Pictures Arts and Sciences en tant que festival qualifiant pour la catégorie court métrage de l'Academy Awards annuel. Pacific Voice Inc. étant un distributeur de courts métrages, nous avons pour but d'introduire les courts internationaux au public japonais et les courts métrages japonais aux spectateurs tout autour du monde.</p>
                    
                    <p>Pacific Voice Inc. est la société en charge des opérations du Short Shorts Film Festival & Asia. Le Short Shorts Film Festival (SSFF) a vu le jour à Harajuku, Tokyo en 1999. En 2004, il a été reconnu par l'Academy of Motion Pictures Arts and Sciences en tant que festival qualifiant pour la catégorie court métrage de l'Academy Awards annuel. Pacific Voice Inc. étant un distributeur de courts métrages, nous avons pour but d'introduire les courts internationaux au public japonais et les courts métrages japonais aux spectateurs tout autour du monde.</p>
                    <p>Pacific Voice Inc. est la société en charge des opérations du Short Shorts Film Festival & Asia. Le Short Shorts Film Festival (SSFF) a vu le jour à Harajuku, Tokyo en 1999. En 2004, il a été reconnu par l'Academy of Motion Pictures Arts and Sciences en tant que festival qualifiant pour la catégorie court métrage de l'Academy Awards annuel. Pacific Voice Inc. étant un distributeur de courts métrages, nous avons pour but d'introduire les courts internationaux au public japonais et les courts métrages japonais aux spectateurs tout autour du monde.</p>
                    <p>Pacific Voice Inc. est la société en charge des opérations du Short Shorts Film Festival & Asia. Le Short Shorts Film Festival (SSFF) a vu le jour à Harajuku, Tokyo en 1999. En 2004, il a été reconnu par l'Academy of Motion Pictures Arts and Sciences en tant que festival qualifiant pour la catégorie court métrage de l'Academy Awards annuel. Pacific Voice Inc. étant un distributeur de courts métrages, nous avons pour but d'introduire les courts internationaux au public japonais et les courts métrages japonais aux spectateurs tout autour du monde.</p>
                    <p>Pacific Voice Inc. est la société en charge des opérations du Short Shorts Film Festival & Asia. Le Short Shorts Film Festival (SSFF) a vu le jour à Harajuku, Tokyo en 1999. En 2004, il a été reconnu par l'Academy of Motion Pictures Arts and Sciences en tant que festival qualifiant pour la catégorie court métrage de l'Academy Awards annuel. Pacific Voice Inc. étant un distributeur de courts métrages, nous avons pour but d'introduire les courts internationaux au public japonais et les courts métrages japonais aux spectateurs tout autour du monde.</p>
                    <p>Pacific Voice Inc. est la société en charge des opérations du Short Shorts Film Festival & Asia. Le Short Shorts Film Festival (SSFF) a vu le jour à Harajuku, Tokyo en 1999. En 2004, il a été reconnu par l'Academy of Motion Pictures Arts and Sciences en tant que festival qualifiant pour la catégorie court métrage de l'Academy Awards annuel. Pacific Voice Inc. étant un distributeur de courts métrages, nous avons pour but d'introduire les courts internationaux au public japonais et les courts métrages japonais aux spectateurs tout autour du monde.</p>
                    <p>Pacific Voice Inc. est la société en charge des opérations du Short Shorts Film Festival & Asia. Le Short Shorts Film Festival (SSFF) a vu le jour à Harajuku, Tokyo en 1999. En 2004, il a été reconnu par l'Academy of Motion Pictures Arts and Sciences en tant que festival qualifiant pour la catégorie court métrage de l'Academy Awards annuel. Pacific Voice Inc. étant un distributeur de courts métrages, nous avons pour but d'introduire les courts internationaux au public japonais et les courts métrages japonais aux spectateurs tout autour du monde.</p>

                    <p>Pacific Voice Inc. est la société en charge des opérations du Short Shorts Film Festival & Asia. Le Short Shorts Film Festival (SSFF) a vu le jour à Harajuku, Tokyo en 1999. En 2004, il a été reconnu par l'Academy of Motion Pictures Arts and Sciences en tant que festival qualifiant pour la catégorie court métrage de l'Academy Awards annuel. Pacific Voice Inc. étant un distributeur de courts métrages, nous avons pour but d'introduire les courts internationaux au public japonais et les courts métrages japonais aux spectateurs tout autour du monde.</p>
                  </div>
                  <div class="content halfContent">
                    <h5>title ergezrg</h5>
                    <p>Pacific Voice Inc..</p>
                  </div>
                  <div class="content halfContent">
                    <h5>title ergezrg</h5>
                    <p>Pacific Voice Inc..</p>
                  </div>
                  <div class="content halfContent">
                    <h5>title ergezrg</h5>
                    <p>Pacific Voice Inc..</p>
                  </div>
                  <div class="content halfContent">
                    <h5>title ergezrg</h5>
                    <p>Pacific Voice Inc..</p>
                  </div>
                  <div class="content halfContent">
                    <h5>title ergezrg</h5>
                    <p>Pacific Voice Inc..</p>
                  </div>
                  <div class="content">
                    <h5>title ergezrg</h5>
                    <p>Pacific Voice Inc. ributeur de courts métrages, nous avons pour but d'introduirdu monde.</p>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>

    <?php include('footer.html'); ?>

     <!-- cookie banner -->
      <?php include('cookie-banner.php'); ?>
    <!-- //// SCRIPTS \\\\ -->

    <?php include('scripts.inc.php'); ?>
  </body>
</html>
