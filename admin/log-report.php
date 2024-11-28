<?php include('includes/header.php') ?>

<div class="row">
    <div class="col-md-12">
        <div class="card">
            <form action="" method="POST">
                <div class="card-header">
                    <div class="row">
                        <div class="col-md-6">
                            <h3 class="font-weight-bolder">User Log</h3>
                        </div>
                        <div class="col-md-6">
                            <div class="row">
                                <div class="col"></div>
                                <div class="col-md-4 col-lg-3">
                                    <pre class="mb-0 ms-1">Role</pre>
                                    <select class="form-select" name="type">
                                        <option value="all">All</option>
                                        <option value="admin">Admin</option>
                                        <option value="tenant">Tenant</option>
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
                        <table id="myTable" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Date</th>
                                    <th>Role</th>
                                    <th>Log Type</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                    if(isset($_POST['submit'])){
                                        if(strtolower($_POST['type']) == 'all'){
                                            $sql = "SELECT * FROM log l, admin a WHERE l.userID = a.adminID";
                                            $result = mysqli_query($conn, $sql);

                                            if(mysqli_num_rows($result) > 0){
                                                while($logItem = mysqli_fetch_assoc($result)){
                                ?>
                                                    <tr>
                                                        <td><?= $logItem['fname']. ' '.$logItem['lname']; ?></td>
                                                        <td><?= $logItem['logDateTime']; ?></td>
                                                        <td><?= $logItem['type']; ?></td>
                                                        <td><?= $logItem['logType']; ?></td>
                                                    </tr>
                                <?php
                                                }
                                            }

                                            $sql = "SELECT * FROM log l, tenant t WHERE l.userID = t.tenantId";
                                            $result = mysqli_query($conn, $sql);

                                            if(mysqli_num_rows($result) > 0){
                                                while($logItem = mysqli_fetch_assoc($result)){
                                ?>
                                                    <tr>
                                                        <td><?= $logItem['fname']. ' '.$logItem['lname']; ?></td>
                                                        <td><?= $logItem['logDateTime']; ?></td>
                                                        <td><?= $logItem['type']; ?></td>
                                                        <td><?= $logItem['logType']; ?></td>
                                                    </tr>
                                <?php
                                                }
                                            }
                                        }else{
                                            if(strtolower($_POST['type']) == 'admin'){
                                                $sql = "SELECT * FROM log l, admin a WHERE l.userID = a.adminID AND type LIKE '%" .strtolower($_POST['type']). "%'";
                                                $result = mysqli_query($conn, $sql);

                                                if(mysqli_num_rows($result) > 0){
                                                    while($logItem = mysqli_fetch_assoc($result)){
                                ?>
                                                        <tr>
                                                            <td><?= $logItem['fname']. ' '.$logItem['lname']; ?></td>
                                                            <td><?= $logItem['logDateTime']; ?></td>
                                                            <td><?= $logItem['type']; ?></td>
                                                            <td><?= $logItem['logType']; ?></td>
                                                        </tr>
                                <?php
                                                    }
                                                }
                                            }else{
                                                $sql = "SELECT * FROM log l, tenant t WHERE l.userID = t.tenantId AND type LIKE '%" .strtolower($_POST['type']). "%'";
                                                $result = mysqli_query($conn, $sql);

                                                if(mysqli_num_rows($result) > 0){
                                                    while($logItem = mysqli_fetch_assoc($result)){
                                ?>
                                                        <tr>
                                                            <td><?= $logItem['fname']. ' '.$logItem['lname']; ?></td>
                                                            <td><?= $logItem['logDateTime']; ?></td>
                                                            <td><?= $logItem['type']; ?></td>
                                                            <td><?= $logItem['logType']; ?></td>
                                                        </tr>
                                <?php
                                                    }
                                                }
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
                    <form action="print/printLogs.php" method="POST" target="_blank">
                        <input type="hidden" name="type" value="<?php echo (isset($_POST['type'])) ? $_POST['type'] : ''; ?>">
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