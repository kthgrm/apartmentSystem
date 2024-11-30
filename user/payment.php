<?php include('includes/header.php'); ?>

<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h4 class="font-weight-bolder">Payment</h4>
            </div>
            <div class="card-body">
                <?= alertMessage(); ?>
                <?php
                    if (isset($_SESSION['loggedInUser']['userID'])) {
                        $userID = $_SESSION['loggedInUser']['userID'];

                        $query = "SELECT * FROM user JOIN tenant ON user.userID = tenant.tenantID JOIN unit ON tenant.unitID = unit.unitID WHERE userID = ?";
                        $stmt = $conn->prepare($query);
                        $stmt->bind_param("i", $userID);
                        $stmt->execute();
                        $result = $stmt->get_result();
                        $user = $result->fetch_assoc();

                        $name = $user['fname'].' '.$user['mname'].' '.$user['lname'];
                        $contact = $user['contact'];
                        $email = $user['email'];
                        $unit = $user['unitID'];
                        $rate = $user['unitRate'];
                        $_SESSION['unit'] = $user['unitID'];
                    }
                ?>
                <div class="row">
                    <div class="col-md-12">
                        
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <div class="card border shadow p-3">
                        <h5 class="font-weight-bolder">Pending Invoices</h5>
                            <?php
                                // Fetch pending invoices from the database
                                $query = "SELECT * FROM invoice WHERE paymentStatus = 'unpaid' AND unitID = '$unit'";
                                $result = mysqli_query($conn, $query);

                                if(mysqli_num_rows($result) > 0) {
                                    while($invoice = mysqli_fetch_assoc($result)) {
                                        $unitID = $invoice['unitID'];
                                        $rentAmount = $invoice['rentAmount'];
                                        $invoiceID = $invoice['invoiceID'];
                                        $month = $invoice['monthYear'];
                                        $issueDate = $invoice['issueDate'];
                                        $dueDate = $invoice['dueDate'];
                            ?>
                            <form action="pay.php" method="post">
                                <div class="row">
                                    <input type="text" name="unitID" class="form-control" value="<?php echo $unitID; ?>" hidden>
                                    <input type="text" name="invoiceID" class="form-control" value="<?php echo $invoiceID; ?>" hidden>
                                    <div class="col-md-6 mb-3">
                                        <label>Month Of</label>
                                        <input type="text" name="month" class="form-control" value="<?php echo $month; ?>" readonly>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label>Issue Date</label>
                                        <input type="text" name="issueDate" class="form-control" value="<?php echo $issueDate; ?>" readonly>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label>Due Date</label>
                                        <input type="text" name="dueDate" class="form-control" value="<?php echo $dueDate; ?>" readonly>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label>Rent Amount</label>
                                        <input type="text" name="rentAmount" class="form-control" value="<?php echo $rentAmount; ?>" readonly>
                                    </div>
                                </div>
                                <input type="hidden" name="invoiceID" value="<?php echo $invoiceID; ?>">
                                <div class="col-md-12">
                                    <button type="submit" name="btnPay" class="btn btn-primary">Pay</button>
                                </div>
                            </form>
                            <?php
                                    }
                                } else {
                                    echo "<p>No pending invoices found.</p>";
                                }
                            ?>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="card border shadow p-3 mb-3">
                            <h5 class="font-weight-bolder">Payment History</h5>
                            <div class="table-responsive">
                                <table class="table table-bordered ">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Amount</th>
                                            <th>Date</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                            $payment = getByIdInvoicePayment($unit);
                                            if (mysqli_num_rows($payment) > 0) {
                                                foreach($payment as $paymentItem){
                                        ?>
                                                    <tr>
                                                        <td><?= $paymentItem['paymentID']; ?></td>
                                                        <td><?= $paymentItem['paymentAmount']; ?></td>
                                                        <td><?= $paymentItem['paymentDate']; ?></td>
                                                    </tr>
                                        <?php
                                                }
                                            }else{
                                        ?>
                                                <tr>
                                                    <td colspan="3" class="text-center">No record found</td>
                                                </tr>
                                        <?php
                                            }
                                        ?>
                                    </tbody>
                                </table>
                            </div>
                            
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include('includes/footer.php'); ?>