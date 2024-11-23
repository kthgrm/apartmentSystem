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
                        <div class="col-md-6">
                            <div class="card border shadow p-3">
                                <h5 class="font-weight-bolder">Payment History
                                    TEST TABLE
                                </h5>
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th>Date</th>
                                            <th>Amount</th>
                                            <th>Status</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>2021-09-01</td>
                                            <td>₱ 1,000.00</td>
                                            <td>PAID</td>
                                        </tr>
                                        <tr>
                                            <td>2021-08-01</td>
                                            <td>₱ 1,000.00</td>
                                            <td>PAID</td>
                                        </tr>
                                        <tr>
                                            <td>2021-07-01</td>
                                            <td>₱ 1,000.00</td>
                                            <td>PAID</td>
                                        </tr>
                                        <tr>
                                            <td>2021-06-01</td>
                                            <td>₱ 1,000.00</td>
                                            <td>PAID</td>
                                        </tr>
                                        <tr>
                                            <td>2021-05-01</td>
                                            <td>₱ 1,000.00</td>
                                            <td>PAID</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="card border shadow p-3">
                                <h5 class="font-weight-bolder">Make Payment</h5>
                                <form action="pay.php" method="post">
                                    <div class="row">
                                        <div class="col-md-6 mb-3">
                                            <label>Unit Number</label>
                                            <input type="text" name="unitID" class="form-control" value="<?php echo $unit ?>" readonly>
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <label>Unit Rate</label>
                                            <input type="text" name="unitRate" class="form-control" value="<?php echo $rate ?>" readonly>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <button type="submit" name="btnPay" class="btn btn-primary">Pay</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

<?php include('includes/footer.php'); ?>