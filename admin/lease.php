<?php include('includes/header.php') ?>

    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="font-weight-bolder">
                        Lease
                        <a href="tenant-add.php" class="btn btn-primary float-end">
                            <i class="fa fa-plus"></i>
                            Add Lease
                        </a>
                    </h4>
                </div>
                <div class="card-body">
                    
                <?= alertMessage(); ?>

                    <div class="table-responsive">
                        <table id="myTable" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Person In Contact</th>
                                    <th>Unit</th>
                                    <th>Start Date</th>
                                    <th>End Date</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                    $lease = fetchLeaseTenant('lease');
                                    if (mysqli_num_rows($lease) > 0) {
                                        foreach($lease as $leaseItem) {
                                ?>
                                            <tr>
                                                <td><?= $leaseItem['leaseID']; ?></td>
                                                <td><?= $leaseItem['fname'].' '.$leaseItem['lname']; ?></td>
                                                <td><?= $leaseItem['unitID']; ?></td>
                                                <td><?= $leaseItem['startDate']; ?></td>
                                                <td><?= $leaseItem['endDate']; ?></td>
                                                <td>
                                                    <a href="tenant-edit.php?id=<?= $leaseItem['leaseID']; ?>" class="btn mb-0 btn-success btn-sm">Edit</a>
                                                    <a href="tenant-delete.php?id=<?= $leaseItem['leaseID']; ?>" class="btn mb-0 btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this data?')">Delete</a>
                                                </td>
                                            </tr>
                                <?php
                                        }
                                    }else{
                                ?>

                                        <tr>
                                            <td colspan="5" class="text-center">No record found</td>
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