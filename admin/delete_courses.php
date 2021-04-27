<?php


function delete_category(){
  global $connection;
  if (isset($_GET['delete_cat'])) {
    $cat_id = $_GET['delete_cat'];
    $query = "DELETE FROM categories WHERE cat_id = $cat_id";
    $result = mysqli_query($connection, $query);
    if (!$result) {
      die("Could not delete data " . mysqli_error($connection));
    }
    else{
      $_SESSION['SuccessMessage'] = "Category Deleted Succesfully";
      header("Location: categories.php?category_deleted");
    }
  }
}
delete_category();

?>
