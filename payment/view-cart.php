<!DOCTYPE html>
<html lang="en">
<?php
session_start();
include_once('../function/db.php');

$cartFromDb = [];
$isLoggedIn = false;

if (isset($_SESSION['user_id'])) {
    $userId = $_SESSION['user_id'];

    // Check if cart has items for this user
    $stmt = $conn->prepare("
        SELECT c.*, p.product_name, p.product_price, p.product_image 
        FROM cart c 
        JOIN products p ON c.product_id = p.product_id 
        WHERE c.user_id = ?
    ");
    $stmt->execute([$userId]);
    $cartFromDb = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // User is considered logged in only if cart table has this user
    if (!empty($cartFromDb)) {
        $isLoggedIn = true;
    } else {
        $isLoggedIn = false;
    }
}

?>

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>My Cart</title>

    <!-- Bootstrap & Custom CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <link rel="stylesheet" href="../css/swiper-bundle.min.css" />
    <link rel="stylesheet" href="../css/sgiv2-main.min.css" />
    <!-- <link rel="stylesheet" href="../css/footer.css"> -->
    <link rel="stylesheet" href="../css/style.css">

    <!-- Custom Style -->
    <style>
        .body-padding-top {
            padding-top: 100px;
        }

        .cart-item-card {
            border: 1px solid #e0e0e0;
            border-radius: 12px;
            padding: 20px;
            display: flex;
            align-items: center;
            gap: 20px;
            background-color: #fff;
            box-shadow: 0 2px 6px rgba(0, 0, 0, 0.05);
            transition: transform 0.2s ease;
        }

        .cart-item-card:hover {
            transform: scale(1.01);
        }

        .cart-item-card img {
            width: 90px;
            height: 90px;
            object-fit: cover;
            border-radius: 10px;
        }

        .qty-controls button {
            min-width: 32px;
            height: 32px;
            font-size: 16px;
            padding: 0;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            border-radius: 8px;
        }

        .qty-controls span {
            width: 30px;
            text-align: center;
            font-weight: bold;
        }

        #cart-summary {
            max-width: 100%;
            background-color: #fff;
            border: 1px solid #ddd;
            border-radius: 12px;
            padding: 20px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.05);
        }

        .btn-warning {
            font-weight: bold;
            border-radius: 10px;
        }

        header.sticky.scrolled {
            background-color: #003a48;
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

        @media (max-width: 768px) {
            #cart-summary {
                margin-top: 20px;
            }
        }

        .addtocrt-button {
            display: inline-flex;
            align-items: center;
            border: 2px solid green;
            border-radius: 12px;
            /* padding: 4px 10px; */
            background-color: #f9f9f9;
            width: 150px;
        }

        .btn-icon {
            background: none;
            border: none;
            /* color: #7a4de9; */
            /* You can change this color */
            font-size: 15px;
            /* padding: 2px 5px; */
            cursor: pointer;
        }

        .btn-icon:hover {
            color: #4a2fb5;
        }

        .qty-value {
            min-width: 20px;
            text-align: center;
            font-weight: 500;
            font-size: 16px;
        }

        .modal-content {
            background: #fff;
        }

        .modal-title {
            font-weight: 600;
            font-size: 1.25rem;
        }

        .form-control:focus {
            border-color: #0d6efd;
            box-shadow: 0 0 0 0.25rem rgba(13, 110, 253, 0.25);
        }
    </style>
</head>

