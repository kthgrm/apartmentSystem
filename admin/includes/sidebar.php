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
                    <span class="nav-link-text ms-1">Dashboard</span>
                </a>
            </li>

            <li class="nav-item mt-3">
                <h6 class="ps-4 ms-2 text-uppercase text-xs font-weight-bolder opacity-6">Manage</h6>
            </li>

            <li class="nav-item">
                <a class="nav-link <?php echo in_array(basename($_SERVER['PHP_SELF']), ['unit.php', 'unit-view.php', 'unit-edit.php']) ? 'active' : ''; ?>" href="unit.php">
                    <div class="icon icon-shape icon-sm shadow border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="fa fa-building text-dark text-lg"></i>
                    </div>
                    <span class="nav-link-text ms-1">Unit</span>
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link <?php echo in_array(basename($_SERVER['PHP_SELF']), ['tenant.php', 'tenant-add.php', 'tenant-edit.php']) ? 'active' : ''; ?>" href="tenant.php">
                    <div class="icon icon-shape icon-sm shadow border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="fa fa-users text-dark text-lg"></i>
                    </div>
                    <span class="nav-link-text ms-1">Tenant</span>
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link <?php echo in_array(basename($_SERVER['PHP_SELF']), ['lease.php','lease-add.php','lease-edit.php']) ? 'active' : ''; ?>" href="lease.php">
                    <div class="icon icon-shape icon-sm shadow border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="fa fa-book text-dark text-lg"></i>
                    </div>
                    <span class="nav-link-text ms-1">Lease</span>
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link <?php echo in_array(basename($_SERVER['PHP_SELF']), ['invoice.php','invoice-generate.php','invoice-edit.php']) ? 'active' : ''; ?>" href="invoice.php">
                    <div class="icon icon-shape icon-sm shadow border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="fa fa-file-invoice text-dark text-lg"></i>
                    </div>
                    <span class="nav-link-text ms-1">Invoice</span>
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link <?php echo in_array(basename($_SERVER['PHP_SELF']), ['payment.php','payment-view.php','payment-add.php']) ? 'active' : ''; ?>" href="payment.php">
                    <div class="icon icon-shape icon-sm shadow border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="fa fa-credit-card text-dark text-lg"></i>
                    </div>
                    <span class="nav-link-text ms-1">Payment</span>
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link <?php echo in_array(basename($_SERVER['PHP_SELF']), ['maintenance.php', 'maintenance-view.php']) ? 'active' : ''; ?>" href="maintenance.php">
                    <div class="icon icon-shape icon-sm shadow border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="fa fa-wrench text-dark text-lg"></i>
                    </div>
                    <span class="nav-link-text ms-1">Maintenance Request</span>
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link <?php echo in_array(basename($_SERVER['PHP_SELF']), ['complaint.php', 'complaint-view.php']) ? 'active' : ''; ?>" href="complaint.php">
                    <div class="icon icon-shape icon-sm shadow border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="fa fa-address-book text-dark text-lg"></i>
                    </div>
                    <span class="nav-link-text ms-1">Complaint</span>
                </a>
            </li>

            <li class="nav-item mt-3">
                <h6 class="ps-4 ms-2 text-uppercase text-xs font-weight-bolder opacity-6">Report</h6>
            </li>

            <li class="nav-item">
                <a class="nav-link" data-bs-toggle="collapse" href="#reportDropdown" role="button" aria-expanded="false" aria-controls="reportDropdown">
                    <div class="icon icon-shape icon-sm shadow border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="fa fa-file-alt text-dark text-lg"></i>
                    </div>
                    <span class="nav-link-text ms-1">Report</span>
                </a>
                <?php
                    $reportPages = ['tenant-report.php', 'maintenance-report.php', 'complaint-report.php', 'invoice-report.php' , 'payment-report.php', 'log-report.php'];
                    $isActive = in_array(basename($_SERVER['PHP_SELF']), $reportPages);
                ?>
                <div class="collapse <?php echo $isActive ? 'show' : ''; ?>" id="reportDropdown">
                    <ul class="ms-5 navbar-nav mb-1">
                        <li class="nav-item">
                            <a class="nav-link <?php echo basename($_SERVER['PHP_SELF']) == 'tenant-report.php' ? 'active' : ''; ?>" href="tenant-report.php">
                                <span class="nav-link-text ms-1">Tenant</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link <?php echo basename($_SERVER['PHP_SELF']) == 'maintenance-report.php' ? 'active' : ''; ?>" href="maintenance-report.php">
                                <span class="nav-link-text ms-1">Maintenance</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link <?php echo basename($_SERVER['PHP_SELF']) == 'complaint-report.php' ? 'active' : ''; ?>" href="complaint-report.php">
                                <span class="nav-link-text ms-1">Complaint</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link <?php echo basename($_SERVER['PHP_SELF']) == 'invoice-report.php' ? 'active' : ''; ?>" href="invoice-report.php">
                                <span class="nav-link-text ms-1">Invoice</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link <?php echo basename($_SERVER['PHP_SELF']) == 'payment-report.php' ? 'active' : ''; ?>" href="payment-report.php">
                                <span class="nav-link-text ms-1">Payment</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link <?php echo basename($_SERVER['PHP_SELF']) == 'log-report.php' ? 'active' : ''; ?>" href="log-report.php">
                                <span class="nav-link-text ms-1">Log</span>
                            </a>
                        </li>
                    </ul>
                </div>
            </li>
        </ul>
    </div>
    <div class="sidenav-footer mx-4 ">
        <a class="btn btn-primary mt-3 w-100 d-flex align-items-center justify-content-center" href="logout.php" onclick="return confirm('Are you sure you want to logout?')">
            <i class="fa fa-sign-out me-2"></i> Logout
        </a>
    </div>
</aside>