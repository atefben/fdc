<!DOCTYPE html>
<html>

  <head>
    <?php include('head.html'); ?>
  </head>

  <body>
    <?php include('header.html'); ?>

    <div id="main" class="press press-programmation loading calendar-open lock events-site">
      <div class="header-press">
        <div class="container">
          <h2>Programmation</h2>
          <div class="buttons">
            <a href="#" class="button subnav"><i class="icon icon_telecharger"></i>
 Télécharger l'horaire des projections presse</a>
            <a href="#" class="button list"><i class="icon icon_telecharger"></i>
Télécharger au format .pdf</a>
            <a href="#" class="button list"><i class="icon icon_telecharger"></i>
Télécharger au format .ics</a>
          </div>
        </div>
      </div>
      <div class="locked">
        <div class="vCenter">
          <div class="vCenterKid">
            <h3 class="title-press"><i class="icon icon_cadenas"></i>contenus verrouillés</h3>
            <p>Journalistes, veuillez vous rendre dans l'espace presse et vous identifier pour déverrouiller les contenus qui vous sont réservés</p>
          </div>
        </div>
        <div class="buttons">
          <a href="programmation.php">Aller dans l'espace presse</a>
        </div>
      </div>
      <div class="wrapper">
        <div id='calendar'>
          <div id="calendar-wrapper">
            <h2 class="title-calendar">mon agenda</h2>
            <div id="mycalendar" class="side"></div>
            <p class="link"><a href="calendar.php"><i class="icon icon_fleche-right"></i>tout mon agenda</a></p>
            <div class="drag">
              <h2>Préparez votre séjour au festival de cannes</h2>
              <img src="img/svg/main-drag.svg" alt="" width="43" />
              <p><strong>Cliquez - déposez</strong> les évènements dans votre agenda puis exportez votre programme</p>
              <a href="#" id="okDrag">OK</a>
            </div>
          </div>
        </div>
        <div class="programmation">
          <div id="calendar-programmation">
            <div class="filters">
            <div id="category" class="filter">
              <span class="label">Sélections :</span>
              <span class="select">
                <span class="active" data-filter="all">Toutes</span><i class="icon icon_fleche-down"></i>
                <span data-filter="competition">Compétition</span>
                <span data-filter="hors_competition">Hors Compétition</span>
                <span data-filter="regard">Un Certain Regard</span>
                <span data-filter="seance">Séances spéciales</span>
                <span data-filter="cannes">Cannes Classics</span>
                <span data-filter="cinema">Cinéma de la plage</span>
                <span data-filter="cinefondation">Cinéfondation</span>
              </span>
            </div>
            <div id="type" class="filter">
              <span class="label">Types :</span>
              <span class="select">
                <span class="active" data-filter="all">Tous</span><i class="icon icon_fleche-down"></i>
                <span data-filter="seances">Séances</span>
                <span data-filter="events">Evènements</span>
              </span>
            </div>
          </div>
            <div id="timeline">
              <span class="arrow left"><i class="icon icon_flecheGauche"></i></span>
              <div class="timeline-container">
                <a href="#" class="" data-date="2016-05-11">mer<span class="day">11</span></a>
                <a href="#" class="active" data-date="2016-05-12">jeu<span class="day">12</span></a>
                <a href="#" class="disabled">ven<span class="day">13</span></a>
                <a href="#" class="disabled">sam<span class="day">14</span></a>
                <a href="#" class="disabled">dim<span class="day">15</span></a>
                <a href="#" class="disabled">lun<span class="day">16</span></a>
                <a href="#" class="disabled">mar<span class="day">17</span></a>
                <a href="#" class="disabled">mer<span class="day">18</span></a>
                <a href="#" class="disabled">jeu<span class="day">19</span></a>
                <a href="#" class="disabled">ven<span class="day">20</span></a>
                <a href="#" class="disabled">sam<span class="day">21</span></a>
                <a href="#" class="disabled">dim<span class="day">22</span></a>
              </div>
              <span class="arrow right"><i class="icon icon_fleche-right"></i></span>
            </div>
            <div class="calendar">
              <div class="timeCol">
                <div class="empty"></div>
                <div class="time">08H</div>
                <div class="time">09H</div>
                <div class="time">10H</div>
                <div class="time">11H</div>
                <div class="time">12H</div>
                <div class="time">13H</div>
                <div class="time">14H</div>
                <div class="time">15H</div>
                <div class="time">16H</div>
                <div class="time">17H</div>
                <div class="time">18H</div>
                <div class="time">19H</div>
                <div class="time">20H</div>
                <div class="time">21H</div>
                <div class="time">22H</div>
                <div class="time">23H</div>
                <div class="time">00H</div>
                <div class="time">01H</div>
                <div class="time">02H</div>
                <div class="time">03H</div>
              </div>
              <div class="venues">
                <a href="#" class="nav prev"><i class="icon icon_flecheGauche"></i></a>
                <a href="#" class="nav next"><i class="icon icon_fleche-right"></i></a>
                <div class="v-wrapper">
                  <div class="venue">
                    <div class="v-head">Grand Théâtre Lumière</div>
                    <div class="v-container">
                      <div class="fc-event" data-category="reprise" data-type="reprise" data-url="eventPopin.html" data-id="3" data-picto='.pen' data-color='#000' data-start="2016-05-12T09:00:00" data-end="2016-05-12T11:00:00" data-time="9" data-duration="120">
                        <span class="category"><i class="icon icon_espace-presse"></i>séance de reprise</span>
                        <div class="info">
                          <img src="http://dummyimage.com/46x64/000/fff" />
                          <div class="txt"><span>orson welles, autopsie d’une légende</span><strong>Elisabet KAPNIST</strong></div>
                        </div>
                        <div class="bottom"><span class="duration">2H</span> - <span class="ven">GRAND THÉÂTRE LUMIÈRE</span><span class="competition">Hors compétition</span></div>
                      </div>
                    </div>
                  </div>
                  <div class="venue">
                    <div class="v-head">Salle Debussy</div>
                    <div class="v-container"></div>
                  </div>
                  <div class="venue">
                    <div class="v-head">Salle du 60e</div>
                    <div class="v-container"></div>
                  </div>
                  <div class="venue">
                    <div class="v-head">Salle Buñuel</div>
                    <div class="v-container">
                      <div class="fc-event" data-category="press" data-type="press" data-url="eventPopin.html" data-id="5" data-picto='.pen' data-color='#000' data-start="2016-05-12T15:00:00" data-end="2016-05-12T16:00:00" data-time="15" data-duration="60">
                        <span class="category"><i class="icon icon_espace-presse"></i>conférence de presse</span>
                        <div class="info">
                          <img src="http://dummyimage.com/46x64/000/fff" />
                          <div class="txt"><span>mad max, fury road</span><strong>Elisabet KAPNIST</strong></div>
                        </div>
                        <div class="bottom"><span class="duration">1H</span> - <span class="ven">GRAND THÉÂTRE LUMIÈRE</span><span class="competition">Hors compétition</span></div>
                      </div>
                    </div>
                  </div>
                  <div class="venue">
                    <div class="v-head">Salle Buñuel</div>
                    <div class="v-container"></div>
                  </div>
                  <div class="venue">
                    <div class="v-head">Salle Buñuel</div>
                    <div class="v-container"></div>
                  </div>
                  <div class="venue">
                    <div class="v-head">Salle Buñuel</div>
                    <div class="v-container"></div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="contact-press">
      </div>
    </div>

    <?php include('footer.html'); ?>

    <!-- //// SCRIPTS \\\\ -->
    <?php include('scripts.inc.php'); ?>
  </body>
</html>
