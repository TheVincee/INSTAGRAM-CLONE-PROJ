<?php
$curr_us = isset($_GET['curr']) ? $_GET['curr'] : '';
$for_us = isset($_GET['for']) ? $_GET['for'] : '';
$get = isset($_GET['get']) ? $_GET['get'] : '';

include_once 'connect.php';

$result = null; // Initialize $result variable

if ($get == "followings") {
    $result = mysqli_query($conn, "SELECT
                                        followings.following    AS 'usernamee', 
                                        users.profile_name      AS 'profile_name', 
                                        users.profile_picture   AS 'profile_picture',
                                        (
                                            SELECT  1
                                            FROM    followings
                                            WHERE   followings.username = '$curr_us'
                                                        AND
                                                    followings.following = usernamee
                                        )                       AS 'isFollowing'
                                    FROM followings
                                    JOIN users
                                    ON followings.following   = users.username
                                    WHERE followings.username = '$for_us'");
} else if ($get == "followers") {
    $result = mysqli_query($conn, "SELECT
                                        followings.username     AS 'usernamee',  
                                        users.profile_name      AS 'profile_name',
                                        users.profile_picture   AS 'profile_picture',
                                        (
                                            SELECT  1
                                            FROM    followings
                                            WHERE   followings.username = '$curr_us'
                                                        AND
                                                    followings.following = usernamee
                                        )                       AS 'isFollowing'
                                    FROM followings
                                    JOIN users
                                    ON followings.username   = users.username
                                    WHERE followings.following = '$for_us'");
} else if ($get == 'search') {
    if (isset($_POST['search_for'])) {
        $for_us = $_POST['search_for'];
    } else {
        $for_us = $_GET['for'];
    }

    $result = mysqli_query($conn, "SELECT 
                                        users.username 			    AS 'usernamee',
                                        users.profile_name 		    AS 'profile_name',
                                        users.profile_picture 	    AS 'profile_picture',
                                        (
                                            SELECT  1
                                            FROM    followings
                                            WHERE   followings.username = '$curr_us' 
                                                        AND
                                                    followings.following = usernamee
                                        )						    AS 'isFollowing'
                                    FROM users
                                    WHERE 	users.username     LIKE '%$for_us%'     -- searching for
                                                OR
                                            users.profile_name LIKE '%$for_us%'");
}
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>Explore | Instaclone</title>
        <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
        <link rel="shortcut icon" href="images/favicon.ico" type="image/x-icon">
        <link href="css/style.css" rel="stylesheet">
        <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    </head>
    <body>
        <nav class="navigation">
            <a href="feed.php?username=<?php echo $curr_us ?>">
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
                <a href="profile.php?curr_us=<?php echo $curr_us ?>" class="navigation__link">
                    <i class="fa fa-user-o"></i>
                </a>
            </div>
        </nav>
        <main class="explore">
            <section class="people">
                <ul class="people__list">
                <?php
                if ($result !== null && mysqli_num_rows($result) > 0) {
                    while ($row = mysqli_fetch_array($result)) {
                        ?>
                        <li class="people__list-item">
                            <a href="profile.php?curr_us=<?php echo $curr_us ?>&profile_for=<?php echo $row['usernamee']; ?>">
                                <img src="<?php echo $row['profile_picture']; ?>" alt="Profile Picture" class="people__list-item-img" style="width:20%">
                                <div class="people__list-item-info">
                                    <span class="people__list-item-name"><?php echo $row['profile_name']; ?></span>
                                    <span class="people__list-item-username">@<?php echo $row['usernamee']; ?></span>
                                </div>
                            </a>
                            <?php if ($row['isFollowing']) { ?>
                                <!-- <button class="people__list-item-button">Following</button> -->
                            <?php } else { ?>
                                <!-- <button class="people__list-item-button">Follow</button> -->
                            <?php } ?>
                        </li>
                        <?php
                    }
                } else {
                    echo "<li>No rows found.</li>";
                }
                ?>
                </ul>
            </section>
        </main>
        <footer class="footer">
            <nav class="footer__nav">
                <ul class="footer__list">
                    <li class="footer__list-item"><a href="#" class="footer__link">about us</a></li>
                    <li class="footer__list-item"><a href="#" class="footer__link">support</a></li>
                    <li class="footer__list-item"><a href="#" class="footer__link">blog</a></li>
                    <li class="footer__list-item"><a href="#" class="footer__link">press</a></li>
                    <li class="footer__list-item"><a href="#" class="footer__link">api</a></li>
                    <li class="footer__list-item"><a href="#" class="footer__link">jobs</a></li>
                    <li class="footer__list-item"><a href="#" class="footer__link">privacy</a></li>
                    <li class="footer__list-item"><a href="#" class="footer__link">terms</a></li>
                    <li class="footer__list-item"><a href="#" class="footer__link">directory</a></li>
                    <li class="footer__list-item"><a href="#" class="footer__link">language</a></li>
                </ul>
            </nav>
            <span class="footer__copyright">© 2024 instagram</span>
        </footer>
        <script
  src="https://code.jquery.com/jquery-3.2.1.min.js"
  integrity="sha256-hwg4gsxgFZhOsEEamdOYGBf13FyQuiTwlAQgxVSNgt4="
  crossorigin="anonymous"></script>
        <script src="js/app.js"></script>
    </body>
</html>
