<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <div class="container">
        <div class="box form-box">

        <?php
        include("./dbconn.php");
        if(isset($_POST['submit'])){
            $username = $_POST['username'];
            $email = $_POST['email'];
            $age = $_POST['age'];
            $password = $_POST['password'];

            // verify the unique email
        $verify_query = mysqli_query($conn, "SELECT email from users where email='$email'");
        if (mysqli_num_rows($verify_query)!=0){
            echo "<div class='message'>
            <p>This email is used, Try another One Plesase</p>
            </div> <br>";
            echo "<a href='javascript:self.history.back()'><button class='btn'>Go Back</button></a>";
        }else{
            mysqli_query($conn,"INSERT INTO users(username,Email,age,password)VALUES('$username','$email','$age','$password')")or die("error occured");
            echo "<div class='message'>
            <p>Signup successfully!</p>
            </div> <br>";
            echo "<a href='index.php'><button class='btn'>Login Now</button>";
        }
        }else{
        ?>
        
            <header>Signup</header>
            <form action="" method="post">
                <div class="field input">
                    <label for="username">Username</label>
                    <input type="text" name="username" autocomplete="off" id="username" required>
                </div>

                <div class="field input">
                    <label for="email">Email</label>
                    <input type="email" name="email" autocomplete="off" id="email" required>
                </div>

                <div class="field input">
                    <label for="Age">Age</label>
                    <input type="number" name="age" autocomplete="off" id="age" required>
                </div>

                <div class="field input">
                    <label for="password">Password</label>
                    <input type="password" name="password"  autocomplete="off" id="password" required>
                </div>

                <div class="field">
                    <input type="submit" class="btn" name="submit" value="Signup" required>
                </div>
                <div class="links">
                    Don't have account? <a href="index.php">Sign In</a>
                </div>
            </form>
        </div>
        <?php } ?>
    </div>
</body>

</html>