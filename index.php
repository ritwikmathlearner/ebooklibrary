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
                <li><a href="about.php">About</a></li>
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
            <li><a href="books.php?category=fiction">Fiction</a></li>
            <li><a href="">Non-fiction</a></li>
            <li><a href="">Thriller</a></li>
            <li><a href="">Horror</a></li>
            <li><a href="">Poems</a></li>
            <form action="search.php" method="POST" id="search-form">
                <input type="text" name="search" id="search" placeholder="Enter book name">
            </form>
        </menu>
        <section>
            <h1>We are here to fulfill your love for books</h1>
            <p>Read books anywhere anytime without carrying any book</p>
        </section>
    </header>
    <section class="author-list" id="authorList">
        <h1>We have covered your love for books with best authors</h1>
            <div class="author">
                <div class="author-container"  v-for="author in authors">
                    <img v-bind:src="author.img" alt="">
                    <h1>{{ author.fullName }}</h1>
                    <p>{{ author.short_desc }}</p>
                </div>
            </div>
    </section>
    <section class="aboutus" id="about">
        <h1>Our short overview</h1>
        <h2>Who We Are</h2>
        <p>E-Book Library is the world’s largest site for readers and book recommendations. 
            Our mission is to help people find and share books they love. E-Book Library launched in August 2019.</p>
        <h3>1 million</h3>
        <p>MEMBERS</p>
        <hr>
        <h3>15 Hundred</h3>
        <p>BOOKS ADDED</p>
        <hr>
        <h3>2 million</h3>
        <p>REVIEWS</p>
        <hr>
        <div class="index-about-img">
            <h3>
            The right book in the right hands at the right time
can change the world.
            </h3>
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
    <script>
        var app = new Vue({
            el: '#authorList',
            data: {
                successMessage: "",
                errorMessage: "",
                authors: []
            },
            mounted: function(){
                this.getAllAuthors();
            },
            methods:{
                getAllAuthors: function(){
                axios.get('http://localhost/ebooklibrary/process.php?action=read_author')
                    .then(function(response){
                        if(response.data.error){
                            app.errorMessage = response.data.message;
                        }
                        else{
                            app.authors = response.data.authors;
                        }
                    });
		        }
            }
        });
    </script>
</body>
</html>