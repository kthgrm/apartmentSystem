<?php include('includes/header.php') ?>

    <div class="row">
        <div class="col-md-2 mb4">
            <div class="card">
                <div class="card-header">
                    <h4>Website Settings</h4>
                </div>
                <div class="cardbody">
                    <form action="adminCode.php" method="post">
                        <div class="mb-3">
                            <label>Title</label>
                            <input type="text" class="form-control" name="siteName">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    
<?php include('includes/footer.php') ?>