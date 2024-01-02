<?php
session_start();
$conn = new mysqli("localhost", "root", "", "myblog");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="images/icon.png" type="image/x-icon">
    <link id="theme" href="css/head_footer_style.css" rel="stylesheet" type="text/css">
    <link href="css/gallery_style.css" rel="stylesheet" type="text/css">
    <title>My Gallery</title>
</head>
<body>
    <header>
        <?php include 'header.php'?>
    </header>
    <main>
        <img src="images/up.png" alt="" class="icon" id="backtop">
        <div id="slide">
            <?php
             $result = $conn->query("SELECT * FROM photos ORDER BY 'path';");
             foreach ($result as $row) {
                $path = $row['path'];
                $name = $row['name'];
                $description = $row['description'];
            ?>
            <div class="item" style="background-image: url(<?php echo $path?>);">
                <div class="content">
                    <div class="name"><?php echo $name?></div>
                    <div class="description"><?php echo $description?></div>
                    <a href="download.php?filename=<?php echo $path?>"><button>Download</button></a>
                </div>
            </div>
            <?php
                }
            ?>
            
        </div>
        <div class="swift">
            <div id="swift1">&#8743</div>
            <div id="swift2">&#8744</div>
        </div>
    </main>
    <footer>
        <?php include 'footer.php' ?>
    </footer>
</body>
<script src="script/index_script.js"></script>
<script src="script/gallery_script.js"></script>
</html>