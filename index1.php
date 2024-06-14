<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>INDEX</title>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css">
<link rel="stylesheet" href="public/css/styles.css">
<style>
  body {
    font-family: Arial, sans-serif;
    margin: 0;
    padding: 0;
    background: #fafafa;
}
.sidebar {
  display: flex;
  flex-direction: column;
  justify-content: space-between;
  height: 100%;
  position: fixed;
  top: 0;
  left: 0;
  padding: 20px;
  box-sizing: border-box;
}

.more-link {
  position: absolute;
  bottom: 0;
  width: 100%;
  border-top: 1px solid #dbdbdb;
  padding: 20px;
}
.icon-bar {
  display: flex;
  flex-direction: column;
  align-items: flex-start; /* Aligns all child elements to the start (left) */
  justify-content: space-between;
  position: fixed; /* Keeps the bar fixed during scrolling */
  top: calc(50% - 50px); /* Moves the bar up by 50px */
  transform: translateY(-50%);
  width: 60px; /* Adjust the width as needed */
  /* ... other styles ... */
}
.navigation {
    padding-top: 0px;
  padding: 20px;
  display: flex;
  flex-direction: column;
  align-items: flex-start; /* Aligns all child elements to the start (left) */
}

.nav-link {
  display: flex;
  align-items: center;
  color: #262626;
  text-decoration: none;
  padding: 17px 0;
  font-size: 16px;
  width: 100%; /* Ensures full width for alignment */
  box-sizing: border-box; /* Ensures padding is included in width */
  justify-content: flex-start; /* Aligns items to the left */
}

.bnav
{
    position: absolute;
    bottom: 30px;
}
/* Icon styling */
.nav-link i {
  margin-right: 8px;
  font-size: 20px;
}



body {
  font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, Helvetica, Arial, sans-serif;
}
  
  .container {
    max-width: 600px;
    margin-top:20px;
    background: #fff;
    border: 1px solid #dbdbdb;
    border-radius: 3px;
  }
  
  .post-header {
    padding: 16px;
    display: flex;
    align-items: center;
    border-bottom: 1px solid #dbdbdb;
  }
  
  .profile-pic {
    width: 40px;
    height: 40px;
    border-radius: 50%;
    margin-right: 10px;
  }
  
  .username {
    font-weight: bold;
    color: #262626;
  }
  
  .post-image {
    width: 100%;
  }
  
  .post-actions {
    padding: 4px 16px;
    display: flex;
    align-items: center;
    justify-content: space-between;
    border-bottom: 1px solid #dbdbdb;
  }
  
  .post-likes,
  .post-caption,
  .post-comments,
  .post-timestamp {
    padding: 0 16px;
    margin: 4px 0;
  }
  
  .add-comment {
    padding: 16px;
    border-top: 1px solid #dbdbdb;
    display: flex;
    align-items: center;
  }
  
  .comment-input {
    flex: 1;
    border: none;
    padding: 8px 0;
  }
  
  .post-btn {
    background: none;
    border: none;
    color: #3897f0;
    cursor: pointer;
  }
