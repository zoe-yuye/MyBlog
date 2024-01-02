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
        <h1>Welcome to Zoe's Blog!</h1>
        <?php include 'header.php'?>
    </header>
    <main>
        <img src="images/up.png" alt="" class="icon" id="backtop">
        <div class="content">
            <div class="about_me">
                <div class="my_info">
                    <img src="images/me.png" alt="" class="avatar">
                    <div class="me">
                        <p class="name">Zoe Zheng</p>
                        <ul class="my_info">
                            <li><a href="https://www.linkedin.com/in/yuye-zheng-6a5512116/"><img class="icon" src="images/linkedin.png" alt=""></a></li>
                            <li><a href="https://www.instagram.com/zzzoe_ye/"><img class="icon" src="images/instagram.png" alt=""></a></li>
                            <li><a href="https://github.com/zoe-yuye"><img class="icon" src="images/github.png" alt=""></a></li>   
                    </ul>
                    </div>
                </div>
                <p class="intro">I'm a software development student who loves travel, photography, and coding. Follow my blog for a peek into the world of tech, creativity, and my adventures on the road. <p>
            </div>
            <div class="my_blog">
                <h2>Blog Wolrd</h2>
               
                <?php 
                    $result = $conn->query("SELECT * FROM blogs ORDER BY publish_date DESC LIMIT 3;");
                    foreach ($result as $row) {
                    $title = $row['title'];
                ?>
                <div class="blog">
                    <h3 class="title"><a href="blog.php?title=<?php echo urlencode($row['title']); ?>"><?php echo $row['title']?></a></h3>
                    <p class="body"><?php echo $row['body']?></p>
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