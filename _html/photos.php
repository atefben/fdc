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
            <span class="active" data-filter="all">Toutes</span>
            <span data-filter="date">Date 1</span>
            <span data-filter="date1">Date 2</span>
          </span>
        </div>
        <div id="format" class="filter">
          <span class="label">Thèmes :</span>
          <span class="select">
            <span class="active" data-filter="all">Tous</span>
            <span data-filter="theme1">Thème 1</span>
            <span data-filter="theme2">Thème 2</span>
          </span>
        </div>
      </div>
      <div id="gridPhotos" class="grid-wrapper">
        <div class="grid-sizer"></div>
        <div class="item theme1 date theme portrait shadow-bottom photo">
          <a id="photo1" class="ajax chocolat-image" href="img/slide002.jpg" title='<span class="category">Conférence de presse</span><span class="date">18.05.2012</span><h2>Sur le tournage de "Deephan" de Jacques Audiard</h2>' data-credit="Crédit Image : VALERY HACHE / AFP"></a>
          <img src="http://dummyimage.com/320x404/3498db/.png" srcset="http://dummyimage.com/320x404/3498db/.png 1x, http://dummyimage.com/640x808/000/fff.png 2x" alt="">
          <div class="picto"></div>
          <div class="info">
            <div class="vCenter">
              <div class="vCenterKid">
                <a href="#" class="category">Montée des marches</a><span class="date">18.05.15</span>
                <p>Le photocall de Maïwenn</p>
              </div>
            </div>
          </div>
        </div>
        <div class="item theme2 date1 theme shadow-bottom photo">
          <a id="photo2" class="ajax chocolat-image" href="img/slide002.jpg" title='<span class="category">Conférence de presse</span><span class="date">18.05.2012</span><h2>Sur le tournage de "Deephan" de Jacques Audiard</h2>' data-credit="Crédit Image : VALERY HACHE / AFP"></a>
          <img src="http://dummyimage.com/640x404/000/fff.png" srcset="http://dummyimage.com/640x404/ddd/000.png 1x, http://dummyimage.com/1280x808/ddd/000.png 2x" alt="">
          <div class="picto"></div>
          <div class="info">
            <div class="vCenter">
              <div class="vCenterKid">
                <a href="#" class="category">Montée des marches</a><span class="date">18.05.15</span>
                <p>Le photocall de Maïwenn</p>
              </div>
            </div>
          </div>
        </div>
        <div class="item theme2 date2 date theme shadow-bottom photo">
          <a id="photo3" class="ajax chocolat-image" href="img/slide001.jpg" title='<span class="category">Conférence de presse</span><span class="date">18.05.2012</span><h2>Sur le tournage de "Deephan" de Jacques Audiard</h2>' data-credit="Crédit Image : VALERY HACHE / AFP"></a>
          <img src="http://dummyimage.com/640x404/000/fff.png" srcset="http://dummyimage.com/640x404/ddd/000.png 1x, http://dummyimage.com/1280x808/ddd/000.png 2x" alt="">
          <div class="picto"></div>
          <div class="info">
            <div class="vCenter">
              <div class="vCenterKid">
                <a href="#" class="category">Montée des marches</a><span class="date">18.05.15</span>
                <p>Le photocall de Maïwenn</p>
              </div>
            </div>
          </div>
        </div>
        <div class="item theme2 date theme portrait shadow-bottom photo">
          <a id="photo4" class="ajax chocolat-image" href="img/slide002.jpg" title='<span class="category">Conférence de presse</span><span class="date">18.05.2012</span><h2>Sur le tournage de "Deephan" de Jacques Audiard</h2>' data-credit="Crédit Image : VALERY HACHE / AFP"></a>
          <img src="http://dummyimage.com/320x404/3498db/.png" srcset="http://dummyimage.com/320x404/3498db/.png 1x, http://dummyimage.com/640x808/000/fff.png 2x" alt="">
          <div class="picto"></div>
          <div class="info">
            <div class="vCenter">
              <div class="vCenterKid">
                <a href="#" class="category">Montée des marches</a><span class="date">18.05.15</span>
                <p>Le photocall de Maïwenn</p>
              </div>
            </div>
          </div>
        </div>
        <div class="item theme2 theme shadow-bottom photo">
          <a id="photo5" class="ajax chocolat-image" href="img/slide002.jpg" title='<span class="category">Conférence de presse</span><span class="date">18.05.2012</span><h2>Sur le tournage de "Deephan" de Jacques Audiard</h2>' data-credit="Crédit Image : VALERY HACHE / AFP"></a>
          <img src="http://dummyimage.com/640x404/000/fff.png" srcset="http://dummyimage.com/640x404/ddd/000.png 1x, http://dummyimage.com/1280x808/ddd/000.png 2x" alt="">
          <div class="picto"></div>
          <div class="info">
            <div class="vCenter">
              <div class="vCenterKid">
                <a href="#" class="category">Montée des marches</a><span class="date">18.05.15</span>
                <p>Le photocall de Maïwenn</p>
              </div>
            </div>
          </div>
        </div>
        <div class="item theme2 date1 theme shadow-bottom photo">
          <a id="photo6" class="ajax chocolat-image" href="img/slide002.jpg" title='<span class="category">Conférence de presse</span><span class="date">18.05.2012</span><h2>Sur le tournage de "Deephan" de Jacques Audiard</h2>' data-credit="Crédit Image : VALERY HACHE / AFP"></a>
          <img src="http://dummyimage.com/640x404/000/fff.png" srcset="http://dummyimage.com/640x404/ddd/000.png 1x, http://dummyimage.com/1280x808/ddd/000.png 2x" alt="">
          <div class="picto"></div>
          <div class="info">
            <div class="vCenter">
              <div class="vCenterKid">
                <a href="#" class="category">Montée des marches</a><span class="date">18.05.15</span>
                <p>Le photocall de Maïwenn</p>
              </div>
            </div>
          </div>
        </div>
        <div class="item theme1 date2 theme shadow-bottom photo">
          <a id="photo7" class="ajax chocolat-image" href="img/slide002.jpg" title='<span class="category">Conférence de presse</span><span class="date">18.05.2012</span><h2>Sur le tournage de "Deephan" de Jacques Audiard</h2>' data-credit="Crédit Image : VALERY HACHE / AFP"></a>
          <img src="http://dummyimage.com/640x404/000/fff.png" srcset="http://dummyimage.com/640x404/000/fff.png 1x, http://dummyimage.com/1280x808/000/fff.png 2x" alt="">
          <div class="picto"></div>
          <div class="info">
            <div class="vCenter">
              <div class="vCenterKid">
                <a href="#" class="category">Montée des marches</a><span class="date">18.05.15</span>
                <p>Le photocall de Maïwenn</p>
              </div>
            </div>
          </div>
        </div>
        <div class="item theme2 date theme shadow-bottom photo">
          <a id="photo8" class="ajax chocolat-image" href="img/slide002.jpg" title='<span class="category">Conférence de presse</span><span class="date">18.05.2012</span><h2>Sur le tournage de "Deephan" de Jacques Audiard</h2>' data-credit="Crédit Image : VALERY HACHE / AFP"></a>
          <img src="http://dummyimage.com/640x404/000/fff.png" srcset="http://dummyimage.com/640x404/ddd/000.png 1x, http://dummyimage.com/1280x808/ddd/000.png 2x" alt="">
          <div class="picto"></div>
          <div class="info">
            <div class="vCenter">
              <div class="vCenterKid">
                <a href="#" class="category">Montée des marches</a><span class="date">18.05.15</span>
                <p>Le photocall de Maïwenn</p>
              </div>
            </div>
          </div>
        </div>
        <div class="item theme2 date1 theme portrait shadow-bottom photo">
          <a id="photo9" class="ajax chocolat-image" href="img/slide002.jpg" title='<span class="category">Conférence de presse</span><span class="date">18.05.2012</span><h2>Sur le tournage de "Deephan" de Jacques Audiard</h2>' data-credit="Crédit Image : VALERY HACHE / AFP"></a>
          <img src="http://dummyimage.com/320x404/3498db/.png" srcset="http://dummyimage.com/320x404/3498db/.png 1x, http://dummyimage.com/640x808/000/fff.png 2x" alt="">
          <div class="picto"></div>
          <div class="info">
            <div class="vCenter">
              <div class="vCenterKid">
                <a href="#" class="category">Montée des marches</a><span class="date">18.05.15</span>
                <p>Le photocall de Maïwenn</p>
              </div>
            </div>
          </div>
        </div>
        <div class="item theme2 date2 theme shadow-bottom photo">
          <a class="ajax chocolat-image" href="img/slide002.jpg" title='<span class="category">Conférence de presse</span><span class="date">18.05.2012</span><h2>Sur le tournage de "Deephan" de Jacques Audiard</h2>' data-credit="Crédit Image : VALERY HACHE / AFP"></a>
          <img src="http://dummyimage.com/640x404/000/fff.png" srcset="http://dummyimage.com/640x404/ddd/000.png 1x, http://dummyimage.com/1280x808/ddd/000.png 2x" alt="">
          <div class="picto"></div>
          <div class="info">
            <div class="vCenter">
              <div class="vCenterKid">
                <a href="#" class="category">Montée des marches</a><span class="date">18.05.15</span>
                <p>Le photocall de Maïwenn</p>
              </div>
            </div>
          </div>
        </div>
        <div class="item theme2 date1 theme shadow-bottom photo">
          <a class="ajax chocolat-image" href="img/slide002.jpg" title='<span class="category">Conférence de presse</span><span class="date">18.05.2012</span><h2>Sur le tournage de "Deephan" de Jacques Audiard</h2>' data-credit="Crédit Image : VALERY HACHE / AFP"></a>
          <img src="http://dummyimage.com/640x404/000/fff.png" srcset="http://dummyimage.com/640x404/ddd/000.png 1x, http://dummyimage.com/1280x808/ddd/000.png 2x" alt="">
          <div class="picto"></div>
          <div class="info">
            <div class="vCenter">
              <div class="vCenterKid">
                <a href="#" class="category">Montée des marches</a><span class="date">18.05.15</span>
                <p>Le photocall de Maïwenn</p>
              </div>
            </div>
          </div>
        </div>
        <div class="item theme1 date2 theme shadow-bottom photo">
          <a class="ajax chocolat-image" href="img/slide002.jpg" title='<span class="category">Conférence de presse</span><span class="date">18.05.2012</span><h2>Sur le tournage de "Deephan" de Jacques Audiard</h2>' data-credit="Crédit Image : VALERY HACHE / AFP"></a>
          <img src="http://dummyimage.com/640x404/000/fff.png" srcset="http://dummyimage.com/640x404/000/fff.png 1x, http://dummyimage.com/1280x808/000/fff.png 2x" alt="">
          <div class="picto"></div>
          <div class="info">
            <div class="vCenter">
              <div class="vCenterKid">
                <a href="#" class="category">Montée des marches</a><span class="date">18.05.15</span>
                <p>Le photocall de Maïwenn</p>
              </div>
            </div>
          </div>
        </div>
        <div class="item theme2 date1 theme shadow-bottom photo">
          <a class="ajax chocolat-image" href="img/slide002.jpg" title='<span class="category">Conférence de presse</span><span class="date">18.05.2012</span><h2>Sur le tournage de "Deephan" de Jacques Audiard</h2>' data-credit="Crédit Image : VALERY HACHE / AFP"></a>
          <img src="http://dummyimage.com/640x404/000/fff.png" srcset="http://dummyimage.com/640x404/ddd/000.png 1x, http://dummyimage.com/1280x808/ddd/000.png 2x" alt="">
          <div class="picto"></div>
          <div class="info">
            <div class="vCenter">
              <div class="vCenterKid">
                <a href="#" class="category">Montée des marches</a><span class="date">18.05.15</span>
                <p>Le photocall de Maïwenn</p>
              </div>
            </div>
          </div>
        </div>
        <div class="item theme2 date2 theme shadow-bottom photo">
          <a class="ajax chocolat-image" href="img/slide002.jpg" title='<span class="category">Conférence de presse</span><span class="date">18.05.2012</span><h2>Sur le tournage de "Deephan" de Jacques Audiard</h2>' data-credit="Crédit Image : VALERY HACHE / AFP"></a>
          <img src="http://dummyimage.com/640x404/000/fff.png" srcset="http://dummyimage.com/640x404/ddd/000.png 1x, http://dummyimage.com/1280x808/ddd/000.png 2x" alt="">
          <div class="picto"></div>
          <div class="info">
            <div class="vCenter">
              <div class="vCenterKid">
                <a href="#" class="category">Montée des marches</a><span class="date">18.05.15</span>
                <p>Le photocall de Maïwenn</p>
              </div>
            </div>
          </div>
        </div>
        <div class="item theme1 date1 date theme portrait shadow-bottom photo">
          <a class="ajax chocolat-image" href="img/slide002.jpg" title='<span class="category">Conférence de presse</span><span class="date">18.05.2012</span><h2>Sur le tournage de "Deephan" de Jacques Audiard</h2>' data-credit="Crédit Image : VALERY HACHE / AFP"></a>
          <img src="http://dummyimage.com/320x404/3498db/.png" srcset="http://dummyimage.com/320x404/3498db/.png 1x, http://dummyimage.com/640x808/000/fff.png 2x" alt="">
          <div class="picto"></div>
          <div class="info">
            <div class="vCenter">
              <div class="vCenterKid">
                <a href="#" class="category">Montée des marches</a><span class="date">18.05.15</span>
                <p>Le photocall de Maïwenn</p>
              </div>
            </div>
          </div>
        </div>
        <div class="item theme2 date theme shadow-bottom photo">
          <a class="ajax chocolat-image" href="img/slide002.jpg" title='<span class="category">Conférence de presse</span><span class="date">18.05.2012</span><h2>Sur le tournage de "Deephan" de Jacques Audiard</h2>' data-credit="Crédit Image : VALERY HACHE / AFP"></a>
          <img src="http://dummyimage.com/640x404/000/fff.png" srcset="http://dummyimage.com/640x404/ddd/000.png 1x, http://dummyimage.com/1280x808/ddd/000.png 2x" alt="">
          <div class="picto"></div>
          <div class="info">
            <div class="vCenter">
              <div class="vCenterKid">
                <a href="#" class="category">Montée des marches</a><span class="date">18.05.15</span>
                <p>Le photocall de Maïwenn</p>
              </div>
            </div>
          </div>
        </div>
        <div class="item theme2 date1 theme shadow-bottom photo">
          <a class="ajax chocolat-image" href="img/slide002.jpg" title='<span class="category">Conférence de presse</span><span class="date">18.05.2012</span><h2>Sur le tournage de "Deephan" de Jacques Audiard</h2>' data-credit="Crédit Image : VALERY HACHE / AFP"></a>
          <img src="http://dummyimage.com/640x404/000/fff.png" srcset="http://dummyimage.com/640x404/ddd/000.png 1x, http://dummyimage.com/1280x808/ddd/000.png 2x" alt="">
          <div class="picto"></div>
          <div class="info">
            <div class="vCenter">
              <div class="vCenterKid">
                <a href="#" class="category">Montée des marches</a><span class="date">18.05.15</span>
                <p>Le photocall de Maïwenn</p>
              </div>
            </div>
          </div>
        </div>
        <div class="item theme2 theme shadow-bottom photo">
          <a class="ajax chocolat-image" href="img/slide002.jpg" title='<span class="category">Conférence de presse</span><span class="date">18.05.2012</span><h2>Sur le tournage de "Deephan" de Jacques Audiard</h2>' data-credit="Crédit Image : VALERY HACHE / AFP"></a>
          <img src="http://dummyimage.com/640x404/000/fff.png" srcset="http://dummyimage.com/640x404/ddd/000.png 1x, http://dummyimage.com/1280x808/ddd/000.png 2x" alt="">
          <div class="picto"></div>
          <div class="info">
            <div class="vCenter">
              <div class="vCenterKid">
                <a href="#" class="category">Montée des marches</a><span class="date">18.05.15</span>
                <p>Le photocall de Maïwenn</p>
              </div>
            </div>
          </div>
        </div>
        <div class="item theme2 date theme shadow-bottom photo">
          <a class="ajax chocolat-image" href="img/slide002.jpg" title='<span class="category">Conférence de presse</span><span class="date">18.05.2012</span><h2>Sur le tournage de "Deephan" de Jacques Audiard</h2>' data-credit="Crédit Image : VALERY HACHE / AFP"></a>
          <img src="http://dummyimage.com/640x404/000/fff.png" srcset="http://dummyimage.com/640x404/ddd/000.png 1x, http://dummyimage.com/1280x808/ddd/000.png 2x" alt="">
          <div class="picto"></div>
          <div class="info">
            <div class="vCenter">
              <div class="vCenterKid">
                <a href="#" class="category">Montée des marches</a><span class="date">18.05.15</span>
                <p>Le photocall de Maïwenn</p>
              </div>
            </div>
          </div>
        </div>
        <div class="item theme2 date theme shadow-bottom photo">
          <a class="ajax chocolat-image" href="img/slide002.jpg" title='<span class="category">Conférence de presse</span><span class="date">18.05.2012</span><h2>Sur le tournage de "Deephan" de Jacques Audiard</h2>' data-credit="Crédit Image : VALERY HACHE / AFP"></a>
          <img src="http://dummyimage.com/640x404/000/fff.png" srcset="http://dummyimage.com/640x404/ddd/000.png 1x, http://dummyimage.com/1280x808/ddd/000.png 2x" alt="">
          <div class="picto"></div>
          <div class="info">
            <div class="vCenter">
              <div class="vCenterKid">
                <a href="#" class="category">Montée des marches</a><span class="date">18.05.15</span>
                <p>Le photocall de Maïwenn</p>
              </div>
            </div>
          </div>
        </div>
        <div class="item theme2 date theme shadow-bottom photo">
          <a class="ajax chocolat-image" href="img/slide002.jpg" title='<span class="category">Conférence de presse</span><span class="date">18.05.2012</span><h2>Sur le tournage de "Deephan" de Jacques Audiard</h2>' data-credit="Crédit Image : VALERY HACHE / AFP"></a>
          <img src="http://dummyimage.com/640x404/000/fff.png" srcset="http://dummyimage.com/640x404/000/fff.png 1x, http://dummyimage.com/1280x808/000/fff.png 2x" alt="">
          <div class="picto"></div>
          <div class="info">
            <div class="vCenter">
              <div class="vCenterKid">
                <a href="#" class="category">Montée des marches</a><span class="date">18.05.15</span>
                <p>Le photocall de Maïwenn</p>
              </div>
            </div>
          </div>
        </div>
        <div class="item theme2 date theme shadow-bottom photo">
          <a class="ajax chocolat-image" href="img/slide002.jpg" title='<span class="category">Conférence de presse</span><span class="date">18.05.2012</span><h2>Sur le tournage de "Deephan" de Jacques Audiard</h2>' data-credit="Crédit Image : VALERY HACHE / AFP"></a>
          <img src="http://dummyimage.com/640x404/000/fff.png" srcset="http://dummyimage.com/640x404/ddd/000.png 1x, http://dummyimage.com/1280x808/ddd/000.png 2x" alt="">
          <div class="picto"></div>
          <div class="info">
            <div class="vCenter">
              <div class="vCenterKid">
                <a href="#" class="category">Montée des marches</a><span class="date">18.05.15</span>
                <p>Le photocall de Maïwenn</p>
              </div>
            </div>
          </div>
        </div>
        <div class="item theme2 date theme shadow-bottom photo">
          <a class="ajax chocolat-image" href="img/slide002.jpg" title='<span class="category">Conférence de presse</span><span class="date">18.05.2012</span><h2>Sur le tournage de "Deephan" de Jacques Audiard</h2>' data-credit="Crédit Image : VALERY HACHE / AFP"></a>
          <img src="http://dummyimage.com/640x404/000/fff.png" srcset="http://dummyimage.com/640x404/ddd/000.png 1x, http://dummyimage.com/1280x808/ddd/000.png 2x" alt="">
          <div class="picto"></div>
          <div class="info">
            <div class="vCenter">
              <div class="vCenterKid">
                <a href="#" class="category">Montée des marches</a><span class="date">18.05.15</span>
                <p>Le photocall de Maïwenn</p>
              </div>
            </div>
          </div>
        </div>
        <div class="item theme2 date2 theme shadow-bottom photo">
          <a class="ajax chocolat-image" href="img/slide002.jpg" title='<span class="category">Conférence de presse</span><span class="date">18.05.2012</span><h2>Sur le tournage de "Deephan" de Jacques Audiard</h2>' data-credit="Crédit Image : VALERY HACHE / AFP"></a>
          <img src="http://dummyimage.com/640x404/000/fff.png" srcset="http://dummyimage.com/640x404/ddd/000.png 1x, http://dummyimage.com/1280x808/ddd/000.png 2x" alt="">
          <div class="picto"></div>
          <div class="info">
            <div class="vCenter">
              <div class="vCenterKid">
                <a href="#" class="category">Montée des marches</a><span class="date">18.05.15</span>
                <p>Le photocall de Maïwenn</p>
              </div>
            </div>
          </div>
        </div>
        <div class="item theme2 date theme shadow-bottom photo">
          <a class="ajax chocolat-image" href="img/slide002.jpg" title='<span class="category">Conférence de presse</span><span class="date">18.05.2012</span><h2>Sur le tournage de "Deephan" de Jacques Audiard</h2>' data-credit="Crédit Image : VALERY HACHE / AFP"></a>
          <img src="http://dummyimage.com/640x404/000/fff.png" srcset="http://dummyimage.com/640x404/ddd/000.png 1x, http://dummyimage.com/1280x808/ddd/000.png 2x" alt="">
          <div class="picto"></div>
          <div class="info">
            <div class="vCenter">
              <div class="vCenterKid">
                <a href="#" class="category">Montée des marches</a><span class="date">18.05.15</span>
                <p>Le photocall de Maïwenn</p>
              </div>
            </div>
          </div>
        </div>
        <div class="item theme2 date theme shadow-bottom photo">
          <a class="ajax chocolat-image" href="img/slide002.jpg" title='<span class="category">Conférence de presse</span><span class="date">18.05.2012</span><h2>Sur le tournage de "Deephan" de Jacques Audiard</h2>' data-credit="Crédit Image : VALERY HACHE / AFP"></a>
          <img src="http://dummyimage.com/640x404/000/fff.png" srcset="http://dummyimage.com/640x404/ddd/000.png 1x, http://dummyimage.com/1280x808/ddd/000.png 2x" alt="">
          <div class="picto"></div>
          <div class="info">
            <div class="vCenter">
              <div class="vCenterKid">
                <a href="#" class="category">Montée des marches</a><span class="date">18.05.15</span>
                <p>Le photocall de Maïwenn</p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <?php include('footer.html'); ?>

    <!-- //// SCRIPTS \\\\ -->
    <?php include('scripts.inc.php'); ?>
  </body>
</html>
