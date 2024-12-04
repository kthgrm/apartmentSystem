<?php include('includes/header.php') ?>

    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex justify-content-between align-items-center">
                        <h4 class="font-weight-bolder">Edit Lease</h4>
                        <a href="lease.php" class="btn btn-primary mb-0 float-end">
                            <i class="fa fa-angle-left"></i>
                            Back
                        </a>
                    </div>
                </div>
                <div class="card-body">
                    <?= alertMessage(); ?>
                    <?php

                        $paramResult = checkParamID('id');
                        if(!is_numeric($paramResult)){
                            echo '<h5>'.$paramResult.'</h5>';
                            return false;
                        }

                        $lease = getByIdLease('lease',$paramResult);
                        if($lease){
                            if($lease['status'] == 200){
                    ?>
                                <form action="adminCode.php" method="post">
                                    <div class="row">
                                        <div class="col"></div>
                                        <div class="col-md-6">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="mb-3">
                                                        <label>Lease ID</label>
                                                        <input type="text" name="leaseID" value="<?= $lease['data']['leaseID']; ?>" class="form-control" required>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="mb-3">
                                                        <label>Unit</label>
                                                        <input type="text" name="unitID" value="<?= $lease['data']['unitID']; ?>" class="form-control" required>
                                                    </div>
                                                </div>
                                                <div class="col-md-12">
                                                    <div class="mb-3">
                                                        <label>Tenant</label>
                                                        <select name="tenantID" class="form-control" required>
                                                            <?php
                                                                $tenants = fetchAll('tenant');
                                                                foreach($tenants as $tenant){
                                                                    $selected = ($tenant['tenantID'] == $lease['data']['tenantID']) ? 'selected' : '';
                                                                    echo "<option value='{$tenant['tenantID']}' {$selected}>{$tenant['fname']} {$tenant['lname']}</option>";
                                                                }
                                                            ?>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-md-12">
                                                    <div class="mb-3">
                                                        <label>Start Date</label>
                                                        <input type="date" name="startDate" value="<?= $lease['data']['startDate']; ?>" class="form-control" required>
                                                    </div>
                                                </div>
                                                <div class="col-md-12">
                                                    <div class="mb-3">
                                                        <label>End Date</label>
                                                        <input type="date" name="endDate" value="<?= $lease['data']['endDate']; ?>" class="form-control" required>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col"></div>
                                    </div>
                                    <div class="row">
                                        <div class="col"></div>
                                        <div class="col-md-6">
                                            <div class="mb-3 text-end">
                                                <button type="submit" class="btn btn-primary" name="updateLease" onclick="return confirm('Confirm changes?')">Update Lease</button>
                                            </div>
                                        </div>
                                        <div class="col"></div>
                                    </div>
                                </form>
                        <?php
                                        }else{
                                            echo '<h5>'.$lease['message'].'</h5>';
                                        }
                                    }else{
                                        echo '<h5>'.$lease['message'].'</h5>';
                                    }
                        ?>
                </div>
            </div>
        </div>
    </div>

<?php include('includes/footer.php') ?>