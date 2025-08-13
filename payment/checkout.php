<?php
session_start();
include_once('../function/db.php');

if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit();
}

$userId = $_SESSION['user_id'];

// Fetch cart items
$stmt = $conn->prepare("
    SELECT 
        c.product_id,
        c.quantity,
        p.product_price,
        p.product_name,
        p.product_image
    FROM cart c
    JOIN products p ON c.product_id = p.product_id
    WHERE c.user_id = :user_id
");
$stmt->execute(['user_id' => $userId]);

$cartItems = [];
$total = 0;
while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
    $subtotal = $row['product_price'] * $row['quantity'];
    $row['subtotal'] = $subtotal;
    $cartItems[] = $row;
    $total += $subtotal;
}

// Fetch existing billing and shipping addresses if any
$billing = ['recipient_name' => '', 'address' => '', 'city' => '', 'state' => '', 'pincode' => '', 'mobile' => '', 'country' => ''];
$shipping = ['recipient_name' => '', 'address' => '', 'city' => '', 'state' => '', 'pincode' => '', 'mobile' => '', 'country' => ''];

// Query for billing address
$billingStmt = $conn->prepare("SELECT recipient_name, address, city, state, pincode, mobile, country FROM shipping_details WHERE user_id = :user_id AND address_type = 'billing' ORDER BY shipping_date DESC LIMIT 1");
$billingStmt->execute(['user_id' => $userId]);
$existingBilling = $billingStmt->fetch(PDO::FETCH_ASSOC);
if ($existingBilling) {
    $billing = $existingBilling;
}

