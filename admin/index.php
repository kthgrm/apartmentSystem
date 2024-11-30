<?php 

    include('includes/header.php'); 

    $totalUnitsQuery = "SELECT COUNT(*) as totalUnits FROM unit";
    $occupiedUnitsQuery = "SELECT COUNT(*) as occupiedUnits FROM unit WHERE status = 'occupied'";

    $totalUnitsResult = mysqli_query($conn, $totalUnitsQuery);
    $occupiedUnitsResult = mysqli_query($conn, $occupiedUnitsQuery);

    $totalUnits = mysqli_fetch_assoc($totalUnitsResult)['totalUnits'];
    $occupiedUnits = mysqli_fetch_assoc($occupiedUnitsResult)['occupiedUnits'];
    $availableUnits = $totalUnits - $occupiedUnits;

    // Prepare data for the frontend
    $data = [
        'totalUnits' => $totalUnits,
        'occupiedUnits' => $occupiedUnits,
        'availableUnits' => $availableUnits
    ];

    // Encode the data as JSON to pass it to JavaScript
    echo '<script>const unitData = ' . json_encode($data) . ';</script>';
?>

<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h4 class="font-weight-bolder">Dashboard</h4>
            </div>
            <div class="card-body">
                <?= alertMessage(); ?>
                <div class="row">
                    <div class="col-md-9">
                        <div class="row">
                            <div class="col-md-4 mb-4">
                                <div class="card card-body p3">
                                    <p class="text-sm mb-0 text-capitalize font-weight-bold">Total Tenants</p>
                                    <h5 class="font-weight-bolder mb-0">
                                        <?= getCount('tenant') ?>
                                    </h5>
                                </div>
                            </div>
                            <div class="col-md-4 mb-4">
                                <div class="card card-body p3">
                                    <p class="text-sm mb-0 text-capitalize font-weight-bold">Total Request</p>
                                    <h5 class="font-weight-bolder mb-0">
                                        <?= getCount('maintenance') ?>
                                    </h5>
                                </div>
                            </div>
                            
                            <div class="col-md-4 mb-4">
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
                        <div class="row">
                            <div class="col-md-3 mb-4">
                                <div class="card card-body p3">
                                    <p class="text-sm mb-0 text-capitalize font-weight-bold">Total Complaint</p>
                                    <h5 class="font-weight-bolder mb-0">
                                        <?= getCount('complaint') ?>
                                    </h5>
                                </div>
                            </div>
                            
                            <div class="col-md-3 mb-4">
                                <div class="card card-body p3">
                                    <p class="text-sm mb-0 text-capitalize font-weight-bold">Pending Complaint</p>
                                    <h5 class="font-weight-bolder mb-0">
                                        <?php
                                            $query = "SELECT * FROM complaint WHERE complaintStatus = 'pending'";
                                            $result = mysqli_query($conn, $query);
                                            $totalCount = mysqli_num_rows($result);
                                            echo '<h5 class="font-weight-bolder mb-0">'.$totalCount.'</h5>';
                                        ?>
                                    </h5>
                                </div>
                            </div>
                            <div class="col-md-6 mb-4">
                                <div class="card card-body p3">
                                    <p class="text-sm mb-0 text-capitalize font-weight-bold">Total Payment This Month</p>
                                    <h5 class="font-weight-bolder mb-0">
                                        <?php
                                            $query = "SELECT SUM(paymentAmount) as totalPayment FROM payment WHERE MONTH(paymentDate) = MONTH(CURRENT_DATE()) AND YEAR(paymentDate) = YEAR(CURRENT_DATE())";
                                            $result = mysqli_query($conn, $query);
                                            $row = mysqli_fetch_assoc($result);
                                            $totalPayment = $row['totalPayment'] ? $row['totalPayment'] : 0;
                                            echo '<h5 class="font-weight-bolder mb-0">'.$totalPayment.'</h5>';
                                        ?>
                                    </h5>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="col-md-3 col-lg-3 mb-4">
                        <div class="card card-body p3 text-center border">
                            <h5>UNITS</h5>
                            <canvas id="unitsChart" width="200" height="200"></canvas>
                            <p>
                                <strong>Available Units: </strong><span id="availableUnits"></span><br>
                                <strong>Total Units: </strong><span id="totalUnits"></span><br>
                                <strong>Occupied Units: </strong><span id="occupiedUnits"></span>
                            </p>
                        </div>
                    </div>
                </div>
                <div class="row">
                    
                </div>
            </div>
        </div>
    </div>
</div>

<?php include('includes/footer.php'); ?>