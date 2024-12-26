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

include "config.php";
$busId = "";
$busname = "";
$pickup = "";
$journey = "";
$drop = "";
$price =  "";
$from = "";
$to = "";
$date = "";

if (isset($_GET['busId']) && isset($_GET['busname']) && isset($_GET['pickup']) && isset($_GET['journey']) && isset($_GET['drop']) && isset($_GET['price']) && isset($_GET['from']) && isset($_GET['to'])) {
    $busId = $_GET['busId'];
    $busname = $_GET['busname'];
    $pickup = $_GET['pickup'];
    $journey = $_GET['journey'];
    $drop = $_GET['drop'];
    $price = $_GET['price'];
    $from = $_GET['from'];
    $to = $_GET['to'];
    $date = $_GET['date'];
}

$seatNumbers = array(
    "one",
    "two",
    "three",
    "four",
    "five",
    "six",
    "seven",
    "eight",
    "nine",
    "ten",
    "eleven",
    "twelve",
    "thirteen",
    "fourteen",
    "fifteen",
    "sixteen",
    "seventeen",
    "eighteen",
    "nineteen",
    "twenty",
    "twentyone"
);

$seatMap = array(
    "one" => 1,
    "two" => 2,
    "three" => 3,
    "four" => 4,
    "five" => 5,
    "six" => 6,
    "seven" => 7,
    "eight" => 8,
    "nine" => 9,
    "ten" => 10,
    "eleven" => 11,
    "twelve" => 12,
    "thirteen" => 13,
    "fourteen" => 14,
    "fifteen" => 15,
    "sixteen" => 16,
    "seventeen" => 17,
    "eighteen" => 18,
    "nineteen" => 19,
    "twenty" => 20,
    "twentyone" => 21
);
$updateQuery = "UPDATE `temp_seat` SET ";
foreach ($seatMap as $seatWord => $seatNumber) {
    if (isset($_GET[$seatWord])) {
        // Set the corresponding numeric seat column to 1 if it was selected
        $updateQuery .= "`$seatNumber` = 1, ";
    }
}
$updateQuery = rtrim($updateQuery, ', ');
$updateQuery .= " WHERE `busid` = $busId";
if (mysqli_query($con, $updateQuery)) {
    echo "Seats updated successfully!";
} else {
    echo "Error updating seats: " . mysqli_error($con);
}


$arraySeats = array_fill(0, 21, 0);

$query = "";

for ($i = 0; $i < 21; $i += 1) {
    if (isset($_GET[$seatNumbers[$i]])) {
        $arraySeats[$i] = 1;
        //echo $seatNumbers[$i];
        $query .= "`" . $seatNumbers[$i] . "`=1 ,";
        //echo $query;
    }
}

