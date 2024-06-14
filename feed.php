<?php
include_once 'connect.php';
$us = $_GET['username'];

// Check for new notifications
$notificationQuery = "SELECT COUNT(*) AS new_notifications FROM notifications WHERE username = '$us' AND seen = 0";
$notificationResult = mysqli_query($conn, $notificationQuery);
if ($notificationResult) {
    $notificationRow = mysqli_fetch_assoc($notificationResult);
    $newNotifications = $notificationRow['new_notifications'] > 0;
} else {
    $newNotifications = false;
}

// Set the timezone to Manila
date_default_timezone_set('Asia/Manila');
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Feed | Instaclone</title>
    <link rel="shortcut icon" href="images/favicon.ico" type="image/x-icon">
    <link href="css/style.css" rel="stylesheet">
    <meta name="viewport" content="width=device-width, user-scalable=no, 1.0, maximum-scale=1.0, minimum-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css">
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <style>
        .photo__file-container {
            display: flex;
            flex-wrap: wrap;
            gap: 10px;
        }

        .photo__file-wrapper {
            flex: 1 1 calc(33.333% - 10px);
            box-sizing: border-box;
        }

        .photo__file {
            width: 100%;
            height: auto;
            display: block;
        }
    </style>
</head>
<body>
<?php
    include_once 'connect.php';
    $us = $_GET['username'];

    $notificationQuery = "SELECT COUNT(*) AS new_notifications FROM notifications WHERE username = '$us' AND seen = 0";
    $notificationResult = mysqli_query($conn, $notificationQuery);
    if ($notificationResult) {
        $notificationRow = mysqli_fetch_assoc($notificationResult);
        $newNotifications = $notificationRow['new_notifications'] > 0;
    } else {
        $newNotifications = false;
    }
    
    // Set the timezone to Manila
    date_default_timezone_set('Asia/Manila');
?>

<nav class="navigation">
    <a href="feed.php?username=<?php echo $us ?>">
        <img 
            src="images/instagram.png"
            alt="logo"
            title="logo"
            class="navigation__logo"
        />
    </a>
    <form action="explore.php?curr=<?php echo $us ?>&for=_&get=search" class="navigation__search-container" method="post">
        <div class="navigation__search-container">
            <i class="fas fa-search"></i>
            <input type="text" name="search_for" placeholder="Search">
            <input type="submit" id="search" name="search" value="Search">
        </div>
    </form>
    <div class="navigation__icons">
        <a href="explore.php" class="navigation__link">
            <i class="fas fa-compass"></i>
        </a>
        <a href="post.php?username=<?php echo $us ?>" class="navigation__link">
            <img
                class=" "
                src="images/plus.svg"
                style="width:17px; height:17px"
            />
        </a>
        <a href="profile.php?curr_us=<?php echo $us ?>&profile_for=<?php echo $us ?>" class="navigation__link">
            <i class="far fa-user"></i>
        </a>
        <a href="notifications.php?username=<?php echo $us ?>" class="navigation__link">
            <i class="fas fa-bell notification-icon" data-new-notifications="<?php echo $newNotifications ? 'true' : 'false'; ?>"></i>
        </a>
    </div>
</nav>

<aside class="aside">
    <div class="SiteLogoContainer">
        <img src="public/logo/instagram.png" alt="Instagram Logo" class="imgcontainer">
    </div>
    <nav class="navigation1">
        <div class="icon-bar">
            <a href="#" class="nav-link"><i class="fas fa-home"></i> Home</a>
            <a href="#" class="nav-link"><i class="fas fa-search"></i> Search</a>
            <a href="#" class="nav-link"><i class="fas fa-compass"></i> Explore</a>
            <a href="#" class="nav-link"><i class="fas fa-film"></i> Reels</a>
            <a href="#" class="nav-link"><i class="fas fa-paper-plane"></i> Messages</a>
            <a href="#" class="nav-link"><i class="fas fa-bell"></i> Notifications</a>
            <a href="#" class="nav-link"><i class="fas fa-plus-square"></i> Create</a>
            <a href="#" class="nav-link"><i class="fas fa-user"></i> Profile</a>
        </div>
    </nav>
    <div class="bnav">
        <div class="thread">
            <a href="#" class="nav-link"><i class="fas fa-comment-dots"></i> Threads</a>
        </div>
        <div class="more">
            <a href="#" class="nav-link"><i class="fas fa-ellipsis-h"></i> More</a>
        </div>
    </div>
</aside>

