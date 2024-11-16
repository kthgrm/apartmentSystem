<?php include('includes/header.php') ?>

    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="font-weight-bolder">
                        Tenant List
                        <a href="tenant-add.php" class="btn btn-primary float-end">
                            <i class="fa fa-user-plus"></i>
                            Add Tenant
                        </a>
                    </h4>
                </div>
                <div class="card-body">
                    
                <?= alertMessage(); ?>

                    <div class="table-responsive">
                        <table class="table table-sm table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>First Name</th>
                                    <th>Middle Name</th>
                                    <th>Last Name</th>
                                    <th>Contact Number</th>
                                    <th>Email</th>
                                    <th>Unit</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                    $tenant = fetchAll('tenant');
                                    if (mysqli_num_rows($tenant) > 0) {
                                        foreach($tenant as $tenantItem) {
                                ?>
                                            <tr>
                                                <td><?= $tenantItem['tenantID']; ?></td>
                                                <td><?= $tenantItem['fname']; ?></td>
                                                <td><?= $tenantItem['mname']; ?></td>
                                                <td><?= $tenantItem['lname']; ?></td>
                                                <td><?= $tenantItem['contact']; ?></td>
                                                <td><?= $tenantItem['email']; ?></td>
                                                <td><?= $tenantItem['unitID']; ?></td>
                                                <td>
                                                    <a href="tenant-edit.php?id=<?= $tenantItem['tenantID']; ?>" class="btn btn-success btn-sm">Edit</a>
                                                    <a href="tenant-delete.php?id=<?= $tenantItem['tenantID']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this data?')">Delete</a>
                                                </td>
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