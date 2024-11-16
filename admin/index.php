<?php include('includes/header.php') ?>

    <div class="row">
        <div class="col-md-2 mb4">
            <div class="card card-body p3">
                <p class="text-sm mb-0 text-capitalize font-weight-bold">Units</p>
                <h5 class="font-weight-bolder mb-0">
                    <?php
                        $unit = fetchAll('unit');
                        echo mysqli_num_rows($unit);
                    ?>
                </h5>
            </div>
        </div>

        <div class="col-md-2 mb4">
            <div class="card card-body p3">
                <p class="text-sm mb-0 text-capitalize font-weight-bold">Tenants</p>
                <h5 class="font-weight-bolder mb-0">
                <?php
                        $tenant = fetchAll('tenant');
                        echo mysqli_num_rows($tenant);
                    ?>
                </h5>
            </div>
        </div>

        <div class="col-md-2 mb4">
            <div class="card card-body p3">
                <p class="text-sm mb-0 text-capitalize font-weight-bold">Maintenance Request</p>
                <h5 class="font-weight-bolder mb-0">10</h5><!-- Fetch from database -->
            </div>
        </div>
    </div>
    
<?php include('includes/footer.php') ?>