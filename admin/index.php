<?php require '../includes/db.php';?>
<?php include 'header.php'; ?>
<?php include 'navbar.php'; ?>

<?php 

  session_start();

  if(!isset($_SESSION['login'])) {
    echo "Cannot acces this page, please Login";
    header('Location: ../index.php');
  }
?>
 <?php include 'sidebar.php'; ?>
 <?php include 'content.php'; ?>


  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->

<?php include 'footer.php'; ?>
