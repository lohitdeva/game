<?php

    //Initialize the session
    session_start();

    $link = mysqli_connect('localhost','root','','game_db');

    if(mysqli_connect_error()) {
        die("There was a problem connecting to the database");
    }

    //Check if the user is already logged in, if yes then redirect him to welcome page
    if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] == true) {
        header("location: home.php");
        exit;
    }

    // Define variables and initialize with empty values
    $username = $password = "";
    $username_err = $password_err = $login_err = "";

    // Processing form data when form is submitted
    if($_SERVER["REQUEST_METHOD"] == "POST"){
 
        // Check if username is empty
        if(empty(trim($_POST["username"]))){
            $username_err = "Please enter username.";
        } else{
            $username = trim($_POST["username"]);
        }
    
        // Check if password is empty
        if(empty(trim($_POST["password"]))){
            $password_err = "Please enter your password.";
        } else{
            $password = trim($_POST["password"]);
        }
    
        // Validate credentials
        if(empty($username_err) && empty($password_err)){
            // Prepare a select statement
            $sql = "SELECT `id`, `uname`, `password` FROM `users` WHERE `uname` = ?";
        
            if($stmt = mysqli_prepare($link, $sql)){
                // Bind variables to the prepared statement as parameters
                mysqli_stmt_bind_param($stmt, "s", $param_username);
            
                // Set parameters
                $param_username = $username;
            
                // Attempt to execute the prepared statement
                if(mysqli_stmt_execute($stmt)){
                    // Store result
                    mysqli_stmt_store_result($stmt);
                
                    // Check if username exists, if yes then verify password
                    if(mysqli_stmt_num_rows($stmt) == 1){                    
                        // Bind result variables
                        mysqli_stmt_bind_result($stmt, $id, $username, $hashed_password);
                        if(mysqli_stmt_fetch($stmt)){
                            if(password_verify($password, $hashed_password)){
                                // Password is correct, so start a new session
                                session_start();
                            
                                // Store data in session variables
                                $_SESSION["loggedin"] = true;
                                $_SESSION["id"] = $id;
                                $_SESSION["username"] = $username;                            
                            
                                // Redirect user to welcome page
                                header("location: home.php");
                            } else{
                                // Password is not valid, display a generic error message
                                $login_err = "Invalid username or password.";
                            }
                        }
                    } else{
                        // Username doesn't exist, display a generic error message
                        $login_err = "Invalid username or password.";
                    }
                } else{
                    echo "Oops! Something went wrong. Please try again later.";
                }

                // Close statement
                mysqli_stmt_close($stmt);
            }
    }
    
    // Close connection
    mysqli_close($link);

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

        <!-- Google Fonts Stylesheet-->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Tiro+Telugu&display=swap" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css2?family=Silkscreen&family=Tiro+Telugu&display=swap" rel="stylesheet">

        <style>

            #logo {
                width:20%;
                height:20%;
            }

            .centered{
                display:flex;
                justify-content: center;
            }

            #img_container {
                padding-top: 25px;
            }

            .jumbotron {
                margin-top: 50px;
            }

            #submit-btn {
                margin-right: 50px;
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

            #form-box {
                background-color: #9C231B;
            }

            .btn-primary {
                background-color: #15502C;
                border-color: #0f3d20;
            }

            .btn-primary:hover {
                background-color: #289b54;
                border-color: #0f3d20;
            }

            .form-control {
                border: 1px solid black;
            }

            .form-text {
                font-family: 'Tiro Telugu', serif;
                color: white;
                font-size: 20px;
                font-weight: bold;
            }

            #heading {
                text-align: center;
                padding-top: 40px;
                font-family: 'Silkscreen', cursive;
                font-size: 50px;
                color: #15502C;
            }


        </style>

        <title>Login</title> 
    </head>

    <body style="background-color:#ECDBAB">

        <div class="container">

            <div class="container" id='img_container'>
                <div class='centered'>
                    <img src="mes logo.png" alt="MES Logo" id='logo' class="img-fluid">
                </div>
            </div>
            
            <div><h1 id='heading'>MES Gaming Portal</h1></div>

            <div class="jumbotron" id='form-box'>
                <form method='post'>
                    <div class="form-group">
                        <label for="EmailAddress" class='form-text'>Username</label>
                        <div class="input-container">
                            <i class="fa fa-user icon"></i>
                            <input type="text" class="form-control" id="username" name="username" placeholder="Enter username">
                        </div>  
                    </div>

                    <div class="form-group">
                        <label for="Password" class='form-text'>Password</label>
                        <div class='input-container'>
                            <i class="fa fa-key icon"></i>
                            <input type="password" class="form-control" placeholder="Password" name = "password" id='password'>
                            <i class='fa fa-eye-slash icon' id='togglePassword'></i>
                        </div>
                    </div>

                    <div class="centered">
                        <button type="submit" class="btn btn-primary" id='submit-btn' name='submit'>Submit</button>
                        <a href="register.php" class="btn btn-primary" role="button">Register New User</a>
                    </div>

                </form>
            </div>
        </div>

        <script>

            const togglePassword = document.querySelector('#togglePassword');
            const password = document.querySelector('#password');
            togglePassword.addEventListener('click', function (e) {
                const type = password.getAttribute('type') === "password" ? 'text' : "password";
                password.setAttribute('type', type);
                const icotype = togglePassword.getAttribute('class') == 'fa fa-eye-slash icon' ? 'fa fa-eye icon' : 'fa fa-eye-slash icon'
            togglePassword.setAttribute('class', icotype)
        });

        </script>

        <!-- Optional JavaScript -->
        <!-- jQuery first, then Popper.js, then Bootstrap JS -->
        <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>

        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

    </body>

</html>