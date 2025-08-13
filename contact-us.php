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

  <?php include 'includes/menu.php'; ?>

  <!--hero-->
  <section class="hero has--hero-banner" >
    <div class="hero__slider__wrapper pos--relative" >
      <div
        class="hero__slider swiper swiper-initialized swiper-horizontal swiper-pointer-events swiper-backface-hidden" >
        <div
          class="swiper-wrapper"
          id="swiper-wrapper-3dcf8f6b534dd310"
          aria-live="polite"
          style="transform: translate3d(0px, 0px, 0px)" >
          <!--slider item -->
          <div
            data-name="Climate Action"
            class="swiper-slide hero__slider__item swiper-video--slider swiper-slide-active"
            role="group"
            aria-label="1 / 3"
            style="width: 1909px; " >
            <div class="banner__caption" style="background: radial-gradient(circle at left, rgba(0, 0, 0, 0.7), rgba(0, 0, 0, 0) 60%);">
              <div class="container__fluid" >
                <div class="banner__caption__content" >
                  <div class="headline__wrapper" >
                    <!-- <span class="headline line__one">Kenz</span> -->
                    <span class="headline line__two" >Get In Touch</span>
                  </div>
                </div>
              </div>
            </div>

            <picture class="web__bg">
              <source srcset="./media/images/get-in-touch.webp" type="image/jpg">
              <img src="./media/images/get-in-touch.webp" alt="kid running towards windmill through green paddy field" width="2000" height="1520" class="cover--img center web__bg--img">
            </picture>
          </div>
        </div>
        <span
          class="swiper-notification"
          aria-live="assertive"
          aria-atomic="true"></span>
      </div>
    </div>
  </section>
  <!--intro-->
  <section style="padding-top: 25px;" id="scroll-in"></section>
  <?php include_once('./includes/sinup.php'); ?>
  <?php include_once('./includes/footer.php'); ?>