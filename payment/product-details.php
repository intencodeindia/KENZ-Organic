<?php
include_once('../includes/header.php');
include_once('../function/db.php');
require_once '../erp_api.php';

$productId = $_GET['id'] ?? '';
if (!$productId) {
    die('Product ID not provided.');
}

$fields = ['name', 'item_name', 'description', 'standard_rate as price', 'item_group as category', 'brand', 'image'];
$filters = [['name', '=', $productId]];
$response = fetchFromERPNext('Item', $filters, $fields);
$product = $response['data'][0] ?? null;

if (!$product) {
    die('Product not found.');
}

$productName = htmlspecialchars($product['item_name']);
$productDesc = nl2br(htmlspecialchars(strip_tags($product['description'])));
$productPrice = number_format($product['price'], 2);
$productImage = !empty($product['image']) ? rtrim($erp_credentials['base_url'], '/') . $product['image'] : '/files/no-image.png';
$productBrand = htmlspecialchars($product['brand'] ?? 'Unknown');
$productCategory = htmlspecialchars($product['category'] ?? 'Uncategorized');
$productRating = rand(3, 5); // Simulated rating
$productStock = 'In Stock'; // Simulated
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <title><?php echo $productName; ?> - Product Details</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">

    <link rel="stylesheet" href="../css/swiper-bundle.min.css" />
    <link rel="stylesheet" href="../css/sgiv2-main.min.css" />
    <!-- <link rel="stylesheet" href="../css/footer.css"> -->
    <link rel="stylesheet" href="../css/style.css">
    <style>
        .product-detail-img-wrapper {
            border: 2px solid #fff;
            border-radius: 8px;
            padding: 0;
            box-shadow: 0 2px 12px rgba(0, 0, 0, 0.05);
            transition: transform 0.3s ease;
            width: 100%;
            height: 420px;
            overflow: hidden;
            background: #fff;
            /* Removed flex centering */
        }

        .product-detail-img-wrapper img {
            width: 100%;
            height: 100%;
            /* object-fit: cover; */
            /* Use 'contain' if you want full image with possible white space */
            border-radius: 8px;
        }

        .product-card {
            border: none;
            border-radius: 15px;
            transition: transform 0.3s ease;
            padding: 10px;
        }

        .product-detail-img-wrapper:hover {
            transform: scale(1.02);
        }

        .related-products img {
            height: 180px;
            object-fit: contain;
            background-color: #f1f1f1;
        }

        .body-padding-top {
            padding-top: 100px;
        }

        header.sticky.scrolled {
            background-color: #003a48;
            /* Dark translucent background */
            /* Optional: subtle shadow */
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.6);
        }

        header {
            --sgi-logo-size-width: 103px;
            --sgi-logo-size-height: 50px;
            --header-height: 90px;
            --sgi-logo-top-offset: 20px;
            --header-nav-block-space: 25px;
            --header-nav-font-size: 10px;
            --menu-bg: #fafafa;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: var(--header-height);
            z-index: 55;
            transition: var(--transition-03s);
            background-color: #003a48;
        }

        .product-hover:hover {
            transform: translateY(-5px);
            transition: 0.3s ease;
            box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.1);
        }

        .addtocrt-button {
            border: 2px solid green;
            border-radius: 10px;
            font-size: 16px;
        }

        .crt-button-gap {
            gap: 1px;
        }
    </style>
</head>

