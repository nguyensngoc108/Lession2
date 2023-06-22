<?php
require_once 'helper/db_connection.php';
require_once 'models/CategoryModel.php';

// Retrieve category data from the database
$categoryModel = new CategoryModel();
$categories = $categoryModel->getAllCategories();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Category Popup</title>
    <!-- Include necessary CSS and JS libraries -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.1.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" href="styles.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.1.0/js/bootstrap.bundle.min.js"></script>
</head>
<body>

    <!-- Button to trigger the category popup -->
    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#categoryPopup">Open Category Popup</button>

    <!-- Category Popup Modal -->
    <div class="modal fade" id="categoryPopup" tabindex="-1" aria-labelledby="categoryPopupLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="categoryPopupLabel">Category Popup</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="saveCategory.php" method="POST">
                        <!-- Category fields -->
                        <div class="mb-3">
                            <label for="categoryCode" class="form-label">Category Code</label>
                            <input type="text" class="form-control" id="categoryCode" name="categoryCode">
                        </div>
                        <div class="mb-3">
                            <label for="categoryName" class="form-label">Category Name</label>
                            <input type="text" class="form-control" id="categoryName" name="categoryName">
                        </div>
                        <div class="mb-3">
                            <label for="parentCategory" class="form-label">Parent Category</label>
                            <select class="form-select" id="parentCategory" name="parentCategory">
                                <option value="">Select Parent Category</option>
                                <?php foreach ($categories as $category) { ?>
                                    <option value="<?php echo $category['categoryCode']; ?>"><?php echo $category['categoryName']; ?></option>
                                <?php } ?>
                            </select>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-primary">Save</button>
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

</body>
</html>
