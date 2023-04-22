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
                        <form method="POST" class="register-form" id="register-form">
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
                                <input type="checkbox" name="agree" id="agree" class="agree" />
                                <label for="agree" class="label-agree"><span><span></span></span>I agree all statements in  <a href="#" class="term-service">Terms of service</a></label>
                            </div>
                            <?php
                                if(isset($_SESSION['error'])){?>
                                <div id="error_message" style="color:red"><?php
                                    if($_SESSION['error']=='invalid_name'){ echo 'Nom invalide !'; }
                                    if($_SESSION['error']=='short_name'){ echo 'Nom trop court !'; }
                                    if($_SESSION['error']=='invalid_password'){ echo 'Mot de passe invalide ! (Une majuscule, un chiffre et un charactère spécial minimum)'; }
                                    if($_SESSION['error']=='confirm_password'){ echo 'Les mots de passe ne correspondent pas !'; }
                                    if($_SESSION['error']=='invalid_mail'){ echo 'Email invalide !'; }
                                    if($_SESSION['error']=='existing_mail'){ echo 'Email déjà existant !'; }
                                    if($_SESSION['error']=='missing_elements'){ echo 'Elements manquants !'; }
                                ?> </div> <?php } ?>
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
const form = document.querySelector('#register-form');
form.addEventListener('submit', (event) => {
    event.preventDefault(); // prevent the default form submission
    const formData = new FormData(form);
    fetch('?action=signup_php', {
        method: 'POST',
        body: formData
    })
    .then(response => response.json())
    .then(data => {
        console.log(data); // Add this console log to see the response data in the browser console
        document.getElementById("signup").remove();
        if (data.success) {
            // handle successful submission
            alert('Un mail pour valider votre compte vous a été envoyé !');
            // redirect to validation page
            window.location.href = `?action=validate_mail&token=${data.token}`;
        } else {
            // handle errors
            const errorMessages = document.querySelector('#error_message');
            errorMessages.innerHTML = '';
            for (const [key, value] of Object.entries(data.errors)) {
                const errorMessage = document.createElement('div');
                errorMessage.style.color = 'red';
                errorMessage.textContent = value;
                errorMessages.appendChild(errorMessage);
            }
        }
    })
    .catch(error => {
        // handle any other errors
        console.error(error);
    });
});
</script>
</body><!-- This templates was made by Colorlib (https://colorlib.com) -->
</html>

<?php
unset($_SESSION['error']);
?>