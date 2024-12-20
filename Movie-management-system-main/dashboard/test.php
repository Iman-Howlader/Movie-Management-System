


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Profile</title>   <style>
body {
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    background-color: #121212;
    color: #f5f5f5;
    margin: 0;
    padding: 0;
}

header {
    text-align: center;
    padding: 50px 0;
    background: linear-gradient(135deg, #03f8e4 0%, #97f500 100%);
    color: black;
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.2);
    border-bottom: 5px solid #ffea70;
}

/* Admin Image */
.admin-img {
    position: absolute;
    top: 10px; /* Adjust the top position as needed */
    left: 50%;
    transform: translateX(-50%);
    width: 150px; /* Adjust the size as needed */
    height: 150px; /* Adjust the size as needed */
    border-radius: 50%;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.3);
    border: 3px solid #fff;
    z-index: 1; /* Ensure the image appears above other content */
}

/* Admin Text */
.admin-text {
    text-align: left;
    z-index: 2; /* Ensure the text appears above the image */
}
header h2 {
    margin: 0;
    font-size: 20px;
    font-weight: 300;
    text-transform: uppercase;
    letter-spacing: 1px;
}

header h1 {
    margin: 10px 0 0;
    font-size: 48px;
    font-weight: 700;
    text-transform: uppercase;
    letter-spacing: 3px;
}

/* Button Styles */
.primary-btn,
.secondary-btn,
.child-btn {
    display: flex;
    justify-content: center;
    flex-wrap: wrap;
    gap: 20px; /* Increase the gap between buttons */
    margin-top: 30px;
}

button,
.intermediate-btn,
.secondary-btn > div button,
.child-btn > div button {
    padding: 15px 30px;
    border: none;
    background-color: #f5c700;
    color: black;
    border-radius: 50px;
    cursor: pointer;
    font-size: 18px;
    font-weight: 600;
    transition: all 0.3s ease;
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.3);
    margin: 10px; /* Ensure buttons are spaced apart */
}

button:hover,
.intermediate-btn:hover,
.secondary-btn > div button:hover,
.child-btn > div button:hover {
    background-color: #d4a200;
    transform: translateY(-2px);
}

button:active,
.intermediate-btn:active,
.secondary-btn > div button:active,
.child-btn > div button:active {
    background-color: #a67800;
    transform: translateY(0);
}

/* Secondary and Child Buttons */
.secondary-btn,
.child-btn > div {
    display: none;
    background-color: #1e1e1e;
    padding: 30px;
    border-radius: 20px;
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.3);
    max-width: 80%;
    margin: 20px auto;
    text-align: center;
}

.secondary-btn > div,
.child-btn > div {
    display: none;
    width: 100%;
}

a {
    color: black;
    text-decoration: none;
    font-weight: 600;
}

a:hover {
    text-decoration: underline;
}

/* Responsive Styles */
@media (max-width: 768px) {
    header h1 {
        font-size: 36px;
    }

    header h2 {
        font-size: 20px;
    }

    button,
    .intermediate-btn,
    .secondary-btn > div button,
    .child-btn > div button {
        font-size: 16px;
        padding: 12px 20px;
    }
}

</style>

  
</head>

