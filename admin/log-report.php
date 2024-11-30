<?php include('includes/header.php') ?>

<div class="row">
    <div class="col-md-12">
        <div class="card">
            <form action="" method="POST">
                <div class="card-header">
                    <div class="row">
                        <div class="col-md-6">
                            <h3 class="font-weight-bolder">Log Report</h3>
                        </div>
                        <div class="col-md-6">
                            <div class="row">
                                <div class="col"></div>
                                <div class="col-md-4 col-lg-3">
                                    <pre class="mb-0 ms-1">Role</pre>
                                    <select class="form-select" name="type">
                                        <option value="all" <?= (isset($_POST['type']) && $_POST['type'] == 'all') ? 'selected' : ''; ?>>All</option>
                                        <option value="admin" <?= (isset($_POST['type']) && $_POST['type'] == 'admin') ? 'selected' : ''; ?>>Admin</option>
                                        <option value="tenant" <?= (isset($_POST['type']) && $_POST['type'] == 'tenant') ? 'selected' : ''; ?>>Tenant</option>
                                    </select>
                                </div>
                                <div class="col-md-4 col-lg-3">
                                    <pre class="mb-0 ms-1">Sort By</pre>
                                    <select class="form-select" name="sort">
                                        <option value="latest" <?= (isset($_POST['sort']) && $_POST['sort'] == 'latest') ? 'selected' : ''; ?>>Latest</option>
                                        <option value="oldest" <?= (isset($_POST['sort']) && $_POST['sort'] == 'oldest') ? 'selected' : ''; ?>>Oldest</option>
                                    </select>
                                </div>
                                <div class="col-md-3 col-lg-2">
                                    <pre class="mb-0"> </pre>
                                    <button type="submit" name="submit" class="btn btn-primary">Submit</button>
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
                                    <th>Name</th>
                                    <th>Date</th>
                                    <th>Role</th>
                                    <th>Log Type</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                    if(isset($_POST['submit'])){
                                        $type = strtolower($_POST['type']);
                                        $sort = isset($_POST['sort']) ? strtolower($_POST['sort']) : 'latest';
                                        $orderBy = $sort == 'oldest' ? 'ASC' : 'DESC';

                                        if($type == 'all'){
                                            $sql = "SELECT * FROM (
                                                        SELECT l.logDateTime, CONCAT(a.fname, ' ', a.lname) AS name, 'admin' AS role, l.logType
                                                        FROM log l
                                                        JOIN admin a ON l.userID = a.adminID
                                                        UNION
                                                        SELECT l.logDateTime, CONCAT(t.fname, ' ', t.lname) AS name, 'tenant' AS role, l.logType
                                                        FROM log l
                                                        JOIN tenant t ON l.userID = t.tenantID
                                                    ) AS combined_logs
                                                    ORDER BY logDateTime $orderBy";
                                        } elseif($type == 'admin'){
                                            $sql = "SELECT l.logDateTime, CONCAT(a.fname, ' ', a.lname) AS name, 'admin' AS role, l.logType
                                                    FROM log l
                                                    JOIN admin a ON l.userID = a.adminID
                                                    ORDER BY l.logDateTime $orderBy";
                                        } elseif($type == 'tenant'){
                                            $sql = "SELECT l.logDateTime, CONCAT(t.fname, ' ', t.lname) AS name, 'tenant' AS role, l.logType
                                                    FROM log l
                                                    JOIN tenant t ON l.userID = t.tenantID
                                                    ORDER BY l.logDateTime $orderBy";
                                        }

                                        $result = mysqli_query($conn, $sql);
                                        if(mysqli_num_rows($result) > 0){
                                            while($row = mysqli_fetch_assoc($result)){
                                                echo "<tr>";
                                                echo "<td>".$row['name']."</td>";
                                                echo "<td>".$row['logDateTime']."</td>";
                                                echo "<td>".$row['role']."</td>";
                                                echo "<td>".$row['logType']."</td>";
                                                echo "</tr>";
                                            }
                                        } else {
                                            echo "<tr><td colspan='4'>No records found</td></tr>";
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
                        <input type="hidden" name="sort" value="<?php echo (isset($_POST['sort'])) ? $_POST['sort'] : ''; ?>">
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