<?php include('includes/header.php') ?>

    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col-md-3 col-lg-7">
                            <h4 class="font-weight-bolder">Maintenance Request List</h4>
                        </div>
                        <div class="col-md-9 col-lg-5 text-end">
                            <form method="GET" action="">
                                <div class="row">
                                    <div class="col-md-4 col-lg-4">
                                        <input type="date" name="date" class="form-control" value="<?= isset($_GET['date']) == true ? $_GET['date']:'' ?>">
                                    </div>
                                    <div class="col-md-4 col-lg-4">
                                        <select name="sort" class="form-select">
                                            <option value="">Select Status</option>
                                            <option value="pending" <?php if (isset($_GET['sort']) && $_GET['sort'] == 'pending') echo 'selected'; ?>>Pending</option>
                                            <option value="completed" <?php if (isset($_GET['sort']) && $_GET['sort'] == 'completed') echo 'selected'; ?>>Completed</option>
                                            <option value="declined" <?php if (isset($_GET['sort']) && $_GET['sort'] == 'declined') echo 'selected'; ?>>Declined</option>
                                        </select>
                                    </div>
                                    <div class="col-md-4 col-lg-4">
                                        <button type="submit" class="btn btn-primary">Filter</button>
                                        <a href="maintenance.php" class="btn btn-danger">Reset</a>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    
                    
                </div>
                <div class="card-body">
                    
                    <?= alertMessage(); ?>

                    <?php
                        $query = "SELECT * FROM maintenance JOIN tenant ON maintenance.tenantID = tenant.tenantID";
                        if (isset($_GET['date']) && !empty($_GET['date'])) {
                            $date = validate($_GET['date']);
                            $query .= " WHERE requestDate = '$date'";
                            
                            if(isset($_GET['sort']) && !empty($_GET['sort'])) {
                                $sortOption = validate($_GET['sort']);
                                $query .= " AND requestStatus = '$sortOption'";
                            }
                        } else if(isset($_GET['sort']) && !empty($_GET['sort'])) {
                            $sortOption = validate($_GET['sort']);
                            $query .= " WHERE requestStatus = '$sortOption'";
                        } 
                        
                        $mReq = mysqli_query($conn, $query);

                        if ($mReq) {
                            if (mysqli_num_rows($mReq) > 0) {
                    ?>

                    <div class="table-responsive">
                        <table id="myTable" class="table table-sm table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>Request ID</th>
                                    <th>Tenant</th>
                                    <th>Unit</th>
                                    <th>Date</th>
                                    <th>Description</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                    foreach($mReq as $mReqItem) {
                                ?>
                                        <tr>
                                            <td><?= $mReqItem['requestID']; ?></td>
                                            <td><?= $mReqItem['fname'] . ' ' . $mReqItem['lname']; ?></td>
                                            <td><?= $mReqItem['unitID']; ?></td>
                                            <td><?= $mReqItem['requestDate']; ?></td>
                                            <td><?= $mReqItem['requestDescription']; ?></td>
                                            <td><?= $mReqItem['requestStatus']; ?></td>
                                            <td>
                                                <a href="maintenance-view.php?id=<?= $mReqItem['requestID']; ?>" class="btn mb-0 btn-info btn-sm">View</a>
                                                <a href="maintenance-delete.php?id=<?= $mReqItem['requestID']; ?>" class="btn mb-0 btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this request?')">Delete</a>
                                            </td>
                                        </tr>
                                <?php
                                    }
                                ?>
                            </tbody>
                        </table>
                        <?php
                                } else {
                                    echo '<h5>No Record Found</h5>';
                        }
                            } else {
                                echo '<h5>Something Went Wrong</h5>';
                            }
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>

<?php include('includes/footer.php') ?>