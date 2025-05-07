<?php
require "../config/configuration.php";
session_start();

if(!isset($_SESSION["adminname"], $_SESSION["adminemail"])){
    header("Location: admin_sigin_login.php");
}
if(isset($_POST["logout"])){
    session_destroy();
    header("Location: ../index.php");
    exit();
}

// feeding data into the database----------------------
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["submit"])) {
    $title = $_POST['title'];
    $content = $_POST['content'];

    if (isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
        $imageName = $_FILES['image']['name'];
        $tmpName = $_FILES['image']['tmp_name'];

        $uniqueName = time() . "_" . basename($imageName);
        $uploadFolder = "../uploads/blogUploads";
        $uploadPath = $uploadFolder . $uniqueName;

        // Make sure upload folder exists
        if (!file_exists($uploadFolder)) {
            mkdir($uploadFolder, 0777, true);
        }
        if (move_uploaded_file($tmpName, $uploadPath)) {
            $dbPath = "../uploads/blogUploads" . $uniqueName;
            $stmt = $connection->prepare("INSERT INTO blogcontent (image, title, content) VALUES (?, ?, ?)");
            $stmt->bind_param("sss", $dbPath, $title, $content);
            if ($stmt->execute()) {
                header("Location: " . $_SERVER['PHP_SELF']);
                exit();
            } else {
                echo "<script>alert('Database insert failed.');</script>";
            }
        } else {
            echo "<script>alert('Image upload failed.');</script>";
        }
    } else {
        echo "<script>alert('Please select a valid image file.');</script>";
    }
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../assets/css/samestyle.css">
    <link rel="stylesheet" href="../assets/css/adminpagestyle.css">
    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css"
      integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg=="
      crossorigin="anonymous"
      referrerpolicy="no-referrer" />
</head>
<body>
    <?php
        require "../includes/navbar.html";
    ?>
    <div class="s_navbar">
        <span class="name">
            <?php
                echo "<i class='fa-solid fa-user-tie'></i> " . Ucfirst($_SESSION["adminname"]);
            ?>
        </span>
        <form action="" method="POST">
            <input type="submit" class="transparent-btn" name="logout" value="Logut Admin">
        </form>
    </div>
    <main>
        <div class="container">
            <div class="image-cont">
                <p>choose file to upload</p>
                <img id="preview" src="" alt="Image Preview" style="max-width: 270px; display: none;" />
            </div>
            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]) ?>" method="POST" enctype="multipart/form-data">
                <input type="file" name="image" required>
                <input id="wid" type="text" name="title" required>
                <input id="wid" type="text" name="content" required>
                <input class="transparent-btn" type="submit" name="submit" value="submit">
            </form>
        </div>
    </main>
    <script>
    document.querySelector('input[type="file"]').addEventListener('change', function(event) {
    const file = event.target.files[0];
    const preview = document.getElementById('preview');

    if (file) {
        const reader = new FileReader();
        reader.onload = function(e) {
            preview.src = e.target.result;
            preview.style.display = "block";
        }
        document.querySelector("p").style.display = "none";
        reader.readAsDataURL(file);
    }
});
</script>
</body>
</html>