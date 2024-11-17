<?php include('includes/header.php') ?>

    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex justify-content-between align-items-center">
                        <h4 class="font-weight-bolder">View Request</h4>
                        <a href="maintenance.php" class="btn btn-primary mb-0 float-end">
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

                        $maintenance = getByIdJoinTenant('maintenance',$paramResult);
                        if($maintenance){
                            if($maintenance['status'] == 200){
                    ?>
                                <div class="table-responsive">
                                    <table class="table table-sm table-bordered table-striped">
                                        <tbody>
                                            <tr>
                                                <th style="width: 30%;">Maintenance ID</th>
                                                <td><?= $maintenance['data']['requestID'] ?></td>
                                            </tr>
                                            <tr>
                                                <th style="width: 30%;">Tenant</th>
                                                <td><?= $maintenance['data']['fname'].' '.$maintenance['data']['lname'] ?></td>
                                            </tr>
                                            <tr>
                                                <th style="width: 30%;">Unit</th>
                                                <td><?= $maintenance['data']['unitID'] ?></td>
                                            </tr>
                                            <tr>
                                                <th style="width: 30%;">Date</th>
                                                <td><?= $maintenance['data']['requestDate'] ?></td>
                                            </tr>
                                            <tr>
                                                <th style="width: 30%;">Description</th>
                                                <td><?= $maintenance['data']['requestDescription'] ?></td>
                                            </tr>
                                            <tr>
                                                <th style="width: 30%;">Status</th>
                                                <td><?= $maintenance['data']['requestStatus'] ?></td>
                                            </tr>
                                        </tbody>
                                    </table>    
                                </div>
                                <div class="mt-3">
                                    <div class="card border card-body">
                                        <form action="adminCode.php" method="post">
                                            <input type="hidden" name="requestID" value="<?= $maintenance['data']['requestID'];?>">
                                            <div class="row">
                                                <label>Update Status</label>
                                                <div class="col-md-4">
                                                    <select name="status" class="form-select">
                                                        <option value="pending" <?= $maintenance['data']['requestStatus'] == 'pending' ? 'selected' : ''; ?>>Pending</option>
                                                        <option value="completed" <?= $maintenance['data']['requestStatus'] == 'completed' ? 'selected' : ''; ?>>Completed</option>
                                                        <option value="declined" <?= $maintenance['data']['requestStatus'] == 'declined' ? 'selected' : ''; ?>>Declined</option>
                                                    </select>
                                                </div>
                                                <div class="col-md-8">
                                                    <button type="submit" name="updateRequestStatus" class="btn btn-primary">Update</button>
                                                </div>
                                            </div>
                                        </form>
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

<?php include('includes/footer.php') ?>