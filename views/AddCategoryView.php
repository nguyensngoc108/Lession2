<!DOCTYPE html>
<html>
<head>
    <title>Add Category</title>
    <link rel="stylesheet" href="assets/bootstrap.css">
    <link rel="stylesheet" href="assets/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <style>
        /* Additional CSS styles */
    </style>
</head>
<body>
    <div class="container">
        <h1>Add Category</h1>

        <form action="index.php?action=add" method="POST">
            <div class="form-group">
                <label for="code">Code:</label>
                <input type="text" id="code" name="code" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="name">Name:</label>
                <input type="text" id="name" name="name" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="parent_id">Parent Category:</label>
                <input type="text" id="parent_id" name="parent_id" class="form-control">
            </div>
            <button type="submit" class="btn btn-primary">Add Category</button>
        </form>
    </div>

    <script src="assets/bootstrap.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/js/all.min.js"></script>
    <script>
        // Additional JavaScript code
    </script>
</body>
</html>
