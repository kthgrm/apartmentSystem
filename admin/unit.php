<?php include('includes/header.php'); ?>

    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="font-weight-bolder">
                        Unit List
                        <a href="unit-add.php" class="btn btn-primary float-end">
                            <i class="fa fa-plus"></i>
                            Add Unit
                        </a>
                    </h4>
                </div>

                <div class="card-body">
                    <?= alertMessage(); ?>
                    <div class="row">
                        
                <?php
                        $unit = fetchAll('unit');
                        if (mysqli_num_rows($unit) > 0) {
                            foreach($unit as $unitItem) {
                ?>

                            <div class="col-md-4 col-lg-3 mb-4">
                                <div class="card card-body text-center">
                                    <a href="unit-view.php?id=<?= $unitItem['unitID']; ?>">
                                        <i class="fa fa-5x fa-building mb-2"></i>
                                        <br>
                                        <p class="text-sm mb-0 text-capitalize font-weight-bold">Unit</p>
                                        <h5 class="font-weight-bolder mb-0">
                                            <?= $unitItem['unitID'] ?>
                                        </h5>
                                    </a>
                                </div>
                            </div>
                <?php
                            }
                        }else{
                ?>
                            <div class="col-md-12">
                                <div class="alert alert-danger">
                                    No record found
                                </div>
                            </div> 
                <?php
                        }
                ?> 
                    </div>
                </div>
            </div>
        </div>
    </div>

<?php include('includes/footer.php'); ?>