// $(document).ready(function () {
//   function bindTrackPlayEvents() {
//     $(".play-track")
//       .off("click")
//       .on("click", function () {
//         const audioSrc = $(this).data("src");
//         const globalAudio = $("#global-audio");
//         globalAudio.find("source").attr("src", audioSrc);
//         globalAudio[0].load();
//         globalAudio[0].play();
//       });
//   }
//   // Load default content (e.g., home.php) on first load
//   $(".content").load("../views/home.php", function () {
//     bindTrackPlayEvents(); // Bind after preload
//   });

//   // Handle menu clicks and load corresponding content
//   $(
//     ".usernavbar a, .user-menu a, .burger-menu a, .user-resp-navbar-bottom a"
//   ).click(function (e) {
//     e.preventDefault();
//     let page = $(this).attr("href");

//     $(".content").load("../views/" + page + ".php", function () {
//       bindTrackPlayEvents(); // Attach to new elements
//     });
//   });

//   bindTrackPlayEvents(); // Initial page load
// });
//  <script>
//   $(document).ready(function () {
//     const globalAudio = $("#global-audio")[0];
//     const userKey = "<?php echo $_SESSION['username']; ?>";

//     function bindTrackPlayEvents() {
//       $(".play-track")
//         .off("click")
//         .on("click", function () {
//           const audioSrc = $(this).data("src");
//           const globalAudioElem = $("#global-audio");

//           globalAudioElem.find("source").attr("src", "");
//           globalAudio.load();

//           setTimeout(() => {
//             globalAudioElem.find("source").attr("src", audioSrc);
//             globalAudio.load();

//             globalAudio.addEventListener("loadedmetadata", function handleLoaded() {
//               globalAudio.removeEventListener("loadedmetadata", handleLoaded);
//               globalAudio.currentTime = 0;
//               globalAudio.play();
//             });

//             $("#global-audio").slideDown(300);

//             localStorage.setItem(userKey + "_audioSrc", audioSrc);
//             localStorage.setItem(userKey + "_showPlayer", "true");
//             localStorage.removeItem(userKey + "_audioTime");
//           }, 50);
//         });
//     }

//     function restoreAudioState() {
//       const savedSrc = localStorage.getItem(userKey + "_audioSrc");
//       const showPlayer = localStorage.getItem(userKey + "_showPlayer");
//       const savedTime = parseFloat(localStorage.getItem(userKey + "_audioTime")) || 0;

//       if (savedSrc && showPlayer === "true") {
//         $("#global-audio").find("source").attr("src", savedSrc);
//         globalAudio.load();

//         globalAudio.addEventListener("loadedmetadata", function handleMetadata() {
//           globalAudio.removeEventListener("loadedmetadata", handleMetadata);
//           if (!isNaN(savedTime)) {
//             globalAudio.currentTime = savedTime;
//           }
//         });

//         $("#global-audio").show();
//       }
//     }

//     setInterval(() => {
//       if (!globalAudio.paused && globalAudio.currentTime > 0) {
//         localStorage.setItem(userKey + "_audioTime", globalAudio.currentTime);
//       }
//     }, 1000);

//     $(".content").load("views/home.php", function () {
//       bindTrackPlayEvents();
//     });

//     $(".usernavbar a, .user-menu .options a, .burger-menu a, .user-resp-navbar-bottom a").click(function (e) {
//       e.preventDefault();
//       const page = $(this).attr("href");
//       $(".content").load("views/" + page + ".php", function () {
//         bindTrackPlayEvents();
//       });
//     });

//     $("#global-audio").hide();
//     bindTrackPlayEvents();
//     restoreAudioState();
//   });
// </script>

$(document).ready(function () {
  const globalAudioElem = $("#global-audio"); // Audio element
  const globalAudio = globalAudioElem[0]; // DOM audio object
  const userKey = "<?php echo $_SESSION['username']; ?>"; // Unique user identifier for localStorage

  let trackQueue = []; // Array of track metadata
  let currentIndex = -1; // Index of currently playing track

  // Bind track click events and refresh track queue
  function bindTrackPlayEvents() {
    const trackElements = $(".play-track");

    trackQueue = trackElements
      .map(function () {
        return {
          src: $(this).data("src"),
          element: this,
        };
      })
      .get();

    trackElements.off("click").on("click", function () {
      const clickedIndex = trackElements.index(this);
      playTrackAtIndex(clickedIndex);
    });
  }

  // Play a track by index
  function playTrackAtIndex(index) {
    if (index < 0 || index >= trackQueue.length) return;
    const { src } = trackQueue[index];
    currentIndex = index;

    globalAudioElem.find("source").attr("src", src);
    globalAudio.load();

    globalAudio.addEventListener("loadedmetadata", function handleLoaded() {
      globalAudio.removeEventListener("loadedmetadata", handleLoaded);
      globalAudio.currentTime = 0;
      globalAudio.play();
    });

    globalAudioElem.slideDown(300);

    localStorage.setItem(userKey + "_audioSrc", src);
    localStorage.setItem(userKey + "_showPlayer", "true");
    localStorage.removeItem(userKey + "_audioTime");
  }

  // Restore audio state from localStorage
  function restoreAudioState() {
    const savedSrc = localStorage.getItem(userKey + "_audioSrc");
    const showPlayer = localStorage.getItem(userKey + "_showPlayer");
    const savedTime =
      parseFloat(localStorage.getItem(userKey + "_audioTime")) || 0;

    if (savedSrc && showPlayer === "true") {
      globalAudioElem.find("source").attr("src", savedSrc);
      globalAudio.load();

      globalAudio.addEventListener("loadedmetadata", function handleMetadata() {
        globalAudio.removeEventListener("loadedmetadata", handleMetadata);
        if (!isNaN(savedTime)) {
          globalAudio.currentTime = savedTime;
        }
      });

      globalAudioElem.show();

      trackQueue.forEach((track, idx) => {
        if (track.src === savedSrc) {
          currentIndex = idx;
        }
      });
    }
  }

  // Save current playback time every second
  setInterval(() => {
    if (!globalAudio.paused && globalAudio.currentTime > 0) {
      localStorage.setItem(userKey + "_audioTime", globalAudio.currentTime);
    }
  }, 1000);

  // Auto play next track when current ends------------------------------------------------------------
  globalAudio.addEventListener("ended", function () {
    playTrackAtIndex(currentIndex + 1);
  });

  // Load view based on the current hash-------------------------
  function loadViewFromHash() {
    const page = window.location.hash.substring(1) || "home";
    $(".content").load("views/" + page + ".php", function () {
      bindTrackPlayEvents();
    });
    // // this is the profile image fix
    // // Fix: If dashboard is loaded, restore profile images
    // //  const page = window.location.hash.substring(1) || "home";
    // $(".content").load("views/" + page + ".php", function () {
    //   bindTrackPlayEvents();
    //   if (
    //     page === "userDashboard" &&
    //     typeof window.loadStoredImages === "function"
    //   ) {
    //     window.loadStoredImages();
    //   }
    // });
  }

  // SPA navigation with hash---------------------------------------
  $(
    ".usernavbar a, .user-menu .options a, .burger-menu a, .user-resp-navbar-bottom a"
  ).click(function (e) {
    e.preventDefault();
    const page = $(this).attr("href").replace("#", "");
    window.location.hash = page;
  });

  $(window).on("hashchange", loadViewFromHash);

  // Initial setup--------------------------------------------
  globalAudioElem.hide();
  loadViewFromHash();
  restoreAudioState();
});
