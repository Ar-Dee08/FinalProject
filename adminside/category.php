<?php
session_start();
include 'admin_middleware.php';
include 'includes/header.php';

?>

<!-- CONTENTS -->

<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h2>
                    Modify Category
                </h2>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <label for="">
                            Category Name
                        </label>
                        <input type="text" name="catname" placeholder="Enter Category Name" class="form-control">
                    </div>
                    <div class="col-md-1">
                        <label for="">
                            ID
                        </label>
                        <p>
                            tempo ID
                        </p>
                    </div>
                </div>
                <br>

                <button type="submit">Confirm</button>
                <button type="submit">Cancel</button>
            </div>

        </div>
    </div>
</div>







<!-- END OF CONTENTS -->
</div>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

<?php
include 'includes/footer.php';
?>