<?php
 include 'header.php';
 //include 'DataBase.class.php';
 include 'nav.php';
 ?>

         <section class="services-area">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12 text-center services-title">
                        <h1 class="text-uppercase title-text">All Employeess</h1>
                    </div>
                </div>
                <!--  -->


                <?php if (count($db->read("employee"))): ?>
                <table class="main-table text-center table table-bordered table-dark">
                    <thead>
                        <tr>
                            <td>Name</td>
                            <td>Email</td>
                            <td>Department</td>
                            <td>Edit</td>
                            <td>Delete</td>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($db->read('employee') as $row): ?>
                            <tr>
                                <td><?php echo strtoupper($row['name']); ?></td>
                                <td><?php echo $row['email']; ?></td>
                                <td><?php echo strtoupper($row['department']); ?></td>

                                <td>
                                    <a href="edite-employee.php?id=<?php echo $row['id']?>" class="text-primary">
                                        <i class="fa fa-pencil-alt fa-2x"></i>
                                    </a>
                                </td>

                                <td>
                                    <a href="delete-employee.php?id=<?php echo $row['id']?>" class="text-danger">
                                        <i class="fa fa-times fa-2x"></i>
                                    </a>
                                </td>
                            </tr>
                        <?php endforeach;?>
                    </tbody>

                </table>
                <?php else:?>
                <div class="col-ms-12">
                    <h3 class="alert alert-danger mt-5 text-center"> Not Found Data</h3>
                </div>

                <?php endif; ?>
            </div>
        </section>


<?php include 'footer.php';?>