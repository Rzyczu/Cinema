<?php
session_start();

if ((isset($_SESSION['login'])) && ($_SESSION['login'] == true)) {
    if ($_SESSION['filmSelect'] != true) {
        header('Location: films.php');
        exit();
    }
} else{
    header('Location: login.php');
    exit();
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Booking</title>
    <link rel="stylesheet" href="styles.css">

    <link rel="stylesheet" href="cinema.css">

    <?php


$conn = @new mysqli('localhost', 'root', '', 'cinema_project');
$film_id = $_SESSION['film_id'];
if ($conn->connect_errno) die('Brak połączenia');
$rs = $conn->query("SELECT film, data, time FROM films WHERE id = $film_id");
if ($rs->num_rows > 0) {
    // session_register("username");
    while ($row = $rs->fetch_assoc()) {
        $name = $row['film'];
        $date = $row['data'];
        $hour = $row['time'];
    }
}


    echo "<script>
            const film = '$name';
            const date = '$date';
            const hour = '$hour';
            var booked=[];
        </script>";
    $conn = @new mysqli('localhost', 'root', '', 'cinema_project');
    // sprawdzenie połączenia
    if ($conn->connect_errno) die('Brak połączenia');
    $result = $conn->query("SELECT id, name, date, time, row, col FROM booked") or die('Nie można pobrać danych');
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            if ($name == $row["name"] && $date == $row["date"] && $hour == $row["time"]) {
                // echo  $row["row"] . $row["col"] . "<br>";

                echo "<script>
                booked.push(['", $row["row"], $row["col"], "'])           
            
            </script>";
            }
        }
    } else {
        echo "0 results";
    }
    ?>

</head>

<body>
    <div id="block">
    <header>
        <h1>Cinema</h1>
        <h3 id="filmInfo"></h3>
    </header>
    <div id="sala">
        <div id="ekran">SCREEN</div>
    </div>
    <form action="" method="POST">
        <input type="hidden" id="filmName" name="name" value="" />
        <input type="hidden" id="filmDate" name="date" value="" />
        <input type="hidden" id="filmHour" name="hour" value="" />

        <input type="hidden" id="col" name="col" value="" />
        <input type="hidden" id="row" name="row" value="" />
        <!-- <h3>Witaj <?php echo $_SESSION['username'] ?></h3> -->
        <br /> <br />
        <input class="login-btn" type="submit" name="akcja" value="Book" /></br></br>
    </form>

    <script>

    </script>
    <?php

echo '<form action="" method="POST">';
echo "<input name='back' class='login-btn' type='submit' value='Back to the preview page' />";
echo '</form>';
if (isset($_POST['back'])) {
    unset($_SESSION['filmSelect']);
    echo "<script>window.location.reload()</script>";
}

    $conn = @new mysqli('localhost', 'root', '', 'cinema_project');
    // sprawdzenie połączenia
    if ($conn->connect_errno) die('Brak połączenia');
    if (isset($_POST['akcja'])) {
        $name = $_POST['name'];
        $date = $_POST['date'];
        $hour = $_POST['hour'];
        $row = $_POST['row'];
        $col = $_POST['col'];
        $usernam = ($_SESSION['username']);


        if (!empty($row) && !empty($col)) {

            echo "<h3>", ucwords($usernam);
            echo ", You booked place $row$col for film $name.</h3>";
            echo "<h4>You must refresh page to see your results</h4>";

            echo "<input onClick='window.location.reload();' class='login-btn' type='submit' value='Refresh page' />";

            //  $username = $_SESSION['username']
            $sql = "INSERT INTO booked (`name`,`date`,`time`,`row`,`col`,`username`) VALUES ('$name', '$date', '$hour', '$row', '$col','$usernam')";
            $conn->query($sql) or die('Error');
            $row = null;
            $col = null;

        } else {
            echo "<h3 class='wrong'>Enter data again</h3>";
        }
    }
    ?>
</div>
<script src="cinema.js" defer></script>

</body>

</html>