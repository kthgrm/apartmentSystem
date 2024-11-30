<?php include('includes/header.php') ?>

    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <form action="" method="POST">
                    <div class="card-header">
                        <div class="row">
                            <div class="col-md-6">
                                <h3 class="font-weight-bolder">Maintenance Report</h3>
                            </div>
                            <div class="col-md-6">
                                <div class="row">
                                    <div class="col"></div>
                                    <div class="col-md-4 col-lg-3">
                                        <pre class="mb-0 ms-1">Status</pre>
                                        <select name="status" class="form-select" required>
                                            <option value="all">All</option>
                                            <option value="pending" <?= (isset($_POST['status']) && $_POST['status'] == 'pending') ? 'selected' : '' ?>>Pending</option>
                                            <option value="completed" <?= (isset($_POST['status']) && $_POST['status'] == 'completed') ? 'selected' : '' ?>>Completed</option>
                                            <option value="denied" <?= (isset($_POST['status']) && $_POST['status'] == 'denied') ? 'selected' : '' ?>>Denied</option>
                                        </select>
                                    </div>
                                    <div class="col-md-3 col-lg-2">
                                        <pre class="mb-0"> </pre>
                                        <button type="submit" name="submit"class="btn btn-primary">Submit</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        
                    <?= alertMessage(); ?>

                        <div class="table-responsive">
                            <table id="" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Tenant</th>
                                        <th>Unit</th>
                                        <th>Date</th>
                                        <th>Description</th>
                                        <th>Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                        if(isset($_POST['submit'])){
                                            if($_POST['status'] == 'all'){
                                                $sql = "SELECT * FROM maintenance JOIN tenant ON maintenance.tenantID = tenant.tenantID";
                                            }else{
                                                $sql = "SELECT * FROM maintenance JOIN tenant ON maintenance.tenantID = tenant.tenantID WHERE requestStatus = '{$_POST['status']}'";
                                            }
                                            $result = mysqli_query($conn, $sql);
                                            if(mysqli_num_rows($result) > 0){
                                                while($requestItem = mysqli_fetch_assoc($result)){
                                    ?>
                                                    <tr>
                                                        <td><?= $requestItem['requestID']; ?></td>
                                                        <td><?= $requestItem['fname'].' '.$requestItem['lname']; ?></td>
                                                        <td><?= $requestItem['unitID']; ?></td>
                                                        <td><?= $requestItem['requestDate']; ?></td>
                                                        <td><?= $requestItem['requestDescription']; ?></td>
                                                        <td><?= $requestItem['requestStatus']; ?></td>
                                                    </tr>
                                    <?php
                                                }
                                            }
                                        }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </form>
                <div class="row">
                    <div class="col-md-12">
                        <form action="print/printMaintenance.php" method="POST" target="_blank">
                            <input type="hidden" name="status" value="<?php echo (isset($_POST['status'])) ? $_POST['status'] : ''; ?>">
                            <div class="row no-print">
                                <div class="col-md-12">
                                    <button type="submit" class="btn btn-primary float-end me-3">
                                        <i class="fa fa-print"></i> 
                                        Print
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

<?php include('includes/footer.php') ?>