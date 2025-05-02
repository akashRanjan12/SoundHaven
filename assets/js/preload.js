window.addEventListener("load", function () {
  // Check if the page has been loaded before
  if (!localStorage.getItem("visited")) {
    // First visit: show preloader, then store the flag
    localStorage.setItem("visited", "true");
    document.getElementById("preloader").style.display = "block";

    setTimeout(function () {
      document.getElementById("preloader").style.display = "none";
      document.getElementById("content").style.display = "block";
    }, 2000); // Delay (in milliseconds)
  } else {
    // Returning visitor: skip preloader
    document.getElementById("preloader").style.display = "none";
    document.getElementById("content").style.display = "block";
  }
});
