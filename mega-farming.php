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
                    <span class="headline line__two" style="text-shadow: 2px 2px 5px rgba(0, 0, 0, 0.3);">KENZ Mega Farming Projects</span>
                  </div>
                  <div class="d__flex banner__text--wrapper">
                    <div class="banner__text">
                      The KENZ Mega Farming Project leverages advanced technologies and sustainable practices to enhance crop yields and address global food security. It focuses on transforming farming systems through innovation and environmental stewardship.
                    </div>
                    <div class="btn__group d__flex"></div>
                  </div>
                </div>
              </div>
            </div>

            <picture class="web__bg">
              <source srcset="./media/images/soil-less-growbags.webp" type="image/jpg">
              <img src="./media/images/soil-less-growbags.webp" alt="kid running towards windmill through green paddy field" width="2000" height="1520" class="cover--img center web__bg--img">
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
          <div class="d__grid two--col">

            <div data-aos="fade-up">
            <video
              width="100%"
              height="70%"
              src="./media/images/tower-garden-video.mp4"
              controls
              autoplay
              muted
              loop style="border-radius: 20px;">
              Your browser does not support the video tag.
            </video>
            </div>

            <div class="content d__grid" data-aos="fade-up" data-aos-delay="100" style="margin-bottom: 18px;">
              <h6>Empowering Mega Farms with Advanced Solutions for Sustainability and Productivity</h6>
              <p>
                KENZ Services supports mega farming operations with scalable and efficient agricultural solutions aimed at boosting productivity and sustainability. By integrating advanced technologies like automated irrigation systems, precision farming tools, and data analytics, KENZ helps large-scale farmers optimize resource use and increase crop yields.</p>
              <p>Their expertise in infrastructure development, including high-capacity greenhouses and expansive hydroponic systems, enables mega farms to achieve greater efficiency and lower operational costs. Partnering with KENZ allows mega farmers to adopt innovative practices that enhance competitiveness while promoting environmental sustainability in the agricultural sector.</p>
            </div>
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
          Follow our journey towards a green future
        </h4>
      </div>

      <div
        class="latest__news--list media__list__wrapper d__grid three--col aos-init aos-animate"
        data-aos="fade-up">
        <div class="news__list__item media__list__item">
          <figure>
            <picture>
              <img
                src="./media/images/team.jpg"
                alt="img"
                width="1000"
                height="600"
                class="cover--img center" />
            </picture>
          </figure>
          <figcaption>
            <h4>Our Team</h4>
          </figcaption>
        </div>
        <div class="news__list__item media__list__item">
          <figure>
            <picture>
              <img
                src="./media/images/29.jpg"
                alt="img"
                width="1000"
                height="600"
                class="cover--img center" />
            </picture>
          </figure>
          <figcaption>
            <h4>
              6MTR Nethouses
            </h4>
          </figcaption>
        </div>
        <div class="news__list__item media__list__item">
          <figure>
            <picture>
              <img
                src="./media/images/31.jpg"
                alt="img"
                width="1000"
                height="600"
                class="cover--img center" />
            </picture>
          </figure>
          <figcaption>
            <h4>
              Wire rope nethouses
            </h4>
          </figcaption>
        </div>
      </div>
    </div>
  </section>

  <!--newsletter-->
  <!--partial-->
  <?php include_once('./includes/sinup.php'); ?>
  <?php include_once('./includes/footer.php'); ?>