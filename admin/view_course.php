<?php require '../includes/db.php'; ?>
<?php include 'functions.php'; ?>
<?php include 'header.php'; ?>
<?php include 'navbar.php'; ?>
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
          
        <!-- Small boxes (Stat box) -->
        <div class="row">
          <div class="col-md-12 col-12">
            <!-- small box -->
            
       
 

<div class="table-responsive">
<table class="table table-bordered table-striped table-hover">
  <thead>
    <th>Course ID</th>
    <th>Course Title</th>
    <th>Course Category</th>
    <th>Description</th>
      
    <th>Edit</th>
    <th>Delete</th>
  </thead>
  <tbody>
  <?php show_courses(); ?>
  </tbody>
</table>
</div>



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



















