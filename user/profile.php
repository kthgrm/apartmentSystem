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

                                $query = "SELECT * FROM user JOIN tenant ON user.userID = tenant.tenantID WHERE userID = ?";
                                $stmt = $conn->prepare($query);
                                $stmt->bind_param("i", $userID);
                                $stmt->execute();
                                $result = $stmt->get_result();
                                $user = $result->fetch_assoc();

                                $name = $user['fname'].' '.$user['mname'].' '.$user['lname'];
                                $contact = $user['contact'];
                                $email = $user['email'];
                                $unit = $user['unitID'];
                                $_SESSION['unit'] = $user['unitID'];
                            }
                        ?>
                        <a href="profile-edit.php?id=<?php echo $userID; ?>" class="btn btn-primary float-end">
                            <i class="fa fa-edit"></i>
                            Edit
                        </a>
                    </h4>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col"></div>
                        <div class="col-md-6 col-lg-5 text-center mb-2">
                            <img src="<?php echo '../'.$user['tenantImage']; ?>" alt="Profile Picture" class="img-fluid img-thumbnail" style="border-radius:50%;max-width:275px">
                        </div>
                        <div class="col"></div>
                    </div>
                    <div class="row mb-2">
                        <div class="col"></div>
                        <div class="col-md-6 col-lg-5">
                            <h5 class="font-weight-bolder">Name</h5>
                            <p class="border rounded p-2"><?php echo $name; ?></p>
                        </div>
                        <div class="col"></div>
                    </div>
                    <div class="row mb-2">
                        <div class="col"></div>
                        <div class="col-md-6 col-lg-5">
                            <h5 class="font-weight-bolder">Contact Number</h5>
                            <p class="border rounded p-2"><?php echo $contact; ?></p>
                        </div>
                        <div class="col"></div>
                    </div>
                    <div class="row mb-2">
                        <div class="col"></div>
                        <div class="col-md-6 col-lg-5">
                            <h5 class="font-weight-bolder">Email</h5>
                            <p class="border rounded p-2"><?php echo $email; ?></p>
                        </div>
                        <div class="col"></div>
                    </div>
                    <div class="row mb-2">
                        <div class="col"></div>
                        <div class="col-md-6 col-lg-5">
                            <h5 class="font-weight-bolder">Unit Number</h5>
                            <p class="border rounded p-2"><?php echo $unit; ?></p>
                        </div>
                        <div class="col"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>

<?php include('includes/footer.php'); ?>