<?php include('includes/header.php'); ?>

<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h4 class="font-weight-bolder">
                    Generate Invoice
                    <a href="invoice.php" class="btn btn-primary mb-0 float-end">
                        <i class="fa fa-angle-left"></i>
                        Back
                    </a>
                </h4>
            </div>
            <div class="card-body">
                <?= alertMessage(); ?>
                <div class="row">
                    <div class="col"></div>
                    <div class="col-md-6 col-lg-6 mb-4">
                        <div class="card card-body border text-center">
                            <h5 class="font-weight-bolder">All Units</h5>
                            <form method="POST" action="">
                                <div class="form-group">
                                    <label for="month">For The Month Of</label>
                                    <input type="month" class="form-control" name="month" required>
                                </div>
                                <div class="form-group">
                                    <label for="issueDate">Issue Date</label>
                                    <input type="date" class="form-control" name="issueDate" value="<?= date('Y-m-d'); ?>" required>
                                </div>
                                <div class="form-group">
                                    <label for="dueDate">Due Date</label>
                                    <input type="date" class="form-control" name="dueDate" value="<?= date('Y-m-d', strtotime('+3 days')); ?>" required>
                                </div>
                                <button type="submit" name="generateInvoices" class="btn btn-primary">Generate Invoice</button>
                            </form>
                        </div>
                    </div>
                    <div class="col"></div>
                </div>
                <div class="row">
                    <div class="col"></div>
                    <div class="col-md-6 col-lg-6 mb-4">
                        <div class="card card-body border text-center">
                            <h5 class="font-weight-bolder">Specific Unit</h5>
                            <form method="POST" action="">
                                <div class="form-group">
                                    <label for="unitID">Unit ID</label>
                                    <input type="text" class="form-control" name="unitID" required>
                                </div>
                                <div class="form-group">
                                    <label for="month">For The Month Of</label>
                                    <input type="month" class="form-control" name="month" required>
                                </div>
                                <div class="form-group">
                                    <label for="issueDate">Issue Date</label>
                                    <input type="date" class="form-control" name="issueDate" value="<?= date('Y-m-d'); ?>" required>
                                </div>
                                <div class="form-group">
                                    <label for="dueDate">Due Date</label>
                                    <input type="date" class="form-control" name="dueDate" value="<?= date('Y-m-d', strtotime('+3 days')); ?>" required>
                                </div>
                                <button type="submit" name="generateInvoiceByUnit" class="btn btn-primary">Generate Invoice</button>
                            </form>
                        </div>
                    </div>
                    <div class="col"></div>
                </div>
                <?php
                if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                    if (isset($_POST['generateInvoices'])) {
                        // Handle generating invoices for all units
                        $monthYear = date('F Y', strtotime($_POST['month']));
                        $issueDate = $_POST['issueDate'];
                        $dueDate = $_POST['dueDate'];

                        $query = "SELECT * FROM unit WHERE status = 'occupied'";
                        $result = mysqli_query($conn, $query);

                        if (mysqli_num_rows($result) > 0) {
                            while ($unit = mysqli_fetch_assoc($result)) {
                                $unitID = $unit['unitID'];
                                $rent = $unit['unitRate'];
                                $paymentStatus = 'unpaid';

                                $insertQuery = "INSERT INTO invoice (unitID, monthYear, rentAmount, issueDate, dueDate, paymentStatus) VALUES ('$unitID', '$monthYear', '$rent', '$issueDate', '$dueDate', '$paymentStatus')";
                                if (mysqli_query($conn, $insertQuery)) {
                                    echo "<div class='alert alert-success'>Invoice generated successfully for Unit ID: $unitID</div>";
                                } else {
                                    echo "<div class='alert alert-danger'>Error generating invoice for Unit ID: $unitID - " . mysqli_error($conn) . "</div>";
                                }
                            }
                        } else {
                            echo "<div class='alert alert-danger'>No occupied units found</div>";
                        }
                    } elseif (isset($_POST['generateInvoiceByUnit'])) {
                        // Handle generating an invoice for a specific unit
                        $unitID = $_POST['unitID'];
                        $month = date('F Y', strtotime($_POST['month']));
                        $issueDate = $_POST['issueDate'];
                        $dueDate = $_POST['dueDate'];
                        $paymentStatus = 'unpaid';

                        // Fetch the unit rate
                        $unitQuery = "SELECT unitRate FROM unit WHERE unitID = '$unitID'";
                        $unitResult = mysqli_query($conn, $unitQuery);
                        if (mysqli_num_rows($unitResult) > 0) {
                            $unit = mysqli_fetch_assoc($unitResult);
                            $rentAmount = $unit['unitRate'];

                            // Insert the new invoice
                            $insertQuery = "INSERT INTO invoice (unitID, monthYear, rentAmount, issueDate, dueDate, paymentStatus) VALUES ('$unitID', '$month', '$rentAmount', '$issueDate', '$dueDate', '$paymentStatus')";
                            if (mysqli_query($conn, $insertQuery)) {
                                echo "<div class='alert alert-success'>Invoice generated successfully for Unit ID: $unitID</div>";
                            } else {
                                echo "<div class='alert alert-danger'>Error generating invoice: " . mysqli_error($conn) . "</div>";
                            }
                        } else {
                            echo "<div class='alert alert-danger'>Unit ID not found</div>";
                        }
                    }
                }
                ?>
            </div>
        </div>
    </div>
</div>

<?php include('includes/footer.php'); ?>