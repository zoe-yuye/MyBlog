<?php
session_start();
$conn = new mysqli("localhost", "root", "", "myblog");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Zoe's Blog</title>
    <link rel="icon" href="images/icon.png" type="image/x-icon">
    <link id="theme" href="css/head_footer_style.css" rel="stylesheet" type="text/css">
    <link href="css/index.css" rel="stylesheet" type="text/css">
</head>
<body>
    <header>
        <?php include 'header.php'?>
        <h1>Welcome to Zoe's Blog!</h1>
    </header>
    <main>
        <img src="images/up.png" alt="" class="icon" id="backtop">
        <div class="content">
            <div class="about_me">
                <div class="my_info">
                <a href="contact.php"><img src="images/me.png" alt="" class="avatar"></a>
                    <div class="me">
                        <p class="name">Zoe Zheng</p>
                        <ul class="my_info">
                            <li><a href="https://www.linkedin.com/in/yuye-zheng-6a5512116/"><img class="icon" src="images/linkedin.png" alt=""></a></li>
                            <li><a href="https://www.instagram.com/zzzoe_ye/"><img class="icon" src="images/instagram.png" alt=""></a></li>
                            <li><a href="https://github.com/zoe-yuye"><img class="icon" src="images/github.png" alt=""></a></li>   
                    </ul>
                    </div>
                </div>
                <p class="intro">Embarking on a self-learning journey in software development, I discovered a deep passion for IT that led me to pursue a Master's Degree in Software Development. With a background in International Economy and Trade and over two years in hospitality management, my diverse experiences from backpacking to various jobs have honed my adaptability and problem-solving skills.
                    <br><br> As I transition into the IT field, I'm excited to blend my love for travel, photography, and coding. 
                    Join me on my blog as I explore the intersection of tech, creativity, and adventures on the road!<p>
            </div>
            <div class="skills">
                <h2>My Skills</h2>
                <?php include 'skills.php'?>
            </div>
            <div class="my_blog">
                <h2>Blog Wolrd</h2>
                <?php 
                    $result = $conn->query("SELECT * FROM blogs ORDER BY publish_date DESC LIMIT 2;");
                    foreach ($result as $row) {
                    $title = $row['title'];
                ?>
                <div class="blog">
                    <a href="blog.php?title=<?php echo urlencode($row['title']); ?>"><h3 class="title"><?php echo $row['title']?></h3></a>
                    <br>
                    <?php
                        $text = $row['body'];
                        $maxWords = 100;
                        $words = explode(' ', $text);
                        if (count($words) > $maxWords) {
                            $words = array_slice($words, 0, $maxWords);
                            $text = implode(' ', $words) . '...';
                        }
                        echo '<p class="body">' . $text . '</p>';
                    ?>
                    <br>
                    <p class="date"><?php echo ' Published: '; echo $row['publish_date']?>
                        <?php
                            $comments = $conn->query("SELECT COUNT(*) AS comment_count FROM `comments` WHERE `blog_title` = '$title';")->fetch_assoc();
                            $comment_count = $comments["comment_count"];
                            echo "| ";
                            ?>
                            <img src="images/comment.png" class = "icon" alt="">
                            <?php 
                            echo $comment_count;
                        ?>
                        <?php
                            if(isset($row['likes']) && $row['likes'] !=0){
                                echo "| ";
                                ?>
                                <img src="images/like.png" class = "icon" alt="">
                                <?php 
                                echo$row['likes'];
                            }
                        ?>
                    </p>
                    <hr>
                </div>
                <?php
                    }
                ?>
                <a href="blog_page.php"><h5 class="btn">See More</h5></a>
            </div>
            <div class="gallery">
                <h2>My Gallery</h2>
                <ul>    
                    <?php
                        $result = $conn->query("SELECT `path` FROM photos ORDER BY 'path';");
                        foreach ($result as $row) {
                            $path = $row['path'];
                    ?>
                    <li><img src="<?php echo $path?>" alt=""></li>
                    <?php
                        }
                    ?>
                </ul>
                <a href="gallery.php"><h5 class="btn">See More</h5></a>
            </div>
        </div>
        
    </main>
    <footer>
        <?php include 'footer.php' ?>
    </footer>
</body>
<script src="script/index_script.js"></script>
</html>