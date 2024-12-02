<?php include('includes/header.php') ?>

    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="font-weight-bolder">
                        Invoice
                        <a href="invoice-generate.php" class="btn btn-primary float-end">
                            <i class="fa fa-user-plus"></i>
                            Generate Invoice
                        </a>
                    </h4>
                </div>
                <div class="card-body">
                    
                <?= alertMessage(); ?>

                    <div class="table-responsive">
                        <table id="myTable" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Unit</th>
                                    <th>Month Year</th>
                                    <th>Amount</th>
                                    <th>Issued</th>
                                    <th>Due</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                    $invoice = fetchAll('invoice');
                                    if (mysqli_num_rows($invoice) > 0) {
                                        foreach($invoice as $invoiceItem) {
                                ?>
                                            <tr>
                                                <td><?= $invoiceItem['invoiceID']; ?></td>
                                                <td><?= $invoiceItem['unitID']; ?></td>
                                                <td><?= $invoiceItem['monthYear']; ?></td>
                                                <td><?= $invoiceItem['rentAmount']; ?></td>
                                                <td><?= $invoiceItem['issueDate']; ?></td>
                                                <td><?= $invoiceItem['dueDate']; ?></td>
                                                <td><?= $invoiceItem['paymentStatus']; ?></td>
                                                <td>
                                                    <a href="tenant-edit.php?id=<?= $tenantItem['tenantID']; ?>" class="btn mb-0 btn-success btn-sm">Edit</a>
                                                    <a href="tenant-delete.php?id=<?= $tenantItem['tenantID']; ?>" class="btn mb-0 btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this data?')">Delete</a>
                                                </td>
                                            </tr>
                                <?php
                                        }
                                    }else{
                                ?>

                                        <tr>
                                            <td colspan="8" class="text-center">No record found</td>
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