<body class="body-padding-top">
    <?php include '../includes/menu.php'; ?>
    <div class="container my-5">
        <!-- Product Details -->
        <div class="row">
            <!-- Left: Image -->
            <div class="col-lg-1 col-md-1">
                <div>
                    <img src="<?php echo $productImage; ?>" class="img-thumbnail" style="width: 100px;" />
                    <img src="<?php echo $productImage; ?>" class="img-thumbnail" style="width: 100px;" />
                    <img src="<?php echo $productImage; ?>" class="img-thumbnail" style="width: 100px;" />
                    <img src="<?php echo $productImage; ?>" class="img-thumbnail" style="width: 100px;" />
                    <img src="<?php echo $productImage; ?>" class="img-thumbnail" style="width: 100px;" />
                    <!-- Add more images here -->
                </div>
            </div>
            <div class="col-lg-4 col-md-4">
                <div class="product-detail-img-wrapper text-center">
                    <img src="<?php echo $productImage; ?>" class="img-fluid rounded" alt="Product Image">
                </div>
            </div>

            <!-- <div class="col-md-1"></div> -->
            <div class="col-lg-6 col-md-6 ms-5">
                <h4><?php echo $productDesc; ?></h4>
                <p class="text-muted"><?php echo $productCategory; ?> | Brand: <?php echo $productBrand; ?></p>
                <div class="mb-2">
                    <div class="text-warning fs-6 font-weight-bold">
                        <?php
                        $fullStars = floor($productRating); // Number of full stars
                        $halfStar = ($productRating - $fullStars) >= 0.5 ? 1 : 0; // If we need half star
                        $emptyStars = 5 - $fullStars - $halfStar;

                        // Full stars
                        for ($i = 0; $i < $fullStars; $i++) {
                            echo '<i class="bi bi-star-fill"></i> ';
                        }

                        // Half star
                        if ($halfStar) {
                            echo '<i class="bi bi-star-half"></i> ';
                        }

                        // Empty stars
                        for ($i = 0; $i < $emptyStars; $i++) {
                            echo '<i class="bi bi-star"></i> ';
                        }
                        ?>
                        <span class="text-muted ms-2 font-bold">(<?php echo $productRating; ?> / 5)</span>
                    </div>
                </div>

                <div class="badge bg-danger mb-2">Limited time deal</div>
                <h4 class="text-danger">-43% ₹<?php echo $productPrice; ?>
                    <small class="text-decoration-line-through text-muted fs-6">₹399.00</small>
                </h4>
                <!-- Stock -->
                <h6 class="text-danger fw-bold">Only 1 left in stock.</h6>
                <h5 class="text-success">✅ Fulfilled | Secure Transaction</h5>

                <!-- Buttons -->
                <div class="d-flex gap-2 mt-3">
                    <!-- Add to Cart -->
                    <div class="cart-controls" id="cart-control-<?php echo $productId; ?>"
                        data-id="<?php echo $productId; ?>"
                        data-name="<?php echo $productName; ?>"
                        data-price="<?php echo $product['price']; ?>"
                        data-image="<?php echo $productImage; ?>"
                        data-description="<?php echo $productDesc; ?>"
                        data-brand="<?php echo $productBrand; ?>">

                        <!-- Shown if added to cart -->
                        <button class="btn btn-sm cart-menu-btn fw-bold">
                            <span class="qty-btn">−</span>
                            <span class="qty-value">1</span>
                            <span class="qty-btn">+</span>
                            <span class="qty-remove">🗑️</span>
                        </button>


                        <!-- Uncomment this for when product is not in cart -->
                        <!-- <button class="btn btn-sm btn-success fw-bold">Add to Cart</button> -->

                    </div>


                </div>


                <!-- Material Color Variants -->
            </div>
        </div>
    </div>

    <div class="container my-5">
        <h5 class="mb-4 fw-bold">✨ You may also like</h5>
        <div class="row related-products g-4">
            <?php
            $filtersRelated = [
                ['name', '!=', $productId],
                ['item_group', '=', $productCategory],
                ['disabled', '=', 0]
            ];
            $related = fetchFromERPNext('Item', $filtersRelated, $fields);
            $relatedItems = $related['data'] ?? [];

            foreach (array_slice($relatedItems, 0, 4) as $r) {
                $rid = $r['name'];
                $name = htmlspecialchars($r['item_name']);
                $desc = htmlspecialchars($r['description'] ?? '');
                $price = number_format($r['price'], 2);
                $rating = $r['rating'] ?? 4.0;
                $img = !empty($r['image']) ? rtrim($erp_credentials['base_url'], '/') . $r['image'] : '/files/no-image.png';
            ?>
                <div class="col-sm-6 col-lg-3">
                    <div class="card product-card h-100 border-0 shadow-sm rounded-4 overflow-hidden product-hover">
                        <a href="product-detail.php?id=<?php echo $rid; ?>"><img src="<?php echo $img; ?>" class="card-img-top img-fluid" alt="Product"></a>
                        <div class="card-body p-3">
                            <!-- Rating Stars -->
                            <div class="text-warning mb-1 small">
                                <?php
                                $fullStars = floor($rating);
                                $halfStar = ($rating - $fullStars) >= 0.5 ? 1 : 0;
                                $emptyStars = 5 - $fullStars - $halfStar;

                                for ($i = 0; $i < $fullStars; $i++) echo '<i class="bi bi-star-fill"></i>';
                                if ($halfStar) echo '<i class="bi bi-star-half"></i>';
                                for ($i = 0; $i < $emptyStars; $i++) echo '<i class="bi bi-star"></i>';
                                ?>
                                <span class="text-muted">(<?php echo $rating; ?>/5)</span>
                            </div>

                            <h6 class="card-title fw-semibold text-dark"><?php echo $name; ?></h6>

                            <div class="mb-2">
                                <h6><strong class="text-success">₹<?php echo $price; ?></strong><span class="text-secondary small">(12% OFF)</span></h6>

                            </div>

                            <div class="d-flex gap-2 mt-3">
                                <button class="btn btn-sm btn-success w-100">Add to Cart</button>
                            </div>
                        </div>
                    </div>
                </div>
            <?php } ?>
        </div>
    </div>

    <?php include_once('../includes/footer.php'); ?>
    <script>
        document.addEventListener("DOMContentLoaded", () => {
            document.querySelectorAll(".cart-controls").forEach(container => {
                const id = container.dataset.id;
                const cart = JSON.parse(localStorage.getItem("cart")) || {};
                const item = cart[id];

                if (item && item.qty > 0) {
                    container.innerHTML = `
        <div class="d-flex gap-2 align-items-center">
          <button class="btn btn-sm btn-outline-secondary minus" data-id="${id}">➖</button>
          <span class="px-2">${item.qty}</span>
          <button class="btn btn-sm btn-outline-secondary plus" data-id="${id}">➕</button>
          <button class="btn btn-sm btn-outline-danger delete" data-id="${id}">🗑️</button>
        </div>`;
                } else {
                    container.innerHTML = `
        <button class="btn btn-success fw-bold flex-fill add-to-cart" data-id="${id}" style="font-size:14px;">Add to Cart</button>`;
                }
            });
        });


        function getCart() {
            return JSON.parse(localStorage.getItem("cart")) || {};
        }

        function saveCart(cart) {
            localStorage.setItem("cart", JSON.stringify(cart));
        }

        function renderCartUI(productId) {
            const cart = getCart();
            const container = document.getElementById("cart-control-" + productId);
            if (!container) return;

            const item = cart[productId];
            if (item && item.qty > 0) {
                container.innerHTML = `
        <div class="d-flex  addtocrt-button">
          <button class="btn btn-sm  minus crt-button-gap" data-id="${productId}">➖</button>
          <span class="mt-1 crt-button-gap">${item.qty}</span>
          <button class="btn btn-sm  plus crt-button-gap" data-id="${productId}">➕</button>
          <button class="btn btn-sm  delete crt-button-gap" data-id="${productId}">🗑️</button>
        </div>`;
            } else {
                container.innerHTML = `
        <button class="btn btn-success w-100 add-to-cart" data-id="${productId}">Add to Cart</button>`;
            }
        }

        document.addEventListener("DOMContentLoaded", () => {
            document.querySelectorAll(".cart-controls").forEach(container => {
                const id = container.dataset.id;
                renderCartUI(id);

                container.addEventListener("click", function(e) {
                    const target = e.target.closest("button");
                    if (!target) return;

                    const id = target.dataset.id;
                    const name = this.dataset.name;
                    const description = this.dataset.description;
                    const brand = this.dataset.brand;
                    const price = parseFloat(this.dataset.price);
                    const image = this.dataset.image;
                    let cart = getCart();

                    if (target.classList.contains("add-to-cart")) {
                        cart[id] = {
                            id,
                            name,
                            description,
                            brand,
                            price,
                            image,
                            qty: 1
                        };
                    } else if (target.classList.contains("plus")) {
                        if (cart[id]) cart[id].qty++;
                    } else if (target.classList.contains("minus")) {
                        if (cart[id]) {
                            cart[id].qty--;
                            if (cart[id].qty <= 0) delete cart[id];
                        }
                    } else if (target.classList.contains("delete")) {
                        delete cart[id];
                    }

                    saveCart(cart);
                    renderCartUI(id);
                });
            });
        });
    </script>

</body>

</html>