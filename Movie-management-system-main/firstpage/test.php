<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" integrity="sha512-oKmDwxjg14BvORXH2LOM7b4pwfMQb79BnDgtjZQ3Vp6WhMxwM6yWVUY+pTXi7eV0gr2HhzWWsbW5lH0TFxSSlw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" type="text/css" href="homeAfterLogin.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css"
        integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://unpkg.com/boxicons@latest/css/boxicons.min.css">
    <link href="https://cdn.jsdelivr.net/npm/remixicon@4.2.0/fonts/remixicon.css" rel="stylesheet" />
    <title>Movie Theater Home</title>
    <style>
        :root {
            --bg-color: #f0f0f0;
            --text-color: #333;
            --header-bg: #333;
            --header-text: white;
            --main-color: red;
            --footer-bg: #333;
            --footer-text: white;
            --button-bg:#2D828C ;
            --button-hover-bg: #ff1e26;

            
        }

        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: var(--bg-color);
            color: var(--text-color);
        }

        header {
            position: fixed;
            top: 0;
            right: 0;
            left: 0;
            z-index: 1000;
            background: var(--header-bg);
            padding: 10px 2%;
            display: flex;
            align-items: center;
            justify-content: space-between;
            transition: all 0.5s ease;
        }

        .logo {
            font-size: 33px;
            font-weight: 700;
            color: var(--header-text);
            text-decoration: none; 
        }

        .logo span {
            color: var(--main-color);
        }

        .navbar {
            display: flex;
            list-style-type: none;
        }

        .navbar a {
            color: var(--header-text);
            font-size: 18px;
            font-weight: bold;
            margin: 0 15px;
            text-decoration: none;
            transition: all 0.5s ease;
        }

        .navbar a:hover {
            color: var(--main-color);
        }

        .search-form {
            display: flex;
            align-items: center;
        }

        .search-bar {
            margin-right: 20px;
        }

        .search-bar input[type="text"] {
            padding: 8px;
            border: none;
            font-size: 17px;
            border-radius: 5px;
        }

        .submit-button button {
            background-color: var(--main-color);
            color: white;
            padding: 8px 15px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 17px;
        }

        .submit-button button:hover {
            background-color: var(--button-hover-bg);
        }

        .login-button {
         background-color: var(--main-color);
         color: white;
        padding: 8px 15px;
          border: none;
        border-radius: 5px;
        cursor: pointer;
         font-size: 17px;
        text-decoration: none;
    display: flex;
    align-items: center;
}

.login-button i {
    margin-right: 5px;
}


        .slider {
            position: relative;
            width: 100%;
            height: 400px;
            overflow: hidden;
            margin-bottom: 20px;
        }

        .slides {
            display: flex;
            width: 500%;
            height: 100%;
            animation: slide 15s infinite;
        }

        .slides img {
            width: 20%;
            height: 100%;
            object-fit: cover;
        }

        @keyframes slide {
            0% { transform: translateX(0%); }
            20% { transform: translateX(-20%); }
            40% { transform: translateX(-40%); }
            60% { transform: translateX(-60%); }
            80% { transform: translateX(-80%); }
            100% { transform: translateX(-100%); }
        }

        .movie-container {
            position: relative;
            width: 100%;
            overflow: hidden;
            background-color: #fff;
            padding: 20px 0;
        }

        .movie-wrapper {
            display: flex;
            transition: transform 0.5s ease-in-out;
            padding: 0 50px;
        }

        .movie-block {
            min-width: 200px;
            width: 20%;
            margin: 0 10px;
            background-color: #f4f4f4;
            padding: 10px;
            text-align: center;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
            transition: transform 0.3s, box-shadow 0.3s;
        }

        .movie-block:hover {
            transform: scale(1.05);
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
        }

        .movie-block img {
            width: 100%;
            height: auto;
            border-radius: 8px;
        }

        .movie-block h3 {
            margin: 10px 0;
        }

        .movie-block button {
            margin-top: 5px;
            padding: 10px;
            cursor: pointer;
            background-color: var(--button-bg);
            color: white;
            border: none;
            border-radius: 5px;
            transition: background-color 0.3s;
        }

        .movie-block button:hover {
            background-color: var(--button-hover-bg);
        }

        .arrows {
            position: absolute;
            top: 50%;
            width: 100%;
            display: flex;
            justify-content: space-between;
            transform: translateY(-50%);
            z-index: 1;
        }

        .arrows span {
            cursor: pointer;
            background-color: rgba(0, 0, 0, 0.5);
            color: white;
            padding: 10px;
            border-radius: 50%;
            transition: background-color 0.3s;
        }

        .arrows span:hover {
            background-color: rgba(0, 0, 0, 0.7);
        }

        .footerContainer {
         background-color: var(--footer-bg);
        position: relative;
        bottom: 0;
        width: 100%;
         padding-bottom: 20px;
         padding-left: 100px;
       }

.socialicons {
    display: flex;
    justify-content: center;
    padding-bottom: 0px;
}

.socialicons a {
    text-decoration: none;
    padding: 10px;
    background-color: white;
    margin: 10px;
    border-radius: 50%;
}

.socialicons a i {
    font-size: 2em;
    color: #000;
    opacity: 0.9;
}

.socialicons a:hover {
    background-color:var(--main-color);
    transition: 0.5s;
}

