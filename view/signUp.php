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
                        <h2 class="form-title">Sign up</h2>
                        <form class="register-form" id="register-form">
                            <div class="form-group">
                                <label for="name"><i class="zmdi zmdi-account material-icons-name"></i></label>
                                <input type="text" name="name" id="name" placeholder="Your Name"/>
                            </div>
                            <div class="form-group">
                                <label for="mail"><i class="zmdi zmdi-email"></i></label>
                                <input type="email" name="mail" id="mail" placeholder="Your Email"/>
                            </div>
                            <div class="form-group">
                                <label for="password"><i class="zmdi zmdi-lock"></i></label>
                                <input type="password" name="password" id="password" placeholder="Password"/>
                            </div>
                            <div class="form-group">
                                <label for="confirm_password"><i class="zmdi zmdi-lock-outline"></i></label>
                                <input type="password" name="confirm_password" id="confirm_password" placeholder="Repeat your password"/>
                            </div>
                            <div class="form-group">
                                <input type="checkbox" name="agree" id="agree" class="agree"/>
                                <label for="agree" class="label-agree"><span><span></span></span>I agree all statements in  <a href="#" class="term-service">Terms of service</a></label>
                            </div>                                
                            <div id="error_message" style="color:red"></div>
                            <a id="activate_account" style="color:black;display:none">Renvoyer le mail d'activation</a>
                            <a id="connect"style="color:black;display:none">Se connecter</a>
                            <div class="form-group form-button">
                                <input type="submit" name="signup" id="signup" class="form-submit" value="signup"/>
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
<script>

const signUpForm = document.querySelector("#register-form")
signUpForm.addEventListener('submit',function(event){
    event.preventDefault();

    const formData = new FormData(signUpForm);
    fetch('index.php?action=signup_php',{
        method: 'POST',
        body: formData
    })
    .then(response => response.json())
    .then(data => {

        const errorMessage = document.querySelector('#error_message');
            errorMessage.innerText = data.message;
            errorMessage.style.display = 'block';

        if (data.status === 'success') {
                const activateAccount = document.querySelector('#activate_account');
                activateAccount.style.display = 'block';
                activateAccount.href = data.activate;
        } else {
            if(data.connect){
                const connect = document.querySelector('#connect');
                connect.style.display = 'block';
                connect.href = data.connect;
            }

        }
    })
    .catch(error => console.error(error));
});


</script>
</body><!-- This templates was made by Colorlib (https://colorlib.com) -->
</html>

<?php
unset($_SESSION['error']);
?>