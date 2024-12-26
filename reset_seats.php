<?php
include "config.php"; // Include your database configuration

if (isset($_GET['busId']) && isset($_GET['seats'])) {
    $busId = $_GET['busId'];
    $seats = json_decode($_GET['seats']); // Decode the seats array

    $resetQuery = "UPDATE `temp_seat` SET ";
    
    // Prepare the reset query for each seat
    foreach ($seats as $seat) {
        $seatNumber = $seatMap[$seat]; // Map seat name to number
        $resetQuery .= "`$seatNumber` = 0, ";
    }

    $resetQuery = rtrim($resetQuery, ', '); // Remove the last comma
    $resetQuery .= " WHERE `busid` = $busId"; // Add bus ID condition

    if (mysqli_query($con, $resetQuery)) {
        echo "Seats reset successfully!";
    } else {
        echo "Error resetting seats: " . mysqli_error($con);
    }
}

// Close the database connection
mysqli_close($con);
?>
