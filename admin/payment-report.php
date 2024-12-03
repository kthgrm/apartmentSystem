<?php include('includes/header.php') ?>

<div class="row">
    <div class="col-md-12">
        <div class="card">
            <form action="" method="POST">
                <div class="card-header">
                    <div class="row">
                        <div class="col-md-6">
                            <h3 class="font-weight-bolder">Payment Report</h3>
                        </div>
                        <div class="col-md-6">
                            <div class="row">
                                <div class="col-md-3 col-lg-3">
                                    <pre class="mb-0 ms-1">Year</pre>
                                    <select class="form-select" name="year">
                                        <option value="all" <?= (isset($_POST['year']) && $_POST['year'] == 'all') ? 'selected' : ''; ?>>All</option>
                                        <?php
                                            $currentYear = date("Y");
                                            for ($year = $currentYear; $year >= 2024; $year--) {
                                                echo "<option value='$year' " . ((isset($_POST['year']) && $_POST['year'] == $year) ? 'selected' : '') . ">$year</option>";
                                            }
                                        ?>
                                    </select>
                                </div>
                                <div class="col-md-3 col-lg-3">
                                    <pre class="mb-0 ms-1">Month</pre>
                                    <select class="form-select" name="month">
                                        <option value="all" <?= (isset($_POST['month']) && $_POST['month'] == 'all') ? 'selected' : ''; ?>>All</option>
                                        <option value="january" <?= (isset($_POST['month']) && $_POST['month'] == 'january') ? 'selected' : ''; ?>>January</option>
                                        <option value="february" <?= (isset($_POST['month']) && $_POST['month'] == 'february') ? 'selected' : ''; ?>>February</option>
                                        <option value="march" <?= (isset($_POST['month']) && $_POST['month'] == 'march') ? 'selected' : ''; ?>>March</option>
                                        <option value="april" <?= (isset($_POST['month']) && $_POST['month'] == 'april') ? 'selected' : ''; ?>>April</option>
                                        <option value="may" <?= (isset($_POST['month']) && $_POST['month'] == 'may') ? 'selected' : ''; ?>>May</option>
                                        <option value="june" <?= (isset($_POST['month']) && $_POST['month'] == 'june') ? 'selected' : ''; ?>>June</option>
                                        <option value="july" <?= (isset($_POST['month']) && $_POST['month'] == 'july') ? 'selected' : ''; ?>>July</option>
                                        <option value="august" <?= (isset($_POST['month']) && $_POST['month'] == 'august') ? 'selected' : ''; ?>>August</option>
                                        <option value="september" <?= (isset($_POST['month']) && $_POST['month'] == 'september') ? 'selected' : ''; ?>>September</option>
                                        <option value="october" <?= (isset($_POST['month']) && $_POST['month'] == 'october') ? 'selected' : ''; ?>>October</option>
                                        <option value="november" <?= (isset($_POST['month']) && $_POST['month'] == 'november') ? 'selected' : ''; ?>>November</option>
                                        <option value="december" <?= (isset($_POST['month']) && $_POST['month'] == 'december') ? 'selected' : ''; ?>>December</option>
                                    </select>
                                </div>
                                <div class="col-md-3 col-lg-3">
                                    <pre class="mb-0 ms-1">Payment Method</pre>
                                    <select class="form-select" name="paymentMethod">
                                        <option value="all" <?= (isset($_POST['paymentMethod']) && $_POST['paymentMethod'] == 'all') ? 'selected' : ''; ?>>All</option>
                                        <option value="cash" <?= (isset($_POST['paymentMethod']) && $_POST['paymentMethod'] == 'cash') ? 'selected' : ''; ?>>Cash</option>
                                        <option value="gcash" <?= (isset($_POST['paymentMethod']) && $_POST['paymentMethod'] == 'gcash') ? 'selected' : ''; ?>>Gcash</option>
                                        <option value="card" <?= (isset($_POST['paymentMethod']) && $_POST['paymentMethod'] == 'card') ? 'selected' : ''; ?>>Card</option>
                                    </select>
                                </div>
                                <div class="col-md-3 col-lg-3">
                                    <pre class="mb-0"> </pre>
                                    <button type="submit" name="submit" class="btn btn-primary">Submit</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    
                    <?= alertMessage(); ?>

                    <div class="table-responsive">
                        <table class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Invoice</th>
                                    <th>Unit</th>
                                    <th>Tenant</th>
                                    <th>Date</th>
                                    <th>Amount</th>
                                    <th>Payment Method</th>
                                    <th>Reference Number</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                    if(isset($_POST['submit'])){
                                        
                                        $sql = "SELECT p.*, t.fname, t.lname, i.unitID FROM payment p JOIN tenant t ON p.tenantID = t.tenantID JOIN invoice i ON p.invoiceID = i.invoiceID WHERE 1=1";

                                        if($_POST['month'] != 'all'){
                                            $month = $_POST['month'];
                                            $sql .= " AND LOWER(DATE_FORMAT(p.paymentDate, '%M')) = LOWER('$month')";
                                        }

                                        if($_POST['year'] != 'all'){
                                            $year = $_POST['year'];
                                            $sql .= " AND YEAR(p.paymentDate) = '$year'";
                                        }

                                        if($_POST['paymentMethod'] != 'all'){
                                            $paymentMethod = $_POST['paymentMethod'];
                                            $sql .= " AND p.paymentMethod = '$paymentMethod'";
                                        }
    
                                        $result = mysqli_query($conn, $sql);
                                        if(mysqli_num_rows($result) > 0){
                                            while($row = mysqli_fetch_assoc($result)){
                                                echo "<tr>";
                                                echo "<td>".$row['paymentID']."</td>";
                                                echo "<td>".$row['invoiceID']."</td>";
                                                echo "<td>".$row['unitID']."</td>";
                                                echo "<td>".$row['fname'].' '.$row['lname']."</td>";
                                                echo "<td>".$row['paymentDate']."</td>";
                                                echo "<td>".$row['paymentAmount']."</td>";
                                                echo "<td>".$row['paymentMethod']."</td>";
                                                echo "<td>".$row['referenceNum']."</td>";
                                                echo "</tr>";
                                            }
                                        } else {
                                            echo "<tr><td colspan='8'>No records found</td></tr>";
                                        }
                                    }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </form>
            <div class="row">
                <div class="col-md-12">
                    <form action="print/printPayment.php" method="POST" target="_blank">
                        <input type="hidden" name="sort" value="<?php echo (isset($_POST['sort'])) ? $_POST['sort'] : ''; ?>">
                        <input type="hidden" name="month" value="<?php echo (isset($_POST['month'])) ? $_POST['month'] : ''; ?>">
                        <input type="hidden" name="year" value="<?php echo (isset($_POST['year'])) ? $_POST['year'] : ''; ?>">
                        <input type="hidden" name="paymentMethod" value="<?php echo (isset($_POST['paymentMethod'])) ? $_POST['paymentMethod'] : ''; ?>">
                        <div class="row no-print">
                            <div class="col-md-12">
                                <button type="submit" class="btn btn-primary float-end me-3">
                                    <i class="fa fa-print"></i> 
                                    Print
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include('includes/footer.php') ?>