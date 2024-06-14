<?php
include_once 'connect.php';
$username = $_GET['username'];

// Mark notifications as seen
$updateNotifications = "UPDATE notifications SET seen = 1 WHERE username = '$username'";
mysqli_query($conn, $updateNotifications);

// Fetch notifications
$notificationQuery = "SELECT * FROM notifications WHERE username = '$username' ORDER BY created_at DESC";
$notificationResult = mysqli_query($conn, $notificationQuery);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Notifications | Instaclone</title>
    <link rel="shortcut icon" href="images/favicon.ico" type="image/x-icon">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <nav>
        <!-- Your navigation code here -->
    </nav>
    <main>
        <center>
            <h1>Notifications</h1>
            <ul>
                <?php
                while ($notification = mysqli_fetch_assoc($notificationResult)) {
                    $post_id = $notification['post_id'];
                    $type = $notification['type'];
                    $triggered_by = $notification['triggered_by'];
                    $created_at = $notification['created_at'];
                    
                    echo "<li><a href='image-detail.php?post_id=$post_id&curr_us=$username'>$triggered_by $type your post at $created_at</a></li>";
                }
                ?>
            </ul>
        </center>
    </main>
    
    <!-- Toast notifications container -->
    <div aria-live="polite" aria-atomic="true" style="position: relative; min-height: 200px;">
        <div style="position: absolute; top: 0; right: 0;" id="toast-container">
            <!-- Toasts will be injected here by JavaScript -->
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script>
        $(document).ready(function(){
            // Sample notifications data (replace with your actual data)
            const notifications = [
                <?php
                mysqli_data_seek($notificationResult, 0); // Reset result pointer to the beginning
                while ($notification = mysqli_fetch_assoc($notificationResult)) {
                    $triggered_by = $notification['triggered_by'];
                    $type = $notification['type'];
                    $created_at = $notification['created_at'];
                    echo "{triggered_by: '$triggered_by', type: '$type', created_at: '$created_at'},";
                }
                ?>
            ];

            notifications.forEach(notification => {
                const toast = `
                    <div class="toast" role="alert" aria-live="assertive" aria-atomic="true">
                        <div class="toast-header">
                            <strong class="mr-auto">${notification.triggered_by}</strong>
                            <small class="text-muted">${notification.created_at}</small>
                            <button type="button" class="ml-2 mb-1 close" data-dismiss="toast" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="toast-body">
                            ${notification.triggered_by} ${notification.type} your post.
                        </div>
                    </div>`;
                $('#toast-container').append(toast);
            });

            $('.toast').toast('show');
        });
    </script>
</body>
</html>