</style>
</head>
<body>
    <aside class="sidebar">
        <div class="SiteLogoContainer">
            <img src="public/logo/instagram.png" alt="Instagram Logo" class="imgcontainer">
        </div>
        <nav class="navigation">
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
         
            </div>
            <div class="bnav">
            <div class="thread">
            <a href="#" class="nav-link"><i class="fas fa-comment-dots"></i> Threads</a>
            </div>
            <div class="more">
            <a href="#" class="nav-link"><i class="fas fa-ellipsis-h"></i> More</a>
      </aside>
  <div class="container">
    <div class="post-header">
      <img src="public/profileimage/profile.png" alt="Profile Picture" class="profile-pic">
      <span class="username">AKP</span>
    </div>
    <img src="public/image/mort.jpg" alt="Post Image" class="post-image">
    <div class="post-actions">
      <!-- Icons for like, comment, send -->
    </div>
    <div class="post-likes">
      100 likes
    </div>
    <div class="post-caption">
      <span class="username">AKP</span>
      #style
    </div>
    <div class="post-comments">
      <!-- Comments go here -->
    </div>
    <div class="post-timestamp">
      1 hour ago
    </div>
    <div class="add-comment">
      <input type="text" placeholder="Add a comment..." class="comment-input">
      <button class="post-btn">Post</button>
    </div>

    <div class="container">
        <div class="post-header">
        <img src="public/profileimage/profile.png" alt="Profile Picture" class="profile-pic">
          <span class="username">AKP</span>
        </div>
        <img src="public/image/mort.jpg" alt="Post Image" class="post-image">
        <div class="post-actions">
          <!-- Icons for like, comment, send -->
        </div>
        <div class="post-likes">
          100 likes
        </div>
        <div class="post-caption">
          <span class="username">yoww</span>
          #style
        </div>
        <div class="post-comments">
          <!-- Comments go here -->
        </div>
        <div class="post-timestamp">
          1 hour ago
        </div>
        <div class="add-comment">
          <input type="text" placeholder="Add a comment..." class="comment-input">
          <button class="post-btn">Post</button>
        </div>

        <div class="container">
            <div class="post-header">
            <img src="public/profileimage/profile.png" alt="Profile Picture" class="profile-pic">
              <span class="username">AKP</span>
            </div>
            <img src="public/image/mort.jpg" alt="Post Image" class="post-image">
            <div class="post-actions">
              <!-- Icons for like, comment, send -->
            </div>
            <div class="post-likes">
              100 likes
            </div>
            <div class="post-caption">
              <span class="username">AKP</span>
              #style
            </div>
            <div class="post-comments">
              <!-- Comments go here -->
            </div>
            <div class="post-timestamp">
              1 hour ago
            </div>
            <div class="add-comment">
              <input type="text" placeholder="Add a comment..." class="comment-input">
              <button class="post-btn">Post</button>
            </div>

            <div class="container">
                <div class="post-header">
                <img src="public/profileimage/profile.png" alt="Profile Picture" class="profile-pic">
                  <span class="username">AKP</span>
                </div>
                <img src="public/image/mort.jpg" alt="Post Image" class="post-image">
                <div class="post-actions">
                  <!-- Icons for like, comment, send -->
                </div>
                <div class="post-likes">
                  100 likes
                </div>
                <div class="post-caption">
                  <span class="username">yoww</span>
                  #style
                </div>
                <div class="post-comments">
                  <!-- Comments go here -->
                </div>
                <div class="post-timestamp">
                  1 hour ago
                </div>
                <div class="add-comment">
                  <input type="text" placeholder="Add a comment..." class="comment-input">
                  <button class="post-btn">Post</button>
                </div>

                <div class="container">
                    <div class="post-header">
                    <img src="public/profileimage/profile.png" alt="Profile Picture" class="profile-pic">
                      <span class="username">AKP</span>
                    </div>
                    <img src="public/image/mort.jpg" alt="Post Image" class="post-image">
                    <div class="post-actions">
                      <!-- Icons for like, comment, send -->
                    </div>
                    <div class="post-likes">
                      100 likes
                    </div>
                    <div class="post-caption">
                      <span class="username">AKP</span>
                      #style
                    </div>
                    <div class="post-comments">
                      <!-- Comments go here -->
                    </div>
                    <div class="post-timestamp">
                      1 hour ago
                    </div>
                    <div class="add-comment">
                      <input type="text" placeholder="Add a comment..." class="comment-input">
                      <button class="post-btn">Post</button>
                    </div>

                    <div class="container">
                        <div class="post-header">
                        <img src="public/profileimage/profile.png" alt="Profile Picture" class="profile-pic">
                          <span class="username">AKP</span>
                        </div>
                        <img src="public/image/mort.jpg" alt="Post Image" class="post-image">
                        <div class="post-actions">
                          <!-- Icons for like, comment, send -->
                        </div>
                        <div class="post-likes">
                          100 likes
                        </div>
                        <div class="post-caption">
                          <span class="username">WAYNESTOON LEE</span>
                          #style
                        </div>
                        <div class="post-comments">
                          <!-- Comments go here -->
                        </div>
                        <div class="post-timestamp">
                          1 hour ago
                        </div>
                        <div class="add-comment">
                          <input type="text" placeholder="Add a comment..." class="comment-input">
                          <button class="post-btn">Post</button>
                        </div>

  </div>
</body>
</html> 
