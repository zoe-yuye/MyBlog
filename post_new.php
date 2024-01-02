<?php
session_start();
$conn = new mysqli("localhost", "root", "", "myblog");
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $blogTitle = $_POST["blog_title"];
    $result = $conn->query("SELECT COUNT(*) FROM `blogs` WHERE `title` = '$blogTitle'");
    $count = $result->fetch_assoc()['COUNT(*)'];
    if ($count == 0) {
        $blogBody = $_POST["blog_text"];
        $publishDate = date("Y-m-d");
        $insertBlog = $conn->prepare("INSERT INTO `blogs` (`title`, `body`, `publish_date`, `likes`) VALUES (?, ?, ?, '0')");
        $insertBlog->bind_param("sss", $blogTitle, $blogBody , $publishDate);
        $insertBlog->execute();  
        
        if (isset($_POST['selectedTags']) && is_array($_POST['selectedTags'])) {
            foreach ($_POST['selectedTags'] as $selectedTag) {
                $insertTag = $conn->prepare("INSERT INTO `tags` (`tag`, `blog_title`) VALUES (?, ?)");
                $insertTag->bind_param("ss", $selectedTag, $blogTitle);
                $insertTag->execute(); 
            }
        }
    
        if (isset($_POST['new_tags']) ) {
            $newTags = $_POST['new_tags'];
            $newTagsArray = explode(',', $newTags);
            foreach ($newTagsArray as $newTag) {
                $insertNewTag = $conn->prepare("INSERT INTO `tags` (`tag`, `blog_title`) VALUES (?, ?)");
                $insertNewTag->bind_param("ss", $newTag, $blogTitle);
                $insertNewTag->execute(); 
            }
        }
        header("Location: blog_page.php");
        echo '<script>alert("Blog published successfully!");</script>';  
    }else{
        echo '<script>alert("Invaild Title!");</script>'; 
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link id="theme" href="css/head_footer_style.css" rel="stylesheet" type="text/css">
    <link href="css/post_new_style.css" rel="stylesheet" type="text/css">
    <link rel="icon" href="images/icon.png" type="image/x-icon">
    <title>Publish New Blog</title>
</head>
<body>
    <header>
        <?php include 'header.php'?>
    </header>
    <main>
    <h2>Publish New Blog </h2>
        <form id="blog" method= "post" action= "">
            <div>
                <label for="blog_title"><h4>Title: </h4></label>
                <input type='text' name="blog_title" id="blog_title" required>
            </div>
            <label for="blog_text"><h4>Body: </h4></label>
            <textarea name="blog_text" id="blog_text" required></textarea><br>
            <label for="addTag"><h4>Add Tag: </h4></label>
            <div class="tags">
                <span>Tags:</span>
                <?php
                    $result = $conn->query("SELECT `tag` FROM tags GROUP BY `tag`;");
                    foreach ($result as $row) {
                        $tag = $row['tag'];
                ?>
                    <div class="tag">
                        <input type="checkbox" name="selectedTags" value="<?php echo $tag; ?>">
                        <span><?php echo $tag; ?></span>
                    </div>
                <?php
                }
                ?>
                <div>
                    <label for="new_tags">New Tags: </label>
                    <p class="hint">If you want to add multiple tags, please separate them with commas.</p>
                    <input type='text' name="new_tags" id="new_tags">
                </div>
            </div>
            <input type = "submit" value="Post" id="submit" >
            
        </form>
    </main>
    <footer>
        <?php include 'footer.php' ?>
    </footer>
</body>
<script src="script/index_script.js"></script>
</html>