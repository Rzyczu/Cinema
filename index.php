    <?php
    session_start();

    if ((isset($_SESSION['login'])) && ($_SESSION['login'] == true)) {
        header('Location: cinema.php');
        exit();
    }

    $conn = @new mysqli('localhost', 'root', '', 'cinema_project');
    // sprawdzenie połączenia
    if ($conn->connect_errno) die('Brak połączenia');

    $username = '';
    $password = '';


    ?>
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <link rel="stylesheet" href="styles.css">
        <title>Login Page</title>
    </head>

    <body>
        <div id="block">
            <h1>Cinema</h1>
            <p>To book a movie, log in to your account.</p>
            <p>If you don't have an account, you can register on the same page</p>
            <br />
            <form action="" method="POST">
                <label>Username: </label><br /><input type="text" name="username" required /><br /><br />
                <label>Password: </label><br /><input type="text" name="password" required /><br /><br />
                <input class="login-btn" name="login" type="submit" value="Login " /><br />
                <input class="login-btn" name="register" type="submit" value="Register " /><br />
            </form>
            <?php
            
    if (isset($_POST['login'])) {
        $username = $_POST['username'];
        $password = $_POST['password'];
        //check login details
        $rs = $conn->query("SELECT * FROM users WHERE username = '$username' and password = '$password'") or die("Nie można edytować");
        if ($rs->num_rows > 0) {
            // session_register("username");
            $_SESSION['username'] = $username;
            $_SESSION['login'] = true;

            echo "<h3>Jestes zalogowany jako $username </h3>";

            header("location: cinema.php");
        } else {
            echo "<h3 class='wrong'>Wrong username or password</h3>";
        }
    }
    if (isset($_POST['register'])) {
        $username = $_POST['username'];
        $password = $_POST['password'];

        $rs = $conn->query("SELECT * FROM users WHERE username = '$username'");
        if ($rs->num_rows > 0) {
            echo " <h3 class='wrong'>A user with that name exists</h3>";
        } else {

            $sql = "INSERT INTO users(username, password) VALUES('$username','$password')";
            $password = '';
            echo "<h3>The account $username has been created</h3>";
            $username = '';

            $conn->query($sql) or die('Nie można dodać rekordu');
        }
    }
    ?>
        </div>
    </body>

    </html>