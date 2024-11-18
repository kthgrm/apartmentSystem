<?php include('includes/header.php') ?>

    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex justify-content-between align-items-center">
                        <h4 class="font-weight-bolder">Complaint Details</h4>
                        <a href="complaint.php" class="btn btn-primary mb-0 float-end">
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

                        $complaint = getByIdComplaintJoinTenant('complaint',$paramResult);
                        if($complaint){
                            if($complaint['status'] == 200){
                    ?>
                                <div class="table-responsive">
                                    <table class="table table-sm table-bordered table-striped">
                                        <tbody>
                                            <tr>
                                                <th style="width: 30%;">Complaint ID</th>
                                                <td><?= $complaint['data']['complaintID'] ?></td>
                                            </tr>
                                            <tr>
                                                <th style="width: 30%;">Tenant</th>
                                                <td><?= $complaint['data']['fname'].' '.$complaint['data']['lname'] ?></td>
                                            </tr>
                                            <tr>
                                                <th style="width: 30%;">Unit</th>
                                                <td><?= $complaint['data']['unitID'] ?></td>
                                            </tr>
                                            <tr>
                                                <th style="width: 30%;">Date</th>
                                                <td><?= $complaint['data']['complaintDate'] ?></td>
                                            </tr>
                                            <tr>
                                                <th style="width: 30%;">Subject</th>
                                                <td><?= $complaint['data']['complaintSubject'] ?></td>
                                            </tr>
                                            <tr>
                                                <th style="width: 30%;">Description</th>
                                                <td><?= $complaint['data']['complaintDescription'] ?></td>
                                            </tr>
                                            <tr>
                                                <th style="width: 30%;">Status</th>
                                                <td><?= $complaint['data']['complaintStatus'] ?></td>
                                            </tr>
                                        </tbody>
                                    </table>    
                                </div>
                                <div class="mt-3">
                                    <div class="card border card-body">
                                        <form action="adminCode.php" method="post">
                                            <input type="hidden" name="complaintID" value="<?= $complaint['data']['complaintID'];?>">
                                            <div class="row">
                                                <label>Update Status</label>
                                                <div class="col-md-4">
                                                    <select name="status" class="form-select">
                                                        <option value="pending" <?= $complaint['data']['complaintStatus'] == 'pending' ? 'selected' : ''; ?>>Pending</option>
                                                        <option value="in progress" <?= $complaint['data']['complaintStatus'] == 'in progress' ? 'selected' : ''; ?>>In Progress</option>
                                                        <option value="resolved" <?= $complaint['data']['complaintStatus'] == 'resolved' ? 'selected' : ''; ?>>Resolved</option>
                                                        <option value="invalid" <?= $complaint['data']['complaintStatus'] == 'invalid' ? 'selected' : ''; ?>>Invalid</option>
                                                    </select>
                                                </div>
                                                <div class="col-md-8">
                                                    <button type="submit" name="updateComplaintStatus" class="btn btn-primary">Update</button>
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