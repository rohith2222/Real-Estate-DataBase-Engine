<?php
  // Check if user is logged in
  session_start();
  if (!isset($_SESSION['buyer_id'])) {
    header("Location: buyerlogin.php");
    exit();
  }
  $buyer_id = $_SESSION['buyer_id'];
    // Connect to the database
    $conn = pg_connect("host=localhost port=5432 dbname=real_estate user=postgres password=1234");

    if (!$conn) {
        echo "An error occurred while connecting to the database.\n";
        exit;
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<style>
    body {
  font-family: Arial, sans-serif;
  background-color: #f2f2f2;
}

.container {
  display: flex;
  max-width: 1200px;
  margin: 0 auto;
}

.sidebar {
  flex: 0 0 200px;
  background-color: #fff;
  border: 1px solid #ccc;
  box-shadow: 0 0 10px rgba(0,0,0,0.2);
  padding: 20px;
}

.sidebar h2 {
  font-size: 24px;
  margin-top: 0;
  margin-bottom: 20px;
}

.sidebar ul {
  list-style: none;
  padding: 0;
  margin: 0;
}

.sidebar li {
  margin-bottom: 10px;
}

.sidebar a {
  display: block;
  padding: 10px 20px;
  background-color: #0077c2;
  color: #fff;
  text-decoration: none;
  border-radius: 5px;
  transition: background-color 0.3s ease;
}

.sidebar a:hover{
  background-color: #005f9d;
}

.content {
  flex: 1;
  background-color: #fff;
  border: 1px solid #ccc;
  box-shadow: 0 0 10px rgba(0,0,0,0.2);
  padding: 20px;
}


button{
    margin-bottom: 10px;
    display: block;
  padding: 10px 20px;
  background-color: #0077c2;
  color: #fff;
  text-decoration: none;
  border-radius: 5px;
  transition: background-color 0.3s ease;
}

</style>
<body>
  <div class="container">
    <div class="sidebar">
      <h2>Dashboard</h2>
      <ul>
        <li><a href="#" id="personal-info-link">Personal Information</a></li>
        <li><a href="#" id="change-password-link">Change Password</a></li>
        <li><a href="#" id="search-properties">Search Properties</a></li>
        <li><a href="#" id="saved-prop">View Saved Searches</a></li>
        <form method="post">
            <button type="submit" name="logout">Logout</button>
        </form>
      </ul>
    </div>
    <div class="content" id="pers">
      <h2>Welcome Buyer!</h2>
    </div>
  </div>
</body>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#personal-info-link').click(function(event) {
                event.preventDefault();
                $.getJSON('buyer_personal_info.php', function(data) {
                    $('#pers').html('<h2>Personal Information</h2><p>Name: ' + data.name + '</p><p>Email: ' + data.email + '</p>');
                });
            });
        });
    </script>
</html>

<?php
// Logout functionality
if (isset($_POST['logout'])) {
  // Destroy the session
  session_destroy();
  
  // Redirect to login page
  header('Location: index.php');
  exit;
}
?>

<script>
  // Get references to the links and the content div
  const changePasswordLink = document.getElementById("change-password-link");
  const savedProp = document.getElementById("saved-prop");
  const contentDiv = document.getElementById("pers");

  // Add an event listener to the "Change Password" link
  changePasswordLink.addEventListener("click", function(event) {
    event.preventDefault(); // prevent the default link behavior
    contentDiv.innerHTML = `
    <style>
    #change-password {
    background-color: #fff;
    padding: 20px;
    width: 400px;
    margin: 0 auto;
    }

    #change-password h3 {
    font-size: 24px;
    margin-bottom: 20px;
    }

    #change-password form {
    display: flex;
    flex-direction: column;
    }

    #change-password label {
    font-size: 16px;
    margin-bottom: 10px;
    }

    #change-password input[type="password"] {
    border: none;
    border-radius: 5px;
    box-shadow: 0px 0px 5px rgba(0, 0, 0, 0.1);
    padding: 10px;
    margin-bottom: 20px;
    font-size: 16px;
    }

    #change-password button[type="submit"] {
    background-color: #007bff;
    color: #fff;
    border: none;
    border-radius: 5px;
    padding: 10px 20px;
    font-size: 16px;
    cursor: pointer;
    transition: all 0.2s ease-in-out;
    }

    #change-password button[type="submit"]:hover {
    background-color: #0062cc;
    }

    </style>
    <div id="change-password" class="tabcontent">
    <h3>Change Password</h3>
    <form action="" method="post">
    <label for="old-password">Old Password:</label>
    <input type="password" id="old-password" name="old-password" required>
    
    <label for="new-password">New Password:</label>
    <input type="password" id="new-password" name="new-password" required>
    
    <label for="confirm-password">Confirm New Password:</label>
    <input type="password" id="confirm-password" name="confirm-password" required>
    
    <button type="submit" name="change-password">Change Password</button>
    </form>
    </div>
    `;
  });

  //Search properties
  const searchProp = document.getElementById("search-properties");
  searchProp.addEventListener("click", function(event) {
    event.preventDefault(); // prevent the default link behavior
    contentDiv.innerHTML = `
    <style>
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
    </style>
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
      </div>    `;
  });

  
  savedProp.addEventListener("click", function(event) {
    event.preventDefault(); // prevent the default link behavior
    contentDiv.innerHTML = `
<div id="saved-searches" class="tabcontent">
  <h3>Saved Searches</h3>
  <table>
    <thead>
      <tr>
        <th>Property Type</th>
        <th>Address</th>
        <th>City</th>
        <th>State</th>
        <th>Zip Code</th>
        <th>Price</th>
        <th>Beds</th>
        <th>Baths</th>
        <th>Square Feet</th>
        <th>Seller Details</th>
      </tr>
    </thead>
    <tbody>
    </tbody>
  </table>
</div>
    `;
  });