.socialicons a:hover i {
    background-color: var(--text-color);
    transition: 0.5s;
}


        .footerNav {
            margin: 30px 0;
        }

        .footerNav ul {
            display: flex;
            justify-content: center;
            padding: 0;
            list-style-type: none;
        }

        .footerNav ul li a {
            color: var(--footer-text);
            margin: 0 20px;
            text-decoration: none;
            font-size: 1.1rem;
            opacity: 0.7;
            transition: 0.5s;
        }

        .footerNav ul li a:hover {
            color: var(--main-color);
        }

        @media (max-width: 768px) {
            .navbar {
                flex-direction: column;
                align-items: center;
            }

            .navbar a {
                margin: 10px 0;
            }

            .search-form {
                margin-top: 10px;
            }

            .movie-block {
                width: 45%;
            }

            .header {
                flex-direction: column;
                align-items: center;
            }

            .header a {
                padding: 10px;
            }

            .footerNav ul {
                flex-direction: column;
            }

            .footerNav ul li {
                margin: 10px 0;
            }
        }
    </style>
</head>

<body>
<header>
    <a href="#" class="logo">IZI <span>Movie</span></a>
    <ul class="navbar">
        <a href="#">Home</a>
        <a href="#">Movies</a>
        <a href="#">Actor</a>
        <a href="#">Actress</a>
        <a href="#">Director</a>
        <a href="#">Top 10</a>
        <a href="#">Theater</a>
        <a href="#">Watchlist</a>
    </ul>
    <form class="search-form" action="/search" method="GET">
        <div class="search-bar">
            <input type="text" name="query" placeholder="Search...">
        </div>
        <div class="submit-button">
            <button type="submit">Search</button>
        </div>
    </form>
        <button class="login-button">Login</button>
</header>


    <div class="slider">
        <div class="slides">
            <img src="https://via.placeholder.com/800x400?text=Movie+1" alt="Movie 1">
            <img src="https://via.placeholder.com/800x400?text=Movie+2" alt="Movie 2">
            <img src="https://via.placeholder.com/800x400?text=Movie+3" alt="Movie 3">
            <img src="https://via.placeholder.com/800x400?text=Movie+4" alt="Movie 4">
            <img src="https://via.placeholder.com/800x400?text=Movie+5" alt="Movie 5">
        </div>
    </div>

    <div class="movie-container">
        <div class="arrows">
            <span id="left-arrow">&lt;</span>
            <span id="right-arrow">&gt;</span>
        </div>
        <div class="movie-wrapper" id="movie-wrapper">
            <!-- PHP code to fetch and display movies goes here -->
            <?php
            ob_start();
            include '../connection/connection.php';
            ob_end_clean();
            $sql = "SELECT MovieID, Title, Image FROM movie";
            $result = $conn->query($sql);
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo '<div class="movie-block">';
                    echo '<img src="../movieadmin/images/' . $row["Image"] . '" alt="' . $row["Title"] . '">';
                    echo '<h3>' . $row["Title"] . '</h3>';
                    echo '<button>Show Details</button>';
                    echo '<button>Rate Movie</button>';
                    echo '<button>Buy Ticket</button>';
                    echo '</div>';
                }
            } else {
                echo "0 results";
            }
            $conn->close();
            ?>
        </div>
    </div>

    <footer>
        <div class="footerContainer">
            <div class="socialicons">
                <a href="#"><i class="fab fa-facebook-square"></i></a>
                <a href="#"><i class="fab fa-instagram"></i></a>
                <a href="#"><i class="fab fa-twitter"></i></a>
                <a href="#"><i class="fab fa-youtube"></i></a>
            </div>
            <div class="footerNav">
                <ul>
                    <li><a href="#">About</a></li>
                    <li><a href="#">Contact Us</a></li>
                    <li><a href="#">News</a></li>
                    <li><a href="#">Our Team</a></li>
                    <li><a href="#">Location</a></li>
                </ul>
            </div>
        </div>
    </footer>

    <script>
        const leftArrow = document.getElementById('left-arrow');
        const rightArrow = document.getElementById('right-arrow');
        const movieWrapper = document.getElementById('movie-wrapper');
        const movieBlocks = Array.from(movieWrapper.children);
        const blockWidth = movieBlocks[0].offsetWidth + 20;
        let currentIndex = 0;
        const visibleMovies = Math.floor(movieWrapper.clientWidth / blockWidth);

        function updateCarousel() {
            movieWrapper.style.transform = `translateX(-${currentIndex * blockWidth}px)`;
        }

        leftArrow.addEventListener('click', () => {
            if (currentIndex > 0) {
                currentIndex--;
                moveCarousel();
            }
        });

        rightArrow.addEventListener('click', () => {
            if (currentIndex < movieBlocks.length - visibleMovies) {
                currentIndex++;
                moveCarousel();
            }
        });

        function moveCarousel() {
            movieWrapper.style.transition = 'transform 0.5s ease-in-out';
            updateCarousel();
        }

        document.addEventListener('keydown', (event) => {
            if (event.key === 'ArrowLeft' && currentIndex > 0) {
                currentIndex--;
                moveCarousel();
            } else if (event.key === 'ArrowRight' && currentIndex < movieBlocks.length - visibleMovies) {
                currentIndex++;
                moveCarousel();
            }
        });

        window.addEventListener('resize', () => {
            updateCarousel();
        });

        // Ensure the correct display of the login button
        const loginButton = document.getElementById('loginButton');
        const profilePicture = document.getElementById('profilePicture');
        const userIcon = document.getElementById('userIcon');

        // Example: check if the profile picture is available
        const profilePictureSrc = profilePicture.getAttribute('src');
        if (profilePictureSrc && profilePictureSrc !== 'Images/Slideshow/nate-johnston-6ajf6BAyYt4-unsplash.jpg') {
            profilePicture.style.display = 'block';
            userIcon.style.display = 'none';
        }
    </script>
</body>

</html>
