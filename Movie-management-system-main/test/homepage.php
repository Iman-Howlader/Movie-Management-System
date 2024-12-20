<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>IZI Movie</title>
    <link rel="stylesheet" type="text/css" href="homepage.css">
    <link rel="stylesheet" href="https://unpkg.com/boxicons@latest/css/boxicons.min.css">
    <link href="https://cdn.jsdelivr.net/npm/remixicon@4.2.0/fonts/remixicon.css" rel="stylesheet" />
</head>

<body>

    <header>
        <a href="homepage.html" class="logo">IZI <span>Movie</span></a>
        <ul class="navbar">
            <li><a href="homepage.php">Home</a></li>
            <li><a href="../movieadmin/AdminShowMovieList.php">Movies</a></li>
            <li><a href="#">Watchlist</a></li>
            <li><a href="#">Directors</a></li>
            <li><a href="#">Top10</a></li>
            <li><a href="#">Trailer</a></li>
            <li><a href="../Theater/TicketBooking/ticket.php">Theater</a></li>
        </ul>
        <form class="search-form" action="/search" method="GET">
            <div class="search-bar">
                <input type="text" name="query" placeholder="Search...">
            </div>
            <div class="submit-button">
                <button type="submit">Search</button>
            </div>
        </form>
        <a href="#" class="login-button">Login</a>
    </header>

    <!-- Front Image Slider -->
    <div class="imgSlider">

    </div>

    <!-- Card Container HTML -->
    <div class="card-container">
        <div class="card">
            <img src="images/Slideshow/austrian-national-library-M7Zu0vfBr8U-unsplash.jpg" alt="">
            <div class="card-content">
                <h3>Card 1</h3>
                <p>Lorem ipsum, dolor sit amet consectetur adipisicing elit.</p>
                <a href="" class="btn">Read More</a>
            </div>
        </div>
        <div class="card">
            <img src="images/SlideShow/austrian-national-library-M7Zu0vfBr8U-unsplash.jpg" alt="">
            <div class="card-content">
                <h3>Card 2</h3>
                <p>Lorem ipsum, dolor sit amet consectetur adipisicing elit.</p>
                <a href="" class="btn">Read More</a>
            </div>
        </div>
        <div class="card">
            <img src="images/SlideShow/austrian-national-library-M7Zu0vfBr8U-unsplash.jpg" alt="">
            <div class="card-content">
                <h3>Card 3</h3>
                <p>Lorem ipsum, dolor sit amet consectetur adipisicing elit.</p>
                <a href="" class="btn">Read More</a>
            </div>
        </div>
        <div class="card">
            <img src="images/SlideShow/austrian-national-library-M7Zu0vfBr8U-unsplash.jpg" alt="">
            <div class="card-content">
                <h3>Card 4</h3>
                <p>Lorem ipsum, dolor sit amet consectetur adipisicing elit.</p>
                <a href="" class="btn">Read More</a>
            </div>
        </div>

        <!-- Navigation Buttons -->
        <label for="slide-1" class="prevBtn">&#10094;</label>
        <label for="slide-2" class="nextBtn">&#10095;</label>
        <input type="radio" id="slide-1" name="slides" checked>
        <input type="radio" id="slide-2" name="slides">
    </div>

    <!-- Footer HTML -->
    <footer>
        <div class="footerContainer">
            <div class="socialicons">
                <a href="#"><i class="bx bxl-facebook-square"></i></a>
                <a href="#"><i class="bx bxl-instagram"></i></a>
                <a href="#"><i class="bx bxl-twitter"></i></a>
                <a href="#"><i class="bx bxl-youtube"></i></a>
            </div>
            <div class="footerNav">
                <ul>
                    <li><a href="#">About</a></li>
                    <li><a href="#">Contact Us</a></li>
                    <li><a href="#">News</a></li>
                    <li><a href="#">Our Team</a></li>
                    <li><a
                            href="https://www.google.com/maps/dir//Plot+%23+15,+North+South+University,+Dhaka+1229/@23.8153685,90.4236196,17z/data=!4m8!4m7!1m0!1m5!1m1!1s0x3755c64c103a8093:0xd660a4f50365294a!2m2!1d90.4255566!2d23.8151107?entry=ttu">Location</a>
                    </li>
                </ul>
            </div>
        </div>
    </footer>

    <script>
        // JavaScript for card sliding functionality
        document.addEventListener("DOMContentLoaded", function () {
            const prevBtn = document.querySelector(".prevBtn");
            const nextBtn = document.querySelector(".nextBtn");
            const cardContainer = document.querySelector(".card-container");
            const cards = document.querySelectorAll(".card");
            let currentIndex = 0;
            const cardWidth = cards[0].offsetWidth;

            // Move cards to the specified index
            function moveCards(index) {
                currentIndex = index;
                cardContainer.style.transform = `translateX(-${currentIndex * cardWidth}px)`;
            }

            // Event listener for previous button
            prevBtn.addEventListener("click", function () {
                if (currentIndex > 0) {
                    moveCards(currentIndex - 1);
                }
            });

            // Event listener for next button
            nextBtn.addEventListener("click", function () {
                const numCards = cards.length;
                if (currentIndex < numCards - 1) {
                    moveCards(currentIndex + 1);
                }
            });
        });

    </script>

</body>

</html>