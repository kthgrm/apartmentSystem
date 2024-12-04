<?php include('includes/header.php') ?>

    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col-md-6 col-lg-8">
                            <h4 class="font-weight-bolder">Payment List</h4>
                        </div>
                        <div class="col-md-6 col-lg-4 text-end">
                            <form action="" method="GET">
                                <div class="row">
                                    <div class="col-md-6 col-lg-7">
                                        <input type="date" name="date" class="form-control" value="<?= isset($_GET['date']) ? $_GET['date'] : '' ?>">
                                    </div>
                                    <div class="col-md-6 col-lg-5">
                                        <button type="submit" class="btn btn-primary">Filter</button>
                                        <a href="payment.php" class="btn btn-danger">Reset</a>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    
                    <?= alertMessage(); ?>
                    <?php
                        $query = "SELECT payment.*, tenant.fname, tenant.lname, tenant.unitID FROM payment JOIN tenant ON payment.tenantID = tenant.tenantID";
                        if (isset($_GET['date']) && !empty($_GET['date'])) {
                            $date = validate($_GET['date']);
                            $query .= " WHERE paymentDate = '$date'";
                        }
                        
                        $result = mysqli_query($conn, $query);

                        if ($result) {
                            if (mysqli_num_rows($result) > 0) {
                    ?>

                    <div class="table-responsive">
                        <table id="myTable" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Invoice</th>
                                    <th>Tenant</th>
                                    <th>Unit</th>
                                    <th>Date</th>
                                    <th>Amount</th>
                                    <th>Payment Method</th>
                                    <th>Reference Number</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                    while ($row = mysqli_fetch_assoc($result)) {
                                ?>
                                            <tr>
                                                <td><?= $row['paymentID']; ?></td>
                                                <td><?= $row['invoiceID']; ?></td>
                                                <td><?= $row['fname'] . ' ' . $row['lname']; ?></td>
                                                <td><?= $row['unitID']; ?></td>
                                                <td><?= $row['paymentDate']; ?></td>
                                                <td><?= $row['paymentAmount']; ?></td>
                                                <td><?= $row['paymentMethod']; ?></td>
                                                <td><?= $row['referenceNum']; ?></td>
                                                <td>
                                                <a href="payment-view.php?id=<?= $row['paymentID']; ?>" class="btn mb-0 btn-info btn-sm">View</a>
                                                </td>
                                            </tr>
                                <?php
                                        }
                                    } else {
                                        echo "<div class='alert alert-warning'>No payments found for the selected date.</div>";
                                    }
                                } else {
                                    echo "<div class='alert alert-danger'>Error executing query: " . mysqli_error($conn) . "</div>";
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

<?php include('includes/footer.php') ?>