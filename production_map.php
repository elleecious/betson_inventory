<?php include('includes/header.php'); ?>
<?php include('library/functions.php'); ?>
<?php include('includes/navbar.php'); ?>
<?php $page_title = "Betson Inventory"; ?>
<div class="row mx-auto">
    <div class="col-md-12 mb-2">
        <header class="mt-5">
            Production Map
        </header>
       <div class="container mt-5">
            <div class="row">
                <?php productionMap(); ?>
            </div>
       </div>
    </div>
</div>
<?php include("includes/modal.php");?>
<?php include('includes/footer.php');?>