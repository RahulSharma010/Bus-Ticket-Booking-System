<?php
session_start();
// Check if the user is logged in
if (!isset($_SESSION['loggedin'])) {
    echo "
    <script>
        alert('You must log in first!');
        window.location.href = 'login.php';
    </script>
    ";
    exit; // Stop further execution
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hamar Bus Ticket Booking Service</title>
    <link rel="icon" type="image/icon" href="Images/hamar-icon.ico">
    <style>
        body,
        html {
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

        .journey {
            margin: 80px;
            /* Added margin for spacing */
            padding: 0px;
            /* Added padding for spacing */
            display: flex;
            justify-content: center;
            align-items: flex-start;
            /* Align items at the start */
            flex-wrap: wrap;
            /* Allow wrapping of children */
            /* Adjust this to your liking */
        }

        .booking {
            background: linear-gradient(to right, #000000, #434343);
            width: 100%;
            /* Make it responsive */
            max-width: 900px;
            /* Maintain a max width */
            display: flex;
            flex-direction: row;
            /* Stack items horizontally */
            align-items: center;
            justify-content: space-between;
            padding: 20px;
            /* Consistent padding */
            border: 2px solid black;
            border-radius: 40px;
            box-shadow: 5px 8px 15px rgba(0, 0, 0, 0.5);
            color: white;
            transition: transform 0.3s;
            margin-bottom: 20px;
            /* Space between multiple booking containers */
        }


        .booking:hover {
            transform: scale(1.1);
        }

        .booking div {
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        .booking h2 {
            margin: 0;
            padding: 10px;
            font-size: 1.5em;
        }

        #Search {
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        #Search button {
            background-color: rgb(232, 167, 38);
            border: 2px solid black;
            color: rgb(0, 0, 0);
            font-size: 1.2em;
            padding: 10px 20px;
            border-radius: 20px;
            transition: background-color 0.25s, box-shadow 0.3s ease;
            cursor: pointer;
        }

        #Search button:hover {
            background-color: rgb(255, 227, 104);
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.3);
        }

        hr {
            border: none;
            border-top: 2px solid #ddd;
            margin: 0 20px;
            width: 3px;
            height: 80px;
            background-color: #ddd;
        }

        #search-input1,
        #search-input2 {
            width: 100%;
            padding: 10px;
            box-sizing: border-box;
            font-weight: 600;
            font-size: 1.1em;
            border-radius: 15px;
        }

        #date-input {
            width: 100%;
            padding: 10px;
            box-sizing: border-box;
            font-weight: 600;
            font-size: 1.1em;
            border-radius: 15px;
        }

        .recommendations1,
        .recommendations2 {
            border: 2px solid #ccc;
            max-height: 150px;
            overflow-y: auto;
            display: none;
            /* Hide by default */
        }

        .recommendation-item {
            padding: 10px;
            border-bottom: 2px solid #ccc;
        }

        .recommendation-item:last-child {
            border-bottom: none;
        }

        .recommendation-item:hover {
            background-color: #f0f0f0;
            cursor: pointer;
        }

        .past-heading {
            color: white;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        .past-journey {
            display: flex;
            justify-content: center;
            align-items: center;
        }

        footer {
            background: linear-gradient(to right, #000000, #434343);
            color: #ffffff;
            padding: 40px 20px;
            display: flex;
            flex-direction: row;
            /* Change to column layout for small screens */
            align-items: center;
            /* Center items horizontally */
        }

        .footer-container {
            display: flex;
            flex-direction: row;
            /* Change to column layout */
            width: 100%;
            max-width: 1200px;
            margin: 0 auto;
            align-items: center;
            /* Center items */
        }

        .footer-section {
            flex: 1;
            text-align: center;
            padding: 20px;
            width: 100%;
            /* Ensure sections take full width */
        }

        .footer-map {
            margin: 20px 0;
            /* Add some margin for spacing */
        }

        .footer-logo-description img {
            max-width: 120px;
            margin-bottom: 10px;
        }

        .footer-logo-description p {
            max-width: 200px;
            margin: 0 auto;
            font-size: 14px;
            line-height: 1.6;
        }

        .footer-map img {
            max-width: 300px;
            border-radius: 10px;
        }

        .footer-socials h3,
        .footer-policy a {
            margin-bottom: 10px;
        }

        .footer-socials a img {
            width: 40px;
            margin: 0 10px;
            transition: transform 0.3s;
        }

        .footer-socials a img:hover {
            transform: scale(1.1);
        }

        .footer-policy a {
            color: #ffffff;
            text-decoration: none;
            font-size: 16px;
            transition: color 0.3s;
        }

        .footer-policy a:hover {
            color: #f0a500;
        }

        .footer-socials h3 {
            margin-bottom: 20px;
            font-size: 18px;
        }

        .footer-socials-policy {
            width: 100%;
            /* Ensure this takes full width */
            display: flex;
            flex-direction: column;
            /* Stack items vertically */
            align-items: center;
            /* Center items */
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

            hr {
                display: none;
            }

            .booking {
                flex-direction: column;
                /* Change to row layout on smaller screens */
                width: auto;
                /* Allow width to adjust */
                overflow: hidden;
                gap: 50px;
                /* Pevent overflow */
            }

            .booking div {
                flex: 1;
                /* Allow each booking div to take equal space */
                margin: 0 10px;
                /* Add margin between items */
            }

            .navbar-icon img {
                height: 40px;
                width: 100px;
            }

            footer {
                flex-direction: column;
                /* Revert to row layout on larger screens */
            }

            .footer-container {
                flex-direction: column;
                /* Keep row layout */
                justify-content: space-between;
                /* Space items out */
            }
        }
    </style>
</head>

<body>
    <nav class="navbar" id="home">
        <div class="navbar-container">
            <a href="#home" class="navbar-icon"><img src="Images/Hamar Bus_transparent.png" alt="Icon"></a>
            <ul class="navbar-menu">
                <li><a href="#home"><b>Home</b></a></li>
                <li><a href="logout.php"><b>Log out</b></a></li>
            </ul>
            <div class="dropdown">
                <button class="dropbtn" onclick="toggleMenu()">☰ Menu</button>
                <div class="dropdown-content" id="dropdownMenu">
                    <a href="#home"><b>Home</b></a>
                    <li><a href="logout.php"><b>Log out</b></a></li>
                </div>
            </div>
        </div>
    </nav>
    <div class="journey">
        <div class="booking">
            <div class="from">
                <h2>From:</h2>
                <input type="text" id="search-input1" placeholder="Search..." required>
                <div id="recommendations1" class="recommendations1"></div>
            </div>
            <hr>
            <div class="to">
                <h2>To:</h2>
                <input type="text" id="search-input2" placeholder="Search..." required>
                <div id="recommendations2" class="recommendations2"></div>
            </div>
            <hr>
            <div class="date">
                <h3>Date:</h3>
                <input type="date" id="date-input" required>
            </div>
            <hr>
            <div id="Search">
                <button onclick="searchData()"><b>Search Buses</b></button>
            </div>
        </div>
    </div>
    <div class="past-journey">
        <h2 class="past-heading"><u>View your Past journeys : -</u></h2>
    </div>
    <footer>
        <div class="footer-container">
            <div class="footer-section footer-logo-description">
                <img src="Images/Hamar Bus_transparent.png" alt="Logo">
                <p><b>Hamar Bus Ticket Booking Service - Your reliable partner for seamless and comfortable bus travel.</b></p>
            </div>
            <div class="footer-section footer-map">
                <h3><u>Available Bus Routes : -</u></h3>
                <h4>Tatanagar,
                    Bhubaneswar,
                    Kolkata,
                    Puri
                </h4>
            </div>
            <div class="footer-section footer-socials-policy">
                <div class="footer-socials">
                    <h3>Follow Us</h3>
                    <a href="#"><img src="Images/facebook.png" alt="Facebook"></a>
                    <a href="#"><img src="Images/X.png" alt="X"></a>
                    <a href="#"><img src="Images/instagram.png" alt="Instagram"></a>
                </div><br>
                <div class="footer-policy">
                    <br>
                    <a href="#"><b>Privacy Policy</b></a>
                </div>
            </div>
        </div>
    </footer>
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

    // script.js
    const today = new Date().toISOString().split('T')[0];
    document.getElementById('date-input').setAttribute('min', today);

    // Sample data for recommendations
    const data = [
        "Tatanagar",
        "Bhubaneswar",
        "Kolkata",
        "Puri",
    ];

    document.addEventListener('DOMContentLoaded', () => {
        const searchInput1 = document.getElementById('search-input1');
        const searchInput2 = document.getElementById('search-input2');
        const recommendationsContainer1 = document.getElementById('recommendations1');
        const recommendationsContainer2 = document.getElementById('recommendations2');

        searchInput1.addEventListener('input', () => {
            const query = searchInput1.value.toLowerCase();
            recommendationsContainer1.innerHTML = '';

            if (query) {
                const filteredData = data.filter(item => item.toLowerCase().includes(query));
                filteredData.forEach(item => {
                    const div = document.createElement('div');
                    div.classList.add('recommendation-item');
                    div.textContent = item;
                    div.addEventListener('click', () => {
                        searchInput1.value = item;
                        recommendationsContainer1.innerHTML = '';
                        recommendationsContainer1.style.display = 'none';
                    });
                    recommendationsContainer1.appendChild(div);
                });
                recommendationsContainer1.style.display = 'block';
            } else {
                recommendationsContainer1.style.display = 'none';
            }
        });
        searchInput2.addEventListener('input', () => {
            const query = searchInput2.value.toLowerCase();
            recommendationsContainer2.innerHTML = '';

            if (query) {
                const filteredData = data.filter(item => item.toLowerCase().includes(query));
                filteredData.forEach(item => {
                    const div = document.createElement('div');
                    div.classList.add('recommendation-item');
                    div.textContent = item;
                    div.addEventListener('click', () => {
                        searchInput2.value = item;
                        recommendationsContainer2.innerHTML = '';
                        recommendationsContainer2.style.display = 'none';
                    });
                    recommendationsContainer2.appendChild(div);
                });
                recommendationsContainer2.style.display = 'block';
            } else {
                recommendationsContainer2.style.display = 'none';
            }
        });
    });

    function searchData() {
        const from = document.getElementById('search-input1').value;
        const to = document.getElementById('search-input2').value;
        const date = document.getElementById('date-input').value;
        window.location.href = `index2.php?from=${encodeURIComponent(from)}&to=${encodeURIComponent(to)}&date=${encodeURIComponent(date)}`;
    }
    window.history.pushState(null, "", window.location.href); // Push current state

    window.addEventListener("popstate", function() {
        // When the user presses the back button, push the same state again
        window.history.pushState(null, "", window.location.href);
        alert("Back navigation is disabled!");
    });
</script>

</html>