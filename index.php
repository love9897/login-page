<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <div class="box form-box">
            <?php 
            include ("./dbconn.php");
            if(isset($_POST['submit'])){
                $email = mysqli_real_escape_string($conn,$_POST['email']);
                $password = mysqli_real_escape_string($conn,$_POST['password']);
                $result = mysqli_query($conn,"SELECT * from users where email ='$email'AND password='$password'")or die("Select Error");
                $row = mysqli_fetch_assoc($result);

                if(is_array($row)&&! empty($row)){
                    $_SESSION['valid']= $row['email'];
                    $_SESSION['username']= $row['username'];
                    $_SESSION['age']= $row['age'];
                    $_SESSION['id']= $row['id'];
                }else{
                    echo "<div class='message'>
                    <p>Wrong Username or Password</p>
                    </div> <br>";
                    echo "<a href='index.php'><button class='btn'>Go Back</button>";
                }
                if (isset($_SESSION['valid'])){
                    header("Location: ./home.php");
                }
            }else{
            ?>
            <header>Login</header>
            <form action="" method="post">
                <div class="field input">
                <label for="email">Email</label>
                <input type="text" name="email" autocomplete="off" id="email" required>
                </div>

                <div class="field input">
                <label for="password">Password</label>
                <input type="password" name="password" autocomplete="off" id="password" required>
                </div>

                <div class="field">
                <input type="submit" class="btn" name="submit" value="Login">
                </div>
                <div class="links">
                    Don't have account?  <a href="./signup.php">Sign Up</a>
                </div>
            </form>
        </div>
        <?php }?>
    </div>
</body>
</html>