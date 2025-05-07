<?php
session_start();

if (!isset($_SESSION["useremail"], $_SESSION["username"])) {
  header("Location: ../index.php");
  exit();
}

if (isset($_POST["logout"])) {
  session_destroy();
  header("Location: ../pages/logout.php");
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
      crossorigin="anonymous"
      referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="../assets/css/style.css" />
    <link rel="stylesheet" href="../assets/css/userDashboard.css" />
    <link rel="stylesheet" href="userassets/userstyle.css" />
  </head>
  <body>
    <!-- Preloader -->
    <div id="preloader">
      <p style="font-size: 7rem">𝄞</p>
      <p>S☆und Haven</p>
      <div class="loading">
        <svg width="64px" height="48px">
          <polyline points="0.157 23.954, 14 23.954, 21.843 48, 43 0, 50 24, 64 24" id="back"></polyline>
          <polyline points="0.157 23.954, 14 23.954, 21.843 48, 43 0, 50 24, 64 24" id="front"></polyline>
        </svg>
      </div>
      <h1>Welcome to the S☆und Haven.</h1>
      <h3>Website is loading, please wait...</h3>
    </div>

    <!-- Header -->
    <header>
      <div class="usernavbar">
        <div class="logo">𝄞</div>
        <div class="search-container">
          <form action="search.php" method="POST">
            <input type="search" placeholder="Search for artists, tracks, bands" />
          </form>
        </div>
        <a href="upload">Uploads</a>
        <div class="user">
          <span class="image">user</span>
          <span class="icon"><i class="fa-solid fa-angle-down"></i></span>
        </div>
        <div class="burger"><i class="fa-solid fa-bars"></i></div>
      </div>

      <div class="special_menu">
        <span class="about"><a href="../pages/aboutpage.php" class="external-link">About S☆undHaven</a></span>
        <span class="blog"><a href="../pages/Blogpage.php" class="external-link">S☆undHaven Blog</a></span>
      </div>

      <div class="burger-menu">
        <span><a href="premium">Try artist pro</a></span>
        <span><a href="notification">Notification</a></span>
        <span><a href="message">Message</a></span>
        <span><a href="playlist">My Playlist</a></span>
        <span><a href="support_help_page">Support</a></span>
      </div>

      <div class="user-menu">
        <div class="options">
          <p style="border-bottom: 1px solid black">
            image <?php echo ucfirst($_SESSION['username']); ?>
          </p>
          <span><a href="profile">Profile</a></span>
          <span><a href="likes">Likes</a></span>
          <span><a href="upload">Uploads</a></span>
            <form style="display: inline-block;" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]) ?>" method="POST">
              <input type="submit" name="logout" value="Logout Account">
            </form>
        </div>
      </div>

      <!-- Bottom navbar -->
      <div class="user-resp-navbar-bottom">
        <div class="options">
          <a href="home"><i class="fa-solid fa-house-crack"></i><span>Home</span></a>
          <a href="feed"><i class="fa-solid fa-cloud"></i><span>Feed</span></a>
          <a href="search"><i class="fa-solid fa-magnifying-glass"></i><span>Search</span></a>
          <a href="library"><i class="fa-solid fa-swatchbook"></i><span>Library</span></a>
          <a href="download"><i class="fa-solid fa-cloud-arrow-down"></i><span>Download</span></a>
        </div>
      </div>
    </header>

    <!-- Main Content -->
    <main>
      <div class="content">Loading content...</div>
    </main>

    <!-- Audio Player -->
    <div class="global-audio-container">
      <audio id="global-audio" controls style="width: 100%">
        <source src="" type="audio/mpeg" />
        Your browser does not support the audio element.
      </audio>
    </div>

    <footer style="padding-top: 60px">
      <?php require "../includes/userfooter.php"; ?>
    </footer>

    <!-- Scripts -->
<script src="../assets/js/preload.js"></script>
<script src="userassets/userburgerlogic.js"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
  $(document).ready(function () {
    const globalAudio = $("#global-audio")[0];

    // Attach audio play buttons
    function bindTrackPlayEvents() {
      $(".play-track")
        .off("click")
        .on("click", function () {
          const audioSrc = $(this).data("src");
          const globalAudioElem = $("#global-audio");

          // Force reset before assigning new src
          globalAudioElem.find("source").attr("src", "");
          globalAudio.load();

          setTimeout(() => {
            globalAudioElem.find("source").attr("src", audioSrc);
            globalAudio.load();

            globalAudio.addEventListener("loadedmetadata", function handleLoaded() {
              globalAudio.removeEventListener("loadedmetadata", handleLoaded);
              globalAudio.currentTime = 0; // Always start from beginning
              globalAudio.play();
            });

            $("#global-audio").slideDown(300);

            localStorage.setItem("audioSrc", audioSrc);
            localStorage.setItem("showPlayer", "true");
            localStorage.removeItem("audioTime"); // Clear old time
          }, 50);
        });
    }

    // Restore last played track if same song
    function restoreAudioState() {
      const savedSrc = localStorage.getItem("audioSrc");
      const showPlayer = localStorage.getItem("showPlayer");
      const savedTime = parseFloat(localStorage.getItem("audioTime")) || 0;

      if (savedSrc && showPlayer === "true") {
        $("#global-audio").find("source").attr("src", savedSrc);
        globalAudio.load();

        globalAudio.addEventListener("loadedmetadata", function handleMetadata() {
          globalAudio.removeEventListener("loadedmetadata", handleMetadata);
          if (!isNaN(savedTime)) {
            globalAudio.currentTime = savedTime;
          }
        });

        $("#global-audio").show();
      }
    }

    // Save audio time every second while playing
    setInterval(() => {
      if (!globalAudio.paused && globalAudio.currentTime > 0) {
        localStorage.setItem("audioTime", globalAudio.currentTime);
      }
    }, 1000);

    // Load default view
    $(".content").load("views/home.php", function () {
      bindTrackPlayEvents();
    });

    // SPA navigation
    $(".usernavbar a, .user-menu .options a, .burger-menu a, .user-resp-navbar-bottom a").click(function (e) {
      e.preventDefault();
      const page = $(this).attr("href");

      $(".content").load("views/" + page + ".php", function () {
        bindTrackPlayEvents();
      });
    });

    // Init
    $("#global-audio").hide();
    bindTrackPlayEvents();
    restoreAudioState();
  });
</script>

<!-- Fixed blog/about alert -->
<script>
  document.querySelectorAll(".blog, .about").forEach(item => {
    item.addEventListener("click", () => {
      alert("You are leaving the Home Page!");
    });
  });
</script>
  </body>
</html>