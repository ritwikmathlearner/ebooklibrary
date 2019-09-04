<?php
    require_once 'connection.php';
    error_reporting (0);
    session_start();
    $result = array('error' => false);
    $action = '';
    if(isset($_GET['action'])){
        $action = $_GET['action'];
    }

    if($action === 'read_author') {
        $sql = $conn->query("select authorID, fullName, short_desc, img, detailed_desc from author");
        $authors = array();
        while($row=$sql->fetch_assoc()) {
            array_push($authors, $row);
        }
        $result['authors'] = $authors;
    }

    if($action === 'read_users') {
        $sql = $conn->query("select * from user where type = 'customer'");
        $users = array();
        while($row=$sql->fetch_assoc()) {
            array_push($users, $row);
        }
        $result['users'] = $users;
    }
    
    if($action === 'read_highestRatedBooks') {
        $sql = $conn->query("select book_id, name, short_desc, image, average_rating from books Order By average_rating DESC limit 3");
        $ratedBooks = array();
        while($row=$sql->fetch_assoc()) {
            array_push($ratedBooks, $row);
        }
        $result['ratedBooks'] = $ratedBooks;
    }
    
    if($action === 'authorBooks') {
        function check_input($data) {
            $data = trim($data);
            $data = stripslashes($data);
            $data = htmlspecialchars($data);
            return $data;
        }
        $authorID = check_input($_POST['authorID']);
        $sql = $conn->query("select book_id, name, image, average_rating from author inner join books on author.authorID = books.author Where books.author = '$authorID' Order By average_rating DESC Limit 4");
        $authorBooks = array();
        while($row=$sql->fetch_assoc()) {
            array_push($authorBooks, $row);
        }
        $result['authorBooks'] = $authorBooks;
    }
    if($action === 'register') {
        function check_input($data) {
            $data = trim($data);
            $data = stripslashes($data);
            $data = htmlspecialchars($data);
            return $data;
        }
        $email = check_input($_POST['email']);
        $password = check_input($_POST['password']);
        $userName = check_input($_POST['userName']);
        $name = check_input($_POST['name']);
        if($email==''){
            $result['email'] = true;
            $result['message'] = "Email is required";
        }
     
        elseif(!filter_var($email, FILTER_VALIDATE_EMAIL)){
            $result['email'] = true;
            $result['message'] = "Invalid Email Format";
        }

        elseif($userName==''){
            $result['userName'] = true;
            $result['message'] = "User name is required";
        }

        elseif($password==''){
            $result['password'] = true;
            $result['message'] = "Password is required";
        }
        else{
            $sql="select * from user where email='$email'";
            $query=$conn->query($sql);
     
            if($query->num_rows > 0){
                $result['email'] = true;
                $result['message'] = "Email already exist";
            } else{
                $sql="select * from user where user_name='$userName'";
                $query=$conn->query($sql);
                if($query->num_rows > 0){
                    $result['userName'] = true;
                    $result['message'] = "Username already exist";
                } else {
                    $sql = "insert into user(user_name, name, email, password) values('$userName', '$name', '$email', '$password')";
                    $query = $conn->query($sql);

                    if($query){
                        $_SESSION['register_success'] = $name . ", your registration done. Now login to read books";
                    }
                    else{
                        $result['error'] = true;
                        $result['message'] = "Could not add User";
                    }
                }
            }
        }
    }
    
    if($action === 'login') {
        function check_input($data) {
            $data = trim($data);
            $data = stripslashes($data);
            $data = htmlspecialchars($data);
            return $data;
            }
            $email = check_input($_POST['email']);
            $password = check_input($_POST['password']);
            if($email==''){
                $result['email'] = true;
                $result['message'] = "Email is required";
            }
         
            elseif(!filter_var($email, FILTER_VALIDATE_EMAIL)){
                $result['email'] = true;
                $result['message'] = "Invalid Email Format";
            }

            elseif($password==''){
                $result['password'] = true;
                $result['message'] = "Password is required";
            } 

            else{
                $sql="select * from user where email='$email'";
                $query=$conn->query($sql);
         
                if($query->num_rows < 1){
                    $result['email'] = true;
                    $result['message'] = "Email does not exist. Please register first";
                } else {
                    $sql = "SELECT name, type, credit, user_name FROM user where email = '$email' AND password = '$password'";
                    $result = $conn->query($sql);
                    if ($result->num_rows > 0) {
                        while($row = $result->fetch_assoc()) {
                            $userType = $row["type"];
                            $name = $row["name"];
                            $credit = $row["credit"];
                            $user_name = $row["user_name"];
                            if($userType == "customer"){
                                // echo 'You are a customer';
                                $_SESSION["customer_name"] = $name;
                                $_SESSION["customer_email"] = $email;  
                                $_SESSION["customer_credit"] = $credit;
                                $_SESSION["customer_user_name"] = $user_name;
                            }
                            else {
                                $_SESSION["admin"] = $name;
                                $_SESSION["admin_email"] = $email;
                            }
                        }
                } else {
                    $result['error'] = true;
                    $result['message'] = "Email or password wrong";
                }
            }
        }
    }

    if($action === 'bookdetails') {
        $book_id = $_SESSION['bookdisplay'];
        $sql = $conn->query("select books.book_id, books.name, books.average_rating, books.image, books.price, author.fullName from books inner join author on books.author = author.authorID where book_id='$book_id'");
        $bookdetails = array();
        while($row=$sql->fetch_assoc()) {
            array_push($bookdetails, $row);
            // echo $row['name'];
        }
        $result['bookdetails'] = $bookdetails;
        // unset($_SESSION['bookdisplay']);
    }

    if($action === 'checkIfPurchased') {
        $book_id = $_SESSION['bookdisplay'];
        $cust_email = $_SESSION["customer_email"];
        // echo $cust_email;
        $sql = $conn->query("select user from purchase where book='$book_id' AND user = '$cust_email'");
        // $result = $conn->query($sql);
        if ($sql->num_rows > 0) {
            $result['bookpurchase'] = true;
        } else {
            $result['bookpurchase'] = false;
        }
    }

    if($action === 'saveEdit') {
        function check_input($data) {
            $data = trim($data);
            $data = stripslashes($data);
            $data = htmlspecialchars($data);
            return $data;
        }
        $email = check_input($_POST['email']);
        $name = check_input($_POST['name']);
        $user_name = check_input($_POST['user_name']);
        $password = check_input($_POST['password']);
        $credit = check_input($_POST['credit']);
        $sql = "UPDATE `user` SET `user_name` = '$user_name', `name` = '$name', `password` = '$password', `credit` = '$credit' WHERE `user`.`email` = '$email'";
        // $result = $conn->query($sql);
        $query = $conn->query($sql);
        if($query){
            $result['error'] = false;
            $result['message'] = "User edit successful";
        }
        else{
            $result['error'] = true;
            $result['message'] = "User edit failed";
            // $result['message'] = $name;
        }
    }

    if($action === 'checkIfWisglisted') {
        $book_id = $_SESSION['bookdisplay'];
        $cust_email = $_SESSION["customer_email"];
        // echo $cust_email;
        $sql = $conn->query("select customer from wishlist where book='$book_id' AND customer = '$cust_email'");
        // $result = $conn->query($sql);
        if ($sql->num_rows > 0) {
            $result['wishlisted'] = true;
        } else {
            $result['wishlisted'] = false;
        }
    }

    if($action === 'addToWIshlist') {
        $book_id = $_SESSION['bookdisplay'];
        $cust_email = $_SESSION["customer_email"];
        // echo $cust_email;
        $sql = "insert into wishlist values('$book_id', '$cust_email')";
        // $result = $conn->query($sql);
        $query = $conn->query($sql);
        if($query){
            $result['wishlisted'] = true;
        }
        else{
            $result['wishlisted'] = false;
        }
    }

    if($action === 'removeFromWIshlist') {
        $book_id = $_SESSION['bookdisplay'];
        $cust_email = $_SESSION["customer_email"];
        // echo $cust_email;
        $sql = "DELETE FROM wishlist WHERE book='$book_id' AND customer='$cust_email'";
        // $result = $conn->query($sql);
        $query = $conn->query($sql);
        if($query){
            $result['wishlisted'] = false;
        }
        else{
            $result['wishlisted'] = true;
        }
    }

    if($action === 'purchase') {
        function check_input($data) {
            $data = trim($data);
            $data = stripslashes($data);
            $data = htmlspecialchars($data);
            return $data;
        }
        $cust_email = $_SESSION["customer_email"];
        $book_id = check_input($_POST['book_id']);
        $price = check_input($_POST['price']);
        $sql = $conn->query("select credit from user where email='$cust_email'");
        $bookdetails = array();
        while($row=$sql->fetch_assoc()) {
            $credit = $row['credit'];
        }
        // $result['result'] = $credit;
        $date = date('Y/m/d H:i:s');
        if($credit > $price){
            $sql = "insert into purchase values('$cust_email', '$book_id', '$date')";
            $query = $conn->query($sql);
            if($query){
                $result['result'] = true;
                $currentCredit = $credit - $price;
                $sql = "UPDATE user SET credit='$currentCredit' WHERE email= '$cust_email'";
                if ($conn->query($sql) === TRUE) {
                    $result['credit'] = round($currentCredit,2);
                    $result['complete'] = true;
                } else {
                    // echo "Error updating record: " . $conn->error;
                }
            }
            else{
                $result['error'] = true;
                $result['message'] = "Could not process purchase";
            }
        } else {
            $result['error'] = true;
            $result['message'] = "Sorry, you do not have sufficient credit";
        }
    }

    if($action === 'reviews') {
        $book_id = $_SESSION['bookdisplay'];
        $sql = $conn->query("select rating, review, user.user_name from user inner join review on user.email = review.email where review.book = '$book_id'");
        $reviews = array();
        while($row=$sql->fetch_assoc()) {
            array_push($reviews, $row);
        }
        $result['allReview'] = $reviews;
    }

    if($action === 'checkIfReviewed') {
        $book_id = $_SESSION['bookdisplay'];
        $cust_email = $_SESSION["customer_email"];
        $sql = $conn->query("select user.user_name from user inner join review on user.email = review.email where review.book = '$book_id' and review.email = '$cust_email'");
        if ($sql->num_rows > 0) {
            $result['bookreview'] = true;
        } else {
            $result['bookreview'] = false;
        }
    }

    if($action === 'addReview') {
        function check_input($data) {
            $data = trim($data);
            $data = stripslashes($data);
            $data = htmlspecialchars($data);
            return $data;
        }
        $book_id = $_SESSION['bookdisplay'];
        $cust_email = $_SESSION["customer_email"];
        $rating = check_input($_POST['rating']);
        $reviewContext = check_input($_POST['reviewContext']);
        if($reviewContext==''){
            $result['reviewContextFalse'] = true;
            $result['message'] = "Review context is required";
        }

        elseif($rating==''){
            $result['ratingFalse'] = true;
            $result['message'] = "Rating is required";
        }

        else{
            $sql = "insert into review values('$cust_email', '$book_id', '$rating', '$reviewContext')";
            $query = $conn->query($sql);

            if($query){
                $result['message'] = $cust_email;
            }
            else{
                $result['error'] = true;
                $result['message'] = "There is some error";
            }
        }
    }

    $conn->close();
    header("Content-type: application/json");
    echo json_encode($result);
    die();
?>