<?php
include_once 'connect.php';

// Check if all required parameters are provided
if (isset($_GET['post_id'], $_GET['username'])) {
    $post_id = $_GET['post_id'];
    $username = $_GET['username'];

    // Validate input values
    if (is_numeric($post_id)) {
        // Sanitize input values before using in queries
        $post_id = intval($post_id);
        $username = mysqli_real_escape_string($conn, $username);

        // Check if the user has already liked the photo
        $check_like_query = "SELECT COUNT(*) AS count FROM likes WHERE post_id = $post_id AND likername = '$username'";
        $check_result = mysqli_query($conn, $check_like_query);
        $row = mysqli_fetch_assoc($check_result);
        $is_liked = ($row['count'] > 0) ? 1 : 0;

        if ($is_liked == 1) {
            // Unlike the photo
            $delete_like_query = "DELETE FROM likes WHERE likername = '$username' AND post_id = $post_id";
            $result = mysqli_query($conn, $delete_like_query);
            if ($result) {
                // Successfully unliked, update likes count
                $update_likes_query = "UPDATE posts SET likes = likes-1 WHERE post_id = $post_id";
                mysqli_query($conn, $update_likes_query);
            } else {
                // Handle error when unliking
                echo "Error: Unable to unlike the post.";
            }
        } else {
            // Like the photo
            $insert_like_query = "INSERT INTO likes(post_id, likername) VALUES ($post_id, '$username')";
            $result = mysqli_query($conn, $insert_like_query);
            if ($result) {
                // Successfully liked, update likes count
                $update_likes_query = "UPDATE posts SET likes = likes+1 WHERE post_id = $post_id";
                mysqli_query($conn, $update_likes_query);

                // Create notification
                $post_owner_query = "SELECT username FROM posts WHERE post_id = $post_id";
                $post_owner_result = mysqli_query($conn, $post_owner_query);
                $post_owner_row = mysqli_fetch_assoc($post_owner_result);
                $post_owner = $post_owner_row['username'];

                if ($post_owner != $username) {
                    $notification_query = "INSERT INTO notifications(username, type, post_id, triggered_by) VALUES ('$post_owner', 'like', $post_id, '$username')";
                    mysqli_query($conn, $notification_query);
                }
            } else {
                // Handle error when liking
                echo "Error: Unable to like the post.";
            }
        }

        // Redirect back to feed.php
        header("Location: feed.php?username=$username");
        exit();
    } else {
        // Invalid post_id
        echo "Error: Invalid post_id.";
    }
} else {
    // Missing parameters
    echo "Error: Missing parameters.";
}
?>
