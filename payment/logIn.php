<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Login</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"/>
</head>
<body class="bg-light">
  <div class="container mt-5">
    <div class="row justify-content-center">
      <div class="col-md-4">
        <h3 class="text-center mb-4">Login</h3>
        <div id="error" class="alert alert-danger d-none"></div>
        <form id="loginForm">
          <div class="mb-3">
            <label>Email</label>
            <input type="email" class="form-control" name="email" required/>
          </div>
          <div class="mb-3">
            <label>Password</label>
            <input type="password" class="form-control" name="password" required/>
          </div>
          <button type="submit" class="btn btn-primary w-100">Login</button>
        </form>
      </div>
    </div>
  </div>

  <script>
    const form = document.getElementById("loginForm");
    const errorDiv = document.getElementById("error");

    form.addEventListener("submit", async (e) => {
      e.preventDefault();
      const formData = new FormData(form);
      const data = Object.fromEntries(formData.entries());

      const response = await fetch("login_user.php", {
        method: "POST",
        headers: { "Content-Type": "application/json" },
        body: JSON.stringify(data)
      });

      const result = await response.json();

      if (result.success) {
        alert("Login successful. Welcome " + result.user.name);
        window.location.href = "/kenz_organic/payment/view-cart.php";
      } else {
        errorDiv.classList.remove("d-none");
        errorDiv.textContent = result.message;
      }
    });
  </script>
</body>
</html>
