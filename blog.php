<?php
session_start();
$conn = new mysqli("localhost", "root", "", "myblog");
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
$title = $_GET['title'];
$query = $conn->prepare("SELECT * FROM blogs WHERE title =?");
$query->bind_param("s", $title);
$query->execute();

$result = $query->get_result();

$row = $result->fetch_assoc();

if ($row) {
    $body = $row['body'];
    $date = $row['publish_date'];
} else {
    $body = "Blog not found";
    $date = "";
}

$like = $row['likes'];
if (isset($_GET['likes']) && !isset($_SESSION['likes'][$title])) {
    $like += 1;
    $updateQuery = $conn->prepare("UPDATE blogs SET likes = ? WHERE title = ?");
    $updateQuery->bind_param("is", $like, $title);
    $updateQuery->execute();
    $_SESSION['likes'][$title] = true;
}
$comments = $conn->query("SELECT COUNT(*) AS comment_count FROM `comments` WHERE `blog_title` = '$title';")->fetch_assoc();
$comment_count = $comments["comment_count"];
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $commentText = $_POST["comment_text"];
    $commentName = $_POST["comment_name"];
    $commentEmail = $_POST["comment_email"];
    $commentPhone = $_POST["comment_phone"];
    $commentBlog = $title;
    $commentDate = date("Y-m-d");
    $insertCommentQuery = $conn->prepare("INSERT INTO `comments` (`comment`, `name`, `email`, `phone`, `date`, `blog_title`) VALUES (?, ?, ?, ?, ?, ?)");
    $insertCommentQuery->bind_param("ssssss", $commentText, $commentName, $commentEmail, $commentPhone, $commentDate, $commentBlog);
    $insertCommentQuery->execute();  
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link id="theme" href="css/head_footer_style.css" rel="stylesheet" type="text/css">
    <link href="css/blog_style.css" rel="stylesheet" type="text/css">
    <link rel="icon" href="images/icon.png" type="image/x-icon">
    <title><?php echo $title?></title>
</head>
<body>
    <header>
        <?php include 'header.php'?>
    </header>
    <main>
        <img src="images/up.png" alt="" class="icon" id="backtop">
        <div class='article'>
            <h1><?php echo $title?></h1>
            <p class="time">
                <img src="images/calendar.png" class = "icon" alt=""> 
                <?php echo ' Published: ';echo $date?>
            </p>
            <p class="body"><?php echo $body?></p>
            <div class="tags">
                <span>Tag: </span>
                <?php 
                    $result2 = $conn->query("SELECT `tag` FROM `tags` WHERE `blog_title`='$title';");
                    foreach ($result2 as $row2){
                        $tag = $row2['tag'];
                    ?>
                        <span class="tag"><?php echo $tag?></span>
                <?php
                    }
                ?>
            </div>
        </div>
        <div class="interact">
            <a href = "?title=<?php echo $title?>&likes=<?php echo $like?>"><img src="images/like.png" class = "icon" alt=""></a><span> <?php echo $like?></span>
            <img src="images/comment.png" class = "icon" alt="" id = "comment_btn"><span> <?php echo $comment_count?></span>
        
        </div>
        <hr class="spe">
        <div class="comments">
            <h3>Comments</h3>
            <div class="sort">
                <span>Sort by: </span>
                <a href="?title=<?php echo $title?>&sortby=newest">Newest |</a>
                <a href="?title=<?php echo $title?>&sortby=oldest">Oldest</a>
            </div>
        <?php 
            $order = " ORDER BY ROW_NUMBER() OVER (ORDER BY (SELECT NULL)) DESC";
            if (isset($_GET['sortby']) && $_GET['sortby'] == 'newest') {
                $order = " ORDER BY ROW_NUMBER() OVER (ORDER BY (SELECT NULL)) DESC";
            } else if (isset($_GET["sortby"]) && $_GET["sortby"] == 'oldest'){
                $order = " ORDER BY ROW_NUMBER() OVER (ORDER BY (SELECT NULL)) ASC";
            }
            $result = $conn->query("SELECT * FROM comments WHERE blog_title = '$title' $order;");
             foreach ($result as $row) {
                ?>
                <div class="eachComment">
                    <p class="com"><?php echo $row['comment']?></p>
                    <span class="name"><?php echo $row['name']?></span>
                    <span class="date"><?php echo $row['date']?></span>
                    
                    <hr>
                </div>
            <?php
                }
            ?>
            <form id="comment" method= "post" action= "">
                <label for="comment_text"><h3>Leave Your Comment*: </h3></label>
                <textarea name="comment_text" id="comment_text" required></textarea><br>
                <div>
                    <label for="comment_name"><h4>Name*: </h4></label>
                    <input type='text' name="comment_name" id="comment_name" required>
                </div>
                <div>
                    <label for="comment_email"><h4>Email: </h4></label>
                    <input type='email' name="comment_email" id="comment_email">
                </div>
                <div>
                    <label for="comment_phone"><h4>Contact Number: </h4> </label>
                    <input type='phone' name="comment_phone" id="comment_phone"><br>
                </div>
                <input type = "submit" value="Submit" id="submit" >
            </form>
        </div>
    </main>
    <footer>
        <?php include 'footer.php' ?>
    </footer>
</body>
<script src="script/blog_script.js"></script>
<script src="script/index_script.js"></script>
</html>