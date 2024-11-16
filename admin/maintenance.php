<?php include('includes/header.php') ?>

    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="font-weight-bolder">
                        Maintenance Request List
                        <a href="tenant-add.php" class="btn btn-primary float-end">
                            <i class="fa fa-user-plus"></i>
                            Add Request
                        </a>
                        <form method="GET" class="float-end me-3 col-md-2">
                            <select name="sort" class="form-select form-select-m" onchange="this.form.submit()">
                                <option value="" <?php if (!isset($_GET['sort']) || $_GET['sort'] == '') echo 'selected'; ?>>Sort</option>
                                <option value="pending" <?php if (isset($_GET['sort']) && $_GET['sort'] == 'pending') echo 'selected'; ?>>Pending</option>
                                <option value="approved" <?php if (isset($_GET['sort']) && $_GET['sort'] == 'approved') echo 'selected'; ?>>Approved</option>
                                <option value="declined" <?php if (isset($_GET['sort']) && $_GET['sort'] == 'declined') echo 'selected'; ?>>Declined</option>
                            </select>
                        </form>
                    </h4>
                </div>
                <div class="card-body">
                    
                <?= alertMessage(); ?>

                    <div class="table-responsive">
                        <table class="table table-sm table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>Request ID</th>
                                    <th>Tenant</th>
                                    <th>Unit</th>
                                    <th>Date</th>
                                    <th>Description</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                    $sortOption = isset($_GET['sort']) ? $_GET['sort'] : '';
                                    $query = "SELECT * FROM maintenance";
                                    $query .= " JOIN tenant ON maintenance.tenantID = tenant.tenantID";
                                    switch ($sortOption) {
                                        case 'pending':
                                            $query .= " WHERE requestStatus = 'pending'";
                                            break;
                                        case 'approved':
                                            $query .= " WHERE requestStatus = 'approved'";
                                            break;
                                        case 'declined':
                                            $query .= " WHERE requestStatus = 'declined'";
                                            break;
                                        default:
                                            $query .= " ORDER BY requestDate DESC";
                                            break;
                                    }

                                    $mReq = mysqli_query($conn, $query);

                                    // Check for errors
                                    if (!$mReq) {
                                        die('Query Failed: ' . mysqli_error($conn));
                                    }

                                    if (mysqli_num_rows($mReq) > 0) {
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
                                                    <?php if ($mReqItem['requestStatus'] == 'pending') { ?>
                                                        <a href="maintenance-approve.php?id=<?= $mReqItem['requestID']; ?>" class="btn btn-success btn-sm" onclick="return confirm('Are you sure you want to approve the request?')">Approve</a>
                                                        <a href="maintenance-decline.php?id=<?= $mReqItem['requestID']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to decline the request?')">Decline</a>
                                                    <?php } ?>
                                                </td>
                                            </tr>
                                <?php
                                        }
                                    } else {
                                ?>
                                        <tr>
                                            <td colspan="7" class="text-center">No record found</td>
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