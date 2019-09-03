<?php
    require_once 'connection.php';
    error_reporting(0);
    session_start();
    if(isset($_GET["bookID"])){
        function check_input($data) {
            $data = trim($data);
            $data = stripslashes($data);
            $data = htmlspecialchars($data);
            return $data;
        }
        $bookID = check_input($_GET['bookID']);
        $_SESSION['bookdisplay'] = $bookID;
        // echo $_SESSION["customer_email"];
        $sql = $conn->query("select books.*, author.fullName from books inner join author on books.author = author.authorID where book_id='$bookID'");
        while($row=$sql->fetch_assoc()) {
            $book_id = $row["book_id"];
            $bookName = $row["name"];
            $author = $row["fullName"];
            $averageRating = $row["average_rating"];
            $description = $row["description"];
            $price = $row["price"];
            $image = $row["image"];
            $pdfLink = $row["pdf_link"];
        }
    } else {
        header('Location: index.php');
    }
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <title>Ebook Library - <?php  echo $bookName; ?></title>
    <link rel="stylesheet" href="./css/style.css" />
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
          <li><a href="books.php" class="active">E-books</a></li>
          <li><a href="author.php">Authors</a></li>
          <li><a href="about.php">About</a></li>
          <li><a href="contact.php">Contact</a></li>
          <?php 
                      if(isset($_SESSION["customer_name"])) {
                  ?>
          <li><a href="logout.php">logout</a></li>
          <li>
            <a href="#"><?php echo $_SESSION["customer_user_name"] ; ?></a>
          </li>
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
    <div>
        <section class="book-page-main" id="bookShowcase" v-for="book in books">
        <img v-bind:src="book.image" v-bind:alt="book.name" />
        <div>
            <h1>{{ book.name }}</h1>
            <p class="rating">{{ book.average_rating }}</p>
            <h3>{{ book.fullName }}</h3>
            <p class="description"><?php echo $description; ?></p>
            <p class="price"><strong>Price -</strong> ${{ book.price }}</p>
            <?php 
                      if(isset($_SESSION["customer_name"])) {
                  ?>
            <a href="" v-if="purchased">Download</a>
            <button type="submit"  @click="purchaseBook(book);" v-else>PURCHASE</button>
            <div>
                <i class="fas fa-heart fa-3x wishlistIcon" @click="removeFromWIshlist();" v-if="wishlisted"></i>
                <i class="far fa-heart fa-3x wishlistIcon" @click="addToWIshlist();"  v-else></i>
            </div>
            <p class="error">{{ errorMessage }}</p>
            <p v-if="purchaseComplete">{{ credit }} is your current credit balance</p>
            <?php 
                      } else {
                  ?>
            <p class="error">Login to purchase book</p>
          <?php } ?>
        </div>
        </section>
    </div>
    <section class="book-reviews" id="reviews">
    <h1>Reviews</h1>
        <div class="user-review" v-for="review in reviews">
            <h3>{{ review.user_name }}</h3>
            <p class="rating">{{ review.rating }}</p>
            <p class="review-given">{{ review.review }}</p>
            <hr />
        </div>
        <div class="give-review" v-if="purchased">
            <select name="rating" id="" v-model="reviewInput.rating">
                 <option selected>1</option>       
                 <option>2</option>       
                 <option>3</option>       
                 <option>4</option>       
                 <option>5</option>       
            </select>
            <textarea name="reviewContext" id="reviewContext" cols="30" rows="5" v-model="reviewInput.reviewContext"></textarea>
            <button type="submit" value="addReview" name="addReview" id="user-form-btn" @click="addReview();" v-if="!reviewed">SUBMIT</button>
            <span class="error">{{ errorReviewContext }}</span>
            <span class="error">{{ errorRating }}</span>
        </div>
        <div class="give-review" v-else>
            <p class="error">You can review only purchased books</p>
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
        <img src="./img/ios.svg" alt="ios" />
        <img src="./img/android.png" alt="android" />
        <p>&copy; 2019 E-Book Library, Inc.</p>
        <a href="#">Mobile Version</a>
      </div>
    </footer>
    <script
      src="https://cdnjs.cloudflare.com/ajax/libs/axios/0.19.0/axios.min.js"
      integrity="sha256-S1J4GVHHDMiirir9qsXWc8ZWw74PHHafpsHp5PXtjTs="
      crossorigin="anonymous"
    ></script>
    <script src="https://cdn.jsdelivr.net/npm/vue/dist/vue.js"></script>
    <script src="./js/main.js"></script>
    <script src="./js/navigation.js"></script>
    <script>
        var app = new Vue({
            el: '#bookShowcase',
            data: {
                successMessage: "",
                errorMessage: "",
                purchased: false,
                purchaseComplete: false, 
                books: [],
                authorBooks: [],
                modalActive: false,
                wishlisted: true,
                authorDetail: {},
                selectedBook: {},
                credit: ""
            },
            mounted: function(){
                this.getBookDetails();
                this.checkIfPurchased();
                this.checkIfWisglisted();
            },
            methods:{
                getBookDetails: function(){
                    axios.get('process.php?action=bookdetails')
                    .then(function(response){
                        // console.log(response);
                        if(response.data.error){
                            app.errorMessage = response.data.message;
                        }
                        else{
                            app.books = response.data.bookdetails;
                            // console.log(app.books);
                        }
                    });
                },
                checkIfPurchased: function(){
                    axios.get('process.php?action=checkIfPurchased')
                    .then(function(response){
                        // console.log(response);
                        if(response.data.error){
                            app.errorMessage = response.data.message;
                        }
                        else{
                            app.purchased = response.data.bookpurchase;
                            // console.log(app.purchased);
                        }
                    });
                },
                purchaseBook: function(bookdetails){
                    app.selectedBook = bookdetails;
                    var formData = app.toFormData(app.selectedBook);
                    axios.post('process.php?action=purchase', formData)
                    .then(function(response){
                        // console.log(response);
                        app.authorDetail = {
                            authorID: ""
                        };
                        if(response.data.error){
                            app.errorMessage = response.data.message;
                        }
                        else{
                            app.purchased = response.data.result;
                            app.credit = response.data.credit;
                            app.purchaseComplete = response.data.complete;
                            // console.log(app.purchased);
                        }
                    });
                },
                checkIfWisglisted: function(){
                    axios.get('process.php?action=checkIfWisglisted')
                    .then(function(response){
                        console.log(response);
                        if(response.data.error){
                            app.wishlisted = response.data.wishlisted;
                            console.log(app.wishlisted);
                        }
                        else{
                            app.wishlisted = response.data.wishlisted;
                            console.log(app.wishlisted);
                        }
                    });
                },
                addToWIshlist: function(){
                    axios.post('process.php?action=addToWIshlist')
                    .then(function(response){
                        console.log(response);
                        if(response.data.error){
                            app.wishlisted = response.data.wishlisted;
                        }
                        else{
                            app.wishlisted = response.data.wishlisted;
                            app.checkIfWisglisted();
                        }
                    });
                }, 
                removeFromWIshlist: function(){
                    axios.post('process.php?action=removeFromWIshlist')
                    .then(function(response){
                        console.log(response);
                        if(response.data.error){
                            app.wishlisted = response.data.wishlisted;
                        }
                        else{
                            app.wishlisted = response.data.wishlisted;
                            app.checkIfWisglisted();
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
        var app2 = new Vue({
            el: '#reviews',
            data: {
                successMessage: "",
                errorMessage: "",
                purchased: false,
                reviewed: false,
                errorReviewContext: "",
                errorRating: "",
                reviewInput: {
                    rating: "",
                    reviewContext: ""
                },
                reviews: []
            },
            mounted: function(){
                this.getAllReviews();
                this.checkIfPurchased();
                this.checkIfReviewed();
            },
            methods:{
                getAllReviews: function(){
                    axios.get('process.php?action=reviews')
                    .then(function(response){
                        console.log(response);
                        if(response.data.error){
                            app2.errorMessage = response.data.message;
                        }
                        else{
                            app2.reviews = response.data.allReview;
                            console.log(app2.reviews);
                        }
                    });
                },
                checkIfPurchased: function(){
                    axios.get('process.php?action=checkIfPurchased')
                    .then(function(response){
                        console.log(response);
                        if(response.data.error){
                            app2.errorMessage = response.data.message;
                        }
                        else{
                            app2.purchased = response.data.bookpurchase;
                            console.log(app2.purchased);
                        }
                    });
                },
                checkIfReviewed: function(){
                    axios.get('process.php?action=checkIfReviewed')
                    .then(function(response){
                        console.log(response);
                        if(response.data.error){
                            app2.errorMessage = response.data.message;
                        }
                        else{
                            app2.reviewed = response.data.bookreview;
                            console.log(app2.reviewed);
                        }
                    });
                },
                addReview: function(){
                    var formData = app2.toFormData(app2.reviewInput);
                    axios.post('process.php?action=addReview', formData)
                    .then(function(response){
                        console.log(response);
                        app2.reviewInput = {
                            rating: "",
                            reviewContext: ""
                        };
                        if(response.data.reviewContextFalse){
                            app2.errorReviewContext = response.data.message;
                            // console.log(app2.errorReviewContext);
                            app2.errorRating = "";
                            app2.reviewed = false;
                        }
                        if(response.data.ratingFalse){
                            app2.errorRating = response.data.message;
                            app2.errorReviewContext = "";
                            app2.reviewed = false;
                        }
                        else if(response.data.error){
                            app2.errorMessage = response.data.message;
                            app2.reviewed = false;
                        }
                        else if(response.data.error){
                            app2.errorMessage = response.data.message;
                        }
                        else{
                            app2.getAllReviews();
                            app2.reviewed = true;
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
