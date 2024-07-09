<?php
session_start();
if(isset($_SESSION['buyer_id'])) {
    // Connect to the database
    $conn = pg_connect("host=localhost port=5432 dbname=real_estate user=postgres password=1234");

    // Get the user's personal information from the database
    $buyer_id = $_SESSION['buyer_id'];
    $query = "SELECT name, email FROM buyers WHERE id=$buyer_id";
    $result = pg_query($conn, $query);
    $row = pg_fetch_assoc($result);

    // Return the personal information as JSON data
    header('Content-Type: application/json');
    echo json_encode($row);

    // Close the database connection
    pg_close($conn);
}
?>
