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
    if($action === 'authorBooks') {
        function check_input($data) {
            $data = trim($data);
            $data = stripslashes($data);
            $data = htmlspecialchars($data);
            return $data;
        }
        $authorID = check_input($_POST['authorID']);
        $sql = $conn->query("select book_id, name, image from author inner join books on author.authorID = books.author Where books.author = '$authorID'");
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
                            if($userType = "customer"){
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
                }
            }
        }
    }
    $conn->close();
    header("Content-type: application/json");
    echo json_encode($result);
    die();
?>