<body>
    <header>
        <div class="admin-info">
            <img src="homepage_background.jpg" alt="Admin Image" class="admin-img">
            <div class="admin-text">
                <h2>Welcome</h2>
                <h1>Admin Name</h1>
            </div>
        </div>
        <div class="primary-btn">
            <button id="main-btn">Main</button>
            <button id="movies-btn">Movies</button>
            <button id="food-btn">Food</button>
            <button id="review-btn">Review</button>
        </div>
    </header>

    <div class="secondary-btn" id="secondary-btn">
        <div class="main-btn">
            <button class="intermediate-btn" data-target="lang-gen">Language and Genre</button>
            <button class="intermediate-btn" data-target="director">Director</button>
            <button class="intermediate-btn" data-target="cast">Cast</button>
            <button class="intermediate-btn" data-target="producer">Producer</button>
        </div>

        <div class="movies-btn">
            <button class="intermediate-btn" data-target="add-movies">Add Movies</button>
            <button class="intermediate-btn" data-target="movie-show">Movie Show</button>
            <button class="intermediate-btn" data-target="update-movies">Update</button>
            <button class="intermediate-btn" data-target="delete-movies">Delete</button>
        </div>

        <div class="food">
            <button class="intermediate-btn" data-target="add-food">Add Foods</button>
            <button class="intermediate-btn" data-target="show-food">Show</button>
            <button class="intermediate-btn" data-target="delete-food">Delete</button>
        </div>

        <div class="review">
            <button class="intermediate-btn" data-target="add-review">Add Reviews</button>
            <button class="intermediate-btn" data-target="show-review">Show Reviews</button>
            <button class="intermediate-btn" data-target="delete-review">Delete Reviews</button>
        </div>
    </div>

    <div class="child-btn" id="child-btn">
        <div class="lang-gen">
            <button>
                <div class="add-lang"><a href="">Add Language</a>
                </div>
            </button>
            <button>
                <div class="show-lang"><a href="">Show Language</a>
                </div>
            </button>
            <button>
                <div class="add-gen"><a href="">Add Genre</a>
                </div>
            </button>
            <button>
                <div class="show-gen"><a href="">Show Genre</a>
                </div>
            </button>
        </div>


        <div class="director">
            <button>
                <div class="add-dir"><a href="">Add Director</a>
                </div>
            </button>
            <button>
                <div class="show-dir"><a href="">Show Director</a>
                </div>
            </button>
            <button>
                <div class="up-dir"><a href="">Update</a>
                </div>
            </button>
            <button>
                <div class="del-dir"><a href="">Delete</a>
                </div>
            </button>
        </div>

        <div class="cast">
            <button>
                <div class="add-cst"><a href="">Add Cast</a>
                </div>
            </button>
            <button>
                <div class="show-cst"><a href="">Show Cast</a>
                </div>
            </button>
            <button>
                <div class="up-cst"><a href="">Update</a>
                </div>
            </button>
            <button>
                <div class="del-cst"><a href="">Delete</a>
                </div>
            </button>
        </div>

        <div class="producer">
            <button>
                <div class="add-prod"><a href="">Add Producer</a>
                </div>
            </button>
            <button>
                <div class="show-prod"><a href="">Show Producer</a>
                </div>
            </button>
            <button>
                <div class="up-prod"><a href="">Update</a>
                </div>
            </button>
            <button>
                <div class="del-prod"><a href="">Delete</a>
                </div>
            </button>
        </div>

        <div class="add-movies">
            <button>
                <div class="add-movies2"><a href="">Add Movies</a></div>
            </button>
        </div>

        <div class="movie-show">
            <button>
                <div class="movie-show2"><a href="">Show Movies</a></div>
            </button>
        </div>

        <div class="update-movies">
            <button>
                <div class="update-movies2"><a href="">Upadte</a></div>
            </button>
        </div>

        <div class="delete-movies">
            <button>
                <div class="delete-movies"><a href="">Delete Movies</a></div>
            </button>
        </div>

        <div class="add-food">
            <button>
                <div class="add-food2"><a href="">Add Foods</a></div>
            </button>
        </div>

        <div class="show-food">
            <button>
                <div class="show-food2"><a href="">Show Foods</a></div>
            </button>
        </div>

        <div class="delete-food">
            <button>
                <div class="delete-food2"><a href="">Delete Foods</a></div>
            </button>
        </div>

        <div class="add-review">
            <button>
                <div class="add-review2"><a href="">Add Reviews</a></div>
            </button>
        </div>

        <div class="show-review">
            <button>
                <div class="show-review2"><a href="">Show Reviews</a></div>
            </button>
        </div>

        <div class="delete-review">
            <button>
                <div class="delete-review2"><a href="">Delete Reviews</a></div>
            </button>
        </div>
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const primaryButtons = document.querySelectorAll('.primary-btn button');
            const secondaryBtnContainer = document.querySelector('.secondary-btn');
            const secondarySections = document.querySelectorAll('.secondary-btn > div');
            const intermediateButtons = document.querySelectorAll('.intermediate-btn');
            const childBtnContainer = document.querySelector('.child-btn');
            const childSections = document.querySelectorAll('.child-btn > div');

            primaryButtons.forEach((button, index) => {
                button.addEventListener('click', () => {
                    // Hide all secondary sections
                    secondarySections.forEach(section => section.style.display = 'none');

                    // Show the corresponding secondary section
                    secondarySections[index].style.display = 'flex';

                    // Show the secondary button container if not already visible
                    secondaryBtnContainer.style.display = 'flex';

                    // Hide all child sections
                    childSections.forEach(section => section.style.display = 'none');

                    // Remove active class from all buttons and add to the clicked one
                    primaryButtons.forEach(btn => btn.classList.remove('active'));
                    button.classList.add('active');
                });
            });

            intermediateButtons.forEach(button => {
                button.addEventListener('click', () => {
                    const target = button.dataset.target;

                    // Hide all child sections
                    childSections.forEach(section => section.style.display = 'none');

                    // Show the corresponding child section
                    document.querySelector(`.${target}`).style.display = 'flex';

                    // Show the child button container if not already visible
                    childBtnContainer.style.display = 'flex';
                });
            });
        });
    </script>
</body>

</html>













