<?php require '../includes/db.php';?>
<?php

function add_course(){
  global $mysqli;
  if (isset($_POST['publish'])) {

    $name = $_POST['name'];
    $course_cat = $_POST['cat'];
    $course_description = mysqli_real_escape_string($mysqli, $_POST['desc']);


    $query = "INSERT INTO courses (name,cat,description) VALUES('$name','$course_cat','$course_description')";
    $result = mysqli_query($mysqli, $query);
    if (!$result) {
      die("Could not send data " . mysqli_error($mysqli));
      header("Location: courses.php.php?source=add_new");
    }else{
      $_SESSION['SuccessMessage'] = "Post Added Succesfully";
      header("Location: view_course.php");
    }
  }
}
  add_course();

function show_courses(){
  global $mysqli;
 

  $query = "SELECT * FROM courses";
  $result = mysqli_query($mysqli, $query);

  while ($row = mysqli_fetch_assoc($result)) {
    $course_id = $row['id'];
    $post_title = $row['name'];
    $course_cat = $row['cat'];
    $course_description = $row['description'];
    
    
    
    /*
    $post_views = $row['post_views'];
    $post_comment_count = $row['post_comment_count'];*/


    echo "<tr>";
    echo "<td>{$course_id}</td>";
    echo "<td>{$post_title}</td>";
    echo "<td>{$course_cat}</td>";
    echo "<td>{$course_description}</td>";
   
    
   
    echo "<td><a href='courses.php?source=edit&edit_course=$course_id' class='btn btn-primary'>Edit</a></td>";
    echo "<td><a href='courses.php?delete_course=$course_id' class='btn btn-danger'>Delete</a></td>";
    echo "</tr>";
  }
}


function delete_category(){
  global $mysqli;
  if (isset($_GET['delete_cat'])) {
    $cat_id = $_GET['delete_cat'];
    $query = "DELETE FROM categories WHERE cat_id = $cat_id";
    $result = mysqli_query($mysqli, $query);
    if (!$result) {
      die("Could not delete data " . mysqli_error($mysqli));
    }
    else{
      $_SESSION['SuccessMessage'] = "Category Deleted Succesfully";
      header("Location: categories.php?category_deleted");
    }
  }
}
delete_category();




?>