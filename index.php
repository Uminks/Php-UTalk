<!-- Head -->  
<?php require_once "controllers/RoutesController.php"; ?>
<?php include 'inc/head.php'; ?>

    <?php 
        $mvc = new RouteController();
        $mvc->linkPagesController();
    ?>

<!-- Footer -->   
<?php include 'inc/footer.php' ?>
    


