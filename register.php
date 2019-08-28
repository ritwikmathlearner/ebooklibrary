<?php
    require_once 'connection.php';
    error_reporting (0);
    session_start();
    if(isset($_SESSION["customer_email"])) {
        header("location: index.php");
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Ebook Library - Register</title>
    <link rel="stylesheet" href="./css/style.css">
    <script src="https://kit.fontawesome.com/9d4da5e5f7.js"></script>
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
            </menu>
            <div class="menu-lines">
                <div class="line1"></div>
                <div class="line2"></div>
                <div class="line3"></div>
            </div>
        </nav>
        <menu class="sub-menu" style="display: none;">
            <li><a href="">Fiction</a></li>
            <li><a href="">Non-fiction</a></li>
            <li><a href="">Thriller</a></li>
            <li><a href="">Horror</a></li>
            <li><a href="">Poems</a></li>
            <form action="search.php" method="POST" id="search-form">
                <input type="text" name="search" id="search" placeholder="Enter book name">
            </form>
        </menu>
    </header>
    <div class="user-form" id="form">
        <h1>Sign up for E-book Library</h1>
        <p>{{ errorMsg }}</p>
        <div class="form-container">
            <label for="email">Email address</label><span style="font-size:13px;">{{ errorEmail }}</span>
            <input type="text" name="email" placeholder="your@email.com" id="email" v-model="newUser.email">
            <label for="name">Full name</label>
            <input type="text" name="name" placeholder="Full name" id="name" v-model="newUser.name">
            <label for="name">User name</label><span style="font-size:13px;">{{ errorUserName }}</span>
            <input type="text" name="userName" placeholder="Select an unique user name" id="userName" v-model="newUser.userName">
            <label for="pass">Password</label><span style="font-size:13px;">{{ errorPassword }}</span>
            <input type="password" name="password" placeholder="********" id="password" v-model="newUser.password">
            <button type="submit" value="register" name="register" id="user-form-btn" @click="addUser();">Register</button>
        </div>
        <p>Already a member? <a href="login.php">Sign in</a></p>
    </div>
    <footer>
        <div>
            <h2>Company</h2>
            <a href="about.php">About us</a>
            <a href="#">Car eers</a>
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
            el:'#form',
            data: {
                errorMsg: "",
                errorEmail: "",
                errorUserName: "",
                errorPassword: "",
                users: [],
                newUser: {
                    name: "",
                    email: "",
                    userName: "",
                    password: ""
                }
            },
            methods: {
                addUser(){
                    var formData = app.toFormData(app.newUser);
                    axios.post("http://localhost/ebooklibrary/process.php?action=register", formData).then(function(response){
                        console.log(response);
                        app.newUser = {
                            name: "",
                            email: "",
                            userName: "",
                            password: ""
                        };
                        if(response.data.email){
                            app.errorEmail = response.data.message;
                            app.errorUserName = '';
                            app.errorPassword = '';
                            app.focusEmail();
                            app.clearMessage();
                        }
                        else if(response.data.userName){
                            app.errorUserName = response.data.message;
                            app.errorEmail='';
                            app.errorPassword = '';
                            app.focusUserName();
                            app.clearMessage();
                        }
                        else if(response.data.password){
                            app.errorPassword = response.data.message;
                            app.errorEmail='';
                            app.errorUserName = '';
                            app.focusPassword();
                            app.clearMessage();
                        }
                        else if(response.data.error){
                            app.errorMessage = response.data.message;
                            app.errorEmail='';
                            app.errorPassword='';
                        }
                        else{
                            window.location.href = 'login.php';
                        }
                    });
                },
                toFormData(obj){
                    var fd = new FormData();
                    for(var i in obj){
                        fd.append(i,obj[i]);
                    }
                    return fd;
                },
            }
        });
    </script>
</body>
</html>