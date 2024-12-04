<?php include('includes/header.php') ?>

    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex justify-content-between align-items-center">
                        <h4 class="font-weight-bolder">Edit Invoice</h4>
                        <a href="invoice.php" class="btn btn-primary mb-0 float-end">
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

                        $invoice = getByIdInvoice('invoice',$paramResult);
                        if($invoice){
                            if($invoice['status'] == 200){
                    ?>
                                <form action="adminCode.php" method="post">
                                    <div class="row">
                                        <div class="col"></div>
                                        <div class="col-md-6">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="mb-3">
                                                        <label>Invoice ID</label>
                                                        <input type="text" name="invoiceID" value="<?= $invoice['data']['invoiceID']; ?>" class="form-control" required>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="mb-3">
                                                        <label>Unit</label>
                                                        <input type="text" name="unitID" value="<?= $invoice['data']['unitID']; ?>" class="form-control" required>
                                                    </div>
                                                </div>
                                                <div class="col-md-12">
                                                    <div class="mb-3">
                                                        <label>Month</label>
                                                        <input type="text" name="monthYear" value="<?= $invoice['data']['monthYear']; ?>" class="form-control" required>
                                                    </div>
                                                </div>
                                                <div class="col-md-12">
                                                    <div class="mb-3">
                                                        <label>Amount</label>
                                                        <input type="number" name="rentAmount" value="<?= $invoice['data']['rentAmount']; ?>" class="form-control" required>
                                                    </div>
                                                </div>
                                                <div class="col-md-12">
                                                    <div class="mb-3">
                                                        <label>Issue</label>
                                                        <input type="date" name="issueDate" value="<?= $invoice['data']['issueDate']; ?>" class="form-control" required>
                                                    </div>
                                                </div>
                                                <div class="col-md-12">
                                                    <div class="mb-3">
                                                        <label>Due</label>
                                                        <input type="date" name="dueDate" value="<?= $invoice['data']['dueDate']; ?>" class="form-control" required>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="mb-3">
                                                        <label for="paymentStatus">Status</label>
                                                        <select name="paymentStatus" class="form-select" required>
                                                            <option value="unpaid" <?= $invoice['data']['paymentStatus'] == 'unpaid' ? 'selected' : '' ?>>Unpaid</option>
                                                            <option value="paid" <?= $invoice['data']['paymentStatus'] == 'paid' ? 'selected' : '' ?>>Paid</option>
                                                            <option value="overdue" <?= $invoice['data']['paymentStatus'] == 'overdue' ? 'selected' : '' ?>>Overdue</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col"></div>
                                    </div>
                                    <div class="row">
                                        <div class="col"></div>
                                        <div class="col-md-6">
                                            <div class="mb-3 text-end">
                                                <button type="submit" class="btn btn-primary" name="updateInvoice" onclick="return confirm('Confirm changes?')">Update Invoice</button>
                                            </div>
                                        </div>
                                        <div class="col"></div>
                                    </div>
                                    
                                </form>
                        <?php
                                        }else{
                                            echo '<h5>'.$invoice['message'].'</h5>';
                                        }
                                    }else{
                                        echo '<h5>'.$invoice['message'].'</h5>';
                                    }
                        ?>
                </div>
            </div>
        </div>
    </div>

<?php include('includes/footer.php') ?>