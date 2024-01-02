<?php
session_start();
$conn = new mysqli("localhost", "root", "", "myblog");
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"];
    $password = $_POST["password"];
    $result = $conn->query("SELECT * FROM `admins` WHERE `username` = '$username' AND `password` = '$password'");

    if ($result->num_rows > 0) {
        $_SESSION["admin"] = $username;
        header("Location: blog_page.php");
        exit();
    } else {
        $error = "Invalid username or password";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link id="theme" href="css/head_footer_style.css" rel="stylesheet" type="text/css">
    <link href="css/login.css" rel="stylesheet" type="text/css">
    <link rel="icon" href="images/icon.png" type="image/x-icon">
    <title>Log In</title>
</head>
<body>
    <header>
        <?php include 'header.php'?>
    </header>
    <main>
        <div class="login">
            <h2>Admin Login</h2>
            <img src="images/avatar.png" alt="" class="avatar">
            <?php 
                if (isset($error)) {  
            ?>
                <p><?php echo $error; ?></p>
            <?php 
                }
            ?>
            <form method="post" action="">
                <label for="username"><img src="images/login.png" alt="" class="icon">Username:</label>
                <input type="text" name="username" id="username" required><br>
                <label for="password"><img src="images/password.png" alt="" class="icon">Password:</label>
                <input type="password" name="password" id="password" required><br>
                <input type="submit" value="Login" id="submit">
            </form>
        </div>  
    </main>
    <footer>
        <?php include 'footer.php' ?>
    </footer>
    
</body>
<script src="script/index_script.js"></script>
</html>