<?php
$login="";
if (!isset($_SESSION['admin'])) {
    $login ='<li><a href="login.php"><img class="icon" id="login" src="images/login.png" alt=""></a></li>';
}else{
    $login ='<li><a href="logout.php"><img class="icon" id="logout" src="images/logout.png" alt=""></a></li>';
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<audio controls>
            <source src="bgm.mp3" type="audio/mp3">
        </audio>
        <div class="navBar">
            <div class="logo">
                <img class="myicon" src="images/icon.png" alt="">
                <a href="index.php">Zoe's Blog</a>
            </div>
            <ul class="links">
                <li><a href="index.php">Home</a></li>
                <li><a href="blog_page.php">Blog</a></li>
                <li><a href="gallery.php">Photograph</a></li> 
                <li><a href="contact.php">Contact</a></li>   
            </ul>
            <div class="nav_right">
                <div class="setting">
                    <li><img class="icon" id="light" src="images/light.png" alt=""></li>
                    <li><span id="mute">\</span><img class="icon" id="music" src="images/music.png" alt=""></li>
                    <?php echo $login?>
                </div>
                <div class="toggle_btn">
                    <img class="hamburger_icon" src="images/hamburger.png" alt="">
                </div>
            </div>
            
        </div>
        <div class="dropdown_menu">
            <li><a href="index.php">Home</a></li>
            <li><a href="blog_page.php">Blog</a></li>
            <li><a href="gallery.php">Photograph</a></li> 
            <li><a href="contact.php">Contact</a></li>
        </div>
</body>
</html>