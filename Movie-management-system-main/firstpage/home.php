<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Movie Theater Home</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }
        .header {
            display: flex;
            justify-content: space-around;
            background-color: #333;
            padding: 10px 0;
        }
        .header a {
            color: white;
            text-decoration: none;
            padding: 14px 20px;
        }
        .header a:hover {
            background-color: #ddd;
            color: black;
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
            animation: slide 10s infinite;
        }
        .slides img {
            width: 20%;
            height: 100%;
            object-fit: cover;
        }
        @keyframes slide {
            0% { transform: translateX(0%); }
            20%, 100% { transform: translateX(-20%); }
            25%, 45% { transform: translateX(-40%); }
            50%, 95% { transform: translateX(-60%); }
            70%, 75% { transform: translateX(-80%); }
        }
        .movie-container {
            position: relative;
            width: 100%;
            overflow: hidden;
        }
        .movie-wrapper {
            display: flex;
            transition: transform 0.5s ease-in-out;
            padding: 0 50px; /* Adjust padding to make space for arrows */
        }
        .movie-block {
            min-width: 200px;
            width: 20%;
            margin: 0 10px;
            background-color: #f4f4f4;
            padding: 10px;
            text-align: center;
            z-index: 0; /* Ensure movies are behind arrows */
        }
        .movie-block img {
            width: 100%;
            height: auto;
        }
        .movie-block button {
            margin-top: 5px;
            padding: 10px;
            cursor: pointer;
        }
        .arrows {
            position: absolute;
            top: 50%;
            width: 100%;
            display: flex;
            justify-content: space-between;
            transform: translateY(-50%);
            z-index: 1; /* Ensure arrows are above movies */
        }
        .arrows span {
            cursor: pointer;
            background-color: rgba(0, 0, 0, 0.5);
            color: white;
            padding: 10px;
        }
    </style>
</head>
<body>
    <div class="header">
        <a href="#">Home</a>
        <a href="#">Movies</a>
        <a href="#">Actor</a>
        <a href="#">Actress</a>
        <a href="#">Director</a>
        <a href="#">Top10_movie</a>
        <a href="#">Theater</a>
        <a href="#">Watchlist</a>
        <a href="#">News</a>
    </div>

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
            <?php
                ob_start();
                include '../connection/connection.php';
                ob_end_clean();
                $sql = "SELECT MovieID, Title, Image FROM movie";
                $result = $conn->query($sql);
                $count = 0;
                if ($result->num_rows > 0) {
                    while($row = $result->fetch_assoc()) {
                        echo '<div class="movie-block">';
                        echo '<img src="../movieadmin/images/'.$row["Image"].'" alt="'.$row["Title"].'">';
                        echo '<h3>'.$row["Title"].'</h3>';
                        echo '<button>Show Details</button>';
                        echo '<button>Rate this Movie</button>';
                        echo '<button>Buy Ticket</button>';
                        echo '</div>';
                        $count++;
                    }
                } else {
                    echo "0 results";
                }
                $conn->close();
            ?>
        </div>
    </div>

    <script>
        const leftArrow = document.getElementById('left-arrow');
        const rightArrow = document.getElementById('right-arrow');
        const movieWrapper = document.getElementById('movie-wrapper');
        const movieBlocks = Array.from(movieWrapper.children);
        const blockWidth = movieBlocks[0].offsetWidth + 20; // 200px width + 20px margin
        let currentIndex = 0;
        const visibleMovies = 3;

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
            if (event.key === 'ArrowLeft') {
                if (currentIndex > 0) {
                    currentIndex--;
                    moveCarousel();
                }
            } else if (event.key === 'ArrowRight') {
                if (currentIndex < movieBlocks.length - visibleMovies) {
                    currentIndex++;
                    moveCarousel();
                }
            }
        });

        // Adjust currentIndex if navigating using arrow keys
        document.addEventListener('keydown', (event) => {
            if (event.key === 'ArrowLeft' && currentIndex >= visibleMovies - 1) {
                currentIndex -= visibleMovies - 1;
                updateCarousel();
            } else if (event.key === 'ArrowRight' && currentIndex <= movieBlocks.length - 1 - visibleMovies) {
                currentIndex += visibleMovies - 1;
                updateCarousel
