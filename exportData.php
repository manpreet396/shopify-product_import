<?php 
 
// Load the database configuration file 
include_once 'dbConfig.php'; 
 
// Fetch records from database 
// $query = $db->query("SELECT * FROM products");

// Fetch records from database 
$query = $db->query("SELECT products.*, categories.Category AS cat_name FROM categories INNER JOIN product_categories ON product_categories.iCategoryID = categories.iCategoryID INNER JOIN products ON products.iProductID = product_categories.iProductID"); 
 
if($query->num_rows > 0){ 
    $delimiter = ","; 
    $filename = "products-data_" . date('Y-m-d') . ".csv"; 
     
    // Create a file pointer 
    $f = fopen('php://memory', 'w'); 

    // Set column headers 
    $fields = array('Title', 'Body (HTML)', 'Vendor', 'Product Category', 'Tags', 'Variant Price', 'Variant SKU', 'Image Src', 'Status'); 
    fputcsv($f, $fields, $delimiter); 
     
    // Output each row of the data, format line as csv and write to file pointer 
    while($row = $query->fetch_assoc()){ 
        
        // $status = ($row['status'] == 1)?'Active':'Inactive'; 

        $lineData = array($row['name'], $row['description'], $row['vendor'], $row['cat_name'] , $row['keywords'], $row['price'], $row['SKU'], "https://www.adlersbride.com/resized/".$row['photo_enlarged'], "active"); 
        fputcsv($f, $lineData, $delimiter); 
    } 
     
    // Move back to beginning of file 
    fseek($f, 0); 
     
    // Set headers to download file rather than displayed 
    header('Content-Type: text/csv'); 
    header('Content-Disposition: attachment; filename="' . $filename . '";'); 
     
    //output all remaining data on a file pointer 
    fpassthru($f); 
} 
exit; 
 
?>