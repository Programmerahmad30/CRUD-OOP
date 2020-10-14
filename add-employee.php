<?php
     include 'header.php';
     ///include 'DataBase.class.php';
     include 'nav.php';
 ?>

 <?php

    $departments = array("cs", "it", "sc");
    $error = '';
    $success = '';

    if (isset($_POST['submit']))
    {
        //VALIDATION

        $name       = filter_var($_POST['name'],FILTER_SANITIZE_STRING);
        $email      = filter_var($_POST['email'],FILTER_SANITIZE_EMAIL);
        $department = filter_var($_POST['department'],FILTER_SANITIZE_STRING);
        $password   = filter_var($_POST['password'],FILTER_SANITIZE_STRING);

        if (empty($name) or empty($email) or empty($department) or empty($password))
        {
            $error = "Please Fill All Fields";
        }
        else
        {
            if (filter_var($_POST['email'],FILTER_VALIDATE_EMAIL))
            {
                $department = strtolower($department);
                if (in_array($department, $departments))
                {
                    if (strlen($password) > 6)
                    {
                        $db = new DataBase();
                        $newpassword = $db->enc_password($password);
                        $sql = "INSERT INTO employee(name,email,department,password)VALUES ('$name','$email','$department','$newpassword')";
                        $success = $db->insert($sql);
                    }
                    else
                    {
                        $error = "Password Must Be Greter Than 6 char !";
                    }
                }
                else
                {
                    $error = "This Department Not Found";
                }
            }
            else
            {
                $error = "Please Type Valid Email";
            }
        } 
    }
 ?>


        <section class="services-area">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12 text-center services-title">
                        <h1 class="text-uppercase title-text">Add New Employee</h1>
                    </div>

                </div>

                <div class="col-sm-12">
                    <?php if($error != ''): ?>
                    <h2 class="p-3 col text-center mt-5 alert alert-danger"><?php echo $error;?> </h2>
                    <?php endif;?>
                </div>

                <div class="col-sm-12">
                    <?php if($success != ''): ?>
                        <h2 class="p-3 col text-center mt-5 alert alert-success"><?php echo $success;?> </h2>
                    <?php endif;?>
                </div>



                    <div class="col-sm-12">
                      <!-- general form elements -->
                      <div class="box box-primary">
                        <!-- /.box-header -->
                        <!-- form start -->
                        <form method="post" action="<?php $_SERVER['PHP_SELF'];?>">
                          <div class="box-body">

                            <div class="form-group">
                              <label for="name">Name</label>
                              <input type="text" name="name" class="form-control" id="name" placeholder="Enter Name">
                            </div>


                            <div class="form-group">
                              <label for="department">Department</label>
                              <input type="text" name="department" class="form-control" id="department"placeholder="Enter Department">
                            </div>



                            <div class="form-group">
                              <label for="exampleInputEmail1">Email address</label>
                              <input type="text" name="email" class="form-control" id="exampleInputEmail1" placeholder="Enter email">
                            </div>

                            <div class="form-group">
                              <label for="exampleInputPassword1">Password</label>
                              <input type="password" name="password" class="form-control" id="exampleInputPassword1" placeholder="Password">
                            </div>

                          </div>
                          <!-- /.box-body -->

                          <div class="box-footer">
                            <button type="submit" name="submit" class="btn btn-primary">Submit</button>
                          </div>
                        </form>
                      </div>
                  </div>
                </div>
                <!--  -->
            </div>
        </section>


        <?php include 'footer.php';?>
