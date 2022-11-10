<?php

    session_start();

    $username = $_SESSION["username"];

    if(array_key_exists('reaction',$_POST)){
        header("location: reaction-time-game/index.php");
    } elseif(array_key_exists('hangman',$_POST)){
        header("location: hangman-game/index.php");
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

        <title>Welcome</title>

        <style>

            #heading-text{
                font-family: 'Silkscreen', cursive;
                color: #15502C;
            }

            #welcome {
                font-size: 3rem;
            }

            .jumbotron {
                background-color: #9C231B;
            }

            .centered{
                display:flex;
                justify-content: center;
            }

            #reaction-button {
                margin-right: 50px;
                width: 20em;
                height: 10em;
            }

            #hangman-button{
                width: 20em;
                height: 10em;
            }

            .btn-primary {
                background-color: #15502C;
                border-color: #0f3d20;
            }

            .btn-primary:hover {
                background-color: #289b54;
                border-color: #0f3d20;
            }

            #log-out{
                margin-top: 20px;
            }

        </style>

    </head>

    <body style="background-color:#ECDBAB">

        <div class="container">

            <div id='heading-text'>
                <h1 id='welcome'>Welcome <?php echo $username?></h1>
            </div>

            <div class="jumbotron">
                <div class="centered">
                    <form method="post">
                        <button type='submit' class="btn btn-primary" name='reaction' id="reaction-button">Reaction Time Test</button>
                        <button type='submit' class="btn btn-primary" name='hangman' id="hangman-button">Hangman</button>
                    </form>
                </div>
                
                <div class="centered" id="log-out"><a href="logout.php" class="btn btn-primary" role="button">Log Out</a></div>
            </div>

        </div>

        </script>
    
        <!-- Optional JavaScript -->
        <!-- jQuery first, then Popper.js, then Bootstrap JS -->
        <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

    </body>
</html>