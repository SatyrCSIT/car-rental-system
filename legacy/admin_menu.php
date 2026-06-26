<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container-fluid">
        <a class="navbar-brand" href="#">RENT - VEHICLE</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="admin.php">Home</a>
                </li>
            </ul>
            <?php
      if (isset($_SESSION['Username'])) {
          $loggedInUsername = $_SESSION['Username'];
          echo '<ul class="navbar-nav">';
          echo '<li class="nav-item dropdown">';
          echo '<a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">';
          echo 'ยินดีต้อนรับ, ' . $loggedInUsername;
          echo '</a>';
          echo '<ul class="dropdown-menu" aria-labelledby="navbarDropdown">';
          echo '<li><a class="dropdown-item" href="#">Edit Profile</a></li>';
          echo '<li><hr class="dropdown-divider"></li>';
          echo '<li><a class="dropdown-item" href="Logout.php">Logout</a></li>';
          echo '</ul>';
          echo '</li>';
          echo '</ul>';
      }
      ?>
        </div>
    </div>
</nav>