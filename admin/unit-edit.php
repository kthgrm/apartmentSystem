<?php include('includes/header.php') ?>

    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <?php
                        $paramResult = checkParamID('id');
                    ?>
                    <h4 class="font-weight-bolder">
                        Edit Unit
                        <a href="unit-view.php?id=<?= $paramResult ?>" class="btn btn-primary float-end">
                            <i class="fa fa-angle-left"></i>
                            Back
                        </a>
                    </h4>
                </div>
                <div class="card-body">
                    <?= alertMessage(); ?>
                    <?php
                        if(!is_numeric($paramResult)){
                            echo '<h5>'.$paramResult.'</h5>';
                            return false;
                        }

                        $unit = getByIdUnit('unit',$paramResult);
                        if($unit){
                            if($unit['status'] == 200){
                    ?>
                    
                                <form action="adminCode.php" method="post">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="unitID">Unit Number</label>
                                                <input type="text" name="unitID" class="form-control" value="<?= $unit['data']['unitID']; ?>">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="numOfRoom">Number of Room</label>
                                                <input type="text" name="numOfRoom" class="form-control" value="<?= $unit['data']['numOfRoom']; ?>">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="unitRate">Unit Rate</label>
                                                <input type="text" name="unitRate" class="form-control" value="<?= $unit['data']['unitRate']; ?>">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="status">Unit Status</label>
                                                <select name="status" class="form-select">
                                                    <option value="vacant" <?= $unit['data']['status'] == 'vacant' ? 'selected' : ''; ?>>Vacant</option>
                                                    <option value="occupied" <?= $unit['data']['status'] == 'occupied' ? 'selected' : ''; ?>>Occupied</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="mb-3">
                                        <button type="submit" name="editUnit" class="btn btn-primary float-end">
                                            <i class="fa fa-floppy-disk"></i>
                                            Save
                                        </button>
                                    </div>
                                </form>
                    <?php
                            }else{
                                echo '<h5>'.$unit['message'].'</h5>';
                            }
                        }
                    ?>
                </div>
            </div>
        </div>
    </div>

<?php include('includes/footer.php') ?>