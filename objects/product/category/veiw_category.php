<?php
include_once '../../../config/database.php';
include_once ("Category.php");

$database = new Database();
$db = $database->getConnection();
$category = new Category($db);
$category1 = new Category($db);

$results_per_page = 5;

// Find out the number of results stored in the database
$total_results = $category1->countCategories();

// Determine number of total pages available
$total_pages = ceil($total_results / $results_per_page);

// Determine which page number visitor is currently on
$page = isset($_GET['page']) && is_numeric($_GET['page']) ? (int)$_GET['page'] : 1;

// Ensure the page number is valid
if ($page > $total_pages) {
    $page = $total_pages;
} elseif ($page < 1) {
    $page = 1;
}

// Determine the starting number for the results on the displaying page
$starting_limit_number = ($page-1) * $results_per_page;

// Retrieve the selected results from database 
$categories1 = $category1->getCategories($starting_limit_number, $results_per_page);
$categories = $category->getAllCategories();

?>

