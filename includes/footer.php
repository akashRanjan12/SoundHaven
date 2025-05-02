<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>FOOTER</title>
    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css"
      integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg=="
      crossorigin="anonymous"
      referrerpolicy="no-referrer" />
    <style>
      * {
        padding: 0;
        margin: 0;
      }
      body {
        overflow-x: hidden;
      }
      a {
        text-decoration: none;
        color: whitesmoke;
      }
      .container-01 {
        display: flex;
        gap: 40px;
        background-color: #010312;
        color: whitesmoke;
        justify-content: space-around;
        padding: 40px 20px;
        .logo-cont {
          display: flex;
          flex-direction: column;
          gap: 10px;
          .logo {
            font-size: 3.5rem;
            font-weight: 600;
            color: white;
          }
          .quote {
            padding: 5px 20px;
            font-size: 1.2rem;
          }
        }
        .data-cont {
          display: flex;
          gap: 50px;
          .dc-01,
          .dc-02 {
            display: flex;
            flex-direction: column;
            gap: 10px;
            color: rgb(162, 162, 162);
            h2 {
              color: white;
            }
            a {
              transition: all 0.3s ease;
              &:hover {
                transform: scale(1.1);
                color: whitesmoke;
              }
            }
          }
        }
        .sm-cont {
          display: flex;
          flex-direction: column;
          .sm {
            padding-top: 10px;
            display: flex;
            gap: 20px;
            font-size: 1.2rem;
            a {
              transition: all 0.3s ease;
              &:hover {
                transform: scale(1.2);
              }
              .fa-facebook {
                transition: all 0.3s ease;
                &:hover {
                  color: blue;
                }
              }
              .fa-github {
                transition: all 0.3s ease;
                &:hover {
                  color: rgb(98, 98, 98);
                }
              }
              .fa-instagram {
                transition: all 0.3s ease;
                &:hover {
                  color: orange;
                }
              }
              .fa-youtube {
                transition: all 0.3s ease;
                &:hover {
                  color: orangered;
                }
              }
            }
          }
        }
      }
      .footer-bottom {
        display: flex;
        justify-content: center;
        align-items: center;
        gap: 5px;
        font-size: 1.2rem;
        padding: 30px 10px;
        color: aliceblue;
        background-color: #010312;
        border-top: 1px solid gray;
      }
    </style>
  </head>
  <body>
    <footer>
      <div class="container-01">
        <div class="logo-cont">
          <div class="logo">𝄞 S☆und Haven</div>
          <div class="quote">
            <p>
              "Where every beat finds its soul."
              <br />
              Tune in. Zone out. Vibe forever.
            </p>
          </div>
        </div>
        <div class="data-cont">
          <div class="dc-01">
            <h2>Explore</h2>
            <a href="#">About Us</a>
            <a href="#">Blog</a>
            <a href="#">Charts</a>
            <a href="#">Resources for Artists</a>
          </div>
          <div class="dc-02">
            <h2>Support</h2>
            <a href="#">Help Center</a>
            <a href="#">Privacy Policy</a>
            <a href="#">Terms & Conditions</a>
            <a href="#">Community Guidelines</a>
          </div>
        </div>
        <div class="sm-cont">
          <h1>Follow us on..</h1>
          <div class="sm">
            <a href="#"><i class="fa-brands fa-github"></i></a>
            <a href="#"><i class="fa-brands fa-facebook"></i></a>
            <a href="#"><i class="fa-brands fa-youtube"></i></a>
            <a href="#"><i class="fa-brands fa-instagram"></i></a>
          </div>
        </div>
      </div>
      <div class="footer-bottom">
        <i class="fa-regular fa-copyright"></i>
        <p class="date">2025</p>
        <p>S☆und Haven — All rights reserved. Crafted for music lovers worldwide.</p>
      </div>
    </footer>
  </body>
</html>
