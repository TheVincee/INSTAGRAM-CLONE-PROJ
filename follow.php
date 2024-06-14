<?php
include_once 'connect.php';

$follower   = $_GET['follower'];
$following  = $_GET['following'];
$return     = $_GET['return'];

if($return == 'explore'){
    $for_us  = $_GET['for'];
    $get     = $_GET['get'];
}

// Check if both usernames exist in the users table
$check_follower = mysqli_query($conn, "SELECT username FROM users WHERE username = '$follower'");
$check_following = mysqli_query($conn, "SELECT username FROM users WHERE username = '$following'");

if (mysqli_num_rows($check_follower) == 0 || mysqli_num_rows($check_following) == 0) {
    echo "Error: One or both users do not exist.";
    exit();
}

$create_relation = mysqli_query($conn, "INSERT INTO followings (username, following) VALUES ('$follower', '$following')");

if($create_relation){
    $increment_follower  = mysqli_query($conn, "UPDATE users SET followers = followers + 1 WHERE username = '$following'");
    $increment_following = mysqli_query($conn, "UPDATE users SET followings = followings + 1 WHERE username = '$follower'");

    if (!$increment_follower || !$increment_following) {
        echo "Error updating followers/followings count: " . mysqli_error($conn);
        exit();
    }
} else {
    echo "Error creating follow relationship: " . mysqli_error($conn);
    exit();
}

if($return == 'profile') {
    header("Location: profile.php?curr_us=$follower&profile_for=$following");
} else if($return == 'explore') {
    header("Location: explore.php?curr=$follower&for=$for_us&get=$get");
}
exit();
?>
