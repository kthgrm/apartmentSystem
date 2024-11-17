<?php include('includes/header.php') ?>

    <?= alertMessage(); ?>
    
    <div class="row">
        <div class="col-md-3 mb-4">
            <div class="card card-body p3">
                <p class="text-sm mb-0 text-capitalize font-weight-bold">Total Units</p>
                <h5 class="font-weight-bolder mb-0">
                    <?= getCount('unit') ?>
                </h5>
            </div>
        </div>

        <div class="col-md-3 mb-4">
            <div class="card card-body p3">
                <p class="text-sm mb-0 text-capitalize font-weight-bold">Total Tenants</p>
                <h5 class="font-weight-bolder mb-0">
                    <?= getCount('tenant') ?>
                </h5>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-3 mb-4">
            <div class="card card-body p3">
                <p class="text-sm mb-0 text-capitalize font-weight-bold">Total Request</p>
                <h5 class="font-weight-bolder mb-0">
                    <?= getCount('maintenance') ?>
                </h5>
            </div>
        </div>
        
        <div class="col-md-3 mb-4">
            <div class="card card-body p3">
                <p class="text-sm mb-0 text-capitalize font-weight-bold">Pending Request</p>
                <h5 class="font-weight-bolder mb-0">
                    <?php
                        $query = "SELECT * FROM maintenance WHERE requestStatus = 'pending'";
                        $result = mysqli_query($conn, $query);
                        $totalCount = mysqli_num_rows($result);
                        echo '<h5 class="font-weight-bolder mb-0">'.$totalCount.'</h5>';
                    ?>
                </h5>
            </div>
        </div>
    </div>
    
<?php include('includes/footer.php') ?>