<?php

@include 'config.php';

if(isset($_POST['submit'])){

   $name = mysqli_real_escape_string($conn, $_POST['name']);
   $email = mysqli_real_escape_string($conn, $_POST['email']);
   $pass = md5($_POST['password']);
   $cpass = md5($_POST['cpassword']);
   $user_type = $_POST['user_type'];

   $select = " SELECT * FROM user WHERE email = '$email' && password = '$pass' ";

   $result = mysqli_query($conn, $select);

   if(mysqli_num_rows($result) > 0){

      $error[] = 'user already exist!';

   }else{

      if($pass != $cpass){
         $error[] = 'password not matched!';
      }else{
         $insert = "INSERT INTO user(name, email, password, user_type) VALUES('$name','$email','$pass','$user_type')";
         mysqli_query($conn, $insert);
         header('location:index.php');
      }
   }

};


?>

<!DOCTYPE html>
<html lang="en">

<head>
<title>Register Form</title>
   <!-- Meta tag Keywords -->
   <meta name="viewport" content="width=device-width, initial-scale=1">
   <meta charset="UTF-8" />
   <meta name="keywords"
        content="Login Form" />

   <!--/Style-CSS -->
   <link rel="stylesheet" href="css/newstyle.css" type="text/css" media="all">

</head>

<body>
   
 <!-- form section start -->
<section class="w3l-mockup-form">
        <div class="container">
            <!-- /form -->
            <div class="workinghny-form-grid">
                <div class="main-mockup">
                    <div class="alert-close">
                        <span class="fa fa-close"></span>
                    </div>
                    <div class="w3l_form align-self">
                        <div class="left_grid_info">
                            <img src="images/unhas.png" alt="">
                        </div>
                    </div>
                    <div class="content-wthree">
                    <h2>Register Now</h2>
                    <p>Smart Campus Universitas Hasanuddin</p>
                    <?php
                        if(isset($error)){
                           foreach($error as $error){
                              echo '<span class="error-msg">'.$error.'</span>';
                           };
                        };
                        ?> 
                    <form action="" method="post">
                        <input type="text" name="name" required placeholder="Enter your name">
                        <input type="email" name="email" required placeholder="Enter your email">
                        <input type="password" name="password" required placeholder="Enter your password">
                        <input type="password" name="cpassword" required placeholder="Confirm your password">
                        <button name="submit" class="btn" type="submit">Register</button>
                     </form>
                     <div class="social-icons">
                            <p>Have an account! <a href="index.php">Login</a>.</p>
                        </div>
                     </div>
                </div>
            </div>
            <!-- //form -->
        </div>
    </section>
    <!-- //form section start -->

    <script src="js/jquery.min.js"></script>
    <script>
        $(document).ready(function (c) {
            $('.alert-close').on('click', function (c) {
                $('.main-mockup').fadeOut('slow', function (c) {
                    $('.main-mockup').remove();
                });
            });
        });
    </script>

</body>
</html>