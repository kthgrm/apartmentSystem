<?php include('includes/header.php') ?>

    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col-md-6 col-lg-8">
                            <h4 class="font-weight-bolder">Complaint List</h4>
                        </div>
                        <div class="col-md-6 col-lg-4 text-end">
                            <form method="GET" action="">
                                <div class="row">
                                    <div class="col-md-6 col-lg-7">
                                        <input type="date" name="date" class="form-control" value="<?= isset($_GET['date']) == true ? $_GET['date']:'' ?>">
                                    </div>
                                    <div class="col-md-6 col-lg-5">
                                        <button type="submit" class="btn btn-primary">Filter</button>
                                        <a href="complaint.php" class="btn btn-danger">Reset</a>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    
                    
                </div>
                <div class="card-body">
                    
                    <?= alertMessage(); ?>

                    <?php
                        $query = "SELECT * FROM complaint JOIN tenant ON complaint.tenantID = tenant.tenantID";
                        if (isset($_GET['date']) && !empty($_GET['date'])) {
                            $date = validate($_GET['date']);
                            $query .= " WHERE complaintDate = '$date'";
                        }
                        
                        $complaint = mysqli_query($conn, $query);

                        if ($complaint) {
                            if (mysqli_num_rows($complaint) > 0) {
                    ?>

                    <div class="table-responsive">
                        <table id="myTable" class="table table-sm table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>Complaint ID</th>
                                    <th>Tenant</th>
                                    <th>Unit</th>
                                    <th>Date</th>
                                    <th>Subject</th>
                                    <th>Description</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                    foreach($complaint as $complaintItem) {
                                ?>
                                        <tr>
                                            <td><?= $complaintItem['complaintID']; ?></td>
                                            <td><?= $complaintItem['fname'] . ' ' . $complaintItem['lname']; ?></td>
                                            <td><?= $complaintItem['unitID']; ?></td>
                                            <td><?= $complaintItem['complaintDate']; ?></td>
                                            <td><?= $complaintItem['complaintSubject']; ?></td>
                                            <td><?= $complaintItem['complaintDescription']; ?></td>
                                            <td><?= $complaintItem['complaintStatus']; ?></td>
                                            <td>
                                                <a href="complaint-view.php?id=<?= $complaintItem['complaintID']; ?>" class="btn mb-0 btn-info btn-sm">View</a>
                                                <a href="complaint-delete.php?id=<?= $complaintItem['complaintID']; ?>" class="btn mb-0 btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this request?')">Delete</a>
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