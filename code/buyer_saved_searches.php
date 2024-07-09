<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
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
      <?php
        $conn = pg_connect("host=localhost port = 5432 dbname=real_estate user=postgres password=1234");

        if (!$conn) {
            echo "An error occurred while connecting to the database.\n";
            exit;
        }

        $query = "SELECT * FROM listings WHERE user_id='$user_id'";
        $result = pg_query($conn, $query);

        if (!$result) {
          echo "An error occurred while executing the query.\n";
          exit;
        }

        if(1){}
        else{
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
            echo "<button type='submit' name='save_property'>Save Property</button>";
            echo "</form>";
            echo "</td>";
            echo "</tr>";
            }
        }
      ?>
    </tbody>
  </table>
</div>
</body>
</html>
