<?php include('includes/header.php'); ?>
    <?= alertMessage(); ?>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="font-weight-bolder">
                        Profile
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
                        <a href="profile-edit.php?id=<?php echo $userID; ?>" class="btn btn-danger float-end">
                            <i class="fa fa-edit"></i>
                            Edit
                        </a>
                    </h4>
                </div>
                <div class="card-body">
                    
                    
                </div>
            </div>
        </div>
    </div>

<?php include('includes/footer.php'); ?>