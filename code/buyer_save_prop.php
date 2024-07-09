<?php
if (isset($_POST['save_property'])) {
    // Get the user ID from the session
    $user_id = $_POST['user_id'];

    // Get the property ID from the form
    $property_id = $_POST['property_id'];

    // Connect to the database
    $conn = pg_connect("host=localhost port=5432 dbname=real_estate user=postgres password=1234");

    if (!$conn) {
        echo "An error occurred while connecting to the database.\n";
        exit;
    }

    $query = "SELECT * FROM listings WHERE property_id = '$property_id'";
    $result = pg_query($conn, $query);

    if (!$result) {
        echo "<script>alert(An error occurred while executing the query.)</script>";
        exit;
    }

    if (pg_num_rows($result) == 1) {
        $row = pg_fetch_assoc($result);
        $listing_id = $row['id'];
    }

    // Check if the property has already been saved by the user
    $query = "SELECT * FROM saved_searches WHERE user_id = '$user_id' AND listing_id = '$listing_id'";
    $result = pg_query($conn, $query);

    if (!$result) {
        echo "<script>alert(The property has already been saved by the user)</script>";
        exit;
    }

    // If the property hasn't been saved, insert a new record into the saved_searches table
    if (pg_num_rows($result) == 0) {
        $query = "INSERT INTO saved_searches (user_id, listing_id) VALUES ('$user_id', '$listing_id')";
        $result = pg_query($conn, $query);

        if (!$result) {
            echo "<script>alert(An error occurred while saving the details.)</script>";
            exit;
        }

        echo "<script>alert(The property has been saved.)</script>";
    } else {
        echo "<script>alert(The property has already been saved.)</script>";
    }

    // Close the database connection
    pg_close($conn);
}
?>
