<!DOCTYPE html>
<html>
<head>
    <title>Category Management</title>
    <link rel="stylesheet" href="assets/bootstrap.css">
    <link rel="stylesheet" href="assets/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    
</head>
<body>
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <h1 style ="padding-top: 50px" >Categories</h1>
            </div>
            <div class="col-md-6 text-right" id="logo">
                <img src="assets/logo.png" alt="Logo">
            </div>
        </div>

        <!-- Search Form -->
        <div class="row mt-3" id ="search-bar">
            <div class="col-md-6">
                <form action="index.php" method="GET" class="form-inline" >
                    <div class="input-group">
                        <input type="text" name="search" class="form-control" placeholder="Search by category name" value="<?php echo $searchQuery; ?>">
                        <div class="input-group-append">
                            <button type="submit" class="btn btn-primary">Search</button>
                        </div>
                    </div>
                </form>
            </div>
            <div class="col-md-6 text-right">
            <a href="index.php?action=add" class="btn btn-success"><i class="fas fa-plus-circle"></i></a>
            </div>
        </div>

        <!-- Category List -->
        <div class="row mt-3">
            <div class="col-md-12">
                <h2>Categories</h2>

                <table class="table">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Name</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($categories as $category) { ?>
                            <tr>
                                <td><?php echo $category['id']; ?></td>
                                <td><?php echo $category['name']; ?></td>
                                <td>
                                <a href="?action=edit&id=<?php echo $category['id']; ?>"><i class="fas fa-edit"></i></a>
                                <a href="?action=copy&id=<?php echo $category['id']; ?>" data-toggle="modal" data-target="#copyCategoryModal"><i class="fas fa-copy"></i></a>
                                <a href="?action=details&id=<?php echo $category['id']; ?>"><i class="fas fa-info-circle"></i></a>
                                </td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>

                <!-- Pagination -->
                <div class="pagination">
            <?php echo $paginationHelper->generatePaginationLinks($totalCount, $categoriesPerPage, $currentPage); ?>
                 </div>
            </div>
        </div>
    </div>


    <div id="copyCategoryModal" class="modal">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Copy Category</h5>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                    <iframe id="copyCategoryFrame" src="../CopyCategoryView.php" width="10%" height="400"></iframe>
                </div>
            </div>
        </div>
    </div>

    <script src="assets/bootstrap.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/js/all.min.js"></script>
    <script>
        $('#copyCategoryModal').on('show.bs.modal', function (event) {
            var button = $(event.relatedTarget);
            var categoryId = button.data('category-id');
            var modal = $(this);
            modal.find('.modal-body #copyCategoryFrame').attr('src', '../CopyCategoryView.php?id=' + categoryId);
        });
    </script>

</body>
</html>
