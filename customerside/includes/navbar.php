<nav class="navbar navbar-expand-lg shadow custom-nav">
  <div class="container-fluid ms-3">
    <a id="logo-ssite-1" href="../customerside/homecustomer.php">
      <img src="images/SSITE-LOGO.png" alt="SSITE-LOGO Logo" style="width:80px;height:auto;">
    </a>
    
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <!-- SIDEBAR CALL -->
      <a class="btn btn-primary" href="#" role="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasExample" aria-controls="offcanvasExample">
        <b>Menu</b>
      </a>

      <ul class="navbar-nav me-auto">
        <li class="nav-item active" id="home-admin">
          <a class="nav-link" href="../customerside/homecustomer.php"><b>Home</b> <span class="sr-only">(current)</span></a>
        </li>
        <li class="nav-item active" id="home-admin">
          <a class="nav-link" href="product_display.php"><b>Products</b> <span class="sr-only">(current)</span></a>
        </li>
        <li class="nav-item active" id="home-admin">
          <a class="nav-link" href="#"><b>News & Update</b> <span class="sr-only">(current)</span></a>
        </li>
        <li class="nav-item active" id="home-admin">
          <a class="nav-link" href="view_cart.php"><b>Cart</b> <span class="sr-only">(current)</span></a>
        </li>
        <li class="nav-item active" id="home-admin">
          <a class="nav-link" href="#"><b>About</b> <span class="sr-only">(current)</span></a>
        </li>
        <li class="nav-item active" id="home-admin">
          <a class="nav-link" href="#"><b>Account</b> <span class="sr-only">(current)</span></a>
        </li>
      </ul>
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.1/css/all.min.css"/>
      <ul class="navbar-nav ms-auto">
        <li>
          <label for="">
          <?php 

          $query = "SELECT * FROM user_information WHERE userinfo_id = ?";
          $stmt = $con->prepare($query);
          $stmt->bind_param("i", $_SESSION['uid']
        );
          if ($stmt->execute()) {
            $result = $stmt->get_result();
            if ($result->num_rows > 0) {
                $item = $result->fetch_assoc();
                $user_fullname = $item['firstname'] .' ' . $item['lastname'];
            }
          }
          echo $user_fullname;
          ?>

          </label>
        </li>
        <li class="nav-item-2" id="admin-cart">
          <a class="nav-link active" href="../vscode/view_cart.php"><i class="fa-solid fa-cart-shopping fa-1x"></i></a>
        </li>
        <style>
          .nav-item-2 {
              font-family: 'Inter', sans-serif;
              font-weight: 500;
              color: #F9F6F6;

          }

          .nav-item-2.active {
              border-radius: 8px;
              color: #F9F6F6;
          }

          .nav-item-2.active .nav-link {
              color: #F9F6F6 !important;
          }

          .nav-item-2:hover .nav-link {
              color: #5e9ba9 !important;
}
        </style>
        <li class="nav-item" id="admin-logout">
          <a class="nav-link active" href="../vscode/userlogout.php"><i class="fa-solid fa-right-from-bracket fa-1x"></i> Sign Out</a>
        </li>
      </ul>
    </div>
  </div>
</nav>
