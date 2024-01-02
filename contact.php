<?php
    session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="images/icon.png" type="image/x-icon">
    <link id="theme" href="css/head_footer_style.css" rel="stylesheet" type="text/css">
    <link href="css/contact.css" rel="stylesheet" type="text/css">
    <title>Contact Me</title>
</head>
<body>
    <header>
        <?php include 'header.php'?>
    </header>
    <main>
        <h2>Contact Me</h2>
        <div class="contact_me" >
            <img src="images/avatar.png" alt="" class="avatar">
            <div class="info">
                <div>Location: Wellington，New Zealand</div>
                <div>Phone: +64 2102321434</div>
                <div>Email: 513557074@qq.com</div>
                <div class="social">Social Media: 
                    <li><a href="https://www.linkedin.com/in/yuye-zheng-6a5512116/"><img class="icon" src="images/linkedin.png" alt=""></a></li>
                    <li><a href="https://www.instagram.com/zzzoe_ye/"><img class="icon" src="images/instagram.png" alt=""></a></li>
                    <li><a href="https://github.com/zoe-yuye"><img class="icon" src="images/github.png" alt=""></a></li>
                </div>
            </div>
        </div>
        <h3 id="btn">Or Leave Me a Message</h3>
        <div class="message" id="message">
            <form method= "post" action= "">
                <label for="message_text"><h4>Message*: </h4></label>
                <textarea name="message_text" id="message_text" required></textarea><br>
                <label for="message_name"><h4>Name*: </h4></label><input type='text' name="message_name" id="message_name" required>
                <label for="message_email"><h4>Email: </h4></label><input type='email' name="message_email" id="message_email"> 
                <label for="message_phone"><h4>Contact Number: </h4></label><input type='phone' name="message_phone" id="message_phone"><br>
                <input type = "submit" value="Submit" id="submit" >
            </form>
            
        </div>
        <?php
            $conn = new mysqli("localhost", "root", "", "myblog");
            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                $messageText = $_POST["message_text"];
                $messageName = $_POST["message_name"];
                $messageEmail = $_POST["message_email"];
                $messagePhone = $_POST["message_phone"];
                $insertmessageQuery = $conn->prepare("INSERT INTO `messages` (`message`, `name`, `email`, `phone`) VALUES (?, ?, ?, ?)");
                $insertmessageQuery->bind_param("ssss", $messageText, $messageName, $messageEmail, $messagePhone);
                $insertmessageQuery->execute();
                echo '<script>alert("Message sent successfully!");</script>';  
            }
        ?>
        <script>
            let form = document.getElementById('message');
            let btn =document.getElementById('btn');
            let display = false;
            btn.addEventListener('click', function(event){
                if (!display) {
                    form.style.display = 'block'; 
                    display = true;
                } else {
                    form.style.display = 'none'; 
                    display = false;
                }
            });
        </script>
    </main>
    <footer>
        <?php include 'footer.php' ?>
    </footer>
</body>
<script src="script/index_script.js"></script>
</html>