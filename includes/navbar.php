<nav class="navbar navbar-expand-lg bg-white shadow sticky-top">
  <div class="container">
    <a class="navbar-brand" href="index.php">
      <img src="assets/image/logo-b.png" aria-hidden="true" style="max-width:50px">
      Estrella Apartment
    </a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse justify-content-end" id="navbarSupportedContent">
      <ul class="navbar-nav ms-auto">
        <li class="nav-item">
          <a class="nav-link <?php if($pageTitle == 'Home') echo 'active text-warning'; ?>" href="index.php">Home</a>
        </li>
        <li class="nav-item">
          <a class="nav-link <?php if($pageTitle == 'Gallery') echo 'active text-warning'; ?>" href="gallery.php">Gallery</a>
        </li>
        <li class="nav-item">
          <a class="nav-link <?php if($pageTitle == 'About Us') echo 'active text-warning'; ?>" href="about.php">About Us</a>
        </li>
        <li class="nav-item">
          <a class="nav-link <?php if($pageTitle == 'Inquire') echo 'active text-warning'; ?>" href="inquire.php">Inquire</a>
        </li>
      </ul>
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="btn btn-primary <?php if($pageTitle == 'Login') echo 'd-none'; ?>" href="login.php">Login</a>
        </li>
      </ul>
    </div>
  </div>
</nav>