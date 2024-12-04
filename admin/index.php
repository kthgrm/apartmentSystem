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

<?php
    // Fetch total payment
    $totalPaymentQuery = "SELECT SUM(paymentAmount) as totalPayment FROM payment JOIN invoice ON payment.invoiceID = invoice.invoiceID";
    $totalPaymentResult = mysqli_query($conn, $totalPaymentQuery);
    $totalPaymentRow = mysqli_fetch_assoc($totalPaymentResult);
    $totalPayment = $totalPaymentRow['totalPayment'] ? $totalPaymentRow['totalPayment'] : 0;

    // Fetch payment per month
    $monthlyPaymentQuery = "SELECT monthYear as month, SUM(paymentAmount) as monthlyPayment FROM payment JOIN invoice ON payment.invoiceID = invoice.invoiceID WHERE paymentStatus = 'paid' GROUP BY monthYear ORDER BY STR_TO_DATE(monthYear, '%M %Y')";
    $monthlyPaymentResult = mysqli_query($conn, $monthlyPaymentQuery);

    $months = [];
    $monthlyPayments = [];

    while ($row = mysqli_fetch_assoc($monthlyPaymentResult)) {
        $months[] = $row['month'];
        $monthlyPayments[] = $row['monthlyPayment'];
    }

    // Prepare data for Chart.js
    $data = [
        'totalPayment' => $totalPayment,
        'months' => $months,
        'monthlyPayments' => $monthlyPayments
    ];

    // Encode the data as JSON to pass it to JavaScript
    echo '<script>const paymentData = ' . json_encode($data) . ';</script>';
?>

<?php
// Fetch rent collection percentage
$currentMonthYear = date('F Y');
$paidInvoicesQuery = "SELECT COUNT(*) as paidInvoices FROM invoice WHERE paymentStatus = 'paid' AND monthYear = '$currentMonthYear'";
$paidInvoicesResult = mysqli_query($conn, $paidInvoicesQuery);
$paidInvoicesRow = mysqli_fetch_assoc($paidInvoicesResult);
$paidInvoices = $paidInvoicesRow['paidInvoices'] ? $paidInvoicesRow['paidInvoices'] : 0;

$totalInvoicesQuery = "SELECT COUNT(*) as totalInvoices FROM invoice WHERE monthYear = '$currentMonthYear'";
$totalInvoicesResult = mysqli_query($conn, $totalInvoicesQuery);
$totalInvoicesRow = mysqli_fetch_assoc($totalInvoicesResult);
$totalInvoices = $totalInvoicesRow['totalInvoices'] ? $totalInvoicesRow['totalInvoices'] : 0;

$rentCollectionPercentage = $totalInvoices > 0 ? ($paidInvoices / $totalInvoices) * 100 : 0;

// Prepare data for Chart.js
$data = [
    'paidInvoices' => $paidInvoices,
    'totalInvoices' => $totalInvoices,
    'rentCollectionPercentage' => $rentCollectionPercentage
];

// Encode the data as JSON to pass it to JavaScript
echo '<script>const collectionData = ' . json_encode($data) . ';</script>';
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
                        <div class="col-md-3 mb-4">
                            <div class="card card-body p3 border">
                                <p class="text-sm mb-0 text-capitalize font-weight-bold">Total Tenants</p>
                                <h5 class="font-weight-bolder mb-0">
                                    <?= getCount('tenant') ?>
                                </h5>
                            </div>
                        </div>
                        <div class="col-md-3 mb-4">
                            <div class="card card-body p3 border">
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
                        
                        <div class="col-md-3 mb-4">
                            <div class="card card-body p3 border">
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
                        <div class="col-md-3 mb-4">
                            <div class="card card-body p3 border">
                                <p class="text-sm mb-0 text-capitalize font-weight-bold">Overdue</p>
                                <h5 class="font-weight-bolder mb-0">  
                                    <?php
                                        $query = "SELECT * FROM invoice WHERE paymentStatus = 'overdue'";
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
                            <div class="card card-body border">
                                <p class="text-sm mb-3 font-weight-bold">Rent Collection</p>
                                <h5 class="font-weight-bolder mb-3">
                                    <?php echo $paidInvoices . ' / ' . $totalInvoices; ?>
                                </h5>
                                <canvas id="rentCollectionChart" width="200" height="222"></canvas>
                            </div>
                        </div>
                        <div class="col-md-6 mb-4">
                            <div class="card card-body border">
                                <p class="text-sm mb-0 font-weight-bold">Total Payment</p>
                                <h5 class="font-weight-bolder mb-0">
                                    <?php echo $totalPayment; ?>
                                </h5>
                                <canvas id="paymentChart" width="400" height="217"></canvas>
                            </div>
                        </div>
                        <div class="col-md-3 mb-4">
                            <div class="card card-body text-center border">
                                <p class="text-sm mb-0 font-weight-bold">UNITS</p>
                                <canvas id="unitsChart" width="60" height="60"></canvas>
                                <p>
                                    <span class="text-sm mb-0 font-weight-bold">Available Units: </span><strong id="availableUnits"></strong><br>
                                    <span class="text-sm mb-0 font-weight-bold">Occupied Units: </span><strong id="occupiedUnits"></strong><br>
                                    <span class="text-sm mb-0 font-weight-bold">Total Units: </span><strong id="totalUnits"></strong>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include('includes/footer.php'); ?>