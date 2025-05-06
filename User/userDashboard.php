<?php
session_start();

if(!isset($_SESSION["email"], $_SESSION["name"])){
  header("Location: ../pages/login.php");
  exit();
}
require '../config/configuration.php';
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>S☆undHaven</title>
    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css"
      integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg=="
      crossorigin="anonymous"
      referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="../assets/css/style.css" />
    <link rel="stylesheet" href="../assets/css/userDashboard.css" />
    <link rel="stylesheet" href="userassets/userstyle.css" />
  </head>
  <body>
    <!-- preloader------------------ -->
    <div id="preloader">
      <p style="font-size: 7rem">𝄞</p>
      <p>S☆und Haven</p>
      <div class="loading">
        <svg width="64px" height="48px">
          <polyline
            points="0.157 23.954, 14 23.954, 21.843 48, 43 0, 50 24, 64 24"
            id="back"></polyline>
          <polyline
            points="0.157 23.954, 14 23.954, 21.843 48, 43 0, 50 24, 64 24"
            id="front"></polyline>
        </svg>
      </div>
      <h1>welcome to the S☆und Haven.</h1>
      <h3>Website is loading please wait...</h3>
    </div>
    <!-- end preloader-------------- -->
    <header>
      <div class="usernavbar">
        <div class="logo">𝄞</div>
        <div class="search-container">
          <form action="serch.php" method="POST">
            <input
              type="search"
              placeholder="Search for artists, tracks, bands" />
          </form>
        </div>
        <a href="upload"><span>Uploads</span></a>
        <div class="user">
          <span class="image">user</span>
          <span class="icon"><i class="fa-solid fa-angle-down"></i></span>
        </div>
        <div class="burger"><i class="fa-solid fa-bars"></i></div>
      </div>
      <div class="special_menu">
      <span class="about"><a href="../pages/aboutpage.php">About S☆undHaven</a></span>
      <span calss="blog"><a href="../pages/Blogpage.php">S☆undHaven Blog</a></span>
      </div>
      <div class="burger-menu">
        <span><a href="premium">Try artist pro</a></span>
        <span><a href="notification">Notification</a></span>
        <span><a href="notification">Message</a></span>
        <span><a href="">My Playlist</a></span>
        <span><a href="support_help_page">Support</a></span>
      </div>
      <div class="user-menu">
        <div class="options">
          <p style="border-bottom: 1px solid black">
            image
            <?php
            echo ucfirst($_SESSION['name']);
            ?>
          </p>
          <span><a href="profile">Profile</a></span>
          <span><a href="">Likes</a></span>          
          <span><a href="">Uploads</a></span>
          <span>
            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]) ?>" method="POST">
              <input type="submit" name="logout" value="Logout Account">
            </form>
          </span>
        </div>
      </div>
      <!-- bottom navbar -->
      <div class="user-resp-navbar-bottom">
        <div class="options">
          <a href="home"
            ><i class="fa-solid fa-house-crack"></i><span>Home</span></a
          >
          <a href="feed"
            ><i class="fa-solid fa-cloud"></i><span>Feed</span></a
          >
          <a class="search"
            ><i class="fa-solid fa-magnifying-glass"></i><span>Search</span></a
          >
          <a href="library"
            ><i class="fa-solid fa-swatchbook"></i><span>Library</span></a
          >
          <a class="download"
            ><i class="fa-solid fa-cloud-arrow-down"></i
            ><span>Download</span></a
          >
        </div>
      </div>
      <!-- end bottom navbar -->
    </header>
    <main>
      <a name="content"></a>
      <div class="content">content section</div>
    </main>
    <!-- Global persistent music player -->
    <div class="global-audio-container">
      <audio id="global-audio" controls style="width: 100%">
        <source src="" type="audio/mpeg" />
        Your browser does not support the audio element.
      </audio>
    </div>
    <footer style="padding-top: 60px">
      <?php
          require "../includes/userfooter.php";
        ?>
    </footer>
    <script src="../assets/js/preload.js"></script>
    <script src="userassets/userburgerlogic.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
  $(document).ready(function () {
    let globalAudio = $("#global-audio")[0];

    function bindTrackPlayEvents() {
      $(".play-track")
        .off("click")
        .on("click", function () {
          const audioSrc = $(this).data("src");
          const globalAudioElem = $("#global-audio");

          // Force reload even if the same audio is selected
          globalAudioElem.find("source").attr("src", "");
          globalAudio.load();

          setTimeout(() => {
            globalAudioElem.find("source").attr("src", audioSrc);
            globalAudio.load();

            globalAudio.addEventListener("loadedmetadata", function handleLoaded() {
              globalAudio.removeEventListener("loadedmetadata", handleLoaded);
              globalAudio.currentTime = 0;
              globalAudio.play();
            });

            // Show the player
            $("#global-audio").slideDown(300);

            // Save only source and visibility (not time)
            localStorage.setItem("audioSrc", audioSrc);
            localStorage.setItem("showPlayer", "true");
            localStorage.removeItem("audioTime");
          }, 50); // Slight delay to ensure browser resets audio
        });
    }

    // Restore audio state on reload
    function restoreAudioState() {
      const savedSrc = localStorage.getItem("audioSrc");
      const showPlayer = localStorage.getItem("showPlayer");
      const savedTime = parseFloat(localStorage.getItem("audioTime")) || 0;

      if (savedSrc && showPlayer === "true") {
        $("#global-audio").find("source").attr("src", savedSrc);
        globalAudio.load();

        globalAudio.addEventListener("loadedmetadata", function () {
          if (!isNaN(savedTime) && savedTime > 0) {
            globalAudio.currentTime = savedTime;
          }
        });

        $("#global-audio").show(); // Don't animate on page load
      }
    }

    // Save current time while playing (only useful on refresh)
    setInterval(() => {
      if (!globalAudio.paused && globalAudio.currentTime > 0) {
        localStorage.setItem("audioTime", globalAudio.currentTime);
      }
    }, 1000);

    // Load default content
    $(".content").load("views/home.php", function () {
      bindTrackPlayEvents();
    });

    // Handle navigation clicks
    $(".usernavbar a, .user-menu .options a, .burger-menu a, .user-resp-navbar-bottom a").click(function (e) {
      e.preventDefault();
      let page = $(this).attr("href");

      $(".content").load("views/" + page + ".php", function () {
        bindTrackPlayEvents();
      });
    });

    // Initial setup
    $("#global-audio").hide();
    bindTrackPlayEvents();
    restoreAudioState();
  });
</script>

<script>
  document.querySelector(".blog, .about").addEventListener("click", ()=>{
    window.alert("You are leaving the Home Page!");
  });
</script>
  </body>
</html>
<?php
    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["logout"])) {
      session_destroy();
      header("Location: ../logout.php");
      exit();
    }
?>
