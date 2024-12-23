<aside class="sidenav navbar navbar-vertical navbar-expand-xs border-0 border-radius-xl my-3 fixed-start ms-3 " id="sidenav-main">
    <div class="sidenav-header">
      <a class="navbar-brand m-0" href="index.php">
        <img src="assets/image/logo-b.png" class="navbar-brand-img h-100" alt="main_logo">
        <span class="ms-1 font-weight-bold">Estrella Apartment</span>
      </a>
    </div>

    <hr class="horizontal dark mt-0">
    <div class="collapse navbar-collapse  w-auto " id="sidenav-collapse-main">
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link <?php echo basename($_SERVER['PHP_SELF']) == 'index.php' ? 'active' : ''; ?>" href="index.php">
                    <div class="icon icon-shape icon-sm shadow border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="fa fa-home text-dark text-lg"></i>
                    </div>
                    <span class="nav-link-text ms-1">Home</span>
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link <?php echo in_array(basename($_SERVER['PHP_SELF']), ['profile.php', 'profile-edit.php']) ? 'active' : ''; ?>" href="profile.php">
                    <div class="icon icon-shape icon-sm shadow border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="fa fa-user text-dark text-lg"></i>
                    </div>
                    <span class="nav-link-text ms-1">Profile</span>
                </a>
            </li>
            
            <li class="nav-item">
                <a class="nav-link <?php echo in_array(basename($_SERVER['PHP_SELF']), ['payment.php', 'pay.php']) ? 'active' : ''; ?>" href="payment.php">
                    <div class="icon icon-shape icon-sm shadow border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="fa fa-money text-dark text-lg"></i>
                    </div>
                    <span class="nav-link-text ms-1">Payment</span>
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link <?php echo in_array(basename($_SERVER['PHP_SELF']), ['maintenance.php', 'maintenance-history.php']) ? 'active' : ''; ?>" href="maintenance.php">
                    <div class="icon icon-shape icon-sm shadow border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="fa fa-book text-dark text-lg"></i>
                    </div>
                    <span class="nav-link-text ms-1">Maintenance</span>
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link <?php echo in_array(basename($_SERVER['PHP_SELF']), ['complaint.php', 'complaint-history.php']) ? 'active' : ''; ?>" href="complaint.php">
                    <div class="icon icon-shape icon-sm shadow border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="fa fa-address-book text-dark text-lg"></i>
                    </div>
                    <span class="nav-link-text ms-1">Complaint</span>
                </a>
            </li>
        </ul>
    </div>
    <div class="sidenav-footer mx-4 ">
        <a class="btn btn-primary mt-3 w-100 d-flex align-items-center justify-content-center" href="logout.php" onclick="return confirm('Are you sure you want to logout?')">
            <i class="fa fa-sign-out me-2"></i> Logout
        </a>
    </div>
</aside>