<body class="body-padding-top">
    <?php include '../includes/menu.php'; ?>
    <div class="container mt-4">
        <div class="row">
            <!-- Left: Cart Items -->
            <div class="col-md-8" id="cart-container"></div>

            <!-- Right: Cart Summary -->
            <div class="col-md-4">
                <div id="cart-summary" class="p-3 bg-light border rounded sticky-top" style="top: 100px;"></div>
            </div>
        </div>
    </div>

    <!-- Registration Modal -->
    <div class="modal fade" id="registerModal" tabindex="-1" aria-labelledby="registerModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Register to Checkout</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <input id="regName" class="form-control mb-2" placeholder="Full Name">
                    <input id="regEmail" class="form-control mb-2" placeholder="Email">
                    <input id="regPhone" class="form-control mb-2" placeholder="Phone">
                    <input id="regPassword" type="password" class="form-control mb-2" placeholder="Password">
                </div>
                <div class="modal-footer">
                    <button class="btn btn-primary" onclick="submitRegistration()">Register & Checkout</button>
                </div>
            </div>
        </div>
    </div>

    <script>
        const isLoggedIn = <?= json_encode($isLoggedIn) ?>;
        const dbCart = <?= json_encode($cartFromDb) ?>;
        let cart = {};

        if (isLoggedIn && Array.isArray(dbCart) && dbCart.length > 0) {
            dbCart.forEach(item => {
                cart[item.product_id] = {
                    name: item.product_name,
                    price: parseFloat(item.product_price),
                    qty: parseInt(item.quantity),
                    image: item.product_image
                };
            });
        } else {
            cart = JSON.parse(localStorage.getItem('cart')) || {};
        }

        function renderCartItems() {
            const container = document.getElementById('cart-container');
            const summary = document.getElementById('cart-summary');
            container.innerHTML = '';
            summary.innerHTML = '';

            const keys = Object.keys(cart);
            if (keys.length === 0) {
                container.innerHTML = `<div class="alert alert-warning">Your cart is empty.</div>`;
                return;
            }

            let totalPrice = 0;
            let totalQty = 0;

            keys.forEach(id => {
                const item = cart[id];
                const itemTotal = item.price * item.qty;
                totalPrice += itemTotal;
                totalQty += item.qty;

                const card = document.createElement('div');
                card.className = 'cart-item-card d-flex gap-3 mb-3 border p-2 rounded';

                card.innerHTML = `
            <img src="${item.image}" alt="${item.name}" style="width: 80px; height: auto;">
            <div class="flex-grow-1">
                <h6 class="mb-1">${item.name}</h6>
                <p class="mb-1 text-muted">Price: ₹${item.price}</p>
                <p class="mb-1 fw-bold">Total: ₹${itemTotal.toFixed(2)}</p>
                <div class="qty-controls d-flex gap-2 align-items-center">
                    <button class="btn btn-sm btn-outline-secondary minus" data-id="${id}">➖</button>
                    <span>${item.qty}</span>
                    <button class="btn btn-sm btn-outline-secondary plus" data-id="${id}">➕</button>
                    <button class="btn btn-sm btn-outline-danger delete" data-id="${id}">🗑️</button>
                </div>
            </div>
        `;

                container.appendChild(card);
            });

            summary.innerHTML = `
        <h5>Cart Summary</h5>
        <p>Total Items: <strong>${totalQty}</strong></p>
        <p>Total Price: <strong>₹${totalPrice.toFixed(2)}</strong></p>
        ${isLoggedIn ? 
                `<a href="checkout.php" class="btn btn-success w-100 mt-2">Go to Checkout</a>` : 
                `<button class="btn btn-warning w-100 mt-2" onclick="openRegisterModal()">Proceed to Checkout</button>`
            }
    `;
        }

        function openRegisterModal() {
            const modal = new bootstrap.Modal(document.getElementById('registerModal'));
            modal.show();
        }

        function submitRegistration() {
            const name = document.getElementById('regName').value;
            const email = document.getElementById('regEmail').value;
            const phone = document.getElementById('regPhone').value;
            const password = document.getElementById('regPassword').value;

            fetch('../payment/register_user.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify({
                    name,
                    email,
                    phone,
                    password,
                    cartItems: cart
                })
            }).then(res => res.json()).then(data => {
                if (data.success) {
                    alert('Registration Successful. Redirecting to checkout...');
                    window.location.href = '/kenz_organic/payment/logIn.php';
                } else {
                    alert(data.message);
                }
            });
        }

        document.addEventListener('click', function(e) {
            const id = e.target.dataset.id;
            if (!id || !cart[id]) return;

            const updateUI = () => {
                localStorage.setItem('cart', JSON.stringify(cart));
                renderCartItems();
            };

            if (e.target.classList.contains('minus')) {
                if (isLoggedIn) {
                    fetch('update_cart.php', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json'
                        },
                        body: JSON.stringify({
                            product_id: id,
                            action: 'decrement'
                        })
                    }).then(res => res.json()).then(data => {
                        if (data.success) {
                            cart[id].qty = Math.max(1, cart[id].qty - 1);
                            renderCartItems();
                        }
                    });
                } else {
                    cart[id].qty = Math.max(1, cart[id].qty - 1);
                    updateUI();
                }
            }

            if (e.target.classList.contains('plus')) {
                if (isLoggedIn) {
                    fetch('update_cart.php', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json'
                        },
                        body: JSON.stringify({
                            product_id: id,
                            action: 'increment'
                        })
                    }).then(res => res.json()).then(data => {
                        if (data.success) {
                            cart[id].qty++;
                            renderCartItems();
                        }
                    });
                } else {
                    cart[id].qty++;
                    updateUI();
                }
            }

            if (e.target.classList.contains('delete')) {
                if (isLoggedIn) {
                    fetch('update_cart.php', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json'
                        },
                        body: JSON.stringify({
                            product_id: id,
                            action: 'delete'
                        })
                    }).then(res => res.json()).then(data => {
                        if (data.success) {
                            delete cart[id];
                            renderCartItems();
                        }
                    });
                } else {
                    delete cart[id];
                    updateUI();
                }
            }
        });


        renderCartItems();
    </script>

    <?php include_once('../includes/footer.php'); ?>
</body>


</html>