<?php include 'header.php'; ?>
<?php include 'navbar.php'; ?>
<?php include 'functions.php'; ?>
<?php require '../includes/db.php';?>
<?php include 'helper.php'; ?>
<?php 
 function delete($table, $colName, $id) {
        global $mysqli;
        $query = mysqli_query($mysqli, "DELETE FROM $table WHERE $colName = $id");
        if($query) {
            return true;
        } else {
            return false;
        }
    }

if(isset($_GET['delete_course']) && $_GET['delete_course'] !== '') {
  $dlt = $_GET['delete_course'];
  if(delete('courses','id',$dlt)) {
	$_SESSION['SuccessMessage'] = "Post Deleted Succesfully";
    header("Location: view_course.php");
  } else {
	  die('FAILED');
  }
}



//Edit, Update, modify post
global $connection;
if (isset($_POST['modify'])) {
	$eid = $_POST['editID'];
	$title = $_POST['title'];
	$category = $_POST['category'];
	$author = $_POST['author'];
	


	
	$query = mysqli_query($connection, "UPDATE posts SET post_title='$title', post_author='$author',  post_image='$image' WHERE post_id='$eid' ");
	if($query) {
		$_SESSION['SuccessMessage'] = "Post Edited Succesfully Succesfully";
		header("Location: posts.php");
	} else {
		$_SESSION['ErrorMessage'] = "Cannot Edit Post";
		echo  'failed'.mysqli_error($connection);
	}
	//echo "<script>alert('$eid');</script>";

}


?>


<?php 

  session_start();

  if(!isset($_SESSION['login'])) {
    echo "Cannot acces this page, please Login";
    header('Location: ../index.php');
  }
?>
 <?php include 'sidebar.php'; ?>
 <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          
        <!-- Small boxes (Stat box) -->
        <div class="row">
          <div class="col-md-12 col-12">
            <!-- small box -->
            
       <?php
						if (isset($_GET['source'])) {
								$source = $_GET['source'];

						switch ($source) {
							case 'add_new':
								include "add_course.php";
								break;
							case 'edit':
								include "edit_course.php";
								break;
							default:
								include "view_course.php";
								break;
						}
		}else {
			include "view_course.php";
		}
					 ?>
 




</div>
</div>
</div>



  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->

<?php include 'footer.php'; ?>
















