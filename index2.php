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
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/pannellum@2.5.6/build/pannellum.css" />
    <link rel="icon" type="image/icon" href="Images/hamar-icon.ico">
    <style>
        body,
        html {
            margin: 0;
            padding: 0;
            font-family: Arial, sans-serif;
            background: url(Images/background1.jpg) no-repeat center center fixed;
            background-size: cover;
            height: 100vh;
            display: flex;
            flex-direction: column;
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

        .dialog {
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .box {
            background: linear-gradient(to right, #000000, #434343);
            display: inline-block;
            margin: 100px;
            border-radius: 30px;
            min-height: 50px;
            min-width: 100px;
            padding: 20px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            overflow-wrap: break-word;
            word-wrap: break-word;
            hyphens: auto;
            color: white;
            font-size: 1.4rem;
        }

        .details1 {
            display: flex;
            gap: 40px;
        }

        .book {
            display: flex;
            justify-content: center;
            align-items: center;
        }

        /* Increase font size and style for input fields */
        input[type="text"] {
            font-size: 18px;
            /* Increase the font size */
            padding: 10px;
            /* Add some padding for better visibility */
            border: 1px solid #ccc;
            /* Add a light border */
            border-radius: 5px;
            /* Rounded corners */
            width: 250px;
            /* Adjust width */
        }

        /* Style for disabled input fields */
        input[type="text"]:disabled {
            color: #333;
            /* Darker color for disabled text */
            background-color: #f5f5f5;
            /* Light background for contrast */
            border: 1px solid #aaa;
            /* Darker border for disabled fields */
            font-weight: bold;
            /* Make the text bold for better visibility */
        }

        /* Add focus effect */
        input[type="text"]:focus {
            outline: none;
            border-color: #007bff;
            /* Blue border on focus */
            box-shadow: 0 0 5px rgba(0, 123, 255, 0.5);
            /* Light shadow on focus */
        }

        #book-btn {
            background-color: rgb(232, 167, 38);
            border: 2px solid black;
            color: rgb(0, 0, 0);
            font-size: 1.2em;
            padding: 10px 20px;
            border-radius: 20px;
            transition: background-color 0.25s, box-shadow 0.3s ease;
            cursor: pointer;
            transition: transition 0.3s;
        }

        #book-btn:hover {
            background-color: rgb(255, 227, 104);
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.3);
            transform: scale(1.1);
        }

        #view-360-btn {
            background-color: rgb(232, 167, 38);
            border: 2px solid black;
            color: rgb(0, 0, 0);
            font-size: 1.2em;
            padding: 10px 20px;
            border-radius: 20px;
            transition: background-color 0.25s, box-shadow 0.3s ease;
            cursor: pointer;
            transition: transition 0.3s;
        }

        #view-360-btn:hover {
            background-color: rgb(255, 227, 104);
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.3);
            transform: scale(1.1);
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

        #popup {
            display: block;
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -80%);
            width: 60%;
            height: 60%;
        }

        #panorama {
            width: 100%;
            height: 100%;
        }

        .close-btn {
            position: absolute;
            top: 10px;
            right: 10px;
            width: 40px;
            height: 40px;
            font-size: 24px;
            cursor: pointer;
            color: white;
            background-color: red;
            border: none;
            border-radius: 5px;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: transform 0.3s, background-color 0.3s;
            z-index: 1001;
            /* Ensures it is above other elements in the popup */
        }

        .close-btn:hover {
            transform: scale(1.1);
            background-color: darkred;
            /* Darker red on hover */
        }

        #panorama {
            width: 100%;
            height: 100vh;
            position: relative;
        }

        @media (max-width: 768px) {

            #panorama {
                height: 70vh;
                /* Adjust height for smaller screens */
            }

            #popup {
                width: 90%;
                /* Make popup wider on smaller screens */
                height: 80%;
                /* Adjust height of the popup */
                top: 50%;
                /* Center vertically */
                transform: translate(-50%, -50%);
                /* Adjust transform to center */
            }

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

            .dialog {
                padding: 20px;
                width: 80%;
                margin: 20px auto;
                /* Center the dialog */
                flex-direction: column;
                /* Stack items vertically */
            }

            .box {
                margin: 20px auto;
                /* Center the box */
                width: 100%;
                /* Take full width */
                min-width: 300px;
                /* Minimum width for better appearance */
                padding: 10px;
                /* Reduced padding */
            }

            .details1 {
                flex-direction: column;
                /* Stack labels and inputs vertically */
                align-items: flex-start;
                /* Align to the start */
            }

            .details1 label {
                margin-bottom: 5px;
                /* Space between label and input */
            }

            input[type="text"] {
                width: 88%;
                /* Full width for inputs */
                margin-bottom: 10px;
                /* Space between input fields */
            }

            .book {
                justify-content: center;
                /* Center the button */
                margin-top: 10px;
                /* Space above the button */
            }

            #book-btn {
                width: 100%;
                /* Full width for the button */
                padding: 15px;
                /* More padding for larger click area */
            }
        }

        @media (max-width: 480px) {

            #panorama {
                height: 60vh;
                /* Further adjust height for very small screens */
            }

            #popup {
                width: 95%;
                /* Full width for very small screens */
                height: auto;
                /* Auto height for better fit */
            }

            .navbar-icon img {
                height: 40px;
                width: 100px;
            }

            #book-btn {
                font-size: 1em;
                /* Smaller font size for the button */
            }

            h2 {
                font-size: 1.5rem;
                /* Adjust heading size */
            }

            .box {
                font-size: 1rem;
                /* Adjust font size in box */
            }

        }
    </style>
