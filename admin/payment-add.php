<?php include('includes/header.php') ?>

<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h4 class="font-weight-bolder">
                    Add Payment
                    <a href="payment.php" class="btn btn-primary float-end">
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
                                <label>Invoice</label>
                                <select name="invoiceID" class="form-control" required>
                                    <?php
                                        $invoices = fetchUnpaidInvoice('invoice');
                                        foreach($invoices as $invoice){
                                            echo "<option value='{$invoice['invoiceID']}'>{$invoice['invoiceID']}</option>";
                                        }
                                    ?>
                                </select>
                            </div>
                        </div>
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
                                <label for="paymentDate">Payment Date</label>
                                <input type="date" name="paymentDate" class="form-control" value="<?= date('Y-m-d'); ?>" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="paymentAmount">Payment Amount</label>
                                <input type="number" name="paymentAmount" class="form-control" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="paymentMethod">Payment Method</label>
                                <select name="paymentMethod" class="form-control" required>
                                    <option value="cash">Cash</option>
                                    <option value="gcash">GCash</option>
                                    <option value="card">Card</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="referenceNum">Reference Number</label>
                                <input type="text" name="referenceNum" class="form-control">
                            </div>
                        </div>
                    </div>
                    <div class="mb-3">
                        <button type="submit" name="addPayment" class="btn btn-primary float-end">
                            <i class="fa fa-plus"></i>
                            Add Payment
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<?php include('includes/footer.php') ?>