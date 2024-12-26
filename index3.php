<?php

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
            background: url(Images/background1.jpg);
            height: 100vh;
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


        .body1 {
            font-family: Arial, sans-serif;
            background: url(Images/background1.jpg) no-repeat center center fixed;
            background-size: cover;
            display: flex;
            justify-content: center;
            flex-direction: column;
            align-items: center;
            height: 1000px;
            gap: 20px;
            margin-top: 20px;
        }

        .bus {
            background-color: #3c3c3c;
            border: 2px solid #ccc;
            padding: 20px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            border-radius: 20px;
        }

        .row {
            display: flex;
            align-items: center;
            margin-bottom: 1px;
            gap: 45px;
        }

        .seat {
            width: 50px;
            height: 50px;
            background-color: white;
            margin: 30px;
            display: flex;
            justify-content: center;
            align-items: center;
            cursor: pointer;
            border-radius: 15px;
        }

        .seat.selected {
            background-color: #6cff61;
        }

        .seat img {
            width: 30px;
            height: 30px;
        }

        .driver img {
            width: 30px;
            height: 30px;
        }

        .driver {
            background-color: #ffcc00;
            margin-right: 20px;
            width: 140px;
            height: 50px;
            margin: 30px;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .single {
            margin-right: 20px;
        }

        .seats-pair {
            display: flex;
        }

        .door {
            margin-right: 20px;
            width: 70px;
            height: 50px;
            background-color: #c5c0c0;
            margin: 30px;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .door img {
            width: 30px;
            height: 30px;
        }

        .seat-selection {
            display: flex;
            justify-content: center;
            align-items: center;
            flex-direction: column;
        }

        #seat-btn {
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

        #seat-btn:hover {
            background-color: rgb(255, 227, 104);
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.3);
            transform: scale(1.1);
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

            .seat {
                width: 50px;
                height: 50px;
                background-color: white;
                margin: 30px;
                display: flex;
                justify-content: center;
                align-items: center;
                cursor: pointer;
                border-radius: 15px;
            }

            .body1 {
                font-family: Arial, sans-serif;
                background: url(Images/background1.jpg) no-repeat center center fixed;
                background-size: cover;
                display: flex;
                justify-content: center;
                flex-direction: column;
                align-items: center;
                height: 1000px;
                gap: 20px;
                margin-top: auto;
            }

            .bus {
                background-color: #3c3c3c;
                border: 2px solid #ccc;
                padding: 0px;
                margin: 10px;
                box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
                border-radius: 20px;
            }

            .door {
                margin: 5px;
            }

            .driver {
                margin: 13px;
            }

            .row {
                display: flex;
                align-items: center;
                gap: 45px;
            }
            .seat{
                margin: 14px;
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
    <?php
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
    $arraySeats = array_fill(0, 21, 0);
    $query = "SELECT * FROM `seatdetail` WHERE `busid` = $busId";
    $query1 = "SELECT * FROM `temp_seat` WHERE `busid` = $busId";
    $result = mysqli_query($con, $query);
    $result1 = mysqli_query($con, $query1);
    $arraySeats1 = array_fill(0, 21, 0);
    while ($row = mysqli_fetch_assoc($result)) {
        for ($i = 0; $i < 21; $i += 1) {
            if ($row[$seatNumbers[$i]] == 1) {
                $arraySeats[$i] = 1;
            }
        }
    }
    while ($row1 = mysqli_fetch_assoc($result1)) {
        for ($i = 1; $i <= 21; $i += 1) { // Loop through columns 1 to 21
            if ($row1[$i] == 1) {
                $arraySeats1[$i - 1] = 1; // Set seat to 1 if the column value is 1
            }
        }
    }
    ?>
    <div class="body1">
        <div class="bus">
            <div class="row">
                <div class="door">
                    <img src="Images/door.png" alt="Seat">
                    <p><b>Exit</b></p>
                </div>
                <div class="driver">
                    <img src="Images/seat.png" alt="Driver Seat">
                    <p><b>Driver</b></p>
                </div>
            </div>
            <div class="row">
                <div class="seat single" id="one" <?php if ($arraySeats[0] == 1) echo 'style="background: red"'; elseif ($arraySeats1[0] == 1) echo 'style="background: yellow"'; ?> data-selected="false" onclick="toggleSelect(this)">
                    <h4>1</h4>
                    <img src="Images/seat.png" alt="Seat">
                </div>
                <div class="seats-pair">
                    <div class="seat" id="two" <?php if ($arraySeats[1] == 1) echo 'style="background: red"'; elseif ($arraySeats1[1] == 1) echo 'style="background: yellow"'; ?> data-selected="false" onclick="toggleSelect(this)">
                        <h4>2</h4>
                        <img src="Images/seat.png" alt="Seat">
                    </div>
                    <div class="seat" id="three" <?php if ($arraySeats[2] == 1) echo 'style="background: red"'; elseif ($arraySeats1[2] == 1) echo 'style="background: yellow"'; ?> data-selected="false" onclick="toggleSelect(this)">
                        <h4>3</h4>
                        <img src="Images/seat.png" alt="Seat">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="seat single" id="four" <?php if ($arraySeats[3] == 1) echo 'style="background: red"'; elseif ($arraySeats1[3] == 1) echo 'style="background: yellow"'; ?> data-selected="false" onclick="toggleSelect(this)">
                    <h4>4</h4>
                    <img src="Images/seat.png" alt="Seat">
                </div>
                <div class="seats-pair">
                    <div class="seat" id="five" <?php if ($arraySeats[4] == 1) echo 'style="background: red"'; elseif ($arraySeats1[4] == 1) echo 'style="background: yellow"'; ?> data-selected="false" onclick="toggleSelect(this)">
                        <h4>5</h4>
                        <img src="Images/seat.png" alt="Seat">
                    </div>
                    <div class="seat" id="six" <?php if ($arraySeats[5] == 1) echo 'style="background: red"'; elseif ($arraySeats1[5] == 1) echo 'style="background: yellow"'; ?> data-selected="false" onclick="toggleSelect(this)">
                        <h4>6</h4>
                        <img src="Images/seat.png" alt="Seat">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="seat single" id="seven" <?php if ($arraySeats[6] == 1) echo 'style="background: red"'; elseif ($arraySeats1[6] == 1) echo 'style="background: yellow"'; ?> data-selected="false" onclick="toggleSelect(this)">
                    <h4>7</h4>
                    <img src="Images/seat.png" alt="Seat">
                </div>
                <div class="seats-pair">
                    <div class="seat" id="eight" <?php if ($arraySeats[7] == 1) echo 'style="background: red"'; elseif ($arraySeats1[7] == 1) echo 'style="background: yellow"'; ?> data-selected="false" onclick="toggleSelect(this)">
                        <h4>8</h4>
                        <img src="Images/seat.png" alt="Seat">
                    </div>
                    <div class="seat" id="nine" <?php if ($arraySeats[8] == 1) echo 'style="background: red"'; elseif ($arraySeats1[8] == 1) echo 'style="background: yellow"'; ?> data-selected="false" onclick="toggleSelect(this)">
                        <h4>9</h4>
                        <img src="Images/seat.png" alt="Seat">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="seat single" id="ten" <?php if ($arraySeats[9] == 1) echo 'style="background: red"'; elseif ($arraySeats1[9] == 1) echo 'style="background: yellow"'; ?> data-selected="false" onclick="toggleSelect(this)">
                    <h4>10</h4>
                    <img src="Images/seat.png" alt="Seat">
                </div>
                <div class="seats-pair">
                    <div class="seat" id="eleven" <?php if ($arraySeats[10] == 1) echo 'style="background: red"'; elseif ($arraySeats1[10] == 1) echo 'style="background: yellow"'; ?> data-selected="false" onclick="toggleSelect(this)">
                        <h4>11</h4>
                        <img src="Images/seat.png" alt="Seat">
                    </div>
                    <div class="seat" id="twelve" <?php if ($arraySeats[11] == 1) echo 'style="background: red"'; elseif ($arraySeats1[11] == 1) echo 'style="background: yellow"'; ?> data-selected="false" onclick="toggleSelect(this)">
                        <h4>12</h4>
                        <img src="Images/seat.png" alt="Seat">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="seat single" id="thirteen" <?php if ($arraySeats[12] == 1) echo 'style="background: red"'; elseif ($arraySeats1[12] == 1) echo 'style="background: yellow"'; ?> data-selected="false" onclick="toggleSelect(this)">
                    <h4>13</h4>
                    <img src="Images/seat.png" alt="Seat">
                </div>
                <div class="seats-pair">
                    <div class="seat" id="fourteen" <?php if ($arraySeats[13] == 1) echo 'style="background: red"'; elseif ($arraySeats1[13] == 1) echo 'style="background: yellow"'; ?> data-selected="false" onclick="toggleSelect(this)">
                        <h4>14</h4>
                        <img src="Images/seat.png" alt="Seat">
                    </div>
                    <div class="seat" id="fifteen" <?php if ($arraySeats[14] == 1) echo 'style="background: red"'; elseif ($arraySeats1[14] == 1) echo 'style="background: yellow"'; ?> data-selected="false" onclick="toggleSelect(this)">
                        <h4>15</h4>
                        <img src="Images/seat.png" alt="Seat">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="seat single" id="sixteen" <?php if ($arraySeats[15] == 1) echo 'style="background: red"'; elseif ($arraySeats1[15] == 1) echo 'style="background: yellow"'; ?> data-selected="false" onclick="toggleSelect(this)">
                    <h4>16</h4>
                    <img src="Images/seat.png" alt="Seat">
                </div>
                <div class="seats-pair">
                    <div class="seat" id="seventeen" <?php if ($arraySeats[16] == 1) echo 'style="background: red"'; elseif ($arraySeats1[16] == 1) echo 'style="background: yellow"'; ?> data-selected="false" onclick="toggleSelect(this)">
                        <h4>17</h4>
                        <img src="Images/seat.png" alt="Seat">
                    </div>
                    <div class="seat" id="eighteen" <?php if ($arraySeats[17] == 1) echo 'style="background: red"'; elseif ($arraySeats1[17] == 1) echo 'style="background: yellow"'; ?> data-selected="false" onclick="toggleSelect(this)">
                        <h4>18</h4>
                        <img src="Images/seat.png" alt="Seat">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="seat single" id="nineteen" <?php if ($arraySeats[18] == 1) echo 'style="background: red"'; elseif ($arraySeats1[18] == 1) echo 'style="background: yellow"'; ?> data-selected="false" onclick="toggleSelect(this)">
                    <h4>19</h4>
                    <img src="Images/seat.png" alt="Seat">
                </div>
                <div class="seats-pair">
                    <div class="seat" id="twenty" <?php if ($arraySeats[19] == 1) echo 'style="background: red"'; elseif ($arraySeats1[19] == 1) echo 'style="background: yellow"'; ?> data-selected="false" onclick="toggleSelect(this)">
                        <h4>20</h4>
                        <img src="Images/seat.png" alt="Seat">
                    </div>
                    <div class="seat" id="twentyone" <?php if ($arraySeats[20] == 1) echo 'style="background: red"'; elseif ($arraySeats1[20] == 1) echo 'style="background: yellow"'; ?> data-selected="false" onclick="toggleSelect(this)">
                        <h4>21</h4>
                        <img src="Images/seat.png" alt="Seat">
                    </div>
                </div>
            </div>
        </div>
        <div class="seat-selection">
            <button id="seat-btn" onclick="countSelectedSeats()">Book Seats</button>
        </div>
    </div>

    <script>
        function toggleSelect(element) {
            const isSelected = element.getAttribute('data-selected') === 'true';
            element.setAttribute('data-selected', !isSelected);
            if (isSelected) {
                element.classList.remove('selected');
            } else {
                element.classList.add('selected');
            }
        }

        function countSelectedSeats() {
            const selectedSeats = document.querySelectorAll('.seat.selected');
            let url = "seatbooking.php?busId=<?php echo $busId ?>&busname=<?php echo $busname ?>&pickup=<?php echo $pickup ?>&journey=<?php echo $journey ?>&drop=<?php echo $drop ?>&price=<?php echo $price ?>&from=<?php echo $from ?>&to=<?php echo $to ?>&date=<?php echo $date ?>&";
            selectedSeats.forEach((seats) => {
                let seat = seats.id;
                url = url + seat + "=1&";
            });
            const count = selectedSeats.length;
            window.location = url;
        }

        function toggleMenu() {
            var dropdown = document.getElementById("dropdownMenu");
            if (dropdown.classList.contains("show")) {
                dropdown.classList.remove("show");
            } else {
                dropdown.classList.add("show");
            }
        }
    </script>
</body>

</html>