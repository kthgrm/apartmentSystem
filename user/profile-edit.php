<?php include('includes/header.php'); ?>
    <?= alertMessage(); ?>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="font-weight-bolder">
                        Edit Profile
                        <a href="profile.php" class="btn btn-primary float-end">
                            <i class="fa fa-angle-left"></i>
                            Back
                        </a>
                    </h4>
                </div>
                <div class="card-body">
                    <?php
                        $paramResult = checkParamID('id');
                        if(!is_numeric($paramResult)){
                            echo "<h5>".$paramResult."</h5>";
                            return false;
                        }

                        $profile = getProfile('tenant',$paramResult);
                        if($profile){
                            if($profile['status'] == 200){
                    ?>
                    
                    <form action="userCode.php" method="post" enctype="multipart/form-data">
                                <div class="row">
                                    <div class="col-md-2 text-center">
                                        <div class="mb-3">
                                            <label>Profile Picture</label>
                                            <br>
                                            <img src="<?php echo '../'.$profile['data']['tenantImage']; ?>" alt="Profile Picture" class="img-fluid img-thumbnail">
                                            <input type="file" name="tenantImage" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-md-10">
                                        <div class="row">
                                            <div class="col-md-4">
                                                <div class="mb-3">
                                                    <label>First Name</label>
                                                    <input type="text" name="fname" class="form-control" value="<?php echo $profile['data']['fname']; ?>">
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="mb-3">
                                                    <label>Middle Name</label>
                                                    <input type="text" name="mname" class="form-control" value="<?php echo $profile['data']['mname']; ?>">
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="mb-3">
                                                    <label>Last Name</label>
                                                    <input type="text" name="lname" class="form-control" value="<?php echo $profile['data']['lname']; ?>">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="mb-3">
                                                    <label>Contact</label>
                                                    <input type="text" name="contact" class="form-control" value="<?php echo $profile['data']['contact']; ?>">
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="mb-3">
                                                    <label>Email</label>
                                                    <input type="text" name="email" class="form-control" value="<?php echo $profile['data']['email']; ?>">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                            <div class="mb-3 text-end">
                                                <button type="submit" class="btn btn-primary" name="btnUpdateProfile" onclick="return confirm('Are you sure you want to submit this maintenance request?')">Update Profile</button>
                                            </div>
                                        </div>
                                </div>

                    <?php
                            }else{
                                echo "<h5>No such data found!</h5>";
                            }
                        }else{
                            echo "<h5>Something Went Wrong!</h5>";
                        }
                    ?>
                    </form>
                </div>
            </div>
        </div>
    </div>

<?php include('includes/footer.php'); ?>