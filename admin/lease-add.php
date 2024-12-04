<?php include('includes/header.php') ?>

<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h4 class="font-weight-bolder">
                    Add Lease
                    <a href="lease.php" class="btn btn-primary float-end">
                        <i class="fa fa-angle-left"></i>
                        Back
                    </a>
                </h4>
            </div>
            <div class="card-body">
                <?= alertMessage(); ?>
                <form action="adminCode.php" method="post">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label>Tenant</label>
                                <select name="tenantID" class="form-control" required>
                                    <?php
                                        $tenants = fetchAll('tenant');
                                        foreach($tenants as $tenant){
                                            echo "<option value='{$tenant['tenantID']}'>{$tenant['fname']} {$tenant['lname']}</option>";
                                        }
                                    ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="unitID">Unit ID</label>
                                <select name="unitID" class="form-control" required>
                                    <?php
                                    $units = fetchAll('unit');
                                    foreach ($units as $unit) {
                                        echo "<option value='{$unit['unitID']}'>{$unit['unitID']}</option>";
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="leaseStartDate">Lease Start Date</label>
                                <input type="date" name="leaseStartDate" class="form-control" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="leaseEndDate">Lease End Date</label>
                                <input type="date" name="leaseEndDate" class="form-control" required>
                            </div>
                        </div>
                    </div>
                    <div class="mb-3">
                        <button type="submit" name="addLease" class="btn btn-primary float-end">
                            <i class="fa fa-plus"></i>
                            Add Lease
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<?php include('includes/footer.php') ?>