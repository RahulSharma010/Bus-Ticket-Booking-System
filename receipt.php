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
$finalprice =  "";
$from = "";
$to = "";
$seat[] = "";
$unqiueNumber = "";
$date = "";

if (isset($_GET['busId']) && isset($_GET['busname']) && isset($_GET['pickup']) && isset($_GET['journey']) && isset($_GET['drop']) && isset($_GET['finalprice']) && isset($_GET['from']) && isset($_GET['to']) && isset($_GET['uniqueNumber'])) {
    $busId = $_GET['busId'];
    $busname = $_GET['busname'];
    $pickup = $_GET['pickup'];
    $journey = $_GET['journey'];
    $drop = $_GET['drop'];
    $finalprice = $_GET['finalprice'];
    $from = $_GET['from'];
    $to = $_GET['to'];
    $seat = $_GET['seat'];
    $uniqueNumber = $_GET['uniqueNumber'];
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

$arraySeats = array_fill(0, 21, 0);

$array = array_fill(0, 21, 0);
$strseat = "";
$query = "";
$count = 0;
for ($i = 0; $i < 21; $i += 1) {
    if (in_array($seatNumbers[$i], $seat)) {
        $arraySeats[$i] = 1;
        $array[$count++] = $i + 1;
        $query .= "`" . $seatNumbers[$i] . "`=1 ,";
        $strseat = $strseat . "_" . ($i + 1);
    }
    //echo $seatNumbers[$i];
    //echo $query;
}

$userid = $_SESSION['userid'];
$username = $_SESSION['username'];
$useremail = $_SESSION['useremail'];

$curr_date = date("Y-m-d"); // Current date in YYYY-MM-DD format
$curr_time = date("H:i:s");

$len = strlen($query);
$query = substr($query, 0, $len - 2); // Trimming the last two characters, typically a trailing comma
$query1 = "UPDATE `seatdetail` SET $query WHERE `busid` = '$busId'";
$query2 = "INSERT INTO `bookeduser`(`userid`, `busid`,`name`, `email`, `ticketid`,`journey_date`,`booked_time`,`booked_date`, `seat`) VALUES ('$userid','$busId','$username','$useremail','$uniqueNumber','$date','$curr_time','$curr_date','$strseat')";

// Establish the database connection
$con = mysqli_connect('localhost', 'root', '', 'user');

// Check the connection.
if (!$con) {
    die("Connection failed: " . mysqli_connect_error());
}

// Execute the query
if (mysqli_query($con, $query1)) {
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
<?php
} else {
    echo "Error updating record: " . mysqli_error($con);
}

if (mysqli_query($con, $query2)) {
?>
<?php
} else {
    echo "Error updating record: " . mysqli_error($con);
}
// Close the database connection
mysqli_close($con);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hamar Bus Ticket Booking Service</title>
    <link rel="icon" type="image/icon" href="Images/hamar-icon.ico">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.10.2/html2pdf.bundle.min.js"></script>
    <style>
        body,
        html {
            margin: 0;
            padding: 0;
            font-family: Arial, sans-serif;
            background-color: white;
            height: 100vh;
        }

        .details {
            display: flex;
            justify-content: center;
            align-items: center;
            flex-direction: column;
            padding: 20px;
            font-size: 1.8rem;
            min-height: 100vh;
            box-sizing: border-box;
        }

        #download {
            background-color: rgb(232, 167, 38);
            border: 2px solid black;
            color: rgb(0, 0, 0);
            font-size: 1rem;
            padding: 10px 20px;
            border-radius: 20px;
            transition: background-color 0.25s, box-shadow 0.3s ease;
            cursor: pointer;
            transition: transition 0.3s;
        }

        #download:hover {
            background-color: rgb(255, 227, 104);
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.3);
            transform: scale(1.1);
        }

        table {
            border-collapse: collapse;
            width: 100%;
            max-width: 600px;
            margin-bottom: 20px;
        }

        table th,
        table td {
            padding: 10px;
            text-align: left;
            border: 1px solid black;
            font-size: 1rem;
            word-wrap: break-word;
        }

        @media (max-width: 768px) {
            .details {
                font-size: 1.2rem;
                padding: 10px;
                min-height: auto;
            }

            #download {
                font-size: 0.9rem;
                padding: 8px 16px;
            }

            table th,
            table td {
                font-size: 0.9rem;
            }
        }

        @media (max-width: 480px) {
            .details {
                font-size: 1rem;
                padding: 10px;
            }

            #download {
                font-size: 0.8rem;
                padding: 6px 12px;
            }

            table {
                width: 100%;
                font-size: 0.8rem;
            }

            table th,
            table td {
                font-size: 0.7rem;
                padding: 6px;
            }

            h2 {
                font-size: 1.4rem;
            }

            .details {
                font-size: 0.9rem;
            }

            img {
                width: 60px;
                height: auto;
            }

            h1 {
                font-size: 1.2rem;
            }
        }
    </style>