</script>

<?php
    // Connect to the database
    if(isset($_POST['location']) || isset($_POST['price-range']) || isset($_POST['bedrooms'])){

        $conn = pg_connect("host=localhost port = 5432 dbname=real_estate user=postgres password=1234");

        if (!$conn) {
            echo "An error occurred while connecting to the database.\n";
            exit;
        }

        // Build the query based on the search criteria
        $query = "SELECT * FROM properties WHERE id IN (SELECT property_id FROM listings WHERE status='For Sale')";
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
            echo "<div class='sidebar'>";
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
            echo "<td>";
            echo "<form method='post' action=''>";
            echo "<input type='hidden' name='user_id' value='$buyer_id'>";
            echo "<input type='hidden' name='property_id' value='" . $row['id'] . "'>";
            echo "<button type='submit' name='save_property'>Save Property</button>";
            echo "</form>";
            echo "</td>";
            echo "</tr>";
            } 
            echo "</table>";
            echo "</div>";
        }
        // Close the database connection
        pg_close($conn);
    }
    ?>

<?php
if (isset($_POST['change-password'])) {
  // Get the entered passwords
  $old_password = $_POST['old-password'];
  $new_password = $_POST['new-password'];
  $confirm_password = $_POST['confirm-password'];

  // Retrieve the user's current password from the database
  $conn = pg_connect("host=localhost port=5432 dbname=real_estate user=postgres password=1234");
  $user_id = $_SESSION['buyer_id'];
  $query = "SELECT password FROM buyers WHERE id = $user_id";
  $result = pg_query($conn, $query);
  $row = pg_fetch_assoc($result);
  $current_password = $row['password'];
  
  // Verify that the old password matches the user's current password
  if ($old_password != $current_password) {
    echo "<script>alert('Invalid old password. Please try again.');</script>";
  } 
  // Verify that the new password and confirm password fields match
  else if ($new_password != $confirm_password) {
    echo "<script>alert('New password and confirm password fields do not match. Please try again.');</script>";
  }
  // Update the user's password in the database
  else {
    $query = "UPDATE buyers SET password = '$new_password' WHERE id = $user_id";
    $result = pg_query($conn, $query);
    echo "<script>alert('Password successfully updated.');</script>";
  }
  // Close the database connection
  pg_close($conn);
}

?>


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
        echo "<script>alert(An error occurred while executing the query.);</script>";
        exit;
    }
        $row = pg_fetch_assoc($result);
        $listing_id = $row['id'];

    // Check if the property has already been saved by the user
    $query = "SELECT * FROM saved_searches WHERE user_id = '$user_id' AND listing_id = '$listing_id'";
    $result = pg_query($conn, $query);

    if (!$result) {
        echo "<script>alert(The property has already been saved by the user);</script>";
        exit;
    }

    // If the property hasn't been saved, insert a new record into the saved_searches table
    if (pg_num_rows($result) == 0) {
        $query = "INSERT INTO saved_searches (user_id, listing_id) VALUES ('$user_id', '$listing_id')";
        $result = pg_query($conn, $query);

        if (!$result) {
            echo "<script>alert(An error occurred while saving the details.);</script>";
            exit;
        }

        echo "<script>alert(The property has been saved.);</script>";
    } else {
        echo "<script>alert(The property has already been saved.);</script>";
    }

    // Close the database connection
    pg_close($conn);
}
?>
