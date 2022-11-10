<?php

$link = mysqli_connect("localhost", "root", '','game_db');

if(mysqli_connect_error()){
  die("There was a problem connecting to the database");
}

$query = "SELECT * FROM `hangman-game-scores` ORDER BY score DESC";

$result = mysqli_query($link, $query);

?>

<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

    <!-- Google Fonts Stylesheet -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Tiro+Telugu&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Silkscreen&family=Tiro+Telugu&display=swap" rel="stylesheet">

    <style>

    .jumbotron {
        background-color: #e9e1e1;
        margin-top: 50px;
    }

    h1 {
        font-family: 'Silkscreen', cursive;
        color: #15502C;
    }

    .table {
        background-color: #f2f2f2;
        margin-top: 50px;
    }

    .btn-primary {
        background-color: #15502C;
        border-color: #0f3d20;
    }

    .btn-primary:hover {
        background-color: #289b54;
        border-color: #0f3d20;
    }

    </style>


    <title>Reaction Time Leaderboard</title>
  </head>
  <body style="background-color:#ECDBAB">
    <div class="container">
        <div class="jumbotron">
            <h1>Reaction Time Leaderboard</h1>
            <table class="table">
                <thead>
                    <th scope="col">Username</th>
                    <th scope="col">Score</th>
                </thead>
                <tbody>
                    <?php while($row = mysqli_fetch_array($result)) :?>
                        <tr>
                            <td><?=$row[1]?></td>
                            <td><?=$row[2]?></td>
                        </tr>
                    <?php endwhile?>
                </tbody>
            </table>
            <a href="index.php" class="btn btn-primary" role="button">Go Back</a>
        </div>
    </div>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
  </body>
</html>