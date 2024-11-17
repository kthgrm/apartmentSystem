<?php include('includes/header.php') ?>

    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="font-weight-bolder">
                        Request History
                        <a href="maintenance.php" class="btn btn-primary float-end">
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
                                    <th>Request ID</th>
                                    <th>Date</th>
                                    <th>Description</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                    $request = fetchAll('maintenance');
                                    if (mysqli_num_rows($request) > 0) {
                                        foreach($request as $requestItem){ 
                                ?>
                                            <tr>
                                                <td><?= $requestItem['requestID']; ?></td>
                                                <td><?= $requestItem['requestDate']; ?></td>
                                                <td><?= $requestItem['requestDescription']; ?></td>
                                                <td><?= $requestItem['requestStatus']; ?></td>
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