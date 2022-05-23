<?php
session_start();

if ((isset($_SESSION['login'])) && ($_SESSION['login'] == true)) {
} else {
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
        <link rel="stylesheet" href="styles.css">
        <title>Booking</title>
    </head>

    <body>
    <div id="block">

<?php
echo '<h1>Films</h1>';
echo "<form action='' method='POST'>";

echo '<table><tr><th>Name</th><th>Date</th><th>Hour</th><th>Select</th></tr>';

$conn = @new mysqli('localhost', 'root', '', 'cinema_project');
// sprawdzenie połączenia
if ($conn->connect_errno) die('Brak połączenia');
$result = $conn->query("SELECT id, film, data, time FROM films") or die('Nie można pobrać danych');

if ($result->num_rows > 0) {

    while ($row = $result->fetch_assoc()) {
        echo "<tr>";

        echo '<td>',$row["film"],'</td>';
        echo '<td>',$row["data"],'</td>';
        echo '<td>',$row["time"],'</td>';
        echo '<td><input type="radio" name="filmik" value="',$row["id"],'"></td> ';

        echo  "</tr>";

    }
        

} else {
    echo "0 films";
}

echo '</table>';
echo '<input class="login-btn" name="submit" type="submit" value="Book"/>';
echo '</form>';
echo '<form action="" method="POST">';
echo "<input name='back' class='login-btn' type='submit' value='Log out' />";
echo '</form>';
if (isset($_POST['back'])) {
    unset($_SESSION['login']);
    echo "<script>window.location.reload()</script>";
}
if (isset($_POST['submit'])) {
    if (isset($_POST['filmik'])) {

    $id = $_POST['filmik'];
    $_SESSION['filmSelect'] = true;

    $_SESSION['film_id']= $id;



    ;
    header('Location: cinema.php');
    }    else {
        echo "<h3 class='wrong'>You have to choose a movie.</h3>";
    }

}
?>
        </div>
    </body>
</html>