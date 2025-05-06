$(document).ready(function () {
  function bindTrackPlayEvents() {
    $(".play-track")
      .off("click")
      .on("click", function () {
        const audioSrc = $(this).data("src");
        const globalAudio = $("#global-audio");
        globalAudio.find("source").attr("src", audioSrc);
        globalAudio[0].load();
        globalAudio[0].play();
      });
  }
  // Load default content (e.g., home.php) on first load
  $(".content").load("../views/home.php", function () {
    bindTrackPlayEvents(); // Bind after preload
  });

  // Handle menu clicks and load corresponding content
  $(
    ".usernavbar a, .user-menu a, .burger-menu a, .user-resp-navbar-bottom a"
  ).click(function (e) {
    e.preventDefault();
    let page = $(this).attr("href");

    $(".content").load("../views/" + page + ".php", function () {
      bindTrackPlayEvents(); // Attach to new elements
    });
  });

  bindTrackPlayEvents(); // Initial page load
});
