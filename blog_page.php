<?php
session_start();
$conn = new mysqli("localhost", "root", "", "myblog");
$addBlog ='';
if (isset($_SESSION['admin'])) {
    $addBlog ='<h3 class="post_new"><a href="post_new.php">Publish New Blog</a></h3>';
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link id="theme" href="css/head_footer_style.css" rel="stylesheet" type="text/css">
    <link rel="icon" href="images/icon.png" type="image/x-icon">
    <link href="css/blog_page_style.css" rel="stylesheet" type="text/css">
    <title>My Blog</title>
</head>
<body>
    <header>
        <?php include 'header.php'?>
    </header>
    <main>
        <img src="images/up.png" alt="" class="icon" id="backtop">
        <div class="my_blog">
                <a href=""><h2>Blog Wolrd</h2></a>
                <div class="nav">
                    <div class="sort">
                        <div>
                            <img src="images/filter.png" alt="" class="icon">
                            <span>Sort by: </span>
                            <a href="?sortby=timedesc"><button id="sortByTimeD">Newest</button></a>
                            <a href="?sortby=timeasc"><button id="sortByTimeA">Oldest</button></a>
                            <a href="?sortby=popularity"><button id="sortByPop">Popularity</button></a>
                            <a href="?sortby=title"><button id="sortByTitle">Title</button></a>
                        </div>
                        <form id="search" method= "get" action= "">
                            <label for="search_text"><img src="images/search.png" alt="" class="icon"></label>
                            <input type="text" name="search_text" id="search_text" required>
                            <input type = "submit" value="Search" id="submit">
                        </form>
                    </div>
                    <div class="tags">
                            <span>Tags:</span>
                            <?php
                                $result = $conn->query("SELECT `tag` FROM tags GROUP BY `tag`;");
                                foreach ($result as $row) {
                                $tag = $row['tag'];
                            ?>
                                <a href="?tagby=<?php echo $tag; ?>"><span class="tag"><?php echo $tag?></span></a>
                            <?php
                                }
                            ?>
                    </div>
                </div>
                <?php echo $addBlog?>
                <?php 
                    $order = " ORDER BY publish_date DESC";
                    $search = "";
                    if(isset($_GET["search_text"]) ){
                        $searchText = $_GET["search_text"];
                        $search = "LEFT JOIN `tags` ON blogs.title = tags.blog_title WHERE blogs.title LIKE '%$searchText%' OR blogs.body LIKE '%$searchText%' OR tags.tag LIKE '%$searchText%' GROUP BY blogs.title";
                    }
                    if (isset($_GET['sortby']) && $_GET['sortby'] == 'popularity') {
                        $order = " ORDER BY likes DESC";
                    } else if (isset($_GET["sortby"]) && $_GET["sortby"] == 'timedesc'){
                        $order = " ORDER BY publish_date DESC";
                    }else if (isset($_GET["sortby"]) && $_GET["sortby"]== 'title'){
                        $order = " ORDER BY title ASC";
                    }else if (isset($_GET["sortby"]) && $_GET["sortby"] == 'timeasc'){
                        $order = " ORDER BY publish_date ASC";
                    }
                    if (isset($_GET["tagby"]) ) {
                        $result = $conn->query("SELECT `tag` FROM tags GROUP BY `tag`;");
                        foreach ($result as $row) {
                            $tag = $row['tag'];
                            if($_GET["tagby"] == $tag){
                            $search = "LEFT JOIN `tags` ON blogs.title = tags.blog_title WHERE tags.tag = '$tag' GROUP BY blogs.title";
                            }
                        }
                    }
                    $result = $conn->query("SELECT * FROM blogs $search $order;");
                    foreach ($result as $row) {
                        $title = $row['title'];
                ?>
                        <div class="blog">
                            <h3 class="title">
                                <a href="blog.php?title=<?php echo urlencode($row['title']); ?>"><?php echo $row['title']?></a>
                            </h3>
                            <?php
                                $text = $row['body'];
                                $maxWords = 150;
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
                                    echo "| ";
                                    ?>
                                    <img src="images/like.png" class = "icon" alt="">
                                    <?php 
                                    echo$row['likes'];
                                    
                                ?>
                            </p>
                        </div>
                <?php
                    }
                ?>
            </div>
    </main>
    <footer>
        <?php include 'footer.php' ?>
    </footer>
</body>
<script src="script/index_script.js"></script>
</html>