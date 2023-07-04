<nav class="navbar navbar-expand-lg bg-light" data-bs-theme="light">
  <div class="container">
    <a class="navbar-brand" href="#"><img src="./images/assets/logo.png" width="75px" alt=""><?php echo $header['siteName'] ?></a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarColor01" aria-controls="navbarColor01" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarColor01">
      <ul class="navbar-nav me-auto">
        <li class="nav-item">
          
          <a class="nav-link active" href="index.php"><?php echo $header['nav-home'] ?></i>
            <span class="visually-hidden">(current)</span>
          </a>
        </li>

        <li class="nav-item">
          <a class="nav-link" href="search.php"><?php echo $header['nav-search'] ?></a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="contactus.php"><?php echo $header['nav-contactus'] ?></a>
        </li>

        <?php if ( isset( $_SESSION['ID'])) {
        ?>
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" data-bs-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false"><?php echo $header['dropdownlistCMS'] ?></a>
            <div class="dropdown-menu">
              <a class="dropdown-item" href="categorymanagment.php"><?php echo $header['nav-dropdown-categories'] ?></a>
              <a class="dropdown-item" href="suppliermanagment.php"><?php echo $header['nav-dropdown-suppliers'] ?></a>
              <a class="dropdown-item" href="productmanagment.php"><?php echo $header['nav-dropdown-products'] ?></a>
            </div>
          </li>

        <?php } ?>

        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" data-bs-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false"><?php echo $header['langname'] ?></a>
          <div class="dropdown-menu">

            <form action="" method="post">
              <div style="display: flex;">
                <input class="dropdown-item" name="ar" type="submit" value="عربي" /><i class="flag flag-uae"></i>

              </div>
              <div style="display: flex">
                <input class="dropdown-item" type="submit" name="en" value="En"><i class="flag flag-united-states"></i>

              </div>


            </form>

          </div>
        </li>
        <?php if ( isset( $_SESSION['ID'])) {
        ?>
        <li class="nav-item">
          <a class="nav-link" href="logout.php"><?php echo $header['nav-logout'] ?></a>
        </li>
        <?php }?>
      </ul>

    </div>
  </div>
</nav>