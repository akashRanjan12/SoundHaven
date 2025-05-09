<?php
session_start();
$usermail = $_SESSION['useremail'];
$username = $_SESSION['username'];

echo "<h1 style='text-align: center; color: white;'>Welcome " . ucfirst($username) . "</h1>";
echo "<h3 style='text-align: center; color: white;'>You're logged in with this " . $usermail . " e-mail</h3>";

include '../../config/configuration.php'; // DB connection

// Fetch image
$profileImage = '';
$stmt = $connection->prepare("SELECT profile_image FROM userdetails WHERE email = ?");
$stmt->bind_param("s", $usermail);
$stmt->execute();
$stmt->bind_result($profileImage);
$stmt->fetch();
$stmt->close();

// Ensure the image URL is correct and accessible from the frontend
$imageUrl = !empty($profileImage) ? "/SoundHaven/Uploads/$profileImage" : "#"; // Adjusting the path

?>


<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Profile</title>
  <style>
    /* CSS remains unchanged */
    .profile-image-container {
      height: 300px;
      width: 100%;  
      display: flex;
      justify-content: center;
      align-items: center;    
    }
    .profile-images {
      width: 95%;
      height: 95%;
      overflow: hidden;
      border-radius: 10px;
      position: relative;
      border: 1px solid white;
      border-radius: 10px;
    }
    .full-screen-image {
      width: 100%;
      height: 100%;
      background-color: rgb(92, 162, 231);
      color: white;
      display: flex;
      justify-content: center;
      align-items: center;
      position: absolute;
      z-index: -1;
      
      img{  
        height: 100%;
        width: 100%;
        background-position: center;
        background-size: cover;
        background-repeat: no-repeat;
      }
    }
    .circle-image {
      width: 130px;
      height: 130px;
      background-color: transparent;
      color: white;
      display: flex;
      justify-content: center;
      align-items: center;
      position: absolute;
      z-index: 1;
      
      img{  
        height: 100%;
        width: 100%;
        background-position: center;
        background-size: cover;
        background-repeat: no-repeat;
        border: 3px solid white;
        border-radius: 50%;
      }
     
    }
    .set-img-btn {
      cursor: pointer;
      margin: 4px 20px;
    }
    .transparent-btn {
      padding: 4px 30px;
    }
    .set-image-container {
      color: black;
      display: none;
      margin: 4px 20px;
      background-color: whitesmoke;
      height: 270px;
      width: 270px;
      padding: 10px;
      position: absolute;
      top: 30%;
      left: 30%;  
      flex-direction: column;
      gap: 10px;
      justify-content: space-around;
      align-items: center;
      border-radius: 6px;
    }
    .btn {
      padding: 4px 30px;
      background-color:rgb(2, 14, 26);
      color: white;
      border: none;
      border-radius: 5px;
      cursor: pointer;
      margin-top: 10px;
    }
    .profile-image {
      background-color:rgb(2, 14, 26);
      color: white;
      width: 90%;
      align-self: center;
      border: none;
      border-radius: 5px;
      cursor: pointer;          
    }
  </style>
</head>
<body>

<div class="profile-image-container">
  <div class="profile-images">
    <div class="full-screen-image">
      <img src="<?= $imageUrl ?>" alt="Profile Image" class="profile-image" >
    </div>
    <div class="circle-image">
      <img src="<?= $imageUrl ?>" alt="Profile Image" class="profile-image">
    </div>
  </div>
</div>

<div class="set-img-btn">
  <p class="transparent-btn">Set Image</p>
</div>

<div class="set-image-container">
  <div class="data">
    <h1>Set Profile Image</h1>
    <p>Upload your profile image</p>
  </div>
  <div class="preview">
    <img src="" alt="preview" class="preview-image" width="100px">
  </div>
  <form id="profile-form" enctype="multipart/form-data">
    <input id="profile-image" type="file" name="profile_image" required>
    <input class="btn" type="submit" value="submit">
  </form>
</div>

<script>
  let profile = true;

  document.querySelector('.set-img-btn').addEventListener('click', function() {
    const container = document.querySelector('.set-image-container');
    if (profile) {
      container.style.display = 'flex';
    } else {
      container.style.display = 'none';
    }
    profile = !profile;
  });

  // Image preview
  document.querySelector('#profile-image').addEventListener('change', function() {
    const file = this.files[0];
    const reader = new FileReader();
    reader.onload = function(e) {
      document.querySelector('.preview-image').src = e.target.result;
    }
    reader.readAsDataURL(file);
  });

  // Handle AJAX Form Submission
  document.getElementById('profile-form').addEventListener('submit', function(event) {
    event.preventDefault();
    let formData = new FormData(this);
    
    fetch('apis/uploadProfileImage.php', {
      method: 'POST',
      body: formData
    })
    .then(response => response.json())
    .then(data => {
      if (data.success) {
        document.querySelector('.full-screen-image img').src = data.imageUrl;
        document.querySelector('.circle-image img').src = data.imageUrl;
        alert('Image uploaded successfully!');
      } else {
        alert('Image upload failed.');
      }
    })
    .catch(error => {
      console.error('Error:', error);
      alert('Error occurred during image upload.');
    });
  });
</script>

</body>
</html>
