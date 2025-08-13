<?php
include_once('./includes/header.php');
?>

<body
  class="  "
  data-aos-easing="ease"
  data-aos-duration="600"
  data-aos-delay="0"
  cz-shortcut-listen="true">

  <title>KENZ ORGANIC</title>

  <link rel="stylesheet" href="./css/swiper-bundle.min.css" />

  <link rel="stylesheet" href="./css/sgiv2-main.min.css" />
  <link rel="stylesheet" href="./css/sgiv2-sgi-mgi.min.css" />
  <!-- <link rel="stylesheet" href="./css/sgiv3-main.min.css" />
  <link rel="stylesheet" href="./css/sgiv4-main.min.css" /> -->


  <?php include 'includes/menu.php'; ?>

  <!--hero-->
  <section class="hero has--hero-banner">
    <div class="hero__slider__wrapper pos--relative">
      <div
        class="hero__slider swiper swiper-initialized swiper-horizontal swiper-pointer-events swiper-backface-hidden">
        <div
          class="swiper-wrapper"
          id="swiper-wrapper-3dcf8f6b534dd310"
          aria-live="polite"
          style="transform: translate3d(0px, 0px, 0px)">
          <!--slider item -->
          <div
            data-name="Climate Action"
            class="swiper-slide hero__slider__item swiper-video--slider swiper-slide-active"
            role="group"
            aria-label="1 / 3"
            style="width: 1909px">
            <div class="banner__caption" style="background: radial-gradient(circle at left, rgba(0, 0, 0, 0.7), rgba(0, 0, 0, 0)80%);">
              <div class="container__fluid">
                <div class="banner__caption__content">
                  <div class="headline__wrapper">
                    <span class="headline line__two" style="text-shadow: 2px 2px 5px rgba(0, 0, 0, 0.3);">KENZ FOR AGRO-CSR PLANNING</span>
                  </div>
                  <div class="d__flex banner__text--wrapper">
                    <div class="banner__text">
                      Agro-CSR involves agricultural companies' efforts to promote sustainability, support local communities, and minimize environmental impact.
                    </div>
                    <div class="btn__group d__flex"></div>
                  </div>
                </div>
              </div>
            </div>

            <picture class="web__bg">
              <source srcset="./media/images/csr-agro.webp" type="image/jpg">
              <img src="./media/images/csr-agro.webp" alt="kid running towards windmill through green paddy field" width="2000" height="1520" class="cover--img center web__bg--img">
            </picture>
          </div>
          <span
            class="swiper-notification"
            aria-live="assertive"
            aria-atomic="true"></span>
        </div>
      </div>
  </section>

  <main class="climate--governance__wrapper">
    <!--intro-->
    <!--content-->

    <section class="cg__content--blocks">
      <div class="container__fluid">
        <!--progress-->
        <div class="progress__wrapper">

          <div class="content d__grid" data-aos="fade-up" data-aos-delay="100" style="margin-bottom: 18px;">
            <h4 style="text-align: center;">AGRO-CSR PLANNINGKRYZEN FOR AGRO-CSR PLANNING</h4>
            <p style="margin-bottom: 20px;">
              KENZ Services is dedicated to fostering agro-Corporate Social Responsibility (CSR) within the agricultural sector, with a strong focus on sustainable development and community upliftment. Through strategic partnerships with corporations, KENZ advocates for responsible farming practices that positively impact both the environment and local communities. Their CSR initiatives include offering training and resources to smallholder farmers, promoting sustainable agricultural techniques, and spearheading projects that enhance food security. KENZ’s agro-CSR efforts not only improve farmers' livelihoods but also encourage corporate accountability by motivating businesses to invest in environmentally and socially responsible agricultural practices that benefit both society and the planet.</p>
          </div>

        </div>
      </div>
    </section>
  </main>
  <!--news-->

  <!--news-->
  <section class="latest__news">
    <div class="container__fluid">
      <div
        class="title__tag space--lg clr__brand d__grid has__border aos-init aos-animate"
        data-aos="fade">
        <h4
          class="block__title aos-init aos-animate"
          data-aos="fade-up"
          data-aos-delay="100">
          AGRO-CSR PLANNING
        </h4>
      </div>

      <div
        class="latest__news--list media__list__wrapper d__grid three--col aos-init aos-animate"
        data-aos="fade-up">
        <div class="news__list__item media__list__item">
          <figure>
            <picture>
              <img
                src="./media/images/26-1.jpg"
                alt="img"
                width="1000"
                height="600"
                class="cover--img center" />
            </picture>
          </figure>
        </div>
        <div class="news__list__item media__list__item">
          <figure>
            <picture>
              <img
                src="./media/images/27-2.jpg"
                alt="img"
                width="1000"
                height="600"
                class="cover--img center" />
            </picture>
          </figure>
        </div>
        <div class="news__list__item media__list__item">
          <figure>
            <picture>
              <img
                src="./media/images/28-2.jpg"
                alt="img"
                width="1000"
                height="600"
                class="cover--img center" />
            </picture>
          </figure>
        </div>
      </div>
    </div>
  </section>

  <!--newsletter-->
  <?php include_once('./includes/sinup.php'); ?>
  <?php include_once('./includes/footer.php'); ?>