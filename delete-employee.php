<?php
 include 'header.php';
 include 'nav.php';
 ?>

<?php $row = $db->find('employee',$_GET['id']); ?>
<?php if (isset($_GET['id']) && is_numeric($_GET['id'])): ?>
    <?php if($row): ?>
        <section class="services-area">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12 text-center services-title">
                        <h1 class="text-uppercase title-text">Delete New Employee</h1>
                    </div>
                </div>
                <!--  -->
                <h2 class="p-3 col text-center mt-5 alert alert-success"><?php echo $db->delete("employee", $row['id']);?> </h2>

            </div>
        </section>
    <?php endif;?>
<?php endif;?>


        <?php include 'footer.php';?>
