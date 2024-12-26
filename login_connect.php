<?php
session_start();
include "config.php";

if (isset($_POST['login'])) {
    $u_email = $_POST['useremail'];
    $u_pass = $_POST['userpassword'];
    $id = "";
    $name = "";

    // Query to select the user details
    $result = mysqli_query($con, "SELECT * FROM `tbluser` WHERE email = '$u_email' AND password = '$u_pass'");

    if ($result && mysqli_num_rows($result) > 0) {
        // Fetch the row as an associative array
        $row = mysqli_fetch_assoc($result);
        $id = $row['id'];  // Access the 'id' field
        $name = $row['name']; // Access the 'Name' field
    } else {
        // Handle case where no matching user is found
        echo "No user found or invalid login details.";
    }

    if (mysqli_num_rows($result)) {
        // Set session variables
        $_SESSION['loggedin'] = true;
        $_SESSION['useremail'] = $u_email;
        $_SESSION['userid'] = $id;
        $_SESSION['username'] = $name; // Store the user's name in a session variable
  
        echo "
        <script>
            alert('Login Success');
            window.location.href = 'index1.php';
        </script>
        ";
    } else {
        echo "
        <script>
            alert('Incorrect Email/Password');
            window.location.href = 'login.php';
        </script>
        ";
    }
}