// Execute the query
$seats = array();
$count = 0;
for ($i = 0; $i < 21; $i++) {
    if ($arraySeats[$i] == 1) {
        $seats[$count] = $i + 1;
        $count++;
    }
}
$total = 0;
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
        }

        #submit {
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

        #submit:hover {
            background-color: rgb(255, 227, 104);
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.3);
            transform: scale(1.1);
        }

        @media (max-width: 768px) {

            #submit {
                font-size: 1em;
                padding: 8px 16px;
                border-radius: 18px;
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
        }

        @media (max-width: 480px) {

            .navbar-icon img {
                height: 40px;
                width: 100px;
            }

            #submit {
                font-size: 0.9em;
                padding: 6px 12px;
                border-radius: 16px;
                font-weight: 700;
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
                    <a href="index1.php"><b>Home</b></a>
                    <li><a href="logout.php"><b>Log out</b></a></li>
                </div>
            </div>
        </div>
    </nav>

    <form action="payscript.php" method="GET">
        <div class="dialog">
            <div class="box" id="resizable-box">
                <h1>Payment Details</h1>
                <hr>
                <h3>Selected Seats :</h3>
                <?php
                $randomNumber1 = rand(10, 99);
                $randomNumber2 = rand(10, 99);
                function getRandomCharacter($characters = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789')
                {
                    $index = rand(0, strlen($characters) - 1);
                    return $characters[$index];
                }
                $randomChar1 = getRandomCharacter();
                $randomChar2 = getRandomCharacter();
                $unqiueNumber = $randomNumber1 . $randomChar1 . $randomNumber2 . $randomChar2;
                for ($i = 0; $i < count($seats); $i++) {
                    echo $seats[$i] . " , ";
                }
                ?>
                <br><br><br>
                <hr><br>
                <h3>Fare :</h3>
                <?php
                for ($i = 0; $i < count($seats); $i++) {
                    $total += $price;
                }
                echo "₹ " . $total;
                ?>
                <h4>Gst % = 5%</h4>
                <h3>Final Price :</h3>
                <?php
                $gst = $total * 0.05;
                $finalprice = $total + $gst;
                echo "₹ " . $finalprice;
                ?>
                <br><br>
                <hr><br>
                <input type="hidden" name="busId" id="busId" value="<?php echo $busId; ?>">
                <input type="hidden" name="busname" id="busname" value="<?php echo $busname; ?>">
                <input type="hidden" name="pickup" id="pickup" value="<?php echo $pickup; ?>">
                <input type="hidden" name="journey" id="journey" value="<?php echo $journey; ?>">
                <input type="hidden" name="drop" id="drop" value="<?php echo $drop; ?>">
                <input type="hidden" name="finalprice" id="finalprice" value="<?php echo $finalprice; ?>">
                <input type="hidden" name="from" id="from" value="<?php echo $from; ?>">
                <input type="hidden" name="to" id="to" value="<?php echo $to; ?>">
                <input type="hidden" name="uniqueNumber" id="uniqueNumber" value="<?php echo $unqiueNumber; ?>">
                <input type="hidden" name="date" id="date" value="<?php echo $date; ?>">
                <?php
                for ($i = 0; $i < 21; $i++) {
                    if ($arraySeats[$i] == 1) {
                ?>
                        <input type="hidden" name="seat[]" value="<?php echo $seatNumbers[$i]; ?>" id="<?php echo $seatNumbers[$i]; ?>">
                <?php
                    }
                }
                ?>

                <input type="submit" name="submit" id="submit" value="Proceed to Payment">
            </div>
        </div>
    </form>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const resizableBox = document.getElementById("resizable-box");

            resizableBox.addEventListener("input", function() {
                // Adjust the size of the box based on the content
                resizableBox.style.width = resizableBox.scrollWidth + "px";
                resizableBox.style.height = resizableBox.scrollHeight + "px";
            });
        });

        function toggleMenu() {
            var dropdown = document.getElementById("dropdownMenu");
            if (dropdown.classList.contains("show")) {
                dropdown.classList.remove("show");
            } else {
                dropdown.classList.add("show");
            }
        }

        function resetSeats() {
            var busId = "<?php echo $busId; ?>"; // Get the bus ID
            var seatsToReset = []; // Array to hold seats to reset

            <?php
            // Generate JavaScript code for selected seats
            for ($i = 0; $i < 21; $i++) {
                if ($arraySeats[$i] == 1) {
                    echo 'seatsToReset.push("' . $seatNumbers[$i] . '");';
                }
            }
            ?>

            // Send a request to the reset script
            fetch('reset_seats.php?busId=' + busId + '&seats=' + JSON.stringify(seatsToReset))
                .then(response => response.text())
                .then(data => console.log(data))
                .catch(error => console.error('Error:', error));
        }
        resetSeats();
        // Set a timer to reset seats after 5 minutes (300000 milliseconds)
        setTimeout(resetSeats, 300000);
    </script>
</body>

</html>
<?php


// Close the database connection
mysqli_close($con);
?>