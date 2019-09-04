<?php
    require_once 'connection.php';
    error_reporting (0);
    session_start();
    if(!isset($_SESSION['admin'])){
        header("location: index.php");
    }

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
                <li><a href="index.php" class="active">Home</a></li>
                <li><a href="books.php">E-books</a></li>
                <li><a href="author.php">Authors</a></li>
                <li><a href="about.php">About</a></li>
                <li><a href="contact.php">Contact</a></li>
                <?php 
                    if(isset($_SESSION["customer_name"])) {
                ?>
                    <li><a href="logout.php">logout</a></li>
                    <a href="wishlist.php"><?php echo $_SESSION["customer_user_name"] ; ?> (Wishlist)</a>
                <?php 
                    } 
                    elseif(isset($_SESSION["admin"])) {
                        echo '<a href="admin.php">Admin Section</a>';
                    }
                    else {
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
    <section class="userlist" id="userlist">
        <table>
            <tr>
                <th>Name</th>
                <th>user Name</th>
                <th>Password</th>
                <th>Credit</th>
                <th>Actions</th>
            </tr>
            <tr v-for="user in users">
                <td>{{ user.name }}</td>
                <td>{{ user.user_name }}</td>
                <td>{{ user.password }}</td>
                <td>{{ user.credit }}</td>
                <td>
                <i class="fas fa-edit edit-btn" @click="editModal=true; editUser(user);"> Edit</i>     
                <i class="fas fa-trash-alt delete-btn"> Delete</i>     
                </td>
            </tr>
        </table>
        <p class="error">{{ errorMsg }}</p>
        <p class="success">{{ successMsg }}</p>
        <div class="edit-modal" v-if="editModal">
            <div class="close" @click="editModal=false;">
                <p>+</p>
            </div>
            <input type="text" v-model="selecteduser.name">
            <input type="text" v-model="selecteduser.user_name">
            <input type="text" v-model="selecteduser.password">
            <input type="text" v-model="selecteduser.credit">
            <input type="hidden" v-model="selecteduser.email">
            <button @click="saveEdit(); editModal=false;">SAVE</button>
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
            el: '#userlist',
            data: {
                editModal: false,
                errorMsg: "",
                successMsg: "",
                users: [],
                selecteduser: {}
            },
            mounted: function(){
                this.getAllUsers();
            },
            methods:{
                getAllUsers: function(){
                    axios.get('process.php?action=read_users')
                    .then(function(response){
                        if(response.data.error){
                            app.errorMessage = response.data.message;
                        }
                        else{
                            app.users = response.data.users;
                            console.log(app.users);
                        }
                    });
                },
                editUser: function(user){
                    app.selecteduser = user;
                },
                saveEdit: function(){
                    var formData = app.toFormData(app.selecteduser);
                    axios.post("process.php?action=saveEdit", formData).then(function(response){
                        if(response.data.error){
                            app.errorMsg = response.data.message;
                        }
                        else{
                            app.successMsg = response.data.message;
                            app.getAllUsers();
                        }
                    });
                },
                toFormData(obj){
                    var fd = new FormData();
                    for(var i in obj){
                        fd.append(i,obj[i]);
                    }
                    return fd;
                }
            }
        });
    </script>
</body>
</html>