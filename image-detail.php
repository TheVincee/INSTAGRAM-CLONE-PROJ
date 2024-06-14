<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Image Detail | Instaclone</title>
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
    <link rel="shortcut icon" href="images/favicon.ico" type="image/x-icon">
    <link href="css/style.css" rel="stylesheet">
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <style>
        * {
            box-sizing: border-box;
        }

        .column {
            float: left;
            width: 50%;
            padding: 10px;
            height: 550px;
            border: 1px solid #ddd;
            background-color: #ffffff;
        }

        .row:after {
            content: "";
            display: table;
            clear: both;
        }

        .vertical-center {
            margin: 0;
            position: absolute;
            top: 50%;
            -ms-transform: translateY(-50%);
            transform: translateY(-50%);
        }
    </style>
</head>
<body>
<?php
    include_once 'connect.php';

    $post_id = $_GET['post_id'];
    $curr_us = $_GET['curr_us'];

    // Fetch post details
    $result = mysqli_query($conn, "SELECT username, photos, time_stamp FROM posts WHERE post_id = $post_id");

    if (!$result) {
        echo "Error fetching post details: " . mysqli_error($conn);
        exit;
    }

    $row = mysqli_fetch_array($result);
    $username = $row['username'];
    $photos = json_decode($row['photos'], true); // Decode the JSON array of photos
    $post_time_stamp = $row['time_stamp'];

    // Calculate time difference for the post
    $created_at = getTimeDifference($post_time_stamp);

    // Count total likes for the post
    $likes_result = mysqli_query($conn, "SELECT COUNT(*) as total_likes FROM likes WHERE post_id = $post_id");
    if (!$likes_result) {
        echo "Error fetching likes count: " . mysqli_error($conn);
        exit;
    }
    $likes_row = mysqli_fetch_array($likes_result);
    $total_likes = $likes_row['total_likes'];

    // Count total comments for the post
    $comments_result = mysqli_query($conn, "SELECT COUNT(*) as total_comments FROM comments WHERE post_id = $post_id");
    if (!$comments_result) {
        echo "Error fetching comments count: " . mysqli_error($conn);
        exit;
    }
    $comments_row = mysqli_fetch_array($comments_result);
    $total_comments = $comments_row['total_comments'];

    // Fetch comments
    $comments_result = mysqli_query($conn, "SELECT commentername, comment_text, time_stamp FROM comments WHERE post_id = $post_id ORDER BY time_stamp DESC");
    if (!$comments_result) {
        echo "Error fetching comments: " . mysqli_error($conn);
        exit;
    }

    $comments = [];
    while ($comment_row = mysqli_fetch_array($comments_result, MYSQLI_ASSOC)) {
        $comment_row['created_at'] = getTimeDifference($comment_row['time_stamp']);
        $comments[] = $comment_row;
    }

    // Debugging: Check if comments are fetched
    if (empty($comments)) {
        echo "<script>console.log('No comments found for post_id: " . $post_id . "');</script>";
    } else {
        echo "<script>console.log('Comments fetched: " . json_encode($comments) . "');</script>";
    }

    // Fetch user profile picture
    $result2 = mysqli_query($conn, "SELECT profile_picture FROM users WHERE username = '$username'");
    if (!$result2) {
        echo "Error fetching user profile picture: " . mysqli_error($conn);
        exit;
    }
    $row2 = mysqli_fetch_array($result2);
    $profile_picture = $row2['profile_picture'];

    function getTimeDifference($timestamp)
    {
        $datetime1 = new DateTime($timestamp);
        $datetime2 = new DateTime();
        $interval = $datetime1->diff($datetime2);

        if ($interval->y > 0) {
            return $interval->y . " years ago";
        } else if ($interval->m > 0) {
            return $interval->m . " months ago";
        } else if ($interval->d > 0) {
            return $interval->d . " days ago";
        } else if ($interval->h > 0) {
            return $interval->h . " hours ago";
        } else if ($interval->i > 0) {
            return $interval->i . " minutes ago";
        } else {
            return "Just now";
        }
    }
