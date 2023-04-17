<?php

@include 'config.php';

session_start();

if(isset($_POST['submit'])){

   $email = mysqli_real_escape_string($conn, $_POST['email']);
   $pass = md5($_POST['password']);


   $select = " SELECT * FROM user WHERE email = '$email' && password = '$pass' ";

   $result = mysqli_query($conn, $select);

   if(mysqli_num_rows($result) > 0){

      $row = mysqli_fetch_array($result);

      if($row['user_type'] == 'admin'){

         $_SESSION['admin_name'] = $row['name'];
         header("location:admin_page.php");

      }elseif($row['user_type'] == 'user'){

         $_SESSION['user_name'] = $row['name'];
         header("location:user_page.php");

      }
     
   }else{
      $error[] = 'incorrect email or password!';
   }

};
?>

<!DOCTYPE html>
<html lang="en">
<head>
<title>Smart Campus - Universitas Hasanuddin</title>
   <!-- Meta tag Keywords -->
   <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta charset="UTF-8" />
    <meta name="keywords"
        content="Login Form" />
    <!-- //Meta tag Keywords -->

   <link href="//fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">

   <!--/Style-CSS -->
   <link rel="stylesheet" href="css/newstyle.css" type="text/css" media="all" />
   <!--//Style-CSS -->

   <script src="https://kit.fontawesome.com/af562a2a63.js" crossorigin="anonymous"></script>

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
                     
                        <h2>Login Now</h2>
                        <p>Smart Campus Universitas Hasanuddin</p>
                        <?php
                        if(isset($error)){
                           foreach($error as $error){
                              echo '<span class="error-msg">'.$error.'</span>';
                           };
                        };
                        ?>
                        <form action="" method="post">
                        <input type="email" name="email" required placeholder="enter your email">
                        <input type="password" name="password" required placeholder="enter your password">
                        <button name="submit" class="btn" type="submit" value="Login">Login</button>
                        <div class="social-icons">
                        <p>don't have an account? <a href="register_form.php">register now</a></p>
                        </div>
                     </form>
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
