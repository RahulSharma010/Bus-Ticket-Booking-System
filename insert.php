<?php
session_start();
include 'config.php';

if(isset($_POST['submit'])){
    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $password = ($_POST['password']);
    $confirm_password = ($_POST['confirm_password']);
    $gender = $_POST['gender'];

    $dup_email = mysqli_query($con,"SELECT * FROM `tbluser` WHERE email = '$email'");

    if(mysqli_num_rows($dup_email)){
        echo "
            <script>
                alert('This Email is already taken');
                window.location.href = 'signup.php';
            </script>
        ";
    }
    else{
        $_SESSION['name'] = $name;
        mysqli_query($con,"INSERT INTO `tbluser`(`name`, `email`, `number`, `password`, `cPassword`, `gender`) VALUES ('$name','$email','$phone','$password','$confirm_password','$gender')");
        echo "
        <script>
                window.location.href = 'login.php';
        </script>";
    }

}

?>
