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
        <div id="theme" class="filter">
          <span class="label">Dates :</span>
          <span class="select">
            <span class="active" data-filter="all">Toutes</span><i class="icon icon_fleche-down"></i>
            <span data-filter="date">Date 1</span>
            <span data-filter="date1">Date 2</span>
          </span>
        </div>
        <div id="format" class="filter">
          <span class="label">Thèmes :</span>
          <span class="select">
            <span class="active" data-filter="all">Tous</span><i class="icon icon_fleche-down"></i>
            <span data-filter="theme1">Thème 1</span>
            <span data-filter="theme2">Thème 2</span>
          </span>
        </div>
      </div>
      <div id="gridPhotos" class="grid-wrapper">
        <div class="grid-sizer"></div>
        <div class="item theme1 date theme portrait shadow-bottom photo">
          <a id="photo1"  data-pid="1"class="ajax chocolat-image" href="img/slide002.jpg" title='<span class="category">Conférence de presse</span><span class="date">18.05.2012</span><h2>Sur le tournage de "Deephan" de Jacques Audiard</h2>' data-credit="Crédit Image : VALERY HACHE / AFP"></a>
          <img src="http://dummyimage.com/320x404/3498db/.png" srcset="http://dummyimage.com/320x404/3498db/.png 1x, http://dummyimage.com/640x808/000/fff.png 2x" alt="">
          <div class="picto"><i class="icon icon_photo"></i></div>
          <div class="info">
            <div class="vCenter">
              <div class="vCenterKid">
                <a href="#" class="category">Montée des marches</a><span class="date">18.05.15</span>
                <p data-title="Le photocall de Maïwenn">Le photocall de Maïwenn</p>
              </div>
            </div>
          </div>
        </div>
        <div class="item theme2 date1 theme shadow-bottom photo">
          <a id="photo2"  data-pid="2"class="ajax chocolat-image" href="img/slide002.jpg" title='<span class="category">Conférence de presse</span><span class="date">18.05.2012</span><h2>Sur le tournage de "Deephan" de Jacques Audiard</h2>' data-credit="Crédit Image : VALERY HACHE / AFP"></a>
          <img src="http://dummyimage.com/640x404/000/fff.png" srcset="http://dummyimage.com/640x404/ddd/000.png 1x, http://dummyimage.com/1280x808/ddd/000.png 2x" alt="">
          <div class="picto"><i class="icon icon_photo"></i></div>
          <div class="info">
            <div class="vCenter">
              <div class="vCenterKid">
                <a href="#" class="category">Montée des marches</a><span class="date">18.05.15</span>
                <p data-title="Le photocall de Maïwenn">Le photocall de Maïwenn</p>
              </div>
            </div>
          </div>
        </div>
        <div class="item theme2 date2 date theme shadow-bottom photo">
          <a id="photo3"  data-pid="3"class="ajax chocolat-image" href="img/slide001.jpg" title='<span class="category">Conférence de presse</span><span class="date">18.05.2012</span><h2>Sur le tournage de "Deephan" de Jacques Audiard</h2>' data-credit="Crédit Image : VALERY HACHE / AFP"></a>
          <img src="http://dummyimage.com/640x404/000/fff.png" srcset="http://dummyimage.com/640x404/ddd/000.png 1x, http://dummyimage.com/1280x808/ddd/000.png 2x" alt="">
          <div class="picto"><i class="icon icon_photo"></i></div>
          <div class="info">
            <div class="vCenter">
              <div class="vCenterKid">
                <a href="#" class="category">Montée des marches</a><span class="date">18.05.15</span>
                <p data-title="Le photocall de Maïwenn">Le photocall de Maïwenn</p>
              </div>
            </div>
          </div>
        </div>
        <div class="item theme2 date theme portrait shadow-bottom photo">
          <a id="photo4"  data-pid="4"class="ajax chocolat-image" href="http://dummyimage.com/2560x3232/000/fff.png" title='<span class="category">Conférence de presse</span><span class="date">18.05.2012</span><h2>Sur le tournage de "Deephan" de Jacques Audiard</h2>' data-credit="Crédit Image : VALERY HACHE / AFP"></a>
          <img src="http://dummyimage.com/320x404/3498db/.png" srcset="http://dummyimage.com/320x404/3498db/.png 1x, http://dummyimage.com/640x808/000/fff.png 2x" alt="">
          <div class="picto"><i class="icon icon_photo"></i></div>
          <div class="info">
            <div class="vCenter">
              <div class="vCenterKid">
                <a href="#" class="category">Montée des marches</a><span class="date">18.05.15</span>
                <p data-title="Le photocall de Maïwenn">Le photocall de Maïwenn</p>
              </div>
            </div>
          </div>
        </div>
        <div class="item theme2 theme shadow-bottom photo">
          <a id="photo5"  data-pid="5"class="ajax chocolat-image" href="img/slide002.jpg" title='<span class="category">Conférence de presse</span><span class="date">18.05.2012</span><h2>Sur le tournage de "Deephan" de Jacques Audiard</h2>' data-credit="Crédit Image : VALERY HACHE / AFP"></a>
          <img src="http://dummyimage.com/640x404/000/fff.png" srcset="http://dummyimage.com/640x404/ddd/000.png 1x, http://dummyimage.com/1280x808/ddd/000.png 2x" alt="">
          <div class="picto"><i class="icon icon_photo"></i></div>
          <div class="info">
            <div class="vCenter">
              <div class="vCenterKid">
                <a href="#" class="category">Montée des marches</a><span class="date">18.05.15</span>
                <p data-title="Le photocall de Maïwenn">Le photocall de Maïwenn</p>
              </div>
            </div>
          </div>
        </div>
        <div class="item theme2 date1 theme shadow-bottom photo">
          <a id="photo6"  data-pid="6"class="ajax chocolat-image" href="img/slide002.jpg" title='<span class="category">Conférence de presse</span><span class="date">18.05.2012</span><h2>Sur le tournage de "Deephan" de Jacques Audiard</h2>' data-credit="Crédit Image : VALERY HACHE / AFP"></a>
          <img src="http://dummyimage.com/640x404/000/fff.png" srcset="http://dummyimage.com/640x404/ddd/000.png 1x, http://dummyimage.com/1280x808/ddd/000.png 2x" alt="">
          <div class="picto"><i class="icon icon_photo"></i></div>
          <div class="info">
            <div class="vCenter">
              <div class="vCenterKid">
                <a href="#" class="category">Montée des marches</a><span class="date">18.05.15</span>
                <p data-title="Le photocall de Maïwenn">Le photocall de Maïwenn</p>
              </div>
            </div>
          </div>
        </div>
        <div class="item theme1 date2 theme shadow-bottom photo">
          <a id="photo7"  data-pid="7"class="ajax chocolat-image" href="img/slide002.jpg" title='<span class="category">Conférence de presse</span><span class="date">18.05.2012</span><h2>Sur le tournage de "Deephan" de Jacques Audiard</h2>' data-credit="Crédit Image : VALERY HACHE / AFP"></a>
          <img src="http://dummyimage.com/640x404/000/fff.png" srcset="http://dummyimage.com/640x404/000/fff.png 1x, http://dummyimage.com/1280x808/000/fff.png 2x" alt="">
          <div class="picto"><i class="icon icon_photo"></i></div>
          <div class="info">
            <div class="vCenter">
              <div class="vCenterKid">
                <a href="#" class="category">Montée des marches</a><span class="date">18.05.15</span>
                <p data-title="Le photocall de Maïwenn">Le photocall de Maïwenn</p>
              </div>
            </div>
          </div>
        </div>
        <div class="item theme2 date theme shadow-bottom photo">
          <a id="photo8"  data-pid="8"class="ajax chocolat-image" href="img/slide002.jpg" title='<span class="category">Conférence de presse</span><span class="date">18.05.2012</span><h2>Sur le tournage de "Deephan" de Jacques Audiard</h2>' data-credit="Crédit Image : VALERY HACHE / AFP"></a>
          <img src="http://dummyimage.com/640x404/000/fff.png" srcset="http://dummyimage.com/640x404/ddd/000.png 1x, http://dummyimage.com/1280x808/ddd/000.png 2x" alt="">
          <div class="picto"><i class="icon icon_photo"></i></div>
          <div class="info">
            <div class="vCenter">
              <div class="vCenterKid">
                <a href="#" class="category">Montée des marches</a><span class="date">18.05.15</span>
                <p data-title="Le photocall de Maïwenn">Le photocall de Maïwenn</p>
              </div>
            </div>
          </div>
        </div>
        <div class="item theme2 date1 theme portrait shadow-bottom photo">
          <a id="photo9"  data-pid="9"class="ajax chocolat-image" href="img/slide002.jpg" title='<span class="category">Conférence de presse</span><span class="date">18.05.2012</span><h2>Sur le tournage de "Deephan" de Jacques Audiard</h2>' data-credit="Crédit Image : VALERY HACHE / AFP"></a>
          <img src="http://dummyimage.com/320x404/3498db/.png" srcset="http://dummyimage.com/320x404/3498db/.png 1x, http://dummyimage.com/640x808/000/fff.png 2x" alt="">
          <div class="picto"><i class="icon icon_photo"></i></div>
          <div class="info">
            <div class="vCenter">
              <div class="vCenterKid">
                <a href="#" class="category">Montée des marches</a><span class="date">18.05.15</span>
                <p data-title="Le photocall de Maïwenn">Le photocall de Maïwenn</p>
              </div>
            </div>
          </div>
        </div>
        <div class="item theme2 date2 theme shadow-bottom photo">
          <a id="photo10" data-pid="10" class="ajax chocolat-image" href="img/slide002.jpg" title='<span class="category">Conférence de presse</span><span class="date">18.05.2012</span><h2>Sur le tournage de "Deephan" de Jacques Audiard</h2>' data-credit="Crédit Image : VALERY HACHE / AFP"></a>
          <img src="http://dummyimage.com/640x404/000/fff.png" srcset="http://dummyimage.com/640x404/ddd/000.png 1x, http://dummyimage.com/1280x808/ddd/000.png 2x" alt="">
          <div class="picto"><i class="icon icon_photo"></i></div>
          <div class="info">
            <div class="vCenter">
              <div class="vCenterKid">
                <a href="#" class="category">Montée des marches</a><span class="date">18.05.15</span>
                <p data-title="Le photocall de Maïwenn">Le photocall de Maïwenn</p>
              </div>
            </div>
          </div>
        </div>
        <div class="item theme2 date1 theme shadow-bottom photo">
          <a id="photo11" data-pid="11" class="ajax chocolat-image" href="img/slide002.jpg" title='<span class="category">Conférence de presse</span><span class="date">18.05.2012</span><h2>Sur le tournage de "Deephan" de Jacques Audiard</h2>' data-credit="Crédit Image : VALERY HACHE / AFP"></a>
          <img src="http://dummyimage.com/640x404/000/fff.png" srcset="http://dummyimage.com/640x404/ddd/000.png 1x, http://dummyimage.com/1280x808/ddd/000.png 2x" alt="">
          <div class="picto"><i class="icon icon_photo"></i></div>
          <div class="info">
            <div class="vCenter">
              <div class="vCenterKid">
                <a href="#" class="category">Montée des marches</a><span class="date">18.05.15</span>
                <p data-title="Le photocall de Maïwenn">Le photocall de Maïwenn</p>
              </div>
            </div>
          </div>
        </div>
        <div class="item theme1 date2 theme shadow-bottom photo">
          <a id="photo12" data-pid="12" class="ajax chocolat-image" href="img/slide002.jpg" title='<span class="category">Conférence de presse</span><span class="date">18.05.2012</span><h2>Sur le tournage de "Deephan" de Jacques Audiard</h2>' data-credit="Crédit Image : VALERY HACHE / AFP"></a>
          <img src="http://dummyimage.com/640x404/000/fff.png" srcset="http://dummyimage.com/640x404/000/fff.png 1x, http://dummyimage.com/1280x808/000/fff.png 2x" alt="">
          <div class="picto"><i class="icon icon_photo"></i></div>
          <div class="info">
            <div class="vCenter">
              <div class="vCenterKid">
                <a href="#" class="category">Montée des marches</a><span class="date">18.05.15</span>
                <p data-title="Le photocall de Maïwenn">Le photocall de Maïwenn</p>
              </div>
            </div>
          </div>
        </div>
        <div class="item theme2 date1 theme shadow-bottom photo">
          <a id="photo13" data-pid="13" class="ajax chocolat-image" href="img/slide002.jpg" title='<span class="category">Conférence de presse</span><span class="date">18.05.2012</span><h2>Sur le tournage de "Deephan" de Jacques Audiard</h2>' data-credit="Crédit Image : VALERY HACHE / AFP"></a>
          <img src="http://dummyimage.com/640x404/000/fff.png" srcset="http://dummyimage.com/640x404/ddd/000.png 1x, http://dummyimage.com/1280x808/ddd/000.png 2x" alt="">
          <div class="picto"><i class="icon icon_photo"></i></div>
          <div class="info">
            <div class="vCenter">
              <div class="vCenterKid">
                <a href="#" class="category">Montée des marches</a><span class="date">18.05.15</span>
                <p data-title="Le photocall de Maïwenn">Le photocall de Maïwenn</p>
              </div>
            </div>
          </div>
        </div>
        <div class="item theme2 date2 theme shadow-bottom photo">
          <a id="photo14" data-pid="14" class="ajax chocolat-image" href="img/slide002.jpg" title='<span class="category">Conférence de presse</span><span class="date">18.05.2012</span><h2>Sur le tournage de "Deephan" de Jacques Audiard</h2>' data-credit="Crédit Image : VALERY HACHE / AFP"></a>
          <img src="http://dummyimage.com/640x404/000/fff.png" srcset="http://dummyimage.com/640x404/ddd/000.png 1x, http://dummyimage.com/1280x808/ddd/000.png 2x" alt="">
          <div class="picto"><i class="icon icon_photo"></i></div>
          <div class="info">
            <div class="vCenter">
              <div class="vCenterKid">
                <a href="#" class="category">Montée des marches</a><span class="date">18.05.15</span>
                <p data-title="Le photocall de Maïwenn">Le photocall de Maïwenn</p>
              </div>
            </div>
          </div>
        </div>
        <div class="item theme1 date1 date theme portrait shadow-bottom photo">
          <a id="photo15" data-pid="15" class="ajax chocolat-image" href="img/slide002.jpg" title='<span class="category">Conférence de presse</span><span class="date">18.05.2012</span><h2>Sur le tournage de "Deephan" de Jacques Audiard</h2>' data-credit="Crédit Image : VALERY HACHE / AFP"></a>
          <img src="http://dummyimage.com/320x404/3498db/.png" srcset="http://dummyimage.com/320x404/3498db/.png 1x, http://dummyimage.com/640x808/000/fff.png 2x" alt="">
          <div class="picto"><i class="icon icon_photo"></i></div>
          <div class="info">
            <div class="vCenter">
              <div class="vCenterKid">
                <a href="#" class="category">Montée des marches</a><span class="date">18.05.15</span>
                <p data-title="Le photocall de Maïwenn">Le photocall de Maïwenn</p>
              </div>
            </div>
          </div>
        </div>
        <div class="item theme2 date theme shadow-bottom photo">
          <a id="photo16" data-pid="16" class="ajax chocolat-image" href="img/slide002.jpg" title='<span class="category">Conférence de presse</span><span class="date">18.05.2012</span><h2>Sur le tournage de "Deephan" de Jacques Audiard</h2>' data-credit="Crédit Image : VALERY HACHE / AFP"></a>
          <img src="http://dummyimage.com/640x404/000/fff.png" srcset="http://dummyimage.com/640x404/ddd/000.png 1x, http://dummyimage.com/1280x808/ddd/000.png 2x" alt="">
          <div class="picto"><i class="icon icon_photo"></i></div>
          <div class="info">
            <div class="vCenter">
              <div class="vCenterKid">
                <a href="#" class="category">Montée des marches</a><span class="date">18.05.15</span>
                <p data-title="Le photocall de Maïwenn">Le photocall de Maïwenn</p>
              </div>
            </div>
          </div>
        </div>
        <div class="item theme2 date1 theme shadow-bottom photo">
          <a cid="photo17" data-pid="17" lass="ajax chocolat-image" href="img/slide002.jpg" title='<span class="category">Conférence de presse</span><span class="date">18.05.2012</span><h2>Sur le tournage de "Deephan" de Jacques Audiard</h2>' data-credit="Crédit Image : VALERY HACHE / AFP"></a>
          <img src="http://dummyimage.com/640x404/000/fff.png" srcset="http://dummyimage.com/640x404/ddd/000.png 1x, http://dummyimage.com/1280x808/ddd/000.png 2x" alt="">
          <div class="picto"><i class="icon icon_photo"></i></div>
          <div class="info">
            <div class="vCenter">
              <div class="vCenterKid">
                <a href="#" class="category">Montée des marches</a><span class="date">18.05.15</span>
                <p data-title="Le photocall de Maïwenn">Le photocall de Maïwenn</p>
              </div>
            </div>
          </div>
        </div>
        <div class="item theme2 theme shadow-bottom photo">
          <a id="photo18" data-pid="18" class="ajax chocolat-image" href="img/slide002.jpg" title='<span class="category">Conférence de presse</span><span class="date">18.05.2012</span><h2>Sur le tournage de "Deephan" de Jacques Audiard</h2>' data-credit="Crédit Image : VALERY HACHE / AFP"></a>
          <img src="http://dummyimage.com/640x404/000/fff.png" srcset="http://dummyimage.com/640x404/ddd/000.png 1x, http://dummyimage.com/1280x808/ddd/000.png 2x" alt="">
          <div class="picto"><i class="icon icon_photo"></i></div>
          <div class="info">
            <div class="vCenter">
              <div class="vCenterKid">
                <a href="#" class="category">Montée des marches</a><span class="date">18.05.15</span>
                <p data-title="Le photocall de Maïwenn">Le photocall de Maïwenn</p>
              </div>
            </div>
          </div>
        </div>
        <div class="item theme2 date theme shadow-bottom photo">
          <a id="photo19" data-pid="19" class="ajax chocolat-image" href="img/slide002.jpg" title='<span class="category">Conférence de presse</span><span class="date">18.05.2012</span><h2>Sur le tournage de "Deephan" de Jacques Audiard</h2>' data-credit="Crédit Image : VALERY HACHE / AFP"></a>
          <img src="http://dummyimage.com/640x404/000/fff.png" srcset="http://dummyimage.com/640x404/ddd/000.png 1x, http://dummyimage.com/1280x808/ddd/000.png 2x" alt="">
          <div class="picto"><i class="icon icon_photo"></i></div>
          <div class="info">
            <div class="vCenter">
              <div class="vCenterKid">
                <a href="#" class="category">Montée des marches</a><span class="date">18.05.15</span>
                <p data-title="Le photocall de Maïwenn">Le photocall de Maïwenn</p>
              </div>
            </div>
          </div>
        </div>
        <div class="item theme2 date theme shadow-bottom photo">
          <a id="photo20" data-pid="20" class="ajax chocolat-image" href="img/slide002.jpg" title='<span class="category">Conférence de presse</span><span class="date">18.05.2012</span><h2>Sur le tournage de "Deephan" de Jacques Audiard</h2>' data-credit="Crédit Image : VALERY HACHE / AFP"></a>
          <img src="http://dummyimage.com/640x404/000/fff.png" srcset="http://dummyimage.com/640x404/ddd/000.png 1x, http://dummyimage.com/1280x808/ddd/000.png 2x" alt="">
          <div class="picto"><i class="icon icon_photo"></i></div>
          <div class="info">
            <div class="vCenter">
              <div class="vCenterKid">
                <a href="#" class="category">Montée des marches</a><span class="date">18.05.15</span>
                <p data-title="Le photocall de Maïwenn">Le photocall de Maïwenn</p>
              </div>
            </div>
          </div>
        </div>
        <div class="item theme2 date theme shadow-bottom photo">
          <a id="photo21" data-pid="21" class="ajax chocolat-image" href="img/slide002.jpg" title='<span class="category">Conférence de presse</span><span class="date">18.05.2012</span><h2>Sur le tournage de "Deephan" de Jacques Audiard</h2>' data-credit="Crédit Image : VALERY HACHE / AFP"></a>
          <img src="http://dummyimage.com/640x404/000/fff.png" srcset="http://dummyimage.com/640x404/000/fff.png 1x, http://dummyimage.com/1280x808/000/fff.png 2x" alt="">
          <div class="picto"><i class="icon icon_photo"></i></div>
          <div class="info">
            <div class="vCenter">
              <div class="vCenterKid">
                <a href="#" class="category">Montée des marches</a><span class="date">18.05.15</span>
                <p data-title="Le photocall de Maïwenn">Le photocall de Maïwenn</p>
              </div>
            </div>
          </div>
        </div>
        <div class="item theme2 date theme shadow-bottom photo">
          <a id="photo22" data-pid="22" class="ajax chocolat-image" href="img/slide002.jpg" title='<span class="category">Conférence de presse</span><span class="date">18.05.2012</span><h2>Sur le tournage de "Deephan" de Jacques Audiard</h2>' data-credit="Crédit Image : VALERY HACHE / AFP"></a>
          <img src="http://dummyimage.com/640x404/000/fff.png" srcset="http://dummyimage.com/640x404/ddd/000.png 1x, http://dummyimage.com/1280x808/ddd/000.png 2x" alt="">
          <div class="picto"><i class="icon icon_photo"></i></div>
          <div class="info">
            <div class="vCenter">
              <div class="vCenterKid">
                <a href="#" class="category">Montée des marches</a><span class="date">18.05.15</span>
                <p data-title="Le photocall de Maïwenn">Le photocall de Maïwenn</p>
              </div>
            </div>
          </div>
        </div>
        <div class="item theme2 date theme shadow-bottom photo">
          <a id="photo23" data-pid="23" class="ajax chocolat-image" href="img/slide002.jpg" title='<span class="category">Conférence de presse</span><span class="date">18.05.2012</span><h2>Sur le tournage de "Deephan" de Jacques Audiard</h2>' data-credit="Crédit Image : VALERY HACHE / AFP"></a>
          <img src="http://dummyimage.com/640x404/000/fff.png" srcset="http://dummyimage.com/640x404/ddd/000.png 1x, http://dummyimage.com/1280x808/ddd/000.png 2x" alt="">
          <div class="picto"><i class="icon icon_photo"></i></div>
          <div class="info">
            <div class="vCenter">
              <div class="vCenterKid">
                <a href="#" class="category">Montée des marches</a><span class="date">18.05.15</span>
                <p data-title="Le photocall de Maïwenn">Le photocall de Maïwenn</p>
              </div>
            </div>
          </div>
        </div>
        <div class="item theme2 date2 theme shadow-bottom photo">
          <a id="photo24" data-pid="24" class="ajax chocolat-image" href="img/slide002.jpg" title='<span class="category">Conférence de presse</span><span class="date">18.05.2012</span><h2>Sur le tournage de "Deephan" de Jacques Audiard</h2>' data-credit="Crédit Image : VALERY HACHE / AFP"></a>
          <img src="http://dummyimage.com/640x404/000/fff.png" srcset="http://dummyimage.com/640x404/ddd/000.png 1x, http://dummyimage.com/1280x808/ddd/000.png 2x" alt="">
          <div class="picto"><i class="icon icon_photo"></i></div>
          <div class="info">
            <div class="vCenter">
              <div class="vCenterKid">
                <a href="#" class="category">Montée des marches</a><span class="date">18.05.15</span>
                <p data-title="Le photocall de Maïwenn">Le photocall de Maïwenn</p>
              </div>
            </div>
          </div>
        </div>
        <div class="item theme2 date theme shadow-bottom photo">
          <a id="photo25" data-pid="25" class="ajax chocolat-image" href="img/slide002.jpg" title='<span class="category">Conférence de presse</span><span class="date">18.05.2012</span><h2>Sur le tournage de "Deephan" de Jacques Audiard</h2>' data-credit="Crédit Image : VALERY HACHE / AFP"></a>
          <img src="http://dummyimage.com/640x404/000/fff.png" srcset="http://dummyimage.com/640x404/ddd/000.png 1x, http://dummyimage.com/1280x808/ddd/000.png 2x" alt="">
          <div class="picto"><i class="icon icon_photo"></i></div>
          <div class="info">
            <div class="vCenter">
              <div class="vCenterKid">
                <a href="#" class="category">Montée des marches</a><span class="date">18.05.15</span>
                <p data-title="Le photocall de Maïwenn">Le photocall de Maïwenn</p>
              </div>
            </div>
          </div>
        </div>
        <div class="item theme2 date theme shadow-bottom photo">
          <a id="photo26" data-pid="26" class="ajax chocolat-image" href="img/slide002.jpg" title='<span class="category">Conférence de presse</span><span class="date">18.05.2012</span><h2>Sur le tournage de "Deephan" de Jacques Audiard</h2>' data-credit="Crédit Image : VALERY HACHE / AFP"></a>
          <img src="http://dummyimage.com/640x404/000/fff.png" srcset="http://dummyimage.com/640x404/ddd/000.png 1x, http://dummyimage.com/1280x808/ddd/000.png 2x" alt="">
          <div class="picto"><i class="icon icon_photo"></i></div>
          <div class="info">
            <div class="vCenter">
              <div class="vCenterKid">
                <a href="#" class="category">Montée des marches</a><span class="date">18.05.15</span>
                <p data-title="Le photocall de Maïwenn">Le photocall de Maïwenn</p>
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
