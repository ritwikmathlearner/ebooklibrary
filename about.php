<?php
    require_once 'connection.php';
    error_reporting (0);
    session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Ebook Library - Home</title>
    <link rel="stylesheet" href="./css/style.css">
    <script src="https://kit.fontawesome.com/9d4da5e5f7.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/vue/dist/vue.js"></script>
</head>
<body>
    <header>
        <nav>
            <div class="logo">
                <a href="index.php"><i class="fas fa-book-open fa-3x"></i></a>
            </div>
            <menu class="nav-link">
                <li><a href="index.php">Home</a></li>
                <li><a href="books.php">E-books</a></li>
                <li><a href="author.php">Authors</a></li>
                <li><a href="about.php" class="active">About</a></li>
                <li><a href="contact.php">Contact</a></li>
                <?php 
                    if(isset($_SESSION["customer_name"])) {
                ?>
                    <li><a href="logout.php">logout</a></li>
                    <li><a href="#"><?php echo $_SESSION["customer_user_name"] ; ?></a></li>
                <?php 
                    } else {
                ?>
                    <li><a href="login.php">login</a></li>
                <?php } ?>
                </menu>
                <div class="menu-lines">
                    <div class="line1"></div>
                    <div class="line2"></div>
                    <div class="line3"></div>
                </div>
            </nav>
            <menu class="sub-menu">
                <li><a href="books.php?action=fiction">Fiction</a></li>
                <li><a href="books.php?action=fantasy">Fantasy</a></li>
                <li><a href="books.php?action=thriller">Thriller</a></li>
                <li><a href="books.php?action=horror">Horror</a></li>
                <li><a href="books.php?action=mystery">Mystery</a></li>
                <form action="books.php" method="POST" id="search-form">
                    <input type="text" name="search" id="search" placeholder="Enter book name">
                </form>
            </menu>
        </header>
        <section class="about-us-description">
            <div class="about-us-img-header">
                <h1>The right book in the right hands at the right time
                can change the world.</h1>
            </div>
            <div class="about-us-details">
                <h1>Who We Are</h1>
                <p>E-Book Library is the world’s largest site for readers and book recommendations. 
            Our mission is to help people find and share books they love. E-Book Library launched in August 2019.</p>
                <h1>A Few Things You Can Do On Goodreads</h1>
                <p>See what books your friends are reading. <br />
                    Track the books you're reading, have read, and want to read. <br />
                    Check out your personalized book recommendations. Our recommendation engine analyzes 20 billion data points to give suggestions tailored to your literary tastes. <br />
                    Find out if a book is a good fit for you from our community’s reviews.</p>
                <h1>A Message From Our Co-Founder</h1>
                <p>When I was in second grade, I discovered the Hardy Boys series. Ever since, I've loved to read — both for fun and to improve my mind. And I'm always looking for the next great book. <br /> <br />

                    One afternoon while I was scanning a friend's bookshelf for ideas, it struck me: when I want to know what books to read, I'd rather turn to a friend than any random person or bestseller list. <br /> <br />

                    So I decided to build a website – a place where I could see my friends' bookshelves and learn about what they thought of all their books. Elizabeth, my co-founder (and now my wife) wrote the site copy and I wrote the code. We started in my living room, motivated by the belief that there was a better way to discover and discuss good books, and that we could build it. <br /> <br />

                    Goodreads is that site. It is a place where you can see what your friends are reading and vice versa. You can create "bookshelves" to organize what you've read (or want to read). You can comment on each other's reviews. You can find your next favorite book. And on this journey with your friends you can explore new territory, gather information, and expand your mind. <br /> <br />

                    Knowledge is power, and power is best shared among readers. </p>
                </div>
                <div class="about-us-fact">
                    <h3>1 million</h3>
                    <p>MEMBERS</p>
                    <hr>
                    <h3>15 Hundred</h3>
                    <p>BOOKS ADDED</p>
                    <hr>
                    <h3>2 million</h3>
                    <p>REVIEWS</p>
                    <hr>
                </div>
        </section>
        <footer>
            <div>
                <h2>Company</h2>
                <a href="about.php">About us</a>
                <a href="#">Careers</a>
                <a href="#">Terms</a>
                <a href="#">Privacy</a>
                <a href="#">Help</a>
            </div>
            <div>
                <h2>Work with us</h2>
                <a href="author.php">Authors</a>
                <a href="#">Advertise</a>
                <a href="#">Authors & ads blog</a>
                <a href="#">API</a>
            </div>
            <div>
                <h2>CONNECT</h2>
                <a href="#"><i class="fab fa-facebook fa-2x"></i></a>
                <a href="#"><i class="fab fa-twitter-square fa-2x"></i></a>
                <a href="#"></a>
                <a href="#"></a>
            </div>
            <div>
                <img src="./img/ios.svg" alt="ios">
                <img src="./img/android.png" alt="android">
                <p>&copy; 2019 E-Book Library, Inc.</p>
                <a href="#">Mobile Version</a>
            </div>
        </footer>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/axios/0.19.0/axios.min.js" integrity="sha256-S1J4GVHHDMiirir9qsXWc8ZWw74PHHafpsHp5PXtjTs=" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/vue/dist/vue.js"></script>
        <script src="./js/main.js"></script>
        <script src="./js/navigation.js"></script>
    </body>
    </html>