// Query for shipping address
$shippingStmt = $conn->prepare("SELECT recipient_name, address, city, state, pincode, mobile, country FROM shipping_details WHERE user_id = :user_id AND address_type = 'shipping' ORDER BY shipping_date DESC LIMIT 1");
$shippingStmt->execute(['user_id' => $userId]);
$existingShipping = $shippingStmt->fetch(PDO::FETCH_ASSOC);
if ($existingShipping) {
    $shipping = $existingShipping;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <title>Checkout</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="../css/swiper-bundle.min.css" />
    <link rel="stylesheet" href="../css/sgiv2-main.min.css" />
    <link rel="stylesheet" href="../css/style.css">
    <style>
        body {
            background: linear-gradient(135deg, #cdebd7 30%, #a2d9ce 50%);
            /* Matching soft green gradient */
            font-family: 'Poppins', sans-serif;
            color: #333;
            padding-top: 100px;
        }

        .card {
            background: rgba(255, 255, 255, 0.4);
            border: none;
            border-radius: 20px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
            backdrop-filter: blur(10px);
            padding: 40px;

        }

        .card-header {
            background: transparent;
            border-bottom: none;
            font-weight: 600;
            font-size: 1.3rem;
            display: flex;
            align-items: center;
        }

        .card-header h5 {
            color: #005f56;
            font-weight: 700;
            margin: 0;
        }

        .card-body label {
            font-weight: 500;
            color: #003a48;
        }

        input.form-control,
        select.form-select,
        textarea.form-control {
            background: rgba(255, 255, 255, 0.4);
            border: solid 1px rgba(0, 90, 80, 0.3);
            border-radius: 10px;
            padding: 10px 15px;
            box-shadow: inset 0 1px 3px rgba(0, 0, 0, 0.1);
            font-size: 15px;
        }

        input:focus,
        select:focus,
        textarea:focus {
            box-shadow: 0 0 0 2px rgba(0, 90, 80, 0.2);
            outline: none;
        }

        .btn-dark {
            background: linear-gradient(to right, #003a48, #005f56);
            border: none;
            border-radius: 30px;
            padding: 12px 30px;
            font-weight: bold;
            font-size: 1.1rem;
            box-shadow: 0 5px 15px rgba(0, 90, 80, 0.3);
            transition: background 0.3s ease;
            margin-bottom: 50px;
        }

        .btn-dark:hover {
            background: linear-gradient(to right, #006255, #004a42);
        }

        .small-label {
            font-size: 17px;
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

        /* Style the checkbox itself */
        .custom-checkbox {
            accent-color: #198754;
            /* Bootstrap green */
            width: 25px;
            height: 25px;
            cursor: pointer;
            border: solid 1px rgba(0, 90, 80, 0.3);
        }

        /* Style the label */
        .custom-label {
            font-size: 14px;
            color: #333333;
            /* Dark gray text */
            margin-left: 6px;
        }
    </style>
</head>

<body>
    <?php include '../includes/menu.php'; ?>
    <div class="container mt-5">
        <?php if (empty($cartItems)): ?>
            <div class="alert alert-warning text-center shadow-sm p-3 rounded">Your cart is empty!</div>
        <?php else: ?>
            <form method="POST" action="create_stripe_session.php" class="needs-validation" novalidate id="checkoutForm">
                <div class="row">
                    <!-- Billing Address -->
                    <div class="col-md-1"></div>
                    <div class="col-md-5 mb-4">
                        <div class="card shadow-sm">
                            <div class="card-header text-white">
                                <h5 class="mb-0">🪴 Billing Address</h5>
                            </div>
                            <div class="card-body">
                                <div class="mb-3">
                                    <label for="billing_recipient_name" class="form-label small-label">Full Name</label>
                                    <input type="text" class="form-control" id="billing_recipient_name" name="billing_recipient_name" required value="<?= htmlspecialchars($billing['recipient_name']) ?>">
                                </div>
                                <div class="mb-3">
                                    <label for="billing_address" class="form-label small-label">Address</label>
                                    <textarea class="form-control" id="billing_address" name="billing_address" rows="3" required><?= htmlspecialchars($billing['address']) ?></textarea>
                                </div>
                                <div class="row mb-3">
                                    <div class="col">
                                        <label for="billing_city" class="form-label small-label">City</label>
                                        <input type="text" class="form-control" id="billing_city" name="billing_city" required value="<?= htmlspecialchars($billing['city']) ?>">
                                    </div>
                                    <div class="col">
                                        <label for="billing_country" class="form-label small-label">Country</label>
                                        <select id="billing_country" name="billing_country" class="form-select" required>
                                            <option value="">Select Country</option>
                                            <option value="India" <?= ($billing['country'] == 'India') ? 'selected' : '' ?>>India</option>
                                            <option value="United States" <?= ($billing['country'] == 'United States') ? 'selected' : '' ?>>United States</option>
                                            <option value="United Kingdom" <?= ($billing['country'] == 'United Kingdom') ? 'selected' : '' ?>>United Kingdom</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col">
                                        <label for="billing_state" class="form-label small-label">State</label>
                                        <select class="form-select" id="billing_state" name="billing_state" required>
                                            <option value="">Select State</option>
                                        </select>
                                    </div>
                                    <div class="col">
                                        <label for="billing_pincode" class="form-label small-label">Pincode</label>
                                        <input type="text" class="form-control" id="billing_pincode" name="billing_pincode" required value="<?= htmlspecialchars($billing['pincode']) ?>">
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <label for="billing_mobile" class="form-label small-label">Mobile Number</label>
                                    <input type="text" class="form-control" id="billing_mobile" name="billing_mobile" required value="<?= htmlspecialchars($billing['mobile']) ?>">
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Shipping Address -->
                    <div class="col-md-5 mb-4">
                        <div class="card shadow-sm">
                            <div class="card-header text-white d-flex justify-content-center align-items-center">
                                <h5 class="mb-0">🪴 Shipping Address</h5>
                                <div class="form-check small ms-4">
                                    <input class="form-check-input custom-checkbox" type="checkbox" id="sameAsBilling" />
                                    <label class="form-check-label custom-label mt-2" for="sameAsBilling">Same as Billing</label>
                                </div>


                            </div>
                            <div class="card-body">
                                <div class="mb-3">
                                    <label for="shipping_recipient_name" class="form-label small-label">Full Name</label>
                                    <input type="text" class="form-control" id="shipping_recipient_name" name="shipping_recipient_name" required value="<?= htmlspecialchars($shipping['recipient_name']) ?>">
                                </div>
                                <div class="mb-3">
                                    <label for="shipping_address" class="form-label small-label">Address</label>
                                    <textarea class="form-control" id="shipping_address" name="shipping_address" rows="3" required><?= htmlspecialchars($shipping['address']) ?></textarea>
                                </div>
                                <div class="row mb-3">
                                    <div class="col">
                                        <label for="shipping_city" class="form-label small-label">City</label>
                                        <input type="text" class="form-control" id="shipping_city" name="shipping_city" required value="<?= htmlspecialchars($shipping['city']) ?>">
                                    </div>
                                    <div class="col">
                                        <label for="shipping_country" class="form-label small-label">Country</label>
                                        <select id="shipping_country" name="shipping_country" class="form-select" required>
                                            <option value="">Select Country</option>
                                            <option value="India" <?= ($shipping['country'] == 'India') ? 'selected' : '' ?>>India</option>
                                            <option value="United States" <?= ($shipping['country'] == 'United States') ? 'selected' : '' ?>>United States</option>
                                            <option value="United Kingdom" <?= ($shipping['country'] == 'United Kingdom') ? 'selected' : '' ?>>United Kingdom</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col">
                                        <label for="shipping_state" class="form-label small-label">State</label>
                                        <select class="form-select" id="shipping_state" name="shipping_state" required>
                                            <option value="">Select State</option>
                                        </select>
                                    </div>
                                    <div class="col">
                                        <label for="shipping_pincode" class="form-label small-label">Pincode</label>
                                        <input type="text" class="form-control" id="shipping_pincode" name="shipping_pincode" required value="<?= htmlspecialchars($shipping['pincode']) ?>">
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <label for="shipping_mobile" class="form-label small-label">Mobile Number</label>
                                    <input type="text" class="form-control" id="shipping_mobile" name="shipping_mobile" required value="<?= htmlspecialchars($shipping['mobile']) ?>">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Payment Button -->
                <div class="text-center">
                    <button type="submit" class="btn btn-lg btn-dark px-5">Pay Now</button>
                </div>
            </form>
        <?php endif; ?>
    </div>


    <script>
        async function fetchStates(countryName, targetSelectId, selectedState = '') {
            if (!countryName) return;

            const statesSelect = document.getElementById(targetSelectId);
            statesSelect.innerHTML = '<option>Loading states...</option>';

            try {
                const response = await fetch('https://countriesnow.space/api/v0.1/countries/states', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json'
                    },
                    body: JSON.stringify({
                        country: countryName
                    })
                });
                const data = await response.json();

                if (!data.data || !data.data.states) {
                    statesSelect.innerHTML = '<option value="">No states found</option>';
                    return;
                }

                const states = data.data.states;

                if (states.length === 0) {
                    statesSelect.innerHTML = '<option value="">No states available</option>';
                    return;
                }

                statesSelect.innerHTML = '<option value="">Select State</option>';
                states.forEach(state => {
                    const selectedAttr = (state.name === selectedState) ? 'selected' : '';
                    statesSelect.innerHTML += `<option value="${state.name}" ${selectedAttr}>${state.name}</option>`;
                });
            } catch (error) {
                console.error('Error fetching states:', error);
                statesSelect.innerHTML = '<option value="">Error loading states</option>';
            }
        }

        // When country changes for billing
        document.getElementById('billing_country').addEventListener('change', function() {
            fetchStates(this.value, 'billing_state');
        });

        // When country changes for shipping
        document.getElementById('shipping_country').addEventListener('change', function() {
            fetchStates(this.value, 'shipping_state');
        });

        // Copy billing address to shipping when checkbox checked
        document.getElementById('sameAsBilling').addEventListener('change', function() {
            const checked = this.checked;

            const billingFields = {
                recipient_name: document.getElementById('billing_recipient_name'),
                address: document.getElementById('billing_address'),
                city: document.getElementById('billing_city'),
                state: document.getElementById('billing_state'),
                pincode: document.getElementById('billing_pincode'),
                mobile: document.getElementById('billing_mobile'),
                country: document.getElementById('billing_country')
            };

            const shippingFields = {
                recipient_name: document.getElementById('shipping_recipient_name'),
                address: document.getElementById('shipping_address'),
                city: document.getElementById('shipping_city'),
                state: document.getElementById('shipping_state'),
                pincode: document.getElementById('shipping_pincode'),
                mobile: document.getElementById('shipping_mobile'),
                country: document.getElementById('shipping_country')
            };

            if (checked) {
                // Copy billing to shipping & disable shipping fields
                for (const key in shippingFields) {
                    if (key === 'state') {
                        // For state, we need to populate states select then select value
                        fetchStates(billingFields.country.value, 'shipping_state', billingFields.state.value)
                            .then(() => {
                                shippingFields.state.value = billingFields.state.value;
                                shippingFields.state.setAttribute('disabled', 'disabled');
                            });
                    } else {
                        shippingFields[key].value = billingFields[key].value;
                        if (key !== 'state') shippingFields[key].setAttribute('readonly', 'readonly');
                    }
                }
            } else {
                // Enable shipping fields and clear readonly/disabled
                for (const key in shippingFields) {
                    if (key === 'state') {
                        shippingFields.state.removeAttribute('disabled');
                    } else {
                        shippingFields[key].removeAttribute('readonly');
                    }
                }
            }
        });

        // On page load, populate states if country is already selected (billing)
        window.addEventListener('DOMContentLoaded', () => {
            const billingCountry = document.getElementById('billing_country');
            if (billingCountry.value) {
                fetchStates(billingCountry.value, 'billing_state', document.getElementById('billing_state').getAttribute('data-selected'));
            }
            const shippingCountry = document.getElementById('shipping_country');
            if (shippingCountry.value) {
                fetchStates(shippingCountry.value, 'shipping_state', document.getElementById('shipping_state').getAttribute('data-selected'));
            }

            // Trigger checkbox logic if checked
            const checkbox = document.getElementById('sameAsBilling');
            if (checkbox.checked) {
                checkbox.dispatchEvent(new Event('change'));
            }
        });
    </script>
    <?php include_once('../includes/footer.php'); ?>
</body>

</html>