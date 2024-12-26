<?php
include "config.php";

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

$busId = "";
$busname = "";
$pickup = "";
$journey = "";
$drop = "";
$finalprice =  "";
$from = "";
$to = "";
$seat[] = "";
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
    $unqiueNumber = $_GET['uniqueNumber'];
    $seat = $_GET['seat'];
    $date = $_GET['date'];
}
$api_key = "rzp_test_Bx39GtCIXQIB27"; // Replace with your actual Razorpay API key

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hamar Bus - Payment</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }
        .container {
            max-width: 600px;
            margin: 50px auto;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            padding: 20px;
        }
        h1 {
            text-align: center;
            color: #333;
            font-size: 24px;
        }
        p {
            text-align: center;
            color: #555;
        }
        .details {
            margin: 20px 0;
            padding: 10px;
            background-color: #f7f7f7;
            border-radius: 5px;
        }
        .details strong {
            color: #333;
        }
        .razorpay-payment-button {
            display: block;
            width: 100%;
            padding: 15px;
            background-color: #7F4E39;
            color: #fff;
            text-align: center;
            font-size: 18px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            margin-top: 20px;
            transition: background-color 0.3s ease;
        }
        .razorpay-payment-button:hover {
            background-color: #633c2f;
        }
        .razorpay-logo {
            display: block;
            margin: 0 auto 20px;
            max-width: 100px;
        }
    </style>
</head>
<body>

<div class="container">
    <h1>Confirm Your Booking</h1>
    <p>Book your journey with ease and travel in comfort! - Apki Yatra, Hamari jimmedari</p>

    <div class="details">
        <p><strong>Bus Name:</strong> <?php echo $busname; ?></p>
        <p><strong>From:</strong> <?php echo $from; ?> <strong>To:</strong> <?php echo $to; ?></p>
        <p><strong>Pickup:</strong> <?php echo $pickup; ?> <strong>Drop:</strong> <?php echo $drop; ?></p>
        <p><strong>Journey Date:</strong> <?php echo $date; ?></p>
        <p><strong>Total Price:</strong> ₹<?php echo $finalprice; ?></p>
    </div>

    <img src="Images/hamar-icon.ico" alt="Hamar Bus Logo" class="razorpay-logo">

    <form action="receipt.php" method="GET">
    <input type="hidden" name="busId" value="<?php echo $busId; ?>">
    <input type="hidden" name="busname" value="<?php echo $busname; ?>">
    <input type="hidden" name="pickup" value="<?php echo $pickup; ?>">
    <input type="hidden" name="journey" value="<?php echo $journey; ?>">
    <input type="hidden" name="drop" value="<?php echo $drop; ?>">
    <input type="hidden" name="finalprice" value="<?php echo $finalprice; ?>">
    <input type="hidden" name="from" value="<?php echo $from; ?>">
    <input type="hidden" name="to" value="<?php echo $to; ?>">
    <input type="hidden" name="date" value="<?php echo $date; ?>">
    <input type="hidden" name="uniqueNumber" value="<?php echo $unqiueNumber; ?>">
    <?php
    foreach ($seat as $s) {
        echo '<input type="hidden" name="seat[]" value="' . $s . '">';
    }
    ?>
    <script
        src="https://checkout.razorpay.com/v1/checkout.js"
        data-key="<?php echo $api_key ?>"
        data-amount="<?php echo $finalprice * 100; ?>"
        data-currency="INR"
        data-id="<?php echo $unqiueNumber; ?>"
        data-buttontext="Pay with Razorpay"
        data-name="Hamar Bus"
        data-description="Book your journey with ease and travel in comfort!"
        data-image="https://upload.wikimedia.org/wikipedia/en/archive/4/41/20230226120915%21Victoria_bus_logo.svg"
        data-prefill.name="<?php echo $_SESSION['name']; ?>"
        data-prefill.email="<?php echo $_SESSION['useremail']; ?>"
        data-theme.color="#7F4E39">
    </script>
    <input type="hidden" custom="Hidden Element" name="hidden" />
    <!-- Remove the custom button -->
</form>
</div>

</body>
</html>
