<?php include('includes/header.php') ?>

    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <form action="" method="POST">
                    <div class="card-header">
                        <div class="row">
                            <div class="col-md-6">
                                <h3 class="font-weight-bolder">Tenant Report</h3>
                            </div>
                            <div class="col-md-6">
                                <div class="row">
                                    <div class="col"></div>
                                    <div class="col-md-4 col-lg-3">
                                        <pre class="mb-0 ms-1">Unit</pre>
                                        <select name="unit" class="form-select" required>
                                            <option value="all">All</option>
                                            <?php
                                                $unit = fetchAll('unit');
                                                if (mysqli_num_rows($unit) > 0) {
                                                    foreach($unit as $unitItem) {
                                            ?>
                                                        <option value="<?= $unitItem['unitID'] ?>" <?= (isset($_POST['unit']) && $_POST['unit'] == $unitItem['unitID']) ? 'selected' : '' ?>><?= $unitItem['unitID'] ?></option>
                                            <?php
                                                    }
                                                }else{
                                            ?>
                                                    <option value="">No record found</option>
                                            <?php
                                                }
                                            ?>
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
                                        <th>First Name</th>
                                        <th>Middle Name</th>
                                        <th>Last Name</th>
                                        <th>Contact Number</th>
                                        <th>Email</th>
                                        <th>Unit</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                        if(isset($_POST['submit'])){
                                            if($_POST['unit'] == 'all'){
                                                $sql = "SELECT * FROM tenant";
                                            }else{
                                                $sql = "SELECT * FROM tenant WHERE unitID = '{$_POST['unit']}'";
                                            }
                                            $result = mysqli_query($conn, $sql);
                                            if(mysqli_num_rows($result) > 0){
                                                while($tenantItem = mysqli_fetch_assoc($result)){
                                    ?>
                                                    <tr>
                                                        <td><?= $tenantItem['tenantID']; ?></td>
                                                        <td><?= $tenantItem['fname']; ?></td>
                                                        <td><?= $tenantItem['mname']; ?></td>
                                                        <td><?= $tenantItem['lname']; ?></td>
                                                        <td><?= $tenantItem['contact']; ?></td>
                                                        <td><?= $tenantItem['email']; ?></td>
                                                        <td><?= $tenantItem['unitID']; ?></td>
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
                        <form action="print/printTenant.php" method="POST" target="_blank">
                            <input type="hidden" name="unit" value="<?php echo (isset($_POST['unit'])) ? $_POST['unit'] : ''; ?>">
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