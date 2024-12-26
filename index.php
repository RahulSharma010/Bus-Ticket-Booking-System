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
            height: 100%;
            background: url(Images/background1.jpg) no-repeat center center fixed;
            background-size: cover;
        }

        .navbar {
            background: linear-gradient(to right, #000000, #434343);
            padding: 20px 40px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        .navbar-container {
            display: flex;
            align-items: center;
            justify-content: space-between;
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

        .front {
            display: flex;
            justify-content: center;
            align-items: center;
            position: relative;
        }

        .front img {
            width: 100%;
        }

        /* Centering h1, h2, and button */
        .front-content {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            text-align: center;
        }

        .front h1,
        .front h2 {
            color: rgb(0, 0, 0);
            margin: 10px 0;
            font-family: Georgia, 'Times New Roman', Times, serif;
        }

        .front button {
            color: rgb(0, 0, 0);
            font-size: 2.5em;
            background-color: rgb(224, 168, 56);
            border-radius: 20px;
            padding: 10px;
            cursor: pointer;
            transition: background-color 0.25s, box-shadow 0.3s ease;
            margin-top: 20px;
        }

        .front-content h1 {
            font-size: 3em;
        }

        .front-content h2 {
            font-size: 2em;
        }

        .front button:hover {
            background-color: rgb(255, 227, 104);
            box-shadow: 0 15px 10px rgb(35, 34, 34);
        }

        /* Card styles */
        .cards {
            display: flex;
            justify-content: space-around;
            padding: 50px 0;
            gap: 20px;
        }

        .card {
            position: relative;
            width: 330px;
            height: 430px;
            overflow: hidden;
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s ease;
            cursor: pointer;
        }

        .card img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .card-text {
            display: none;
            /* Initially hidden */
            position: absolute;
            bottom: 0;
            left: 0;
            width: 100%;
            background: rgba(19, 19, 19, 0.8);
            color: #ffffff;
            text-align: center;
            padding: 10px;
            box-sizing: border-box;
            transition: bottom 0.3s ease;
            font-family: Verdana, Geneva, Tahoma, sans-serif;
        }


        .card:hover {
            transform: scale(1.05);
        }

        .card:hover .card-text {

            bottom: 0;
            display: block;
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

        .marquee-container {
            width: 100%;
            overflow: hidden;
            white-space: nowrap;
            box-sizing: border-box;
        }

        #marquee-text {
            display: inline-block;
            animation: marquee 20s linear infinite;
            font-size: 1.2em;
            color: white;
        }

        @keyframes marquee {
            0% {
                transform: translateX(100%);
            }

            100% {
                transform: translateX(-100%);
            }
        }

        #popup {
            display: none;
            /* Keep it hidden by default */
            left: 50%;
            top: 50%;
            transform: translate(-50%, -50%);
            background-color: #fff;
            border: 2px solid #000;
            padding: 20px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.5);
            z-index: 1000;
            border-radius: 10px;
            position: fixed;
            max-width: 90%;
            /* Limit the width of the dialog box */
            max-height: 90%;
            /* Limit the height of the dialog box */
            overflow: auto;
        }

        .close-btn {
            position: absolute;
            /* Positioning to the top right */
            top: 10px;
            /* Adjust as needed */
            right: 10px;
            /* Adjust as needed */
            width: 40px;
            /* Width of the square */
            height: 40px;
            /* Height of the square */
            font-size: 24px;
            /* Size of the cross */
            cursor: pointer;
            /* Change cursor to pointer */
            color: white;
            /* Color of the cross */
            background-color: red;
            /* Background for the square */
            border: none;
            /* No border */
            border-radius: 5px;
            /* Optional: rounded corners */
            display: flex;
            /* Flexbox for centering */
            align-items: center;
            /* Center vertically */
            justify-content: center;
            /* Center horizontally */
            transition: transform 0.3s;
        }

        .close-btn:hover {
            transform: scale(1.1);
            /* Scale effect on hover */
        }


        /* Optional: Add a background overlay */
        #overlay {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5);
            z-index: 999;
        }

        .popup-content {
            text-align: center;
            /* Center text in the dialog */
        }

        .popup-content h2 {
            font-size: 1.8em;
            /* Responsive font size */
            margin-bottom: 15px;
            /* Margin for spacing */
        }

        .popup-content p {
            font-size: 1em;
            /* Responsive font size */
            margin-bottom: 20px;
            /* Margin for spacing */
        }

        .popup-content button {
            padding: 10px 20px;
            /* Button padding */
            font-size: 1em;
            /* Responsive font size */
            background-color: rgb(224, 168, 56);
            /* Button background */
            border: none;
            /* No border */
            border-radius: 10px;
            /* Rounded corners */
            cursor: pointer;
            /* Pointer cursor */
            transition: background-color 0.3s ease, box-shadow 0.3s ease;
            /* Transition effects */
        }

        .popup-content button:hover {
            background-color: rgb(255, 227, 104);
            /* Background on hover */
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
            /* Shadow on hover */
        }

        #popup img {
            max-width: 100%;
            /* Ensure the image does not exceed the width of the dialog box */
            height: auto;
            /* Maintain aspect ratio */
            border-radius: 5px;
            /* Optional: Add rounded corners to the image */
        }

        .contact-section {
            background-color: rgba(255, 255, 255, 0.8);
            padding: 40px;
            text-align: center;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            margin: 40px 20px;
            border-radius: 10px;
        }

        .contact-section h2 {
            font-size: 2.5em;
            margin-bottom: 20px;
            font-family: Georgia, 'Times New Roman', Times, serif;
        }

        .contact-form {
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        .form-group {
            width: 100%;
            max-width: 600px;
            margin-bottom: 20px;
        }

        .form-group label {
            display: block;
            font-size: 1.2em;
            margin-bottom: 8px;
            text-align: left;
            font-weight: bold;
        }

        .form-group input,
        .form-group textarea {
            width: 100%;
            padding: 10px;
            font-size: 1em;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        .form-group textarea {
            resize: none;
        }

        .submit-btn {
            padding: 12px 30px;
            background-color: rgb(224, 168, 56);
            border: none;
            color: #000;
            font-size: 1.2em;
            cursor: pointer;
            border-radius: 10px;
            transition: background-color 0.3s ease, box-shadow 0.3s ease;
        }

        .submit-btn:hover {
            background-color: rgb(255, 227, 104);
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
        }


        @media (max-width: 768px) {

            #popup {
                width: 90%;
                /* Keep width responsive on smaller screens */
                padding: 15px;
                /* Reduce padding for smaller screens */
            }

            .close-btn {
                width: 35px;
                /* Slightly smaller button */
                height: 35px;
                /* Slightly smaller button */
                font-size: 20px;
                /* Slightly smaller text */
            }

            .popup-content h2 {
                font-size: 1.5em;
                /* Adjust font size for smaller screens */
            }

            .popup-content p {
                font-size: 0.9em;
                /* Adjust font size for smaller screens */
            }

            .popup-content button {
                font-size: 0.9em;
                /* Adjust button font size */
            }


            .contact-section {
                padding: 30px 15px;
            }

            .contact-form {
                width: 100%;
            }

            .form-group {
                max-width: 100%;
            }

            .submit-btn {
                width: 100%;
            }

            .navbar-menu {
                display: none;
            }

            .dropbtn {
                display: block;
            }

            .dropdown {
                display: block;
            }

            #marquee-text {
                font-size: 1.0em;
            }

            .front img {
                width: 100%;
                height: 300px;
            }

            .card-text {
                display: none;
            }

            .card {
                cursor: pointer;
            }

            .card:hover .card-text {
                display: block;
                /* Show text on hover */
            }

            .form-group input,
            .form-group textarea {
                width: 90%;
            }
        }

        @media (max-width: 480px) {

            .close-btn {
                width: 30px;
                /* Further reduce button size */
                height: 30px;
                /* Further reduce button size */
                font-size: 18px;
                /* Further reduce font size */
            }

            .popup-content h2 {
                font-size: 1.3em;
                /* Further adjust font size */
            }

            .popup-content p {
                font-size: 0.8em;
                /* Further adjust font size */
            }

            .popup-content button {
                padding: 8px 16px;
                /* Adjust button padding */
                font-size: 0.8em;
                /* Adjust button font size */
            }

            .form-group input,
            .form-group textarea {
                width: 90%;
            }

            .contact-section h2 {
                font-size: 2em;
            }

            .contact-section {
                padding: 20px 10px;
            }

            .navbar-icon img {
                height: 40px;
                width: 100px;
            }

            .front h1 {
                font-size: 1.5em;
            }

            .front h2 {
                font-size: 1em;
            }

            .front button {
                font-size: 1.2em;
            }

            .cards {
                display: flex;
                flex-direction: column;
                justify-content: space-around;
                align-items: center;
            }

            .card {
                width: 280px;
                height: 380px;
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
                <li><a href="#cards"><b>About</b></a></li>
                <li><a href="#contact"><b>Help 📞</b></a></li>
                <li><a href="login.php"><b>Login / Signup</b></a></li>
            </ul>
            <div class="dropdown">
                <button class="dropbtn" onclick="toggleMenu()">☰ Menu</button>
                <div class="dropdown-content" id="dropdownMenu">
                    <a href="#home"><b>Home</b></a>
                    <a href="#cards"><b>About</b></a>
                    <a href="#contact"><b>Help 📞</b></a>
                    <a href="login.php"><b>Login / Signup</b></a>
                </div>
            </div>
        </div>
    </nav>
    <div class="marquee-container">
        <p id="marquee-text"><b>Journey with ease and comfort—wherever you go, we're here to make your travels memorable! || Book fast and save big! Enjoy exclusive discounts on your next journey. Limited time offer—grab your tickets now!</b></p>
    </div>
    <div id="overlay"></div>

    <!-- Hidden Popup Dialog -->
    <div id="popup">
        <span class="close-btn" onclick="closeDialog()">✖</span> <!-- Cross Button -->
        <img src="Images/ad.jpeg" alt="">
    </div>
    <div class="front">
        <img src="Images/front.jpg" alt="bg-icon">
        <div class="front-content">
            <h1>Online Bus Ticket Booking Site</h1>
            <h2>Aapki Yatra, Hamari Jimmedari</h2>
            <a href="login.php"><button id="book"><b>Book Now</b></button></a>
        </div>
    </div>
    <br><br>
    <div class="cards" id="cards">
        <div class="card">
            <img src="Images/card-1.jpg" alt="Card Image">
            <div class="card-text">Discover seamless travel with our bus ticket booking site! Enjoy instant discounts of up to Rs 500 on your next journey. Book now for a hassle-free, affordable, and comfortable ride to your destination.</div>
        </div>
        <div class="card">
            <img src="Images/card-2.jpg" alt="Card Image">
            <div class="card-text">Discover ultimate convenience with our comprehensive bus ticket booking site! Whether you need tickets for events, functions, or school bus services, we offer a seamless booking experience. Enjoy reliable, safe, and efficient transportation tailored to your needs. Book now and travel with ease!</div>
        </div>
        <div class="card">
            <img src="Images/card-3.jpg" alt="Card Image">
            <div class="card-text">Plan the perfect getaway with our bus ticket booking site! Book tickets for family and partner vacations effortlessly and enjoy a smooth, comfortable journey. With reliable service and great deals, your dream vacation is just a click away. Book now and make unforgettable memories!</div>
        </div>
    </div><br>

    <div class="contact-section" id="contact">
        <h2>Contact Us</h2>
        <form class="contact-form" action="mailto:your-email@example.com" method="post" enctype="text/plain">
            <div class="form-group">
                <label for="name">Name</label>
                <input type="text" id="name" name="name" placeholder="Your Name" required>
            </div>
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" id="email" name="email" placeholder="Your Email" required>
            </div>
            <div class="form-group">
                <label for="message">Message</label>
                <textarea id="message" name="message" rows="5" placeholder="Your Message" required></textarea>
            </div>
            <button type="submit" class="submit-btn">Send Message</button>
        </form>
    </div><br>

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

    <script>
        function showDialog() {
            document.getElementById("popup").style.display = "block";
            document.getElementById("overlay").style.display = "block";
        }

        // Function to hide the dialog box
        function closeDialog() {
            document.getElementById("popup").style.display = "none";
            document.getElementById("overlay").style.display = "none";
        }

        // Show the dialog after 3 seconds
        setTimeout(showDialog, 3000);

        function toggleMenu() {
            var dropdown = document.getElementById("dropdownMenu");
            if (dropdown.classList.contains("show")) {
                dropdown.classList.remove("show");
            } else {
                dropdown.classList.add("show");
            }
        }

        function toggleCardText(event) {
            if (window.innerWidth <= 768) { // Check if screen width is mobile size
                const cardText = event.currentTarget.querySelector('.card-text');

                // Toggle display between 'none' and 'block'
                if (cardText.style.display === 'block') {
                    cardText.style.display = 'none';
                } else {
                    cardText.style.display = 'block';
                }
            }
        }

        // Add event listeners to all cards
        document.querySelectorAll('.card').forEach(card => {
            card.addEventListener('click', toggleCardText);
        });
    </script>
</body>

</html>