<main class="feed">

    
    <?php
        $result = mysqli_query($conn, "SELECT 
                                            posts.post_id AS post_id,
                                            posts.photos AS photos, 
                                            posts.likes AS likes,
                                            posts.comments AS comments_count,
                                            posts.time_stamp AS created_at,
                                            posts.description AS description,
                                            users.username AS follower,
                                            users.profile_picture AS following_dp
                                        FROM posts
                                        JOIN users ON posts.username = users.username
                                        ORDER BY posts.time_stamp DESC"
                                    );

        while($row = mysqli_fetch_array($result)){
            $follower       = $row['follower'];
            $following_dp   = $row['following_dp'];
            $post_id        = $row['post_id'];
            $photos         = json_decode($row['photos'], true); // Decode the JSON-encoded photos as an array
            $likes          = $row['likes'];
            $comments_count = $row['comments_count'];
            $created_at     = date("Y-m-d H:i:s"); // Set the current date and time in Manila timezone
            $description    = $row['description'];

            // Ensure $photos is an array
            if (!is_array($photos)) {
                $photos = [];
            }
    ?>
    <section class="photo">
        <header class="photo__header">
            <div class="photo__header-column">
                <img class="photo__avatar" src="<?php echo ($following_dp == null) ? 'images/avatar.svg' : $following_dp; ?>" style="width:30px;height:30px" />
            </div>
            <div class="photo__header-column">
                <a href="profile.php?curr_us=<?php echo $us ?>&profile_for=<?php echo $follower ?>">
                    <?php echo $follower ?>
                    <img height="13" width="13" src="images\verified.png" />
                </a>
            </div>
        </header>
        <div class="photo__description"><?php echo "Your Content:", $description; ?></div>
        <div class="photo__info">
            <div class="photo__file-container">
                <?php foreach ($photos as $photo): ?>
                <div class="photo__file-wrapper">
                    <a href="image-detail.php?post_id=<?php echo $post_id ?>&curr_us=<?php echo $us ?>"> 
                        <img class="photo__file" src="<?php echo $photo; ?>" >
                    </a>
                </div>
                <?php endforeach; ?>
            </div>
            <div class="photo__icons">
                <span class="photo__icon">
                    <a href="like.php?is_liked=<?php echo isset($is_liked) ? $is_liked : 0 ?>&post_id=<?php echo $post_id ?>&username=<?php echo $us ?>">
                        <?php 
                            $heartClass = isset($is_liked) && $is_liked == 1 ? 'fas fa-heart heart fa-lg' : 'far fa-heart heart fa-lg';
                            echo "<i class=\"$heartClass\"></i>"; 
                        ?>
                    </a> 
                    <a href="image-detail.php?post_id=<?php echo $post_id ?>&curr_us=<?php echo $us ?>"> 
                        <i class="far fa-comment fa-lg"></i>
                        <?php echo $comments_count; ?>
                    </a>
                </span>
            </div>
            <span class="photo__likes"><?php echo $likes ?> likes</span>
            <ul class="photo__comments">
                <?php
                $result2 = mysqli_query($conn, "SELECT 
                                                    comments.commentername AS 'commenter_name', 
                                                    comments.comment_text  AS 'comment_text'
                                                FROM comments
                                                WHERE post_id = $post_id
                                                ORDER BY time_stamp DESC
                                                LIMIT 2"
                                            );

                while ($row2 = mysqli_fetch_array($result2)) {
                    $commenter_name = $row2['commenter_name'];
                    $comment_text   = $row2['comment_text'];
                ?>
                <li class="photo__comment">
                    <span class="photo__comment-author"><?php echo $commenter_name ?></span><?php echo $comment_text ?>
                </li>
                <?php
                }
                ?>
                <a href="image-detail.php?post_id=<?php echo $post_id ?>&curr_us=<?php echo $us ?>"> 
                    <li class="photo__comment">
                        <span class="photo__comment-author">
                            <?php 
                            if ($comments_count != null && $comments_count > 2) {
                                echo ($comments_count - 2);
                            } elseif ($comments_count == 1 || $comments_count == 0) {
                                echo "no";
                            } else {
                                echo $comments_count;
                            }
                            ?> 
                            more comments...
                        </span>
                    </li>
                </a>
            </ul>
            <span class="photo__time-ago"><?php echo $created_at ?> days</span>
            <div class="photo__add-comment-container">
                <form action="comment.php?post_id=<?php echo $post_id ?>&username=<?php echo $us ?>&return_to=feed" method="POST">
                    <textarea name="comment" placeholder="Add a comment..." class="photo__add-comment"></textarea>
                    <input type="submit" class="fa fa-ellipsis-h"></input>
                </form>
            </div>
        </div>
    </section>
    <?php
        }
    ?>
</main>
<script src="https://code.jquery.com/jquery-3.2.1.min.js" integrity="sha256-hwg4gsxgFZhOsEEamdOYGBf13FyQuiTwlAQgxVSNgt4=" crossorigin="anonymous"></script>
<script src="js/app.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const notificationIcon = document.querySelector('.notification-icon');
        const hasNewNotifications = notificationIcon.getAttribute('data-new-notifications') === 'true';
        
        if (hasNewNotifications) {
            notificationIcon.style.color = 'red';
        }
    });
</script>
</body>
</html>
