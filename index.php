<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>SoundHaven</title>
    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css"
      integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg=="
      crossorigin="anonymous"
      referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="assets/css/style.css" />
    <style>
      body {
        overflow-x: hidden;
        font-family: "Times New Roman", Times, serif;
      }
      .resp-design {
        display: none;
      }

      /* media querries */
      @media (max-width: 900px) {
        .pc-only-design {
          display: none;
        }
        .resp-design {
          display: flex;
        }
      }
    </style>
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
    <pc-part class="pc-only-design">
      <header>
        <div class="navbar">
          <div class="logo">𝄞 S☆und Haven</div>
          <div class="acc">
          <a href="" class="white-btn">Create Acc</a>
          <a href="" class="transparent-btn">Sigin</a>
          </div>
        </div>
      </header>
      <!-- carousel -->
      <div class="carousel">
        <!-- list item -->
        <div class="list">
          <div class="item">
            <img src="assets/rawMat/img01.jpg" alt="" />
            <div class="content">
              <div class="author">S☆UND HAVEN</div>
              <div class="title">Where Every Music</div>
              <div class="topic">Scene Live</div>
              <div class="des" style="font-size: 1.2rem">
                From bedrooms and broom closets to studios and stadiums,
                SoundCloud is where you define what’s next in music. Just hit
                upload.
              </div>
              <div class="buttons">
                <a href="" class="white-btn">Get Started</a>
                <a href="" class="transparent-btn">Explore GO +</a>
              </div>
            </div>
          </div>
          <div class="item">
            <img src="assets/rawMat/img02.jpg" alt="" />
            <div class="content">
              <div class="author">S☆UND HAVEN</div>
              <div class="title">FIND PLAYLISTs WHAT's,</div>
              <div class="topic">Find Well.</div>
              <div class="des" style="font-size: 1.2rem">
                Discover your next obsession, or become someone else’s. Sound
                Haven is the only Platform where fans and artists come together
                to discover and connect through music.
              </div>
              <div class="buttons">
                <a href="" class="white-btn">Playlists</a>
                <a href="" class="transparent-btn">Explore GO +</a>
              </div>
            </div>
          </div>
          <div class="item">
            <img src="assets/rawMat/img03.png" alt="" />
            <div class="content">
              <div class="author">S☆UND HAVEN</div>
              <div class="title">DISCOVER</div>
              <div class="topic">GET DISCOVER.</div>
              <div class="des" style="font-size: 1.2rem">
                Discover millions of songs, remixes and Bhojpuri to hollywood:
                every track you can find elsewhere, and millions more you can’t
                find anywhere else.
              </div>
              <div class="buttons">
                <a href="" class="white-btn">UPOAD</a>
                <a href="" class="transparent-btn">Explore GO +</a>
              </div>
            </div>
          </div>
          <div class="item">
            <img src="assets/rawMat/img04.png" alt="" />
            <div class="content">
              <div class="author">S☆UND HAVEN</div>
              <div class="title">Come,</div>
              <div class="topic">Join us.</div>
              <div class="des" style="font-size: 1.2rem">
                Get on S☆UND HAVEN to connect with fans, share your sounds, and
                grow your audience. What are you waiting for? Join us!
              </div>
              <div class="buttons">
                <a href="" class="white-btn">Create acc</a>
                <a href="" class="transparent-btn">Sigin</a>
              </div>
            </div>
          </div>
        </div>
        <!-- list thumnail -->
        <div class="thumbnail">
          <div class="item">
            <img src="assets/rawMat/img01.jpg" alt="" />
          </div>
          <div class="item">
            <img src="assets/rawMat/img02.jpg" alt="" />
          </div>
          <div class="item">
            <img src="assets/rawMat/img03.png" alt="" />
          </div>
          <div class="item">
            <img src="assets/rawMat/img04.png" alt="" />
          </div>
        </div>
        <!-- next prev -->

        <div class="arrows">
          <button id="prev"><</button>
          <button id="next">></button>
        </div>
        <!-- time running -->
        <div class="time"></div>
      </div>
      <!-- circle down button -->
      <a href="index.html#down"
        ><i class="fa fa-arrow-down-long fa-bounce"></i>.</a
      >
      <!-- secont page of pc part -->
      <a name="down"></a>
      <div class="down-container">
        <div class="logo reveal">𝄞 S☆und Haven</div>
        <div class="cont-01  reveal">
          <div class="search-container">
            <form action="serch.php" method="POST">
              <input
                type="search"
                placeholder="Search for artists, tracks, bands" />
            </form>
          </div>
          <font style="font-size: 1.5rem">𝑜𝓇</font>
          <a href=""><div class="btn-cont white-btn">upload Your Own.</div></a>
        </div>
        <div class="cont-02  reveal">
          <p>
            "Start by finding the music you love using the search, or upload
            your own tracks to share with others. <br />
            When you're ready for something new, hit Explore More and discover
            fresh sounds waiting for you."
          </p>
          <a href=""
            ><div class="btn-cont transparent-btn">Explore Playlists.</div></a
          >
        </div>
      </div>
      <div class="container-02">
        <div class="cont-01  reveal">
          <div class="data">
            <h1>Calling all creators</h1>
            <p>
              Get on Sound Haven to connect with fans, share your sounds, and
              grow your audience. <br />
              What are you waiting for?
            </p>
            <br />
            <a href="" class="white-btn">Find Out More.</a>
          </div>
          <div class="image">
            <img
              src="assets/rawMat/Playing Music-bro.png"
              alt=""
              width="380px" />
          </div>
        </div>
        <div class="cont-02 reveal">
          <div class="image">
            <img
              src="assets/rawMat/Playing Music-amico.png"
              alt=""
              width="380px" />
          </div>
          <div class="data">
            <h1>Get Discover</h1>
            <p>
              "Find your favorite tunes, create and upload your own music to
              share with the world, <br />
              then explore more to see what others are creating too."
            </p>
            <br />
            <a href="" class="transparent-btn">UPLOAD.</a>
          </div>
        </div>
        <div class="container-03 reveal">
          <h1>Thanks for listening. Now join us.</h1>
          <p>Save tracks, follow artists and build playlists. All for free.</p>
          <a href="" class="transparent-btn">Create new account.</a>
          <p>Already hava an account? <a href=""> Sigin!</a></p>
        </div>
      </div>
      <!-- <i class="fa-solid fa-guitar"></i> -->
       <footer style="padding-top: 60px;">
        <?php
          require "includes/footer.php";
        ?>
       </footer>
    </pc-part>
    <responsive-part class="resp-design"> tab/mobile </responsive-part>
    <script src="assets/js/logic.js"></script>
    <script src="assets/js/suffle.js"></script>
    <script src="assets/js/preload.js"></script>
  </body>
</html>
