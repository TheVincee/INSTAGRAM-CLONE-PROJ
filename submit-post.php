<?php
include_once 'connect.php';

if(isset($_POST['submit'])){
    $username = $_POST['user_name'];
    $description = $_POST['discription'];

    // File upload configuration
    $targetDir = "photos/";
    $allowTypes = array('jpg', 'png', 'jpeg', 'gif');

    $statusMsg = $errorMsg = $errorUpload = $errorUploadType = '';
    $fileNames = array_filter($_FILES['fileToUpload']['name']);
    $uploadedFiles = [];

    if(!empty($fileNames)){
        foreach($_FILES['fileToUpload']['name'] as $key=>$val){
            // File upload path
            $fileName = basename($_FILES['fileToUpload']['name'][$key]);
            $targetFilePath = $targetDir . $fileName;

            // Check whether file type is valid
            $fileType = pathinfo($targetFilePath, PATHINFO_EXTENSION);
            if(in_array($fileType, $allowTypes)){
                // Upload file to server
                if(move_uploaded_file($_FILES["fileToUpload"]["tmp_name"][$key], $targetFilePath)){
                    $uploadedFiles[] = $targetFilePath;
                }else{
                    $errorUpload .= $_FILES['fileToUpload']['name'][$key].' | ';
                }
            }else{
                $errorUploadType .= $_FILES['fileToUpload']['name'][$key].' | ';
            }
        }

        // Error message
        $errorUpload = !empty($errorUpload) ? 'Upload Error: '.trim($errorUpload, ' | ') : '';
        $errorUploadType = !empty($errorUploadType) ? 'File Type Error: '.trim($errorUploadType, ' | ') : '';
        $errorMsg = !empty($errorUpload) ? '<br/>'.$errorUpload.'<br/>'.$errorUploadType : '<br/>'.$errorUploadType;

        if(!empty($uploadedFiles)){
            // Convert uploaded files array to JSON
            $photosJson = json_encode($uploadedFiles);
            
            // Insert post into database
            $query = "INSERT INTO posts (username, photos, description) VALUES ('$username', '$photosJson', '$description')";
            if(mysqli_query($conn, $query)){
                // Increment posts count
                $increment_posts = mysqli_query($conn, "UPDATE users SET posts = posts + 1 WHERE username = '$username'");
                $conn->close();
                header("Location: feed.php?username=$username");
                exit();
            }else{
                $statusMsg = "Sorry, there was an error uploading your file.";
            }
        }else{
            $statusMsg = "Upload failed! ".$errorMsg;
        }
    }else{
        $statusMsg = 'Please select a file to upload.';
    }

    // Display status message
    echo $statusMsg;

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $comment = $_POST['comment'];
        $post_id = $_POST['post_id'];
        $curr_us = $_POST['curr_us'];
        $time_stamp = date('Y-m-d H:i:s');
    
        $sql = "INSERT INTO comments (post_id, commentername, comment_text, time_stamp) VALUES ('$post_id', '$curr_us', '$comment', '$time_stamp')";
    
        if (mysqli_query($conn, $sql)) {
            $response = array(
                'success' => true,
                'commentername' => $curr_us,
                'comment_text' => $comment
            );
        } else {
            $response = array(
                'success' => false,
                'error' => 'Error: ' . mysqli_error($conn)
            );
        }
    
        echo json_encode($response);
    }
}
?>
