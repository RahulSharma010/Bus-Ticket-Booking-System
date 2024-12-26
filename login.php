<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <style>
        html,
        body {
            margin: 0;
            padding: 0;
            font-family: Arial, sans-serif;
            background: url(Images/background1.jpg) no-repeat center center fixed;
            background-size: cover;
        }

        .navbar {
            background: linear-gradient(to right, #000000, #434343);
            padding: 20px 40px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            display: block;
        }

        .navbar-container {
            display: flex;
            align-items: center;
            justify-content: space-between;
            /* Space between items */
            flex-wrap: wrap;
            /* Allow items to wrap on smaller screens */
        }

        .navbar-icon {
            margin-right: 30px;
            /* Space between the image and the navbar menu */
        }

        .navbar-icon img {
            height: 60px;
            width: 150px;
        }

        .navbar-menu {
            list-style: none;
            display: flex;
            margin: 0;
            padding: 0;
        }

        .navbar-menu li {
            margin-left: 30px;
        }

        .navbar-menu li a {
            text-decoration: none;
            color: #ffffff;
            padding: 12px 24px;
            border-radius: 4px;
            transition: background 0.3s ease, color 0.3s ease, box-shadow 0.3s ease;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.2);
        }

        .navbar-menu li a:hover {
            background: #ffffff;
            color: #000000;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.3);
        }

        /* Responsive Navbar Menu */
        .dropdown {
            display: none;
            position: relative;
            margin-left: auto;
            /* Push the menu button to the rightmost */
        }

        .dropbtn {
            background-color: #373737;
            color: white;
            padding: 12px 20px;
            font-size: 18px;
            border: none;
            cursor: pointer;
            display: none;
            border-radius: 20px;
        }

        .dropdown-content {
            display: none;
            position: absolute;
            background-color: #333;
            min-width: 160px;
            box-shadow: 0px 8px 16px rgba(0, 0, 0, 0.2);
            right: 0;
            top: 60px;
            z-index: 1;
        }

        .dropdown-content a {
            color: white;
            padding: 12px 16px;
            text-decoration: none;
            display: block;
            text-align: left;
        }

        .dropdown-content a:hover {
            background-color: #575757;
        }

        .show {
            display: block;
        }

        .login-container {
            background: linear-gradient(to right, #000000, #434343);
            padding: 20px 40px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            text-align: center;
            width: 100%;
            max-width: 600px;
            /* Limit max width */
            margin: 50px auto;
            /* Center on the page */
            color: white;
        }

        .login-container h1 {
            margin-bottom: 20px;
        }

        .login-container form {
            display: flex;
            flex-direction: column;
        }

        .login-container label {
            text-align: left;
            margin-top: 10px;
            margin-bottom: 5px;
        }

        .login-container input,
        .login-container select {
            padding: 10px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
            width: 100%;
            box-sizing: border-box;
        }

        .login-container .checkbox-container {
            text-align: left;
            margin-top: 10px;
            display: flex;
            align-items: center;
        }

        .login-container .checkbox-container input {
            width: 45px;
        }

        .login-container button {
            padding: 10px;
            margin-top: 10px;
            border: none;
            border-radius: 4px;
            background-color: #007BFF;
            color: black;
            font-size: 16px;
            cursor: pointer;
        }

        .login-container .login-btn {
            background-color: #6c757d;
        }

        .login-container button:hover {
            background-color: #0056b3;
        }

        .login-container .login-btn:hover {
            background-color: #5a6268;
        }

        @media (max-width: 768px) {
            .navbar-menu {
                display: none;
                /* Hide menu on small screens */
            }

            .dropbtn {
                display: block;
                /* Show hamburger menu */
            }

            .dropdown {
                display: block;
                /* Show dropdown */
            }

            .navbar-container {
                justify-content: space-between;
                /* Space between items */
                flex-wrap: wrap;
                /* Allow items to wrap on smaller screens */
            }
        }

        @media (max-width: 480px) {
            .navbar-icon img {
                height: 40px;
                width: 100px;
            }

            .login-container {
                padding: 20px;
                /* Adjust padding for smaller screens */
            }
        }
    </style>
</head>

<body>
    <nav class="navbar" id="home">
        <div class="navbar-container">
            <a href="index.php" class="navbar-icon"><img src="Images/Hamar Bus_transparent.png" alt="Icon"></a>
            <ul class="navbar-menu">
                <li><a href="index.php"><b>Home</b></a></li>
            </ul>
            <div class="dropdown">
                <button class="dropbtn" onclick="toggleMenu()">☰ Menu</button>
                <div class="dropdown-content" id="dropdownMenu">
                    <a href="index.php"><b>Home</b></a>
                </div>
            </div>
        </div>
    </nav>
    <div class="container">
        <div class="login-container">
            <h1>Login</h1>
            <form action="login_connect.php" method="post">
                <label for="email"><b>Email</b></label>
                <input type="email" id="email" name="useremail" placeholder="Enter email" required>

                <label for="password"><b>Password</b></label>
                <input type="password" id="password" name="userpassword" placeholder="Enter password" required>

                <button name="login" class="login-btn"><b>Login</b></button>
            </form>
            <a href="signup.php"><button type="button"><b>Register</b></button></a>
        </div>
    </div>
</body>
<script>
    function toggleMenu() {
        var dropdown = document.getElementById("dropdownMenu");
        if (dropdown.classList.contains("show")) {
            dropdown.classList.remove("show");
        } else {
            dropdown.classList.add("show");
        }
    }
</script>

</html>