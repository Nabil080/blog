<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Sign Up Form by Colorlib</title>

    <!-- Font Icon -->
    <link rel="stylesheet" href="assets/fonts/material-icon/css/material-design-iconic-font.min.css">

    <!-- Main css -->
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>

    <div class="main">

        <!-- Sign up form -->
        <section class="signup">
            <div class="container">
                <div class="signup-content">
                    <div class="signup-form">
                        <h2 class="form-title">Reset password</h2>
                        <form action="?action=change_password" method="POST" class="register-form" id="register-form">
                        <div class="form-group">
                                <label for="password"><i class="zmdi zmdi-lock"></i></label>
                                <input type="password" name="password" id="password" placeholder="Password"/>
                            </div>
                            <div class="form-group">
                                <label for="confirm_password"><i class="zmdi zmdi-lock-outline"></i></label>
                                <input type="password" name="confirm_password" id="confirm_password" placeholder="Repeat your password"/>
                            </div>
                            <input type="text" name="token" value="<?=$_GET['token']?>" style="display:none"/>
                            <?php
                                if(isset($_SESSION['error'])){
                                    if($_SESSION['error']=='invalid_password'){ echo '<div style="color:red">Mot de passe invalide ! (Une majuscule, un chiffre et un charactère spécial minimum)</div>'; }
                                    if($_SESSION['error']=='confirm_password'){ echo '<div style="color:red">Les mots de passe ne correspondent pas !</div>'; }
                                }
                            ?>
                            <div class="form-group form-button">
                                <input type="submit" name="signup" id="signup" class="form-submit" value="Change password"/>
                            </div>
                        </form>
                    </div>
                    <div class="signup-image">
                        <figure><img src="assets/images/signup-image.jpg" alt="sing up image"></figure>
                        <a href="?action=login" class="signup-image-link">I am already member</a>
                    </div>
                </div>
            </div>
        </section>
    </div>

    <!-- JS -->
    <srcipt src="assets/vendor/jquery/jquery.min.js"></srcipt>
    <srcipt src="assets/js/main.js"></srcipt>
</body><!-- This templates was made by Colorlib (https://colorlib.com) -->
</html>

<?php
unset($_SESSION['error']);
?>