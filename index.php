
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product Migration</title>
    <!-- Bootstrap library -->
    <link rel="stylesheet" href="assets/bootstrap/bootstrap.min.css">
    <!-- Stylesheet file -->
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
    
<!-- Export link -->
<div class="col-md-12 head">
    <div class="float-right">
        <a href="exportData.php" class="btn btn-success"><i class="dwn"></i> Export</a>
    </div>
</div>

<!-- Data list table --> 
<table class="table table-striped table-bordered">
    <thead class="thead-dark">
        <tr>
            <th>#Id</th>
            <th>Title</th>
            <th>Body (HTML)</th>
            <th>Vendor</th>
            <th>Category</th>
            <th>Tags</th>
            <th>Variant SKU</th>
            <th>Image Src</th>
            <th>Image Src</th>
            <th>Status</th>
        </tr>
    </thead>
    <tbody>
   <?php 
   // Load the database configuration file 
    include_once 'dbConfig.php'; 

    // Fetch records from database 
    // $result = $db->query("SELECT * FROM products"); 
    $result = $db->query("SELECT products.*, categories.Category AS cat_name FROM categories INNER JOIN product_categories ON product_categories.iCategoryID = categories.iCategoryID INNER JOIN products ON products.iProductID = product_categories.iProductID"); 

    if($result->num_rows > 0){ 
        while($row = $result->fetch_assoc()){ 
    ?>
        <tr>
            <td><?php echo $row['iProductID']; ?></td>
            <td><?php echo $row['name']; ?></td>
            <td><?php echo $row['description']; ?></td>
            <td><?php echo $row['vendor']; ?></td>
            <td><?php echo $row['cat_name']; ?></td>
            <td><?php echo $row['keywords']; ?></td>
            <td><?php echo $row['price']; ?></td>
            <td><?php echo $row['SKU']; ?></td>
            <td><?php echo $row['photo_enlarged']; ?></td>
            <td><?php echo ($row['bPublish'] == 1)?'active':'draft'; ?></td>
        </tr>
    <?php } }else{ ?>
        <tr><td colspan="7">No record(s) found...</td></tr>
    <?php } ?>
    </tbody>
</table>

</body>
</html>