</head>

<body>
    <div class="details" id="invoice">
        <div style="display:flex; gap:20px; align-items:center;">
            <img src="Images/hamar-icon.ico" alt="" style="width:100px; height:auto">
            <h1 style="font-size: 1em;"><u>Hamar Bus Services</u></h1>
            <img src="Images/hamar-icon.ico" alt="" style="width:100px; height:auto">
        </div>
        <h2>BUS BOOKING CONFIRMED !!</h2>

        <table border="3">
            <tr>
                <th>Data</th>
                <th>Value</th>
            </tr>
            <tr>
                <td>Passenger Name</td>
                <td><?php echo $username ?></td>
            </tr>
            <tr>
                <td>Passenger Mail</td>
                <td><?php echo $useremail ?></td>
            </tr>
            <tr>
                <td>Unique Ticket ID</td>
                <td><?php echo $uniqueNumber ?></td>
            </tr>
            <tr>
                <td>Bus ID</td>
                <td><?php echo $busId ?></td>
            </tr>
            <tr>
                <td>Bus Name</td>
                <td><?php echo $busname ?></td>
            </tr>
            <tr>
                <td>Bus Pickup Time</td>
                <td><?php echo $pickup ?></td>
            </tr>
            <tr>
                <td>Bus Drop Time</td>
                <td><?php echo $drop ?></td>
            </tr>
            <tr>
                <td>Bus Total Journey Duration</td>
                <td><?php echo $journey ?></td>
            </tr>
            <tr>
                <td>Bus Pickup Location</td>
                <td><?php echo $from ?></td>
            </tr>
            <tr>
                <td>Bus Destination Location</td>
                <td><?php echo $to ?></td>
            </tr>
            <tr>
                <td>Seat Numbers Booked</td>
                <td><?php
                    for ($i = 0; $i < 21; $i++) {
                        if ($array[$i] != 0) {
                            echo $array[$i] . " ";
                        }
                    }
                    ?></td>
            </tr>
            <tr>
                <td>Total Amount Paid</td>
                <td><?php echo "₹" . $finalprice ?></td>
            </tr>
        </table>
        <button id="download">Print Ticket</button>
        <div style="display:flex; justify-content: center;">
            <span style="font-size: 0.5em;">Copyright © 2024 Hamar Bus®. All rights reserved.</span>
        </div>
    </div>
    <script>
        window.addEventListener('popstate', function(event) {
            window.location.href = "index1.php"; // Replace with the URL of your current page
        });

        window.onload = function() {
            document.getElementById("download").addEventListener("click", () => {
                const downloadButton = document.getElementById("download");
                downloadButton.style.display = 'none'; // Hide the button during PDF generation

                const invoice = document.getElementById("invoice");

                const opt = {
                    margin: 0.5, // Adjust margins for better mobile fit
                    filename: 'booking-confirmation.pdf',
                    image: {
                        type: 'jpeg',
                        quality: 0.98
                    },
                    html2canvas: {
                        scale: window.innerWidth > 768 ? 2 : 1.5 // Scale for mobile devices
                    },
                    jsPDF: {
                        unit: 'in',
                        format: 'letter',
                        orientation: 'portrait'
                    }
                };

                html2pdf().from(invoice).set(opt).save().then(() => {
                    downloadButton.style.display = 'block'; // Re-display button after download
                    setTimeout(() => {
                        window.location.href = "index1.php";
                    }, 2000);
                }).catch((error) => {
                    console.error('Download failed:', error);
                    downloadButton.style.display = 'block'; // In case of error, show button again
                    alert('Error downloading PDF. Please try again or use a different device.');
                });
            });
        };
    </script>

</body>

</html>