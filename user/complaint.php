<?php include('includes/header.php'); ?>
    <?= alertMessage(); ?>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="font-weight-bolder">
                        Complaint Form
                        <?php
                            if (isset($_SESSION['loggedInUser']['userID'])) {
                                $userID = $_SESSION['loggedInUser']['userID'];

                                $query = "SELECT fname, lname, unitID FROM user JOIN tenant ON user.userID = tenant.tenantID WHERE userID = ?";
                                $stmt = $conn->prepare($query);
                                $stmt->bind_param("i", $userID);
                                $stmt->execute();
                                $result = $stmt->get_result();
                                $user = $result->fetch_assoc();

                                $name = $user['fname'].' '.$user['lname'];
                                $_SESSION['unit'] = $user['unitID'];
                            }
                        ?>
                        <a href="complaint-history.php?id=<?php echo $userID; ?>" class="btn btn-danger float-end">
                            <i class="fa fa-history"></i>
                            History
                        </a>
                    </h4>
                </div>
                <div class="card-body">
                    <form action="userCode.php" method="post">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label>Name</label>
                                    <input type="text" name="name" class="form-control" value="<?php echo htmlspecialchars($name); ?>" disabled>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label>Unit</label>
                                    <input type="text" name="unit" class="form-control" value="<?php echo htmlspecialchars($_SESSION['unit']); ?>" disabled>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label>Date</label>
                                    <input type="text" name="compDate" class="form-control" value="<?php echo date('Y-m-d'); ?>" disabled>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="mb-3">
                                    <label>Subject</label>
                                    <input type="text" name="compSubject" class="form-control" required>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="mb-3">
                                    <label>Description of the Issue</label>
                                    <textarea name="compDesc" class="form-control" rows="10" required></textarea>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="mb-3 text-end">
                                    <button type="submit" class="btn btn-primary" name="btnComplain" onclick="return confirm('Are you sure you want to submit complain?')">Submit Complain</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

<?php include('includes/footer.php'); ?>