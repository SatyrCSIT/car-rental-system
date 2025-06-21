<?php
session_start();
?>

<!doctype html>
<html lang="en">
<head>
  <title>เข้าสู่ระบบ - ล็อคอิน</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta property="og:image" itemprop="image" content="https://devbanban.com/app/carrent/asset/theme/images/hero_1.jpg">
  <meta property="og:type" content="website" />
  <meta name="twitter:card" content="summary" />
  <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700;900&display=swap" rel="stylesheet">
  <link href="https://devbanban.com/app/carrent/asset/theme/fonts/icomoon/style.css" rel="stylesheet" type="text/css" />
  <link href="https://devbanban.com/app/carrent/asset/theme/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
  <link href="https://devbanban.com/app/carrent/asset/theme/css/owl.theme.default.min.css" rel="stylesheet"
    type="text/css" />
  <link href="https://devbanban.com/app/carrent/asset/theme/fonts/flaticon/font/flaticon.css" rel="stylesheet"
    type="text/css" />
  <link href="https://devbanban.com/app/carrent/asset/theme/css/aos.css" rel="stylesheet" type="text/css" />
  <link href="https://devbanban.com/app/carrent/asset/theme/css/style.css" rel="stylesheet" type="text/css" />
</head>
<body>
  
  <div class="site-wrap" id="home-section">
    <div class="site-mobile-menu site-navbar-target">
      <div class="site-mobile-menu-header">
        <div class="site-mobile-menu-close mt-3">
          <span class="icon-close2 js-menu-toggle"></span>
        </div>
      </div>
      <div class="site-mobile-menu-body"></div>
    </div>
    <header class="site-navbar site-navbar-target" role="banner">
      <div class="container">
        <div class="row align-items-center position-relative">
          <div class="col-3">
          </div>
          <div class="col-9  text-right">

            <span class="d-inline-block d-lg-none"><a href="#" class=" site-menu-toggle js-menu-toggle py-5 "><span
                  class="icon-menu h3 text-black"></span></a></span>
            <nav class="site-navigation text-right ml-auto d-none d-lg-block" role="navigation">
              <ul class="site-menu main-menu js-clone-nav ml-auto ">
                <li><a href="#" class="nav-link">Home</a></li>
                <li><a href="register.php" class="nav-link">Register</a></li>
              </ul>
            </nav>
          </div>

        </div>
      </div>
    </header>

    <div class="hero inner-page"
      style="background-image: url('https://devbanban.com/app/carrent/asset/theme/images/hero_1.jpg');">

      <div class="container">
        <div class="row align-items-end ">
          <div class="col-lg-12 col-12">
            <div class="intro">
              <span class="d-block d-sm-none">
                <br><br><br>
              </span>
              <h1 style="color:#eb4034;" class="d-none d-sm-block"><strong><br>Rent a car in Phitsanulok</strong></h1>
              <div class="custom-breadcrumbs">
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="site-section bg-light" id="contact-section">
        <div class="container">
          <div class="row">

            <div class="col-sm-2 col-md-4"></div>
            <div class="col-12 col-sm-12 col-md-5">
              <h2>LOGIN</h2>

              <?php
              if (isset($_SESSION["Error"])) {
                echo '<div class="error-message">' . $_SESSION["Error"] . '</div>';
                unset($_SESSION["Error"]); 
              }
              ?>
              
              <form action="login_check.php" method="post" onsubmit="return validateForm();">
                <div class="form-group row">
                  <div class="col-md-7">
                    <input type="text" name="username" class="form-control" placeholder="Username" required
                      minlength="3">
                  </div>
                </div>
                <div class="form-group row">
                  <div class="col-md-7">
                    <input type="password" name="password" class="form-control" placeholder="Password"
                      pattern="^[a-zA-Z0-9]+$" title="ภาษาอังกฤษหรือตัวเลขเท่านั้น" required minlength="2">
                  </div>
                </div>
                <div class="form-group row">
                  <div class="col-md-7 mr-auto">
                    <input type="submit" class="btn btn-block btn-primary text-white py-3 px-5" value="Login">
                  </div>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
    <?php
                if(isset($_SESSION["Error"])){
                    echo $_SESSION["Error"] ;
                }
    ?>
</body>
</html>
