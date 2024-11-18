<?php include('includes/header.php') ?>

    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="font-weight-bolder">
                        Complaint History
                        <a href="complaint.php" class="btn btn-primary float-end">
                            <i class="fa fa-angle-left"></i>
                            Back
                        </a>
                    </h4>
                </div>
                <div class="card-body">
                    
                <?= alertMessage(); ?>

                    <div class="table-responsive">
                        <table class="table table-sm table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>Complaint ID</th>
                                    <th>Date</th>
                                    <th>Subject</th>
                                    <th>Description</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                    $userID = $_GET['id'];
                                    $complaint = getByIdComplaint($userID);
                                    if (mysqli_num_rows($complaint) > 0) {
                                        foreach($complaint as $complaintItem){ 
                                ?>
                                            <tr>
                                                <td><?= $complaintItem['complaintID']; ?></td>
                                                <td><?= $complaintItem['complaintDate']; ?></td>
                                                <td><?= $complaintItem['complaintSubject']; ?></td>
                                                <td><?= $complaintItem['complaintDescription']; ?></td>
                                                <td><?= $complaintItem['complaintStatus']; ?></td>
                                            </tr>
                                <?php
                                        }
                                    }else{
                                ?>
                                        <tr>
                                            <td colspan="7" class="text-center">No record found</td>
                                        </tr>
                                        <?php
                                    }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

<?php include('includes/footer.php') ?>