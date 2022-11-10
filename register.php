<?php

    if(array_key_exists('submit',$_POST)) {

        $link = mysqli_connect('localhost','root','','game_db');

        if(mysqli_connect_error()) {
            die("There was a problem connecting to the database");
        }

        $error = "";
        $success = "";

        if(!$_POST['fname']) {
            $error .= 'Please enter your first name<br>';
        }

        if(!$_POST['lname']) {
            $error .= 'Please enter your last name<br>';
        }

        if(!$_POST['username']) {
            $error .= 'Please enter your desired username<br>';
        }
        
        if(!$_POST['email']) {
            $error .= 'Please enter your email address<br>';
        }

        if(!$_POST['password']) {
            $error .= 'Please enter a password<br>';
        }

        if(!$_POST['confirm_password']) {
            $error .= 'Please confirm your password<br>';
        }

        $query = "SELECT id FROM `users` WHERE uname = '".mysqli_real_escape_string($link, $_POST['username'])."'";
        $result = mysqli_query($link, $query);

        if(mysqli_num_rows($result) > 0) {
            $error .= 'This username is already in use<br>';
        }

        $query = "SELECT id FROM `users` WHERE email = '".mysqli_real_escape_string($link, $_POST['email'])."'";
        $result = mysqli_query($link, $query);

        if(mysqli_num_rows($result) > 0) {
            $error .= "This email address is already in use<br>";
        }

        if ($error != '') {

            $error = '<p><strong>The following errors were found in your form:</strong></p>'.$error;

        } else {

            $query = "INSERT INTO `users` (`fname`, `lname`, `uname`, `email`, `password`) VALUES ('".mysqli_real_escape_string($link, $_POST['fname'])."','".mysqli_real_escape_string($link, $_POST['lname'])."','".mysqli_real_escape_string($link, $_POST['username'])."','".mysqli_real_escape_string($link, $_POST['email'])."','".mysqli_real_escape_string($link, $_POST['password'])."')";

            if(!mysqli_query($link, $query)) {

                $error = "<strong>Error:</strong><br><br>Could not sign you up - please try again later";

            } else {

                $query = "UPDATE `users` SET PASSWORD = '".password_hash($_POST['password'], PASSWORD_DEFAULT)."' WHERE id = ".mysqli_insert_id($link);
                mysqli_query($link, $query);

                $success = "You were successfully signed up!";

            }

        }

    }

?>

<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

    <!-- FontAwesome CSS -->
    <link rel="stylesheet" href= "https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    
    <!-- Google Fonts Stylesheet -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Tiro+Telugu&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Silkscreen&family=Tiro+Telugu&display=swap" rel="stylesheet">

    <style>

        body {
            background-color: #ECDBAB;
            font-family: 'Tiro Telugu', serif;
        }

        .jumbotron {
            background-color: #9C231B;
        }

        #heading {
            margin-top: 25px;
            margin-bottom: 30px;
        }

        #heading-text {
            font-size: 3rem;
            font-family: 'Silkscreen', cursive;
            color: #15502C;
        }

        .form-control {
                border: 1px solid black;
        }

        .form-text {
            font-family: 'Tiro Telugu', serif;
            color: white;
            font-size: 20px;
        }

        .btn-primary {
            background-color: #15502C;
            border-color: #0f3d20;
        }

        .btn-primary:hover {
            background-color: #289b54;
            border-color: #0f3d20;
        }

        .input-container {
            display: flex;
            width: 100%;
            margin-bottom: 15px;
        }

        .icon {
            color: white;
            padding: 10px;
            background-color: #7A896B;
            border-radius: .25rem;
            border: 1px solid #15502C;
            min-width: 50px;
            text-align: center;
        }

        #error {
            margin-bottom: 30px;
        }

        #bottom-text {
            padding-top: 50px;
        }

        a{
            color: #289b54;
        }

        a:hover {
            color: #15502C
        }

    </style>

    <title>New User Registration</title>
  </head>
  <body>

    <div class='container'>

        <div id='heading'>
            <h1 id='heading-text'>Registration Form</h1>
        </div>

        <?php

            if(isset($error) && $error != '') { 
                echo "<div id='error' class='alert alert-danger' role='alert'>".$error."</div>";
            } 
            
            if(isset($success) && $success != ''){
                echo "<div class='alert alert-success' role='alert'>".$success."</div>";
            }

        ?>

        <div class='jumbotron'>

            <form action="" method="post">

                <div class='row'>
                    <div class='col'>
                        <div class='form-group'>
                            <label for="FName" class='form-text'>First Name</label>
                            <div class="input-container">
                                <i class="fa fa-id-card icon"></i>
                                <input type="text" class="form-control" name="fname" required>
                            </div>
                        </div>
                    </div>
                    <div class='col'>
                        <div class='form-group'>
                            <label for="LName" class='form-text'>Last Name</label>
                            <div class="input-container">
                                <i class="fa fa-id-card icon"></i>
                                <input type="text" class="form-control" name = "lname" required>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <label for="EmailAddress" class='form-text'>Email address</label>
                    <div class="input-container">
                        <i class="fa fa-envelope icon"></i>
                        <input type="email" class="form-control" id="emailID" aria-describedby="emailHelp" name = "email" required>
                    </div>
                </div>

                <div class="form-group">
                    <label for="username" class="form-text">Username</label>
                    <div class="input-container">
                        <i class="fa fa-user icon"></i>
                        <input type="text" class="form-control" id="username" name="username" required>
                    </div>
                </div>
                
                <div class="form-group">
                    <label for="password" class='form-text'>Password</label>
                    <div class='input-container'>
                        <i class="fa fa-key icon"></i>
                        <input type="password" class="form-control" required name='password' id='password'>
                        <i class='fa fa-eye-slash icon' id='togglePassword'></i>
                    </div>
                </div>

                <div class="form-group">
                    <label for="Re-Password" class='form-text'>Re-Enter Password</label>
                    <div class='input-container'>
                        <i class="fa fa-key icon"></i>
                        <input type="password" class="form-control" required name='confirm_password' id='repassword'>
                        <i class='fa fa-eye-slash icon' id='retogglePassword'></i>
                    </div>
                </div>

                <button type="submit" name='submit' class="btn btn-primary" id='submit-btn'>Register Now</button>

                <div id='bottom-text'>
                    <p class='form-text'>Already Registered? <a href='index.php'>Click here!</a></p>
                </div>

            </form>

        </div>

    </div>

    <script>

        /* Toggling password */
        const togglePassword = document.querySelector('#togglePassword');
        const password = document.querySelector('#password');
        togglePassword.addEventListener('click', function (e) {
            const type = password.getAttribute('type') === "password" ? 'text' : "password";
            password.setAttribute('type', type);
            const icotype = togglePassword.getAttribute('class') == 
            'fa fa-eye-slash icon' ? 'fa fa-eye icon' : 'fa fa-eye-slash icon'
            togglePassword.setAttribute('class', icotype)
        });

        /* Toggling Re-Enter Password */
        const retogglePassword = document.querySelector('#retogglePassword');
        const repassword = document.querySelector('#repassword');
        retogglePassword.addEventListener('click', function (e) {
            const type2 = repassword.getAttribute('type') === "password" ? 'text' : "password";
            repassword.setAttribute('type', type2);
            const icotype2 = retogglePassword.getAttribute('class') == 
            'fa fa-eye-slash icon' ? 'fa fa-eye icon' : 'fa fa-eye-slash icon'
            retogglePassword.setAttribute('class', icotype2)
        });

    </script>
    
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

  </body>
</html>