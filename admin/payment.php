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
                                        <input type="date" name="date" class="form-control" value="<?= isset($_GET['date']) == true ? $_GET['date']:'' ?>">
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
                        $query = "SELECT * FROM payment JOIN tenant ON payment.tenantID = tenant.tenantID";
                        if (isset($_GET['date']) && !empty($_GET['date'])) {
                            $date = validate($_GET['date']);
                            $query .= " WHERE paymentDate = '$date'";
                        }
                        
                        $complaint = mysqli_query($conn, $query);

                        if ($complaint) {
                            if (mysqli_num_rows($complaint) > 0) {
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
                                    $payment = fetchPaymentJoinTenant('payment');
                                    if (mysqli_num_rows($payment) > 0) {
                                        foreach($payment as $paymentItem) {
                                ?>
                                            <tr>
                                                <td><?= $paymentItem['paymentID']; ?></td>
                                                <td><?= $paymentItem['invoiceID']; ?></td>
                                                <td><?= $paymentItem['fname'].' '. $paymentItem['lname']; ?></td>
                                                <td><?= $paymentItem['unitID']; ?></td>
                                                <td><?= $paymentItem['paymentDate']; ?></td>
                                                <td><?= $paymentItem['paymentAmount']; ?></td>
                                                <td><?= $paymentItem['paymentMethod']; ?></td>
                                                <td><?= $paymentItem['referenceNum']; ?></td>
                                                <td>
                                                    <a href="payment-view.php?id=<?= $paymentItem['paymentID']; ?>" class="btn mb-0 btn-info btn-sm">View</a>
                                                </td>
                                            </tr>
                                <?php
                                        }
                                    }else{
                                ?>

                                        <tr>
                                            <td colspan="8" class="text-center">No record found</td>
                                        </tr>
                                        <?php
                                    }
                                ?>
                            </tbody>
                        </table>
                        <?php
                                } else {
                                    echo '<h5>No Record Found</h5>';
                        }
                            } else {
                                echo '<h5>Something Went Wrong</h5>';
                            }
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>

<?php include('includes/footer.php') ?>