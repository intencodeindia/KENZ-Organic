<?php
include_once('./includes/header.php');
?>

<body
  class=""
  data-aos-easing="ease"
  data-aos-duration="600"
  data-aos-delay="0"
  cz-shortcut-listen="true">

  <title>KENZ ORGANIC</title>

  <link rel="stylesheet" href="./css/swiper-bundle.min.css" />
  <link rel="stylesheet" href="./css/sgiv2-main.min.css" />
  <link rel="stylesheet" href="./css/sgiv2-sgi-mgi.min.css" />
  <link rel="stylesheet" href="./css/products.css" />
  <style>
    body {
      background-color: #f8f9fa;
      font-family: 'Segoe UI', sans-serif;
    }

    .product-card {
      border: none;
      border-radius: 15px;
      transition: transform 0.3s ease;
      padding: 10px;
    }

    .product-card:hover {
      transform: translateY(-10px);
      box-shadow: 0 8px 16px rgba(0, 0, 0, 0.1);
    }

    .product-card img {
      border-top-left-radius: 15px;
      border-top-right-radius: 15px;

      width: 100%;
      height: 220px;
      /* Set your desired fixed height */
      overflow: hidden;
      display: flex;
      align-items: center;
      justify-content: center;
      object-fit: contain;
      background-color: #e9ecef;

    }

    .card-body {
      padding: 1rem;
    }

    .card-title {
      font-weight: 600;
    }

    .sidebar h5,
    .sidebar h6 {
      font-weight: 600;
    }

    .rating-badge {
      position: absolute;
      top: 10px;
      right: 10px;
      background: #fff;
      /* color: #000; */
      font-size: 15px;
      /* font-weight: 500; */
      padding: 4px 8px;
      border-radius: 0px 0px 0px 10px;
      box-shadow: 0 0 5px rgba(0, 0, 0, 0.2);
    }

    .product-card .discount {
      font-size: 0.85rem;
      /* color: #e9ecef; */
      font-weight: 500;
      margin-left: 0.5rem;
    }

    .product-des {
      display: -webkit-box;
      -webkit-line-clamp: 2;
      -webkit-box-orient: vertical;
      overflow: hidden;
      text-overflow: ellipsis;
      font-weight: 500;
    }

    /* Overall Sidebar Card Styling */
    .sidebar {
      /* background-color: #f8fff4; */
      /* Light greenish background */
      /* color: #2d3e2d; */
      /* Dark green text */
      border-radius: 18px;
      border: 2px solid #d5ecd3;

    }

    /* Headings inside filter */
    .sidebar h5,
    .sidebar h6 {
      color: #165d3f;
      /* Strong dark green */
      font-weight: 600;
    }

    /* Accordion Button Styling */
    .accordion-button {
      background-color: #e9f5ea;
      height: 25px;
      /* Light green background */
      /* color: black; */
      font-weight: 500;
    }

    .accordion-button:not(.collapsed) {
      color: #155c3b;
      font-weight: 700;
      background-color: #e9ecef;
    }

    .accordion-button:focus {
      box-shadow: none;
      border-color: #b2dab4;
    }

    /* Accordion Border & Background */
    .accordion-item {
      background-color: transparent;
      border: none;

    }

    /* Form Elements */
    .form-check-label {
      color: #2a4a2a;
      font-weight: 500;
      padding: 2px;
    }


    .form-check-input:checked {
      background-color: #1a754f;
      border-color: #1a754f;

    }

    .form-check-input:focus {
      box-shadow: 0 0 0 0.2rem rgba(26, 117, 79, 0.25);
    }

    /* Form Select Dropdown */
    .form-select {
      background-color: #fff;
      border-color: #bcd9be;
      color: #1f3e2e;
      font-weight: 500;
    }

    .form-select:focus {
      border-color: #e9ecef;
      box-shadow: 0 0 0 0.2rem rgba(26, 117, 79, 0.25);
    }

    /* Price Range Inputs */
    input[type="number"] {
      border-color: #c7e5cc;
      color: #2a4a2a;
    }

    input[type="number"]::placeholder {
      /* color: #a1c4a5; */
      font-weight: 500;
    }


    .form-check:hover label {
      color: #0f583b;
      cursor: pointer;
    }

    /* Container styling search */
    .input-group-sm {
      border-radius: 8px;
      overflow: hidden;
      box-shadow: 0 2px 5px rgba(0, 0, 0, 0.08);
      border: 2px solid #d5ecd3;
    }

    /* Icon styling */
    .input-group-text {
      background-color: #f8f9fa;
      /* Light gray background */
      border: none;
      color: green;
      /* Bootstrap primary */
      font-size: 1rem;
    }

    /* Input field */
    #searchInput.form-control {
      border: none;
      outline: none;
      box-shadow: none;
    }

    /* On focus */
    #searchInput:focus {
      box-shadow: none;
      border-color: transparent;
    }

    /* Optional hover effect */
    .input-group:hover {
      box-shadow: 0 2px 8px rgba(0, 0, 0, 0.12);
    }
  </style>
  <?php include 'includes/menu.php'; ?>
  <!-- Main Content -->
  <section class="latest__news bg-color">
    <div class="container__fluid">
      <div style="margin-top: 15px; text-align:center;"> </div>
      <div class="main-container">
        <!-- Left Sidebar - Categories -->
        <!-- Filters Sidebar -->
        <aside class="filters">
          <!-- Categories -->
          <div class="filter-section">
            <div class="filter-header" onclick="toggleFilter('category-options', 'category-icon')">
              <h4>Categories</h4>
              <button class="dropdown-btn">
                <span id="category-icon">▼</span>
              </button>
            </div>
            <hr class="filter-line">
            <div id="category-options" class="filter-options">
              <div class="checkbox-container">
                <label><input type="checkbox"> Polytunnel</label>
                <label><input type="checkbox"> Dutch Bucket</label>
              </div>
              <div class="checkbox-container">
                <label><input type="checkbox"> Saffran Farming</label>
                <label><input type="checkbox"> Net House</label>
              </div>
            </div>
          </div>
          <div class="filter-section">
            <div class="filter-header">
              <h4>Price Range</h4>
            </div>
            <hr class="filter-line">

            <div class="price-filter">
              <input type="number" id="minPrice" placeholder="Min" min="0" oninput="filterByPrice()">
              <input type="number" id="maxPrice" placeholder="Max" min="0" oninput="filterByPrice()">
            </div>

            <input type="range" id="priceRange" min="0" max="2000" step="10" value="1000" oninput="updatePriceRange(this.value)">
          </div>

          <div class="filter-section">
            <div class="filter-header" onclick="toggleFilter('category-options', 'category-icon')">
              <h4>Brands</h4>
              <button class="dropdown-btn">
                <span id="category-icon">▼</span>
              </button>
            </div>
            <hr class="filter-line">
            <div id="category-options" class="filter-options">
              <div class="checkbox-container">
                <label><input type="checkbox"> Skincare</label>
                <label><input type="checkbox"> Body Lotions</label>
              </div>
              <div class="checkbox-container">
                <label><input type="checkbox"> Makeup</label>
                <label><input type="checkbox"> Spa</label>
              </div>
            </div>
          </div>
          <div class="filter-section">
            <div class="filter-header" onclick="toggleFilter('category-options', 'category-icon')">
              <h4>Ratings & Reviews </h4> 
              <button class="dropdown-btn">
                <span id="category-icon">▼</span>
              </button>
            </div>
            <hr class="filter-line">
            <div id="category-options" class="filter-options-rt">
              <label><input type="checkbox"> 4.5 & Above</label>
              <label><input type="checkbox"> 3.5 & Above</label>
              <label><input type="checkbox"> 2.5 & Above</label>
            </div>
          </div>
          <div class="filter-section">
            <div class="filter-header" onclick="toggleFilter('category-options', 'category-icon')">
              <h4>Availability & Delivery </h4>
              <button class="dropdown-btn">
                <span id="category-icon">▼</span>
              </button>
            </div>
            <hr class="filter-line">
            <div id="category-options" class="filter-options-rt">
              <label><input type="checkbox">Same Day Delivery</label>
              <label><input type="checkbox">1-2 Day delivery</label>
              <!-- <label><input type="checkbox"> 2.5 & Above</label> -->
            </div>
          </div>
        </aside>

        <!-- Right - Product Grid -->
        <div class="product-grid">
          <div class="product-item">
            <div class="image-container">
              <img src="./media/images/suport-gaze.jpeg" alt="Green Bronx Machine Bundle Green Bronx Machine Bundle">
              <div class="rating">4.5 ⭐</div>
            </div>
            <p class="product-name">Green Bronx Machine Bundle Green Bronx Machine Bundle</p>
            <div class="price-cart">
              <p class="price">$1,385.00</p>
              <button class="cart-btn">Add to Cart</button>
            </div>
          </div>


          <div class="product-item">
            <div class="image-container">
              <img src="./media/images/suport-gaze.jpeg" alt="Green Bronx Machine Bundle Green Bronx Machine Bundle">
              <div class="rating">4.5 ⭐</div>
            </div>
            <p class="product-name">Green Bronx Machine Bundle Green Bronx Machine Bundle</p>
            <div class="price-cart">
              <p class="price">$1,385.00</p>
              <button class="cart-btn">Add to Cart</button>
            </div>
          </div>

          <div class="product-item">
            <div class="image-container">
              <img src="./media/images/suport-gaze.jpeg" alt="Green Bronx Machine Bundle Green Bronx Machine Bundle">
              <div class="rating">4.5 ⭐</div>
            </div>
            <p class="product-name">Green Bronx Machine Bundle Green Bronx Machine Bundle</p>
            <div class="price-cart">
              <p class="price">$1,385.00</p>
              <button class="cart-btn">Add to Cart</button>
            </div>
          </div>
          <div class="product-item">
            <div class="image-container">
              <img src="./media/images/suport-gaze.jpeg" alt="Green Bronx Machine Bundle Green Bronx Machine Bundle">
              <div class="rating">4.5 ⭐</div>
            </div>
            <p class="product-name">Green Bronx Machine Bundle Green Bronx Machine Bundle</p>
            <div class="price-cart">
              <p class="price">$1,385.00</p>
              <button class="cart-btn">Add to Cart</button>
            </div>
          </div>
          <div class="product-item">
            <div class="image-container">
              <img src="./media/images/suport-gaze.jpeg" alt="Green Bronx Machine Bundle Green Bronx Machine Bundle">
              <div class="rating">4.5 ⭐</div>
            </div>
            <p class="product-name">Green Bronx Machine Bundle Green Bronx Machine Bundle</p>
            <div class="price-cart">
              <p class="price">$1,385.00</p>
              <button class="cart-btn">Add to Cart</button>
            </div>
          </div>
          <div class="product-item">
            <div class="image-container">
              <img src="./media/images/suport-gaze.jpeg" alt="Green Bronx Machine Bundle Green Bronx Machine Bundle">
              <div class="rating">4.5 ⭐</div>
            </div>
            <p class="product-name">Green Bronx Machine Bundle Green Bronx Machine Bundle</p>
            <div class="price-cart">
              <p class="price">$1,385.00</p>
              <button class="cart-btn">Add to Cart</button>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <?php include_once('./includes/footer.php'); ?>
  <script>
    function toggleFilter(filterId, iconId) {
      let filter = document.getElementById(filterId);
      let icon = document.getElementById(iconId);

      if (filter.classList.contains("hidden")) {
        filter.classList.remove("hidden");
        icon.textContent = "▲"; // Change icon to indicate open state
      } else {
        filter.classList.add("hidden");
        icon.textContent = "▼"; // Change icon to indicate closed state
      }
    }


    function updatePriceRange(value) {
      document.getElementById('maxPrice').value = value;
      filterByPrice(); // Call function instantly when slider is changed
    }

    function filterByPrice() {
      let minPrice = parseFloat(document.getElementById('minPrice').value) || 0;
      let maxPrice = parseFloat(document.getElementById('maxPrice').value) || Infinity;

      document.querySelectorAll('.product-item').forEach(item => {
        let priceText = item.querySelector('.price').textContent.replace('$', '').replace(',', '');
        let price = parseFloat(priceText);

        if (price >= minPrice && price <= maxPrice) {
          item.style.display = 'block';
        } else {
          item.style.display = 'none';
        }
      });
    }

    // Attach event listener to range input
    document.getElementById('priceRange').addEventListener('input', () => {
      document.getElementById('maxPrice').value = document.getElementById('priceRange').value;
      filterByPrice();
    });
  </script>