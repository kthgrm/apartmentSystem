<?php include('includes/header.php') ?>

    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h5 class="font-weight-bolder">
                        Edit Tenant
                        <a href="tenant.php" class="btn btn-danger float-end">
                            <i class="fa fa-angle-left"></i>
                            Back
                        </a>
                    </h5>
                </div>
                <div class="card-body">
                    <?php
                        $paramResult = checkParamID('id');
                        if(!is_numeric($paramResult)){
                            echo '<h5>'.$paramResult.'</h5>';
                            return false;
                        }

                        $tenantID = getByID('tenant',$paramResult);
                        if($tenantID['status'] == 200){
                    ?>
                        <form action="adminCode.php" method="post" enctype="multipart/form-data">
                            
                                    <input type="hidden" name="tenantID" value="<?= $tenantID['data']['tenantID']; ?>">
                                    <div class="row">
                                        <div class="col-md-3">
                                            <div class="col-md-12">
                                                <div class="mb-3">
                                                    <label>Picture</label>
                                                    <br>
                                                    <?php if (!empty($tenantID['data']['tenantImage']) && file_exists('../'.$tenantID['data']['tenantImage'])): ?>
                                                        <img src="<?php echo '../'.$tenantID['data']['tenantImage']; ?>" alt="Profile Picture" class="img-fluid img-thumbnail">
                                                    <?php else: ?>
                                                        <p>No picture available.</p>
                                                    <?php endif; ?>
                                                </div>
                                                <div class="mb-3">
                                                    <input type="file" name="tenantImage" class="form-control">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-9">
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <div class="mb-3">
                                                        <label for="">First Name</label>
                                                        <input type="text" name="fname" value="<?= $tenantID['data']['fname']; ?>" class="form-control" required>
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="mb-3">
                                                        <label for="mname">Middle Name</label>
                                                        <input type="text" name="mname" value="<?= $tenantID['data']['mname']; ?>" class="form-control" required>
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="mb-3">
                                                        <label for="lname">Last Name</label>
                                                        <input type="text" name="lname" value="<?= $tenantID['data']['lname']; ?>" class="form-control" required>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-5">
                                                    <div class="mb-3">
                                                        <label for="contact">Contact Number</label>
                                                        <input type="text" name="contact" value="<?= $tenantID['data']['contact']; ?>" class="form-control" required>
                                                    </div>
                                                </div>
                                                <div class="col-md-5">
                                                    <div class="mb-3">
                                                        <label for="email">Email</label>
                                                        <input type="email" name="email" value="<?= $tenantID['data']['email']; ?>" class="form-control" required>
                                                    </div>
                                                </div>
                                                <div class="col-md-2">
                                                    <div class="mb-3">
                                                        <label for="unit">Unit</label>
                                                        <input type="hidden" name="prevUnit" value="<?= $tenantID['data']['unitID']; ?>">
                                                        <select name="unit" class="form-select" required>
                                                            <?php
                                                                $unit = fetchAll('unit');
                                                                if (mysqli_num_rows($unit) > 0) {
                                                                    foreach($unit as $unitItem) {
                                                            ?>
                                                                        <option value="<?= $unitItem['unitID'] ?>" <?= $tenantID['data']['unitID'] == $unitItem['unitID'] ? 'selected' : '' ?>><?= $unitItem['unitID'] ?></option>
                                                            <?php
                                                                    }
                                                                }else{
                                                            ?>
                                                                    <option value="">No record found</option>
                                                            <?php
                                                                }
                                                            ?>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="mb-3">
                                                        <label for="username">Username</label>
                                                        <input type="text" name="username" value="<?= $tenantID['data']['username']; ?>" class="form-control" required>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="mb-3">
                                                        <label for="password">Password</label>
                                                        <input type="password" name="password" value="<?= $tenantID['data']['password']; ?>" class="form-control" required>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="col-md-12">
                                        <div class="mb-3 text-end">
                                            <button type="submit" class="btn btn-primary" name="updateTenant" onclick="return confirm('Confirm changes?')">Update Tenant</button>
                                        </div>
                                    </div>
                    <?php
                                    $tenantData = $tenantID['data'];
                                }else{
                                    echo '<h5>'.$tenantID['message'].'</h5>';
                                }
                    ?>
                        </form>
                </div>
            </div>
        </div>
    </div>

<?php include('includes/footer.php') ?>