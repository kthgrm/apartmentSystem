<?php include('includes/header.php'); ?>

    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="font-weight-bolder">
                        Unit Details
                        <a href="unit-edit.php?id=<?= $_GET['id']; ?>" class="btn btn-primary float-end">
                            <i class="fa fa-edit"></i>
                            Edit Unit
                        </a>
                        <a href="unit.php" class="btn btn-danger float-end mx-2">
                            <i class="fa fa-angle-left"></i>
                            Back
                        </a>
                    </h4>
                </div>
                <div class="card-body">
                    <?php
                        $paramResult = checkParamID('id');
                        if(!is_numeric($paramResult)){
                            echo '<h5>'.$paramResult.'</h5>';
                            return false;
                        }

                        $unit = getByIdUnit('unit',$paramResult);
                        if($unit){
                            if($unit['status'] == 200){
                    ?>
                                <div class="row">
                                    <div class="col-md-6">
                                        <h5 class="font-weight-bolder">Unit Information</h5>
                                        <div class="card border card-body">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <label>Unit Number</label>
                                                    <p><?= $unit['data']['unitID']; ?></p>
                                                </div>
                                                <div class="col-md-6">
                                                    <label>Unit Status</label>
                                                    <p><?= $unit['data']['status']; ?></p>
                                                </div>
                                                <div class="col-md-6">
                                                    <label>Number of Room</label>
                                                    <p><?= $unit['data']['numOfRoom']; ?></p>
                                                </div>
                                                <div class="col-md-6">
                                                    <label>Unit Rate</label>
                                                    <p><?= $unit['data']['unitRate']; ?></p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <h5 class="font-weight-bolder">Tenants</h5>
                                        <div class="card border card-body">
                                            <?php 
                                                $tenant = fetchUnitTenant($paramResult);
                                                if (mysqli_num_rows($tenant) > 0) {
                                                    foreach($tenant as $tenantItem) {
                                            ?>
                                                        <div class="row my-2">
                                                            <div class="col-md-5 col-lg-4">
                                                                <?php if (!empty($tenantItem['tenantImage']) && file_exists('../'.$tenantItem['tenantImage'])): ?>
                                                                    <img src="<?php echo '../'.$tenantItem['tenantImage']; ?>" alt="Profile Picture" class="img-fluid img-thumbnail">
                                                                <?php else: ?>
                                                                    <p>No picture available.</p>
                                                                <?php endif; ?>
                                                            </div>
                                                            <div class="col-md-7">
                                                                <div class="col-md-12">
                                                                    <label>Name</label>
                                                                    <p><?= $tenantItem['fname'].' '.$tenantItem['lname']; ?></p>
                                                                </div>
                                                                <div class="col-md-12">
                                                                    <label>Phone Number</label>
                                                                    <p><?= $tenantItem['contact']; ?></p>
                                                                </div>
                                                                <div class="col-md-12">
                                                                    <label>Email</label>
                                                                    <p><?= $tenantItem['email']; ?></p>
                                                                </div>
                                                            </div>
                                                            
                                                        </div>
                                            <?php
                                                    }
                                                }else{
                                            ?>
                                                    <h5>No Tenant Found</h5>
                                            <?php
                                                }
                                            ?>
                                        </div>
                                    </div>
                                </div>
                    <?php
                            }else{
                                echo '<h5>No Record Found</h5>';
                            }
                        }
                    ?>
                </div>
            </div>
        </div>
    </div>

<?php include('includes/footer.php'); ?>