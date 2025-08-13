<!DOCTYPE html>
<html lang="en">
<?php
include_once('../includes/header.php');
include_once('../function/db.php');
?>

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Organic Product Grid</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" />
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
  <link rel="stylesheet" href="../css/swiper-bundle.min.css" />
  <!-- <link rel="stylesheet" href="../css/payment_style.css" /> -->
  <link rel="stylesheet" href="../css/sgiv2-main.min.css" />
  <link rel="stylesheet" href="../css/style.css">
</head>
<body>
  <?php include '../includes/menu.php'; ?>
  <div class="container-fluid mt-4">
    <div class="row">
      <!-- Sidebar Filters -->
      <div class="col-12 col-md-12 col-lg-3" mb-4 filters">
        <div class="card p-5 shadow-sm sidebar">
          <div class="d-flex justify-content-between align-items-center mb-2">
            <h5 class="mb-0">Filters</h5>
            <div class="input-group input-group-sm ms-2" style="max-width: 200px;">
              <span class="input-group-text bg-white border-end-0">
                <i class="bi bi-search"></i>
              </span>
              <input type="text" id="searchInput" class="form-control border-start-0" placeholder="Search products...">
            </div>

          </div>


          <div class="accordion mt-3" id="filterAccordion">

            <!-- Category -->
            <div class="accordion-item">
              <h2 class="accordion-header">
                <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseCategory">
                  Categories
                </button>
              </h2>
              <div id="collapseCategory" class="accordion-collapse collapse show" data-bs-parent="#filterAccordion">
                <div class="accordion-body" id="category-options">
                  <div class="form-check">
                    <input class="form-check-input" type="checkbox" id="cat1" value="Polytunnel">
                    <label class="form-check-label" for="cat1">Polytunnel</label>
                  </div>
                  <div class="form-check">
                    <input class="form-check-input" type="checkbox" id="cat2" value="Dutch Bucket">
                    <label class="form-check-label" for="cat2">Dutch Bucket</label>
                  </div>
                </div>
              </div>
            </div>

            <!-- Price -->
            <div class="accordion-item">
              <h2 class="accordion-header">
                <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapsePrice">
                  Price Range
                </button>
              </h2>
              <div id="collapsePrice" class="accordion-collapse collapse show" data-bs-parent="#filterAccordion">
                <div class="accordion-body">
                  <div class="d-flex gap-2">
                    <input type="number" id="minPrice" class="form-control" placeholder="Min ₹">
                    <input type="number" id="maxPrice" class="form-control" placeholder="Max ₹">
                  </div>
                </div>
              </div>
            </div>

            <!-- Brands -->
            <div class="accordion-item">
              <h2 class="accordion-header">
                <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseBrand">
                  Brands
                </button>
              </h2>
              <div id="collapseBrand" class="accordion-collapse collapse show" data-bs-parent="#filterAccordion">
                <div class="accordion-body">
                  <div class="form-check">
                    <input class="form-check-input" type="checkbox" id="brand1" value="KENZ Farms">
                    <label class="form-check-label" for="brand1">KENZ Farms</label>
                  </div>
                  <div class="form-check">
                    <input class="form-check-input" type="checkbox" id="brand2" value="Urban Agro">
                    <label class="form-check-label" for="brand2">Urban Agro</label>
                  </div>
                </div>
              </div>
            </div>

            <!-- Rating -->
            <div class="accordion-item">
              <h2 class="accordion-header">
                <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseRating">
                  Ratings
                </button>
              </h2>
              <div id="collapseRating" class="accordion-collapse collapse show" data-bs-parent="#filterAccordion">
                <div class="accordion-body">
                  <select class="form-select" id="ratingFilter">
                    <option value="0" selected>All Ratings</option>
                    <option value="4">4 ★ & above</option>
                    <option value="3">3 ★ & above</option>
                    <option value="2">2 ★ & above</option>
                  </select>
                </div>
              </div>
            </div>

            <!-- Availability -->
            <div class="accordion-item">
              <h2 class="accordion-header">
                <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseAvailability">
                  Availability
                </button>
              </h2>
              <div id="collapseAvailability" class="accordion-collapse collapse show" data-bs-parent="#filterAccordion">
                <div class="accordion-body">
                  <div class="form-check">
                    <input class="form-check-input" type="checkbox" id="avail1" value="In Stock">
                    <label class="form-check-label" for="avail1">In Stock</label>
                  </div>
                  <div class="form-check">
                    <input class="form-check-input" type="checkbox" id="avail2" value="Out of Stock">
                    <label class="form-check-label" for="avail2">Out of Stock</label>
                  </div>
                </div>
              </div>
            </div>

            <!-- Discount -->
            <div class="accordion-item">
              <h2 class="accordion-header" id="headingDiscount">
                <button class="accordion-button text-success" type="button" data-bs-toggle="collapse" data-bs-target="#collapseDiscount">
                  Discount
                </button>
              </h2>
              <div id="collapseDiscount" class="accordion-collapse collapse show" data-bs-parent="#filterAccordion">
                <div class="accordion-body">
                  <select class="form-select">
                    <option selected>All</option>
                    <option>10% or more</option>
                    <option>25% or more</option>
                    <option>50% or more</option>
                  </select>
                </div>
              </div>
            </div>

          </div>
        </div>
      </div>



      <!-- Product Grid -->
      <div class="col-12 col-md-12 col-lg-9">
        <div class="row g-4">
          <?php
          require_once '../erp_api.php';
          require_once '../credentials.php'; // For $erp_credentials

          $productsPerPage = 8;
          $page = isset($_GET['page']) ? max(1, intval($_GET['page'])) : 1;
          $offset = ($page - 1) * $productsPerPage;

          // Step 1: Fetch products from Item
          $fields = ['name', 'item_name', 'description', 'standard_rate as price', 'item_group as category', 'brand', 'image'];
          $filters = [['disabled', '=', 0]];
          $response = fetchFromERPNext('Item', $filters, $fields);
          $erpProducts = $response['data'] ?? [];

          // Step 2: Fetch Item Prices (no filter)
          $priceFields = ['item_code', 'price_list_rate', 'currency'];
          $priceResponse = fetchFromERPNext('Item%20Price', [], $priceFields);
          $itemPrices = $priceResponse['data'] ?? [];

          // Step 3: Map item prices by item_code
          $priceMap = [];
          foreach ($itemPrices as $price) {
            if (!empty($price['item_code']) && isset($price['price_list_rate'])) {
              $priceMap[$price['item_code']] = $price['price_list_rate'];
            }
          }

          // Step 4: Display product cards
          foreach ($erpProducts as $product) {
            $productName = htmlspecialchars($product['item_name']);
            $productDesc = htmlspecialchars(strip_tags($product['description']));

            // Use price from Item Price if available, else fallback to Item.standard_rate
            $itemCode = $product['name'];
            $finalPrice = $priceMap[$itemCode] ?? $product['price'];
            $productPrice = number_format($finalPrice, 2);

            $erpBaseUrl = rtrim($erp_credentials['base_url'], '/');
            $productImage = !empty($product['image']) ? $erpBaseUrl . $product['image'] : '/files/no-image.png';

            $productBrand = htmlspecialchars($product['brand'] ?? 'Unknown');
            $productCategory = htmlspecialchars($product['category'] ?? 'Uncategorized');
            $productRating = rand(3, 5); // Fake rating
            $productStock = 'In Stock';  // Fake stock
          ?>
            <div class="col-sm-6 col-lg-3 product-item"
              data-availability="<?php echo $productStock; ?>">
              <div class="card product-card h-100 shadow-sm"
                data-category="<?php echo $productCategory; ?>"
                data-brand="<?php echo $productBrand; ?>"
                data-rating="<?php echo $productRating; ?>"
                data-price="<?php echo $finalPrice; ?>">
                <a href="../payment/product-details.php?id=<?php echo $itemCode; ?>">
                  <img src="<?php echo $productImage; ?>" class="card-img-top" alt="Product">
                  <strong class="rating-badge text-success">⭐ <?php echo $productRating; ?></strong>
                  <div class="card-body">
                    <h6 class="card-title text-dark"><?php echo $productName; ?></h6>
                    <p class="text-muted product-des"><?php echo $productDesc; ?>...</p>

                    <!-- Display price -->
                    <strong class="text-success product-price">₹<?php echo $productPrice; ?></strong>
                    <span class="discount text-secondary">(12% OFF)</span>

                    <div class="d-flex justify-content-end gap-2 mt-2">
                      <button class="btn btn-success btn-sm w-100">View more</button>
                    </div>
                  </div>
                </a>
              </div>
            </div>
          <?php } ?>
        </div>
      </div>

    </div>
  </div>

  <script>
    document.addEventListener("DOMContentLoaded", function() {
      const checkboxes = document.querySelectorAll(".form-check-input");
      const minPriceInput = document.getElementById("minPrice");
      const maxPriceInput = document.getElementById("maxPrice");
      const ratingSelect = document.getElementById("ratingFilter");
      const searchInput = document.getElementById("searchInput");
      const products = document.querySelectorAll(".product-item");

      const applyFilters = () => {
        const selectedCategories = Array.from(document.querySelectorAll("#category-options .form-check-input:checked")).map(cb => cb.value);
        const selectedBrands = Array.from(document.querySelectorAll("#collapseBrand .form-check-input:checked")).map(cb => cb.value);
        const selectedAvailability = Array.from(document.querySelectorAll("#collapseAvailability .form-check-input:checked")).map(cb => cb.value);
        const selectedRating = parseInt(ratingSelect.value);
        const minPrice = parseFloat(minPriceInput.value) || 0;
        const maxPrice = parseFloat(maxPriceInput.value) || Infinity;
        const searchText = searchInput.value.toLowerCase();

        products.forEach(product => {
          const card = product.querySelector(".product-card");
          const category = card.dataset.category;
          const brand = card.dataset.brand;
          const rating = parseFloat(card.dataset.rating);
          const price = parseFloat(card.dataset.price);
          const availability = product.dataset.availability;
          const name = product.querySelector('.card-title').textContent.toLowerCase();
          const desc = product.querySelector('.product-des').textContent.toLowerCase();

          let show = true;

          if (selectedCategories.length > 0 && !selectedCategories.includes(category)) show = false;
          if (selectedBrands.length > 0 && !selectedBrands.includes(brand)) show = false;
          if (selectedAvailability.length > 0 && !selectedAvailability.includes(availability)) show = false;
          if (selectedRating > 0 && rating < selectedRating) show = false;
          if (price < minPrice || price > maxPrice) show = false;
          if (searchText && !name.includes(searchText) && !desc.includes(searchText)) show = false;

          product.style.display = show ? "block" : "none";
        });
      };

      checkboxes.forEach(cb => cb.addEventListener("change", applyFilters));
      minPriceInput.addEventListener("input", applyFilters);
      maxPriceInput.addEventListener("input", applyFilters);
      ratingSelect.addEventListener("change", applyFilters);
      searchInput.addEventListener("input", applyFilters);

      document.getElementById("clearFilters").addEventListener("click", () => {
        checkboxes.forEach(cb => cb.checked = false);
        minPriceInput.value = "";
        maxPriceInput.value = "";
        ratingSelect.value = "0";
        searchInput.value = "";
        products.forEach(product => product.style.display = "block");
      });
    });
  </script>

  <?php include_once('../includes/footer.php'); ?>
</body>

</html>