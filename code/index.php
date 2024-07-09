<!DOCTYPE html>
<html>
  <head>
    <title>Real Estate Search Engine</title>
    <style>
      body {
        font-family: Arial, sans-serif;
        background-color: #f2f2f2;
      }
      .container {
        max-width: 800px;
        margin: 0 auto;
        padding: 20px;
        background-color: #fff;
        border: 1px solid #ccc;
        box-shadow: 0 0 10px rgba(0,0,0,0.2);
      }
      .header {
        text-align: center;
        margin-bottom: 30px;
      }
      .header h1 {
        font-size: 36px;
        margin-top: 0;
      }
      .header p {
        font-size: 20px;
        margin-bottom: 0;
      }
.search-bar {
  display: flex;
  justify-content: center;
  align-items: center;
  margin: 20px 0;
}

.search-bar form {
  display: flex;
  flex-wrap: wrap;
  justify-content: center;
  align-items: center;
}

.search-bar label {
  margin-right: 10px;
}

.search-bar select {
  padding: 5px;
  margin-right: 10px;
  margin-bottom: 10px;
}

.search-bar button {
  padding: 10px 20px;
  background-color: #0077c2;
  color: #fff;
  border: none;
  margin-right: 10px;
  margin-bottom: 10px;
  cursor: pointer;
}

.search-bar button:hover {
  background-color: #005f9d;
}


  .image-slider {
  display: flex;
  justify-content: center;
  align-items: center;
  margin-bottom: 30px;
}

.image-slider img {
  max-width: 70%;
  height: auto;
  margin: 0 10px;
}


.login {
  text-align: right;
  margin-bottom: 20px;
}

.login-button {
  background-color: #0077c2;
  color: #fff;
  padding: 10px 20px;
  border-radius: 5px;
  border: none;
  font-size: 18px;
  cursor: pointer;
  margin-left: 20px;
}

.login-button:hover {
  background-color: #0069d9;
}

    </style>
  </head>
  <body>
    <div class="login">
      <a href="sellerlogin.php"><button class="login-button">Seller Login</button></a>
      <a href="buyerlogin.php"><button class="login-button">Buyer Login</button></a>
    </div>
    <div class="container">
      <div class="header">
        <h1>Welcome to our Real Estate Search Engine</h1>
        <p>Find your dream home today!</p>
        <a href="register.php"><p>Register Here for further info!</p></a>
      </div>
      <div class="image-slider">
        <img src="image2.jpg" alt="House Image 2">
        </div>
      <div class="search-bar">
        <form action="" method="post">
          <label for="location">Location:</label>
          <select name="location" id="location">
            <option value="">Select a location</option>
            <option value="New York City">New York City</option>
            <option value="Syracuse">Syracuse</option>
            <option value="Albany">Albany</option>
            <option value="Buffalo">Buffalo</option>
            <option value="Rochester">Rochester</option>
          </select>
      
          <label for="property">Property Type:</label>
          <select name="property" id="property">
            <option value="">Select a property type</option>
            <option value="Town House">Town House</option>
            <option value="Single Family">Single Family</option>
            <option value="Bungalow">Bungalow</option>
            <option value="Ranch Home">Ranch Home</option>
            <option value="Multi Family">Multi Family</option>
            <option value="Duplex">Duplex</option>
          </select>

          <label for="price-range">Price Range:</label>
          <select name="price-range" id="price-range">
            <option value="">Select a price range</option>
            <option value="0-50000">$0 - $50,000</option>
            <option value="50000-100000">$50,000 - $100,000</option>
            <option value="100000-250000">$100,000 - $250,000</option>
            <option value="250000-500000">$250,000 - $500,000</option>
            <option value="500000+">$500,000+</option>
          </select>

          <label for="bedrooms">Bedrooms:</label>
          <select name="bedrooms" id="bedrooms">
            <option value="">Select number of bedrooms</option>
            <option value="1">1 Bedroom</option>
            <option value="2">2 Bedrooms</option>
            <option value="3">3 Bedrooms</option>
            <option value="4">4 Bedrooms</option>
            <option value="5">5 Bedrooms</option>
            <option value="6">6 Bedrooms</option>
            <option value="7">7 Bedrooms</option>
            <option value="8+">8+ Bedrooms</option>
          </select>
      
          <button type="submit" name="search">Search</button>
          <button type="reset" name="reset">Reset</button>
        </form>
      </div>
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
    </div>

  </body>
</html>



