<?php
// Include database connection script
include 'config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['from']) && isset($_POST['to'])) {
        $from = $_POST['from'];
        $to = $_POST['to'];

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
                $bus1_sql = "SELECT `Bus`, `PickupTime`, `JourneyTime`, `DropTime`, `Price` FROM $table_name LIMIT 1 OFFSET 0";
                $bus1_result = $con->query($bus1_sql);
                if ($bus1_result->num_rows > 0) {
                    $bus1_row = $bus1_result->fetch_assoc();
                    // Assign retrieved values to HTML elements
                    echo "<input type='text' value='" . $bus1_row['Bus'] . "' disabled>";
                    echo "<input type='text' value='" . $bus1_row['PickupTime'] . "' disabled>";
                    echo "<input type='text' value='" . $bus1_row['JourneyTime'] . "' disabled>";
                    echo "<input type='text' value='" . $bus1_row['DropTime'] . "' disabled>";
                    echo "<input type='text' value='" . $bus1_row['Price'] . "' disabled>";
                }

                // Query to retrieve details for the second bus
                $bus2_sql = "SELECT `Bus`, `PickupTime`, `JourneyTime`, `DropTime`, `Price` FROM $table_name LIMIT 1 OFFSET 1";
                $bus2_result = $con->query($bus2_sql);
                if ($bus2_result->num_rows > 0) {
                    $bus2_row = $bus2_result->fetch_assoc();
                    // Assign retrieved values to HTML elements
                    echo "<input type='text' value='" . $bus2_row['Bus'] . "' disabled>";
                    echo "<input type='text' value='" . $bus2_row['PickupTime'] . "' disabled>";
                    echo "<input type='text' value='" . $bus2_row['JourneyTime'] . "' disabled>";
                    echo "<input type='text' value='" . $bus2_row['DropTime'] . "' disabled>";
                    echo "<input type='text' value='" . $bus2_row['Price'] . "' disabled>";
                }
            } else {
                echo "No routes found for the selected cities.";
            }
        } else {
            echo "Database connection failed.";
        }
    } else {
        echo "Invalid input.";
    }
}
?>
