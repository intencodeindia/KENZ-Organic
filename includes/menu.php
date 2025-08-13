<!--Header // Update 22 Feb-->
<style>
  /* Popup Styles */
  .popup {
    display: none;
    position: fixed;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    width: 40%;
    background: #FFFFFF;
    padding: 15px;
    box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.2);
    border-radius: 8px;
    z-index: 1000;
  }

  .popup-overlay {
    display: none;
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: rgba(0, 0, 0, 0.5);
    z-index: 999;
  }


  .popup-close {
    cursor: pointer;
    font-size: 40px;
    color: #48b291;
    border: none;
    background: none;
  }



  @media (max-width: 768px) {

    /* For tablets and smaller screens */
    .popup {
      width: 90%;
      max-width: 500px;
    }
  }

  @media (max-width: 480px) {

    /* For mobile screens */
    .popup {
      width: 95%;
      max-width: 400px;
      padding: 15px;
      overflow-y: auto;
    }

    .popup-header {
      font-size: 16px;
    }

    .popup-content {
      font-size: 14px;
    }
  }
</style>
<header class="site__header sticky ">
  <div>
    <a
      href="./"
      class="sgi__logo aos-init aos-animate"
      data-aos="fade-down"
      data-aos-delay="100">
      <img src="media/images/Asset 6@4x.png" height="50" />
    </a>

    <a class="nav__burger" href="#" aria-label="Menu">
      <span></span>
      <span></span>
      <span></span>
    </a>
    <nav
      class="aos-init aos-animate"
      data-aos="fade-down"
      data-aos-delay="150">
      <!--Nav-->
      <ul class="primary__nav">
        <li class="nav__item has--primarysub__menu">
          <a href="#" class="nav__item__main" style="font-size: 14px;">Products</a>

          <div class="sub__menu">
            <div class="sub__menu__overflow--wrapper">
              <div class="sub__menu__container d__flex">
                <div class="sub__menu__wrapper d__grid">
                  <ul class="sub__menu__nav d__grid">
                    <li>
                      <a href="polytunnel.php" class="subnav__item__main">
                        Polytunnel
                      </a>
                    </li>
                    <li>
                      <a href="nethouse-shadehouse.php" class="subnav__item__main">
                        Nethouse / Shadehouse
                      </a>
                    </li>
                    <li>
                      <a href="naturally-ventilated-polyhouse.php" class="subnav__item__main">
                        Naturally Ventilated Polyhouse
                      </a>
                    </li>
                    <li>
                      <a href="fan-pad-controlled-environment-polyhouse.php" class="subnav__item__main">
                        Fan & Pad Polyhouse
                      </a>
                    </li>
                    <!-- <li>
                        <a href="verticle-nft-hydroponics.php" class="subnav__item__main">
                          Vertical Hydroponic NFT
                        </a>
                      </li> -->
                    <li>
                      <a href="flat-nft-hydroponics.php" class="subnav__item__main">
                        Flat Hydroponic NFT
                      </a>
                    </li>
                    <li>
                      <a href="soil-less-growbags.php" class="subnav__item__main">
                        Soil-less Growbags
                      </a>
                    </li>
                    <li>
                      <a href="grow-buckets-dutch-buckets.php" class="subnav__item__main">
                        Dutch Buckets
                      </a>
                    </li>
                    <li>
                      <a href="saffran-farming.php" class="subnav__item__main">
                        Saffran Farming
                      </a>
                    </li>
                  </ul>
                </div>

                <aside class="d__flex">
                  <!--download factsheet-->
                  <a class="download__factsheet d__grid pos--relative">
                    <img
                      src="./media/images/DALL·E 2024-11-08 08.55.20 - A detailed agricultural scene featuring a variety of modern farming techniques_ a large polytunnel filled with crops, a soil-less growing setup, a fan.webp"
                      alt="download factsheet"
                      class="cover--img center"
                      width="1100"
                      height="500"
                      loading="lazy" />
                  </a>
                  <!--close submenu-->
                  <a
                    href="#"
                    class="close__subnav"
                    aria-label="Close sub menu navigation">
                    <svg
                      width="26"
                      height="26"
                      fill="none"
                      xmlns="http://www.w3.org/2000/svg"
                      viewBox="0 0 26 26">
                      <path
                        d="m1 1 12 12m12 12L13 13m0 0L25 1 1 25"
                        stroke="#48B291"
                        stroke-width="2"></path>
                    </svg>
                  </a>
                </aside>
              </div>
            </div>
          </div>
        </li>
        <li class="nav__item has--primarysub__menu">
          <a href="#" class="nav__item__main" style="font-size: 14px;">Services</a>

          <div class="sub__menu">
            <div class="sub__menu__overflow--wrapper">
              <div class="sub__menu__container d__flex">
                <div class="sub__menu__wrapper d__grid">
                  <ul class="sub__menu__nav d__grid">
                    <li>
                      <a href="rural-farmer.php" class="subnav__item__main">
                        Rural Farming Tech
                      </a>
                    </li>
                    <li>
                      <a href="urban-farmer.php" class="subnav__item__main">
                        Urban Farming Tech
                      </a>
                    </li>
                    <li>
                      <a href="crop-research.php" class="subnav__item__main">
                        Crop Research Lab
                      </a>
                    </li>
                    <li>
                      <a href="mega-farming.php" class="subnav__item__main">
                        Mega Farming Projects
                      </a>
                    </li>
                    <li>
                      <a href="agro-csr-plan.php" class="subnav__item__main">
                        Agro-CSR Planning
                      </a>
                    </li>
                    <!-- <li>
                        <a href="kenz-for-building-community.php" class="subnav__item__main">
                          Kenz Community
                        </a>
                      </li> -->
                    <!-- <li>
                        <a href="grant-subsidies.php" class="subnav__item__main">
                          Grants & Subsidies
                        </a>
                      </li> -->
                  </ul>
                </div>

                <aside class="d__flex">
                  <!--download factsheet-->
                  <a class="download__factsheet d__grid pos--relative">
                    <img
                      src="./media/images/services.webp"
                      alt="download factsheet"
                      class="cover--img center"
                      width="1100"
                      height="500"
                      loading="lazy" />
                  </a>
                  <!--close submenu-->
                  <a
                    href="#"
                    class="close__subnav"
                    aria-label="Close sub menu navigation">
                    <svg
                      width="26"
                      height="26"
                      fill="none"
                      xmlns="http://www.w3.org/2000/svg"
                      viewBox="0 0 26 26">
                      <path
                        d="m1 1 12 12m12 12L13 13m0 0L25 1 1 25"
                        stroke="#48B291"
                        stroke-width="2"></path>
                    </svg>
                  </a>
                </aside>
              </div>
            </div>
          </div>
        </li>
        <li class="nav__item has--primarysub__menu">
          <a href="#" class="nav__item__main" style="font-size: 14px;">Tower garden</a>

          <div class="sub__menu">
            <div class="sub__menu__overflow--wrapper">
              <div class="sub__menu__container d__flex">
                <div class="sub__menu__wrapper d__grid">
                  <!--submenu content-->
                  <!--submenu list-->
                  <ul class="sub__menu__nav d__grid">
                    <li>
                      <a href="tower-garden.php" class="subnav__item__main">Residential Towers</a>
                    </li>
                  </ul>
                </div>

                <aside class="d__flex">
                  <!--download factsheet-->
                  <a class="download__factsheet d__grid pos--relative">
                    <img
                      src="./media/images/tower_ _ Vertical Hydroponics.jpeg"
                      alt="download factsheet"
                      class="cover--img center"
                      width="1100"
                      height="500"
                      loading="lazy" />
                  </a>
                  <!--close submenu-->
                  <a
                    href="#"
                    class="close__subnav"
                    aria-label="Close sub menu navigation">
                    <svg
                      width="26"
                      height="26"
                      fill="none"
                      xmlns="http://www.w3.org/2000/svg"
                      viewBox="0 0 26 26">
                      <path
                        d="m1 1 12 12m12 12L13 13m0 0L25 1 1 25"
                        stroke="#48B291"
                        stroke-width="2"></path>
                    </svg>
                  </a>
                </aside>
              </div>
            </div>
          </div>
        </li>
        <li class="nav__item has--primarysub__menu">
          <a href="#" class="nav__item__main" style="font-size: 14px;">livestock farming</a>

          <div class="sub__menu">
            <div class="sub__menu__overflow--wrapper">
              <div class="sub__menu__container d__flex">
                <div class="sub__menu__wrapper d__grid">
                  <!--submenu content-->
                  <!--submenu list-->
                  <ul class="sub__menu__nav d__grid">
                    <li>
                      <a href="sheep-farming.php" class="subnav__item__main">Sheep Farming</a>
                    </li>
                    <li>
                      <a href="camel-farming.php" class="subnav__item__main">Camel Farming</a>
                    </li>
                    <li>
                      <a href="cattles-farming.php" class="subnav__item__main">cattles Farming</a>
                    </li>
                    <li>
                      <a href="fish-farming.php" class="subnav__item__main">Fish Farming</a>
                    </li>
                    <li>
                      <a href="hen-farming.php" class="subnav__item__main">Hen Farming</a>
                    </li>
                    <li>
                      <a href="horses-farming.php" class="subnav__item__main">Horse Farming</a>
                    </li>

                  </ul>
                </div>

                <aside class="d__flex">
                  <!--download factsheet-->
                  <!-- <a class="download__factsheet d__grid pos--relative">
                      <img
                        src="./media/images/tower_ _ Vertical Hydroponics.jpeg"
                        alt="download factsheet"
                        class="cover--img center"
                        width="1100"
                        height="500"
                        loading="lazy" />
                    </a> -->
                  <!--close submenu-->
                  <a
                    href="#"
                    class="close__subnav"
                    aria-label="Close sub menu navigation">
                    <svg
                      width="26"
                      height="26"
                      fill="none"
                      xmlns="http://www.w3.org/2000/svg"
                      viewBox="0 0 26 26">
                      <path
                        d="m1 1 12 12m12 12L13 13m0 0L25 1 1 25"
                        stroke="#48B291"
                        stroke-width="2"></path>
                    </svg>
                  </a>
                </aside>
              </div>
            </div>
          </div>
        </li>
        <li class="nav__item has--primarysub__menu" style="justify-content: end; position: relative; left: 600px;">
          <a href="#"
            style="font-size:14px; padding:6px 12px; border:1px solid white; border-radius:6px; background-color:transparent; color:white; text-decoration:none; transition:background-color 0.3s, color 0.3s;"
            onmouseover="this.style.backgroundColor='green'; this.style.color='white';"
            onmouseout="this.style.backgroundColor='transparent'; this.style.color='black';">
            GET IN TOUCH
          </a>


          <div class="sub__menu">
            <div class="sub__menu__overflow--wrapper">
              <div class="sub__menu__container d__flex">
                <div class="sub__menu__wrapper d__grid">
                  <!--submenu content-->

                  <!--submenu list-->
                  <ul class="sub__menu__nav d__grid">
                    <li>
                      <a href="about-us.php" class="subnav__item__main">
                        About KENZ ORGANIC
                      </a>
                    </li>
                    <li>
                      <a href="#" class="subnav__item__main" onclick="openPopup()">Company Profile</a>
                    </li>

                  </ul>
                </div>

                <aside class="d__flex">
                  <!--download factsheet-->
                  <a class="download__factsheet d__grid pos--relative">
                    <img
                      src="./media/images/about-us-page67.jpeg"
                      alt="download factsheet"
                      class="cover--img center"
                      width="1100"
                      height="500"
                      loading="lazy" />
                  </a>
                  <!--close submenu-->
                  <a
                    href="#"
                    class="close__subnav"
                    aria-label="Close sub menu navigation">
                    <svg
                      width="26"
                      height="26"
                      fill="none"
                      xmlns="http://www.w3.org/2000/svg"
                      viewBox="0 0 26 26">
                      <path
                        d="m1 1 12 12m12 12L13 13m0 0L25 1 1 25"
                        stroke="#48B291"
                        stroke-width="2"></path>
                    </svg>
                  </a>
                </aside>
              </div>
            </div>
          </div>
        </li>

      </ul>

      <!--Language Selector-->


      <!--social links-->
      <div class="nav__footer">
        <ul class="sgi__social d__grid">
          <li>
            <a href="#">
              <img src="./media/images/Twitter.svg" alt="Twitter" loading="lazy" width="26" height="22" />
            </a>
          </li>
          <li>
            <a href="#">
              <img src="./media/images/LinkedIn.svg" alt="LinkedIn" loading="lazy" width="26" height="22" />
            </a>
          </li>
          <li>
            <a href="#">
              <img src="./media/images/Facebook.svg" alt="Facebook" loading="lazy" width="26" height="22" />
            </a>
          </li>
          <li>
            <a href="#">
              <img src="./media/images/Instagram.svg" alt="Instagram" loading="lazy" width="26" height="22" />
            </a>
          </li>
          <li>
            <a href="#">
              <img src="./media/images/Youtube.svg" alt="Youtube" loading="lazy" width="26" height="22" />
            </a>
          </li>
        </ul>

        <p>
          <span class="copyright">KENZ ORGANIC</span>
        </p>
      </div>
    </nav>


  </div>
</header>
<!-- Popup Overlay -->
<div class="popup-overlay" id="popupOverlay" onclick="closePopup()"></div>

<!-- Popup Box -->
<div class="popup" id="popupBox">
  <div class="popup-header">
    <!-- <span>Company Profile</span> -->
    <button class="popup-close" onclick="closePopup()">×</button>
  </div>
  <div class="popup-content">
    <?php include_once('./includes/download_profile.php'); ?>
  </div>
</div>
<script>
  function openPopup() {
    document.getElementById('popupBox').style.display = 'block';
    document.getElementById('popupOverlay').style.display = 'block';
  }

  function closePopup() {
    document.getElementById('popupBox').style.display = 'none';
    document.getElementById('popupOverlay').style.display = 'none';
  }
</script>
<script>
  window.addEventListener("scroll", function() {
    const header = document.querySelector("header.sticky");

    if (window.scrollY > 10) {
      header.classList.add("scrolled");
    } else {
      header.classList.remove("scrolled");
    }
  });
</script>