?>

<nav class="navigation">
    <a href="feed.php?username=<?php echo htmlspecialchars($curr_us); ?>">
        <img 
            src="images/instagram.png"
            alt="logo"
            title="logo"
            class="navigation__logo"
        />
    </a>
    <div class="navigation__icons">
        <a href="explore.html" class="navigation__link">
            <i class="fa fa-compass"></i>
        </a>
        <a href="#" class="navigation__link">
            <i class="fa fa-heart-o"></i>
        </a>
        <a href="profile.php" class="navigation__link">
            <i class="fa fa-user-o"></i>
        </a>
    </div>
</nav>

<main class="image-detail">
    <section class="image">
        <div class="row">
            <div class="column">
                <?php foreach ($photos as $photo) { ?>
                    <img src="<?php echo htmlspecialchars($photo); ?>" class="image__avatar" style="width:100%;height:100%;" alt="Post Image" onerror="this.onerror=null; this.src='images/default.jpg';"/>
                <?php } ?>
            </div>
            <div class="column">
                <div class="photo__header">
                    <div class="people__avatar-container">
                        <img 
                            src="<?php echo ($profile_picture == null) ? 'images/avatar.svg' : htmlspecialchars($profile_picture); ?>"
                            class="people__avatar"
                            style="width:50px;height:50px;"
                        />
                    </div>
                    <div class="people__info">
                        <span class="people__username"><?php echo htmlspecialchars($username); ?></span>
                        <span class="people__created-at"><?php echo htmlspecialchars($created_at); ?> days ago</span>
                    </div>
                </div>
                <div class="photo__info">
                    <ul class="photo__comments" id="commentlist">
                        <?php foreach ($comments as $comment) { ?>
                            <li>
                                <span class="comment__username"><?php echo htmlspecialchars($comment['commentername']); ?></span>
                                <span class="comment__text"><?php echo htmlspecialchars($comment['comment_text']); ?></span>
                                <span class="comment__created-at"><?php echo htmlspecialchars($comment['time_stamp']); ?> days ago</span>
                            </li>
                        <?php } ?>
                    </ul>
                </div>
                <div class="photo__icons">
                    <span class="photo__icon">
                        <i class="fa fa-heart-o heart fa-lg"></i> <?php echo htmlspecialchars($total_likes); ?> likes
                    </span>
                    <span class="photo__icon">
                        <i class="fa fa-comment-o fa-lg"></i> <?php echo htmlspecialchars($total_comments); ?> comments
                    </span>
                </div>
                <div class="add-comment">
                    <!-- <form id="commentForm">
                        <textarea name="comment" id="commentText" placeholder="Add a comment..."></textarea>
                        <button type="submit">Post Comment</button>
                    </form> -->
                </div>
            </div>
        </div>
    </section>
</main>
<script
    src="https://code.jquery.com/jquery-3.2.1.min.js"
    integrity="sha256-hwg4gsxgFZhOsEEamdOYGBf13FyQuiTwlAQgxVSNgt4="
    crossorigin="anonymous"></script>
<script>
$(document).ready(function() {
    $("#commentForm").submit(function(event) {
        event.preventDefault();
        var commentText = $("#commentText").val();
        var postId = "<?php echo $post_id; ?>";
        var currUs = "<?php echo $curr_us; ?>";

        $.ajax({
            url: "submit-comment.php",
            type: "POST",
            data: {
                comment: commentText,
                post_id: postId,
                curr_us: currUs
            },
            success: function(response) {
                if (response.success) {
                    var newComment = '<li>' +
                        '<span class="comment__username">' + response.commentername + '</span>' +
                        '<span class="comment__text">' + response.comment_text + '</span>' +
                        '<span class="comment__created-at">Just now</span>' +
                        '</li>';
                    $("#commentlist").prepend(newComment);
                    $("#commentText").val('');
                } else {
                    alert(response.error);
                }
            },
            error: function(xhr, status, error) {
                console.log(error);
            }
        });
    });
});
</script>
<script src="js/app.js"></script>
</body>
</html>
