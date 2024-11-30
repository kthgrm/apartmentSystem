<?php include('includes/header.php') ?>

    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex justify-content-between align-items-center">
                        <h4 class="font-weight-bolder">Payment Details</h4>
                        <a href="payment.php" class="btn btn-primary mb-0 float-end">
                            <i class="fa fa-angle-left"></i>
                            Back
                        </a>
                    </div>
                </div>
                <div class="card-body">
                    <?= alertMessage(); ?>
                    <?php

                        $paramResult = checkParamID('id');
                        if(!is_numeric($paramResult)){
                            echo '<h5>'.$paramResult.'</h5>';
                            return false;
                        }

                        $payment = getByIdPaymentJoinTenant('payment',$paramResult);
                        if($payment){
                            if($payment['status'] == 200){
                    ?>
                                <div class="table-responsive">
                                    <table class="table table-sm table-bordered table-striped">
                                        <tbody>
                                            <tr>
                                                <th style="width: 30%;">Payment ID</th>
                                                <td><?= $payment['data']['paymentID'] ?></td>
                                            </tr>
                                            <tr>
                                                <th style="width: 30%;">Tenant</th>
                                                <td><?= $payment['data']['fname'].' '.$payment['data']['lname'] ?></td>
                                            </tr>
                                            <tr>
                                                <th style="width: 30%;">Unit</th>
                                                <td><?= $payment['data']['unitID'] ?></td>
                                            </tr>
                                            <tr>
                                                <th style="width: 30%;">Date</th>
                                                <td><?= $payment['data']['paymentDate'] ?></td>
                                            </tr>
                                            <tr>
                                                <th style="width: 30%;">Amount</th>
                                                <td><?= $payment['data']['paymentAmount'] ?></td>
                                            </tr>
                                            <tr>
                                                <th style="width: 30%;">Payment Method</th>
                                                <td><?= $payment['data']['paymentMethod'] ?></td>
                                            </tr>
                                            <tr>
                                                <th style="width: 30%;">Reference Number</th>
                                                <td><?= $payment['data']['referenceNum'] ?></td>
                                            </tr>
                                        </tbody>
                                    </table>    
                                </div>
                    <?php
                            }else{
                                echo '<h5>No Record Found</h5>';
                            }
                        }
                    ?>
                </div>
            </div>
        </div>
    </div>

<?php include('includes/footer.php') ?>