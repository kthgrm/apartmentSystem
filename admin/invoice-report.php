<?php include('includes/header.php') ?>

<div class="row">
    <div class="col-md-12">
        <div class="card">
            <form action="" method="POST">
                <div class="card-header">
                    <div class="row">
                        <div class="col-md-6">
                            <h3 class="font-weight-bolder">Invoice Report</h3>
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
                                    <pre class="mb-0 ms-1">Status</pre>
                                    <select class="form-select" name="sort">
                                        <option value="all" <?= (isset($_POST['sort']) && $_POST['sort'] == 'latest') ? 'selected' : ''; ?>>All</option>
                                        <option value="paid" <?= (isset($_POST['sort']) && $_POST['sort'] == 'paid') ? 'selected' : ''; ?>>Paid</option>
                                        <option value="unpaid" <?= (isset($_POST['sort']) && $_POST['sort'] == 'unpaid') ? 'selected' : ''; ?>>Unpaid</option>
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
                                    <th>Unit</th>
                                    <th>Month</th>
                                    <th>Amount</th>
                                    <th>Issue</th>
                                    <th>Due</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                    if(isset($_POST['submit'])){
                                        $sort = $_POST['sort'];
                                        
                                        $sql = "SELECT * FROM invoice WHERE 1=1";

                                        if($sort != 'all'){
                                            $sql .= " AND paymentStatus = '$sort'";
                                        }

                                        if($_POST['month'] != 'all'){
                                            $month = $_POST['month'];
                                            $sql .= " AND LOWER(monthYear) LIKE LOWER('%$month%')";
                                        }

                                        if($_POST['year'] != 'all'){
                                            $year = $_POST['year'];
                                            $sql .= " AND monthYear LIKE '%$year%'";
                                        }
    
                                        $result = mysqli_query($conn, $sql);
                                        if(mysqli_num_rows($result) > 0){
                                            while($row = mysqli_fetch_assoc($result)){
                                                echo "<tr>";
                                                echo "<td>".$row['invoiceID']."</td>";
                                                echo "<td>".$row['unitID']."</td>";
                                                echo "<td>".$row['monthYear']."</td>";
                                                echo "<td>".$row['rentAmount']."</td>";
                                                echo "<td>".$row['issueDate']."</td>";
                                                echo "<td>".$row['dueDate']."</td>";
                                                echo "<td>".$row['paymentStatus']."</td>";
                                                echo "</tr>";
                                            }
                                        } else {
                                            echo "<tr><td colspan='7'>No records found</td></tr>";
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
                    <form action="print/printInvoice.php" method="POST" target="_blank">
                        <input type="hidden" name="sort" value="<?php echo (isset($_POST['sort'])) ? $_POST['sort'] : ''; ?>">
                        <input type="hidden" name="month" value="<?php echo (isset($_POST['month'])) ? $_POST['month'] : ''; ?>">
                        <input type="hidden" name="year" value="<?php echo (isset($_POST['year'])) ? $_POST['year'] : ''; ?>">
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