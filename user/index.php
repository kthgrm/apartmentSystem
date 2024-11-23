<?php include('includes/header.php'); ?>
    
    <?= alertMessage(); ?>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="font-weight-bolder">Home</h4>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="card border">
                                <div class="card-header pb-0">
                                    <h5>Next Billing Date</h5>
                                </div>
                                <div class="card-body py-0">
                                    <?php
                                        $nextBillingDate = date("Y-m-t");
                                        echo "<p>".$nextBillingDate."</p>";
                                    ?>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                </div>
            </div>
        </div>
    </div>

<?php include('includes/footer.php'); ?>