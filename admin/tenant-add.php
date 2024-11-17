<?php include('includes/header.php') ?>

    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h5 class="font-weight-bolder">
                        Add Tenant
                        <a href="tenant.php" class="btn btn-danger float-end">
                            <i class="fa fa-angle-left"></i>
                            Back
                        </a>
                    </h5>
                </div>
                <div class="card-body">

                    <?= alertMessage(); ?>

                    <form action="adminCode.php" method="post">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label for="">First Name</label>
                                    <input type="text" name="fname" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label for="mname">Middle Name</label>
                                    <input type="text" name="mname" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label for="lname">Last Name</label>
                                    <input type="text" name="lname" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="contact">Contact Number</label>
                                    <input type="text" name="contact" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="email">Email</label>
                                    <input type="email" name="email" class="form-control">
                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="mb-3">
                                    <label for="unit">Unit</label>
                                    <select name="unit" class="form-select">
                                        <?php
                                            $unit = fetchAll('unit');
                                            if (mysqli_num_rows($unit) > 0) {
                                                foreach($unit as $unitItem) {
                                        ?>
                                                    <option value="<?= $unitItem['unitID'] ?>"><?= $unitItem['unitID'] ?></option>
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
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="username">Username</label>
                                    <input type="text" name="username" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="password">Password</label>
                                    <input type="password" name="password" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="mb-3 text-end">
                                    <button type="submit" class="btn btn-primary" name="addTenant">Add Tenant</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

<?php include('includes/footer.php') ?>