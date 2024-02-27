<?php
session_start();

include('./dbconn.php');
if (!isset($_SESSION['valid'])) {
    header("Location: ./index.php");
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>changeProfile</title>
    <link rel="stylesheet" href="./style.css">
</head>

<body>
    <div class="nav">
        <div class="logo">
            <p><a href="home.php">Logo</a></p>
        </div>
        <div class="right-links">
            <a href="#">Change Profile</a>
            <a href="./logout.php"><button class="btn">Logout</button></a>
        </div>
    </div>

    <div class="container">
        <div class="box form-box">
            <?php
            if (isset($_POST['submit'])) {
                $username = $_POST['username'];
                $email = $_POST['email'];
                $age = $_POST['age'];

                $id = $_SESSION['id'];

                $updateQuery = mysqli_query($conn, "UPDATE users set username='$username',email='$email',age='$age' where id = '$id'") or die("error occur");

                if ($updateQuery) {
                    echo "<div class='message'>
            <p>Profile Updated!</p>
            </div> <br>";
                    echo "<a href='home.php'><button class='btn'>Go Home</button>";
                }
            } else {
                $id = $_SESSION['id'];
                $query = mysqli_query($conn, "SELECT * from users where id=$id ");

                while ($result = mysqli_fetch_assoc($query)) {
                    $res_uname = $result['username'];
                    $res_email = $result['email'];
                    $res_age = $result['age'];
                }



                ?>
                <header>Change Profile</header>
                <form action="" method="post">
                    <div class="field input">
                        <label for="username">Username</label>
                        <input type="text" name="username" value="<?php echo $res_uname; ?>" autocomplete="off" required>
                    </div>

                    <div class="field input">
                        <label for="email">Email</label>
                        <input type="email" name="email" value="<?php echo $res_email; ?>" autocomplete="off" required>
                    </div>

                    <div class="field input">
                        <label for="Age">Age</label>
                        <input type="number" name="age" value="<?php echo $res_age; ?>" autocomplete="off" required>
                    </div>



                    <div class="field">
                        <input type="submit" class="btn" name="submit" value="Update">
                    </div>

                </form>
            </div>
        <?php } ?>
    </div>

</body>

</html>