</head>

<body>
    <nav class="navbar">
        <div class="navbar-container">
            <a href="index1.php" class="navbar-icon"><img src="Images/Hamar Bus_transparent.png" alt="Icon"></a>
            <ul class="navbar-menu">
                <li><a href="index1.php"><b>Home</b></a></li>
                <li><a href="logout.php"><b>Log out</b></a></li>
            </ul>
            <div class="dropdown">
                <button class="dropbtn" onclick="toggleMenu()">☰ Menu</button>
                <div class="dropdown-content" id="dropdownMenu">
                    <a href="#index1.php"><b>Home</b></a>
                    <li><a href="logout.php"><b>Log out</b></a></li>
                </div>
            </div>
        </div>
    </nav>

    <div class="container">
        <div class="dialog">
            <div class="box" id="resizable-box">
                <hr>
                <h2><u>Search results for : -</u></h2><br><br><br>
                <form action="index2.php" method="get">
                    <div class="details1">
                        <label for="from"><b>From :</b></label>
                        <input type="text" id="from" name="from" disabled>
                        <label for="to"><b>To :</b></label>
                        <input type="text" id="to" name="to" disabled>
                    </div><br><br>
                    <label for="date"><b>Date :</b></label>
                    <input type="text" name="date" id="date" disabled><br><br>
                    <br><br><br>
                    <hr><br><br>
                </form>
                <?php
                // Include database connection script
                include 'config.php';

                if ($_SERVER["REQUEST_METHOD"] == "GET") {
                    if (isset($_GET['from']) && isset($_GET['to'])) {
                        $from = $_GET['from'];
                        $to = $_GET['to'];

                        // Check if connection is established
                        if ($con) {
                            // Query to retrieve id from sourcedestn table
                            $sql = "SELECT `id` FROM `sourcedestn` WHERE `fromLoc` = ? AND `toLoc` = ?";
                            $stmt = $con->prepare($sql);
                            $stmt->bind_param("ss", $from, $to);
                            $stmt->execute();
                            $result = $stmt->get_result();

                            if ($result->num_rows > 0) {
                                $row = $result->fetch_assoc();
                                $id = $row['id'];

                                // Table name based on id
                                $table_name = "`$id`";

                                // Query to retrieve details for the first bus
                                $bus1_sql = "SELECT `busid`,`Bus`, `PickupTime`, `JourneyTime`, `DropTime`, `Price` FROM $table_name";
                                $bus1_result = $con->query($bus1_sql);
                                if ($bus1_result->num_rows > 0) {
                                    while ($bus1_row = $bus1_result->fetch_assoc()) {
                                        $busId = $bus1_row['busid'];
                ?>

                                        <div class="busone">
                                            <label for="busname1_<?php echo $busId; ?>"><b>Bus Name :</b></label>
                                            <input type="text" name="busname1" id="busname1_<?php echo $busId; ?>" disabled value="<?php echo $bus1_row['Bus'] ?>"><br><br>
                                            <div class="details">
                                                <label for="pickup_<?php echo $busId; ?>"><b>Pickup :</b></label>
                                                <input type="text" name="pickup" id="pickup_<?php echo $busId; ?>" disabled value="<?php echo $bus1_row['PickupTime'] ?>">
                                                <label for="journey_<?php echo $busId; ?>"><b>Journey :</b></label>
                                                <input type="text" name="joruney" id="journey_<?php echo $busId; ?>" disabled value="<?php echo $bus1_row['JourneyTime'] ?>">
                                                <label for="drop_<?php echo $busId; ?>"><b>Drop :</b></label>
                                                <input type="text" name="drop" id="drop_<?php echo $busId; ?>" disabled value="<?php echo $bus1_row['DropTime'] ?>"><br><br>
                                                <label for="price_<?php echo $busId; ?>"><b>Price :</b></label>
                                                <input type="text" name="price" id="price_<?php echo $busId; ?>" disabled value="<?php echo $bus1_row['Price'] ?>"><br>
                                            </div><br>
                                            <div class="book">
                                                <a id="book-link_<?php echo $busId; ?>" href="index3.html"><button id="book-btn" onclick="bookBus('<?php echo $busId; ?>')">Book</button></a>
                                                <button id="view-360-btn" onclick="showPanorama()">View 360°</button>
                                            </div>
                                            <div id="overlay">
                                                <div id="popup">
                                                    <button class="close-btn" onclick="closePanorama()">X</button>
                                                    <div id="panorama"></div>
                                                </div>
                                            </div>
                                        </div><br><b></b>
                                        <hr><br>
                <?php
                                    }
                                }
                            } else {
                                echo "Database connection failed.";
                            }
                        } else {
                            echo "Invalid input.";
                        }
                    }
                }
                ?>



            </div>
        </div>
    </div>
