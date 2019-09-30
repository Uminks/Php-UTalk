<?php 
  session_start();
  if ( !isset ( $_SESSION["user_information"] ) ) {
    header("location: /");
  }
?>
<!-- Head -->   



  <div class="d-flex" id="wrapper">

    <!-- Sidebar -->
        <?php include 'inc/sidebar.php' ?>
    <!-- /#sidebar-wrapper -->

    <!-- Page Content -->
    <div id="page-content-wrapper">
    
    <!-- Navbar -->
    <?php include 'inc/header.php' ?>

    <div class="tab-content container-fluid containerApp">

        <!-- Chats -->  
        <?php include 'inc/chats.php' ?>
        
        <!-- Contactos --> 
        <?php include 'inc/friends.php' ?>
            
        <!-- Solicitudes de amistad -->   
        <?php include 'inc/friend-requests.php' ?>
            
        <!-- Agregar amigos --> 
        <?php include 'inc/add-friend.php' ?>
            
    </div>



    </div>
    <!-- /#page-content-wrapper -->

  </div>
  <!-- /#wrapper -->
    