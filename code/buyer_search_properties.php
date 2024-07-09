<?php
    // Connect to the database
    if(isset($_POST['location']) || isset($_POST['price-range']) || isset($_POST['bedrooms'])){

        $conn = pg_connect("host=localhost port = 5432 dbname=real_estate user=postgres password=1234");

        if (!$conn) {
            echo "An error occurred while connecting to the database.\n";
            exit;
        }

        // Build the query based on the search criteria
        $query = "SELECT * FROM properties WHERE id IN (SELECT property_id FROM listings)";
        //SELECT p.* FROM properties p JOIN listings l ON p.id = l.property_id WHERE 1=1
        
        $location = $_POST['location'];
        $price_range = $_POST['price-range'];
        $bedrooms = $_POST['bedrooms'];
        $property = $_POST['property'];

        // Retrieve search criteria from the form
        if (!empty($location)) {
            $query .= " AND city = '$location'";
        }

        if (!empty($property)) {
          $query .= " AND property_type = '$property'";
        }

        if (!empty($price_range)) {
            $range = explode("-", $price_range);
            $min_price = $range[0];
            $max_price = $range[1] == "+" ? "99999999" : $range[1];
            $query .= " AND price >= $min_price AND price <= $max_price";
        }

        if (!empty($bedrooms)) {
            $bedrooms = $_POST['bedrooms'];
            if ($bedrooms == "8+") {
                $query .= " AND beds >= 8";
            } else {
                $query .= " AND beds = $bedrooms";
            }
        }
        $query .= " ORDER BY price ASC";
        // Execute the query
        $result = pg_query($conn, $query);

        // Check for errors in the query
        if (!$result) {
        echo "An error occurred while executing the query.\n";
        exit;
        }
        else{
            // Display the search results
            echo "<div class='container'>";
            echo "<h2>Search Results:</h2>";
            echo "<table>";
            echo "<tr><th>Property Type</th><th>Address</th><th>City</th><th>State</th><th>Zip Code</th><th>Bedrooms</th><th>Bathrooms</th><th>Square Feet</th><th>Price</th>   </tr>";
            while ($row = pg_fetch_assoc($result)) {
            echo "<tr>";
            echo "<td>" . $row['property_type'] . "</td>";
            echo "<td>" . $row['address'] . "</td>";
            echo "<td>" . $row['city'] . "</td>";
            echo "<td>" . $row['state'] . "</td>";
            echo "<td>" . $row['zip_code'] . "</td>";
            echo "<td>" . $row['beds'] . "</td>";
            echo "<td>" . $row['baths'] . "</td>";
            echo "<td>" . $row['square_feet'] . "</td>";
            echo "<td>" . $row['price'] . "</td>";
            echo "</tr>";
            }
            echo "</table>";
            echo "</div>";
        }
        // Close the database connection
        pg_close($conn);
    }
    ?>