<?php
if (isset($_POST['submit'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $conn = mysqli_connect("localhost", "root", "", "myappp");

    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }

    $sql = "SELECT * FROM users WHERE username='$username' AND password='$password'";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) > 0) {
        session_start();
        $_SESSION['loggedin'] = true;
        $_SESSION['username'] = $username;
        header("Location: index.php");
    } else {
        echo "Invalid username or password";
    }

    mysqli_close($conn);
}
?>



<html lang="en">

<head>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css">
    <link rel="stylesheet" href="style.css">
    <title>login</title>
</head>


<body>
    <div class="wrapper">
        <?php if (isset($error)) { ?>
            <div class="alert alert-danger"><?php echo $error; ?></div>
        <?php } ?>
        <div class="title">
            Losin Form
        </div>
        <form action="" method="post">
            <div class="field">
                <input type="text" id="username" name="username" required>
                <label>Username</label>
            </div>
            <div class="field">
                <input type="password" id="password" name="password" required>

                <label>password</label>
            </div>
            <div class="content">
                <div class="checkbox">
                    <input type="checkbox" id="remember-me">
                    <label for="remember-me">Remember me</label>
                </div>

            </div>
            <div class="field">
                <input type="submit" name="submit" value="Submit">
            </div>

        </form>
    </div>
</body>

</html>