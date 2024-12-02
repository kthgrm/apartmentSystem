<?php include('includes/header.php'); ?>
    
    <?= alertMessage(); ?>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="font-weight-bolder">Home</h4>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6 mb-4">
                            <div class="card border">
                                <div class="card-header pb-0">
                                    <h5>Current Invoice</h5>
                                </div>
                                <div class="card-body py-0">
                                    <?php
                                        if (isset($_SESSION['loggedInUser']['userID'])) {
                                            $result = fetchUserTenant($_SESSION['loggedInUser']['userID']);
                                            $user = $result->fetch_assoc();
                                            $unitID = $user['unitID'];
                                            
                                            // Check if the unitID is paid for the current month
                                            $currentMonth = date("Y-m");
                                            $query = "SELECT paymentStatus FROM invoice WHERE unitID = '$unitID' ORDER BY issueDate DESC LIMIT 1";
                                            $paymentResult = mysqli_query($conn, $query);
                                            
                                            if (mysqli_num_rows($paymentResult) > 0) {
                                                $paymentRow = mysqli_fetch_assoc($paymentResult);
                                                if ($paymentRow['paymentStatus'] == 'paid') {
                                                    echo "<p>Paid</p>";
                                                } else {
                                                    echo "<p>Not Yet Paid</p>";
                                                }
                                            } else {
                                                echo "<p>Not Yet Paid</p>";
                                            }
                                        }
                                    ?>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 mb-4">
                            <div class="card border">
                                <div class="card-header pb-0">
                                    <h5>Lease Until</h5>
                                </div>
                                <div class="card-body py-0">
                                    <?php
                                        if (isset($_SESSION['loggedInUser']['userID'])) {
                                            $result = fetchUserTenant($_SESSION['loggedInUser']['userID']);
                                            $user = $result->fetch_assoc();
                                            $unitID = $user['unitID'];
                                            
                                            $query = "SELECT endDate FROM lease WHERE unitID = '$unitID' ORDER BY startDate DESC LIMIT 1";
                                            $leaseResult = mysqli_query($conn, $query);
                                            
                                            if (mysqli_num_rows($leaseResult) > 0) {
                                                $leaseRow = mysqli_fetch_assoc($leaseResult);
                                                echo "<p>" . date("F j, Y", strtotime($leaseRow['endDate'])) . "</p>";
                                            } else {
                                                echo "<p>No lease information available</p>";
                                            }
                                        }
                                    ?>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-6 col-md-6 col-lg-3 mb-4">
                            <div class="card card-body text-center border">
                                <a href="profile.php">
                                    <i class="fa fa-4x fa-user mb-2"></i>
                                    <br>
                                    <p class="text-sm mb-0 text-capitalize font-weight-bold">Profile</p>
                                </a>
                            </div>
                        </div>
                        <div class="col-6 col-md-6 col-lg-3 mb-4">
                            <div class="card card-body text-center border">
                                <a href="payment.php">
                                    <i class="fa fa-4x fa-money mb-2"></i>
                                    <br>
                                    <p class="text-sm mb-0 text-capitalize font-weight-bold">Payment</p>
                                </a>
                            </div>
                        </div>
                        <div class="col-6 col-md-6 col-lg-3 mb-4">
                            <div class="card card-body text-center border">
                                <a href="maintenance.php">
                                    <i class="fa fa-4x fa-book mb-2"></i>
                                    <br>
                                    <p class="text-sm mb-0 text-capitalize font-weight-bold">Maintenance</p>
                                </a>
                            </div>
                        </div>
                        <div class="col-6 col-md-6 col-lg-3 mb-4">
                            <div class="card card-body text-center border">
                                <a href="complaint.php">
                                    <i class="fa fa-4x fa-address-book mb-2"></i>
                                    <br>
                                    <p class="text-sm mb-0 text-capitalize font-weight-bold">Complaint</p>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

<?php include('includes/footer.php'); ?>