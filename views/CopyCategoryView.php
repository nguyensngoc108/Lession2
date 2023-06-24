<!DOCTYPE html>
<html>
<head>
    <title>Copy Category</title>
    <link rel="stylesheet" href="assets/bootstrap.css">
    <link rel="stylesheet" href="assets/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

</head>
<body>
    <div class="container">
        <h1>Copy Category</h1>

        <form action="index.php?action=copy" method="POST">
            <input type="hidden" name="category_id" value="<?php echo $_GET['id']; ?>">
            <div class="form-group">
                <label for="copy_name">Copy Name:</label>
                <input type="text" id="copy_name" name="copy_name" class="form-control" required>
            </div>
            <br>
            <button type="submit" class="btn btn-primary">Copy Category</button>
        </form>
    </div>

    <script src="assets/bootstrap.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/js/all.min.js"></script>

</body>
</html>
