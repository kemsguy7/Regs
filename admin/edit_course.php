
<?php
include('sessions.php');


 //get posts content by id
 if(isset($_GET['edit_course']) && $_GET['edit_course'] != "") {
    $edit_id = $_GET['edit_course'];
    $query = mysqli_query($mysqli, "SELECT * FROM courses WHERE id=$edit_id");
    if(mysqli_num_rows($query) > 0) {
      $data = mysqli_fetch_array($query);
      $title = $data['name'];
      $category = $data['cat'];
      $description = $data['description'];
       
    } else {
      echo "error".mysqli_error($mysqli);
    }
 } else {
     die("failed"); 
 } 
 ?>
 




 <?php include 'sidebar.php'; ?>
 <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Dashboard</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Dashboard v1</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <!-- Small boxes (Stat box) -->
        <div class="row">
          <div class="col-lg-3 col-6">
            <!-- small box -->
            
       
 

  <h2>Edit Course</h2>
  
    <form action="includes/functions.php" method="post" enctype="multipart/form-data">
      <div class="form-group">
        <label for="">Course Title</label>
        <input type="text" name="title" placeholder="Post Title" class="form-control"value="<?php echo $title; ?>">
      </div>
     
      <div class="form-group">
        <label for="">Course Category</label>
      <select class="form-control" name="category" value="<?php echo $category; ?>">
        <option>Php</option>
        <option>Html</option>
        <option>Javascript</option>

      </select>
      </div>
      
      <div class="form-group">
        <label for="">Course Description</label>
        <textarea name="content" rows="8" cols="80" class="form-control" 
        value="<?php echo $description; ?>"> </textarea>
      </div>
      
      <div class="form-group">
        <input type="submit" name="publish" value="Edit Course"  class="btn btn-primary">
      </div>
    </form>
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
