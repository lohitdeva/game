<?php
    session_start();

    $username = $_SESSION["username"];

    if(array_key_exists('submit',$_POST)){

        $link = mysqli_connect('localhost','root','','game_db');

        if(mysqli_connect_error()) {
            die("There was a problem connecting to the database");
        }

        $query = "SELECT * FROM `memory-game-scores` WHERE uname ='".$username."'";
        $result = mysqli_query($link,$query);

        if(mysqli_num_rows($result) > 0) {

            $query = "SELECT score FROM `memory-game-scores` WHERE uname ='".$username."'";
            $result = mysqli_query($link,$query);
            $row = mysqli_fetch_array($result);
            $score = $row['score'];

            $current_score = intval($_COOKIE['reactionTimeScore']);

            if ($current_score < $score){
                $query = "UPDATE `memory-game-scores` SET score = ".$current_score." WHERE uname = '".$username."'";
                mysqli_query($link,$query);
            }
        }
        else {
            $query = "INSERT INTO `memory-game-scores` (`uname`, `score`) VALUES ('".$username."', ".intval($_COOKIE['reactionTimeScore']).")";
            mysqli_query($link,$query);
        }

        unset($_COOKIE['reactionTimeScore']);
        header("location: ../home.php");
    }
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0 shrink-to-fit=no">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

    <!-- FontAwesome CSS -->
    <link rel="stylesheet" href= "https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    
    <!-- Google Fonts Stylesheet -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Tiro+Telugu&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Silkscreen&family=Tiro+Telugu&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="styles.css">
    <title>Reaction Time game</title>
</head>

<body style="background-color:#ECDBAB">
    <div class="container">
        <div class="jumbotron">
            <h1 class="heading">Game: Reaction Time Test</h1>
            <h2 class="heading">User: <?php echo $username ?></h2>
            <div class="centered" id="game">
                <div id="app">
                    <div class="click-area">
                        <div class="display-text">Welcome. Click to start!</div>
                    </div>
                    <div class="recent-scores">
                        <div class="score">-</div>
                        <div class="score">-</div>
                        <div class="score">-</div>
                        <div class="score">-</div>
                        <div class="score">-</div>
                    </div>
                </div>
            </div>
            <div class="average-score"></div>
            <form method="post" class="centered">
                <button type="submit" name="submit" id="submit" class="btn btn-primary">Exit Game</button>
                <a href="leaderboard.php" class="btn btn-primary" role="button">Show Leaderboard</a>
            </form>
        </div>
    </div>

    <script src="index.js"></script>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</body>

</html>