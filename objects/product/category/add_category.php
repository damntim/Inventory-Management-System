<?php
include_once '../../../config/database.php';
include_once 'Category.php';

// get database connection
$database = new Database();
$db = $database->getConnection();

// prepare category object
$category = new Category($db);

// set category property values
$category->categoryName = $_POST['categoryName'];
$category->categoryDescription = $_POST['categoryDescription'];

// create the category
if($category->create()){
    echo '<script>
    alert("Categories added successfully!");
    window.location.href = "../../../interfaces/employee/pm/viewcategory.php";
</script>';
} else{
    echo '<script>
    alert("Categories add failed!");
    window.location.href = "../../../interfaces/employee/pm/addcategory.php";
</script>';
}
?>
