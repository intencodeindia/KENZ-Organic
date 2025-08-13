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
                    <span class="headline line__two" style="text-shadow: 2px 2px 5px rgba(0, 0, 0, 0.3);">KENZ FOR BUILDING COMMUNITY</span>
                  </div>
                  <div class="d__flex banner__text--wrapper">
                    <div class="banner__text">
                      KENZ Community is dedicated to empowering farmers through sustainable practices, providing education and resources to enhance productivity and environmental stewardship. By fostering collaboration, KENZ helps farmers thrive while contributing to the well-being of local communities and the planet.rt local communities, and minimize environmental impact.
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
            <h4 style="text-align: center;">BUILDING COMMUNITY</h4>
            <p style="margin-bottom: 20px;">
            KENZ Services is committed to creating a thriving community of hydroponic farmers and enthusiasts through a balanced approach that combines online learning with practical, on-farm training. Their online hydroponic masterclasses offer participants access to expert guidance, techniques, and best practices in soilless farming, enabling flexible, self-paced learning. In parallel, KENZ provides hands-on training sessions in real farming settings, where participants can gain valuable experience with cutting-edge hydroponic systems. This integrated approach promotes skill development, knowledge sharing, and networking, empowering individuals to adopt sustainable farming practices and contribute to the growth of the hydroponic farming community.</p>
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
                src="./media/images/team-image33.jpg"
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
                src="./media/images/Raspberry propagation area with windbreaker.jpg"
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
                src="./media/images/PepsiCo & Yara team up for sustainable farming in Europe.jpg"
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
  <!--partial-->
  <?php include_once('./includes/sinup.php'); ?>
  <?php include_once('./includes/footer.php'); ?>