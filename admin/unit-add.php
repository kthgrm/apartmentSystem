<?php include('includes/header.php') ?>

    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="font-weight-bolder">
                        Add Unit
                        <a href="unit.php" class="btn btn-primary float-end">
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
                                    <label for="unitID">Unit Number</label>
                                    <input type="text" name="unitID" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="numOfRoom">Number of Room</label>
                                    <input type="text" name="numOfRoom" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="unitRate">Unit Rate</label>
                                    <input type="text" name="unitRate" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="status">Unit Status</label>
                                    <select name="status" class="form-select">
                                        <option value="vacant">Vacant</option>
                                        <option value="occupied">Occupied</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="mb-3">
                            <button type="submit" name="addUnit" class="btn btn-primary float-end">
                                <i class="fa fa-plus"></i>
                                Add
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

<?php include('includes/footer.php') ?>