</body>
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/pannellum@2.5.6/build/pannellum.js"></script>
<script>
    function toggleMenu() {
        var dropdown = document.getElementById("dropdownMenu");
        if (dropdown.classList.contains("show")) {
            dropdown.classList.remove("show");
        } else {
            dropdown.classList.add("show");
        }
    }

    document.addEventListener("DOMContentLoaded", function() {
        const resizableBox = document.getElementById("resizable-box");

        resizableBox.addEventListener("input", function() {
            // Adjust the size of the box based on the content
            resizableBox.style.width = resizableBox.scrollWidth + "px";
            resizableBox.style.height = resizableBox.scrollHeight + "px";
        });
    });

    function getQueryParams() {
        const params = new URLSearchParams(window.location.search);
        return {
            from: params.get('from'),
            to: params.get('to'),
            date: params.get('date')
        };
    }

    const params = getQueryParams();
    document.getElementById('from').value = `${params.from}`;
    document.getElementById('to').value = `${params.to}`;
    document.getElementById('date').value = `${params.date}`;


    function bookBus(busId) {
        const busname = document.getElementById('busname1_' + busId).value;
        const pickup = document.getElementById('pickup_' + busId).value;
        const journey = document.getElementById('journey_' + busId).value;
        const drop = document.getElementById('drop_' + busId).value;
        const price = document.getElementById('price_' + busId).value;
        const link = document.getElementById('book-link_' + busId);


        const from = "<?php echo $from; ?>";
        const to = "<?php echo $to; ?>";
        const date = params.date;
        link.href = `index3.php?busId=${encodeURIComponent(busId)}&busname=${encodeURIComponent(busname)}&pickup=${encodeURIComponent(pickup)}&journey=${encodeURIComponent(journey)}&drop=${encodeURIComponent(drop)}&price=${encodeURIComponent(price)}&from=${encodeURIComponent(from)}&to=${encodeURIComponent(to)}&date=${encodeURIComponent(date)}`;
    }

    function showDialog() {
        document.getElementById("popup").style.display = "block";
        document.getElementById("overlay").style.display = "block";
        pannellum.viewer('panorama', {
            "type": "equirectangular",
            "panorama": "Images/bus_interior.jpg",
            "autoLoad": true
        });
    }

    // Function to hide the dialog box
    function closeDialog() {
        document.getElementById("popup").style.display = "none";
        document.getElementById("overlay").style.display = "none";
        pannellum.viewer('panorama').destroy();
    }

    function showPanorama() {
        document.getElementById('overlay').style.display = 'block';

        pannellum.viewer('panorama', {
            type: 'equirectangular',
            panorama: 'Images/bus_interior.jpg', // Replace with the actual image path
            autoLoad: true,
            showZoomCtrl: true
        });
    }

    function closePanorama() {
        document.getElementById('overlay').style.display = 'none';
    }
</script>

</html>