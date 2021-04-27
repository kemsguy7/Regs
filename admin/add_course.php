
<?php include 'header.php'; ?>
<?php include 'navbar.php'; ?>

<?php require '../includes/db.php';?>
<?php include 'sessions.php'; ?>
<?php 

  if (session_status() == PHP_SESSION_NONE){ 
            session_start();
        }

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
          <div class="col-md-9 col-6">
            <!-- small box -->
            
       
 

  <h2>Add Post</h2>
  
    <form action="functions.php" method="post" enctype="multipart/form-data">
      <div class="form-group">
        <label for="">Course Title</label>
        <input type="text" name="name" placeholder="Post Title" class="form-control">
      </div>
     
      <div class="form-group">
        <label for="">Course Category</label>
      <select class="form-control" name="cat">
        <option>Php</option>
        <option>Html</option>
        <option>Javascript</option>

      </select>
      </div>
      
      <div class="form-group">
        <label for="">Course Description</label>
        <textarea name="desc" rows="8" cols="80" class="form-control ckeditor" id="editor"></textarea>
      </div>
      
      <div class="form-group">
        <input type="submit" name="publish" value="Add New Course"  class="btn btn-primary">
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
