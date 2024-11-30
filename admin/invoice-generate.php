<?php include('includes/header.php') ?>

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
                                <h5 class="font-weight-bolder">Invoice For All Unit</h5>
                                <form method="POST" action="">
                                    <div class="form-group">
                                        <label for="unitID">For The Month Of</label>
                                        <input type="Month" class="form-control" name="month" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="issueDate">Issue Date</label>
                                        <input type="date" class="form-control" name="issueDate" value="<?= date('Y-m-d'); ?>" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="issueDate">Due Date</label>
                                        <input type="date" class="form-control" name="dueDate" value="<?= date('Y-m-d', strtotime('+3 days')); ?>" required>
                                    </div>
                                    <button type="submit" name="generateInvoices" class="btn btn-primary">Generate Invoice</button>
                                </form>
                            </div>
                        </div>
                        <div class="col"></div>
                    </div>
                    
                    <?php
                        if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['generateInvoices'])) {
                            $monthYear = date('F Y', strtotime($_POST['month']));
                            $issueDate = $_POST['issueDate'];
                            $dueDate = $_POST['dueDate'];
    
                            $query = "SELECT * FROM unit WHERE status = 'occupied'";
                            $result = mysqli_query($conn, $query);
    
                            if(mysqli_num_rows($result) > 0) {
                                while($unit = mysqli_fetch_assoc($result)) {
                                    $unitID = $unit['unitID'];
                                    $rent = $unit['unitRate'];
                                    $paymentStatus = 'unpaid';
    
                                    $insertQuery = "INSERT INTO invoice (unitID, monthYear, rentAmount, issueDate, dueDate, paymentStatus) VALUES ('$unitID', '$monthYear', '$rent', '$issueDate', '$dueDate', '$paymentStatus')";
                                    if (mysqli_query($conn, $insertQuery)) {
                                        echo "<p>Invoice generated successfully for Unit: $unitID</p>";
                                    } else {
                                        echo "<p>Error generating invoice for Unit: $unitID - " . mysqli_error($conn) . "</p>";
                                    }
    
                                    echo "<table class='table table-bordered'>";
                                    echo "<tr><td>Rent Amount</td><td>$" . $rent . "</td></tr>";
                                    echo "<tr><td>For the Month of</td><td>" . $monthYear . "</td></tr>";
                                    echo "<tr><td>Issue Date</td><td>" . $issueDate . "</td></tr>";
                                    echo "<tr><td>Due Date</td><td>" . $dueDate . "</td></tr>";
                                    echo "</table><hr>";
                                }
                            } else {
                                echo "<p>No occupied units found.</p>";
                            }
                        }
                    ?>
                </div>
            </div>
        </div>
    </div>

<?php include('includes/footer.php') ?>